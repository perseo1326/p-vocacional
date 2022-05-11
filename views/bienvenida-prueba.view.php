<?php 

require_once __DIR__ . '/header.view.php';
?>

  <div id="area" class="contenedor">
    <h1 class="titulo">Bienvenido</h1>
    <!-- pagina para la descripcion de cada una de las pruebas y seleccion de la misma. --> 
    <?php if(!$pruebasRealizadas) : ?>
      <div class=''>
        <h3 class="">Prueba de <?php echo $intereses->getName(); ?></h3>
          <?php echo $intereses->getTextoDescripcion(); ?>
        <?php echo $botonIntereses ?> 

        <h3 class="">Prueba de <?php echo $aptitudes->getName(); ?></h3>
          <?php echo $aptitudes->getTextoDescripcion(); ?>
        <?php echo $botonAptitudes ?>
      </div>
    <?php else : ?> 
      <div class=''>
        <h2>Ver los Resultados</h2>
          <p>Prueba de <strong><?php echo INTERESES; ?></strong> realizada el <?php echo $_SESSION['Intereses']['fecha']; ?>.</p>
          <p>Prueba de <strong><?php echo APTITUDES; ?></strong> realizada el <?php echo $_SESSION['Aptitudes']['fecha']; ?>.</p>
          <!-- <input class="" type="button" value="Conclusiones de la Prueba" onclick="location.href='<?php //echo RUTA; ?>resultados.php'" > -->
          <input class="" type="button" value="Conclusiones de la Prueba" onclick="location.href='resultados.php'" >
      </div>
    <?php endif; ?>
  </div>

<?php
  
  require_once __DIR__ . '/footer.view.php';
?>

</body>
</html>