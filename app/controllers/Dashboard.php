<?php
  class Dashboard extends Controller {
    public function index() {
      Utils::PrivatePage();
      $data['user'] = $this->model('User_model')->getListDashboard();
      switch($_SESSION['user']['role_name']) {
        case "konsultan": 
          $data['tasks'] = $this->model('Task_model')->getTask(5);
          break;
        case "staff": 
          $data['tasks'] = $this->model('Task_model')->getTaskStaff(5);
          break;

        case "clients": 
          $data['tasks'] = $this->model('Task_model')->getTaskClient(5);
          break;
        default: 
        $data['tasks'] = [];
      }

      $this->view('template/header');
      $this->view('template/navigation');
      $this->view('dashboard/index', $data);
      $this->view('template/footer');
    }
  }