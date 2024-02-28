<?php

class Search extends Dbh{

     //Search Activity
     public function searchActivity($query){
        $stmt=$this->getConnection()->prepare("SELECT * FROM activity WHERE activity_name LIKE ?");
        $stmt->execute(["%$query%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}