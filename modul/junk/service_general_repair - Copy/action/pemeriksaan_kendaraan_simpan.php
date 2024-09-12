<?php
	if(count($_POST)){
		
		function jin_date_sql($tgl_awal){
			$exp = explode('-',$tgl_awal);
			if(count($exp) == 3) {
				$tgl_awal = $exp[2].'-'.$exp[1].'-'.$exp[0];
			}
			return $tgl_awal;
		}
		
		include "../../../config/koneksi_service.php";
		date_default_timezone_set('Asia/Jakarta');
		$today=date("ym");
		$gambar_64 = mysql_real_escape_string($_POST['gambar_64']);

		$no_pemeriksaan =  mysql_real_escape_string($_POST['no_pemeriksaan']);
		$tanggal_datang = jin_date_sql( mysql_real_escape_string($_POST['tanggal_datang']));
		$no_polisi =  mysql_real_escape_string($_POST['no_polisi']);
		$model =  mysql_real_escape_string($_POST['model']);
		$tahunbuat =  mysql_real_escape_string($_POST['tahunbuat']);
		$odmeter = str_replace(".","", mysql_real_escape_string($_POST['odmeter']));
		$keluhan =  mysql_real_escape_string($_POST['keluhan']);
		$catatan =  mysql_real_escape_string($_POST['catatan']);
		$pic =  mysql_real_escape_string($_POST['pic']);
		$customer =  mysql_real_escape_string($_POST['customer']);
		$gambar_64 = str_replace(" ", "+", $_POST['gambar_64']);
		$ttd_base64 =  str_replace(" ", "+", $_POST['ttd_base64']);
		$transmisi_mobil =  mysql_real_escape_string($_POST['transmisi_mobil']);
		$posisi_transmisi =  mysql_real_escape_string($_POST['posisi_transmisi']);
		$rpm =  mysql_real_escape_string($_POST['rpm']);
		
		$battery =  mysql_real_escape_string($_POST['battery']);
		if($battery == 'G'){
			$battery = 'BAIK';
		}else if($battery == 'GR'){
			$battery = 'SEDANG';
		}else if($battery == 'BR'){
			$battery = 'TIDAK BAIK';
		}else{
			$battery = '';
		}
		
		$tebaldepankanan =  mysql_real_escape_string($_POST['tebaldepankanan']);
		$tebaldepankiri =  mysql_real_escape_string($_POST['tebaldepankiri']);
		$tebalbelakangkanan =  mysql_real_escape_string($_POST['tebalbelakangkanan']);
		$tebalbelakangkanan =  mysql_real_escape_string($_POST['tebalbelakangkanan']);	
		
		$keterangandepankanan =  mysql_real_escape_string($_POST['keterangandepankanan']);
		$keterangandepankiri =  mysql_real_escape_string($_POST['keterangandepankiri']);
		$keteranganbelakangkanan =  mysql_real_escape_string($_POST['keteranganbelakangkanan']);
		$keteranganbelakangkiri =  mysql_real_escape_string($_POST['keteranganbelakangkiri']);
		
		$stnk =  mysql_real_escape_string($_POST['stnk']);
		$bukuservice =  mysql_real_escape_string($_POST['bukusrv']);
		$toolset =  mysql_real_escape_string($_POST['toolset']);
		$dongkrak =  mysql_real_escape_string($_POST['dongkrak']);
		$doproda =  mysql_real_escape_string($_POST['doproda']);
		$bancadangan =  mysql_real_escape_string($_POST['bancadangan']);
		
		$kondisistnk =  mysql_real_escape_string($_POST['kondisi_stnk']);
		$kondisibukuservice =  mysql_real_escape_string($_POST['kondisi_buku_srv']);
		$kondisitoolset =  mysql_real_escape_string($_POST['kondisi_toolset']);
		$kondisidongkrak =  mysql_real_escape_string($_POST['kondisi_dongkrak']);
		$kondisidoproda =  mysql_real_escape_string($_POST['kondisi_doproda']);
		$kondisibancadangan =  mysql_real_escape_string($_POST['kondisi_bancadangan']);
		
		$bunyi =  mysql_real_escape_string($_POST['bunyi']);
		$sumberbunyi =  mysql_real_escape_string($_POST['sumberbunyi']);
		$volumebunyi =  mysql_real_escape_string($_POST['volumebunyi']);
		$karakterbunyi =  mysql_real_escape_string($_POST['karakterbunyi']);
		$intensitasbunyi =  mysql_real_escape_string($_POST['intensitasbunyi']);
		$waktubunyi =  mysql_real_escape_string($_POST['waktubunyi']);
		$waktukejadian =  mysql_real_escape_string($_POST['waktukejadian']);
		$kondisipengendaraan =  mysql_real_escape_string($_POST['kondisipengendaraan']);
		$kondisijalan =  mysql_real_escape_string($_POST['kondisijalan']);
		
		
		$upload_dir = "upload/";
		$img = $_POST['hidden_data'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = $upload_dir . mktime() . ".png";
		$nama_file = mktime() . ".png";
		$success = file_put_contents($file, $data);
		print $success ? $file : 'Unable to save the file.';
		
		$battery =  mysql_real_escape_string($_POST['battery']);
		if($battery == 'G'){
			$battery = "BAIK";
		}elseif($battery == 'GR'){
			$battery = "SEDANG";
		}elseif($battery == 'BR'){
			$battery = "TIDAK BAIK";
		}else{
			$battery = "";
		}
			
		$today=date("ym");
			$query = "SELECT max(no_pemeriksaan) as last FROM pemeriksaan_kendaraan WHERE no_pemeriksaan LIKE 'NP$today%'";
			$hasil = mysql_query($query, $koneksi_service);
			$data  = mysql_fetch_array($hasil);
			$lastNoTransaksi = $data['last'];
			$lastNoUrut = substr($lastNoTransaksi, 6, 4);
			$nextNoUrut = $lastNoUrut + 1;
			$nextNoTransaksi = "NP".$today.sprintf('%04s', $nextNoUrut);	

		mysql_unbuffered_query("INSERT INTO pemeriksaan_kendaraan values 
				('$nextNoTransaksi', 
					'$tanggal_datang', 
					'$no_polisi', 
					'$model',  
					'$tahunbuat', 
					'$odmeter', 
					'$keluhan', 
					'$catatan', 
					'$pic', 
					'$customer',
					'$rpm',
					'$transmisi_mobil',
					'$posisi_transmisi',
					'$nama_file',
					'$gambar_64',
					'$ttd_base64'
					
					)", $koneksi_service);	
					
		
		mysql_unbuffered_query("INSERT INTO pemeriksaan_kendaraan_kelengkapan values 
				('', '$no_pemeriksaan', 'KELENGKAPAN', 'STNK', '$stnk', '$kondisistnk'),
				('', '$no_pemeriksaan', 'KELENGKAPAN', 'Buku Service', '$bukuservice', '$kondisibukuservice'),
				('', '$no_pemeriksaan', 'KELENGKAPAN', 'Tool Set', '$toolset', '$kondisitoolset'),
				('', '$no_pemeriksaan', 'KELENGKAPAN', 'Dongkrak', '$dongkrak', '$kondisidongkrak'),
				('', '$no_pemeriksaan', 'KELENGKAPAN', 'Dop Roda', '$doproda', '$kondisidoproda'),
				('', '$no_pemeriksaan', 'KELENGKAPAN', 'Ban Cadangan', '$bancadangan', '$kondisibancadangan')
				");	
		
		
		mysql_unbuffered_query("INSERT INTO pemeriksaan_kendaraan_ban_battery values 
					('','$no_pemeriksaan', 'BAN', 'BAN', '$_POST[tebaldepankiri]', 'DEPAN', 'KIRI', '$_POST[kondisidepankiri]', '$_POST[keterangandepankiri]'),
					('','$no_pemeriksaan', 'BAN', 'BAN', '$_POST[tebaldepankanan]', 'DEPAN', 'KANAN', '$_POST[kondisidepankanan]', '$_POST[keterangandepankanan]'),
					('','$no_pemeriksaan', 'BAN', 'BAN', '$_POST[tebalbelakangkiri]', 'BELAKANG', 'KIRI', '$_POST[kondisibelakangkiri]', '$_POST[keteranganbelakangkiri]'),
					('','$no_pemeriksaan', 'BAN', 'BAN', '$_POST[tebalbelakangkanan]', 'BELAKANG', 'KANAN', '$_POST[kondisibelakangkanan]', '$_POST[keteranganbelakangkanan]')")
					;
		
		mysql_unbuffered_query("INSERT INTO pemeriksaan_kendaraan_ban_battery values 
				('','$no_pemeriksaan', 'Battery', 'Battery', '0',  '0', '0', '$battery', '0')");
		
					
		mysql_unbuffered_query("INSERT INTO pemeriksaan_kendaraan_bunyi values 
				('',
					'$no_pemeriksaan', 
					'$bunyi', 
					'$sumberbunyi', 
					'$volumebunyi',
					'$karakterbunyi',  
					'$intensitasbunyi', 
					'$waktubunyi', 
					'$waktukejadian', 
					'$kondisipengendaraan', 
					'$kondisijalan', 
					'$transmisi_mobil',
					'$posisi_transmisi')");	

					
				$msg = "<div class='alert alert-success alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Selamat!</h4>
						Berhasil Menambah Data.</div>";
			//	echo $msg;
			
		
	}

?>