

// mustache js e' una libreria che ci facilita la vita 
// per la realizzazione delle  carte dei corsi, inoltre,  rende il codice piu' legginile

// https://github.com/janl/mustache.js/







//----------------------------------------------------------------------------------------------------
// perform search


function performSearch( params) {

  var searchTextInput = params;
  var categoryFilter = [];
  var releaseDateFilter = [];
  var priceFilter = $('#priceInput').val();
  var courseAvarageValutationFilter = $('#averageValutationInput').val();

  // acquisiamo i valori dei filtri selezionti dall'utente
  $('.filter-category-cb:checked').each(function() {
      categoryFilter.push($(this).val());
  });

  $('.filter-releaseDate-cb:checked').each(function() {
      releaseDateFilter.push($(this).val());
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
  $.ajax({
      url: "../php/search_script.php",
      type: "POST",
      data: dataToSend,
      dataType: "json",
      success: function(response) {

        $(".show-cards").html(console.log(response));
      
      },



      error: function(jqXHR, textStatus, errorThrown) {
          console.error("Error:", textStatus, errorThrown);
          $("#search-results").html("Error: Search failed!");
      }
  });
}


    // definiamo "gli eventi in ascolto"
    $("#searchInput").keyup(function(event) {
      if (event.isComposing || event.keyCode === 229) {
          return;
      }
      var input = $(this).val();
      console.log(input);
      performSearch(input);
  });;


      
      $("#filterInput").on("change", function() {
        var input = $(this).val();

        performSearch(input); 
      });


      /*note:
        .on e' la versione jquery di addEventListener
        doc: https://developer.mozilla.org/en-US/docs/Web/API/Element/keyup_event
*/

    


    

//----------------------------------------------------------------------------------------------------
// show the results

function displayResults(response) {
  let output = ""; // Initialize empty string to accumulate card content

  // Iterate through each course in the response
  response.courses.forEach((course) => {
      // Render the course card using the template and course data
      const renderedCard = renderCourseCard(course);
      output += renderedCard; // Append card to output
  });

  // Inject the accumulated HTML into the DOM
  $(".show-cards").html(output);
}

function renderCourseCard(course) {
  // Define your course card template directly in JavaScript
  // Use string interpolation to insert course data into the template
  return `
      <div class="course-card">
          <h2>${course.name}</h2>
          <p>By: ${course.teacher}</p>
          <p>${course.description}</p>
          <div class="course-details">
              <span class="price">Price: ${course.price}</span>
              <span class="ambit">Ambit: ${course.ambit}</span>
              <span class="rating">Rating: ${course.average_valuation}</span>
          </div>
      </div>
  `;
}