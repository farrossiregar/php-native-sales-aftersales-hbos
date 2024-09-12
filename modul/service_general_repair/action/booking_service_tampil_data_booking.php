<?php 
if (count($_POST)){
	include "../../../config/koneksi_service.php";
	date_default_timezone_set('Asia/Jakarta');
		$tgl = $_POST['data_ajax'];
		$query = mysql_unbuffered_query("SELECT * FROM booking_service where waktu_booking = '$tgl' order by jam_booking asc, waktu_input asc");
		$n = 0;
		while($r = mysql_fetch_array($query)){
		$count = mysql_num_rows($query);
		$n = $n+1;
				$id = $r['no'];
				$no_booking = $r['no_booking'];
				$nama = $r['nama_customer'];
				$waktu_booking = $r['waktu_booking'];
				$jam_booking = substr($r['jam_booking'], 0, 5);
				$no_polisi = $r['no_polisi'];
				$tipe = $r['tipe'];
				$telepon = $r['telepon'];
				$perbaikan = $r['perbaikan'];
				$jenisperbaikan = $r['jenis_perbaikan'];
				$keterangan = $r['keterangan'];
				$norangka = $r['norangka'];
				$nomesin = $r['nomesin'];
				$waktu_reschdule = $r['jam_reschedule']." ".$r['tgl_reschedule'];
				$konfirmasi_telp = $r['konfirmasi_telp'];
				$konfirmasi_sms = $r['konfirmasi_sms'];
				
				if($norangka == '' and $nomesin == ''){
					$norangka = "<b class='blink'><font color = 'red'> DATA KOSONG </font></b>";
					$nomesin = "<b class='blink'><font color = 'red'> DATA KOSONG </font></b>";
				}
				if($r['kedatangan'] == "Y"){
					$kedatangan = "<div class='dlt btn btn-xs btn-success'>$r[kedatangan]</div>";
					$reschedule = "<div class='dlt btn btn-xs btn-danger'>$r[reschedule]</div>";
					$act = "<button type='button' id='edit$id' name='edit' class='dlt btn btn-xs btn-success' onclick='edit_modal($id);' data-original-title='Update Data Booking $id' value='$id'>
								<span class='ladda-label'><i class='fa fa-pencil'></i> Datang</span>
							</button>";
					
				}elseif($r['kedatangan'] == "N"){
					if($r['reschedule'] == "Y"){
						$kedatangan = "<div class='dlt btn btn-xs btn-danger'>$r[kedatangan]</div>";
						$reschedule = "<div class='dlt btn btn-xs btn-success'>$r[reschedule]</div>";
					/*	$act = "<button type='button' id='resch$id' name='resch' class='dlt btn btn-xs btn-primary' onclick='resch_modal($id);' data-original-title='Reschedule Data Booking $id' value='$id'>
										<span class='ladda-label'><i class='fa fa-pencil'></i> Reschedule</span>
									</button>";	*/
						$act = "<button type='button' id='edit$id' name='resch' class='dlt btn btn-xs btn-primary' onclick='edit_modal($id);' data-original-title='Reschedule Data Booking $id' value='$id'>
										<span class='ladda-label'><i class='fa fa-pencil'></i> Reschedule</span>
									</button>";
					}elseif($r['reschedule'] == "N"){
						$kedatangan = "<div class='dlt btn btn-xs btn-danger'>$r[kedatangan]</div>";
						$reschedule = "<div class='dlt btn btn-xs btn-danger'>$r[reschedule]</div>";
						$act = "<button type='button' id='edit$id' name='edit' class='dlt btn btn-xs btn-danger' onclick='edit_modal($id);' data-original-title='Update Data Booking $id' value='$id'>
										<span class='ladda-label'><i class='fa fa-pencil'></i> Cancel</span>
									</button>";
					}else{
						$kedatangan = "<div class='dlt btn btn-xs btn-danger'>$r[kedatangan]</div>";
						$reschedule = "";
						$act = "<button type='button' id='edit$id' name='edit' class='dlt btn btn-xs btn-warning' onclick='edit_modal($id);' data-original-title='Update Data Booking $id' value='$id'>
										<span class='ladda-label'><i class='fa fa-pencil'></i> Edit Data</span>
									</button>";
					}
				}elseif($r['kedatangan'] == "Sudah Service"){
					$kedatangan = "<div class='dlt btn btn-xs btn-success'>$r[kedatangan]</div>";
					$act = "<button type='button' id='edit$id' name='edit' class='dlt btn btn-xs btn-info' onclick='edit_modal($id);' data-original-title='Update Data Booking $id' value='$id'>
										<span class='ladda-label'><i class='fa fa-pencil'></i> Sudah Service</span>
									</button>";
				}else{
					$kedatangan = "";
					$reschedule = "";
					$act = "<button type='button' id='edit$id' name='edit' class='dlt btn btn-xs btn-warning' onclick='edit_modal($id);' data-original-title='Update Data Booking $id' value='$id'>
								<span class='ladda-label'><i class='fa fa-pencil'></i> Ubah Status</span>
							</button>";
				}
				$jam_datang = $r['jam_datang'];
			//	$reschedule = $r['reschedule'];
				$ket_kedatangan = $r['ket_kedatangan'];
				$user = $r['user_input'];
				$input = $r['waktu_input'];
				
				
				$date_awal  = new DateTime($jam_booking);
				$date_akhir = new DateTime($jam_datang);
				$selisih = $date_akhir->diff($date_awal);

				$jam = $selisih->format('%h');
				$menit = $selisih->format('%i');
				$detik = $selisih->format('%s');
				 
				 if($menit >= 0 && $menit <= 9){
				   $menit = "0".$menit;
				 }
				 
				$hasil = ($jam == "0" ? "" : "$jam Jam ").$menit." Menit";
				$status_datang ="";
				if ($jam != 0 or ($jam == 0 and $menit > 16) ){
					if($jam_booking < $jam_datang){
						$status_datang = "<div class='dlt btn btn-xs btn-danger'>Terlambat : ".$hasil."</div>";
						
					}elseif($jam_booking > $jam_datang){
						$status_datang = "<div class='dlt btn btn-xs btn-warning'>Lebih Awal : ".$hasil."</div>";
					}
				}else{
					$status_datang = "<div class='dlt btn btn-xs btn-success'>Tepat Waktu</div>";
				}
				
				$reminder = "";
				if ($waktu_booking == date('Y-m-d')){
					if ($jam_booking < date('H:i:s')){
						$date_akhir = new DateTime(date('H:i:s'));
						$selisih = $date_akhir->diff($date_awal);
						
						$jam = $selisih->format('%h');
						$menit = $selisih->format('%i');
						if ($jam != 0 or ($jam == 0 and $menit > 15) ){
							$reminder = "<div class='blink text-danger'><b>MELEBIHI WAKTU BOOKING</b></div>";
						}
					}
				}
				
				$result = "	<tr>
								<td>$n</td>
								<td width='15%' id='tede' style='text-align:center;' >
									NoPol : <b>$no_polisi</b> <br>
									Jam Booking : <font style='color: red;'>$jam_booking</font><br>
									 ".
									($r['kedatangan'] == "" ? $act : "" )." 
									
								</td>
								<td ><b>
									".($r['kedatangan'] == "Y" || $r['kedatangan'] == "Sudah Service" ? " $act $status_datang <br>
									$jam_datang" : ($r['kedatangan'] == "N" ? $act : "")).($r['kedatangan'] == "" ? $reminder : "" )."  
								</b></td>
								<td><b>
									
									Perbaikan : $jenisperbaikan/$perbaikan<br>
									
									".($r['konfirmasi_sms'] != '' || $r['konfirmasi_telp'] != '' ? "" : "<div class='blink text-danger'><b>Belum Konfirmasi H-1</b></div>")."
								</b></td>
								<td><b>
									
									Nama Customer : $nama<br>
									
									No Telepon : $telepon
								</b></td>
								
								
								
								<td class='hidden-xs'><b>
									User Input : $user <br>
									Keterangan : $keterangan<br>
								</b></td>
								
							</tr>,";
		

			if($count > 0){
				$count = "ada";
			}else{
				$count = "kosong";
			}
			echo $result.','.$count;
		}

}
?>
