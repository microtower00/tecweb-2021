<?php
    session_start();
    require_once "utils.php";
    $paginaHTML = file_get_contents("dashboard.html");

    if(!Utils::checkPriv()){
        header("Location: index.php");
        die("Pagina riservata ad amministratori");
    }else
    
    $find = array("['LinkDashboard']","['LinkLogin']");
    $replaceDashboard = Utils::checkPriv()?"<a class='right' href='dashboard.php'>Dasboard Admin</a>":"";
    $replaceLogin = isset($_SESSION['Privilegi'])?"<a class='right' href='logout.php'>Logout</a>":"<a class='right' href='login.php'>Login</a>";
    $replace = array($replaceDashboard,$replaceLogin);
    echo str_replace($find, $replace, $paginaHTML);
?>