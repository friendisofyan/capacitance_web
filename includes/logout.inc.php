<?php
session_start();

//cek apakah session terdaftar
if(isset($_SESSION["useruid"])&& isset($_SESSION["userjabatan"])){
  //session terdaftar, saatnya logout
  session_unset();
  session_destroy();
  header("location: loggedin.inc.php");
  exit();
}
else{
  //variabel session salah, user tidak seharusnya ada dihalaman ini. Kembalikan ke login
  header("location: loggedin.inc.php");
  exit();
}