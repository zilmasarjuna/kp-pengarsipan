<?php
  class Notes_model {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function addNotes($data) {
      $query = 'INSERT INTO note (description, task_id) VALUES (:description, :task_id)';
      $this->db->query($query);

      try {
        $this->db->bind("description", $data['description']);
        $this->db->bind("task_id", $data['id']);
        $this->db->execute();
      } catch (PDOException $e) {
        echo $e->getMessage();
      }

      return $this->db->rowCount();
    }
  }