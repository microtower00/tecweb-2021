<?php

$hname= "localhost";
$username= "";
$password = "";
$db_name = "";

$conn = mysqli_connect($hname, $username, $password, $db_name);

if (!$conn) {

    echo "Connection failed!";

}
?>