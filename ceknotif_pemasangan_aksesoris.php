<?php
	if(count($_POST)){
		session_start();
		include "config/koneksi.php";
		$leveluser = $_POST['leveluser'];
		$kode_spv = $_POST['kode_spv'];
		if($leveluser == 'admin'){
			$user_app = "where status_approved = '' and notif_admin = 'Y'";
		}elseif($leveluser == 'supervisor'){
			$user_app = "where status_approved = '' and kode_spv = '$kode_spv' and notif_spv = 'Y'";
		}elseif($leveluser == 'MNGR'){
			$user_app = "where status_approved = 'SPV_APP' and notif_mngr = 'Y'";
		}elseif($leveluser == 'salesadm' || $leveluser == 'staff_salesadm'){
			$user_app = "where status_approved = 'MNGR_APP' and notif_salesadm = 'Y'";
		}elseif($leveluser == 'mngr_finance'){
			$user_app = "where status_approved = 'ADM_APP' and notif_finance = 'Y'";
		}elseif($leveluser == 'staff_logistik'){
			$user_app = "where status_approved = 'ADM_APP' and notif_logistik = 'Y' and status_pasang = 'BP' ";
		}else{
			$user_app = "where status_approved = 'ADM_APsssP' and notif_logistik = 'Ysss' and status_pasang = 'BPsss'";
		}
		$pemasangan_aksesoris = mysql_query("select * from pemasangan_aksesoris pa
											left join notif_pemasangan_aksesoris n on pa.no_permohonan = n.no_permohonan
											$user_app");
		
		while($data_pemasasangan_aksesoris = mysql_fetch_array($pemasangan_aksesoris)){
		//	$no_permohonan = $data_pemasasangan_aksesoris['no_permohonan'];
			$no_spk = $data_pemasasangan_aksesoris['no_spk'];
			$no_rangka = $data_pemasasangan_aksesoris['no_rangka'];
			$no_mesin = $data_pemasasangan_aksesoris['no_mesin'];
			$nama_customer = $data_pemasasangan_aksesoris['no_mesin'];
			$tipe_model = $data_pemasasangan_aksesoris['tipe_model'];
			$tahun_buat = $data_pemasasangan_aksesoris['tahun_buat'];
			$warna = $data_pemasasangan_aksesoris['warna'];
			$status_pesan = $data_pemasasangan_aksesoris['status_pemesanan'];
			$status_pasang = $data_pemasasangan_aksesoris['status_pasang'];
			$no_permohonan_md5 = substr(md5(md5(addslashes($data_pemasasangan_aksesoris['no_permohonan']))),0,28).md5($data_pemasasangan_aksesoris['no_permohonan']);
			$no_permohonan = $data_pemasasangan_aksesoris['no_permohonan'];
			if($leveluser == 'staff_logistik'){
				$link = "media_showroom.php?module=aksesoris_pemasangan_aksesoris&act=ubahstatuspemasangan&id=$no_permohonan_md5";
			}else{
				$link = "media_showroom.php?module=aksesoris_pemasangan_aksesoris&act=approvedpemasangan&id=$no_permohonan_md5";
			}
			
			echo $no_permohonan.','.$tipe_model.','.$tahun_buat.','.$warna.','.$status_pesan.','.$link.','.$status_pasang;
		}
	}
	
?>