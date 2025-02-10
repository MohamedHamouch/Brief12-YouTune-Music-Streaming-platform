<?php

class AlbumController
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function manageAlbum()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['upload_song'])) {
        $this->uploadSong();
      } elseif (isset($_POST['remove_song'])) {
        $this->removeSong();
      }

    } else {

      if (isset($_GET['id'])) {
        $this->showAlbum();
      } else {
        require_once './views/404.html';
      }

    }
  }
  private function showAlbum()
  {

    $album_id = $_GET['id'];

    $album = new Album($album_id, null, null, null);
    if ($album->loadAlbumById($this->db)) {
      $songs = $album->getAlbumSongs($this->db);
      isset($_SESSION['user']) ? $user = unserialize($_SESSION['user']) : $user = null;
      $artisUsername = $album->getArtistName($this->db);
      require_once './views/album.php';
    } else {
      require_once './views/404.html';
    }


  }

  private function uploadSong()
  {
    $title = $_POST['title'];
    $album_id = $_POST['album_id'];

    if (isset($_FILES['audio']) && $_FILES['audio']['error'] === UPLOAD_ERR_OK) {
      $uploadDir = './uploads/audios/';

      $fileExtension = pathinfo($_FILES['audio']['name'], PATHINFO_EXTENSION);
      $fileName = uniqid() . '.' . $fileExtension;
      $uploadPath = $uploadDir . $fileName;

      if (move_uploaded_file($_FILES['audio']['tmp_name'], $uploadPath)) {
        $audioPath = 'uploads/audios/' . $fileName;

        $song = new Song(null, $title, $album_id, $audioPath);

        if ($song->saveSong($this->db)) {
          $_SESSION['message'] = "Song uploaded successfully!";
          header("Location: /album?id=$album_id");
          exit();
        } else {
          $_SESSION['error'] = "Song upload failed! Database error.";
          header("Location: /album?id=$album_id");
          exit();
        }
      } else {
        $_SESSION['error'] = "Failed to upload the audio file!";
        header("Location: /album?id=$album_id");
        exit();
      }
    } else {
      $_SESSION['error'] = "No audio file uploaded!";
      header("Location: /album?id=$album_id");
      exit();
    }
  }

  public function removeSong()
  {
    $song_id = $_POST['song_id'] ?? '';
    $album_id = $_POST['album_id'] ?? '';


    if ($song_id) {
      $song = new Song($song_id, null, null, null);
      $song->loadSong($this->db);
      $album = new Album($song->getAlbumId(), null, null, null);
      $album->loadAlbumById($this->db);
      isset($_SESSION['user']) ? $user = unserialize($_SESSION['user']) : $user = null;

      if ($user->getId() !== $album->getArtistId()) {
        $_SESSION['error'] = "You are not authorized to delete this song!";
        header("Location: /album?id=$album_id");
        exit();
      }

      if ($song->deleteSong($this->db)) {
        $_SESSION['message'] = "Song deleted successfully!";
        header("Location: /album?id=$album_id");
        exit();
      } else {
        $_SESSION['error'] = "Failed to delete song!";
        header("Location: /album?id=$album_id");
        exit();
      }

    } else {
      $_SESSION['error'] = "No song selected!";
      header("Location: /album?id=$album_id");
      exit();
    }
  }

  public function browseAlbums()
  {
    $albums = Album::getAllAlbums($this->db);
    require_once './views/browse.php';
  }

}