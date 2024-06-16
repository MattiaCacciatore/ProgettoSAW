<?php
require dirname(__FILE__).'/../configuration/check_session.php';

// Controllo ridondante, già fatto in check_session.php
//if (!$_SESSION['authentication']) {
    //header('../authentication/pages/login.html');
//}

// $user_email = isset($_SESSION['email']) ? $_SESSION['email'] : exit('email non presente nella variabile globale');

// Se viene superata la check_session allora $_SESSION['authentication'] e $_SESSION['email'] esistono e sono inizializzate.
$user_email = $_SESSION['email'];

// Require only those course that user don't evaluate yet.
$query = 'SELECT c.id AS course_id, c.name AS course_name
FROM follow f
INNER JOIN course c ON f.id_course = c.id
LEFT JOIN evaluate e ON f.email_user = e.email_user AND f.id_course = e.id_course
WHERE e.email_user IS NULL
AND f.email_user = ?;';

$type_param = 's';

/*$query = 'SELECT c.id AS course_id, c.name AS course_name
FROM follow f 
INNER JOIN course c ON f.id_course = c.id
WHERE f.email_user = ? AND f.email_user NOT IN (SELECT email_user FROM evaluate WHERE vote IS NOT NULL)';

$type_param = 's';*/

// La connessione viene aperta solo quando serve e può esser chiusa.
require dirname(__FILE__).'/../configuration/database_connect.php';

try {
    
    $stmt = mysqli_prepare($db_connection, $query);

    if($stmt)
    {
        // binding statement
        if (!empty($type_param)) {
            mysqli_stmt_bind_param($stmt, $type_param, $user_email);
        }

        // execute statement
        if (mysqli_stmt_execute($stmt)) {
            $results = mysqli_stmt_get_result($stmt);
            $data    =  mysqli_fetch_all($results, MYSQLI_ASSOC);

            // encoding result as JSON
            echo json_encode($data);
        }else {
            echo json_encode(array("error" => "Error executing statement: " . mysqli_stmt_error($stmt)));
        }


        mysqli_stmt_close($stmt); 
    }else {
        echo json_encode(array("error" => "Error preparing statement: " . mysqli_error($db_connection)));
    }

} catch (Exception $e) {
    error_log($e->getMessage(), 3, dirname(__FILE__) . '/../../../errors/errors.log');
    echo json_encode(array("error" => "Database Error"));
}

require dirname(__FILE__).'/../configuration/database_disconnect.php';

?>