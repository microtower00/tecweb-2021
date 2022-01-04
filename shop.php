<?php
session_start();
require_once "utils.php";
require_once "dbRicky.php";
use DB\DBAccess;



$connessione = new DBAccess();
$connessione->openDBConnection();

$pagina = file_get_contents("shop.html");



//CREA LA NAVBAR
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
$pagina = str_replace("[Menu]",Utils::buildNav($curPageName),$pagina);

//INSERISCE IL NUMERO DI SKIPASS NEL CARRELLO
$sql='SELECT COALESCE(SUM(quantita), 0) AS num_skipass FROM Carrelli WHERE utente="'.$_SESSION['Username'].'";';
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