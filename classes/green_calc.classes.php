<?php

class GreenCalcInfo extends Dbh {
  
  // Method to get GreenCalc info
  public function getGreenCalcInfo($gcid, $userId) {
    try {
      $stmt = $this->getConnection()->prepare('SELECT * FROM greencalc WHERE greencalc_id=? AND users_id=?');
      $stmt->execute(array($gcid, $userId));
      
      if ($stmt->rowCount() == 0) {
        throw new Exception("green_calcnotfound");
      }
      
      // Get Green_calc Info from query
      $greenCalcData = $stmt->fetch(PDO::FETCH_ASSOC);
      return $greenCalcData;
      
    } catch (PDOException $e) {
      // Handle PDO exceptions
      throw new Exception("Database error: " . $e->getMessage());
    } catch (Exception $e) {
      // Handle other exceptions
      throw $e;
    }
  }
  
  // Method to get GreenCalc info Ids from database **
  protected function getGreenCalcInfoIds($gcid) {
    // Prepare the SQL statement
    $stmt = $this->getConnection()->prepare('SELECT greencalc_id FROM greencalc WHERE users_id=?;');
    
    try {
        // Attempt to execute the SQL statement
        $stmt->execute(array($gcid));
    } catch (PDOException $e) {
        // Handle PDO exceptions
        throw new Exception("Database error: " . $e->getMessage());
    }

    // If no results found
    if ($stmt->rowCount() == 0) {
        // Handle the case where no green calc IDs are found
        return null; // or handle differently as per your application logic
    }

    // Fetch the result
    $greenCalcIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Close the statement
    $stmt = null;

    // Return the fetched green calc IDs
    return $greenCalcIds;
}
  


// Method to set GreenCalc info
public function setGreenCalcInfoId($totalScore, $voucherAmount, $createdAt, $userId) {
  
    $stmt = $this->getConnection()->prepare('INSERT INTO greencalc(total_score, voucher_amount, created_at,  users_id) VALUES (?, ?, ?, ?)');
    try {
    $stmt->execute(array($totalScore, $voucherAmount, $createdAt, $userId));

    // return $gcid;
  } catch (PDOException $e) {
    // Handle PDO exceptions
    throw new Exception("Database error occurred while setting Green Calculator information: " . $e->getMessage());
  }
   // Close the statement
   $stmt = null;
}

// Method to update GreenCalc Info 
public function updateGreenCalcInfo($gcid, $totalScore, $voucherAmount) {
  try {
    $stmt = $this->getConnection()->prepare('UPDATE greencalc SET total_score=?, voucher_amount=?,  WHERE greencalc_id=?');
    $stmt->execute(array($totalScore, $voucherAmount,  $gcid));
  } catch (PDOException $e) {
    // Handle PDO exceptions
    throw new Exception("Database error occurred while updating Green Calculator information: " . $e->getMessage());
  }
}

  // Method to update GreenCalc Info 
  public function setNewGreenCalcInfo($totalScore, $voucherAmount, $createdAt, $userId) {
    try {
      $stmt = $this->getConnection()->prepare('UPDATE greencalc SET total_score=?, voucher_amount=?, created_at=? WHERE greencalc_id=? AND users_id=?');
      $stmt->execute(array($totalScore, $voucherAmount, $createdAt, $userId));
    } catch (PDOException $e) {
      // Handle PDO exceptions
      throw new Exception("database_error");
    } catch (Exception $e) {
      // Handle other exceptions
      throw $e;
    }
  }


}
