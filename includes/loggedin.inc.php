<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
  if ($_SESSION["userlevel"] == "admin") {
    header("location: ../dashboard_admin.php");
    exit();
  }
  elseif ($_SESSION["userlevel"] == "reguler"){
    header("location: ../dashboard.php");
    exit();
  }
  else {
    echo "Error account not Found!";
    exit();
  }
}
  