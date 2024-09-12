<?php

	session_start();
	include "config/koneksi.php";
	
	$level = $_POST['leveluser'];
	
	
	if($level != ''){
		if($level=='admin'){
			$pesan = mysql_query("SELECT n.read_admin, pd.no_pengajuan FROM pengajuan_discount pd 
									left join notif n on pd.no_pengajuan = n.no_pengajuan 
									where n.read_admin = 'N' and (pd.proses_approve = 'N' or pd.status_approved='AL') order by pd.tgl_pengajuan_ulang desc");
									
			$cek_jumlah_pesan = mysql_num_rows($pesan);
									
			$pemasangan_aksesoris = mysql_query("select * from pemasangan_aksesoris pa 
											left join notif_pemasangan_aksesoris n on pa.no_permohonan = n.no_permohonan
											where status_approved = '' and read_admin = 'N'");

			$cek_pemasangan_aksesoris = mysql_num_rows($pemasangan_aksesoris);	
			
			$permohonan_unit_keluar = mysql_query("select * from unit_keluar uk
											left join notif_permohonan_unit_keluar n on uk.no_spk = n.no_spk
											where uk.spv_app = '' and n.read_admin = 'N'");

			$cek_permohonan_unit_keluar = mysql_num_rows($permohonan_unit_keluar);
		

			$j = $cek_jumlah_pesan + $cek_pemasangan_aksesoris + $cek_permohonan_unit_keluar;
			
		}elseif($_SESSION['leveluser']=='DRKSI'){
			$pesan = mysql_query("SELECT n.read_drksi, pd.no_pengajuan FROM pengajuan_discount pd 
									left join notif n on pd.no_pengajuan = n.no_pengajuan 
									where n.read_drksi = 'N' and (pd.proses_approve = 'N' or pd.status_approved='AL') order by pd.tgl_pengajuan_ulang desc");
									
			$cek_jumlah_pesan = mysql_num_rows($pesan);
			
			$j = $cek_jumlah_pesan;
		}elseif($_SESSION['leveluser']=='MNGR'){
			$pesan = mysql_query("SELECT n.read_mngr, pd.no_pengajuan FROM pengajuan_discount pd 
									left join notif n on pd.no_pengajuan = n.no_pengajuan 
									where n.read_mngr = 'N' and pd.proses_approve = 'N' order by pd.tgl_pengajuan_ulang desc");
									
			$cek_jumlah_pesan = mysql_num_rows($pesan);
			
			$pemasangan_aksesoris = mysql_query("select * from pemasangan_aksesoris pa 
											left join notif_pemasangan_aksesoris n on pa.no_permohonan = n.no_permohonan
											where status_approved = 'SPV_APP' and read_mngr = 'N'");

			$cek_pemasangan_aksesoris = mysql_num_rows($pemasangan_aksesoris);	
			
			$permohonan_unit_keluar = mysql_query("select * from unit_keluar uk
											left join notif_permohonan_unit_keluar n on uk.no_spk = n.no_spk
											where uk.spv_app = 'Y' and read_mngr = 'N'");

			$cek_permohonan_unit_keluar = mysql_num_rows($permohonan_unit_keluar);
			
			$j = $cek_jumlah_pesan + $cek_pemasangan_aksesoris + $cek_permohonan_unit_keluar;
			
		}elseif($_SESSION['leveluser']=='user'){
			$pesan = mysql_query("SELECT n.read_user, pd.no_pengajuan FROM pengajuan_discount pd 
									left join notif n on pd.no_pengajuan = n.no_pengajuan 
									where n.read_user = 'N' and pd.proses_approve = 'Y' and (pd.status_approved = 'Y' or pd.status_approved = 'N') and username_pemohon = '$_SESSION[username]' order by pd.tgl_pengajuan_ulang desc limit 20");
									
			$cek_jumlah_pesan = mysql_num_rows($pesan);
			
			$j = $cek_jumlah_pesan;
			
		}elseif($_SESSION['leveluser']=='salesadm' || $_SESSION['leveluser']=='staff_salesadm'){
			$pemasangan_aksesoris = mysql_query("select * from pemasangan_aksesoris pa 
											left join notif_pemasangan_aksesoris n on pa.no_permohonan = n.no_permohonan
											where status_approved = 'MNGR_APP' and read_salesadm = 'N'");

			$cek_pemasangan_aksesoris = mysql_num_rows($pemasangan_aksesoris);	
			
			$permohonan_unit_keluar = mysql_query("select * from unit_keluar uk
											left join notif_permohonan_unit_keluar n on uk.no_spk = n.no_spk
											where uk.mngr_app = 'Y' and read_salesadm = 'N'");

			$cek_permohonan_unit_keluar = mysql_num_rows($permohonan_unit_keluar);

			$j = $cek_pemasangan_aksesoris + $cek_permohonan_unit_keluar;
			
		}elseif($_SESSION['leveluser']=='supervisor'){
			$kode_spv = $_SESSION['kode_spv'];
			
			$pemasangan_aksesoris = mysql_query("select * from pemasangan_aksesoris pa 
											left join notif_pemasangan_aksesoris n on pa.no_permohonan = n.no_permohonan
											where status_approved = '' and kode_spv = '$kode_spv' and read_spv = 'N'");

			$cek_pemasangan_aksesoris = mysql_num_rows($pemasangan_aksesoris);	
			
			$permohonan_unit_keluar = mysql_query("select * from unit_keluar uk
											left join notif_permohonan_unit_keluar n on uk.no_spk = n.no_spk
											where uk.spv_app = '' and uk.kd_spv = '$kode_spv' and read_spv = 'N'");

			$cek_permohonan_unit_keluar = mysql_num_rows($permohonan_unit_keluar);

			$j = $cek_pemasangan_aksesoris + $cek_permohonan_unit_keluar;
		//	$j = 0;
		}elseif($_SESSION['leveluser']=='mngr_finance' or $level == 'ar_finance' or $level == 'spv_finance'){
			$pemasangan_aksesoris = mysql_query("select * from pemasangan_aksesoris pa 
											left join notif_pemasangan_aksesoris n on pa.no_permohonan = n.no_permohonan
											where status_approved = 'ADM_APP' and read_finance = 'N'");

			$cek_pemasangan_aksesoris = mysql_num_rows($pemasangan_aksesoris);	
			
			$permohonan_unit_keluar = mysql_query("select * from unit_keluar uk
											left join notif_permohonan_unit_keluar n on uk.no_spk = n.no_spk
											where uk.status_approved = 'ADM_APP' and read_finance = 'N'");

			$cek_permohonan_unit_keluar = mysql_num_rows($permohonan_unit_keluar);

			$j = $cek_pemasangan_aksesoris + $cek_permohonan_unit_keluar;
		//	$j = 0;
		}elseif($_SESSION['leveluser']=='staff_logistik'){
			
			$pemasangan_aksesoris = mysql_query("select * from pemasangan_aksesoris pa 
											left join notif_pemasangan_aksesoris n on pa.no_permohonan = n.no_permohonan
											where status_approved = 'ADM_APP' and read_logistik = 'N' and status_pasang = 'BP'");

			$cek_pemasangan_aksesoris = mysql_num_rows($pemasangan_aksesoris);	
			
			$permohonan_unit_keluar = mysql_query("select * from unit_keluar uk
											left join notif_permohonan_unit_keluar n on uk.no_spk = n.no_spk
											where uk.mngr_finance_app = 'Y' and read_staff_logistik = 'N'");

			$cek_permohonan_unit_keluar = mysql_num_rows($permohonan_unit_keluar);

			$j = $cek_pemasangan_aksesoris + $cek_permohonan_unit_keluar;
		//	$j = 0;
		}else{
			$j = 0;
		}
	}else{
		$j = 0;
	}	
	
	echo $j;

	

?>