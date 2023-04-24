<?php
namespace tests;
require 'Job/Controllers/User.php';


class RegisterUserTest extends \PHPUnit\Framework\TestCase {

 private $controller;

 public function setUp() {

    $pdo=new \PDO('mysql:host=mysql;dbname=job;charset=utf8', 'student', 'student');
 $usersTable = new \CSY2028\DatabaseTable($pdo, 'user', 'id');
 $this->controller = new \Job\Controllers\User($usersTable);
 }


  public function testEditSubmitInvalid() {
    $user = [
      'firstname' => '',
      'surname' => '',
      'email' => '',
      'password' => ''
    ];
    
    $_POST['user'] = $user;
  
    $result = $this->controller->editSubmit();
  
    $expectedResult = [
      'template' => 'register.html.php',
      'variables' => ['user' => $user],
      'title' => 'Register an Account'
    ];
    $this->assertEquals($expectedResult, $result);
  }
  

  public function testList() {
    $user=[
        'id'=>1,
        'firstname' =>'user',
        'surname' =>'user',
        'email'=>'user@gmail.com',
        'password'=>'user'
    ];
        $expectedResult = ['template' => '/admin/userlist.html.php',
          'title' => 'User List',
          'variables' => [
          'user' => $user
          ]
        ];
        
        $result = $this->controller->list();
        
        $this->assertEquals($expectedResult, $result);
      }
      

}