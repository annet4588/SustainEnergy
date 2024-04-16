<?php
class CertificateView extends Certificate{

    //Method to get all Details
    public function fetchCertificate($userId){
        $certificate = $this->getCertificate($userId);
        //Array
        return $certificate; //To return as array 
    }

       //Method to get a single ID
       public function fetchCertificateSingleId($userId){
        $certificate = $this->getCertificateIds($userId);
        return $certificate[0]; //To return as single field
    }
     //Method to get a certificate ID
     public function fetchCertificatecId($userId){
        $certificate = $this->getCertificateIds($userId);
        return $certificate[0]['certificate_id'];     
    }

     //Method to get a Company name
     public function fetchCompanyName($userId,){
        $certificate = $this->getCertificateIds($userId);
        return $certificate[0]['completed_by'];     
    }
     //Method to get a Completion date
     public function fetchCompletionDate($userId){
        $certificate = $this->getCertificateIds($userId);
        return $certificate[0]['completion_date'];     
    }
     //Method to get a Certificate type
     public function fetchCertificateType($userId){
        $certificate = $this->getCertificateIds($userId);
        return $certificate[0]['certificate_type'];     
    }
     //Method to get a name approvedBy
     public function fetchApprovedBy($userId){
        $certificate = $this->getCertificateIds($userId);
        return $certificate[0]['approved_by'];     
    }
     //Method to get an image
     public function fetchImage($userId){
        $certificate = $this->getCertificateIds($userId);
        return $certificate[0]['certificate_img'];     
    }
}

