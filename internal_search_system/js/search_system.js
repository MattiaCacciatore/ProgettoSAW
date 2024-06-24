//----------------------------------------------------------------------------------------------------
// Si definiscono "gli eventi in ascolto".

$(document).ready(function() {
  performSearchOpeningPage();
});

// Ad ogni input dell'utente viene effettuata una ricerca, più dinamico.
$("#searchInput").keyup(function(event){
    if(event.isComposing || event.keyCode === 229){
      return;
    }

    let input = $(this).val();
    performUserSearch(input);
  });

// Se venissero impostati dei valori ai campi del filtro dei prezzi allora...
$("#searchButton").click(function(){
  performUserSearch($("#searchInput").val()); // Trigger search with current search input
});  

/*---------------------------------------------------------------------------------------------------------------------------------- */
/*                                                          FUNZIONI PRINCIPALI                                                      */
/*---------------------------------------------------------------------------------------------------------------------------------- */

function performUserSearch(params){

  document.querySelector('.price-filter-error').innerHTML = '';

  
  // Nota: toFixed aggiunge a un input intero la virgola con due zeri. 80 -> 80,00
  let minPrice = getPriceFilterValue('#input-min'); 
  let maxPrice = getPriceFilterValue('#input-max');

  if (minPrice > maxPrice) {
    document.querySelector('.price-filter-error').innerHTML = '<p class="error"> il minimo non può essere più grande del massimo </p>';
    return;
  }

  let searchTextInput = params;
  
  // Si preparano i dati da inviare al server.
  let dataToSend = {
    searchTextInput: searchTextInput,
    minPrice:minPrice,
    maxPrice:maxPrice

  };

  // Si invia una richiesta ajax 
  $.ajax({
      url: "../php/performUserSearch.php",
      type: "POST",
      data: dataToSend,
      dataType: "json",
      success: function(results) {
        // Se non si trova nulla si solleva un'eccezione altrimenti si stampano i risultati.
        console.log(results);
        !$.trim(results) ?  document.querySelector('.wildCards').innerHTML= '<p class="error">nessun corso trovato</p>' : displayResults(results);
    
      },

      error: function(textStatus, errorThrown) {
          console.error("Error:", textStatus, errorThrown);
          $("#search-results").html("Error: Search failed!");
      }
  });
}

//----------------------------------------------------------------------------------------------------
// Method that performs a preliminary search for courses to show the user when he opens the page.

function performSearchOpeningPage(){
    $.ajax({
      url: "../php/performSearchOpeningPage.php",
      type: "POST",
      dataType: "json",
      success: function(results) {
        // Se non si trova nulla si solleva un'eccezione altrimenti si stampano i risultati.
        console.log(results);
        !$.trim(results) ?  document.querySelector('.wildCards').innerHTML= '<p class="error">nessun corso trovato</p>' : displayResults(results);
    
      },

      error: function(textStatus, errorThrown) {
          console.error("Error:", textStatus, errorThrown);
          $("#search-results").html("Error: Search failed!");
      }
  });
}

/*---------------------------------------------------------------------------------------------------------------------------------- */
/*                                                          FUNZIONI SECONDARIE                                                      */
/*---------------------------------------------------------------------------------------------------------------------------------- */

function getPriceFilterValue(priceFilterId) {
  let priceValue = parseFloat($(priceFilterId).val()); // Parse the input value to a float.
  let result;

  // Sanity check.
  if (priceValue < 0) {
    document.querySelector('.price-filter-error').innerHTML = '<p class="error">Il prezzo non può essere negativo</p>';
    return; // Return or throw an error.
  }

  // Check which input field we are referring to and if the field is empty, set default values ​​of 0 and 10,000 respectively.
  if (priceFilterId === "#input-min") {
    result = priceValue ? priceValue : 1.0; 
  } else {
    result = priceValue ? priceValue : 10000.0; 
  }

  return result;
}

//----------------------------------------------------------------------------------------------------

function displayResults(results) {
  // Parse the JSON data into a JavaScript object.
  let courses = JSON.parse(JSON.stringify(results));

  console.log(courses);

  // Siccome noi facciamo un parsing dei dati in JSON, possiamo sfruttarlo per eseguire il filtraggio dei dati.

  // Get the DOM element where the results will be displayed.
  let resultPosition = document.querySelector('.wildCards');

  // Initialize an empty string to accumulate HTML content.
  let html = '';

  // Iterate through each course in the response.
  courses.forEach(function(course) {
    html += renderCourseCard(course);
  });

  // Set the innerHTML of the result position with the accumulated HTML.
  if (resultPosition) {
    resultPosition.innerHTML = html;
  } else {
      console.error("Element with class 'show-cards' not found.");
  }

}

//----------------------------------------------------------------------------------------------------

function renderCourseCard(course){

  return `
  <div class = 'course-card'>
    <h2>${course.name}</h2>
    <p>Da: ${course.teacher}</p>
    <p>${course.description}</p>
    <div class = 'course-details'>
      <span class = 'price'>Prezzo: ${course.price}</span>
      <span class = 'rating'>Valutazione: ${course.average_evaluation}</span>
    </div>
    <form form action = '../../user_area/show_course.php' method = 'post'>
      <button type = 'submit' name = 'courseId' value = ${course.id}>Accedi al corso</button>
    </form>
  </div>
  `;
}