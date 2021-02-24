<?php

  require_once 'core/Utils.php';
  require_once 'core/Menu.php';
  require_once 'core/App.php';
  require_once 'core/Controller.php';
  require_once 'core/Database.php';
  require_once 'core/Flasher.php';
  require_once 'config/class.phpmailer.php';
  require_once 'core/mailer/Exception.php';
  require_once 'core/mailer/PHPMailer.php';
  require_once 'core/mailer/SMTP.php';

  require_once 'config/config.php';

  $app = new App();