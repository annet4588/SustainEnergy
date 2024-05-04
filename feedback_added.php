<?php
include_once 'header.php';

include_once "classes/dbh.classes.php";
include_once "classes/feedback.classes.php";
include_once "classes/feedback-contr.classes.php";
include_once "classes/feedback-view.classes.php";

include_once "classes/profileinfo.classes.php";
include_once "classes/profileinfo-contr.classes.php";
include_once "classes/profileinfo-view.classes.php";

// Display the title
echo '<div class="container text-center mt-4" style="min-height: 100vh;">';
echo '<h3 class="text-center mt-4 p-3">Feedback</h3>';

//Check if session is set
$userId = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;


//Initialise variables
$companyName = $fbMessage = "";
$fbDate = date('Y-m-d');
$fbRate = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     // Getting data from the POST request from shoppingCart page
     $userId = $_SESSION['userid'];
        // Create an instance of ProfileView to get Company name
        $profileInfo = new ProfileInfoView();
        // Get the name of the company
        $companyName = $profileInfo->fetchCompanyName($userId);

   
    // $fbid = $_SESSION['fbid'];
    // Sanitising data
    $companyName = isset($_POST['company_name']) ? $_POST['company_name'] : '';
    $fbMessage = htmlspecialchars($_POST['fb_message'], ENT_QUOTES, 'UTF-8');
    $fbRate = isset($_POST['fb_rate']) ? $_POST['fb_rate'] : 0;
    
 
   // Set session variables
   $_SESSION['fb_rate'] = $fbRate;
   $_SESSION['company_name'] = $companyName;
   $_SESSION['fb_message'] = $fbMessage;
   $_SESSION['fb_date'] = $fbDate;
   

    // Create an instance of FeedbackView 
    // $feedbackView = new FeedbackView();
    // $fbMessage = $feedbackView->fetchFeedback($userId);

    // Fetch the feedback id
    // $fbid = $feedbackView->fetchFeedbackSingleId($userId);



    try {
        // Create an instance of FeedbackContr
        $feedbackContr = new FeedbackContr($userId, $fbRate, $companyName, $fbMessage, $fbDate);

        // Set the feedback
        $feedbackContr->processFeedback();
         // Unset session variables after processing
         unset($_SESSION['fb_rate']);
         unset($_SESSION['company_name']);
         unset($_SESSION['fb_message']);
         unset($_SESSION['fb_date']);

        // var_dump($userId, $fbRate, $companyName, $fbMessage, $fbDate);
        // Display success message inside a card
    
        echo '<div class="alert alert-success" role="alert">';
        echo '<p>Your feedback has been added successfully.</p>';
        echo '<p>Thank you for providing feedback!</p>';
        echo '<p>Click on the button "View Feedback" to see your feedback.</p>';
        echo '</div>';
       
    } catch (Exception $e) {
        // Handle any exceptions here
        echo "An error occurred: " . $e->getMessage();
    }
    // Button to view feedback
echo '<div class="row justify-content-center p-3">';
echo '<div class="col-md-8">';
echo '<div class="text-center">';
echo '<a href="feedback.php" class="btn btn-secondary">View Feedback</a>';
echo '</div>';
echo '</div>';
echo '</div>';
}

// Form for submitting feedback
echo '<div class="row justify-content-center p-3">';
echo '<div class="center-card" style="width: 700px;">';
echo '<div class="card profile-bg profile-card">';
echo '<div class="card-body profile-info">';
echo '<h3>Your Review</h3>';
echo '<form action="feedback_added.php" method="post">';
// Include userId as a hidden input
echo '<input type="hidden" id="userid" name="userid" value="' . $userId . '">';
// Include userId as a hidden input
echo '<input type="hidden" id="fb_date" name="fb_date" value="' . $fbDate . '">';
echo '<div class="form-group">';
echo '<img name="empty-star" type="button" src="images/star-48-empty.png" alt="Star" onclick="fillStars(this)">
<img name="empty-star" type="button" src="images/star-48-empty.png" alt="Star" onclick="fillStars(this)">
<img name="empty-star" type="button" src="images/star-48-empty.png" alt="Star" onclick="fillStars(this)">
<img name="empty-star" type="button" src="images/star-48-empty.png" alt="Star" onclick="fillStars(this)">
<img name="empty-star" type="button" src="images/star-48-empty.png" alt="Star" onclick="fillStars(this)">';
echo '</div>';
echo '<input type="hidden" id="fb_rate" name="fb_rate" value="0">'; // Hidden input for actual rating value
// echo '<div id="totalRate" name="fb_rate">'. $fbRate.'</div>';
echo '<div class="form-group">';
echo '<input type="text" class="form-control" name="company_name" placeholder="Company Name ..." value="">';
echo '</div>';
echo '<div class="form-group">';
echo '<textarea class="form-control" name="fb_message" rows="10" placeholder="Feedback message ..."></textarea>';
echo '</div>';
echo '<button type="submit" class="btn btn-outline-success form-control" name="submit">SAVE</button>';
echo '</form>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '</div>';
echo '</div>';


include_once 'footer.php';

?>
<!-- Include Bootstrap JS and jQuery -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    function fillStars(element){
        var filledStars = document.querySelectorAll('img[src="images/star-48.png"]').length;
        var fbRateInput = document.getElementById('fb_rate'); // Hidden input for actual rating value
        if(element.src.includes('star-48-empty.png')){
            element.src = 'images/star-48.png';
            filledStars++; // Increment the total rate
        } else {
            element.src = 'images/star-48-empty.png';
            filledStars--; // Decrement the total rate if unselecting
        }

        fbRateInput.value = filledStars; // Update hidden input value
        document.getElementById('totalRate').textContent = filledStars;
    
    }
</script>
