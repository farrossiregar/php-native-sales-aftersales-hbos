<?php
	include "../../config/koneksi_service.php";
	
	$no = $_POST['data_ajax'];
	
	$query = mysql_query("SELECT * FROM pengecekan_service_detail where no = '$no'");
						
		$r = mysql_fetch_array($query);
				$id = $r['no'];
				$no_pengecekan = $r['no_pengecekan'];
				$no_pengecekan_mingguan = $r['no_pengecekan_mingguan'];
				$nama_penilaian = $r['nama_penilaian'];
				$kategori_penilaian = $r['kategori_penilaian'];
				$jam = $r['jam'];
				$catatan_pengecekan = $r['catatan_pengecekan'];
				$keterangan_catatan_pengecekan = $r['keterangan_catatan_pengecekan'];
				$hasil_pengecekan = $r['hasil'];
				$jenis_pengecekan = "1";
				
		$hasil = array('id'=>$id,'no_pengecekan'=>$no_pengecekan,'no_pengecekan_mingguan'=>$no_pengecekan_mingguan,'catatan_pengecekan'=>$catatan_pengecekan,'hasil_penilaian'=>$hasil_pengecekan,'keterangan_catatan_pengecekan'=>$keterangan_catatan_pengecekan,'jenis'=>$jenis_pengecekan,'nama_penilaian'=>$nama_penilaian,'kategori_penilaian'=>$kategori_penilaian,'jam'=>$jam);	
		
				
	//	$hasil = array('id'=>$id,'no_pengecekan'=>$no_pengecekan,'no_pengecekan_mingguan'=>$no_pengecekan_mingguan,'catatan_pengecekan'=>$catatan_pengecekan,'hasil_penilaian'=>$hasil_penilaian,'jenis'=>$jenis_pengecekan,'nama_penilaian'=>$nama_penilaian,'kategori_penilaian'=>$kategori_penilaian,'jam'=>$jam,'keterangan_catatan_pengecekan'=>$keterangan_catatan_pengecekan);	
		
		echo json_encode($hasil);
	
//	echo $id.','.$no_pengecekan.','.$catatan_pengecekan.','.$keterangan_catatan_pengecekan;	
		
	
?>


