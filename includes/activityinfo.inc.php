<?php
require "../classes/dbh.classes.php";

if($_SERVER['REQUEST_METHOD']=='POST'){

    //Clear previous Activity data
   if(isset($_SESSION['selected_activity_id'])){
    unset($_SESSION['selected_activity_id']);
   }
    

   //Check if activity_id provided in the query
   if(isset($_GET['activity_id'])){
    $selected_activity_id = $_GET['activity_id'];

    $activityInfo = new ActivityInfoView();
    //Query to get Activity
    $activityInfo->fetchActivityId();

   }

}