<?php
  include_once("header_dashboard_admin.php");
  include_once("includes/dbconn.inc.php");
  include_once("includes/dashboard_functions.inc.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selamat Datang!</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row Atas -->
    <div class="row">

        <!-- Card persentase kehadiran hari ini -->
        <a class="col-xl-3 col-md-6 mb-4 indexCard" href="tables.php">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                              Kehadiran Hari ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                              <?php
                                echo persenKehadiran($conn ,$_SESSION["userlevel"], "1", date('Y-m-d')) . "%";
                              ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Card jumlah karyawan -->
        <a class="col-xl-3 col-md-6 mb-4 indexCard" href="karyawan.php">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jumlah Karyawan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                              <?php
                                echo jumlahKaryawan($conn);
                              ?>
                            </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Card jumlah izin -->
        <a class="col-xl-3 col-md-6 mb-4 indexCard" href="#">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                              Izin/Sakit
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                      <?php
                                        echo jumlahSakit($conn, $_SESSION["userlevel"], "1");
                                      ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Card Absen tanpa keterangan -->
        <a class="col-xl-3 col-md-6 mb-4 indexCard" href="#">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Tanpa Keterangan
                          </div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                              echo jumlahAbsen($conn, $_SESSION["userlevel"], "1");
                            ?>
                          </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Content Row Tengah-->
    <div class="row">
      <!-- Area Chart -->
      <div class="col-xl-12 col-xl-12">
        <div class="card shadow mb-4">
          <!-- Card Header -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Grafik Kehadiran Bulan <?php echo date("M")?></h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-area">
              <canvas id="areaChartKehadiranIndex"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>


</div>
<!-- /.container-fluid -->


<?php
  include_once("footer_dashboard_admin.php");
?>
