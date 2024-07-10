<!DOCTYPE html>
<html lang = 'it'>

<head>

  <?php 
    include dirname(__FILE__).'/../../modules/head_style.php'; 
  ?>

  <link rel="stylesheet" href="../../modules/css/form.css">

  <title>
    Modulo di Registrazione
  </title>
  
</head>

<body>

  <?php 
    require dirname(__FILE__).'/../../modules/header.php';
  ?>

  <main>

    <form form action = '../registration/registration.php' method = 'post'>

      <h2>Crea il tuo account</h2>

      <label for = 'firstname'>Nome:</label><br>
      <input type = 'text' id = 'firstname' name = 'firstname' required><br>

      <label for = 'lastname'>Cognome:</label><br>
      <input type = 'text' id = 'lastname' name = 'lastname' required><br>

      <label for = 'email'>Indirizzo email:</label><br>
      <input type = 'email' id = 'email' name = 'email' required><br>
            
      <label for = 'pass'>Password:</label><br>
      <input type = 'password' id = 'pass' name = 'pass' required><br>

      <label for = 'confirm'>Conferma Password:</label><br>
      <input type = 'password' id = 'confirm' name = 'confirm' required><br><br>

      <input type = 'submit' name = 'submit' value = 'Registrati'>

    </form>
  </main>

  <?php 
    require dirname(__FILE__).'/../..//modules/footer.php'; 
  ?>

</body>
</html>