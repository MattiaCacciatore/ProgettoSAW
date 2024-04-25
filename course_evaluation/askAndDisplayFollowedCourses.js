// LISTENERS =============================================

$(document).ready(function() {
    followedCoursesByUser(); // Call followedCoursesByUser on page load
});




// METHODS ===============================================

// This method provides to send ajax request in post and elaborate results
function followedCoursesByUser() {


    $.ajax({
        url: './performSearchFollowedCourses.php',
        method:'POST',
        dataType:'json',

        success: function(result) {
            
            console.log(result);
            // check if there is some result from request to database: if there is no result display a message, displayrResult() otherwise
            // !$.trim(result)?  document.querySelector('.evaluation-courses-wrapper').innerHTML= '<p class="error">Non segui nessun corso</p>' : displayResults(result);

        },

        error: function(textStatus, errorThrown) {
            console.error("Error:", textStatus, errorThrown);
            $("#search-results").html("Error: Search failed!");
        },
    });
    
}




// This method provides to display results dinamically
function displayResults(resultsFromAjaxRequest) {
    
    let follwedCourses = JSON.parse(JSON.stringify(resultsFromAjaxRequest));
    let sectionToInjectResult = document.querySelector('.evaluation-courses-wrapper');
    let html = "";

    // Iterate for each course inside followedCourse
    follwedCourses.foreEach(function(followedCourse) {
        html += followedCoursesTemplate(followedCourse);
    });

    // check if section to inject results exsist inside the page
    sectionToInjectResult? sectionToInjectResult.innerHTML = html : console.error("Element not found.");

}



function followedCoursesTemplate(followedCourse) {
    // ---
}



function performUpdateEvaluation() {
    //-- ajax post
}

