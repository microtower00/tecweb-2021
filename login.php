<?php
session_start();
include_once "login.html";
include_once "dbConn.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
       echo "Validazione";
    }

    //validazione credenziali (non va)
    $username = validate($_POST['username']);
    $pass = validate($_POST['password']);


    $sql = "SELECT * FROM Utenti WHERE Username='$username'";
    $result = mysqli_query($conn, $sql);

    echo "fetchato ";
    echo mysqli_num_rows($result);
    echo " righe";

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        echo "Verifica password:";
        if (password_verify($pass, $row['password'])){
            echo "1";
        }else{echo "0";}
        if ($row['Username'] === $username && password_verify($pass, $row['password'])) {
            
            //Si puó togliere volendo
            echo "Logged in!";

            //setto variabili di sessione
            $_SESSION['Username'] = $row['Username'];
            $_SESSION['Privilegi'] = $row['Privilegi'];

            //header("Location: index.html");

            exit();

        }else{
            //Username o password sbagliati
            exit();
        }
    }else{
        //username o password sbagliati 
        exit();
    }
}else{
    //form non riempito
    exit();

}

?>