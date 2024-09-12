<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=booking_service_(".$_GET['periode_booking'].").xls");

?>

<?php
include "koneksi.php";

	$sql=mysql_query("SELECT * from booking_service where waktu_booking = '$_GET[periode_booking]' order by jam_booking, waktu_input");						
	

?>
			
                        <table border = '1'>
                    		<thead>
								<tr>
									<th colspan='24'><h3>BOOKING SERVICE</h3></th>
								</tr>
								<tr>
									<th colspan='24' align = "left">Hari/Tanggal : <?php echo substr($_GET['periode_booking'], 8, 2)."-".substr($_GET['periode_booking'], 5, 2)."-".substr($_GET['periode_booking'], 0, 4) ?> </th>
								</tr>
								<tr >
									<th>No</th>
									<th>No Booking</th>
									<th>Tanggal Booking</th>
									<th>Nama</th>
									<th>Jam Booking</th>
									<th>No Polisi</th>
									<th>No Rangka</th>
									<th>No Mesin</th>
									<th>Tipe</th>
									<th>Telepon</th>
									<th>Jenis Pekerjaan</th>
									<th>Detail Pekerjaan</th>
									<th>Booking Via</th>
									<th>Keterangan</th>
									<th>Konfirmasi telp</th>
									<th>Konfirmasi Sms</th>
									<th>Kedatangan</th>
									
									<th>Jam Datang</th>
									<th>Ketepatan Waktu</th>
									<th>Selisih Waktu</th>
									<th>Reschedule</th>
									<th>Keterangan Tidak Datang</th>
									<th>User Input</th>
									<th>Waktu Input</th>
								</tr>
							</thead>
                            <tbody>
							
							<?php
								$no = 0;
								while($data = mysql_fetch_array($sql)){
									$no = $no+1;
									
									$date_awal  = new DateTime($data['jam_booking']);
									$date_akhir = new DateTime($data['jam_datang']);
									$selisih = $date_akhir->diff($date_awal);

									$jam = $selisih->format('%h');
									$menit = $selisih->format('%i');
									$detik = $selisih->format('%s');
									 
									 if($menit >= 0 && $menit <= 9){
									   $menit = "0".$menit;
									 }
									 
									$hasil = ($jam == "0" ? "" : "$jam Jam ").$menit." Menit";
									$status_datang ="";
									$selisih_waktu = "";
									if ($jam != 0 or ($jam == 0 and $menit > 16) ){
										if ($data['kedatangan'] == 'Y'){
											if($data['jam_booking'] < $data['jam_datang']){
												$status_datang = "Terlambat";
												$selisih_waktu = "<div class='dlt btn btn-xs btn-danger'>".$hasil."</div>";
												
											}elseif($data['jam_booking'] > $data['jam_datang']){
												$status_datang = "Lebih Awal";
												$selisih_waktu = "<div class='dlt btn btn-xs btn-warning'>".$hasil."</div>";
											}
										}
									}else{
										if ($data['kedatangan'] == 'Y'){
											$status_datang = "Tepat Waktu";
											$selisih_waktu = "$menit";
										}
									}
						    
    						?>
						
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $data['no_booking']; ?></td>
									<td><?php echo $data['waktu_booking']; ?></td>
									<td><?php echo $data['nama_customer']; ?></td>
									<td><?php echo $data['jam_booking']; ?></td>
									<td><?php echo $data['no_polisi']; ?></td>
									<td><?php echo $data['norangka']; ?></td>
									<td><?php echo $data['nomesin']; ?></td>
									<td><?php echo $data['tipe']; ?></td>
									<td><?php echo $data['telepon']; ?></td>
									<td><?php echo $data['jenis_perbaikan']; ?></td>
									<td><?php echo $data['perbaikan']; ?></td>
									<td><?php echo $data['booking_via']; ?></td>
									<?php
										if($data['keterangan'] == ''){
									?>
									<td><?php echo $data['keterangan']; ?></td>
									<?php
										}else{
									?>
									<td><?php echo $data['keterangan']; ?></td>
									<?php
										}
									?>
									<td><?php echo $data['konfirmasi_telp']; ?></td>
									<td><?php echo $data['konfirmasi_sms']; ?></td>
									<td><?php echo $data['kedatangan']; ?></td>
									<td><?php echo ($data['kedatangan'] == "" ? "" :$data['jam_datang']); ?></td>
									<td><?php echo ($data['kedatangan'] == "" ? "" :$status_datang); ?></td>
									<td><?php echo ($data['kedatangan'] == "" ? "" :$selisih_waktu); ?></td>
									<?php
										if($data['reschedule'] == 'Y'){
									?>
									<td bgcolor = "red"><?php echo $data['reschedule']; ?></td>
									<?php
										}else{
									?>
									<td><?php echo $data['reschedule']; ?></td>
									<?php
										}
									?>
									<td><?php echo $data['ket_kedatangan']; ?></td>
									<td><?php echo $data['user_input']; ?></td>
									<td><?php echo $data['waktu_input']; ?></td>
								</tr>
								<?php
									}
								?>		
							</tbody>
                        </table>