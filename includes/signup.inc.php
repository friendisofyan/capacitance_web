<?php

if (isset($_POST["submit"])) {
  include_once('../lib/phpqrcode/qrlib.php');
  include_once('mail.inc.php');

  $configFilepath = $_SERVER['DOCUMENT_ROOT'].'/config.ini';
  include_once('parse-config.inc.php');
  $config = new Config;
  $config->load($configFilepath);

  
  $name = ucwords($_POST["name"]);
  $jabatan = $_POST["jabatan"];
  $email = strtolower($_POST["email"]);
  $username = strtolower($_POST["username"]);
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
  QRcode::png($QRcontent, $config->get('storage.filepathQR') . $username . '.png', QR_ECLEVEL_M, 10);

  sendEmail($name, $username, $email, $config);
  createUser($conn, $name, $jabatan, $email, $username, $pwd);
}
else {
  header("location: ../signup.php");
}
