<?php
namespace MockDatabase;
class MockDatabaseJobsTable {
   public $valid=false;
 public function save($data) {
    if ($data['id']=='20'
    &&$data['title'] == 'Test Job Title'
    && $data['description'] == 'Test Job Description'
    && $data['categoryId'] == 1
    && $data['locationId'] == 1
    && $data['salary'] == 50000
    &&$data['closingDate']=='2024-01-01'
    &&$data['userId'] == '1')
    {
    $this->valid ='manageJobs.html.php';
 }
}
 public function getUser()
 {
     return (object) ['id' => 1];
 }
 }

?>