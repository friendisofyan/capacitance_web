<?php
header('Content-Type: application/json');
include_once('dbconn.inc.php');

if (isset($_POST["tglAwal"]) AND isset($_POST["tglAkhir"])) {
  $tglAwal = $_POST["tglAwal"];
  $tglAkhir = $_POST["tglAkhir"];
}

$sql1 = "SELECT pgwId, nama, COUNT(pgwId) AS counter 
        FROM presensi 
        WHERE prsnTgl BETWEEN '$tglAwal' AND '$tglAkhir'
        GROUP BY pgwId";

$sql2 = " SELECT d.pgwId, d.nama
          FROM pegawai d 
          WHERE d.pgwId NOT IN (SELECT pgwId 
                                FROM presensi
                                Where prsnTgl BETWEEN '$tglAwal' AND '$tglAkhir');";

$result1 = mysqli_query($conn,$sql1);
$result2 = mysqli_query($conn,$sql2);

$data = array();
foreach ($result1 as $row) {
	$data[] = $row;
}

foreach ($result2 as $row){
  array_push($data, $row);
}

mysqli_close($conn);

echo json_encode($data);
?>