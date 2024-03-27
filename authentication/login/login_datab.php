<?php

declare(strict_types=1);

/* la seguente funzione  puo' restituire due tipi di valori:
    - FALSE : se l'email non e' presente -> l'utente non esiste
    - Array:  altrimenti

    queste considerazioni si collegheranno con il metodo: is_email_wrong*()
*/
function get_user(object $pdo, string $email) {

    $query = "SELECT * FROM users WHERE email = :email;";

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


?>