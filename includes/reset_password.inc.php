<?php

if(isset($_POST["reset_password_submit"])){

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $pwd = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd_repeat"];

    if(empty($password || empty($passwordRepeat))){
      header("Location: ../create_new_password.php?newpwd=empty");
      exit();
    }else if($password != $passwordRepeat){
            header("Location: ../create_new_password.php?newpwd=pwdnotsame");
            exit();
        
    }

    $currentDate = date("U");

    require 'dbh.classes.php';

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "There was an error!";
      exit();
    }else{
      mysqli_stmt_bind_param($stmt, "s", $selector);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      if(!$row = mysqli_fetch_assoc($result)){
        echo "You need to re-submit your reset request.";
        exit();
      }else{
        //match the token that we have inside the database with the token that we sent from the form
        //make sure its in binary data
        $tokenBin = hex2bin($validator);
        $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

        if($tokenCheck === false){
            echo "You need to re-submit your reset request.";
        }elseif ($tokenCheck === true) {
            $tokenEmail = $row["pwdResetEmail"];

            $sql = "SELECT * FROM users WHERE users_email=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
              echo "There was an error!";
              exit();
            }else{
               mysqli_stmt_bind_param($stmt, "s", $tokenEmail); 
               mysqli_stmt_execute($stmt);
               $result = mysqli_stmt_get_result($stmt);
                if(!$row = mysqli_fetch_assoc($result)){
                    echo "There was error!";
                    exit();
                }else{
                    //Update the password in database
                    $sql = "UPDATE users SET pwdUsers=? WHERE users_email=?";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                      echo "There was an error!";
                      exit();
                    }else{
                      $newPwdHash = password_hash($password, PASSWORD_DEFAULT); 
                      mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                      mysqli_stmt_execute($stmt);

                      $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                      $stmt = mysqli_stmt_init($conn);
                      if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "There was an error!";
                        exit();
                      }else{
                        mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../login.php?newpwd=passwordupdated");
                      }

                    }
                }
            }
        }
      }
    }

}else{
    header("Location: ../index.php");
}