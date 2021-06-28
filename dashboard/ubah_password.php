<?php
  include_once("header_dashboard.php");
?>
<!-- Begin Page Content -->
<div class="container-fluid col-xl-10">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <p class="h3 text-dark text-center font-weight-bold">Ubah Password</p>
    </div>
    <div class="card-body col-xl-8 mx-auto">
      <form action="includes/dashboard_functions.inc.php" method="post" id="formGantiPwd"></form>
      <div class="form-group row">
        <label for="oldPwd" class="col-sm-4 col-form-label">Password Lama</label>
        <div class="col-sm-8">
          <input type="password" class="form-control" id="oldPwd" form="formGantiPwd" name="oldPwd">
        </div>
      </div>
      <div class="form-group row">
        <label for="newPwd" class="col-sm-4 col-form-label">Password Baru</label>
        <div class="col-sm-8">
          <input type="password" class="form-control" id="newPwd" form="formGantiPwd" name="newPwd">
        </div>
      </div>
      <div class="form-group row">
        <label for="rePwd" class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
        <div class="col-sm-8">
          <input type="password" class="form-control" id="rePwd" form="formGantiPwd" name="rePwd">
        </div>
      </div>
      <button class="btn btn-primary mt-3 float-right" type="submit" name="gantiPwd" form="formGantiPwd">Ubah Password</button>
    </div>
    <div class="mx-auto my-4">
      <?php
        if (isset($_GET["error"])) {
          if ($_GET["error"] == "notMatch") {
            echo "<p class='text-danger'>Password dan konfirmasi password berbeda!</font> </p>";
          }
          elseif ($_GET["error"] == "wrongPassword") {
            echo "<p class='text-danger'>Password lama salah!</font></p>";
          }
          elseif ($_GET["error"] == "none") {
            echo "<p class='text-success'>Password berhasil diganti!</font></p>";
          }
        }
      ?>
    </div>
  </div>


</div>
<!-- /.container-fluid -->



<?php
  include_once("footer_dashboard.php");
?>

<!-- Page level custom scripts -->
<!-- <script src="js/demo/datatables-admin.js"></script> -->
  
</body>
</html>