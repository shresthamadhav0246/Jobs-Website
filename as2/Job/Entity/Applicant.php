<?php
namespace Job\Entity;

class Applicant {
 private $jobsTable;
 
 public $id;
 public $name;
 public $email;
 public $details;
 public $jobId;
 public $cv;
 

 public function __construct(\CSY2028\DatabaseTable $jobsTable) {
 $this->jobsTable = $jobsTable;
 }
 public function getJobByApplicant() {
 return $this->jobsTable->find('id', $this->jobId);
 }
}