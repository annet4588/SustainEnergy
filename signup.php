<?php
ob_start(); // Start output buffering
include_once "header.php";

//Instantiate classes
require_once "classes/dbh.classes.php";
include "classes/signup.classes.php";
include "classes/signup-contr.classes.php";

$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    try {
        //Getting data from the POST request
        $uid = htmlspecialchars($_POST["uid"], ENT_QUOTES, 'UTF-8');
        $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8');
        $pwdRepeat = htmlspecialchars($_POST["pwdrepeat"], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');

        // Create a SignupContr object to handle signup
        $signup = new SignupContr($uid, $pwd, $pwdRepeat, $email);

        // Process signup
        $signup->processSignup();

        // Get any errors from the signup process
        $errors = $signup->getErrors();

        if (empty($errors)) {
            // If there are no errors, proceed with other signup-related tasks

            // Grab the user ID from signup
            $userId = $signup->fetchUserId($uid);

            // Include and instantiate the ProfileInfoContr class
            include "classes/profileinfo.classes.php";
            include "classes/profileinfo-contr.classes.php";

            // Create profile Object and set default profile info
            $profileInfo = new ProfileInfoContr($userId, $uid);
            $profileInfo->setDefaultProfileInfo();

            // Redirect to the front page with no errors
            header("location: index.php?message=registered");
            exit();
        }
    } catch (Exception $e) {
        // Redirect to the front page with the appropriate error message
        $errorMessage = $e->getMessage();
    }
}
?>

<body class="d-flex flex-column vh-100"> 
<main class="login-container mt-5 pb-5 flex-grow-1" style="background-image: url('images/nature1.jpg');">
    <div class="container d-flex justify-content-center align-items-start" style="min-height: 100vh; width: 400px">
        <div class="card card card-login p-3" style="margin-top:50px">
            <div class="card-body m-3">
                <h5 class="card-title">Create an Account</h5>
                <?php  // Check if there are any errors
                if (!empty($errors)) {
                    echo '<div class="alert alert-danger">';
                    foreach($errors as $error) {
                        echo htmlspecialchars($error) . '<br>';
                    }
                    echo '</div>';
                }
                ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="uid" name="uid" placeholder="Enter username" value="<?php echo isset($uid) ? htmlspecialchars($uid) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Create password">
                    </div>
                    <div class="form-group pb-3">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="pwdrepeat" name="pwdrepeat" placeholder="Confirm password" >
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                </form>
                <?php 
                if(isset($_GET["newpwd"])){
                    if($_GET["newpwd"]=="passwordupdated"){
                        echo '<p class="signupsuccess">Your password has been reset!</p>';
                    }
                }?>
                <div class="mt-3 text-center">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
<?php
include_once "footer.php";
ob_end_flush(); // Flush the output buffer
