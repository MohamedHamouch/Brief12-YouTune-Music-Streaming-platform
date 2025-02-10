<?php

$url = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($url);
$path = $parsed_url['path'];

if (preg_match("#^/(views|models|config|controllers|assets|js)/#", $url)) {
  require './views/404.html';
  exit();
}

$allowed_routes = ['/', '/home', '/login', '/logout', '/register', '/browse', '/library', '/catalog', '/album', '/playlist'];

if (!in_array($path, $allowed_routes)) {
  require_once './views/404.html';
  exit();
}

switch ($path) {
  case '/':
  case '/home':
    require_once './views/home.php';
    break;

  case '/login':
    $authCon = new AuthController($db);
    $authCon->login();
    break;

  case '/register':
    $authCon = new AuthController($db);
    $authCon->register();
    break;

  case '/logout':
    $authCon = new AuthController($db);
    $authCon->logout();
    break;

  case '/browse':
    $albumCon = new AlbumController($db);
    $albumCon->browseAlbums();
    break;

  case '/library':
    $libraryCon = new LibraryController($db);
    $libraryCon->manageLibrary();
    break;

  case '/album':
    $albumCon = new AlbumController($db);
    $albumCon->manageAlbum();
    break;

  case '/catalog':
    $catalogCon = new CatalogController($db);
    $catalogCon->manageCatalog();
    break;

  case '/playlist':
    $playlistCon = new PlaylistController($db);
    $playlistCon->managePlaylist();
    break;

  default:
    require_once './views/404.html';
    break;
}

?>