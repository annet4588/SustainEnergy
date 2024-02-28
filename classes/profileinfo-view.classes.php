<?php

class ProfileInfoView extends ProfileInfo{
    
    public function fetchAbout($userId){
      $profileInfo = $this->getProfileInfo($userId);
      //Grab the dimential array with the first element and the column name from the database you need to get details from
      echo $profileInfo[0]["profiles_about"];
    }
    public function fetchTitle($userId){
        $profileInfo = $this->getProfileInfo($userId);
        //Grab the dimential array with the first element and the column name from the database you need to get details from
        echo $profileInfo[0]["profiles_introtitle"];
      }
      public function fetchText($userId){
        $profileInfo = $this->getProfileInfo($userId);
        //Grab the dimential array with the first element and the column name from the database you need to get details from
        echo $profileInfo[0]["profiles_introtext"];
      }
}


//The View Class talks to the Model Class