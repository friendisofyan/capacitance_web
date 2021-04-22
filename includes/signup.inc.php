<?php
include('lib/phpqrcode/qrlib.php');

if (isset($_POST["submit"])) {
  
  $name = $_POST["name"];
  $jabatan = $_POST["jabatan"];
  $email = $_POST["email"];
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $repwd = $_POST["repwd"];

  require_once 'dbconn.inc.php';
  require_once 'functions.inc.php';

  if(emptyInputSignup($name, $jabatan, $email, $username, $pwd, $repwd) !== false){
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
  if(uidExist($conn, $username, $email) !== false){
    header("location: ../signup.php?error=usernameTaken");
    exit();
  }

  $QRcontent = '{ "username":"' .$username. '", "name":"' .$name. '" }';
  QRcode::png($QRcontent, 'assets/qr/' .$username. '.png', QR_ECLEVEL_M, 7);

  createUser($conn, $name, $jabatan, $email, $username, $pwd);
  
}
else {
  header("location: ../signup.php");
}
