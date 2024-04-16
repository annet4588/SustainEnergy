<?php

class ProfileInfo extends Dbh{

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

    public function createProfile($profileTitle, $profileStatus, $companyName, $firstName, $lastName, $email, $phoneNumber, $joinDate, $userId) {
        $stmt = $this->getConnection()->prepare('INSERT INTO profiles (profile_title, profile_status, company_name, first_name, last_name, users_email, phone_number, join_date, users_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        
        if (!$stmt->execute([$profileTitle, $profileStatus, $companyName, $firstName, $lastName, $email, $phoneNumber, $joinDate, $userId])) {
            throw new Exception("Failed to create profile.");
        }
    }

    public function updateProfile($companyName, $firstName, $lastName, $email, $phoneNumber, $joinDate, $userId) {
        $stmt = $this->getConnection()->prepare('UPDATE profiles SET company_name=?, first_name=?, last_name=?, users_email=?, phone_number=?, join_date=? WHERE users_id=?');
        
        if (!$stmt->execute([$companyName, $firstName, $lastName, $email, $phoneNumber, $joinDate, $userId])) {
            throw new Exception("Failed to update profile.");
        }
    }

    //Method to update profile Status info
    public function updateProfileStatusInfo($profileStatus, $userId){
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
    
