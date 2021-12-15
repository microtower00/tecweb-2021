<?php
    require_once "dbRicky.php";
    use DB\DBAccess;

    $paginaHTML = file_get_contents("comprensorio.html");

    $connessione = new DBAccess();
    $connessioneOK = $connessione->openDBConnection();

    $piste = ""; //dati grezzi dal DB
    $listaPiste = ""; //codice html da dare in output

    if ($connessioneOK) {
        $piste = $connessione->getPisteList();
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
    } else {
        $listaPiste = "<p>I sistemi al momento sono non disponibili, riprova più tardi.</p>";
    }

    echo str_replace("['Piste']",$listaPiste,$paginaHTML);
?>