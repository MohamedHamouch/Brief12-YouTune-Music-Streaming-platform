<?php

class Album
{
  private $id;
  private $title;
  private $artist_id;
  private $cover;
  private $created_at;

  public function __construct($id, $title, $artist_id, $cover)
  {
    $this->id = $id;
    $this->title = $title;
    $this->artist_id = $artist_id;
    $this->cover = $cover;
    $this->created_at = date('Y-m-d H:i:s');
  }

  public function getId()
  {
    return $this->id;
  }
  public function setId($id)
  {
    $this->id = $id;
  }

  public function getTitle()
  {
    return $this->title;
  }
  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function getArtistId()
  {
    return $this->artist_id;
  }
  public function setArtistId($artist_id)
  {
    $this->artist_id = $artist_id;
  }

  public function getCover()
  {
    return $this->cover;
  }
  public function setCover($cover)
  {
    $this->cover = $cover;
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

  public static function getAllAlbums($db)
  {
    $query = "SELECT a.*, u.username FROM albums a JOIN users u ON a.artist_id = u.id";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getArtistAlbums($db, $artist_id)
  {
    $query = "SELECT * FROM albums WHERE artist_id = :artist_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  //methods
  public function loadAlbumById($db)
  {
    $query = "SELECT * FROM albums WHERE id = :album_id LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':album_id', $this->id, PDO::PARAM_INT);
    $stmt->execute();

    $albumData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($albumData) {

      $this->id = $albumData['id'];
      $this->title = $albumData['title'];
      $this->cover = $albumData['cover'];
      $this->artist_id = $albumData['artist_id'];
      $this->created_at = $albumData['created_at'];

      return true;
    }

    return false;
  }

  public function saveAlbum($db)
  {
    $query = "INSERT INTO albums (title, artist_id, cover) VALUES (:title, :artist_id, :cover)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':artist_id', $this->artist_id);
    $stmt->bindParam(':cover', $this->cover);

    return $stmt->execute();
  }

  public function deleteAlbum($db)
  {
    $query = "DELETE FROM albums WHERE id = :album_id";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':album_id', $this->id, PDO::PARAM_INT);

    return $stmt->execute();
  }
  public function getArtistName($db)
  {
    $query = "SELECT username FROM users WHERE id = :artist_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':artist_id', $this->artist_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
  }
  public function getAlbumSongs($db)
  {
    $query = "SELECT * FROM songs WHERE album_id = :album_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':album_id', $this->id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
