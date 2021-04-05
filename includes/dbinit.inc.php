<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "capacitance";
$tableusers = "users";

// Create connection
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully |";

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dBName";
if (mysqli_query($conn, $sql)) {
  echo "Database created successfully |";
} else {
  echo "Error creating database: " . mysqli_error($conn) . " |";
}

// Create connection to database
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully to db |";

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS $tableusers (
  usersId INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  usersName VARCHAR(128) NOT NULL,
  usersJabatan VARCHAR(128) NOT NULL,
  usersUid VARCHAR(128) NOT NULL,
  usersPwd VARCHAR(128) NOT NULL
  )";
if (mysqli_query($conn, $sql)) {
  echo "Table users created successfully |";
} 
else {
  echo "Error creating table: " . mysqli_error($conn) . " |";
}

mysqli_close($conn);