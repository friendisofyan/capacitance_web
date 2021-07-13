<?php
include_once('lib/phpqrcode/qrlib.php');
$username = array('hasan1', 'raymond2', 'steven3');
$name = array('Laurence Hasan', 'Raymond', 'Steven');

$uid='leo7';
$nama='Leonardo';

// foreach (array_combine($usename, $name) as $uid => $nama) {
  $QRcontent = '{ "username":"' .$uid. '", "name":"' .$nama. '" }';
  QRcode::png($QRcontent, 'pengujian/' .$uid. '.png', QR_ECLEVEL_M, 10);  
// }
