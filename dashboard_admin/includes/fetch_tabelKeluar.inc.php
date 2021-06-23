<?php
include_once('dbconn.inc.php');

$column = array("pgwId", "uid", "nama");

$sql = "SELECT pgwId, uid, nama FROM pegawai WHERE statusPgw='keluar' AND ";

if (isset($_POST["search"]["value"])) {
  $sql .= "
    (pgwId LIKE '%".$_POST['search']['value']."%'
    OR uid LIKE '%".$_POST['search']['value']."%'
    OR nama LIKE '%".$_POST['search']['value']."%')
  ";
}

if (isset($_POST["order"])) {
  $sql .= 'ORDER BY '.$column[$_POST['order']['0']['column']]. ' ' .$_POST['order']['0']['dir']. ' ';
}
else {
  //untuk ordering biasa
  $sql .= "ORDER BY pgwID ASC"; 
}

$sql1 = "";

if ($_POST["length"] != -1) {
  $sql1 = " LIMIT ". $_POST['start'].",".$_POST['length'];
}

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$number_filter_row = mysqli_num_rows($result);
mysqli_free_result($result);

mysqli_stmt_prepare($stmt, $sql. $sql1);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$data = array();

while ($row=mysqli_fetch_array($result)) {
  $subdata = array();
  $subdata[] = $row[0]; //pgwId
  $subdata[] = $row[1]; //uid
  $subdata[] = $row[2]; //nama
  $subdata[] = $row[0].';'.$row[1].';'.$row[2]; //identifier
  $data[] = $subdata;
}

function countAllData($conn){
  $sql = "SELECT pgwId FROM pegawai WHERE statusPgw='keluar' ";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $totalRows = mysqli_num_rows($result);
  mysqli_free_result($result);
  return $totalRows;
}

$output = array(
  'draw'  => intval($_POST['draw']),
  'recordsTotal' => countAllData($conn),
  'recordsFiltered' => $number_filter_row,
  'data' => $data
);

echo json_encode($output);