<?php
  session_start();
  if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    if (($_SESSION["userlevel"] !== "admin") || ($_SESSION["username"] !== "admin")) {
      header("location: ../includes/loggedin.inc.php");
      exit();
    }
  }
  else {
    header("location: login.php");
    exit();
  }
  // Report all errors except E_NOTICE karena session start 2 kali di header sekali lagi
  error_reporting(E_ALL & ~E_NOTICE); 
  
  include_once("header_dashboard_admin.php");
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Penghapusan Akun Admin</h1>

    <!-- DataTales admin -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Akun Admin</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="tabelAdmin" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nama Admin</th>
                    <th>Username</th>
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
<script src="js/demo/datatables-admin.js"></script>
  
</body>
</html>