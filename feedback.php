<?php
include_once 'header.php';

include_once "classes/dbh.classes.php";
include_once "classes/feedback.classes.php";
include_once "classes/feedback-contr.classes.php";
include_once "classes/feedback-view.classes.php";

include_once "classes/subsriptioninfo.classes.php";
include_once "classes/subscriptioninfo-view.classes.php";

// Display the title and Add Your Story button inline
echo '<div class="container text-center mt-4" style="min-height: 100vh;">';
echo '<div class="d-flex  flex-column  align-items-center mb-3">';
echo '<h3 class="mb-3 p-3">Your Stories</h3>';
echo '<a href="' . (isset($_SESSION['userid']) ? 'feedback_added.php' : 'login.php') . '" class="btn btn-outline-success">Add Your Story</a>';
echo '</div>';

$userId= '';

// $subscriptionView = new SubscriptionView();
// $subId = $subscriptionView->fetchSubscriptionSingleId($userId); // This returns the subscription ID 

// var_dump($subId);

try {
    // Create an instance of FeedbackView
    $feedbackView = new FeedbackView();

    $feedbackIds = $feedbackView->getAllFeedbackIdsFromDB();

    // Display each feedback using a foreach loop
    echo '<div class="container">';
    echo '<div class="row justify-content-center">';

    // var_dump($feedbackIds);
   
    foreach ($feedbackIds as $feedbackId) {
        $feedbackInfo = $feedbackView->getFeedbackById($feedbackId['fb_id']); // Use getFeedbackById instead of getAllFeedbackIds
    
        $fbRate = $feedbackInfo['fb_rate'];
        $companyName = $feedbackInfo['company_name'];
        $fbMessage = $feedbackInfo['fb_message'];
        $userId = $feedbackInfo['users_id']; // display user ID 
        $fbDate = new DateTime($feedbackInfo['fb_date']);


        $now = new DateTime();
        //Calculate the interval 
        $interval = $fbDate->diff($now);
        $daysDiff = $interval->days;

        //Format the date
        if($daysDiff == 0){
            $fbDate = 'today';
        }elseif($daysDiff == 1){
            $fbDate = 'yesterday';
        }else{
            $fbDate = $daysDiff . ' days ago';
        }

        echo '<div class="col-md-6 p-3">';
        echo '<div class="card form-group mt-3 d-flex align-items-center">';
        echo '<div class="card-body style="height: 200px; display: flex;">';
        echo '<img style="width:100px; height: 100px;flex-shrink: 0;" src="activityImg/img_default.png" class="img-fluid rounded-circle mt-3" alt="Review Image">';
        echo '<div>';
        echo '<h5 class="card-title form-group mb-0">' . $companyName . '</h5>';
        echo '<h6 class= "form-group">'.$fbDate.'</h6> ';
        echo '<div class="form-group p-3">';
         // Display filled stars based on $fbRate
         for ($i = 1; $i <= 5; $i++) {
            if ($i <= $fbRate) {
                echo '<img src="images/star-48.png" style="width:30px" alt="Star">';
            } else {
                echo '<img src="images/star-48-empty.png" style="width:30px" alt="Empty Star">';
            }
        }
        echo '</div>';
        echo '<div class="alert alert-success pt-3" role="alert" style="width: 100%;">';       
        echo '<p class="form-group mb-0 flex-grow-1">' . $fbMessage . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
 } catch (Exception $e) {
    // Handle any exceptions here
    echo '<div class="alert alert-danger" role="alert">';
    echo 'An error occurred: ' . $e->getMessage();
    echo '</div>';
}

echo '</div>'; // Close row div
echo '</div>'; // Close container div
echo '</div>';
include_once "footer.php";

?>
<script>
   function fillStars(element){
        var filledStars = Array.from(element.parentNode.children).indexOf(element) + 1;
        var totalRate = document.getElementById('totalRate_' + element.dataset.feedbackId); // Total rate element

        // Display filled stars
        for (var i = 0; i < filledStars; i++) {
            element.parentNode.children[i].src = 'images/star-48.png';
        }
        // Display empty stars
        for (var i = filledStars; i < 5; i++) {
            element.parentNode.children[i].src = 'images/star-48-empty.png';
        }

        totalRate.textContent = filledStars; // Update total rate text
    }
</script>

