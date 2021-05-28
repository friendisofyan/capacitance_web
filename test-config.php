<?php

$configFilepath = $_SERVER['DOCUMENT_ROOT'].'/config.ini';

include_once('includes/parse-config.inc.php');

$config = new Config;

$config->load($configFilepath);

$serverName = $config->get('db.serverName');
$dBUsername = $config->get('db.username');
$dBPassword = $config->get('db.password');
$dBName = $config->get('db.dbName');

echo "$serverName <br> $dBUsername <br> $dBPassword <br> $dBName";
echo "<br><br>";
