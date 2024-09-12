<?php
	if(count($_POST)){	
	include "../../../config/koneksi.php";
	include "../../../config/koneksi_service_pdo.php";
	
	session_start();
	date_default_timezone_set('Asia/Jakarta');
	
		$no_pengecekan = mysql_real_escape_string($_POST['no_pengecekan']);	
		$waktu_pengecekan = date('Y-m-d H:i:s');	
		$model = mysql_real_escape_string($_POST['model']);	
		$nopolisi = mysql_real_escape_string($_POST['nopolisi']);	
		$odometer = mysql_real_escape_string($_POST['odometer']);
		$gambar64 = mysql_real_escape_string($_POST['gambar64']);
		
		$status_stnk = mysql_real_escape_string($_POST['status_stnk']);
		$status_buku_service = mysql_real_escape_string($_POST['status_buku_srv']);
		$status_dokumen = mysql_real_escape_string($_POST['status_dokumen']);
		$status_radio = mysql_real_escape_string($_POST['status_radio']);
		$status_cd = mysql_real_escape_string($_POST['status_cd']);
		$status_tape = mysql_real_escape_string($_POST['status_tape']);
		$status_steer = mysql_real_escape_string($_POST['status_steer']);
		$status_dongkrak = mysql_real_escape_string($_POST['status_dongkrak']);
		$status_ban = mysql_real_escape_string($_POST['status_ban']);
		$status_cover_ban = mysql_real_escape_string($_POST['status_cover_ban']);
		$status_kunci = mysql_real_escape_string($_POST['status_kunci']);
		$status_dop = mysql_real_escape_string($_POST['status_dop']);
		$status_tutup_pentil = mysql_real_escape_string($_POST['status_tutup_pentil']);
		
		
		$qty_stnk = mysql_real_escape_string($_POST['qty_stnk']);
		$qty_buku_service = mysql_real_escape_string($_POST['qty_buku_srv']);
		$qty_dokumen = mysql_real_escape_string($_POST['qty_dokumen']);
		$qty_radio = mysql_real_escape_string($_POST['qty_radio']);
		$qty_cd = mysql_real_escape_string($_POST['qty_cd']);
		$qty_tape = mysql_real_escape_string($_POST['qty_tape']);
		$qty_steer = mysql_real_escape_string($_POST['qty_steer']);
		$qty_dongkrak = mysql_real_escape_string($_POST['qty_dongkrak']);
		$qty_ban = mysql_real_escape_string($_POST['qty_ban']);
		$qty_cover_ban = mysql_real_escape_string($_POST['qty_cover_ban']);
		$qty_kunci = mysql_real_escape_string($_POST['qty_kunci']);
		$qty_dop = mysql_real_escape_string($_POST['qty_dop']);
		$qty_tutup_pentil = mysql_real_escape_string($_POST['qty_tutup_pentil']);
		
		
		$user = $_SESSION['username'];
		
		$input = date("Y-m-d H:i:s");	

		$i;
		
			if($no_pengecekan!=''){
				$today=date("ym");	
				$hasil = $pdo->query("SELECT max(no_pengecekan) as last FROM test_drive_pengecekan_kendaraan WHERE no_pengecekan LIKE 'PK$today%'");
				$data = $hasil->fetch();
				$lastNoTransaksi = $data['last'];
				$lastNoUrut = substr($lastNoTransaksi, 6, 3);
				$nextNoUrut = $lastNoUrut + 1;
				$nextNoTransaksi = "PK".$today.sprintf('%03s', $nextNoUrut);	
				
					$pdo->query("INSERT INTO test_drive_pengecekan_kendaraan (	no_pengecekan, 
																				waktu_pengecekan, 
																				odometer, 
																				model, 
																				kondisi_kendaraan, 
																				keterangan_pengecekan, 
																				pic_pengecekan)	
																					
																		values 
																			(	'$nextNoTransaksi', 
																				'$waktu_pengecekan', 
																				'$model', 
																				'$odometer', 
																				'$gambar64', 
																				'',
																				'$user')");
																							
					
					
					$kelengkapan = array("STNK","Buku Service","Dokumen / Surat / Koran","Radio - Tape / CD Charger / TV","Cassete / CD","Remote Tape / Remote Alarm","Kunci Steer","Dongkrak","Ban Cadangan","Cover Ban Cadangan","Kunci-kunci","Dop Roda","Tutup Pentil");
					$status_kelengkapan = array("$status_stnk","$status_buku_service","$status_dokumen","$status_radio","$status_cd","$status_tape","$status_steer","$status_dongkrak","$status_ban","$status_cover_ban","$status_kunci","$status_dop","$status_tutup_pentil");
					$jumlah_kelengkapan = array("$qty_stnk","$qty_buku_service","$qty_dokumen","$qty_radio","$qty_cd","$qty_tape","$qty_steer","$qty_dongkrak","$qty_ban","$qty_cover_ban","$qty_kunci","$qty_dop","$qty_tutup_pentil");
					$jumlah_array = count($kelengkapan);
					
					for($i = 0; $i < $jumlah_array; $i++){
						
					$pdo->query("INSERT INTO test_drive_inspeksi (	no,
																	no_pemeriksaan, 
																	perlengkapan_kendaraan, 
																	status_perlengkapan, 
																	kondisi_perlengkapan, 
																	jumlah)	
			
																values 
																(	'',
																	'$nextNoTransaksi', 
																	'$kelengkapan[$i]', 
																	'$status_kelengkapan[$i]', 
																	'$kondisi_kelengkapan[$i]',
																	'$jumlah_kelengkapan[$i]')");
					}
					
					
					
					$msg = "<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil Menambah Data.</div>";
					
					header("location:../../../../media_showroom.php?module=prospek_test_drive&status=ok"); 
			}
	}		
	
?>
		
		
		
		
