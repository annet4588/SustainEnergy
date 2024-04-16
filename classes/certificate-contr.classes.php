<?php

class CertificateContr extends Certificate{
    private $userId;
    private $companyName;
    private $completionDate;
    private $certificateType;
    private $approvedBy;
    private $certificateImg;


    public function __construct($userId, $companyName, $completionDate, $certificateType, $approvedBy, $certificateImg){

    $this->userId = $userId;
    $this->companyName = $companyName;
    $this->completionDate = $completionDate;
    $this->certificateType = $certificateType;
    $this->approvedBy = $approvedBy;
    $this->certificateImg = $certificateImg;
   
    }

    //Public method to call the private certificate
   public function processCertificate(){
    try{
        $this->createCertificate();
    }catch(Exception $e){
        echo "An error occurred: " . $e->getMessage();
        }
    }

    //Method to create certificate
    private function createCertificate(){
        if(!$this->emptyInput()){
            throw new Exception("emptyinput");
        }
        $this->setCertificateId($this->userId, $this->companyName,$this->completionDate, $this->certificateType, $this->approvedBy, $this->certificateImg);
    }
   
    //Method to check if any empty input
    private function emptyInput(){
        return !(empty($this->userId) || empty($this->companyName) || empty($this->completionDate) || empty($this->certificateType) || empty($this->approvedBy) || empty($this->certificateImg));
    }

    //Method to get the Certificate ID
    public function fetchCertificateID($userId){
        $phid = $this->getCertificateIds($userId);
        return $phid[0]['purchase_id'];
     }


}