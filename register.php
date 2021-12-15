<?php
include_once "register.html";
include_once "dbConn.php";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['ripetiPassword'])) {
    if($_POST['password'] == $_POST['ripetiPassword']){

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
     
     
        $query = "SELECT * FROM Utenti WHERE Username='$username'";
        $result = mysqli_query($conn, $query);
     
        
        if (mysqli_num_rows($result)==0) {
            //se non c'é nessun utente con questo usrname
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $query = "INSERT INTO `Utenti` (`Username`, `Password`, `Privilegi`) VALUES ('$username', '$hash', '0');";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                //se si verifica un errore
                echo "<p>Si é verificato un errore, riprovare piú tardi</p>";
            }else{
                //tutto bene
                //non credo vada bene inserire in questo modo il feedback
                echo "<p>Registrato con successo</p>";
                header("Location: login.php");
            }
        }else{
            //username giá utilizzato
            echo "<p>Username giá in uso</p>";
        }
    }
}else{
    echo "form non riempito";

}
$conn->close();
?>
