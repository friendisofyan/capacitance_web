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

    $sql1 = mysqli_query($conn, "DELETE FROM presensi WHERE prsnId = '$prsnId'");
    $sql2 = mysqli_query($conn, "INSERT INTO absensi (pgwId, nama, absnTgl)
            VALUES ('$pgwId', '$nama', '$tgl')");

    echo json_encode($_POST);
  }
  else{
    echo "alert('Pegawai tidak ada data kehadiran pada tanggal tersebut')";
  }
  
}