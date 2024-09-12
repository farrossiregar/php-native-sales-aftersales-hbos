<?php

require 'PHPMailer_5.2.4/class.phpmailer.php';


$alm_mail = 'abdullah_it@honda-bintaro.com';
$alm_mailcc = 'cco@honda-bintaro.com';
$alm_mailfrom = 'cco@honda-bintaro.com';
$subjek = 'Booking service Online';
$pass = 'honda0102';
$tgl = date('d-m-Y');



$mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'localhost';  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $alm_mailfrom;                            // SMTP username
$mail->Password = $pass;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = $alm_mailfrom;
$mail->FromName = 'Honda Bintaro';

$mail->AddAddress($alm_mail);               // Name is optional

$mail->AddCC($alm_mailcc);
//$mail->AddBCC('bcc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = $subjek;
//$mail->Body    = 'isi pesannya ini lho';
$mail->Body    = '<b>Booking service Online</b><br><br>'.'<b>Nama Customer</b> : '.$nama.'<br>'.'<b>Email : </b>'.$email.'<br><b>No Hp : </b>'
.$nohp.'<br><b>No Polisi : </b>'. $nopol.'<br><b>Model : </b>'.$model.'<br><b>Transmisi : </b>'.$transmisi.'</br><b> Tahun Kendaraan : </b>'.$tahun.'<br/><b>Kilometer : </b>'.$km.
'<br/><b>Tanggal Booking : </b>'.$tanggal.' <b> Jam : </b>'.$jam.'<br/><b>Keluhan : </b>'.$keluhan.'<br/></br>'.'<b>Tanggal kirim : </b>'.$tgl.'<b> Jam : </b>'.date('H:i:s');

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

//echo 'Message has been sent';
header('location:booking_service');
?>



<!-- Modal -->
<div class="modal fade" id="modal_booking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Information</h4>
      </div>
      <div class="modal-body">
        Terima Kasih telah melakukan booking
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>