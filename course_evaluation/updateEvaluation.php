<?php
require dirname(__FILE__).'/../configuration/database_connect.php';
require dirname(__FILE__).'/../configuration/check_session.php';




// gathering variables
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email']: exit('email non presente nella variabile globale');
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

        // binding statement ************************************************
        if (!empty($param_type)) {
            mysqli_stmt_bind_param($stmt, $param_type, ...$param_array);
          }

          // Execute statement **********************************************
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
            // Encode results as JSON ***************************************
            echo json_encode($data);
        } else {
            echo json_encode(array("error" => "Error executing statement: " . mysqli_stmt_error($stmt)));
        }


        // Close statement **************************************************
        mysqli_stmt_close($stmt);
        
    } else {
    echo json_encode(array("error" => "Error preparing statement: " . mysqli_error($db_connection)));
    }
        
    
} catch (Exception $e) {
    error_log($e->getMessage(), 3, dirname(__FILE__) . '/../../../../errors/errors.log');
    echo json_encode(array("error" => "Database Error"));
}


require dirname(__FILE__).'../configuration/database_disconnect.php';





?>