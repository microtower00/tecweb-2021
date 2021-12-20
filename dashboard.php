<?php
session_start();
require_once "utils.php";
$paginaHTML = file_get_contents("dashboard.html");

if(!Utils::checkPriv()){
    header("Location: index.html");
    die("Pagina riservata ad amministratori");
    //echo "Plebeo";
}else
    echo "PLEBEOOSalve adminOOO";
echo $paginaHTML
?>