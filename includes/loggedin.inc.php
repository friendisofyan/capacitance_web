<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
  if ($_SESSION["userjabatan"] == "admin") {
    header("location: ../admin_index.php");
    exit();
  }
  elseif ($_SESSION["userjabatan"] == "reguler"){
    header("location: ../reguler_index.php");
    exit();
  }
  else {
    echo "Error Jabatan not Found!";
    exit();
  }
}
else {
  header("location: ../login.php");
  exit();
}