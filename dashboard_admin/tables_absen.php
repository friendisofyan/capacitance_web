<?php
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

</div>
<!-- End of Main Content -->
<!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Capacitance 2021</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin untuk Logout?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Tekan tombol "Logout" untuk mengakhiri sesi.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../includes/logout.inc.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


  <script src="js/demo/datatables-kehadiran.js"></script>
  

</body>

</html>