<?php

$configFilepath = '../config.ini';
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