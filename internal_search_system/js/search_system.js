

// mustache js e' una libreria che ci facilita la vita 
// per la realizzazione delle  carte dei corsi, inoltre,  rende il codice piu' legginile

// https://github.com/janl/mustache.js/

const Mustache = require('mustache');  





//----------------------------------------------------------------------------------------------------
// perform search


    function performSearch(params) {

        var searchTextInput = $('#searchInput').val();
        var categoryFilter  = [];
        var releaseDateFilter = [];
        var priceFilter = [];
        var courseAvarageValutationFilter = [];


        // acquisiamo i valori dei filtri selezionti dall-utente

        /* penso che sia sbagliata, qui inseriamo qualsiasi filtro scelto dall'utente
        ma ho differenti filtri */
        $('.filter-category-cb:checked').each(function(){
            categoryFilter.push($(this).val());
        });

        $('.filter-releaseDate-cb:checked').each(function(){
          releaseDateFilter.push($(this).val());
        });

        $('.filter-price-cb:checked').each(function(){
          priceFilter.push($(this).val());
        }); 
        
        
        $('.filter-avarageVal-cb:checked').each(function(){
          courseAvarageValutationFilter.push($(this).val());
        });        
        


        // prepariamo i dati da inviare al server
        var dataToSend = {
            searchTextInput: searchTextInput,
            categoryFilter: categoryFilter,
            releaseDateFilter: releaseDateFilter,
            priceFilter: priceFilter,
            courseAvarageValutationFilter: courseAvarageValutationFilter

        };


        // inviamo una richiesta ajax
        var performSearchRequest = searchRequest(function() {

            $.ajax({
                url: "search_script.php",
                type: "POST",
                data: dataToSend,
                dataType: "json",    /* ci aspettiamo un file json di risposta */
    
                success:  function(response) {
                    displayResults(response);
                    
                },

                error: function(textStatus, errorThrown) {
                    
                    console.error("Error:", textStatus, errorThrown);
                    $("#search-results").html("Error: Search failed!");
                },
                
            });
        })
       

        performSearchRequest();

        
    }


    // definiamo "gli eventi in ascolto"
    $("#searchInput").on("keyup", (event) => {
        if (event.isComposing || event.keyCode === 229) {
          return;
        }
        performSearch();
      });


      
      $("#filterInput").on("change", function() {
        performSearch(); 
      });


      /*note:
        .on e' la versione jquery di addEventListener
        doc: https://developer.mozilla.org/en-US/docs/Web/API/Element/keyup_event
*/

    


    

//----------------------------------------------------------------------------------------------------
// show the results


function displayResults(response) {

    const templateUrl = "./courseCardTemplate.html"; 

// Recupera il modello Mustache.js
fetch(templateUrl)
  .then((response) => response.text()) // Converte la risposta in testo
  .then((template) => {


    const output = ""; // Stringa vuota per accumulare il contenuto delle schede corso

    // per ogni corso all-interno della response 
    response.courses.forEach((course) => {
      const renderedCard = Mustache.render(template, course); // Genera la scheda corso
      output += renderedCard; // Aggiunge la scheda al risultato
    });

    $(".show-cards").html(output); // mostra all-interno della classe show-cards tutte le carte trovate
  })


  // nel caso ci fossero errori:
  .catch((error) => {
    console.error("Errore durante il recupero del modello:", error); // Gestione degli errori
  });

    
}