<?php
  include_once("header_dashboard_admin.php");
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <p class="h3 mb-2 text-gray-800">Data Karyawan</p>
      <p class="text-justify font-weight-bold col-xl-8 mb-2">
        Menonaktifkan status karyawan tidak akan menghapus data karyawan tersebut,
        untuk menghapusnya silahkan ke halaman 
        <a href="delete_karyawan.php">penghapusan akun</a>
        namun diperlukan status "keluar" untuk menghapus data karyawan.
      </p>
    </div>
    <div class="card-body">
      <div class="text-danger font-weight-bold">
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