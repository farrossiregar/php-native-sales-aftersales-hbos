<?php
if (count($_POST)){	
	include "../../../../config/koneksi.php";
	date_default_timezone_set('Asia/Jakarta');
	
		$no_peminjaman = $_POST['no_peminjaman'];
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$no_ktp = $_POST['no_ktp'];
		$telepon = $_POST['telepon'];
		$keterangan = $_POST['keterangan'];
		$tipe = $_POST['tipe'];
		$tanggal_test_drive = $_POST['tanggal_test_drive'];
		$jam_test_drive_awal = $_POST['jam_test_drive_awal'];
		$jam_test_drive_akhir = $_POST['jam_test_drive_akhir'];
		$rencana_spk = "";
		$jenis_customer = $_POST['jenis_customer'];
		$peserta_test_drive = $_POST['peserta_test_drive'];
		$lokasi_test_drive = $_POST['lokasi_test_drive'];
		$user_input = $_POST['user_input'];
		$input = date("Y-m-d H:i:s");	

		$i;
		
		if($nama!=''){
			$today=date("ym");
			$query = "SELECT max(no_peminjaman) as last FROM peminjaman_test_drive WHERE no_peminjaman LIKE 'TD$today%'";
			$hasil = mysql_query($query);
			$data  = mysql_fetch_array($hasil);
			$lastNoTransaksi = $data['last'];
			$lastNoUrut = substr($lastNoTransaksi, 6, 3);
			$nextNoUrut = $lastNoUrut + 1;
			$nextNoTransaksi = "TD".$today.sprintf('%03s', $nextNoUrut);	
			
				mysql_unbuffered_query("INSERT INTO peminjaman_test_drive 
				(no_peminjaman, nama_customer, alamat_customer, no_ktp, no_telp, tipe_mobil, tgl_test_drive, jam_test_drive, estimasi_jam_selesai, keterangan, rencana_spk, jenis_customer, lokasi_test_drive, peserta_test_drive, nama_sales, waktu_permohonan) 
				values 
				('$nextNoTransaksi', '$nama', '$alamat', '$no_ktp', '$telepon', '$tipe', '$tanggal_test_drive', '$jam_test_drive_awal', '$jam_test_drive_akhir', '$keterangan',  '$rencana_spk', '$jenis_customer', '$lokasi_test_drive', '$peserta_test_drive', '$user_input', '$input')");	
				
				
				
				$msg = "<div class='alert alert-success alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Selamat!</h4>
						Berhasil Menambah Data.</div>";
				echo $msg;
			
		}
}
?>