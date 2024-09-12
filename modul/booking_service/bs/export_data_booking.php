<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=booking_service_(".$_GET['periode_booking'].").xls");

?>

<?php
include "koneksi.php";

	$sql=mysql_query("SELECT * from booking_service where waktu_booking = '$_GET[periode_booking]' order by jam_booking");						
	

?>
			
                        <table  class="table table-striped table-bordered table-hover table-full-width">
                    		<thead>
								<tr>
									<th colspan='14'><h3>DATA BOOKING SERVICE TANGGAL <?php echo $_GET['periode_booking'] ?> </h3></th>
								</tr>
								<tr>
									<th colspan='14'></th>
								</tr>
								<tr >
									<th>No</th>
									<th>No Booking</th>
									<th>Nama</th>
									<th>Tanggal Booking</th>
									<th>Jam</th>
									<th>No Polisi</th>
									<th>Tipe</th>
									<th>Telepon</th>
									<th>Perbaikan</th>
									<th>Keterangan</th>
									<th>Kedatangan</th>
									<th>Jam Datang</th>
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
						    
    						?>
						
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $data['no_booking']; ?></td>
									<td><?php echo $data['nama_customer']; ?></td>
									<td><?php echo $data['waktu_booking']; ?></td>
									<td><?php echo $data['jam_booking']; ?></td>
									<td><?php echo $data['no_polisi']; ?></td>
									<td><?php echo $data['tipe']; ?></td>
									<td><?php echo $data['telepon']; ?></td>
									<td><?php echo $data['perbaikan']; ?></td>
									<td><?php echo $data['keterangan']; ?></td>
									<td><?php echo $data['kedatangan']; ?></td>
									<td><?php echo $data['jam_datang']; ?></td>
									<td><?php echo $data['reschedule']; ?></td>
									<td><?php echo $data['ket_kedatangan']; ?></td>
									<td><?php echo $data['user_input']; ?></td>
									<td><?php echo $data['waktu_input']; ?></td>
								</tr>
								<?php
									}
								?>		
							</tbody>
                        </table>