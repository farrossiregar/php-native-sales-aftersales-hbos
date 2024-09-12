
			
	<?php 
		include "../../config/koneksi.php";		
		include "../../config/fungsi_thumb.php";		
		session_start();
		date_default_timezone_set('Asia/Jakarta');
		
		if(count($_POST)) {
			date_default_timezone_set('Asia/Jakarta');
			$today = date("Y-m-d H:i:s");
		    $hari_ini=date("ym");
			
			$tgl_awal = $_POST['periode_awal'];
			$tgl_akhir = $_POST['periode_akhir'];
			

			// FUNGSI DATE CONVERT
			function jin_date_sql($tgl_awal){
				$exp = explode('-',$tgl_awal);
				if(count($exp) == 3) {
					$tgl_awal = $exp[2].'-'.$exp[1].'-'.$exp[0];
				}
				return $tgl_awal;
			}
			
			// UPLOAD FOTO CHUY
			$jumlah = count($_FILES['foto']['name']);
			if ($jumlah > 0) {
			for ($i=0; $i < $jumlah; $i++) {
			$unik = uniqid();
				$lokasi_file = $_FILES['foto']['tmp_name'][$i];
				$tipe_file   = $_FILES['foto']['type'][$i];
				$nama_file   = $_FILES['foto']['name'][$i];
				//$direktori   = 'image/'.$unik.'_'.$nama_file;
				$nama_file_unik   = $unik.'_'.$nama_file;
				}
			}
			
			$tgl_awal1 = jin_date_sql($tgl_awal);
			$tgl_awal2 = jin_date_sql($tgl_akhir);
			
                $query = "SELECT max(no_pameran) as last FROM checklist_pameran WHERE no_pameran LIKE 'CP$hari_ini%'";
                $hasil = mysql_query($query);
                $data  = mysql_fetch_array($hasil);
                $lastNoTransaksi = $data['last'];
                $lastNoUrut = substr($lastNoTransaksi, 6, 3);
                $nextNoUrut = $lastNoUrut + 1;
                $nextNoTransaksi = $hari_ini.sprintf('%03s', $nextNoUrut);

			if (!empty($lokasi_file)) {
				if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
					$msg = "<div class='alert alert-warning alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-warning'></i> Peringatan!</h4>
							File yang diupload harus dengan format JPEG.</div>";
				
				}else{
					
				for ($i=0; $i < $jumlah; $i++) {
					$unik = uniqid();
					$lokasi_file = $_FILES['foto']['tmp_name'][$i];
					$tipe_file   = $_FILES['foto']['type'][$i];
					$nama_file   = $_FILES['foto']['name'][$i];
					//$direktori   = 'image/'.$unik.'_'.$nama_file;
					$nama_file_unik   = $unik.'_'.$nama_file;
					//move_uploaded_file($lokasi_file, "foto_pameran/".$nama_file); 
					UploadPameran($nama_file_unik,$i);
					mysql_unbuffered_query("insert into checklist_pameran_foto (no_pameran,foto_pameran) value ('CP$nextNoTransaksi','$nama_file_unik')");
				}	
					
				//UploadPameran($nama_file_unik);
				
                mysql_unbuffered_query("insert into checklist_pameran (no_pameran, lokasi_pameran, jenis_pameran, periode_pameran_awal, periode_pameran_akhir, waktu_simpan, user_buat, foto_pameran,pic_pameran) 
				values('CP$nextNoTransaksi','$_POST[lokasi_pameran]','$_POST[jenis_pameran]','$tgl_awal1','$tgl_awal2','$today','$_SESSION[namalengkap]','$nama_file_unik','$_POST[pic_pameran]')");
			
				$kueri = mysql_query("select * from standar_keputusan_pameran");
				$sql = $kueri;
				$nomor = 0;
				while($sql = mysql_fetch_array($kueri)){
				
				$nomor += 1; 
				$kategori_kontrol = $_POST['kategori_kontrol'.$nomor];
				$standar_keputusan = $_POST['standar_keputusan'.$nomor];
				if (empty($_POST['penilaian'.$nomor])){
					$penilaian = '';
				}else {
					$penilaian = $_POST['penilaian'.$nomor];
				}
				$keterangan = $_POST['keterangan'.$nomor];
				
				mysql_unbuffered_query("insert into checklist_pameran_detail (id, no_pameran, kategori_kontrol, standar_keputusan, penilaian, keterangan) 
				values('','CP$nextNoTransaksi','$kategori_kontrol','$standar_keputusan','$penilaian','$keterangan')");
					}
				
				
						
				}
				
				
				header("location:../../media_showroom.php?module=checklist_checklist_pameran&status=ok"); 
				
			}else{
				header("location:../../media_showroom.php?module=checklist_checklist_pameran&status=kosong"); 
				}	
				
		}
?>

