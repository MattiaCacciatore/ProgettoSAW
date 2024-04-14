<?php

include_once '../../configuration/databaseHandler.php';



// Extract search parameters from $_POST
$searchInput = isset($_POST['searchInput']) ? $_POST['searchInput'] : '';
$categoryFilter = isset($_POST['categoryFilter']) ? $_POST['categoryFilter'] : [];
$releaseDateFilter = isset($_POST['releaseDateFilter']) ? $_POST['releaseDateFilter'] : [];
$priceFilter = isset($_POST['priceFilter']) ? $_POST['priceFilter'] : '';
$courseAvarageValutationFilter = isset($_POST['courseAvarageValutationFilter']) ? $_POST['courseAvarageValutationFilter'] : '';



// $query = queryBuilder($searchInput, $categoryFilter, $releaseDateFilter, $priceFilter, $courseAvarageValutationFilter);

// printf($query);

try {
   
    $textInput = addslashes($searchInput);
    $query = "SELECT * FROM course WHERE id LIKE '$textInput%' ";
    $stmt = $pdo->prepare($query);
    // $stmt->bindParam(':searchInput', $searchInput);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Fetch all rows as associative arrays


    echo json_encode($results);                    // Encode the results as JSON and send to client



} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();
}










/************************************** METHODS ******************************************/


function queryBuilder(string $searchInput, array $categoryFilter, array $releaseDateFilter, string $priceFilter, string $courseAvarageValutationFilter)
{
    $whereClause = "WHERE"; // Start with a true condition

    // Input from the search bar ---------------------------------------------------------------
    if (!empty($searchInput)) {
        $whereClause .= " (course.id LIKE '%$searchInput%' OR 
        course.name_course LIKE '%$searchInput%' OR 
        course.description_of_course LIKE '%$searchInput%')";
    }


    // input from filter of categories'courses --------------------------------------------------
    if (!empty($categoryFilter)) {
        $whereClause .= " AND (";
        foreach ($categoryFilter as $category) {
            $whereClause .= " OR course.category LIKE '%$category%'";
        }
        $whereClause .= ")";
    }

    //  release date filter --------------------------------------------------------------------
    if (!empty($releaseDateFilter)) {
        $whereClause .= " AND (";
        foreach ($releaseDateFilter as $date) {
            $whereClause .= " OR course.release_date LIKE '%$date%'";
        }
        $whereClause .= ")";
    }

    // Add price filter condition ------------------------------------------------------------
    if (!empty($priceFilter)) {
        $whereClause .= " AND (course.price >= '$priceFilter')";
    }

    // Add course average valuation filter condition ----------------------------------------
    if (!empty($courseAvarageValutationFilter)) {
        $whereClause .= " AND course.average_valuation >= '$courseAvarageValutationFilter'";
    }


    // Construct the final query
    $query = "SELECT * FROM course $whereClause";

    return $query;
}

?>
