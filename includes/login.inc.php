<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    try {
        //Getting data
        $uid = htmlspecialchars($_POST['uid'], ENT_QUOTES, 'UTF-8');
        $pwd = htmlspecialchars($_POST['pwd'], ENT_QUOTES, 'UTF-8');

        //Instantiate LoginContr class
        require_once "../classes/dbh.classes.php";
        include "../classes/login.classes.php";
        include "../classes/login-contr.classes.php";

        $errors = [];
      

        // Check if the input is an email address
        if(filter_var($uid, FILTER_VALIDATE_EMAIL)){
            //if its email set email variable
            $email = $uid;
            $username = null;
        } else {
            //if its not email but username
            $username = $uid;
            $email = null;
        }
        $login = new LoginContr($uid, $pwd);

        //Running error handling and user signup
        $login->processLogin();

        //Going back to front page
        header("location: ../index.php?error=none");
    } catch (Exception $e) {
        // Handle exceptions here
        header("location: ../login.php?error=". urlencode($e->getMessage()));
        exit();
    }
}
