<?php

class ProfileInfoView extends ProfileInfo{
    

public function fetchAllProfileDetails($userId) {
    try {
        $profileInfo = $this->getProfileInfo($userId);
        return $profileInfo;
    } catch (Exception $e) {
        throw new Exception("Failed to fetch profile details: " . $e->getMessage());
    }
}

public function fetchCompanyName($userId) {
  try {
      $profileInfo = $this->getProfileInfo($userId);
      return $profileInfo["company_name"];
  } catch (Exception $e) {
      throw new Exception("Failed to fetch profile details: " . $e->getMessage());
  }
}

public function fetchFirstName($userId) {
  try {
      $profileInfo = $this->getProfileInfo($userId);
      return $profileInfo["first_name"];
  } catch (Exception $e) {
      throw new Exception("Failed to fetch first name: " . $e->getMessage());
  }
}

public function fetchLastName($userId) {
  try {
      $profileInfo = $this->getProfileInfo($userId);
      return $profileInfo["last_name"];
  } catch (Exception $e) {
      throw new Exception("Failed to fetch last name: " . $e->getMessage());
  }
}

public function fetchEmail($userId) {
  try {
      $profileInfo = $this->getProfileInfo($userId);
      return $profileInfo["users_email"];
  } catch (Exception $e) {
      throw new Exception("Failed to fetch email: " . $e->getMessage());
  }
}

public function fetchPhoneNumber($userId) {
  try {
      $profileInfo = $this->getProfileInfo($userId);
      return $profileInfo["phone_number"];
  } catch (Exception $e) {
      throw new Exception("Failed to fetch phone number: " . $e->getMessage());
  }
}

public function fetchJoinDate($userId) {
  try {
      $profileInfo = $this->getProfileInfo($userId);
      return $profileInfo["join_date"];
  } catch (Exception $e) {
      throw new Exception("Failed to fetch join date: " . $e->getMessage());
  }
}

}
  
//The View Class talks to the Model Class