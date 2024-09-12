<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=summary_booking_(".$_GET['tgl_awal'].")_sd_(".$_GET['tgl_akhir'].").xls");

?>

<?php
//include "../config/koneksi.php";
include "koneksi.php";

	$qry="select * from booking_service";
							
	$sql=mysql_query("$qry where waktu_booking >= '$_GET[tgl_awal]' and waktu_booking <= '$_GET[tgl_akhir]' group by waktu_booking order by waktu_booking asc");
	//$sql=mysql_query("select * from booking_service where waktu_booking >= '$_GET[tgl_awal]' and waktu_booking <= '$_GET[tgl_akhir]' group by waktu_booking order by waktu_booking asc");

?>

                        <table border = "1">
								<tr>
									<th colspan='10' bgcolor='#bdc3c7'><h3>SUMMARY BOOKING SERVICE</h3></th>
								</tr>
								<tr>
									<th colspan='10' align = "left">Hari/Tanggal : <?php echo substr($_GET['tgl_awal'], 8, 2)."-".substr($_GET['tgl_akhir'], 8, 2) ?> </th>
								</tr>
								<tr>
									<th bgcolor='#ecfof1'>Tanggal</th>
									<th bgcolor='#ecfof1'>Total Booking</th>
									<th bgcolor='#ecfof1'>Total Tidak Datang</th>
									<th bgcolor='#ecfof1'>Total Datang</th>
									<th bgcolor='#ecfof1'>Datang Lebih Awal</th>
									<th bgcolor='#ecfof1'>Datang Tepat Waktu</th>
									<th bgcolor='#ecfof1'>Datang Terlambat</th>
									<th bgcolor='#ecfof1'>Total Reschedule</th>
									<th bgcolor='#ecfof1'>Total Cancel</th>
									<th bgcolor='#ecfof1'>Total Rasio</th>
								</tr>
                    		</thead>
							<tbody>
							<?php
							while ($data = mysql_fetch_array($sql)){
							?>
								<tr align = "center">
									<td>
										<?php 
											//echo substr($data['waktu_booking'],8,2);
											echo $data['waktu_booking'];
										?>
									</td>
									<td>
										<?php
										$query5 = mysql_query("select no_booking from booking_service where waktu_booking ='$data[waktu_booking]' ");
										$tot_boking = mysql_num_rows($query5);
										echo $tot_boking;
										?>	
									</td>
									<td>
										<?php
										$query5 = mysql_query("select *, kedatangan from booking_service where (kedatangan='N' or kedatangan ='') and waktu_booking ='$data[waktu_booking]'"); 
										$tot_tdk_datang = mysql_num_rows($query5);
										echo $tot_tdk_datang;
										
										?>
									</td>
									<td>
										<?php
										//$time_booking = substr($tgl_awal,0,7)."-".$noL;
										$query5 = mysql_query("select kedatangan from booking_service where (kedatangan = 'Y' or kedatangan ='Sudah Service')  and waktu_booking ='$data[waktu_booking]'");
										$tot_datang = mysql_num_rows($query5);
										echo $tot_datang;
										
										?>
									</td>
									<td>
										<?php
												//$time_booking = substr($tgl_awal,0,7)."-".$noL;
												$query5 = mysql_query("select * from booking_service where jam_booking > jam_datang and waktu_booking = '$data[waktu_booking]' and (kedatangan = 'Y' or kedatangan ='Sudah Service') ");
												
												
												$total_lebihawal = 0;
												while ($file = mysql_fetch_array($query5)){
												
													$date_awal  = new DateTime($file['jam_booking']);
													$date_akhir = new DateTime($file['jam_datang']);
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
														if (($file['kedatangan'] == 'Y') or ($file['kedatangan'] == 'Sudah Service')){
														$total_lebihawal = $total_lebihawal + 1;
														}
													}
													
												}
												
												echo $total_lebihawal;
										
											
										?>
									</td>
									<td>
										<?php
											//$time_booking = substr($tgl_awal,0,7)."-".$noL;
											$query5 = mysql_query("select * from booking_service where waktu_booking ='$data[waktu_booking]'");
											
											$total_tepatwaktu = 0;
											while ($file = mysql_fetch_array($query5)){
											
												$date_awal  = new DateTime($file['jam_booking']);
												$date_akhir = new DateTime($file['jam_datang']);
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
													
												}else{
													if (($file['kedatangan'] == 'Y') or ($file['kedatangan'] == 'Sudah Service')){
														$total_tepatwaktu = $total_tepatwaktu + 1;
													}
												}											
											}
											
											echo $total_tepatwaktu;
									
										?>
									</td>
									<td>
										<?php
											//$time_booking = substr($tgl_awal,0,7)."-".$noL;
											$query5 = mysql_query("select * from booking_service where jam_booking < jam_datang and waktu_booking ='$data[waktu_booking]' and kedatangan = 'Y'");
											
											
											$total_terlambat = 0;
											while ($file = mysql_fetch_array($query5)){
											
												$date_awal  = new DateTime($file['jam_booking']);
												$date_akhir = new DateTime($file['jam_datang']);
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
													if (($file['kedatangan'] == 'Y') or ($file['kedatangan'] == 'Sudah Service')){
													$total_terlambat = $total_terlambat + 1;
													}
												}
												
											}
											
											echo $total_terlambat;
									
										
										?>
										
									</td>
									<td>
										<?php
										//$time_booking = substr($tgl_awal,0,7)."-".$noL;
										$query8 = mysql_query("select reschedule from booking_service where reschedule='Y' and waktu_booking ='$data[waktu_booking]'");
										$tot_reschedule = mysql_num_rows($query8);
										echo $tot_reschedule;
										
										?>
									</td>
									<td>
									<?php
										$tot_cancel = $tot_tdk_datang - $tot_reschedule;
										echo $tot_cancel;
									?>
									</td>
									<td>
										<?php
											$rasio = ($tot_datang*100)/$tot_boking;
											if ($rasio > 80){
												echo "<div class='label  label-success'>".round($rasio)."%</div>";
											}else if($rasio <= 50){
												echo "<div class='label  label-danger'>".round($rasio)."%</div>";
											}else{
												echo "<div class='label  label-warning'>".round($rasio)."%</div>";
											}
										?>
									</td>	
								</tr>
								
							<?php
							}
							?>
								<tr align = "center">
									<td bgcolor="#ecfof1"><b>TOTAL</b></td>
									<td bgcolor="#ecfof1">
										<?php
											$query5 = mysql_query("select count(no_booking) as total_booking from booking_service where waktu_booking >='$_GET[tgl_awal]' and waktu_booking <='$_GET[tgl_akhir]'");
											$total_booking = mysql_fetch_array($query5);
											echo $total_booking['total_booking'];
										?>
									</td>
									<td bgcolor="#ecfof1">
										<?php
											$query5 = mysql_query("select count(kedatangan) as total_tdkkedatangan from booking_service where (kedatangan = 'N' or kedatangan ='') and waktu_booking >='$_GET[tgl_awal]' and waktu_booking <='$_GET[tgl_akhir]'");
											$total_tdkkedatangan = mysql_fetch_array($query5);
											echo $total_tdkkedatangan['total_tdkkedatangan'];
										?>
									</td>
									<td bgcolor="#ecfof1">
										<?php
											$query5 = mysql_query("select count(kedatangan) as total_kedatangan from booking_service where (kedatangan = 'Y' or kedatangan ='Sudah Service') and waktu_booking >='$_GET[tgl_awal]' and waktu_booking <='$_GET[tgl_akhir]'");
											$total_kedatangan = mysql_fetch_array($query5);
											echo $total_kedatangan['total_kedatangan'];
											
										?>
									</td>
								
																
									<td bgcolor="#ecfof1">
									<?php
										
										$query5 = mysql_query("select * from booking_service where jam_booking > jam_datang and jam_booking != '00:00:00' and (kedatangan = 'Y' or kedatangan = 'Sudah Service') and waktu_booking >='$_GET[tgl_awal]' and waktu_booking <='$_GET[tgl_akhir]'");
										
										$tot_lebihawal = 0;
											while ($data = mysql_fetch_array($query5)){
											
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
													if ($data['kedatangan'] == 'Y' or $data['kedatangan'] == 'Sudah Service'){
													$tot_lebihawal = $tot_lebihawal + 1;
													}
												}
												
											}
											
											echo $tot_lebihawal;
										
									?>	
								</td>
									<td bgcolor="#ecfof1">
									<?php
										
											$query5 = mysql_query("select * from booking_service where jam_booking != '00:00:00' and waktu_booking >='$_GET[tgl_awal]' and waktu_booking <='$_GET[tgl_akhir]'");
											
											$tot_tepatwaktu = 0;
											while ($data = mysql_fetch_array($query5)){
											
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
													
												}else{
													if ($data['kedatangan'] == 'Y' or $data['kedatangan'] == 'Sudah Service'){
														$tot_tepatwaktu = $tot_tepatwaktu + 1;
													}
												}											
											}
											
											echo $tot_tepatwaktu;
								
									?>	
								</td>
							
									<td bgcolor="#ecfof1">
									<?php
										$query5 = mysql_query("select * from booking_service where jam_booking < jam_datang and  waktu_booking >='$_GET[tgl_awal]' and waktu_booking <='$_GET[tgl_akhir]'");
										
										$tot_terlambat = 0;
											while ($data = mysql_fetch_array($query5)){
											
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
													if ($data['kedatangan'] == 'Y' or $data['kedatangan'] == 'Sudah Service'){
													$tot_terlambat = $tot_terlambat + 1;
													}
												}
												
											}
											
											echo $tot_terlambat;
										
									?>	
								</td>
								
								<td bgcolor="#ecfof1">
									<?php
									$query5 = mysql_query("select count(reschedule) as total_reschedule from booking_service where reschedule='Y' and waktu_booking >='$_GET[tgl_awal]' and waktu_booking <='$_GET[tgl_akhir]'");
									$total_reschedule = mysql_fetch_array($query5);
									echo $total_reschedule['total_reschedule'];
									
									?>
								</td>
								<td bgcolor="#ecfof1">
								<?php
									$total_cancel = $total_tdkkedatangan['total_tdkkedatangan'] - $total_reschedule['total_reschedule'];
									echo $total_cancel;
								?>
								</td>
								<td bgcolor="#ecfof1">
									<?php
										$totrasio = ($total_kedatangan['total_kedatangan']*100)/$total_booking['total_booking'];
										if ($totrasio > 80){
											echo "<div class='label  label-success'>".round(substr($totrasio,0,6))."%</div>";
										}else if($totrasio <= 50){
											echo "<div class='label  label-danger'>".round(substr($totrasio,0,6))."%</div>";
										}else{
											echo "<div class='label  label-warning'>".round(substr($totrasio,0,6))."%</div>";
										}
									?>
									</td>
								</tr>
							</tbody>
                        </table>