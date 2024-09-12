<?php
//if (count($_POST)){
	include "../../../../config/koneksi.php";
	date_default_timezone_set('Asia/Jakarta');
		$today=date("ym");
		$query = "SELECT max(no_peminjaman) as last FROM peminjaman_test_drive WHERE no_peminjaman LIKE 'TD$today%'";
		$hasil = mysql_query($query);
		$data  = mysql_fetch_array($hasil);
		$lastNoTransaksi = $data['last'];
		$lastNoUrut = substr($lastNoTransaksi, 6, 3);
		$nextNoUrut = $lastNoUrut + 1;
		$nextNoTransaksi = "TD".$today.sprintf('%03s', $nextNoUrut);				

		echo $nextNoTransaksi;
//}
?>
