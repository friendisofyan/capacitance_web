<?php
include_once("dbconn.inc.php");
$tgl = '2021-05-09';

$sql1 = "SELECT d.pgwId, d.nama 
          FROM pegawai d 
          WHERE d.pgwId NOT IN (SELECT pgwId FROM presensi Where prsnTgl = ?);";

$sql2 = "SELECT * FROM presensi WHERE prsnTgl = ?";

$stmt1 = mysqli_stmt_init($conn);
$stmt2 = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt1, $sql1);
mysqli_stmt_bind_param($stmt1, "s", $tgl);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);


mysqli_stmt_prepare($stmt2, $sql2);
mysqli_stmt_bind_param($stmt2, "s", $tgl);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);

$rows1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
$rows2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

mysqli_stmt_close($stmt1);
mysqli_stmt_close($stmt2);

foreach ($rows2 as $row) {
  echo "<tr>";
  echo "<td>" . $row['pgwId'] . "</td>";
  echo "<td>" . $row['nama'] . "</td>";
  echo "<td>" . $row['prsnTgl'] . "</td>";
  echo "<td>" . $row['temperature'] . "</td>";
  echo "<td>" . $row['jamMasuk'] . "</td>";
  echo "<td>" . $row['jamKeluar'] . "</td>";
  echo "</tr>";
}

foreach ($rows1 as $row1) {
  echo "<tr>";
  echo "<td>" . $row1['pgwId'] . "</td>";
  echo "<td>" . $row1['nama'] . "</td>";
  echo "<td>" . $tgl . "</td>";
  echo "<td>" . NULL . "</td>";
  echo "<td>" . NULL . "</td>";
  echo "<td>" . NULL . "</td>";
  echo "</tr>";
}