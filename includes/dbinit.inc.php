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

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS $tableusers (
        usersId INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        usersName VARCHAR(128) NOT NULL,
        usersJabatan VARCHAR(128) NOT NULL,
        usersEmail VARCHAR(128) NOT NULL,
        usersUid VARCHAR(128) NOT NULL,
        usersPwd VARCHAR(128) NOT NULL,
        INDEX (usersName),
        INDEX (usersEmail),
        INDEX (usersJabatan)
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
        jabatan VARCHAR(128) NOT NULL,
        email VARCHAR(128) NOT NULL,
        gender ENUM('male', 'female'),
        tglLahir VARCHAR(32),
        telp VARCHAR(16),
        alamat VARCHAR(128),
        statusPgw ENUM('aktif',  'keluar'),
        FOREIGN KEY (nama) REFERENCES users(usersName) ON DELETE RESTRICT ON UPDATE CASCADE,
        FOREIGN KEY (email) REFERENCES users(usersEmail) ON DELETE RESTRICT ON UPDATE CASCADE,
        FOREIGN KEY (jabatan) REFERENCES users(usersJabatan) ON DELETE RESTRICT ON UPDATE CASCADE
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
        prsnTgl DATE,
        jamMasuk TIME,
        jamKeluar TIME,
        overtime  TIME,
        FOREIGN KEY (pgwID) REFERENCES pegawai(pgwID) ON DELETE RESTRICT ON UPDATE CASCADE
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
        tgl_mulai DATE,
        tgl_selesai DATE,
        absnStatus enum('cuti', 'ijin', 'sakit'),
        absnKet VARCHAR(128),
        FOREIGN KEY (pgwID) REFERENCES pegawai(pgwID) ON DELETE RESTRICT ON UPDATE CASCADE
        );";
if (mysqli_query($conn, $sql)) {
  echo "Table absensi created successfully <br>";
} 
else {
  echo "Error creating table: " . mysqli_error($conn) . " <br>";
}

mysqli_close($conn);