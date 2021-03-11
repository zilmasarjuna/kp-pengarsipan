<?php

class Task_model {
  public function __construct() {
    $this->db = new Database;
  }

  public function getTask($limit = null) {
    if (!$limit) {
      $query = 'SELECT t.id, t.name, t.status, DATE_FORMAT(t.tgl_deadline, "%d %M %Y") as tgl_deadline, c.fullname as client, s.fullname as staff
        from tasks as t 
        inner join clients as c 
        on t.client_id = c.id
        inner join staffs as s
        on t.staff_id = s.id
      ';
      $this->db->query($query);
      $this->db->execute();
    } else {
      $query = 'SELECT t.id, t.name, t.status, DATE_FORMAT(t.tgl_deadline, "%d %M %Y") as tgl_deadline, c.fullname as client, s.fullname as staff
        from tasks as t 
        inner join clients as c 
        on t.client_id = c.id
        inner join staffs as s
        on t.staff_id = s.id
        LIMIT :limit
      ';

      $this->db->query($query);
      $this->db->bind('limit', $limit);
      $this->db->execute();
    }
    
    return $this->db->resultSet();
  }

  public function getTaskExport($limit = null) {
    if (!$limit) {
      $query = 'SELECT t.id, 
        t.name, 
        t.status,
        DATE_FORMAT(t.tgl_deadline, "%d %M %Y") as tgl_deadline, 
        DATE_FORMAT(t.created_at, "%d %M %Y") as tgl_created, 
        c.fullname as client, 
        s.fullname as staff,
        c.no_telp as client_no,
        c.address as client_address 
            from tasks as t 
            inner join clients as c 
            on t.client_id = c.id
            inner join staffs as s
            on t.staff_id = s.id
        WHERE created_at BETWEEN :date_from AND :date_to
      ';
      $this->db->query($query);
      $this->db->bind('date_from', $_POST['from_date']);
      $this->db->bind('date_to', $_POST['to_date']);
      $this->db->execute();
    } else {
      $query = 'SELECT t.id, t.name, DATE_FORMAT(t.tgl_deadline, "%d %M %Y") as tgl_deadline, c.fullname as client, s.fullname as staff
        from tasks as t 
        inner join clients as c 
        on t.client_id = c.id
        inner join staffs as s
        on t.staff_id = s.id
        LIMIT :limit
      ';

      $this->db->query($query);
      $this->db->bind('limit', $limit);
      $this->db->execute();
    }
    
    return $this->db->resultSet();
  }

  public function getTaskStaff($limit = null) {
    if (!$limit) {
      $query = 'SELECT t.id, t.name, t.status, DATE_FORMAT(t.tgl_deadline, "%d %M %Y") as tgl_deadline, c.fullname as client, s.fullname as staff
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
    } else {
      $query = 'SELECT t.id, t.name, t.status, DATE_FORMAT(t.tgl_deadline, "%d %M %Y") as tgl_deadline, c.fullname as client, s.fullname as staff
        from tasks as t 
        inner join clients as c 
        on t.client_id = c.id
        inner join staffs as s
        on t.staff_id = s.id
        where t.staff_id = :id
        LIMIT :limit
      ';

      $this->db->query($query);
      $this->db->bind('id', $_SESSION['user']['data_acc']['id']);
      $this->db->bind('limit', $limit);
      $this->db->execute();
    }
    return $this->db->resultSet();
  }

  public function getTaskClient($limit = null) {
    if (!$limit) {
      $query = 'SELECT t.id, t.name, t.status, DATE_FORMAT(t.tgl_deadline, "%d %M %Y") as tgl_deadline, c.fullname as client, s.fullname as staff
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
    } else {
      $query = 'SELECT t.id, t.name,  t.status, DATE_FORMAT(t.tgl_deadline, "%d %M %Y") as tgl_deadline, c.fullname as client, s.fullname as staff
        from tasks as t 
        inner join clients as c 
        on t.client_id = c.id
        inner join staffs as s
        on t.staff_id = s.id
        where t.client_id = :id
        LIMIT :limit
      ';

      $this->db->query($query);
      $this->db->bind('id', $_SESSION['user']['data_acc']['id']);
      $this->db->bind('limit', $limit);
      $this->db->execute();
    }
    
    return $this->db->resultSet();
  }

