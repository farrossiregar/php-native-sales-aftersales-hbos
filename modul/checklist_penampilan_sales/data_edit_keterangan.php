<?php
	include "koneksi.php";
	
	$no = $_POST['data_ajax'];
	
	$query = mysql_unbuffered_query("SELECT * FROM pengecekan_penampilan_sales_detail where no = '$no'");
						
		$r = mysql_fetch_array($query);
				$id = $r['no'];
				$no_pengecekan = $r['no_pengecekan'];
				$catatan_pengecekan = $r['catatan_pengecekan'];
				$keterangan_catatan_pengecekan = $r['keterangan_catatan_pengecekan'];
		echo $id.','.$no_pengecekan.','.$catatan_pengecekan.','.$keterangan_catatan_pengecekan;
	
?>

