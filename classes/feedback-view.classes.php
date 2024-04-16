<?php

class FeedbackView extends Feedback{

// Method to insert feedback into the database
public function addFeedback($userId, $fbRate, $companyName, $fbMessage, $fbDate) {
    try {
        // Call the setFeedback method from the parent class to insert feedback into the database
        $this->setFeedback($userId, $fbRate, $companyName, $fbMessage, $fbDate);
        return true; // Return true if insertion is successful
    } catch (Exception $e) {
        // Handle any exceptions here
        throw new Exception("Failed to add feedback: " . $e->getMessage());
    }
}   
//Method to get all Feedback Info
public function fetchFeedback($userId){
    $feedbackInfo = $this->getFeedbackByUserId($userId);
    //Array
    return $feedbackInfo; //To return as array 
}

//Method to get All Feedback IDs
public function getAllFeedbackIds(){
    try {
        // Call the method to fetch all feedback IDs from the database
        $feedbackIds = $this->getAllFeedbackIdsFromDB();
        return $feedbackIds;
    } catch (Exception $e) {
        // Handle any exceptions here
        throw new Exception("Failed to fetch feedback IDs: " . $e->getMessage());
    }
}
   //Method to get a single ID
   public function fetchFeedbackSingleId($userId){
    $feedbackInfo = $this->getFeedbackByUserId($userId);
    return $feedbackInfo[0]; //To return as single field
}
//Method to get a feedback rate
public function fetchFeedbackRate($userId,){
    $feedbackInfo = $this->getFeedbackByUserId($userId);
    return $feedbackInfo['fb_rate'];     
}

 //Method to get a feedback company name
 public function fetchFeedbackCompanyName($userId,){
    $feedbackInfo = $this->getFeedbackByUserId($userId);
    return $feedbackInfo['company_name'];     
}
 //Method to get a feedback message
 public function fetchFeedbackMessage($userId){
    $feedbackInfo = $this->getFeedbackByUserId($userId);
    return $feedbackInfo['fb_message'];     
}
 //Method to get a feedback date
 public function fetchFeedbackDate($userId){
    $feedbackInfo = $this->getFeedbackByUserId($userId);
    return $feedbackInfo['fb_date'];     
}

// Method to fetch details of a feedback record by its ID
public function fetchFeedbackDetails($feedbackId) {
    try {
        // Use the getFeedbackByUserId method to retrieve the feedback details
        $feedbackData = $this->getFeedbackByUserId($feedbackId);
        return $feedbackData;
    } catch (PDOException $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}

} 