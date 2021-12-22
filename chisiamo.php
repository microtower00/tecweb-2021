<?php
session_start();
require_once "utils.php";

$pagina = file_get_contents("chisiamo.html");
echo str_replace("['LinkDashboard']",Utils::checkPriv()?"<a class='right' href='dashboard.php'>Dasboard Admin</a>":"", $pagina);
?>