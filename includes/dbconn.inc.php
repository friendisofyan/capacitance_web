<?php

$configFilepath = $_SERVER['DOCUMENT_ROOT'].'/config.ini';
include_once('parse-config.inc.php');
$config = new Config;
$config->load($configFilepath);

$serverName = $config->get('db.serverName');
$dBUsername = $config->get('db.username');
$dBPassword = $config->get('db.password');
$dBName = $config->get('db.dbName');

$conn = mysqli_connect($serverName,$dBUsername,$dBPassword,$dBName);

if(!$conn){
  die("Connection failed: " . mysqli_connect_error());
}


// <?php
// //Get Heroku ClearDB connection information
// $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
// $cleardb_server = $cleardb_url["host"];
// $cleardb_username = $cleardb_url["user"];
// $cleardb_password = $cleardb_url["pass"];
// $cleardb_db = substr($cleardb_url["path"],1);
// $active_group = 'default';
// $query_builder = TRUE;
// // Connect to DB
// $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);