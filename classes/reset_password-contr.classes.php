<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;


require_once "dbh.classes.php";
require_once "reset_password.classes.php";
require_once "login.classes.php";
require_once '../helpers/session_helper.php';
include_once "create_new_password.php";

//Required PHP Mailer
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/SMTP.php';


class ResetPasswords {
    private $resetModel;
    private $userModel;
    private $mail;

    public function __construct(){
        $this->resetModel = new ResetPassword();
        $this->userModel = new Login();

        //Setup PHPMailer
        // Initialize PHPMailer object
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.mailtrap.io';
        $this->mail->SMTPAuth = true;
        $this->mail->Port = 2525;
        $this->mail->Username = '81065248f75a57';
        $this->mail->Password = '30f9bf3fff698a';
    }


    //Method to send email
    public function sendEmail(){
        //Sanitise POST data
        $usersEmail = filter_input(INPUT_POST, 'users_email', FILTER_VALIDATE_EMAIL);
        $usersEmail = trim($usersEmail);

        if(empty($usersEmail)){
            flash("reset", "Please input email");
            header("location:../forgot_password.php");
        }

         //Will be used to query the user from the database
         $selector = bin2hex(random_bytes(8));
         //Will be used for confirmation once the database entry has been matched
         $token = random_bytes(32);
         $url = 'http://localhost/sustainenergy/create_new_password.php?selector=' . $selector . '&validator=' . bin2hex($token);

         
   
         $expires = date("U") + 1800;
        if(!$this->resetModel->deleteEmail($usersEmail)){
            die("There was an error");
        }

        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        if(!$this->resetModel->insertToken($usersEmail, $selector, $hashedToken, $expires)){
          die("There was an error");
        }

        //Can send Email now
        $subject = "Reset your password";
        $message = "<p>We recieved a password reset request.</p>";
        $message .= "<p>Here is your password reset link: </p>";
        $message .= "<a href='".$url."'>".$url."</a>";

        $this->mail->setFrom('TheBoss@gmail.com');
        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        $this->mail->addAddress($usersEmail);

        $this->mail->send();

        flash("reset", "Check your email", 'form-message form-message-green');
        header("location: ../forgot_password.php");
    }

    //Method to rest password
    public function resetPassword(){
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST);
        $data = [
            'selector' => trim($_POST['selector']),
            'validator' => trim($_POST['validator']),
            'pwd' => trim($_POST['pwd']),
            'pwd-repeat' => trim($_POST['pwd-repeat'])
        ];
        $url = 'create-new-password.php?selector='.$data['selector'].'&validator='.$data['validator'];
    
        if(empty($_POST['pwd']) || empty($_POST['pwd-repeat'])){ // Fix empty check condition
            flash("newReset", "Please fill out all fields");
            redirect($url);
        }else if($data['pwd'] != $data['pwd-repeat']){
            flash("newReset", "Passwords do not match");
            redirect($url);
        }else if(strlen($data['pwd']) < 6){ // Correct password length validation
            flash("newReset", "Password must be at least 6 characters long");
            redirect($url);
        }
    
        $currentDate = date("U");
        $row = $this->resetModel->resetPassword($data['selector'], $currentDate);
        if(!$row){
            flash("newReset", "Sorry. The link is no longer valid");
            redirect($url);
        }
    
        $tokenBin = hex2bin($data['validator']);
        $tokenCheck = password_verify($tokenBin, $row->pwdResetToken); // Use array access for result
        if(!$tokenCheck){
            flash("newReset", "You need to re-Submit your reset request");
            redirect($url);
        }
    
        $tokenEmail = $row->pwdResetEmail; // Access properties using ->
        $foundUser = $this->userModel->findUserByEmailOrPassword($tokenEmail, $tokenEmail);
        if(!$foundUser){
            flash("newReset", "There was an error");
            redirect($url);
        }
    
        $newPwdHash = password_hash($data['pwd'], PASSWORD_DEFAULT);
        if(!$this->userModel->resetPassword($newPwdHash, $tokenEmail)){
            flash("newReset", "There was an error");
            redirect($url);
        }
    
        if(!$this->resetModel->deleteEmail($tokenEmail)){
            flash("newReset", "There was an error");
            redirect($url);
        }
    
        flash("newReset", "Password Updated", 'form-message form-message-green');
        redirect("../login.php");
    }
    
}


$init = new ResetPasswords;

//Ensure that user is sending a post request, 2 Post requests send and rest
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //The value of hidden input in the forgotPassword form
    switch($_POST['type']){
        case 'send':
            $init->sendEmail();
            break;
        case 'reset':
            $init->resetPassword();
            break;
        }
}else{
    header("location: ../login.php");
 
}