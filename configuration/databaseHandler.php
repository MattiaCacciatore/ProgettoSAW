<?php

  
    $host = 'localhost'; 
    $dbname ='S4850100'; 
    $dbusername = 'S4850100'; 
    $dbpassword = 'pHpIs50DeCeNt'; 

    try {
        // proviamo di stabilire una connessione al database MySQL utilizzando PDO
        $pdo = new PDO ("mysql:host=$host; dbname=$dbname",$dbusername, $dbpassword);
        
        // settiamo il pdo per verificare se ci sono stati degli errori
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {

        die("Connessione fallita: ". $e->getMessage());

        /** in breve questo e' come  un errno per verificare se la connessione
         * e' andata a buon fine o meno
         */
    }
?>