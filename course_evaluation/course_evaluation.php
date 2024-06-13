<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Courses Evaluation</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./course-evaluation.css">
    <link rel="stylesheet" href="../modules/css/header.css">
    <link rel="stylesheet" href="../modules/css/footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./askAndDisplayFollowedCourses.js" defer></script>
</head>

<body>

<?php
    require dirname(__FILE__).'/../modules/header.php';
?>

<h1>Valuta i tuoi corsi</h1>

<main>
    <div class="evaluation-courses-wrapper">
        <div id="coursesContainer">
            <!-- Questo spazio verrà riempito dinamicamente con i dati dei corsi -->
        </div>
    </div>

    <!-- Modal for the feedback form -->
    <div id="feedbackModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeFeedbackModal()">&times;</span>
            <h3>Feedback del corso <span id="courseName"></span></h3>
            <div id="courseId"></div>

            <hr>
            <form id="feedbackForm">
                <label for="vote">Voto:</label>
                <input type="number" id="vote" name="vote" min="1.0" max="5.0" required><br><br>
                <label for="feedbackText">Feedback:</label><br>
                <textarea id="feedbackText" name="feedbackText" rows="4" cols="50" required></textarea><br><br>
                <input type="button" id="feedbackButton" value="Invia il tuo Feedback">
            </form>
        </div>
    </div>

</main>

</body>
</html>
