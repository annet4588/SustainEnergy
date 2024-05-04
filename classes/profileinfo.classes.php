<?php

class ProfileInfo extends Dbh{

    //Method to get a profile info
    public function getProfileInfo($userId) {
        $stmt = $this->getConnection()->prepare('SELECT profile_title, profile_status, company_name, first_name, last_name, users_email, phone_number, join_date FROM profiles WHERE users_id = ?');
        
        if (!$stmt->execute([$userId])) {
            throw new Exception("Failed to fetch profile information.");
        }

        $profileData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$profileData) {
            throw new Exception("Profile not found.");
        }
        
        return $profileData;
    }

    //Method to get all profiles
    public function getAllProfiles(){
       //Prepare the SQL statement
       $stmt = $this->getConnection()->prepare('SELECT * FROM profiles');
       try{
        $stmt->execute();
       }catch(PDOException $e){
        echo "Error: " .$e->getMessage();
        exit();
       }
       //Fetch all profiles
       $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
       //Close statement
       $stmt = null;

       //Return array of profiles
       return $profiles;
    }
  
    //Method to get profile ID
    public function getProfileId($profileId){
         // Prepare the SQL statement
         $stmt = $this->getConnection()->prepare('SELECT profiles_id FROM profiles WHERE users_id=?');
        
         try {
             // Attempt to execute the SQL statement
             $stmt->execute(array($profileId));
         } catch (PDOException $e) {
             // Handle PDO exceptions
             throw new Exception("Database error: " . $e->getMessage());
         }
         // If no results found
        if ($stmt->rowCount() == 0) {
            // Handle the case where no profile IDs are found
            return null; // or handle differently as per your application logic
        }
         // Fetch the result
         $profileIdInfo = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
         // Close the statement
         $stmt = null;
     
         // Return the fetched purchaseHistory IDs
         return  $profileIdInfo;
    }

    //Method to create a profile
    public function createProfile($profileTitle, $profileStatus, $companyName, $firstName, $lastName, $email, $phoneNumber, $joinDate, $userId) {
        $stmt = $this->getConnection()->prepare('INSERT INTO profiles (profile_title, profile_status, company_name, first_name, last_name, users_email, phone_number, join_date, users_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        
        if (!$stmt->execute([$profileTitle, $profileStatus, $companyName, $firstName, $lastName, $email, $phoneNumber, $joinDate, $userId])) {
            throw new Exception("Failed to create profile.");
        }
    }

    //Method to update Profile
    public function updateProfile($userId, $profileTitle, $profileStatus, $companyName, $firstName, $lastName, $email, $phoneNumber, $joinDate) {
        $stmt = $this->getConnection()->prepare('UPDATE profiles SET profile_title=?, profile_status=?, company_name=?, first_name=?, last_name=?, users_email=?, phone_number=?, join_date=? WHERE users_id=?');
    
        if (!$stmt->execute([$profileTitle, $profileStatus, $companyName, $firstName, $lastName, $email, $phoneNumber, $joinDate, $userId])) {
            throw new Exception("Failed to update profile.");
        }
    }
    
    

    //Method to update profile title
    public function updateProfileTitle($profileTitle, $userId){
        $stmt = $this->getConnection()->prepare('UPDATE profiles SET profile_title=? WHERE users_id=?');
        if(!$stmt->execute([$profileTitle, $userId])){
         throw new Exception("Failed to update profile status.");
        }
     }
    //Method to update profile Status info
    public function updateProfileStatus($profileStatus, $userId){
       $stmt = $this->getConnection()->prepare('UPDATE profiles SET profile_status=? WHERE users_id=?');
       if(!$stmt->execute([$profileStatus, $userId])){
        throw new Exception("Failed to update profile status.");
       }
    }
    //Methods to update profile individual fields
    public function updateCompanyName($companyName, $userId) {
        $stmt = $this->getConnection()->prepare('UPDATE profiles SET company_name=? WHERE users_id=?');
        
        if (!$stmt->execute([$companyName, $userId])) {
            throw new Exception("Failed to update company name.");
        }
    }

    public function updateFirstName($firstName, $userId) {
        $stmt = $this->getConnection()->prepare('UPDATE profiles SET first_name=? WHERE users_id=?');
        
        if (!$stmt->execute([$firstName, $userId])) {
            throw new Exception("Failed to update first name.");
        }
    }

    public function updateLastName($lastName, $userId) {
        $stmt = $this->getConnection()->prepare('UPDATE profiles SET last_name=? WHERE users_id=?');
        
        if (!$stmt->execute([$lastName, $userId])) {
            throw new Exception("Failed to update last name.");
        }
    }

    public function updateEmail($email, $userId) {
        $stmt = $this->getConnection()->prepare('UPDATE profiles SET users_email=? WHERE users_id=?');
        
        if (!$stmt->execute([$email, $userId])) {
            throw new Exception("Failed to update email.");
        }
    }

    public function updatePhoneNumber($phoneNumber, $userId) {
        $stmt = $this->getConnection()->prepare('UPDATE profiles SET phone_number=? WHERE users_id=?');
        
        if (!$stmt->execute([$phoneNumber, $userId])) {
            throw new Exception("Failed to update phone number.");
        }
    }

    public function updateJoinDate($joinDate, $userId) {
        $stmt = $this->getConnection()->prepare('UPDATE profiles SET join_date=? WHERE users_id=?');
        
        if (!$stmt->execute([$joinDate, $userId])) {
            throw new Exception("Failed to update join date.");
        }
    }
   
}


//Model Class talks to the database
    
