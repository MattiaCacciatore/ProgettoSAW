<?php
/* ------------------------------------------------------------------------------------------------
CLOSE THE CONNECTION TO THE DATABASE.
--------------------------------------------------------------------------------------------------- */
    /* They always return true or void. */
    if($result !== true && $result !== false)
        mysqli_free_result($result);

    mysqli_close($db_connection);

    if($error_occured)
        die('HTTP 500 Internal Server Error');
?>