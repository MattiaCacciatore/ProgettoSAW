<!DOCTYPE html>
<html lang = 'it'>

<head>
  <!-- Same style for all pages. -->
  <?php 
		include dirname(__FILE__).'/../../modules/head_style.php'; 
	?>
  
  <link rel = 'stylesheet' href = '../css/search-page.css'>
  <link rel = 'stylesheet' href = '../css/courses-cards.css'>

  <!-- Icon links: google matireal. -->
  <link rel = 'stylesheet' href = 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200' />
  <link rel = 'stylesheet' href = 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200' />

   <!-- Include jQuery. -->
   <script src = 'https://code.jquery.com/jquery-3.6.0.min.js'></script>
   <script src = '../js/search_system.js' defer></script>
    
   <title>
      Cerca i corsi
    </title>

</head>

<body>

  <?php
    require dirname(__FILE__).'/../../modules/header.php';
  ?>

  <h1 class="page-title">
    Cerca il tuo prossimo corso
  </h1>
 
  <!-- ******************************************************************************************************** -->
  <!-- Search menu. -->
  <div class = 'search-system'>

    <div class = 'search-wrapper'>
      <span class = 'material-symbols-outlined'>search </span>
      <input type = 'search' id = 'searchInput' placeholder = 'Cerca per parola chiave nei titoli o contenuti.'>
    </div>

  <!-- ******************************************************************************************************** -->
  <!-- Price filter. -->
    <div class = 'price-filter'>
      <div class = 'field'>
        <span>Euro</span>
        <input type = 'number' id = 'input-min' placeholder = 'Min'>
      </div>

      <div class = 'field'>
        <span>Euro</span>
        <input type = 'number' id = 'input-max' placeholder = 'Max'>
      </div>

      <button class = 'button' id = 'searchButton'>Vai</button>

      <div class = 'price-filter-error'></div>

    </div>
  </div>

  <!-- ******************************************************************************************************** -->
  <!-- wild cards dei corsi 
  

    vengono stampate dallo script search_system.js che:
      - prende in input i dati della barra di ricerca e dei filtri
      - effettua una ricerca con ajax: metodo performingSeacrh

      - i risultati vengono scritti all-interno di template ben definiti (courseCardTemplate.html)
       con l-utilizzo della libreria moustache.js

       nel metodo: displayResults
  -->   
  <div class = 'wildCards'></div>


  <?php
    require dirname(__FILE__).'/../../modules/footer.php';
  ?>

</body>
</html>