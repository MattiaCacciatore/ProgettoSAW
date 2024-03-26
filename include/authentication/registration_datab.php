<?php



    declare (strict_types = 1);

    require_once('./registration_control.php');


    
    function insert_user_into_database(object $pdo, string $firstname, string $lastname, string $email, string  $hashedPwd) {
       
        $query = "INSERT INTO users (firstname, lastname, email, pwd) VALUES (:firstname, :lastname, :email, :pwd)";

        // Preparazione della query
            $stmt = $pdo->prepare($query);

    
        // Associazione del parametro :email con il valore della variabile $email
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pwd", $hashedPwd);
    
        // Esecuzione della query
            $stmt->execute();

        
        /* verificando la seguente condizione verifichiamo che sia andato a buon fine */
        return $stmt->rowCount() == 1;


        /* se per esempio l'email fosse già registrata, l'errore verrà sollevato dal database
        siccome email è UNIQUE, quindi non abbiamo bisogno di definire alcun metodoto. tc. se così
        fosse il return sarebbe false perchè le righe inserite nel database sarebbero 0 e non 1 */

        
    }



    


?>