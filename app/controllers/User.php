<?php 

  class User extends Controller {
    public function index() {
      Utils::PrivatePage();
      $data['user'] = $this->model('User_model')->getList();
      // print_r($data['user']);
      $this->view('template/header');
      $this->view('template/navigation');
      $this->view('user/index', $data);
      $this->view('template/footer');
    }

    public function add() {
      Utils::PrivatePage();
      if ($this->model('User_model')->addUser($_POST) > 0) {
        Flasher::setFlash('berhasil', 'ditambah', 'success', 'User');
        header('Location: ' . BASEURL . '/user');
        exit;
      } else {
        Flasher::setFlash('gagal', 'ditambah', 'danger', 'User');
        header('Location: ' . BASEURL . '/user');
        exit;
      }
    }

    public function delete($id) {
      if ($this->model('User_model')->deleteUser($id) > 0) {
        Flasher::setFlash('berhasil', 'dihapus', 'success', 'User');
        header('Location: ' . BASEURL . '/user');
        exit;
      } else {
        Flasher::setFlash('gagal', 'dihapus', 'danger', 'User');
        header('Location: ' . BASEURL . '/user');
        exit;
      }
    }

    public function getubah() {
      echo json_encode($this->model('User_model')->getUserById($_POST['id']));
    }

    public function ubah() {
      if ($this->model('User_model')->ubahDataUser($_POST) > 0) {
        Flasher::setFlash('berhasil', 'diubah', 'success', 'User');
        header('Location: ' . BASEURL . '/user');
        exit;
      } else {
        Flasher::setFlash('gagal', 'diubah', 'danger', 'User');
        header('Location: ' . BASEURL . '/user');
        exit;
      }
    }

    public function logout() {
      session_unset();
      session_destroy();
      header('Location: '. BASEURL . '/login');
    }
  }