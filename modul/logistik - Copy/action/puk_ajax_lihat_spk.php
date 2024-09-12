<?php 
session_start();
include "../../../config/koneksi_sqlserver.php";
include "../../../config/koneksi.php";

$id = $_GET['data_ajax'];
$a = mysql_query("select * from unit_keluar where md5(md5(no_spk)) = '$id'");
	$j = mysql_fetch_array($a);

?>

<?php
														$qry1 = mysql_query("select * from matching_local where no_spk_local='$j[no_spk]'");
														$sql1 = mysql_fetch_array($qry1);
													?>
													<?php
														$qry2 = mysql_query("select * from data_mobil where norangka='$sql1[norangka_local]'");
														$sql2 = mysql_fetch_array($qry2);
													?>
													<?php
													//	$qry3 = mysql_query("select * from pengajuan_discount where no_spk='$j[no_spk]'");
														$qry3 = mysql_query("SELECT pd.tipe_mobil as tipe_mobil, t.nama_tipe as nama_tipe, pd.*, t.* FROM pengajuan_discount pd, tipe t where no_spk='$j[no_spk]' and t.kode_tipe = pd.tipe_mobil");
														$sql3 = mysql_fetch_array($qry3);
													?>
													<?php
														$qry4 = mysql_query("select * from status_spk where no_spk='$sql3[no_spk]'");
														$sql4 = mysql_fetch_array($qry4);
														
														$query = "select SPK.* from vw_PukSOS SPK
																where SPK.NomorSPK = '$j[no_spk]' ";
														$query = sqlsrv_query($conn, $query);
														$n=0;
														while($data = sqlsrv_fetch_array($query)){
															$norangka = $data['NoRangka'];
															$nomesin = $data['NoMesin'];
														}
													?>
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title" id="myModalLabel">Detail data</h4>
									</div>
									<div class="modal-body">
									
														
															<table class="table table-bordered table-hover" id="sample-table-1">
																<tbody>
																	<tr class="warning">
																		<td>No SPK</td>
																		<td><?php echo $j['no_spk']; ?></td>
																	</tr>
																	<tr class="info">
																		<td>Pemohon</td>
																		<td><?php echo $j['nama_sales']." / ".$j['input'] ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Nama Customer</td>
																		<td><?php echo $sql3['nama_customer'] ?></td>
																	</tr>
																	<tr class="info">
																		<td>Tipe</td>
																		<td><?php echo $sql3['tipe_mobil'].' / '.$sql3['nama_tipe'] ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Warna</td>
																		<td><?php echo $sql3['warna'] ?></td>
																	</tr>
																	<tr class="info">
																		<td>No Rangka</td>
																		<td><?php echo $norangka ?></td>
																	</tr>
																	<tr class="warning">
																		<td>No Mesin</td>
																		<td><?php echo $nomesin ?></td>
																	</tr>
																	<tr class="info">
																		<td>Waktu Keluar</td>
																		<td><?php echo $j['waktu_keluar'] ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Cara Pembayaran</td>
																		<td><?php echo $sql3['cara_beli'] ?></td>
																	</tr>
																	<?php if ($sql3['cara_beli']!= 'TUNAI'){ ?>
																	<tr class="info">
																		<td>Leasing</td>
																		<td><?php echo $sql3['leasing'] ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Tenor</td>
																		<td><?php echo $sql3['tenor'] ?></td>
																	</tr>
																	<?php }
																	/*
																		$qry5total = mysql_query("select sum(nilaipenerimaan) as dp1 from kwitansi_pesanan_kendaraan where noreferensi='$sql3[no_spk]'");
																		$sql5total = mysql_fetch_array($qry5total);
																		$total_dp1 = $sql5total['dp1'];
																		
																		$qry5 = mysql_query("select * from kwitansi_pesanan_kendaraan where noreferensi='$sql3[no_spk]'");
																		while($sql5 = mysql_fetch_array($qry5)){
																	?>
																	<tr class="info">
																		<td>DP</td>
																		<td><?php echo number_format("$sql5[nilaipenerimaan]",0,".",".") ?></td>
																	</tr>
																	<?php
																		}
																	?>
																	
																	<?php
																		$qry6total = mysql_query("select sum(nilaipenerimaan) as dp2 from kwitansi_pesanan_kendaraan where noreferensi='$sql4[no_penjualan]'");
																		$sql6total = mysql_fetch_array($qry6total);
																		$total_dp2 = $sql6total['dp2'];
																		
																	
																		$qry6 = mysql_query("select * from kwitansi_pesanan_kendaraan where noreferensi='$sql4[no_penjualan]'");
																		while($sql6 = mysql_fetch_array($qry6)){
																	?>
																	<tr class="warning">
																		<td>DP</td>
																		<td><?php echo number_format("$sql6[nilaipenerimaan]",0,".",".") ?></td>
																	</tr>
																	<?php
																		}*/
																	?>
																	
																	<?php
																	/*	if($tot!='0'){	
																			$tot = $total_dp1 + $total_dp2;
																	?>
																	<tr class="info">
																		<td>TOTAL</td>
																		<td><?php echo number_format("$tot",0,".",".") ?></td>
																	</tr>
																	<?php
																		} */
																	?>
																	
																	<!--tr class="warning">
																		<td>Discount</td>
																		<td><?php echo number_format("$sql3[pengajuan_disc]",".",".") ?></td>
																	</tr-->
																	<tr class="info">
																		<td>Keterangan</td>
																		<td><?php echo $j['keterangan']; ?></td>
																	</tr>
																	
																</tbody>
															</table>
													
									</div>
								</div>
							</div>