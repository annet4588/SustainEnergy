<?php
class SignupContr extends Signup {
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;
    private $errors = array();

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
            throw new Exception("Empty Input");
        }
  
        if (!$this->invalidUid()) {
            throw new Exception("Invalid Username");
        }
        
        if (!$this->invalidEmail()) {
            throw new Exception("Invalid Email");
        }
        
        if (!$this->pwdMatch()) {
            throw new Exception("Passwords do not match");
        }
        
        if (!$this->uidTakenCheck()) {
            throw new Exception("Username or Email is already taken");
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

    // Check if the user exists
    private function uidTakenCheck() {
        return $this->checkUser($this->uid, $this->email);
    }

    // Create method to get the user ID
    public function fetchUserId($uid) {
        $userId = $this->getUserId($uid);
        return $userId[0]["users_id"]; //return the first row of data we get from the database and the column name
    }
}
