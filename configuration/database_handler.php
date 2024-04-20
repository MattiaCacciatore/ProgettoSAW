<?php
    /* ---------------------------------------------------------------------------------------------------
        OPEN THE CONNECTION TO THE DATABASE.
       --------------------------------------------------------------------------------------------------- */
    /* Enable error reporting and set the desired charset after establishing 
	a connection for the encoding. Mandatory for the try-catch statement. */
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $db_connection;
    $host          = 'localhost'; 
    $dbname        ='S4850100'; 
    $dbusername    = 'S4850100'; 
    $dbpassword    = 'pHpIs50DeCeNt'; 
    $error_occured = false;
    $result        = false;
    $res           = null;
    
    if(!($db_connection = mysqli_connect($host, $dbusername, $dbpassword, $dbname))
        || !mysqli_set_charset($db_connection, 'utf8mb4')){
        mysqli_close($db_connection);
        if(mysqli_connect_errno()){
            $error = sprintf('%s - Connect failed: %s\n', date('Y-m-d H:i:s'), mysqli_connect_error());
            error_log($error, 3, '../../../errors/errors.log');
        }
        die('ERROR: Couldn\'t connect to the database or set the encoding.');
    }
    /* ---------------------------------------------------------------------------------------------------
        EXECUTE THE QUERY.
       --------------------------------------------------------------------------------------------------- */
    try{
        if(!empty($params) && !empty($param_types)){
            $sql_stmt = mysqli_prepare($db_connection, $query);
            mysqli_stmt_bind_param($sql_stmt, $param_types, ...$params);
            mysqli_stmt_execute($sql_stmt);
            if(($result = mysqli_stmt_get_result($sql_stmt)) !== false)
                $res = mysqli_fetch_array($result, MYSQLI_NUM);
        }
        else{ /* I HATE PHP FOR THIS. Fatto a causa del fatto che la bind_param esige almeno un parametro, altrimenti genera warning. */
            $result = mysqli_query($db_connection, $query);
            $res = mysqli_fetch_all($result, MYSQLI_NUM);
        }
    }
    catch(mysqli_sql_exception $e){
        $error = sprintf('%s - %s: %s\n', date('Y-m-d H:i:s'), $query, $e->getMessage());
        error_log($error, 3, '../../../errors/errors.log');
        $error_occured = true;
        goto close_connection;
    }
    /* ---------------------------------------------------------------------------------------------------
        CLOSE THE CONNECTION TO THE DATABASE.
       --------------------------------------------------------------------------------------------------- */
close_connection:
    /* They always return true or void. */
    if($result !== true && $result !== false)
	    mysqli_free_result($result);

	mysqli_close($db_connection);
    
    if($error_occured)
        die('ERROR: Couldn\'t recover the user from the database.');
?>