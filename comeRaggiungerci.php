<?php
session_start();
require_once "php_vari/utils.php";

$pagina = file_get_contents("html/comeRaggiungerci.html");
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
echo str_replace("[Menu]",Utils::buildNav($curPageName),$pagina);
?>