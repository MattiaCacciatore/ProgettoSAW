<?php
    if(!(isset($_SESSION['authentication']))){
        header('Location: http://localhost/SAW/php/login.php');
        exit();
    }
?>