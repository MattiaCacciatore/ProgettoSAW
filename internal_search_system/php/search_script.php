<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$db_connection;
$host          = 'localhost';
$dbname        = 'S4850100';
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
        error_log($error, 3, dirname(__FILE__).'/../../../errors/errors.log');
    }
    die('ERROR: Couldn\'t connect to the database or set the encoding.');
}



// Extract search parameters from $_POST
$searchInput = isset($_POST['searchTextInput']) ? $_POST['searchTextInput'] : "";
$minPrice = isset($_POST['minPrice']) ? $_POST['minPrice'] : 0;
$maxPrice = isset($_POST['maxPrice']) ? $_POST['maxPrice'] : 10000;

$query = queryBuilder($searchInput, $minPrice, $maxPrice);

try {

    $stmt = mysqli_prepare($db_connection, $query);

    // Bind the search parameter only if it's not empty
    if (!empty($searchInput) && (empty($minPrice) || empty($maxPrice))) {
        $searchWithWildcards = "%$searchInput%";
        mysqli_stmt_bind_param($stmt, "ss", $searchWithWildcards, $searchWithWildcards);
    } elseif (!empty($searchInput) && !empty($minPrice) && !empty($maxPrice)) {
        $searchWithWildcards = "%$searchInput%";
        mysqli_stmt_bind_param($stmt, "sdd", $searchWithWildcards, $minPrice, $maxPrice);
    } elseif (empty($searchInput) && !empty($minPrice) && !empty($maxPrice)) {
        mysqli_stmt_bind_param($stmt, "dd", $minPrice, $maxPrice);
    }

    $error = sprintf('%s - %s: %s\n', date('Y-m-d H:i:s'), $query, var_export($stmt, true)); // Changed $stmt to $query
    error_log($error, 3, dirname(__FILE__).'/../../../../errors/errors.log');

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $results = mysqli_fetch_all($result, MYSQLI_ASSOC); // Fetch all rows as associative array
        echo json_encode($results); // Encode results in JSON and send to the client
    } else {
        echo json_encode(array("error" => "Database Error: " . mysqli_error($db_connection)));
    }

} catch (mysqli_sql_exception $e) {

    $error = sprintf('%s - Query: %s, Error: %s\n', date('Y-m-d H:i:s'), $query, $e->getMessage()); // Changed $stmt to $query
    error_log($error, 3, dirname(__FILE__).'/../../../../errors/errors.log');
    $error_occurred = true;
}

/************************************** METHODS ******************************************/

function queryBuilder($searchInput, $minPrice, $maxPrice) {

    $whereClause = "";

    if (!empty($searchInput)) {
        $whereClause .= " (name LIKE ? OR description LIKE ?) AND ";
    }

    if (!empty($minPrice) && !empty($maxPrice)) {
        $whereClause .= " (price BETWEEN ? AND ?) ";
    }

    // Remove unnecessary AND if exists
    $whereClause = rtrim($whereClause, "AND ");

    $query = "SELECT * FROM course";

    // Append the where clause if there are any options
    if (!empty($whereClause)) {
        $query .= " WHERE " . $whereClause;
    }

    return $query;
}
?>
