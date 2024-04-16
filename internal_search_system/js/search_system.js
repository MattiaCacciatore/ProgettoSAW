

// mustache js e' una libreria che ci facilita la vita 
// per la realizzazione delle  carte dei corsi, inoltre,  rende il codice piu' legginile

// https://github.com/janl/mustache.js/







//----------------------------------------------------------------------------------------------------
// perform search


function performSearchFromSearchBarInput(params) {

  let searchTextInput = params;




  // prepariamo i dati da inviare al server
  let dataToSend = {
      searchTextInput: searchTextInput,
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
      performSearchFromSearchBarInput(input);
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