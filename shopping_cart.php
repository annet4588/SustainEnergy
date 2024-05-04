<?php
include_once 'header.php';

    //Access to the classes in order to grab info
    include_once "classes/dbh.classes.php";
    include_once "classes/profileinfo.classes.php";
    include_once "classes/profileinfo-contr.classes.php";
    include_once "classes/profileinfo-view.classes.php";

    include_once "classes/subsriptioninfo.classes.php";
    include_once "classes/subscriptioninfo-contr.classes.php";
    include_once "classes/subscriptioninfo-view.classes.php";
    

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subscribe'])){ //post subscribe from Profile page

    $userId = $_SESSION['userid'];
    $userUid = $_SESSION['useruid'];
    $profileStatus = 'Inactive';
    $voucherAmount = 99.00;
    $subscriptionDate = date("Y-m-d");
    // $totalScore = 'Sub1';
    // $gcid = 2;
    // Instantiate ProfileInfoContr class to retrieve profile data
    $profileInfoContr = new ProfileInfoContr($userId, $userUid);

    //Instance Subscription class
    $subscriptionContr = new SubscriptionContr($userId, $subscriptionDate);
    $subscriptionContr->processSubscription();

     //Grab the subscription id
     $subscriptionView = new SubscriptionView();
     $subId = $subscriptionView->fetchSubscriptionSingleId($userId);
     $_SESSION['subid'] = $subId;

    //Get Subscription ID
    // $subId = $subscriptionContr->fetchSubscriptionID($userId);

//    var_dump($userId, $userUid, $subId);
   
