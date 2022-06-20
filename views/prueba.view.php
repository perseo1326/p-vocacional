<?php 

    require_once __DIR__ . '/header.view.php';
    $num_preg = 1;
?>

    <div id="contenido" class="contenedor">
        <h1 class="titulo">Prueba Vocacional</h1>
        <h3>Instrucciones:</h3>
        <p>Lee cada pregunta y selecciona el valor correspondiente, conforme a la siguiente escala:</p>

        <div class="caja_ cuadroInstrucciones margen-bajo">
            <?php echo $area->getInstrucciones(); ?>
        </div> 
        <div class="">
            <h2 class="texto-centro margen-bajo"><?php echo $area->getTitulo(); ?></h2>
            <p class="margen-bajo">
                <?php echo $area->getTextoRecuerda(); ?>
            </p>
            <div class=""> 
                <form id="formPreguntas" name="form<?php echo $area->getName(); ?>" class="" action="<?php echo RUTA; ?>resultados.php" method="post" >
                    <div class="margen-bajo" id="preguntas">
                        <?php foreach ($preguntas as $preg) : ?> 
                            <div id="<?php echo $preg['preg_id']; ?>" class="bloque-pregunta" > 
                                <p class="pregunta">
                                    <?php echo $num_preg . ". " . $preg['preg_pregunta']; ?>
                                </p>
                                <div class="respuesta" >
                                    <icon class="far fa-angry" id="<?php echo $preg['preg_id'] . ".1"; ?>" data-respuesta="0"></icon>
                                    <icon class="far fa-frown-open" id="<?php echo $preg['preg_id'] . ".2"; ?>" data-respuesta="1"></icon>
                                    <icon class=" far fa-meh" id="<?php echo $preg['preg_id'] . ".3"; ?>" data-respuesta="2"></icon>
                                    <icon class="far fa-smile" id="<?php echo $preg['preg_id'] . ".4"; ?>" data-respuesta="3"></icon>
                                    <icon class="far fa-grin-hearts" id="<?php echo $preg['preg_id'] . ".5"; ?>" data-respuesta="4"></icon>
                                    
                                    <!-- variable en la cual retornaremos el valor de la respuesta seleccionada -->
                                    <input type="hidden" id="<?php echo $preg['preg_id']; ?>" name="<?php echo $preg['preg_id']; ?>" value="-">
                                </div>
                            </div>
                        <?php $num_preg++; endforeach; ?>
                    
                    </div>
                    <input id="" type="hidden" name="tipoPrueba" value="<?php echo $area->getName(); ?>">
                    <div class="contenedor-flex">
                        <input class="" id="bEnviarPrueba" type="submit" value="Enviar Resultados"> 
                        <input class="rojo" id="bCancelarPrueba" type="button" value="Cancelar Prueba" >
                    </div>
                </form>  
            </div>  
        </div> 
    </div>

    <?php
        require_once __DIR__ . '/footer.view.php';
    ?>

    <script src="<?php echo RUTA; ?>js/validaciones.js" ></script>
    <script src="<?php echo RUTA; ?>js/script.js" ></script>
    <script src="<?php echo RUTA; ?>js/prueba.js" ></script>
</body>
</html>
