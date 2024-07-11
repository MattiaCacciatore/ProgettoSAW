<?php
    require dirname(__FILE__).'/../../configuration/check_session.php';

    $user_email = $_SESSION['email'];

    /* Si richiedono solo i corsi seguiti dall'utente non ancora valutati. */
    $query = 'SELECT c.id AS course_id, c.name AS course_name
              FROM follow f
              INNER JOIN course c ON f.id_course = c.id
              LEFT JOIN evaluate e ON f.email_user = e.email_user AND f.id_course = e.id_course
              WHERE e.email_user IS NULL
              AND f.email_user = ?;';

    $type_param = 's';

    require dirname(__FILE__).'/../../configuration/database_connect.php';

    try{
        
        $stmt = mysqli_prepare($db_connection, $query);

        if($stmt){
            // Preparazione statement ********************************************
            if(!empty($type_param)){
                mysqli_stmt_bind_param($stmt, $type_param, $user_email);
            }

            // Esecuzione statement **********************************************
            if (mysqli_stmt_execute($stmt)){
                $results = mysqli_stmt_get_result($stmt);
                $data    =  mysqli_fetch_all($results, MYSQLI_ASSOC);

                /* Codifica il risultato in formato JSON. */
                print(json_encode($data));
            }
            else{
                print(json_encode(array("error" => "Error executing statement: " . mysqli_stmt_error($stmt))));
            }
            // Chiusura statement ************************************************
            mysqli_stmt_close($stmt); 
        }
        else{
            print(json_encode(array("error" => "Error preparing statement: " . mysqli_error($db_connection))));
        }

    } 
    catch(Exception $e){
        error_log($e->getMessage(), 3, dirname(__FILE__) . '/../../../../errors/errors.log');
        print(json_encode(array("error" => "Database Error")));
    }

    require dirname(__FILE__).'/../../configuration/database_disconnect.php';
?>