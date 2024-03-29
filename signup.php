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
      <div class="title mt-1">
        <h1>Registration Form</h1>
      </div>

      <div class="form-wrapper mb-2">
        <h3>Isikan Data Dirimu</h3>
        <form action="includes/signup.inc.php" method="post">
          <div class="grey"><label for="name"></label></div> 
          <input type="text" id="name" name="name" class="form" placeholder="Nama Lengkap">

          <div class="grey"><label for="jabatan"></label></div>
          <select id="jabatan" name="jabatan" class="form">
            <option value="">Pilih jabatan...</option>
            <option value="Chief">Chief</option>
            <option value="Manager">Manager</option>
            <option value="Asisten Manager">Asisten Manager</option>
            <option value="Karyawan">Karyawan</option>
          </select>
          
          <div class="grey"><label for="email"></label></div> 
          <input type="text" id="email" name="email" class="form" placeholder="email">
          <div id="errorMail" class="col-4 text-danger small text-left ml-5 my-0">Wrong email!</div> 

          <div class="grey"><label for="username"></label></div> 
          <input type="text" id="username" name="username" class="form" placeholder="username">

          <div class="grey"><label for="pwd"></label></div>
          <input type="password" id="pwd" name="pwd" class="form" placeholder="password">

          <div class="grey"><label for="repwd"></label></div>
          <input type="password" id="repwd" name="repwd" class="form" placeholder="Re-type Password">
          <button type="submit" name="submit" class="btn btn-primary sbmt">Sign Up</button>
        </form>
        
        <?php
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyInput") {
              echo "<p class='text-danger'>Fill out all the forms!</p>";
            }
            elseif ($_GET["error"] == "invalidUsername") {
              echo "<p class='text-danger'>Username invalid!</p>";
            }
            elseif ($_GET["error"] == "passwordNotMatch") {
              echo "<p class='text-danger'>Password and re-type password don't match!</p>";
            }
            elseif ($_GET["error"] == "stmtFailed") {
              echo "<p class='text-danger'>Oops something went wrong!</p>";
            }
            elseif ($_GET["error"] == "usernameTaken") {
              echo "<p class='text-danger'>Username telah dipakai!</p>";
            }
            elseif ($_GET["error"] == "notValid") {
              echo "<p class='text-danger'>Data tidak valid!</p>";
            }
            elseif ($_GET["error"] == "mailerError") {
              echo "<p class='text-danger'>Pastikan kamu terhubung ke internet dan memasukkan email yang benar!</p>";
            }
            elseif ($_GET["error"] == "none") {
              echo "<p class='text-success'>Pendaftaran akun berhasil!";
              echo "<br>";
              echo "silahkan lanjut ke halaman login</p>";
            }
          }
        ?>

        <a class="btn btn-link" href="login.php" role="button">Back to login page</a>
      </div>



      


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
      $("#errorMail").hide();
      $('#email').on('keypress', function() {
        var re = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,6}/.test(this.value);
        if(!re) {
          $('#errorMail').show();
        } else {
          $('#errorMail').hide();
        }
      })
    </script>
  </body>
</html>