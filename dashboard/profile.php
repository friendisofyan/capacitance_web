<?php
  include_once("includes/profile.inc.php");
  include_once("header_dashboard.php");
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="col-xl-12 col-sm-12">
    <div class="card shadow mb-4">
      <!-- row pertama -->
      <div class= "row">
        <!-- profile piture -->
        <div class = "col-xl-3 col-sm-10 profilePic indexCard">
          <a href="#">
            <img class="img-profile" src="img/undraw_profile.svg">
          </a>
        </div>
        
        <!-- data-data -->
        <div class="col-xl-6 col-sm-10  profileData">
          <table style="width:100%" class="table profileTable">
            <?php showProfile($conn, $_SESSION['pgwid']); ?>
          </table>

          <button type="button" class="btn btn-success btnEdit" data-toggle="modal" data-target="#editProfileModal">
            <i class="fas fa-edit"></i>
            Edit Profil
          </button>
        </div>
      </div>

    </div>
  </div>

</div>
<!-- /.container-fluid -->

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileLabel" aria-hidden="true">
  <div class="modal-dialog" role="update">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileLabel">Edit Profile</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
      </div>

      <div class="modal-body">
        <center><h5>Pastikan data yang diisi sudah benar!</h5></center>
        <form action="includes/profile.inc.php" method="post" id="formEditProfile"></form>
          <?php
            $row = getProfile($conn, $_SESSION['pgwid']);

            echo '<input type="hidden" id="pgwId" name="pgwId" value="'.$_SESSION['pgwid'].'" form="formEditProfile">';

            echo '<div class="grey"><label for="nama">Nama Lengkap</label></div>';
            echo '<input type="text" class="formEdit" id="nama" name="nama" value="'.$row['nama'].'" form="formEditProfile" readonly>';
            
            echo '<div class="grey"><label for="tglLahir">Tanggal Lahir</label></div>';
            echo '<input type="date" class="formEdit" id="tglLahir" name="tglLahir" value="'.$row['tglLahir'].'" form="formEditProfile" required>';
            
            echo '<div class="grey"><label for="gender">Jenis Kelamin</label></div>';
            if (is_null($row['gender'])) {
            echo '<select id="gender" name="gender" class="formEdit" form="formEditProfile">
                    <option value="" selected>Pilih Jenis Kelamin...</option>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                  </select>';
            }
            elseif ($row['gender'] == 'L') {
              echo '<select id="gender" name="gender" class="formEdit" form="formEditProfile" readonly>
                      <option value="L" selected>Laki-Laki</option>
                    </select>';
            }
            else {
              echo '<select id="gender" name="gender" class="formEdit" form="formEditProfile" readonly>
                      <option value="P" selected>Perempuan</option>
                    </select>';
            }

            echo '<div class="grey"><label for="email">Email</label></div>';
            echo '<input type="email" class="formEdit" id="email" name="email" value="'.$row['email'].'" form="formEditProfile" required>';
            
            echo '<div class="grey"><label for="telp">Nomor Handphone</label></div>';
            echo '<input type="tel" class="formEdit" id="telp" name="telp" placeholder="0812-xxxx-xxxx" value="'.$row['telp'].'" form="formEditProfile" required>';
            
            echo '<div class="grey"><label for="alamat">Alamat</label></div>';
            echo '<input type="text" class="formEdit" id="alamat" name="alamat" placeholder="alamat" value="'.$row['alamat'].'" form="formEditProfile" required>';
          ?>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" type="submit" name="submit" form="formEditProfile">Submit</button>
      </div>
    </div>
  </div>
</div>

<?php
  include_once("footer_dashboard.php");
?>