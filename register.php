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

    if($_POST['password'] == $_POST['ripetiPassword']){


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
$find = array("['UsrVal']","['UsrMsg']","['LinkDashboard']","['LinkLogin']");
$replaceDashboard = Utils::checkPriv()?"<a class='right' href='dashboard.php'>Dasboard Admin</a>":"";
$replaceLogin = isset($_SESSION['Privilegi'])?"<a class='right' href='logout.php'>Logout</a>":"<a class='right' href='login.php'>Login</a>";
$replace = array($replaceUser,$replaceMsg,$replaceDashboard, $replaceLogin);
echo str_replace($find,$replace,$paginaHTML);
$connessione->closeConnection();
?>
