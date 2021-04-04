<?php
  include_once 'includes/loggedin.inc.php';
  if (basename(__FILE__) != "login.php"){
    header("location: ../login.php");
    exit();
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Login Page</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/bg_style.css">
  </head>

  <body>
      <div class="title">
        <h1>Welcome!</h1>
      </div>
      <div class="form-wrapper">
        <h2>Akses Sistem Presensi</h2>
        <br><br>
        <form action="/includes/login.inc.php" method="post">
          <div class="grey"><label for="username">Username</label></div> 
          <input type="text" id="username" name="username" class="form">
          <br><br>
          <div class="grey"><label for="pwd">Password</label></div>
          <input type="password" id="pwd" name="pwd" class="form">
          <br>
          <button type="submit" name="submit" class="btn btn-primary sbmt">Login</button>
        </form>

        <?php
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyInput") {
              echo "<p> <font color=red>Username and Password must NOT empty!</font> </p>";
            }
            elseif ($_GET["error"] == "wrongLogin") {
              echo "<font color=red>Username or Password is incorrect
                      <br>Please try again
                    </font>";
            }
            elseif ($_GET["error"] == "notLoggedIn") {
              echo "<p> <font color=red>Please login first!</font> </p>";
            }
          }
        ?>
        
        <br>
        Don't have an account yet?
        <br>
        <a class="btn btn-link" href="signup.php" role="button">Create an account!</a>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>