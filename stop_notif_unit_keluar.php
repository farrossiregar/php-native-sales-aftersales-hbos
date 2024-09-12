<?php
session_start();
include "config/koneksi.php";
$no_spk = $_POST['nospk'];
$leveluser = $_POST['leveluser'];
if($leveluser == 'admin'){
	$pesan = mysql_query("UPDATE notif_permohonan_unit_keluar set notif_admin = 'N' WHERE no_spk = '$no_spk'");
}elseif($leveluser=='supervisor'){
	$pesan = mysql_query("UPDATE notif_permohonan_unit_keluar set notif_spv = 'N' WHERE no_spk = '$no_spk'");
}elseif($leveluser == 'MNGR'){
	$pesan = mysql_query("UPDATE notif_permohonan_unit_keluar set notif_mngr = 'N' WHERE no_spk = '$no_spk'");
}elseif($leveluser == 'salesadm' || $leveluser == 'staff_salesadm'){
	$pesan = mysql_query("UPDATE notif_permohonan_unit_keluar set notif_salesadm = 'N' WHERE no_spk = '$no_spk'");
}elseif($leveluser == 'mngr_finance'){
	$pesan = mysql_query("UPDATE notif_permohonan_unit_keluar set notif_finance = 'N' WHERE no_spk = '$no_spk'");
}elseif($leveluser == 'staff_logistik'){
	$pesan = mysql_query("UPDATE notif_permohonan_unit_keluar set notif_staff_logistik = 'N' WHERE no_spk = '$no_spk'");
}else{
	
}

		$berhasil = "sukses".$no_spk;
	echo $berhasil;
?>