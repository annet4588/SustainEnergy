<?php

class ActivityInfo extends Dbh{

    //Method to get Activity Info
    protected function getActivityInfo($activityId){
        $stmt = $this->getConnection()->prepare('SELECT * FROM activity WHERE activity_id=?');
        if(!$stmt->execute(array($activityId))){
            $stmt=null;
            header("location: activity.php?error=stmtfailed");
            exit();
        }
        if($stmt->rowCount()==0){
            $stmt=null;
            header("location: activity.php?error=activitynot found");
            exit();
        }

        //Get Activity data from query
        $activityData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $activityData;
    }

    //Method to get Activity Ids from database
    protected function getActivityIds(){
       $stmt = $this->getConnection()->query ('SELECT activity_id FROM activity');
       return $stmt->fetchAll(PDO::FETCH_COLUMN); //Get all ID Columns
    }

    //Method to update Activity Info
    protected function setNewActivityInfo($activityImg, $activityName,$activityDescription, $activityBenefit, $activityId){
        $stmt = $this->getConnection()->prepare('UPDATE activity SET activity_img=?, activity_name=?, activity_description=?, activity_benefit=? WHERE activity_id=?');

        if(!$stmt->execute(array($activityName, $activityDescription, $activityBenefit, $activityId))){
           $stmt=null;
           header("location: activity.php?error=stmtfailed");
           exit();
        }
        //Close statement
        $stmt=null;
    }

    //Method to insert Activity Info inside database
    protected function setActivityInfo($activityImg, $activityName,$activityDescription, $activityBenefit, $activityId){
        $stmt = $this->getConnection()->prepare('INSERT INTO activity (activity_img, activity_name, activity_description, activity_benefit, activity_id) VALUES (?, ?, ?, ?)');


        if(!$stmt->execute(array($activityImg, $activityName, $activityDescription, $activityBenefit, $activityId))){
            $stmt=null;
            header("location: activity.php?error=stmtfailed");
            exit();
        }
        $stmt=null;
    }
}