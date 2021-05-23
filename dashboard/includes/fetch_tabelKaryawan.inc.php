<?php
include_once('dbconn.inc.php');

$sql = "SELECT d.pgwId, d.nama, d.jabatan, d.email, d.telp, d.alamat, d.statusPgw
          FROM pegawai d 
          WHERE 1=1;";

$query = mysqli_query($conn, $sql);

$data = array();

while ($row=mysqli_fetch_array($query)) {
  $subdata = array();
  $subdata[] = $row[0]; //pgwId
  $subdata[] = $row[1]; //nama
  $subdata[] = $row[2]; //jabatan
  $subdata[] = $row[3]; //email  
  $subdata[] = $row[4]; //telp
  $subdata[] = $row[5]; //alamat
  if (strcmp($row[6],"keluar")==0) {
    $subdata[] = '<font style="color:red">'.$row[6].'</font>';
  }
  else {
    $subdata[] = $row[6]; //status  
  }
  $data[] = $subdata;
}

$json_data = array("data" => $data);
echo json_encode($json_data);