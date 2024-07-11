// ASCOLTATORI. =============================================

$(document).ready(function() {
    followedCoursesByUser(); // Chiama followedCoursesByUser sulla pagina caricata.
});



  // Se venissero impostati dei valori ai campi del filtro dei prezzi allora...
  $("#feedbackButton").click(function() {
    // ...viene innescata la ricerca con l'input corrente.
    performUpdateEvaluation($("#vote").val(), $("#feedbackText").val() );
  });

// METODI. ===============================================

// Questo metodo permette di inviare richieste ajax in post ed elaborare i risultati.
function followedCoursesByUser() {

    $.ajax({
        url: '../php/performSearchFollowedCourses.php',
        method:'POST',
        dataType:'json',

        success: function(result) {

            console.log(result);
            // Controlla se ci sono risultati dalla richiesta al database: se non ci sono risultati visualizza un messaggio, altrimenti li mostra.
            !$.trim(result)?  document.querySelector('.evaluation-courses-wrapper').innerHTML= '<p class="error">Hai valutato tutti i corsi!</p>' : displayFollowedCourses(result);

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

// Questo metodo permette di visualizzare i risultati dinamicamente.
function displayFollowedCourses(result) {
    let followedCourses = JSON.parse(JSON.stringify(result));
    let sectionToInjectResult = document.querySelector('#coursesContainer');
    let html = "";

    console.log("followedCourses");
    console.log(followedCourses);

    // Itera per ogni course dentro followedCourses.
    followedCourses.forEach(function(followedCourse) {
        html += followedCoursesTemplate(followedCourse);
    });

    // Controlla se la sezione in cui inserire i risultati esiste all'interno della pagina.
    sectionToInjectResult ? sectionToInjectResult.innerHTML = html : console.error("Element not found.");
}

// Template per i corsi seguiti.
function followedCoursesTemplate(course) {
    return `
        <div class="course-item">
            <h2>${course.course_name}</h2>
            <button onclick="openFeedbackModal('${course.course_id}', '${course.course_name}')">Valuta il corso</button>
        </div>
    `;
}

// Funzione per aprire il feedback modale.
function openFeedbackModal(courseId, courseName) {
    document.getElementById('courseName').textContent = courseName;
    document.getElementById('courseId').textContent = courseId;
    document.getElementById('feedbackModal').style.display = 'block';
}

// Funzione per chiudere il feedback modale.
function closeFeedbackModal() {
    document.getElementById('feedbackModal').style.display = 'none';
}
