<?php
include_once('dbconn.inc.php');

$column = array("prsnId", "nama", "temperature", "jamMasuk", "jamKeluar", "durasi");

$sql1 = "SELECT d.pgwId, d.nama, d.statusPgw
          FROM pegawai d ";

$sql2 = "SELECT *
        FROM presensi ";

if (isset($_POST["tgl"])) {
  $tgl = $_POST["tgl"];

  $sql1 .= "WHERE d.pgwId NOT IN (SELECT pgwId FROM presensi Where prsnTgl = '$tgl') AND (d.statusPgw = 'aktif') ";
  $sql2 .= "WHERE prsnTgl = '$tgl' ";
}

if (isset($_POST["search"]["value"])) {
  $sql2 .= "
    AND (prsnId LIKE '%".$_POST['search']['value']."%'
    OR nama LIKE '%".$_POST['search']['value']."%'
    OR temperature LIKE '%".$_POST['search']['value']."%'
    OR jamMasuk LIKE '%".$_POST['search']['value']."%'
    OR jamKeluar LIKE '%".$_POST['search']['value']."%'
    OR durasi LIKE '%".$_POST['search']['value']."%')
  ";

  $sql1 .="
    AND (nama LIKE '%".$_POST['search']['value']."%')
  ";
}

if (isset($_POST["order"])) {
  $sql2 .= 'ORDER BY '.$column[$_POST['order']['0']['column']]. ' ' .$_POST['order']['0']['dir']. ' ';
}
else {
  //untuk ordering biasa
  $sql2 .= "ORDER BY nama ASC"; 
}

$sqlPaging = "";

if ($_POST["length"] != -1) {
  $sqlPaging = " LIMIT ". $_POST['start'].",".$_POST['length'];
}

$data = array();

$stmt1 = mysqli_prepare($conn, $sql1);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);
$number_filter_row = mysqli_num_rows($result1);
mysqli_free_result($result1);

mysqli_stmt_prepare($stmt1, $sql1. $sqlPaging);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);

while ($row=mysqli_fetch_array($result1)) {
  $subdata = array();
  $subdata[] = NULL; //prsnId
  $subdata[] = $row[1]; //nama
  $subdata[] = NULL; //temperature
  $subdata[] = NULL; //jamMasuk
  $subdata[] = NULL; //jamKeluar
  $subdata[] = NULL; //durasi
  $subdata[] = NULL; //identifier
  $data[] = $subdata;
}

$stmt = mysqli_prepare($conn, $sql2);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$number_filter_row += mysqli_num_rows($result);
mysqli_free_result($result);

mysqli_stmt_prepare($stmt, $sql2. $sqlPaging);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while ($row=mysqli_fetch_array($result)) {
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
  $subdata[] = $row[0].";".$row[1].";".$row[2].";".$row[3]; //prsnId;pgwId;nama;tgl
  $data[] = $subdata;
}

function countAllData($conn ,$tgl){
  $sql = "SELECT d.nama FROM pegawai d WHERE d.pgwId NOT IN (SELECT pgwId FROM presensi Where prsnTgl = '$tgl')";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $totalRows = mysqli_num_rows($result);
  mysqli_free_result($result);

  $sql = "SELECT prsnId FROM presensi WHERE prsnTgl = '$tgl' ";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $totalRows += mysqli_num_rows($result);
  mysqli_free_result($result);
  return $totalRows;
}

$output = array(
  'draw'  => intval($_POST['draw']),
  'recordsTotal' => countAllData($conn, $tgl),
  'recordsFiltered' => $number_filter_row,
  'data' => $data
);

echo json_encode($output);