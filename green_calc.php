<?php
include_once 'header.php';
include_once "classes/dbh.classes.php";
include_once "classes/activityinfo.classes.php";
include_once "classes/activityinfo-contr.classes.php";
include_once "classes/activityinfo-view.classes.php";

include_once "classes/green_calc.classes.php";
include_once "classes/green_calc_contr.classes.php";
include_once "classes/green_calc_view.classes.php";

include_once "classes/subsriptioninfo.classes.php";
include_once "classes/subscriptioninfo-contr.classes.php";
include_once "classes/subscriptioninfo-view.classes.php";

$activityInfo = new ActivityInfoView();
// Initialize variables
$totalScore = '0';
$voucherAmount = '0';
$subId = '';
if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];
}
if (isset($_SESSION['subid'])) {
    $subId = $_SESSION['subid'];
}

// Initialize $_SESSION['green_calc'] as an empty array if not set
if (!isset($_SESSION['green_calc'])) {
    $_SESSION['green_calc'] = array();
}

// Check if the selected activity is received and update the session
if (isset($_POST['activity_id'])) {
    $selected_activity_id = $_POST['activity_id'];

    // Check if the activity ID is valid and not already chosen
    if ($selected_activity_id > 0 && (!isset($_SESSION['green_calc'][$selected_activity_id]))) {
        // Check if the count of activities is less than 10
        if (count($_SESSION['green_calc']) < 10) {
            $activityDetails = $activityInfo->fetchActivityDetails($selected_activity_id);
            $_SESSION['green_calc'][$selected_activity_id] = $activityDetails;

            // Check if all 10 activities are chosen after adding the new activity
            if (count($_SESSION['green_calc']) == 10) {
                echo '<div class="alert alert-info m-3">
                <p>You have chosen all 10 activities. Thank you!</p>
                <p>Please Proceed to the Step 2 to Select Score!</p>
                </div>';
            }
        } else {
            echo '<div class="alert alert-danger m-3">
            <p>You have already chosen the maximum number of activities.</p>
            <p>Please Proceed to the Step 2 to Select Score!</p>
            </div>';
        }
    } else {
        echo '<div class="alert alert-danger m-3">
        <p>The selected activity is already chosen.</p>
        <p>Please choose another activity.</p>
        </div>';
    }
}

// Check if the activity_id is received for deletion
if (isset($_POST['delete_activity_id'])) {
    $delete_activity_id = $_POST['delete_activity_id'];

    // Check if the activity exists in the session
    if (isset($_SESSION['green_calc'][$delete_activity_id])) {
        // If the activity exists, unset it from the session
        unset($_SESSION['green_calc'][$delete_activity_id]);
    }
}

if (count($_SESSION['green_calc']) == 10) {
    // If all activities are chosen, enable the select boxes
    echo "<script>";
    echo "document.querySelectorAll('select[name=\"select-box\"]').forEach(function(selectElement) {";
    echo "selectElement.disabled = false;";
    echo "});";
    echo "</script>";
}

// Check the session for activity details
$activities_in_green_calc = isset($_SESSION['green_calc']) ? $_SESSION['green_calc'] : array();
?>

