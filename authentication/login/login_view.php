<?php

declare(strict_types=1);


function check_login_errors() {

    if (isset($_SESSION["errors_login"]) && is_array($_SESSION["errors_login"])) {

        $errors = $_SESSION["errors_login"];

        foreach ($errors as $error ) {
            echo '<p class="form-error">'. $error . '</p>';
        }


        // dopo averli stampanti pulisco l'array
        unset($_SESSION["errors_login"]);


    }elseif (isset($_GET["login"]) && $_GET["login"] == "success") {
        
        /* se l'utenticazione è riuscita allora definisco key la quale salva l'avvenuta autenticazione
         ci servirà per definire quali aree può accedere l'utente, tuttavia penso che bisogneà dare dei permessi per
         far si che questa implementazione sia più generale possibile, dopo di che si andrà a verificare i permessi e quindi
         a quali aree potrà accedere */
        $_SESSION["authenticated"] = true; 
        echo "<br>";
        echo '<p class="form-success"> Log In Success </p>';

        sleep(3);

        // header("Location: ../pages/private/user_area.private.php"); e@Kk4GHrnszfJ#Ab

        
    }
}

?>