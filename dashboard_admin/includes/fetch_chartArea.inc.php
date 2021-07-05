<?php
header('Content-Type: application/json');
include_once('dbconn.inc.php');
include_once('dashboard_functions.inc.php');

if (isset($_POST["selector"])) {
  $selector = $_POST["selector"];
}

if ($selector == "harian") {
  //menampilkan data perhari dari awal hingga akhir bulan
  $start = date('Y-m-01');
  $awal = new DateTime($start);
  $interval = new DateInterval('P1M');// P[eriod] 1 M[onth]
  $akhir = new DateTime($start);
  $akhir->add($interval);

  $data = array();
  $subarray = array();
  $oneday = new DateInterval("P1D");

  // iterasi dari $start sampe $end day, dengan iterasi 1 hari.
  // iterasi tidak include hari ke $end dan sengaja dilakukan
  // karena hari ke $end adalah tgl 1 di bulan depan
  foreach(new DatePeriod($awal, $oneday, $akhir) as $day) {
    $day_num = $day->format("N"); /* 'N' number days 1 (mon) to 7 (sun) */
    if($day_num <= $hariKerja) { /* weekday */
      $subarray["date"] = $day->format('D, d M');
      //menggunakan persenKehadiran dari fungsi di dasboard_functions
      $subarray["persen"] = persenKehadiran($conn, "admin", "1", $day->format('Y-m-d'), $hariKerja);
      $data[] = $subarray;
    } 
  }
  echo json_encode($data);
}

elseif ($selector == "bulanan"){
  //menampilkan data perbulan dari awal bulan hingga akhir bulan dalam 1 tahun

  //terdapat bug di datetime php jika tidak diberi nilai tahun maka
  //bulannya akan (Jan, Mar, Mar, May, May, Jul, Jul, dst)
  //selanjutnya diberi nilai tahun agar bisa mengetahui tahun kabisat
  $thnSkrg = date('Y');
  $dataBulan = array("Jan $thnSkrg", "Feb $thnSkrg", "Mar $thnSkrg", 
                    "Apr $thnSkrg", "May $thnSkrg", "Jun $thnSkrg", 
                    "Jul $thnSkrg", "Aug $thnSkrg", "Sep $thnSkrg", 
                    "Oct $thnSkrg", "Nov $thnSkrg", "Dec $thnSkrg");

  $result = array();
  foreach ($dataBulan as $bulan) {
    $subdata = array();
    $temp = new DateTime($bulan);
    $subdata["date"] = $temp->format('M'); //untuk label diambil format M dari variabel temp
    $subdata["persen"] = kehadiranPerbulan($conn, $bulan, $hariKerja);
    $result[] =$subdata;
  }
  echo json_encode($result);
}

function kehadiranPerbulan($conn, $bulan, $hariKerja){
  $jumlahKaryawan = jumlahKaryawan($conn);

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

  $sql = "SELECT DISTINCT pgwId, prsnTgl
          FROM presensi 
          WHERE (prsnTgl BETWEEN ? AND ?)";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'ss', $awal, $akhir);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $jumlahKehadiran = mysqli_num_rows($result);
  mysqli_free_result($result);
  mysqli_stmt_close($stmt);

  //menghitung hari dari awal bulan hingga hari ini
  $jumlahHari = getSelisihWeekdays(new DateTime($awal), new DateTime($akhir), $hariKerja);

  $persenKehadiran = ($jumlahKehadiran/($jumlahKaryawan * $jumlahHari))*100;
  $persenKehadiran = round($persenKehadiran,2);
  if ($persenKehadiran > 100) {
    return 100;
  }
  return $persenKehadiran;
}