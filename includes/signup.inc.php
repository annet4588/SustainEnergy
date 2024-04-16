<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //Getting data from the POST request
    $uid = $_POST['uid'];
    $pws = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdrepeat'];
    $email = $_POST['email'];


    //Sanitising data
    $uid = htmlspecialchars($_POST["uid"], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8');
    $pwdRepeat = htmlspecialchars($_POST["pwdrepeat"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');

    //Dump the values for debugging
    var_dump($uid, $pwd, $pwdRepeat, $email);
    var_dump($userId);

    //Instantiate classes
    require_once "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    try {
        // Create signup Object and process signup
        $signup = new SignupContr($uid, $pwd, $pwdRepeat, $email);
        $signup->processSignup();
        $errors = $signup->getErrors();

        if (!empty($errors)) {
            throw new Exception("Signup failed: " . implode(", ", $errors));
        }
        // Grab the user ID from signup
        $userId = $signup->fetchUserId($uid);

        // Include and instantiate the ProfileInfoContr class
        include "../classes/profileinfo.classes.php";
        include "../classes/profileinfo-contr.classes.php";
        
        // Create profile Object and set default profile info
        $profileInfo = new ProfileInfoContr($userId, $uid);
        $profileInfo->setDefaultProfileInfo();

        // Redirect to the front page with no errors
        header("location: ../index.php?message=registered");
        exit();
    } catch (Exception $e) {
        // Redirect to the front page with the appropriate error message
        header("location: ../index.php?error=" . $e->getMessage());
        exit();
    }

}