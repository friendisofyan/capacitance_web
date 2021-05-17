<?php

function jumlahKaryawan($conn){
  $sql = "SELECT pgwId FROM pegawai WHERE 1";
  $result = mysqli_query($conn, $sql);
  $jumlah = mysqli_num_rows($result);
  mysqli_free_result($result);
  return $jumlah;
}

function persenKehadiran ($conn, $userLevel, $pgwId){
  $timezone = date_default_timezone_get();
  date_default_timezone_set($timezone);
  $today = date('Y-m-d');

  //jika admin maka akan menampilkan persentase kehadiran harian
  if ($userLevel == "admin") {
    $sql = "SELECT pgwId 
            FROM presensi 
            WHERE prsnTgl = '$today' 
            GROUP BY pgwId";
    
    $result = mysqli_query($conn, $sql);
    $jumlahHadir = mysqli_num_rows($result);
    
    $jumlahKaryawan = jumlahKaryawan($conn);

    $persenKehadiran = round((($jumlahHadir/$jumlahKaryawan)*100),2);
    mysqli_free_result($result);
    return "$persenKehadiran %";
  }

  //jika user reguler maka menampilkan rekap kehadiran dalam 1 bulan
  //dari awal bulan tgl 1 sampai hari ini (today)
  elseif ($userLevel == "reguler") {
    $awal = date('Y-m-01');
    $sql = "SELECT pgwId 
            FROM presensi 
            WHERE (prsnTgl BETWEEN '$awal' AND '$today') AND (pgwId = '$pgwId')";
    $result = mysqli_query($conn, $sql);
    $jumlahHadir = mysqli_num_rows($result);
    mysqli_free_result($result);

    //menghitung hari dari awal bulan hingga hari ini
    $awal = new DateTime($awal);
    $today = new DateTime($today);
    $hariKerja = getSelisihWeekdays($awal, $today);

    $persenKehadiran = round((($jumlahHadir/$hariKerja)*100),2);
    return "$persenKehadiran %";
  }
  
}


function getSelisihWeekdays(\DateTime $startDate, \DateTime $endDate){
  $isWeekday = function (\DateTime $date) {
    return $date->format('N') < 6;
  };

  $days = $isWeekday($endDate) ? 1 : 0;

  while($startDate->diff($endDate)->days > 0) {
    $days += $isWeekday($startDate) ? 1 : 0;
    $startDate = $startDate->add(new \DateInterval("P1D"));
  }

  return $days;
}

function jumlahSakit ($conn, $userLevel, $pgwId){
  $timezone = date_default_timezone_get();
  date_default_timezone_set($timezone);
  $today = date('Y-m-d');

  //jika admin maka akan menampilkan persentase kehadiran harian
  if ($userLevel == "admin") {
    $sql = "SELECT pgwId 
            FROM absensi 
            WHERE (absnTgl = '$today') AND 
            (absnStatus = 'sakit')
            GROUP BY pgwId";
    
    $result = mysqli_query($conn, $sql);
    $jumlahSakit = mysqli_num_rows($result);
 
    mysqli_free_result($result);
    return $jumlahSakit;
  }

  //jika user reguler maka menampilkan rekap kehadiran dalam 1 bulan
  //dari awal bulan tgl 1 sampai hari ini (today)
  elseif ($userLevel == "reguler") {
    $awal = date('Y-m-01');
    $sql = "SELECT pgwId
            FROM absensi 
            WHERE (absnTgl BETWEEN '$awal' AND '$today') 
            AND (pgwId = '$pgwId')
            AND (absnStatus = 'sakit')";
    $result = mysqli_query($conn, $sql);
    $jumlahSakit = mysqli_num_rows($result);
    mysqli_free_result($result);

    return $jumlahSakit;
  }
}

function jumlahAbsen ($conn, $userLevel, $pgwId){
  $timezone = date_default_timezone_get();
  date_default_timezone_set($timezone);
  $today = date('Y-m-d');

  //jika admin maka akan menampilkan persentase kehadiran harian
  if ($userLevel == "admin") {
    $sql = "SELECT pgwId 
            FROM absensi 
            WHERE (absnTgl = '$today') AND 
            (absnStatus IS NULL)
            GROUP BY pgwId";
    
    $result = mysqli_query($conn, $sql);
    $jumlahAbsen = mysqli_num_rows($result);
 
    mysqli_free_result($result);
    return $jumlahAbsen;
  }

  //jika user reguler maka menampilkan rekap kehadiran dalam 1 bulan
  //dari awal bulan tgl 1 sampai hari ini (today)
  elseif ($userLevel == "reguler") {
    $awal = date('Y-m-01');
    $sql = "SELECT pgwId
            FROM absensi 
            WHERE (absnTgl BETWEEN '$awal' AND '$today') 
            AND (pgwId = '$pgwId')
            AND (absnStatus IS NULL)";
    $result = mysqli_query($conn, $sql);
    $jumlahAbsen = mysqli_num_rows($result);
    mysqli_free_result($result);

    return $jumlahAbsen;
  }
}