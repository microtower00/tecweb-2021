<?php
class Utils{
    public static function validaData($date, $format = 'Y-m-d'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    public static function dataAggiungiGiorni($date,$giorni, $format= 'Y-m-d'){
        $d = DateTime::createFromFormat($format, $date);
        return $d->modify("+$giorni day")->format($format);
    }
    public static function riformaData($date, $format_in = 'Y-m-d', $format_out='d/m/Y'){
        $d = DateTime::createFromFormat($format_in, $date);
        return $d->format($format_out);
    }

    public static function valida($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        return $data;
     }

    public static function checkPriv(){
        if(isset($_SESSION['Privilegi']))
            return $_SESSION['Privilegi']=="1";
    }

    public static function buildNav($page){
        $find = array("['attrIndex']","['attrChisiamo']","['attrComprensorio']","['attrMappa']","['attrShop']","['attrComeraggiungerci']","['LinkLogin']","['LinkDashboard']");
        $replace = array("href='index.php'","href='chisiamo.php'","href='comprensorio.php'","href='mappa.php'","href='shop.php'","href='comeRaggiungerci.php'","<li class='right'><a id='login' href='login.php' class='right'>Login</a></li>","");
        $data = "<nav aria-label='Menu principale' id='menu'>
                <h2>Valle Bianca <span lang='en'>Ski</span></h2>
                <div class='pulsanteMenu' onclick='toggleMenu()'>
                <button aria-label='Espandi il menu' aria-controls='ulMenu' aria-expanded='true'>
                        <span class='barra'></span>
                        <span class='barra'></span>
                        <span class='barra'></span>
                        </button>
                </div>
                    <ul id='ulMenu' class='active'>
                        <li><a id='home' ['attrIndex']><span lang='en'>Home</span></a></li>
                        <li><a id='info' ['attrChisiamo']>Chi siamo</a></li>
                        <li><a id='comprensorio' ['attrComprensorio']>Il nostro Comprensorio</a></li>
                        <li><a id='mappaIcon' ['attrMappa']>Mappa delle piste</a></li>
                        <li><a id='shop' ['attrShop']>Compra <span lang='en'>skipass</span></a></li>
                        <li><a id='come-raggiungerci' ['attrComeraggiungerci']>Come raggiuncerci</a></li>
                            ['LinkLogin']
                            ['LinkDashboard']
                        
                    </ul>
                </nav>";
                
        switch ($page){
            case "index.php":
                $replace[0] = "class = 'active'";
                break;
            case "chisiamo.php":
                $replace[1] = "class = 'active'";
                break;
            case "comprensorio.php":
                $replace[2] = "class = 'active'";
                break;
            case "mappa.php":
                $replace[3] = "class = 'active'";
                break;
            case "shop.php":
                $replace[4] = "class = 'active'";
                break;
            case "comeRaggiungerci.php":
                $replace[5] = "class = 'active'";
                break;
            case "login.php":
                $replace[6] = "<li class='right'><a id='login' class='active right'><span lang='en'>Login</span></a></li>";
                break;
        }

        if(isset($_SESSION['Privilegi'])){
            $replace[6] = "<li class='right'><a id='logout' href='logout.php' class='right'><span lang='en'>Logout</span></a></li>";
            if(Utils::checkPriv()){
                $replace[7]="<li ><a id='dashboard' href='dashboard.php' class=''><span lang='en'>Dashboard Admin</span></a></li>";
            }
        }
            $data = str_replace($find,$replace,$data);
            return $data;
    }

    public static function globalImports(){
        $css="<link rel='stylesheet' type='text/css' media='screen' href='css/style.css' />";
        $scriptMenu="<script src='js/menu.js'></script>";
        $cssTablet="<link rel='stylesheet' type='text/css' media='screen and (min-width: 601px) and (max-width: 1090px), only screen and (min-width: 601px) and (max-width:1090px)' href='css/tablet.css' />";
        $cssMini="<link rel='stylesheet' type='text/css' media='screen and (max-width: 600px), only screen and (max-width:600px)' href='css/mini.css' />";
        $cssPrint="<link rel='stylesheet' type='text/css' media='print' href='css/print.css' />";
        $icon="<link rel='shortcut icon' type='image/png' href='icon/icons8-montagna-48.png' />";
        return $css."\n".$cssTablet."\n".$cssMini."\n".$cssPrint."\n".$scriptMenu."\n".$icon;
    }

    public static function skipNavBtn($html){
        return str_replace("['BtnSkip']", "<nav aria-label='Salta al contenuto'><a class='skip-nav' href='#content'>Salta il menu</a></nav>",$html); 
    }

    public static function addScrollBtn($html){
        return str_replace("['BtnScroll']","<nav aria-label='Torna su'><a class='linkScroll' href='#top'>Torna all'inizio</a></nav>",$html);
    }
}

?>