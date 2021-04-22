<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "testAJAX";

$conn = mysqli_connect($serverName,$dBUsername,$dBPassword,$dBName);

if(!$conn){
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM data WHERE dataNama = ?";

$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "s", $_GET['q']);
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($resultData);
mysqli_stmt_close($stmt);


echo "<table>";
echo "<tr>";
echo "<th>Nama</th>";
echo "<td>" . $row['dataNama'] . "</td>";
echo "</tr> <tr>";
echo "<th>Tanggal Lahir</th>";
echo "<td>" . $row['dataLahir'] . "</td>";
echo "</tr> <tr>";
echo "<th>Hobi</th>";
echo "<td>" . $row['dataHobi'] . "</td>";
echo "</tr> <tr>";
echo "<th>Pekerjaan</th>";
echo "<td>" . $row['dataPekerjaan'] . "</td>";
echo "</tr>";
echo "</table>";