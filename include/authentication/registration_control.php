<?php

    /* nota: non c'è bisogno di includere il file: registration_datab.php per usare le sue funzioni */

    declare (strict_types = 1);


    function is_input_empty(string $firstname, string $password, string $email){

        return ((empty($firstname) ||  empty($password) || empty($email)));

    }


    function is_email_valid(string $email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) != FALSE ?  TRUE :  FALSE;
    }



    /* restituisce TRUE se l'email  e' gia' presente all'interno del database, FALSE altrimenti */
    function is_email_registred(object $pdo, string $email) {
        
        return (bool) get_email($pdo, $email);
    }



    function create_user(object $pdo, string $firstname, string $email, string $password) {
        
        set_user( $pdo,  $firstname,  $email,  $password);
    }


?>