<?php
include_once 'header.php';

// Display success message
echo '<div class="container text-center mt-4" style="min-height: 100vh;">';
echo '<h3 class="text-center">Achievments</h3>';

// Include necessary classes
include_once "classes/dbh.classes.php";
include_once "classes/certificate.classes.php";
include_once "classes/certificate-contr.classes.php";
include_once "classes/profileinfo.classes.php";
include_once "classes/profileinfo-contr.classes.php";
include_once "classes/profileinfo-view.classes.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Getting data from the POST request from GreenCalc page
        $userId = $_SESSION['userid'];

        // Certificate data
        $completionDate = date('Y-m-d');
        $certificateType = 'Gold';
        $approvedBy = 'John Piperras';
        $certificateImg = 'certificateBCS.png';

        // Get the company name
        $profileInfo = new ProfileInfoView();
        $companyName = $profileInfo->fetchCompanyName($userId);

        // Create an instance of CertificateContr to record Certificate
        $certificateContr = new CertificateContr($userId, $companyName, $completionDate, $certificateType, $approvedBy, $certificateImg);
        $certificateContr->processCertificate();

        var_dump($userId, $companyName, $completionDate, $certificateType, $approvedBy, $certificateImg);
      
        
        echo '<div class="row justify-content-center p-3">';
        echo '<div class="col-md-8">';
        echo '<div class="card mt-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title text-center">Your Certificate</h5>';
        echo '<div class="text-center">';
        echo '<div class="alert alert-success" role="alert">';
        echo '<p>Your Certificate has been recorded successfully.</p>';
        echo '<p>Thank you for taking part! You can see your Certificate in Achievements inside your Profile.</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } catch (Exception $e) {
        // Handle any exceptions
        echo '<div class="container mt-4">';
        echo '<div class="alert alert-danger">';
        echo 'An error occurred: ' . $e->getMessage();
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
} else {
    // Display message if no orders are placed
    echo '<div class="row justify-content-center">';
    echo '<div class="col-md-12">';
    echo '<div class="card mb-3 custom-card">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">Your Sertificate</h5>';
    echo '<p>No Certificate recorded</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
echo '</div>';
include_once "footer.php";