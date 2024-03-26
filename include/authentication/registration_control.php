<?php

    /* nota: non c'è bisogno di includere il file: registration_datab.php per usare le sue funzioni */

    declare (strict_types = 1);


    function validate_registration_data($firstname, $lastname, $email, $password) {
        $errors = array();
    
        if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
            $errors["empty_input"] = "All fields are required.";
        }
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["invalid_email"] = "Invalid email format.";
        }
    
    
        return $errors;
    }





    function register_user($pdo, $firstname, $lastname, $email, $password) {
        $errors = validate_registration_data($firstname, $lastname, $email, $password);
    
        // in assenza di errori, restituisce un vettore vuoto
        if (!empty($errors)) {


            return $errors;
        }
    
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        /* nota: siccome hai detto che gli errori devono essere il più generici possibili */
        if (!insert_user_into_database($pdo, $firstname, $lastname, $email, $hashed_password)) {
            $errors["registration_failed"] = "Registration failed. Please try again.";
            return $errors;
        }
    
    }


?>