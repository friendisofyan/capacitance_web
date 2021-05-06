<?php

function getPgwId($conn, $uid){
	$sqlPgw = "SELECT * FROM  pegawai WHERE uid = ?;";
	$stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sqlPgw)) {
    header("location: errorHandling.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $uid);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row["pgwId"];
  }
  else {
    $result = false;
    return $result;
  }
  mysqli_stmt_close($stmt);
}