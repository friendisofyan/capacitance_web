<?php
  include_once("includes/kehadiran.inc.php");
  include_once("header_dashboard_admin.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- heading hadir -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Hadir</h1>


    <!-- DataTales kehadiran -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Hadir per Hari</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <div class="form-group row">
                <label for="filterTanggal" class="col-sm-1 col-form-label responsive">Tanggal:</label>
                <div class="col-sm-3">
                  <input class="form-control" type="date" value=
                    <?php
                      $timezone = date_default_timezone_get();
                      date_default_timezone_set($timezone);
                      $date = date('Y-m-d', time());
                      echo '"'.$date.'"';
                    ?> 
                  id="filterTanggal">
                </div>
                <div class="col-md-8 pt-2 text-right">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahHadirModal">
                    <i class="fa fa-plus-circle"></i> Tambah
                  </button>
                </div>
              </div>
              <table class="table table-bordered" id="tabelKehadiran" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id Presensi</th>
                    <th>Nama Karyawan</th>
                    <th>Temperatur</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Durasi</th>
                    <th>Identifier</th>
                  </tr>
                </thead>
              </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Tambah Hadir Modal -->
<div class="modal fade" id="tambahHadirModal" tabindex="-1" role="dialog" aria-labelledby="tambahHadirLabel" aria-hidden="true">
  <div class="modal-dialog" role="update">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahHadirLabel">Tambah Kehadiran</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
      </div>

      <div class="modal-body">
        <form action="includes/kehadiran.inc.php" method="post" id="formTambahHadir"></form>
          <!-- pilih karyawan -->
          <div class="form-group">
            <label for="pgw">Pilih Karyawan</label>
            <input type="text" id="pgw" name="pgw" form="formTambahHadir" list="karyawan" class="form-control" required placeholder="Id - Nama">
            <datalist id="karyawan">
              <?php 
                showPegawai($conn); 
              ?>
            </datalist>
          </div>

          <!-- tanggal presensi -->
          <div class="form-group">
            <label for="tgl">Tanggal Presensi</label>
            <input type="date" id="tgl" name="tgl" form="formTambahHadir" class="form-control" required>
          </div>

          <!-- jam masuk -->
          <div class="form-group">
            <label for="masuk">Jam Masuk</label>
            <input type="time" id="masuk" name="masuk" form="formTambahHadir" class="form-control" required>
          </div>

          <!-- jam keluar -->
          <div class="form-group">
            <label for="keluar">Jam Masuk</label>
            <input type="time" id="keluar" name="keluar" form="formTambahHadir" class="form-control" required>
          </div>
          
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
        <button class="btn btn-success" type="submit" name="hadir" form="formTambahHadir">Tambah</button>
      </div>
    </div>
  </div>
</div>

<?php
  include_once("footer_dashboard_admin.php");
?>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-kehadiran.js"></script>
  
</body>
</html>