<?php
  session_start();
  if (!isset($_SESSION["loggedin"])){
    header("location: login.php?error=notLoggedIn");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard User</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <div id="main-wrapper">
    <div class="sidebar">
      <header>
        <h2>Sistem Presensi</h2>
      </header>
      <div class="dropdown">
        <button class="dropbtn">Menu</button>
        <div class="dropdown-content">
          <nav>
            <div class="utility">
              <a href="#">
              <img src="assets/img/user_icon.png" alt="user" >
              Display Name
              </a>
              <a href="#">
                <img src="assets/img/chart_icon_flip.png" alt="chart">
                Data Showcase
              </a>
              <a href="#">
                <img src="assets/img/gear_icon_flip.png" alt="control">  
                Control
              </a>
            </div>
              
            <div class="logout">
              <a href="includes/logout.inc.php">
                <img src="assets/img/logout_icon.png" alt="logout">
                Logout
              </a>
            </div>
          </nav>
        </div>
      </div>
    </div>

    <div class="content-wrapper">
      <center><h1>INI DASHBOARD USER</h1></center>
      
</body>
</html>