<?php
session_start();
include "../config/koneksi.php";

if(count($_POST)) {
	$leveluser = $_POST['leveluser'];
	if($leveluser == 'admin'){
		$pesan = mysql_query("UPDATE notif_pengecekan set notif_admin = 'N' WHERE notif_admin = 'Y'");
	}elseif($leveluser == 'CCO'){
		$pesan = mysql_query("UPDATE notif_pengecekan set notif_cco = 'N' WHERE notif_cco = 'Y'");
	}elseif($leveluser == 'HRD' or $leveluser == 'MNGR' or $leveluser == 'DRKSI'){
		$pesan = mysql_query("UPDATE notif_pengecekan set notif_hrd = 'N' WHERE notif_hrd = 'Y'");
	}else{
		
	}
			$berhasil = "sukses";
		echo $berhasil;
}
?>