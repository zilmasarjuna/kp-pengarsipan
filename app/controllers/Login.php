<?php
  class Login extends Controller {
    public function index() {
      if ($_SESSION['status'] === 'login') {
        header('Location: '. BASEURL . '/dashboard');
      } else {
        $this->view('template/header');
        $this->view('login/index');
      }
    }

    public function auth() {
      $data['user'] = $this->model('User_model')->auth($_POST);
      if ($data['user']) {
        $_SESSION['status'] = 'login';
        $_SESSION['user_id'] = $data['user']['id'];
        $_SESSION['user'] = $data['user'];
        print_r($_SESSION['user']);
        header('Location: '. BASEURL . '/dashboard');
      } else {
        header('Location: '. BASEURL . '/dashboard');
        Flasher::setError('Masukan username dan password dengan benar');
      }
    }
    
  }
?>