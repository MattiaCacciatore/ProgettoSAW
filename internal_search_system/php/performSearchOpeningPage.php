<?php
require dirname(__FILE__) . '/../../configuration/database_connect.php';

$query = "SELECT * FROM course ORDER BY average_evaluation DESC LIMIT 10;";

try {
    // Prepara la query
    $stmt = mysqli_prepare($db_connection, $query);

    if ($stmt) {
        // Esegui la query
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($data);
        } else {
            echo json_encode(array("error" => "Error executing statement: " . mysqli_stmt_error($stmt)));
        }
        // Chiudi lo statement
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(array("error" => "Error preparing statement: " . mysqli_error($db_connection)));
    }
} catch (Exception $e) {
    error_log($e->getMessage(), 3, dirname(__FILE__) . '/../../../../errors/errors.log');
    echo json_encode(array("error" => "Database Error"));
}

require dirname(__FILE__) . '/../../configuration/database_disconnect.php';
?>