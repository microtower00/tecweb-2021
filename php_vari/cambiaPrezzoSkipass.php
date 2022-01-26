<?php
session_start();

if($_SESSION['Privilegi']!=1)
    header('Location: ../index.php');


require_once "utils.php";
require_once "dbRicky.php";
use DB\DBAccess;


if(isset($_GET['durata'],$_GET['tipo'],$_GET['nuovo-prezzo'])){
    $sql = 'UPDATE Skipass SET Prezzo='.$_GET['nuovo-prezzo'].' WHERE Durata="'.$_GET['durata'].'" AND Tipo="'.$_GET['tipo'].'";';
    echo $sql;

    $connessione = new DBAccess();
    $connessione->openDBConnection();

    $connessione->execMultiQuery($sql);

    if($connessione->getAffectedRows()==0)
        $msg="err=Errore nel cambio del prezzo (o prezzo uguale al precedente)";
    else
        $msg="suc=Prezzo skipass cambiato con successo";

}

if(isset($msg))
    header("Location: ../modificaPrezzi.php?$msg");
else
    header("Location: ../modificaPrezzi.php");

?>