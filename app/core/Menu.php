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