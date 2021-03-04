<?php

class Files_model {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function saveFile($filename, $name) {
    $query = 'INSERT INTO files (filename, path_name , task_id, date_created, user_id) VALUES (:name, :filename, :task, NOW(), :user)';
    $this->db->query($query);

    try {
      $this->db->bind('filename', $filename);
      $this->db->bind('name', $name);
      $this->db->bind('task', $_POST['id']);
      $this->db->bind('user', $_SESSION['user']['id']);
      $this->db->execute();
    } catch(PDOException $e) {
      echo $e->getMessage();
    }

    return $this->db->rowCount();
  }

  public function saveFileBerkas($filename, $name) {
    $query = 'INSERT INTO files (filename, path_name , task_id, date_created, user_id, file_client) VALUES (:name, :filename, :task, NOW(), :user, 1)';
    $this->db->query($query);

    try {
      $this->db->bind('filename', $filename);
      $this->db->bind('name', $name);
      $this->db->bind('task', $_POST['id']);
      $this->db->bind('user', $_SESSION['user']['id']);
      $this->db->execute();
    } catch(PDOException $e) {
      echo $e->getMessage();
    }

    return $this->db->rowCount();
  }

  public function showFile($id) {
    $query = 'SELECT * FROM files WHERE id= :id';

    try {
      $this->db->query($query);
      $this->db->bind('id', $id);
      $this->db->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $this->db->single();
  }

  public function deleteFile($id) {
    $query = 'DELETE FROM files WHERE id= :id';

    try {
      $this->db->query($query);
      $this->db->bind('id', $id);
      $this->db->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    return $this->db->rowCount();
  }

  public function showFileClient($id) {
    $query = "UPDATE files set 
                show_client = 1
              WHERE id = :id";
    
    $this->db->query($query);
    try {
      $this->db->bind("id", $id);
      $this->db->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    return $this->db->rowCount();
  }
}