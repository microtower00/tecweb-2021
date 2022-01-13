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
    $replace = array($listaPisteChiuse,$listaPisteAperte,$listaImpiantiChiusi,$listaImpiantiAperti,Utils::globalImports());
    echo str_replace($find, $replace, $paginaHTML);
?>