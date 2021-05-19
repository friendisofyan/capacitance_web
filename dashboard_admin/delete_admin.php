<?php
  session_start();
  include_once("header_dashboard_admin.php");
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
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>

</div>
<!-- /.container-fluid -->



<?php
  include_once("footer_dashboard_admin.php");
?>