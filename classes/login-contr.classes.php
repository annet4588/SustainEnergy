<?php

class LoginContr extends Login {
   
    private $uid;
    private $pwd;
    private $errors = array();


    //Constructor
    public function __construct($uid, $pwd){
        $this->uid=$uid;
        $this->pwd=$pwd;
    }

    //Method to process login input externally
    public function processLogin(){
        try{
            $this->loginUser();
        }catch(Exception $e){
            // Handle the exception
            $this->errors[]=$e->getMessage();
        }
        
    }

    //Method to initiate the login process
    private function loginUser(){
        try{
            //Check for empty input
            if($this->emptyInput()){
                throw new Exception("Empty username or password.");
            }
            // Attempt to get user
            $this->getUser($this->uid, $this->pwd);
        }catch(Exception $e){
            // Re-throw the exception to be caught by the calling method
        throw new Exception("Login failed: " . $e->getMessage());
        }
    }

    // Method checks if either the username or password is empty
    private function emptyInput(){
        return empty($this->uid) || empty($this->pwd);
    }

     // Method to get the array of errors
     public function getErrors(){
        return $this->errors;
    }
}

//The LoginContr class is designed to handle the user input data (username and password) 
//and process the login operation.