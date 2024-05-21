<!DOCTYPE html>
<html lang='it'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>
    Modulo di Login
  </title>
</head>

<body>

  <?php require dirname(__FILE__).'/../../modules/navbar.php'; ?>

  <h2>Accedi</h2>

  <!-- Scheletro del form di registrazione. Non cambiate i nomi dei campi e il nome 
  dello script che viene invocato una volta inseriti i dati richiesti.
  Il form può stare in un file a parte oppure nello stesso file registration.php (
  come abbiamo visto in classe) -->
  <form form action='../login/login.php' method='post'>

    <label for='email'>Email</label><br>
    <input type='email' id='email' name='email'><br><br>

    <label for='pass'>Password:</label><br>
    <input type='password' id='pass' name='pass'><br><br>

    <label for = 'remember'>Ricordati di me:</label><br>
    <input type = 'checkbox' name = 'remember' value = 'yes'><br><br>

    <input type='submit' name='submit' value='Accedi'>

  </form>

</body>
</html>
