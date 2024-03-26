<?php


    if (!$_SERVER["REQUEST_METHOD"] == "POST") {
        header("Location: ../index.php" );
        die();
    }


    $firstname = $_POST["firstname"];
    $firstname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $confirm_password = $_POST['confirm'];



    /************************ ci connettiamo al database ************************ */
    try {
        require_once './include/databaseHandler.php';
        require_once './registration_datab.php';
        require_once './registration_control.php';


        /******* ERROR HANDLERS ******* */ 

        $errors = [];

        if (is_input_empty($firstname, $lastname, $email, $password, $confirm_password)) {
            $errors["empty_input"] =  "Fill in all filelds";
        }


        if ( !is_email_valid($email)) {
            $errors["invalid_email"] =  "invalid email used, be careful man";
        }

        if ( is_email_registred($pdo,  $email)){

            $errors["email_registred"] =  "oh gosh, the email has been registred;
            have you forgotten your account credentials?";

        }

        // verifichiamo che i campi password e confirm_password corrispondano
        if($password != $confirm_password){
            $errors["pwds_arent_equal"] = "The passwords do not match";
        }



        require_once './config_session.inc.php';

        // nota: si e' corretto fare cosi' altrimenti non potremmos
        // scrivere all'interno di $_SESSION
        if($errors) {
            $_SESSION["errors_registration"] = $errors;

            

            /* Ora, anche se ci sono stati degli errori,con  registration data, 
            voglio mantenere i dati di quei campi che sono stati compilati correttamente dell-utente in modo tale
            che lui non debba reinserirli. eccezion fatta per la password per ovvie
            questioni di sicurezza*/

            $registration_data = [
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email,
            ];

            $_SESSION["registration_data"] = $registration_data;


            /* ora ci colleghiamo con registration.php stampare queste varibili nei campi del form */

            header("Location:../../pages/authentication/registration.php ");
            die(); // senza die() all'interno del server si genererebbero comunque degli user con
                    // i campi vuoti; nonostante gli errori vengano correttamente identificati
        }



            create_user( $pdo,  $firstname,  $email,  $password);
            

            /* una volta creato lo user, per il momento rispediamo l'utente alla registration page
            page. Scriveremo il messaggio di successo all'interno dell'url */

            
            header("Location: ../../pages/authentication/registration.php?registration=success");

            $pdo = NULL;
            $stmt = NULL;
            die();

            header("Location: ../../index.php");



           



} catch (PDOException $e) {
        die("Query has failed: ". $e->getMessage());
    }
?>