<?php
  include_once("includes/dbconn.inc.php");
  include_once("includes/dashboard_functions.inc.php");
  session_start();
  if (!isset($_SESSION["loggedin"])){
    header("location: ../login.php?error=notLoggedIn");
    exit();
  }
  elseif ($_SESSION["userlevel"] == "reguler") {
    header("location: ../dashboard/404.php");
  }

  //config
  $configFilepath = $_SERVER['DOCUMENT_ROOT'].'/config.ini';
  include_once($_SERVER['DOCUMENT_ROOT'].'/includes/parse-config.inc.php');
  $config = new Config;
  $config->load($configFilepath);
  $nama_perusahaan = $config->get('perusahaan.nama');
?>

<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->
  <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-purple sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-text mx-3">Dashboard Admin</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
          Utilitas
      </div>

      <!-- Nav Item - Kehadiran Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKehadiran"
          aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-table"></i>
          <span>Kehadiran</span>
        </a>
        <div id="collapseKehadiran" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kehadiran per Hari:</h6>
            <a class="collapse-item" href="tables_hadir.php">Daftar Hadir</a>
            <a class="collapse-item" href="tables_absen.php">Detail Ketidakhadiran</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Kehadiran keseluruhan:</h6>
            <a class="collapse-item" href="charts.php">Grafik Kehadiran</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Data Karyawan -->
      <li class="nav-item">
        <a class="nav-link" href="karyawan.php">
          <i class="fas fa-fw fa-address-book"></i>
          <span>Data Karyawan</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
          Pengaturan
      </div>

      <!-- Nav Item - Pengaturan Kehadiran -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#configModal">
          <i class="fas fa-fw fa-calendar-week"></i>
          <span>Pengaturan Kehadiran</span></a>
      </li>

      <!-- Nav Item - Zona Karyawan Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>Zona Karyawan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
          data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Perubahan Data:</h6>
            <a class="collapse-item" href="delete_karyawan.php">Penghapusan Karyawan</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Zona Admin Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
          aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Zona Admin</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Zona Admin:</h6>
            <?php
              if ($_SESSION["username"] === "admin") {
                echo '<a class="collapse-item" href="signup_admin.php">Registrasi Akun Admin</a>';
                echo '<a class="collapse-item" href="delete_admin.php">Penghapusan Akun Admin</a>';
              }
              else {
                echo '<a class="collapse-item btn btn-sm disabled" href="#">Registrasi Akun Admin</a>';
                echo '<a class="collapse-item btn btn-sm disabled" href="#">Penghapusan Akun Admin</a>';
              }
            ?>
            
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      
      <!-- Nav Item - Bantuan -->
      <li class="nav-item">
        <a class="nav-link" href="help.php">
        <i class="fas fa-fw fa-question-circle"></i>
          <span>Bantuan</span></a>
      </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

      <!-- Sidebar Message -->
      <div class="sidebar-card d-none d-lg-flex">
        <p class="text-center mb-2">Today :<br> 
        <strong> <?php
          date_default_timezone_set('Asia/Jakarta');
          $date = date('l, d M', time());
          echo "<h6>".$date."</h6>";
        ?></strong>
        </p>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      
      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Branding -->
          <div class="h4 mb-0 text-gray-800">
            <?php
              echo $nama_perusahaan;
            ?>
          </div>
          

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->

            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                    placeholder="Search for..." aria-label="Search"
                    aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

              <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <!-- <span class="badge badge-danger badge-counter">0</span> -->
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Notifications
                </h6>
                <a class="dropdown-item d-flex align-items-center disabled" href="#">
                  <div>
                    Belum ada notifikasi baru...
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Notifications</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php 
                    echo $_SESSION["username"];
                  ?>
                </span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item disabled" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->
