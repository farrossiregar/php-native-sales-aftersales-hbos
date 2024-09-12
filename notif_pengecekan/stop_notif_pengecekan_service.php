<?php
session_start();
include "../config/koneksi_service.php";

if(count($_POST)) {
	$leveluser = addslashes($_POST['leveluser']);
	if($leveluser == 'admin'){
		$pesan = mysql_query("UPDATE notif_pengecekan_service set notif_admin = 'N' WHERE notif_admin = 'Y'",$koneksi_service);
	}elseif($leveluser == 'CCO'){
		$pesan = mysql_query("UPDATE notif_pengecekan_service set notif_cco = 'N' WHERE notif_cco = 'Y'",$koneksi_service);
	}elseif($leveluser == 'HRD' or $leveluser == 'MNGR' or $leveluser == 'DRKSI'){
		$pesan = mysql_query("UPDATE notif_pengecekan_service set notif_hrd = 'N' WHERE notif_hrd = 'Y'",$koneksi_service);
	}else{
		
	}
}

		$berhasil = "sukses";
	echo $berhasil;
?>