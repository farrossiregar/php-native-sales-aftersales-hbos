<?php
	if(count($_POST)){
		include "../../../config/koneksi_service.php";
		date_default_timezone_set('Asia/Jakarta');
		$today=date("ym");
		
		$no_pemeriksaan = $_POST['no_pemeriksaan'];
		$tanggal_datang = $_POST['tanggal_datang'];
		$no_polisi = $_POST['no_polisi'];
		$model = $_POST['model'];
		$tahunbuat = $_POST['tahunbuat'];
		$odmeter = $_POST['odmeter'];
		$keluhan = $_POST['keluhan'];
		$catatan = $_POST['catatan'];
		$pic = $_POST['pic'];
		$customer = $_POST['customer'];
		$transmisi_mobil = $_POST['transmisi_mobil'];
		$posisi_transmisi = $_POST['posisi_transmisi'];
		$rpm = $_POST['rpm'];
		
		$battery = $_POST['battery'];
		
		$tebaldepankanan = $_POST['tebaldepankanan'];
		$tebaldepankiri = $_POST['tebaldepankiri'];
		$tebalbelakangkanan = $_POST['tebalbelakangkanan'];
		$tebalbelakangkanan = $_POST['tebalbelakangkanan'];	
		
		$keterangandepankanan = $_POST['keterangandepankanan'];
		$keterangandepankiri = $_POST['keterangandepankiri'];
		$keteranganbelakangkanan = $_POST['keteranganbelakangkanan'];
		$keteranganbelakangkiri = $_POST['keteranganbelakangkiri'];
		
		$stnk = $_POST['stnk'];
		$bukuservice = $_POST['bukusrv'];
		$toolset = $_POST['toolset'];
		$dongkrak = $_POST['dongkrak'];
		$doproda = $_POST['doproda'];
		$bancadangan = $_POST['bancadangan'];
		
		$kondisistnk = $_POST['kondisi_stnk'];
		$kondisibukuservice = $_POST['kondisi_buku_srv'];
		$kondisitoolset = $_POST['kondisi_toolset'];
		$kondisidongkrak = $_POST['kondisi_dongkrak'];
		$kondisidoproda = $_POST['kondisi_doproda'];
		$kondisibancadangan = $_POST['kondisi_bancadangan'];
		
		$bunyi = $_POST['bunyi'];
		$sumberbunyi = $_POST['sumberbunyi'];
		$volumebunyi = $_POST['volumebunyi'];
		$karakterbunyi = $_POST['karakterbunyi'];
		$intensitasbunyi = $_POST['intensitasbunyi'];
		$waktubunyi = $_POST['waktubunyi'];
		
		
		$upload_dir = "act/upload/";
		$img = $_POST['hidden_data'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = $upload_dir . mktime() . ".png";
		$nama_file = mktime() . ".png";
		$success = file_put_contents($file, $data);
		print $success ? $file : 'Unable to save the file.';
		
		$battery = $_POST['battery'];
		
		mysql_unbuffered_query("INSERT INTO pemeriksaan_kendaraan values 
				('',
					'$no_pemeriksaan', 
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
					'$nama_file')", $koneksi_service);	
					
					
		$status_kelengkapan = array($_POST['stnk'],$_POST['bukusrv'],$_POST['toolset'],$_POST['dongkrak'],$_POST['doproda'],$_POST['bancadangan']);
		$kondisi_kelengkapan = array($_POST['kondisi_stnk'],$_POST['kondisi_buku_srv'],$_POST['kondisi_toolset'],$_POST['kondisi_dongkrak'],$_POST['kondisi_doproda'],$_POST['kondisi_bancadangan']);
	//	$kondisi_kelengkapan = array($kondisistnk, $kondisibukuservice, $kondisitoolset, $kondisidongkrak, $kondisidoproda, $kondisibancadangan);
		$item_kelengkapan = array("STNK","Buku Service","Tool Set","Dongkrak","Dop Roda","Ban Cadangan");
		$nomor = 0;
		foreach($item_kelengkapan as $data_item_kelengkapan){
			$nomor = $nomor++;
		mysql_unbuffered_query("INSERT INTO pemeriksaan_kendaraan_kelengkapan values 
				('',
					'$no_pemeriksaan', 
					'KELENGKAPAN', 
					'$item_kelengkapan[$nomor]', 
					'$status_kelengkapan[$nomor]',  
					'$kondisi_kelengkapan[$nomor]')");	
		}
		
		
		$tebalban = array($_POST['tebaldepankiri'], $_POST['tebaldepankanan'], $_POST['tebalbelakangkiri'],  $_POST['tebalbelakangkanan']);
		$keteranganban = array($_POST['keterangandepankiri'], $_POST['keterangandepankanan'], $_POST['keteranganbelakangkiri'], $_POST['keteranganbelakangkanan']);
		$kondisiban = array($_POST['kondisidepankiri'], $_POST['kondisidepankanan'], $_POST['kondisibelakangkiri'], $_POST['kondisibelakangkanan']);
		$sisi = array("depan", "belakang");
	//	$j = 0;
		$i = 0;
		foreach($sisi as $data_sisi){
			
			$sebelah = array("kiri", "kanan");
			foreach($sebelah as $data_sebelah){
				$j = $i++;
				
				mysql_unbuffered_query("INSERT INTO pemeriksaan_kendaraan_ban_battery values 
					('',
						'$no_pemeriksaan', 
						'BAN', 
						'BAN', 
						'$tebalban[$j]',  
						'$sisi[$j]', 
						'$sebelah[$j]', 
						'$kondisiban[$j]', 
						'$keteranganban[$j]')");
					//	$i = $i++;
			}
		}
		
		mysql_unbuffered_query("INSERT INTO pemeriksaan_kendaraan_ban_battery values 
				('',
					'$no_pemeriksaan', 
					'Battery', 
					'Battery', 
					'0',  
					'0', 
					'0', 
					'$battery', 
					'0')");
		
					
		mysql_unbuffered_query("INSERT INTO pemeriksaan_kendaraan_bunyi values 
				('',
					'$no_pemeriksaan', 
					'$bunyi', 
					'$sumberbunyi', 
					'$volumebunyi',
					'$karakterbunyi',  
					'$intensitasbunyi', 
					'$waktubunyi', 
					'', 
					'', 
					'', 
					'',
					'',
					'')");	
				
				
				
				$msg = "<div class='alert alert-success alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Selamat!</h4>
						Berhasil Menambah Data.</div>";
			//	echo $msg;
		
	}

?>