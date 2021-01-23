<?php
  class Dashboard extends Controller {
    public function index() {
      Utils::PrivatePage();
      $this->view('template/header');
      $this->view('template/navigation');
      $this->view('dashboard/index');
      $this->view('template/footer');
    }
  }