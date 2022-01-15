<?php
session_start();

if($_SESSION['Privilegi']!=1)
    header('Location: ../index.php');
}

require_once "php_vari/utils.php";
require_once "php_vari/dbRicky.php";
use DB\DBAccess;




?>