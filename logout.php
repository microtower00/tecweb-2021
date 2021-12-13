<?php
    session_start();
    unset($_SESSION["Username"]);
    unset($_SESSION["Privilegi"]);
    header("Location:login.php");
?>