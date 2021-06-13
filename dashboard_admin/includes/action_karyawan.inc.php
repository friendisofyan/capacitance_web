<?php
//action admin untuk melakukan action edit pada tabel data karyawan.

include_once('dbconn.inc.php');

if ($_POST['action'] == 'edit') {

  $pgwId = $_POST['pgwId'];
  $jabatan = $_POST['jabatan'];
  $statusPgw = $_POST['statusPgw'];

  $sql = "UPDATE pegawai 
          SET jabatan = ?, statusPgw = ?
          WHERE pgwId = ?;
        ";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "fail preparing";
    exit();
  }
  mysqli_stmt_bind_param($stmt, "sss", $jabatan, $statusPgw, $pgwId);
  mysqli_stmt_execute($stmt);
  echo json_encode($_POST);
}