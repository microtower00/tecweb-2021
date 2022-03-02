<?php
    session_start();
    require_once "php_vari/utils.php";
    require_once "php_vari/dbRicky.php";
    use DB\DBAccess;

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

    

    $piste = ""; //dati grezzi dal DB
    $listaPisteAperte = ""; //codice html da dare in output
    $listaPisteChiuse = ""; //codice html da dare in output
    
    $impianti = "";
    $listaImpiantiAperti = "";
    $listaImpiantiChiusi = "";

    $messaggio="";
    if (isset($_GET['apriP']) || isset($_GET['chiudiP']) || isset($_GET['apriI']) || isset($_GET['chiudiI']) || isset($_GET['cambiaD'])) {
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
            } elseif (isset($_GET['chiudiI'])) {
                $impianti = isset($_GET['impianti']) ? $_GET['impianti'] : array();
                foreach($impianti as $impianto) {
                    echo $impianto;
                    $connessione->updateState('Impianti',$impianto,0);
                    $messaggio="Operazione completata correttamente, uno o più impianti sono stati chiusi.";
                }
            } elseif(isset($_GET['cambiaD'])){
                $nuovaDesc = filter_var($_GET["nuova-descrizione"], FILTER_SANITIZE_STRING);
                $connessione->execQuery("UPDATE Piste SET descrizione='$nuovaDesc' WHERE numero=".$_GET['numero-pista'].";");
                $messaggio="Operazione completata correttamente, cambiata la descrizione della pista ". $_GET['numero-pista'];
            }
            $connessione->closeConnection();
        } else {
            $messaggio = "Operazione fallita";
        }
    }
    $paginaHTML = str_replace("['Messaggio']",$messaggio,$paginaHTML);

    $connessione = new DBAccess();
    $connessioneOK = $connessione->openDBConnection();

    if ($connessioneOK) {
        $piste = $connessione->getPisteList();
        $impianti = $connessione->getImpiantiList();
        $connessione->closeConnection();
        
        if ($piste != null) {
            $listaPisteAperte = '<tbody>';
            $listaPisteChiuse = '<tbody>';
            $selectPiste = '';
            foreach ($piste as $pista) {               
                if ($pista['stato'] == 0) {
                    $stato = "Chiusa";
                    $listaPisteChiuse .= '<tr>';
                    $listaPisteChiuse .= '<td><input type="checkbox" id="p' . $pista['numero'] . '" name="piste[]" value="' . $pista['numero'] . '" /></td>
                                <td><label for="p' . $pista['numero'] . '">' . $pista['numero'] . '</label></td>
                                <td>' . $pista['nome'] . '</td>
                                <td>' . $pista['difficoltà'] . '</td>
                                <td>' . $stato . '</td>';  
                                $listaPisteChiuse .= '</tr>'; 
                } else {
                    $stato = "Aperta";
                    $listaPisteAperte .= '<tr>';
                    $listaPisteAperte .= '<td><input type="checkbox" id="p' . $pista['numero'] . '" name="piste[]" value="' . $pista['numero'] . '" /></td>
                                <td><label for="p' . $pista['numero'] . '">' . $pista['numero'] . '</label></td>
                                <td>' . $pista['nome'] . '</td>
                                <td>' . $pista['difficoltà'] . '</td>
                                <td>' . $stato . '</td>';  
                                $listaPisteAperte .= '</tr>'; 
                }       
                $selectPiste .= '<option value="'.$pista['numero'].'">'.$pista['numero'].' - '.$pista['nome'].'</option>';      
            }
            $listaPisteAperte .= '</tbody>';
            $listaPisteChiuse .= '</tbody>';

            if ($listaPisteAperte == "<tbody></tbody>") {
                $listaPisteAperte = "<p class='error-message'>Non ci sono informazioni relative alle piste aperte.</p>";
            }else if ($listaPisteChiuse == "<tbody></tbody>") {
                $listaPisteChiuse = "<p class='error-message'>Non ci sono informazioni relative alle piste chiuse.</p>";
            }

        } else {
            $listaPisteAperte = "<p class='error-message'>Non ci sono informazioni relative alle piste.</p>";
            $listaPisteChiuse = "<p class='error-message'>Non ci sono informazioni relative alle piste.</p>";
        }

        if ($impianti != null) {
            $listaImpiantiAperti = '<tbody>';
            $listaImpiantiChiusi = '<tbody>';
            foreach ($impianti as $impianto) {
                if ($impianto['stato'] == 0) {
                    $stato = "Chiuso";
                    $listaImpiantiChiusi .= '<tr>';
                    $listaImpiantiChiusi .= '<td><input type="checkbox" id="i' . $impianto['numero'] . '" name="impianti[]" value="' . $impianto['numero'] . '" /></td>
                                <td><label for="i' . $impianto['numero'] . '">' . $impianto['numero'] . '</label></td>
                                <td>' . $impianto['nome'] . '</td>
                                <td>' . $impianto['tipo'] . '</td>
                                <td>' . $stato . '</td>';  
                                $listaImpiantiChiusi .= '</tr>'; 
                } else {
                    $stato = "Aperto";
                    $listaImpiantiAperti .= '<tr>';
                    $listaImpiantiAperti .= '<td><input type="checkbox" id="i' . $impianto['numero'] . '" name="impianti[]" value="' . $impianto['numero'] . '" /></td>
                                <td><label for="i' . $impianto['numero'] . '">' . $impianto['numero'] . '</label></td>
                                <td>' . $impianto['nome'] . '</td>
                                <td>' . $impianto['tipo'] . '</td>
                                <td>' . $stato . '</td>';  
                                $listaImpiantiAperti .= '</tr>'; 
                }                                 
            }

            $listaImpiantiAperti .= '</tbody>';
            $listaImpiantiChiusi .= '</tbody>';

            if ($listaImpiantiAperti == "<tbody></tbody>") {
                $listaImpiantiAperti = "<p class='error-message'>Non ci sono informazioni relative alle piste aperte.</p>";
            }else if ($listaImpiantiChiusi == "<tbody></tbody>") {
                $listaImpiantiChiusi = "<p class='error-message'>Non ci sono informazioni relative alle piste chiuse.</p>";
            }
        } else {
            $listaImpiantiAperti = "<p class='error-message'>Non ci sono informazioni relative agli impianti.</p>";
            $listaImpiantiChiusi = "<p class='error-message'>Non ci sono informazioni relative agli impianti.</p>";
        }
    } else {
        $listaPisteAperte = "<p class='error-message'>I sistemi al momento sono non disponibili, riprova più tardi.</p>";
        $listaPisteChiuse = "<p class='error-message'>I sistemi al momento sono non disponibili, riprova più tardi.</p>";
        $listaImpiantiAperti = "<p class='error-message'>I sistemi al momento sono non disponibili, riprova più tardi.</p>";
        $listaImpiantiChiusi = "<p class='error-message'>I sistemi al momento sono non disponibili, riprova più tardi.</p>";
    }


    $find = array("['PisteChiuse']","['PisteAperte']","['ImpiantiChiusi']","['ImpiantiAperti']", "['SelectPiste']","['Imports']");
    $replace = array($listaPisteChiuse,$listaPisteAperte,$listaImpiantiChiusi,$listaImpiantiAperti,$selectPiste,Utils::globalImports());
    $paginaHTML = str_replace($find, $replace, $paginaHTML);

    echo $paginaHTML;

?>