<?php
namespace Job\Controllers;

class Admin{
    private $adminTable;

    public function __construct($adminTable) {
              $this->adminTable = $adminTable;
    }
   
 
   
    public function delete() {
              $this->jokesTable->delete('id',$_POST['id']);
              header('location: /joke/delete');
    }

    public function editSubmit() {
    
        $admin = $_POST['admin'];
      
        $admin['password'] = password_hash($admin['password'],PASSWORD_DEFAULT);
    
      $result=$this->adminTable->save($admin);
        

      if($result){
     header('location:/admin/list');
       
      
        
    }else{
   
        return [
            'template' => '/admin/addAdmin.html.php',
            'variables' => ['admin' => $admin],
            'title' => 'Register an Account'
        ];
    }

}

    public function edit() {
            if  (isset($_GET['id'])) {
                $result = $this->adminTable->find('id', $_GET['id']);
                $admin = $result;
            }
            else  {
                $admin = false;
            }
    
            return [
                'template' => '/admin/addAdmin.html.php',
                'variables' => ['admin' => $admin
            ],
                'title' => 'Register Admin'
            ];
        }
        public function list() {
            $users = $this->adminTable->findAll();
            return ['template' => '/admin/userlist.html.php',
            'title' => 'User List',
            'variables' => [
            'users' => $users
            ]
            ];
            }
    
        public function permissions($id = null) {
               if(isset($_GET['id'])){
                $user = $this->adminTable->find('id',$_GET['id'])[0];
      }
                $reflected = new \ReflectionClass('\Job\Entity\Users');
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
                   
                    $this->adminTable->save($user);
        
                    header('location: /admin/list');
                }
    

    } 

?>