<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Homepage</title>
        <link rel="stylesheet" type="text/css" href="./css/style.css">

    </head>

    <body>
        <header>
            <img class="web_site_logo" src="./img/logo.jpg" alt="logo" width="150" height="150">


            <nav class="navbar">
                
                    <a href="./index.php">Home</a>
                    <a href="./pages/signin.php">Sing-In</a>
                    <a href="./pages/login.php">Login</a>
                    <a href="contact.asp">Contact</a>
                    <a href="about.asp">About</a>
                
            </nav>


        </header>


        <?php if (isset($_SESSION["logout_success"])) {
        
            echo '<p> Logout Success </p>';
            unset($_SESSION["logout_success"]);

        }?>





    </body>
</html>