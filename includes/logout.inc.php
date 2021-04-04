<?php
session_start();

//cek apakah session terdaftar
if(isset($_SESSION["loggedin"])){
  //session terdaftar, saatnya logout
  session_unset();
  session_destroy();
  header("location: ../login.php");
  exit();
}
else{
  //variabel session salah, user tidak seharusnya ada dihalaman ini. Kembalikan ke login
  header("location: ../login.php");
  exit();
}