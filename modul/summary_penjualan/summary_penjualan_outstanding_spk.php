<?php
session_start();
$level = $_SESSION['leveluser'];
										    
$cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 

");
$cek_akses2 = mysql_fetch_array($cek_akses);

										
if($cek_akses2['akses'] != 'Y'){

  
	include "modul/protected.php";
	
		
}else{
		
		switch($_GET[act]){
		//tampilkan data
		default:
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		//$bulan_sekarang = date("m-Y");
		include "class_hitung_incentif.php"; 
?>
	
				

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-7">
									<h1 class="mainTitle">Summary</h1>
									<span class="mainDescription">Outstanding SPK</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
							
									<div class="col-md-3">	
										<form action="" method="GET" name="postform">									
											<div class="form-group">
												
													<input type = "hidden" name = "module" value = "summary_penjualan_outstanding_spk" />
													<label class="control-label">
														   Pilih Data yang akan di tampilkan <span class="symbol required"></span>
													</label>
													<br/> 
													<select id="status_spk" name="status_spk" >
																		<option value="" >SILAHKAN - PILIH</option>
																		<option value="out_spk" <?php if($_GET[status_spk]=='out_spk'){echo "selected";}  ?> >OUTSTANDING SPK</option>
																		<option value="out_do" <?php if($_GET[status_spk]=='out_do'){echo "selected"; } ?> >OUTSTANDING DO</option>
																		
													</select>
													
													
																
											</div>
											<div class="form-group">
												<button type="submit" id="tampil_outstanding"  class="btn btn-white btn-info btn-bold">Tampilkan Data</button>	
											</div>
										</form>
									</div>
								
								
								<!------------------ UNTUK SS PERFORMANCE ------------------------------------------------------------------------------------------------>
								<?php 
								
								
								$bulan_ini = date('m');
								$tahun_ini = date('Y');
								
								
								
								if($_GET[status_spk]!=''){
									
									
									if($_GET[status_spk]=='out_spk'){
										$filter = " and tglfakturnaik = '' ";
									}
									if($_GET[status_spk]=='out_do'){
										$filter = " and norangka != '' ";
									}
								
								?>
								
								
								
								
								
								
								
								<div class="col-sm-12">
									
									
									<div class="panel panel-white no-radius">
										<div class="panel-body no-padding">
											<div class="tabbable no-margin no-padding">
												<ul>
													
												</ul>
												<ul class="nav nav-tabs" id="myTab">
													
													<li class="padding-top-5 active" >
														<a data-toggle="tab" href="#prospect_faktur">
															<font>SUMMARY </font>
														</a>
													</li>
												    <?php 
												        $query = mysql_query("SELECT kode_spv FROM pesanan_kendaraan_outstanding where kode_spv != 'OFFCE' $filter group by kode_spv");
																			        while ($data = mysql_fetch_array($query)){
																			        $kode_targetspv = $data[kode_spv];
																			      
												    
												    ?>
													 
												    <li class="padding-top-5" >
														<a data-toggle="tab" href="#<?php echo $kode_targetspv; ?>">
															<?php echo $kode_targetspv; ?> 
														</a>
													</li>
													
													<?php } ?>
													
													
												</ul>
												
												<div class="tab-content" >
													<div class="tab-pane padding-bottom-5 active" id="prospect_faktur">
														<div class="table-responsive">
														<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center;" >
															<thead>
																<tr style = "font-weight: bold;">							
																	<td align = "left">ITEM</td>	
																	<?php 
																		$query = mysql_query("SELECT kode_spv FROM pesanan_kendaraan_outstanding where kode_spv != 'OFFCE' $filter group by kode_spv");
																		while ($data = mysql_fetch_array($query)){
																			echo "<td><div style=color:$data[warna]>".substr($data[kode_spv],0,4)."</div></td>";
																		}
																	?>
																											
																	<!--th>HENRI</th>
																	<th>WIND</th>
																	<th>ZAIN</th>
																	<th>IBNU</th>
																	<th>INDRA</th>
																	<th>COUNTER</th-->
																	<td>TOTAL</td>											
																</tr>
															</thead>
															<tbody>
															<?php
															//	if($_SESSION['leveluser']=='admin'){
															?>
																<tr>
																	<td align = "left">
																		SPK BO DIATAS 3 BULAN
																	
																	</td>
																	<?php 
																		$query2 = mysql_query("SELECT kode_spv FROM pesanan_kendaraan_outstanding where kode_spv != 'OFFCE' $filter group by kode_spv");
																		while ($data = mysql_fetch_array($query2)){
																			//echo "<td>a</td>";
																		
																			$hari_ini = date("Y-m-d");
																		//	$query3 = mysql_query("select count(no_spk) as total_prospect from pesanan_kendaraan_outstanding where kode_spv = '$data[kode_spv]' and (substr(tanggal,6,2) = '$bulan_ini' and left(tanggal,4) = '$tahun_ini') $filter ");
																		//	$query3 = mysql_query("SELECT count(no_spk) as total_prospect FROM pesanan_kendaraan_outstanding where kode_spv = '$data[kode_spv]' and tanggal < date_sub('$hari_ini', interval 3 month) order by kode_spv $filter");
																			$query3 = mysql_query("select count(no_spk) as total_prospect from pesanan_kendaraan_outstanding where kode_spv = '$data[kode_spv]' and tanggal < date_sub('$hari_ini', interval 3 month) and (substr(tanggal,6,2) < '$bulan_ini' or left(tanggal,4) < '$tahun_ini') $filter ");
																			$data3 = mysql_fetch_array($query3);
																			echo "<td style='font-size:17px;'>".$data3[total_prospect]."</td>";
																		}
																	?>
																	<td style='font-size:17px;'>
																		<?php
																	//	$query3 = mysql_query("select count(no_spk) as total_prospect from pesanan_kendaraan_outstanding where kode_spv != 'OFFCE' and (substr(tanggal,6,2) = '$bulan_ini' and left(tanggal,4) = '$tahun_ini') $filter ");
																		$query3 = mysql_query("SELECT count(no_spk) as total_prospect FROM pesanan_kendaraan_outstanding where kode_spv != 'OFFCE' and tanggal < date_sub('$hari_ini', interval 3 month) $filter");
																			$data3 = mysql_fetch_array($query3);
																			echo $data3[total_prospect] ;
																		?>
																	
																	</td>	
																</tr>
																
															<?php
															//	}
															?>
																<tr>
																	
																	<td align = "left">
																		SPK BO
																	
																	</td>
																	
																	<?php 
																		$query2 = mysql_query("SELECT kode_spv FROM pesanan_kendaraan_outstanding where kode_spv != 'OFFCE' $filter group by kode_spv");
																		while ($data = mysql_fetch_array($query2)){
																			//echo "<td>a</td>";
																		//	$query3 = mysql_query("select count(no_spk) as total_prospect from pesanan_kendaraan_outstanding where kode_spv = '$data[kode_spv]' and (substr(tanggal,6,2) < '$bulan_ini' or left(tanggal,4) < '$tahun_ini')  $filter ");
																			$query3 = mysql_query("select count(no_spk) as total_prospect from pesanan_kendaraan_outstanding where kode_spv = '$data[kode_spv]' and tanggal > date_sub('$hari_ini', interval 3 month) and (substr(tanggal,6,2) < '$bulan_ini' or left(tanggal,4) < '$tahun_ini')  $filter ");
																			$data3 = mysql_fetch_array($query3);
																			echo "<td style='font-size:17px;'>".$data3[total_prospect]."</td>";
																		}
																	?>
																	<td style='font-size:17px;'>
																		<?php
																		$query3 = mysql_query("select count(no_spk) as total_prospect from pesanan_kendaraan_outstanding where kode_spv != 'OFFCE' and tanggal > date_sub('$hari_ini', interval 3 month) and (substr(tanggal,6,2) < '$bulan_ini' or left(tanggal,4) < '$tahun_ini') $filter ");
																	//	$query3 = mysql_query("select count(no_spk) as total_prospect from pesanan_kendaraan_outstanding where kode_spv != 'OFFCE' and (substr(tanggal,6,2) < '$bulan_ini' or left(tanggal,4) < '$tahun_ini') $filter ");
																			$data3 = mysql_fetch_array($query3);
																			echo $data3[total_prospect] ;
																		?>
																	
																	</td>																				
																</tr>
																<tr>																				
																	<td align = "left">
																		SPK BO BULAN INI
																	
																	</td>
																	
																	<?php 
																		$query2 = mysql_query("SELECT kode_spv FROM pesanan_kendaraan_outstanding where kode_spv != 'OFFCE' $filter group by kode_spv");
																		while ($data = mysql_fetch_array($query2)){
																			//echo "<td>a</td>";
																			$query3 = mysql_query("select count(no_spk) as total_prospect from pesanan_kendaraan_outstanding where kode_spv = '$data[kode_spv]' and (substr(tanggal,6,2) = '$bulan_ini' and left(tanggal,4) = '$tahun_ini') $filter ");
																		//	$query3 = mysql_query("select count(no_spk) as total_prospect from pesanan_kendaraan_outstanding where kode_spv = '$data[kode_spv]' and (substr(tanggal,6,2) + INTERVAL 30 DAY <  (substr(tanggal,6,2) = '$bulan_ini' and left(tanggal,4) = '$tahun_ini') $filter ");
																			$data3 = mysql_fetch_array($query3);
																			echo "<td style='font-size:17px;'>".$data3[total_prospect]."</td>";
																		}
																	?>
																	<td style='font-size:17px;'>
																		<?php
																		$query3 = mysql_query("select count(no_spk) as total_prospect from pesanan_kendaraan_outstanding where kode_spv != 'OFFCE' and (substr(tanggal,6,2) = '$bulan_ini' and left(tanggal,4) = '$tahun_ini') $filter ");
																			$data3 = mysql_fetch_array($query3);
																			echo $data3[total_prospect] ;
																		?>
																	
																	</td>																				
																</tr>
																
															</tbody>
														</table>
														</div>
													</div>
												
													<?php  
													///////////////////////////////////////////////////////////////////////////////
													//////////////////////////////////////////////////////////////////////////////
													
													if($_GET[status_spk]=='out_spk'){
														$filter = " and po.tglfakturnaik = '' ";
													}
													if($_GET[status_spk]=='out_do'){
														$filter = " and po.norangka != '' ";
													}
																	
													
													$query_tgtspv = mysql_query("SELECT kode_spv FROM pesanan_kendaraan_outstanding where kode_spv != 'OFFCE' group by kode_spv");
																			        while ($data_targetspv = mysql_fetch_array($query_tgtspv)){
																			        $kode_spvtarget = trim($data_targetspv['kode_spv']);  
																			        //echo "aaaaaabbbbbbbb";
																			        
													?>
													
													
													<div id="<?php echo $kode_spvtarget; ?>" class="tab-pane padding-bottom-5"> 
														<div class="panel-scroll height-360">
															
																<div class = "table-responsive">
																	
																
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center;" >
																	
																		<thead>
																			<tr>
																			    <!--th width="5%"><font color = "<?php echo $data_targetspv[warna]; ?>"><?php echo $kode_spvtarget; ?></font></th-->
																				<td align = "left"><b>NO</b></td>
																				<td align = "left"><b>SALES</b></td>
																				<td><b>NO SPK</b></td>
																				<td><b>TANGGAL</b></td>	
																				<td><b>NAMA CUST</b></td>	
																				<td><b>NIK / FAKTUR</b></td>	
																				<td><b>DP (Rp)</b></td>	
																				<td><b>TIPE</b></td>
																				<td><b>WARNA</b></td>
																				
																			</tr>
																		</thead>
																		<tbody>
																				<?php 
																				//	$sales = mysql_query("select * from users where level='user' and kode_supervisor='$kode_spvtarget' order by kode_sales asc");	
																					$nomor = 0;
																					$sales = mysql_query("select po.*,t.nama_tipe,w.nama_warna from pesanan_kendaraan_outstanding po left join tipe t on t.kode_tipe = po.kode_tipe left join warna w on w.kode_warna = po.kode_warna where po.kode_spv = '$kode_spvtarget' $filter order by po.tanggal ");
																					
																					while($sql = mysql_fetch_array($sales)){
																						
																						
																						$query_status_spk = mysql_query("select * from status_spk where no_spk = '$sql[no_spk]' ");
																						$dtspk = mysql_fetch_array($query_status_spk);
																						$no_spk = trim($dtspk['no_spk']);
																						$no_penjualan = trim($dtspk['no_penjualan']);
																						
																						$query_kwitansi = mysql_query("select sum(nilaipenerimaan) as nilaipenerimaan from kwitansi_pesanan_kendaraan where noreferensi in('$sql[no_spk]','$no_penjualan') ");
																						$data_kwitansi = mysql_fetch_array($query_kwitansi);
																						
																						
																						$nilai_penerimaan = $data_kwitansi['nilaipenerimaan'];
																							
																						
																							
																						$nomor++;
																						$nama = $sql['username'];	
																						$kode = $sql['kode_sales'];
																						$no_spk = $sql['no_spk'];
																						$tanggal = date('d-m-Y',strtotime($sql['tanggal']));
																						$nama_customer = $sql['nama_customer'];
																						$nilaikwitansi = number_format("$sql[nilaikwitansi]",0,".",".");	
																						$nama_tipe = $sql['nama_tipe'];
																						$nama_warna = $sql['nama_warna'];
																						
																						require "config/koneksi_sqlserver.php";
																					//	require "config/koneksi_sqlserverit.php";
																							
																						
																						$query_pembayaran = "SELECT PK.hargaperunit,pk.DiscUnit,ak.NilaiTDP FROM UntT_PesananKendaraan PK left join UntT_AplikasiKredit AK on PK.nomor = AK.nomor_pesanan where PK.nomor = '$no_spk'";
																						$query_pembayaran = sqlsrv_query($conn, $query_pembayaran);
																						while($data_pembayaran = sqlsrv_fetch_array($query_pembayaran)){
																							$disc_unit = $data_pembayaran['DiscUnit'];
																							$harga_otr = $data_pembayaran['hargaperunit'] - $data_pembayaran['DiscUnit'];
																							$kurang_bayar = $nilai_penerimaan - $harga_otr ;
																						}
																						
																					
																						$pembayaran = "select JenisPenjualan, NamaLeasing from vw_PukSOS SPK where NomorSPK = '$no_spk'";
																						$pembayaran = sqlsrv_query($conn, $pembayaran);
																						while($data_detail_pembayaran = sqlsrv_fetch_array($pembayaran)){
																							$jenis_pembayaran = $data_detail_pembayaran['JenisPenjualan'];
																							if($data_detail_pembayaran['NamaLeasing'] == ''){
																								$nama_leasing = "Belum ada Leasing";
																							}else{
																								$nama_leasing = $data_detail_pembayaran['NamaLeasing'];
																							}
																							
																							if($jenis_pembayaran == 'Kredit'){
																								$namaleasing = ' / '.$nama_leasing;
																							}else{
																								$namaleasing = '';
																							}
																						}
																						
																						$spk = " SELECT PK.hargaperunit,pk.DiscUnit,ak.NilaiTDP,ak.nilaikredit FROM UntT_PesananKendaraan PK left join UntT_AplikasiKredit AK on PK.nomor = AK.nomor_pesanan where PK.nomor = '$no_spk'";
																						$spk = sqlsrv_query($conn, $spk);
																						
																						
																						while ($data_spk = sqlsrv_fetch_array($spk)){
																							$disc = $data_spk['DiscUnit'];
																							
																						/*	if ($jenis_pembayaran == "Tunai" || $jenis_pembayaran == "COP"){
																								$ar_unit = $data_spk['hargaperunit'];
																								$sisa_bayar = $harga_otr - $total_bayar;
																								
																							}	*/
																							if ($jenis_pembayaran == "Kredit"){
																							//	$ar_unit_tdp = $data_spk['NilaiTDP'];
																							//	$ar_unit = $data_spk['hargaperunit'];
																								//$sisa_bayar = $ar_unit - $disc_unit - $total_bayar;
																							//	$sisa_bayar = $ar_unit - $disc_unit - $total_bayar;
																								if($data_spk['nilaikredit'] == ''){
																									$nilaikredit = '';
																								}else{
																									$nilaikredit = ' / '.number_format("$data_spk[nilaikredit]",0,".",".");
																								}
																								
																							}
																						}
																				?>
																			<tr>
																				<td align="left"><?php echo $nomor; ?></td>
																				<td align="left"><?php echo $kode; ?></td>
																				<td><?php echo $no_spk.''.$namaleasing.''.$nilaikredit; ?></td>
																				<td><?php echo $tanggal; ?></td>
																				<td><?php echo $nama_customer; ?></td>
																				<td><?php echo substr($sql['norangka'],10,6) .(trim($sql['tglfakturnaik']) != "" ? " / ".trim($sql['tglfakturnaik']) : "") ; ?></td>
																				<td><?php echo number_format("$nilai_penerimaan",0,".",".").' / ' ?><b class="blink text-danger"><?php echo number_format("$kurang_bayar",0,".","."); ?></b></td>
																				<td><?php echo $nama_tipe; ?></td>
																				<td><?php echo $nama_warna; ?></td>
																			</tr>
																				<?php
																					}
																				?>
																			
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													
													
													<?php 
																			            
												} 
													
													?>
													
													
												</div>
											</div>
										</div>
									</div>
									
									
									<div class="progress-demo">
										<a href='modul/summary_penjualan/export_outstanding_spk.php?status_spk=<?php echo $_GET['status_spk']; ?>'>
											<button class="btn btn-wide btn-primary ladda-button" data-style="expand-right" >
												<span class="ladda-label"> Export Data ke Excel</span>
											</button>
										</a>
									</div>
								</div>
								<?PHP } ?>
								
								
								
								
								
								
							</div>
						</div>
						<!-- end: DYNAMIC TABLE -->
					</div>
				</div>

<?php break;
} 
}?>