<?php
//SignupContr class is designed to handle the user input data when signing up
//and process the signup operation.
class SignupContr extends Signup {
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;
    private $errors = array();

    //Signup class Constructor
    public function __construct($uid, $pwd, $pwdRepeat, $email) {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
    }

    // Public method to call private signupUser method
    public function processSignup() {
        try {
            $this->signupUser();
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }
    }

    // Method to get the array of errors
    public function getErrors() {
        return $this->errors;
    }

    // Signup user
    private function signupUser() {
        if (!$this->emptyInput()) {
            throw new Exception("All fields are required.");
        }
  
        if (!$this->invalidUid()) {
            throw new Exception("Username can only contain letters and numbers.");
        }
        
        if (!$this->invalidEmail()) {
            throw new Exception("Invalid email format, e.g. example@gmail.com");
        }
        if (!$this->pwdCheck()) {
            throw new Exception("Password should be at least 6 characters long.");
        }
        if (!$this->pwdMatch()) {
            throw new Exception("Passwords do not match");
        }
        
        if (!$this->uidTakenCheck()) {
            throw new Exception("Username or Email is already taken, please choose another one.");
        }

        $this->setUser($this->uid, $this->pwd, $this->email);
    }

    // Method to check if any empty input
    private function emptyInput() {
        return !(empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email));
    }

    // Check certain characters don't exist inside the user ID input 
    private function invalidUid() {
        return preg_match("/^[a-zA-Z0-9]*$/", $this->uid);
    }

    // Check email address is properly validated
    private function invalidEmail() {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }  
    
    // Check for password and repeat password match
    private function pwdMatch() {
        return $this->pwd === $this->pwdRepeat;
    }
    // Check if password is at least 6 characters long
    private function pwdCheck() {
        return strlen($this->pwd) >= 6;
    }

    // Check if the user exists
    private function uidTakenCheck() {
        return $this->checkUser($this->uid, $this->email);
    }

    // Create method to get the user ID
    public function fetchUserId($uid) {
        $userId = $this->getUserId($uid);
        return $userId[0]["users_id"]; //return the first row of data we get from the database and the column name
    }

     // Method to get all users
     public function fetchAllUsers() {
        // Instantiate the Signup class to access its methods
        $signup = new Signup();

        // Call the getAllUsers method to fetch all users
        $users = $signup->getAllUsers();

        // Return the array of users
        return $users;
    }
   
     // Method to remove a user
     public function removeUser($userId) {
        try {
            $this->deleteUser($userId);
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();
        }
    }
}

