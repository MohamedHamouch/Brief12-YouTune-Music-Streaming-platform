<?php

class Song
{
  private $id;
  private $title;
  private $album_id;
  private $audio;

  public function __construct($id, $title, $album_id, $audio)
  {
    $this->id = $id;
    $this->title = $title;
    $this->album_id = $album_id;
    $this->audio = $audio;
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
  public function getAlbumId()
  {
    return $this->album_id;
  }
  public function setAlbumId($album_id)
  {
    $this->album_id = $album_id;
  }

  public function saveSong($db)
  {
    $query = "INSERT INTO songs (title, album_id, audio) VALUES (:title, :album_id, :audio)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
    $stmt->bindParam(':album_id', $this->album_id, PDO::PARAM_INT);
    $stmt->bindParam(':audio', $this->audio, PDO::PARAM_STR);

    return $stmt->execute();
  }
}