//    var_dump($subId);
    // Retrieve individual profile data  
    $profileInfoContr->updateProfileStatus($profileStatus, $userId);
    

    // Display the title and form
    echo '<div class="container mt-4 pb-3 vh-100" >'; // Moved here
    echo '<h3 class="text-center p-3">Shopping cart</h3>';
    echo '<div class="row justify-content-center p-3">';
    echo '<div class="col-md-8">';
    echo '<div class="card mt-3">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title text-center">Your Order</h5>';
    echo '<div class="alert alert-success" role="alert  text-center">';
    echo '<form id="purchaseForm" action="place_order.php" method="post">'; // Opening form tag
    echo '<div class="card-body profile-content">';
    echo '<h5 class= "mt-2">Subcription Amount</h5>';
    
    // Input element to display the voucher
    echo '<input type="hidden" id="userid" name="userid" value="'.$userId.'" readonly>';
    echo '<input type="hidden" id="useruid" name="useruid" value="'.$userUid.'" readonly>';
    echo '<input type="hidden" id="sbid" name="sbid" value="'.$subId.'" readonly>';
    // echo '<input type="hidden" id="gcid" name="gcid" value="'.$gcid.'" readonly>';
    echo '<input type="hidden" id="profilestatus" name="profilestatus" value="'.$profileStatus.'" readonly>';
    // echo '<input type="hidden" id="totalScore" name="total_score" value="'.$totalScore.'" readonly>';
    echo '<input type="text" id="voucherAmount" name="voucher_amount" value="'.$voucherAmount .'" readonly style="border: none;">';
    echo '<h5 class= "mt-2">Payment Date</h5>';
    echo '<input type="text" id="createdAt" name="created_at" value="'.$subscriptionDate .'" readonly style="border: none;">';
    // Payment preferences
    echo '<h5 class="mt-2">Payment Preferences</h5>';
    echo '<p>Choose your payment method:</p>';
    echo '<h5 class= "mt-2">Payment Method</h5>';
    echo '<div class="d-flex">'; // Flexbox styling to center the select box
    echo '<select id="payment_method" name="payment_method" class="form-select form-control" style="width: auto;">';
    echo '<option value="credit card">Credit Card</option>';
    echo '<option value="paypal">PayPal</option>';
    echo '</select>';
    echo '</div>'; // End of flexbox container
    // Additional payment details based on the selected payment method
    // For example, if credit_card is selected, display credit card fields
    // If paypal is selected, display PayPal login button or fields
    // Form submission button
    echo '<button type="submit" class="btn btn-outline-success mt-3" name="pay_subscription">Pay</button>';
    echo '</div>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';


}
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    //Getting data from the POST request from GreenCalc page
    $userId = $_SESSION['userid'];
   
    if (isset($_SESSION['gcid'])) {
        $gcid = $_SESSION['gcid'];
    }
   //Grab the subscription id
   $subscriptionView = new SubscriptionView();
   $subId = $subscriptionView->fetchSubscriptionSingleId($userId);
   $_SESSION['subid'] = $subId;
  
    //Sanitising data
    $totalScore = isset($_POST["total_score"]) ? $_POST["total_score"] : ''; // Retrieve total_score from $_POST array
    $voucherAmount = isset($_POST["voucher_amount"]) ? $_POST["voucher_amount"] : ''; // Retrieve voucher_amount from $_POST array
    $createdAt = date('Y-m-d');

    include_once "classes/dbh.classes.php";
    include_once "classes/green_calc.classes.php";
    include_once "classes/green_calc_contr.classes.php";
    include_once "classes/green_calc_view.classes.php";

    try {
        // Create an instance of GreenCalcContr
        $greenCalcContr = new GreenCalcContr($userId, $totalScore, $voucherAmount, $createdAt);

        // Set the GreenCalc information 
        $greenCalcContr->processGreenCalcInfo();

        //Grab the greecCalc id
        $greenCalcInfo = new GreenCalcView();
        $gcid = $greenCalcInfo->fetchGreenCalcSingleId($userId);
        $_SESSION['gcid'] = $gcid;

        // var_dump($subId);
        // var_dump($gcid);

        // Display the title and form
        echo '<h3 class="text-center p-3">Shopping cart</h3>';
        echo '<div class="row justify-content-center p-3 vh-100">';
        echo '<div class="col-md-8">';
        echo '<div class="card mt-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title text-center">Your Order</h5>';
        echo '<div class="alert alert-success" role="alert  text-center">';
        echo '<form id="purchaseForm" action="place_order.php" method="post">'; // Opening form tag
        echo '<div class="card-body profile-content">';
        echo '<h5 class= "mt-2">Voucher Amount</h5>';
        
        // Input element to display the voucher
        echo '<input type="hidden" id="sbid" name="sbid" value="'.$subId.'" readonly>';
        echo '<input type="hidden" id="gcid" name="gcid" value="'. $_SESSION['gcid'].'" readonly>';
        echo '<input type="hidden" id="totalScore" name="total_score" value="'.$totalScore.'" readonly>';
        echo '<input type="text" id="voucherAmount" name="voucher_amount" value="'.$voucherAmount .'" readonly style="border: none;">';
        echo '<h5 class= "mt-2">Payment Date</h5>';
        echo '<input type="text" id="createdAt" name="created_at" value="'.$createdAt .'" readonly style="border: none;">';
        // Payment preferences
        echo '<h5 class="mt-2">Payment Preferences</h5>';
        echo '<p>Choose your payment method:</p>';
        echo '<h5 class= "mt-2">Payment Method</h5>';
        echo '<div class="d-flex">'; // Flexbox styling to center the select box
        echo '<select id="payment_method" name="payment_method" class="form-select form-control" style="width: auto;">';
        echo '<option value="credit card">Credit Card</option>';
        echo '<option value="paypal">PayPal</option>';
        echo '</select>';
        echo '</div>'; // End of flexbox container
        // Additional payment details based on the selected payment method
        // For example, if credit_card is selected, display credit card fields
        // If paypal is selected, display PayPal login button or fields
        // Form submission button
        echo '<button type="submit" class="btn btn-outline-success mt-3" name="pay_greencalc">Pay</button>';
        echo '</div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

    } catch (Exception $e) {
        // Handle any exceptions here
        echo '<div class="container mt-4">';
        echo '<div class="alert alert-danger">';
        echo 'An error occurred: ' . $e->getMessage();
        echo '</div>';
        echo '</div>';
    }
} else {
    // If there's no POST request
    echo '<div class="container mt-4" style="height: 100vh;">'; // Moved here
    echo '<h3 class="text-center p-3">Shopping cart</h3>';
    echo '<div class="row justify-content-center">';
    echo '<div class="col-md-12">';
    echo '<div class="card mb-3 custom-card">';
    echo '<div class="card-body">';
    echo '<div class="text-center">';
    echo '<div class="alert alert-success" role="alert">';
    echo '<h5 class="card-title text-center">Your Shopping Basket</h5>';
    echo '<p>Your Shopping Basket is empty</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

include_once "footer.php";

