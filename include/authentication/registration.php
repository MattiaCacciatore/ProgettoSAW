<?php



// Redirect if not a POST request
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: ../index.php");
        exit();
    }

// Retrieve form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $confirm_password = $_POST['confirm'];

// Include necessary files and functions
    require_once '../databaseHandler.php';
    require_once './registration_datab.php';
    require_once './registration_control.php';
    require_once '../config_session.php';




try {

    // proviamo a registrare il nuovo utente
    $registration_result = register_user($pdo, $firstname, $lastname, $email, $password);

    // se tutto va a buon fine
    if ($registration_result === true) {

        
        header("Location: ../../pages/authentication/registration.php?registration=success");
        exit();


    } else {

        // Altrimenti... 
        $_SESSION["registration_errors"] = $errors;
        header("Location: ../../pages/authentication/registration.php");
        exit();
    }
} catch (PDOException $e) {

    // Se per puro caso insorgessero alti errori lato database
    die("Query has failed: ". $e->getMessage());

}

?>
