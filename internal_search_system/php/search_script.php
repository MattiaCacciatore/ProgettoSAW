<?php

include_once '../../configuration/databaseHandler.php';

// Estraggo i parametri di ricerca da $_POST
$searchInput = isset($_POST['searchTextInput']) ? $_POST['searchTextInput'] : "";

$query = "SELECT * FROM course";

// Se l'input di ricerca non è vuoto, aggiungo la clausola WHERE per filtrare i risultati
// TODO: da modificare quando aggiorniamo ol db
if (!empty($searchInput)) {
  $query .= " WHERE (name_course LIKE :search OR description_of_course LIKE :search)";
}

try {

  $stmt = $pdo->prepare($query);

  // Assocoa il parametro di ricerca solo se non è vuoto
  if (!empty($searchInput)) {
    $searchWithWildcards = "%$searchInput%";
    $stmt->bindParam(":search", $searchWithWildcards);
  }

  $stmt->execute();

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Recupero tutte le righe come array associativi

  echo json_encode($results); // codifico i risultati in JSON e invia al client

} catch (PDOException $e) {

  echo "Errore: " . $e->getMessage();
}

/************************************** METODI ******************************************/

function queryBuilder() {
  $whereClause = "WHERE ((name_course LIKE :search) OR (description_of_course LIKE :search))";

  // Costruisci la query finale
  $query = "SELECT * FROM course $whereClause";

  return $query;
}

?>