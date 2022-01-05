<?php
session_start();
require_once "utils.php";
require_once "dbRicky.php";
use DB\DBAccess;

$connessione = new DBAccess();
$connessioneOK = $connessione->openDBConnection();

if ($connessioneOK) {
    if (isset($_GET['apriP'])) {
        $piste = isset($_GET['piste']) ? $_GET['piste'] : array();
        foreach($piste as $pista) {
            $connessione->updateState('Piste',$pista,1);
        }
    } elseif (isset($_GET['chiudiP'])) {
        $piste = isset($_GET['piste']) ? $_GET['piste'] : array();
        foreach($piste as $pista) {
            $connessione->updateState('Piste',$pista,0);
        }
    } elseif (isset($_GET['apriI'])) {
        $impianti = isset($_GET['impianti']) ? $_GET['impianti'] : array();
        foreach($impianti as $impianto) {
            echo $impianto;
            $connessione->updateState('Impianti',$impianto,1);
        }
    } else {
        $impianti = isset($_GET['impianti']) ? $_GET['impianti'] : array();
        foreach($impianti as $impianto) {
            echo $impianto;
            $connessione->updateState('Impianti',$impianto,0);
        }
    }
    $connessione->closeConnection();
    header('Location: modificaComprensorio.php');
}

?>