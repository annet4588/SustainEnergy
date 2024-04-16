<?php
class Certificate extends Dbh{

    //Method to get Certificate
    public function getCertificate($userId){
        try{
            $stmt = $this->getConnection()->prepare('SELECT * FROM certificate_db WHERE  users_id=?');
            $stmt->execute(array($userId));
           
            if($stmt->rowCount() == 0){
              throw new Exception('No Certificate found for the user');
            }

            //Get Certificate from query
            $certificate = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $certificate;

        }catch(Exception $e){
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    //Method to get Certificate IDs from database
    protected function getCertificateIds($phid) {
        // Prepare the SQL statement
        $stmt = $this->getConnection()->prepare('SELECT certificate_id FROM certificate_db WHERE users_id=?');
        
        try {
            // Attempt to execute the SQL statement
            $stmt->execute(array($phid));
        } catch (PDOException $e) {
            // Handle PDO exceptions
            throw new Exception("Database error: " . $e->getMessage());
        }
    
        // If no results found
        if ($stmt->rowCount() == 0) {
            // Handle the case where no Certificate IDs are found
            return null; // or handle differently as per your application logic
        }
    
        // Fetch the result
        $certificateIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // Close the statement
        $stmt = null;
    
        // Return the fetched Certificate IDs
        return  $certificateIds;
    }

    //Method to set Certificate 
    public function setCertificateId($userId, $companyName, $completionDate, $certificateType, $approvedBy, $certificateImg){
 
        $stmt = $this->getConnection()->prepare('INSERT INTO certificate_db(users_id, completed_by, completion_date, certificate_type, approved_by, certificate_img) VALUES(?,?, ?, ?, ?, ?)');
        try{
            $stmt->execute(array($userId, $companyName, $completionDate, $certificateType, $approvedBy, $certificateImg));
        }catch(Exception $e){
            throw new Exception("Database error occurred while setting PurchaseHistory: " . $e->getMessage());
        }
        // Close the statement
       $stmt = null;
    }
}