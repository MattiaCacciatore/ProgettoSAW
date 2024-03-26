<?php

    declare (strict_types = 1);



/*  verifichiamo se in SESSION sono stati registrati degli errori e li stampiamo  altrimenti stamperemo 
 *   un messaggio di successo*/
    function check_registration_errors() {
        if (isset($_SESSION["registration_errors"]) && is_array($_SESSION["registration_errors"])) {


            $errors = $_SESSION["registration_errors"];

            echo "<br>";

            foreach ($errors as $error ) {
               echo '<p class="form-error">'. $error . '</p>';
            }

            // dopo averli stampati mi premuro di eliminarli dalla variabile globale
            unset($_SESSION["registration_errors"]);


        }elseif (isset($_GET["registration"]) && $_GET["registration"] == "success") {

            echo "<br>";
            echo '<p class="form-success"> Sign In Success </p>';

        }
    }



    /* funzione che visualizza i campi di input del form di registration, e che nel caso
    fossero stati corrattamente compilati (salvati in $_SESSION["registration_data"])  li ripresenta*/
    function registration_inputs()  {
        


        // verifico che il campo registration_data non sia vuoto per la key firstname
        if (isset($_SESSION["registration_data"]["firstname"])) {


            // verrra' cos' ristampato nel campo con il dato corretto inserito dall'utente
            // NOTA: dovrei inserire dei triggher o qualcosa per validare i nomi così non va bene
            echo'<label for="firstname">Firstname</label><br>
            <input type="text" id="firstname" name="firstname"
            value="'.$_SESSION["registration_data"]["firstname"].'"><br><br>';


        }else {

            // altrimenti...
            echo'<label for="firstname">Firstname</label><br>
            <input type="text" id="firstname" name="firstname"><br><br>';
        }



        // verifico che il campo registration_data non sia vuoto per la key lastname
        if (isset($_SESSION["registration_data"]["lastname"])) {


            // verrra' cos' ristampato nel campo con il dato corretto inserito dall'utente
            // NOTA: dovrei inserire dei triggher o qualcosa per validare i nomi così non va bene
            echo'<label for="lastname">Cognome</label><br>
            <input type="text" id="lastname" name="lastname"
            value="'.$_SESSION["registration_data"]["lastname"].'"><br><br>';


        }else {

            // altrimenti...
            echo'<label for="lastname">Cognome</label><br>
            <input type="text" id="lastname" name="lastname"><br><br>';
        }



        // verifico che il campo registration_data non sia vuoto per la key email
        if (isset($_SESSION["registration_data"]["email"]) &&
            !isset($_SESSION["errors_registration"]["invalid_email"]) &&
            !isset($_SESSION["errors_registration"]["email_registred"])) {

            // verrra' cos' ristampato nel campo
            echo '<label for="email">Email</label><br>
            <input type="email" id="email" name="email"
            value="'.$_SESSION["registration_data"]["email"].'  "><br><br>';


        }else {

            // altrimenti...
            echo '<label for="email">Email</label><br>
            <input type="email" id="email" name="email"><br><br>';
        }


        // contrariamente per la password il campo sara' sempre vuoto
        echo '<label for="pass">Password:</label><br>
        <input type="password" id="pass" name="pass"><br><br>';


        echo '<label for="confirm">Conferma Password:</label><br>
        <input type="password" id="confirm" name="confirm"><br><br>';


        echo '<input type="submit" name="submit" value="Accedi">';
    }







?>