<?php
include_once "header.php";

// Check if $_SESSION is set and not empty
if (!isset($_SESSION['userid']) || !isset($_SESSION['useruid'])) {
    // Handle the case where $_SESSION is not set or empty
    header("location: ../login.php?error=session");
    exit();
}
//Access to the classes in order to grab info
include_once "classes/dbh.classes.php";
include_once "classes/profileinfo.classes.php";
include_once "classes/profileinfo-contr.classes.php";
include_once "classes/profileinfo-view.classes.php";

include_once "classes/subsriptioninfo.classes.php";
include_once "classes/subscriptioninfo-contr.classes.php";
include_once "classes/subscriptioninfo-view.classes.php";

$profileInfo = new ProfileInfoView();

// Instantiate ProfileInfoContr class to retrieve profile data
$profileInfoContr = new ProfileInfoContr($_SESSION['userid'], $_SESSION['useruid']);

// Fetch profile information
$profileData = $profileInfoContr->getProfileInfo($_SESSION['userid']);

// var_dump($profileData);

// Retrieve individual profile data
$profileStatus = $profileData['profile_status'] ?? '';
$companyName = $profileData['company_name'] ?? '';
$firstName = $profileData['first_name'] ?? '';
$lastName = $profileData['last_name'] ?? '';
$email = $profileData['email'] ?? '';
$phoneNumber = $profileData['phone_number'] ?? '';
$joinDate = $profileData['join_date'] ?? '';

//Assign userid session to a variable
$userId = $_SESSION['userid'];

//Instance SubscriptionView class to get subscription id
$subscriptionView = new SubscriptionView();
$subId = $subscriptionView->fetchSubscriptionSingleId($userId);

// Check if $subId is null before using it
if ($subId !== null) {
    // $subId is not null, proceed with using it
    // Your existing code that relies on $subId can go here
} else {
    // $subId is null, handle this case gracefully
    // For example, you can provide a default value or skip processing
    // Here's an example of providing a default value:
    $subId = null; // Assuming 0 indicates no subscription
}

if(isset($_SESSION['subid'])){
    $subId = $_SESSION['subid'];
}
// Check if the user is subscribed
$isSubscribed = $profileStatus === 'Active';

//Ckeck if the user is Blocked
$isUserBlocked = $profileStatus === 'Blocked';

// Retrieve current date
$currentDate = date('Y-m-d');
// var_dump($subId);

