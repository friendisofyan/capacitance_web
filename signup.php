<?php
  include_once 'includes/loggedin.inc.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Sign Up Page</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bg_style.css">
  </head>

  <body>
      <div class="title">
        <h1>Registration Form</h1>
      </div>

      <div class="form-wrapper">
        <h3>Isikan Data Dirimu</h3>
        <form action="includes/signup.inc.php" method="post">
          <div class="grey"><label for="name">Nama Lengkap</label></div> 
          <input type="text" id="name" name="name" class="form">

          <div class="grey"><label for="jabatan">Jabatan</label></div>
          <select id="jabatan" name="jabatan" class="form">
            <option value="">Pilih jabatan...</option>
            <option value="Chief">Chief</option>
            <option value="Manager">Manager</option>
            <option value="Asisten Manager">Asisten Manager</option>
            <option value="Karyawan">Karyawan</option>
          </select>
          
          <div class="grey"><label for="email">Email</label></div> 
          <input type="text" id="email" name="email" class="form"> 

          <div class="grey"><label for="username">Username</label></div> 
          <input type="text" id="username" name="username" class="form">

          <div class="grey"><label for="pwd">Password</label></div>
          <input type="password" id="pwd" name="pwd" class="form">

          <div class="grey"><label for="repwd">Re-type Password</label></div>
          <input type="password" id="repwd" name="repwd" class="form">
          <button type="submit" name="submit" class="btn btn-primary sbmt">Sign Up</button>
        </form>
        
        <?php
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyInput") {
              echo "<p> <font color=red>Fill out all the forms!</font> </p>";
            }
            elseif ($_GET["error"] == "invalidUsername") {
              echo "<p> <font color=red>Username invalid!</font></p>";
            }
            elseif ($_GET["error"] == "passwordNotMatch") {
              echo "<p> <font color=red>Password and re-type password don't match!</font></p>";
            }
            elseif ($_GET["error"] == "stmtFailed") {
              echo "<p> <font color=red>Oops something went wrong!</font></p>";
            }
            elseif ($_GET["error"] == "usernameTaken") {
              echo "<p> <font color=red>Username telah dipakai!</font></p>";
            }
            elseif ($_GET["error"] == "notValid") {
              echo "<p> <font color=red>Data tidak valid!</font></p>";
            }
            elseif ($_GET["error"] == "none") {
              echo "Pendaftaran akun berhasil!";
              echo "<br>";
              echo "silahkan lanjut ke halaman login";
            }
          }
        ?>

        <a class="btn btn-link" href="login.php" role="button">Back to login page</a>
      </div>



      


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>