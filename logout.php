<?php
    session_start();
    $paginaHTML = file_get_contents("html/logout.html");
    unset($_SESSION["Username"]);
    unset($_SESSION["Privilegi"]);
    echo $paginaHTML;
?>