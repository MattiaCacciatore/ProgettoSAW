<?php
require_once '../../include/config_session.inc.php'; // Start session


// Verifico che la autenticazione sia avvenuta ( vedi file: login_view.inc.php)
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: ../../errors/page_denied.err.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Area</title>
    <link rel="stylesheet" type="text/css" href="./../../css/style.css">
</head>
<body>

    <header>
        <img class="web_site_logo" src="./../../img/logo.jpg" alt="logo" width="150" height="150">

        <h3>Welcome to the Private Area</h3>
        <nav class="navbar">
            <a href="/">Home</a>
            <a href="./../../include/logout.inc.php">Logout</a> <!-- Assuming a logout link is present -->
            <!-- Other navigation links if needed -->
        </nav>
    </header>

<main>
    <!-- Main content of the page -->
    <p>This is a protected area. Only authenticated users can access it.</p>
</main>

</body>
</html>