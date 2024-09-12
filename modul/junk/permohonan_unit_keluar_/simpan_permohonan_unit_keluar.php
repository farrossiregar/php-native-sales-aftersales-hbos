<?php
	include "../../config/koneksi_sqlserver.php";
	include "../../config/koneksi.php";	
	date_default_timezone_set('Asia/Jakarta');
	if(count($_POST)) {
		
		$nospk = $_POST['nospk'];
		$pemohon = $_POST['nama_sales'];
		$kd_spv = $_POST['kode_spv'];
		$norangka = $_POST['no_rangka'];
		$tgl = $_POST['tanggal'];
		$jam = $_POST['jam1'];
		$menit = $_POST['menit1'];
		
		$waktu = $tgl." ".$jam.":".$menit.":00";

		
		
		$jam_keluar = $jam.":".$menit;
	//	$jam_keluar = $_POST['eventStartDate'];
		$ket = $_POST['keterangan'];
		$input = date("Y-m-d H:i:s");
		
		if ($_GET['aksi'] != 'update'){
	
		
			
			$cek=mysql_query("select * from unit_keluar where no_spk = '$nospk'");
			
			$jml_rec = mysql_num_rows($cek);
			
			if ($jml_rec < 1){
				
				$hari_ini=date("ym");
								$query = "SELECT max(no_puk) as last FROM unit_keluar WHERE no_puk LIKE 'PUK$today%'";
								$hasil = mysql_query($query);
								$data  = mysql_fetch_array($hasil);
								$lastNoTransaksi = $data['last'];
								$lastNoUrut = substr($lastNoTransaksi, 7, 3);
								$nextNoUrut = $lastNoUrut + 1;
								$nextNoTransaksi = $hari_ini.sprintf('%03s', $nextNoUrut);
				
		
				mysql_unbuffered_query("insert into unit_keluar (no_puk,no_spk, nama_sales, kd_spv, norangka, waktu_keluar, keterangan, input, mngr_finance_app, arfinance_app, spv_finance_app, spv_app,tanggal_puk_awal) 
				values('PUK$nextNoTransaksi','$nospk','$pemohon','$kd_spv','$norangka','$waktu','$ket','$input','','','','','$waktu')");
				
				header("location:../../media_showroom.php?module=logistik_puk&status=ok"); 
					
			}else {
				header("location:../../media_showroom.php?module=logistik_puk&status=double"); 
			}
		}else{
			mysql_unbuffered_query("update unit_keluar set waktu_keluar = '$waktu',keterangan = '$ket',input = '$input',revisi = 'Y' where no_puk = '$_POST[no_puk]' ");
			mysql_unbuffered_query("update unit_keluar_revisi set aktif = 'N' ");
			mysql_unbuffered_query("insert into unit_keluar_revisi (no_puk,no_spk,waktu_keluar,keterangan,input) values ('$_POST[no_puk]','$nospk','$waktu','$ket','$input') ");
			
			header("location:../../media_showroom.php?module=logistik_puk&status=ok"); 

		}		
			
	}	
?>
		
		
		
		
