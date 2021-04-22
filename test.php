<?php
include_once('lib/phpqrcode/qrlib.php');
$username = "admin";
$name = "admin";

$QRcontent = '{ "username":"' .$username. '", "name":"' .$name. '" }';
QRcode::png($QRcontent, 'assets/qr/' .$username. '.png', QR_ECLEVEL_M, 10);