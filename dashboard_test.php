<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard User</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    form {
      margin-left: 20px;
    }
    table,th,td {
      margin-left: 20px;
      border : 1px solid black;
      border-collapse: collapse;
      background-color: white;
    }
    th,td {
      font-weight : bold;
      padding: 5px;
    }
  </style>
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
      <div id="demo">
        TEST xttp.responseText dari file ajax_info.txt
        <button type="button" onclick="loadDoc('ajax_info.txt', myFunction)">Change Content</button>
      </div>

      <div id= "demo2">
        TEST xttp.responseXML dari file cd_catalog.xml
        <button type="button" onclick="loadDoc('cd_catalog.xml', loadXML)">Change Content</button>
      </div>

      <button type="button" id="btnjQuery">tes ajax pake jQuery</button>
      <div id="div1"></div> 


      <h2>TES AJAX KE SERVER DATABASE</h2>
      <form action=""> 
        <select name="data" onchange="showData(this.value)">
          <option value="">Pilih nama COK:</option>
          <option value="Yapin">Yapin</option>
          <option value="MC">MC</option>
          <option value="Friendi">Friend</option>
          <option value="Arief">Arief</option>
          <option value="Ivan">Ivan</option>
          <option value="Jeve">Jeve</option>
        </select>
      </form>
      <br>
      <div id="txtHint">info hasil dari db disini cuy!!!</div>

    </div>

  </div>
  <script src="js/AJAX_test.js"></script>
</body>
</html>