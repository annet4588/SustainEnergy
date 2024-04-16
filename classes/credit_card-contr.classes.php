<?php

class CreditCardContr extends CreditCard{
    private $userId;
    private $cardType;
    private $cardholderName;
    private $cardNumber;
    private $expirationDate;
    private $cvv;
    private $billingAddress;
    private $city;
    private $county;
    private $postalCode;
    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $errors = array();


    public function __construct($userId, $cardType,$cardholderName, $cardNumber, $expirationDate, $cvv, $billingAddress, $city, $county, $postalCode, $createdAt, $updatedAt, $deletedAt){
      $this->userId = $userId;
      $this->cardType = $cardType;
      $this->cardholderName = $cardholderName;
      $this->cardNumber = $cardNumber;
      $this->expirationDate = $expirationDate;
      $this->cvv = $cvv;
      $this->billingAddress = $billingAddress;
      $this->city = $city;
      $this->county = $county;
      $this->postalCode = $postalCode;
      $this->createdAt = $createdAt;
      $this->updatedAt = $updatedAt;
      $this->deletedAt = $deletedAt;
    
    }

    //Public method to call private createCredirCard
    public function processCreditCard(){
      try{
        $this->createCreditCard();
      }catch(Exception $e){
        // If an error occurs, add it to the errors array
        $this->errors[] = $e->getMessage();
      }
    }

    // Method to get the array of errors
    public function getErrors() {
      return $this->errors;
  }
    //Method to create CreditCard
    private function createCreditCard(){

      if(!$this->emptyInput()){
        throw new Exception("Empty Input");
      }
      $this->setCreditCard($this->userId, $this->cardType,$this->cardholderName, $this->cardNumber, $this->expirationDate, $this->cvv, $this->billingAddress, $this->city, $this->county, $this->postalCode, $this->createdAt, $this->updatedAt, $this->deletedAt);
    }

    //Method to check if inputs empty
  private function emptyInput(){
    return !(empty($this->userId) || empty($this->cardType) || empty($this->cardholderName) || empty($this->cardNumber) || empty($this->expirationDate) || empty($this->cvv) || empty($this->billingAddress) || empty($this->city) || empty($this->county) || empty($this->postalCode) || empty($this->createdAt) || empty($this->updatedAt) || empty($this->deletedAt));
  }

  //Method to get the CreditCard ID
  public function fetchCreditCardID($userId){
    $cardid = $this->getCreditCardIds($userId);
    return $cardid[0]['card_id'];
  }

  //Method to delete the CreditCard
public function deleteCreditCard($cardId, $userId){
  try {
      $this->deleteCreditCardById($cardId, $userId);
  } catch (Exception $e) {
      throw new Exception("Error occurred while deleting the card: " . $e->getMessage());
  }
}

}
