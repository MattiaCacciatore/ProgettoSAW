<?php



    declare (strict_types = 1);



    
    function register_user($pdo, $firstname, $lastname, $email, $password, $confirm_password) {
        // Validate input data
        $errors = validate_registration_data($firstname, $lastname, $email, $password, $confirm_password);
        if (!empty($errors)) {
            return $errors;
        }
    
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        // Insert user into the database
        $query = "INSERT INTO users (firstname, lastname, email, pwd) VALUES (:firstname, :lastname, :email, :pwd)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":firstname", $firstname);
        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pwd", $hashed_password);
    
        try {
            
            // proviamo a eseguire l'inserimento all'interno del database dell'utente
            $stmt->execute();
            return true;

        } catch (PDOException $e) { 

            // in caso di errore: verifichiamo se è dovuto all'inserimento di una email duplicata
            if ($e->getCode() == '23000' && strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $errors["email_registered"] = "This email address is already registered.";

            } else {

                // se ci fossero altre cause
                $errors["registration_failed"] = "Registration failed. Please try again. Error code:". $e->getCode() . $e->getMessage() ;
                // Log or handle other database errors
                error_log("Error during registration: " . $e->getMessage());
            }
            return $errors;
        }
    }



    


?>