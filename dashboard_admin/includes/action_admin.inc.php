<?php
//action admin untuk melakukan action delete dan edit pada tabel akun admin.

include_once('dbconn.inc.php');

if ($_POST['action'] == 'edit') {

  $adminName = $_POST['adminName'];
  $adminUid = $_POST['adminUid'];

  $sql = "UPDATE admin 
          SET adminName =? 
          WHERE adminUid =?;
        ";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "fail preparing";
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ss", $adminName, $adminUid);
  mysqli_stmt_execute($stmt);
  echo json_encode($_POST);
}

if ($_POST['action'] == 'delete') {
  if ($_POST["adminUid"] !== "admin") {
    $sql = "DELETE FROM admin
          WHERE adminUid = '".$_POST["adminUid"]."'
          ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    echo json_encode($_POST);
  }
  else{
    echo "Root Admin cannnot be deleted!";
  }
  
}