<?php
include_once('dbconn.inc.php');

if (isset($_POST["submit"])) {
  $pgwId = $_POST['pgwId'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $tglLahir = $_POST['tglLahir'];
  $telp = $_POST['telp'];
  $alamat = $_POST['alamat'];

  updateProfile($conn, $pgwId, $email, $gender, $tglLahir, $telp, $alamat);
}

function getProfile($conn,$pgwId){
  $sql = "SELECT * FROM pegawai
          WHERE pgwId = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 's', $pgwId);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  mysqli_stmt_close($stmt);
  return $row;
}

function showProfile($conn, $pgwId) {
  $row = getProfile($conn, $pgwId);

  $gender = '';
  if ($row['gender'] == 'L') {
    $gender = 'Laki-Laki';
  }
  elseif ($row['gender'] == 'P') {
    $gender = 'Perempuan';
  }
  $tglLahir = new DateTime($row['tglLahir']);

  $html ="
    <tr>
      <th>Nama </th>
      <td>".$row['nama']."</td>
    </tr>
    <tr>
      <th>Tgl Lahir</th>
      <td>".$tglLahir->format('d F Y')."</td>
    </tr>
    <tr>
      <th>Jenis Kelamin</th>
      <td>".$gender."</td>
    </tr>
    <tr>
      <th>Email</th>
      <td>".$row['email']."</td>
    </tr>
    <tr>
      <th>Nomor Telepon</th>
      <td>".$row['telp']."</td>
    </tr>
    <tr>
      <th>Alamat</th>
      <td>".$row['alamat']."</td>
    </tr>
  ";
  echo $html;
}

function updateProfile($conn, $pgwId, $email, $gender, $tglLahir, $telp, $alamat) {
  $sql = 'UPDATE pegawai SET
          email = ?,
          gender = ?,
          tglLahir = ?,
          telp = ?,
          alamat =?
          WHERE pgwId = ?;
          ';
  if (!$stmt = mysqli_prepare($conn, $sql)) {
    echo "Fail Preparing!";
    exit();
  }
  mysqli_stmt_bind_param($stmt, 'ssssss', $email, $gender, $tglLahir, $telp, $alamat, $pgwId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../profile.php?error=none");
  exit();
}