<?php

class Playlist
{
  private $id;
  private $title;
  private $visibility;
  private $creator_id;
  private $cover;
  private $created_at;


  public function __construct($id, $title, $visibility, $creator_id, $cover)
  {
    $this->id = $id;
    $this->title = $title;
    $this->visibility = $visibility;
    $this->creator_id = $creator_id;
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
}