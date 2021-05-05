<?php

function emptyInputSignup($name, $jabatan, $email, $username, $pwd, $repwd){
  $result;
  if (empty($name) || empty($jabatan) || empty($email) || empty($username) || empty($pwd) || empty($repwd)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function invalidUid($username){
  $result;
  if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $repwd){
  $result;
  if ($pwd !== $repwd) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}

function uidExist($conn, $username, $email){
  $sql = "SELECT * FROM  users WHERE usersUid = ? OR usersEmail = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $jabatan, $email, $username, $pwd){
  // mencegah user register dengan jabatan Admin hingga memiliki akses ke admin
  if ($jabatan === "Admin") {
    header("location: ../signup.php?error=notValid");
    exit();
  }
  $sql = "INSERT INTO users (usersName, usersJabatan, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtFailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
  mysqli_stmt_bind_param($stmt, "sssss", $name, $jabatan, $email, $username, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../signup.php?error=none");
  exit();
}

function emptyInputLogin($username, $pwd){
  $result;
  if (empty($username) || empty($pwd)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}


function loginUser($conn, $username, $pwd){
  $uidExist = uidExist($conn, $username, $username);

  if ($uidExist == false) {
    header("location: ../login.php?error=wrongLogin");
    exit();
  }

  $pwdHashed = $uidExist["usersPwd"];
  $checkPwd = password_verify($pwd, $pwdHashed);
  
  if ($checkPwd == false) {
    header("location: ../login.php?error=wrongLogin");
    exit();
  }
  elseif ($checkPwd == true){
    $findJabatan = $uidExist["usersJabatan"];
    session_start();
    $_SESSION["loggedin"] = true;

    if ($findJabatan == "Admin") {
      // $_SESSION["userid"] = $uidExist["usersId"];
      $_SESSION["useruid"] = $uidExist["usersUid"];
      $_SESSION["userjabatan"] = "admin";
    }
    else {
      // $_SESSION["userid"] = $uidExist["usersId"];
      $_SESSION["useruid"] = $uidExist["usersUid"];
      $_SESSION["userjabatan"] = "reguler";
    }
    header("location: loggedin.inc.php");
    exit();
  }
}

function createAdmin($username, $pwd){
  $sql = "INSERT INTO admin (adminUid, adminPwd) VALUES (?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup_admin.php?error=stmtFailed");
    exit();
  }
  
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
  mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../signup_admin.php?error=none");
  exit();
}

function adminExist($conn, $username){
  $sql = "SELECT * FROM  admin WHERE adminUid = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup_admin.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }
  mysqli_stmt_close($stmt);
}