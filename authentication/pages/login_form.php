<!DOCTYPE html>
<html lang = 'it'>

<head>

  <?php 
    include dirname(__FILE__).'/../../modules/head_style.php';
  ?>

  <link rel="stylesheet" href="../../modules/css/form.css">

  <title>
    Modulo di Accesso
  </title>
  
</head>

<body>

  <?php 
    require dirname(__FILE__).'/../../modules/header.php';
  ?>

  <!-- Scheletro del form di registrazione. Non cambiate i nomi dei campi e il nome 
  dello script che viene invocato una volta inseriti i dati richiesti.
  Il form può stare in un file a parte oppure nello stesso file registration.php (
  come abbiamo visto in classe) -->

  <main>

    <form form action = '../login/login.php' method = 'post'>

      <h2>Accedi</h2>

      <label for = 'email'>Indirizzo Email</label><br>
      <input type = 'email' id = 'email' name = 'email'><br><br>

      <label for = 'pass'>Password:</label><br>
      <input type = 'password' id = 'pass' name = 'pass'><br><br>

      <label for = 'remember'>Ricordati di me:</label><br>
      <input type = 'checkbox' name = 'remember' value = 'yes'><br><br>

      <input type = 'submit' name = 'submit' value = 'Accedi'>

    </form>

  </main>

  <?php 
    require dirname(__FILE__).'/../..//modules/footer.php'; 
  ?>

</body>
</html>
