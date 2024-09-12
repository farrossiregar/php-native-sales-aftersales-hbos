<?php
	include "koneksi.php";
	
	$no = $_POST['data_ajax'];
	
	$query = mysql_unbuffered_query("SELECT * FROM pengecekan_showroom_detail_lain where no = '$no'");
						
		$r = mysql_fetch_array($query);
				$id = $r['no'];
				$no_pengecekan = $r['no_pengecekan'];
				$catatan_pengecekan = $r['catatan_pengecekan'];
				$keterangan_catatan_pengecekan = $r['keterangan_catatan_pengecekan'];
				$hasil_penilaian = $r['hasil'];
				$jenis_pengecekan = "2";
				
		$hasil = array('id'=>$id,'no_pengecekan'=>$no_pengecekan,'catatan_pengecekan'=>$catatan_pengecekan,'keterangan_catatan_pengecekan'=>$keterangan_catatan_pengecekan,'hasil'=>$hasil_penilaian,'jenis'=>$jenis_pengecekan);	
		echo json_encode($hasil);
	
?>

