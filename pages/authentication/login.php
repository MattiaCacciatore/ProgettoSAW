<?php
    require_once ('../../include/config_session.php'); 
    require_once('../../include/authentication/login_view.php');


?>


<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modulo di Login</title>
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

  <h2>Accedi</h2>

<!-- Scheletro del form di registrazione. Non cambiate i nomi dei campi e il nome dello script che viene invocato una volta inseriti i dati richiesti.
Il form può stare in un file a parte oppure nello stesso file registration.php (come abbiamo visto in classe) -->
<form form action="../../include/authentication/login.php" method="post">

        <label for="email">Email</label><br>
        <input type="email" id="email" name="email"><br><br>

        <label for="pass">Password:</label><br>
        <input type="password" id="pass" name="pass"><br><br>
        
        <?php check_login_errors()?>

        <input type="submit" name="submit" value="Accedi">

 </form>






</body>
</html>
