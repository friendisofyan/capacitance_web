<?php

include_once("dbconn.inc.php");

$column = array("nama, username");

$query = "SELECT adminName, adminUid  FROM admin ";

if (isset($_POST["search"]["value"])) {
  $query .= "
    WHERE adminName LIKE '%".$_POST['search']['value']."%'
    OR adminUid LIKE '%".$_POST['search']['value']."%'
  ";
}

//untuk ordering biasa
$query .= "ORDER BY adminName ASC";

$query1 = "";

if ($_POST["length"] != -1) {
  $query1 = " LIMIT ". $_POST['start'].",".$_POST['length'];
}

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$number_filter_row = mysqli_num_rows($result);
mysqli_free_result($result);


mysqli_stmt_prepare($stmt, $query. $query1);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$data = array();

while ($row = mysqli_fetch_array($result)) {
  $subdata = array();
  $subdata[] = $row[0]; //adminName
  $subdata[] = $row[1]; //adminUid
  $data[] = $subdata;
}

function countAllData($conn){
  $sql = "SELECT * FROM admin";
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