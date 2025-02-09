<?php

trait RegisterTrait
{
  public function saveUser($db)
  {
    $is_suspended = isset($this->is_suspended) ? (bool) $this->is_suspended : false;
    $created_at = isset($this->created_at) ? $this->created_at : date('Y-m-d H:i:s');

    $query = "INSERT INTO users (username, email, role, password, is_suspended, created_at)
                    VALUES (:username, :email, :role, :password, :is_suspended, :created_at)";

    $stmt = $db->prepare($query);

    $stmt->bindParam(':username', $this->username);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':role', $this->role);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindParam(':is_suspended', $is_suspended, PDO::PARAM_BOOL);
    $stmt->bindParam(':created_at', $created_at);

    return $stmt->execute();
  }
}

?>