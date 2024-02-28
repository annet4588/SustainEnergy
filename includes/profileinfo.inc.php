<?php

session_start();

if($_SERVER['REQUEST_METHOD']=='POST'){

    $id = $_SESSION['userid'];
    $uid = $_SESSION['useruid'];
    $about = htmlspecialchars($_POST['about'], ENT_QUOTES, 'UTF-8');
    $introTitle = htmlspecialchars($_POST['introtitle'], ENT_QUOTES, 'UTF-8');
    $introText = htmlspecialchars($_POST['introtext'], ENT_QUOTES, 'UTF-8');

    //Access to classes
    include_once "../classes/dbh.classes.php";
    include_once "../classes/profileinfo.classes.php";
    include_once "../classes/profileinfo-contr.classes.php"; //We are changing data so need controller class
    $profileInfo = new ProfileInfoContr($id, $uid);
    
    $profileInfo->updateProfileInfo($about, $introTitle, $introText);

    header("location: ../profile.php?error=none");
}