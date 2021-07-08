<?php
include_once("dashboard_functions.inc.php");
include_once("dbconn.inc.php");

$data = array();

if(isset($_POST["fungsi"])){
  if ($_POST["fungsi"] === 'getData'){
    $data["absen"] = jumlahAbsen($conn, $_POST["level"], $_POST["pgwId"]);
    $data["sakit"] = jumlahSakit($conn, $_POST["level"], $_POST["pgwId"]);
    $data["pgw"] = jumlahKaryawan($conn);
    $data["hadir"] = persenKehadiran($conn, $_POST["level"], $_POST["pgwId"], date('Y-m-d'), $hariKerja) . '%';
    echo json_encode($data);
  }
}