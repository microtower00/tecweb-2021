<?php
session_start();
require_once "utils.php";
require_once "dbRicky.php";
use DB\DBAccess;

$err=array();


function valida(){
    global $err;
    if(isset($_GET['durata'])){
        $durata=$_GET['durata'];
        if(!($durata==1 || $durata==3 || $durata==7))
            $err[] = "La durata dello skipass non è valida.";
    }else
        $err[] = "Non è stata inserita la durata dello skipass.";

    if(isset($_GET['data-inizio'])){
        $data=$_GET['data-inizio'];
        if(Utils::validaData($data, 'Y-m-d')){
            if(date($data)<date("Y-m-d"))
                $err[] = "La data selezionata è già passata";
        }else
            $err[] = "Formato data non valido";
    }else
        $err[] = "Non è stata inserita la durata dello skipass.";

    //Almeno un tipo di skipass deve essere impostato (0 conta come non inserito)
    if((!isset($_GET['intero']) || $_GET['intero']==0) && (!isset($_GET['ridotto']) || $_GET['ridotto']==0))
        $err[] = "Non è stato inserito nessun tipo di skipass da comprare.";
    
    if(isset($_GET['intero'])){
        $n_interi=$_GET['intero'];
        if($n_interi<0 || (int)$n_interi!=$n_interi)
            $err[] = "Il numero di skipass interi non è valido";
    }
    if(isset($_GET['ridotto'])){
        $n_ridotti=$_GET['ridotto'];
        if($n_ridotti<0 || (int)$n_ridotti!=$n_ridotti)
            $err[] = "Il numero di skipass ridotti non è valido";
    }

    return empty($err);
}


$connessione = new DBAccess();
$connessione->openDBConnection();

if(isset($_SESSION['Username'])){
    if(valida()){
                
        if(isset($_GET['intero']) && $_GET['intero']!=0){
            echo "INTERI +".$_GET['intero'];
            $sql = 'INSERT INTO Carrelli(utente,tipo_skipass,durata_skipass,data_inizio,quantita)
                    VALUES  ("'.$_SESSION['Username'].'","Intero",'.$_GET['durata'].',"'.$_GET['data-inizio'].'",'.$_GET['intero'].');';
            if($connessione->execQuery($sql) === FALSE){
                $sql='UPDATE Carrelli SET quantita=quantita+'.$_GET['intero'].'
                        WHERE utente="'.$_SESSION['Username'].'" AND tipo_skipass="Intero" AND 
                            durata_skipass='.$_GET['durata'].' AND data_inizio="'.$_GET['data-inizio'].'";';
                $connessione->execQuery($sql);
            }
        }

        if(isset($_GET['ridotto']) && $_GET['ridotto']!=0){
            echo "RIDOTTI +".$_GET['ridotto'];
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
            header('Location: ../carrello.php');
        else{
            $link_arg=$_SERVER['QUERY_STRING'];     
            $link_arg = preg_replace('~(\?|&)carrello=[^&]*~','$1',$link_arg);
            $link_arg = preg_replace('~(\?|&)intero=[^&]*~','$1',$link_arg);
            $link_arg = preg_replace('~(\?|&)ridotto=[^&]*~','$1',$link_arg);
            
            $link_arg = $link_arg.'&suc=Aggiunti al carrello '.($_GET['intero']+$_GET['ridotto']).' skipass';

            header('Location: ../shop.php?'.$link_arg);
        }
    }else{
        $link_arg=$_SERVER['QUERY_STRING'];     
        $link_arg = preg_replace('~(\?|&)carrello=[^&]*~','$1',$link_arg);
        foreach($err as $e)
            $link_arg = $link_arg.'&err[]='.$e;
        //var_dump($link_arg);
        header('Location: ../shop.php?'.$link_arg);
    }
}else{
    header('Location: ../shop.php');
}
//echo "<br/>";
//print_r($err);