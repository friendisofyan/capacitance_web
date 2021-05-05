<?php

if (isset($_POST["submit"])) {
  
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repwd = $_POST["repwd"];

  require_once 'dbconn.inc.php';
  require_once 'functions.inc.php';

  if(emptyInputSignup_admin($username, $pwd, $repwd) !== false){
    header("location: ../signup_admin.php?error=emptyInput");
    exit();
  }
  if(invalidUid($username) !== false){
    header("location: ../signup_admin.php?error=invalidUsername");
    exit();
  }
  if(pwdMatch($pwd, $repwd) !== false){
    header("location: ../signup_admin.php?error=passwordNotMatch");
    exit();
  }
  if((adminExist($conn, $username) !== false) || (uidExist($conn, $username, $username) !==false)){
    header("location: ../signup_admin.php?error=usernameTaken");
    exit();
  }

  createAdmin($conn, $username, $pwd);
}
else {
  header("location: ../signup_admin.php");
}
