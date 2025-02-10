<?php

class PlaylistController
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function managePlaylist()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    } else {
      if (isset($_GET['id'])) {
        $this->showPlaylist();
      } else {
        require_once './views/404.html';
      }
    }
  }

  private function showPlaylist()
  {

    $playlist_id = $_GET['id'];

    $playlist = new Playlist($playlist_id, null, null, null);
    if ($playlist->loadPlaylistById($this->db)) {
      $songs = $playlist->getPlaylistSongs($this->db);

      isset($_SESSION['user']) ? $user = unserialize($_SESSION['user']) : $user = null;
    
      require_once './views/playlist.php';
    } else {
      require_once './views/404.html';
    }
  }

}

?>