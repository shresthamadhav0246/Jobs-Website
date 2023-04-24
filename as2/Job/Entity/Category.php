<?php
namespace Job\Entity;

class Category {
 private $jobsTable;
 
 public $id;
 public $name;

 public function __construct(\CSY2028\DatabaseTable $jobsTable) {
 $this->jobsTable = $jobsTable;
 }
 public function getJobs() {
 return $this->jobsTable->find('categoryId', $this->id);
 }
}