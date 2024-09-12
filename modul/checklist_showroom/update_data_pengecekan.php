<?php
	include "../../config/koneksi.php";
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
		$jenis_penilaian = $_POST['jenis_pengecekan'];
		//	$query = mysql_unbuffered_query("UPDATE pengecekan_showroom_detail SET keterangan_catatan_pengecekan = '$catatan_keterangan' where no = '$no'");
		if($jenis_penilaian == '1'){	
			if($leveluser == 'HRD' or $leveluser == 'admin' or $leveluser == 'MNGR' or $leveluser == 'DRKSI'){
				mysql_query("UPDATE pengecekan_showroom_detail SET keterangan_catatan_pengecekan = '$catatan_keterangan' where no = '$no'");
				mysql_query("update notif_pengecekan set read_admin = 'Y', read_hrd = 'Y', notif_cco = 'Y', read_cco = 'N' where no_pengecekan = '$no_pengecekan' and nama_penilaian = '$nama_penilaian' and jam = '$jam'");	
				header("location:../../../media_showroom.php?module=checklist_showroom&act=lihat&id=$no_pengecekan_mingguan"); 
			}elseif($leveluser == 'CCO' or $leveluser == 'admin'){
				$query = mysql_unbuffered_query("UPDATE pengecekan_showroom_detail SET catatan_pengecekan = '$catatan_keterangan_cco', hasil = '$hasil_penilaian' where no = '$no'");
				mysql_query("update notif_pengecekan set read_admin = 'N', read_hrd = 'N', notif_hrd = 'N', notif_cco = 'Y', read_cco = 'N' where no_pengecekan = '$no_pengecekan' and nama_penilaian = '$nama_penilaian' and jam = '$jam'");	
				header("location:../../../media_showroom.php?module=checklist_showroom&act=lihat&id=$no_pengecekan_mingguan"); 
			}else{
				
			}
		}else{
			if($leveluser == 'HRD' or $leveluser == 'admin' or $leveluser == 'MNGR' or $leveluser == 'DRKSI'){
				$query = mysql_unbuffered_query("UPDATE pengecekan_showroom_detail2 SET keterangan_catatan_pengecekan = '$catatan_keterangan' where no = '$no'");
			//	mysql_query("update notif_pengecekan set read_admin = 'Y', read_hrd = 'Y', notif_cco = 'Y', read_cco = 'N' where no_pengecekan = '$no_pengecekan' and nama_penilaian = '$nama_penilaian' and jam = '$jam'");	
				header("location:../../media_showroom.php?module=checklist_showroom&act=lihat&id=$no_pengecekan_mingguan"); 
			}elseif($leveluser == 'CCO' or $leveluser == 'admin'){
				$query = mysql_unbuffered_query("UPDATE pengecekan_showroom_detail2 SET catatan_pengecekan = '$catatan_keterangan_cco' where no = '$no'");
				header("location:../../media_showroom.php?module=checklist_showroom&act=lihat&id=$no_pengecekan_mingguan"); 
			}else{
				
			}
			
		}
	
	}


?>