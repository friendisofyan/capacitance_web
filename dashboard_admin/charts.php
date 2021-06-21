<?php
  include_once("header_dashboard_admin.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Grafik Kehadiran</h1>
    <p class="mb-4">
      Di halaman ini kamu bisa melihat grafik kehadiran dari semua karyawan.
    </p>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-8 col-lg-7">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Persen Kehadiran</h6>
                  
                  <div class="select">
                    <select class="form-select col-12" aria-label="select" id="areaChartSel">
                      <option value="tahunan">Tahunan</option>
                      <option value="bulanan">Bulanan</option>
                      <option selected value="harian">Harian</option>
                    </select>
                  </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                      <canvas id="areaChartKehadiran"></canvas>
                    </div>
                    <hr>
                    Menampilkan persen kehadiran seluruh karyawan di setiap hari.
                </div>
            </div>

            <!-- Bar Chart -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Chart Jumlah Kehadiran Karyawan</h6>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label for="tglAwal" class="col-sm-1 col-lg-2 col-form-label responsive">Dari:</label>
                  <div class="col-sm-6 col-lg-4">
                    <?php
                      $date = date('Y-m-01');
                      echo '<input class="form-control" type="date" value="'.$date.'" id="tglAwal">';
                    ?>
                    
                  </div>
                </div>
                <div class="form-group row">
                  <label for="tglAkhir" class="col-sm-1 col-lg-2 col-form-label responsive">Hingga:</label>
                  <div class="col-sm-6 col-lg-4">
                    <input class="form-control" type="date" value=
                      <?php
                        $date = date('Y-m-d');
                        echo '"'.$date.'"';
                      ?> 
                    id="tglAkhir">
                  </div>
                </div>
                  <div class="chart-bar">
                    <canvas id="barChartKehadiran"></canvas>
                  </div>
                  <hr>
                  Menampilkan jumlah kehadiran seluruh karyawan di rentang waktu tertentu.
              </div>
            </div>

        </div>

        <!-- Donut Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <hr>
                    Styling for the donut chart can be found in the
                    <code>/js/demo/chart-pie-demo.js</code> file.
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
  include_once("footer_dashboard_admin.php");
?>

<!-- Page level custom scripts -->
<script src="js/demo/chart-pie-demo.js"></script>
<script src="js/demo/chart-bar.js"></script>
<script src="js/demo/chart-area.js"></script>
  
</body>
</html>