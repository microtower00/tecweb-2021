<?php
    session_start();
    require_once "utils.php";
    require_once "dbRicky.php";
    use DB\DBAccess;

    $paginaHTML = file_get_contents("comprensorio.html");

    $connessione = new DBAccess();
    $connessioneOK = $connessione->openDBConnection();

    $piste = ""; //dati grezzi dal DB
    $listaPiste = ""; //codice html da dare in output
    
    $impianti = "";
    $listaImpianti = "";

    if ($connessioneOK) {
        $piste = $connessione->getPisteList();
        $impianti = $connessione->getImpiantiList();
        $connessione->closeConnection();
        if ($piste != null) {
            $listaPiste = '<tbody>';
            foreach ($piste as $pista) {
                $listaPiste .= '<tr>';
                
                if ($pista['stato'] == 0) {
                    $stato = "Chiusa";
                } else {
                    $stato = "Aperta";
                }
                
                $listaPiste .= '<td><a href="dettagli.php#' . $pista['numero'] . '">' . $pista['numero'] . '</a></td>
                                <td>' . $pista['nome'] . '</td>
                                <td>' . $pista['difficoltà'] . '</td>
                                <td>' . $pista['lunghezza'] . '</td>
                                <td>' . $pista['dislivello'] . '</td>
                                <td>' . $stato . '</td>';  
                                $listaPiste .= '</tr>';                                  
            }
            $listaPiste .= '</tbody>';
        } else {
            $listaPiste = "<p>Non ci sono informazioni relative alle piste.</p>";
        }

        if ($impianti != null) {
            $listaImpianti = '<tbody>';
            foreach ($impianti as $impianto) {
                $listaImpianti .= '<tr>';
                
                if ($impianto['stato'] == 0) {
                    $stato = "Chiuso";
                } else {
                    $stato = "Aperto";
                }
                
                $listaImpianti .= '<td>' . $impianto['numero'] . '</td>
                                <td>' . $impianto['nome'] . '</td>
                                <td>' . $impianto['tipo'] . '</td>
                                <td>' . $impianto['lunghezza'] . '</td>
                                <td>' . $impianto['dislivello'] . '</td>
                                <td>' . $stato . '</td>';  
                                $listaImpianti .= '</tr>';                                  
            }
            $listaImpianti .= '</tbody>';
        } else {
            $listaImpianti = "<p>Non ci sono informazioni relative agli impianti.</p>";
        }
    } else {
        $listaPiste = "<p>I sistemi al momento sono non disponibili, riprova più tardi.</p>";
        $listaImpianti = "<p>I sistemi al momento sono non disponibili, riprova più tardi.</p>";
    }


    $cercataArray = array("['Piste']","['Impianti']","['LinkDashboard']");
    $sostitutaArray = array($listaPiste,$listaImpianti,Utils::checkPriv()?"<a href='dashboard.php'>Dasboard Admin</a>":"");
    
    echo str_replace($cercataArray,$sostitutaArray,$paginaHTML);
?>
