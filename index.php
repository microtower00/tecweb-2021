<?php
session_start();
require_once "utils.php";

$pagina = file_get_contents("home.html");
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
echo str_replace("[Menu]",Utils::buildNav($curPageName),$pagina);
/*$find = array("['LinkDashboard']","['LinkLogin']");
$replaceDashboard = Utils::checkPriv()?"<a class='right' href='dashboard.php'>Dasboard Admin</a>":"";
$replaceLogin = isset($_SESSION['Privilegi'])?"<a class='right' href='logout.php'>Logout</a>":"<a class='right' href='login.php'>Login</a>";
$replace = array($replaceDashboard,$replaceLogin);
echo str_replace($find, $replace, $pagina);*/
?>