<?php

class User_model {
  private $table = 'users';
  private $db;
  private $db2;

  public function __construct() {
    $this->db = new Database;
    $this->db2 = new Database;
  }

  public function auth($data) {
      $query = 'SELECT 
        users.id, users.username, roles.name as role_name  FROM users 
        LEFT JOIN roles ON users.role_id = roles.id 
        where username=:username and pasword=:password';
      
      $this->db->query($query);
      $this->db->bind('username', $data['username']);
      $this->db->bind('password', $data['password']);

      $this->db->execute();
      $users =  $this->db->single();

      if (!$users) {
        return $users;
      }
      
      switch($users['role_name']) {
        case 'staff':
          $query = 'SELECT * from staffs where user_id = :id';
          break;
        case 'clients':
          $query = 'SELECT * from clients where user_id = :id';
          break;
        default:
          return $this->db->single();
      } 
      $this->db->query($query);
      $this->db->bind('id', $users['id']);
      $this->db->execute();

      $dataAcc = $this->db->single();
      $users['data_acc'] = $dataAcc;
      return $users;
  }

  public function getClient() {
    $query = 'SELECT id, fullname as name from clients';

    $this->db->query($query);
    return $this->db->resultSet();
  }

  public function getStaff() {
    $query = 'SELECT id, fullname as name from staffs';

    $this->db->query($query);
    return $this->db->resultSet();
  }

  public function getUserById($id) {
    $this->db->query('SELECT * FROM '. $this->table . ' WHERE id=:id');

    $this->db->bind('id', $id);
    return $this->db->single();
  }

  public function getList() {
    $query = 'SELECT users.id, users.username, roles.name  FROM users LEFT JOIN roles ON users.role_id = roles.id where users.id != :id';
    
    $this->db->query($query);
    $this->db->bind('id', Utils::GetUserId());

    return $this->db->resultSet();
  }

  public function addUser($data) {
    $query = "INSERT INTO users (username, pasword, role_id) VALUES(:username, :password, :role_id)";
    $this->db->query($query);

    try {
      $this->db->bind('username', $data['username']);
      $this->db->bind('password', $data['password']);
      $this->db->bind('role_id', $data['role_id']);

      $this->db->execute();
    } catch(PDOException $e) {
      echo $e->getMessage();
    }

    return $this->db->rowCount();
  }

  public function deleteUser($id) {
    $query = 'DELETE FROM users WHERE id= :id';
    $this->db->query($query);
    $this->db->bind('id', $id);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function ubahDataUser($data) {

    $query = "UPDATE users set 
                username = :username,
                pasword = :password,
                role_id = :role_id
              WHERE id = :id";
    $this->db->query($query);
    try {
      $this->db->bind('username', $data['username']);
      $this->db->bind('password', $data['password']);
      $this->db->bind('id', $data['id']);
      $this->db->bind('role_id', $data['role_id']);
      $this->db->execute();
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
    return $this->db->rowCount();
  }
}