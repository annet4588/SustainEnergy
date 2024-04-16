<?php
class SubscriptionContr extends Subscription{
    private $userId;
    private $subscriptionDate;

    public function __construct($userId, $subscriptionDate){

        $this->userId = $userId;
        $this->subscriptionDate = $subscriptionDate;
    }

      //Public method to call the private subscription
   public function processSubscription(){
    try{
        $this->createSubscription();
    }catch(Exception $e){
        echo "An error occurred: " . $e->getMessage();
        }
    }

     //Method to create Subscription
     private function createSubscription(){
        if(!$this->emptyInput()){
            throw new Exception("emptyinput");
        }
        $this->setSubscriptionId($this->userId, $this->subscriptionDate);
    }

       //Method to check if any empty input
       private function emptyInput(){
        return !(empty($this->userId) || empty($this->subscriptionDate));
    }

    //Method to get the Subscription ID
    public function fetchSubscriptionID($userId){
        $subid = $this->getSubscriptionIds($userId);
        return $subid[0];
     }

}