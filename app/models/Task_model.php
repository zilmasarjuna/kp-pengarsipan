<?php

class Task_model {
  public function __construct() {
    $this->db = new Database;
  }

  public function getTask() {
    $query = 'SELECT t.id, t.name, t.tgl_deadline, c.fullname as client, s.fullname as staff
      from tasks as t 
      inner join clients as c 
      on t.client_id = c.id
      inner join staffs as s
      on t.staff_id = s.id
    ';

    $this->db->query($query);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function getTaskStaff() {
    $query = 'SELECT t.id, t.name, t.tgl_deadline, c.fullname as client, s.fullname as staff
      from tasks as t 
      inner join clients as c 
      on t.client_id = c.id
      inner join staffs as s
      on t.staff_id = s.id
      where t.staff_id = :id
    ';

    $this->db->query($query);
    $this->db->bind('id', $_SESSION['user']['data_acc']['id']);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function getTaskClient() {
    $query = 'SELECT t.id, t.name, t.tgl_deadline, c.fullname as client, s.fullname as staff
      from tasks as t 
      inner join clients as c 
      on t.client_id = c.id
      inner join staffs as s
      on t.staff_id = s.id
      where t.client_id = :id
    ';

    $this->db->query($query);
    $this->db->bind('id', $_SESSION['user']['data_acc']['id']);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function addTask($data) {
    $query = 'INSERT INTO tasks (name, description, tgl_deadline, client_id, staff_id) 
      VALUES (:name, :description, :tgl_deadline, :client_id, :staff_id)';
    $this->db->query($query);
    try {
      $this->db->bind('name', $data['name']);
      $this->db->bind('description', $data['description']);
      $this->db->bind('tgl_deadline', $data['tgl_deadline']);
      $this->db->bind('client_id', $data['client']);
      $this->db->bind('staff_id', $data['staff']);

      $this->db->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    return $this->db->rowCount();
  }

  public function ubahDataTask($data) {

    $query = "UPDATE tasks set 
                name = :name,
                description = :description,
                tgl_deadline = :tgl_deadline,
                client_id = :client_id,
                staff_id = :staff_id
              WHERE id = :id";
    $this->db->query($query);
    try {
      $this->db->bind('name', $data['name']);
      $this->db->bind('description', $data['description']);
      $this->db->bind('tgl_deadline', $data['tgl_deadline']);
      $this->db->bind('client_id', $data['staff']);
      $this->db->bind('staff_id', $data['client']);
      $this->db->bind('id', $data['id']);
      $this->db->execute();
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
    return $this->db->rowCount();
  }

  public function getTaskById($id) {
    $query = 'SELECT t.id, t.name, t.description, t.tgl_deadline, c.id as client, s.id as staff
      from tasks as t 
      inner join clients as c 
      on t.client_id = c.id
      inner join staffs as s
      on t.staff_id = s.id
      where t.id = :id
      ;
    ';
    $this->db->query($query);

    $this->db->bind('id', $id);
    $task = $this->db->single();

    $query = 'SELECT * from files where task_id = :id';

    $this->db->query($query);
    $this->db->bind('id', $task['id']);
    $this->db->execute();

    $dataFile = $this->db->resultSet();
    $task['files'] = $dataFile;
    return $task;
  }

  public function deleteTask($id) {
    $query = 'DELETE FROM tasks WHERE id= :id';
    $this->db->query($query);
    $this->db->bind('id', $id);

    $this->db->execute();
    return $this->db->rowCount();
  }

 
}