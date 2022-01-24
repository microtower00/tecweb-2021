<?php
    session_start();
    require_once "php_vari/utils.php";
    require_once "php_vari/dbRicky.php";
    use DB\DBAccess;

    /*function modificaStato(){
        $connessione = new DBAccess();
        $connessioneOK = $connessione->openDBConnection();
        $messaggio="";

        if ($connessioneOK) {
            if (isset($_GET['apriP'])) {
                $piste = isset($_GET['piste']) ? $_GET['piste'] : array();
                foreach($piste as $pista) {
                    $connessione->updateState('Piste',$pista,1);
                    $messaggio="Operazione completata correttamente, una o più piste sono state aperte.";
                }
            } elseif (isset($_GET['chiudiP'])) {
                $piste = isset($_GET['piste']) ? $_GET['piste'] : array();
                foreach($piste as $pista) {
                    $connessione->updateState('Piste',$pista,0);
                    $messaggio="Operazione completata correttamente, una o più piste sono state chiuse.";
                }
            } elseif (isset($_GET['apriI'])) {
                $impianti = isset($_GET['impianti']) ? $_GET['impianti'] : array();
                foreach($impianti as $impianto) {
                    echo $impianto;
                    $connessione->updateState('Impianti',$impianto,1);
                    $messaggio="Operazione completata correttamente, uno o più impianti sono stati aperti.";
                }
            } else {
                $impianti = isset($_GET['impianti']) ? $_GET['impianti'] : array();
                foreach($impianti as $impianto) {
                    echo $impianto;
                    $connessione->updateState('Impianti',$impianto,0);
                    $messaggio="Operazione completata correttamente, uno o più impianti sono stati chiusi.";
                }
            }
            $connessione->closeConnection();
            echo str_replace("['Messaggio']",$messaggio,$paginaHTML);
        }
    }*/

    $paginaHTML = file_get_contents("html/modificaComprensorio.html");
    $paginaHTML = Utils::skipNavBtn($paginaHTML);
    $paginaHTML = Utils::addScrollBtn($paginaHTML);

    if(!Utils::checkPriv()){
        header("Location: index.php");
        die("Pagina riservata ad amministratori");
    }

    //CREA LA NAVBAR
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
    $paginaHTML = str_replace("[Menu]",Utils::buildNav($curPageName),$paginaHTML);

    $connessione = new DBAccess();
    $connessioneOK = $connessione->openDBConnection();

    $piste = ""; //dati grezzi dal DB
    $listaPisteAperte = ""; //codice html da dare in output
    $listaPisteChiuse = ""; //codice html da dare in output
    
    $impianti = "";
    $listaImpiantiAperti = "";
    $listaImpiantiChiusi = "";

    if ($connessioneOK) {
        $piste = $connessione->getPisteList();
        $impianti = $connessione->getImpiantiList();
        $connessione->closeConnection();
        
        if ($piste != null) {
            $listaPisteAperte = '<tbody>';
            $listaPisteChiuse = '<tbody>';
            foreach ($piste as $pista) {
                                
                if ($pista['stato'] == 0) {
                    $stato = "Chiusa";
                    $listaPisteChiuse .= '<tr>';
                    $listaPisteChiuse .= '<td><input type="checkbox" name="piste[]" value="' . $pista['numero'] . '" /></td>
                                <td>' . $pista['numero'] . '</td>
                                <td>' . $pista['nome'] . '</td>
                                <td>' . $pista['difficoltà'] . '</td>
                                <td>' . $stato . '</td>';  
                                $listaPisteChiuse .= '</tr>'; 
                } else {
                    $stato = "Aperta";
                    $listaPisteAperte .= '<tr>';
                    $listaPisteAperte .= '<td><input type="checkbox" name="piste[]" value="' . $pista['numero'] . '" /></td>
                                <td>' . $pista['numero'] . '</td>
                                <td>' . $pista['nome'] . '</td>
                                <td>' . $pista['difficoltà'] . '</td>
                                <td>' . $stato . '</td>';  
                                $listaPisteAperte .= '</tr>'; 
                }                                  
            }
            $listaPisteAperte .= '</tbody>';
            $listaPisteChiuse .= '</tbody>';

            if ($listaPisteAperte == "<tbody></tbody>") {
                $listaPisteAperte = "<p>Non ci sono informazioni relative alle piste aperte.</p>";
            }else if ($listaPisteChiuse == "<tbody></tbody>") {
                $listaPisteChiuse = "<p>Non ci sono informazioni relative alle piste chiuse.</p>";
            }

        } else {
            $listaPisteAperte = "<p>Non ci sono informazioni relative alle piste.</p>";
            $listaPisteChiuse = "<p>Non ci sono informazioni relative alle piste.</p>";
        }

        if ($impianti != null) {
            $listaImpiantiAperti = '<tbody>';
            $listaImpiantiChiusi = '<tbody>';
            foreach ($impianti as $impianto) {
                $listaImpiantiAperti .= '<tr>';
                $listaImpiantiChiusi .= '<tr>';
                
                if ($impianto['stato'] == 0) {
                    $stato = "Chiuso";
                    $listaImpiantiChiusi .= '<td><input type="checkbox" name="impianti[]" value="' . $impianto['numero'] . '" /></td>
                                <td>' . $impianto['numero'] . '</td>
                                <td>' . $impianto['nome'] . '</td>
                                <td>' . $impianto['tipo'] . '</td>
                                <td>' . $stato . '</td>';  
                                $listaImpiantiChiusi .= '</tr>'; 
                } else {
                    $stato = "Aperto";
                    $listaImpiantiAperti .= '<td><input type="checkbox" name="impianti[]" value="' . $impianto['numero'] . '" /></td>
                                <td>' . $impianto['numero'] . '</td>
                                <td>' . $impianto['nome'] . '</td>
                                <td>' . $impianto['tipo'] . '</td>
                                <td>' . $stato . '</td>';  
                                $listaImpiantiAperti .= '</tr>'; 
                }                                 
            }

            $listaImpiantiAperti .= '</tbody>';
            $listaImpiantiChiusi .= '</tbody>';

            if ($listaImpiantiAperti == "<tbody></tbody>") {
                $listaImpiantiAperti = "<p>Non ci sono informazioni relative alle piste aperte.</p>";
            }else if ($listaImpiantiChiusi == "<tbody></tbody>") {
                $listaImpiantiChiusi = "<p>Non ci sono informazioni relative alle piste chiuse.</p>";
            }
        } else {
            $listaImpiantiAperti = "<p>Non ci sono informazioni relative agli impianti.</p>";
            $listaImpiantiChiusi = "<p>Non ci sono informazioni relative agli impianti.</p>";
        }
    } else {
        $listaPisteAperte = "<p>I sistemi al momento sono non disponibili, riprova più tardi.</p>";
        $listaPisteChiuse = "<p>I sistemi al momento sono non disponibili, riprova più tardi.</p>";
        $listaImpiantiAperti = "<p>I sistemi al momento sono non disponibili, riprova più tardi.</p>";
        $listaImpiantiChiusi = "<p>I sistemi al momento sono non disponibili, riprova più tardi.</p>";
    }


    $find = array("['PisteChiuse']","['PisteAperte']","['ImpiantiChiusi']","['ImpiantiAperti']","['Imports']");
    $replace = array($listaPisteChiuse,$listaPisteAperte,$listaImpiantiChiusi,$listaImpiantiAperti,Utils::globalImports()."['Imports']");
    $paginaHTML = str_replace($find, $replace, $paginaHTML);

    $messaggio="";
    if (isset($_GET['apriP']) || isset($_GET['chiudiP']) || isset($_GET['apriI']) || isset($_GET['chiudiI'])) {
        $connessione = new DBAccess();
        $connessioneOK = $connessione->openDBConnection();

        if ($connessioneOK) {
            if (isset($_GET['apriP'])) {
                $piste = isset($_GET['piste']) ? $_GET['piste'] : array();
                foreach($piste as $pista) {
                    $connessione->updateState('Piste',$pista,1);
                    $messaggio="Operazione completata correttamente, una o più piste sono state aperte.";
                }
            } elseif (isset($_GET['chiudiP'])) {
                $piste = isset($_GET['piste']) ? $_GET['piste'] : array();
                foreach($piste as $pista) {
                    $connessione->updateState('Piste',$pista,0);
                    $messaggio="Operazione completata correttamente, una o più piste sono state chiuse.";
                }
            } elseif (isset($_GET['apriI'])) {
                $impianti = isset($_GET['impianti']) ? $_GET['impianti'] : array();
                foreach($impianti as $impianto) {
                    echo $impianto;
                    $connessione->updateState('Impianti',$impianto,1);
                    $messaggio="Operazione completata correttamente, uno o più impianti sono stati aperti.";
                }
            } else {
                $impianti = isset($_GET['impianti']) ? $_GET['impianti'] : array();
                foreach($impianti as $impianto) {
                    echo $impianto;
                    $connessione->updateState('Impianti',$impianto,0);
                    $messaggio="Operazione completata correttamente, uno o più impianti sono stati chiusi.";
                }
            }
            $connessione->closeConnection();
            $messaggio .= " Attendi 3 secondi che il database si aggiorni.";
            $paginaHTML = str_replace("['Imports']","<meta http-equiv='refresh' content='3;url=./modificaComprensorio.php' />",$paginaHTML);
        } else {
            $messaggio = "Operazione fallita";
        }
    }else {
        $paginaHTML = str_replace("['Imports']","",$paginaHTML);
    }
    $paginaHTML = str_replace("['Messaggio']",$messaggio,$paginaHTML);

    echo $paginaHTML;

?>