<?php

class ActivityInfoContr extends ActivityInfo{

    private $activityId;
    
    //Constructor
    public function __construct($activityId){
        $this->activityId = $activityId;
    }

    //Method that includes the default Activity info 
    public function defaultActivityInfo(){
        $activityImg = "";
        $activityName = "";
        $activityDescription = "";
        $activityBenefit = "";
        $this->setActivityInfo($activityImg, $activityName, $activityDescription, $activityBenefit, $this->activityId);
        
    }
}