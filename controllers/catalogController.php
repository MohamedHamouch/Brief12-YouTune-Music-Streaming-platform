<?php

class CatalogController
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function manageCatalog()
  {
    if (!isset($_SESSION['user'])) {
      $_SESSION['error'] = "You must be logged in to view this page.";
      header("Location: /login");
      exit();
    }

    $user = unserialize($_SESSION['user']);

    if ($user->getRole() !== 'artist') {
      $_SESSION['error'] = "You must be an artist to access this page.";
      header("Location: /home");
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['create_album'])) {
        $this->createAlbum();
      } else if (isset($_POST['delete_album'])) {
        $this->deleteAlbum();
      }
    } else {
      $albums = Album::getArtistAlbums($this->db, $user->getId());
      require_once './views/catalog.php';
    }
  }

  private function createAlbum()
  {
    $title = $_POST['title'];
    $user = unserialize($_SESSION['user']);

    if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
      $uploadDir = './uploads/images/';

      $fileExtension = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
      $fileName = uniqid() . '.' . $fileExtension;
      $uploadPath = $uploadDir . $fileName;

      if (move_uploaded_file($_FILES['cover']['tmp_name'], $uploadPath)) {
        $coverPath = 'uploads/images/' . $fileName;
      } else {
        $_SESSION['error'] = "Failed to upload image!";
        header("Location: /catalog");
        exit();
      }
    } else {
      $_SESSION['error'] = "No image uploaded!";
      header("Location: /catalog");
      exit();
    }

    $album = new Album(null, $title, $user->getId(), $coverPath);

    if ($album->saveAlbum($this->db)) {
      $_SESSION['message'] = "Album created successfully!";
      header("Location: /catalog");
      exit();
    } else {
      $_SESSION['error'] = "Album creation failed!";
      header("Location: /catalog");
      exit();
    }
  }

  private function deleteAlbum()
  {
    $albumId = $_POST['album_id'] ?? '';

    if ($albumId) {
      $album = new Album($albumId, null, null, null);
      $album->loadAlbumById($this->db);
      $user = unserialize($_SESSION['user']);

      if ($album->getArtistId() !== $user->getId()) {
        $_SESSION['error'] = "You are not authorized to delete this album!";
        header("Location: /catalog");
        exit();
      }

      if ($album->deleteAlbum($this->db)) {
        $_SESSION['message'] = "Album deleted successfully!";
      } else {
        $_SESSION['error'] = "Failed to delete album!";
      }
    }

    header("Location: /catalog");
    exit();
  }
}

?>