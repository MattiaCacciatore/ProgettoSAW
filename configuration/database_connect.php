<?php
/* ------------------------------------------------------------------------------------------------
    OPEN THE CONNECTION TO THE DATABASE.
--------------------------------------------------------------------------------------------------- */
    /* Enable error reporting and set the desired charset after establishing
	a connection for the encoding. Mandatory for the try-catch statement. */
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $db_connection;
    $host           = 'localhost';
    $dbname         = 'S4850100';
    $dbusername     = 'S4850100';
    $dbpassword     = 'pHpIs50DeCeNt';
    $error_occurred = false;
    $result         = false;
    $res            = null;
    
    if(!($db_connection = mysqli_connect($host, $dbusername, $dbpassword, $dbname))
        || !mysqli_set_charset($db_connection, 'utf8mb4')){
        mysqli_close($db_connection);
        if(mysqli_connect_errno()){
            $error = sprintf('%s - Connect failed: %s\n', date('Y-m-d H:i:s'), mysqli_connect_error());
            error_log($error, 3, dirname(__FILE__).'/../../../errors/errors.log');
        }
        die('HTTP 500 Internal Server Error');
    }
?>