<?php  session_start();

    require_once __DIR__ . '/config.php';

    if (!isset($_SESSION['usuarioId'])) {
        header('Location: ' . 'index.php');
    } 
    else {
        if ($_SESSION['tipoUsuario'] != PSICOLOGO) {
            header('Location: ' . 'cerrar.php');
        }
    }

    require_once __DIR__ . '/../funciones.php';
    require __DIR__ . '/../session.php';
    $claseError = "";
    $resultados = 
    $busqueda = "";
    $mensaje = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // require_once '../funciones.php';

        regLog(__FILE__, __LINE__, "Iniciando procesamiento POST para 'Config/Index'");


        $nombre = limpiarDatos($_POST['nombre']);
        $apellido1 = limpiarDatos($_POST['apellido1']);
        $apellido2 = limpiarDatos($_POST['apellido2']);
        $tipoFecha = $_POST['tipoFecha'];
        // Validar las fechas
        if($tipoFecha == 'noFecha') {
            $fechaDesde = false;
            $fechaHasta = false;
        } else {
            $fechaDesde  = validateDate($_POST['fechaDesde'], 'Y-m-d') ? $_POST['fechaDesde'] : false;
            $fechaHasta = validateDate($_POST['fechaHasta'], 'Y-m-d') ? $_POST['fechaHasta'] : false;
        }
        
        // si el nombre, apellido1 y apellido2 son vacios = TRUE
        $nombreApellido = (empty($nombre) && empty($apellido1) && empty($apellido2));

        // busqueda sin nombre, apellido1 u apellido2, ni fechas
        if ($nombreApellido && $tipoFecha == 'noFecha') {
            $claseError = "caja-mediana error";
            $mensaje .= "No hay datos para realizar una búsqueda<br />";
        }

        // Busqueda por Nacimiento o examen con fechas invalidas
        if ($tipoFecha != 'noFecha' && (!$fechaDesde || !$fechaHasta)) {
            $claseError = "caja-mediana error";
            $mensaje .= "Las fechas son inválidas<br />"; 
        } 
        else {
            // Busqueda por fecha de nacimiento o Examen con fechas en rango inverso
            if ($tipoFecha != 'noFecha' && !validarRangoFechas($fechaDesde, $fechaHasta)) {
                $claseError = "caja-mediana error";
                $mensaje .= "El rango de las fechas no es válido<br />";
            } 
            else {
                if (calcularDiferenciaYears($fechaDesde, $fechaHasta) > 100) {
                    $claseError = "caja-mediana error";
                    $mensaje .= "El Rango de fechas NO puede ser  mayor a 100 años<br />";
                }
            }
        }

        if ($mensaje == "") {

            regLog(__FILE__, __LINE__, "Iniciando la ejecucion de la Busqueda");

            //crear conexion ddbb 
            $conexion = conexion($db_config);
            if (!$conexion) {
                error("No es posible la conexion.");
            }

            // Busqueda solo con nombres y/o apellidos, SIN fechas
            if (!$nombreApellido && $tipoFecha == 'noFecha') {
                $resultados = buscarNombres($conexion, $nombre, $apellido1, $apellido2);
                $busqueda = "Búsqueda: \"" . $nombre . " " . $apellido1 . " " . $apellido2 . "\"<br />";
                $mensaje = "Encontrados " . sizeof($resultados) . " resultados.";
            }
            
            // Busqueda con o sin nombres y/o apellidos +  fecha de NACIMIENTO
            if ($tipoFecha == 'nacimiento') {
                $resultados = buscarNombresFechaNacimiento($conexion, $nombre, $apellido1, $apellido2, $fechaDesde, $fechaHasta);
                $busqueda = "Búsqueda: \"" . $nombre . " " . $apellido1 . " " . $apellido2 . "\"" . " - Fechas (" . fechaFormato($fechaDesde) . " / " . fechaFormato($fechaHasta) . ")<br />";
                $mensaje = "Encontrados " . sizeof($resultados) . " resultados.";
            }
            
            // Busqueda con o sin nombres y/o apellidos + fecha de EXAMEN
            if ($tipoFecha == 'examen') {
                $resultados = buscarNombresFechaExamen($conexion, $nombre, $apellido1, $apellido2, $fechaDesde, $fechaHasta);
                $busqueda = "Búsqueda: \"" . $nombre . " " . $apellido1 . " " . $apellido2 . "\"" . " - Fechas (" . fechaFormato($fechaDesde) . " / " . fechaFormato($fechaHasta) . ")<br />";
                $mensaje = "Encontrados " . sizeof($resultados) . " resultados.";
            }
        }
    }

    require_once __DIR__ . '/index.view.php';

?>
