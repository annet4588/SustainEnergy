<?php
class GreenCalcContr extends GreenCalcInfo {
    
   
    private $userId;
    private $totalScore;
    private $voucherAmount;
    private $createdAt;
    
    public function __construct($userId, $totalScore, $voucherAmount, $createdAt) {
        
        $this->userId = $userId;
        $this->totalScore = $totalScore;
        $this->voucherAmount = $voucherAmount;
        $this->createdAt = $createdAt;
    }
    
    //Public method to call private createCreenCalc
    public function processGreenCalcInfo(){
        try{
            $this->createGreenCalcInfo();
        }catch(Exception $e){
            echo "An error occurred: " . $e->getMessage();
        }
    }

    //Method to create greencalc
    private function createGreenCalcInfo(){
        if(!$this->emptyInput()){
            throw new Exception("emptyinput");
        }
        $this->setGreenCalcInfoId($this->totalScore, $this->voucherAmount, $this->createdAt, $this->userId);
    }

    //Method to check if any empty input
    private function emptyInput(){
        return !(empty($this->userId) || empty($this->totalScore) || empty($this->voucherAmount) || empty($this->createdAt));
    }



    //Method to get the greencalc ID
    public function fetchGreenCalcID($userId){
        $gcid = $this->getGreenCalcInfoIds($userId);
        if (is_array($gcid) && !empty($gcid)) {
            return $gcid[0]['greencalc_id'];
        } else {
            // Handle the case where no GreenCalc ID is found
            return null; // Or you can return false or any other value indicating failure
        }
    }
}
