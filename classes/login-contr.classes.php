<?php

class LoginContr extends Login {
   
    private $uid;
    private $pwd;


    //Constructor
    public function __construct($uid, $pwd){
        $this->uid=$uid;
        $this->pwd=$pwd;
    }

    //Method to process login input externally
    public function processLogin(){
        $this->loginUser();
    }

    //Method to initiate the login process
    private function loginUser(){
      if($this->emptyInput() == false){
        header("location: ../index.php?error=emptyinput");
        exit();
      }
      $this->getUser($this->uid, $this->pwd);
    }

    //Method checks if either the username or password is empty
    private function emptyInput(){
        $result = true;
        if(empty($this->uid) || empty($this->pwd)){
            $result = false;
        }else{
            $result=true;
        }
        return $result;
    }
}

//The LoginContr class is designed to handle the user input data (username and password) 
//and process the login operation.