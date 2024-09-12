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
		
		include "config/koneksi_sqlserver.php";
		
		include "config/koneksi_service.php";
?>
	
				<style>
					
					table div {
  
					  position:relative;
					  //height:90px;
					  width:20px;
					  
					  
					}
					table span{
						  transform: rotate(-90deg);display:block; border: 0px solid red;
						}

					.vertical-text {
						//transform: rotate(-90deg);
						text-align:center;
						white-space:nowrap;
						transform-origin:50% 50%;
						-webkit-transform: rotate(-90deg);
						-moz-transform: rotate(-90deg);
						-ms-transform: rotate(-90deg);
						-o-transform: rotate(-90deg);
						transform: rotate(-90deg);
						padding:0%;
					}
					
					.vertical-text:before {
					
					content:'';
					padding-top:100%;/* takes width as reference, + 10% for faking some extra padding */
					//width : 5px;
					display:inline-block;
					vertical-align:middle;
					
					}
				</style>

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-7">
									<h1 class="mainTitle">Summary</h1>
									<span class="mainDescription">Performance Service Advisor BP</span>
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
											<input type = "hidden" name="module" value = "service_summary_service_sa_bp" />
											<!--div class="form-group">
												<label for="form-field-select-2">
													Pilih bulan & Tahun <span class="symbol required"></span>
												</label></br>													
												<select name = "bulan" >	
													<option value ="01" <?php echo ($_GET[bulan]=='02' ? "selected" : "") ?> > Januari </option>
													<option value ="02" <?php if ($_GET[bulan]=='02'){echo "selected"; }?> > Februari </option>
													<option value ="03" <?php if ($_GET[bulan]=='03'){echo "selected"; }?> > Maret </option>
													<option value ="04" <?php if ($_GET[bulan]=='04'){echo "selected"; }?> > April </option>
													<option value ="05" <?php if ($_GET[bulan]=='05'){echo "selected"; }?> > Mei </option>
													<option value ="06" <?php if ($_GET[bulan]=='06'){echo "selected"; }?> > Juni </option>
													<option value ="07" <?php if ($_GET[bulan]=='07'){echo "selected"; }?> > Juli </option>
													<option value ="08" <?php if ($_GET[bulan]=='08'){echo "selected"; }?> > Agustus </option>
													<option value ="09" <?php if ($_GET[bulan]=='09'){echo "selected"; }?> > September </option>
													<option value ="10" <?php if ($_GET[bulan]=='10'){echo "selected"; }?> > Oktober </option>
													<option value ="11" <?php if ($_GET[bulan]=='11'){echo "selected"; }?> > November </option>
													<option value ="12" <?php if ($_GET[bulan]=='12'){echo "selected"; }?> > Desember </option>
												
													
												
												</select>
												<select name = "tahun"  >
													<option value="2017"> 2017 </option>
													<option value="2018"> 2018 </option>
												</select>
											</div-->
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
											
											<!--label class="control-label">
												Pilih Bulan <span class="symbol required"></span>
											</label>
											<div class="input-group input-append datepicker date" data-date-format='mm-yyyy'>
												<input type="text" class="form-control" name = "bulan" id = "bulan" value = "<?php if(empty($isi_lama)){
													echo "";
												} else { echo "$isi_lama";} ?>"  />
												<span class="input-group-btn">
													<button type="button" class="btn btn-default">
														<i class="glyphicon glyphicon-calendar"></i>
													</button> </span>
											</div-->	
											
											
											<div class="form-group">
												<label class="control-label">
													Pilih SA BP <span class="symbol required"></span>
												</label>
													<select name="nama_bp" id="idsatarget" onchange="tgt_sa()" >
													<option value="">--PILIH--</option>
													 <?php
													 $a="SELECT * FROM service_advisor_bp";
													 $sql=mysql_query($a);
													 while($data=mysql_fetch_array($sql)){
													 ?>
													 <option value="<?php echo $data['nama_bp']; ?>" <?php echo ($data['nama_bp'] == $_GET['nama_bp'] ? 'selected' : '') ?>><?php echo $data['nama_bp']?></option>
													 <?php
													 }
													 ?>
													 </select>
													 
											</div>
											
											<div class="progress-demo">
												<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" >
													<span class="ladda-label"><i class="fa fa-check"></i> Proses </span>
												</button>
											</div><br/>
											<label class="control-label">
											    <font color="red"><b>Note : </b></font>Sebelum Proses,Terlebih dahulu Pilih Bulan yang akan di tampilkan <span class="symbol required"></span>
									    	</label>
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
								
								//	$bulan = "$_GET[bulan]"."-"."$_GET[tahun]";
									
								/*	$tgl_awal = "$_GET[tgl_awal]";
									$bln_awal = "substr($_GET[tgl_awal], 1, 4)";
									$thn_awal = "substr($_GET[tgl_awal], 6, 2)";
									$bulan1 = "$bln_awal"."-"."$thn_awal";
									
									$tgl_akhir = "$_GET[tgl_akhir]";
									$bln_akhir = "substr($_GET[tgl_akhir], 1, 4)";
									$thn_akhir = "substr($_GET[tgl_akhir], 6, 2)";
									$bulan2 = "$bln_akhir"."-"."$thn_akhir";	*/
									
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
										$querysadetail = "select count(f.nomor) as total from srvt_faktur F
															where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'
															and f.batal = 0 ";
														
										$result = sqlsrv_query($conn, $querysadetail);		
										
										
										while($data_faktur = sqlsrv_fetch_array($result)){
											$ada_record = $data_faktur['total'];
										}
										
										
										if ($ada_record == '0') { echo "<div class='col-sm-12'> Tidak ada data pada periode Ini, silahkan pilih ulang </div>"; } else {
								?>
								
								<div class="col-sm-12">
									
									<div class="panel panel-white no-radius">
										<div class="panel-body no-padding">
											<div class="tabbable no-margin no-padding">
												<ul class="nav nav-tabs" id="myTab">
												    <!--li class="padding-top-5 padding-left-5"> 
														<a data-toggle="tab" href="#chart">
															GRAFIK
														</a>
													</li>
												    <li class="padding-top-5">
														<a data-toggle="tab" href="#incentif">
															SS PERFORMANCE
														</a>
													</li-->
													<?php 
														if ($thn_akhir - $thn_awal > 0){
															//$query = mysql_query("select * from target_serviceadvisor_bp where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) and nama_bp = '$_GET[nama_bp]' group by nama_bp order by nama_bp");
															
														}else{
															//$query = mysql_query("select * from target_serviceadvisor_bp where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and nama_bp = '$_GET[nama_bp]' group by nama_bp order by nama_bp, bulan");
															$query = mysql_query("select * from service_advisor_bp where nama_bp = '$_GET[nama_bp]'");
														}
																				
															while ($data = mysql_fetch_array($query)){
															$kode_bp = $data['nama_bp'];
															$kode_bp2 = str_replace(" ","",$kode_bp);
															
													/*	$num_row = mysql_query("select * from target_spv where bulan >= '$bulan1' and bulan <= '$bulan2' and kode_spv = '$kode_bp' group by kode_spv order by kode_spv");
															$num = mysql_num_rows($num_row);	*/
												    ?>
															<li class="active padding-top-5" >
																<a data-toggle="tab" href="#<?php echo $kode_bp2; ?>">
																	<font color="<?php echo $data[warna]; ?>"><?php echo $kode_bp; ?> </font>
																</a>
															</li>
													
													<?php } ?>
													<!--li class="padding-top-5">
														<a data-toggle="tab" href="#PM_PACKAGE">
															PM PACKAGE
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#POLES">
															POLES
														</a>
													</li-->
												
													
												</ul>
												
												<div class="tab-content">
													<div id="incentif" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-360">
															<?php
																	$query = mysql_query("SELECT nm_bp from acchv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by nm_bp");
																
																	while ($r=mysql_fetch_array($query)){
																		$nama_bp = $nama_bp.$r[nm_bp];
																	}
																	$nama_bp = array("$nama_bp",1);
																?>
																
														</div>
													</div>
													
													
													
													
													
													
												    
													<?php  
													///////////////////////////////////////////////////////////////////////////////
													//////////////////////////////////////////////////////////////////////////////
													if ($thn_akhir - $thn_awal > 0){	
														$query5 = mysql_query("select * from target_serviceadvisor_bp where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) and nama_bp = '$_GET[nama_bp]' group by nama_bp");
														
													}else{
														$query5 = mysql_query("select * from target_serviceadvisor_bp where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and nama_bp ='$_GET[nama_bp]' group by nama_bp");
													}
													//$query_tgtspv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
													
												//	$query_tgtspv = mysql_query("select * from target_spv where bulan = '$bulan'");
														while ($data_targetsa2 = mysql_fetch_array($query5))
														{
														$kode_bp = $data_targetsa2['nama_bp'];  
														$kode_bp2 = str_replace(" ","",$kode_bp);
														
																			        
													?>
													
													<div id="<?php echo $kode_bp2; ?>" class="tab-pane padding-bottom-5 active"> 
														<div class="panel-scroll height-360">
															<?php
																/*
																$query = mysql_query("SELECT nm_bp from acchv where bulan = '$bulan' group by nm_bp");
																while ($r=mysql_fetch_array($query)){
																	$nama_bp = $nama_bp.$r[nm_bp];
																}
																$nama_bp = array("$nama_bp",1);
																 */
																 //echo $kode_bp;
															?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center; border-collapse:collapse" >
																		<thead>
																			<tr>
																				<td width="30" height="29">NO</td>
																			    <td>ITEM</td>												
																				
																				<td>TGT</td>
																				<td>P</td>
																			    <?php 
																				
																					$tgl_sa = 1		;		  
																			        while ($tgl_sa < 32){
																						
																						echo "<td width='5%'><div>".$tgl_sa."</div></td>";
																						$tgl_sa ++;
																			        }
																			    ?>
																														
																				
																				<td>TOTAL</td>
																				<td>POINT</td>	
																				<td>%</td>
																															
																			</tr>
																		</thead>
																		<tbody>
																		    <?php 
																				if ($thn_akhir - $thn_awal > 0){
																					$query_sa2 = mysql_query("SELECT * FROM target_serviceadvisor_bp where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) and nama_bp = '$kode_bp' or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) and nama_bp = '$kode_bp' group by kode_kategori order by urutan ");
																					$filter_sa = "(substring(convert(varchar,f.tanggal,102),1,4) = '$thn_awal' 
																								or substring(convert(varchar,f.tanggal,102),1,4) = '$thn_akhir') ";
																								
																				}else{
																					$query_sa2 = mysql_query("SELECT * FROM target_serviceadvisor_bp where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and nama_bp = '$kode_bp' group by kode_kategori order by urutan ");
																					$filter_sa = " substring(convert(varchar,f.tanggal,102),1,4) = '$thn_awal' ";
																					
																					if ($bln_akhir - $bln_awal > 0 ){
																						$awal = $bln_awal;
																						$akhir = $bln_akhir;
																						
																						while ($akhir >= $awal){
																							
																							$akhir = $akhir -1;
																						}
																						$filter_sa2 = "(substring(convert(varchar,f.tanggal,102),6,2) = '01'
																						or substring(convert(varchar,f.tanggal,102),6,2) = '01')";
																						
																					}else{
																						$filter_sa2 = " and (substring(convert(varchar,f.tanggal,102),6,2) = '$bln_awal') ";
																						$tgl_akhir_sa = substr($tgl_akhir,9,2);
																						
																						$filter_sa3 = " and (substring(convert(varchar,f.tanggal,102),9,2) <= '$tgl_akhir_sa') ";
																					}

																				}
																				
																				$query_ppb = "select wo.penerima,f.Tanggal,Fd.kode_referensi,fd.nama_referensi from srvt_faktur F
																																					left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																					left join srvt_wo WO on wo.nomor = F.nomor_wo
																																					
																																					where convert(date,f.tanggal,105) >= '$tgl_awal' and  convert(date,f.tanggal,105) >= '$tgl_awal'
																																					
																																					
																																					and wo.penerima = '$kode_bp' 
																																					and fd.kode_referensi ='EX-PB/RU20'
																																					and f.batal = 0 order by f.tanggal ";	
																				
																				
																				
																				
																					
																			//	$query_sales = mysql_query("SELECT *, sum(target_unit) as target_unit FROM target_sales where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and kode_spv = '$kode_spvtarget' group by kode_bples order by grade desc");
																			       
																					
																					$grandtotal_kategori=0;
																					$rata2rasio = 0;
																					$total_record_extracare = 0;
																					$total_record_chemical = 0;
																					$total_rasio_chemical = 0;
																					
																					
																				   while ($data_sa2 = mysql_fetch_array($query_sa2))
																			        {
																			          
																					   $kategori = $data_sa2['kode_kategori'];
																					//	$qry_sls = mysql_query("select * from target_sales where kode_spv = '$kode_spvtarget' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and kode_bples = '$kode_bples' order by grade desc");
																					//	$num_row = mysql_num_rows($qry_sls);
																		    ?>
																								
																						
																							
																							<?php 
																								if ($thn_akhir - $thn_awal > 0){
																									$query_sa3 = mysql_query("SELECT * FROM target_serviceadvisor_bp where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) and nama_bp = '$kode_bp' or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) and nama_bp = '$kode_bp' and kode_kategori = '$kategori' order by urutan ");
																								
																								}else{
																									$query_sa3 = mysql_query("SELECT * FROM target_serviceadvisor_bp where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and nama_bp = '$kode_bp' and kode_kategori = '$kategori' order by urutan ");
																								}
																								$no = 1;
																								
																								$tot_kategori = 0;
																								$rasio_total = 0 ;
																								$jumlah_rasio = 0;
																								
																								while ($data_sa3 = mysql_fetch_array($query_sa3)){
																									$kode_item = trim($data_sa3['kode_item']);
																									
																									echo "<tr><td>$no</td><td>$data_sa3[nama_item]</td>";
																									
																									if ($data_sa3['kode_item'] =='JASA BP' || $data_sa3['kode_item'] =='SPARE PARTS BP'  ){
																										echo "<td><div style='height:80px'><br/><br/><br/><span>".number_format($data_sa3['target_unit'],0,".",".")."</span></div></td>";
																										
																										}else {
																												echo "<td>$data_sa3[target_unit]</td>";

																										}																										
																										echo "<td>$data_sa3[target_point]</td>"	;
																										  
																										$tgl_no = 1;
																										$tot_count = 0;
																										$tot_point_count = 0;
																										$tot_point_count_poles = 0;
																										while ($tgl_no <32)
																										{
																											
																											$tanggalan = (strlen($tgl_no) < 2 ? "0".$tgl_no : $tgl_no );
																											$tgl_depan = substr($_GET['tgl_awal'],8,2);
																											$tgl_belakang = substr($_GET['tgl_akhir'],8,2);
																											
																											
																											$program = $data_sa3['program'];
																											
																											switch ($program){
																												case "STANDAR":   ///////////////////////////////
																												
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													
																													
																													
																													$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																		left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																		left join srvt_wo WO on wo.nomor = F.nomor_wo
																																		
																																		where convert(date,f.tanggal,105) = '$tglawal'
																																		
																																		
																																		and wo.penerima = '$kode_bp' 
																																		and fd.kode_referensi = '$data_sa3[kode_item]'
																																		and f.batal = 0 ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													
																													while ($data = sqlsrv_fetch_array($result)){
																														$row_count = $data['total'];
																													}
																													
																													
																													
																													
																												}else {
																													$row_count = "-";
																												}
																												
																												break;
																												
																												
																												
																												case "POLES":  /////////////////////////////////////
																												
																													if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																														$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																														
																														$querysadetail = "select wo.penerima,f.Tanggal,
																																			Fd.* from SrvT_FakturBodyRepair F
																																			left join SrvT_FakturBodyRepairDetail FD on fd.Nomor_FakturBody = f.Nomor
																																			left join SrvT_WOBodyRepair WO on wo.nomor = F.Nomor_WOBody
																																												
																																					where convert(date,f.tanggal,105) = '$tglawal'
																																					
																																					
																																					and wo.penerima = '$kode_bp' 
																																					and fd.Nama_Referensi like '%POLES%' 
																																					
																																					and f.batal = 0 order by f.tanggal ";
																																				
																														$result = sqlsrv_query($conn, $querysadetail);		
																														$row_count = 0;
																														$point_count_poles = 0;		
																														while ($data = sqlsrv_fetch_array($result)){
																															
																															$query_package = mysql_query("select * from target_poles_bp where kode_item = '$data[Kode_Referensi]' and grup = '$kode_item' and bulan = '$bulan1'");
																													
																															while($data_poles = mysql_fetch_array($query_package)){	
																																	$row_count = $row_count + 1 ;
																																	$point_count_poles = $point_count_poles + $data_poles['target_point'];
																															}
																																	
																														}
																														
																													}else {
																														$row_count = "-";
																														$point_count_poles = 0;
																													}
																												
																												break;
																												
																												
																												
																												
																											}
																											if ($data_sa3['kode_item'] == 'INCOMING UNIT'){
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													//$tglakhir = "2017-12-".$tanggalan ;
																													
																													$querysadetail = "select count(f.nomor) as total from SrvT_FakturBodyRepair F
																																	left join SrvT_WOBodyRepair WO on wo.nomor = F.Nomor_WOBody																													
																															
																															
																																	where convert(date,f.tanggal,105) = '$tglawal'
																																		
																																		
																																	and wo.penerima = '$kode_bp' 
																															
																															
																																	and f.batal = 0 ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													
																													
																													//$row_count = 123;
																													
																													while($data = sqlsrv_fetch_array($result)){	
																														$row_count = $data['total'] ;
																															
																													}
																													
																													
																												
																												
																												}else {
																													$row_count = "-";
																												}	
																											}
																											
																											
																											
																											if ($data_sa3['kode_item'] == 'POLIS ASURANSI'){
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													//$tglakhir = "2017-12-".$tanggalan ;
																													
																													$querysadetail = "select count(f.kode_salesman) as total from untt_asuransipurnajual f																												
																																	
																																	where convert(date,f.tanggal,105) = '$tglawal'
																																																																				
																																	and f.kode_salesman = '$kode_bp' 																															
																																	and f.batal = 0 ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																																																									
																													while($data = sqlsrv_fetch_array($result)){	
																														$row_count = $data['total'] ;
																															
																													}
																												
																												}else {
																													$row_count = "-";
																												}	
																											}
																											
																											
																											if ($data_sa3['kode_item'] == 'PANEL'){
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													//$tglakhir = "2017-12-".$tanggalan ;
																													
																													$querysadetail = "select count(FD.Nomor_FakturBody) as total from SrvT_FakturBodyRepair F
																																	left join SrvT_FakturBodyRepairDetail FD on fd.Nomor_FakturBody = f.Nomor
																																	left join SrvT_WOBodyRepair WO on wo.nomor = F.Nomor_WOBody
																																																																
																															where convert(date,f.tanggal,105) = '$tglawal'
																																		
																																		
																															and wo.penerima = '$kode_bp' 
																															and (fd.Jenis = 3)
																															
																															and f.batal = 0 ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													
																													$row_count = 0;
																													while ($data = sqlsrv_fetch_array($result)){
																														$row_count = $data['total'];
																													}
																													
																												
																												
																												}else {
																													$row_count = "-";
																												}	
																											}
																											
																											
																											if ($data_sa3['kode_item'] == 'JASA BP'){
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													//$tglakhir = "2017-12-".$tanggalan ;
																													
																													$querysadetail = "select sum(fd.subtotal) as total from 
																																	SrvT_FakturBodyRepair F
																																	left join SrvT_FakturBodyRepairDetail FD on fd.Nomor_FakturBody = f.Nomor
																																	left join SrvT_WOBodyRepair WO on wo.nomor = F.Nomor_WOBody
																																																																
																															where convert(date,f.tanggal,105) = '$tglawal'
																																		
																																		
																															and wo.penerima = '$kode_bp' 
																															and (fd.Jenis = 3 or fd.jenis = 2)
																															
																															and f.batal = 0 ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													
																													$row_count = 0;
																													while ($data = sqlsrv_fetch_array($result)){
																														$row_count = $data['total'];
																													}
																													
																												
																												
																												}else {
																													$row_count = "-";
																												}	
																											}
																											
																											
																											if ($data_sa3['kode_item'] == 'SPARE PARTS BP'){
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													//$tglakhir = "2017-12-".$tanggalan ;
																													
																													$querysadetail = "select sum(fd.subtotal) as total from 
																																	SrvT_FakturBodyRepair F
																																	left join SrvT_FakturBodyRepairDetail FD on fd.Nomor_FakturBody = f.Nomor
																																	left join SrvT_WOBodyRepair WO on wo.nomor = F.Nomor_WOBody
																																																																
																															where convert(date,f.tanggal,105) = '$tglawal'
																																		
																																		
																															and wo.penerima = '$kode_bp' 
																															and (fd.Jenis = 1 or fd.jenis = 4)
																															
																															and f.batal = 0 ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													
																													$row_count = 0;
																													while ($data = sqlsrv_fetch_array($result)){
																														$row_count = $data['total'];
																													}
																													
																												
																												
																												}else {
																													$row_count = "-";
																												}	
																											}
																											
																											
																											
																											//$result = $row_count;
																											$result = ($row_count == 0 ? '' : number_format($row_count,0,".","."));
																										
																											if ($data_sa3['kode_item'] =='JASA BP' || $data_sa3['kode_item'] =='SPARE PARTS BP'  ){
																												//echo "<td><div><br/><br/><br/><span>".number_format($row_count,0,".",".")."</span></div></td>";
																												echo "<td><div><br/><br/><br/><span>".$result."</span></div></td>";
																											
																											}else {
																													//$result = ($row_count == 0 ? '' : number_format($row_count,0,".","."));
																													echo "<td><div>$result</div></td>";

																											}	
																											$tot_count = $tot_count + $row_count;
																											$tot_point_count =$tot_point_count +$point_count;
																											
																											$tot_point_count_poles = $tot_point_count_poles + $point_count_poles;
																											$tgl_no++;
																										}
																										
																										
																									/////////// DARI KATEGORI  //////////////	
																									if ($data_sa3['kode_kategori'] == 'EXTRA CARE'){
																										
																										$total_point_ectracare = $tot_count * $data_sa3['target_point'];
																										$tot_kategori_extracare = $tot_kategori_extracare + $total_point_ectracare + $tot_point_count;
																										if ($data_sa3['target_unit'] == '0'){
																											$total_record_extracare = $total_record_extracare + 0;
																										}else{
																											$total_record_extracare = $total_record_extracare + 1;
																										}
																										$total_rasio_extracare = $total_rasio_extracare+(($tot_count / $data_sa3['target_unit']) > 1 ? 100 :round(($tot_count / $data_sa3['target_unit'])*100,2));
																										//$tot_kategori_extracare = 1575;
																									}
																									
																									if ($data_sa3['kode_kategori'] == 'PART & CHEMICALS'){
																										if ($data_sa3['target_unit'] == '0'){
																											$total_record_chemical = $total_record_chemical + 0;
																										}else{
																											$total_record_chemical = $total_record_chemical + 1;
																										}
																										$total_rasio_chemical = $total_rasio_chemical + (($tot_count / $data_sa3['target_unit']) > 1 ? 100 :round(($tot_count / $data_sa3['target_unit'])*100,2));
																									
																									}

																									
																									
																									
																									
																									
																									
																									if ($data_sa3['kode_item'] == 'JASA BP' || $data_sa3['kode_item'] == 'SPARE PARTS BP' || $data_sa3['kode_item'] == 'INCOMING UNIT' || $data_sa3['kode_item'] == 'PANEL'){
																										if ($data_sa3['kode_item'] == 'INCOMING UNIT' || $data_sa3['kode_item'] == 'PANEL'){
																											
																											
																											echo "<td>". number_format($tot_count,0,".",".")."</td>";
																											
																											if ($tot_count / $data_sa3['target_unit'] >= 1){
																												$total_point = $data_sa3['target_point'];
																											}else{
																												$total_point = 0;
																											}
																											$tot_kategori = $tot_kategori + $total_point ;
																											
																											
																										}else{
																											if ($tot_count / $data_sa3['target_unit'] >= 1){
																												$total_point = $data_sa3[target_point];
																											}else{
																												$total_point = 0;
																											}
																											$tot_kategori = $tot_kategori + $total_point ;
																											
																											echo "<td><div><br/><br/><br/><span>". number_format($tot_count,0,".",".")."</span></div></td>";
																											if ($data_sa3['kode_item'] == 'JASA BP'){
																												$total_amount_jasa = $tot_count;
																											}
																										}
																										
																										if ($tot_count / $data_sa3['target_unit'] >= 1){
																											echo "<td>$data_sa3[target_point]</td>";
																										}else{
																											echo "<td>0</td>";
																										}
																										
																									}else {
																											$total_point = $tot_count * $data_sa3['target_point'];
																											$tot_kategori = $tot_kategori + $total_point + $tot_point_count_poles + $tot_point_count;
																										
																											echo "<td><div>$tot_count</div></td>";
																											if ($data_sa3['kode_item'] =='PM PACKAGE'){
																												echo "<td>".ceil($tot_point_count)."</td>";
																											}else if($data_sa3['program'] =='POLES'){
																												echo "<td>".ceil($tot_point_count_poles)."</td>"; 
																											}
																											
																											else{
																												echo "<td>".$total_point."</td>";
																											}

																									}	
																									
																									
																									//echo "<td>$tot_count </td>";
																									
																									
																									$rasio = (($tot_count / $data_sa3['target_unit']) > 1 ? 100 :round(($tot_count / $data_sa3['target_unit'])*100,2));
																									$rasio_total = $rasio_total + $rasio ;
																									
																									echo "<td>".$rasio ."</td>";
																									
																									echo	 "</tr>";
																									
																									if ($data_sa3['target_unit'] == '0'){
																										$jumlah_rasio = $jumlah_rasio + 0;
																									}else{
																										$jumlah_rasio = $jumlah_rasio + $data_sa3['fix_pembagi'];
																									}
																									
																									
																									$no ++;
																									
																									
																									
																									
																								}
																								
																								
																								
																								$persen_rasio = $rasio_total/$jumlah_rasio;
																								
																								
																								
																								$grand_total_kategori_rasio = $grand_total_kategori_rasio + $persen_rasio;
																								$grandtotal_kategori = $grandtotal_kategori + $tot_kategori;
																								
																								
																								if ($kategori == 'REVENUE'){
																									$total_ratio_revenue = round($total_ratio_revenue + $persen_rasio,2);
																									
																									
																								}
																								if ($kategori == 'CAR CARE'){
																									$total_ratio_carcare = round($total_ratio_carcare + $persen_rasio,2);
																									
																									
																								}
																								
																								
																							?>																		
																								<tr >
																									<td colspan=36 align=left style="background-color:darkgrey;"><?php echo $kategori; ?></td>
																									<td style="background-color:darkgrey;"><?php echo number_format($tot_kategori,0,".","."); ?></td>
																									<td style="background-color:darkgrey;"><?php echo round($persen_rasio,2); ?></td>
																																										
																								</tr>
																								
																								
																			<?php
																			        }
																					
																					//$grand_total_kategori_rasio = round(($grand_total_kategori_rasio - round($total_rasio_chemical/$total_record_chemical,2)) / 2,2);
																					$grand_total_kategori_rasio = round((($total_ratio_revenue * 3)+ $total_ratio_carcare)/4,2);
																					
																					
																					
																					
																			?>
																						<tr >
																							<td colspan=36 align=left style="background-color:darkgrey;"><?php echo "TOTAL"; ?></td>
																							<td style="background-color:darkgrey;"><?php echo number_format($grandtotal_kategori,0,".","."); ?></td>
																							<td style="background-color:darkgrey;"><?php echo $grand_total_kategori_rasio; ?></td>
																																								
																						</tr>
																						<tr >
																							<td colspan=36 align=left style="background-color:darkgrey;"><?php echo "LABOUR INCENTIVE"; ?></td>
																							<td colspan=2 style="background-color:darkgrey;"><?php 
																							$labour_incentif = $total_amount_jasa * ($grand_total_kategori_rasio / 100) * 0.018 * 0.44;
																							echo number_format($labour_incentif ,0,".","."); ?></td>
																							
																																								
																						</tr>
																						<tr >
																							<td colspan=36 align=left style="background-color:darkgrey;"><?php echo "OTHER INCENTIVE"; ?></td>
																							<td colspan=2 style="background-color:darkgrey;"><?php 
																							$other_incentif = $grandtotal_kategori * ($grand_total_kategori_rasio/100) * 1000;
																							echo number_format($other_incentif ,0,".","."); ?></td>
																							
																																								
																						</tr>
																						<tr >
																							<td colspan=36 align=left style="background-color:darkgrey;"><?php echo "TOTAL INCENTIVE"; ?></td>
																							<td colspan=2 style="background-color:darkgrey;"><?php 
																							$total_incentif = $labour_incentif + ($other_incentif*0.6);
																							echo number_format($total_incentif,0,".","."); ?></td>
																							
																																								
																						</tr>
																					
																		</tbody>
																	</table>
																</div>	
																<?php
																		
																		/*
																		echo $tot_kategori_extracare; 
																
																		$grand_total_kategori_rasio1 = (($grandtotal_kategori * ($grand_total_kategori_rasio/100)) + $tot_kategori_extracare) * 1000;
																		
																		echo "</br>".number_format($grand_total_kategori_rasio1,0,".",".") ;
																		echo  "</br>".number_format($grand_total_kategori_rasio1*0.7,0,".",".");
																		
																		
																		*/
																?>
																
															</div>
													</div>
																
																<?php 									
																	}
																?>
													
													
													
													<!--div id="PM_PACKAGE" class="tab-pane padding-bottom-5" >
															<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center; border-collapse:collapse" >
																		<thead>
																			<tr>
																				<td width="30" height="29">NO</td>
																			    <td>TIPE</td>												
																				
																				<td>PERIODE</td>
																				<td>OIL</td>
																			   							
																				
																				<td>P</td>
																				<td>QTY</td>	
																				
																															
																			</tr>
																		</thead>
																		<tbody>
													
														<?PHP
															$query5 = mysql_query("select * from target_pmpackage where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and
															(substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
															$nomor = 1;
															
															while ($data = mysql_fetch_array($query5)){
																$row_count = 0 ;
														?>
															<tr>
																	<td><?php echo $nomor; ?></td>	
																	<td><?php echo $data['type_item'] ?></td>	
																	<td><?php echo $data['periode'] ?></td>
																	<td><?php echo $data['oil'] ?></td>
																	<td><?php echo $data['point'] ?></td>
																	<?php
																		$bulan = $bln_awal.'-'.$thn_awal ;
																		
																		
																		if ($data['group_type'] == 'GROUP2' AND $data['periode'] == '3' and $data['oil'] == 'GOLD'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_bp]' 
																								and fd.Nama_Referensi like '%PPB%' and (fd.Nama_Referensi like '%BRIO%' or fd.Nama_Referensi like '%MOBILIO%' or fd.Nama_Referensi like '%JAZZ%' or fd.Nama_Referensi like '%HR-V%' or fd.Nama_Referensi like '%BRV%'
																								or fd.Nama_Referensi like '%CITY%' or fd.Nama_Referensi like '%CIVIC%' or fd.Nama_Referensi like '%CR-V%' or fd.Nama_Referensi like '%HRV%') 
																								and fd.Nama_Referensi like '%3%' and fd.Nama_Referensi like '%GOLD%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count = sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		
																		
																		
																		
																		
																		
																		
																		if ($data['group_type'] == 'GROUP2' AND $data['periode'] == '3' and $data['oil'] == 'GREEN'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_bp]' 
																								
																								and fd.Nama_Referensi like '%PPB%' and (fd.Nama_Referensi like '%BRIO%' or fd.Nama_Referensi like '%MOBILIO%' or fd.Nama_Referensi like '%JAZZ%' or fd.Nama_Referensi like '%HR-V 1.5%' or fd.Nama_Referensi like '%BRV%') 
																								and fd.Nama_Referensi like '%3%' and fd.Nama_Referensi like '%GREEN%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count = sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		
																		if ($data['group_type'] == 'GROUP2' AND $data['periode'] == '3' and $data['oil'] == 'BLUE'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_bp]' 
																								and fd.Nama_Referensi like '%PPB%' and (fd.Nama_Referensi like '%BRIO%' or fd.Nama_Referensi like '%MOBILIO%' or fd.Nama_Referensi like '%JAZZ%' or fd.Nama_Referensi like '%HR-V 1.5%' or fd.Nama_Referensi like '%BRV%') 
																								and fd.Nama_Referensi like '%3%' and fd.Nama_Referensi like '%BLUE%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count =  sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		
																		
																		
																		
																		//GROUP 2 6TAHUN ///////////////////////////////////////////// ;
																		if ($data['group_type'] == 'GROUP2' AND $data['periode'] == '6' and $data['oil'] == 'GOLD'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_bp]' 
																								
																								and fd.Nama_Referensi like '%PPB%' and (fd.Nama_Referensi like '%BRIO%' or fd.Nama_Referensi like '%MOBILIO%' or fd.Nama_Referensi like '%JAZZ%' or fd.Nama_Referensi like '%HR-V%' or fd.Nama_Referensi like '%BRV%'
																								or fd.Nama_Referensi like '%CITY%' or fd.Nama_Referensi like '%CIVIC%' or fd.Nama_Referensi like '%CR-V%' or fd.Nama_Referensi like '%HRV%') 
																								
																								and fd.Nama_Referensi like '%6 TAHUN%' and fd.Nama_Referensi like '%GOLD%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count =  sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		
																		
																		
																		if ($data['group_type'] == 'GROUP2' AND $data['periode'] == '6' and $data['oil'] == 'GREEN'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_bp]' 
																								and fd.Nama_Referensi like '%PPB%' and (fd.Nama_Referensi like '%BRIO%' or fd.Nama_Referensi like '%MOBILIO%' or fd.Nama_Referensi like '%JAZZ%' or fd.Nama_Referensi like '%HR-V 1.5%' or fd.Nama_Referensi like '%BRV%') 
																								and fd.Nama_Referensi like '%6 TAHUN%' and fd.Nama_Referensi like '%GREEN%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count =  sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		if ($data['group_type'] == 'GROUP2' AND $data['periode'] == '6' and $data['oil'] == 'BLUE'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_bp]' 
																								and fd.Nama_Referensi like '%PPB%' and (fd.Nama_Referensi like '%BRIO%' or fd.Nama_Referensi like '%MOBILIO%' or fd.Nama_Referensi like '%JAZZ%' or fd.Nama_Referensi like '%HR-V 1.5%' or fd.Nama_Referensi like '%BRV%') 
																								and fd.Nama_Referensi like '%6 TAHUN%' and fd.Nama_Referensi like '%BLUE%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count =  sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		
																		////////////////////////
																		
																		
																		////GROUP 1 (1TAHUN) / MINI ///////////////////////////
																		if ($data['group_type'] == 'GROUP1' AND $data['periode'] == 'MINI' and $data['oil'] == 'GREEN'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_bp]' 
																								
																								and fd.Nama_Referensi like '%PPB%' and fd.Nama_Referensi like '%MINI%' and fd.Nama_Referensi like '%GREEN%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count =  sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		if ($data['group_type'] == 'GROUP1' AND $data['periode'] == 'MINI' and $data['oil'] == 'GOLD'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_bp]' 
																								
																								and fd.Nama_Referensi like '%PPB%' and fd.Nama_Referensi like '%MINI%' and fd.Nama_Referensi like '%GOLD%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count =  sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		
																		/// ODYSSEY DAN ACCORD 3TAHUN GOLD/////////////////////////

																		if ($data['group_type'] == 'GROUP4' AND $data['periode'] == '3' and $data['oil'] == 'GOLD'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_bp]' 
																								
																								and fd.Nama_Referensi like '%PPB%' and (fd.Nama_Referensi like '%ACCORD%' or fd.Nama_Referensi like '%ODYSSEY%' ) 
																								and fd.Nama_Referensi like '%3%' and fd.Nama_Referensi like '%GOLD%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count =  sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}	
																		
																		
																		
																		
																		
																	
																	?>
																	<td><?PHP echo $row_count; ?></td>
																		
															</tr>			
																		
																	
														<?php
														$nomor ++;
															}
														?>
																		</tbody>
																	</table>
															</div>	
													</div-->
													<!--div id="POLES" class="tab-pane padding-bottom-5" >
															<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center; border-collapse:collapse" >
																		<thead>
																			<tr>
																				<td width="30" height="29">NO</td>
																			    <td>PAKET</td>												
																				
																				<td>JENIS</td>
																				<td>POINT</td>
																			   							
																				
																				
																				<td>QTY</td>	
																				
																															
																			</tr>
																		</thead>
																		<tbody>
													
														<?PHP
															$query5 = mysql_query("select * from target_poles where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and
															(substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
															$nomor = 1;
															while ($data = mysql_fetch_array($query5)){
														?>
															<tr>
																	<td><?php echo $nomor; ?></td>	
																	<td><?php echo $data['paket'] ?></td>	
																	<td><?php echo $data['jenis'] ?></td>
																	<td><?php echo $data['point'] ?></td>
																	
																	<td>0</td>
																		
															</tr>			
																		
																	
														<?php
														$nomor ++;
															}
														?>
																		</tbody>
																	</table>
															</div>	
														
													</div-->
													
													
													
													
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<?php }} ?>
								
								
								
								
								
							</div>
						</div>
						<!-- end: DYNAMIC TABLE -->
					</div>
				</div>
			
	<?php 
		break;
		case "tambah":
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$tanggal = date('Y-m-d',strtotime($_POST[tanggal]));
		$tanggal_post = $_POST[tanggal];
		$bulan_post = date('m-Y',strtotime($_POST[tanggal]));
        $tgl_input = date('Y-m-d H:i:s');
		if(count($_POST)) {
			mysql_unbuffered_query("insert into acchv (tanggal,bulan,id_item,total,package_point,nm_bp,tgl_input) values('$tanggal','$bulan_post','$_POST[id_item]','$_POST[total]','$_POST[package_point]','$_SESSION[username_service]','$tgl_input')");
			
				$msg = "							
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Data telah berhasil disimpan</div>";
								
		}
	?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Acchievement</h1>
									<span class="mainDescription">Input data baru</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Transaksi</span>
									</li>									
									<li class="active">
										<span>Acchievement</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" id="item_control" enctype="multipart/form-data" method="post" action="">
										<div class="row">
											<div class="col-md-12">
											<?php echo(isset ($msg) ? $msg : ''); ?>
												<div class="errorHandler alert alert-danger no-display">
													<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
												</div>
												<div class="successHandler alert alert-success no-display">
													<i class="fa fa-ok"></i> Your form validation is successful!
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														Tanggal <span class="symbol required"></span>
													</label>											
													
													<p class="input-group input-append datepicker date">
														<input type="text" class="form-control" name = "tanggal" id = "tanggal" required  />
														<span class="input-group-btn">
															<button type="button" class="btn btn-default">
																<i class="glyphicon glyphicon-calendar"></i>
															</button> </span>
													</p>
												</div>	
												<div class="form-group">
													<label for="form-field-select-2">
														Kategori <span class="symbol required"></span>
													</label>													
													<select name = "id_kategori" id="id_kategori" class = "form-control" required >														
														<option value="" selected>PILIH KATEGORI</option>
														<?php 
														if ($_SESSION[leveluser] == 'SA_GR'){
															$tampil=mysql_query("SELECT * FROM kategori where aktif = 'Y' and klasifikasi = 'GR'");
														}elseif ($_SESSION[leveluser] == 'SA_BP') {
															$tampil=mysql_query("SELECT * FROM kategori where aktif = 'Y' and klasifikasi = 'BP'");
														}else {
															$tampil=mysql_query("SELECT * FROM kategori where aktif = 'Y'");
														}
														
														while ($w = mysql_fetch_array($tampil)){															
															echo "<option value = '$w[id_kategori]'>$w[nm_kategori]</option>";															
														}
														?>
													</select>
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Item <span class="symbol required"></span>
													</label>													
													<select name = "id_item" id = "id_item" class = "form-control" required >	
														<option value = "">PILIH ITEM</option>
													</select>
												</div>
												<div id = "package" class="form-group">
													<label for="form-field-select-2">
														Type Mobil <span class="symbol required"></span>
													</label>													
													<select name = "package_point" class = "form-control" >	
														<option value = "" selected>PILIH TYPE</option>
														<?php 
															$data = mysql_query("select * from pmpackage where aktif = 'Y'");
															while ($r = mysql_fetch_array($data)){
																echo "<option value = '$r[point]'>$r[type_mobil] - $r[periode] ($r[kategori])</option>";
															}
														?>
													</select>
												</div>
												
												<div class="form-group">
													<label class="control-label">
														Total <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" type="number" value = "<?php echo $r[nm_kategori]?>" onblur="this.value=this.value.toUpperCase()" placeholder="Total" class="form-control" id="total" name="total" required>
												</div>
											</div>											
										</div>
										<div class="row">
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Harus diisi
													<hr>
												</div>
											</div>
										</div>
										<div class="row">											
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_bodyrepair';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Cancel </span>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>

<?php	
	break;
	case "edituser":
	$a = "select * from asuransi where id_asuransi='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
				
	if(count($_POST)) {
		mysql_unbuffered_query("update asuransi set nm_asuransi = '$_POST[nm_asuransi]',aktif = '$_POST[aktif]' where id_asuransi = '$_GET[id]'");
		$msg = "							
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Data telah berhasil dirubah</div>";
	}
?>

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Edit Data Asuransi</h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li>
										<span>Tabel Asuransi</span>
									</li>
									<li class="active">
										<span>Edit Data</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" id="frm_kategori" enctype="multipart/form-data" method="post" action="">
										<div class="row">
											<div class="col-md-12">
											<?php echo(isset ($msg) ? $msg : ''); ?>
												<div class="errorHandler alert alert-danger no-display">
													<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
												</div>
												<div class="successHandler alert alert-success no-display">
													<i class="fa fa-ok"></i> Your form validation is successful!
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														Nama Item <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" type="text" value = "<?php echo $r[nm_asuransi]?>" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Asuransi" class="form-control" id="nm_asuransi" name="nm_asuransi" required>
												</div>												
												<?php if ($r[aktif] == 'Y'){?>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio1" name="aktif" value="Y" checked = "checked">
													<label for="radio1">
														Yes
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="aktif" value="N">
													<label for="radio2">
														No
													</label>
												</div>
												<?php } else { ?>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio1" name="aktif" value="Y">
													<label for="radio1">
														Yes
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="aktif" value="N" checked="checked">
													<label for="radio2">
														No
													</label>
												</div>
												<?php } ?>
											</div>											
										</div>
										<div class="row">
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Harus diisi
													<hr>
												</div>
											</div>
										</div>
										<div class="row">											
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_master_list_asuransi';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Cancel </span>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>
<?php break;
}
} ?>