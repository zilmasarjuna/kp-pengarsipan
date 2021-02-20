<?php
  class Report extends Controller {
    public function tasks() {
      Utils::PrivatePage();
      $this->view('template/header');
      $this->view('template/navigation');
      $this->view('report/task');
      $this->view('template/footer');
    }

    public function files() {
      Utils::PrivatePage();
      echo "files";
    }

    public function users() {
      Utils::PrivatePage();
      echo "users";
    }
  }