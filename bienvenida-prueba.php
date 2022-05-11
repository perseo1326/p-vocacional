<?php 
    session_start();

    require_once __DIR__ . '/admin/config.php';

    if (isset($_SESSION['usuarioId'])) {

        require_once __DIR__ . '/funciones.php';
        // comprobar que la sesion no tiene mas de una hora de vigencia
        require __DIR__ . '/session.php';

        $pruebasRealizadas = false;

        $conexion = conexion($db_config);
        if (!$conexion) {
            error("No se pudo conectar a la base de datos");
        }

        if (!isset($_SESSION['tipoUsuario'])) {
            // primera vez que entra a la bienvenida
            // consultar el tipo de usuario
            $tipoUsuario = getTipoUsuario($conexion, $_SESSION['usuarioId']);

            if (empty($tipoUsuario)) {
                error("Error obteniendo el tipo de usuario");
            }
            // $tipoUsuario = $tipoUsuario[0]; usando fetch() en vez de fetchAll()
            
            // colocar el tipo de usuario en la sesion
            // crea las variables para cada una de las pruebas
            $_SESSION['tipoUsuario'] = $tipoUsuario['tipoUsuario']; 
            $_SESSION['Intereses'] = [ 'id' => TIPO_INTERESES, 'Prueba' => false, 'fecha' => ""];
            $_SESSION['Aptitudes'] = [ 'id' => TIPO_APTITUDES, 'Prueba' => false, 'fecha' => ""];
            
            // preguntar si el usuario ha realizado algun examen previo
            // el usuario realizo la prueba de Intereses?
            $pruebaIntereses = pruebaRealizada($conexion, $intereses->getTipo(), $_SESSION['usuarioId']);

            if($pruebaIntereses['Num_preg'] > 0 ) 
            {
                $_SESSION['Intereses'] ['Prueba'] = true;
                $_SESSION['Intereses']['fecha'] = fecha($pruebaIntereses['fExamen']);
            }

            // el usuario realizo la prueba de Aptitudes?
            $pruebaAptitudes = pruebaRealizada($conexion, $aptitudes->getTipo(), $_SESSION['usuarioId']);

            if($pruebaAptitudes['Num_preg'] > 0) 
            {
                $_SESSION['Aptitudes'] ['Prueba'] = true;
                $_SESSION['Aptitudes']['fecha'] = fecha($pruebaAptitudes['fExamen']);
            }
        } 

        // comprobar el TIPO de usuario
        if ($_SESSION['tipoUsuario'] == BASICO) {

            if($_SESSION['Intereses']['Prueba']) {
                // desactivar boton de la prueba Intereses
                $botonIntereses = "<input class='desactivado' type='button' value='" . $intereses->getTitulo() . " - Realizada' onclick='javascript: alert(" . '"Esta prueba no es posible repetirla"' . ")' title='Prueba Realizada'>";   
            }
            else {
                // no ha realizado la prueba de Intereses todavia => habilitar boton de la prueba
                $botonIntereses = "<input onclick='location.href=" . '"prueba.php?prueba=' ;
                $botonIntereses .= $intereses->getName() .  '"' . "'" ; 
                $botonIntereses .= " type='button' value='" . $intereses->getTitulo() . "'>";
            }

            if($_SESSION['Aptitudes']['Prueba']) {
                // desactivar boton de la prueba Aptitudes
                $botonAptitudes = "<input  class='desactivado' type='button' value='" . $aptitudes->getTitulo() . " - Realizada' onclick='javascript: alert(" . '"Esta prueba no es posible repetirla"' . ")' title='Prueba Realizada'>";
            }
            else {
                // no ha realizado la prueba de Aptitudes todavia => habilitar boton de la prueba
                $botonAptitudes = "<input onclick='location.href=" . '"prueba.php?prueba=' ;
                $botonAptitudes .= $aptitudes->getName() .  '"' . "'" ; 
                $botonAptitudes .= " type='button' value='" . $aptitudes->getTitulo() . "'>";
            }

            // se han realizado las dos pruebas?
            if ($_SESSION['Intereses']['Prueba'] && $_SESSION['Aptitudes']['Prueba']) {
                // si las DOS pruebas SI han sido realizadas 
                $pruebasRealizadas = true;    //si se han hecho v + v
            } else {
                // falta por realizar una o las dos pruebas
                $pruebasRealizadas = false;   //no se ha hecho una o las dos f + v || f + f
            }
            require_once __DIR__ . '/views/bienvenida-prueba.view.php';

        }
        
        // redireccionar para el usuario PSICOLOGO
        elseif ($tipoUsuario['tipoUsuario'] == PSICOLOGO) 
        {
            //error("Iniciando sesion de Psicologo");
            // header('Location: ' . '/admin/index.php');
            header('Location: ' . 'admin/index.php');
        } 
        // Redireccionar para el usuario ADMINISTRADOR
        elseif ($tipoUsuario['tipoUsuario'] == ADMINISTRADOR) {
            error("Iniciando sesion de Administrador");
        }
        // si no es un tipo de usuario reconocido enviar a la pagina de error.
        else {
            error("Hubo un error, por favor inicie session de nuevo.");
        }
    } 
    else {
        // si no hay una session activa entonces...
        header('Location: ' . RUTA . 'index.php');
    }

?>