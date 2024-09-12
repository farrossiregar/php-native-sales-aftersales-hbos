<?php
if(count($_POST)){
session_start();
include "../config/koneksi_service.php";
	$leveluser = $_POST['leveluser'];
	if($leveluser == 'admin'){	
		$notif = "and n.notif_admin = 'Y' ";	
	}else{
		$notif = "and n.notif_hrd = 'Y' ";
	}
	
	$pesan = mysql_query("SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kategori_penilaian, psd.tanggal, psd.no_pengecekan FROM pengecekan_service_detail psd
								left join notif_pengecekan_service n on psd.no_pengecekan = n.no_pengecekan
								where psd.jam = n.jam and psd.kategori_penilaian = n.kategori_penilaian and psd.jam = n.jam and psd.kategori_penilaian = n.kategori_penilaian and psd.hasil = 'N' and psd.catatan_pengecekan != '' $notif", $koneksi_service);
	
		while($sql = mysql_fetch_array($pesan)){
			$row = mysql_num_rows($pesan);
			$no = $sql['no'];
			$no_pengecekan = $sql['no_pengecekan'];
			$no_pengecekan_mingguan = $sql['no_pengecekan_mingguan'];
			$tanggal = substr($sql['tanggal'], 8, 2).'-'.substr($sql['tanggal'], 5, 2).'-'.substr($sql['tanggal'], 0, 4);
			$jam = $sql['jam'];
			$kategori_pengecekan = $sql['kategori_penilaian'];
			$catatan_pengecekan = $sql['catatan_pengecekan'];
			$keterangan_catatan_pengecekan = $sql['keterangan_catatan_pengecekan'];
		
			
			if($leveluser == 'admin' or $leveluser == 'HRD'){
				$link = "media_showroom.php?module=service_checklist_service&act=lihat&id=$no_pengecekan_mingguan&no=$no";
			}else{
				$link = "media_showroom.php?module=service_checklist_service&act=lihat&id=$no_pengecekan_mingguan";
			}
			if($row > 0){
				echo $no_pengecekan.','.$tanggal.','.$jam.','.$kategori_pengecekan.','.$catatan_pengecekan.','.$link.','.$keterangan_catatan_pengecekan;
			}else{
				echo "";
			}
		}
}
?>