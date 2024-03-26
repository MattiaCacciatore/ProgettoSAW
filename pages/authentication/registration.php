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
  <form action="../../include/authentication/registration.php" method="post">
    <label for="firstname">Nome:</label>
    <input type="text" id="firstname" name="firstname" required><br><br>

    <label for="lastname">Cognome:</label>
    <input type="text" id="lastname" name="lastname" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="pass">Password:</label>
    <input type="password" id="pass" name="pass" required><br><br>

    <label for="confirm">Conferma Password:</label>
    <input type="password" id="confirm" name="confirm" required><br><br>

    <input type="submit" name="submit" value="Accedi">
  </form>

</body>
</html>
