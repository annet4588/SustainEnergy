<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
  'lifetime' => 1800,
  'domain' => 'localhost',
  'path' => '/',
  'secure' => true,
  'httponly' => true
]);

session_start();
//Security
//The code block regenerating the session id if running for more than 30 minutes 
if(!isset($_SESSION['last_regeneration'])){ //If running for the first time

    //Make your session id stronger by regenerating it
    session_regenerate_id(true);
    //The first time starting the session, it will create a session variable 
    $_SESSION['last_regeneration'] = time(); //it equals to the current time that we have inside the server
//If not first time running it will go to else statement
}else{
    $interval = 60*30; //60 sec times 30 minutes
    //Check if the session is more than interval (which is 30 mins here)
    if(time() - $_SESSION['last_regeneration'] >= $interval){ 
        session_regenerate_id(true); //if more than regenerate the session id again
        $_SESSION['last_regeneration'] = time();
    }
}

