<?php
header('Content-Type: application/json');
include_once('dbconn.inc.php');
include_once('dashboard_functions.inc.php');

// $timezone = date_default_timezone_get();
// date_default_timezone_set($timezone);
date_default_timezone_set("Asia/Jakarta");

if (isset($_POST["pgwId"])) {
  $pgwId = $_POST["pgwId"];

  //ada bug di datetime php jika tidak diberi nilai tahun maka
  //bulannya akan (Jan, Mar, Mar, May, May, Jul, Jul, dst)
  //selanjutnya diberi nilai tahun agar bisa mengetahui tahun kabisat
  $thnSkrg = date('Y');
  $dataBulan = array("Jan $thnSkrg", "Feb $thnSkrg", "Mar $thnSkrg", 
                    "Apr $thnSkrg", "May $thnSkrg", "Jun $thnSkrg", 
                    "Jul $thnSkrg", "Aug $thnSkrg", "Sep $thnSkrg", 
                    "Oct $thnSkrg", "Nov $thnSkrg", "Dec $thnSkrg");
  $result = array();

  foreach ($dataBulan as $bulan){
    $subdata = array();
    $temp = new DateTime($bulan);
    $subdata["bulan"] = $temp->format('M');
    $subdata["persen"] = persenKehadiranBulanan($conn, $pgwId, $bulan, $hariKerja);
    $result[] =$subdata;
  }
  echo json_encode($result);
}



function persenKehadiranBulanan ($conn, $pgwId, $bulan, $hariKerja){
  $start = new DateTime($bulan);
  $awal = $start->format("Y-m-01");
  
  $now = new DateTime();
  $bulanNow = $now->format("M Y");
  //untuk bulan hari-h maka hanya akan dihitung persentasi hingga hari-h
  if ($bulan == $bulanNow) {
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
  $jumlahHari = getSelisihWeekdays(new DateTime($awal), new DateTime($akhir), $hariKerja);

  $persenKehadiran = round((($jumlahHadir/$jumlahHari)*100),2);
  return $persenKehadiran;
}