<?php
    require_once('../../include/authentication/registration_view.php');
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
        <li><a href="#">Registrati</a></li>
        <li><a href="#">Accedi</a></li>
      </ul>
    </nav>
  </header>

  <h2>Crea il tuo account</h2>

<!-- Scheletro del form di registrazione. Non cambiate i nomi dei campi e il nome dello script che viene invocato una volta inseriti i dati richiesti.
Il form può stare in un file a parte oppure nello stesso file registration.php (come abbiamo visto in classe) -->

<?php registration_inputs()?>

</body>
</html>
