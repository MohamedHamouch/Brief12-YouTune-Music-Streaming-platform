<?php
require_once './config/database.php';
require_once './controllers/authController.php';

$url = $_SERVER['REQUEST_URI'];

if (preg_match("#^/(views|models|config|controllers|assets|js)/#", $url)) {
  require './views/404.html';
  exit;
}

$allowed_routes = ['/', '/home', '/login', '/register', '/browse', '/library', '/album'];
if (in_array($url, $allowed_routes)) {
  if ($url == '/' || $url == '/home') {

    require_once './views/home.php';
  } elseif ($url == '/login') {

    $authCon = new AuthController($db);
    $authCon->login();
  } elseif ($url == '/register') {

    $authCon = new AuthController($db);
    $authCon->register();
  } elseif ($url == '/browse') {

    require_once './views/browse.php';
  } elseif ($url == '/library') {

    require_once './views/library.php';
  } elseif ($url == '/album') {

    require_once './views/album.php';
  } else {

    require_once './views/404.html';
  }

} else {
  require_once './views/404.html';
}


?>