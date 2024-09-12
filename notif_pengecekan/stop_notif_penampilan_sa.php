<?php
session_start();
include "../config/koneksi_service.php";

if(count($_POST)) {
	$leveluser = $_POST['leveluser'];
	if($leveluser == 'admin'){
		$pesan = mysql_query("UPDATE notif_penampilan_sa set notif_admin = 'N' WHERE notif_admin = 'Y'");
		
	}elseif($leveluser == 'CCO'){
		$pesan = mysql_query("UPDATE notif_penampilan_sa set notif_cco = 'N' WHERE notif_cco = 'Y'");
//	}elseif($leveluser == 'HRD' or $leveluser == 'MNGR' or $leveluser == 'DRKSI'){
	}elseif($leveluser == 'HRD'){
		$pesan = mysql_query("UPDATE notif_penampilan_sa set notif_cco = 's' WHERE notif_cco = 'Y'");
	}else{
		
	}
	$berhasil = "mantap";
	echo $berhasil;	
}
?>