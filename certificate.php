<?php
include_once 'header.php';
?>
<html>
<head>
<title>SustainEnergy</title>
<!-- You can use Open Graph tags to customize link previews.
Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
<meta property="og:url"           content="http://localhost/sustainenergy/certificate.php" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="Your Website Title" />
<meta property="og:description"   content="Your description" />
<meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" />
</head>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v19.0" nonce="V86SXdpP"></script>

<?php
echo '<div class="container text-center mt-4" style="min-height: 100vh;">';
echo '<h3 class="text-center mt-4 p-3">Achievements</h3>';

include_once "classes/dbh.classes.php";
include_once "classes/certificate.classes.php";
include_once "classes/certificate-view.classes.php";

$certificateInfo = new CertificateView();
$userId = $_SESSION['userid'] ?? null;


try {
    $certificates = $certificateInfo->fetchCertificate($userId);

    
    echo'<div class="row container justify-content-center pb-3">';
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
        }?>


<!-- Your share button code -->
<div class="fb-share-button btn=lg" 
data-href="http://localhost/sustainenergy/certificate.php" 
data-layout="button" 
data-size="large">
<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%2Fsustainenergy%2Fcertificate.php&amp;src=sdkpreparse" 
class="fb-xfbml-parse-ignore">Share</a></div>

<?php echo '</div>';
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


            

