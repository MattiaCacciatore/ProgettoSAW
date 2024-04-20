<?php


if (!$_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: ../../index.php" );
    die(); // 1- Meglio impostazione con if($SERVER){} header()?
}


$email = $_POST["email"];
$password = $_POST["pass"];


try {

    require_once '../../configuration/databaseHandler.php'; // 2- Aprire adesso la connessione con il database non è ottimale.
    require_once './login_datab.php';                       // 3- Richiamo delle funzioni, quindi ci sta, ma serve un file a parte?
    require_once './login_control.php';                     // 4- Controlli ripetuti ma ci stanno se usati sia per login che per registration. Letto commento.


    /******* ERROR HANDLERS ******* */ 


    $errors = [];


    //NOTA: per il progetto dovremmo generalizzare gli errori per questioni di sicurezza es. "input non corretto"
    

    if ( is_input_empty( $email,  $password )){
    
        $errors["empty_input"] = "Fill in all filelds"; // 5- Anche qui, non è meglio schematizzare con degli if(){}else{}?
    }

    // nota: pdo la prendimo dal file: databasehandler.inc.php
    $result = get_user($pdo, $email);                   // 6-  La preparazione e l'esecuzione della query non è all'interno di un try-catch! -> il try parte alla riga 14, what?

    if (!is_email_exsist($result["email"])) {
        $errors["login_error_email"] = "email is incorrect or not exsist";
    }


    /* ricordo che result e' un'array in caso l'utente esista all'interno del db 
    potendo cosi' accedere alla password hashed come qui di seguito*/
    if (!password_verify($password, $result["pwd"])) {
        $errors["login_error_pwd"] = "password is incorrect";
    }


    


    require_once ('../../configuration/config_session.php');
   

    // nota: si e' corretto fare cosi' altrimenti non potremmos
    // scrivere all'interno di $_SESSION
    if($errors) {


        $_SESSION["errors_login"] = $errors; // 7- Gli errori dovuti alla connessione di un utente NON vanno inserite nell'array super globale, ma su un file di .log
        header("Location: '../pages/login.phplogin=failed");
        die(); 

        
    }
    

    header("Location: ../pages/login.phplogin=success"); // 8- Il reindirizzamento dovrebbe avvenire verso la homepage index.php
    $pdo = null;
    $statement = null ;

    die(); // 9- Perchè chiamare die()?

    
} catch (PDOException $e) {
    die("Query has failed: ". $e->getMessage());
}


?>