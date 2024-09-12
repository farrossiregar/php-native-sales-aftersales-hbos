<?php
session_start();
include "config/koneksi.php";
$leveluser = $_POST['leveluser'];
//$nopermohonan = $_POST['nopermohonan'];
$nopermohonan = "PA1805031";
if($leveluser =='admin'){
	$pesan = mysql_query("UPDATE notif_pemasangan_aksesoris set notif_admin = 'N' WHERE no_permohonan = '$nopermohonan'");
}elseif($_SESSION['leveluser']=='MNGR'){
	$pesan = mysql_query("UPDATE notif_pemasangan_aksesoris set notif_mngr = 'N' WHERE no_permohonan = '$nopermohonan'");
}elseif($_SESSION['leveluser']=='supervisor'){
	$pesan = mysql_query("UPDATE notif_pemasangan_aksesoris set notif_spv = 'N' WHERE no_permohonan = '$nopermohonan'");
}elseif($_SESSION['leveluser']=='salesadm' and $_SESSION['leveluser']=='staff_salesadm'){
	$pesan = mysql_query("UPDATE notif_pemasangan_aksesoris set notif_salesadm = 'N' WHERE no_permohonan = '$nopermohonan'");
}

	$berhasil = "sukses";
	echo $nopermohonan;
?>