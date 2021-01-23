<?php
  class Tasks extends Controller {
    public function index() {
      Utils::PrivatePage();

      $data['tasks'] = $this->model('Task_model')->getTask();
      $data['clients'] = $this->model('User_model')->getClient();
      $data['staffs'] = $this->model('User_model')->getStaff();
      $this->view('template/header');
      $this->view('template/navigation');
      $this->view('tasks/index', $data);
      $this->view('template/footer');
    }

    public function add() {
      Utils::PrivatePage();
      if ($this->model('Task_model')->addTask($_POST) > 0) {
        Flasher::setFlash('berhasil', 'ditambah', 'success', 'Task');
        header('Location: ' . BASEURL . '/tasks');
        exit;
      } else {
        Flasher::setFlash('gagal', 'ditambah', 'danger', 'Task');
        header('Location: ' . BASEURL . '/tasks');
        exit;
      }
    }

    public function getubah() {
      echo json_encode($this->model('Task_model')->getTaskById($_POST['id']));
    }

    public function delete($id) {
      if ($this->model('Task_model')->deleteTask($id) > 0) {
        Flasher::setFlash('berhasil', 'dihapus', 'success', 'Task');
        header('Location: ' . BASEURL . '/tasks');
        exit;
      } else {
        Flasher::setFlash('gagal', 'dihapus', 'danger', 'Task');
        header('Location: ' . BASEURL . '/tasks');
        exit;
      }
    }

    public function ubah() {
      if ($this->model('Task_model')->ubahDataTask($_POST) > 0) {
        Flasher::setFlash('berhasil', 'diubah', 'success', 'Task');
        header('Location: ' . BASEURL . '/tasks');
        exit;
      } else {
        Flasher::setFlash('gagal', 'diubah', 'danger', 'Task');
        header('Location: ' . BASEURL . '/tasks');
        exit;
      }
    }
  }