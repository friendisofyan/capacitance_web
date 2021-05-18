<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "capacitance";
$tableusers = "users";
$tablepegawai = "pegawai";
$tablepresensi = "presensi";
$tableabsensi = "absensi";

// Create connection
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully <br>";

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dBName";
if (mysqli_query($conn, $sql)) {
  echo "Database created successfully <br>";
} else {
  echo "Error creating database: " . mysqli_error($conn) . " <br>";
}

// Create connection to database
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully to db <br>";

<?php

include_once("dbconn.inc.php");

$tableusers = "users";
$tablepegawai = "pegawai";
$tablepresensi = "presensi";
$tableabsensi = "absensi";

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS $tableusers (
        usersId INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        usersName VARCHAR(128) NOT NULL,
        usersEmail VARCHAR(128) NOT NULL,
        usersUid VARCHAR(128) NOT NULL,
        usersPwd VARCHAR(128) NOT NULL,
        INDEX (usersName),
        INDEX (usersUid),
        INDEX (usersEmail)
        );";
if (mysqli_query($conn, $sql)) {
  echo "Table users created successfully <br>";
} 
else {
  echo "Error creating table: " . mysqli_error($conn) . " <br>";
}


// Create pegawai table
$sql = "CREATE TABLE IF NOT EXISTS $tablepegawai (
        pgwId INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(128) NOT NULL,
        uid VARCHAR(128) NOT NULL,
        jabatan VARCHAR(128) NOT NULL,
        email VARCHAR(128) NOT NULL,
        gender ENUM('L', 'P'),
        tglLahir VARCHAR(32),
        telp VARCHAR(16),
        alamat VARCHAR(128),
        statusPgw ENUM('aktif',  'keluar'),
        FOREIGN KEY (nama) REFERENCES users(usersName) ON DELETE RESTRICT ON UPDATE CASCADE,
        FOREIGN KEY (email) REFERENCES users(usersEmail) ON DELETE RESTRICT ON UPDATE CASCADE,
        FOREIGN KEY (uid) REFERENCES users(usersUid) ON DELETE RESTRICT ON UPDATE CASCADE
        );";
if (mysqli_query($conn, $sql)) {
  echo "Table pegawai created successfully <br>";
} 
else {
  echo "Error creating table: " . mysqli_error($conn) . " <br>";
}

//create presensi table
$sql = "CREATE TABLE IF NOT EXISTS $tablepresensi (
        prsnId INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        pgwId INT(10) UNSIGNED NOT NULL,
        nama VARCHAR(128) NOT NULL,
        prsnTgl DATE,
        temperature VARCHAR(6),
        jamMasuk TIME,
        jamKeluar TIME,
        overtime  TIME,
        FOREIGN KEY (pgwID) REFERENCES pegawai(pgwID) ON DELETE RESTRICT ON UPDATE CASCADE,
        FOREIGN KEY (nama) REFERENCES pegawai(nama) ON DELETE RESTRICT ON UPDATE CASCADE
        );";
if (mysqli_query($conn, $sql)) {
  echo "Table presensi created successfully <br>";
} 
else {
  echo "Error creating table: " . mysqli_error($conn) . " <br>";
}


//create absensi table
$sql = "CREATE TABLE IF NOT EXISTS $tableabsensi (
	      absnId INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        pgwId INT(10) UNSIGNED NOT NULL,
        nama VARCHAR(128) NOT NULL,
        absnTgl DATE,
        absnStatus enum('cuti', 'ijin', 'sakit'),
        absnKet VARCHAR(128),
        FOREIGN KEY (pgwID) REFERENCES pegawai(pgwID) ON DELETE RESTRICT ON UPDATE CASCADE,
        FOREIGN KEY (nama) REFERENCES pegawai(nama) ON DELETE RESTRICT ON UPDATE CASCADE
        );";
if (mysqli_query($conn, $sql)) {
  echo "Table absensi created successfully <br>";
} 
else {
  echo "Error creating table: " . mysqli_error($conn) . " <br>";
}

//create admin table
$sql = "CREATE TABLE IF NOT EXISTS admin (
        adminName varchar(128) NOT NULL,
        adminUid varchar(128) NOT NULL PRIMARY KEY,
        adminPwd varchar(128) NOT NULL
      );";
if (mysqli_query($conn, $sql)) {
  echo "Table admin created successfully <br>";
} 
else {
  echo "Error creating table: " . mysqli_error($conn) . " <br>";
}

//create default admin account
$adminName = "admin"
$adminUid = "admin";
$adminPwd = password_hash("admin", PASSWORD_DEFAULT);
$sql = "INSERT INTO admin (adminName, adminUid, adminPwd) VALUES ('$adminName', '$adminUid', '$adminPwd');";
if (mysqli_query($conn, $sql)) {
  echo "Default admin account created successfully <br>";
} 
else {
  echo "Error creating admin account: " . mysqli_error($conn) . " <br>";
}

mysqli_close($conn);