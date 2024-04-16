<?php
//Handle input from the user
class ProfileInfoContr extends ProfileInfo{
    
    private $userId;
    private $userUid;


    //Create the contsruct method that asigns data to these fields inside our class. Inside we want to tell what kind of data we want to pass to this constractor
   //Pass the userId and (the username) userUid
 
   public function __construct($userId, $userUid) {
       $this->userId = $userId;
       $this->userUid = $userUid;
   }


    //Create method that includes some default info once the user has just signed up
    public function setDefaultProfileInfo() {
        $profileTitle = $this->userUid;
        $profileStatus = "Inactive";
        $companyName = "Your Company Name goes here";
        $firstName = "";
        $lastName = "";
        $email = "";
        $phoneNumber = "";
        $joinDate = "";
        
        $this->createProfile($profileTitle, $profileStatus, $companyName, $firstName, $lastName, $email, $phoneNumber, $joinDate, $this->userId);
    }
    

    //Create method to update the actual infor when the user types the new info for each field
   
    public function updateProfileInfo($userId,$companyName, $firstName, $lastName, $email, $phoneNumber, $joinDate) {
 
        // Update individual fields only if they are not null
        if ($companyName !== null) {
            $this->updateCompanyName($companyName, $userId);
        }
        if ($firstName !== null) {
            $this->updateFirstName($firstName, $userId);
        }
        if ($lastName !== null) {
            $this->updateLastName($lastName, $userId);
        }
        if ($email !== null) {
            $this->updateEmail($email, $userId);
        }
        if ($phoneNumber !== null) {
            $this->updatePhoneNumber($phoneNumber, $userId);
        }
        if ($joinDate !== null) {
            $this->updateJoinDate($joinDate,$userId);
        }
    }
    
    // Method to check for empty input fields
    private function emptyInputCheck($companyName, $firstName, $lastName, $email, $phoneNumber, $joinDate) {
        return empty($companyName) || empty($firstName) || empty($lastName) || empty($email) || empty($phoneNumber) || empty($joinDate);
    }

    //Method to update profile Status once subscibed 
    public function updateProfileStatus($profileStatus, $userId){
        $this->updateProfileStatusInfo($profileStatus,$userId);
    }

}

//The Controller class which handles user's input from the user inside the Website
//This class is going to talk to our Model Class 