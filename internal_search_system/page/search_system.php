<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="../css/search-page.css">
  <link rel="stylesheet" href="../css/courses-cards.css">
  <link rel="stylesheet" href="../../modules/css/header.css">
  <link rel="stylesheet" href="../../modules/css/footer.css">



  <!-- link per le icone: google matireal -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


   <!-- Include jQuery -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="../js/search_system.js" defer></script>
    
   <title>Cerca il tuo prossimo corso</title>
</head>



<body>

<?php
  require dirname(__FILE__).'/../../modules/cookies_banner.php';
  require dirname(__FILE__).'/../../modules/header.php';
?>


      <h1>Cerca il tuo prossimo corso</h1>
 

    <!-- ******************************************************************************************************** -->
    <!-- search menu -->


    <div class="search-system">

        <div class="search-wrapper">
          <span class="material-symbols-outlined">search </span>
          <input type="search" id="searchInput" placeholder="Search by id , name , or the conntent of the course">
        </div>


      




      <!-- ******************************************************************************************************** -->
      <!-- price filter -->
      <div class="price-filter">
          <div class="field">
            <span>Eur</span>
            <input type="number" id="input-min" placeholder="Min">


          </div>

          <div class="field">
            <span>Eur</span>
            <input type="number" id="input-max" placeholder="Max">
            
          </div>


          <button class="button" id="searchButton">vai</button>

          <div class="price-filter-error"></div>

      </div>
    </div>


 
      
<div class="wildCards"></div>


  <!-- ******************************************************************************************************** -->
  <!-- wild cards dei corsi 
  

    vengono stampate dallo script search_system.js che:
      - prende in input i dati della barra di ricerca e dei filtri
      - effettua una ricerca con ajax: metodo performingSeacrh

      - i risultati vengono scritti all-interno di template ben definiti (courseCardTemplate.html)
       con l-utilizzo della libreria moustache.js

       nel metodo: displayResults
  -->   





  

</body>
<?php
  require dirname(__FILE__).'/../../modules/footer.php';
?>


</html>