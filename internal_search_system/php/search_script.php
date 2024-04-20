<?php

			require dirname(__FILE__).'/../../configuration/database_handler.php';

// Estraggo i parametri di ricerca da $_POST
$searchInput = isset($_POST['searchTextInput']) ? $_POST['searchTextInput'] : "";
$minPrice = isset($_POST['minPrice']) ? $_POST['minPrice'] : 0;
$maxPrice = isset($_POST['maxPrice']) ? $_POST['maxPrice'] : 10000;




$query = queryBuilder($searchInput, $minPrice, $maxPrice);

try {

  $stmt = $pdo->prepare($query);

  // Assocoa il parametro di ricerca solo se non è vuoto
  if (!empty($searchInput)) {
    $searchWithWildcards = "%$searchInput%";
    $stmt->bindParam(":search", $searchWithWildcards, PDO::PARAM_STR);
  }


  if (!empty($minPrice) && !empty($maxPrice)) {

    $stmt->bindParam(":minPrice", $minPrice, PDO::PARAM_INT);
    $stmt->bindParam(":maxPrice", $maxPrice, PDO::PARAM_INT);
  }



  $stmt->execute();

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Recupero tutte le righe come array associativi

  echo json_encode($results); // codifico i risultati in JSON e invia al client

} catch (PDOException $e) {

  echo json_encode(array("error" => "Database Error: " . $e->getMessage()));
}

/************************************** METODI ******************************************/

function queryBuilder($searchInput, $minPrice, $maxPrice) {

  $whereClause = "";

  if (!empty($searchInput)) {
      $whereClause .= " (name_course LIKE :search OR description_of_course LIKE :search) AND ";
  }

  if (!empty($minPrice) && !empty($maxPrice)) {
      $whereClause .= " (price BETWEEN :minPrice AND :maxPrice) ";
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