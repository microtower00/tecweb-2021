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

}

?>