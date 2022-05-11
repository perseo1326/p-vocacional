<?php

session_start();
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['usuarioId'])) {
  header('Location: ' . 'index.php');
} else {
  if ($_SESSION['tipoUsuario'] != PSICOLOGO) {
    header('Location: ' . 'cerrar.php');
  } else {
    require_once '../funciones.php';
    require '../session.php';
  }
}

if($_SERVER['REQUEST_METHOD'] == 'GET') 
{  

  // por precaucion limpiar el valor pasado con GET
  $id = limpiarDatos($_GET['id']);

  //conexion a la base de datos
  $conexion = conexion($db_config);
  // si la conexion falla...
  if (!$conexion) {
    error("Error conexion.");
  }

  // obtener el conjunto de datos para el area adecuada
  $pregIntereses = obtener_preguntas_desc_cat($conexion, $intereses->getTipo(), $id);
  // si no hay datos, hay ERROR!
  if (empty($pregIntereses)) {
    error("Error, no se obtuvieron las preguntas.");
  } 
  $pregAptitudes = obtener_preguntas_desc_cat($conexion, $aptitudes->getTipo(), $id);
  // si no hay datos, hay ERROR!
  if (empty($pregAptitudes)) {
    error("Error, no se obtuvieron las preguntas.");
  } 
  
  $pregIntereses = setTextoRespuesta($pregIntereses, $intereses->getTipo());
  $pregAptitudes = setTextoRespuesta($pregAptitudes, $aptitudes->getTipo());   

  require_once __DIR__ . '/preguntas.view.php';
}

?>
