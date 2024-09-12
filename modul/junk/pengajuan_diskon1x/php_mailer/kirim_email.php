<?php

require 'PHPMailer_5.2.4/class.phpmailer.php';

date_default_timezone_set('Asia/Jakarta');

$judul = 'Pengajuan Diskon';
$subjek = 'Informasi Pengajuan Diskon';

if ($pengajuan_ulang == "Y"){
	$subjek = 'Informasi Pengajuan Ulang Diskon';
}
if ($ajukan_lagi == "Y"){
	if ($statusaprrov == "Sedang Diajukan Lagi"){
		$subjek = 'Menunggu Persetujuan Direktur';
	}else {
		$subjek = 'Informasi Persetujuan Diskon';
	}
	
}
if ($approve == "Y"){
	$subjek = 'Informasi Persetujuan Diskon';
}

$email_manager = 'burli_sales@honda-bintaro.com';
$email_admin = 'salesadm@honda-bintaro.com';
$email_direktur = 'tinkoksin@honda-bintaro.com';

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP


try {
  //$mail->Host       = "mail.yourdomain.com"; // SMTP server
  //$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->Host       = "satus.idwebhost.com"; // sets the SMTP server
  //$mail->SMTPSecure = 'ssl'; 
  $mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
  $mail->Port       = 465;
  //$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
  $mail->Username   = "cco@honda-bintaro.com"; // SMTP account username
  $mail->Password   = "hondabintaro0102";        // SMTP account password
  $mail->AddAddress('it@honda-bintaro.com', 'IT Team');
  $mail->AddCC($email_manager, 'Burli');
  
  if ($pengajuan == "Y" ){
	  $mail->AddCC($email_pemohon);
  }
  if ($pengajuan_ulang == "Y" and $no_spk !="" ){
	  $mail->AddCC($email_admin);
	  $mail->AddCC('ellen_salesadm@honda-bintaro.com');
  }
  
  if ($ajukan_lagi == "Y" and $statusaprrov == "Sedang Diajukan Lagi"){
	  $mail->AddCC($email_direktur, 'Bpk Tinkoksin');
  }
  
  
  $mail->SetFrom('no-reply@honda-bintaro.com', $judul);
  //$mail->AddReplyTo('cco@honda-bintaro.com', 'First Last');
  $mail->Subject = $subjek;
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->Body    = $message;
 
 //$mail->MsgHTML(file_get_contents('php_mailer/isi_email.html'));
  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  $mail->Send();
  echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}

?>