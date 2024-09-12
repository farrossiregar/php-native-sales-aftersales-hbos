<?php
session_start();

include "../config/koneksi_service.php";

if(count($_POST)) {
	$leveluser = $_POST['leveluser'];
	$no = $_POST['no'];
	$jenis_pengecekan = $_POST['jenis_pengecekan'];

/*	if($jenis_pengecekan == 'service'){
		if($_SESSION['leveluser'] == 'admin'){
			$pesan = mysql_query("UPDATE notif_pengecekan_service set read_admin = 'Y' WHERE no = '$no'",$koneksi_service);
		}elseif($leveluser == 'CCO'){
			$pesan = mysql_query("UPDATE notif_pengecekan_service set read_cco = 'Y' WHERE read_cco = 'N'",$koneksi_service);
		}else{
			$pesan = mysql_query("UPDATE notif_pengecekan_service set read_hrd = 'Y' WHERE read_hrd = 'N'",$koneksi_service);
		}
		$berhasil = "sukses";
	//	echo $berhasil;
	}
	else	*/
		
	if($jenis_pengecekan == 'showroom'){
		if($leveluser == 'admin'){
			$pesan = mysql_query("UPDATE notif_pengecekan set read_admin = 'Y' WHERE no = '$no'",$koneksi_showroom);
		}elseif($leveluser == 'CCO'){
			$pesan = mysql_query("UPDATE notif_pengecekan set read_cco = 'Y' WHERE read_cco = 'N'",$koneksi_showroom);
		}else{
			$pesan = mysql_query("UPDATE notif_pengecekan set read_hrd = 'Y' WHERE read_hrd = 'N'",$koneksi_showroom);
		}
		$berhasil = "sukses";
		echo $berhasil;
	}else{
		
	}
}

?>