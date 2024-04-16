<?php
class Signup extends Dbh{

protected function setUser($uid, $pwd, $email){
    $stmt = $this->getConnection()->prepare('INSERT INTO users(users_uid, users_pwd, users_email) VALUES(?, ?, ?);');

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    try {
        // Attempt to execute the SQL statement
        $stmt->execute(array($uid, $hashedPwd, $email));


            
    } catch (PDOException $e) {
        // Redirect to the index page with the appropriate error message
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    // Close the statement
    $stmt = null;
}

protected function checkUser($uid, $email){
   $stmt = $this->getConnection()->prepare('SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?');
  
   try {
        // Attempt to execute the SQL statement
        $stmt->execute(array($uid, $email));
   } catch (PDOException $e) {
        // Redirect to the index page with the appropriate error message
        header("location: ../index.php?error=stmtfailed");
        exit();
   }

   // Check if we have any results back from the database
   $resultCheck = $stmt->rowCount() > 0 ? false : true;
   
   // Close the statement
   $stmt = null;

   return $resultCheck;
}

protected function getUserId($uid){
    $stmt = $this->getConnection()->prepare('SELECT users_id FROM users WHERE users_uid = ?;');
   
    try {
        // Attempt to execute the SQL statement
        $stmt->execute(array($uid));
    } catch (PDOException $e) {
        // Redirect to the profile page with the appropriate error message
        header("location: profile.php?error=stmtfailed");
        exit();
    }

    // If succeed 
    if($stmt->rowCount() == 0){
        // Redirect to the profile page with the appropriate error message
        header("location: profile.php?error=profilenotfound");
        exit();
    }

    // Get the data from the query
    $profileDate = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the statement
    $stmt = null;

    // Return data
    return $profileDate;
}
}