  public function addTask($data) {
    $query = 'INSERT INTO tasks (name, description, tgl_deadline, client_id, staff_id, created_at, status) 
      VALUES (:name, :description, :tgl_deadline, :client_id, :staff_id, NOW(), "Menunggu Berkas")';
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
      $this->db->bind('client_id', $data['client']);
      $this->db->bind('staff_id', $data['staff']);
      $this->db->bind('id', $data['id']);
      $this->db->execute();
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
    return $this->db->rowCount();
  }

  public function updateProcess($data) {
    $query = "UPDATE tasks set 
        status = :status
      WHERE id = :id";
    $this->db->query($query);

    try {
      $this->db->bind('id', $data['id']);
      $this->db->bind('status', $data['proses']);
      $this->db->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    return $this->db->rowCount();
  }

  public function getTaskById($id) {
    $query = 'SELECT t.id, t.name, t.description, t.status, t.tgl_deadline, c.id as client, s.id as staff
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

    switch($_SESSION['user']['role_name']) {
      case 'clients':
        $query = 'SELECT f.id, f.filename, DATE_FORMAT(f.date_created, "%d %M %Y") as date_created, f.task_id, f.path_name, f.user_id, u.username, f.show_client, f.file_client from files as f inner join users as u on u.id = f.user_id where task_id = :id and show_client = 1 and file_client = 0';
        break;
      default:
        $query = 'SELECT f.id, f.filename, DATE_FORMAT(f.date_created, "%d %M %Y") as date_created, f.task_id, f.path_name, f.user_id, u.username, f.show_client, f.file_client from files as f inner join users as u on u.id = f.user_id where task_id = :id and file_client = 0';
        break;
    } 

    $this->db->query($query);
    $this->db->bind('id', $task['id']);
    $this->db->execute();

    $dataFile = $this->db->resultSet();
    $task['files'] = $dataFile;

    $query = 'SELECT * from note where task_id = :id';
    $this->db->query($query);
    $this->db->bind('id', $task['id']);
    $this->db->execute();
    $dataFeedback = $this->db->resultSet();
    $task['feedback'] = $dataFeedback;
    return $task;
  }

  public function getTaskByIdBerkas($id) {
    $query = 'SELECT t.id, t.name, t.description, t.status, t.tgl_deadline, c.id as client, s.id as staff
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

    switch($_SESSION['user']['role_name']) {
      case 'clients':
        $query = 'SELECT f.id, f.filename, DATE_FORMAT(f.date_created, "%d %M %Y") as date_created, f.task_id, f.path_name, f.user_id, u.username, f.show_client, f.file_client from files as f inner join users as u on u.id = f.user_id where task_id = :id and file_client = 1';
        break;
      default:
        $query = 'SELECT f.id, f.filename, DATE_FORMAT(f.date_created, "%d %M %Y") as date_created, f.task_id, f.path_name, f.user_id, u.username, f.show_client, f.file_client from files as f inner join users as u on u.id = f.user_id where task_id = :id and file_client = 1';
        break;
    } 

    $this->db->query($query);
    $this->db->bind('id', $task['id']);
    $this->db->execute();

    $dataFile = $this->db->resultSet();
    $task['files'] = $dataFile;

    $query = 'SELECT * from note where task_id = :id';
    $this->db->query($query);
    $this->db->bind('id', $task['id']);
    $this->db->execute();
    $dataFeedback = $this->db->resultSet();
    $task['feedback'] = $dataFeedback;
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