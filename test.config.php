<?php

//config
$configFilepath = $_SERVER['DOCUMENT_ROOT'].'/config.ini';
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/parse-config.inc.php');
$config = new Config;
$config->load($configFilepath);
// var_dump($config);
var_dump ($config->get('hari_kerja'));

$new = array(
      "hari_kerja" => array(
        "hari" => "6"
      )
      );

$config->update($new, $configFilepath);

$config->load($configFilepath);
var_dump ($config->get('hari_kerja'));
