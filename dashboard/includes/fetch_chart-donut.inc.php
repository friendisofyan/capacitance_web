<?php
header('Content-Type: application/json');
include_once('dbconn.inc.php');
include_once('dashboard_functions.inc.php');


if (isset($_POST["pgwId"])) {
  $pgwId = $_POST["pgwId"];

  $start = date('Y-m-01');
  $end = date('Y-m-d');

  $sql = "SELECT prsnId FROM presensi
          WHERE pgwId = '$pgwId' AND
          prsnTgl BETWEEN '$start' AND '$end'
          GROUP BY prsnTgl";
  if ($result=mysqli_query($conn,$sql)){
    $jlhHadir = mysqli_num_rows($result);
    mysqli_free_result($result);
  }
  else {
    $jlhHadir = -1;
  }

  $sql = "SELECT absnId FROM absensi
          WHERE pgwId = '$pgwId' AND
          (absnStatus IS NOT NULL AND absnStatus != '')AND
          absnTgl BETWEEN '$start' AND '$end'
          GROUP BY absnTgl";
  if ($result=mysqli_query($conn,$sql)){
    $jlhIzin = mysqli_num_rows($result);
    mysqli_free_result($result);
  }
  else {
    $jlhIzin = -1;
  }

  $sql = "SELECT absnId FROM absensi
          WHERE pgwId = '$pgwId' AND
          (absnStatus IS NULL OR absnStatus ='') AND
          absnTgl BETWEEN '$start' AND '$end'
          GROUP BY absnTgl";
  if ($result=mysqli_query($conn,$sql)){
    $jlhAbsen = mysqli_num_rows($result);
    mysqli_free_result($result);
  }
  else {
    $jlhAbsen = -1;
  }

  $data = array(
    "hadir"=>$jlhHadir, "izin"=>$jlhIzin, "absen"=>$jlhAbsen
  );
  echo json_encode($data);
}
