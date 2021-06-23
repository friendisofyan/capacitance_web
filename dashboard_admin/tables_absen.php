<?php
  include_once("includes/kehadiran.inc.php");
  include_once("header_dashboard_admin.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- heading hadir -->
    <h1 class="h3 mb-2 text-gray-800">Detail Ketidakhadiran</h1>


    <!-- DataTales kehadiran -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Detail Ketidakhadiran Karyawan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <div class="form-group row">
              <label for="tglAwal" class="col-sm-1 col-xl-1 col-form-label col-md-2 responsive">Dari:</label>
                <div class="col-sm-6 col-xl-3">
                  <?php
                    $date = date('Y-m-01');
                    echo '<input class="form-control" type="date" value="'.$date.'" id="tglAwalAbsn">';
                  ?>
                </div>
                <div class="col-xl-2"></div>
                <label for="tglAkhir" class="col-sm-1 col-lg-1 col-form-label col-md-2 responsive">Hingga:</label>
                <div class="col-sm-6 col-xl-3">
                  <?php
                    $date = date('Y-m-d');
                    echo '<input class="form-control" type="date" value="'.$date.'" id="tglAkhirAbsn">';
                  ?>
                </div>
                <div class="col-sm-12 col-xl-2 col-md-12 mt-2 mt-xl-0 text-right">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahAbsenModal">
                    <i class="fa fa-plus-circle"></i> Tambah
                  </button>
                </div>
              </div>
              <table class="table table-bordered" id="tabelAbsen" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id Absensi</th>
                    <th>Nama Karyawan</th>
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
<!-- Tambah Absen Modal -->
<div class="modal fade" id="tambahAbsenModal" tabindex="-1" role="dialog" aria-labelledby="tambahAbsenLabel" aria-hidden="true">
  <div class="modal-dialog" role="update">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahAbsenLabel">Tambah Absen</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
      </div>

      <div class="modal-body">
        <form action="includes/kehadiran.inc.php" method="post" id="formTambahAbsen"></form>
          <!-- pilih karyawan -->
          <div class="form-group">
            <label for="pgw">Pilih Karyawan</label>
            <input type="text" id="pgw" name="pgw" form="formTambahAbsen" list="karyawan" class="form-control" required placeholder="Id - Nama">
            <datalist id="karyawan">
              <?php 
                showPegawai($conn); 
              ?>
            </datalist>
          </div>

          <!-- tanggal presensi -->
          <div class="form-group">
            <label for="tgl">Tanggal Ketidakhadiran</label>
            <input type="date" id="tgl" name="tgl" form="formTambahAbsen" class="form-control" required>
          </div>

          <!-- Status Absen -->
          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" form="formTambahAbsen">
              <option value="">Tanpa Keterangan</option>
              <option value="sakit">Sakit</option>
              <option value="izin">Izin</option>
              <option value="cuti">Cuti</option>
            </select>
          </div>

          <!-- Keterangan Absen -->
          <div class="form-group">
            <label for="ket">Keterangan</label>
            <sub>(max. 500 karakter)</sub>
            <textarea class="form-control" id="ket" rows="2" id="ket" name="ket" form="formTambahAbsen"></textarea>
          </div>
          
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
        <button class="btn btn-success" type="submit" name="absen" form="formTambahAbsen">Tambah</button>
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