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
		$tgl = date("Y-m-d");
		//$bulan_sekarang = date("m-Y");
		//include "class_hitung_incentif.php"; 
	//	include "config/koneksi_sqlserver.php";
	include "config/koneksi_sqlserver.php";
		
?>
	
				

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-7">
									<h1 class="mainTitle">Summary</h1>
									<span class="mainDescription">Pencapaian Asuransi
					
									</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
							
								<div class = "col-md-6">
									<?php $isi_lama = $_GET['bulan']; 
										
										
									?>
									<div class="form-group">
																					
										<form action = "<?php echo "$_SERVER[PHP_SELF]"; ?>" method = "GET">
											<input type = "hidden" name="module" value = "summary_penjualan_asuransi" />
											
											<div class="form-group">
												<label class="control-label">
													Pilih Periode <span class="symbol required"></span>
												</label>
												<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
													<input class="form-control" type="text" id="tgl_awal" name="tgl_awal" value ="<?php echo $_GET[tgl_awal]; ?>" readonly>
														<span class="input-group-addon bg-primary">s/d</span>
													<input class="form-control" type="text" id="tgl_akhir" name="tgl_akhir" value ="<?php echo $_GET[tgl_akhir]; ?>" readonly>
												</div>
											</div>
											
											
											
											
										
											<div class="progress-demo">
												<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" >
													<span class="ladda-label"><i class="fa fa-check"></i> Proses </span>
												</button>
											</div><br/>
											
											<?php
												$tgl_awal = $_GET[tgl_awal];
												$tgl_akhir = $_GET[tgl_akhir];
											?>
											<!--label class="control-label">
											    <div class="table-header">Data Faktur Sales: dari Periode <?php echo $tgl_awal; ?> sampai dengan periode <?php echo $tgl_akhir; ?> </div>
									    	</label-->
											
											<div class="form-group">
												<i><b></b></i></div>
											</div>
										</form>										
									</div>
								
								<!------------------ UNTUK SS PERFORMANCE ------------------------------------------------------------------------------------------------>
								<?php 
								
							
									
									$bln = "substr($_GET[bulan], 1, 7)";
									
									$tgl_awal = $_GET[tgl_awal];
									$tgl1 = substr($tgl_awal,4,4);
									$bln_awal = substr($tgl_awal, 5, 2);
									$thn_awal = substr($tgl_awal, 0, 4);
									$bulan1 = $bln_awal."-".$thn_awal;
									
									$tgl_akhir = $_GET[tgl_akhir];
									$tgl2 = substr($tgl_akhir,4,4);
									$bln_akhir = substr($tgl_akhir, 5, 2);
									$thn_akhir = substr($tgl_akhir, 0, 4);
									$bulan2 = $bln_akhir."-".$thn_akhir;
									
									if($bulan !="-") {
										
										
									/*	$querysadetail = "select count(f.nomor) as total from srvt_faktur F
															where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'
															and f.batal = 0 ";	*/
														
										$querysadetail = mysql_query("select * from summary_faktur where substr(tanggal, 1, 11) >= '$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir'");
									//	$result = sqlsrv_query($conn, $querysadetail);		
										if($bulan !="-") { 
										$querysadetail = mysql_query("select * from summary_faktur where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir'  ");
										$tot_rec = mysql_num_rows($querysadetail);
										if ($tot_rec == '0') { echo "<div class='col-sm-12'> Tidak ada data pada periode Ini, silahkan pilih ulang </div>"; } else {
										
									/*	while($data_faktur = mysql_fetch_array($querysadetail)){
											$ada_record = $data_faktur['total'];
										}
										
										
										if ($ada_record == '0') { echo "<div class='col-sm-12'> Tidak ada data pada periode Ini, silahkan pilih ulang </div>"; } else {	*/
								?>
								
								<div class="col-sm-12">
									<div class="panel panel-white no-radius">
										<div class="panel-body no-padding">
											<div class="tabbable no-margin no-padding">
												<ul class="nav nav-tabs" id="myTab">
												    <li class="active padding-top-5 padding-left-5"> 
														<a data-toggle="tab" href="#chart">
															GRAFIK
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#incentif">
															SS PERFORMANCE
														</a>
													</li>
												
													<?php 
													//	$query = mysql_query("select * from target_spv where bulan >= '$bulan1' and bulan <= '$bulan2' group by kode_spv order by kode_spv, bulan");
														if ($thn_akhir - $thn_awal > 0){	
															$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv");
														}else{
															$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv");
														}
														
													//	$query = mysql_query("select * from target_spv where substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]' group by kode_spv order by kode_spv, bulan");
															while ($data = mysql_fetch_array($query)){
															$kode_targetspv = $data[kode_spv];
												    ?>
												    <li class="padding-top-5" >
														<a data-toggle="tab" href="#<?php echo $kode_targetspv; ?>">
															<font color="<?php echo $data[warna]; ?>"><?php echo $kode_targetspv; ?> </font>
														</a>
													</li>
													
													<?php } ?>
												
													
												</ul>
												
												<div class="tab-content">
													<div id="incentif" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-360">
															
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center;" >
																		<thead>
																			<tr style = "font-weight: bold;">											
																				<td>TGT</td>	
																			    <?php 
																				if ($thn_akhir - $thn_awal > 0){
																					$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv");
																					
																				}else{
																					$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv, bulan");
																				}
																			        while ($data = mysql_fetch_array($query)){
																			            echo "<td width='6%'><div style=color:$data[warna]>".substr($data[kode_spv],0,3)."</div></td>";
																			        }
																			    ?>
																				
																				<td>TOTAL</td>													
																			</tr>
																		</thead>
																		<tbody>
																			
																		    <?php 
																			 if ($thn_akhir - $thn_awal > 0){
																				$query_model = mysql_query("select *, sum(target) as target from target_marketing  where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by model order by model asc");
																				
																			}else{
																				$query_model = mysql_query("select *, sum(target) as target from target_marketing  where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by model order by model asc");
																			}
																			
																					$rec = mysql_fetch_array($query_model);
																				
																		    ?>
																			
																			<tr>
																			    <td>PENJUALAN TUNAI</td>
																			    	<?php  
                                													///////////////////////////////////////////////////////////////////////////////
                                													//////////////////////////////////////////////////////////////////////////////
                                													if ($thn_akhir - $thn_awal > 0){
																						$query_tgtspv = mysql_query("select *, sum(target_unit) target_unit from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv");
																					}else{
																						$query_tgtspv = mysql_query("select *, sum(target_unit) target_unit from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv");
																					}
                                												
																						while ($data_targetspv = mysql_fetch_array($query_tgtspv)){
																							$kode_spvtarget = $data_targetspv['kode_spv']; 
																						
																							$faktur = mysql_query("select count(kode_sales) as target_penjualan from summary_faktur where substr(tanggal, 1, 11) >= '$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv = '$kode_spvtarget' and jenispenjualan = 'TUNAI' ");
																							$faktur_target = mysql_fetch_array($faktur);
																							 $faktur_target2 = $faktur_target['target_penjualan'];
																							
																						 
																						echo "<td style='font-size:17px;'><b><font color='$data_targetspv[warna]'>$faktur_target2</font></b></td>";
																						}				        
                                																			        
                                													?>
																				<td style="font-size:17px;">
																					<?php
																						$faktur = mysql_query("select count(kode_sales) as target_penjualan from summary_faktur where substr(tanggal, 1, 11) >= '$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir'  and jenispenjualan = 'TUNAI' ");
																						$faktur_target = mysql_fetch_array($faktur);
																						 $faktur_target2 = $faktur_target['target_penjualan'];
																						
																						echo $faktur_target2;
																			        ?>
																				</td>
																			</tr>
																			<tr>
																			    <td>
																			        PENJUALAN ASURANSI
																			   
																				</td>
																			    	<?php
																						 if ($thn_akhir - $thn_awal > 0){
																							$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv");
																							
																						}else{
																							$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv");
																						}
																						$total_asuransi = 0;
    																			        while ($data = mysql_fetch_array($query)){
																							$spv = data['kode_spv'];
    																			            echo "<td style='font-size:17px;'>";
																							
																							$asuransi = "select count(kode_salesman) as total from UntT_AsuransiPurnaJual where convert(date, tanggal, 105) >= '$tgl_awal' and convert(date, tanggal, 105) <= '$tgl_akhir' and kode_supervisor = '$data[kode_spv]'";
																							$asuransi_result = sqlsrv_query($conn, $asuransi);
																							while($data = sqlsrv_fetch_array($asuransi_result)){
																								echo "<b><font color='$data[warna]' >".$target_asuransi = $data['total']."</font></b>";
																								$total_asuransi = $total_asuransi + $data['total'];
																							}
    																			        }
    																				?>
    																			<td style="font-size:17px;">
    																			    <?php
																						
																						echo $total_asuransi	;
																						
    																				?>
    																			</td>
																			</tr>
																			<tr>
																			    <td>RASIO %</td>
																			        <?php
																						
																						if ($thn_akhir - $thn_awal > 0){
																							$query = mysql_query("select *, sum(target_unit) as target_unit from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv");
																						}else{
																							$query = mysql_query("select *, sum(target_unit) as target_unit from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv");
																						}
    																				
    																			        while ($data = mysql_fetch_array($query)){
    																			            echo "<td>";
																					
        																				    $kode_spvtarget = $data_targetspv['kode_spv']; 
																						
																							$faktur = mysql_query("select count(kode_sales) as target_penjualan from summary_faktur where substr(tanggal, 1, 11) >= '$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv = '$data[kode_spv]' and jenispenjualan = 'TUNAI' ");
																							$faktur_target = mysql_fetch_array($faktur);
																							 $faktur_target2 = $faktur_target['target_penjualan'];
																							 
																							 $asuransi = "select count(kode_salesman) as total from UntT_AsuransiPurnaJual where convert(date, tanggal, 105) >= '$tgl_awal' and convert(date, tanggal, 105) <= '$tgl_akhir' and kode_supervisor = '$data[kode_spv]'";
																							$asuransi_result = sqlsrv_query($conn, $asuransi);
																							while($data2 = sqlsrv_fetch_array($asuransi_result)){
																								$total_asuransi = $data2['total'];
																							}
																							 
        																				    if ($faktur_target==0){
    																				            echo 0;
    																				        }
    																				        else {
    																				            if($total_asuransi==0){
    																				                echo "<span class='label label-danger'>"."0%</span>";
    																				            }else {
    																				                $ratio = round(($total_asuransi/ $faktur_target2)*100,2);
    																				                 if ((round(($total_asuransi/ $faktur_target2)*100,2))<100){
    																				                     if ($ratio >= 65 and $ratio < 100){
    																				                         echo "<span class='label label-warning'>".(round(($total_asuransi/ $faktur_target2)*100))."</span>";
    																				                     }
    																				                     else {
    																				                         echo "<span class='label label-danger'>".(round(($total_asuransi/ $faktur_target2)*100))."</span>";
    																				                     }
    																				                 }
    																				                 else{
    																				                     echo "<span class='label label-success'>".(round(($total_asuransi/ $faktur_target2)*100))."</span>";
    																				                 }
    																				                
    																				            }
    																				            
    																				            
    																				        }
																							
																						//	echo "<span class='label label-danger'>".$summary."</span>";
    																				        $total_point_tipe = 0;
        																				    
    																			        }
    																			        
    																				?>
																					<td>
																						 <?php
																						 if ($thn_akhir - $thn_awal > 0){
																							$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv");
																							
																						}else{
																							$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv");
																						}
																						$total_asuransi = 0;
																						while($data1 = mysql_fetch_array($query)){
																							$spv = data1['kode_spv'];
																							
																							$asuransi = "select count(kode_salesman) as total from UntT_AsuransiPurnaJual where convert(date, tanggal, 105) >= '$tgl_awal' and convert(date, tanggal, 105) <= '$tgl_akhir' and kode_supervisor = '$data1[kode_spv]'";
																							$asuransi_result = sqlsrv_query($conn, $asuransi);
																							while($data = sqlsrv_fetch_array($asuransi_result)){
																								$total_asuransi = $total_asuransi + $data['total'];
																							}
																							
																						
																							 
																							$faktur = mysql_query("select count(kode_sales) as target_penjualan from summary_faktur where substr(tanggal, 1, 11) >= '$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir'  and jenispenjualan = 'TUNAI' ");
																							$faktur_target = mysql_fetch_array($faktur);
																							 $faktur_target2 = $faktur_target['target_penjualan'];
																						
																						//	echo $faktur_target2;
																							
																							
																							
																						} 
																						
																						if ($total_asuransi==0){
																							echo 0;
																						}
																						else {
																							
																							if ((round(($total_asuransi/$faktur_target2)*100,2))<100){
																								echo "<span class='label label-danger'>".(round(($total_asuransi/$faktur_target2)*100))."</span>";
																							}
																							else {
																								echo "<span class='label label-success'>".(round(($total_asuransi/$faktur_target2)*100))."</span>";
																							}
																						}
																						
																					
																				    ?>
																					</td>
																			</tr>
																			
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													
													
													
													
													<div id="<?php echo "INCENTIF_SA"; ?>" class="tab-pane padding-bottom-5"> 
														<div class="panel-scroll height-360">
														
														<?php
														/////////////////// data PM Package
														$querysadetail = "select wo.penerima,f.tanggal,fd.* from srvt_faktur F
																				left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																				left join srvt_wo WO on wo.nomor = F.nomor_wo
																				
																				where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'		
																				
																				
																																																						
																				and fd.Nama_Referensi like '%PPB%'
																				and f.batal = 0  ";
																			
															$result_ppb = sqlsrv_query($conn, $querysadetail);		
														
															
															
														?>
															
														</div>
													</div>
													
													 <?php 
												       
												        // VARIABEL VARIABEL UNTUK GRAFIK PENCAPAIAN PENJUALAN UNIT PER SUPERVISOR
												        //===============================================================================================
												  
														if ($thn_akhir - $thn_awal > 0){
															$spv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv asc");
														}else{
															$spv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv asc");
														}	
														$targets = '';
														$results = '';
														while ($spv2 = mysql_fetch_array($spv)){
															$spv3 = $spv2['kode_spv'];
															$res_ss = mysql_query("select * from summary_faktur where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and kode_spv = '$spv3' and jenispenjualan = 'TUNAI' and kode_spv != 'OFFCE' order by kode_spv asc");
														
															$res_ss1 = mysql_num_rows($res_ss);
															if ($results == ''){
															//	$results = $cd1['kdspv'];
																	if($res_ss1 == 0){
																		$results = '0';
																	}else {
																		$results = $res_ss1;
																	}
																}else {
																	
																	$results = $results.','.$res_ss1;
																}
												        }
												      
												        //VARIABEL VARIABEL UNTUK PENJUALAN ASURANSI
												        //=======================================================================================================
												       
														if ($thn_akhir - $thn_awal > 0){
															$tgt_ss = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv asc");
														}else{
															$tgt_ss = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv asc");
														}
														$kdspv = '';
														
													/*	while ($cd = mysql_fetch_array($tgt_ss)){
															if ($kdspv == ''){
																$kdspv = $cd['kode_spv'];
																$targets = $cd['targetunit'];
															}else {
																$kdspv = $kdspv.','.$cd['kode_spv'];
																$targets = $targets.','.$cd['targetunit'];
															}
																
														}	*/
														
													
														while ($cd = mysql_fetch_array($tgt_ss)){
															$asuransi = "select count(kode_salesman) as total from UntT_AsuransiPurnaJual where convert(date, tanggal, 105) >= '$tgl_awal' and convert(date, tanggal, 105) <= '$tgl_akhir' and kode_supervisor = '$cd[kode_spv]'";
															$asuransi_result = sqlsrv_query($conn, $asuransi);
															while($data = sqlsrv_fetch_array($asuransi_result)){
															//	echo $targets = $data['total'];
																if ($kdspv == ''){
																	$kdspv = $cd['kode_spv'];
																	$targets = $data['total'];
																}else {
																	$kdspv = $kdspv.','.$cd['kode_spv'];
																	$targets = $targets.','.$targets = $data['total'];
																	
																}
															}
															
																
														}
														
														  //VARIABEL VARIABEL UNTUK PENJUALAN UNIT MOBIL VS ASURANSI
												        //========================================================================================================
												        $tunai = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'TUNAI' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
														
															
														if ($thn_akhir - $thn_awal > 0){
															$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv");
															
														}else{
															$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv");
														}
														$spv_kd = '';
														while ($data1 = mysql_fetch_array($query)){
															$spv_kd = $data1[kode_spv].','.$spv_kd;
															$spv_kd1 = "'".$spv_kd."'";
															$spv_kd2 = substr($spv_kd, 0, -1);
															$asuransi = "select count(kode_salesman) as total from UntT_AsuransiPurnaJual where convert(date, tanggal, 105) >= '$tgl_awal' and convert(date, tanggal, 105) <= '$tgl_akhir' and kode_supervisor in ('sudi', 'ibnu', 'henri', 'wind', 'indra', 'wildy', 'zain', 'tiko')";
															$asuransi_result = sqlsrv_query($conn, $asuransi);
															while($data2 = sqlsrv_fetch_array($asuransi_result)){
																$asuransi = $data2['total'];
															//	echo $spv_kd2;
															}
															
														}
														
															
															
												        
														
														
														
														
												
												
												    ?>
												    
												    <script>
												        var brio    = "<?php echo $tot_brio; ?>";
												        var mobilio = "<?php echo $tot_mobilio; ?>";
												        var brv    = "<?php echo $tot_brv; ?>";
												        var hrv    = "<?php echo $tot_hrv; ?>";
												        var jazz    = "<?php echo $jazz; ?>";
												        var city    = "<?php echo $city; ?>";
												        var civic    = "<?php echo $civic; ?>";
												        var crv    = "<?php echo $crv; ?>";
												        var accord    = "<?php echo $accord; ?>";
												        var odyssey    = "<?php echo $odyssey; ?>";
												        var crz    = "<?php echo $crz; ?>";
														
														var kdspv = "<?php echo $kdspv; ?>";
												        
												        var target_henri = "<?php echo $target_henri; ?>";
												        var target_sudi = "<?php echo $target_sudi; ?>";
												        var target_wind = "<?php echo $target_wind; ?>";
												        var target_ibnu = "<?php echo $target_ibnu; ?>";
												        var target_indra = "<?php echo $target_indra; ?>";
												        var target_zain = "<?php echo $target_zain; ?>";
														var target_tiko = "<?php echo $target_tiko; ?>";
														var tgt_ss = "<?php echo $targets; ?>";
												        
												        var result_henri = "<?php echo $result_henri; ?>";
												        var result_sudi = "<?php echo $result_sudi; ?>";
												        var result_wind = "<?php echo $result_wind; ?>";
												        var result_ibnu = "<?php echo $result_ibnu; ?>";
												        var result_indra = "<?php echo $result_indra; ?>";
												        var result_zain = "<?php echo $result_zain; ?>";
														var result_tiko = "<?php echo $result_tiko; ?>";
														var res_ss = "<?php echo $results; ?>";
														
												        
												        var tunai = "<?php echo $tunai; ?>";
												        var kredit = "<?php echo $asuransi; ?>";
												        
												        var mbf = "<?php echo $mbf; ?>";
												        var maf = "<?php echo $maf; ?>";
												        var mtf = "<?php echo $mtf; ?>";
												        var may = "<?php echo $may; ?>";
												        var bca = "<?php echo $bca; ?>";
												        var other = "<?php echo $other; ?>";
												        
														
															
														
												    </script>
												    
													<div id="chart" class="tab-pane padding-bottom-5 active" >
														<div class = "row">
															<!--div class = "col-md-6">
															<h1 class="mainTitle">Penjualan Per Tipe</h1>
																
																		<canvas id="barChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="barLegend" class="chart-legend"></div>
																		</div>
																	
															</div-->
															
															<div class = "col-md-6">
															<h1 class="mainTitle">Penjualan Asuransi Per Team</h1>
																
																		<canvas id="lineChart1" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="lineLegend1" class="chart-legend"></div>
																		</div>
																	
															</div>
														
															<div class = "col-md-6">
															<h1 class="mainTitle">Penjualan Unit VS Penjualan Asuransi</h1>
																
																		<canvas id="pieChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="pieLegend" class="chart-legend"></div>
																		</div>
																	
															</div>
															<!--div class = "col-md-6">
															<h1 class="mainTitle">Leasing Company</h1>
																
																		<canvas id="doughnutChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="doughnutLegend" class="chart-legend"></div>
																		</div>
																	
															</div-->
														</div>
													</div>
													
													
													
													
														<?php 
													//	$query_tgtspv = mysql_query("select * from target_spv where bulan >= '$bulan1' and bulan <= '$bulan2' group by kode_spv order by kode_spv, bulan");
														
														if ($thn_akhir - $thn_awal > 0){	
															$query_tgtspv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv");
														}else{
															$query_tgtspv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv");
														}
													
														while ($data_targetspv = mysql_fetch_array($query_tgtspv)){
														$kode_spvtarget = $data_targetspv['kode_spv'];  
																			        
													?>
													
													<div id="<?php echo $kode_spvtarget; ?>" class="tab-pane padding-bottom-5"> 
														<div class="panel-scroll height-360">
															<?php
																/*
																	$query = mysql_query("SELECT nm_sa from acchv where bulan = '$bulan' group by nm_sa");
																	while ($r=mysql_fetch_array($query)){
																		$nama_sa = $nama_sa.$r[nm_sa];
																	}
																	$nama_sa = array("$nama_sa",1);
																	 */
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center;" >
																		<thead>
																			<tr>
																			    <td><font color = "<?php echo $data_targetspv[warna]; ?>">NAMA SALES</font></td>	
																				<td>PENJUALAN UNIT</td>
																			   
																				<td>PENJUALAN ASURANSI</td>
																				<td>RASIO %</td>
																				<!--th>RATA2 DISKON</th-->												
																			</tr>
																		</thead>
																		<tbody>
																		    <?php 
																				if ($thn_akhir - $thn_awal > 0){
																					$query_sales = mysql_query("SELECT *, sum(target_unit) as target_unit FROM target_sales where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) and kode_spv = '$kode_spvtarget' or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) and kode_spv = '$kode_spvtarget' group by kode_sales order by grade desc");
																					
																				}else{
																					$query_sales = mysql_query("SELECT *, sum(target_unit) as target_unit FROM target_sales where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and kode_spv = '$kode_spvtarget' group by kode_sales order by grade desc");
																				}
																				
																				$faktur = mysql_query("select * from summary_faktur where where tanggal >= ''");
																			        while ($sales = mysql_fetch_array($query_sales))
																			        {
																			           $nama_sales = trim($sales['nama_sales']);
																			           $kode_sales = trim($sales['kode_sales']);
																			           $grade = trim($sales['grade']);
																			           
																			           $target = $sales['target_unit'];
																					   $target2 = $target + 1;
																			           $target_point = $sales['target_point'];
																		    ?>
																			<tr>
																				
																				<td style="text-align:left;"><?php echo $kode_sales; ?></td>
																				<td>
																					<?php 
																						$faktur = mysql_query("select count(kode_sales) as target_penjualan from summary_faktur where substr(tanggal, 1, 11) >= '$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_sales = '$kode_sales' and jenispenjualan = 'TUNAI' ");
																						$faktur_target = mysql_fetch_array($faktur);
																						 $faktur_target2 = $faktur_target['target_penjualan'];
																						 echo $faktur_target2;
																					?>
																				</td>
																				
    																				
																				<td style="font-size:17px;">
    																				<?php
																					
																					
																						$asuransi = "select count(kode_salesman) as total from UntT_AsuransiPurnaJual where convert(date, tanggal, 105) >= '$tgl_awal' and convert(date, tanggal, 105) <= '$tgl_akhir' and kode_salesman = '$kode_sales'";
																						$asuransi_result = sqlsrv_query($conn, $asuransi);
																						while($data = sqlsrv_fetch_array($asuransi_result)){
																							$asuransi = $data['total'];
																							echo $asuransi;
																						}	
    																				    
    																				?>
																				</td>
																				<td>
																				    <?php
																						$faktur = mysql_query("select count(kode_sales) as target_penjualan from summary_faktur where substr(tanggal, 1, 11) >= '$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_sales = '$kode_sales' and jenispenjualan = 'TUNAI' ");
																						$faktur_target = mysql_fetch_array($faktur);
																						$faktur_target2 = $faktur_target['target_penjualan'];
																						
																						$asuransi = "select count(kode_salesman) as total from UntT_AsuransiPurnaJual where convert(date, tanggal, 105) >= '$tgl_awal' and convert(date, tanggal, 105) <= '$tgl_akhir' and kode_salesman = '$kode_sales'";
																						$asuransi_result = sqlsrv_query($conn, $asuransi);
																						while($data = sqlsrv_fetch_array($asuransi_result)){
																							$asuransi = $data['total'];
																						}
																						

																				        if ($faktur_target==0){
																				            echo 0;
																				        }
																				        else {
																				            if($asuransi==0){
																				                echo "<span class='label label-danger'>"."0</span>";
																				            }else {
																				                $ratio = round(($asuransi/$faktur_target2)*100,2);
																				                 if ((round(($asuransi/$faktur_target2)*100,2))<100){
																				                     if ($ratio >= 65 and $ratio < 100){
																				                         echo "<span class='label label-warning'>".(round(($asuransi/$faktur_target2)*100))."</span>";
																				                     }
																				                     else {
																				                         echo "<span class='label label-danger'>".(round(($asuransi/$faktur_target2)*100))."</span>";
																				                     }
																				                 }
																				                 else{
																				                     echo "<span class='label label-success'>".(round(($asuransi/$faktur_target2)*100))."</span>";
																				                 }
																				                
																				            }
																				            /*
																				            $ratio_point = round(($total_point_tipe/$target_point)*100,2);
																				            if ($ratio_point < 100) {
																				                if ($ratio_point >= 65 and $ratio_point < 100){
																				                    echo "  <span class='label label-warning'>".$ratio_point."%</span>";
																				                     }
																				                     else {
																				                         echo "  <span class='label label-danger'>".$ratio_point."%</span>";
																				                     }
																				                    
																				            }
																				            else{
																				                     echo "  <span class='label label-success'>".$ratio_point."%</span>";
																				                 }
																				            */
																				        }
																				        $total_point_tipe = 0;
																				    ?>
																				    
																				</td>
																																							
																			</tr>
																			<?php
																			        }
																			?>
																			<tr>
																			    <td><b style=color:#007aff>TOTAL</b></td>
																			    <td style="font-size:17px;">
																					<?php 
																						$faktur = mysql_query("select count(kode_sales) as target_penjualan from summary_faktur where substr(tanggal, 1, 11) >= '$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv = '$kode_spvtarget' and jenispenjualan = 'TUNAI'");
																						$faktur_total = mysql_fetch_array($faktur);
																						echo $faktur_total['target_penjualan'];
																					
    																				     
    																				?>
    																			</td>
																			    	
    																			<td style="font-size:17px;">
    																			    <?php
    																			    
																					$asuransi = "select count(kode_salesman) as total from UntT_AsuransiPurnaJual where convert(date, tanggal, 105) >= '$tgl_awal' and convert(date, tanggal, 105) <= '$tgl_akhir' and kode_supervisor = '$kode_spvtarget'";
																						$asuransi_result = sqlsrv_query($conn, $asuransi);
																						while($data = sqlsrv_fetch_array($asuransi_result)){
																							echo "<b>".$total_asuransi = $data['total']."</b>";
																						}
    																				     
    																				?>
    																			</td>
    																			<td>
																				    <?php
																						$faktur = mysql_query("select count(kode_sales) as target_penjualan from summary_faktur where substr(tanggal, 1, 11) >= '$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv = '$kode_spvtarget' and jenispenjualan = 'TUNAI'");
																						$faktur_total = mysql_fetch_array($faktur);
																							 $faktur_total2 = $faktur_total['target_penjualan'];
																						
																						$asuransi = "select count(kode_salesman) as total from UntT_AsuransiPurnaJual where convert(date, tanggal, 105) >= '$tgl_awal' and convert(date, tanggal, 105) <= '$tgl_akhir' and kode_supervisor = '$kode_spvtarget'";
																						$asuransi_result = sqlsrv_query($conn, $asuransi);
																						while($data = sqlsrv_fetch_array($asuransi_result)){
																							 $total_asuransi = $data['total'];
																						}
																					
																				        if ($total_asuransi==0){
																				            echo  "<span class='label label-danger'>0</span>";
																				        }
																				        else {
																				            $ratio = round(($total_asuransi/$faktur_total2)*100);
																				            if ($ratio < 100){
																				                    if ($ratio >= 65 and $ratio < 100){
																				                         echo "<span class='label label-warning'>".$ratio."</span>";
																				                     }
																				                     else {
																				                         echo "<span class='label label-danger'>".$ratio."</span>";
																				                     }
																				            }
																				            else {
																				                echo "<span class='label label-success'>".(round(($total_asuransi/$faktur_total2)*100))."</span>";
																				            }
																				           
																				        }
																				        
																				        $total_point_all= 0;
																				    ?>
																				    
																				</td>
																				
																			</tr>
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
								</div>
								
										<?php }}} ?>
								
								
								
								
								
							</div>
						</div>
						<!-- end: DYNAMIC TABLE -->
					</div>
				</div>
	
				
<?php break;
}
} ?>