<?php
session_start();

if($_SERVER['REQUEST_METHOD']=='POST'){

     // Check if $_SESSION is set and not empty
     if (!isset($_SESSION['userid']) || !isset($_SESSION['useruid'])) {
        // Handle the case where $_SESSION is not set or empty
        header("location: ../login.php?error=session");
        exit();
    }

    $userId = $_SESSION['userid'];
    $uid = $_SESSION['useruid'];
    $companyName = htmlspecialchars($_POST['company_name'], ENT_QUOTES, 'UTF-8');
    $firstName = htmlspecialchars($_POST['first_name'], ENT_QUOTES, 'UTF-8');
    $lastName = htmlspecialchars($_POST['last_name'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $phoneNumber = htmlspecialchars($_POST['phone_number'], ENT_QUOTES, 'UTF-8');
    
    // Fetch current date
    $joinDate = date('Y-m-d'); // Format: YYYY-MM-DD

    //Access to classes
    include_once "../classes/dbh.classes.php";
    include_once "../classes/profileinfo.classes.php";
    include_once "../classes/profileinfo-contr.classes.php"; //We are changing data so need controller class
    $profileInfo = new ProfileInfoContr($userId, $uid);
    
    $profileInfo->updateProfileInfo($userId,$companyName, $firstName, $lastName, $email, $phoneNumber, $joinDate);

    header("location: ../profile.php?error=none");
    exit();
}

