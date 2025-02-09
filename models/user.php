<?php

abstract class User
{
  protected $id;
  protected $username;
  protected $email;
  protected $role;
  protected $password;
  protected $is_suspended;
  protected $created_at;

  public function __construct($username, $email, $role, $password, $is_suspended = false)
  {
    $this->username = $username;
    $this->email = $email;
    $this->role = $role;
    $this->password = $password;
    $this->is_suspended = $is_suspended;
    $this->created_at = date('Y-m-d H:i:s');
    ;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getUsername()
  {
    return $this->username;
  }
  public function setUsername($username)
  {
    $this->username = $username;
  }

  public function getEmail()
  {
    return $this->email;
  }
  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getRole()
  {
    return $this->role;
  }
  public function setRole($role)
  {
    $this->role = $role;
  }

  public function getPassword()
  {
    return $this->password;
  }
  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function getIsSuspended()
  {
    return $this->is_suspended;
  }
  public function setIsSuspended($is_suspended)
  {
    $this->is_suspended = $is_suspended;
  }

  public function getCreatedAt()
  {
    return $this->created_at;
  }
  public function setCreatedAt($created_at)
  {
    $this->created_at = $created_at;
  }

  //static methods

  public static function checkEmailExist($db, $email)
  {
    $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    return $stmt->fetch() ? true : false;
  }

  public static function checkRole($db, $email)
  {
    $stmt = $db->prepare("SELECT role FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    return $stmt->fetchColumn();
  }



  //methods
  
  public function loadUserByEmail($db)
  {
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $this->email);
    $stmt->execute();

    $user = $stmt->fetch();

    if ($user) {
      $this->id = $user['id'];
      $this->username = $user['username'];
      $this->email = $user['email'];
      $this->role = $user['role'];
      $this->password = $user['password'];
      $this->is_suspended = $user['is_suspended'];
      $this->created_at = $user['created_at'];
    }
  }
}

