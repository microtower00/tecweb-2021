<?php
    session_start();
    require_once "php_vari/utils.php";
    $paginaHTML = file_get_contents("html/dashboard.html");

    if(!Utils::checkPriv()){
        header("Location: index.php");
        die("Pagina riservata ad amministratori");
    }
    
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
    $paginaHTML = str_replace("[Menu]",Utils::buildNav($curPageName),$paginaHTML);
echo str_replace("['Imports']", Utils::globalImports(),$paginaHTML);
?>