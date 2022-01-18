<?php
session_start();
//include_once "html/register.html";
require_once "php_vari/utils.php";
require_once "php_vari/dbRicky.php";
use DB\DBAccess;
$paginaHTML = file_get_contents("html/register.html");
$replaceMsg="";
$replaceUser="";
$replaceLink="";

$connessione = new DBAccess();
$connessioneOK = $connessione->openDBConnection();

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['ripetiPassword'])) {
    $exp = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=.\-_*!?])([a-zA-Z0-9@#$%^&+=*.\-_!?]){8,}$|^$/";
    $expUsr = "/^[a-zA-Z0-9_\.]{5,20}$|^$/";
    if(!(preg_match($_POST['password'],$exp) || preg_match($_POST['ripetiPassword'],$exp) || preg_match($_POST['username'],$expUsr))){
        $replaceMsg = "Username o password non validi.";
    }
    else if($_POST['password'] == $_POST['ripetiPassword']){


        $replaceUser=$_POST['username'];
     
        //validazione credenziali
        $username = Utils::valida($_POST['username']);
        $pass = Utils::valida($_POST['password']);
     
        
        if (!$connessione->isUsernameTaken($username)) {
            //se non c'é nessun utente con questo usrname
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $query = "INSERT INTO `Utenti` (`Username`, `Password`, `Privilegi`) VALUES ('$username', '$hash', '0');";
            $result = $connessione->execQuery($query);
            if (!$result) {
                //se si verifica un errore
                $replaceMsg =  "Si é verificato un errore, riprovare piú tardi";
            }else{
                //tutto bene
                $replaceMsg = "Registrato con successo";
            }
        }else{
            //username giá utilizzato
            $replaceMsg = "Username giá in uso";
        }
    }else{
        $replaceMsg="Password diverse";
    }
}else{//form non riempito
    $replaceMsg = "";
}

//sostituzioni
$find = array("['UsrVal']","['UsrMsg']");
$replace = array($replaceUser,$replaceMsg);
$paginaHTML = str_replace($find,$replace,$paginaHTML);
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
$paginaHTML = str_replace("[Menu]",Utils::buildNav($curPageName),$paginaHTML);
$paginaHTML = Utils::skipNavBtn($paginaHTML);
$paginaHTML = Utils::addScrollBtn($paginaHTML);
echo str_replace("['Imports']", Utils::globalImports(),$paginaHTML);
$connessione->closeConnection();
?>
