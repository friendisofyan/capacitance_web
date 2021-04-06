<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard User</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/responsive.css">
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
              <img src="img/user_icon.png" alt="user" >
              Display Name
              </a>
              <a href="#">
                <img src="img/chart_icon_flip.png" alt="chart">
                Data Showcase
              </a>
              <a href="#">
                <img src="img/gear_icon_flip.png" alt="control">  
                Control
              </a>
            </div>
              
            <div class="logout">
              <a href="includes/logout.inc.php">
                <img src="img/logout_icon.png" alt="logout">
                Logout
              </a>
            </div>
          </nav>
        </div>
      </div>
    </div>

    <div class="content-wrapper">
      <center><h1>INI DASHBOARD USER</h1></center>
      <div id="demo">
        TEST xttp.responseText dari file ajax_info.txt
        <button type="button" onclick="loadDoc('ajax_info.txt', myFunction)">Change Content</button>
      </div>

      <div id= "demo2">
        TEST xttp.responseXML dari file cd_catalog.xml
        <button type="button" onclick="loadXML('cd_catalog.xml')">Change Content</button>
      </div>
    </div>

  </div>
  <script src="js/AJAX_test.js"></script>
</body>
</html>