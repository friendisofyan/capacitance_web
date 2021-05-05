<?php
  session_start();
  if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    if ($_SESSION["userjabatan"] !== "admin") {
      header("location: dashboard.php");
      exit();
    }
  }
  else {
    header("location: login.php");
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Sign Up Admin</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bg_style.css">
  </head>

  <body>
      <div class="title">
        <h1>Admin Registration</h1>
      </div>

      <div class="form-wrapper">
        <h3>Data Akun Admin</h3>
        <br>
        <form action="includes/signup_admin.inc.php" method="post">
          
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
            elseif ($_GET["error"] == "none") {
              echo "Pendaftaran akun berhasil!";
              echo "<br>";
              echo "silahkan kembali ke Dashboard Admin";
            }
          }
        ?>

        <a class="btn btn-link" href="dashboard_admin.php" role="button">Back to Admin Dashboard</a>
      </div>



      


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>