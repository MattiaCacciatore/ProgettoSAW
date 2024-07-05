<?php
  require dirname(__FILE__).'/../../configuration/database_connect.php';
// PERFORMING WITH SEARCH ====================================================

  // Extract search parameters from $_POST
  $searchInput = isset($_POST['searchTextInput']) ? trim($_POST['searchTextInput']) : "";
  $minPrice    = isset($_POST['minPrice'])        ? floatval($_POST['minPrice'])      : 1.0;
  $maxPrice    = isset($_POST['maxPrice'])        ? floatval($_POST['maxPrice'])      : 10000.0;

  $query = buildQuery($searchInput, $minPrice, $maxPrice);

  try{
    $stmt = mysqli_prepare($db_connection, $query);
    if($stmt){
      // Binding statement *********************************
      $param_type  = "";
      $param_array = [];
  
      if(!empty($searchInput)){
        $param_type         .= "ssss";
        $searchWithWildcards = "%" . $searchInput . "%";
        $param_array[]       = &$searchWithWildcards;
        $param_array[]       = &$searchWithWildcards;
        $param_array[]       = &$searchWithWildcards;
        $param_array[]       = &$searchWithWildcards;
      }
  
      if(!empty($minPrice) && !empty($maxPrice)){
        $param_type   .= "ii";
        $param_array[] = &$minPrice;
        $param_array[] = &$maxPrice;
      }
  
      if(!empty($param_type)){
        mysqli_stmt_bind_param($stmt, $param_type, ...$param_array);
      }
      // Execute statement **********************************************
      if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);
        $data   = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // Encode results as JSON ***************************************
        echo json_encode($data);
      }
      else{
        echo json_encode(array("error" => "Error executing statement: " . mysqli_stmt_error($stmt)));
      }
      // Close statement ************************************************
      mysqli_stmt_close($stmt);
    } 
    else{
      echo json_encode(array("error" => "Error preparing statement: " . mysqli_error($db_connection)));
    }
  } 
  catch(Exception $e){
    error_log($e->getMessage(), 3, dirname(__FILE__) . '/../../../../errors/errors.log');
    echo json_encode(array("error" => "Database Error"));
  }

  require dirname(__FILE__).'/../../configuration/database_disconnect.php';

  
/***************************************************************************************************** */
// Method to build the complete query string
function buildQuery($searchInput, $minPrice, $maxPrice) {
  $whereClause = [];
  if ($searchInput !== "") {
      $whereClause[] = " (name LIKE ? OR description LIKE ? OR firstname LIKE ? OR lastname LIKE ?)";
  }

  if ($minPrice !== null && $maxPrice !== null) {
      $whereClause[] = " (price BETWEEN ? AND ?)";
  } elseif ($minPrice !== null) {
      $whereClause[] = " (price >= ?)";
  } elseif ($maxPrice !== null) {
      $whereClause[] = " (price <= ?)";
  }

  $query = "SELECT * FROM course JOIN teach ON id = id_course JOIN user ON email_user = email";
  if (!empty($whereClause)) {
      $query .= " WHERE " . implode(" AND ", $whereClause);
  }

  $query .= " ORDER BY average_evaluation DESC LIMIT 30";

  return $query;
}
?>