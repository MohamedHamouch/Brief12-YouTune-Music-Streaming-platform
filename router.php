<?php

$url = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($url);
$path = $parsed_url['path'];
if (preg_match("#^/(views|models|config|controllers|assets|js)/#", $url)) {
  require './views/404.html';
  exit();
}

$allowed_routes = ['/', '/home', '/login', '/logout', '/register', '/browse', '/library', '/catalog', '/album'];
if (in_array($path, $allowed_routes)) {
  if ($path == '/' || $path == '/home') {

    require_once './views/home.php';
  } elseif ($path == '/login') {

    $authCon = new AuthController($db);
    $authCon->login();
  } elseif ($path == '/register') {

    $authCon = new AuthController($db);
    $authCon->register();
  } elseif ($path == '/logout') {

    $authCon = new AuthController($db);
    $authCon->logout();
  } elseif ($path == '/browse') {

    $albumCon = new AlbumController($db);
    $albumCon->browseAlbums();
  } elseif ($path == '/library') {

    require_once './views/library.php';
  } elseif ($path == '/album') {

    $albumCon = new AlbumController($db);
    $albumCon->manageAlbum();
  } elseif ($path == '/catalog') {

    $catalogCon = new CatalogController($db);
    $catalogCon->manageCatalog();
  } else {

    require_once './views/404.html';
  }

} else {
  require_once './views/404.html';
}


?>