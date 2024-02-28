<?php
class Subscription_classes extends Dbh{

    protected function setUser($username, $password, $email){
       $errors = array();
       //Assign statement to Insert user details into user table
        $stmt = $this->getConnection()->prepare('INSERT INTO user(username, password, email, registration_date) VALUES(?, ?, ?, NOW())');

        $hashedPassword=password_hash($password, PASSWORD_DEFAULT);

        //Check if SQL execution failed
        if($stmt->execute(array($username, $hashedPassword, $email))){
            $stmt=null;
            $errors['stmtfailed'] = "Failed to execute SQL statement";
        }
        //Get the user ID on the inserted user
        $userId = $this->getConnection()->lastInsertId();

        //Assign statement to Insert details into subscription table
        $subsciptionStmt = $this->getConnection()->prepare('INSERT INTO subscription(user_id, subscription_date, expiry_date, amount_paid, status) VALUES(?, NOW(), DATE_ADD(NOW(), INTERVAL 1 YEAR), 0, "active" )');
        $subsciptionStmt->execute([$userId]);

        $stmt=null;
        $subsciptionStmt=null;

    }

    //Method to check if username or email exist
    protected function checkUser($username, $email){
        $stmt=$this->getConnection()->prepare('SELECT username FROM user WHERE username = ? OR email = ?');

        //Check if SQL execution failed
        if(!$stmt->execute(array($username, $email))){
            $stmt = null;
            //Handle execution failure
            $errors['stmtfailed'] = "Failed to execute SQL statement";
        }

        $resulCheck = null;
        //Check if any result returned from database
        if($stmt->rowCount()>0){
            $resultCheck = false; //already taken
        }else{
            $resultCheck = true; //available username or email
        }
        return $resultCheck;
    }

    //Method to get user ID from database to create a Profile on Subscription
    protected function getUserId($username){
      $stmt=$this->getConnection()->prepare('SELECT user_id FROM user WHERE username = ?');

      if(!$stmt->execute(array($username))){
        $stmt=null;
        $errors['stmtfailed'] = "Failed to execute SQL statement";
      }

      //If user not found
      if($stmt->rowCount()==0){
        $stmt=null;
        $errors['profilenotfound'] = "Profile not found";
      }

      //Get data from query
      $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
      //Return data
      return $profileData[0]["user_id"];
    }
}