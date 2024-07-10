// LISTENERS =============================================

$(document).ready(function() {
    followedCoursesByUser(); // Call followedCoursesByUser on page load
});



  // se venissero inpostati dei valori ai campi del filtro dei prezzi allora,
  $("#feedbackButton").click(function() {
    performUpdateEvaluation($("#vote").val(), $("#feedbackText").val() ); // Trigger search with current search input
  });




// METHODS ===============================================

// This method provides to send ajax request in post and elaborate results
function followedCoursesByUser() {


    $.ajax({
        url: '../php/performSearchFollowedCourses.php',
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



function performUpdateEvaluation(vote, feedback) {
    let id_course = document.getElementById('courseId').innerHTML;
    let convertedVote = parseFloat(vote);
    console.log(id_course, convertedVote, feedback);



    try {
        updateEvaluationSanityCheck(id_course, convertedVote, feedback);

        let dataToSend = {
            id_course: id_course,
            vote: convertedVote,
            feedback: feedback,
        };

        console.log("data to send:", dataToSend);

        $.ajax({
            url: '../php/updateEvaluation.php',
            method: 'POST',
            data: dataToSend,

            success: function(results) {
                console.log(results);
                location.reload();
            },

            error: function(xhr, textStatus, errorThrown) {
                console.error("Error:", textStatus, errorThrown);
                $(".search-evaluation-courses-wrapper").html("Error: Search failed!");
            },
        });
    } catch (error) {
        console.error("Error:", error.message);
    }
}





function updateEvaluationSanityCheck(id_course,vote) {
    
    if (id_course === '' || isNaN(vote)) {
        throw new Error('Uno dei parametri non è valido.');
    }

    if (vote < 0.0 || vote > 5.0) {
        throw new Error('il voto deve essere compreso tra 0.0 e 5.0');

    }


    
}



// This method provides to display results dynamically
function displayFollowedCourses(result) {
    let followedCourses = JSON.parse(JSON.stringify(result));
    let sectionToInjectResult = document.querySelector('#coursesContainer');
    let html = "";

    console.log("followedCourses");
    console.log(followedCourses);

    // Iterate for each course inside followedCourses
    followedCourses.forEach(function(followedCourse) {
        html += followedCoursesTemplate(followedCourse);
    });

    // Check if section to inject results exists inside the page
    sectionToInjectResult ? sectionToInjectResult.innerHTML = html : console.error("Element not found.");
}

// Template for followed courses
function followedCoursesTemplate(course) {
    return `
        <div class="course-item">
            <h2>${course.course_name}</h2>
            <button onclick="openFeedbackModal('${course.course_id}', '${course.course_name}')">Valuta il corso</button>
        </div>
    `;
}

// Function to open the feedback modal
function openFeedbackModal(courseId, courseName) {
    document.getElementById('courseName').textContent = courseName;
    document.getElementById('courseId').textContent = courseId;
    document.getElementById('feedbackModal').style.display = 'block';
}

// Function to close the feedback modal
function closeFeedbackModal() {
    document.getElementById('feedbackModal').style.display = 'none';
}