//Instance of SubscriptionContr
$subscriptionContr = new SubscriptionContr($userId, $subId);

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userid'])&& isset($_POST['subid'])){
    $userIdToRemove = $_POST['userid'];
    $subIdToRemove = $_POST['subid'];
    
    //
    $subscriptionContr->deleteSubscription($userId, $subId);
}?>
<body class="d-flex flex-column vh-100">
  <main class="flex-grow-1">
  <div class="p-3 text-center">
        <h3>Profile</h3>
    </div>
    <section class="center-card">
        <div class="row d-flex p-3">
            <!-- First Card (Left) -->
            <div class="col-md-12 col-lg-6 d-flex p-3">
                <div class="card profile-bg profile-card" id="profile-card">
                <div class="card-body profile-info" id="profile-body">  
                    <img class="rounded-circle" src="activityImg/img_default.png">
                    <h4 class="px-4 py-2 m-4"><?php echo $_SESSION["useruid"] ?></h4>
                    <form method="POST" action="shopping_cart.php">
                    <div class="form-group">
                    <label for="profile_status">Company status</label>
                        <input type="text" class="form-control" name="profile_status" readonly value="<?php echo $profileStatus;?>" />
                        <!-- Disable the button if user is Subscribed or Blocked-->
                        <button type="submit" class="btn btn-outline-success mt-3" name="subscribe" <?php if($isSubscribed || $isUserBlocked) echo 'disabled'; ?>>
                            <?php echo $isSubscribed ? 'Subscribed' : ($isUserBlocked ? 'Blocked' : 'Subscribe'); ?>
                        </button>
                        <form id="unsubscribeForm" method="POST" action="unsubscribe.php">
                            <input type="hidden" name="userid" value="<?php echo $userId; ?>">
                            <input type="hidden" name="subid" id="subid" value="<?php echo $subId; ?>">
                            <button type="button" class="btn btn-outline-success mt-3" name="unsubscribeBtn" onclick="unsubscribe(event, <?php echo $subId; ?>)" <?php if(!$isSubscribed) echo 'disabled';?>><?php echo $isSubscribed ? 'Unsubscribe' : ($isUserBlocked ? 'Blocked' : 'Unsubscribe'); ?></button>
                        </form>
                        </div>


                     <!-- Profile Update Form -->
                    <form method="POST" action="includes/profileinfo.inc.php">
                        <!-- Include a hidden input field for the profile ID -->
                        <input type="hidden" name="profiles_id" value="<?php echo $profileId; ?>">
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name" value="<?php echo $companyName;?>">
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="<?php echo $firstName;?>">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="<?php echo $lastName;?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Update Email" value="<?php echo $email;?>">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number" value="<?php echo $phoneNumber;?>">
                        </div>
                        <div class="form-group">
                            <label for="join_date">Date Registered</label>
                            <input type="text" class="form-control" id="join_date" name="join_date" value="<?php echo $currentDate; ?>">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-success mt-3" name="update_profile" <?php if($isUserBlocked) echo 'disabled'; ?>>Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

            <!-- Two Cards Aligned Above Each Other (Right) -->
            <div class="col-md-12 col-lg-6">
                <!-- First Card -->
                <div class="col-md-10 d-flex p-3">
                    <div class="card profile-bg profile-card" id="profile-card">
                        <div class="card-body profile-content" id="profile-body">
                            <!-- Content of the second card goes here -->
                            <h4>Achievements</h4>
                            <h5>Certificates</h5>
                            <a href="certificate.php" type="submit" class="btn btn-outline-success <?php if($isUserBlocked) echo 'disabled'; ?>">View</a>
                        </div>
                    </div>
                </div>

                <!-- Second Card -->
                <div class="col-md-10 d-flex p-3">
                    <div class="card profile-bg profile-card" id="profile-card">
                        <div class="card-body profile-content" id="profile-body">
                            <!-- Content of the third card goes here -->
                            <h4>Payment</h4>
                            <h5>Cards</h5>                            
                            <a href="credit_card.php" type="submit" class="btn btn-outline-success <?php if($isUserBlocked) echo 'disabled'; ?>">Add Card</a>  
                            <a href="credit_card_added.php" type="submit" class="btn btn-outline-success <?php if($isUserBlocked) echo 'disabled'; ?>">View My Cards</a>                
                        </div>
                    </div>
                </div>
                 <!-- Third Card -->
                 <div class="col-md-10 d-flex p-3">
                    <div class="card profile-bg profile-card" id="profile-card">
                        <div class="card-body profile-content" id="profile-body">
                            <!-- Content of the third card goes here -->
                            <h4>History</h4>
                            <h5>Purchase</h5>
                            <a href="purchase_history.php" type="submit" class="btn btn-outline-success <?php if($isUserBlocked) echo 'disabled'; ?>">Go</a>
                        </div>
                    </div>
                </div>
                
               <!-- Admin Card Only visible to Admin-->
                <?php if(isset($_SESSION['useruid']) && $_SESSION['useruid'] === 'admin'): ?>
                    <div class="col-md-10 d-flex p-3">
                        <div class="card profile-bg profile-card" id="profile-card">
                            <div class="card-body profile-content" id="profile-body">
                                <!-- Content of the third card goes here -->
                                <h4>View Users</h4>
                                <h5>Delete Users</h5>
                                <a href="admin.php" type="submit" name="adminBtn" class="btn btn-outline-success">Go</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
</main>
 </body>
 </html>

 <?php
include_once "footer.php";?>

<!-- Include Bootstrap JS and jQuery -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
   
   // Function to handle unsubscribe
function unsubscribe(event, subId) {
    // Prevent the default behavior of the button click
    event.preventDefault();
    
    // Show confirmation dialog
    if (confirm('Are you sure you want to unsubscribe?')) {
        // Change the action of the form to unsubscribe.php
        document.getElementById('unsubscribeForm').action = "unsubscribe.php";
        
        // Update the value of the hidden input field
        document.getElementById('subid').value = subId;
        
        // Submit the form
        document.getElementById('unsubscribeForm').submit();
    } else {
        // If canceled, do nothing
        return;
    }
}
</script>    
    <style>
  #profile-card .center-card {
        display: flex;
        justify-content: center;
        align-items: center;
        /* height: 100vh; Adjust as needed */
    }

    #profile-card .card {
        width: 400px; /* Adjust as needed */
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        margin: 0 10px;
    }

    #profile-card .card:hover {
        transform: translateY(-5px);
    }

    #profile-cody.card-body {
        padding: 20px;
    }

    .profile-info {
        /* Existing styles for profile-info */
        width: 100%; /* Adjust as needed */
        margin-bottom: 10px; /* Add margin for separation */
    }

    .profile-content {
        /* Existing styles for profile-content */
        width: 100%; /* Adjust as needed */
        margin-bottom: 10px; /* Add margin for separation */
    }

    .profile-post {
        /* Existing styles for profile-post */
        width: 100%; /* Adjust as needed */
    }
    </style>

