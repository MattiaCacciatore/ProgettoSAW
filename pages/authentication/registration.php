<?php
    require_once('../../include/authentication/registration_view.php');
    require_once ('../../include/config_session.php'); 


?>


<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modulo di Registrazione</title>
</head>
<body>

  <header>
    <nav>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Contatti</a></li>
        <li><a href="./registration.php">Registrati</a></li>
        <li><a href="./login.php">Accedi</a></li>
      </ul>
    </nav>
  </header>

  <h2>Crea il tuo account</h2>

<!-- Scheletro del form di registrazione. Non cambiate i nomi dei campi e il nome dello script che viene invocato una volta inseriti i dati richiesti.
Il form può stare in un file a parte oppure nello stesso file registration.php (come abbiamo visto in classe) -->
<form form action="../../include/authentication/registration.php" method="post">

         <?php registration_inputs();
         unset($_SESSION["registration_data"]); ?>
        
        <?php check_registration_errors()?>


        <input type="submit" name="submit" value="Registrati">

 </form>






</body>
</html>
