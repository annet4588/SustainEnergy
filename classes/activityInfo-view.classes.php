<?php

class ActivityInfoView extends ActivityInfo{

    //Method to get All Activity Info *
    public function fetchActivityDetails($activityId){
        try {
            $activityInfo = $this->getActivityInfo($activityId);
            return $activityInfo[0];
        } catch (Exception $e) {
            // Handle the exception
            return array(); // Return an empty array or handle the error as needed
        }
    }
    //Method to get  Activity Info id
    public function fetchActivityId(){
        try{
            $activityInfo = $this->getActivityIds();
            return $activityInfo;
        }catch(Exception $e){
            // Handle the exception
            return array('error' => 'An error occurred while fetching activity IDs: ' . $e->getMessage());
        }
    }

    //Method to get Single Activity ID
    public function fetchSingleActivityById($activityId){
        try{
            $activityInfo = $this->getActivityById($activityId);
            return $activityInfo;

        }catch(Exception $e){
            throw new Exception("Error: " .$e->getMessage());
        }
    }

    public function fetchActivityImage($activityId){
        try {
            $activityInfo = $this->getActivityInfo($activityId);
              // Check if activity info is empty
              if(empty($activityInfo)) {
                return array('error' => 'Activity with ID ' . $activityId . ' not found.');
            }
            return $activityInfo[0]["activity_img"];
        } catch (Exception $e) {
            // Handle the exception
            return array('error' => 'An error occurred while fetching activity image: ' . $e->getMessage());
        }
    }
    public function fetchActivityName($activityId){
        try {
            $activityInfo = $this->getActivityInfo($activityId);
            return $activityInfo[0]["activity_name"];
        } catch (Exception $e) {
            // Handle the exception
            return array('error' => 'An error occurred while fetching activity name: ' . $e->getMessage());
        }
    }
    public function fetchActivityDescription($activityId){
        try {
            $activityInfo = $this->getActivityInfo($activityId);
             // Check if activity info is empty
             if(empty($activityInfo)) {
                return array('error' => 'Activity with ID ' . $activityId . ' not found.');
            }
             //Dimential array with first element and column name from db
             return $activityInfo[0]["activity_description"];
            } catch (Exception $e) {
        } catch (Exception $e) {
            // Handle the exception
            return array('error' => 'An error occurred while fetching activity description: ' . $e->getMessage());
        }
    }

    public function fetchActivityBenefit($activityId){
        try {
            $activityInfo = $this->getActivityInfo($activityId);
            // Check if activity info is empty
            if(empty($activityInfo)) {
                return array('error' => 'Activity with ID ' . $activityId . ' not found.');
            }
            return $activityInfo[0]["activity_benefit"];
        } catch (Exception $e) {
            // Handle the exception
            return null; // Return null or handle the error as needed
        }
    }

    public function fetchSelectedActivityInfo($activityId){
        try{
            // Get selected activity information
            $activityInfo = $this->getSelectedActivityInfo($activityId);
            
            // Return the fetched activity information
            return $activityInfo;
        } catch (Exception $e) {
            // Handle exceptions
            // You can log the error or perform any other actions required
            // For now, we'll re-throw the exception
            throw new Exception("Failed to fetch selected activity info: " . $e->getMessage());
        }
    }

    //Method to fetch Activity Object
    public function fetchActivityObject(){
        $activityInfo = $this->getActivityObject();
        return $activityInfo;
    }
}
