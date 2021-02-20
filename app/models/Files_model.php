<?php

class Files_model {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function saveFile($filename, $name) {
    $query = 'INSERT INTO files (filename, path_name , task_id, date_created) VALUES (:name, :filename, :task, NOW())';
    $this->db->query($query);

    try {
      $this->db->bind('filename', $filename);
      $this->db->bind('name', $name);
      $this->db->bind('task', $_POST['id']);
      $this->db->execute();
    } catch(PDOException $e) {
      echo $e->getMessage();
    }

    return $this->db->rowCount();
  }
}