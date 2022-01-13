<?php
session_start();
require_once "php_vari/utils.php";

$pagina = file_get_contents("html/chisiamo.html");
$pagina = Utils::skipNavBtn($pagina);

$pagina = Utils::addScrollBtn($pagina);
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
$pagina = str_replace("[Menu]",Utils::buildNav($curPageName),$pagina);
echo str_replace("['Imports']", Utils::globalImports(),$pagina);
?>