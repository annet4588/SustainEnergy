<?php
include_once 'header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     //Getting data from the POST request from GreenCalc page
     $userId = $_SESSION['userid'];

     include_once "../classes/dbh.classes.php";
     include_once "../classes/certificate.classes.php";
     include_once "../classes/certificate-contr.classes.php";

     // Certificate data
    $completionDate = date('Y-m-d');
    $certificateType = 'Gold';
    $approvedBy = 'John Piperras';
    $certificateImg = 'certificateBCS.png';

    include_once "../classes/profileinfo.classes.php";
    include_once "../classes/profileinfo-contr.classes.php";
    include_once "../classes/profileinfo-view.classes.php";

    // Create an instance of ProfileView to get Company name
    $profileInfo = new ProfileInfoView();
    // Get the name of the company
    $companyName = $profileInfo->fetchCompanyName($userId);

    try{
         // Create an instance of CertificateContr to record Certificate
         $certificateContr = new CertificateContr($userId, $companyName, $completionDate, $certificateType, $approvedBy, $certificateImg);
         $certificateContr->processCertificate();
 
         // Display success message inside a card
         echo '<div class="container mt-4">';
         echo '<h3 class="text-center">Certificate</h3>';
         echo '</div>';
         echo '<div class="row justify-content-center p-3">';
         echo '<div class="col-md-8">';
         echo '<div class="card mt-3">';
         echo '<div class="card-body">';
         echo '<h5 class="card-title text-center">Your Order</h5>';
         echo '<div class="text-center">';
         echo '<div class="alert alert-success" role="alert">';
         echo '<p>Your Certificate has been recorded successfully.</p>';
         echo '<p>Thank you for taken part! You can see your Certificate in Achievments inside your Profile.</p>';
         echo '</div>';
         echo '</div>';
         echo '</div>';
         echo '</div>';
         echo '</div>';
         echo '</div>';
 
    }catch (Exception $e) {
        // Handle any exceptions here
        echo "An error occurred: " . $e->getMessage();
    }
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


