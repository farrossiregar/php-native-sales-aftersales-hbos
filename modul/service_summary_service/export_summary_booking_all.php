<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=summary_booking_all_(".$_GET['tgl_awal'].")_sd_(".$_GET['tgl_akhir'].").xls");

?>

<?php
//include "../config/koneksi.php";
include "koneksi.php";

	$qry="select * from booking_service";
							
	$sql=mysql_query("$qry where waktu_booking >= '$_GET[tgl_awal]' and waktu_booking <= '$_GET[tgl_akhir]' order by waktu_booking, jam_booking asc");
	//$sql=mysql_query("select * from booking_service where waktu_booking >= '$_GET[tgl_awal]' and waktu_booking <= '$_GET[tgl_akhir]' group by waktu_booking order by waktu_booking asc");

?>

                        <table border = "1">
								<tr>
									<th colspan='22' bgcolor='#bdc3c7'><h3>SUMMARY BOOKING SERVICE</h3></th>
								</tr>
								<tr>
									<th colspan='22' align = "left">Hari/Tanggal : <?php echo substr($_GET['tgl_awal'], 8, 2)."-".substr($_GET['tgl_akhir'], 8, 2) ?> </th>
								</tr>
								<tr>
									
									<td bgcolor='#ecfof1' width="30" height="29">NO</th>
									<th bgcolor='#ecfof1'>No Booking</th>											
									<th bgcolor='#ecfof1'>Tanggal Booking</th>
									<th bgcolor='#ecfof1'>Nama</th>
									<th bgcolor='#ecfof1'>Jam Booking</th>
									<th bgcolor='#ecfof1'>No Polisi</th>												
									<th bgcolor='#ecfof1'>No Rangka</th>
									<th bgcolor='#ecfof1'>No Mesin</th>
									<th bgcolor='#ecfof1'>Tipe</th>
									<th bgcolor='#ecfof1'>Telephone</th>
									<th bgcolor='#ecfof1'>Jenis Pekerjaan</th>												
									<th bgcolor='#ecfof1'>Detail Pekerjaan</th>
									<th bgcolor='#ecfof1'>Booking Via</th>
									<th bgcolor='#ecfof1'>Keterangan</th>
									<th bgcolor='#ecfof1'>Konfirmasi Telp</th>												
									<th bgcolor='#ecfof1'>Konfirmasi Sms</th>
									<th bgcolor='#ecfof1'>Kedatangan</th>
									<th bgcolor='#ecfof1'>Jam Datang</th>																				
									<th bgcolor='#ecfof1'>Reschedule</th>												
									<th bgcolor='#ecfof1'>Keterangan Tidak Datang</th>
									<th bgcolor='#ecfof1'>User Input</th>
									<th bgcolor='#ecfof1'>Waktu Input</th>
								</tr>
                    		</thead>
							<tbody>
							<?PHP
								$nomor = 1;
								while ($data = mysql_fetch_array($sql)){
							?>
								<tr>
										<td><?php echo $nomor; ?></td>	
										<td><?php echo $data['no_booking'] ?></td>	
										<td><?php echo $data['waktu_booking'] ?></td>
										<td><?php echo $data['nama_customer'] ?></td>
										<td><?php echo $data['jam_booking'] ?></td>
										<td><?php echo $data['no_polisi'] ?></td>
										<td><?php echo $data['norangka'] ?></td>
										<td><?php echo $data['nomesin'] ?></td>	
										<td><?php echo $data['tipe'] ?></td>
										<td><?php echo $data['telepon'] ?></td>
										<td><?php echo $data['jenis_perbaikan'] ?></td>
										<td><?php echo $data['perbaikan'] ?></td>	
										<td><?php echo $data['booking_via'] ?></td>
										<td><?php echo $data['keterangan'] ?></td>
										<td><?php echo $data['konfirmasi_telp'] ?></td>
										<td><?php echo $data['konfirmasi_sms'] ?></td>	
										<td><?php echo $data['kedatangan'] ?></td>
										<td><?php echo $data['jam_datang'] ?></td>	
										<td><?php echo $data['reschedule'] ?></td>
										<td><?php echo $data['ket_kedatangan'] ?></td>
										<td><?php echo $data['user_input'] ?></td>
										<td><?php echo $data['waktu_input'] ?></td>
								</tr>			
										
							<?php
							$nomor ++;
								}
							?>
							
							</tbody>
                        </table>