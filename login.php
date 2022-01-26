<?php
session_start();
require_once "php_vari/utils.php";
require_once "php_vari/dbRicky.php";
use DB\DBAccess;

$paginaHTML = file_get_contents("html/login.html");
$replaceError="";
$replaceUser="";
$replaceLink="";
$replaceSuccess="";

$connessione = new DBAccess();
$connessioneOK = $connessione->openDBConnection();

if (isset($_POST['username']) && isset($_POST['password'])) {

    $replaceUser=$_POST['username'];

    //validazione credenziali
    $username = Utils::valida($_POST['username']);
    $pass = Utils::valida($_POST['password']);


    $sql = "SELECT * FROM Utenti WHERE Username='$username'";
    $result = $connessione->execQuery($sql);


    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['Username'] === $username && password_verify($pass, $row['Password'])) {
            
            
            

            //setto variabili di sessione
            $_SESSION['Username'] = $row['Username'];
            $_SESSION['Privilegi'] = $row['Privilegi'];
            if(Utils::checkPriv()){
                $replaceSuccess="Ti sei loggato, verrai portato alla dashboard tra 3 secondi.";
                $paginaHTML = str_replace("['Imports']","<meta http-equiv='refresh' content='3;url=./dashboard.php' />['Imports']",$paginaHTML);
            }else{
                $replaceSuccess="Ti sei loggato, verrai portato alla home tra 3 secondi.";
                $paginaHTML = str_replace("['Imports']","<meta http-equiv='refresh' content='3;url=./index.php' />['Imports']",$paginaHTML);
            }
        }else{
            $replaceError="Username o password non corretti";
            //exit();
        }
    }else{
        $replaceUser = "";
        $replaceError="Username o password non corretti";
        //exit();
    }
}else{
    $replaceError="";
    //exit();

}

$connessione->closeConnection();


$find = array("['ValUsername']","['Errore']","['Success']");
$replace = array($replaceUser,$replaceError,$replaceSuccess);
$paginaHTML = str_replace($find,$replace,$paginaHTML);

$paginaHTML = Utils::skipNavBtn($paginaHTML);
$paginaHTML = Utils::addScrollBtn($paginaHTML);
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
$paginaHTML = str_replace("[Menu]",Utils::buildNav($curPageName),$paginaHTML);
echo str_replace("['Imports']", Utils::globalImports(),$paginaHTML);
if($replaceError=="Logged in!"){
}
?>