<?php
//Handle input from the user
class ProfileInfoContr extends ProfileInfo{
    
    private $userId;
    private $userUid;


    //Create the contsruct method that asigns data to these fields inside our class. Inside we want to tell what kind of data we want to pass to this constractor
   //Pass the userId and (the username) userUid
   public function __construct($userId, $userUid){
    $this->userId = $userId;
    $this->userUid = $userUid;
   }

    //Create method that includes some default info once the user has just signed up
    public function defaultProfileInfo(){
        $profileAbout = "Text about the user";
        $profileTitle = "Hi! I'm " . $this->userUid;
        $profileText = "Text about the user";
        $this->setProfileInfo($profileAbout, $profileTitle, $profileText, 
        $this->userId);
    }

    //Create method to update the actual infor when the user types the new info
    public function updateProfileInfo($about, $introTitle, $introText){
        //Error handlers
        if($this->emptyInputCheck($about, $introTitle, $introText) == true){
            header("location: ../profilesettings.php?error=emptyinput");
            exit();
        }
        //You can create another check for a Certain number character the user use or Sanitizing 
        //..
        //Update profile info
        $this->setNewProfileInfo($about, $introTitle, $introText, $this->userId);
       
    }

    //Checks if the input is empty. The reason its private as it's only this particular class is going to use it
    private function emptyInputCheck($about, $introTitle, $introText){
        $result = false;
        if(empty($about) || empty($introTitle) || empty($introText)){
          $result = true;
        }else{
            $result=false;
        }
        return $result;
    }   

}

//The Controller class which handles user's input from the user inside the Website
//This class is going to talk to our Model Class 