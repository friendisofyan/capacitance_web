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
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
          <a class="btn btn-primary" href="../includes/logout.inc.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Config Modal-->
  <div class="modal fade" id="configModal" tabindex="-1" role="dialog" aria-labelledby="configModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark font-weight-bold" id="configModalLabel">Pengaturan Presensi</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="includes/dashboard_functions.inc.php" method="post" id="formHariKerja"></form>
          <div class="form-group">
            <label for="newHariKerja" class="text-dark font-weight-bold">Jumlah hari kerja</label>
            <select class="form-control" id="newHariKerja" name="newHariKerja" form="formHariKerja">
            <?php
              if ($hariKerja == "5") {
                echo "
                  <option value='5' selected>Senin - Jumat (5 Hari)</option>
                  <option value='6'>Senin - Sabtu (6 Hari)</option>
                ";
              }
              elseif ($hariKerja == "6") {
                echo "
                  <option value='5'>Senin - Jumat (5 Hari)</option>
                  <option value='6' selected>Senin - Sabtu (6 Hari)</option>
                ";
              }
              else {
                echo "
                  <option value=''>pilih hari kerja...</option>
                  <option value='5'>Senin - Jumat (5 Hari)</option>
                  <option value='6'>Senin - Sabtu (6 Hari)</option>
                ";
              }
            ?>
            </select>
            <small id="newHelp" class="form-text text-dark">Pengaturan hari kerja untuk menyesuaikan jumlah hari kerja per minggu-nya.</small>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
          <button class="btn btn-primary" type="submit" name="gantiHariKerja" form="formHariKerja">Ubah</button>
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
  <script src="vendor/jquery-tabledit/jquery.tabledit.js"></script>