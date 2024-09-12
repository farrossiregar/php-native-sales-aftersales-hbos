<?php
	include "koneksi.php";
	
	$no = $_POST['data_ajax'];
	
	$query = mysql_unbuffered_query("SELECT * FROM pengecekan_penampilan_sales_detail where no = '$no'");
						
		$r = mysql_fetch_array($query);
				$id = $r['no'];
				$no_pengecekan = $r['no_pengecekan'];
				$no_pengecekan_mingguan = $r['no_pengecekan_mingguan'];
				$nama_penilaian = $r['jenis_penilaian'];
				$kode_sales = $r['kode_sales'];
				$jam = $r['jam'];
				$catatan_pengecekan = $r['catatan_pengecekan'];
				$keterangan_catatan_pengecekan = $r['keterangan_catatan_pengecekan'];
				$tanggal = $r['tanggal'];
				$hasil_penilaian = $r['hasil_penilaian'];
				$jenis_pengecekan = "1";
				
	//	$hasil = array('id'=>$id,'no_pengecekan'=>$no_pengecekan,'catatan_pengecekan'=>$catatan_pengecekan,'keterangan_catatan_pengecekan'=>$keterangan_catatan_pengecekan,'hasil_penilaian'=>$hasil_penilaian);	
		
		$hasil = array('id'=>$id,'no_pengecekan'=>$no_pengecekan,'no_pengecekan_mingguan'=>$no_pengecekan_mingguan,'catatan_pengecekan'=>$catatan_pengecekan,'hasil'=>$hasil_penilaian,'jenis'=>$jenis_pengecekan,
						'nama_penilaian'=>$nama_penilaian,'kode_sales'=>$kode_sales,'jam'=>$jam,'keterangan_catatan_pengecekan'=>$keterangan_catatan_pengecekan,'tanggal'=>$tanggal);	
		echo json_encode($hasil);
		
?>

