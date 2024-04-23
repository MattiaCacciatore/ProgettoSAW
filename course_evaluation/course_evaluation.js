function followedCoursesByUser() {


    $.ajax({
        url: './course_evaluation.php',
        method:'POST',
        dataType:'json',

        success: function(result) {
            !$.trim(results)?  document.querySelector('.evaluation-courses-wrapper').innerHTML= '<p class="error">Non segui nessun corso</p>' : displayResults(results);

        }
    })
    
}


$(document).ready(function() {
    followedCoursesByUser(); // Call followedCoursesByUser on page load
  });
  