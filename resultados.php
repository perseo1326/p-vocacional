<?php
    session_start();

    require_once __DIR__ . '/admin/config.php';
    $error = "";
    
    if (isset($_SESSION['usuarioId']) ) {
        require_once __DIR__ . '/funciones.php';
        require __DIR__ . '/session.php';
    
        regLog(__FILE__, __LINE__, "Iniciando analisis de los resultados");
        
        // variable true = las DOS pruebas han sido realizadas
        $pruebasRealizadas = false;
        // Texto para el boton al final de la pagina del grafico
        $botonTexto = "";
        
        $conexion = conexion($db_config);
        if (!$conexion) {
            error("Error en la conexion");
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') 
        {  
        
            regLog(__FILE__, __LINE__, "Comenzando procesamiento de respueatas");

            $area = new Area();
            // cargar la variable "$respuestas" con los valores de la prueba devueltos por POST 
            $respuestas = $_POST;
            $tipoPrueba = $_POST['tipoPrueba'];
            // guarda la categoria ID y su valor de la prueba
            $catValor = [];
            // variable con #ID_user, usuarioId, ID categoria y nombre de la categoria del usuario especificado
            $tipoUsuario;
            
            if ($_POST['tipoPrueba'] == $intereses->getName()) {
                $area = clone $intereses;
                $_SESSION['Intereses'] ['Prueba'] = true;
            } 
            else {
                $area = clone $aptitudes;
                $_SESSION['Aptitudes'] ['Prueba'] = true;
            }

            // variable con #ID_user, usuarioId, ID tipo Usuario y nombre del tipo de usuario (Basico..etc)
            $tipoUsuario = getTipoUsuario($conexion, $_SESSION['usuarioId']);

            regLog(__FILE__, __LINE__, "Obteniendo el tipo de usuario.");

            // obtener la lista de preguntas con su ID y el ID de las categorias
            $pregCat = getPreguntasCategorias($conexion, $area->getTipo());

            regLog(__FILE__, __LINE__, "Obtener las categorias de las preguntas");

            
            if (!$pregCat) {
                error("Error en la conexion.");
                //$error .= " pregcat es igual a vacio.";
            }

            // consultar las categorias y sus detalles 
            $categorias = getCategorias($conexion, $area->getTipo());

            regLog(__FILE__, __LINE__, "Obtener las categorias y sus detalles");

            if (empty($categorias)) {
                error("Error en la conexion.");
            }
            
            // inicializar la variable $catValor[] para almacenar los resultados de la prueba.
            foreach ($categorias as $key => $value) {
                $catValor[($value['catId'])] = 0;
            }
            
            // ******************************************************************************
            // insercion cada una de las respuestas en la base de datos    
            foreach ($respuestas as $clave => $value) {
                if ($value != $tipoPrueba) 
                {
                    if(!setRespuestaPrueba($conexion, $area->getTipo(), $tipoUsuario['ID'], $clave, $pregCat[$clave], $value)) {
                        error("Fallo al transmitir los datos.");
                    }
                $catValor[($pregCat[$clave])] += $value;
                }
            }

            regLog(__FILE__, __LINE__, "Finalizada el guardado de las respuestas en tabla 'resultados'");

            // insertar en la tabla "resultado_resumen" los valores totales de la prueba, segun el area
            foreach ($catValor as $key => $value) {
                setTotalesCategPrueba($conexion, $tipoUsuario['ID'], $key, $value, $area->getTipo());
            }

            regLog(__FILE__, __LINE__, "Guardado los totales de las categorias");


            // insertar en la tabla usuarios la fecha del examen y la fecha de modificacion para el usuario
            setFechaExamen($conexion, $_SESSION['usuarioId'], $area->getTipo());

            regLog(__FILE__, __LINE__, "Actualizacion de la fecha del examen en el usuario");

            setFechaModificacion($conexion, $_SESSION['usuarioId']);

            regLog(__FILE__, __LINE__, "Actualizar la fecha de modificacion del usuario");


            // ******************************************************************************
            // colocar la fecha y hora en la variable de sesion fecha para mostrarla en la bienvenida
            if ($area->getTipo() == TIPO_INTERESES) {
                // date('Y m d  g:i:s a');
                $_SESSION['Intereses']['fecha'] = fecha(date('Y-m-d H:i:s'));
            }
            else {
                $_SESSION['Aptitudes']['fecha'] = fecha(date('Y-m-d H:i:s'));
            }

            // ****** FIN DE LA INSERCION EN LA BASE DE DATOS ******

            //mostrar resultados preliminares
            if ($_SESSION['Intereses']['Prueba'] && $_SESSION['Aptitudes']['Prueba']) {
                // las dos pruebas YA han sido realizadas!!
                // boton -> a esta misma pagina para entrar en la seccion sin formulario, para ver el resultado final
                $botonTexto = "Resultados Generales";
            }
            else {
                // AUN falta realizar alguna prueba, regresar a la bienvenida
                // boton -> regresar a la pagina de bienvenida para terminar las pruebas.
                $botonTexto = "Continuar con la Prueba";
            }
            // Mostrar el grafico de la prueba recien realizada
            // require 'grafico-sencillo.php';
            $grafico_script = 'grafico-sencillo.php';
        } 
        else { 
            //no hay formulario enviado, llegamos desde bienvenida o desde esta misma pagina y las dos pruebas han sido realizadas
            $pruebasRealizadas = true;

            // consultar los resultados de las pruebas y las categorias y sus detalles para el grafico
            $resulIntereses = getResultadosResumen($conexion, $_SESSION['usuarioId'], $_SESSION['Intereses']['id']);
            $catIntereses = getCategorias($conexion, $_SESSION['Intereses']['id']);

            if ($resulIntereses == false OR empty($catIntereses)) {
                error("Error en la conexion.");
            }

            $resulAptitudes = getResultadosResumen($conexion, $_SESSION['usuarioId'], $_SESSION['Aptitudes']['id']);
            $catAptitudes = getCategorias($conexion, $_SESSION['Aptitudes']['id']);
            if ($resulAptitudes == false OR empty($catAptitudes)) {
                error("Error en la conexion.");
            }
            
            // obtener un array simple con los valores de los indices ordenados descendente
            $maxIntereses = obtenerMaximos($resulIntereses);
            $maxAptitudes = obtenerMaximos($resulAptitudes);
            
            // consultar el la ddbb las conclusiones y cargarlas en una variable
            $conclusionesIntereses = getConclusiones($conexion, $_SESSION['Intereses']['id'], $maxIntereses[0], $maxIntereses[1]);

            if (empty($conclusionesIntereses)) {
                //error("No se obtuvieron datos. primera combinacion");
                $conclusionesIntereses = getConclusiones($conexion, $_SESSION['Intereses']['id'], $maxIntereses[1], $maxIntereses[0]);
            }

            if (empty($conclusionesIntereses)) {
                //error("No se obtuvieron datos. Segunda combinacion, invertir el orden de busqueda");
                $conclIntereses = "Los datos no son consistentes. Por favor consulte con su asesor o Psicólogo.";
            }
            else {      
                $conclIntereses = nl2br($conclusionesIntereses['texto']);
            }

            // consultar las conclusiones para el area de Aptitudes
            $conclusionesAptitudes = getConclusiones($conexion, $_SESSION['Aptitudes']['id'], $maxAptitudes[0], $maxAptitudes[0]);
            if (empty($conclusionesAptitudes)) {
                error("Por favor refresque la pagina e ingrese de nuevo.");
            }
            else {
                $conclAptitudesExpli = $conclusionesAptitudes['explicacion'];
                $conclAptitudestexto = $conclusionesAptitudes['texto'];
            }

            // Mostrar grafico completo
            $grafico_script = 'grafico-general.php';
            
            $botonTexto = "Regresar";
        }
        require_once __DIR__ . '/views/resultados.view.php';
    } 
    else {
        header('Location: ' . 'index.php');
    }
    ?>