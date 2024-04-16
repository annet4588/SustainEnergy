<?php

class ActivityInfo extends Dbh{

    //Method to get All Activity Info *
    protected function getActivityInfo($activityId){
        try {
            $stmt = $this->getConnection()->prepare('SELECT * FROM activity WHERE activity_id=?');
            if(!$stmt->execute(array($activityId))){
                throw new Exception("Statement execution failed.");
            }
            if($stmt->rowCount()==0){
                throw new Exception("Activity not found.");
            }
            
            //Get Activity data from query
            $activityData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Start session 
            // session_start();
            
            // Set activity_id session variable
            // $_SESSION['activity_id'] = $activityData['activity_id'];

            return $activityData;
        } catch (Exception $e) {
            // Handle exceptions
            throw new Exception("Failed to fetch activity info: " . $e->getMessage());
        }
    }
    //Method to get Activity Object
    protected function getActivityObject(){
        $query = $this->getConnection()->query('SELECT * FROM activity');

        while($r = $query->fetch(PDO::FETCH_OBJ)){
            return  $r;
        }
    }
    //Method to get Single Activity ID
    protected function getActivityById($activityId){
        $stmt = $this->getConnection()->prepare('SELECT * FROM activity WHERE activity_id=?');
        $activitySingleId = $stmt->execute(array($activityId));

        $activitySingleId= $stmt->fetch(PDO::FETCH_ASSOC);
        return $activitySingleId;
    }

    //Method to get Activity Ids from database
    protected function getActivityIds(){
        try {
            $stmt = $this->getConnection()->query ('SELECT activity_id FROM activity');
            $activityId =$stmt->fetchAll(PDO::FETCH_COLUMN); //Get all ID Columns
            return $activityId;
        } catch (Exception $e) {
            // Handle exceptions
            throw new Exception("Failed to fetch activity IDs: " . $e->getMessage());
        }
    }

    //Method to get Activity ID from database
    protected function getActivityId($activityId){
        try {
            $stmt = $this->getConnection()->prepare('SELECT * FROM activity');
            $stmt->execute(array($activityId));

            //Fetch activity id
            $activity = $stmt->fetchAll(PDO::FETCH_COLUMN); 

            // Start session and set session variables
            session_start();
            $_SESSION['activityID'] = $activity['activity_id'];

        } catch (Exception $e) {
            // Handle exceptions
            throw new Exception("Failed to fetch activity IDs: " . $e->getMessage());
        }
    }
    //Method to update Activity Info
    protected function setNewActivityInfo($activityImg, $activityName,$activityDescription, $activityBenefit, $activityId){
        try {
            $stmt = $this->getConnection()->prepare('UPDATE activity SET activity_img=?, activity_name=?, activity_description=?, activity_benefit=? WHERE activity_id=?');

            if(!$stmt->execute(array($activityImg,$activityName, $activityDescription, $activityBenefit, $activityId))){
                throw new Exception("Statement execution failed.");
            }
        } catch (Exception $e) {
            // Handle exceptions
            throw new Exception("Failed to update activity info: " . $e->getMessage());
        } finally {
            // Close statement
            $stmt = null;
        }
    }

    //Method to insert Activity Info inside database
    protected function setActivityInfo($activityImg, $activityName,$activityDescription, $activityBenefit){
        try {
            $stmt = $this->getConnection()->prepare('INSERT INTO activity (activity_img, activity_name, activity_description, activity_benefit) VALUES (?, ?, ?, ?)');

            if(!$stmt->execute(array($activityImg, $activityName, $activityDescription, $activityBenefit))){
                throw new Exception("Statement execution failed.");
            }
        } catch (Exception $e) {
            // Handle exceptions
            throw new Exception("Failed to insert activity info: " . $e->getMessage());
        } finally {
            // Close statement
            $stmt = null;
        }
    }

    //Method to get selected Activity Info
    protected function getSelectedActivityInfo($activityId){
        try{
            $stmt = $this->getConnection()->prepare('SELECT activity_id, activity_name, activity_img FROM activity WHERE activity_id =?');
           
           if(!$stmt->execute(array($activityId))){
           throw new Exception("Statement execution failed.");
        }
        if($stmt->rowCount()==0){
            throw new Exception("Activity not found.");
        }
            //Get the selected activity from query
        $selectedActivities = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $selectedActivities;
        }catch(Exception $e){
          throw new Exception("Failed to fetch activity IDs: " . $e->getMessage());
        }
        
    }
    
}