<?php
  session_start();
  error_reporting(E_ALL & ~E_NOTICE);
  include_once("dbconn.inc.php");

  date_default_timezone_set('Asia/Jakarta');

  $configFilepath = $_SERVER['DOCUMENT_ROOT'].'/config.ini';
  include_once($_SERVER['DOCUMENT_ROOT'].'/includes/parse-config.inc.php');
  $config = new Config;
  $config->load($configFilepath);
  $hariKerja = intval($config->get('hari_kerja.hari'));

if (isset($_POST["gantiHariKerja"])) {
  $new = $_POST["newHariKerja"];
  updateHarikerja($new, $config, $configFilepath);
  header('Location: ../index.php');
  // header("location:javascript://history.go(-1)");
  exit();
}

if (isset($_POST["gantiPwd"])) {
  $oldPwd = $_POST["oldPwd"];
  $newPwd = $_POST["newPwd"];
  $rePwd = $_POST["rePwd"];
  $uid = $_SESSION["useruid"];
  $userLevel = $_SESSION["userlevel"];

  if ($rePwd != $newPwd) {
    header("location: ../ubah_password.php?error=notMatch");
    exit();
  }
  else{
    changePwd($conn, $userLevel, $uid, $oldPwd, $newPwd);
    exit();
  }
}

function jumlahKaryawan($conn){
  $sql = "SELECT pgwId FROM pegawai WHERE 1";
  $result = mysqli_query($conn, $sql);
  $jumlah = mysqli_num_rows($result);
  mysqli_free_result($result);
  return $jumlah;
}

function persenKehadiran ($conn, $userLevel, $pgwId, $today, $hariKerja){
  //jika admin maka akan menampilkan persentase kehadiran harian
  if ($userLevel == "admin") {
    $sql = "SELECT pgwId 
            FROM presensi 
            WHERE prsnTgl = '$today' 
            GROUP BY pgwId";
    
    $result = mysqli_query($conn, $sql);
    $jumlahHadir = mysqli_num_rows($result);
    
    $jumlahKaryawan = jumlahKaryawan($conn);

    if ($jumlahKaryawan == 0) {
      $persenKehadiran = 0;  
    }
    else{
      $persenKehadiran = round((($jumlahHadir/$jumlahKaryawan)*100),2);
    }
    mysqli_free_result($result);
    return $persenKehadiran;
  }

  //jika user reguler maka menampilkan rekap kehadiran dalam 1 bulan
  //dari awal bulan tgl 1 sampai hari ini (today)
  elseif ($userLevel == "reguler") {
    $awal = date('Y-m-01');
    $sql = "SELECT pgwId 
            FROM presensi 
            WHERE (prsnTgl BETWEEN '$awal' AND '$today') AND (pgwId = '$pgwId')
            GROUP BY prsnTgl";
    $result = mysqli_query($conn, $sql);
    $jumlahHadir = mysqli_num_rows($result);
    mysqli_free_result($result);

    //menghitung hari dari awal bulan hingga hari ini
    $awal = new DateTime($awal);
    $today = new DateTime($today);
    $jumlahHari = getSelisihWeekdays($awal, $today, $hariKerja);

    $persenKehadiran = round((($jumlahHadir/$jumlahHari)*100),2);
    return $persenKehadiran;
  }
  
}

function getSelisihWeekdays(\DateTime $startDate, \DateTime $endDate, $hariKerja){
  $isWeekday = function (\DateTime $date) use($hariKerja) {
    return $date->format('N') <= $hariKerja;
  };

  $days = $isWeekday($endDate) ? 1 : 0;

  while($startDate->diff($endDate)->days > 0) {
    $days += $isWeekday($startDate) ? 1 : 0;
    $startDate = $startDate->add(new \DateInterval("P1D"));
  }

  return $days;
}

function jumlahSakit ($conn, $userLevel, $pgwId){
  $today = date('Y-m-d');

  //jika admin maka akan menampilkan jumlah karyawan sakit dan izin harian
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

  //jika user reguler maka menampilkan rekap sakit dan izin dalam 1 bulan
  //dari awal bulan tgl 1 sampai hari ini (today)
  elseif ($userLevel == "reguler") {
    $awal = date('Y-m-01');
    $sql = "SELECT pgwId
            FROM absensi 
            WHERE (absnTgl BETWEEN '$awal' AND '$today') 
            AND (pgwId = '$pgwId')
            AND (absnStatus = 'sakit')
            GROUP BY absnTgl";
    $result = mysqli_query($conn, $sql);
    $jumlahSakit = mysqli_num_rows($result);
    mysqli_free_result($result);

    return $jumlahSakit;
  }
}

