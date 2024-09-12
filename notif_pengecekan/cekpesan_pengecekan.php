<?php
session_start();
include "../config/koneksi_service.php";
	$leveluser = $_POST['leveluser'];
	if($leveluser == 'admin'){
		$pesan_showroom = mysql_query("SELECT psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.kategori_penilaian, psd.tanggal, psd.no_pengecekan FROM pengecekan_showroom_detail psd
									left join notif_pengecekan n on psd.no_pengecekan = n.no_pengecekan
									where n.read_admin = 'N' and psd.hasil = 'N' and psd.catatan_pengecekan != '' ",$koneksi_showroom);
								
		$jumlah_data_showroom = mysql_num_rows($pesan_showroom);
		
		$pesan_service = mysql_query("SELECT psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kategori_penilaian, psd.tanggal, psd.no_pengecekan FROM pengecekan_service_detail psd
										left join notif_pengecekan_service n on psd.no_pengecekan = n.no_pengecekan
										where psd.jam = n.jam and psd.kategori_penilaian = n.kategori_penilaian and n.read_admin = 'N' and psd.hasil = 'N' and psd.catatan_pengecekan != ''",$koneksi_service);
								
		$jumlah_data_service = mysql_num_rows($pesan_service);
		
		$pesan_penampilan_sales = mysql_query("SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kode_sales, psd.tanggal, psd.no_pengecekan FROM pengecekan_penampilan_sales_detail psd 
										left join notif_penampilan_sales n on psd.no_pengecekan = n.no_pengecekan 
										where psd.jam = n.jam and psd.kode_sales = n.kode_sales and n.read_admin = 'N' and psd.hasil_penilaian = 'N' and psd.catatan_pengecekan != '' group by no_pengecekan, kode_sales, jam order by tanggal desc, jam asc ",$koneksi_showroom);
								
		$jumlah_pesan_penampilan_sales = mysql_num_rows($pesan_penampilan_sales);
		
	/*	$pesan_penampilan_sa = mysql_query("SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kode_sa, psd.tanggal, psd.no_pengecekan FROM pengecekan_penampilan_sa_detail psd 
										left join notif_penampilan_sa n on psd.no_pengecekan = n.no_pengecekan 
										where psd.jam = n.jam and psd.kode_sa = n.kode_sa_bp and n.read_admin = 'N' and psd.hasil_penilaian = 'N' and psd.catatan_pengecekan != '' group by no_pengecekan, kode_sa, jam order by tanggal desc, jam asc ",$koneksi_service);
								
		$jumlah_pesan_penampilan_sa = mysql_num_rows($pesan_penampilan_sa);		*/
		
		echo $total_pesan = $jumlah_data_showroom + $jumlah_data_service + $jumlah_pesan_penampilan_sales ;
		
	}elseif($leveluser == 'HRD'){
		$pesan_showroom = mysql_query("SELECT psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.kategori_penilaian, psd.tanggal, psd.no_pengecekan FROM pengecekan_showroom_detail psd
									left join notif_pengecekan n on psd.no_pengecekan = n.no_pengecekan
									where n.read_hrd = 'N' and psd.hasil = 'N' and psd.catatan_pengecekan != '' ",$koneksi_showroom);
								
		$jumlah_data_showroom = mysql_num_rows($pesan_showroom);
		
		$pesan_service = mysql_query("SELECT psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kategori_penilaian, psd.tanggal, psd.no_pengecekan FROM pengecekan_service_detail psd
										left join notif_pengecekan_service n on psd.no_pengecekan = n.no_pengecekan
										where psd.jam = n.jam and psd.kategori_penilaian = n.kategori_penilaian and n.read_hrd = 'N' and psd.hasil = 'N' and psd.catatan_pengecekan != ''",$koneksi_service);
								
		$jumlah_data_service = mysql_num_rows($pesan_service);
		
		echo $total_pesan = $jumlah_data_service + $jumlah_data_showroom;
		
	}elseif($leveluser == 'supervisor'){
		$pesan_penampilan_sales = mysql_query("SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kode_sales, psd.tanggal, psd.no_pengecekan FROM pengecekan_penampilan_sales_detail psd 
										left join notif_penampilan_sales n on psd.no_pengecekan = n.no_pengecekan 
										where psd.jam = n.jam and psd.kode_sales = n.kode_sales and n.read_spv = 'N' and psd.hasil_penilaian = 'N' and psd.catatan_pengecekan != '' group by no_pengecekan, kode_sales, jam order by tanggal desc, jam asc ",$koneksi_showroom);
								
		$jumlah_pesan_penampilan_sales = mysql_num_rows($pesan_penampilan_sales);
		
		echo $total_pesan = $jumlah_pesan_penampilan_sales;
		
	}else{
		$total_pesan = 0;
	}

?>