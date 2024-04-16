<?php

class PurchaseHistory extends Dbh{

    //Method to get PurchaseHistory
    public function getPurchaseHistory($userId){
        try{
            $stmt = $this->getConnection()->prepare('SELECT * FROM purchase_history WHERE  users_id=?');
            $stmt->execute(array($userId));
           
            if($stmt->rowCount() == 0){
              throw new Exception('No purchase history found for the user');
            }

            //Get PurchaseHistory from query
            $purchaseHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $purchaseHistory;

        }catch(Exception $e){
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    //Method to set PurchaseHistory 
public function setPurchaseHistoryId($userId, $gcid, $subId, $purchaseDate, $shortfallScore, $voucherAmount, $paymentMethod){
    // Prepare the SQL statement
    $stmt = $this->getConnection()->prepare('INSERT INTO purchase_history(users_id, greencalc_id, subscription_id, purchase_date, shortfall_score, voucher_amount, payment_method) VALUES(?, ?, ?, ?, ?, ?, ?)');
    try{
        // Execute the SQL statement with appropriate parameters
        if (!empty($gcid)) {
            // If GreenCalc ID is provided, insert it
            $stmt->execute(array($userId, $gcid, $subId, $purchaseDate, $shortfallScore, $voucherAmount, $paymentMethod));
        } elseif (!empty($subId)) {
            // If Subscription ID is provided, insert it
            $stmt->execute(array($userId, $gcid, $subId, $purchaseDate, $shortfallScore, $voucherAmount, $paymentMethod));
        } else {
            // Handle the case where neither GreenCalc ID nor Subscription ID is provided
            throw new Exception("Neither GreenCalc ID nor Subscription ID provided.");
        }
    } catch(Exception $e){
        // Handle exceptions
        throw new Exception("Database error occurred while setting PurchaseHistory: " . $e->getMessage());
    }
    // Close the statement
    $stmt = null;
}

    //Method to get PurchaseHistory IDs from database
    protected function getPurchaseHistoryIds($phid) {
        // Prepare the SQL statement
        $stmt = $this->getConnection()->prepare('SELECT purchase_id FROM purchase_history WHERE users_id=? AND greencalc_id=?;');
        
        try {
            // Attempt to execute the SQL statement
            $stmt->execute(array($phid));
        } catch (PDOException $e) {
            // Handle PDO exceptions
            throw new Exception("Database error: " . $e->getMessage());
        }
    
        // If no results found
        if ($stmt->rowCount() == 0) {
            // Handle the case where no purchaseHistory IDs are found
            return null; // or handle differently as per your application logic
        }
    
        // Fetch the result
        $purchaseHistoryIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // Close the statement
        $stmt = null;
    
        // Return the fetched purchaseHistory IDs
        return  $purchaseHistoryIds;
    }

    

}