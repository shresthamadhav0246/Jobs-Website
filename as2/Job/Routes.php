<?php
namespace Job;

class Routes implements \CSY2028\Routes {
   private ?\CSY2028\DatabaseTable $usersTable;
   private ?\CSY2028\DatabaseTable $jobsTable;
   private ?\CSY2028\DatabaseTable $applicantsTable;
   private ?\CSY2028\DatabaseTable $jobCategoriesTable;
   private ?\CSY2028\DatabaseTable $enquiresTable;
   private \CSY2028\Authentication $authentication;
   private \CSY2028\Authentication $adminAuthentication;
   
   public function __construct() {
   require '../connection/connection.php';

   $this->jobsTable = new \CSY2028\DatabaseTable($pdo, 'job', 'id','\Job\Entity\Job',[&$this->categoriesTable,&$this->locationsTable,&$this->adminTable]);
   $this->categoriesTable = new \CSY2028\DatabaseTable($pdo, 'category', 'id','\Job\Entity\Category',[&$this->jobsTable]);
   $this->applicantsTable=new \CSY2028\DatabaseTable($pdo,'applicants','id','\Job\Entity\Applicant',[&$this->jobsTable]);
   $this->usersTable=new \CSY2028\DatabaseTable($pdo, 'user', 'id');
   $this->authentication = new \CSY2028\Authentication($this->usersTable,'email', 'password');
   $this->locationsTable=new \CSY2028\DatabaseTable($pdo,'location','id');
   $this->adminTable=new \CSY2028\DatabaseTable($pdo,'admin','id','\Job\Entity\Users',[&$this->jobsTable]);
   $this->adminAuthentication = new \CSY2028\Authentication($this->adminTable,'email', 'password');
   $this->jobCategoriesTable=new \CSY2028\DatabaseTable($pdo,'job_category','categoryId');
   $this->enquiresTable= new \CSY2028\DatabaseTable($pdo,'enquiry','id');
}

public function getController($name){
 $controllers = []; 
 $controllers['job'] = new \Job\Controllers\Job($this->jobsTable,
                                                $this->categoriesTable,
                                                $this->locationsTable,
                                                $this->adminAuthentication,
                                                $this->adminTable,
                                                $_GET,
                                                $_POST);
 $controllers['category'] = new \Job\Controllers\Category($this->categoriesTable);
 $controllers['applicant']=new \Job\Controllers\Applicant($this->applicantsTable,$this->jobsTable);
 $controllers['user'] =new \Job\Controllers\User($this->usersTable);
 $controllers['location']=new \Job\Controllers\Location($this->locationsTable);
 $controllers['admin']=new \Job\Controllers\Admin($this->adminTable);
 $controllers['login']=new \Job\Controllers\Login($this->authentication,$this->adminAuthentication);
 $controllers['faqs']=new \Job\Controllers\FAQs();
 $controllers['enquiry']= new \Job\Controllers\Enquiry($this->enquiresTable);

 return $controllers[$name];
 }

 public function getDefaultRoute(){
    return 'job/home';
 }

 
 public function checkLogin($route) {

   $restrictedPages = ['applicant/edit'=>true,
                      'job/edit'=> \Job\Entity\Users::EDIT_JOB,  
                      'job/delete'=> \Job\Entity\Users::DELETE_JOB,  
                     'category/list' => \Job\Entity\Users::LIST_CATEGORIES,
                     'category/delete' => \Job\Entity\Users::DELETE_CATEGORY,
                     'category/edit' => \Job\Entity\Users::EDIT_CATEGORY,
                     'admin/edit' => \Job\Entity\Users::EDIT_USER,
                     'admin/list' => \Job\Entity\Users::EDIT_USER_ACCESS,
                     'applicant/list' => \Job\Entity\Users::APPLICANT_LIST,
                     'job/archiveJob' => \Job\Entity\Users::ARCHIVE_JOB

                    
];

if (isset($restrictedPages[$route])) {
   
   if ($restrictedPages[$route] === true) {
      if (!$this->authentication->isLoggedIn()) {
          header('location: /login/login');
          exit();
      }
  } else {
      if (!$this->adminAuthentication->isLoggedIn()
          || !$this->adminAuthentication->getUser()->hasPermission($restrictedPages[$route])) {
          header('location: /login/notAllowed');
          exit();
      }

 return $route;
}
}
 }
   public function getLayoutVariables(): array {
      return [
      'loggedIn' => $this->authentication->isLoggedIn()
     
      ];
     
      }
      
   }


?>