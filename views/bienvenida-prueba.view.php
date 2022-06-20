    <?php 

    require_once __DIR__ . '/header.view.php';
    ?>

    <div id="contenido" class="contenedor">
        <h1 class="titulo">Bienvenido</h1>
        <!-- pagina para la descripcion de cada una de las pruebas y seleccion de la misma. --> 
        <?php if(!$pruebasRealizadas) : ?>
        <div class='margen-bajo'>
            <h3 class="margen-bajo">Prueba de <?php echo $intereses->getName(); ?></h3>
            <div class="margen-bajo">
                <?php echo $intereses->getTextoDescripcion(); ?>
                <?php echo $botonIntereses ?> 
            </div>

            <h3 class="margen-bajo">Prueba de <?php echo $aptitudes->getName(); ?></h3>
            <div class="margen-bajo">
                <?php echo $aptitudes->getTextoDescripcion(); ?>
                <?php echo $botonAptitudes ?>
            </div>
        </div>

        <?php else : ?> 
        <div class=''>
            <h2>Ver los Resultados</h2>
            <p>Prueba de <strong><?php echo INTERESES; ?></strong> realizada el <?php echo $_SESSION['Intereses']['fecha']; ?>.</p>
            <p>Prueba de <strong><?php echo APTITUDES; ?></strong> realizada el <?php echo $_SESSION['Aptitudes']['fecha']; ?>.</p>
            <input class="" type="button" value="Conclusiones de la Prueba" onclick="location.href='resultados.php'" >
        </div>
        <?php endif; ?>
    </div>

    <?php
    require_once __DIR__ . '/footer.view.php';
    ?>

    <script src="<?php echo RUTA; ?>js/script.js"></script>
    </body>
    </html>