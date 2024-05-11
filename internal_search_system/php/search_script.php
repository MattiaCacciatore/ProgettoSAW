<?php

// DATABASE CONNECTION ==================================================
$host = 'localhost';
$dbname = 'S4850100';
$dbusername = 'S4850100';
$dbpassword = 'pHpIs50DeCeNt';

// Error handling variables
$error_occurred = false;
$result = false;
$data = null;

// Connect to the database
try {
  $db_connection = new mysqli($host, $dbusername, $dbpassword, $dbname);
  if ($db_connection->connect_errno != 0) {
    error_log("Failed to connect to database: " . $db_connection->connect_error, 3, dirname(__FILE__) . '/../../../../errors/errors.log');
  }
} catch (Exception $e) {
  error_log($e->getMessage(), 3, dirname(__FILE__) . '/../../../../errors/errors.log');
  mysqli_close($db_connection);
  exit();
}



// PERFORMING WITH SEARCH ====================================================

// Extract search parameters from $_POST
$searchInput = isset($_POST['searchTextInput']) ? trim($_POST['searchTextInput']) : "";
$minPrice = isset($_POST['minPrice']) ? intval($_POST['minPrice']) : 0;
$maxPrice = isset($_POST['maxPrice']) ? intval($_POST['maxPrice']) : 10000;



$query = buildQuery($searchInput, $minPrice, $maxPrice);


try {
    $stmt = mysqli_prepare($db_connection, $query);
    if ($stmt) {

      // Binding statement *********************************
      $param_type = "";
      $param_array = [];
  
      if (!empty($searchInput)) {
        $param_type .= "ss";
        $searchWithWildcards = "%" . $searchInput . "%";
        $param_array[] = &$searchWithWildcards;
        $param_array[] = &$searchWithWildcards;
      }
  
      if (!empty($minPrice) && !empty($maxPrice)) {
        $param_type .= "ii";
        $param_array[] = &$minPrice;
        $param_array[] = &$maxPrice;
      }
  
      if (!empty($param_type)) {
        mysqli_stmt_bind_param($stmt, $param_type, ...$param_array);
      }
  
      // Execute statement **********************************************
      if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
        // Encode results as JSON ***************************************
        echo json_encode($data);
      } else {
        echo json_encode(array("error" => "Error executing statement: " . mysqli_stmt_error($stmt)));
      }
  
      // Close statement ************************************************
      mysqli_stmt_close($stmt);
    } else {
      echo json_encode(array("error" => "Error preparing statement: " . mysqli_error($db_connection)));
    }
  } catch (Exception $e) {
    error_log($e->getMessage(), 3, dirname(__FILE__) . '/../../../../errors/errors.log');
    echo json_encode(array("error" => "Database Error"));
  }

require dirname(__FILE__).'/../../configuration/database_disconnect.php';

/***************************************************************************************************** */

// Method to build the complete query string
function buildQuery($searchInput, $minPrice, $maxPrice) {
    $whereClause = "";
    if (!empty($searchInput)) {
      $whereClause .= " (name LIKE ? OR description LIKE ?) AND";
    }
  
    if (!empty($minPrice) && !empty($maxPrice)) {
      $whereClause .= " (price BETWEEN ? AND ?) ";
    }
  
    // Remove unnecessary trailing AND
    $whereClause = rtrim($whereClause, " AND ");
  
    // Construct the query
    $query = "SELECT * FROM course";
    if (!empty($whereClause)) {
      $query .= " WHERE " . $whereClause;
    }
  
    return $query;
  }

?>