<?php 

require_once __DIR__ . '/header.view.php';

?>

<div id="area" class="contenedor">
  <h1 class="titulo">Resultados</h1>
  <div class="">  
    <!-- mostrar grafico sencillo o general => una o las dos pruebas realizadas -->
    <?php if( !$pruebasRealizadas ) : ?> 
      <!-- Mostrar grafico sencillo  -->
      <div id="grafico-sencillo" class="grafico-sencillo-general">
      </div>
      <div class="caja-grande">
        <ul>
          <?php $i = 0; ?>
          <?php  foreach ($catValor as $cat => $value)  : ?>
            <li><?php echo $categorias[$i]['catNombre']; ?> <strong>(<?php echo $categorias[$i]['catTipo']?>)</strong>: <?php echo $value ?>%<br /></li>
            <?php $i++; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    
    <?php else : ?>
      <!-- Mostrar grafico general -->
      <div id="grafico-general" class="grafico-sencillo-general">
      </div>
      <h2 class="titulo">Valores</h2>
      <div class="resul-categorias" >
        <div class="">
          <h3 class="cuadroConvenciones" onclick="javascript:mostrarCategoriasGeneral()"><u>Categorias: Area <?php echo INTERESES; ?></u></h3>
          <ul id="catIntereses">
            <?php foreach ($catIntereses as $key => $value) : ?>
              <li><?php echo valorPorcentaje($resulIntereses[$value['catId']]); ?>% = <strong>(<?php echo $value['catTipo'] ;?>)</strong> <?php echo $value['catNombre']; ?></li>
              <?php if ($value['catId'] == $maxIntereses[0]) {
                $catInteresesAlta_1 = $value['catNombre'];
              } else if($value['catId'] == $maxIntereses[1]) {
                $catInteresesAlta_2 = $value['catNombre'];
              } ?>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="" >
          <h3 class="cuadroConvenciones" onclick="javascript:mostrarCategoriasGeneral()"><u>Categorias: Area <?php echo APTITUDES; ?></u></h3>
          <ul id="catAptitudes">
            <?php foreach ($catAptitudes as $key => $value) : ?>
              <li><?php echo valorPorcentaje($resulAptitudes[$value['catId']]); ?>% = <strong>(<?php echo $value['catTipo'] ;?>)</strong> <?php echo $value['catNombre']; ?></li>
              <?php if ($value['catId'] == $maxAptitudes[0]) {
                $catAptitudesAlta = $value['catNombre'];
              } ?>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <!-- <h2>Resultado general de la prueba realizada. </h2> -->
      <h2>Area <?php echo INTERESES; ?></h2>
      <p><strong>Categorias: </strong><?php echo $catInteresesAlta_1 . ' - ' . $catInteresesAlta_2; ?></p>
      <p><?php echo $conclIntereses; ?></p>
      <h2>Area <?php echo APTITUDES; ?></h2>
      <p><Strong>Categoria: </strong><?php echo $catAptitudesAlta; ?></p>
      <p><?php echo nl2br($conclAptitudesExpli); ?></p>
      <p><strong>Carreras: </strong><?php echo $conclAptitudestexto; ?></p>

    <?php endif; ?>
    <!-- <input class="boton " type="button" value="<?php echo $botonTexto; ?>" onclick="location.href='<?php //echo RUTA; ?>bienvenida-prueba.php'" > -->
    <input class="boton " type="button" value="<?php echo $botonTexto; ?>" onclick="location.href='bienvenida-prueba.php'" >
  </div>
</div>

<?php
  require_once $grafico_script; 
  require_once __DIR__ . '/footer.view.php';
?>  
</body>
</html>
