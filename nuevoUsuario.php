<?php session_start();

    require_once __DIR__ . '/admin/config.php';

    regLog(__FILE__, __LINE__, "Pagina Crear nuevo usuario.");

    if (isset($_SESSION['usuarioId'])) {
        header('Location: ' . 'cerrar.php');
        //error("nuevo usuario -> session activa");
    }

    require_once __DIR__ . '/funciones.php';
    $error= "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' )  
    {
        if (isset($_POST['formNuevoUsuario'])) 
        {
            regLog(__FILE__, __LINE__, "Recibidos datos para nuevo usuario.");

            // crear y comprobar la conexion 
            $conexion = conexion($db_config);
            if (!$conexion) {
                error("Error de conexion.");
            }
            // limpiamos la entrada usuario ID
            $usuarioId = limpiarDatos($_POST['usuarioId']);
            // consultar y verificar si elusuario esta registrado
            $userReg = usuarioRegistrado($conexion, $usuarioId);

            if (!empty($userReg)) {
                $error .= "El ID de usuario ya esta registrado!<br />";
            }
        
            // limpiamos las contraseñas de posible codigo
            $password = limpiarDatos($_POST['password']);
            $password2 = limpiarDatos($_POST['password2']); 
            
            if (empty($password) || empty($password2)) {
                $error .= "Los campos de contraseña no pueden ser vacios.<br />";
            }
            
            if (!(strcmp($password, $password2) == 0 )) {
                $error .= "Las contraseñas no son iguales.<br />";
            }
            
            // verificar que la fecha esta en un formato correcto
            $nacimiento = $_POST['nacimiento'];
            // falso = fecha NO valida
            if(!validateDate($nacimiento, 'Y-m-d')) { 
                $error .= "Fecha no válida";
            } 
            else {
                // saber si la fecha es menor de 16 años?
                $x = calcularDiferenciaYears($nacimiento);
                if($x < 16 && $x > 90) {
                    $error .= "Debe ser mayor de 16 años y menor de 90 años<br />";
                }      
            }
            
            // strip_tags(string, [tag_permitida])
            // ucwords(string) -> Convert the first character of each word to uppercase: 
            // checkdate(month, day, year) -> validate a Gregorian date.
            $nombre = limpiarDatos($_POST['nombre']);
            $nombre = ucwords($nombre);
            $apellido1 = limpiarDatos($_POST['apellido1']);
            $apellido1 = ucwords($apellido1);
            $apellido2 = limpiarDatos($_POST['apellido2']);
            $apellido2 = ucwords($apellido2);
            $telefono = limpiarDatos($_POST['telefono']);
            $email = limpiarDatos($_POST['email'], 'E');
            
            $notas = "";
            // Indica que ESTE será un usuario "ACTIVO" = 'A' 
            $usuarioStatus = ACTIVO;
            $tipoUsuario = BASICO;
        }
            
        if ($error == "") {
            // Enmascarar o encriptar la contraseña usando el algoritmo "sha512" con el metodo "hash()"
            // $password = hash('sha512', $password);
            // $password2 = hash('sha512', $password2);

            if ($password != $password2) {
                error("Error Codificando la información");
            }
            
            $statement = $conexion->prepare(" INSERT INTO usuarios 
                        (usuarios_id, usuarios_usuario, usuarios_password, usuarios_nombres, 
                        usuarios_apellido1, usuarios_apellido2, usuarios_nacimiento, usuarios_email, 
                        usuarios_telefono, usuarios_notas, usuarios_status, usuarios_tipoUsuario_id) 
                        VALUES (NULL, :usuarioId, :pass, :nombre, :apellido1, :apellido2, :nacimiento,
                                :email, :telefono, :notas, :usuarioStatus, (SELECT tipousua_id FROM tipos_usuario
                        WHERE tipousua_nombre = :tipoUsuario)) "); 
        
            $statement->execute(array(':usuarioId' => $usuarioId, 
                                    ':pass' => $password,
                                    ':nombre' => $nombre, 
                                    ':apellido1' => $apellido1, 
                                    ':apellido2' => $apellido2, 
                                    ':nacimiento' => $nacimiento, 
                                    ':email' => $email, 
                                    ':telefono' => $telefono, 
                                    ':notas' => $notas, 
                                    ':usuarioStatus' => $usuarioStatus, 
                                    ':tipoUsuario' => $tipoUsuario
            ));
            
            // obtener el id del ultimo elemento insertado en la ddbb
            $ddbb_userId = $conexion->lastInsertId();

            // ahora comprobaremos que el usuario nuevo fue insertado con exito en la ddbb
            $statement = $conexion->prepare("SELECT usuarios_id AS id, 
                                                    usuarios_usuario AS usuarioId, 
                                                    tipousua_nombre AS tipo, 
                                                    usuarios_nombres as nombre 
                                            FROM usuarios
                                            JOIN tipos_usuario 
                                            ON usuarios_tipousuario_id = tipousua_id
                                            WHERE tipousua_nombre = :tipoUsuario 
                                            AND usuarios_usuario = :usuarioId " );
            $statement->execute(array(':tipoUsuario' => $tipoUsuario, ':usuarioId' => $usuarioId));
            // usamos fetch() porque solo necesitamos una linea, fetchAll() trae un conjunto de resultados
            $resultados = $statement->fetch(PDO::FETCH_ASSOC);

            regLog(__FILE__, __LINE__, "Comprobacion creacion nuevo usuario.");

            if(empty($resultados)) {
                error("Error al transmitir los datos.");
            }

            // $resultado = $resultado[0]; // es necesario si usas fetchAll()
            // crear la session de usuario
            if($resultados['id'] == $ddbb_userId && $resultados['usuarioId'] == $usuarioId && $resultados['tipo'] == BASICO) {
                $_SESSION['usuarioId'] = $resultados['usuarioId'];
                $_SESSION['usuarioNombre'] = $resultados['nombre'];

                regLog(__FILE__, __LINE__, "Inicializando la sesion");

                header('Location: bienvenida-prueba.php');
            }
            else {
                //$error = "error al transmitir los datos";
                error("Error al transmitir los datos.");
            } 
        }
    }
    require_once __DIR__ . '/views/nuevoUsuario.view.php';

?>