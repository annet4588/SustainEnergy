<?php

class ProfileInfo extends Dbh{

    protected function getProfileInfo($userId){
        $stmt=$this->getConnection()->prepare('SELECT * FROM profiles WHERE users_id = ?');

        if(!$stmt->execute(array($userId))){
            $stmt=null;
            header("location: profile.php?error=stmtfailed");
            exit();
        }

        //If successful
        if($stmt->rowCount()==0){
            $stmt=null;
            header("location: profile.php?error=profilenotfound");
            exit();
        }

        //Get data from query
        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //Return data
        return $profileData;
    }

    //Update data
    protected function setNewProfileInfo($profileAbout, $profileTitle, $profileText, $userId){
        $stmt = $this->getConnection()->prepare('UPDATE profiles SET profiles_about=?, profiles_inrotitle=?, profile_introtext=? WHERE users_id=?');
    
        //Execute Statement
        if(!$stmt->execute(array($profileAbout, $profileTitle, $profileText, $userId))){
            $stmt = null;
            header("location: profile.php?error=stmtfailed");
            exit();
         }
         //Reset our Statement to make sure we close off the statement
         $stmt = null;
       }

       //Once signed we want to insert the information inside the database
       protected function setProfileInfo($profileAbout, $profileTitle, $profileText, $userId){
        //Prepared statement is a safer way to interact with the database
        //$this referencing to this class here. Grab the connect method from Dbh and Insert Values into each column - there are 4 in the profiles table  
         $stmt = $this->getConnection()->prepare('INSERT INTO profiles (profiles_about, profiles_introtitle, profiles_introtext, users_id) VALUES (?, ?, ?, ?)');
         //Execute Statement
         if(!$stmt->execute(array($profileAbout, $profileTitle, $profileText, $userId))){
            $stmt = null;
            header("location: profile.php?error=stmtfailed");
            exit();
         }
         //Reset our Statement to make sure we close up the statement
         $stmt = null;
       }

   
}


//Model Class talks to the database
    
