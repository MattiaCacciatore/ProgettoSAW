<?php
  require_once ('../../configuration/config_session.php'); 
?>

<!DOCTYPE html>
<html lang='it'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Modulo di Registrazione</title>
</head>
<body>

<?php
  require_once('../../navbar.php'); /* placeholder. */
?>

  <h2>Crea il tuo account</h2>

<!-- Scheletro del form di registrazione. Non cambiate i nomi dei campi e il nome dello script che viene invocato una volta inseriti i dati richiesti.
Il form può stare in un file a parte oppure nello stesso file registration.php (come abbiamo visto in classe) -->
<form form action='../registration/registration.php' method='post'>

  <label for = 'firstname'>Nome:</label><br>
  <input type = 'text' id = 'firstname' name = 'firstname' required><br>

  <label for = 'lastname'>Cognome:</label><br>
  <input type = 'text' id = 'lastname' name = 'lastname' required><br>

  <label for = 'email'>Indirizzo email:</label><br>
  <input type = 'email' id = 'email' name = 'email' required><br>
        
  <!-- 72 caratteri massimo per l'algoritmo di criptazione bcrypt (vedasi manuale php). -->
  <label for = 'pass'>Password:</label><br>
  <input type = 'password' id = 'pass' name = 'pass' required><br>

  <label for = 'confirm'>Conferma Password:</label><br>
  <input type = 'password' id = 'confirm' name = 'confirm' required><br><br>

  <input type='submit' name='submit' value='Registrati'>

 </form>

</body>
</html>
