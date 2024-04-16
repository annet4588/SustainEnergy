<?php
include_once 'header.php';

//Access to classes in orddeer to get info
include_once "classes/dbh.classes.php";
include_once "classes/activityinfo.classes.php";
include_once "classes/activityinfo-contr.classes.php";
include_once "classes/activityinfo-view.classes.php";
$activityInfo = new ActivityInfoView();
$activityIds = $activityInfo->fetchActivityId();


var_dump($activityIds);
// $activityObject = $activityInfo->fetchActivityObject();
// var_dump($activityObject);
?>

<body class="d-flex flex-column vh-100"> 
<main class="container mt-5 flex-grow-1">
    <div class="p-3">
        <h3>Activities</h3>
    </div>
    <section class="row justify-content-center">
        <?php    
        
        foreach($activityIds as $activityId):?>
        <div class="col-md-4 mb-4">
                <div class="card activity-bg activity-card" id="activity-card">
                    <div class="card-body activity-info"> <!-- Adjust height as needed -->
                       <form action="activityinfo.php" method="get"> 
                       <input type="hidden" name="activity_id" value="<?php echo $activityId;?>">
                        <!-- Hidden input to store the activity ID -->
                        <img src="activityImg/<?php echo $activityInfo->fetchActivityImage($activityId);?>" class="img-fluid" alt="Activity Image">
                        <h5 class="card-title mt-3">
                            <?php echo $activityInfo->fetchActivityName($activityId);?>
                        </h5>
                        <p class="card-description">
                            <?php echo $activityInfo->fetchActivityDescription($activityId) ?>
                        </p>
                        <div class="mt-3">
                        <div style="display: flex; justify-content: space-between;">
                        <button type="submit" class="btn btn-outline-success find-more-btn" data-activity-id="<?php echo $activityId; ?>">Find More</button>
                       
                       </div>
                        </div>
                       </form>
                    </div>
                </div>
            </div>
        <?php 
        endforeach ?>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</main>
</body>
<?php
include_once "footer.php";
?>
<style>
#activity-card .card-title {
    width: 200px; /* Adjust the width as needed */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; /* Adds ellipsis (...) when text overflows */
}
#activity-card .card-description {
    white-space: nowrap; /* Prevents the text from wrapping */
    overflow: hidden; /* Hides any overflowing text */
    text-overflow: ellipsis; /* Displays an ellipsis (...) to indicate truncated text */
}
</style>






<!-- .fixed-height-image {
    height: 300px; /* Adjust the height as needed */
    object-fit: cover; /* Ensure the image covers the entire container */
} -->
<!-- .card-body {
        height: 500px; /* Adjust the height as needed */
        overflow: hidden;
    } -->

<!-- .activity-img {
    width: 100%; /* Set width to 100% to make it flexible */
    height: auto; /* Allow height to adjust based on aspect ratio */
    max-width: 100%; /* Ensure image does not exceed its container's width */
} -->