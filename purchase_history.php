<?php
include_once 'header.php';

// Display the title
echo '<div class="container mt-4" style="min-height: 100vh;">';
echo '<h3 class="text-center p-3">Purchase History</h3>';


// Display purchase history details using PurchaseHistoryView class
include_once "classes/dbh.classes.php";
include_once "classes/purchasehistory.classes.php";
include_once "classes/purchasehistory-view.classes.php";

// Fetch purchase history details using PurchaseHistoryView class
$purchaseHistoryInfo = new PurchaseHistoryView();
$userId = $_SESSION['userid'] ?? null;
if(isset($_SESSION['subid'])){
    $subId = $_SESSION['subid'];
}
if(isset($_SESSION['gcid'])){
    $gcid = $_SESSION['gcid'];
}
try {
    // Attempt to fetch purchase history for the user
    $purchaseHistoryIds = $purchaseHistoryInfo->fetchPurchaseHistory($userId);

    // Display each purchase history 
    echo '<div class="container">';
    echo '<div class="row justify-content-center">';

    if (!empty($purchaseHistoryIds)) {
        foreach ($purchaseHistoryIds as $purchase) {
            echo '<div class="col-md-6 p-3">';
            echo '<div class="card mt-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Your Purchase</h5>';
            echo '<div class="alert alert-success" role="alert">';
            echo '<h5 class="mt-2">Purchase ID:</h5>';
            echo '<p>' . $purchase['purchase_id'] . '</p>';
            // echo '<h5 class="mt-2">Shortfall Score:</h5>';
            // echo '<p>' . $purchase['shortfall_score'] . '</p>';
            echo '<h5 class="mt-2">Amount paid:</h5>';
            echo '<p> £' . $purchase['voucher_amount'] . '</p>';
            echo '<h5 class="mt-2">Payment Date:</h5>';
            echo '<p>' . $purchase['purchase_date'] . '</p>';
            echo '<h5 class="mt-2">Payment Method:</h5>';
            echo '<p>' . $purchase['payment_method'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        // Display a message if no purchases are made
        echo '<div class="col-md-12">';
        echo '<div class="card mt-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title text-center">Your Purchase</h5>';
        echo '<div class="text-center">';
        echo '<div class="alert alert-success" role="alert">';
        echo '<p>No Purchases made.</p>'; 
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

   

} catch (Exception $e) {
    // Handle exceptions
    echo '<div class="row justify-content-center p-3">';
    echo '<div class="col-md-8">';
    echo '<div class="card mt-3">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title text-center">Your Purchase</h5>';
    echo '<div class="text-center">';
    echo '<div class="alert alert-success" role="alert">';
    echo '<p>No purchase made.</p>'; 
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
echo '</div>'; // Close row div
echo '</div>'; // Close container div
echo '</div>';
include_once "footer.php";


