<?php

    /* nota: non c'è bisogno di includere il file: registration_datab.php per usare le sue funzioni */

    declare (strict_types = 1);


    function is_email_registered($pdo, $email) {
        $query = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }



    function validate_registration_data( $firstname, $lastname, $email, $password, $confirm_password) {
        $errors = array();
    
        // Check if any of the fields are empty
        if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password)) {
            $errors["empty_input"] = "All fields are required.";
        }
    
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["invalid_email"] = "Invalid email format.";
        }
    
        // Check if password and confirm password match
        if ($password != $confirm_password) {
            $errors["invalid_pwd"] = "Passwords do not match.";
        }


        return $errors;
    }




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
                $stmt->execute();
                // Registration succeeded
                return true;
            } catch (PDOException $e) {
                // Check if the error is due to duplicate email
                if ($e->getCode() == '45000' && strpos($e->getMessage(), 'Email address must be unique') !== false) {
                    $errors["email_registered"] = "This email address is already registered.";
                } else {
                    $errors["registration_failed"] = "Registration failed. Please try again.";
                    // Log or handle other database errors
                    error_log("Error during registration: " . $e->getMessage());
                }
                return $errors;
            }
        }


?>