<?php
require dirname(__FILE__) . '/../../configuration/database_connect.php';

$query = "SELECT * FROM course ORDER BY average_evaluation DESC LIMIT 10;";

try {
    $result = mysqli_query($db_connection, $query);

    if ($result) {
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($data);
    } else {
        echo json_encode(array("error" => "Error executing query: " . mysqli_error($db_connection)));
    }

    mysqli_free_result($result); // Free memory from the result set
} catch (Exception $e) {
    error_log($e->getMessage(), 3, dirname(__FILE__) . '/../../../../errors/errors.log');
    echo json_encode(array("error" => "Database Error"));
}

require dirname(__FILE__) . '/../../configuration/database_disconnect.php';
?>