<?php
    require './check_authorization.php';

    if(!isset($_SESSION['authentication'])){
        header('Location: ../index.php');
        exit();
    }
?>