<?php

class Subcription_contr_classes extends Subscription_classes{
    private $username;
    private $password;
    private $confirm_password;
    private $email;
    private $errors = array();

    //Constructor
    public function __construct($username, $password, $confirm_password, $email){
        $this->username = $username;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        $this->email = $email;
    }
    
    //Process signup
    public function processSignup(){
        $this->signupUser();
    }

    private function signupUser(){
        //If empty input
        if($this->emptyInput()==false){
            $this->addError("emptyinput", "Please fill in all fields");
        }

        //if username taken
        if($this->uidTakenCheck()==false){
            $this->addError("useroremailtaken", "USername or email already taken");
        }
        //Handle errors
        if(!empty($this->errors)){
          //Display errors
          foreach($this->errors as $error){
            echo $error . "<br>";
          }
          exit();
        }
        //If no errors continue with signup
        $this->setUser($this->username, $this->password, $this->email);

    }
    //Empty input method
    private function emptyInput(){
        return !empty($this->username) && !empty($this->password) && !empty($this->confirm_password) && !empty($this->email);     
    }

    private function uidTakenCheck(){
        return $this->checkUser($this->username, $this->email);
    }

    private function addError($key, $message){
        $this->errors[$key]=$message;

    }
}