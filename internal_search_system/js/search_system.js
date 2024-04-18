
function performSearch(params) {

  document.querySelector('.price-filter-error').innerHTML = '';


  /******************** RACCOLTA DEI DATI *****************************/
  
  let minPrice = getPriceFilterValue('#input-min');
  let maxPrice = getPriceFilterValue('#input-max');

  if (minPrice > maxPrice) {
    document.querySelector('.price-filter-error').innerHTML = '<p class="error"> il minimo non può essere più grande del massimo </p>';
    return;
  }


  let searchTextInput = params;


  /******************* PREPARAZIONE DEI DATI *************************** */
  
  // prepariamo i dati da inviare al server
  let dataToSend = {
    searchTextInput: searchTextInput,
    minPrice:minPrice,
    maxPrice:maxPrice

  };



  // inviamo una richiesta ajax------------------------------------------
  $.ajax({
      url: "../php/search_script.php",
      type: "POST",
      data: dataToSend,
      dataType: "json",
      success: function(results) {

        // se non troviamo nulla, solleviamo un'eccezione. Stampiamo i risultati altrimenti
      !$.trim(results)?  document.querySelector('.wildCards').innerHTML= '<p class="error">nessun corso trovato</p>' : displayResults(results);
    
      
      },



      error: function(textStatus, errorThrown) {
          console.error("Error:", textStatus, errorThrown);
          $("#search-results").html("Error: Search failed!");
      }
  });
}







//----------------------------------------------------------------------------------------------------
// definiamo "gli eventi in ascolto"

$(document).ready(function() {
  performSearch(""); // Call performSearch with an empty string on page load
});

// ad ogni input dell'utente viene efftettuata una ricerca, molto più dinamico
$("#searchInput").keyup(function(event) {
    if (event.isComposing || event.keyCode === 229) {
          return;
      }
      let input = $(this).val();
      performSearch(input);
  });


  // se venissero inpostati dei valori ai campi del filtro dei prezzi allora,
  $("#searchButton").click(function() {
    performSearch($("#searchInput").val()); // Trigger search with current search input
  });


    

//----------------------------------------------------------------------------------------------------
// show the results

function getPriceFilterValue(priceFilterId) {

  let priceValue = $(priceFilterId).val();
  let result;

  // sanity check
  if (priceValue < 0 ) {
    document.querySelector('.price-filter-error').innerHTML = '<p class="error">Il prezzo non può essere negativo</p>';
    return;

  }

   
  // verifichiamo a quale campo ci refriamo e se percaso il campo e' vuoto impostiamo dei valori di default 0 e 10.000 rispettivamente
  if (priceFilterId === "#input-min") {
    result = priceValue ? parseFloat(priceValue) : 0; 
  } else {
    result = priceValue ? parseFloat(priceValue) : 10000; 
  }

  console.log(result);
  
  return result;
}





function displayResults(results) {
  // Parse the JSON data into a JavaScript object
  let courses = JSON.parse(JSON.stringify(results));

  // siccome noi facciamo un parsing dei dati in JSON, possimao sfruttarlo per esegurie il filtraggio dei dati



  // Get the DOM element where the results will be displayed
  let resultPosition = document.querySelector('.wildCards');

  // Initialize an empty string to accumulate HTML content
  let html = '';

  // Iterate through each course in the response
      courses.forEach(function(course) {
        html += renderCourseCard(course);
    });




  // Set the innerHTML of the result position with the accumulated HTML
  if (resultPosition) {
    resultPosition.innerHTML = html;
  } else {
      console.error("Element with class 'show-cards' not found.");
  }

}


function renderCourseCard(course) {

  return `
  <div class="course-card">
  <h2>${course.name_course}</h2>
          <p>By: ${course.teacher}</p>
          <p>${course.description_of_course}</p>
          <div class="course-details">
              <span class="price">Price: ${course.price}</span>
              <span class="ambit">Ambit: ${course.ambit}</span>
              <span class="rating">Rating: ${course.average_evaluation}</span>
          </div>
      </div>
  `;
}