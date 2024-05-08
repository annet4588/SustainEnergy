<?php
include_once 'header.php';

include_once "classes/dbh.classes.php";
include_once "classes/purchasehistory.classes.php";
include_once "classes/purchasehistory-contr.classes.php";

include_once "classes/profileinfo.classes.php";
include_once "classes/profileinfo-contr.classes.php";
include_once "classes/profileinfo-view.classes.php";

include_once "classes/certificate.classes.php";
include_once "classes/certificate-contr.classes.php";

include_once "classes/subsriptioninfo.classes.php";
include_once "classes/subscriptioninfo-contr.classes.php";

// Display success message inside a card
echo '<div class="container text-center mt-4" style="min-height: 100vh;">';
echo '<h3 class="text-center">Shopping cart</h3>';
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pay_subscription'])){
     // Getting data from the POST request from shoppingCart page
     $userId = $_SESSION['userid'];
     $userUid = $_SESSION['useruid'];
     $subId = $_SESSION['subid'];
     if (isset($_SESSION['gcid'])) {
        $gcid = $_SESSION['gcid'];
    }else{
        $gcid='';
    }
   
     // Sanitising data
     $purchaseDate = date('Y-m-d');
     $shortfallScore = isset($_POST["total_score"]) ? $_POST["total_score"] : ''; // Retrieve total_score from $_POST array
     $voucherAmount = isset($_POST["voucher_amount"]) ? $_POST["voucher_amount"] : ''; // Retrieve voucher_amount from $_POST array
     $paymentMethod = isset($_POST["payment_method"]) ? $_POST["payment_method"] : '';
 
     $profileStatus = 'Active';

    //Get Subscription ID
    $subscriptionContr = new SubscriptionContr($userId, $purchaseDate);
    $subId = $subscriptionContr->fetchSubscriptionID($userId);

     try{
         // Create an instance of PurchaseHistoryContr
         $purchaseHistoryContr = new PurchaseHistoryContr($userId, $subId,$gcid, $purchaseDate, $shortfallScore, $voucherAmount, $paymentMethod);
         // Record the purchaseHistory
         $purchaseHistoryContr->processPurchaseHistory();

        
        //  var_dump($subId, $gcid, $userId, $purchaseDate);
 
         //Profile status
         $profileInfo = new ProfileInfoContr($userId, $userUid);
         $profileInfo->updateProfileStatus($profileStatus, $userId);

         echo '<div class="row justify-content-center p-3">';
         echo '<div class="col-md-8">';
         echo '<div class="card mt-3">';
         echo '<div class="card-body">';
         echo '<h5 class="card-title text-center">Your Order</h5>';
         echo '<div class="text-center">';
         echo '<div class="alert alert-success" role="alert">';
         echo '<p>Your order has been placed successfully.</p>';
         echo '<p>Thank you for ordering with us! You can see your order in Purchase History inside your Profile.</p>';
         echo '</div>';
         echo '</div>';
         echo '</div>';
         echo '</div>';
         echo '</div>';
         echo '</div>';
     
    } catch (Exception $e) {
        // Handle any exceptions here
        echo "An error occurred: " . $e->getMessage();
    }
    echo '</div>';
    
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST'&& isset($_POST['pay_greencalc'])) {

    // Getting data from the POST request from shoppingCart page
    $userId = $_SESSION['userid'];
    $gcid = $_SESSION['gcid'];
    $subId = isset($_POST['subid']) ? $_POST['subid'] : (isset($_SESSION['subid']) ? $_SESSION['subid'] : null);
    
    // Sanitising data
    $purchaseDate = date('Y-m-d');
    $shortfallScore = isset($_POST["total_score"]) ? $_POST["total_score"] : ''; // Retrieve total_score from $_POST array
    $voucherAmount = isset($_POST["voucher_amount"]) ? $_POST["voucher_amount"] : ''; // Retrieve voucher_amount from $_POST array
    $paymentMethod = isset($_POST["payment_method"]) ? $_POST["payment_method"] : '';

    // Certificatedata
    $completionDate = date('Y-m-d');
    $certificateType = 'Silver';
    $approvedBy = 'John Piperras';
    $certificateImg = 'certificateBCS.png';

    // Create an instance of ProfileView to get Company name
    $profileInfo = new ProfileInfoView();
    // Get the name of the company
    $companyName = $profileInfo->fetchCompanyName($userId);

    try {
        // Create an instance of PurchaseHistoryContr
        $purchaseHistoryContr = new PurchaseHistoryContr($userId, $subId,$gcid, $purchaseDate, $shortfallScore, $voucherAmount, $paymentMethod);
        // Record the purchaseHistory
        $purchaseHistoryContr->processPurchaseHistory();
        // var_dump($userId, $subId,$gcid, $purchaseDate, $shortfallScore, $voucherAmount, $paymentMethod);

        // var_dump($gcid);
        // Debugging
        // var_dump($userId, $companyName, $completionDate, $certificateType, $approvedBy, $certificateImg);
        // var_dump($gcid, $userId, $purchaseDate, $shortfallScore, $voucherAmount, $paymentMethod);

        // Create an instance of CertificateContr to record Certificate
        $certificateContr = new CertificateContr($userId, $companyName, $completionDate, $certificateType, $approvedBy, $certificateImg);
        $certificateContr->processCertificate();


        echo '<div class="row justify-content-center p-3">';
        echo '<div class="col-md-8">';
        echo '<div class="card mt-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title text-center">Your Order</h5>';
        echo '<div class="text-center">';
        echo '<div class="alert alert-success" role="alert">';
        echo '<p>Your order has been placed successfully.</p>';
        echo '<p>Thank you for ordering with us! You can see your order in Purchase History inside your Profile.</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';


    } catch (Exception $e) {
        // Handle any exceptions here
        echo "An error occurred: " . $e->getMessage();
    }
    echo '</div>';
    
} else {
    echo '<div class="row justify-content-center">';
    echo '<div class="col-md-12">';
    echo '<div class="card mb-3 custom-card">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">Placed Orders</h5>';
    echo '<p>No Placed Order</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

include_once "footer.php";

