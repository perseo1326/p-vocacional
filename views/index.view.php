<?php
    require_once __DIR__ . '/header.view.php';
    // alterna la clase CSS "errores" en los inputs para indicar si hay o no errores
    $claseError = '';
    // muestra o esconde el formulario de "Inicio de Sesion"
    $mostrarFormulario = '';
    $mostrarError = '';

    if ($error == "") {
        $mostrarFormulario = 'fondo esconder';
        $claseError = "ancho";
        $mostrarError = "";
    } else {
        $claseError = "ancho errores";
        $mostrarFormulario = "fondo";
        $mostrarError = "errores";
    }
?>

    <div class="imagen-fondo" id="contenido">
        <div id="area" class="contenedor ">
            <h1 class="titulo">Prueba Vocacional</h1>
            <p class="presentacion">Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis praesentium molestias quidem obcaecati aperiam recusandae, similique nesciunt maiores! Non inventore neque aut veniam corporis eos nostrum autem debitis reiciendis quisquam.</p>
            <div class="caja-pequenna">
                <input id="bNuevoUsuario" class="ancho" type="button" value="Registrar Nuevo Usuario" >
                <input id="bBotonLogin" class="ancho" type="button" value="Iniciar Sesion" >
                <div class="<?php echo $mostrarFormulario ;?>" id="iniciarSesion">
                    <form id="formLogin" class="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  method="post" >
                        <input class="<?php echo $claseError; ?>" id="usuarioId" type="text" name="usuarioId" placeholder="Usuario" autofocus >
                        <input class="<?php echo $claseError; ?>" id="passw" type="password" name="password" placeholder="Contraseña">
                        <p id="verErrorLogin" class="<?php echo $mostrarError; ?>"><?php echo $error; ?></p>
                        <input class="boton-fondo" id="bIniciarSesion" type="submit" value="Iniciar Sesion">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php
        require_once __DIR__ . '/footer.view.php';
    ?>

    <script src="<?php echo RUTA; ?>js/script.js" ></script>
    <script src="<?php echo RUTA; ?>js/index.js" ></script>

</body>
</html>
