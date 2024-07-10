<?php
/* ------------------------------------------------------------------------------------------------ */
// CHIUDE LA CONNESSIONE CON IL DATABASE.
/* --------------------------------------------------------------------------------------------------- */
    /* Ritorna sempre vero o nulla. */
    if($result !== true && $result !== false)
        mysqli_free_result($result);

    mysqli_close($db_connection);

    if($error_occurred)
        die('HTTP 500 Internal Server Error');
?>