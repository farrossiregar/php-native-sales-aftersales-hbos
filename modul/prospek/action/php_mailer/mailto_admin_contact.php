<?php

require 'PHPMailer_5.2.4/class.phpmailer.php';

date_default_timezone_set('Asia/Jakarta');
$alm_mail = 'abdullah_it@honda-bintaro.com'; 
$alm_mailcc = 'abdul.240515@gmail.com';
$alm_mailfrom = 'honda.bintaro102@gmail.com';
$subjek = 'Pengajuan Diskon';
$pass = 'gadingprimaperkasa0102';
$tgl = date('d-m-Y');
$wkt = date('H:i:s');


$mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $alm_mailfrom;                            // SMTP username
$mail->Password = $pass;                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
$mail->Port       = 465;

$mail->From = $alm_mailfrom;
$mail->FromName = 'Honda Bintaro';

$mail->AddAddress($alm_mailfrom);               // Name is optional

$mail->AddCC($alm_mailcc);
//$mail->AddBCC('bcc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = $subjek;
//$mail->Body    = 'isi pesannya ini lho';
$mail->Body    = 'tes kirim pake gmail nih ah gw tambahin dikit';

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

//echo 'Message has been sent';

?>