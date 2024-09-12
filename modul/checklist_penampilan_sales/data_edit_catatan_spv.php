<?php
	include "koneksi.php";
	
	$no = $_POST['data_ajax'];
	
	$query = mysql_unbuffered_query("SELECT * FROM pengecekan_penampilan_sales where no_pengecekan_mingguan = '$no'");
						
		$r = mysql_fetch_array($query);
				$id = $r['no'];
				$no_pengecekan_mingguan = $r['no_pengecekan_mingguan'];
				$keterangan_spv = $r['keterangan_spv'];
				
		$hasil = array('id'=>$id,'no_pengecekan_mingguan'=>$no_pengecekan_mingguan,'keterangan_spv'=>$keterangan_spv);	
		echo json_encode($hasil);
		
	//	echo $id.','.$no_pengecekan.','.$catatan_pengecekan.','.$keterangan_catatan_pengecekan;
	
?>

