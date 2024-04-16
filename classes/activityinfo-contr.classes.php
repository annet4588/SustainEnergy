<?php

class ActivityInfoContr extends ActivityInfo{

  private $activityId;
    
  //Constructor
  public function __construct($activityId){
      $this->activityId = $activityId;
  }

  //Method that includes the default Activity info 
  public function defaultActivityInfo(){
      $activityImg = "../activityImg/img_default.png";
      $activityName = "Activity Name";
      $activityDescription = "Activity Description";
      $activityBenefit = "Activity Benefit";
      $this->setActivityInfo($activityImg, $activityName, $activityDescription, $activityBenefit, $this->activityId);
      
  }

  public function updateActivityInfo($activityImg, $activityName, $activityDescription, $activityBenefit){
      try {
          // Check for empty input fields
          $this->validateInput($activityImg, $activityName, $activityDescription, $activityBenefit);
          
          // Update activity
          $this->setNewActivityInfo($activityImg, $activityName, $activityDescription, $activityBenefit, $this->activityId);
      } catch (Exception $e) {
          // Handle the exception
          header("location: ../activitysettings.php?error=" . urlencode($e->getMessage()));
          exit();
      }
  }

  // Method to validate input fields
  private function validateInput($activityImg, $activityName, $activityDescription, $activityBenefit){
      if (empty($activityImg) || empty($activityName) || empty($activityDescription) || empty($activityBenefit)) {
          throw new Exception("Please fill in all fields.");
      }
  }

  //Method to get the user ID
  public function fetchSelectedActivityInfo($activityId){
    $activityId = $this->getSelectedActivityInfo($activityId);
        return $activityId[0]["activity_id"];
    }
  
}