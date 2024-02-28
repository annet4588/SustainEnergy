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

    //Instantiate classes
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    //Create signup Object
    $signup = new SignupContr($uid, $pwd, $pwdRepeat, $email);

    //Running error handling
    $signup->processSignup();

    // Grab the method from the signup-contr.classes.php
    $userId = $signup->fetchUserId($uid); // pass the username(uid)

    // Instantiate the ProfileInfoContr class
    include "../classes/profileinfo.classes.php";
    include "../classes/profileinfo-contr.classes.php";
    
    // Create profile Object
    $profileInfo = new ProfileInfoContr($userId, $uid);
    $profileInfo->defaultProfileInfo();

    // Going back to the front page
    header("location: ../index.php?error=none");

}