<?php
header('Content-Type: application/json');
include_once('dbconn.inc.php');
include_once('dashboard_functions.inc.php');

$timezone = date_default_timezone_get();
date_default_timezone_set($timezone);

if (isset($_POST["pgwId"])) {
  $pgwId = $_POST["pgwId"];

  $dataBulan = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
  $result = array();

  foreach ($dataBulan as $bulan){
    $subdata = array();
    $subdata["bulan"] = $bulan;
    $subdata["persen"] = persenKehadiranBulanan($conn, $pgwId, $bulan);
    $result[] =$subdata;
  }
  echo json_encode($result);
}



function persenKehadiranBulanan ($conn, $pgwId, $bulan){
  $start = new DateTime($bulan);
  $awal = $start->format("Y-m-01");
  
  $now = new DateTime();
  //untuk bulan hari-h maka hanya akan dihitung persentasi hingga hari-h
  if ($bulan == $now->format("M")) {
    $akhir = $now->format("Y-m-d");
  }
  //untuk bulan lainnya maka akan dihitung hingga akhir bulan
  else {
    $end = new DateTime($awal);
    $end->add(new DateInterval('P1M'));//P[eriod] 1 M[onth]
    $end->sub(new DateInterval('P1D'));// P[eriod] 1 D[ay]
    $akhir = $end->format("Y-m-d");
  }

  $sql = "SELECT pgwId 
          FROM presensi 
          WHERE (prsnTgl BETWEEN '$awal' AND '$akhir') AND (pgwId = '$pgwId')
          GROUP BY prsnTgl";
  $result = mysqli_query($conn, $sql);
  $jumlahHadir = mysqli_num_rows($result);
  mysqli_free_result($result);

  //menghitung hari dari awal bulan hingga hari ini
  $hariKerja = getSelisihWeekdays(new DateTime($awal), new DateTime($akhir));

  $persenKehadiran = round((($jumlahHadir/$hariKerja)*100),2);
  return $persenKehadiran;
}