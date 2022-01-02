<?php
session_start();
require_once "utils.php";
require_once "dbRicky.php";
use DB\DBAccess;



$connessione = new DBAccess();
$connessione->openDBConnection();


$pagina = file_get_contents("carrello.html");


$find = array("['LinkDashboard']","['LinkLogin']");
$replaceDashboard = Utils::checkPriv()?"<a class='right' href='dashboard.php'>Dasboard Admin</a>":"";
$replaceLogin = isset($_SESSION['Privilegi'])?"<a class='right' href='logout.php'>Logout</a>":"<a class='right' href='login.php'>Login</a>";
$replace = array($replaceDashboard,$replaceLogin);
$pagina= str_replace($find, $replace, $pagina);


$articolo_singolo=  "<article class=\"articolo-carrello\">
                <p class=\"intestazione\">['Quantita']x Skipass ['Durata']</p>
                <div class=\"corpo\">
                    <p>['Tipo']</p>
                    <p>Valido dal ['DataInizio'] al ['DataFine']</p>
                </div>
                <p class=\"prezzo\">Prezzo: ['Prezzo']€</p>
            </article>";
$articoli="";

$sql='SELECT tipo_skipass, durata_skipass, data_inizio, quantita, (Prezzo*quantita) AS prezzo  
        FROM Carrelli C JOIN Skipass S ON C.tipo_skipass=S.Tipo AND C.durata_skipass=S.durata 
        WHERE utente="'.$_SESSION["Username"].'";';
$res=$connessione->execQuery($sql);
while($row = $res->fetch_assoc()){
    $articolo_corrente=$articolo_singolo;

    $find_art=array("['Quantita']","['Durata']","['Tipo']","['DataInizio']","['DataFine']","['Prezzo']");

    $durata="";
    switch($row['durata_skipass']){
        case 1:
            $durata="giornaliero";break;
        case 3:
            $durata="3 giorni";break;
        case 7:
            $durata="settimanale";break;
    }
    $dataInizio=Utils::riformaData($row['data_inizio'],'Y-m-d','d/m/Y');
    $dataFine=Utils::dataAggiungiGiorni($dataInizio,$row['durata_skipass'],'d/m/Y');

    $articolo_corrente= str_replace("['Quantita']", $row['quantita'], $articolo_corrente);
    $articolo_corrente= str_replace("['Durata']", $durata, $articolo_corrente);
    $articolo_corrente= str_replace("['Tipo']", $row['tipo_skipass'], $articolo_corrente);
    $articolo_corrente= str_replace("['DataInizio']", $dataInizio, $articolo_corrente);
    $articolo_corrente= str_replace("['DataFine']", $dataFine, $articolo_corrente);
    $articolo_corrente= str_replace("['Prezzo']", $row['prezzo'], $articolo_corrente);

    $articoli.=$articolo_corrente;
}

$pagina= str_replace("['Articoli']", $articoli, $pagina);


$sql = 'SELECT SUM(Prezzo*quantita) AS totale FROM Carrelli C
            JOIN Skipass S ON C.tipo_skipass=S.Tipo AND C.durata_skipass=S.durata
            WHERE utente="'.$_SESSION["Username"].'";';
$tot=$connessione->execQuery($sql)->fetch_assoc()['totale'];
$pagina= str_replace("['Totale']", $tot, $pagina);


echo $pagina
?>