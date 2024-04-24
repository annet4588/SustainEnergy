<?php

class Dbh {

    private $dbh; //Var to store the database connection
    private $host = "localhost";
    private $dbname = "sustainenergy_db";
    private $dbusername = "root";
    private $dbpassword = "";

    //Connect to the database
    protected function connect(){

        try{
            $this->dbh = new PDO('mysql:host=' . $this->host .'; dbname='. $this->dbname, $this->dbusername, $this->dbpassword);
           //Set PDO to throw exception on error
           $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           return $this->dbh;
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