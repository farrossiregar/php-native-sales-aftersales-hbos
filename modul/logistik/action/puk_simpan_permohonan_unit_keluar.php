<?php
session_start();

	
	if(count($_POST)) {
		
		include "../../../config/koneksi_sqlserver.php";
		include "../../../config/koneksi.php";	
		date_default_timezone_set('Asia/Jakarta');
		
		$nospk = mysql_real_escape_string($_POST['nospk']);
		$pemohon = mysql_real_escape_string($_SESSION['username']);
		$kd_spv = mysql_real_escape_string($_SESSION['kode_spv']);
		$norangka = mysql_real_escape_string($_POST['no_rangka']);
		$tgl = mysql_real_escape_string($_POST['tanggal']);
		$jam = mysql_real_escape_string($_POST['jam1']);
		$menit = mysql_real_escape_string($_POST['menit1']);
		
		$waktu = $tgl." ".$jam.":".$menit.":00";

		
		
		$jam_keluar = $jam.":".$menit;
	//	$jam_keluar = $_POST['eventStartDate'];
		$ket = mysql_real_escape_string($_POST['keterangan']);
		$input = date("Y-m-d H:i:s");
		
		if ($_GET['aksi'] != 'update'){
	
		
			
			$cek=mysql_query("select * from unit_keluar where no_spk = '$nospk'");
			
			$jml_rec = mysql_num_rows($cek);
			
			if ($jml_rec < 1){
				
				if (strlen($nospk) < 10){
					header("location:../../../media_showroom.php?module=logistik_puk&status=galengkap"); 
					return false;
				}
				
				$hari_ini=date("ym");
								$query = "SELECT max(no_puk) as last FROM unit_keluar WHERE no_puk LIKE 'PUK$today%'";
								$hasil = mysql_query($query);
								$data  = mysql_fetch_array($hasil);
								$lastNoTransaksi = $data['last'];
								$lastNoUrut = substr($lastNoTransaksi, 7, 3);
								$nextNoUrut = $lastNoUrut + 1;
								$nextNoTransaksi = $hari_ini.sprintf('%03s', $nextNoUrut);
								
				if ($_SESSION['leveluser'] == "MNGR"){
					mysql_unbuffered_query("insert into unit_keluar (no_puk,no_spk, nama_sales, kd_spv, norangka, waktu_keluar, keterangan, input, mngr_finance_app, salesadm_app, mngr_app, spv_app, tanggal_puk_awal,
					spv_user_app,spv_app_time,mngr_user_app,mngr_app_time) 
					values('PUK$nextNoTransaksi','$nospk','a/n $pemohon','$kd_spv','$norangka','$waktu','$ket','$input','','','Y','Y','$waktu',
					'a/n $pemohon','$waktu','$pemohon','$waktu')");
					
					mysql_unbuffered_query("insert into notif_permohonan_unit_keluar values('','$nospk','Y','N','N','Y','N','Y','N','Y','N','Y','N','Y')");

				}else{
				
				
				
		
					mysql_unbuffered_query("insert into unit_keluar (no_puk,no_spk, nama_sales, kd_spv, norangka, waktu_keluar, keterangan, input, mngr_finance_app, salesadm_app, mngr_app, spv_app, tanggal_puk_awal) 
					values('PUK$nextNoTransaksi','$nospk','$pemohon','$kd_spv','$norangka','$waktu','$ket','$input','','','','','$waktu')");
					
					mysql_unbuffered_query("insert into notif_permohonan_unit_keluar values('','$nospk','Y','N','Y','N','N','Y','N','Y','N','Y','N','Y')");
				}
				
				header("location:../../../media_showroom.php?module=logistik_puk&status=ok"); 
					
			}else {
				header("location:../../../media_showroom.php?module=logistik_puk&status=double"); 
			}
		}else{
			$cek=mysql_query("select * from unit_keluar where no_spk = '$nospk'");
			$data_cek = mysql_fetch_array($cek);
			
			if($data_cek['mngr_finance_app'] == 'Y'){
				mysql_unbuffered_query("update unit_keluar set status_approved = '', spv_app = '', mngr_app = '', salesadm_app='', waktu_keluar = '$waktu', keterangan = '$ket',input = '$input',revisi = 'Y',ket_approved = '', user_revisi = '$_SESSION[username]' where no_puk = '$_POST[no_puk]' ");
			}else{
				mysql_unbuffered_query("update unit_keluar set status_approved = '', spv_app = '', mngr_app = '', salesadm_app='', mngr_finance_app = '' , waktu_keluar = '$waktu',keterangan = '$ket',input = '$input',revisi = 'Y',ket_approved = '', user_revisi = '$_SESSION[username]' where no_puk = '$_POST[no_puk]' ");
			}
			
			
		//	mysql_unbuffered_query("update unit_keluar set status_approved = '', spv_app = '', mngr_app = '', salesadm_app='', mngr_finance_app = '' , waktu_keluar = '$waktu',keterangan = '$ket',input = '$input',revisi = 'Y',ket_approved = '' where no_puk = '$_POST[no_puk]' ");
			mysql_unbuffered_query("update unit_keluar_revisi set aktif = 'N' ");
			mysql_unbuffered_query("insert into unit_keluar_revisi (no_puk,no_spk,waktu_keluar,keterangan,input) values ('$_POST[no_puk]','$nospk','$waktu','$ket','$input') ");
			
			header("location:../../../media_showroom.php?module=logistik_puk&status=ok"); 

		}		
			
	}	
?>
		
		
		
		
