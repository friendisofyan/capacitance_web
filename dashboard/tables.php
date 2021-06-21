<?php
  include_once("header_dashboard.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Riwayat Kehadiran</h1>


    <!-- DataTales kehadiran -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Kehadiran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <div class="form-group row">
                <label for="tglAwal" class="col-sm-1 col-lg-1 col-form-label responsive">Dari:</label>
                <div class="col-sm-6 col-lg-3">
                  <?php
                    $date = date('Y-m-01');
                    echo '<input class="form-control" type="date" value="'.$date.'" id="tglAwalPrsn">';
                  ?>
                </div>
                <div class="col-lg-4"></div>
                <label for="tglAkhir" class="col-sm-1 col-lg-1 col-form-label responsive">Hingga:</label>
                <div class="col-sm-6 col-lg-3">
                  <?php
                    $date = date('Y-m-d');
                    echo '<input class="form-control" type="date" value="'.$date.'" id="tglAkhirPrsn">';
                  ?>
                </div>
              </div>
              
              <table class="table table-bordered" id="tabelKehadiran" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id Presensi</th>
                    <th>Tanggal</th>
                    <th>Temperatur</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Durasi</th>
                  </tr>
                </thead>
              </table>
            </div>
        </div>
    </div>


    <!-- DataTales absen -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Absen</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <div class="form-group row">
                <label for="tglAwal" class="col-sm-1 col-lg-1 col-form-label responsive">Dari:</label>
                <div class="col-sm-6 col-lg-3">
                  <?php
                    $date = date('Y-m-01');
                    echo '<input class="form-control" type="date" value="'.$date.'" id="tglAwalAbsn">';
                  ?>
                </div>
                <div class="col-lg-4"></div>
                <label for="tglAkhir" class="col-sm-1 col-lg-1 col-form-label responsive">Hingga:</label>
                <div class="col-sm-6 col-lg-3">
                  <?php
                    $date = date('Y-m-d');
                    echo '<input class="form-control" type="date" value="'.$date.'" id="tglAkhirAbsn">';
                  ?>
                </div>
              </div>
              <table class="table table-bordered" id="tabelAbsen" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id Absensi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
              </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
  include_once("footer_dashboard.php");
?>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-kehadiran.js"></script>
  
</body>

</html>