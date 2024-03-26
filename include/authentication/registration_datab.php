<?php



    declare (strict_types = 1);



    
    function insert_user_into_database($pdo, $firstname, $lastname, $email, $hashedPwd) {
        $query = "INSERT INTO users (firstname, lastname, email, pwd) VALUES (:firstname, :lastname, :email, :pwd)";
    
        $stmt = $pdo->prepare($query);
    
        $stmt->bindParam(":firstname", $firstname);
        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pwd", $hashedPwd);
    
        // Execute the query
        if (!$stmt->execute()) {
            // If execution fails, return false
            return false;
        }
    
        // If execution succeeds, return true
        return true;
    }



    


?>