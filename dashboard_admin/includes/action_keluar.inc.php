<?php
//action admin untuk melakukan action delete data karyawan pada tabel user dan pegawai.

include_once('dbconn.inc.php');

if ($_POST['action'] == 'delete'){
  if (!empty($id_ser = $_POST["identifier"])) {
    $id_array = preg_split("/;/",$id_ser);
    $pgwId = $id_array[0];
    $uid = $id_array[1];
    $nama = $id_array[2];

    //memasukkan data tersebut ke tabel deleted
    $sql = "INSERT INTO deleted (pgwId, uid, nama) VALUES (?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $pgwId, $uid, $nama);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //menghapus data dari tabel user
    $sql = "DELETE FROM users WHERE usersUid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //menghapus data dari tabel pegawai
    //menonaktifkan relasi untuk menghapus data di tabel parent
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=0;"); 
    $sql = "DELETE FROM pegawai WHERE pgwId = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s",$pgwId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    //mengaktifkan kembali relasi untuk menjaga integritas data
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=1;");

    echo json_encode($_POST);
  }
}