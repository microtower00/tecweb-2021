<?php
session_start();
//include_once "login.html";
require_once "utils.php";
require_once "dbRicky.php";
use DB\DBAccess;

$paginaHTML = file_get_contents("login.html");
$replaceError="";
$replaceUser="";
$replaceLink="";

$connessione = new DBAccess();
$connessioneOK = $connessione->openDBConnection();

if (isset($_POST['username']) && isset($_POST['password'])) {

    $replaceUser=$_POST['username'];

    //validazione credenziali
    $username = Utils::valida($_POST['username']);
    $pass = Utils::valida($_POST['password']);


    $sql = "SELECT * FROM Utenti WHERE Username='$username'";
    $result = $connessione->execQuery($sql);


    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['Username'] === $username && password_verify($pass, $row['Password'])) {
            
            //Si puó togliere volendo
            

            //setto variabili di sessione
            $_SESSION['Username'] = $row['Username'];
            $_SESSION['Privilegi'] = $row['Privilegi'];
            $replaceError="Logged in!";
            usleep(1*1000*1000);
            header("Location: index.php");

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
if (Utils::checkPriv()){
    $replaceLink = "<a class='right' href='dashboard.php'>Dashboard Admin</a>";
}
$find = array("['ValUsername']","['Errore']","['LinkLogin']","['LinkDashboard']");
$replaceDashboard = Utils::checkPriv()?"<a class='right' href='dashboard.php'>Dasboard Admin</a>":"";
$replaceLogin = isset($_SESSION['Privilegi'])?"<a class='right' href='logout.php'>Logout</a>":"<a class='right' href='login.php'>Login</a>";
$replace = array($replaceUser,$replaceError,$replaceLogin,$replaceDashboard);
echo str_replace($find,$replace,$paginaHTML);
?>