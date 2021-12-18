<?php
session_start();
//include_once "login.html";
require_once "dbRicky.php";
use DB\DBAccess;

$paginaHTML = file_get_contents("login.html");
$search = array("['ValUsername']","['Errore']");
$replaceError="";
$replaceUser="";

$connessione = new DBAccess();
$connessioneOK = $connessione->openDBConnection();

if (isset($_POST['username']) && isset($_POST['password'])) {

    $replaceUser=$_POST['username'];

    function valida($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       $data = strip_tags($data);
       return $data;
    }

    //validazione credenziali
    $username = valida($_POST['username']);
    $pass = valida($_POST['password']);


    $sql = "SELECT * FROM Utenti WHERE Username='$username'";
    $result = $connessione->execQuery($sql);


    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['Username'] === $username && password_verify($pass, $row['Password'])) {
            
            //Si puó togliere volendo
            $replaceError="Logged in!";

            //setto variabili di sessione
            $_SESSION['Username'] = $row['Username'];
            $_SESSION['Privilegi'] = $row['Privilegi'];

            //exit();

        }else{
            $replaceError="Username o password non corretti";
            //exit();
        }
    }else{
        $replaceUser = "";
        $replaceError="Username o password non corretti";
        //exit();
    }
}else{
    $replaceError="";
    //exit();

}

$connessione->closeConnection();

echo str_replace($search, array($replaceUser,$replaceError), $paginaHTML);

?>