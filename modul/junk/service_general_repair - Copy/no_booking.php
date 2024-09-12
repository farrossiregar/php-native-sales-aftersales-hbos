<?php
	include "koneksi.php";
	date_default_timezone_set('Asia/Jakarta');
		$today=date("ym");
		$query = "SELECT max(no_booking) as last FROM booking_service WHERE no_booking LIKE 'BS$today%'";
		$hasil = mysql_query($query);
		$data  = mysql_fetch_array($hasil);
		$lastNoTransaksi = $data['last'];
		$lastNoUrut = substr($lastNoTransaksi, 6, 4);
		$nextNoUrut = $lastNoUrut + 1;
		$nextNoTransaksi = "BS".$today.sprintf('%04s', $nextNoUrut);		

		echo $nextNoTransaksi;

?>
