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
    // Prepare the SQL statement to check for existing user
    $stmt = $this->getConnection()->prepare('SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?');

    // Attempt to execute the SQL statement
    $stmt->execute([$uid, $email]);

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // If a result is found, return false (user already exists)
    if ($result !== false) {
        return false;
    } else {
        return true;
    }
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

// Method to fetch all users from the database
public function getAllUsers() {
    // Prepare the SQL statement to fetch all users
    $stmt = $this->getConnection()->prepare('SELECT * FROM users');

    try {
        // Attempt to execute the SQL statement
        $stmt->execute();
    } catch (PDOException $e) {
        // Handle the error, maybe log it or display a message
        echo "Error: " . $e->getMessage();
        exit(); // Stop execution
    }

    // Fetch all users as an associative array
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the statement
    $stmt = null;

    // Return the array of users
    return $users;
}

// Method to delete user
protected function deleteUser($userId){
    // Prepare the SQL statement to delete the user
    $stmt = $this->getConnection()->prepare('DELETE FROM users WHERE users_id = ?;');

    try {
        // Attempt to execute the SQL statement
        $stmt->execute(array($userId));
        
        // Debugging: Output user ID being deleted
        echo "User with ID $userId has been deleted successfully.";
        
        // Delete associated profile records
        $this->deleteUserProfile($userId);
    } catch (PDOException $e) {
        // Redirect to the admin page with the appropriate error message
        // Debugging: Output error message if deletion fails
        echo "Error deleting user: " . $e->getMessage();
        // header("location: admin.php?error=deletefailed");
        exit();
    }

    // Close the statement
    $stmt = null;

    // Redirect 
    header("location: admin.php");
    exit();
}

// Method to delete user profile
private function deleteUserProfile($userId) {
    // Prepare the SQL statement to delete the user profile
    $stmt = $this->getConnection()->prepare('DELETE FROM profiles WHERE users_id = ?;');

    try {
        // Attempt to execute the SQL statement
        $stmt->execute(array($userId));
    } catch (PDOException $e) {
        // Throw an exception if deletion fails
        throw new Exception("Error deleting user profile: " . $e->getMessage());
    }

    // Close the statement
    $stmt = null;
}
}
