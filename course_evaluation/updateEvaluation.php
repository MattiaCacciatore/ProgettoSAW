<?php
    require dirname(__FILE__).'/../configuration/check_session.php';

    // Gathering variables.
    // Anche qui come in performSearchFollowedCourses, l'email c'è ed è già inizializzata se
    // viene passato il controllo della check_session.
    $user_email = $_SESSION['email'];
    $id_course  = isset($_POST['id_course']) ? intval($_POST['id_course']) : exit('id_course non presente nella variabile globale');
    $vote       = isset($_POST['vote']) ? floatval($_POST['vote']) : exit('voto non presente nella variabile globale post');
    $feedback   = isset($_POST['feedback']) ? $_POST['feedback'] : null;
    // Set $feedback as null if is ''.
    $feedback   = strcmp($feedback,'') != 0 ? $feedback : null; 

    // QUERY BUILDING ========================================================================
    $param_type  = '';
    $param_array = [];

    if ($feedback == null){
        $query = 'INSERT INTO evaluate (email_user, id_course, vote) VALUES (?, ?, ?) ';
        $param_type='sid';

        $param_array[] = &$user_email;
        $param_array[] = &$id_course;
        $param_array[] = &$vote;

    }
    else{
        $query = 'INSERT INTO evaluate (email_user, id_course,vote, feedback) VALUES (?, ?, ?, ?) ';
        $param_type = 'sids';

        $param_array[] = &$user_email;
        $param_array[] = &$id_course;
        $param_array[] = &$vote;
        $param_array[] = &$feedback;

    }
    // =====================================================================================
    // La connessione viene aperta solo quando serve e può esser chiusa.
    require dirname(__FILE__).'/../configuration/database_connect.php';

    try{
        $stmt = mysqli_prepare($db_connection, $query);

        if($stmt){

            // binding statement ************************************************
            if(!empty($param_type)){
                mysqli_stmt_bind_param($stmt, $param_type, ...$param_array);
            }

            // Execute statement **********************************************
            if(!mysqli_stmt_execute($stmt)){
                echo json_encode(array("error" => "Error executing statement: " . mysqli_stmt_error($stmt)));
            } 

            // Close statement **************************************************
            // encoding result as JSON
            echo json_encode($param_array);
            mysqli_stmt_close($stmt);
            
        } else {
        echo json_encode(array("error" => "Error preparing statement: " . mysqli_error($db_connection)));
        }
            
    } catch (Exception $e) {
        error_log($e->getMessage(), 3, dirname(__FILE__) . '/../../../../errors/errors.log');
        echo json_encode(array("error" => "Database Error"));
    }

    require dirname(__FILE__).'/../configuration/database_disconnect.php';

?>