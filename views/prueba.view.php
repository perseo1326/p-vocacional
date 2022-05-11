<?php 

    require_once __DIR__ . '/header.view.php';
    $num_preg = 1;
?>

    <div id="area" class="contenedor">
        <h1 class="titulo">Prueba Vocacional</h1>
        <h3>Instrucciones:</h3>
        <p>Lee cada pregunta y selecciona el valor correspondiente, conforme a la siguiente escala:</p>

        <div class="caja cuadroInstrucciones">
            <?php echo $area->getInstrucciones(); ?>
        </div>  
        <h2><?php echo $area->getTitulo(); ?></h2>
        <?php echo $area->getTextoRecuerda(); ?>
        <div class=""> 
            <form id="form<?php echo $area->getName(); ?>" name="form<?php echo $area->getName(); ?>" class="" action="resultados.php" method="post" onsubmit="javascript:return validarRespuestas('form<?php echo $area->getName(); ?>');">
            
                <?php foreach ($resultados as $resul) : ?> 
                    <div id="<?php echo "P" . $resul['preg_id']; ?>" class="bloque clearfix" value="5"> 
                        <?php echo $num_preg . ". " . $resul['preg_pregunta']; ?>
                        <p class="respuesta derecha">
                            <icon class="far fa-angry" id="<?php echo $resul['preg_id'] . ".1"; ?>" onclick="selPreguntaResp(this)"></icon>
                            <icon class="far fa-frown-open" id="<?php echo $resul['preg_id'] . ".2"; ?>" onclick="selPreguntaResp(this)"></icon>
                            <icon class="far fa-meh" id="<?php echo $resul['preg_id'] . ".3"; ?>" onclick="selPreguntaResp(this)"></icon>
                            <icon class="far fa-smile" id="<?php echo $resul['preg_id'] . ".4"; ?>" onclick="selPreguntaResp(this)"></icon>
                            <icon class="far fa-grin-hearts" id="<?php echo $resul['preg_id'] . ".5"; ?>" onclick="selPreguntaResp(this)"></icon>
                            
                            <!-- variable en la cual retornaremos el valor de la respuesta seleccionada -->
                            <input type="hidden" id="<?php echo $resul['preg_id']; ?>" name="<?php echo $resul['preg_id']; ?>" value="">
                        </p>
                    </div>
                <?php $num_preg++; endforeach; ?>
            
                <input id="" type="hidden" name="tipoPrueba" value="<?php echo $area->getName(); ?>">
                <!-- botones del formulario, fuera de las preguntas (cancelar y enviar) -->
                <div class="clearfix">
                    <input class="izquierda" type="button" value="Cancelar Prueba" onclick="location.href='bienvenida-prueba.php'">
                    <input class="derecha" type="submit" value="Enviar Resultados"> 
                </div>
            </form>        
        </div>    
    </div>

    <?php
        require_once __DIR__ . '/footer.view.php';
    ?>

</body>
</html>
