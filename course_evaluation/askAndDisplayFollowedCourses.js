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
            !$.trim(result)?  document.querySelector('.evaluation-courses-wrapper').innerHTML= '<p class="error">Non segui nessun corso</p>' : displayFollowedCourses(result);

        },

        error: function(textStatus, errorThrown) {
            console.error("Error:", textStatus, errorThrown);
            $("#search-results").html("Error: Search failed!");
        },
    });
    
}




function performUpdateEvaluation(email_user,id_course) {

    if (empty(email_user) || empty(id_course)) {
        console.error('courseName or courseId cannot be empty');
    }

    let vote = document.getElementById('vote');
    let feedback = document.getElementById('feedbackText');


  let dataToSend = {
    courseId:id_course,
    feedback:feedback,
    vote:vote

  };

    $.ajax({
        url: './performSearchFollowedCourses.php',
        method:'POST',
        data: dataToSend,
        dataType:'json',

        success: function(result) {

            
            console.log(result);

            // check if there is some result from request to database: if there is no result display a message, displayrResult() otherwise
            !$.trim(result)?  document.querySelector('.evaluation-courses-wrapper').innerHTML= '<p class="error">Non segui nessun corso</p>' : displayFollowedCourses(result);

        },

        error: function(textStatus, errorThrown) {
            console.error("Error:", textStatus, errorThrown);
            $("#search-results").html("Error: Search failed!");
        },
    });
}



// This method provides to display results dinamically
function displayFollowedCourses(result) {

    let followedCourses = JSON.parse(JSON.stringify(result));
    let sectionToInjectResult = document.querySelector('tbody');
    let html = "";

    
    console.log("followerCourse");
    console.log(followedCourses);

    // Iterate for each course inside followedCourse
    followedCourses.forEach(function(followedCourse) {
        html += followedCoursesTemplate(followedCourse);
    });

    // check if section to inject results exsist inside the page
    sectionToInjectResult? sectionToInjectResult.innerHTML = html : console.error("Element not found.");

}



function followedCoursesTemplate(followedCourse) {
    // Costruisci il template HTML per il corso seguito
    return `
        <tr>
            <td>${followedCourse.course_name}</td>
            <td><button onclick="showFeedbackModal('${followedCourse.course_name}',' ${followedCourse.course_id}')">Feedback</button></td>
        </tr>
    `;
}




// Function to show the feedback modal
function showFeedbackModal(course_name, course_id) {
  
    document.getElementById('courseName').textContent = course_name;
    document.getElementById('courseId').textContent = '[course code id:' + course_id + ']';
    document.getElementById('feedbackModal').style.display = 'block';
  }
  
  // Function to close the feedback modal
  function closeFeedbackModal() {
    document.getElementById('feedbackModal').style.display = 'none';
  }

