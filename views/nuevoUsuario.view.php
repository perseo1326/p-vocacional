<?php
    require_once __DIR__ . '/header.view.php';
?>

    <div id="area" class="contenedor">
        <h1 class="titulo">Registrar Nuevo Usuario</h1>
        <div class="caja-mediana">
            <div class="">
                <form id='formNuevoUsuario' class="formulario clearfix" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="javascript:return validarNuevoUsuario('ancho')">
                    <input type="hidden" name="formNuevoUsuario">
                    <input class='ancho' id="usuarioId" type="text" name="usuarioId" placeholder="Usuario" onblur="javascript:validarIdUsuarioEvento('usuarioId')" value="<?php echo (isset($usuarioId)) ? $usuarioId : ''; ?>">
                    <!-- autofocus -->
                    <input class='ancho' id="password" type="password" name="password" placeholder="Contraseña" onblur="javascript:checkPass()">
                    <input class='ancho' id="password2" type="password" name="password2" placeholder="Repetir contraseña" onblur="javascript:checkPass()">
                    <p> </p>
                    <input class='ancho' id="nombre" type="text" name="nombre" placeholder="Nombres" title="Solo letras de la A a la Z" onblur="javascript:validarTextos('nombre', 'ancho')" value="<?php echo (isset($nombre)) ? $nombre : ''; ?>" maxlength="98">
                    <input class='ancho' id="apellido1" type="text" name="apellido1" placeholder="Primer Apellido" title="Solo letras de la A a la Z" onblur="javascript:validarTextos('apellido1', 'ancho')" value="<?php echo (isset($apellido1)) ? $apellido1 : ''; ?>" maxlength="49">
                    <input class='ancho' id="apellido2" type="text" name="apellido2" placeholder="Segundo Apellido" title="Solo letras de la A a la Z" onblur="javascript:validarTextos('apellido2', 'ancho')" value="<?php echo (isset($apellido2)) ? $apellido2 : ''; ?>" maxlength="49">
                    <input class='ancho' id="nacimiento" type="date" name="nacimiento" title="Formato para la fecha AAAA-MM-DD" placeholder="Fecha de nacimiento AAAA-MM-DD" onblur="javascript:validarEventoFecha('nacimiento', 'ancho')" value="<?php echo (isset($nacimiento)) ? $nacimiento : ''; ?>">
                    <input class='ancho' id="telefono" type="text" name="telefono" placeholder="Numero de telefono" title="Solo más(+) y números del 0-9." onblur="javascript:validarNumerosTel('telefono', 'ancho')" value="<?php echo (isset($telefono)) ? $telefono : ''; ?>" maxlength="19">
                    <input class='ancho' id="email" type="email" name="email" placeholder="Correo electronico" onblur="javascript:validarEmailFormulario('email', 'ancho')" value="<?php echo (isset($email)) ? $email : ''; ?>">
                    <!-- Seccion para mostrar los posibles errores -->
                    <?php if ($error == "") : ?>
                        <p id="errorRegistro" class=""></p>
                    <?php else : ?>
                        <p id="errorRegistro" class="errores"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <!-- boton Cancelar Registro -->
                    <input class="izquierda" type="button" value="Cancelar Registro" onclick="location.href='index.php'">
                    <!-- Boton Submit, enviar a la ddbb los datos para el nuevo usuario -->
                    <input class="derecha" type="submit" value="Registrar Usuario">
                </form>
            </div>
        </div>
    </div>

    <?php
        require_once __DIR__ . '/footer.view.php';
    ?>
</body>

</html>