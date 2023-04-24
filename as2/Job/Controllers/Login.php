<?php

namespace Job\Controllers;
class Login {
    
public function __construct(private \CSY2028\Authentication $authentication,
                            private \CSY2028\Authentication $adminAuthentication) {

}

public function login() {

return ['template' => '/login/login.html.php',
'title' => 'Log in',
'variables'=>[]
];
}

public function notAllowed() {

    return ['template' => '/login/notAllowed.html.php',
    'title' => 'Not Allowed to view this page',
    'variables'=>[]
    ];
    }
public function loginSubmit() {

$success = $this->authentication->login($_POST['email'],$_POST['password']);

if ($success) {

return ['template' => '/login/loginSuccess.html.php',
'title' => 'Log In Successful',
'variables'=>[]
];

}
else {

return ['template' => '/login/login.html.php',
'title' => 'Log in',
'variables' => [
'errorMessage' => true
]
];
}
}


public function adminlogin() {

return ['template' => '/admin/adminLoginForm.html.php',
'title' => 'Admin login',
'variables'=>[]
];
}
public function adminloginSubmit() {

$success = $this->adminAuthentication->login($_POST['email'],$_POST['password']);

if ($success) {

return ['template' => '/admin/adminLogin.html.php',
'title' => 'Log In Successful',
'variables'=>['success'=>$success]
];

}
else {

return ['template' => '/admin/adminloginForm.html.php',
'title' => 'Admin Login',
'variables' => [
'errorMessage' => true
]
];
}
}


public function logout() {
$this->authentication->logout();
header('location: /');
}

public function adminlogout() {
$this->adminAuthentication->logout();
header('location:/login/adminlogin');
}



}
?>