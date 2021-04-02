<?php

if (isset($_POST["submit"])) {
  
  $name = $_POST["name"];
  $jabatan = $_POST["jabatan"];
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repwd = $_POST["repwd"];

  require_once 'dbconn.inc.php';
  require_once 'functions.inc.php';

  if(emptyInputSignup($name, $jabatan, $username, $pwd, $repwd) !== false){
    header("location: ../signup.php?error=emptyInput");
    exit();
  }
  if(invalidUid($username) !== false){
    header("location: ../signup.php?error=invalidUsername");
    exit();
  }
  if(pwdMatch($pwd, $repwd) !== false){
    header("location: ../signup.php?error=passwordNotMatch");
    exit();
  }
  if(uidExist($conn, $username) !== false){
    header("location: ../signup.php?error=usernameTaken");
    exit();
  }

  createUser($conn, $name, $jabatan, $username, $pwd);
  
}
else {
  header("location: ../signup.php");
}
