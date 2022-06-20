<?php
    require_once __DIR__ . '/header.view.php';
?>

    <div id="contenido" class="contenedor">
        <h1 class="titulo">Registrar Nuevo Usuario</h1>
        <div class="caja-mediana">
            <div class="">
                <form id='formNuevoUsuario' class="formulario clearfix" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
                    <input type="hidden" name="formNuevoUsuario">
                    <input class='ancho' id="usuarioId" type="text" name="usuarioId" placeholder="Usuario"  value="<?php echo (isset($usuarioId)) ? $usuarioId : ''; ?>">
                    <!-- autofocus -->
                    <input class='ancho' id="password" type="password" name="password" placeholder="Contraseña" >
                    <input class='ancho' id="password2" type="password" name="password2" placeholder="Repetir contraseña" >
                    <p> </p>
                    <input class='ancho' id="nombre" type="text" name="nombre" placeholder="Nombres" title="Solo letras de la A a la Z" value="<?php echo (isset($nombre)) ? $nombre : ''; ?>" maxlength="98">
                    <input class='ancho' id="apellido1" type="text" name="apellido1" placeholder="Primer Apellido" title="Solo letras de la A a la Z" value="<?php echo (isset($apellido1)) ? $apellido1 : ''; ?>" maxlength="49">
                    <input class='ancho' id="apellido2" type="text" name="apellido2" placeholder="Segundo Apellido" title="Solo letras de la A a la Z"  value="<?php echo (isset($apellido2)) ? $apellido2 : ''; ?>" maxlength="49">
                    <input class='ancho' id="nacimiento" type="date" name="nacimiento" title="Formato para la fecha AAAA-MM-DD" placeholder="Fecha de nacimiento AAAA-MM-DD" value="<?php echo (isset($nacimiento)) ? $nacimiento : ''; ?>">
                    <input class='ancho' id="telefono" type="text" name="telefono" placeholder="Numero de telefono" title="Solo más(+) y números del 0-9."  value="<?php echo (isset($telefono)) ? $telefono : ''; ?>" maxlength="19">
                    <input class='ancho' id="email" type="email" name="email" placeholder="Correo electronico" value="<?php echo (isset($email)) ? $email : ''; ?>">
                    <!-- Seccion para mostrar los posibles errores -->
                    <?php if ($error == "") : ?>
                        <p id="errorRegistro" class=""></p>
                    <?php else : ?>
                        <p id="errorRegistro" class="errores"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <!-- Boton Submit, enviar a la ddbb los datos para el nuevo usuario -->
                    <input class="izquierda" id="bFormNuevoUsuario" type="submit" value="Registrar Usuario">
                    <!-- boton Cancelar Registro -->
                    <input class="derecha rojo" id="bCancelarRegistro" type="button" value="Cancelar Registro" >
                </form>
            </div>
        </div>
    </div>

    <?php
        require_once __DIR__ . '/footer.view.php';
    ?>

    <script src="<?php echo RUTA; ?>js/validaciones.js" ></script>
    <script src="<?php echo RUTA; ?>js/script.js" ></script>
    <script src="<?php echo RUTA; ?>js/nuevoUsuario.js" ></script>

</body>

</html>