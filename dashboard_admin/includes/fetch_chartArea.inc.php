<?php
header('Content-Type: application/json');
include_once('dbconn.inc.php');
include_once('dashboard_functions.inc.php');

if (isset($_POST["selector"])) {
  $selector = $_POST["selector"];
}

if ($selector == "harian") {
  //menampilkan data perhari dari awal hingga akhir bulan
  $early = date('Y-m-01');
  $start = new DateTime($early);//datetime untuk awal bulan 
  $interval = new DateInterval('P1M');// P[eriod] 1 M[onth]
  $end = new DateTime($early);
  $end->add($interval);

  $result = fetchDataPerhari($conn, $start, $end, $hariKerja);
  echo json_encode($result);
}
elseif ($selector == "bulanan"){
  //menampilkan data perbulan dari awal bulan hingga akhir bulan dalam 1 tahun
}


function fetchDataPerhari($conn, $start, $end,$hariKerja){
  $data = array();
  $subarray = array();
  $oneday = new DateInterval("P1D");

  // iterasi dari $start sampe $end day, dengan iterasi 1 hari.
  // iterasi tidak include hari ke $end dan sengajak dilakukan
  // karena hari ke $end adalah tgl 1 di bulan depan
  foreach(new DatePeriod($start, $oneday, $end) as $day) {
    $day_num = $day->format("N"); /* 'N' number days 1 (mon) to 7 (sun) */
    if($day_num <= $hariKerja) { /* weekday */
      $subarray["hari"] = $day->format('D, d M');
      $subarray["persen"] = persenKehadiran($conn, "admin", "1", $day->format('Y-m-d'), $hariKerja);
      $data[] = $subarray;
    } 
  }
  return $data;
}