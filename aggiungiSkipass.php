<?php
session_start();
require_once "utils.php";
require_once "dbRicky.php";
use DB\DBAccess;



$connessione = new DBAccess();
$connessione->openDBConnection();

if(isset($_GET['durata'],$_GET['data-inizio']) && (isset($_GET['intero']) || isset($_GET['ridotto'])) &&
        Utils::validaData($_GET['data-inizio'], 'Y-m-d')){
            
    if(isset($_GET['intero']) && $_GET['intero']>0){
        $sql = 'INSERT INTO Carrelli(utente,tipo_skipass,durata_skipass,data_inizio,quantita)
                VALUES  ("'.$_SESSION['Username'].'","Intero",'.$_GET['durata'].',"'.$_GET['data-inizio'].'",'.$_GET['intero'].');';
        if($connessione->execQuery($sql) === FALSE){
            $sql='UPDATE Carrelli SET quantita=quantita+'.$_GET['intero'].'
                    WHERE utente="'.$_SESSION['Username'].'" AND tipo_skipass="Intero" AND 
                        durata_skipass='.$_GET['durata'].' AND data_inizio="'.$_GET['data-inizio'].'";';
            $connessione->execQuery($sql);
        }
    }

    if(isset($_GET['ridotto']) && $_GET['ridotto']>0){
        $sql = 'INSERT INTO Carrelli(utente,tipo_skipass,durata_skipass,data_inizio,quantita)
                VALUES ("'.$_SESSION['Username'].'","Ridotto",'.$_GET['durata'].',"'.$_GET['data-inizio'].'",'.$_GET['ridotto'].')';
        if($connessione->execQuery($sql) === FALSE){
            $sql='UPDATE Carrelli SET quantita=quantita+'.$_GET['ridotto'].'
                WHERE utente="'.$_SESSION['Username'].'" AND tipo_skipass="Ridotto" AND 
                    durata_skipass='.$_GET['durata'].' AND data_inizio="'.$_GET['data-inizio'].'";';
            $connessione->execQuery($sql);
        }
    }

    if(isset($_GET['carrello']) && $_GET['carrello'])
        header('Location: carrello.php');
    else{
        $link_arg=$_SERVER['QUERY_STRING'];     
        $link_arg = preg_replace('~(\?|&)carrello=[^&]*~','$1',$link_arg);
        $link_arg = preg_replace('~(\?|&)intero=[^&]*~','$1',$link_arg);
        $link_arg = preg_replace('~(\?|&)ridotto=[^&]*~','$1',$link_arg);
        header('Location: shop.php?'.$link_arg);
    }
}else{
    $link_arg=$_SERVER['QUERY_STRING'];     
    $link_arg = preg_replace('~(\?|&)carrello=[^&]*~','$1',$link_arg);
    header('Location: shop.php?'.$link_arg);
}