<?php
include_once("dbconn.inc.php");
include_once("function.php");

// $pgwId = getPgwId($conn, $_GET['q'])

// $sql = "SELECT * FROM presensi WHERE  pgwId = ?";
$sql = "SELECT * FROM presensi";

$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
// mysqli_stmt_bind_param($stmt, "s", $pgwId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

foreach ($rows as $row) {
  echo "<tr>";
  echo "<td>" . $row['pgwId'] . "</td>";
  echo "<td>" . $row['nama'] . "</td>";
  echo "<td>" . $row['prsnTgl'] . "</td>";
  echo "<td>" . $row['temperature'] . "</td>";
  echo "<td>" . $row['jamMasuk'] . "</td>";
  echo "<td>" . $row['jamKeluar'] . "</td>";
  echo "</tr>";
}
