<?php
  include_once("header_dashboard_admin.php");
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Data Karyawan</h1>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tabel Data Karyawan</h6>
    </div>
    <div class="card-body">
      <div class="text-danger">
        <sup>*</sup>Status karyawan menandakan karyawan tersebut masih "aktif" atau sudah "keluar".
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="tabelKaryawan" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nama Karyawan</th>
              <th>Jabatan</th>
              <th>Email</th>
              <th>No.Telp</th>
              <th>Alamat</th>
              <th>Status<sup>*</sup></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php
  include_once("footer_dashboard_admin.php");
?>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-karyawan.js"></script>
  
</body>
</html>