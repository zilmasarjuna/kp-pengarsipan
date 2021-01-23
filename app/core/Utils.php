<?php 

  class Utils {
    public static function PrivatePage() {
      if ($_SESSION['status'] !== 'login') {
        return header('Location: '. BASEURL . '/login');
      }
    }

    public static function GetUserId() {
      return $_SESSION['user_id'];
    }

    public static function GetUser() {
      return $_SESSION['user'];
    }

    public static function GetUserName() {
      echo $_SESSION['user']['username'];
    }

    public static function GetRoleName() {
      echo $_SESSION['user']['role_name'];
    }
  }