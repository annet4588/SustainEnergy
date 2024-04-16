<?php
class Feedback extends Dbh {
   
    // Method to get feedback data for a user
    public function getFeedbackByUserId($userId) {
        try {
            $stmt = $this->getConnection()->prepare('SELECT * FROM feedback WHERE users_id = ?');
            $stmt->execute([$userId]);

            if ($stmt->rowCount() == 0) {
                throw new Exception('No feedback found for the user');
            }

            // Get feedback data from the query
            $feedbackData = $stmt->fetch(PDO::FETCH_ASSOC); //use fetch here, not fetchAll
            
            return $feedbackData;
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    // Method to get feedback IDs for a user
    public function getFeedbackIdsByUserId($userId) {
        try {
            $stmt = $this->getConnection()->prepare('SELECT fb_id FROM feedback WHERE users_id = ?');
            $stmt->execute([$userId]);

            // Fetch the result
            $feedbackIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return $feedbackIds;
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    // Method to set feedback for a user
    public function setFeedback($userId, $fbRate, $companyName, $fbMessage, $fbDate) {
        try {
            $stmt = $this->getConnection()->prepare('INSERT INTO feedback(users_id, fb_rate, company_name, fb_message, fb_date) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$userId, $fbRate, $companyName, $fbMessage, $fbDate]);
        } catch (PDOException $e) {
            throw new Exception("Database error occurred while setting feedback: " . $e->getMessage());
        }
    }

    //Method to fetch all feedback IDs from the database
    public function getAllFeedbackIdsFromDB(){
        try{
            $stmt=$this->getConnection()->prepare('SELECT fb_id FROM feedback');
            $stmt->execute();
            // Fetch all the results as an associative array
        $feedbackIds = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Return the array of feedback IDs
        return $feedbackIds;
    } catch (PDOException $e) {
        // Handle any database errors here
        throw new Exception("Failed to fetch feedback IDs: " . $e->getMessage());
    }
      
    }
    // Method to fetch feedback details by feedback ID
public function getFeedbackById($feedbackId) {
    try {
        $stmt = $this->getConnection()->prepare('SELECT * FROM feedback WHERE fb_id = ?');
        $stmt->execute([$feedbackId]);

        if ($stmt->rowCount() == 0) {
            throw new Exception('No feedback found for the given ID');
        }

        // Get feedback data from the query
        $feedbackData = $stmt->fetch(PDO::FETCH_ASSOC);
        return $feedbackData;
    } catch (PDOException $e) {
        throw new Exception("Database error: " . $e->getMessage());
    }
}

    
}

