<?php
require dirname(__FILE__).'/../configuration/database_connect.php';
require dirname(__FILE__).'/../configuration/check_session.php';



if (!$_SESSION['authentication']) {
    header('../authentication/pages/login.html');
}

// gathering variables
$user_email = isset($_SESSION['email']) ? $_SESSION['email']: exit('email non presente nella variabile globale');
$vote       = isset($_POST['vote']) ? $_POST['vote']: exit('voto non presente nella variabile globale post');
$feedback   = isset($_POST['vote']) ? $_POST['vote']: '';


$query = 'SELECT '





?>