
<?php  session_start();

    require_once __DIR__ . '/config.php';
    require __DIR__ . '/../session.php';

    regLog(__FILE__, __LINE__,"Estamos en 'Admin/Usuario.php'"); 

    if (!isset($_SESSION['usuarioId'])) {
        header('Location: ' . RUTA . 'index.php');
    } else {
        if ($_SESSION['tipoUsuario'] != PSICOLOGO) {
            header('Location: ' . RUTA . 'cerrar.php');
        } else {
            require_once __DIR__ . '/../funciones.php';
        }
    } 

    if($_SERVER['REQUEST_METHOD'] == 'GET') 
    {  
        regLog(__FILE__, __LINE__, "Iniciando procesamiento de los datos del usuario");

        $errorIntereses = '';
        $errorAptitudes = '';
        $claseCajaBoton = 'caja-mediana';

        $id = (isset($_GET['id'])) ? $_GET['id'] : false;
        $id = limpiarDatos($id);

        //crear conexion ddbb 
        $conexion = conexion($db_config);
        if (!$conexion) {
            error("No es posible conectar a la base de datos");
        }
        
        // Consultar los datos personales del paciente
        $datosPersonales = getDatosPersonales($conexion, $id);
        if (empty($datosPersonales)) {
            error("No se obtuvieron datos");
            // echo "No se obtuvieron datos";
        }
        // consultar si el usuario ha realizado algun examen previo
        // el usuario realizo la prueba de Intereses?
        $pruebaIntereses = pruebaRealizada($conexion, $intereses->getTipo(), $datosPersonales['usuarioId']);
        $datosPersonales['Intereses']['id'] = TIPO_INTERESES;

        if($pruebaIntereses['Num_preg'] <= 0 ) {
            $datosPersonales['Intereses']['Prueba'] = false;
            $datosPersonales['Intereses']['fecha'] = "Prueba NO realizada!";
            $errorIntereses = "error";
        } 
        else  {
            $datosPersonales['Intereses']['Prueba'] = true;
            $datosPersonales['Intereses']['fecha'] = "Realizada el " . fecha($pruebaIntereses['fExamen']);
        }
        
        // el usuario realizo la prueba de Aptitudes?
        $pruebaAptitudes = pruebaRealizada($conexion, $aptitudes->getTipo(), $datosPersonales['usuarioId']);
        $datosPersonales['Aptitudes']['id'] = TIPO_APTITUDES;

        if($pruebaAptitudes['Num_preg'] <= 0 ) {
            $datosPersonales['Aptitudes']['Prueba'] = false;
            $datosPersonales['Aptitudes']['fecha'] = "Prueba NO realizada!";
            $errorAptitudes = "error";
        }
        else {
            $datosPersonales['Aptitudes']['Prueba'] = true;
            $datosPersonales['Aptitudes']['fecha'] = "Realizada el " . fecha($pruebaAptitudes['fExamen']);
        }

        //verificacion, si las DOS pruebas han sido realizadas => mostrar resumen, sino indicar que la prueba no esta completa!!
        // Si falta alguna prueba por ser realizada NO se mostraran los resultados.
        if ($datosPersonales['Intereses']['Prueba'] && $datosPersonales['Aptitudes']['Prueba']) {
            
            // modificar la clase para alinear el boton de cierre 
            $claseCajaBoton = '';
            // consultar los resultados de las pruebas y las categorias y sus detalles para el grafico
            $resulIntereses = getResultadosResumen($conexion, $datosPersonales['usuarioId'], $datosPersonales['Intereses']['id']);
            // var_dump($resulIntereses);
            $catIntereses = getCategorias($conexion, $intereses->getTipo());
            if ($resulIntereses == false OR empty($catIntereses)) {
                error("No hay conexion a la base de datos.");
                // echo "No hay conexion a la base de datos.";
            }

            $resulAptitudes = getResultadosResumen($conexion, $datosPersonales['usuarioId'], $datosPersonales['Aptitudes']['id']);
            $catAptitudes = getCategorias($conexion, $aptitudes->getTipo());
            if ($resulAptitudes == false OR empty($catAptitudes)) {
                error("No hay conexion a la base de datos.");
                // echo "No hay conexion a la base de datos.";
            }

            // obtener un array simple con los valores de los indices (de "resulIntereses y resulAptitudes") ordenados descendente
            $maxIntereses = obtenerMaximos($resulIntereses);
            $maxAptitudes = obtenerMaximos($resulAptitudes);

            // consultar en la ddbb las conclusiones y cargarlas en una variable
            $conclusionesIntereses = getConclusiones($conexion, $datosPersonales['Intereses']['id'], $maxIntereses[0], $maxIntereses[1]);
            // buscar con la primera combinacion, sino se encuentra pareja entonces invertir la combinacion y buscar otra vez

            if (empty($conclusionesIntereses)) {
                //error("No se obtuvieron datos. primera combinacion");
                $conclusionesIntereses = getConclusiones($conexion, $datosPersonales['Intereses']['id'], $maxIntereses[1], $maxIntereses[0]);
            }

            if (empty($conclusionesIntereses)) {
                //error("No se obtuvieron datos. Segunda combinacion, invertir el orden de busqueda");
                $conclIntereses = "Los datos no son consistentes. Por favor consulte con su asesor o Psicólogo.";
            }
            else {      
                $conclIntereses = nl2br($conclusionesIntereses['texto']);
            }

            // consultar las conclusiones para el area de Aptitudes
            $conclusionesAptitudes = getConclusiones($conexion, $datosPersonales['Aptitudes']['id'], $maxAptitudes[0], $maxAptitudes[0]);
            if (empty($conclusionesAptitudes)) {
                error("Por favor refresque la página e ingrese de nuevo.");
            }
            else {
                $conclAptitudesExpli = $conclusionesAptitudes['explicacion'];
                $conclAptitudestexto = $conclusionesAptitudes['texto'];
            }
            // Mostrar grafico completo
            require_once '../grafico-general.php';
        }

        require_once __DIR__ . '/usuario.view.php';
    }

    // SI hay una actualizacion de datos:
    if($_SERVER['REQUEST_METHOD'] == 'POST') 
    {  
        //crear conexion ddbb 
        $conexion = conexion($db_config);
        if (!$conexion) {
            error("No es posible conectar a la base de datos");
        }
        // limpiar datos
        $id = limpiarDatos($_POST['id']);
        $nombre = limpiarDatos($_POST['nombre']);
        
        $apellido1 = limpiarDatos($_POST['apellido1']);
        $apellido2 = limpiarDatos($_POST['apellido2']);
        $telefono = limpiarDatos($_POST['telefono']);
        $email = limpiarDatos($_POST['email'], 'E');
        $notas = limpiarDatos($_POST['notas']);

        // Actualizacion de los datos del paciente (usuario)
        if(!actualizarUsuario($conexion, $id, $nombre, $apellido1, $apellido2, $email, $telefono, $notas)) {
            error("No fue posible actualizar la información del usuario.");
        }

        // require_once 'usuario.view.php';
        header('Location: ' . RUTA . 'admin/usuario.php?id=' . $id );
        // header('Location: ' . 'admin/usuario.php?id=' . $id );
    }

    ?>
