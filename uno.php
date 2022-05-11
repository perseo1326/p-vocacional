<?php

require_once __DIR__ . "/admin/config.php";
$t =  date("Y/m/d - h:i:sa");

echo "$t";
echo "<br>este es un texto de prueba";
$a = 12;
$a = $a + 11;
echo "<br>$a";




// codDebug($GLOBALS, false, "VARIABLE GLOBALS");
codDebug(__FUNCTION__, true, "FILE");

// echo "*************************************************************<br>";
// echo $_SERVER['HTTP_HOST'] . "<br>";
// echo RUTA;
// echo "<br>DIR: " . __DIR__;


?>

<!-- /usr/lib/php/20151012/xdebug.so -->