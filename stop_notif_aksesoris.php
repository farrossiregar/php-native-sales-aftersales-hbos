<?php
session_start();
include "config/koneksi.php";
$leveluser = $_POST['leveluser'];
$nopermohonan = $_POST['nopermohonan'];
//$nopermohonan = "PA1805031";
if($leveluser =='admin'){
	$pesan = mysql_query("UPDATE notif_pemasangan_aksesoris set notif_admin = 'N' WHERE no_permohonan = '$nopermohonan'");
}elseif($leveluser=='MNGR'){
	$pesan = mysql_query("UPDATE notif_pemasangan_aksesoris set notif_mngr = 'N' WHERE no_permohonan = '$nopermohonan'");
}elseif($leveluser=='supervisor'){
	$pesan = mysql_query("UPDATE notif_pemasangan_aksesoris set notif_spv = 'N' WHERE no_permohonan = '$nopermohonan'");
}elseif($leveluser=='salesadm' or $leveluser=='staff_salesadm'){
	$pesan = mysql_query("UPDATE notif_pemasangan_aksesoris set notif_salesadm = 'N' WHERE no_permohonan = '$nopermohonan'");
}elseif($leveluser=='mngr_finance'){
	$pesan = mysql_query("UPDATE notif_pemasangan_aksesoris set notif_finance = 'N' WHERE no_permohonan = '$nopermohonan'");
}elseif($leveluser=='staff_logistik'){
	$pesan = mysql_query("UPDATE notif_pemasangan_aksesoris set notif_logistik = 'N' WHERE no_permohonan = '$nopermohonan'");
}else{
	$pesan = mysql_query("UPDATE notif_pemasangan_aksesoris set notif_finance = 'N' WHERE no_permohonan = 'aaa'");
}


	echo $leveluser;
?>