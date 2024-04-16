<?php
include_once '../header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selected_activity_id = $_POST['activity_id'];
    
    include_once "../classes/dbh.classes.php";
    include_once "../classes/activityinfo.classes.php";
    include_once "../classes/activityinfo-contr.classes.php";
    include_once "../classes/activityInfo-view.classes.php";

    $activityInfo = new ActivityInfoView();
    $activityDetails = $activityInfo->fetchActivityDetails($selected_activity_id);

    // Output activity details
    echo '<div class="container mt-4">';
    echo '<div class="card activity-bg activity-card" style="height: 100vh;">';
    echo '<div class="card-body mb-3 activity-info">';
    echo '<div class="row">';
    echo '<div class="col-md-3">';
    echo '<img src="../activityImg/' . $activityInfo->fetchActivityImage($selected_activity_id) . '" class="img-fluid" alt="Activity Image">';
    echo '</div>';
    echo '<div class="col-md-5 align-self-center">';
    echo '<button class="btn btn-primary read-aloud-button" data-content="' . htmlentities($activityInfo->fetchActivityName($selected_activity_id) . '. ' . $activityInfo->fetchActivityDescription($selected_activity_id) . '. ' . $activityInfo->fetchActivityBenefit($selected_activity_id)) . '">Read Aloud</button>';
    echo '<h5 class="card-title mt-3">' . $activityInfo->fetchActivityName($selected_activity_id) . '</h5>';
    echo '<p class="card-description">' . $activityInfo->fetchActivityDescription($selected_activity_id) . '</p>';
    echo '<p class="card-description">' . $activityInfo->fetchActivityBenefit($selected_activity_id) . '</p>';
    echo '<form action="green_calc_new.php" method="POST">';
    echo '<input type="hidden" name ="activity_id" value="'.$activityInfo->fetchActivityImage($selected_activity_id).'">';
    echo '<input type="hidden" name="image" value="' . urlencode($activityInfo->fetchActivityImage($selected_activity_id)) . '">';
    echo '<input type="hidden" name="name" value="' . urlencode($activityInfo->fetchActivityName($selected_activity_id)) . '">';
    echo '<button type="submit" class="btn btn-outline-success add-btn">Add</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

include_once "../footer.php";
?>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- <script src="https://code.responsivevoice.org/responsivevoice.js"></script> -->

<!-- Read Aloud code-->
<script>
    let currentSpeech;
    const readAloudButtons = document.querySelectorAll('.read-aloud-button');
    readAloudButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const content = button.getAttribute('data-content');
            if (currentSpeech) {
                console.log('Stop speech');
                responsiveVoice.cancel(currentSpeech);
            }
            console.log('Start speech');
            currentSpeech = responsiveVoice.speak(content, "UK English Female");
        });
    });
</script>

<!-- Add button-->