<body class="d-flex flex-column vh-100">
    <main class="flex-grow-1">
        <section class="center-card">
            <div class="container-fluid">
                <h3 class="text-center">Green Calculator</h3>
                <div class="card profile-bg profile-card p-3">
                    <div class="alert alert-success" role="alert">
                        <h5>How to take part in Green Activities:</h5>
                        <p>1. Choose 10 Green Activities - use ADD button to add them to the List, DELETE button will remove Activities from the List.</p>
                        <p>2. Once all 10 Activities chosen - Select Score - for each Activity to find our if you reached the Goal - 100 Points!</p>
                        <p>3. Once all 10 Activities marked - Total Score will be calculated. If 100 Points achieved, you can see Certificate - click on the button - Certificate!</p>
                        <p>4. Don't worry if you did not achieve the Goal from the first time, as you can donate to purchase voucher to get the remaining Points and still receive Certificate - click on the button - Donate!</p>
                    </div>
                </div>
                <div class="row d-flex p-3">
                    <!-- Left Column for Activity Name Cards -->
                    <div class="col-md-12 col-lg-6">
                        <!-- Card Group for Activity Name -->
                        <div class="row">

                            <?php foreach ($activities_in_green_calc as $activity_id => $activity) : ?>
                                <div class="col-md-6 d-flex p-3">
                                    <div class="card card-login profile-bg profile-card">
                                        <div class="card-body profile-content text-center">
                                            
                                        <!-- Display added activity card -->
                                            <select name="select-box" class="form-select" onchange="changeColour(this, <?php echo $activity_id; ?>)">
                                                <option name="default" value="0">Select Score</option>
                                                <option name="five-score" value="5" style="background-color: darkred">5% Score</option>
                                                <option name="ten-score" value="10" style="background-color: green">10% Score</option>
                                            </select>
                                            <img style="width:100px; height: 100px;" src="activityImg/<?php echo $activity['activity_img']; ?>" class="img-fluid rounded-circle mt-3" alt="Activity Image">
                                            <h6 class="card-title mt-3"><?php echo $activity['activity_name']; ?></h6>
                                            <form action="activity.php" method="POST"> <!-- Changed action to activity.php -->
                                                <input type="hidden" name="activity_id" value="<?php echo $activity_id; ?>">
                                                <button type="submit" class="btn btn-outline-success btn-sm add-btn" name="add_activity">ADD</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm del-btn" onclick="deleteActivity(<?php echo $activity_id; ?>)">DELETE</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php for ($i = count($activities_in_green_calc); $i < 10; $i++) : ?>
                                <div class="col-md-6 d-flex p-3">
                                    <div class="card card-login profile-bg profile-card">
                                        <div class="card-body profile-content text-center">
                                            
                                        <!-- Display default activity card -->
                                            <select name="select-box" class="form-select" onchange="changeColour(this, <?php echo $i; ?>)" disabled>
                                                <option name="default" value="0">Select Score</option>
                                                <option name="five-score" value="5" style="background-color: darkred">5% Score</option>
                                                <option name="ten-score" value="10" style="background-color: green">10% Score</option>
                                            </select>
                                            <img style="width:100px; height: 100px;" src="activityImg/img_default.png" class="img-fluid rounded-circle mt-3" alt="Default Activity Image">
                                            <h6 class="card-title mt-3">Default Activity Name</h6>
                                            <form id="addForm<?php echo $i; ?>" method="POST">
                                                <input type="hidden" name="activity_id" value="<?php echo $i; ?>">
                                                <input type="hidden" id="hiddenActivityId<?php echo $i; ?>" name="hidden_activity_id" value="">
                                                <button type="button" class="btn btn-outline-success btn-sm add-btn" name="add_activity" onclick="addActivity(<?php echo $i; ?>)">ADD</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm del-btn" onclick="deleteActivity(<?php echo $i; ?>)">DELETE</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                            <?php var_dump($activities_in_green_calc) ?>
                        </div>
                    </div>

                    <!-- Right Column for Display Card with Total Score and Voucher Option-->
                    <div class="col-md-12 col-lg-6">
                        <!-- Total Card -->
                        <div class="col-md-12 d-flex p-3">
                            <div class="card profile-bg profile-card">
                                <div class="card-body profile-content">
                                    <!-- Content of the display card -->
                                    <form id="certificateForm" action="certificate_recorded.php" method="POST">
                                        <h4>Total Score</h4>
                                        <p>If 100 Points achieved - see Your Certificate!</p>
                                        <!-- Input element to display the total score -->
                                        <input type="text" id="certificateTotalScore" name="cert_total_score" value="<?php echo $totalScore ?>" readonly>
                                        <button id="certificateBtn" type="button" class="btn btn-outline-success" onclick="validateBeforeProceed()">Certificate</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Voucher Card -->
                        <div class="col-md-12 d-flex p-3">
                            <div class="card profile-bg profile-card">
                                <div class="card-body profile-content">
                                    <!-- Content of the voucher card -->
                                    <form id="voucherForm" action="shopping_cart.php" method="POST">
                                        <h4>Voucher</h4>
                                        <p>Not achieved 100 Points? </p>
                                        <p>Donate and Receive Certificate!</p>
                                        <!-- Input element to display the voucher -->
                                        <input type="hidden" id="subid" name="subid" value="<?php echo $subId ?>" readonly>
                                        <input type="hidden" id="totalScore" name="total_score" value="<?php echo $totalScore ?>" readonly>
                                        <input type="text" id="voucherAmount" name="voucher_amount" value="<?php echo $voucherAmount ?>" readonly>
                                        <button id="donateBtn" type="button" class="btn btn-outline-success" name="donateBtn" onclick="validateBeforeProceed()">Donate</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
