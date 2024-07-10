<?php
    require dirname(__FILE__) . '/../../configuration/database_connect.php';

    $query = 'SELECT * 
            FROM course JOIN teach ON id = id_course JOIN user ON email_user = email 
            ORDER BY average_evaluation DESC LIMIT 10;';

    try{

        $stmt = mysqli_prepare($db_connection, $query);

        if($stmt){
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                print(json_encode($data));
            } 
            else{
                print(json_encode(array("error" => "Error executing statement: " . mysqli_stmt_error($stmt))));
            }

            mysqli_stmt_close($stmt);
        } else {
            print(json_encode(array("error" => "Error preparing statement: " . mysqli_error($db_connection))));
        }
    } 
    catch(Exception $e){
        error_log($e->getMessage(), 3, dirname(__FILE__) . '/../../../../errors/errors.log');
        print(json_encode(array("error" => "Database Error")));
    }

    require dirname(__FILE__) . '/../../configuration/database_disconnect.php';
?>