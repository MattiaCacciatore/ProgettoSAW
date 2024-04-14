

// mustache js e' una libreria che ci facilita la vita 
// per la realizzazione delle  carte dei corsi, inoltre,  rende il codice piu' legginile

// https://github.com/janl/mustache.js/







//----------------------------------------------------------------------------------------------------
// perform search


function performSearch(params) {

  let searchTextInput = params;
  let categoryFilter = [];
  let releaseDateFilter = [];
  let priceFilter = $('#priceInput').val();
  let courseAletageValutationFilter = $('#averageValutationInput').val();

  // acquisiamo i valori dei filtri selezionti dall'utente
  $('.filter-category-cb:checked').each(function() {
      categoryFilter.push($(this).val());
  });

  $('.filter-releaseDate-cb:checked').each(function() {
      releaseDateFilter.push($(this).val());
  });



  // prepariamo i dati da inviare al server
  let dataToSend = {
      searchTextInput: searchTextInput,
      categoryFilter: categoryFilter,
      releaseDateFilter: releaseDateFilter,
      priceFilter: priceFilter,
      courseAletageValutationFilter: courseAletageValutationFilter
  };





  // inviamo una richiesta ajax
  $.ajax({
      url: "../php/search_script.php",
      type: "POST",
      data: dataToSend,
      dataType: "json",
      success: function(results) {

        displayResults(results);
      
      },



      error: function(textStatus, errorThrown) {
          console.error("Error:", textStatus, errorThrown);
          $("#search-results").html("Error: Search failed!");
      }
  });
}






//----------------------------------------------------------------------------------------------------
// definiamo "gli eventi in ascolto"
$("#searchInput").keyup(function(event) {
    if (event.isComposing || event.keyCode === 229) {
          return;
      }
      let input = $(this).val();
      performSearch(input);
  });;


  $("#priceInput").keyup(function(event) {
    if (event.isComposing || event.keyCode === 229) {
          return;
      }
      let input = $(this).val();
      console.log(input);
      performSearch(input);
  });;


      
      $("#filterInput").on("change", function() {
        let input = $(this).val();

        performSearch(input); 
      });


      /*note:
        .on e' la versione jquery di addEventListener
        doc: https://developer.mozilla.org/en-US/docs/Web/API/Element/keyup_event
*/

    


    

//----------------------------------------------------------------------------------------------------
// show the results

function displayResults(results) {
  // Parse the JSON data into a JavaScript object
  let courses = JSON.parse(JSON.stringify(results));

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
  <div class="course-card" style="border: 1px solid #ccc; border-radius: 8px; padding: 20px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
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