<?php
include_once "header.php";

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    // Redirect or handle the case where the user is not logged in
    echo "User not logged in";
    exit();
}
// Set the user ID from session
$userId = $_SESSION['userid'];

// Include necessary files and classes
include_once "classes/dbh.classes.php"; // Include database connection class
include_once "classes//subsriptioninfo.classes.php"; // Include subscription class
include_once "classes/subscriptioninfo-contr.classes.php"; // Include subscription class

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["unsubscribeBtn"])) {
    // Check if subid is set in the session
    if (!isset($_SESSION['subid'])) {
        // Handle the case where subid is not set
        echo "Subscription ID not found";
        exit();
    }

    // Get subscription ID from session
    $subId = $_SESSION['subid'];

    // Instantiate Subscription class
    //Instance of SubscriptionContr
   $subscriptionContr = new SubscriptionContr($userId, $subId);

    // Delete the subscription
  $subscriptionContr->removeSubscription($userId, $subId);

    if (isset($_SESION['subid'])) {
        // Unset the subscription ID from the session
        unset($_SESSION['subid']);

        // Provide a success message
        echo "Subscription successfully canceled";
    } else {
        // Handle errors if subscription deletion fails
        echo "Failed to cancel subscription";
    }
} else {
    // Handle requests that are not POST
    echo "Only POST requests are allowed";
}

include_once "footer.php";

