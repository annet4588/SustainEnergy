<?php
class ResetPassword extends Dbh{

  
    public function deleteEmail($email) {
        $stmt = $this->getConnection()->prepare('DELETE FROM pwdreset WHERE pwdResetEmail=:email');
        $stmt->bindParam(':email', $email);

        // Execute
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
   
    public function insertToken($email, $selector, $hashedToken, $expires) {
        $conn = $this->getConnection();
        $stmt = $conn->prepare('INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (:email, :selector, :token, :expires)');
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':selector', $selector);
        $stmt->bindParam(':token', $hashedToken); // hashedToken instead of $hashedToken
        $stmt->bindParam(':expires', $expires);

        // Execute
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function resetPassword($selector, $currentDate){
        $conn = $this->getConnection();
        $stmt = $conn->prepare('SELECT * FROM pwdreset WHERE pwdResetSelector=:selector AND pwdResetExpires>=:currentDate');
        $stmt->bindParam(':selector', $selector);
        $stmt->bindParam(':currentDate', $currentDate);
        $stmt->execute();

        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_OBJ);

        // Check row
        if($stmt->rowCount() > 0){
            return $row;
        } else {
            return false;
        }

    }
}