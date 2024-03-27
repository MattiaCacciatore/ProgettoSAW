<?php

    /* nota: non c'è bisogno di includere il file: registration_datab.php per usare le sue funzioni */

    declare (strict_types = 1);





    function validate_registration_data($firstname, $lastname, $email, $password, $confirm_password) {
        $errors = array();
    
        // Cverifica se c'è qualche campo vuoto
        if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password)) {
            $errors["empty_input"] = "All fields are required.";
        }

            
        // verifichiamo che i nomi e i cognomi possano contenere solo lettere
        if (!preg_match("/^[a-zA-Z]+$/", $firstname)) {
            $errors["invalid_firstname"] = "First name must contain only letters (upper or lower case).";
        }
    
        if (!preg_match("/^[a-zA-Z]+$/", $lastname)) {
            $errors["invalid_lastname"] = "Last name must contain only letters (upper or lower case).";
        }
    
        // verifichiamo che l'email sia scritta correttamente
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["invalid_email"] = "Invalid email format.";
        }

        /* le password devono
         -  essere composte almento da 8 caratteri
         - contenere almento una lettera maiuscola e una minuscola
         - e almeno un numero 
         */
         if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password)) {
            $errors["weak_password"] = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.";
        }
    
        // CVerifichiamo che la password e la password di conferma conbacino
        if ($password != $confirm_password) {
            $errors["invalid_pwd"] = "Passwords do not match.";
        }
    


    
        return $errors;
    }
    






?>