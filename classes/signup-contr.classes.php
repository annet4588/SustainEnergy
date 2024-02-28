<?php

class SignupContr extends Signup{
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;


    public function __construct($uid, $pwd, $pwdRepeat, $email){

        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
    }
    // Public method to call private signupUser method
    public function processSignup() {
        $this->signupUser();
    }
    //Signup user
    private function signupUser(){

        var_dump($this->uid, $this->pwd, $this->pwdRepeat, $this->email); 
    
      if($this->emptyInput()== false){
        //echo "Empty input!";
        header("location: ../index.php?error=emptyinput");
        exit();
      }
  
      if($this->invalidUid()== false){
        //echo "Invalid username!";
        header("location: ../index.php?error=username");
        exit();
      }
      if($this->invalidEmail()== false){
        //echo "Invalid email!";
        header("location: ../index.php?error=email");
        exit();
      }
      if($this->pwdMatch()== false){
        //echo "Passwords don't match!";
        header("location: ../index.php?error=passwordmatch");
        exit();
      }
      if($this->uidTakenCheck()== false){
        //echo "Username or email taken!";
        header("location: ../index.php?error=useroremailtaken");
        exit();
      }

      $this->setUser($this->uid, $this->pwd, $this->email);
    }

    //Method to check if any empty input
    private function emptyInput(){
        $result = true;
        if(empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)){

          $result = false;
        } else{
            $result = true;
        }
        return $result;
    }

    //Check certain characters dont exist inside the user ID input 
    private function invalidUid(){
        $result =null;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    //Check email address is properly validated
    private function invalidEmail(){
        $result =null;
        if(!filter_var( $this->email, FILTER_VALIDATE_EMAIL)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }  
    
    //Check for password and repeat password match
    private function pwdMatch(){
        $result =null;
        if($this->pwd !== $this->pwdRepeat){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    //Check if the user exists
    private function uidTakenCheck(){
        $result =null;
        if(!$this->checkUser($this->uid, $this->email)){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    //Create method to get the user ID
    public function fetchUserId($uid){
        $userId = $this->getUserId($uid);
        return $userId[0]["users_id"]; //return the first row of data we get form the dtabase and the column name
    }

}




    
