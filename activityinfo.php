<?php
include_once 'header.php';

// Access to classes in order to get info
include_once "classes/dbh.classes.php";
include_once "classes/activityinfo.classes.php";
include_once "classes/activityinfo-contr.classes.php";
include_once "classes/activityinfo-view.classes.php";

$activityInfo = new ActivityInfoView();

if (isset($_GET['activity_id'])) {
    $activityId = $_GET['activity_id'];
    $activityDetails = $activityInfo->fetchActivityDetails($activityId); //Array $activityDetails with all details\s
   // Set session from GET
//    $_SESSION['activity_details'] = $activityDetails;

}
if(isset($_SESSION['userid'])){
    $userId = $_SESSION['userid'];   
}

//If user not logged in
if(isset($_SESSION['userid'])) {
    $action = "green_calc.php";
} else {
    $action = "login.php";
}

// var_dump($activityDetails);
// Output activity details
echo '
<body class="d-flex flex-column"> 
<main class="container m-3 flex-grow vh-100">

<div class="p-3">
        <h3>Activity Info</h3>
    </div>
    <div class="card activity-bg activity-card p-3">
        <div class="card-body mb-3 activity-info">
            <div class="row">
                <div class="col-md-3">
                    <img src="activityImg/' . $activityDetails['activity_img'] . '" class="img-fluid" alt="Activity Image">
                </div>
                <div class="col-md-5 align-self-center">
                    <button class="btn btn-primary read-aloud-button" data-content="' . htmlentities($activityDetails['activity_name'] . '. ' . $activityDetails['activity_description'] . '. ' . $activityDetails['activity_benefit']) . '">Read Aloud</button>
                    <h5 class="card-title mt-3">' . $activityDetails['activity_name'] . '</h5>
                    <p class="card-description">' . $activityDetails['activity_description'] . '</p>
                    <p class="card-description">' . $activityDetails['activity_benefit'] . '</p>
                    <form action="'.$action.'" method="POST">
                        <input type="hidden" name="activity_id" value="' . $activityId . '">
                        <input type="hidden" name="image" value="' . urlencode($activityDetails['activity_img']) . '">
                        <input type="hidden" name="name" value="' . urlencode($activityDetails['activity_name']) . '">
                        <button id="button-container" type="submit" class="btn btn-outline-success add-btn">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </main>
</body>';
include_once "footer.php";
?>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://code.responsivevoice.org/responsivevoice.js"></script> 

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
<script>
function addButton(){
    
// Create a new button element
var newButton = document.createElement('button');

// Set attributes for the button
newButton.setAttribute('type', 'button');
newButton.setAttribute('class', 'btn btn-outline-success add-btn');
newButton.textContent = 'Add';

// Append the button to a specific element in the DOM
var container = document.getElementById('button-container'); // Replace 'button-container' with the ID of the container where you want to append the button
container.appendChild(newButton);
}

   
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