<?php
include_once "footer.php";
?>


<!-- Include Bootstrap JS and jQuery -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    //Function to add activity to the page
    function addActivity(activityId) {
        // Get the activity_id
        var activityIdValue = document.getElementById('hiddenActivityId' + activityId).value;
        // Redirect to activity.php with activity_id as URL parameter
        window.location.href = 'activity.php?activity_id=' + activityIdValue;
    }
    //Function to delete activity from the page
    function deleteActivity(activityId) {
        if (confirm("Are you sure you want to delete this activity?")) {
            // Set the delete_activity_id to be sent to server for deletion
            var deleteActivityForm = document.createElement('form');
            deleteActivityForm.method = 'POST';
            deleteActivityForm.action = 'green_calc.php'; // The same page
            var deleteActivityInput = document.createElement('input');
            deleteActivityInput.type = 'hidden';
            deleteActivityInput.name = 'delete_activity_id';
            deleteActivityInput.value = activityId;
            deleteActivityForm.appendChild(deleteActivityInput);
            document.body.appendChild(deleteActivityForm);
            deleteActivityForm.submit();
        }
    }
</script>

<script>
    //Function to change the colour for the points
    function changeColour(selectElement, activityId) {
        var selectedScore = selectElement.value;
        // Change the background color of the select box based on the selected score
        if (selectedScore == '5') {
            selectElement.style.backgroundColor = 'darkred';
        } else if (selectedScore == '10') {
            selectElement.style.backgroundColor = 'green';
        } else {
            selectElement.style.backgroundColor = ''; // Reset to default
        }
        calculateTotalScore(); // Recalculate total score
    }

    function calculateTotalScore() {
        var totalScore = 0;
        var allScoresSelected = true; // Flag to check if all scores are selected
        // Loop through each select box and sum up the selected scores
        document.querySelectorAll('select[name="select-box"]').forEach(function(selectElement) {
            totalScore += parseInt(selectElement.value);

            // Check if any score is not selected (value = 0)
            if (selectElement.value == 0) {
                allScoresSelected = false;
            }
        });
        // Update the value of the total score input element
        document.getElementById('certificateTotalScore').value = totalScore;
        document.getElementById('totalScore').value = totalScore; // Update the hidden input to pass the totalScore value


        //Calculate voucher ammount
        var maxScore = 100;
        var remainingScore = maxScore - totalScore;
        var voucherAmount = remainingScore > 0 ? remainingScore : 0;
        document.getElementById('voucherAmount').value = voucherAmount;

    }

    function validateBeforeProceed() {
        // Get the value of total_score input field
        var totalScore = document.getElementById('certificateTotalScore').value;
        // Check if all scores are selected
        var allScoresSelected = true;
        document.querySelectorAll('select[name="select-box"]').forEach(function(selectElement) {
            if (selectElement.value == 0) {
                allScoresSelected = false;
            }
        });

        // If all scores are selected
        if (allScoresSelected) {
            // If total score is 100
            if (totalScore == 100) {
                // Determine which button was clicked
                var btnClicked = event.target.id;
                if (btnClicked === 'certificateBtn') {
                    // Redirect to certificate_recorded page to display a success message 
                    document.getElementById('certificateForm').action = "certificate_recorded.php";
                    document.getElementById('certificateForm').submit();
                } else if (btnClicked === 'donateBtn') {
                    // Display message that 100 mark is reached
                    alert("You have already reached the 100 mark. You don't need to donate.");
                }
            } else {
                // If total score is not 100
                // Determine which button was clicked
                var btnClicked = event.target.id;
                if (btnClicked === 'certificateBtn') {
                    // Display message that total score needs to reach 100
                    alert("You need to reach a total score of 100 to get the certificate. You can donate by clicking on the Donate button.");
                } else if (btnClicked === 'donateBtn') {
                    // Redirect to shopping cart
                    document.getElementById('voucherForm').action = "shopping_cart.php";
                    document.getElementById('voucherForm').submit();
                }
            }
        } else {
            // Notify the user to select scores for all activities
            alert("Please select scores for all activities before proceeding.");
        }
    }
</script>