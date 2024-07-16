<?php
/* ------------------------------------------------------------------------------------------------ */
// EXEC THE QUERY
/* ------------------------------------------------------------------------------------------------ */
    try{
        if(!empty($params) && !empty($param_types)){
            $sql_stmt = mysqli_prepare($db_connection, $query);
            mysqli_stmt_bind_param($sql_stmt, $param_types, ...$params);
            mysqli_stmt_execute($sql_stmt);
            $result = mysqli_stmt_get_result($sql_stmt);
        }
        else{   
            $result = mysqli_query($db_connection, $query);
        }

        if($result !== false)
            $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    catch(mysqli_sql_exception $e){
        $error = sprintf('%s - %s: %s\n', date('Y-m-d H:i:s'), $query, $e->getMessage());
        error_log($error, 3, dirname(__FILE__).'/../../../errors/errors.log');
        $error_occurred = true;
    }
?>