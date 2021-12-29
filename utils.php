<?php
class Utils{

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
        $replace = array("href='index.php'","href='chisiamo.php'","href='comprensorio.php'","href='mappa.php'","href='shop.php'","href='comeRaggiungerci.php'","<a href='login.php' class='right'>Login</a>","");
        $data = "<nav id='menu'>
                    <a ['attrIndex']>Home</a>
                    <a ['attrChisiamo']>Chi siamo</a>
                    <a ['attrComprensorio']>Il nostro Comprensorio</a>
                    <a ['attrMappa']>Mappa delle piste</a>
                    <a ['attrShop']>Compra skipass</a>
                    <a ['attrComeraggiungerci']>Come raggiuncerci</a>
                    ['LinkLogin']
                    ['LinkDashboard']
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
                $replace[6] = "<a class='active right'>Login</a>";
                break;
        }

        if(isset($_SESSION['Privilegi'])){
            $replace[6] = "<a href='logout.php' class='right'>Logout</a>";
            if(Utils::checkPriv()){
                $replace[7]="<a href='dashboard.php' class='right'>Dashboard Admin</a>";
            }
        }
            $data = str_replace($find,$replace,$data);
            return $data;
     }

}

?>