<?php
	include "../../config/koneksi_service.php";
	date_default_timezone_set('Asia/Jakarta');
	
	if(count($_POST)) {
		$no = $_POST['id'];
		$no_pengecekan = $_POST['no_pengecekan'];
		$no_pengecekan_mingguan = $_POST['no_pengecekan_mingguan'];
		$kategori_penilaian = $_POST['kategori_penilaian'];
		$nama_penilaian = $_POST['nama_penilaian'];
		$leveluser = $_POST['leveluser'];
		$jam = $_POST['jam_edit'];
		$catatan_keterangan = $_POST['catatan_keterangan'];
		$catatan_keterangan_cco = $_POST['keterangan'];
		$hasil_penilaian = $_POST['hasil'];
		if($leveluser == 'mngr_bengkel' or $leveluser == 'admin'){
			mysql_query("UPDATE pengecekan_penampilan_sa_detail SET keterangan_catatan_pengecekan = '$catatan_keterangan' where no = '$no'",$koneksi_service);
			mysql_query("update notif_penampilan_sa set read_admin = 'Y', notif_cco = 'Y', read_cco = 'N', read_spv = 'Y'  where no_pengecekan = '$no_pengecekan' and kode_sa_bp = '$kategori_penilaian' and jam = '$jam'",$koneksi_service);	
			header("location:../../../media_showroom.php?module=service_checklist_penampilan_sa&act=lihat&id=$no_pengecekan_mingguan"); 
		}elseif($leveluser == 'CCO' or $leveluser == 'admin'){
			mysql_query("UPDATE pengecekan_penampilan_sa_detail SET catatan_pengecekan = '$catatan_keterangan_cco', hasil = '$hasil_penilaian' where no = '$no'",$koneksi_service);
			mysql_query("update notif_penampilan_sa set read_admin = 'N', notif_cco = 'N', read_cco = 'Y', read_spv = 'N'  where no_pengecekan = '$no_pengecekan' and kode_sa_bp = '$kategori_penilaian' and jam = '$jam'",$koneksi_service);	
			header("location:../../../media_showroom.php?module=service_checklist_penampilan_sa&act=lihat&id=$no_pengecekan_mingguan"); 
		}else{
			
		}
	}

?>