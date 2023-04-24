<?php
namespace Job\Controllers;

class Job{
    private $jobsTable;
    private $categoriesTable;
    private $locationsTable;
    private $adminAuthentication;
    private $adminTable;
    private $get;
    private $post;
    
    public function __construct($jobsTable,
                                $categoriesTable,
                                $locationsTable,
                                $adminAuthentication,
                                $adminTable,
                                array $get,
                                array $post
    ){
              $this->jobsTable = $jobsTable;
              $this->categoriesTable=$categoriesTable;
              $this->locationsTable=$locationsTable;
              $this->adminAuthentication=$adminAuthentication;
              $this->adminTable=$adminTable;
              $this->get=$get;
              $this->post=$post;
    }
   
    public function list(){
        if(isset($_GET['id'])){
        $jobs= $this->jobsTable->find('categoryId',$_GET['id']);
        }
        else{
            $jobs = $this->jobsTable->find('status','active');  
        }
        $user = $this->adminAuthentication->getUser();
        $categories = $this->categoriesTable->findAll();
        $locations = $this->locationsTable->findAll();
        return ['template' => '/jobs/jobs-list.html.php', 
              'title' => 'Job List',
              'variables' => [
              'jobs' => $jobs,
              'userId'=>$user->id ?? null,
                                'categories'=>$categories,
                                'locations'=>$locations
            
            ]
              ];
    }


public function manageJobs(){
  
    $jobs= $this->jobsTable->find('status','active');
    $user = $this->adminAuthentication->getUser();

    foreach($jobs as $job) {
        $job->applicantCount = $this->getApplicantCount($job->id);
       
    }
    $categories = $this->categoriesTable->findAll();
    return ['template' => '/admin/manageJobs.html.php', 
    'title' => 'Manage Jobs',
    'variables' => [
    'jobs' => $jobs, 'categories'=>$categories,
     'userId'=>$user->id ?? null,
     'user'=>$user  
    ]
    ];
}
   
public function delete() {
        $this->jobsTable->delete('id',$_POST['id']);
        header('location: /job/manageJobs');

    }
    public function deleteSubmit() {
    if(isset($_POST['submit'])){
        $this->jobsTable->delete('id',$_POST['id']);
        header('location: /job/manageJobs');
}
    }


    public function editSubmit($id = null) {
        $errors = $this->validateJob($this->post['job']);

        $user= $this->adminAuthentication->getUser();
       
        if(!empty($id)){
            $job=$this->jobsTable->find('id',$id)[0];

            if($job->userId != $user->id){
                return;
            }
        }

       $job['userId'] = $user->id;
   
       if (count($errors) == 0) {

       $this->jobsTable->save($this->post['job']);
    //    return '/job/manageJobs';
    header('location:/job/manageJobs');
       }
      else{
               header('location: /job/edit');
      }
       }
      
   
    public function edit($id = null) {
        if (isset($id)) {
	        $job = $this->jobsTable->find('id', $id)[0] ?? null;
	    }
	    else {
	    	$job = null;
        }
        
        $user = $this->adminAuthentication->getUser();
        $categories = $this->categoriesTable->findAll();
        $locations = $this->locationsTable->findAll();

           return [
               'template' => '/admin/editJob.html.php',
               'variables' => ['job' => $job,
                                'userId'=>$user->id ?? null,
                                'categories'=>$categories,
                                'locations'=>$locations
            ],
               'title' => 'Edit Job',
               
           ];
       }

public function jobFilter(){
    $jobs = $this->jobsTable->find('status','active'); 
    $location = isset($_GET['location']) ? $_GET['location'] : null;
    $category = isset($_GET['category']) ? $_GET['category'] : null;
    if ($location) {
        $jobs = array_filter($jobs, function($job) use ($location) {
            return $job;
        
    });
    }
  
    if ($category) {
        $jobs = array_filter($jobs, function($job) use ($category) {
            return $job->getCategory()->id == $category;
        });
    }
    return ['template' => '/jobs/filterJobs.html.php', 
        'title' => 'Job List',
        'variables' => [
            'jobs' => $jobs
        ]
    ];
}
public function jobFilterByCategory(){
    $jobs = $this->jobsTable->find('status','active');
    $category = isset($_GET['category']) ? $_GET['category'] : null;
    $categories = $this->categoriesTable->findAll();
    $user = $this->adminAuthentication->getUser();
    foreach($jobs as $job) {
        $job->applicantCount = $this->getApplicantCount($job->id);
       
    }
    if ($category) {
        $jobs = array_filter($jobs, function($job) use ($category) {
            return $job->getCategory()->id == $category;
        });
    }
    return ['template' => '/admin/manageJobs.html.php', 
        'title' => 'Job List',
        'variables' => [
            'jobs' => $jobs,'categories'=>$categories,
            'user'=>$user
        ]
    ];
}

public function archiveJob()
{
    if (isset($_GET['id'])) {
        $job = [
            'id' => $_GET['id'],
            'status' => 'archived'  
        ];

        $this->jobsTable->update($job);

        header('location: /job/manageJobs');
    }
}
 public function archivedJobs(){
    $jobs=$this->jobsTable->find('status','archived');

 return[
      'template'=>'/admin/archivedJobs.html.php',
      'title'=>'Archived Jobs',
      'variables'=>[
        'jobs'=>$jobs
      ]
      ];

 }
public function getArchivedJobs(){
    if (isset($_GET['id'])) {
        $job = [
            'id' => $_GET['id'],
            'status' => 'active'
        ];

        $this->jobsTable->update($job);

        header('location: /job/manageJobs');
    }
}

public function home(){
    $jobs = $this->jobsTable->find('status', 'active');
    usort($jobs, function($a, $b){
      return strtotime($a->closingDate) - strtotime($b->closingDate);
    });
    $jobs = array_slice($jobs, 0, 10);
  
    return ['template' => '/jobs/home.html.php', 
    'title' => 'Home Page',
    'variables' => [
    'jobs' => $jobs
    ]
    ];
  }
  
  public function getApplicantCount($jobId) {
    require '../connection/connection.php';
    $applicants = $pdo->prepare('SELECT COUNT(*) as count FROM applicants WHERE jobId = :jobId');
    $applicants->execute(['jobId' => $jobId]);
    return $applicants->fetch()['count'];
}

  public function validateJob($job) {
    $errors = [];
    if ($job['title'] == '') {
    $errors[] = 'You must enter a Job title';
    }
    if ($job['description'] == '') {
    $errors[] = 'You must enter a description';
    }
    if ($job['salary'] == '') {
    $errors[] = 'You must enter an Salary';
    }
    if ($job['locationId'] == '') {
    $errors[] = 'You must select a location';
    } 
    if ($job['categoryId'] == '') {
    $errors[] = 'You must select a category';
    } 
    if ($job['closingDate'] == '') {
    $errors[] = 'You must enter a Closing date';
    } 
    return $errors;
    }
   
   }

?>