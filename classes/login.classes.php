<?php 

class Login extends Dbh {

    //Method to validate the user credentials
    protected function getUser($uid, $pwd){
        $stmt = $this->getConnection()->prepare('SELECT users_pwd FROM users WHERE users_uid =? OR users_email=?');
   

        //Check if the execution of the sql statement failed
        if(!$stmt->execute(array($uid, $pwd))){
           $stmt = null;
           header("location: ..index.php?error=stmtfailed");
           exit();
        }

        //User not found
        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
        }

        //Password verification
        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]);

        //Handling incorrect password
        if($checkPwd == false){
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        //Password is correct
        }elseif($checkPwd == true){
            $stmt = $this->getConnection()->prepare('SELECT * FROM users WHERE users_uid=? OR users_email=? AND users_pwd=?');
        
            if(!$stmt->execute(array($uid, $uid, $pwd))){
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }
            if($stmt->rowCount() == 0){
                $stmt = null;
                header("location: ../index.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();

            //Create 2 SESSION variables, one for the ID of the user 
            //and another one for the username of the user(useruid) inside the SESSION.
            $_SESSION['userid'] = $user[0]['users_id'];
            $_SESSION['useruid'] = $user[0]['users_uid'];
        
            $stmt = null;
        }

        //The prepared statement is null, closing the db connection.
        $stmt = null;
    }
}

//This class encapsulates the logic for authenticating a user 
//based on provided credentials and handling sessions upon successful authentication. 
//Additionally, it includes error handling for various scenarios, 
//such as SQL statement execution failures and incorrect passwords.