<?php
  class Profile extends Controller {
    public function index() {
      Utils::PrivatePage();

      $this->view('template/header');
      $this->view('template/navigation');
      $this->view('profile/index');
      $this->view('template/footer');
    }
  }