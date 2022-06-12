<?php 
// session_start();

require_once __DIR__ . '/admin/config.php';

session_unset();
session_destroy();
$_SESSION = array();

regLog(__FILE__, __LINE__, "Cerrando sesion.");

header('Location: ' . RUTA . 'index.php');
die();

?>