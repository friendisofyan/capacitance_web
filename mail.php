<?php

//require_once('lib/PHPMailer-5.2-stable/PHPMailerAutoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'lib/PHPMailer/src/Exception.php';
require 'lib/PHPMailer/src/PHPMailer.php';
require 'lib/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
try {

  //Server settings
  //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                //Enable verbose debug output
  $mail->isSMTP();                                      //Send using SMTP
  $mail->Host       = 'smtp.gmail.com';               //Set the SMTP server to send through
  $mail->SMTPAuth   = true;                             //Enable SMTP authentication
  $mail->Username   = 'capacitancefyk@gmail.com';               //SMTP username
  $mail->Password   = 'Capacitance15';                         //SMTP password
  $mail->SMTPSecure = 'tls';   //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port       = '587';                              //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  //Recipients
  $mail->SetFrom('no-reply@capacitance.com', 'Admin');
  $mail->addAddress('christangelinayoung@gmail.com', 'CA');     //Add a recipient
  //$mail->addAddress('ellen@example.com');               //Name is optional
  //$mail->addReplyTo('info@example.com', 'Information');
  //$mail->addCC('cc@example.com');
  //$mail->addBCC('bcc@example.com');

  //Attachments
  $mail->AddEmbeddedImage('assets/qr/bubub.png', 'qrcode');

  //Content
  $mail->isHTML(true);  //Set email format to HTML
  $mail->Subject = 'Test email capacitance';
  $mail->Body    = 
  '<h2><b>Selamat anda sudah mendaftar di Perusahaan Capacitance!</b></h2>
  <h3>Berikut adalah QR Code yang akan anda anda pakai untuk mendaftar di depan device presensi dengan face recoqnition yang telah disediakan.</h3>
  <br>
  <center><img src="cid:qrcode" alt="QR Code" width=400px></center>
  ';
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->Send();
  echo 'Message has been sent';
} 
catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}