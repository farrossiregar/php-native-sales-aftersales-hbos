<?php
	if(count($_POST)){	
	include "../../../config/koneksi.php";
	date_default_timezone_set('Asia/Jakarta');
		$aksi = $_GET['aksi'];
		$no_peminjaman = mysql_real_escape_string($_POST['no_peminjaman']);
		$nama = mysql_real_escape_string($_POST['nama_cust']);
		$alamat = mysql_real_escape_string($_POST['alamat']);
		$no_ktp = mysql_real_escape_string($_POST['no_ktp']);
		$telepon = mysql_real_escape_string($_POST['telepon']);
		$keterangan = mysql_real_escape_string($_POST['keterangan']);
		$tipe = mysql_real_escape_string($_POST['tipe']);
		$tanggal_test_drive = mysql_real_escape_string($_POST['tgl_test_drive']);
		$jam_test_drive_awal = mysql_real_escape_string($_POST['waktu_test_drive_awal']).':'.mysql_real_escape_string($_POST['menit_test_drive_awal']);
		$jam_test_drive_akhir = mysql_real_escape_string($_POST['waktu_test_drive_akhir']).':'.mysql_real_escape_string($_POST['menit_test_drive_akhir']);
		$rencana_spk = "";
		$jenis_customer = mysql_real_escape_string($_POST['jenis_customer']);
		$peserta_test_drive = mysql_real_escape_string($_POST['peserta_test_drive']);
		$lokasi_test_drive = mysql_real_escape_string($_POST['lokasi_test_drive']);
		$user_input = mysql_real_escape_string($_POST['nama_sales']);
		$input = date("Y-m-d H:i:s");	

		$i;
		if($aksi == 'update'){
			mysql_unbuffered_query("UPDATE test_drive_peminjaman_kendaraan set nama_customer = '$nama',
																	 alamat_customer = '$alamat',
																	 no_ktp = '$no_ktp',
																	 no_telp = '$telepon',
																	 keterangan = '$keterangan',
																	 tipe_mobil = '$tipe',
																	 tgl_test_drive = '$tanggal_test_drive',
																	 jam_test_drive = '$jam_test_drive_awal',
																	 estimasi_jam_selesai = '$jam_test_drive_akhir',
																	 rencana_spk = '$rencana_spk',
																	 jenis_customer = '$jenis_customer',
																	 peserta_test_drive = '$peserta_test_drive',
																	 lokasi_test_drive = '$lokasi_test_drive'
																	 where no_peminjaman = '$no_peminjaman'");	
																
			header("location:../../../../media_showroom.php?module=prospek_test_drive&status=ok"); 
					
		}else{
			if($nama!=''){
				$today=date("ym");
				$query = "SELECT max(no_peminjaman) as last FROM test_drive_peminjaman_kendaraan WHERE no_peminjaman LIKE 'TD$today%'";
				$hasil = mysql_query($query);
				$data  = mysql_fetch_array($hasil);
				$lastNoTransaksi = $data['last'];
				$lastNoUrut = substr($lastNoTransaksi, 6, 3);
				$nextNoUrut = $lastNoUrut + 1;
				$nextNoTransaksi = "TD".$today.sprintf('%03s', $nextNoUrut);	
				
					mysql_unbuffered_query("INSERT INTO test_drive_peminjaman_kendaraan (	no_peminjaman, 
																				nama_customer, 
																				alamat_customer, 
																				no_ktp, 
																				no_telp, 
																				tipe_mobil, 
																				tgl_test_drive, 
																				jam_test_drive, 
																				estimasi_jam_selesai, 
																				keterangan, 
																				rencana_spk, 
																				jenis_customer, 
																				lokasi_test_drive, 
																				peserta_test_drive, 
																				nama_sales, 
																				waktu_permohonan, 
																				mngr_app, 
																				mngr_user_app, 
																				mngr_app_time, 
																				keterangan_app) 
																		values 
																				(	'$nextNoTransaksi', 
																					'$nama', 
																					'$alamat', 
																					'$no_ktp', 
																					'$telepon', 
																					'$tipe', 
																					'$tanggal_test_drive', 
																					'$jam_test_drive_awal', 
																					'$jam_test_drive_akhir', 
																					'$keterangan',  
																					'$rencana_spk', 
																					'$jenis_customer', 
																					'$lokasi_test_drive', 
																					'$peserta_test_drive', 
																					'$user_input', 
																					'$input', 
																					'', 
																					'', 
																					'', 
																					'')");	
					
					
					
					$msg = "<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil Menambah Data.</div>";
				//	echo $msg;
					
					header("location:../../../../media_showroom.php?module=prospek_test_drive&status=ok"); 
			}
		}
		
	}		
	
?>
		
		
		
		
