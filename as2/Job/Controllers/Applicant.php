<?php
namespace Job\Controllers;

class Applicant {
 private $applicantsTable;
 private $jobsTable;


 public function __construct($applicantsTable,$jobsTable) {
           $this->applicantsTable = $applicantsTable;
           $this->jobsTable = $jobsTable;
 }

 public function list() {
    if(isset($_GET['id'])){
           $applicants = $this->applicantsTable->find('jobId',$_GET['id']);
           $job=$this->jobsTable->find('id',$_GET['id'])[0];
           
           return ['template' => '/admin/applicant.html.php', 
           'title' => 'Applicant Details',
           'variables' => [
           'applicants' => $applicants,
           'job'=>$job
           ]
           ];
        } 
 }

 public function delete() {
           $this->applicantsTable->delete('id',$_POST['id']);
           header('location: /joke/delete');
 }

 public function editSubmit() {
   
		if ($_FILES['cv']['error'] == 0) {

			$parts = explode('.', $_FILES['cv']['name']);

			$extension = end($parts);

			$fileName = uniqid() . '.' . $extension;

			move_uploaded_file($_FILES['cv']['tmp_name'], 'cvs/' . $fileName);

			$applicant = [
				'name' => $_POST['name'],
				'email' => $_POST['email'],
				'details' => $_POST['details'],
				'jobId' => $_POST['jobId'],
				'cv' => $fileName
			];

  $this->applicantsTable->insert($applicant);
   
    return [
        'template' => '/applicant/applied.html.php',
        'variables' => [],
        'title' => 'Job Applied',
        
    ];
  }else{
    echo 'Failed to upload file';
  }
   


 }

public function edit() {
    if(isset($_GET['id'])){
    $job=$this->jobsTable->find('id',$_GET['id'])[0];
       

       return [
           'template' => '/applicant/job-apply.html.php',
           'variables' => ['job' => $job],
           'title' => 'Job Apply',
           
       ];
    }
   }

}

