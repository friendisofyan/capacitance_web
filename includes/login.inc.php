<?php

if (isset($_POST["submit"])) {
  
  $username = strtolower($_POST["username"]);
  $pwd =   $_POST["pwd"];

  require_once 'dbconn.inc.php';
  require_once 'functions.inc.php';

  if(emptyInputLogin($username, $pwd) !== false){
    header("location: ../login.php?error=emptyInput");
    exit();
  }

  loginUser($conn, $username, $pwd);
  exit();
}

else {
  header("location: ../login.php");
}