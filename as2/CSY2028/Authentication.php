<?php
namespace CSY2028;

class Authentication {

public function __construct(private DatabaseTable $users, private string $usernameColumn,
 private string $passwordColumn)

 {
  if (session_status() == PHP_SESSION_NONE){
session_start();
}
 }

public function login(string $username, string $password): bool 
    {
    $users = $this->users->find($this->usernameColumn, strtolower($username)); 
    $user = json_decode(json_encode($users), true);
         if (!empty($user) && password_verify($password, $user[0][$this->passwordColumn]))
          {
                 session_regenerate_id();
                 $_SESSION['username'] = $username;
                 $_SESSION['password'] = $user[0][$this->passwordColumn];
                 return true;
       }  else {
     return false;
   }
  }

public function isLoggedIn(): bool {
       if (empty($_SESSION['username'])) {
       return false;
}
      $users = $this->users->find($this->usernameColumn, strtolower($_SESSION['username']));
      $user = json_decode(json_encode($users), true);
    if (!empty($user) && $user[0][$this->passwordColumn] === $_SESSION['password']) {
      return true;
  } else {
  return false;
 }
}


public function logout() {
unset($_SESSION['username']);
unset($_SESSION['password']);
session_regenerate_id();
}


public function getUser(): ?object {
  if ($this->isLoggedIn()) {
    return $this->users->find($this->usernameColumn, strtolower($_SESSION['username']))[0];
  }
  else {
    return null;
  }
}
}

