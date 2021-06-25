<?php
  include_once("header_dashboard_admin.php");
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <p class="m-0 h4 font-weight-bold text-dark">Daftar Karyawan yang Sudah Keluar</p>
    </div>
    <div class="card-body">
      <div class="text-danger font-weight-bold">
        <sup>*</sup>Data karyawan dapat dihapus apabila sudah berstatus "keluar".
      </div>
      <p class="small text-dark text-justify font-weight-bold col-xl-6">
        Penghapusan karyawan akan menghapus keseluruhan data karyawan tersebut kecuali 
        kehadiran karyawan tersebut.
      </p>
      
      <div class="table-responsive">
        <table class="table table-bordered" id="tabelKeluar" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id Karyawan</th>
              <th>Username</th>
              <th>Nama Karyawan</th>
              <th>identifier</th>
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