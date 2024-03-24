<?php
    require_once '../include/config_session.inc.php'; // iniziamo la sessione
    require_once '../include/login_view.inc.php' // verifichiamo che non ci sino stati errori
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

    <header>
        <img class="web_site_logo" src="../img/logo.jpg" alt="logo" width="150" height="150">

        <h3>LogIn</h3>
        <nav class="navbar">
            
                <a href="../index.php">Home</a>
                <a href="./signin.php">Sing-In</a>
                <a href="contact.asp">Contact</a>
                <a href="about.asp">About</a>
            
        </nav>
        


    </header>

<main>
    <!-- Contenuto principale della pagina -->
    <form method="post" action="../include/login.inc.php">
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email"><br>

        <label for="password">Password</label><br>
        <input type="password" id="password" name="password"><br>


        <input type="submit" name="Sign In">

        <?php check_login_errors(); ?>
    </form>
</main>

</body>
</html>