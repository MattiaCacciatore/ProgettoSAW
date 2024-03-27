<?php

declare(strict_types=1);


function is_input_empty(string $email, string $password){

    return  (empty($email) || empty($password));

}


// Concordo sul fatto che non siano necessarie tuttavia migliorano la leggibilita' del codice
function is_email_exsist (bool | array  $result_from_getUser) {

    return $result_from_getUser == FALSE? FALSE: TRUE;
} 




?>