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
											<input type = "hidden" name="module" value = "summary_penjualan_pameran" />
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
								if($bulan !="-") { 
								//$faktur = mysql_query("select * from summary_faktur where bulan ='$bulan' ");
								$faktur = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang,1,7) ='$bln' ");
												$tot_rec = mysql_num_rows($faktur);
												if ($tot_rec == '0') { echo "<div class='col-sm-12'> Tidak ada data pada periode Ini, silahkan pilih ulang </div>"; } 
													else {
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
												        $query = mysql_query("select * from target_spv where bulan = '$bulan' order by kode_spv desc");
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
												
												<div class="tab-content" >
													<div class="tab-pane padding-bottom-5 active" id="prospect_faktur">
														<div class="row">
															<div class="col-sm-6">
																
																
																
																	<div class="panel panel-transparent">
																		<div class="panel-heading" style = "padding:0px;">
																			<div class="panel-title">
																				<font color="<?php echo $warna; ?>">
																					<?php echo $kdspv; ?>
																				</font>
																			</div>
																		</div>
																		<div class="panel-heading" style = "padding:0px;">
																			<div class="panel-title">
																				<font>
																					DEALER
																				</font>
																			</div>
																		</div>
																		<div class="panel-body" style = "padding:0px;">
																			<div class="list-group">
																				<a class="list-group-item active">
																					<?php
																						$prospek = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln'");
																						$prospek3 = mysql_num_rows($prospek);
																					?>
																					<h5 class="list-group-item-heading">
																						PROSPEK : <?php echo $prospek3; ?>
																						<?php
																							$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and no_spk!=''");
																							$app2 = mysql_num_rows($app);
																							if($app2 < 1){
																								echo " - SPK : 0";
																							}else{
																								echo " - SPK : ".$app2;
																							}
																						?>
																					</h5>
																				</a>
																				<a class="list-group-item">
																					<?php
																						$retail = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='RETAIL'");
																						$retail2 = mysql_fetch_array($retail);
																						$retail3 = mysql_num_rows($retail);
																						$rtl =  $retail2['asal_prospek'];
																					?>
																					<h5 class="list-group-item-heading">
																						RETAIL : <?php echo $retail3; ?>
																						<?php
																							$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='RETAIL' and no_spk!=''");
																							$app2 = mysql_num_rows($app);
																							if($app2 < 1){
																								echo " - SPK : 0";
																							}else{
																								echo " - SPK : ".$app2;
																							}
																						?>
																					</h5>
																					<!--p class="list-group-item-text">
																						Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
																					</p-->
																				</a>
																				
																				<a class="list-group-item">
																					<?php
																						$moving = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='MOVING' ");
																						$moving3 = mysql_num_rows($moving);
																						$mov =  $moving2['asal_prospek'];
																					?>
																					<h5 class="list-group-item-heading">
																						MOVING : <?php echo $moving3; ?>
																						<?php
																							$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='MOVING' and no_spk!=''");
																							$app2 = mysql_num_rows($app);
																							if($app2 < 1){
																								echo " - SPK : 0";
																							}else{
																								echo " - SPK : ".$app2;
																							}
																						?>
																					</h5>
																					<p class="list-group-item-text">
																						<?php
																							$moving = mysql_query("select count(ket_asal_prospek) as ket, ket_asal_prospek from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='MOVING' group by ket_asal_prospek order by ket_asal_prospek asc");
																							while($moving2 = mysql_fetch_array($moving)){
																							$mov =  $moving2['ket_asal_prospek'];
																							$ket =  $moving2['ket'];
																							
																						?>
																						
																						<ul>
																							<li>
																								<?php echo $mov." : ".$ket; ?>
																								<?php
																									$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='MOVING' and no_spk!='' and ket_asal_prospek='$mov'");
																									$app2 = mysql_num_rows($app);
																									if($app2 < 1){
																										echo " - SPK : 0";
																									}else{
																										echo " - SPK : ".$app2;
																									}
																								?>
																							</li>
																						</ul>
																						<?php
																							}
																						?>
																					</p>
																				</a>
																				
																				<a class="list-group-item">
																					<?php
																						$event = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='EVENT' order by ket_asal_prospek asc");
																						$event3 = mysql_num_rows($event);
																					?>
																					<h5 class="list-group-item-heading">
																						EVENT : <?php echo $event3; ?>
																						<?php
																							$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='EVENT' and no_spk!=''");
																							$app2 = mysql_num_rows($app);
																							if($app2 < 1){
																								echo " - SPK : 0";
																							}else{
																								echo " - SPK : ".$app2;
																							}
																						?>
																					</h5>
																					<p class="list-group-item-text">
																						<?php
																							$event = mysql_query("select count(ket_asal_prospek) as ket, ket_asal_prospek from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='EVENT'  group by ket_asal_prospek order by ket_asal_prospek asc");
																							while($event2 = mysql_fetch_array($event)){
																								$pam =  $event2['ket_asal_prospek'];
																								$ket = $event2['ket'];
																						?>
																						<ul>
																							<li>
																								<?php echo $pam." : ".$ket; ?>
																								<?php
																									$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='EVENT' and no_spk!='' and ket_asal_prospek='$pam'");
																									$app2 = mysql_num_rows($app);
																									if($app2 < 1){
																										echo " - SPK : 0";
																									}else{
																										echo " - SPK : ".$app2;
																									}
																								?>
																							</li>
																						</ul>
																						<?php
																							}
																						?>
																					</p>
																				</a>
																				
																				<a class="list-group-item">
																				<?php
																					$pameran = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='PAMERAN' order by ket_asal_prospek asc");
																					$pameran3 = mysql_num_rows($pameran);
																				?>
																					<h5 class="list-group-item-heading">
																					    PAMERAN : <?php echo $pameran3; ?>
																					       <?php
																							$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='PAMERAN' and no_spk!=''");
																							$app2 = mysql_num_rows($app);
																							if($app2 < 1){
																								echo " - SPK : 0";
																							}else{
																								echo " - SPK : ".$app2;
																							}
																						?>
																					</h5>
																					<p class="list-group-item-text">
																						<?php
																							$pameran = mysql_query("select count(ket_asal_prospek) as ket, ket_asal_prospek from pengajuan_discount where substr(waktu, 1, 7)='$bln' and asal_prospek='PAMERAN' group by ket_asal_prospek order by ket_asal_prospek asc");
																							while($pameran2 = mysql_fetch_array($pameran)){
																								$pam =  $pameran2['ket_asal_prospek'];
																								$ket = $pameran2['ket'];
																						?>
																						<ul>
																							<li>
																								<?php echo $pam." : ".$ket; ?>
																								<?php
																									$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='PAMERAN' and no_spk!='' and ket_asal_prospek='$pam'");
																									$app2 = mysql_num_rows($app);
																									if($app2 < 1){
																										echo " - SPK : 0";
																									}else{
																										echo " - SPK : ".$app2;
																									}
																								?>
																							</li>
																						</ul>
																						<?php
																							}
																						?>
																					</p>
																				</a>
																			</div>
																		</div>
																	</div>
																
																
																
																</div>
															</div>
														<?php
															$spv = mysql_query("select * from target_spv where bulan = '$bulan' order by kode_spv desc");
															$recno = 0;
															while($spv2 = mysql_fetch_array($spv)){
																$kdspv = $spv2['kode_spv'];
																$warna = $spv2['warna'];
																$recno++;
														?>
													<?php if ($recno == 1 ){  ?> <div class="row"> <?php } ?>
														<div class="col-sm-3">
														
														
															
															<div class="panel panel-transparent">
																<div class="panel-heading" style = "padding:0px;">
																	<div class="panel-title">
																		<font color="<?php echo $warna; ?>">
																			<?php echo $kdspv; ?>
																		</font>
																	</div>
																</div>
																<div class="panel-body" style = "padding:0px;">
																	<div class="list-group">
																		<a class="list-group-item active">
																			<?php
																				$prospek = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and kode_spv='$kdspv'");
																				$prospek3 = mysql_num_rows($prospek);
																			?>
																			<h5 class="list-group-item-heading">
																				PROSPEK : <?php echo $prospek3; ?>
																				<?php
																					$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and no_spk!='' and kode_spv = '$kdspv'");
																					$app2 = mysql_num_rows($app);
																					if($app2 < 1){
																						echo " - SPK : 0";
																					}else{
																						echo " - SPK : ".$app2;
																					}
																				?>
																			</h5>
																		</a>
																		<a class="list-group-item">
																			<?php
																				$retail = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='RETAIL' and kode_spv = '$kdspv'");
																				$retail2 = mysql_fetch_array($retail);
																				$retail3 = mysql_num_rows($retail);
																				$rtl =  $retail2['asal_prospek'];
																			?>
																			<h5 class="list-group-item-heading">
																				RETAIL : <?php echo $retail3; ?>
																				<?php
																					$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='RETAIL' and no_spk!='' and kode_spv = '$kdspv'");
																					$app2 = mysql_num_rows($app);
																					if($app2 < 1){
																						echo " - SPK : 0";
																					}else{
																						echo " - SPK : ".$app2;
																					}
																				?>
																			</h5>
																			<!--p class="list-group-item-text">
																				Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
																			</p-->
																		</a>
																		
																		<a class="list-group-item">
																			<?php
																				$moving = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='MOVING' and kode_spv = '$kdspv' ");
																			//	$moving2 = mysql_fetch_array($retail);
																				$moving3 = mysql_num_rows($moving);
																				$mov =  $moving2['asal_prospek'];
																			?>
																			<h5 class="list-group-item-heading">
																				MOVING : <?php echo $moving3; ?>
																				<?php
																					$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='MOVING' and no_spk!='' and kode_spv = '$kdspv'");
																					$app2 = mysql_num_rows($app);
																					if($app2 < 1){
																						echo " - SPK : 0";
																					}else{
																						echo " - SPK : ".$app2;
																					}
																				?>
																			</h5>
																			<p class="list-group-item-text">
																				<?php
																					$moving = mysql_query("select count(ket_asal_prospek) as ket, ket_asal_prospek from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='MOVING' and kode_spv = '$kdspv' group by ket_asal_prospek order by ket_asal_prospek asc");
																					while($moving2 = mysql_fetch_array($moving)){
																					$mov =  $moving2['ket_asal_prospek'];
																					$ket =  $moving2['ket'];
																					
																				?>
																				
																				<ul>
																					<li>
																						<?php echo $mov." : ".$ket; ?>
																						<?php
																							$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='MOVING' and no_spk!='' and ket_asal_prospek='$mov' order by ket_asal_prospek asc");
																							$app2 = mysql_num_rows($app);
																							if($app2 < 1){
																								echo " - SPK : 0";
																							}else{
																								echo " - SPK : ".$app2;
																							}
																						?>
																					</li>
																					
																				</ul>
																				<?php
																					}
																				?>
																			</p>
																		</a>
																		
																		<a class="list-group-item">
																			<?php
																				$event = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7) = '$bln' and asal_prospek='EVENT' and kode_spv='$kdspv' order by ket_asal_prospek asc");
																									//  select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7) = '$bln' and asal_prospek='EVENT' and kode_spv='$kdspv' group by ket_asal_prospek order by ket_asal_prospek asc
																				$event3 = mysql_num_rows($event);
																			?>
																			<h5 class="list-group-item-heading">
																			    EVENT : <?php echo $event3; ?>
																			    <?php
																					$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='EVENT' and no_spk!='' and kode_spv = '$kdspv'");
																					$app2 = mysql_num_rows($app);
																					if($app2 < 1){
																						echo " - SPK : 0";
																					}else{
																						echo " - SPK : ".$app2;
																					}
																				?>
																			</h5>
																			<p class="list-group-item-text">
																				<?php
																					$event = mysql_query("select count(ket_asal_prospek) as ket, ket_asal_prospek from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='EVENT' and kode_spv='$kdspv' group by ket_asal_prospek order by ket_asal_prospek asc");
																					while($event2 = mysql_fetch_array($event)){
																						$evt =  $event2['ket_asal_prospek'];
																						$ket = $event2['ket'];
																				?>
																				<ul>
																					<li>
																						<?php echo $evt." : ".$ket; ?>
																						<?php
																							$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='EVENT' and no_spk!='' and kode_spv = '$kdspv' and ket_asal_prospek='$evt' order by ket_asal_prospek asc");
																							$app2 = mysql_num_rows($app);
																							if($app2 < 1){
																								echo " - SPK : 0";
																							}else{
																								echo " - SPK : ".$app2;
																							}
																						?>
																					</li>
																				</ul>
																				<?php
																					}
																				?>
																			</p>
																		</a>
																		
																		<a class="list-group-item">
																		<?php
																			$pameran = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='PAMERAN' and kode_spv = '$kdspv' order by ket_asal_prospek asc");
																			$pameran3 = mysql_num_rows($pameran);
																		?>
																			<h5 class="list-group-item-heading">
																			    PAMERAN : <?php echo $pameran3; ?>
																			    <?php
																					$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='PAMERAN' and no_spk!='' and kode_spv = '$kdspv'");
																					$app2 = mysql_num_rows($app);
																					if($app2 < 1){
																						echo " - SPK : 0";
																					}else{
																						echo " - SPK : ".$app2;
																					}
																				?>
																			    
																			</h5>
																			<p class="list-group-item-text">
																				<?php
																					$pameran = mysql_query("select count(ket_asal_prospek) as ket, ket_asal_prospek from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='PAMERAN' and kode_spv = '$kdspv' group by ket_asal_prospek order by ket_asal_prospek asc");
																					while($pameran2 = mysql_fetch_array($pameran)){
																						$pam =  $pameran2['ket_asal_prospek'];
																						$ket = $pameran2['ket'];
																				?>
																				<ul>
																					<li>
																						<?php echo $pam." : ".$ket; ?>
																						<?php
																							$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='PAMERAN' and no_spk!='' and kode_spv = '$kdspv' and ket_asal_prospek='$pam' order by ket_asal_prospek asc");
																							$app2 = mysql_num_rows($app);
																							if($app2 < 1){
																								echo " - SPK : 0";
																							}else{
																								echo " - SPK : ".$app2;
																							}
																						?>
																							
																					</li>
																				</ul>
																				<?php
																					}
																				?>
																			</p>
																		</a>
																	</div>
																</div>
															</div>
														
														
														
														</div>
													<?php if ($recno == 4){ ?></div> <?php } ?>
														<?php
															}
														?>
														
														
													</div>
												
													<?php  
													///////////////////////////////////////////////////////////////////////////////
													//////////////////////////////////////////////////////////////////////////////
													
													$query_tgtspv = mysql_query("select * from target_spv where bulan = '$bulan' order by kode_spv desc");
																			        while ($data_targetspv = mysql_fetch_array($query_tgtspv)){
																			        $kd_spv = $data_targetspv['kode_spv'];  
																			        //echo "aaaaaabbbbbbbb";
																			        
													?>
													
													
													<div id="<?php echo $kd_spv; ?>" class="tab-pane padding-bottom-5"> 
														<div class="panel-scroll height-360">
															
															
															<?php
															
															//$sales = mysql_query("select u.username as username,ts.* from target_sales ts,users u where ts.kode_spv = '$kd_spv' and ts.kode_sales = u.kode_sales and ts.bulan = '$bulan' ");
															$sales_query = mysql_query("
																select us.username as username_sales, ts.* from target_sales ts 
																left join users us on us.kode_sales = ts.kode_sales
																
																where ts.kode_spv = '$kd_spv' and ts.bulan = '$bulan'
															
															");
															
															$jml_rec_sales = mysql_num_rows($sales_query);
															$recno = 0;
															while($sales2 = mysql_fetch_array($sales_query) ){
																$username_sales = $sales2['username_sales'];
																$kd_sales   = $sales2['kode_sales'];
																//$warna = $spv2['warna'];
																
																$recno = $recno + 1;
															//echo $kd_spv. " - ".$bulan;
															
														?>
															
															<?php 
																if (substr($recno/4,2,2) == 25 ){echo "<div class = 'row'>"; } 
															
															?>
													
														<div class="col-sm-3">
														
														
														
														
															<div class="panel panel-transparent">
																<div class="panel-heading" style = "padding:0px;">
																	<div class="panel-title">
																		<font color="<?php echo $warna; ?>">
																			<?php 
																			echo $kd_sales;
																		//	echo $kd_sales. " - $recno $jml_rec_sales ---". substr(($recno /4),2,2) . " / ". $jml_rec_sales; 
													
																			?>
																		</font>
																	</div>
																</div>
																<div class="panel-body" style = "padding:0px;">
																	<div class="list-group">
																		<a class="list-group-item active">
																			<?php
																				$prospek = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and username_pemohon = '$username_sales' ");
																				$prospek3 = mysql_num_rows($prospek);
																			?>
																			<h5 class="list-group-item-heading">
																				PROSPEK : <?php echo $prospek3; ?>
																				<?php
																					$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln'  and no_spk!='' and username_pemohon = '$username_sales' ");
																					$app2 = mysql_num_rows($app);
																					if($app2 < 1){
																						echo " - SPK : 0";
																					}else{
																						echo " - SPK : ".$app2;
																					}
																				?>
																			</h5>
																		</a>
																		<a class="list-group-item">
																			<?php
																				$retail = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='RETAIL' and username_pemohon = '$username_sales' ");
																				$retail2 = mysql_fetch_array($retail);
																				$retail3 = mysql_num_rows($retail);
																				$rtl =  $retail2['asal_prospek'];
																			?>
																			<h5 class="list-group-item-heading">
																				RETAIL : <?php echo $retail3; ?>
																				<?php
																					$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='RETAIL' and no_spk!='' and username_pemohon = '$username_sales' ");
																					$app2 = mysql_num_rows($app);
																					if($app2 < 1){
																						echo " - SPK : 0";
																					}else{
																						echo " - SPK : ".$app2;
																					}
																				?>
																			</h5>
																			<!--p class="list-group-item-text">
																				Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
																			</p-->
																		</a>
																		
																		<a class="list-group-item">
																			<?php
																				$moving = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='MOVING' and username_pemohon = '$username_sales' ");
																				$moving3 = mysql_num_rows($moving);
																				$mov =  $moving2['asal_prospek'];
																			?>
																			<h5 class="list-group-item-heading">
																			    MOVING : <?php echo $moving3; ?>
																			    <?php
																					$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='MOVING' and no_spk!='' and username_pemohon = '$username_sales' ");
																					$app2 = mysql_num_rows($app);
																					if($app2 < 1){
																						echo " - SPK : 0";
																					}else{
																						echo " - SPK : ".$app2;
																					}
																				?>
																			</h5>
																			<p class="list-group-item-text">
																				<?php
																					$moving = mysql_query("select count(ket_asal_prospek) as ket, ket_asal_prospek from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='MOVING' and username_pemohon = '$username_sales' group by ket_asal_prospek order by ket_asal_prospek asc");
																					while($moving2 = mysql_fetch_array($moving)){
																					$mov =  $moving2['ket_asal_prospek'];
																					$ket =  $moving2['ket'];
																					
																				?>
																				
																				<ul>
																					<li>
																						<?php echo $mov." : ".$ket; ?>
																						<?php
																							$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='MOVING' and no_spk!='' and username_pemohon = '$username_sales' and ket_asal_prospek='$mov' order by ket_asal_prospek asc");
																							$app2 = mysql_num_rows($app);
																							if($app2 < 1){
																								echo " - SPK : 0";
																							}else{
																								echo " - SPK : ".$app2;
																							}
																						?>
																					</li>
																				</ul>
																				<?php
																					}
																				?>
																			</p>
																		</a>
																		
																		<a class="list-group-item">
																			<?php
																				$event = mysql_query("select * from pengajuan_discount where substr(waktu, 1, 7)='$bln' and asal_prospek='EVENT' and username_pemohon = '$username_sales' order by ket_asal_prospek asc");
																				$event3 = mysql_num_rows($event);
																			?>
																			<h5 class="list-group-item-heading">
																			    EVENT : <?php echo $event3; ?>
																			    <?php
																					$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='EVENT' and no_spk!='' and username_pemohon = '$username_sales' ");
																					$app2 = mysql_num_rows($app);
																					if($app2 < 1){
																						echo " - SPK : 0";
																					}else{
																						echo " - SPK : ".$app2;
																					}
																				?>
																		    </h5>
																			<p class="list-group-item-text">
																				<?php
																					$event = mysql_query("select count(ket_asal_prospek) as ket, ket_asal_prospek from pengajuan_discount where substr(waktu, 1, 7)='$bln' and asal_prospek='EVENT' and username_pemohon = '$username_sales' group by ket_asal_prospek order by ket_asal_prospek asc");
																					while($event2 = mysql_fetch_array($event)){
																						$evt =  $event2['ket_asal_prospek'];
																						$ket = $event2['ket'];
																				?>
																				<ul>
																					<li>
																						<?php echo $evt." : ".$ket; ?>
																						
																						<?php
																							$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='EVENT' and no_spk!='' and username_pemohon = '$username_sales' and ket_asal_prospek='$evt' order by ket_asal_prospek asc");
																							$app2 = mysql_num_rows($app);
																							if($app2 < 1){
																								echo " - SPK : 0";
																							}else{
																								echo " - SPK : ".$app2;
																							}
																						?>
																					</li>
																				</ul>
																				<?php
																					}
																				?>
																			</p>
																		</a>
																		
																		<a class="list-group-item">
																		<?php
																			$pameran = mysql_query("select * from pengajuan_discount where substr(waktu, 1, 7)='$bln' and asal_prospek='PAMERAN' and username_pemohon = '$username_sales' order by ket_asal_prospek asc");
																			$pameran3 = mysql_num_rows($pameran);
																		?>
																			<h5 class="list-group-item-heading">
																			    PAMERAN : <?php echo $pameran3; ?>
																			    <?php
																					$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='PAMERAN' and no_spk!='' and username_pemohon = '$username_sales' ");
																					$app2 = mysql_num_rows($app);
																					if($app2 < 1){
																						echo " - SPK : 0";
																					}else{
																						echo " - SPK : ".$app2;
																					}
																				?>
																			</h5>
																			<p class="list-group-item-text">
																				<?php
																					$pameran = mysql_query("select count(ket_asal_prospek) as ket, ket_asal_prospek from pengajuan_discount where substr(waktu, 1, 7)='$bln' and asal_prospek='PAMERAN' and username_pemohon = '$username_sales' group by ket_asal_prospek order by ket_asal_prospek asc");
																					while($pameran2 = mysql_fetch_array($pameran)){
																						$pam =  $pameran2['ket_asal_prospek'];
																						$ket = $pameran2['ket'];
																				?>
																				<ul>
																					<li>
																						<?php echo $pam." : ".$ket; ?>
																						<?php
																							//$app = mysql_query("select count(status_approve) as app from pengajuan_discount where substr(waktu, 1, 7)='$bln' and asal_prospek='PAMERAN' and username_pemohon = '$username_sales' and ket_asal_prospek='$pam' ");
																							
																						?>
																						<?php
																							$app = mysql_query("select * from pengajuan_discount where substr(tgl_pengajuan_ulang, 1, 7)='$bln' and asal_prospek='PAMERAN' and no_spk!='' and username_pemohon = '$username_sales' and ket_asal_prospek='$pam' order by ket_asal_prospek asc");
																							$app2 = mysql_num_rows($app);
																							if($app2 < 1){
																								echo " - SPK : 0";
																							}else{
																								echo " - SPK : ".$app2;
																							}
																						?>
																					</li>
																				</ul>
																				<?php
																					}
																				?>
																			</p>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													<?php 
														
													if ($recno > 2 and substr($recno/4,2,2) == ""){echo "</div>"; } 
													
													if ($recno == $jml_rec_sales and substr($jml_rec_sales/4,2,2) != ""){echo "</div>";}
													?>
														
													
													
													<?php } ?>
																
														</div>
													</div>
													
													
													<?php 
																			            
												} 
												
												}
													
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