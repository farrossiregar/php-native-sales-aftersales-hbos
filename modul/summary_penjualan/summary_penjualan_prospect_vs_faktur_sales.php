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
									<span class="mainDescription">Performance Sales</span>
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
											<input type = "hidden" name="module" value = "summary_penjualan_prospect_vs_faktur_sales" />
											<div class="form-group">
												<label for="form-field-select-2">
													Pilih bulan & Tahun <span class="symbol required"></span>
												</label></br>													
												<select name = "bulan" >	
													<option value ="01" <?php if ($_GET[bulan]=='01'){echo "selected"; }?> > Januari </option>
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
													<option value="2017" <?php if ($_GET['tahun']=='2017'){echo "selected"; }?> > 2017 </option>
													<option value="2018" <?php if ($_GET['tahun']=='2018'){echo "selected"; }?> > 2018 </option>
													<option value="2019" <?php if ($_GET['tahun']=='2019'){echo "selected"; }?> > 2019 </option>
												</select>
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
											<div class="progress-demo">
												<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" >
													<span class="ladda-label"><i class="fa fa-check"></i> Proses </span>
												</button>
											</div><br/>
											<label class="control-label">
											    <font color="red"><b>Note : </b></font>Sebelum Proses,Terlebih dahulu Pilih Bulan yang akan di tampilkan <span class="symbol required"></span>
									    	</label>
										</form>										
									</div>
								</div>		
								
								<!------------------ UNTUK SS PERFORMANCE ------------------------------------------------------------------------------------------------>
								<?php 
								
								$bulan = "$_GET[bulan]"."-"."$_GET[tahun]";
								$bulan2 = "$_GET[bulan]";
								$tahun2 = "$_GET[tahun]";
								
								$bln = "$_GET[tahun]"."-"."$_GET[bulan]";
								if($bulan !="-") { $faktur = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7) ='$bln' ");
												$tot_rec = mysql_num_rows($faktur);
												if ($tot_rec == '0') { echo "<div class='col-sm-12'> Tidak ada data pada periode Ini, silahkan pilih ulang </div>"; } else {
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
												        $query = mysql_query("select * from supervisor");
																			        while ($data = mysql_fetch_array($query)){
																			        $kode_targetspv = $data[kode_supervisor];
																			      
												    
												    ?>
													 
												    <li class="padding-top-5" >
														<a data-toggle="tab" href="#<?php echo $kode_targetspv; ?>">
															<font color="<?php echo $data[warna]; ?>"><?php echo $kode_targetspv; ?> </font>
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
																		$query = mysql_query("select * from target_spv where bulan = '$bulan'");
																		while ($data = mysql_fetch_array($query)){
																			echo "<td><div style=color:$data[warna]>".substr($data[kode_spv],0,3)."</div></td>";
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
																<tr>																				
																	<td align = "left">
																		PROSPECT
																	
																	</td>
																	
																	<?php 
																		$query2 = mysql_query("select * from target_spv where bulan = '$bulan'");
																		while ($data = mysql_fetch_array($query2)){
																			//echo "<td>a</td>";
																			$query3 = mysql_query("select count(no_pengajuan) as total_prospect from pengajuan_discount where kode_spv = '$data[kode_spv]' and month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																			$data3 = mysql_fetch_array($query3);
																			echo "<td style='font-size:17px;'>".$data3[total_prospect]."</td>";
																		}
																	?>
																	<td style='font-size:17px;'>
																		<?php
																		$query3 = mysql_query("select count(no_pengajuan) as total_prospect from pengajuan_discount where month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																			$data3 = mysql_fetch_array($query3);
																			echo $data3[total_prospect] ;
																		?>
																	
																	</td>																				
																</tr>
																<tr>																				
																	<td align = "left">
																		DISETUJUI
																	
																	</td>
																	
																	<?php 
																		$query6 = mysql_query("select * from target_spv where bulan = '$bulan'");
																		while ($data2 = mysql_fetch_array($query6)){
																			//echo "<td>a</td>";
																			$query4 = mysql_query("select count(no_pengajuan) as total_disetujui from pengajuan_discount where status_approved = 'Y' and kode_spv = '$data2[kode_spv]' and month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																			$data4 = mysql_fetch_array($query4);
																			echo "<td style='font-size:17px;'>".$data4[total_disetujui]."</td>";
																		}
																	?>
																	<td style="font-size:17px;">
																		<?php 
																		$query4 = mysql_query("select count(no_pengajuan) as total_disetujui from pengajuan_discount where status_approved = 'Y' and month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																		$data4 = mysql_fetch_array($query4);
																		
																		echo $data4[total_disetujui];
																		
																		?>
																	
																	</td>																			
																</tr>
																<!--tr>																				
																	<td align = "left">
																		SPK BO
																	
																	</td>
																	
																	<?php 
																		$bulan_ini = date('m');
																		$tahun_ini = date('Y');
																		
																		$query6 = mysql_query("select * from target_spv where bulan = '$bulan'");
																		while ($data2 = mysql_fetch_array($query6)){
																			//echo "<td>a</td>";
																			$query4 = mysql_query("select count(no_spk) as total_outstanding from pesanan_kendaraan_outstanding where kode_spv = '$data2[kode_spv]' and (substr(tanggal,6,2) < '$bulan_ini' or left(tanggal,4) < '$tahun_ini') and tglfakturnaik = '' ");
																			$data4 = mysql_fetch_array($query4);
																			echo "<td style='font-size:17px;'>".$data4[total_outstanding]."</td>";
																		}
																	?>
																	<td style="font-size:17px;">
																		<?php 
																		$query4 = mysql_query("select count(no_spk) as total_outstanding from pesanan_kendaraan_outstanding where (substr(tanggal,6,2) < '$bulan_ini' or left(tanggal,4) < '$tahun_ini') ");
																		$data4 = mysql_fetch_array($query4);
																		
																		echo $data4[total_outstanding]; 
																		
																		?>
																	
																	</td>																			
																</tr-->
																<tr>																				
																	<td align = "left">
																		SPK
																	
																	</td>
																	
																	<?php 
																		$query6 = mysql_query("select * from target_spv where bulan = '$bulan'");
																		while ($data2 = mysql_fetch_array($query6)){
																			//echo "<td>a</td>";
																			$query4 = mysql_query("select count(no_pengajuan) as total_disetujui from pengajuan_discount where no_spk !='' and status_approved = 'Y' and kode_spv = '$data2[kode_spv]' and month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																			$data4 = mysql_fetch_array($query4);
																			echo "<td style='font-size:17px;'>".$data4[total_disetujui]."</td>";
																		}
																	?>
																	<td style="font-size:17px;">
																		<?php 
																		$query4 = mysql_query("select count(no_pengajuan) as total_disetujui from pengajuan_discount where no_spk !='' and status_approved = 'Y' and month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																		$data4 = mysql_fetch_array($query4);
																		
																		echo $data4[total_disetujui]; 
																		
																		?>
																	
																	</td>																			
																</tr>
																<tr>																				
																	<td align = "left">
																		FAKTUR BO
																	
																	</td>
																	
																	<?php 
																		$query6 = mysql_query("select * from target_spv where bulan = '$bulan'");
																		while ($data2 = mysql_fetch_array($query6)){
																			//echo "<td>a</td>";
																			
																			$query4 = mysql_query("select count(nama_sales) as total_disetujui from summary_faktur where kode_spv = '$data2[kode_spv]' and bulan = '$bulan' and ((month(tgl_spk) <= 12 and year(tgl_spk) < $tahun2) or (month(tgl_spk) < $bulan2 and year(tgl_spk) = '$tahun2')) ");
																			$data4 = mysql_fetch_array($query4);
																			
																			echo "<td style='font-size:17px;'>".$data4[total_disetujui]."</td>";
																		}
																	?>
																	<td style="font-size:17px;">
																		<?php 
																		$query4 = mysql_query("select count(nama_sales) as total_disetujui from summary_faktur where bulan = '$bulan' and ((month(tgl_spk) <= 12 and year(tgl_spk) < $tahun2) or (month(tgl_spk) < $bulan2 and year(tgl_spk) = '$tahun2')) ");
																		$data4 = mysql_fetch_array($query4);
																		
																		echo $data4[total_disetujui];
																		
																		?>
																	
																	</td>																			
																</tr>
																<tr>																				
																	<td align = "left">
																		FAKTUR
																	
																	</td>
																	
																	<?php 
																		$query6 = mysql_query("select * from target_spv where bulan = '$bulan'");
																		while ($data2 = mysql_fetch_array($query6)){
																			//echo "<td>a</td>";
																			$query4 = mysql_query("select count(nama_sales) as total_disetujui from summary_faktur where kode_spv = '$data2[kode_spv]' and bulan = '$bulan' and month(tgl_spk) = $bulan2 ");
																			$data4 = mysql_fetch_array($query4);
																			echo "<td style='font-size:17px;'>".$data4[total_disetujui]."</td>";
																		}
																	?>
																	<td style="font-size:17px;">
																		<?php 
																		$query4 = mysql_query("select count(nama_sales) as total_disetujui from summary_faktur where bulan = '$bulan' and month(tgl_spk) = $bulan2 ");
																		$data4 = mysql_fetch_array($query4);
																		
																		echo $data4[total_disetujui];
																		
																		?>
																	
																	</td>																			
																</tr>
																<tr>																				
																	<td align = "left">
																		RASIO (%)
																	
																	</td>
																	
																	<?php 
																		$query6 = mysql_query("select * from target_spv where bulan = '$bulan'");
																		while ($data2 = mysql_fetch_array($query6)){
																			//echo "<td>a</td>";
																			$query4 = mysql_query("select count(nama_sales) as total_faktur from summary_faktur where kode_spv = '$data2[kode_spv]' and bulan = '$bulan' and month(tgl_spk) = $bulan2 ");
																			$data4 = mysql_fetch_array($query4);
																			
																			$query3 = mysql_query("select count(no_pengajuan) as total_prospect from pengajuan_discount where kode_spv = '$data2[kode_spv]' and month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																			$data3 = mysql_fetch_array($query3);
																			
																			$ratio = round($data4[total_faktur]/$data3[total_prospect],2)*100;
																			
																			if ($ratio >= 100){
																				echo "<td style='font-size:17px;'><span class='label label-success'>".$ratio."</span></td>";
																				
																			}elseif( $ratio > 65 and $ratio <100){
																				echo "<td style='font-size:17px;'><span class='label label-warning'>".$ratio."</span></td>";
																				
																			}else {
																				echo "<td style='font-size:17px;'><span class='label label-danger'>".$ratio."</span></td>";
																			}
																				
																			
																			//
																		}
																	
																	
																		$query4 = mysql_query("select count(nama_sales) as total_faktur from summary_faktur where bulan = '$bulan' and month(tgl_spk) = $bulan2 ");
																			$data4 = mysql_fetch_array($query4);
																			
																			$query3 = mysql_query("select count(no_pengajuan) as total_prospect from pengajuan_discount where month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																			$data3 = mysql_fetch_array($query3);
																			
																			$ratio = round($data4[total_faktur]/$data3[total_prospect],2)*100;
																		
																		if ($ratio >= 100){
																				echo "<td style='font-size:17px;'><span class='label label-success'>".$ratio."</span></td>";
																				
																			}elseif( $ratio > 65 and $ratio <100){
																				echo "<td style='font-size:17px;'><span class='label label-warning'>".$ratio."</span></td>";
																				
																			}else {
																				echo "<td style='font-size:17px;'><span class='label label-danger'>".$ratio."</span></td>";
																			}
																		
																		?>
																	
																																			
																</tr>
															</tbody>
														</table>
														</div>
													</div>
												
													<?php  
													///////////////////////////////////////////////////////////////////////////////
													//////////////////////////////////////////////////////////////////////////////
													
													$query_tgtspv = mysql_query("select * from supervisor order by kode_supervisor desc");
																			        while ($data_targetspv = mysql_fetch_array($query_tgtspv)){
																			        $kode_spvtarget = $data_targetspv['kode_supervisor'];  
																			        //echo "aaaaaabbbbbbbb";
																			        
													?>
													
													
													<div id="<?php echo $kode_spvtarget; ?>" class="tab-pane padding-bottom-5"> 
														<div class="panel-scroll height-360">
															
																<div class = "table-responsive">
																	
																
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center;" >
																	
																		<thead>
																			<tr>
																			    <!--th width="5%"><font color = "<?php echo $data_targetspv[warna]; ?>"><?php echo $kode_spvtarget; ?></font></th-->
																				<td align = "left"><b>SALES</b></td>
																				<td><b>GRD</b></td>
																				<td><b>PROSP</b></td>	
																				<td><b>APPROVE</b></td>	
																				<!--td><b>SPK BO</b></td-->	
																				<td><b>SPK</b></td>
																				<td><b>FAKTUR BO</b></td>
																				<td><b>FAKTUR</b></td>
																				<td><b>(%)</b></td>
																			</tr>
																		</thead>
																		<tbody>
																				<?php 
																				//	$sales = mysql_query("select * from users where level='user' and kode_supervisor='$kode_spvtarget' order by kode_sales asc");	
																					$sales = mysql_query("select ts.kode_sales as kode_sales, u.username as username, ts.*, u.* from target_sales ts, users u where ts.kode_sales=u.kode_sales and ts.kode_spv='$kode_spvtarget' and bulan='$bulan' order by ts.grade desc ");
																					while($sql = mysql_fetch_array($sales)){
																					$nama = $sql['username'];	
																					$kode = $sql['kode_sales'];
																				?>
																			<tr>
																				<td align="left"><?php echo $kode; ?></td>
																				<td>
																					<?php echo $sql['grade'] ; ?>
																				</td>
																				<td style="font-size:17px;">
																					
																					<?php
																						$query_sales1 = mysql_query("select count(username_pemohon) as pd, username_pemohon from pengajuan_discount where kode_spv='$kode_spvtarget' and substr(tgl_pengajuan_ulang, 1, 7) = '$bln' and username_pemohon='$nama' group by username_pemohon");
																					//	$query_sales1 = mysql_query("select count(kode_sales) as pd, kode_sales from pengajuan_discount where kode_spv='$kode_spvtarget' and substr(waktu, 1, 7) = '$bln' and kode_sales='$kode' group by kode_sales");
																						$sales1 = mysql_fetch_array($query_sales1);
																						$cnt = mysql_num_rows($query_sales1);
																						   $pd = $sales1['pd'];	
																						   $nama_sales = $sales1['nama_sales'];
																						   $kdspv = $sales1['kode_spv'];
																						if($sales1 < 1){
																							echo 0; 
																						}else{
																							echo $pd;
																						}
																					?>
																				</td>
																				<td style="font-size:17px;">
																					<?php
																						$qry_sales = mysql_query("select count(status_approved) as app, username_pemohon from pengajuan_discount where kode_spv = '$kode_spvtarget' and substr(tgl_pengajuan_ulang, 1, 7) = '$bln' and username_pemohon='$nama' and status_approved='Y' group by username_pemohon");
																						$sal = mysql_fetch_array($qry_sales);
																						$count = mysql_num_rows($qry_sales);
																						$disetujui = $sal['app'];	
																							if($sal < 1){
																								echo 0;
																							}else{
																								echo $disetujui;
																							}
																					?>
																				</td>
																				<!--td style="font-size:17px;">
																					<?php
																						$bulan_ini = date('m');
																						$tahun_ini = date('Y');
																		
																						//select count(no_spk) as total_outstanding from pesanan_kendaraan_outstanding where kode_spv = '$data2[kode_spv]' and (substr(tanggal,6,2) < '$bulan_ini' or left(tanggal,4) < '$tahun_ini')
																						
																						$qry_sales = mysql_query("select count(no_spk) as total_outstanding from pesanan_kendaraan_outstanding where kode_spv = '$kode_spvtarget' and kode_sales = '$kode' and (substr(tanggal,6,2) < '$bulan_ini' or left(tanggal,4) < '$tahun_ini') and tglfakturnaik = ''");
																						$sal = mysql_fetch_array($qry_sales);
																						$count = mysql_num_rows($qry_sales);
																						$disetujui = $sal['total_outstanding'];	
																							if($sal < 1){
																								echo 0;
																							}else{
																								echo $disetujui;
																							}
																					?>
																				</td-->
																				<td style="font-size:17px;">	
																					<?php
																						$qry_sales = mysql_query("select count(status_approved) as app, username_pemohon from pengajuan_discount where kode_spv = '$kode_spvtarget' and substr(tgl_pengajuan_ulang, 1, 7) = '$bln' and username_pemohon='$nama' and status_approved='Y' and no_spk != '' group by username_pemohon");
																						$sal = mysql_fetch_array($qry_sales);
																						$count = mysql_num_rows($qry_sales);
																						$disetujui = $sal['app'];	
																							if($sal < 1){
																								echo 0;
																							}else{
																								echo $disetujui;
																							}
																					?>
																				</td>
																				<td style="font-size:17px;">
																					<?php
																						$faktur_bl = mysql_query("SELECT count(kode_sales) as faktur_bulan_lalu, kode_sales, substr(tgl_spk, 1, 11) as spk, bulan FROM `summary_faktur` where bulan = '$bulan' and substr(tgl_spk, 1, 7)!='$bln' and kode_spv='$kode_spvtarget' and kode_sales='$kode' group by kode_sales ");
																						$bl = mysql_fetch_array($faktur_bl);
																						$fbl = $bl['faktur_bulan_lalu'];	
																							if($bl < 1){
																								echo 0;
																							}else{
																								echo $fbl;
																							}
																						
																					?>
																				</td>
																				<td style="font-size:17px;">
																					<?php
																						$faktur_bi = mysql_query("SELECT count(kode_sales) as faktur_bulan_ini, kode_sales, substr(tgl_spk, 1, 11) as bulan FROM `summary_faktur` where substr(tgl_spk, 1, 7)='$bln' and kode_spv='$kode_spvtarget' and kode_sales='$kode' group by kode_sales ");
																						$bi = mysql_fetch_array($faktur_bi);
																						$fbi = $bi['faktur_bulan_ini'];	
																							if($bi < 1){
																								echo 0;
																							}else{
																								echo $fbi;
																							}
																						
																					?>
																				</td>
																				<td style="font-size:17px;">
																					<?php
																						$rasio = round(($fbi/$pd)*100);
																						if($rasio<='65'){
																							echo "<span class='label label-danger'>".$rasio."</span>";
																						}elseif($rasio >'65' && $rasio <'100'){
																							echo "<span class='label label-warning'>".$rasio."</span>";
																						}else{
																							echo "<span class='label label-success'>".$rasio."</span>";
																						}
																					?>
																				</td>
																			</tr>
																			
																				<?php
																					}
																				?>
																			<tr style="font-size:17px;">
																				<td colspan = "2"><b style=color:#007aff>TOTAL</b></td>
																				<td>
																					<b>
																					<?php
																						$qry_sales = mysql_query("select username_pemohon from pengajuan_discount where kode_spv='$kode_spvtarget' and substr(tgl_pengajuan_ulang, 1, 7) = '$bln'");
																						$count1 = mysql_num_rows($qry_sales); 
																						echo $count1;
																					?>
																					</b>
																				</td>
																				<td>
																					<b>
																					<?php 
																						$qry_sales = mysql_query("select username_pemohon from pengajuan_discount where kode_spv = '$kode_spvtarget' and substr(tgl_pengajuan_ulang, 1, 7) = '$bln' and status_approved='Y'");
																						$count2 = mysql_num_rows($qry_sales); 
																						echo $count2;
																					?>
																					</b>
																				</td>
																				<!--td>
																					<b>
																					<?php 
																						$bulan_ini = date('m');
																						$tahun_ini = date('Y');
																		
																						
																						
																						//$qry_sales = mysql_query("select count(no_spk) as total_outstanding from pesanan_kendaraan_outstanding where kode_spv = '$kode_spvtarget' and kode_sales = '$kode' and (substr(tanggal,6,2) < '$bulan_ini' or left(tanggal,4) < '$tahun_ini')");
																						
																						$qry_sales = mysql_query("select no_spk from pesanan_kendaraan_outstanding where kode_spv = '$kode_spvtarget' and (substr(tanggal,6,2) < '$bulan_ini' or left(tanggal,4) < '$tahun_ini')");
																						$count2 = mysql_num_rows($qry_sales); 
																						echo $count2;
																					?>
																					</b>
																				</td-->
																				<td>
																					<b>
																					<?php 
																						$qry_sales = mysql_query("select username_pemohon from pengajuan_discount where kode_spv = '$kode_spvtarget' and substr(tgl_pengajuan_ulang, 1, 7) = '$bln' and status_approved='Y' and no_spk !=''");
																						$count8 = mysql_num_rows($qry_sales); 
																						echo $count8;
																					?>
																					</b>
																				</td>
																				<td>
																					<b>
																					<?php
																						$qry_faktur = mysql_query("SELECT kode_sales, substr(tgl_spk, 1, 11) as bulan FROM `summary_faktur` where bulan='$bulan' and substr(tgl_spk, 1, 7)!='$bln' and kode_spv='$kode_spvtarget'");
																						$count4 = mysql_num_rows($qry_faktur);
																							echo $count4;
																					?>
																					</b>
																				</td>
																				<td>
																					<b>
																					<?php
																						$qry_faktur = mysql_query("SELECT kode_sales, substr(tgl_spk, 1, 11) as bulan FROM `summary_faktur` where substr(tgl_spk, 1, 7)='$bln' and kode_spv='$kode_spvtarget'");
																						$count6 = mysql_num_rows($qry_faktur);
																							echo $count6;
																					?>
																					</b>
																				</td>
																				<td>
																					<b>
																					<?php
																						$count3 = round(($count6/$count1)*100);
																						if($count3<='65'){
																							echo "<span class='label label-danger'>".$count3."</span>";
																						}elseif($count3 >'65' && $count3 <'100'){
																							echo "<span class='label label-warning'>".$count3."</span>";
																						}else{
																							echo "<span class='label label-success'>".$count3."</span>";
																						}
																					?>
																					
																					<b>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													
													
													<?php 
																			            
												} }
													
													?>
													
													
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<?php } ?>
								
								
								
								
								
							</div>
						</div>
						<!-- end: DYNAMIC TABLE -->
					</div>
				</div>

<?php break;
} 
}?>