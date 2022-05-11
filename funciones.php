<?php 
    /* INDICE DE FUNCIONES
    - comprobarSession()
    - limpiarDatos($datos)
    - conexion($db_config)
    - usuarioRegistrado($conexion, $usuarioId)
    - getPassUsuario($conexion, $usuarioId)
    - getTipoUsuario($conexion, $usuarioId)
    - obtener_preguntas($conexion, $areaId)
    - pruebaRealizada($conexion, $areaId, $usuarioId) 
    - getPreguntasCategorias($conexion, $areaId) 
    - setRespuestasPrueba($conexion, $tipoPrueba, $ID_user, $pregId, $categId, $valor)
    - getCategorias ($conexion, $areaId)
    */

    // default_charset = "utf-8";

    // ****************************************************************
    function limpiarDatos($datos, $tipo = 'S') {
        $datos = trim($datos);
        $datos = stripslashes($datos);
        $datos = htmlspecialchars($datos);

        // por defecto tratamos el "$dato" como una cadena, sino "E" OR "e" => Email
        if ($tipo == 'E' || $tipo == 'e') {
            $datos = filter_var($datos, FILTER_SANITIZE_EMAIL);
        } 
        else {
            $datos = filter_var(strtolower($datos), FILTER_SANITIZE_STRING);
            // $datos = filter_var(($datos), FILTER_SANITIZE_STRING);
        }
        return $datos;
    }

    // ****************************************************************
    // funcion para la conexion a la ddbb
    function conexion($db_config) {
        $servername = $db_config['host'];
        $database = $db_config['ddbb_name']; 
        $username = $db_config['ddbb_user'];
        $password = $db_config['ddbb_pass'];
        $dsn = "mysql:host=$servername;dbname=$database;charset=utf8mb4";
        $dsn_Options = [ /*PDO::ATTR_EMULATE_PREPARES => false // turn off emulation mode for 'real' prepared statements */
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // turn on errors in the form of exceptions
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // default fetch an associative array
                        PDO::MYSQL_ATTR_FOUND_ROWS => true ]; // get number of affected rows even on an UPDATE (use $statement->rowCount();)

        // Create a new connection to the MySQL database using PDO, $conexion is an object
        try { 
            $conexion = new PDO($dsn, $username, $password, $dsn_Options);

            regLog(__FILE__, __LINE__, "Conexion a DDBB Exitosa!");

            // error("Connected successfully");
            // $statement = $conexion->prepare("SET NAMES 'utf8';");
            // $statement->execute();
            return $conexion;
        } 

        catch (Exception $error) {
            // catch (PDOException $error) {
            error_log($error->getMessage());
            error('Connection error: ' . $error->getMessage());
            return false;
        }
    }

    // ****************************************************************
    // false => el $usuarioId NO existe en la ddbb
    // $resultados => SI, el $usuarioId existe, ya esta registrado.
    function usuarioRegistrado($conexion, $usuarioId) {
        $statement = $conexion->prepare("SELECT usuarios_usuario AS usuarioId, usuarios_nombres as nombre
                                        FROM usuarios
                                        WHERE usuarios_usuario = :usuarioId" );
        $statement->execute(array(':usuarioId' => $usuarioId));
        $resultados = $statement->fetch();
        if (empty($resultados)) {
            $statement = null;
            return false;
        }
        $statement = null;
        return ($resultados);
    }

    // ****************************************************************
    // funcion para consultar la contraseña de un usuario
    function getPassUsuario($conexion, $usuarioId) {
        $statement = $conexion->prepare("SELECT usuarios_password AS pass 
                                        FROM usuarios
                                        WHERE usuarios_usuario = :usuarioId " );
        $statement->execute(array(':usuarioId' => $usuarioId));
        $resultados =  $statement->fetch();
        $statement = null;
        return ($resultados);
    }

    // ****************************************************************
    // funcion para obtender el id de usuario, el usuarioId, el id de tipo de usuario y su tipo de usuario
    function getTipoUsuario($conexion, $usuarioId) {
        $statement = $conexion->prepare(" SELECT usuarios_id AS ID, usuarios_usuario as usuarioId, 
                                            tipousua_id AS tipoId, tipousua_nombre AS tipoUsuario 
                                            FROM usuarios 
                                            JOIN tipos_usuario 
                                            ON usuarios_tipousuario_id = tipousua_id 
                                            WHERE usuarios_usuario = :usuarioId 
                                            LIMIT 1 ");
        $statement->execute(array(':usuarioId' => $usuarioId));
        $resultado = $statement->fetch();
        $statement = null;
        return $resultado;
    }

    // ****************************************************************
    // funcion para obtener las preguntas conociendo el area = intereses o aptitudes
    function obtener_preguntas($conexion, $areaId) {
        $statement = $conexion->prepare("SELECT preg_id, preg_categ_id, preg_pregunta FROM preguntas
                                        WHERE preg_area = :area AND preg_status = :status_activo LIMIT 10 ");
        $statement->execute(array(':area' => $areaId, ':status_activo' => ACTIVO));
        $resultados = $statement->fetchAll();
        $statement = null;
        return $resultados;
    }

    // ****************************************************************
    // funcion para obtener las preguntas, las categorias y los valores, 
    // conociendo el area y el usuario
    function obtener_preguntas_desc_cat($conexion, $areaId, $usuarioId) {
        $statement = $conexion->prepare(" 
            SELECT preg_id AS pregId, 
            cat_categoria AS categoria, 
            preg_pregunta AS pregunta, 
            resul_valor AS valor,
            '-' AS texto 
            FROM preguntas 
            JOIN categorias 
            ON cat_id = preg_categ_id 
            JOIN resultados 
            ON resul_pregunta_id = preg_id 
            WHERE preg_area = :areaId 
            AND resul_usuario_id = :usuarioId
            AND preg_status = :status_activo ");
        $statement->execute(array(':areaId' => $areaId, ':usuarioId' => $usuarioId, ':status_activo' => ACTIVO));
        $resultados = $statement->fetchAll();
        $statement = null;
        return $resultados;
    }

    // ****************************************************************
    // funcion para conocer si el usuario ha hecho la prueba indicada
    function pruebaRealizada($conexion, $areaId, $usuarioId) {
        // 1. hallar el id del usuario en la tabla usuarios.
        // 2. consultar si hay registros para el id de usuario y el area seleccionada

        $tipoExamen = "";
        if ($areaId == TIPO_INTERESES) {
            $tipoExamen = "usuarios_fExamenIntereses";
        }
        else {
            $tipoExamen = "usuarios_fExamenAptitudes";
        }

        $statement = $conexion->prepare(" SELECT " . $tipoExamen . " AS fExamen, COUNT(resul_pregunta_id) AS Num_preg
                FROM resultados
                JOIN usuarios
                ON resul_usuario_id = usuarios_id
                WHERE usuarios_usuario = :usuarioId
                AND resul_area = :areaId; " );

        regLog(__FILE__, __LINE__, "QUERY: " . $statement->queryString);
                                
        $statement->execute(array(':areaId' => $areaId, ':usuarioId' => $usuarioId));
        $resultados = $statement->fetch();
        
        regLog(__FILE__, __LINE__, "Cantidad de preguntas devueltas: " . $resultados['Num_preg']);

        $statement = null;
        return ($resultados);
    }

    // ****************************************************************
    function getPreguntasCategorias($conexion, $areaId) {
        $statement = $conexion->prepare(" SELECT preg_id AS  preguntaId, 
                                                    preg_categ_id AS categoriaId 
                                            FROM preguntas 
                                            WHERE preg_area = :areaId 
                                            AND preg_status = :status_activo ");
        $statement->execute(array(':areaId' => $areaId, ':status_activo' => ACTIVO));
        $resultados = $statement->fetchAll();

        if (empty($resultados)) {
            return false;
        }

        foreach ($resultados as $elemento => $valores) {
            $y[($valores['preguntaId'])] = $valores['categoriaId']; 
        }
        return $y;
    }

    // ****************************************************************
    // funcion para insertar en la ddbb las respuestas de un tipo de prueba 
    function setRespuestaPrueba($conexion, $tipoPrueba, $ID_user, $pregId, $categId, $valor) {

        regLog(__FILE__, __LINE__, "Registrando las respuestas de la prueba en 'resultados'");

        // indica si la ejecucion de la funcion fue EXITOSA o FALLIDA
        $error = false;

        $statement = $conexion->prepare(" INSERT INTO resultados 
                                                        (resul_id, 
                                                        resul_area, 
                                                        resul_usuario_id, 
                                                        resul_pregunta_id, 
                                                        resul_categoria_id, 
                                                        resul_valor) 
                                            VALUES (NULL, :tipoPrueba, :ID_user, 
                                                    :pregId, :categId, :valor) ");
        $resultados = $statement->execute(array(':tipoPrueba' => $tipoPrueba, 
                                    ':ID_user' => $ID_user, 
                                    ':pregId' => $pregId, 
                                    ':categId' => $categId, 
                                    ':valor' => $valor));
        if ($resultados && $statement->rowCount() == 1) {
            // insercion correcta!!
            $error = true;
        } else {
            // insercion Fallida!!
            $error = false;
        }
        return $error;
    }

    // ****************************************************************
    // funcion para actualizar la fecha de examen del usuario
    function setFechaExamen($conexion, $usuarioId, $areaId)
    {
        regLog(__FILE__, __LINE__, "Ubicados en SetFechaExamen");

        // $tipoExamen = "";
        if ($areaId == TIPO_INTERESES) {
            $tipoExamen = "usuarios_fExamenIntereses";
        }
        else {
            $tipoExamen = "usuarios_fExamenAptitudes";
        }

        $statement = $conexion->prepare(" UPDATE usuarios 
                            SET " . $tipoExamen . " = CURRENT_TIMESTAMP, usuarios_fmodificacion = CURRENT_TIMESTAMP
                            WHERE usuarios_usuario =  :usuarioId ");

        regLog(__FILE__, __LINE__, "EXPRESION SQL: " . $statement->queryString);

        $resultados = $statement->execute(array(':usuarioId' => $usuarioId));

        regLog(__FILE__, __LINE__, "fecha Examen Filas UPDATE: " . $statement->rowCount());

        // if ($resultados && $statement->rowCount() == 1) {
        if ($resultados ) {
            // insercion correcta!!
            $error = true;
        } else {
            // insercion Fallida!!
            $error = false;
        }

        return $error;
    }

    // ****************************************************************
    // funcion para guardar la fecha cuando se genere alguna actualizacion a un usuario
    // Es valido usar "CURRENT_TIMESTAMP" o una variable para el tiempo como en este caso.
    function setFechaModificacion ($conexion, $usuarioId)
    {
        $error = false;
        $tiempo = date("Y-m-d H:i:s");
        regLog(__FILE__, __LINE__, "TIEMPO: " . $tiempo);
        regLog(__FILE__, __LINE__, "Usuario ID: " . $usuarioId);

        $statement = $conexion->prepare(" UPDATE usuarios 
                    SET usuarios_fModificacion = '" . $tiempo . "' 
                    WHERE usuarios_usuario = :usuarioId ");

        regLog(__FILE__, __LINE__, "EXPRESION SQL: " . $statement->queryString);

        $resultados = $statement->execute(array(':usuarioId' => $usuarioId));

        regLog(__FILE__, __LINE__, "fecha Modificacion Filas UPDATE: " . $statement->rowCount());

        // if ($resultados && $statement->rowCount() == 1) {
        if ($resultados ) {
            // insercion correcta!!
            $error = true;
        } else {
            // insercion Fallida!!
            $error = false;
        }
        return $error;
    }

    // ****************************************************************
    // funcion para insertar los datos del total de la prueba segun su area y ID de usuario
    function setTotalesCategPrueba($conexion, $ID_user, $categId, $valor, $areaId) {

        regLog(__FILE__, __LINE__, "Registrando los totales de la prueba en 'resultado_resumen'");

        $statement = $conexion->prepare(" INSERT INTO resultado_resumen
                                (resulResumen_id, 
                                resulResumen_total, 
                                resulResumen_usuario_id, 
                                resulResumen_categoria_id, 
                                resulResumen_area) 
                    VALUES ( NULL, :valor, :ID_user, :categoria, :areaId )" );
        $statement->execute(array(':valor' => $valor, ':ID_user' => $ID_user, ':categoria' => $categId, ':areaId'=> $areaId));
        // $valor = $statement->rowCount();
        return ($statement);
    }

    // ****************************************************************
    // funcion para la consulta de los resultados totales de un area para un usuario determinado 
    function getResultadosResumen($conexion, $usuarioId, $areaId) {
        $statement = $conexion->prepare(" SELECT resulresumen_categoria_id as catId, resulresumen_total as total 
                                FROM resultado_resumen 
                                JOIN usuarios 
                                ON resulresumen_usuario_id = usuarios_id 
                                WHERE usuarios_usuario = :usuarioId 
                                AND resulresumen_area = :areaId 
                                AND usuarios_status = :status_activo ");
        $statement->execute(array(':usuarioId' => $usuarioId, ':areaId' => $areaId, ':status_activo' => ACTIVO));
        $resultados = $statement->fetchAll();
        if(empty($resultados))
            return false;
        foreach ($resultados as $key => $value) {
            $x[$value['catId']] = $value['total'];
        }
            return $x;
    }
    // ****************************************************************
    // funcion para calcular los porcentajes de los valores obtenidos
    // para dibujar el grafico
    function valorPorcentaje ($valor) {
        // maximo de puntos = 24 = 100%
        $valor = ($valor * 100) / 24;
        return round($valor);
    }
    // ****************************************************************
    // funcion para consultar las categorias de un area determinada
    function getCategorias($conexion, $areaId) {
        $statement = $conexion->prepare(" SELECT cat_id AS catId, cat_tipo AS catTipo, 
                                            cat_categoria as catNombre, 
                                            cat_descripcion AS catDescripcion 
                                            FROM categorias 
                                            WHERE cat_area = :areaId 
                                            AND cat_status = :status_activo ");
        $statement->execute(array(':areaId' => $areaId, ':status_activo' => ACTIVO));
        return $statement->fetchAll();
    }

    // ****************************************************************
    // funcion para la consulta de las conclusiones 
    function getConclusiones($conexion, $areaId, $cat1, $cat2) {
        $statement = $conexion->prepare(" SELECT concl_1cat_id as cat1, 
                                                concl_2cat_id as cat2, 
                                                concl_explicacion as explicacion, 
                                                concl_texto as texto 
                                            FROM conclusiones 
                                            WHERE concl_area = :areaId 
                                            AND concl_1cat_id = :cat1 
                                            AND concl_2cat_id = :cat2 ");
        $statement->execute(array(':areaId' => $areaId, ':cat1' => $cat1, ':cat2' => $cat2));
        $resultados = $statement->fetchAll();
        if (empty($resultados)) {
            return false;
        }
        return ($resultados = $resultados[0]);
    }

    // ****************************************************************
    // funcion para la busqueda de usuarios SIN rangos de fechas
    function buscarNombres($conexion, $nombre, $apellido1, $apellido2) {
        $nombre = '%' . $nombre . '%';
        $apellido1 = '%' . $apellido1 . '%';
        $apellido2 = '%' . $apellido2 . '%';
        $statement = $conexion->prepare(" SELECT usuarios_id as id, 
                                                usuarios_nombres AS nombre, 
                                                usuarios_apellido1 AS apellido1, 
                                                usuarios_apellido2 AS apellido2, 
                                                usuarios_fExamenIntereses AS fExamenIntereses,
                                                usuarios_fExamenAptitudes AS fExamenAptitudes 
                            FROM usuarios 
                            WHERE usuarios_nombres LIKE(:nombre) 
                            AND usuarios_apellido1 LIKE(:apellido1) 
                            AND usuarios_apellido2 LIKE(:apellido2) ");
        $statement->execute(array(':nombre' => $nombre, ':apellido1' => $apellido1, ':apellido2' => $apellido2));
        $resultados = $statement->fetchAll();
        return $resultados;
    }

    // ****************************************************************
    // funcion para la busqueda de usuarios CON rangos de fechas de NACIMIENTO
    function buscarNombresFechaNacimiento($conexion, $nombre, $apellido1, $apellido2, $fechaDesde, $fechaHasta) {
        $nombre = '%' . $nombre . '%';
        $apellido1 = '%' . $apellido1 . '%';
        $apellido2 = '%' . $apellido2 . '%';
        $statement = $conexion->prepare(" SELECT usuarios_id as id, 
                                                usuarios_nombres AS nombre, 
                                                usuarios_apellido1 AS apellido1, 
                                                usuarios_apellido2 AS apellido2, 
                                                usuarios_nacimiento AS nacimiento,
                                                usuarios_fExamenIntereses AS fExamenIntereses,
                                                usuarios_fExamenAptitudes AS fExamenAptitudes 
                            FROM usuarios 
                            WHERE usuarios_nombres LIKE(:nombre) 
                            AND usuarios_apellido1 LIKE(:apellido1) 
                            AND usuarios_apellido2 LIKE(:apellido2) 
                            AND usuarios_nacimiento BETWEEN(:fechaDesde) 
                            AND :fechaHasta ");
        $statement->execute(array(':nombre' => $nombre, ':apellido1' => $apellido1, 
                                    ':apellido2' => $apellido2, ':fechaDesde' => $fechaDesde, 
                                    ':fechaHasta' => $fechaHasta));
        $resultados = $statement->fetchAll();
        $statement = null;
        return $resultados;
    }

    // ****************************************************************
    // funcion para la busqueda de usuarios CON rangos de fechas de EXAMEN
    function buscarNombresFechaExamen($conexion, $nombre, $apellido1, $apellido2, $fechaDesde, $fechaHasta) {

        $nombre = '%' . $nombre . '%';
        $apellido1 = '%' . $apellido1 . '%';
        $apellido2 = '%' . $apellido2 . '%';

        $statement = $conexion->prepare(" SELECT usuarios_id AS id, usuarios_nombres AS nombre, usuarios_apellido1 AS apellido1, 
                        usuarios_apellido2 AS apellido2, 
                        usuarios_fExamenIntereses AS fExamenIntereses, usuarios_fExamenAptitudes AS fExamenAptitudes
                    FROM usuarios
                    WHERE usuarios_nombres LIKE(:nombre) 
                    AND usuarios_apellido1 LIKE(:apellido1) 
                    AND usuarios_apellido2 LIKE(:apellido2) 
                    AND usuarios_fExamenIntereses BETWEEN :fechaDesde
                    AND :fechaHasta
                    OR  usuarios_fExamenAptitudes BETWEEN :fechaDesde
                    AND :fechaHasta ");
        $statement->execute(array(':nombre' => $nombre, ':apellido1' => $apellido1, 
                                    ':apellido2' => $apellido2, ':fechaDesde' => $fechaDesde, 
                                    ':fechaHasta' => $fechaHasta));

        $resultados = $statement->fetchAll();
        $statement = null;
        return $resultados;
    }

    // ****************************************************************
    // funcion para obtener los datos personales de un paciente basado en su id de la ddbb
    function getDatosPersonales($conexion, $id) {
        $statement = $conexion->prepare(" SELECT usuarios_usuario AS usuarioId, 
                                            usuarios_nombres AS nombre, 
                                            usuarios_apellido1 AS apellido1, 
                                            usuarios_apellido2 AS apellido2, 
                                            usuarios_nacimiento AS nacimiento, 
                                            usuarios_email AS email, 
                                            usuarios_telefono AS telefono, 
                                            usuarios_notas AS notas 
                                            FROM usuarios 
                                            WHERE usuarios_id = :id 
                                            AND usuarios_status = :status_activo ");
        $statement->execute(array(':id' => $id, ':status_activo' => ACTIVO));
        $resultados = $statement->fetch();
        $statement = null;
        return ($resultados);
    }

    // ****************************************************************
    // funcion para actualizar los datos de un usuario (paciente)
    function actualizarUsuario($conexion, $id, $nombre, $apellido1, $apellido2, $email, $telefono, $notas) {
        $statement = $conexion->prepare(" UPDATE usuarios
                                            SET usuarios_nombres = :nombre, 
                                            usuarios_apellido1 = :apellido1, 
                                            usuarios_apellido2 = :apellido2, 
                                            usuarios_email = :email, 
                                            usuarios_telefono = :telefono, 
                                            usuarios_notas = :notas
                                        WHERE usuarios_id = :id 
                                        AND usuarios_status = :status_activo ");
        $statement->execute(array(':id'=>$id, ':nombre'=>$nombre, ':apellido1'=>$apellido1, ':apellido2'=>$apellido2, ':email'=>$email, ':telefono'=>$telefono, ':notas'=>$notas, ':status_activo' => ACTIVO));
        $valor = $statement->rowCount();
        return ($valor == 1 ? true : false);
    }

    // ****************************************************************
    // funcion para mostrar un tipo de error en la pagina de ERROR.php
    function error ($error) {
        $_GET['error'] = $error;
        header("Location: " . RUTA . "error.php?error=$error");
    }

    // ****************************************************************
    // funcion para dar formato a una fecha y mostrarla
    function fecha($fecha) {
        $time = strtotime($fecha);
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $dia = date('d', $time);
        $mes = date('m', $time) - 1;
        $anno = date('Y', $time);
        $hora = date('h', $time);
        $minuto = date('i', $time);
        $ampm = date('a', $time);

        $fecha = "$dia de " . $meses[$mes] . " del $anno, a las $hora:$minuto $ampm";
        return $fecha;
    }

    // ****************************************************************
    // funcion para mostrar la fecha de una forma mas amigable
    function fechaFormato($fecha) {
        if ($fecha == "1000-01-01 00:00:00") {
            return " -- ";
        } else
        {
            $date = new DateTime($fecha);
            $meses = array('Jan' => 'Ene', 'Feb'=>'Feb', 'Mar'=>'Mar', 'Apr'=>'Abr', 'May'=>'May', 'Jun'=>'Jun', 'Jul'=>'Jul', 'Aug'=>'Ago', 'Sep'=>'Sep', 'Oct'=>'Oct', 'Nov'=>'Nov', 'Dec'=>'Dic');
            return $date->format('d') . '-' . $meses[$date->format('M')] . '-' . $date->format('Y');
        }
    }

    // ****************************************************************
    // funcion para la validacion de fechas
    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        // fecha Valida = true, si no = false
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    // ****************************************************************
    // compara si una fecha dada es menor a la cantidad de años indicada
    // respecto a la fecha actual o a una fecha dada ($fechaMayor)
    function calcularDiferenciaYears($fechaMenor, $fechaMayor = false) {
        // se asume que la fecha "YA ha sido validada" 
        // Para ver el listado de formatos permitidos ver:
        // https://www.php.net/manual/es/dateinterval.format.php
    
        if (!$fechaMayor ) {
            $date1 = new DateTime("now");
        } 
        else {
            $date1 = date_create($fechaMayor);
        }
        $date2 = date_create($fechaMenor);
        $diff = date_diff($date2,$date1);
        $difYears =  $diff->format("%r%y");
        return $difYears;
    }

    // ****************************************************************
    // compara si un rango de fechas dadas es valido 
    // "fechaMenor" menor que "fechaMayor" = true(rango valido) ; return false
    function validarRangoFechas($fechaMenor, $fechaMayor) {
    // se asume que la fecha "YA ha sido validada" 
    // Para ver el listado de formatos permitidos ver:
    // https://www.php.net/manual/es/dateinterval.format.php

    $date1 = new DateTime($fechaMenor);
    $date2 = new DateTime($fechaMayor);
    $diff = $date1->diff($date2);
    // $difDays =  $diff->format("%r%d");

    if(!$diff->invert && $diff->days > 0) {
        // Rango SI es valido
        return true;
    }
    // rango NO valido
    return false;
    }

    // ****************************************************************
    // funcion q regresa ordenado descendente los valores de la prueba.
    function obtenerMaximos($valoresCateg) {
        // realizar un ordenamiento descendente 
        arsort($valoresCateg);
        $i = 0;
        foreach ($valoresCateg as $key => $value) {
            // $ordenIntereses => array simple (indexado) con los valores de los indices ordenados
            $ordenIntereses[$i] = $key;
            $i++; 
        }
        return $ordenIntereses;
    }

    // ****************************************************************
    // funcion que cambia el valor de la respuesta por un texto acorde
    function setTextoRespuesta($pregValores, $areaId) {

        if ($areaId == TIPO_INTERESES) {
            foreach ($pregValores as $key => $value) {
                switch($value['valor']) {
                    case 0:
                    $pregValores[$key]['texto'] = '0. Me desagrada mucho';
                    break;
                    case 1:
                    $pregValores[$key]['texto'] = '1. Me desagrada algo';
                    break;
                    case 2:
                    $pregValores[$key]['texto'] = '2. Me es indiferente';
                    break;
                    case 3:
                    $pregValores[$key]['texto'] = '3. Me gusta algo';
                    break;
                    case 4:
                    $pregValores[$key]['texto'] = '4. Me gusta mucho';
                    break;
                }
            }
        } 
        else 
        {
            foreach ($pregValores as $key => $value) {
                switch($value['valor']) {
                    case 0:
                    $pregValores[$key]['texto'] = '0. No soy apto';
                    break;
                    case 1:
                    $pregValores[$key]['texto'] = '1. Muy poco apto';
                    break;
                    case 2:
                    $pregValores[$key]['texto'] = '2. Medianamente apto';
                    break;
                    case 3:
                    $pregValores[$key]['texto'] = '3. Soy apto';
                    break;
                    case 4:
                    $pregValores[$key]['texto'] = '4. Soy muy apto';
                    break;
                }
            }
        }
        return $pregValores;  
    }


    ?>