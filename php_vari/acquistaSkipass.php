<?php
session_start();
require_once "utils.php";
require_once "dbRicky.php";
use DB\DBAccess;

if(!isset($_SESSION['Username']))
    header('Location: ../carrello.php');
else{
    $sql='START TRANSACTION;

    INSERT INTO Ordini(utente) VALUES("'.$_SESSION['Username'].'");


    INSERT INTO SkipassOrdinati(id_ordine, tipo_skipass, durata_skipass, data_inizio, quantita)
                SELECT (SELECT LAST_INSERT_ID()) AS id_ordine, tipo_skipass, durata_skipass, data_inizio, quantita 
                FROM Carrelli WHERE utente="'.$_SESSION['Username'].'";
                
    DELETE FROM Carrelli WHERE utente="'.$_SESSION['Username'].'";

    COMMIT;';

    $connessione = new DBAccess();
    $connessione->openDBConnection();

    $connessione->execMultiQuery($sql);

    /*echo $sql;
    echo "<br/><br/>";
    echo ($connessione->getErrors());*/

    if($connessione->getErrorsNumber()==0){
        header('Location: ../carrello.php?suc');
    }else{
        header('Location: ../carrello.php?err');
    }
}