<?php
if(count($_POST)){
session_start();
include "../config/koneksi.php";
	$leveluser = $_POST['leveluser'];
	if($leveluser == 'admin'){	
		$notif = "and n.notif_admin = 'Y'";
	}elseif(($leveluser == 'supervisor' and $_SESSION['username']=='sudi123') or ($leveluser == 'supervisor' and $_SESSION['username']=='supervisor')){
		$notif = "and n.notif_spv = 'Y'";
	}else{
		$notif = "and n.notif_spv = 'A'";
	}
	
	$pesan = mysql_query("SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kode_sales, psd.tanggal, psd.no_pengecekan FROM pengecekan_penampilan_sales_detail psd 
										left join notif_penampilan_sales n on psd.no_pengecekan = n.no_pengecekan 
										where psd.jam = n.jam and psd.kode_sales = n.kode_sales and psd.hasil_penilaian = 'N' and psd.catatan_pengecekan != '' $notif group by no_pengecekan, kode_sales, jam order by tanggal desc, jam asc  ");
	
		while($sql = mysql_fetch_array($pesan)){
			$row = mysql_num_rows($pesan);
			$no = $sql['no'];
			$no_pengecekan = $sql['no_pengecekan'];
			$no_pengecekan_mingguan = $sql['no_pengecekan_mingguan'];
			$tanggal = substr($sql['tanggal'], 8, 2).'-'.substr($sql['tanggal'], 5, 2).'-'.substr($sql['tanggal'], 0, 4);
			$jam = $sql['jam'];
			$kode_sales = $sql['kode_sales'];
			$catatan_pengecekan = $sql['catatan_pengecekan'];
			$keterangan_catatan_pengecekan = $sql['keterangan_catatan_pengecekan'];
		
			if($leveluser == 'admin' or $leveluser == 'HRD'){
				$link = "media_showroom.php?module=checklist_penampilan_sales&act=lihat&id=$no_pengecekan_mingguan&no=$no";
			}else{
				$link = "media_showroom.php?module=checklist_penampilan_sales&act=lihat&id=$no_pengecekan_mingguan";
			}
			if($row > 0){
				echo $no_pengecekan.','.$tanggal.','.$jam.','.$kode_sales.','.$catatan_pengecekan.','.$link.','.$keterangan_catatan_pengecekan;
			}else{
				echo "";
			}
		}
}
?>