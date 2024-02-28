<?php

class Dbh {

    private $dbh; //Var to store the database connection

    //Connect to the database
    protected function connect(){

        try{
            $username = "root";
            $password = "";
            $this->dbh = new PDO('mysql:host=localhost; dbname=sustainenergy_db', $username, $password);
           //Set PDO to throw exception on error
           $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            //Handle connection errors
            die("Error!: " . $e->getMessage());
        }
    }

    //Get the database connection
    public function getConnection(){
        //check if connection is already on
        if(!$this->dbh){
            $this->connect();
        }
        return $this->dbh;
    }

   
}