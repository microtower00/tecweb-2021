<?php
session_start();
require_once "utils.php";
require_once "dbRicky.php";
use DB\DBAccess;  

$sql="SELECT * FROM `Skipass` ORDER BY Tipo,Durata";
$connessione = new DBAccess();
$connessione->openDBConnection();  
$res = $connessione->execQuery($sql);

$prezzi=[];
while($r = $res->fetch_assoc()){
    $prezzi[$r['Tipo']][$r['Durata']]=$r['Prezzo'];
    //$prezzi[$r['Durata']][$r['Tipo']]=$r['Prezzo'];
}
/*
echo("<pre>");
print_r($prezzi);
echo("</pre>");
*/
echo json_encode($prezzi);
