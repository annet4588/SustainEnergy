<?php
class Search extends Dbh{

     //Search Activity
     public function searchActivity($query){
        try{
            $stmt=$this->getConnection()->prepare("SELECT * FROM activity WHERE activity_name LIKE ?");
            $stmt->execute(["%$query%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
        // Handle database connection or query errors
        throw new Exception("Database error: " . $e->getMessage());
        }
    }
}