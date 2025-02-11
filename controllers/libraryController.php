<?php

class LibraryController
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function manageLibrary()
  {
    if (!isset($_SESSION['user'])) {
      $_SESSION['error'] = "You must be logged in to view this page.";
      header("Location: /login");
      exit();
    }

    $user = unserialize($_SESSION['user']);

    if ($user->getRole() !== 'member') {
      $_SESSION['error'] = "You must be an member to access this page.";
      header("Location: /home");
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['create_playlist'])) {
        $this->createPlaylist();
      } else {
        $_SESSION['error'] = "Invalid request!";
        header("Location: /library");
        exit();
      }

    } else {

      $playlists = Playlist::getMemberPlaylists($this->db, $user->getId());
      require_once './views/library.php';
    }
  }

  private function createPlaylist()
  {
    $title = $_POST['title'];
    $visibility = $_POST['visibility'];
    $user = unserialize($_SESSION['user']);


    $playlist = new Playlist(null, $title, $visibility, $user->getId());
    if ($playlist->savePlaylist($this->db)) {
      $_SESSION['message'] = "Playlist created successfully!";
      header("Location: /library");
      exit();
    } else {
      $_SESSION['error'] = "Failed to create playlist!";
      header("Location: /library");
      exit();
    }
  }


}


?>