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
    // Check if the array is not empty before accessing its first element
    if (!empty($subscriptionInfo)) {
        // Passed subscription single ID
        return $subscriptionInfo[0]; // Array offset if added['subscription_id]    
    } else {
        // Handle the case where the array is empty (no subscription)
        return null; // Return null indicating no subscription
    }
}
}