<?php
session_start();
require_once "utils.php";

$pagina = file_get_contents("comeRaggiungerci.html");
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
echo str_replace("[Menu]",Utils::buildNav($curPageName),$pagina);
?>