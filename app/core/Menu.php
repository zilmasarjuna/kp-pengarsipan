<?php

class Menu {
  public static function ShowMenu() {
    switch ($_SESSION['user']['role_name']) {
      case 'konsultan':
        echo '<ul class="header-tabs nav align-self-end font-size-lg" role="tablist">
          <li class="nav-item">
            <a href="'. BASEURL .'/dashboard" class="nav-link py-4 px-6 active">Dashboard</a>
          </li>
          <li class="nav-item mr-3">
            <a href="'. BASEURL .'/tasks" class="nav-link py-4 px-6">Tasks</a>
          </li>
          <li class="nav-item mr-3">
            <a href="'. BASEURL .'/user" class="nav-link py-4 px-6">Users</a>
          </li>
          <li class="nav-item dropdown mr-3">
            <a class="nav-link py-4 px-6 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Laporan
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item mr-3">
            <a href="'. BASEURL .'/user/logout" class="nav-link py-4 px-6">Logout</a>
          </li>
        </ul>';
        break;
      case 'staff': 
        echo '<ul class="header-tabs nav align-self-end font-size-lg" role="tablist">
          <li class="nav-item">
            <a href="'. BASEURL .'/dashboard" class="nav-link py-4 px-6 active">Dashboard</a>
          </li>
          <li class="nav-item mr-3">
            <a href="'. BASEURL .'/tasks" class="nav-link py-4 px-6">Tasks</a>
          </li>
          <li class="nav-item mr-3">
            <a href="'. BASEURL .'/user/logout" class="nav-link py-4 px-6">Logout</a>
          </li>
        </ul>';
        break;
      case 'clients':
        echo '<ul class="header-tabs nav align-self-end font-size-lg" role="tablist">
          <li class="nav-item">
            <a href="'. BASEURL .'/dashboard" class="nav-link py-4 px-6 active">Dashboard</a>
          </li>
          <li class="nav-item mr-3">
            <a href="'. BASEURL .'/tasks" class="nav-link py-4 px-6">Tasks</a>
          </li>
          <li class="nav-item mr-3">
            <a href="'. BASEURL .'/user/logout" class="nav-link py-4 px-6">Logout</a>
          </li>
        </ul>';
        break;
      default:
        echo '';
    }
  }
}