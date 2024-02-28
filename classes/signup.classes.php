<?php
class Signup extends Dbh{

    protected function setUser($uid, $pwd, $email){
        $stmt = $this->connect()->prepare('INSERT INTO users(users_uid, users_pwd, users_email) VALUES(?, ?, ?);');

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);


        //Check if the execution of the sql statement failed 
        if(!$stmt->execute(array($uid, $hashedPwd, $email))){
           $stmt = null;
           header("location: ../index.php?error=stmtfailed");
           exit();
           
        }

       $stmt = null;
     }

    //Inside the brakets properties from the Controller class
    protected function checkUser($uid, $email){
       $stmt = $this->connect()->prepare('SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?');
      
       //Check if the execution of the sql statement failed 
       if(!$stmt->execute(array($uid, $email))){
          $stmt = null;
          header("location: ../index.php?error=stmtfailed");
          exit();
       }

       $resultCheck = null;
       //Check if we have any results back from the database
       if($stmt->rowCount() > 0){
         $resultCheck = false;
       }else{
        $resultCheck= true;
       }
       return $resultCheck;
    }

    protected function getUserId($uid){
      //Prepared statement is a safer way to interact with the database
      //$this referencing to this class here. Grab the connect method from Dbh
       $stmt = $this->connect()->prepare('SELECT users_id FROM users WHERE users_uid = ?;');
       
       if(!$stmt->execute(array($uid))){
          $stmt = null;
          header("location: profile.php?error=stmtfailed");
          exit();
       }
       //If succeed 
       if($stmt->rowCount()== 0){
         $stmt = null;
         header("location: profile.php?error=profilenotfound");
         exit();
       }
 
       //Get the data from the query
       $profileDate = $stmt->fetchAll(PDO::FETCH_ASSOC);
       //Return data
       return $profileDate;
     }
}

//protected function setUser($uid, $pwd, $email){
//    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

//    $stmt = $this->connect()->prepare('INSERT INTO users(users_uid, users_pwd, users_email) VALUES(:uid, :pwd, :email)');
//    $stmt->bindParam(':uid', $uid);
//    $stmt->bindParam(':pwd', $hashedPwd);
//    $stmt->bindParam(':email', $email);

//    if(!$stmt->execute()){
//       header("location: ../index.php?error=stmtfailed");
//       exit();
//    }

//    $stmt = null;
// }
