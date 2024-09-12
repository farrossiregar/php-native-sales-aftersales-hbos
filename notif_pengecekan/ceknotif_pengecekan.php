<?php
if(count($_POST)){
session_start();
include "../config/koneksi.php";
	$leveluser = $_POST['leveluser'];
	if($leveluser == 'admin'){			
		$notif = "n.notif_admin = 'Y'";	

	}else{
		$notif = "n.notif_admin = 'Y'";	
	}
	
	$pesan = mysql_query("SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.keterangan_catatan_pengecekan, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kategori_penilaian, psd.tanggal, psd.no_pengecekan FROM pengecekan_showroom_detail psd
								left join notif_pengecekan n on psd.no_pengecekan = n.no_pengecekan
								where $notif and psd.hasil = 'N' and psd.catatan_pengecekan != '' ");
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
				$link = "media_showroom.php?module=checklist_showroom&act=lihat&id=$no_pengecekan_mingguan&no=$no";
			}else{
				$link = "media_showroom.php?module=checklist_showroom&act=lihat&id=$no_pengecekan_mingguan";
			}
			if($row > 0){
				echo $no_pengecekan.','.$tanggal.','.$jam.','.$kategori_pengecekan.','.$catatan_pengecekan.','.$link.','.$keterangan_catatan_pengecekan;
			}else{
				echo "";
			}
		}
}
?>