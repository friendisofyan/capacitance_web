<?php

$configFilepath = 'config.ini';

include_once('includes/parse-config.inc.php');

$config = new Config;

$config->load($configFilepath);

echo $config->get('db.dbName');
echo $config->get('db.dbPaddword');
echo $config->get('db.serverName');
