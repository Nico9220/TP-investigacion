<?php 
header('Content-Type: text/html; charset=utf-8');
header ("Cache-Control: no-cache, must-revalidate ");

/////////////////////////////
// CONFIGURACION APP//
/////////////////////////////

$directorio = '/Investigacion/TP-investigacion'; // Escribir el directorio donde se encuentra el proyecto dentro del servidor
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].$directorio);
define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].$directorio);
define('STRUCTURE_PATH', ROOT_PATH.'Vista/Templates/');
$_SESSION['ROOT'] = ROOT_PATH;
$ROOT = ROOT_PATH; // Agrega esta línea para definir la variable $ROOT