function jumlahAbsen ($conn, $userLevel, $pgwId){
  $today = date('Y-m-d');

  //jika admin maka akan menampilkan jumlah karyawan absen pada hari itu
  if ($userLevel == "admin") {
    $sql = "SELECT pgwId 
            FROM absensi 
            WHERE (absnTgl = '$today') AND 
            (absnStatus IS NULL OR absnStatus = '')
            GROUP BY pgwId";
    
    $result = mysqli_query($conn, $sql);
    $jumlahAbsen = mysqli_num_rows($result);
 
    mysqli_free_result($result);
    return $jumlahAbsen;
  }

  //jika user reguler maka menampilkan rekap absen dalam 1 bulan
  //dari awal bulan tgl 1 sampai hari ini (today)
  elseif ($userLevel == "reguler") {
    $awal = date('Y-m-01');
    $sql = "SELECT pgwId
            FROM absensi 
            WHERE (absnTgl BETWEEN '$awal' AND '$today') 
            AND (pgwId = '$pgwId')
            AND (absnStatus IS NULL OR absnStatus = '')
            GROUP BY absnTgl";
    $result = mysqli_query($conn, $sql);
    $jumlahAbsen = mysqli_num_rows($result);
    mysqli_free_result($result);

    return $jumlahAbsen;
  }
}

function updateHarikerja ($new, $config, $configFilepath){
  $format = array(
    "hari_kerja" => array(
      "hari" => $new
    )
  );

  $config->update($format, $configFilepath);
}

function getPegawai ($conn){
  $sql = "SELECT pgwId, nama FROM pegawai
          WHERE 1";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  $pegawais = array();
  // dengan format : pgwId - Nama
  while ($row = mysqli_fetch_array($result)) {
    $pegawais[] = $row[0].' - '.$row[1];
  }
  mysqli_free_result($result);
  mysqli_stmt_close($stmt);
  return $pegawais;
}

function showPegawai ($conn){
  $pegawais = getPegawai($conn);
  //print option satu persatu 
  foreach($pegawais as $pegawai){
    echo '<option value="'.$pegawai.'">';
  }
}

function changePwd ($conn, $userLevel, $uid, $oldPwd, $newPwd){
  if ($userLevel === "admin") {
    $sql = "SELECT adminPwd FROM admin WHERE adminUid =?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);
    $dbPwd = $row[0];
    mysqli_free_result($result);
    mysqli_stmt_close($stmt);

    $checkPwd = password_verify($oldPwd, $dbPwd);
    // jika password lama tidak sesuai akan dikirim kembali ke ke halaman ganti password
    if (!$checkPwd) {
      header('location: ../ubah_password.php?error=wrongPassword');
      exit();
    }
    // jika password lama sesuai maka akan lanjut ganti password
    else{
      $newPwd = password_hash($newPwd, PASSWORD_DEFAULT);

      $sql = "UPDATE admin set adminPwd = ?
              WHERE adminUid = ?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, 'ss', $newPwd, $uid);
      mysqli_stmt_execute($stmt);
      header('location: ../ubah_password.php?error=none');
      exit();
    }
  }

  elseif ($userLevel == "reguler") {
    $sql = "SELECT usersPwd FROM users WHERE usersUid =?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);
    $dbPwd = $row[0];
    mysqli_free_result($result);
    mysqli_stmt_close($stmt);

    $checkPwd = password_verify($oldPwd, $dbPwd);
    // jika password lama tidak sesuai akan dikirim kembali ke ke halaman ganti password
    if (!$checkPwd) {
      header('location: ../ubah_password.php?error=wrongPassword');
      exit();
    }
    // jika password lama sesuai maka akan lanjut ganti password
    else{
      $newPwd = password_hash($newPwd, PASSWORD_DEFAULT);

      $sql = "UPDATE users set usersPwd = ?
              WHERE usersUid = ?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, 'ss', $newPwd, $uid);
      mysqli_stmt_execute($stmt);
      header('location: ../ubah_password.php?error=none');
    }
  }
}