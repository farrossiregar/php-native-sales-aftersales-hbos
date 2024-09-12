<?php
if(count($_POST)){
	session_start();
	include "config/koneksi.php";
	$leveluser = $_POST['leveluser'];
	$kode_spv = $_POST['kode_spv'];
	if($leveluser== 'admin'){
		$user_app = "where uk.spv_app = '' and n.notif_admin = 'Y'";
	}elseif($leveluser == 'supervisor'){
		$user_app = "where uk.spv_app = '' and kd_spv = '$kode_spv' and notif_spv = 'Y'";
	}elseif($leveluser == 'MNGR'){
		$user_app = "where uk.spv_app = 'Y' and notif_mngr = 'Y'";
	}elseif($leveluser == 'salesadm' || $_SESSION['leveluser']=='staff_salesadm'){
		$user_app = "where uk.mngr_app = 'Y' and notif_salesadm = 'Y'";
	}elseif($leveluser == 'mngr_finance' or $leveluser == 'ar_finance' or $leveluser == 'spv_finance' ){
		$user_app = "where uk.salesadm_app = 'Y' and notif_finance = 'Y'";
	}elseif($leveluser == 'staff_logistik'){
		$user_app = "where uk.finance_app = 'Y' and notif_staff_logistik = 'Y'";
	}else{
		$user_app = "where uk.finance_app = 'sss' and notif_staff_logistik = 'uuu'";
	}
	$permohonan_unit_keluar = mysql_query("select * from unit_keluar uk
										left join notif_permohonan_unit_keluar n on uk.no_spk = n.no_spk
										$user_app");
	
	while($data_permohonan_unit_keluar = mysql_fetch_array($permohonan_unit_keluar)){
		$no_puk = $data_permohonan_unit_keluar['no_puk'];
		$no_spk = $data_permohonan_unit_keluar['no_spk'];
		$waktu_keluar = $data_permohonan_unit_keluar['waktu_keluar'];
		$no_rangka = $data_permohonan_unit_keluar['norangka'];
		$no_spk_md5 = md5(md5($data_permohonan_unit_keluar['no_spk']));
		$keterangan = $data_permohonan_unit_keluar['keterangan'];
		
		$link = "media_showroom.php?module=logistik_puk&act=approvedpermohonan&id=$no_spk_md5";
		
		echo $no_spk.','.$no_puk.','.$waktu_keluar.','.$no_rangka.','.$keterangan.','.$link.','.$keterangan;
	}
}
?>