<?php

  class Tasks extends Controller {
    public function index() {
      Utils::PrivatePage();

      switch($_SESSION['user']['role_name']) {
        case "konsultan": 
          $data['tasks'] = $this->model('Task_model')->getTask();
          $data['clients'] = $this->model('User_model')->getClient();
          $data['staffs'] = $this->model('User_model')->getStaff();
          break;
        case "staff": 
          $data['tasks'] = $this->model('Task_model')->getTaskStaff();
          break;

        case "clients": 
          $data['tasks'] = $this->model('Task_model')->getTaskClient();
          break;
        default: 
        $data['tasks'] = [];
      }
      
      // $mail = new PHPMailer();

      // $mail->IsSMTP();
      // $mail->Host = "smtp.gmail.com";
      // $mail->SMTPAuth = true;
      // $mail->Username = "zilmasarjuna12@gmail.com";
      // $mail->Password = "zilmas123@";
      // $mail->Port = 465;
      // $mail->SMTPSecure = "ssl";

      // $mail->isHTML(true);  
      // $mail->SetFrom("zilmasarjuna12@gmail.com", "Zilmas Arjuna");
      // $mail->AddAddress("zilmas.sutrisno@ottodigital.id");

      // $mail->Subject = "asdasd";
			// $mail->Body    = '<div style="border:2px solid red;">This is the HTML message body <b>in bold!</b></div>';

      // if(!$mail->send()) {
      //   echo 'Message could not be sent.';
      //   echo 'Mailer Error: ' . $mail->ErrorInfo;
      // } else {
      //     echo 'Message has been sent';
      // }
      $this->view('template/header');
      $this->view('template/navigation');
      $this->view('tasks/index', $data);
      $this->view('template/footer');
    }

    public function export() {
      Utils::PrivatePage();
      switch($_SESSION['user']['role_name']) {
        case "konsultan": 
          $data['tasks'] = $this->model('Task_model')->getTaskExport();
          $data['clients'] = $this->model('User_model')->getClient();
          $data['staffs'] = $this->model('User_model')->getStaff();
          break;
        case "staff": 
          $data['tasks'] = $this->model('Task_model')->getTaskStaff();
          break;

        case "clients": 
          $data['tasks'] = $this->model('Task_model')->getTaskClient();
          break;
        default: 
        $data['tasks'] = [];
      }

      $data['post'] = $_POST;
      $this->view('tasks/export', $data);
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

    public function upload() {
      $nameFile = $_FILES['fileUpload']['name'];
      $nameSementara = $_FILES['fileUpload']['tmp_name'];

      $dirUpload = "./file/task/";
      $terupload = move_uploaded_file($nameSementara, $dirUpload.$nameFile);
      $msg = "First line of text\nSecond line of text";

      $msg = wordwrap($msg,70);

      // send email
      mail("zilmasarjuna12@gmail.com","My subject",$msg);
      if ($terupload) {
        $filename = '/file/task/'.$nameFile;
        if ($this->model('Files_model')->saveFile($filename, $nameFile) > 0) {
          Flasher::setFlash('berhasil', 'diupload', 'success', 'Task');
          header('Location: ' . BASEURL . '/tasks');
        } else {
          Flasher::setFlash('gagal', 'diupload', 'danger', 'Task');
          header('Location: ' . BASEURL . '/tasks');
        }
      } else {
        echo "Upload Gagal!";
      }
    }

    public function deleteFile($id) {
      $data = $this->model('Files_model')->showFile($id);
      $myFile = ".".$data['path_name'];
      $myFileLink = fopen($myFile, 'w') or die("can't open file");
      fclose($myFileLink);
      
      if ($this->model('Files_model')->deleteFile($id) > 0) {
        Flasher::setFlash('berhasil', 'dihapus', 'success', 'File');
        unlink($myFile);
        header('Location: ' . BASEURL . '/tasks');
        exit;
      } else {
        Flasher::setFlash('gagal', 'dihapus', 'danger', 'File');
        header('Location: ' . BASEURL . '/tasks');
        exit;
      }
    }
  }