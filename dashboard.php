<?php
    session_start();
    require_once "utils.php";
    $paginaHTML = file_get_contents("dashboard.html");

    if(!Utils::checkPriv()){
        header("Location: index.php");
        die("Pagina riservata ad amministratori");
    }else
    echo $paginaHTML;
?>