<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
  if ($_SESSION["userjabatan"] == "admin") {
    header("location: ../dashboard_admin.php");
    exit();
  }
  elseif ($_SESSION["userjabatan"] == "reguler"){
    header("location: ../dashboard.php");
    exit();
  }
  else {
    echo "Error Jabatan not Found!";
    exit();
  }
}
  