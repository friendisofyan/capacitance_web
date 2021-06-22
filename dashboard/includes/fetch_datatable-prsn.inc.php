<?php
include_once('dbconn.inc.php');

// $tgl = '2021-05-09';
if (isset($_POST["tglAwal"]) && isset($_POST["tglAkhir"]) && isset($_POST["pgwId"])) {
  $tglAwal = $_POST["tglAwal"];
  $tglAkhir = $_POST["tglAkhir"];
  $pgwId = $_POST["pgwId"];

  $sql = "SELECT * FROM presensi 
        WHERE pgwId = ? AND 
        prsnTgl BETWEEN ? and ?";

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
    $subdata[] = $row["prsnId"]; //prsnId
    $date = new DateTime($row["prsnTgl"]);
    $subdata[] = $date->format("d-m-Y, l"); //prsnTgl
    if (strcmp($row["temperature"],"37.50")>=0) {
      $subdata[] = '<font style="color:red">'.$row["temperature"].'</font>';
    }
    else {
      $subdata[] = $row["temperature"]; //temperature  
    }
    $subdata[] = $row["jamMasuk"]; //jamMasuk
    $subdata[] = $row["jamKeluar"]; //jamKeluar
    $subdata[] = $row["durasi"]; //durasi
    $data[] = $subdata;
  }

  mysqli_free_result($result);

  $json_data = array("data" => $data);
  echo json_encode($json_data);
  
}
else {
  $data = array("------");
  $json_data = array("data" => $data);
  echo json_encode($json_data);
}

function getWeekdays(\DateTime $startDate, \DateTime $endDate){
  $result = array();
  function isWeekday (\DateTime $date) {
    return $date->format('N') < 6;
  };

  while($startDate->diff($endDate)->days > 0) {
    if (isWeekday($startDate)){
        $result[] = $startDate->format('d-m-Y');
    }
    $startDate = $startDate->add(new \DateInterval("P1D"));
  }
  if (isWeekday($endDate)){
      $result[] = $endDate->format('d-m-Y');
  }

  return $result;
}
