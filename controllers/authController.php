<?php

class AuthController
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }
  public function register()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $role = $_POST['role'];
      $password = $_POST['password'];
      $is_suspended = false;
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      if ($role == 'artist') {
        $user = new Artist($username, $email, $hashed_password, $is_suspended);
      } elseif ($role == 'member') {
        $user = new Member($username, $email, $hashed_password, $is_suspended);
      } else {

        $_SESSION['error'] = "Select a valid role";
        header("Location: /register");
        exit();

      }

      if ($user->saveUser($this->db)) {

        $_SESSION['message'] = "User registered successfully!";
        header("Location: /login");
        exit();

      } else {

        $_SESSION['error'] = "User registration failed!";
        header("Location: /register");
        exit();

      }

    } else {
      require_once './views/register.php';
    }

  }

  public function login()
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $role = User::checkRole($this->db, $email);

      if ($role === 'artist') {
        $user = new Artist(null, $email, null, null);
      } elseif ($role === 'member') {
        $user = new Member(null, $email, null, null);
      } elseif ($role === 'admin') {
        $user = new Admin(null, $email, null, null);
      } else {

        $_SESSION['error'] = "Invalid email or password";
        echo "Invalid email or password";
        header("Location: /login");
        exit();
      }

      $user->loadUserByEmail($this->db);


      if ($user && password_verify($password, $user->getPassword())) {

        $_SESSION['user'] = serialize($user);
        $_SESSION['message'] = "Welcome back {$user->getUsername()}!";
        header("Location: /home");
        exit();
      } else {

        $_SESSION['error'] = "Invalid email or password 2!";
        header("Location: /login");
        exit();
      }
    } else {
      require_once './views/login.php';
    }

  }

  public function logout()
  {

    session_unset();
    session_destroy();
    header("Location: /login");
    exit();
  }
}

?>