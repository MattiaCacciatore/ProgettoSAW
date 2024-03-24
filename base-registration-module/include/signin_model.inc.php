<?php

    declare (strict_types = 1);


    /*  */
    function get_email(object $pdo, string $email) {

   
        $query = "SELECT email FROM users WHERE email = :email;";

    // Preparazione della query
        $stmt = $pdo->prepare($query);

    // Associazione del parametro :email con il valore della variabile $email
        $stmt->bindParam(":email", $email);

    // Esecuzione della query
        $stmt->execute();

    // Recupero della riga risultante come un array associativo
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;

    }


    function set_user(object $pdo, string $firstname, string $email, string $password) {
       
        $query = "INSERT INTO users (firstname, email, pwd) VALUES (:firstname, :email, :pwd );";

        // Preparazione della query
            $stmt = $pdo->prepare($query);


            
            $hashedPwd = password_hash($password, PASSWORD_BCRYPT);
    
        // Associazione del parametro :email con il valore della variabile $email
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pwd", $hashedPwd);
    
        // Esecuzione della query
            $stmt->execute();
    }

?>