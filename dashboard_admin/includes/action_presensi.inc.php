<?php
//action presensi untuk melakukan action delete pada tabel presensi dan menambahkannya ke tabel absensi.

include_once('dbconn.inc.php');

if ($_POST['action'] == 'delete') {
  if (!empty($id_ser = $_POST["identifier"])) {
    $id_array = preg_split("/;/",$id_ser);
    $prsnId = $id_array[0];
    $pgwId = $id_array[1];
    $nama = $id_array[2];
    $tgl = $id_array[3];

    $jumlahHadir = cekJumlahHadir($conn, $pgwId, $tgl);

    $sql1 = mysqli_query($conn, "DELETE FROM presensi WHERE prsnId = '$prsnId'");
    //jika jumlah hadir cuma satu maka akan menambahnya ke tabel absensi
    //jika lebih dari 1 maka karyawan tersebut masih hadir pada tanggal itu
    //dan tidak dimasukkan ke tabel absensi
    if ($jumlahHadir == 1) {
      $sql2 = mysqli_query($conn, "INSERT INTO absensi (pgwId, nama, absnTgl)
            VALUES ('$pgwId', '$nama', '$tgl')");
    }
    

    echo json_encode($_POST);
  }
  else{
    echo "Pegawai tidak ada data kehadiran pada tanggal tersebut";
  }
}

function cekJumlahHadir($conn, $pgwId, $tgl){
  $sql = "SELECT pgwId FROM presensi 
          WHERE pgwId='$pgwId' AND prsnTgl='$tgl' ";
  $result = mysqli_query($conn, $sql);
  $jumlahHadir = mysqli_num_rows($result);
  mysqli_free_result($result);
  return $jumlahHadir;
}