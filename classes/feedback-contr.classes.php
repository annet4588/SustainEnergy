<?php

class FeedbackContr extends Feedback{

    private $userId;
    private $fbRate;
    private $companyName;
    private $fbMessage;
    private $fbDate;


    public function __construct($userId, $fbRate, $companyName, $fbMessage, $fbDate){
       $this->userId = $userId;
       $this->fbRate = $fbRate;
       $this->companyName = $companyName;
       $this->fbMessage = $fbMessage;
       $this->fbDate = $fbDate;
    }

    //Method to call the private createFeedback
    public function processFeedback(){
        try{
            $this->createFeedback();
        }catch(Exception $e){
            echo "An error occurred: " . $e->getMessage();
        }
    }

    //Method to create feedback
    private function createFeedback(){
      if(!$this->emptyInput()){
        throw new Exception("empty input");
      }
      $this->setFeedback($this->userId, $this->fbRate, $this->companyName, $this->fbMessage, $this->fbDate);
    }

    //Method to check if input empty
    private function emptyInput(){
        return !(empty($this->userId) || empty($this->fbRate) || empty($this->companyName) || empty($this->fbMessage));
    }

}