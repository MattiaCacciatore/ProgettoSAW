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
$releaseDateFilter = takeInputIfExsist('releaseDateFilter', '');
$priceFilter = takeInputIfExsist('priceFilter', '');
$courseAvarageValutationFilter = takeInputIfExsist('courseAvarageValutationFilter', '');


$query = queryBuilder($searchInput, $categoryFilter, $releaseDateFilter, $priceFilter, $courseAvarageValutationFilter);



























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
    // sbura
};

?>
