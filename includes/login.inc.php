<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //Getting data
    $uid = htmlspecialchars($_POST['uid'], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST['pwd'], ENT_QUOTES, 'UTF-8');

    //Instantiate LoginContr class
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";

    $login = new LoginContr($uid, $pwd);

    //Running error handling and user signup
    $login->processLogin();

    //Going back to front page
    header("location: ../index.php?error=none");
}