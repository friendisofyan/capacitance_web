<?php
include_once('dbconn.inc.php');

// $tgl = '2021-05-09';
if (isset($_POST["tgl"])) {
  $tgl = $_POST["tgl"];
}

$sql1 = "SELECT d.nama 
          FROM pegawai d 
          WHERE d.pgwId NOT IN (SELECT pgwId FROM presensi Where prsnTgl = ?);";

$sql2 = "SELECT prsnId, nama, prsnTgl, temperature, jamMasuk, jamKeluar 
        FROM presensi WHERE prsnTgl = ? ";

if (isset($_POST["search"]["value"])) {
  $sql1 .= "
    OR nama LIKE '%".$_POST['search']['value']."%'
  ";

  $sql2 .= "
    OR prsnId LIKE '%".$_POST['search']['value']."%'
    OR nama LIKE '%".$_POST['search']['value']."%'
    OR prsnTgl LIKE '%".$_POST['search']['value']."%'
    OR temperature LIKE '%".$_POST['search']['value']."%'
    OR jamMasuk LIKE '%".$_POST['search']['value']."%'
    OR jamKeluar LIKE '%".$_POST['search']['value']."%'
  ";
}


$data = array();

while ($row=mysqli_fetch_array($query2)) {
  $subdata = array();
  $subdata[] = $row[0]; //prsnId
  $subdata[] = $row[2]; //nama
  if (strcmp($row[4],"37.50")>=0) {
    $subdata[] = '<font style="color:red">'.$row[4].'</font>';
  }
  else {
    $subdata[] = $row[4]; //temperature  
  }
  $subdata[] = $row[5]; //jamMasuk
  $subdata[] = $row[6]; //jamKeluar
  $subdata[] = $row[7]; //durasi
  $data[] = $subdata;
}
while ($row=mysqli_fetch_array($query1)) {
  $subdata = array();
  $subdata[] = NULL; //prsnId
  $subdata[] = $row[0]; //nama
  $subdata[] = NULL; //temperature
  $subdata[] = NULL; //jamMasuk
  $subdata[] = NULL; //jamKeluar
  $subdata[] = NULL; //durasi
  array_push($data, $subdata);
}
$json_data = array("data" => $data);
echo json_encode($json_data);