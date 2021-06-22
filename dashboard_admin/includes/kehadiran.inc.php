<?php
include_once('dbconn.inc.php');
include_once('dashboard_functions.inc.php');

if (isset($_POST["submit"])) {
  $id_ser = $_POST["pgw"];
    //memisahkan id dan nama dari garis penghubung dengan spasi diantara " - "
    $id_array = preg_split("/ - /",$id_ser);
    $pgwId = $id_array[0];
    $nama = $id_array[1];
  
  $tgl = $_POST['tgl'];
  $jamMasuk = $_POST['masuk'];
  $jamKeluar = $_POST['keluar'];
  $temperature = "-";

  $diff = date_diff(new DateTime($jamMasuk), new DateTime($jamKeluar));
  $durasi = $diff->format('%H:%I:%S'); //durasi

  $check = presensi($conn, $pgwId, $nama, $tgl, $temperature, $jamMasuk, $jamKeluar, $durasi);
  if ($check === "ERROR") {
    header("location: ../tables_hadir.php?err=error-inserting");
    exit();
  }
  elseif($check === "OK") {
    header("location: ../tables_hadir.php?err=none");
    exit();
  }
}


function presensi ($conn, $pgwId, $nama, $tgl, $temperature, $jamMasuk, $jamKeluar, $durasi) {
  //pertama hapus terlebih dahulu apabila pegawai tersebut ada absen pada tgl tersebut
  $sql = "DELETE FROM absensi WHERE pgwId = ? AND absnTgl = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "ss", $pgwId, $tgl);
  if (!mysqli_stmt_execute($stmt)) {
    return "ERROR";
  }
  mysqli_stmt_close($stmt);

  //lanjut memasukkannya ke dalam tabel presensi
  $sql = "INSERT INTO presensi (pgwId, nama, prsnTgl, temperature, jamMasuk, jamKeluar, durasi)
          VALUES (?,?,?,?,?,?,?)
          ";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "sssssss", $pgwId, $nama, $tgl, $temperature, $jamMasuk, $jamKeluar, $durasi);
  if (!mysqli_stmt_execute($stmt)) {
    return "ERROR";
  }
  
  mysqli_stmt_close($stmt);

  return "OK";
}
