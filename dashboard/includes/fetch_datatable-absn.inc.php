<?php
include_once('dbconn.inc.php');

// $tgl = '2021-05-09';
if (isset($_POST["tglAwal"]) && isset($_POST["tglAkhir"]) && isset($_POST["pgwId"])) {
  $tglAwal = $_POST["tglAwal"];
  $tglAkhir = $_POST["tglAkhir"];
  $pgwId = $_POST["pgwId"];

  $sql = "SELECT * FROM absensi 
        WHERE pgwId = ? AND 
        absnTgl BETWEEN ? and ?
        ORDER BY absnTgl ASC;";

  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "fail preparing";
    exit();
  }
  mysqli_stmt_bind_param($stmt, "sss", $pgwId, $tglAwal, $tglAkhir);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $data = array();

  while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $subdata = array();
    $subdata[] = $row["absnId"]; //absnId
    $date = new DateTime($row["absnTgl"]);
    $subdata[] = $date->format("d-m-Y, l"); //absnTgl

    //subdata untuk status absen
    if (empty($row["absnStatus"])) {
      $subdata[] = "-";
    }
    else {
      $subdata[] = $row["absnStatus"]; //absnStatus
    }
    
    //subdata untuk keterangan absen
    if (empty($row["absnKet"])) {
      $subdata[] = "-";
    }
    else {
      $subdata[] = $row["absnKet"]; //absnStatus
    }
    
    $data[] = $subdata;
  }

  $json_data = array("data" => $data);
  echo json_encode($json_data);
  
}
else {
  $data = array("----");
  $json_data = array("data" => $data);
  echo json_encode($json_data);
}

