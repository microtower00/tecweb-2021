<?php
session_start();
//include_once "html/register.html";
require_once "php_vari/utils.php";
require_once "php_vari/dbRicky.php";
use DB\DBAccess;
$paginaHTML = file_get_contents("html/register.html");
$replaceMsg="";
$replaceUser="";
$replaceMail="";
$replaceLink="";
$replaceSuccess="";

$connessione = new DBAccess();
$connessioneOK = $connessione->openDBConnection();

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['ripetiPassword'])&& isset($_POST['email']) && isset($_POST['ripetiEmail'])) {
    
    
    $exp = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=.\-_*!?])([a-zA-Z0-9@#$%^&+=*.\-_!?]){8,}$|^$/";
    $expUsr = "/^[a-zA-Z0-9_\.]{5,20}$|^$/";
    $exprEmail= "/^[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+$/";
    if(!(preg_match($exp,$_POST['password']) || preg_match($exp, $_POST['ripetiPassword']) || preg_match($expUsr, $_POST['username']))){
        $replaceMsg = "Username o password non validi.";
    }
    else if(!(preg_match($exprEmail,$_POST['email'])&&preg_match($exprEmail,$_POST['email']))){
        $replaceMsg = "Email non valida";
    }
    else if($_POST['password'] == $_POST['ripetiPassword'] && $_POST['email']==$_POST['ripetiEmail']){
        $replaceMail=$_POST['email'];
        $replaceUser=$_POST['username'];
     
        //validazione credenziali
        $username = Utils::valida($_POST['username']);
        $pass = Utils::valida($_POST['password']);
        $mail = Utils::valida($_POST['email']);
     
        
        if (!$connessione->isUsernameTaken($username)) {
            //se non c'é nessun utente con questo usrname
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $query = "INSERT INTO `Utenti` (`Username`, `Password`, `Privilegi`, `Email`) VALUES ('$username', '$hash', '0', '$mail');";
            $result = $connessione->execQuery($query);
            if (!$result) {
                //se si verifica un errore
                $replaceMsg =  "Si é verificato un errore, riprovare piú tardi";
            }else{
                //tutto bene
                $replaceSuccess = "Registrato con successo";
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
$find = array("['UsrVal']","['UsrMsg']", "['EmailVal']","['Success']");
$replace = array($replaceUser,$replaceMsg, $replaceMail,$replaceSuccess);
$paginaHTML = str_replace($find,$replace,$paginaHTML);
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
$paginaHTML = str_replace("[Menu]",Utils::buildNav($curPageName),$paginaHTML);
$paginaHTML = Utils::skipNavBtn($paginaHTML);
$paginaHTML = Utils::addScrollBtn($paginaHTML);
echo str_replace("['Imports']", Utils::globalImports(),$paginaHTML);
$connessione->closeConnection();
?>
