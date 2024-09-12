<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=summary_permohonan_unit_keluar_(".$_GET['tgl_awal'].")_sd_(".$_GET['tgl_akhir'].").xls");

?>

<?php
include "../../config/koneksi.php";
include "../../config/koneksi_service.php";
include "../../config/koneksi_sqlserver.php";
//include "koneksi.php";
		$nomor = 0;
		//$tgl_doank2 = $tgl_doank - 0;
			$query = mysql_query("select * from unit_keluar where substr(waktu_keluar,1,11) >= '$_GET[tgl_awal]' and substr(waktu_keluar,1,11) <= '$_GET[tgl_akhir]' order by waktu_keluar desc",$koneksi_showroom);
																		
			

			
?>

                        <table border = "1">
								<tr>
									<th colspan='16' bgcolor='#bdc3c7'><h3>SUMMARY PERMOHONAN UNIT KELUAR</h3></th>
								</tr>
								<tr>
									<!--th colspan='30' align = "left">Hari/Tanggal : <?php echo substr($_GET['tgl_awal'], 8, 2)." sampai ".substr($_GET['tgl_akhir'], 8, 2) ?> </th-->
									<th colspan='16' align = "left">Hari/Tanggal : <?php echo $_GET['tgl_awal']." sampai ".$_GET['tgl_akhir'] ?> </th>
								</tr>
									<tr>
										<td bgcolor='#bdc3c7' width="30" height="29"><b>No</td>
										<td bgcolor='#bdc3c7'><b>No PUK</td>												
										<td bgcolor='#bdc3c7'><b>No SPK</td>
										<td bgcolor='#bdc3c7'><b>Nama Customer</td>
										<td bgcolor='#bdc3c7'><b>Type Mobil</td>												
										<td bgcolor='#bdc3c7'><b>Warna Mobil</td>
										<td bgcolor='#bdc3c7'><b>Salesman</td>
										<td bgcolor='#bdc3c7'><b>Supervisor</td>
										<td bgcolor='#bdc3c7'><b>No Rangka</td>
										<td bgcolor='#bdc3c7'><b>No Mesin</td>
										<td bgcolor='#bdc3c7'><b>Tanggal Keluar</td>																				
										<td bgcolor='#bdc3c7'><b>Jam Keluar</td>																				
										<td bgcolor='#bdc3c7'><b>Keterangan</td>
										<td bgcolor='#bdc3c7'><b>Input Pada</td>
										<td bgcolor='#bdc3c7'><b>Status Approved</td>
										<td bgcolor='#bdc3c7'><b>Tanggal PUK Awal</td>
									</tr>
                    		</thead>
							<tbody>
								<?php
								
									while($data_puk = mysql_fetch_array($query)){
									$nomor += 1;
									$query2 = "select NomorSpk,NoRangka,NamaTipe,NamaWarna,NoMesin, NamaSalesman, NamaCustomer from vw_PukSOS SPK where NomorSPK = '$data_puk[no_spk]'";
									$query3 = sqlsrv_query($conn, $query2);
									while($data_detail = sqlsrv_fetch_array($query3)){ 
								?>
								<tr>
									<td width='100dp'><?php echo $nomor ?></td>
									<td><?php  echo  $data_puk['no_puk']; ?></td>
									<td><?php  echo  $data_puk['no_spk']; ?></td>
									<td align='center' valign='middle'><?php  echo  $data_detail['NamaCustomer']; ?></td>
									<td><?php  echo  $data_detail['NamaTipe']; ?></td>
									<td><?php  echo  $data_detail['NamaWarna']; ?></td>
									<td align='center'><?php  echo  $data_detail['NamaSalesman']; ?></td>
									<td align='center'><?php  echo  $data_puk['kd_spv']; ?></td>
									<td align='center'><?php  echo  $data_puk['norangka']; ?></td>
									<td align='center'><?php  echo  $data_detail['NoMesin']; ?></td>
									<td align='center'><?php  echo  substr($data_puk['waktu_keluar'],0,10); ?></td>
									<td align='center'><?php  echo  substr($data_puk['waktu_keluar'],11,8); ?></td>
									<td align='center'><?php  echo  $data_puk['keterangan']; ?></td>
									<td align='center'><?php  echo  $data_puk['input']; ?></td>
									<td align='center'>
										<?php 
											if ($data_puk['status_approved'] == 'MNGR_APP'){
												$hasil = 'SALES MANAGER';
											}else if ($data_puk['status_approved'] == 'FIN_APP'){
												$hasil = 'FINANCE MANAGER';
											}else if ($data_puk['status_approved'] == 'SPV_APP'){
												$hasil = 'SUPERVISOR';
											}else if ($data_puk['status_approved'] == 'ADM_APP'){
												$hasil = 'SALES ADMIN';
											}else if ($data_puk['status_approved'] == 'N'){
												if($data_puk['spv_app'] == 'N'){
													$hasil ='TIDAK DI SETUJUI SUPERVISOR';
												}else if($data_puk['mngr_app'] == 'N'){
													$hasil ='TIDAK DI SETUJUI SALES MANAGER';
												}else if($data_puk['salesadm_app'] == 'N'){
													$hasil ='TIDAK DI SETUJUI SALES ADMIN';
												}else if($data_puk['mngr_finance_app'] == 'N'){
													$hasil ='TIDAK DI SETUJUI MANAGER FINANCE MANAGER';
												}
											}
											echo  $hasil;
										?>
									</td>
									<td align='center'><?php  echo  $data_puk['tanggal_puk_awal']; ?></td>
									
								</tr>
									<?php }} ?>
							</tbody>
                        </table>