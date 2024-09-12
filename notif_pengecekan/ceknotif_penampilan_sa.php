<?php
if(count($_POST)){
session_start();
include "../config/koneksi_service.php";
	$leveluser = $_POST['leveluser'];
	if($leveluser == 'admin'){		
		$notif = "and n.notif_admin = 'Y' ";
	}else{
		$notif = "and n.notif_admin = 's' ";
	}
	
	$pesan = mysql_query("SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kode_sa, psd.tanggal, psd.no_pengecekan FROM pengecekan_penampilan_sa_detail psd 
										left join notif_penampilan_sa n on psd.no_pengecekan = n.no_pengecekan where psd.jam = n.jam and psd.kode_sa = n.kode_sa_bp and psd.hasil_penilaian = 'N' and psd.catatan_pengecekan != '' $notif
										group by kode_sa, catatan_pengecekan, no_pengecekan, jenis_penilaian, jam order by tanggal desc, jam desc");

	
		while($sql = mysql_fetch_array($pesan)){
			$row = mysql_num_rows($pesan);
			$no = $sql['no'];
			$no_pengecekan = $sql['no_pengecekan'];
			$no_pengecekan_mingguan = $sql['no_pengecekan_mingguan'];
			$tanggal = substr($sql['tanggal'], 8, 2).'-'.substr($sql['tanggal'], 5, 2).'-'.substr($sql['tanggal'], 0, 4);
			$jam = $sql['jam'];
			$kode_sales = $sql['kode_sa'];
			$catatan_pengecekan = $sql['catatan_pengecekan'];
			$keterangan_catatan_pengecekan = $sql['keterangan_catatan_pengecekan'];
		
			if($leveluser == 'admin' or $leveluser == 'HRD'){
				$link = "media_showroom.php?module=service_checklist_penampilan_sa&act=lihat&id=$no_pengecekan_mingguan&no=$no";
			}else{
				$link = "media_showroom.php?module=service_checklist_penampilan_sa&act=lihat&id=$no_pengecekan_mingguan";
			}
			if($row > 0){
				echo $no_pengecekan.','.$tanggal.','.$jam.','.$kode_sales.','.$catatan_pengecekan.','.$link.','.$keterangan_catatan_pengecekan;
			}else{
				echo "";
			}
		}
}
?>