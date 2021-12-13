<?php

$hname= "localhost";
$username= "mcazzaro";
$passwordDb = "Eetho5aer6ahqueJ";
$db_name = "mcazzaro";

$conn = mysqli_connect($hname, $username, $passwordDb, $db_name);

if (!$conn) {

    echo "Connection failed!";

}
?>