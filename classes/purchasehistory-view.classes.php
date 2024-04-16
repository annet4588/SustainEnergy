<?php

class PurchaseHistoryView extends PurchaseHistory{

     //Method to get all Details
     public function fetchPurchaseHistory($userId){
        $purchaseHistory = $this->getPurchaseHistory($userId);
        //Array
        return $purchaseHistory; //To return as array 
    }

       //Method to get a single ID
       public function fetchPurchaseHistorySingleId($userId){
        $purchaseHistory = $this->getPurchaseHistoryIds($userId);
        return $purchaseHistory[0]; //To return as single field
    }
     //Method to get a greencalc ID
     public function fetchGreenCalcId($userId){
        $purchaseHistory = $this->getPurchaseHistoryIds($userId);
        return $purchaseHistory[0]['greencalc_id'];     
    }

     //Method to get a shortfallScore
     public function fetchShortfallScore($userId,){
        $purchaseHistory = $this->getPurchaseHistoryIds($userId);
        return $purchaseHistory[0]['shortfall_score'];     
    }
     //Method to get a purchaseDate
     public function fetchPurchaseDate($userId){
        $purchaseHistory = $this->getPurchaseHistoryIds($userId);
        return $purchaseHistory[0]['purchase_date'];     
    }
     //Method to get a voucherAmount
     public function fetchVoucherAmount($userId){
        $purchaseHistory = $this->getPurchaseHistoryIds($userId);
        return $purchaseHistory[0]['voucher_amount'];     
    }
     //Method to get a paymentmMethod
     public function fetchPaymentMethod($userId){
        $purchaseHistory = $this->getPurchaseHistoryIds($userId);
        return $purchaseHistory[0]['payment_method'];     
    }
}