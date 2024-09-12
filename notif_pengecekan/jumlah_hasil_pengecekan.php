<?php
session_start();
include "../config/koneksi_service.php";
	$leveluser = $_POST['leveluser'];
	if($leveluser == 'admin'){
		
		$approve_showroom = mysql_query("SELECT * from pengecekan_showroom where sign_atasan1 = ''",$koneksi_showroom);
		$jumlah_approve_showroom = mysql_num_rows($approve_showroom);
		
		$approve_penampilan_sales = mysql_query("SELECT * from pengecekan_penampilan_sales where sign_atasan1 = ''",$koneksi_showroom);
		$jumlah_approve_penampilan_sales = mysql_num_rows($approve_penampilan_sales);
									
		$approve_service = mysql_query("SELECT * from pengecekan_service where sign_atasan1 = ''",$koneksi_service);	
		$jumlah_approve_service = mysql_num_rows($approve_service);
		
		$approve_penampilan_sa = mysql_query("SELECT * from pengecekan_penampilan_sa where sign_atasan1 = ''",$koneksi_service);
		$jumlah_approve_penampilan_sa = mysql_num_rows($approve_penampilan_sa);
		
		echo $total_pesan = $jumlah_approve_showroom + $jumlah_approve_service + $jumlah_approve_penampilan_sales + $jumlah_approve_penampilan_sa;
		
	}elseif($leveluser == 'MNGR' or $leveluser == 'mngr_bengkel' or $leveluser == 'DRKSI' or $leveluser == 'supervisor'){
		
		if($leveluser == 'MNGR'){
			$approve_showroom = mysql_query("SELECT * from pengecekan_showroom where sign_atasan2 = ''",$koneksi_showroom);
			$jumlah_approve_showroom = mysql_num_rows($approve_showroom);
			
			$approve_penampilan_sales = mysql_query("SELECT * from pengecekan_penampilan_sales where sign_atasan2 = ''",$koneksi_showroom);
			$jumlah_approve_penampilan_sales = mysql_num_rows($approve_penampilan_sales);
			
			echo $total_pesan = $jumlah_approve_showroom + $jumlah_approve_penampilan_sales;
		}else if($leveluser == 'mngr_bengkel'){			
			$approve_service = mysql_query("SELECT * from pengecekan_service where sign_atasan2 = ''",$koneksi_service);
			$jumlah_approve_service = mysql_num_rows($approve_service);
			
			$approve_penampilan_sa = mysql_query("SELECT * from pengecekan_penampilan_sa where sign_atasan2 = ''",$koneksi_service);
			$jumlah_approve_penampilan_sa = mysql_num_rows($approve_penampilan_sa);
			
			echo $total_pesan = $jumlah_approve_service + $jumlah_approve_penampilan_sa;
		}else if($leveluser == 'supervisor'){			
			$approve_penampilan_sales = mysql_query("SELECT * from pengecekan_penampilan_sales where sign_atasan3 = 'Y'",$koneksi_showroom);
			$jumlah_approve_penampilan_sales = mysql_num_rows($approve_penampilan_sales);
			
			echo $total_pesan = $jumlah_approve_penampilan_sales;
		}else{
			$approve_showroom = mysql_query("SELECT * from pengecekan_showroom where sign_atasan2 = 'Y' and sign_atasan1 = ''",$koneksi_showroom);
			$jumlah_approve_showroom = mysql_num_rows($approve_showroom);
			
			$approve_penampilan_sales = mysql_query("SELECT * from pengecekan_penampilan_sales where sign_atasan2 = 'Y' and sign_atasan1 = ''",$koneksi_showroom);
			$jumlah_approve_penampilan_sales = mysql_num_rows($approve_penampilan_sales);
			
			$approve_service = mysql_query("SELECT * from pengecekan_service where sign_atasan2 = 'Y' and sign_atasan1 = ''",$koneksi_service);
			$jumlah_approve_service = mysql_num_rows($approve_service);
			
			$approve_penampilan_sa = mysql_query("SELECT * from pengecekan_penampilan_sa where sign_atasan2 = 'Y' and sign_atasan1 = ''",$koneksi_service);
			$jumlah_approve_penampilan_sa = mysql_num_rows($approve_penampilan_sa);
			
			echo $total_pesan = $jumlah_approve_showroom + $jumlah_approve_penampilan_sales +  $jumlah_approve_service + $jumlah_approve_penampilan_sa;
		}
		
	}else{
		$total_pesan = 0;
	}

?>