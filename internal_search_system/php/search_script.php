<?php

include_once '../../configuration/databaseHandler.php';

// Extract search parameters from $_POST
$query = isset($_POST['searchTextInput']) && $_POST['searchTextInput'] != null ? queryBuilder() : 'SELECT * FROM course WHERE :search';
$searchInput = isset($_POST['searchTextInput']) && $_POST['searchTextInput'] !="" ? $_POST['searchTextInput'] : 1;

// Remove commented-out line (security risk)
// printf($query);

try {

    $stmt = $pdo->prepare($query);

    $searchWithWildcards = "%$searchInput%";
    $stmt->bindParam(":search", $searchWithWildcards);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Fetch all rows as associative arrays

    echo json_encode($results);                 // Encode the results as JSON and send to client

} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();
}

/************************************** METHODS ******************************************/

function queryBuilder()
{
    $whereClause = "WHERE ((name_course LIKE :search) OR (description_of_course LIKE :search))";

    // Construct the final query
    $query = "SELECT * FROM course $whereClause";

    return $query;
}

?>