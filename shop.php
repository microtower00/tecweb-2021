<?php
session_start();
require_once "php_vari/utils.php";
require_once "php_vari/dbRicky.php";
use DB\DBAccess;



$connessione = new DBAccess();
$connessione->openDBConnection();

$pagina = file_get_contents("html/shop.html");
$pagina = Utils::skipNavBtn($pagina);
$pagina = Utils::addScrollBtn($pagina);


//CREA LA NAVBAR
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
$pagina = str_replace("[Menu]",Utils::buildNav($curPageName),$pagina);
$pagina = str_replace("['Imports']", Utils::globalImports(),$pagina);

//INSERISCE IL MINIMO PER LA DATA DEGLI SKIPASS
$pagina= str_replace("['DataOggi']", date('Y-m-d'), $pagina);

if(isset($_SESSION['Username'])){
    //INSERISCE IL NUMERO DI SKIPASS NEL CARRELLO
    $sql='SELECT COALESCE(SUM(quantita), 0) AS num_skipass FROM Carrelli WHERE utente="'.$_SESSION['Username'].'";';
    $result=$connessione->execQuery($sql);
    $pagina= str_replace(
        "['Numero-Skipass']", 
        $result->fetch_assoc()['num_skipass'],
        $pagina);

    $pagina= str_replace("['ErrNotLogged']", '', $pagina);
    $pagina= str_replace("['CarrelloNascoto']",'',$pagina);
    $pagina= str_replace("['ShopDisabled']", '', $pagina);
}else{
    //DISABILITA I PULSANTI DI AGGIUNTA AL CARRELLO
    $pagina= str_replace("['ErrNotLogged']", '<p class="warning-message">Non è possibile aggiungere skipass al carrello se non si è autenticati</p>', $pagina);
    $pagina= str_replace("['ShopDisabled']", 'disabled', $pagina);
    $pagina= str_replace("['CarrelloNascoto']",'class="carrello-nascosto"',$pagina);

    $pagina= str_replace("['Numero-Skipass']", '', $pagina);
}

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

//INSERISCE MESSAGGI DI ERRORRE O SUCCESSO
$replace='';
if(isset($_GET['err']))
    $replace=implode(', ',$_GET['err']);
$pagina = str_replace("['ErrMsg']", $replace, $pagina);

$replace='';
if(isset($_GET['suc']))
    $replace=$_GET['suc'];
$pagina = str_replace("['SucMsg']", $replace, $pagina);

//TABELLA PREZZI
$sql="SELECT Prezzo FROM `Skipass` ORDER BY Tipo,Durata";
$connessione = new DBAccess();
$connessione->openDBConnection();  
$res = $connessione->execQuery($sql);
$prezzi=[];
while($r = $res->fetch_assoc()){
    $prezzi[]=number_format($r['Prezzo'],2,',',' ');
}

$find=["['i1']","['i3']","['i7']","['r1']","['r3']","['r7']"];
$pagina = str_replace($find,$prezzi,$pagina);


echo $pagina;

?>