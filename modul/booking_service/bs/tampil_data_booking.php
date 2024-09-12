<?php 
	include "koneksi.php";
	
		$tgl = $_POST['data_ajax'];
		$query = mysql_unbuffered_query("SELECT * FROM booking_service where tgl_reschedule = '$tgl' order by jam_booking asc, waktu_input asc");
		$n = 0;
		while($r = mysql_fetch_array($query)){
		$count = mysql_num_rows($query);
		$n = $n+1;
				$id = $r['no'];
				$no_booking = $r['no_booking'];
				$nama = $r['nama_customer'];
				$waktu_booking = $r['tgl_reschedule'];
				$jam_booking = substr($r['jam_reschedule'], 0, 5);
				$no_polisi = $r['no_polisi'];
				$tipe = $r['tipe'];
				$telepon = $r['telepon'];
				$perbaikan = $r['perbaikan'];
				$keterangan = $r['keterangan'];
				if($r['kedatangan'] == "Y"){
					$kedatangan = "<div class='dlt btn btn-xs btn-success'>$r[kedatangan]</div>";
					$reschedule = "<div class='dlt btn btn-xs btn-danger'>$r[reschedule]</div>";
					$act = "<button type='button' id='edit$id' name='edit' class='dlt btn btn-xs btn-success' onclick='edit_modal($id);' data-original-title='Update Data Booking $id' value='$id'>
								<span class='ladda-label'><i class='fa fa-pencil'></i> Lihat Data</span>
							</button>";
					
				}elseif($r['kedatangan'] == "N"){
					if($r['reschedule'] == "Y"){
						$kedatangan = "<div class='dlt btn btn-xs btn-danger'>$r[kedatangan]</div>";
						$reschedule = "<div class='dlt btn btn-xs btn-success'>$r[reschedule]</div>";
						$act = "<button type='button' id='resch$id' name='resch' class='dlt btn btn-xs btn-primary' onclick='resch_modal($id);' data-original-title='Reschedule Data Booking $id' value='$id'>
										<span class='ladda-label'><i class='fa fa-pencil'></i> Reschedule</span>
									</button>";
					}elseif($r['reschedule'] == "N"){
						$kedatangan = "<div class='dlt btn btn-xs btn-danger'>$r[kedatangan]</div>";
						$reschedule = "<div class='dlt btn btn-xs btn-danger'>$r[reschedule]</div>";
						$act = "<button type='button' id='edit$id' name='edit' class='dlt btn btn-xs btn-danger' onclick='edit_modal($id);' data-original-title='Update Data Booking $id' value='$id'>
										<span class='ladda-label'><i class='fa fa-pencil'></i> Lihat Data</span>
									</button>";
					}else{
						$kedatangan = "<div class='dlt btn btn-xs btn-danger'>$r[kedatangan]</div>";
						$reschedule = "";
						$act = "<button type='button' id='edit$id' name='edit' class='dlt btn btn-xs btn-warning' onclick='edit_modal($id);' data-original-title='Update Data Booking $id' value='$id'>
										<span class='ladda-label'><i class='fa fa-pencil'></i> Edit Data</span>
									</button>";
					}
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
				
				$result = "	<tr>
								<td>$n</td>
								<td id='tede' style='text-align:center;' >
									No Polisi : $no_polisi <br>
									Jam Booking : <font style='color: red;'>$jam_booking</font><br>
									$act
								</td>
								<td><b>
									
									Tipe Mobil : $tipe<br>
									Perbaikan : $perbaikan<br>
									Keterangan : $keterangan<br>
								</b></td>
								<td><b>
									No Booking : $no_booking<br>
									Nama Customer : $nama<br>
									Tgl Booking : <font style='color: red;'>$waktu_booking</font><br>
									No Telepon : $telepon
								</b></td>
								
								<td ><b>
									Customer Datang : $kedatangan <br>
									Jam Datang : $jam_datang <br>
									Reschedule : $reschedule <br>
									Keterangan Tidak Datang : $ket_kedatangan
								</b></td>
								
								<td class='hidden-xs'><b>
									User Input : $user <br>
									Waktu Input : $input
								</b></td>
								
							</tr>,";
		

			if($count > 0){
				$count = "ada";
			}else{
				$count = "kosong";
			}
			echo $result.','.$count;
		}


?>
