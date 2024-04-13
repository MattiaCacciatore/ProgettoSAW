<?php


include_once '../../configuration/databaseHandler.php';


/* non definisco un metodo, perhce' questo file racchiude lo script che utilizza
ajax per effettuare la richiesta al server, e nient'altro */


// verofichiamo se e' stato mandato qualcosa

if (!isset($_POST['dataToSend'])) {
    // retriveAllBestCourses();

    echo "non e' stato cercato nulla \n";
    exit();
}


$searchInput = takeInputIfExsist('searchInput', '');
$categoryFilter = takeInputIfExsist('categoryFilter', []);
$releaseDateFilter = takeInputIfExsist('releaseDateFilter',[]);
$priceFilter = takeInputIfExsist('priceFilter', '');
$courseAvarageValutationFilter = takeInputIfExsist('courseAvarageValutationFilter', '');


$query = queryBuilder($searchInput, $categoryFilter, $releaseDateFilter, $priceFilter, $courseAvarageValutationFilter);

try {
    // prepariamo la query
    $stmt = $pdo->prepare($query);

    // esecuzione della query
    $stmt->execute();

    // Fetch di tutte le colonne; ottenendo un'array associativo
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


        
    // Encodei risultati in in Json
    $response = json_encode($results);

    // a questo punto inviamo i risultati al client (ovvero: ) success:  function(response) 
    echo $response;





} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}





















?>






<?php 


/************************************** METODI ****************************************** */

function takeInputIfExsist(string $post_input, $default = NULL) {
    if (!isset($_POST[$post_input])) {
        return $default;
    }
    return $_POST[$post_input];
};



function queryBuilder($searchInput, $categoryFilter, $releaseDateFilter, $priceFilter, $courseAvarageValutationFilter){

    $whereClause = "WHERE 1"; // inizializzaimo a true per semplicita'

    /*  search input dalla barra di ricerca, verifichiamo se puc'corrispondere all'id del corso oppure al nome */
    if (!empty($searchInput)) {
        $whereClause .= " AND (id LIKE '%$searchInput%' OR 
                                name_course LIKE '%$searchInput%' OR 
                                description_of_course LIKE '%$searchInput%')";
    }


    //  per ogni catergoria selezionata
    if(!empty($categoryFilter)) {
       
        $whereClause .= "AND (";
        foreach ($categoryFilter as $category) {
            $whereClause .= " OR category LIKE '%$category%'";
         }

         $whereClause .= ")";

    }


    
    // 
    if (!empty($releaseDateFilter)) {
        $whereClause .= "AND (";
        foreach ($releaseDateFilter as $date) {
            $whereClause .= " OR release_date LIKE '%$date%'";
        }
        $whereClause .= ")";
    }


    
    if (!empty($priceFilter)) {
        $whereClause .= " AND (price >= '$priceFilter')";

    }


    $courseAvarageValutationFilter = takeInputIfExsist('courseAvarageValutationFilter');
    if (!empty($courseAvarageValutationFilter)) {
        $whereClause .= " AND average_valuation >= '$courseAvarageValutationFilter'";
    }



    $query = "SELECT * FROM course $whereClause";

    return $query;


};

?>
