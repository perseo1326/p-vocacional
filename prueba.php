<?php session_start();

    require_once __DIR__ . '/admin/config.php';

    if (isset($_SESSION['usuarioId'])) 
    {
        require_once __DIR__ . '/funciones.php';
        require __DIR__ . '/session.php';

        //verificar si existe un metodo GET indica que se han recibido datos, 
        //de lo contrario enviar a la pagina de ERROR!
        if ($_SERVER['REQUEST_METHOD'] == 'GET') 
        {
            regLog(__FILE__, __LINE__, "Iniciando pagina del test");

            if ($_GET['prueba'] == $intereses->getName()) {
                $area = clone $intereses;
            } 
            elseif ($_GET['prueba'] == $aptitudes->getName()) {
                $area = clone $aptitudes;
            } 
            else {
                // existe algun error!
                error("Opcion seleccionada incorrecta.");
            }
            
            //conexion a la base de datos
            $conexion = conexion($db_config);
            // si la conexion falla...
            if (!$conexion) {
                error("Error en la conexion.");
            }

            // obtener el conjunto de datos para el area adecuada
            $resultados = obtener_preguntas($conexion, $area->getTipo());
            // si no hay datos, hay ERROR!
            
            if (empty($resultados)) {
                error("Error, no se obtuvieron las preguntas.");
            } 
        }
        require_once __DIR__ . '/views/prueba.view.php';
    } 
    else {
        //echo "No hay sesion, saliendo al index";
        // header('Location: ' . RUTA . 'index.php');
        header('Location: ' . 'index.php');
    }

?>