<?php 

// require_once '../views/header.view.php';
require_once __DIR__ . '/views/header.view.php';
  $num_preg = 1;
?>

  <div id="area" class="contenedor">
    <h1 class="titulo">Preguntas Prueba Vocacional</h1>
    <div class="caja ">
      <div>
        <h2 id="tituloIntereses" class="areaPreguntas" onclick="javascript:alternar('intereses', 'aptitudes', 'tituloIntereses')">Área Intereses</h2>
        <div id="intereses" class="esconder">
          <?php echo $intereses->getTextoRecuerda(); ?>
          <?php foreach ($pregIntereses as $key => $value) : ?>
            <div id="<?php echo $value['pregId']; ?>" class="bloque clearfix" title="<?php echo $value['categoria']; ?>"> 
              <?php echo $num_preg . '. ' . $value['pregunta']; ?>
              <p class="respuesta derecha">
                <?php echo $value['texto']; ?>
            </p>
            </div>
            <?php $num_preg++; ?>
          <?php endforeach; ?>
        </div>
      </div>
      <div>
        <h2 id='tituloAptitudes' class="areaPreguntas" onclick="javascript:alternar('aptitudes', 'intereses', 'tituloAptitudes')">Área Aptitudes</h2>
        <div id='aptitudes' class="esconder">
          <?php echo $aptitudes->getTextoRecuerda(); ?>
          <?php foreach ($pregAptitudes as $key => $value) : ?>
            <div id="<?php echo $value['pregId']; ?>" class="bloque clearfix" title="<?php echo $value['categoria']; ?>"> 
              <?php echo $num_preg . '. ' . $value['pregunta']; ?>
              <p class="respuesta derecha">
                <?php echo $value['texto']; ?>
            </p>
            </div>
            <?php $num_preg++; ?>
          <?php endforeach; ?>
        </div>
      </div>
      <div id="botonArriba" class="botonArriba" onclick="" >
        Ir
        <ul id="botonArribaLista" class='botonArribaLista' >
          <a href="#tituloIntereses"><li class='botonArribaItems' onclick="javascript:mostrarArea('intereses', 'aptitudes')">Intereses</li></a>
          <a href="#tituloAptitudes"><li class='botonArribaItems' onclick="javascript:mostrarArea('aptitudes', 'intereses')">Aptitudes</li></a>
        </ul>
      </div>
    </div>
    <div class="clearfix">
      <input class="boton izquierda" type="button" value="Regresar" onclick="javascript:window.close()">
    </div>
  </div>    
<script>
  document.getElementById("header").style.display = 'none';

  document.getElementById("intereses").style.display = 'block';
  document.getElementById("aptitudes").style.display = 'none';

  function alternar(id1, id2, _focus) {
    mostrarFormulario(id2, _focus);
    mostrarFormulario(id1, _focus);
  }
  
  function mostrarArea (visible, oculto) {
    document.getElementById(visible).style.display = 'block';
    document.getElementById(oculto).style.display = 'none';
  }
  
</script>
  </body>
</html>
