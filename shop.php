<?php
session_start();
require_once "utils.php";
require_once "dbRicky.php";
use DB\DBAccess;



$connessione = new DBAccess();
$connessione->openDBConnection();

$pagina = file_get_contents("shop.html");



//CREA LA NAVBAR
$find = array("['LinkDashboard']","['LinkLogin']");
$replaceDashboard = Utils::checkPriv()?"<a class='right' href='dashboard.php'>Dasboard Admin</a>":"";
$replaceLogin = isset($_SESSION['Privilegi'])?"<a class='right' href='logout.php'>Logout</a>":"<a class='right' href='login.php'>Login</a>";
$replace = array($replaceDashboard,$replaceLogin);
$pagina= str_replace($find, $replace, $pagina);

//INSERISCE IL NUMERO DI SKIPASS NEL CARRELLO
$sql='SELECT SUM(quantita) AS num_skipass FROM Carrelli WHERE utente="'.$_SESSION['Username'].'";';
$result=$connessione->execQuery($sql);
$pagina= str_replace("['Numero-Skipass']", $result->fetch_assoc()['num_skipass'], $pagina);

//RISELEZIONA I RADIO BUTTON
$find=array("['Checked-1g']","['Checked-3g']","['Checked-7g']");
$replace=array("","","");
if(isset($_GET['durata'])){
    switch($_GET['durata']){
        case 1:
            $replace[0]='checked';break;
        case 3:
            $replace[1]='checked';break;
        case 7:
            $replace[2]='checked';break;
    }
}
$pagina = str_replace($find, $replace, $pagina);

//RE-INSERISCE LA DATA DI INIZIO
$replace="";
if(isset($_GET['data-inizio']))
    $replace=$_GET['data-inizio'];
$pagina = str_replace("['DataInizioVal']", $replace, $pagina);

//RE-INSERISCE IL NUMERO DI SKI-PASS INTERI
$replace="0";
if(isset($_GET['intero']))
    $replace=$_GET['intero'];
$pagina = str_replace("['InteroVal']", $replace, $pagina);

//RE-INSERISCE IL NUMERO DI SKI-PASS RIDOTTI
$replace="0";
if(isset($_GET['ridotto']))
    $replace=$_GET['ridotto'];
$pagina = str_replace("['RidottoVal']", $replace, $pagina);



echo $pagina;

?>