<?php
require dirname(__FILE__).'/../configuration/database_connect.php';
require dirname(__FILE__).'/../configuration/check_session.php';



if (!$_SESSION['authentication']) {
    header('../authentication/pages/login.html');
}

// gathering variables
$user_email = isset($_SESSION['email']) ? $_SESSION['email']: exit('email non presente nella variabile globale');
$id_course  = isset($_POST['id_course']) ? $_POST['id_course']: exit('id_course non presente nella variabile globale');
$vote       = isset($_POST['vote']) ? $_POST['vote']: exit('voto non presente nella variabile globale post');
$feedback   = isset($_POST['feedback']) ? $_POST['feedback']: null;

$feedback   = strcmp($feedback,'') != 0 ? null : $feedback;  // set $feedback as null if is ''


// QUERY BUILDING ========================================================================
$param_type  = '';
$param_array = [];

if ($feedback == null) {
    $query = 'INSERT INTO evaluate (email_user, id_course, vote) VALUES (?, ?, ?) ';
    $param_type='ssi';

    $param_array[] = &$user_email;
    $param_array[] = &$id_course;
    $param_array[] = &$vote;


}else {
    $query = 'INSERT INTO evaluate (email_user, id_course, feedback, vote) VALUES (?, ?, ?, ?) ';
    $param_type = 'sssi';

    $param_array[] = &$user_email;
    $param_array[] = &$id_course;
    $param_array[] = &$feedback;
    $param_array[] = &$vote;

}
// =====================================================================================





try {
    $stmt = mysqli_prepare($db_connection, $query);

    if ($stmt) {
        
        mysqli_stmt_bind_param()
    }
} catch (\Throwable $th) {
    //throw $th;
}




?>