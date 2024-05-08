<?php
require_once "header.php";
require_once "classes/dbh.classes.php";
require_once "classes/signup.classes.php";
require_once "classes/signup-contr.classes.php";

require_once "classes/profileinfo.classes.php";
require_once "classes/profileinfo-view.classes.php";
require_once "classes/profileinfo-contr.classes.php";

// Check if the userId is set in the POST request
if(isset($_POST['userId'])) {
    // Retrieve the userId
    $userId = $_POST['userId']; //User's ID once clciked View button
    // var_dump($userId);  

    // Now you can use $userId to fetch the user's profile information from the database
    $profileInfoContr = new ProfileInfoContr(null, null);
    $profiles = $profileInfoContr->fetchAllProfiles();
    // var_dump($profiles);

    //Profile correspnding userId
    $profileData = null;
    foreach($profiles as $profile){
        if($profile['users_id'] == $userId){
            //Found profile
            $profileData = $profile;
            break;
        }
    }
   //var_dump($profileData);

    // Retrieve individual profile data
    // Now $profileData contains the profile information for the user with the specified ID
    if ($profileData !== null) {
        // Retrieve individual profile data
        $profileId = $profileData['profiles_id'];
        $profileTitle = $profileData['profile_title'];
        $profileStatus = $profileData['profile_status'];
        $companyName = $profileData['company_name'];
        $firstName = $profileData['first_name'];
        $lastName = $profileData['last_name'];
        $email = $profileData['users_email'];
        $phoneNumber = $profileData['phone_number'];
        $joinDate = $profileData['join_date'];

        // Use these variables as needed
    } else {
        // Profile not found for the specified user ID
        echo "Profile not found for user with ID: $userId";
    }

    //Request method on Update to update the related field in the form and record in the database
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["update_profile"])){

        // Sanitise and validate form inputs
        $userId = isset($_POST['userId']) ? filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT) : null;
        $profileTitle = isset($_POST['profile_title']) ? filter_var($_POST['profile_title']) : null;
        $profileStatus = isset($_POST['profile_status']) ? filter_var($_POST['profile_status']) : null;
        $companyName = isset($_POST['company_name']) ? filter_var($_POST['company_name']) : null;
        $firstName = isset($_POST['first_name']) ? filter_var($_POST['first_name'],) : null;
        $lastName = isset($_POST['last_name']) ? filter_var($_POST['last_name']) : null;
        $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : null;
        $phoneNumber = isset($_POST['phone_number']) ? filter_var($_POST['phone_number']) : null;
        $joinDate = isset($_POST['join_date']) ? $_POST['join_date'] : null; 
        

        
        $profileInfoContr->updateUserProfileInfo($userId,$profileTitle, $profileStatus, $companyName, $firstName, $lastName, $email, $phoneNumber, $joinDate);
    }   
}

?>

<body>
<div class="container mt-4 pt-3 vh-100">
    <h3>User Profile</h3>
    <h5>User ID: <?php echo $userId?></h5>

    <!-- Profile Update Form -->
    <form method="POST" action="">
        <!-- Include a hidden input field for the profile ID -->
        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
        <div class="form-group">
            <label for="profile_title">Profile Title</label>
            <input type="text" class="form-control" id="profile_title" name="profile_title" placeholder="Enter Profile Title" value="<?php echo $profileTitle;?>">
        </div>
        <div class="form-group">
            <label for="profile_status">Profile Status</label>
            <input type="text" class="form-control" id="profile_status" name="profile_status" placeholder="Enter Profile Status" value="<?php echo $profileStatus;?>">
        </div>
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
            <input type="text" class="form-control" id="join_date" name="join_date" value="<?php echo $joinDate; ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-outline-success mt-3" name="update_profile">Update Profile</button>
        </div>
    </form>
</div>
</body>
<?php include_once "footer.php"; ?>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    }
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    h3 {
        text-align: center;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    tr:hover {
        background-color: #f2f2f2;
    }
    button {
        padding: 8px 12px;
        border: none;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }
</style>