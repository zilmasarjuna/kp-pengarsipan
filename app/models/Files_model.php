<?php

class Files_model {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function saveFile($filename) {
    $query = 'INSERT INTO files (filename, task_id) VALUES (:filename, :task)';
    $this->db->query($query);

    try {
      $this->db->bind('filename', $filename);
      $this->db->bind('task', $_POST['id']);
      $this->db->execute();
    } catch(PDOException $e) {
      echo $e->getMessage();
    }

    return $this->db->rowCount();
  }
}