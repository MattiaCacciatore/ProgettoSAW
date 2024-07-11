<?php
/* ------------------------------------------------------------------------------------------------ */
// CLOSE THE CONNECTION TO DATABASE
/* --------------------------------------------------------------------------------------------------- */
    
    if($result !== true && $result !== false)
        mysqli_free_result($result);

    mysqli_close($db_connection);

    if($error_occurred)
        die('HTTP 500 Internal Server Error');
?>