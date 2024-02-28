<?php


if(isset($_POST["reset_request_submit"])){

  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);

  $url = "http://localhost/sustainenergy/forgot_password.php/create_new_password.php?selector=". $selector. "&validator=" . $token . bin2hex($token);

  $expires = date("U") + 1800;

  require 'dbh.classes.php';

  $userEmail = $_POST["users_email"];

  //check token from user
  $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "There was an error!";
    exit();
  }else{
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
  }

  $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?)";

  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    echo "There was an error!";
    exit();
  }else{
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "s", $userEmail, $selector, $hashToken, $expires);
    mysqli_stmt_execute($stmt);
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);

  $to = $userEmail;

  $subject = 'Reset password for sustain energy';

  $message = '<p>We received a password reset request. The link to reset your password was sent to your email. If you did not make the request, you can ignore this email</p>';

  $message .= '<p>Here is your password reset link: </br>';
  $message .= '<a href="' . $url . '">' . $url . '</a></p>';

  $headers = "From: sustainenergy <usesustainenergy.gmail.com>\r\n";

  $headers .= "Replay-To: usesustainenergy@gmail.com\r\n";
  $headers .= "Content-type: text/html\r\n";
   
  mail($to, $message, $headers);
  header("Location: ../reset_password.inc.php?reset=success");

}else{
    header("location: ../index.php");
}