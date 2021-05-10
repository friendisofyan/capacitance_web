<?php
include_once('dbconn.inc.php');

$tgl = '2021-05-09';
$sql1 = "SELECT d.pgwId, d.nama 
          FROM pegawai d 
          WHERE d.pgwId NOT IN (SELECT pgwId FROM presensi Where prsnTgl = '$tgl');";

$sql2 = "SELECT * FROM presensi WHERE prsnTgl = '$tgl'";
$query1 = mysqli_query($conn, $sql1);
$query2 = mysqli_query($conn, $sql2);

$data = array();

while ($row=mysqli_fetch_array($query2)) {
  $subdata = array();
  $subdata[] = $row[1]; //pgwId
  $subdata[] = $row[2]; //nama
  $subdata[] = $row[3]; //prsnTgl
  $subdata[] = $row[4]; //temperature
  $subdata[] = $row[5]; //jamMasuk
  $subdata[] = $row[6]; //jamKeluar
  $data[] = $subdata;
}
while ($row=mysqli_fetch_array($query1)) {
  $subdata = array();
  $subdata[] = $row[0]; //pgwId
  $subdata[] = $row[1]; //nama
  $subdata[] = $tgl; //prsnTgl
  $subdata[] = NULL; //temperature
  $subdata[] = NULL; //jamMasuk
  $subdata[] = NULL; //jamKeluar
  array_push($data, $subdata);
}

echo json_encode($data);