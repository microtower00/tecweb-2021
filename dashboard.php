<?php
    session_start();
    require_once "utils.php";
    $paginaHTML = file_get_contents("dashboard.html");

    if(!Utils::checkPriv()){
        header("Location: index.php");
        die("Pagina riservata ad amministratori");
    }
    
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
    echo str_replace("[Menu]",Utils::buildNav($curPageName),$paginaHTML);
?>