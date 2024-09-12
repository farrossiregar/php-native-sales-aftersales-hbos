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
		$jenis_perbaikan = $_POST['data10'];
		$norangka = $_POST['data11'];
		$nomesin = $_POST['data12'];
		$kedatangan = '';
		$reschedule = '';
		$booking_via = $_POST['data13'];
		
		$tgl = $waktu_booking;
		
		$day = $_POST['nama_hari'];
		
		$input = date("Y-m-d H:i:s");
		$tgl_reschedule = '0000-00-00';
		$i;
		
		if ($booking_via == 'LAIN-LAIN'){
			$booking_via = $_POST['data14'];
			
		}
		if($nama!='' and $no_polisi !='' and $waktu_booking !='' and ($perbaikan!='null' and $perbaikan!='') and ($booking_via != '' and $booking_via != 'null') and $jenis_perbaikan !='' and $telepon !='' ){
			
			if($jam_booking == '00:00:10'){
				$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-close'></i> Gagal!</h4>
							Jam booking belum diisi</div>";
							
						$data = array('status'=>"Kosong",'pesan'=>$msg);
						echo json_encode($data);

				return false;
			}
			
			
			
			
			if($jam_booking == '00:00:00'){
				$today=date("ym");
					$query = "SELECT max(no_booking) as last FROM booking_service WHERE no_booking LIKE 'BS$today%'";
					$hasil = mysql_query($query);
					$data  = mysql_fetch_array($hasil);
					$lastNoTransaksi = $data['last'];
					$lastNoUrut = substr($lastNoTransaksi, 6, 4);
					$nextNoUrut = $lastNoUrut + 1;
					$nextNoTransaksi = "BS".$today.sprintf('%04s', $nextNoUrut);				

				//	echo $nextNoTransaksi;
					
							mysql_unbuffered_query("INSERT INTO booking_service 
						(no_booking, nama_customer, waktu_booking, jam_booking, no_polisi, tipe, telepon, perbaikan, keterangan, kedatangan, reschedule, user_input, waktu_input, tgl_reschedule, jam_reschedule, norangka, nomesin, jenis_perbaikan,booking_via) 
						values 
						('$nextNoTransaksi', '$nama', '$waktu_booking', '$jam_booking', '$no_polisi', '$tipe', '$telepon', '$perbaikan', '$keterangan', '$kedatangan', '$reschedule', '$user', '$input', '$tgl_reschedule', '00:00:00', '$norangka', '$nomesin', '$jenis_perbaikan','$booking_via')");	
						
						
						
						$msg = "<div class='alert alert-success alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								<h4><i class='icon fa fa-check'></i> Selamat!</h4>
								Berhasil Menambah Data.</div>";
						
						
						$double = "TIDAK";
						
						$data = array('status'=>$double,'pesan'=>$msg);
						echo json_encode($data);
			}else{
				$cek_data = mysql_query("select * from booking_service where jam_booking = '$jam_booking' and waktu_booking = '$waktu_booking' and reschedule != 'Y' ");
				$cek_jumlah_data = mysql_num_rows($cek_data);
				if($cek_jumlah_data < 4){
					
					
					
					
					
					if ($jenis_perbaikan == 'QS'){
						if ($day == 'Mon' or $day == 'Tue' or $day == 'Wed' or $day == 'Thu' or $day == 'Fri'){
							$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan = 'QS' and hari = 'Mon-Fri' and jam = '$jam_booking' ");
						}
						elseif ($day == 'Sat'){
							$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan = 'QS' and hari = 'Sat' and jam = '$jam_booking' ");
						}
					}
					
					
					if ($jenis_perbaikan == 'PM'){
						if ($day == 'Mon' or $day == 'Tue' or $day == 'Wed' or $day == 'Thu' or $day == 'Fri' ){
							$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan = 'PM' and hari = 'Mon-Fri' and jam = '$jam_booking' ");
						}
						elseif ($day == 'Sat' ){
							$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan = 'PM' and hari = 'Sat' and jam = '$jam_booking' ");
						}
					}
					
					
					if ($jenis_perbaikan == 'REPAIR'){
						if ($day == 'Mon' or $day == 'Tue' or $day == 'Wed' or $day == 'Thu' or $day == 'Fri' ){
							$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan = 'REPAIR' and hari = 'Mon-Fri' and jam = '$jam_booking' ");
						}
						elseif ($day == 'Sat'){
							$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan = 'REPAIR' and hari = 'Sat' and jam = '$jam_booking' ");
						}
					}
					
					
					
					
					if ($jenis_perbaikan == 'PUD'){
						if ($day == 'Mon' or $day == 'Tue' or $day == 'Wed' or $day == 'Thu' or $day == 'Fri' ){
							$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan != 'QS' group by jam ");
						}
						if ($day == 'Sat'){
							$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan != 'QS' and hari = 'sat' group by jam");
						}
						
						if ($day == 'Sun'){
							
						}else{
							
						
							
								
								$query_total_pud = mysql_query("select count(jam_booking) as total_booking from booking_service where waktu_booking = '$tgl' and jenis_perbaikan = 'PUD' and reschedule != 'Y' ");
								$data_total_pud = mysql_fetch_array($query_total_pud);
								
								$query_quota = mysql_query("select sum(quota) as total from booking_service_parameterjam where hari = '$day' and jam = '$jam_booking' ");
								$data_quota = mysql_fetch_array($query_quota);
								
								$vacancy = mysql_query("select count(jam_booking) as total_booking from booking_service where waktu_booking = '$tgl' and jam_booking = '$jam_booking' and jenis_perbaikan = 'PUD' and reschedule != 'Y' ");
								$data = mysql_fetch_array($vacancy);
								
								$query_total_perjam = mysql_query("select count(jam_booking) as total_perjam from booking_service where waktu_booking = '$tgl' and jam_booking = '$jam_booking' and reschedule != 'Y' ");
								$data_total_perjam = mysql_fetch_array($query_total_perjam);
								
								if ($data_total_pud['total_booking'] >= 10){
									$double = "YA";
									
								}else{
									if($data['total_booking'] < 1 and $data_total_perjam['total_perjam'] < 4 ){
										$double = "TIDAK";
									}else{
										$double = "YA";
									}
								}
								
						}
						
					}else{
					
						if ($day == 'Sun'){
							
								$vacancy = mysql_query("select count(jam_booking) as total_booking from booking_service where waktu_booking = '$tgl' and jam_booking = '$jam_booking' ");
								$data = mysql_fetch_array($vacancy);
								
								if($data['total_booking'] < 2){
									$double = "TIDAK";
								}else{
									$double = "YA";
								}
							
							
						}else{
					
							while ($data_jam = mysql_fetch_array($query)){
								
								$query_quota = mysql_query("select sum(quota) as total_quota from booking_service_parameterjam where hari = '$data_jam[hari]' and jam = '$data_jam[jam]' ");
								$data_quota = mysql_fetch_array($query_quota);
								
								$query_total_recod_perjam = mysql_query("select count(jam_booking) as total_booking_jam from booking_service where waktu_booking = '$tgl' and jam_booking = '$data_jam[jam]' and reschedule !='Y' ");
								$data_total_recod_perjam = mysql_fetch_array($query_total_recod_perjam);
								
								
								$vacancy = mysql_query("select count(jam_booking) as total_booking from booking_service where waktu_booking = '$tgl' and jam_booking = '$data_jam[jam]' and jenis_perbaikan = '$data_jam[jenis_perbaikan]' and reschedule !='Y' ");						
							
								
								$data = mysql_fetch_array($vacancy);
								
								if ($data_total_recod_perjam['total_booking_jam'] >= $data_quota['total_quota']){
									$double = "YA";
									
								}else{
									if($data['total_booking'] < $data_jam['quota']){
										$double = "TIDAK";
										$totalan = $data['total_booking'];
									}else{
										$double = "YA";
										$totalan = $data['total_booking'];
									}	
								}
							}
						}
					
					}
					
					
					if ($double == "YA"){
						$msg = "<div class='alert alert-warning alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Gagal!</h4>
							Data Booking pada periode ini Sudah Full </div>";
							
						$data = array('status'=>$double,'pesan'=>$msg);
						echo json_encode($data);
						
					}else{
					
					
					
						$today=date("ym");
						$query = "SELECT max(no_booking) as last FROM booking_service WHERE no_booking LIKE 'BS$today%'";
						$hasil = mysql_query($query);
						$data  = mysql_fetch_array($hasil);
						$lastNoTransaksi = $data['last'];
						$lastNoUrut = substr($lastNoTransaksi, 6, 4);
						$nextNoUrut = $lastNoUrut + 1;
						$nextNoTransaksi = "BS".$today.sprintf('%04s', $nextNoUrut);				

					//	echo $nextNoTransaksi;
					
						mysql_unbuffered_query("INSERT INTO booking_service 
						(no_booking, nama_customer, waktu_booking, jam_booking, no_polisi, tipe, telepon, perbaikan, keterangan, kedatangan, reschedule, user_input, waktu_input, tgl_reschedule, jam_reschedule, norangka, nomesin, jenis_perbaikan,booking_via) 
						values 
						('$nextNoTransaksi', '$nama', '$waktu_booking', '$jam_booking', '$no_polisi', '$tipe', '$telepon', '$perbaikan', '$keterangan', '$kedatangan', '$reschedule', '$user', '$input', '$tgl_reschedule', '00:00:00', '$norangka', '$nomesin', '$jenis_perbaikan','$booking_via')");	
						
						
						
						$msg = "<div class='alert alert-success alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								<h4><i class='icon fa fa-check'></i> Selamat!</h4>
								Berhasil Menambah Data.</div>";
						$data = array('status'=>$double,'pesan'=>$msg);
						echo json_encode($data);
				//	}
				
				
					}
				
				}else{
						$msg = "<div class='alert alert-warning alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-close'></i> Gagal!</h4>
							Data Booking pada periode ini Sudah Full.</div>";
						
						$data = array('status'=>$double,'pesan'=>$msg);
						echo json_encode($data);
				}
			}
		}else{
			$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-close'></i> Gagal!</h4>
							Inputan data tidak Lengkap !!!!</div>";
							
						
						
						$data = array('status'=>"Kosong",'pesan'=>$msg);
						echo json_encode($data);
			
		}
?>