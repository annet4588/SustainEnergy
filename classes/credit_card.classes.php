<?php
class CreditCard extends Dbh{

    //Method to get CreditCard info
    public function getCreditCard($userId){
        try{
            $stmt = $this->getConnection()->prepare('SELECT * FROM credit_cards WHERE users_id=?');
            $stmt->execute(array($userId));

            if($stmt->rowCount() == 0){
                throw new Exception('Credit card not found');           
            }

            //Get CreditCard from query
            $creditCard = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $creditCard;
        }catch(Exception $e){
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    //Method to get CreditCard IDs from database
    protected function getCreditCardIds($userid){
        //Prepare sql statement
        $stmt = $this->getConnection()->prepare('SELECT card_id FROM credit_cards WHERE users_id=?');
        try{
            $stmt->execute(array($userid));
        }catch(PDOException $e){
            throw new Exception("Database error: " . $e->getMessage());
        }

        //If no results found
        if($stmt->rowCount()==0){
            throw new Exception('No card found');
        }
        //Fetch the result
        $creditCardIds = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Close stmt
        $stmt=null;
        //Return data;
        return $creditCardIds;
    }

    //Method to set CreditCard
    public function setCreditCard($userId, $cardType,$cardholderName, $cardNumber, $expirationDate, $cvv, $billingAddress, $city, $county, $postalCode, $createdAt, $updatedAt, $deletedAt){
        $stmt=$this->getConnection()->prepare('INSERT INTO credit_cards(users_id, card_type, cardholder_name, card_number, expiration_date, cvv, billing_address, city,county, postal_code, created_at, updated_at, deleted_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)');

        try{
            $stmt->execute(array($userId, $cardType,$cardholderName, $cardNumber, $expirationDate, $cvv, $billingAddress, $city, $county, $postalCode, $createdAt, $updatedAt, $deletedAt));
        }catch(Exception $e){
            throw new Exception("Database error occurred while setting Credit Card: " . $e->getMessage());
        }
        //close stmt
        $stmt=null;
    }

    //Method to update CreditCard
    public function updateCreditCard($userId, $cardType,$cardholderName, $cardNumber, $expirationDate, $cvv, $billingAddress, $city, $county, $postalCode, $createdAt, $updatedAt, $deletedAt){
        $stmt=$this->getConnection()->prepare('UPDATE credit_cards SET  card_type=?, cardholder_name=?, card_number=?, expiration_date=?, cvv=?, billing_address=?, city,county=?, postal_code=?, created_at=?, updated_at=?, deleted_at=? WHERE users_id=?');

        try{
            $stmt->execute(array($userId, $cardType,$cardholderName, $cardNumber, $expirationDate, $cvv, $billingAddress, $city, $county, $postalCode, $createdAt, $updatedAt, $deletedAt));
        }catch(Exception $e){
            throw new Exception("Database error occured while updating Credit Card: " . $e->getMessage());
        }
        //close stmt
        $stmt=null;
    }

    //Method to fetch credit card details by credit card ID
    public function getCreditCardId($cardId){
        try{
            $stmt=$this->getConnection()->prepare('SELECT * FROM credit_cards WHERE card_id = ?');
            $stmt->execute([$cardId]);
       
    
            if($stmt->rowCount() == 0){
                throw new Exception('No card found for the given ID');
            }

            //Get credit Card data from the query
            $creditCardData = $stmt->fetch(PDO::FETCH_ASSOC);
            return $creditCardData;
       
        }catch(PDOException $e){
            throw new Exception('Database error: ' . $e->getMessage());
        }   
    }

    // Method to delete CreditCard using card ID and user ID
    public function deleteCreditCardById($cardId, $userId){
        try {
            // Call the getCreditCardId method to ensure the card exists
            $cardData = $this->getCreditCardId($cardId);

            // Check if the card belongs to the current user
            if ($cardData['users_id'] != $userId) {
                throw new Exception("Unauthorized to delete this card.");
            }

            // Delete the card from the database
            $stmt = $this->getConnection()->prepare('DELETE FROM credit_cards WHERE card_id = ?');
            $stmt->execute([$cardId]);

            // Check if the card is successfully deleted
            if ($stmt->rowCount() == 0) {
                throw new Exception('Failed to delete card.');
            }
        } catch (Exception $e) {
            throw new Exception("Error occurred while deleting the card: " . $e->getMessage());
        }
    }
}