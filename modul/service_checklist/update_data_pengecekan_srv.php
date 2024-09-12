<?php
	include "../../config/koneksi_service.php";
//	include "config/koneksi_service.php";
	date_default_timezone_set('Asia/Jakarta');
	
//	if(count($_POST)) {
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
		$jenis_penilaian = $_POST['jenis'];
		if($jenis_penilaian == '1'){	
			if($leveluser == 'HRD' or $leveluser == 'admin'){
				mysql_query("UPDATE pengecekan_service_detail SET keterangan_catatan_pengecekan = '$catatan_keterangan' where no = '$no'",$koneksi_service);
				mysql_query("update notif_pengecekan_service set notif_admin = 'Y', notif_cco = 'Y', read_cco = 'N', read_hrd = 'Y'  where no_pengecekan = '$no_pengecekan' and kategori_penilaian = '$nama_penilaian' and jam = '$jam'",$koneksi_service);	
				header("location:../../../media_showroom.php?module=service_checklist_service&act=lihat&id=$no_pengecekan_mingguan"); 
			}elseif($leveluser == 'CCO' or $leveluser == 'admin'){
				$query = mysql_unbuffered_query("UPDATE pengecekan_service_detail SET catatan_pengecekan = '$catatan_keterangan_cco', hasil = '$hasil_penilaian' where no = '$no'",$koneksi_service);
				header("location:../../../media_showroom.php?module=service_checklist_service&act=lihat&id=$no_pengecekan_mingguan"); 
			}else{
				
			}
		}else{
			if($leveluser == 'HRD' or $leveluser == 'admin'){
				$query = mysql_unbuffered_query("UPDATE pengecekan_service_detail SET keterangan_catatan_pengecekan = '$catatan_keterangan' where no = '$no'",$koneksi_service);
				mysql_query("update notif_pengecekan_service set notif_admin = 'Y', notif_cco = 'Y', read_cco = 'N', read_hrd = 'Y' where no_pengecekan = '$no_pengecekan' and nama_penilaian = '$nama_penilaian' and jam = '$jam'",$koneksi_service);	
				header("location:../../media_showroom.php?module=service_checklist_service&act=lihat&id=$no_pengecekan_mingguan"); 
			}elseif($leveluser == 'CCO' or $leveluser == 'admin'){
				$query = mysql_unbuffered_query("UPDATE pengecekan_service_detaill2 SET catatan_pengecekan = '$catatan_keterangan_cco' where no = '$no'",$koneksi_service);
				header("location:../../../media_showroom.php?module=service_checklist_service&act=lihat&id=$no_pengecekan_mingguan"); 
			}else{
				
			}
		}
//	}
?>