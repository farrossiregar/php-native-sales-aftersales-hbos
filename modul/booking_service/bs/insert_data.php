<?php
	
	include "koneksi.php";
	date_default_timezone_set('Asia/Jakarta');
	
	
		$no_booking = $_POST['data'];
		$nama = $_POST['data1'];
		$waktu_booking = $_POST['data3'];
		$jam_booking = $_POST['data2'];
		$no_polisi = $_POST['data4'];
		$tipe = $_POST['data5'];
		$telepon = $_POST['data6'];
		$perbaikan = $_POST['data7'];
		$keterangan = $_POST['data8'];
		$user = $_POST['data9'];
		$kedatangan = '';
		$reschedule = '';
		$input = date("Y-m-d H:i:s");
		$tgl_reschedule = $_POST['data3'];
		$i;
		
		if($nama!=''){
			$cek_data = mysql_query("select * from booking_service where jam_booking = '$jam_booking' and waktu_booking = '$waktu_booking'");
			$cek_jumlah_data = mysql_num_rows($cek_data);
			if($cek_jumlah_data < 2){
				
				$today=date("ym");
				$query = "SELECT max(no_booking) as last FROM booking_service WHERE no_booking LIKE 'BS$today%'";
				$hasil = mysql_query($query);
				$data  = mysql_fetch_array($hasil);
				$lastNoTransaksi = $data['last'];
				$lastNoUrut = substr($lastNoTransaksi, 6, 3);
				$nextNoUrut = $lastNoUrut + 1;
				$nextNoTransaksi = "BS".$today.sprintf('%03s', $nextNoUrut);				

			//	echo $nextNoTransaksi;
				
					mysql_unbuffered_query("INSERT INTO booking_service 
					(no_booking, nama_customer, waktu_booking, jam_booking, no_polisi, tipe, telepon, perbaikan, keterangan, kedatangan, reschedule, user_input, waktu_input, tgl_reschedule, jam_reschedule) 
					values 
					('$nextNoTransaksi', '$nama', '$waktu_booking', '$jam_booking', '$no_polisi', '$tipe', '$telepon', '$perbaikan', '$keterangan', '$kedatangan', '$reschedule', '$user', '$input', '$tgl_reschedule', '$jam_booking')");	
					
					
					
					$msg = "<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil Menambah Data.</div>";
					echo $msg;
			//	}
			}else{
					$msg = "<div class='alert alert-warning alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Gagal!</h4>
						Data Sudah Data.</div>";
					echo $msg;
			}
		}
?>