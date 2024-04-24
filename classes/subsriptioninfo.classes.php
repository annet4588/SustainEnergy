<?php
class Subscription extends Dbh{

    //Method to get Subscription
    public function getSubscription($userId){
        try{
            $stmt = $this->getConnection()->prepare('SELECT * FROM subscriptions WHERE  users_id=?');
            $stmt->execute(array($userId));
           
            if($stmt->rowCount() == 0){
              throw new Exception('No subscription found for the user');
            }

            //Get PurchaseHistory from query
            $subscriptionData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $subscriptionData;

        }catch(Exception $e){
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    //Method to get Subscription IDs from database **
    protected function getSubscriptionIds($userId) {
        // Prepare the SQL statement
        $stmt = $this->getConnection()->prepare('SELECT subscription_id FROM subscriptions WHERE users_id=?');
        
        try {
            // Attempt to execute the SQL statement
            $stmt->execute(array($userId));
        } catch (PDOException $e) {
            // Handle PDO exceptions
            throw new Exception("Database error: " . $e->getMessage());
        }
    
        // If no results found
        if ($stmt->rowCount() == 0) {
            // Handle the case where no subscription IDs are found
            return null; // or handle differently as per your application logic
        }
    
        // Fetch the result
        $subscriptionIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // Close the statement
        $stmt = null;
    
        // Return the fetched subscription IDs
        return  $subscriptionIds;
    }
    //Method to set Subscription 
    public function setSubscriptionId($userId, $subscriptionDate){
 
        $stmt = $this->getConnection()->prepare('INSERT INTO subscriptions(users_id, subscription_date) VALUES(?, ?)');
        try{
            $stmt->execute(array($userId, $subscriptionDate));
        }catch(Exception $e){
            throw new Exception("Database error occurred while setting Subscription: " . $e->getMessage());
        }
        // Close the statement
       $stmt = null;
    }

   // Method to delete a subscription
   public function deleteSubscription($userId, $subId){
    try {
        // Prepare the SQL statement
        $stmt = $this->getConnection()->prepare('DELETE FROM subscriptions WHERE users_id = ? AND subscription_id = ?');
    
        // Attempt to execute the SQL statement
        $stmt->execute(array($userId, $subId));
    
        // Check if any rows were affected
        if ($stmt->rowCount() == 0) {
            throw new Exception('No subscription found for the user with the given subscription ID');
        }
    
        // Close the statement
        $stmt = null;
    
    } catch (PDOException $e) {
        // Handle PDO exceptions
        throw new Exception("Database error: " . $e->getMessage());
    }
}
}