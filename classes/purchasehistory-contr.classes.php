<?php

class PurchaseHistoryContr extends PurchaseHistory{

    private $userId;
    private $subId;
    private $gcid;
    private $purchaseDate;
    private $shortfallScore;
    private $voucherAmount;
    private $paymentMethod;

   public function __construct($userId, $subId, $gcid, $purchaseDate, $shortfallScore,$voucherAmount, $paymentMethod){

    $this->userId = $userId;
    $this->subId = $subId;
    $this->gcid = $gcid;
    $this->purchaseDate = $purchaseDate;
    $this->shortfallScore = $shortfallScore;
    $this->voucherAmount = $voucherAmount;
    $this->paymentMethod = $paymentMethod;
   }

   //Public method to call the private createPurchaseHistory
   public function processPurchaseHistory(){
    try {
         // Check if both subscriptionId and greencalcId are provided
        if ($this->subId !== null && $this->gcid == null) {
            // If only subscription Id is provided, create a subscription purchase
            $this->createSubscriptionPurchase();
        } elseif ($this->subId !== null && $this->gcid !== null) {
            // If both subscription Id and greencalc Id are provided, create a greencalc purchase
            $this->createGreencalcPurchase();
        } else {
            // If neither subscription Id nor greencalc Id is provided, throw an exception
            throw new Exception("Neither subscriptionId nor greencalcId provided.");
        }
    } catch (Exception $e) {
        // Catch any exceptions and display an error message
        echo "An error occurred: " . $e->getMessage();
    }
    }
    // Private method to create a subscription purchase
    private function createSubscriptionPurchase() {
      
        $this->setPurchaseHistoryId(
            $this->userId,
            null,
            $this->subId,
            $this->purchaseDate,
            null,
            $this->voucherAmount,
            $this->paymentMethod
        );
    }
    // Private method to create a greencalc purchase
    private function createGreencalcPurchase() {
        
        $this->setPurchaseHistoryId(
            $this->userId,
            $this->gcid,
            $this->subId,
            $this->purchaseDate,
            $this->shortfallScore,
            $this->voucherAmount,
            $this->paymentMethod
        );
    }

    //Method to get the purchaseHistory ID
    public function fetchPurchaseHistoryID($userId){
        $phid = $this->getPurchaseHistoryIds($userId);
        return $phid[0]['purchase_id'];
     }
}