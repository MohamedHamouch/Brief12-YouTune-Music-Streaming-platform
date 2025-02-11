<?php

class Playlist
{
  private $id;
  private $title;
  private $visibility;
  private $creator_id;
  private $created_at;


  public function __construct($id, $title, $visibility, $creator_id)
  {
    $this->id = $id;
    $this->title = $title;
    $this->visibility = $visibility;
    $this->creator_id = $creator_id;
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

  public function getVisibility()
  {
    return $this->visibility;
  }
  public function setVisibility($visibility)
  {
    $this->visibility = $visibility;
  }

  public function getCreatorId()
  {
    return $this->creator_id;
  }
  public function setCreatorId($creator_id)
  {
    $this->creator_id = $creator_id;
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

  public static function getMemberPlaylists($db, $member_id)
  {
    $query = "SELECT * FROM playlists WHERE creator_id = :member_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':member_id', $member_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  //methods

  public function loadPlaylistById($db)
  {
    $query = "SELECT * FROM playlists WHERE id = :playlist_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':playlist_id', $this->id, PDO::PARAM_INT);
    $stmt->execute();

    $playlist = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($playlist) {
      $this->title = $playlist['title'];
      $this->visibility = $playlist['visibility'];
      $this->creator_id = $playlist['creator_id'];
      $this->created_at = $playlist['created_at'];
      return true;
    } else {
      return false;
    }
  }

  public function savePlaylist($db)
  {
    $query = "INSERT INTO playlists (title, visibility, creator_id)
                    VALUES (:title, :visibility, :creator_id)";

    $stmt = $db->prepare($query);

    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':visibility', $this->visibility);
    $stmt->bindParam(':creator_id', $this->creator_id);

    return $stmt->execute();
  }

  public function getPlaylistSongs($db)
  {
    $query = "SELECT s.* FROM songs s
            JOIN playlist_songs ps ON s.id = ps.song_id 
            WHERE ps.playlist_id = :playlist_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':playlist_id', $this->id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}