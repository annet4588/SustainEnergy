<?php

class SubscriptionView extends Subscription{

    
public function fetchAllSubscriptions($userId) {
    try {
        $subscriptionInfo = $this->getSubscription($userId);
        return $subscriptionInfo;
    } catch (Exception $e) {
        throw new Exception("Failed to fetch subscription details: " . $e->getMessage());
    }
}

//Method to get a single ID
public function fetchSubscriptionSingleId($userId){
    $subscriptionInfo = $this->getSubscriptionIds($userId);
    //Passed subscription single ID
    return $subscriptionInfo[0]; //Array ofset if added['subscription_id]    
}
}