<?php
namespace Job\Controllers;


 class User{
    private $usersTable;
 

    public function __construct($usersTable){
        $this->usersTable=$usersTable;
       
    }

    public function list() {
        $users = $this->usersTable->findAll();
        return ['template' => '/admin/userlist.html.php',
        'title' => 'User List',
        'variables' => [
        'users' => $users
        ]
        ];
        }

    public function permissions($id = null) {
           if(isset($_GET['id'])){
            $user = $this->usersTable->find('id',$_GET['id'])[0];
  }
            $reflected = new \ReflectionClass('\Job\Entity\User');
            $constants = $reflected->getConstants();

            return ['template' => '/admin/permissions.html.php',
            'title' => 'Edit Permissions',
            'variables' => [
            'user' => $user,
            'permissions' => $constants,
            ]
            ];
            
        }
        public function permissionsSubmit() {
                $user = [
                    'id' => $_POST['id'],
                    'permissions' => array_sum($_POST['permissions'] ?? [])
                ];
               
                $this->usersTable->save($user);
    
                header('location: /user/list');
            }

            

        public function editSubmit() {
           
        
            $user = $_POST['user'];

            // Assume the data is valid to begin with
            $valid = true;
            $errors = [];
           
            if (empty($user['firstname'])) {
            $valid = false;
            $errors[] = 'Firstname cannot be blank';
            }

            if (empty($user['surname'])) {
            $valid = false;
            $errors[] = 'Surname cannot be blank';
            }

            if (empty($user['email'])) {
            $valid = false;
            $errors[] = 'Email cannot be blank';
            } 
            elseif (
                filter_var($user['email'],
            FILTER_VALIDATE_EMAIL) == false) 
            {
            $valid = false;
            $errors[] = 'Invalid email address';
            } 
            else 
            { 
            $user['email'] = strtolower($user['email']);
            
            if (count($this->usersTable->find('email',
            $user['email'])) > 0) {
            $valid = false;
            $errors[] = 'That email address is already
            registered';
            }
            }
            if (empty($user['password'])) {
            $valid = false;
            $errors[] = 'Password cannot be blank';
            }
         
            if ($valid == true) {
          
            $user['password'] = password_hash($user['password'],PASSWORD_DEFAULT);
        
          $this->usersTable->save($user);
          header('location:/login/login');
            }      
           else{
       
            return [
                'template' => '/users/register.html.php',
                'variables' => ['user' => $user],
                'title' => 'Register an Account'
            ];
        }
    }


        public function edit() {
                if  (isset($_GET['id'])) {
                    $result = $this->usersTable->find('id', $_GET['id']);
                    $user = $result;
                }
                else  {
                    $user = false;
                }
        
                return [
                    'template' => '/users/register.html.php',
                    'variables' => ['user' => $user
                ],
                    'title' => 'Register an Account'
                ];
            }

        public function addUser() {
                if  (isset($_GET['id'])) {
                    $result = $this->usersTable->find('id', $_GET['id']);
                    $user = $result;
                }
                else  {
                    $user = false;
                }
        
                return [
                    'template' => '/admin/addUser.html.php',
                    'variables' => 
                    ['user' => $user
        
                     ],
                    'title' => 'Register an Account'
                ];
            }

         public function addUserSubmit(){
            $user = $_POST['user'];
            $user['password'] = password_hash($user['password'],PASSWORD_DEFAULT);
        
            $result=$this->usersTable->save($user);
              
           if($result){
           header('location:/user/list');
             
            
              
          }else{
         
              return [
                  'template' => '/admin/addUser.html.php',
                  'variables' => ['user' => $user],
                  'title' => 'Register an Account'
              ];
          
         }

   
 }
 }
?>