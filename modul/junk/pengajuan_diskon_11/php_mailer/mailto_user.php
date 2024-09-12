<?php
require 'PHPMailer_5.2.4/class.phpmailer.php';



$alm_mail = 'abdullah_it@honda-bintaro.com';
$subjek = 'tes subjek email';
$pesan  = 'tes isi pesan email';
$pass = $_POST[password];

$mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'localhost';  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'cco@honda-bintaro.com';                            // SMTP username
$mail->Password = 'gadingprimaperkasa';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'cco@honda-bintaro.com';
$mail->FromName = 'honda-bintaro.com';

$mail->AddAddress($alm_mail);               // Name is optional

$mail->AddCC('abdul_ajah22@yahoo.com');
//$mail->AddBCC('bcc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = $subjek;
$mail->Body    = $pesan;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';
?>