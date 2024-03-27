<?php


if (!$_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: ../index.php" );
    die();
}


$email = $_POST["email"];
$password = $_POST["pass"];


try {

    require_once '../databaseHandler.php';
    require_once './login_datab.php';
    require_once './login_control.php';


    /******* ERROR HANDLERS ******* */ 


    $errors = [];


    //NOTA: per il progetto dovremmo generalizzare gli errori per questioni di sicurezza es. "input non corretto"
    

    if ( is_input_empty( $email,  $password )){
    
        $errors["empty_input"] = "Fill in all filelds";
    }

    // nota: pdo la prendimo dal file: databasehandler.inc.php
    $result = get_user($pdo, $email);

    if (!is_email_exsist($result["email"])) {
        $errors["login_error_email"] = "email is incorrect or not exsist";
    }


    /* ricordo che result e' un'array in caso l'utente esista all'interno del db 
    potendo cosi' accedere alla password hashed come qui di seguito*/
    if (!password_verify($password, $result["pwd"])) {
        $errors["login_error_pwd"] = "password is incorrect";
    }


    


    require_once '../config_session.php';
   

    // nota: si e' corretto fare cosi' altrimenti non potremmos
    // scrivere all'interno di $_SESSION
    if($errors) {


        $_SESSION["errors_login"] = $errors;
        header("Location: '../../pages/authentication/login.php?login=failed");
        die(); 

        
    }
    

    header("Location: ../../pages/authentication/login.php?login=success");
    $pdo = null;
    $statement = null ;

    die();

    
} catch (PDOException $e) {
    die("Query has failed: ". $e->getMessage());
}


?>