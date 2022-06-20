<?php
    require_once __DIR__ . '/admin/config.php';
    require_once __DIR__ . '/views/header.view.php';
?>


<div class="contenedor">
    <div class="">
        <article>
            <i class="icono-error fas fa-exclamation-triangle"></i>
            <h2 class="titulo">¡Houston, tenemos un problema!</h2>
            <?php 
                if (isset($_GET['error'])) {
                    echo "<h3 class='titulo error'>" . $_GET['error'] . "</h3>";
                }
            ?>
            <br />
            <input class="boton " type="button" value="Aceptar" onclick="location.href='<?php echo RUTA; ?>index.php'" >
        </article>
    </div>
</div>

<?php
    require_once __DIR__ . '/views/footer.view.php';
?>