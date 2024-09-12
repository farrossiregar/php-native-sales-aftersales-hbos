<?php
///	if(count($_POST)){
		include "../../../config/koneksi_service.php";
		date_default_timezone_set('Asia/Jakarta');
			$today=date("ym");
			$query = "SELECT max(no_pemeriksaan) as last FROM pemeriksaan_kendaraan WHERE no_pemeriksaan LIKE 'NP$today%'";
		//	$query = "SELECT max(no_pemeriksaan) as last FROM pemeriksaan_kendaraan";
			$hasil = mysql_query($query, $koneksi_service);
			$data  = mysql_fetch_array($hasil);
			$lastNoTransaksi = $data['last'];
			$lastNoUrut = substr($lastNoTransaksi, 6, 4);
			$nextNoUrut = $lastNoUrut + 1;
			$nextNoTransaksi = "NP".$today.sprintf('%04s', $nextNoUrut);				

			echo $nextNoTransaksi;
//	}
?>
