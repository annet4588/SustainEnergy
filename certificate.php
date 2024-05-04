<?php
include_once 'header.php';

echo '<div class="container text-center mt-4" style="min-height: 100vh;">';
echo '<h3 class="text-center mt-4 p-3">Achievements</h3>';

include_once "classes/dbh.classes.php";
include_once "classes/certificate.classes.php";
include_once "classes/certificate-view.classes.php";

$certificateInfo = new CertificateView();
$userId = $_SESSION['userid'] ?? null;


try {
    $certificates = $certificateInfo->fetchCertificate($userId);

    
    echo'<div class="row justify-content-center">';
    if (!empty($certificates)) {
        foreach ($certificates as $certificate) {
            echo '<div class="col-md-6 p-3 text-center">';
            echo '<div class="card mt-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">SustainEnergy Certificate</h5>';
            echo '<div class="alert alert-success" role="alert">';
            echo '<h5 class="mt-2">Completed By:</h5>';
            echo '<p>' . $certificate['completed_by'] . '</p>';
            echo '<h5 class="mt-2">Completion Date:</h5>';
            echo '<p>' . $certificate['completion_date'] . '</p>';
            echo '<h5 class="mt-2">Certificate Type:</h5>';
            echo '<p>' . $certificate['certificate_type'] . '</p>';
            echo '<h5 class="mt-2">Approved By:</h5>';
            echo '<p>' . $certificate['approved_by'] . '</p>';
            echo '<h5 class="mt-2">Certificate ID:</h5>';
            echo '<p>' . $certificate['certificate_id'] . '</p>';
            echo '<h5 class="mt-2"></h5>';
            echo '<img  style="width:150px; height:150px;" src="images/' . $certificate['certificate_img'] . '">';
            echo '<h5 class="text-center p-3">Everyone is a Winner!</h5>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="col-md-12">';
        echo '<div class="card mt-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title text-center">Your Certificate</h5>';
        echo '<div class="text-center">';
        echo '<div class="alert alert-success" role="alert">';
        echo '<p>No Certificate found.</p>'; 
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';
    echo '</div>';

} catch (Exception $e) {
    // Handle exceptions
    echo '<div class="row justify-content-center p-3">';
    echo '<div class="col-md-8">';
    echo '<div class="card mt-3">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title text-center">Your Certificate</h5>';
    echo '<div class="text-center">';
    echo '<div class="alert alert-success" role="alert">';
    echo '<p>No Certificate found</p>'; 
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
}
echo '</div>'; 
echo '</div>';

include_once "footer.php";


// <div class="container-fluid mt-4">
//     <h4 class="text-center">My Cetificate</h4>
//     <div class="row justify-content-center p-3">
//         <div class="col-md-6">
//             <div class="card border border-success">
//                 <div class="card-body">
//                     <h5 class="card-title text-center">SustainEnergy Certificate</h5>
//                     <div class="text-center">
//                         <div class="card-body profile-content">
//                             <!-- Content of the purchaseHistory card -->
//                             <h5 class="mt-4">Completed by</h5> 
//                             <p class="certificate-info">Company Name</p>
//                             <h5 class="mt-4">Date of Completion</h5>
//                             <p class="certificate-info">April 1, 2024</p>
//                             <h5 class="mt-4">Certificate Type</h5>
//                             <p class="certificate-info">Green Energy</p>
//                             <h5 class="mt-4">Approved by</h5>
//                             <p class="certificate-info">John Piperras</p>
//                             <h5 class="mt-4">Certificate ID</h5>
//                             <p class="certificate-info">123456789  <img class="certificate-img" src="images/certificateBCS.png"></p>
//                         </div> 
//                     </div>
//                 </div>
//             </div>
//         </div>
//     </div>
// </div>

            

