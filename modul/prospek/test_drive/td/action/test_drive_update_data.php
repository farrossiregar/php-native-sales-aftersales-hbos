<?php 
if (count($_POST)){
	include "../../../../config/koneksi.php";
	date_default_timezone_set('Asia/Jakarta');
	
	$action = $_POST['action'];
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
	$rencana_spk = "Y";
	$jenis_customer = $_POST['jenis_customer'];
	$peserta_test_drive = $_POST['peserta_test_drive'];
	$lokasi_test_drive = $_POST['lokasi_test_drive'];
	$rencana_spk = $_POST['rencana_spk'];
	$keterangan_spk = $_POST['keterangan_spk'];
	$input = date("Y-m-d H:i:s");
	
	if($action == '1'){
		$query = mysql_unbuffered_query("UPDATE peminjaman_test_drive SET keterangan_spk = '$keterangan_spk' 
																where no_peminjaman = '$no_peminjaman'");
		$msg = "<div class='alert alert-success alert-dismissable'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<h4><i class='icon fa fa-check'></i> Selamat!".$no_peminjaman."</h4>
			Berhasil Mengubah Data.</div>";
		echo $msg;
	}elseif($action == '2'){
	/*	$query = mysql_unbuffered_query("UPDATE peminjaman_test_drive SET 	nama_customer = '$nama',
																			alamat_customer = '$alamat',
																			no_ktp = '$no_ktp',
																			no_telp = '$telepon',
																			tipe_mobil = '$tipe',
																			tgl_test_drive = '$tanggal_test_drive',
																			jam_test_drive = '$jam_test_drive_awal',
																			estimasi_jam_selesai = '$jam_test_drive_awal',
																			keterangan = '$keterangan',
																			jenis_customer = '$jenis_customer',
																			lokasi_test_drive = '$lokasi_test_drive',
																			peserta_test_drive = '$peserta_test_drive'
																					where no_peminjaman = '$no_peminjaman'");	*/
																					
		$query = mysql_unbuffered_query("UPDATE peminjaman_test_drive SET 	nama_customer = '$nama',
																			alamat_customer = '$alamat',
																			no_ktp = '$no_ktp'
																			
																			where no_peminjaman = '$no_peminjaman'");
			$msg = "<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-check'></i> Selamat!".$no_peminjaman.$nama.$telepon.$alamat.$rencana_spk."</h4>
				Berhasil Mengubah Data.</div>";
			echo $msg;
			
	}else{
		
	}
	
				
		
		
}
?>


