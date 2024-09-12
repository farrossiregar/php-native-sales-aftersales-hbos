<?php
session_start();
include "../config/koneksi.php";

if(count($_POST)) {
	$leveluser = $_POST['leveluser'];
	if($leveluser == 'admin'){
		$pesan = mysql_query("UPDATE notif_penampilan_sales set notif_admin = 'N' WHERE notif_admin = 'Y'");
	}elseif($leveluser == 'CCO'){
		$pesan = mysql_query("UPDATE notif_penampilan_sales set notif_cco = 'N' WHERE notif_cco = 'Y'");
	}elseif($leveluser == 'supervisor' ){
		$pesan = mysql_query("UPDATE notif_penampilan_sales set notif_spv = 'N' WHERE notif_spv = 'Y'");
	}else{
		
	}
	$berhasil = "sukses";
	echo $berhasil;
}
?>