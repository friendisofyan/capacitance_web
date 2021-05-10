<?php
include_once('dbconn.inc.php');

// $tgl = '2021-05-09';
if (isset($_POST["tgl"])) {
  $tgl = $_POST["tgl"];
}
else {
  $tgl = "2021-05-01";
}
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
  if (strcmp($row[4],"37.50")>=0) {
    $subdata[] = '<font style="color:red">'.$row[4].'</font>';
  }
  else {
    $subdata[] = $row[4]; //temperature  
  }
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
$json_data = array("data" => $data);
echo json_encode($json_data);