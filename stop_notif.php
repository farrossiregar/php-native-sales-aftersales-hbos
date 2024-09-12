<?php
session_start();
include "config/koneksi.php";
$no_pengajuan = $_POST['no_pengajuan'];
if($_SESSION['leveluser']=='admin'){
	$pesan = mysql_query("UPDATE notif set notif_admin = 'N' WHERE no_pengajuan = '$no_pengajuan'");
}elseif($_SESSION['leveluser']=='MNGR'){
	$pesan = mysql_query("UPDATE notif set notif_mngr = 'N' WHERE no_pengajuan = '$no_pengajuan'");
}elseif($_SESSION['leveluser']=='DRKSI'){
	$pesan = mysql_query("UPDATE notif set notif_drksi = 'N' WHERE no_pengajuan = '$no_pengajuan'");
}elseif($_SESSION['leveluser']=='user'){
	$username = $_POST['data2'];
//	$pesan = mysql_query("UPDATE notif set notif_user = 'N' WHERE notif_user = 'Y'");
	$pesan = mysql_query("UPDATE notif set notif_user = 'N' WHERE no_pengajuan = '$no_pengajuan' and username = '$username'");
}

		$berhasil = "sukses";
	echo $berhasil;
?>