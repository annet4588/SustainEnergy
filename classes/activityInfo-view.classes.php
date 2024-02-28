<?php

class ActivityInfoView extends ActivityInfo{

    public function fetchActivityId(){
        $activityInfo = $this->getActivityIds();
        return $activityInfo;

    }
    public function fetchActivityImage($activityId){
        $activityInfo=$this->getActivityInfo($activityId);
        //Array with images
        return $activityInfo[0]["activity_img"];
    }
    public function fetchActivityName($activityId){
        $activityInfo = $this->getActivityInfo($activityId);
        //Dimential array with first element and column name from db
        return $activityInfo[0]["activity_name"];
    }
    public function fetchActivityDescription($activityId){
        $activityInfo = $this->getActivityInfo($activityId);
        //Dimential array with first element and column name from db
        return $activityInfo[0]["activity_description"];
    }
    public function fetchActivityBenefit($activityId){
        $activityInfo = $this->getActivityInfo($activityId);
        //Dimential array with first element and column name from db
        return $activityInfo[0]["activity_benefit"];
    }
}
