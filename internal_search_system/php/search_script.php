<?php

// Estraggo i parametri di ricerca da $_POST
$searchInput = isset($_POST['searchTextInput']) ? $_POST['searchTextInput'] : "";
$minPrice    = isset($_POST['minPrice']) ? $_POST['minPrice'] : 0;
$maxPrice    = isset($_POST['maxPrice']) ? $_POST['maxPrice'] : 10000;

$query = queryBuilder($searchInput, $minPrice, $maxPrice);

if(!strpos($query, 'name_course')){
  $params      = array($minPrice, $maxPrice);
  $param_types = 'ff';
}
else{
  $params      = array($searchInput, $minPrice, $maxPrice);
  $param_types = 'sff';
}
/* $res stores the result of the query called in database_handler.php */
$res;

require dirname(__FILE__).'/../../configuration/database_handler.php';

echo json_encode($res); // codifico i risultati in JSON e invia al client.

/************************************** METODI ******************************************/
function queryBuilder($searchInput, $minPrice, $maxPrice){

  $whereClause = "";

  if (!empty($searchInput)) {
      $whereClause .= " (name_course LIKE ? OR description_of_course LIKE ?) AND ";
  }

  if (!empty($minPrice) && !empty($maxPrice)) {
      $whereClause .= " (price BETWEEN ? AND ?) ";
  }

  // controlliamo ed eliminamo nel caso ci fossero degli AND non necessari
  $whereClause = rtrim($whereClause, "AND ");

  $query = "SELECT * FROM course";

  // se ci fosse qualche opzione, allora
  if (!empty($whereClause)) {
      $query .= " WHERE " . $whereClause;
  }

  return $query;
}
?>