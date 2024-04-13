<?php

include_once '../../configuration/databaseHandler.php';



// Extract search parameters from $_POST
$searchInput = isset($_POST['searchInput']) ? $_POST['searchInput'] : '';
$categoryFilter = isset($_POST['categoryFilter']) ? $_POST['categoryFilter'] : [];
$releaseDateFilter = isset($_POST['releaseDateFilter']) ? $_POST['releaseDateFilter'] : [];
$priceFilter = isset($_POST['priceFilter']) ? $_POST['priceFilter'] : '';
$courseAvarageValutationFilter = isset($_POST['courseAvarageValutationFilter']) ? $_POST['courseAvarageValutationFilter'] : '';

// Build the query
$query = queryBuilder($searchInput, $categoryFilter, $releaseDateFilter, $priceFilter, $courseAvarageValutationFilter);

try {
    // Prepare and execute the query
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    // Fetch all rows as associative arrays
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Encode the results as JSON and send to client
    echo json_encode($results);



} catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
}


/************************************** METHODS ******************************************/

function queryBuilder($searchInput, $categoryFilter, $releaseDateFilter, $priceFilter, $courseAvarageValutationFilter)
{
    $whereClause = "WHERE 1"; // Start with a true condition

    // Add search input conditions
    if (!empty($searchInput)) {
        $whereClause .= " AND (id LIKE '%$searchInput%' OR 
                                name_course LIKE '%$searchInput%' OR 
                                description_of_course LIKE '%$searchInput%')";
    }

    // Add category filter conditions
    if (!empty($categoryFilter)) {
        $whereClause .= " AND (";
        foreach ($categoryFilter as $category) {
            $whereClause .= " OR category LIKE '%$category%'";
        }
        $whereClause .= ")";
    }

    // Add release date filter conditions
    if (!empty($releaseDateFilter)) {
        $whereClause .= " AND (";
        foreach ($releaseDateFilter as $date) {
            $whereClause .= " OR release_date LIKE '%$date%'";
        }
        $whereClause .= ")";
    }

    // Add price filter condition
    if (!empty($priceFilter)) {
        $whereClause .= " AND (price >= '$priceFilter')";
    }

    // Add course average valuation filter condition
    if (!empty($courseAvarageValutationFilter)) {
        $whereClause .= " AND average_valuation >= '$courseAvarageValutationFilter'";
    }

    // Construct the final query
    $query = "SELECT * FROM course $whereClause";

    return $query;
}

?>
