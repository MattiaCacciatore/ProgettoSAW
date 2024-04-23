<?php
    require dirname(__FILE__).'/check_authorization.php';

    if(!isset($_SESSION['authentication'])){
        header('Location: ../index.php');
        exit();
    }
?>