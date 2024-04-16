<?php

class CreditCardView extends CreditCard{
    //Method to get all CreditCard Info
    public function fetchCreditCardInfo($userId){
       try {
            $creditCardInfo = $this->getCreditCard($userId);
            return $creditCardInfo;
        } catch (Exception $e) {
            // Handle the exception here, e.g., log it
            // Returning an empty array in case of an error
            return [];
        }
    }
}