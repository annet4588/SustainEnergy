<?php
include_once "header.php";

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    // Redirect or handle the case where the user is not logged in
    echo "User not logged in";
    exit();
}else{
    $_SESSION['userid'] = $userId;
}

// Include necessary files and classes
include_once "classes/dbh.classes.php"; // Include database connection class
include_once "classes/subscriptioninfo.classes.php"; // Include subscription class

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the unsubscribe button was clicked
    if (isset($_POST["unsubscribe"])) {
        // Get user ID from session
        $userId = $_SESSION['userid'];

        // Instantiate Subscription class
        $subscription = new Subscription();

        // Delete the subscription
        $subscription->deleteSubscription($userId, $subId);

        // Unset the subscription ID from the session
        unset($_SESSION['subid']);

        // Provide a success message or handle the response as needed
        echo "Subscription successfully canceled";
    } else {
        // Handle invalid requests or missing parameters
        echo "Invalid request";
    }
} else {
    // Handle requests that are not POST
    echo "Only POST requests are allowed";
}

