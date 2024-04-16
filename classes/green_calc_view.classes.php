<?php

class GreenCalcView extends GreenCalcInfo{

    //Method to get all Details
    public function fetchGreenCalcInfoDetails($gcid, $userId){
        $greenCalcInfo = $this->getGreenCalcInfo($gcid, $userId);
        //Array
        return $greenCalcInfo[0];
    }

    //Method to get all IDs
    public function fetchGreenCalcId($userId){
        $greenCalcInfo = $this->getGreenCalcInfoIds($userId);
        return $greenCalcInfo;     
    }

    //Method to get a single ID
    public function fetchGreenCalcSingleId($userId){
        $greenCalcInfo = $this->getGreenCalcInfoIds($userId);
        return $greenCalcInfo[0]; //Array ofset if ['greencalc_id]    
    }
 
    //Method get Activity Total Score
    public function getActivityTotalScore($gcid, $userId){
        $greenCalcInfo = $this->getGreenCalcInfo($gcid, $userId);
        return $greenCalcInfo[0]["total_score"];
    }
    //Method get Voucher Amount
    public function getActivityVoucherAmount($gcid, $userId){
        $greenCalcInfo = $this->getGreenCalcInfo($gcid, $userId);
        return $greenCalcInfo[0]["voucher_amount"];
    }


    //Method to change Score to Voucher Amount
    public function priceAsCurency($gcid, $userId, $currencySymbol){
       $greenCalcInfo = $this->getGreenCalcInfo($gcid, $userId);
       return $currencySymbol . $greenCalcInfo[0]['voucher_amount'] * 10;
    }


}