<?php
namespace Job\Entity;

class Job {
 private $categoriesTable;
 private $locationsTable;
 
 public $id;
 public $title;
 public $description;
 public $salary;
 public $closingDate;
 public $categoryId;
 public $locationId;
 private ?object $user;

 public function __construct(\CSY2028\DatabaseTable $categoriesTable,
                              \CSY2028\DatabaseTable $locationsTable,
                               \CSY2028\DatabaseTable $adminTable
                                ) {
 
             $this->categoriesTable = $categoriesTable;
             $this->locationsTable=$locationsTable;
             $this->adminTable=$adminTable;
            

 }
 public function getCategory() {
 return $this->categoriesTable->find('id', $this->categoryId)[0];
 }

 public function getLocation(){
    return $this->locationsTable->find('id',$this->locationId);
 }
 
 public function getUser() {
   if (empty($this->user)) {
   $this->user = $this->adminTable->find('id', $this->userId)[0];
   }
   return $this->user;
   }
   

}