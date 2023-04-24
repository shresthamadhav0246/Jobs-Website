<?php
require 'Job/Controllers/Login.php';
require 'CSY2028/Authentication.php';

class LoginTest extends \PHPUnit\Framework\TestCase {


private $controller;

  public function setUp() {

    $this->authentication = $this->getMockBuilder(\CSY2028\Authentication::class)
        ->disableOriginalConstructor()
        ->getMock();
    $this->adminAuthentication = $this->getMockBuilder(\CSY2028\Authentication::class)
        ->disableOriginalConstructor()
        ->getMock();
    $this->controller = new \Job\Controllers\Login($this->authentication, $this->adminAuthentication);
  }
  
  public function testLoginSuccess() {

    $this->authentication->expects($this->once())
        ->method('login')
        ->with($this->equalTo('test@email.com'), $this->equalTo('testPassword'))
        ->willReturn(true);
    $_POST['email'] = 'test@email.com';
    $_POST['password'] = 'testPassword';
    
    $result = $this->controller->loginSubmit();
    $this->assertEquals($result['template'], 'loginSuccess.html.php');
    $this->assertEquals($result['title'], 'Log In Successful');
    $this->assertEmpty($result['variables']);
  }
  
  public function testLoginFailed() {
    $this->authentication->expects($this->once())
        ->method('login')
        ->with($this->equalTo('test@email.com'), $this->equalTo('testPassword'))
        ->willReturn(false);
    $_POST['email'] = 'test@email.com';
    $_POST['password'] = 'testPassword';
    $result = $this->controller->loginSubmit();
    $this->assertEquals($result['template'], 'login.html.php');
    $this->assertEquals($result['title'], 'Log in');
    $this->assertArrayHasKey('errorMessage', $result['variables']);
  }

  public function testAdminLoginSuccess() {
    $this->adminAuthentication->expects($this->once())
        ->method('login')
        ->with($this->equalTo('test@email.com'), $this->equalTo('testPassword'))
        ->willReturn(true);
    $_POST['email'] = 'test@email.com';
    $_POST['password'] = 'testPassword';
    $result = $this->controller->adminloginSubmit();
    $this->assertEquals($result['template'], '/admin/adminLogin.html.php');
    $this->assertEquals($result['title'], 'Log In Successful');
    $this->assertArrayHasKey('success', $result['variables']);
  }

}
