
<?php 
	session_start();
	
	include "koneksi.php";
	date_default_timezone_set('Asia/Jakarta');
	$user = $_SESSION['username'];
	
	$no_booking = $_POST['data_update'];
	$nama = $_POST['data1'];
	$waktu_booking = $_POST['data3'];
	$jam_booking = $_POST['data2'];
	$no_polisi = $_POST['data4'];
	$tipe = $_POST['data5'];
	$telepon = $_POST['data6'];
	$perbaikan = $_POST['data7'];
	$keterangan = $_POST['data8'];
	$kedatangan = $_POST['data9'];
	//$waktu_kedatangan = $_POST['data10'];
	$waktu_kedatangan = date('H:i:s');
	$reschedule = $_POST['data11'];
	$ket_tidak_datang = $_POST['data12'];
	$input = date("Y-m-d H:i:s");
	$norangka = $_POST['data13'];
	$nomesin = $_POST['data14'];
	$jam_reschedule = $_POST['data15'];
	$tgl_reschedule = $_POST['data16'];
	$user = $_POST['data17'];
	$jenis_perbaikan = $_POST['data18'];
	
	$booking_via = $_POST['data_booking_via'];
	
	if ($booking_via == "LAIN-LAIN"){
		$booking_via =  $_POST['data_lainlain'];
	}
	
	$msg = "<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-check'></i> Selamat!</h4>
				Berhasil Mengubah Data.</div>";
	
		if ($_SESSION['leveluser'] == "admin" or $_SESSION['leveluser'] == "CCO"){
			
			if($nama!='' and $no_polisi !='' and $waktu_booking !='' and ($perbaikan!='null' and $perbaikan!='') and ($booking_via != '' and $booking_via != 'null') and $jenis_perbaikan !='' and $telepon !='' ){
				if ($kedatangan == 'Y' or $kedatangan == 'Sudah Service'){
					$query = mysql_unbuffered_query("UPDATE booking_service SET kedatangan = '$kedatangan', 
																		jam_datang = '$waktu_kedatangan', 
																		reschedule = '$reschedule', 
																		ket_kedatangan = '$ket_tidak_datang', 
																		norangka = '$norangka', 
																		nomesin = '$nomesin',
																		keterangan = '$keterangan',
																		konfirmasi_telp = '$_POST[data_konfirmasi_telp]',
																		waktu_booking = '$waktu_booking',
																		jam_booking = '$jam_booking',
																		jenis_perbaikan = '$jenis_perbaikan',
																		perbaikan = '$perbaikan',
																		booking_via = '$booking_via',
																		user_update = '$user',
																		konfirmasi_sms = '$_POST[data_konfirmasi_sms]'
																		where no_booking = '$no_booking'");
																	
				}else{
					$query = mysql_unbuffered_query("UPDATE booking_service SET kedatangan = '$kedatangan',																		
																		reschedule = '$reschedule', 
																		ket_kedatangan = '$ket_tidak_datang', 
																		norangka = '$norangka', 
																		nomesin = '$nomesin',
																		keterangan = '$keterangan',
																		konfirmasi_telp = '$_POST[data_konfirmasi_telp]',
																		waktu_booking = '$waktu_booking',
																		jam_booking = '$jam_booking',
																		jenis_perbaikan = '$jenis_perbaikan',
																		perbaikan = '$perbaikan',
																		booking_via = '$booking_via',
																		user_update = '$user',
																		konfirmasi_sms = '$_POST[data_konfirmasi_sms]'
																		where no_booking = '$no_booking'");
					
				}
				
				$data = array('status'=>"OK",'pesan'=>$msg);
				echo json_encode($data);
				
			}else{
				
				
				$msg = "<div class='alert alert-danger alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-close'></i> Gagal!</h4>
				Inputan data tidak lengkap.</div>";
				
				$data = array('status'=>"Kosong",'pesan'=>$msg);
				
				echo json_encode($data);
			}
		
		}else{
			$query = mysql_unbuffered_query("UPDATE booking_service SET kedatangan = '$kedatangan', 
																	jam_datang = '$waktu_kedatangan', 
																	reschedule = '$reschedule', 
																	ket_kedatangan = '$ket_tidak_datang', 
																	norangka = '$norangka', 
																	nomesin = '$nomesin',
																	keterangan = '$keterangan'
																	where no_booking = '$no_booking'");
			
			
				
				$data = array('status'=>"OK",'pesan'=>$msg);
				echo json_encode($data);
			
		}
		
		if($reschedule == 'Y'){
				$today=date("ym");
					$query = "SELECT max(no_booking) as last FROM booking_service WHERE no_booking LIKE 'BS$today%'";
					$hasil = mysql_query($query);
					$data  = mysql_fetch_array($hasil);
					$lastNoTransaksi = $data['last'];
					$lastNoUrut = substr($lastNoTransaksi, 6, 4);
					$nextNoUrut = $lastNoUrut + 1;
					$nextNoTransaksi = "BS".$today.sprintf('%04s', $nextNoUrut);
					
					mysql_unbuffered_query("INSERT INTO booking_service 
					(no_booking, nama_customer, waktu_booking, jam_booking, no_polisi, tipe, telepon, perbaikan, keterangan, kedatangan, jam_datang, reschedule, ket_kedatangan, user_input, waktu_input, tgl_reschedule, jam_reschedule, norangka, nomesin, jenis_perbaikan,booking_via) 
					values 
					('$nextNoTransaksi', '$nama', '$tgl_reschedule', '$jam_reschedule', '$no_polisi', '$tipe', '$telepon', '$perbaikan', '$keterangan', '', '', '', '', '$user', '$input', '0000-00-00', '00:00:00', '$norangka', '$nomesin', '$jenis_perbaikan','$booking_via')");
					
/*
					$query = mysql_unbuffered_query("UPDATE booking_service SET kedatangan = 'N', 
																				jam_datang = '$waktu_kedatangan', 
																				reschedule = '$reschedule', 
																				ket_kedatangan = '$ket_tidak_datang', 
																				tgl_reschedule = '$tgl_reschedule', 
																				jam_reschedule = '$jam_reschedule', 
																				norangka = '$norangka', 
																				nomesin = '$nomesin', 
																				keterangan = '$keterangan'
																				where no_booking = '$no_booking'");
																				*/
		}	
	
	
		
	
?>


