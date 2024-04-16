<?php 

class Login extends Dbh {

    //Method to validate the user credentials
    protected function getUser($uid, $pwd){
        try {
            // Prepare the SQL statement
            $stmt = $this->getConnection()->prepare('SELECT * FROM users WHERE users_uid = :uid OR users_email= :email');
            
            // Execute the statement with provided parameters
            $stmt->execute(array(':uid' => $uid, ':email' => $uid));
    
            // Check if any user found
            if($stmt->rowCount() == 0){
                throw new Exception("User not found.");
            }
    
            // Fetch user details
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Verify password
            $checkPwd = password_verify($pwd, $user["users_pwd"]);
    
            // Handling incorrect password
            if(!$checkPwd){
                throw new Exception("Incorrect password.");
            }
    
            // Start session and set session variables
            session_start();
            $_SESSION['userid'] = $user['users_id'];
            $_SESSION['useruid'] = $user['users_uid'];
        } catch (PDOException $e) {
            // Handle database errors
            throw new Exception("Database error: " . $e->getMessage());
        } catch (Exception $e) {
            // Handle other exceptions
            throw $e;
        } finally {
            // Close the statement
            $stmt = null;
        }
    }


     // Find user by email or username
    public function findUserByEmailOrPassword($email, $username){
        try {
            $stmt = $this->getConnection()->prepare('SELECT * FROM users WHERE users_uid = :username OR users_email = :email');
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);

            // Execute the statement
            $stmt->execute();

            $findUser = $stmt->fetch(PDO::FETCH_ASSOC);
            // Check row
            if($findUser) {
                return $findUser;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Handle database errors
            throw new Exception("Database error: " . $e->getMessage());
        } catch (Exception $e) {
            // Handle other exceptions
            throw $e;
        } finally {
            // Close the statement
            $stmt = null;
        }
    }

    // Reset Password
    public function resetPassword($newPwdHash, $tokenEmail){
        try {
            $stmt = $this->getConnection()->prepare('UPDATE users SET users_pwd=:pwd WHERE users_email=:email');
            $stmt->bindParam(':pwd', $newPwdHash);
            $stmt->bindParam(':email', $tokenEmail);

            // Execute the statement
            if($stmt->execute()){
                return true;
            } else {
                throw new Exception("Error updating password.");
            }
        } catch (PDOException $e) {
            // Handle database errors
            throw new Exception("Database error: " . $e->getMessage());
        } catch (Exception $e) {
            // Handle other exceptions
            throw $e;
        } finally {
            // Close the statement
            $stmt = null;
        }
    }

}

//This class encapsulates the logic for authenticating a user 
//based on provided credentials and handling sessions upon successful authentication. 
//Additionally, it includes error handling for various scenarios, 
//such as SQL statement execution failures and incorrect passwords.
//    if(!$checkPwd){
 //   $stmt = null;
 //   header("location: ../index.php?error=wrongpassword");
//    exit();
//}