<?php  session_start();

    require_once __DIR__ . '/admin/config.php';
    $error = "";

    if (isset($_SESSION['usuarioId'])) {
        require_once __DIR__ . '/cerrar.php';
    } 
    else {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            require_once __DIR__ . '/funciones.php';

            regLog(__FILE__, __LINE__, "Index con metodo POST");

            $usuarioId = limpiarDatos($_POST['usuarioId']);
            $password = limpiarDatos($_POST['password']);
            // encriptar al contraseña del login para luego compararla con la ddbb
            // $password = hash('sha512', $password);

            //crear conexion ddbb 
            $conexion = conexion($db_config);
        
            if (!$conexion) {
                error("No es posible conectar a la base de datos");
            }

            // consultar si el usuario esta registrado
            $resultados = usuarioRegistrado($conexion, $usuarioId);
            // si no hay resultados entonces el usuario no existe en la ddbb
            if (!empty($resultados)) 
            {
                if ($resultados['usuarioId'] == $usuarioId) {
                    // obtener el password del usuario y compararlos 
                    $passDB = getPassUsuario($conexion, $usuarioId);

                    if (!(strcmp($passDB['pass'], $password) == 0 )) {
                        // $error .= " -- la contraseña son incorrectos<br />";
                        $error .= "El usuario o la contraseña son incorrectos.<br />";
                        $regLog(__FILE__, __LINE__, "Contraseña NO valida");
                    }
                }
            } 
            else 
            {
                $error .= "El usuario o la contraseña son incorrectos.<br />";
            }

            // si no hay "errores" entonces iniciamos la sesion y redirigimos al usuario
            if ($error == "") {
                $_SESSION['usuarioId'] = $resultados['usuarioId'];
                $_SESSION['usuarioNombre'] = $resultados['nombre'];
                // header('Location: ' . RUTA . 'bienvenida-prueba.php');
                header('Location: ' . 'bienvenida-prueba.php');
            }
        } 

        require_once __DIR__ . '/views/index.view.php';
    
    }

?>