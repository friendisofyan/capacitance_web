<?php

//require_once('lib/PHPMailer-5.2-stable/PHPMailerAutoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'lib/PHPMailer/src/Exception.php';
require 'lib/PHPMailer/src/PHPMailer.php';
require 'lib/PHPMailer/src/SMTP.php';
require 'lib/PHPMailer/src/OAuth.php';

function sendEmail($name, $username, $email){
  $mail = new PHPMailer(true);
  $subject = 'Pendaftaran Presensi Less-Contact';
  $body = '
          <h1><center>Halo '.$name.'!</center></h1>
          <p>
          <h2><b>Selamat anda berhasil mendaftar di Sistem Presensi <i>Less-Contact</i></b></h2>
          <h3><b><i>oleh Tim Capacitance</i></b></h3>
          </p>
          <br><br>
          <h3>Berikut adalah QR Code yang akan anda anda pakai untuk mendaftar di depan device presensi dengan face recoqnition yang telah disediakan.</h3>
          <center><img src="cid:qrcode" alt="QR Code" width=400px></center>
          <br>
          <p><font color=red>
          <h4>QR Code ini hanya akan berlaku selama 7x24 jam, mohon segera mendaftarkan diri ke device yang telah disediakan oleh perusahaan.</h4>
          </font></p>
          ';
  try {

    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                //Enable verbose debug output
    $mail->isSMTP();                                      //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';               //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                             //Enable SMTP authentication
    $mail->Username   = 'capacitancefyk@gmail.com';               //SMTP username
    $mail->Password   = 'Capacitance-15';                         //SMTP password
    $mail->SMTPSecure = 'tls';   //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = '587';                              //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->SetFrom('no-reply@capacitance.com', 'Admin');
    $mail->addAddress($email, $name);     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional

    //Attachments
    $mail->addAttachment('../assets/qr/'.$username.'.png', 'qrcode_'.$username.'.png');    //Optional name
    $mail->AddEmbeddedImage('../assets/qr/'.$username.'.png', 'qrcode');

    //Content
    $mail->isHTML(true);  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
  
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->Send();
    echo 'Message has been sent';
  } 
  catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
