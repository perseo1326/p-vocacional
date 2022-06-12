<!DOCTYPE html>
<html lang="es">
<head>
  <!-- <meta charset="UTF-8"> -->
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <!-- Iconos Font awesome 4.7 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
  <!-- Iconos Font Awesome 5+ -->
  <script src="https://kit.fontawesome.com/b0d3e7dfc1.js" crossorigin="anonymous"></script> 
  <link rel="stylesheet" href="<?php echo RUTA; ?>css/estilos.css">
  <link rel="stylesheet" href="<?php echo RUTA; ?>css/estilos_admin_busquedas.css">
  <script src="<?php echo RUTA; ?>js/validaciones.js" language="Javascript"></script>
  <script src="<?php echo RUTA; ?>js/script.js" language="Javascript"></script>
  <title>Prueba Vocacional</title>
  
</head>
<body onload="javascript:altoContenedor()" onresize="javascript:altoContenedor()">
  <header id="header">
    <div class="contenedor">
      <div class="izquierda ">
        <!-- <a class="logo" href="<?php //echo RUTA; ?>index.php">Prueba Vocacional</a> -->
        <a class="logo" href="uno.php">Prueba Vocacional</a>
      </div>
      <?php if (isset($_SESSION['usuarioId'])) : ?> 
        <div class="derecha clearfix" >
          <?php if (strlen($_SESSION['usuarioNombre']) < 20) : ?> 
            <span class='usuario'>
          <?php else : ?>
            <span class='usuario medio-nombre'>
          <?php endif; ?>
              <icon class="fas fa-user-tie"></icon>
              <?php echo $_SESSION['usuarioNombre']; ?>
            <input type='button' class="boton-fondo" id='cerrar_sesion' onclick="location.href='<?php echo RUTA; ?>cerrar.php'" value='Cerrar Sesion'>
            <!-- <input type='button' class="boton-fondo" id='cerrar_sesion' onclick="location.href='cerrar.php'" value='Cerrar Sesion'> -->
          </span>
        </div>
      <?php endif; ?>
    </div>
  </header>
  <div id="dimensiones" >Alto: xxxxx <br>Ancho: xxx</div>
  <script>
    document.onload = verDimensiones();
    document.onresize = verDimensiones();
    
    function verDimensiones() {
      let dim = '';
      dim = (window.innerWidth + ' x ' + window.innerHeight);
      document.getElementById("dimensiones").innerHTML = dim;
      console.log(dim);
      console.log(window);
    }
  </script>