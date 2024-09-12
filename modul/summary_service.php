<?php
session_start();
 if ($_SESSION['leveluser'] == 'SA_BP' || $_SESSION['leveluser'] == 'SA_GR' ){
  
?>
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle text-orange ">This page is PROTECTED..!!!</h1>
									
								</div>
								
							</div>
						</section>
					</div>
				</div>
<?php
}
	else {
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
									<h1 class="mainTitle">Summaryqq</h1>
									<span class="mainDescription">General Repair</span>
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
										<label class="control-label">
											Pilih Bulan <span class="symbol required"></span>
										</label>											
										<form action = "<?php echo "$_SERVER[PHP_SELF]"; ?>" method = "GET">
											<input type = "hidden" name="module" value = "sub_summary_service" />
											<div class="input-group input-append datepicker date" data-date-format='mm-yyyy'>
												<input type="text" class="form-control" name = "bulan" id = "bulan" value = "<?php if(empty($isi_lama)){
													echo "";
												} else { echo "$isi_lama";} ?>"  />
												<span class="input-group-btn">
													<button type="button" class="btn btn-default">
														<i class="glyphicon glyphicon-calendar"></i>
													</button> </span>
											</div>	
											<div class="progress-demo">
												<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" >
													<span class="ladda-label"><i class="fa fa-check"></i> Proses </span>
												</button>
											</div>
										</form>										
									</div>
								</div>		
								
								<!------------------ untuk panel per sa ------------------------------------------------------------------------------------------------>
								
								<div class="col-sm-12">
									<div class="panel panel-white no-radius">
										<div class="panel-body no-padding">
											<div class="tabbable no-margin no-padding">
												<ul class="nav nav-tabs" id="myTab">
													<li class="active padding-top-5 padding-left-5">
														<a data-toggle="tab" href="#chart">
															CHART
														</a>
													</li>
													<li class="padding-top-5 padding-left-5">
														<a data-toggle="tab" href="#ariyanto">
															ARIYANTO
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#ihsan">
															IHSAN
														</a>
													</li>
													<li class="padding-top-5 padding-left-5">
														<a data-toggle="tab" href="#suherman">
															SUHERMAN
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#taufik">
															TAUFIK
														</a>
													</li>
													<li class="padding-top-5 padding-left-5">
														<a data-toggle="tab" href="#wahyu">
															WAHYU
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#yus">
															YUS
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#cecep">
															CECEP
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#ponco">
															PONCO
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#total">
															SUMMARY
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#incentif">
															INCENTIF
														</a>
													</li>
												</ul>
												<div class="tab-content">
													
												
													<div id="ariyanto" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-360">
																<?php 
																$bulan = $_GET['bulan'];
																$dt = new hitung_persa;
																$ari_care = $dt->sagr('ari',$bulan,1);
																$ari_plus  = $dt->sagr('ari',$bulan,2);
																$ari_engineoil  = $dt->sagr('ari',$bulan,3);
																$ari_partchemical  = $dt->sagr('ari',$bulan,22);
																$ari_others  = $dt->sagr('ari',$bulan,4);
																$ari_revenue  = $dt->sagr('ari',$bulan,21);
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sample">
																		<thead>
																			<tr>
																				<th>No.</th>												
																				<th>Item</th>												
																				<th>Target Unit</th>
																				<th>Point</th>
																				<th>Result Item</th>
																				<th>Result Point</th>
																				<th>Ratio</th>												
																			</tr>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Extra Care</td><td><?php echo $ari_care[2]; ?></td><td> <?php echo $ari_care[1]; ?></td></tr>
																		</thead>
																		<tbody>
																			
																			<?php
																				echo $ari_care[0];
																				
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Plus +</td><td><?php echo $ari_plus[2]; ?></td><td> <?php echo $ari_plus[1]; ?></td></tr>
																			<?php													
																				echo $ari_plus[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Engine Oil</td><td><?php echo $ari_engineoil[2]; ?></td><td> <?php echo $ari_engineoil[1]; ?></td></tr>
																			<?php													
																				echo $ari_engineoil[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Part & Chemical</td><td><?php echo $ari_partchemical[2]; ?></td><td> <?php echo $ari_partchemical[1]; ?></td></tr>
																			<?php													
																				echo $ari_partchemical[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Others</td><td><?php echo $ari_others[2]; ?></td><td> <?php echo $ari_others[1]; ?></td></tr>
																			<?php													
																				echo $ari_others[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Revenue</td><td><?php echo $ari_revenue[2]; ?></td><td> <?php echo $ari_revenue[1]; ?></td></tr>
																			<?php													
																				echo $ari_revenue[0];
																			?>
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													
													<div id="ihsan" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-390">
																<?php 
																
																$dt = new hitung_persa;
																$ihsan_care = $dt->sagr('ihsan',$bulan,1);
																$ihsan_plus  = $dt->sagr('ihsan',$bulan,2);
																$ihsan_engineoil  = $dt->sagr('ihsan',$bulan,3);
																$ihsan_partchemical  = $dt->sagr('ihsan',$bulan,22);
																$ihsan_others  = $dt->sagr('ihsan',$bulan,4);
																$ihsan_revenue  = $dt->sagr('ihsan',$bulan,21);
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sample">
																		<thead>
																			<tr>
																				<th>No.</th>												
																				<th>Item</th>												
																				<th>Target Unit</th>
																				<th>Point</th>
																				<th>Result Item</th>
																				<th>Result Point</th>
																				<th>Ratio</th>												
																			</tr>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Extra Care</td><td><?php echo $ihsan_care[2]; ?></td><td> <?php echo $ihsan_care[1]; ?></td></tr>
																		</thead>
																		<tbody>
																			
																			<?php
																				echo $ihsan_care[0];
																				
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Plus +</td><td><?php echo $ihsan_plus[2]; ?></td><td> <?php echo $ihsan_plus[1]; ?></td></tr>
																			<?php													
																				echo $ihsan_plus[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Engine Oil</td><td><?php echo $ihsan_engineoil[2]; ?></td><td> <?php echo $ihsan_engineoil[1]; ?></td></tr>
																			<?php													
																				echo $ihsan_engineoil[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Part & Chemical</td><td><?php echo $ihsan_partchemical[2]; ?></td><td> <?php echo $ihsan_partchemical[1]; ?></td></tr>
																			<?php													
																				echo $ihsan_partchemical[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Others</td><td><?php echo $ihsan_others[2]; ?></td><td> <?php echo $ihsan_others[1]; ?></td></tr>
																			<?php													
																				echo $ihsan_others[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Revenue</td><td><?php echo $ihsan_revenue[2]; ?></td><td> <?php echo $ihsan_revenue[1]; ?></td></tr>
																			<?php													
																				echo $ihsan_revenue[0];
																			?>
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													
													<div id="suherman" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-390">
																<?php 
																
																$dt = new hitung_persa;
																$suherman_care = $dt->sagr('suherman',$bulan,1);
																$suherman_plus  = $dt->sagr('suherman',$bulan,2);
																$suherman_engineoil  = $dt->sagr('suherman',$bulan,3);
																$suherman_partchemical  = $dt->sagr('suherman',$bulan,22);
																$suherman_others  = $dt->sagr('suherman',$bulan,4);
																$suherman_revenue  = $dt->sagr('suherman',$bulan,21);
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sample">
																		<thead>
																			<tr>
																				<th>No.</th>												
																				<th>Item</th>												
																				<th>Target Unit</th>
																				<th>Point</th>
																				<th>Result Item</th>
																				<th>Result Point</th>
																				<th>Ratio</th>												
																			</tr>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Extra Care</td><td><?php echo $suherman_care[2]; ?></td><td> <?php echo $suherman_care[1]; ?></td></tr>
																		</thead>
																		<tbody>
																			
																			<?php
																				echo $suherman_care[0];
																				
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Plus +</td><td><?php echo $suherman_plus[2]; ?></td><td> <?php echo $suherman_plus[1]; ?></td></tr>
																			<?php													
																				echo $suherman_plus[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Engine Oil</td><td><?php echo $suherman_engineoil[2]; ?></td><td> <?php echo $suherman_engineoil[1]; ?></td></tr>
																			<?php													
																				echo $suherman_engineoil[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Part & Chemical</td><td><?php echo $suherman_partchemical[2]; ?></td><td> <?php echo $suherman_partchemical[1]; ?></td></tr>
																			<?php													
																				echo $suherman_partchemical[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Others</td><td><?php echo $suherman_others[2]; ?></td><td> <?php echo $suherman_others[1]; ?></td></tr>
																			<?php													
																				echo $suherman_others[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Revenue</td><td><?php echo $suherman_revenue[2]; ?></td><td> <?php echo $suherman_revenue[1]; ?></td></tr>
																			<?php													
																				echo $suherman_revenue[0];
																			?>
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													
													<div id="taufik" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-390">
																<?php 
																
																$dt = new hitung_persa;
																$taufik_care = $dt->sagr('taufik',$bulan,1);
																$taufik_plus  = $dt->sagr('taufik',$bulan,2);
																$taufik_engineoil  = $dt->sagr('taufik',$bulan,3);
																$taufik_partchemical  = $dt->sagr('taufik',$bulan,22);
																$taufik_others  = $dt->sagr('taufik',$bulan,4);
																$taufik_revenue  = $dt->sagr('taufik',$bulan,21);
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sample">
																		<thead>
																			<tr>
																				<th>No.</th>												
																				<th>Item</th>												
																				<th>Target Unit</th>
																				<th>Point</th>
																				<th>Result Item</th>
																				<th>Result Point</th>
																				<th>Ratio</th>												
																			</tr>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Extra Care</td><td><?php echo $taufik_care[2]; ?></td><td> <?php echo $taufik_care[1]; ?></td></tr>
																		</thead>
																		<tbody>
																			
																			<?php
																				echo $taufik_care[0];
																				
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Plus +</td><td><?php echo $taufik_plus[2]; ?></td><td> <?php echo $taufik_plus[1]; ?></td></tr>
																			<?php													
																				echo $taufik_plus[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Engine Oil</td><td><?php echo $taufik_engineoil[2]; ?></td><td> <?php echo $taufik_engineoil[1]; ?></td></tr>
																			<?php													
																				echo $taufik_engineoil[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Part & Chemical</td><td><?php echo $taufik_partchemical[2]; ?></td><td> <?php echo $taufik_partchemical[1]; ?></td></tr>
																			<?php													
																				echo $taufik_partchemical[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Others</td><td><?php echo $taufik_others[2]; ?></td><td> <?php echo $taufik_others[1]; ?></td></tr>
																			<?php													
																				echo $taufik_others[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Revenue</td><td><?php echo $taufik_revenue[2]; ?></td><td> <?php echo $taufik_revenue[1]; ?></td></tr>
																			<?php													
																				echo $taufik_revenue[0];
																			?>
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													
													<div id="wahyu" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-390">
																<?php 
																
																$dt = new hitung_persa;
																$wahyu_care = $dt->sagr('wahyu',$bulan,1);
																$wahyu_plus  = $dt->sagr('wahyu',$bulan,2);
																$wahyu_engineoil  = $dt->sagr('wahyu',$bulan,3);
																$wahyu_partchemical  = $dt->sagr('wahyu',$bulan,22);
																$wahyu_others  = $dt->sagr('wahyu',$bulan,4);
																$wahyu_revenue  = $dt->sagr('wahyu',$bulan,21);
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sample">
																		<thead>
																			<tr>
																				<th>No.</th>												
																				<th>Item</th>												
																				<th>Target Unit</th>
																				<th>Point</th>
																				<th>Result Item</th>
																				<th>Result Point</th>
																				<th>Ratio</th>												
																			</tr>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Extra Care</td><td><?php echo $wahyu_care[2]; ?></td><td> <?php echo $wahyu_care[1]; ?></td></tr>
																		</thead>
																		<tbody>
																			
																			<?php
																				echo $wahyu_care[0];
																				
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Plus +</td><td><?php echo $wahyu_plus[2]; ?></td><td> <?php echo $wahyu_plus[1]; ?></td></tr>
																			<?php													
																				echo $wahyu_plus[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Engine Oil</td><td><?php echo $wahyu_engineoil[2]; ?></td><td> <?php echo $wahyu_engineoil[1]; ?></td></tr>
																			<?php													
																				echo $wahyu_engineoil[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Part & Chemical</td><td><?php echo $wahyu_partchemical[2]; ?></td><td> <?php echo $wahyu_partchemical[1]; ?></td></tr>
																			<?php													
																				echo $wahyu_partchemical[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Others</td><td><?php echo $wahyu_others[2]; ?></td><td> <?php echo $wahyu_others[1]; ?></td></tr>
																			<?php													
																				echo $wahyu_others[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Revenue</td><td><?php echo $wahyu_revenue[2]; ?></td><td> <?php echo $wahyu_revenue[1]; ?></td></tr>
																			<?php													
																				echo $wahyu_revenue[0];
																			?>
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													
													<div id="yus" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-390">
																<?php 
																
																$dt = new hitung_persa;
																$yus_care = $dt->sagr('yus',$bulan,1);
																$yus_plus  = $dt->sagr('yus',$bulan,2);
																$yus_engineoil  = $dt->sagr('yus',$bulan,3);
																$yus_partchemical  = $dt->sagr('yus',$bulan,22);
																$yus_others  = $dt->sagr('yus',$bulan,4);
																$yus_revenue  = $dt->sagr('yus',$bulan,21);
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sample">
																		<thead>
																			<tr>
																				<th>No.</th>												
																				<th>Item</th>												
																				<th>Target Unit</th>
																				<th>Point</th>
																				<th>Result Item</th>
																				<th>Result Point</th>
																				<th>Ratio</th>												
																			</tr>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Extra Care</td><td><?php echo $yus_care[2]; ?></td><td> <?php echo $yus_care[1]; ?></td></tr>
																		</thead>
																		<tbody>
																			
																			<?php
																				echo $yus_care[0];
																				
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Plus +</td><td><?php echo $yus_plus[2]; ?></td><td> <?php echo $yus_plus[1]; ?></td></tr>
																			<?php													
																				echo $yus_plus[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Engine Oil</td><td><?php echo $yus_engineoil[2]; ?></td><td> <?php echo $yus_engineoil[1]; ?></td></tr>
																			<?php													
																				echo $yus_engineoil[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Part & Chemical</td><td><?php echo $yus_partchemical[2]; ?></td><td> <?php echo $yus_partchemical[1]; ?></td></tr>
																			<?php													
																				echo $yus_partchemical[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Others</td><td><?php echo $yus_others[2]; ?></td><td> <?php echo $yus_others[1]; ?></td></tr>
																			<?php													
																				echo $yus_others[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Revenue</td><td><?php echo $yus_revenue[2]; ?></td><td> <?php echo $yus_revenue[1]; ?></td></tr>
																			<?php													
																				echo $yus_revenue[0];
																			?>
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													<div id="ponco" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-390">
																<?php 
																
																$dt = new hitung_persa;
																$ponco_care = $dt->sagr('ponco',$bulan,1);
																$ponco_plus  = $dt->sagr('ponco',$bulan,2);
																$ponco_engineoil  = $dt->sagr('ponco',$bulan,3);
																$ponco_partchemical  = $dt->sagr('ponco',$bulan,22);
																$ponco_others  = $dt->sagr('ponco',$bulan,4);
																$ponco_revenue  = $dt->sagr('ponco',$bulan,21);
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sample">
																		<thead>
																			<tr>
																				<th>No.</th>												
																				<th>Item</th>												
																				<th>Target Unit</th>
																				<th>Point</th>
																				<th>Result Item</th>
																				<th>Result Point</th>
																				<th>Ratio</th>												
																			</tr>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Extra Care</td><td><?php echo $ponco_care[2]; ?></td><td> <?php echo $ponco_care[1]; ?></td></tr>
																		</thead>
																		<tbody>
																			
																			<?php
																				echo $ponco_care[0];
																				
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Plus +</td><td><?php echo $ponco_plus[2]; ?></td><td> <?php echo $ponco_plus[1]; ?></td></tr>
																			<?php													
																				echo $ponco_plus[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Engine Oil</td><td><?php echo $ponco_engineoil[2]; ?></td><td> <?php echo $ponco_engineoil[1]; ?></td></tr>
																			<?php													
																				echo $ponco_engineoil[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Part & Chemical</td><td><?php echo $ponco_partchemical[2]; ?></td><td> <?php echo $ponco_partchemical[1]; ?></td></tr>
																			<?php													
																				echo $ponco_partchemical[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Others</td><td><?php echo $ponco_others[2]; ?></td><td> <?php echo $ponco_others[1]; ?></td></tr>
																			<?php													
																				echo $ponco_others[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Revenue</td><td><?php echo $ponco_revenue[2]; ?></td><td> <?php echo $ponco_revenue[1]; ?></td></tr>
																			<?php													
																				echo $ponco_revenue[0];
																			?>
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													<div id="cecep" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-390">
																<?php 
																
																$dt = new hitung_persa;
																$cecep_care = $dt->sagr('cecep',$bulan,1);
																$cecep_plus  = $dt->sagr('cecep',$bulan,2);
																$cecep_engineoil  = $dt->sagr('cecep',$bulan,3);
																$cecep_partchemical  = $dt->sagr('cecep',$bulan,22);
																$cecep_others  = $dt->sagr('cecep',$bulan,4);
																$cecep_revenue  = $dt->sagr('cecep',$bulan,21);
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sample">
																		<thead>
																			<tr>
																				<th>No.</th>												
																				<th>Item</th>												
																				<th>Target Unit</th>
																				<th>Point</th>
																				<th>Result Item</th>
																				<th>Result Point</th>
																				<th>Ratio</th>												
																			</tr>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Extra Care</td><td><?php echo $cecep_care[2]; ?></td><td> <?php echo $cecep_care[1]; ?></td></tr>
																		</thead>
																		<tbody>
																			
																			<?php
																				echo $cecep_care[0];
																				
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Plus +</td><td><?php echo $cecep_plus[2]; ?></td><td> <?php echo $cecep_plus[1]; ?></td></tr>
																			<?php													
																				echo $cecep_plus[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Engine Oil</td><td><?php echo $cecep_engineoil[2]; ?></td><td> <?php echo $cecep_engineoil[1]; ?></td></tr>
																			<?php													
																				echo $cecep_engineoil[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Part & Chemical</td><td><?php echo $cecep_partchemical[2]; ?></td><td> <?php echo $cecep_partchemical[1]; ?></td></tr>
																			<?php													
																				echo $cecep_partchemical[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Others</td><td><?php echo $cecep_others[2]; ?></td><td> <?php echo $cecep_others[1]; ?></td></tr>
																			<?php													
																				echo $cecep_others[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Revenue</td><td><?php echo $cecep_revenue[2]; ?></td><td> <?php echo $cecep_revenue[1]; ?></td></tr>
																			<?php													
																				echo $cecep_revenue[0];
																			?>
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													<div id="total" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-390">
																<?php 
																
																$dt = new hitung_persa;
																$total_care = $dt->summary('total',$bulan,1);
																$total_plus  = $dt->summary('total',$bulan,2);
																$total_engineoil  = $dt->summary('total',$bulan,3);
																$total_partchemical  = $dt->summary('total',$bulan,22);
																$total_others  = $dt->summary('total',$bulan,4);
																$total_revenue  = $dt->summary('total',$bulan,21);
																$subtotal_ratio_care = round(($ari_care[3]+$ihsan_care[3]+$wahyu_care[3]+$yus_care[3]+$taufik_care[3]+$suherman_care[3])/6,2);																
																$subtotal_ratio_care = $dt->subtotal_ratio($subtotal_ratio_care);
																
																$subtotal_ratio_plus = round(($ari_plus[3]+$ihsan_plus[3]+$wahyu_plus[3]+$yus_plus[3]+$taufik_plus[3]+$suherman_plus[3])/6,2);
																$subtotal_ratio_plus = $dt->subtotal_ratio($subtotal_ratio_plus);
																$subtotal_ratio_engineoil = round(($ari_engineoil[3]+$ihsan_engineoil[3]+$wahyu_engineoil[3]+$yus_engineoil[3]+$taufik_engineoil[3]+$suherman_engineoil[3])/6,2);
																$subtotal_ratio_engineoil = $dt->subtotal_ratio($subtotal_ratio_engineoil);
																
																$subtotal_ratio_partchemical = round(($ari_partchemical[3]+$ihsan_partchemical[3]+$wahyu_partchemical[3]+$yus_partchemical[3]+$taufik_partchemical[3]+$suherman_partchemical[3])/6,2);
																$subtotal_ratio_partchemical = $dt->subtotal_ratio($subtotal_ratio_partchemical);
																
																$subtotal_ratio_others = round(($ari_others[3]+$ihsan_others[3]+$wahyu_others[3]+$yus_others[3]+$taufik_others[3]+$suherman_others[3])/6,2);
																$subtotal_ratio_others = $dt->subtotal_ratio($subtotal_ratio_others);
																
																$subtotal_ratio_revenue = round(($ari_revenue[3]+$ihsan_revenue[3]+$wahyu_revenue[3]+$yus_revenue[3]+$taufik_revenue[3]+$suherman_revenue[3])/6,2);
																$subtotal_ratio_revenue = $dt->subtotal_ratio($subtotal_ratio_revenue);
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sample">
																		<thead>
																			<tr>
																				<th>No.</th>												
																				<th>Item</th>												
																				<th>Target Dealer</th>
																				<th>Point</th>
																				<th>Result Item</th>
																				<th>Result Point</th>
																				<th>Ratio</th>												
																			</tr>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 7 >Extra Care Ratio : <?php echo $subtotal_ratio_care ; ?></td></tr>
																		</thead>
																		<tbody>
																			
																			<?php
																				echo $total_care[0];
																				
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 7 >Plus + Ratio : <?php echo $subtotal_ratio_plus; ?></td></tr>
																			<?php													
																				echo $total_plus[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 7 >Engine Oil Ratio : <?php echo $subtotal_ratio_engineoil; ?></td></tr>
																			<?php													
																				echo $total_engineoil[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 7 >Part & Chemical Ratio : <?php echo $subtotal_ratio_partchemical; ?></td></tr>
																			<?php													
																				echo $total_partchemical[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 7 >Others Ratio : <?php echo $subtotal_ratio_others; ?></td></tr>
																			<?php													
																				echo $total_others[0];
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 7 >Revenue Ratio : <?php echo $subtotal_ratio_revenue; ?></td></tr>
																			<?php													
																				echo $total_revenue[0];
																			?>
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													
													<div id="incentif" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-360">
															<?php
																	$query = mysql_query("SELECT nm_sa from acchv where bulan = '$bulan' group by nm_sa");
																	while ($r=mysql_fetch_array($query)){
																		$nama_sa = $nama_sa.$r[nm_sa];
																	}
																	$nama_sa = array("$nama_sa",1);
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1">
																		<thead>
																			<tr>
																				<th>NO.</th>												
																				<th>ITEM</th>												
																				<th>ARIYANTO</th>
																				<th>IHSAN</th>
																				<th>SUHERMAN</th>
																				<th>TAUFIK</th>
																				<th>WAHYU</th>
																				<th>YUS</th>
																				<th>CECEP</th>
																				<th>PONCO</th>																				
																				<th>TOTAL</th>												
																			</tr>
																		</thead>
																		<tbody>
																			<tr>
																				<?php 
																					
																					
																					$dt = new hitung_data;
																					$iu_ari = $dt->hitung_revenue_gr('ari',$bulan);
																					$iu_ari_ = ($iu_ari[1]+$iu_ari[2]);
																					$iu_ihsan = $dt->hitung_revenue_gr('ihsan',$bulan);
																					$iu_ihsan_ = ($iu_ihsan[1]+$iu_ihsan[2]);
																					$iu_suherman = $dt->hitung_revenue_gr('suherman',$bulan);
																					$iu_suherman_ = ($iu_suherman[1]+$iu_suherman[2]);
																					$iu_taufik = $dt->hitung_revenue_gr('taufik',$bulan);
																					$iu_taufik_ = ($iu_taufik[1]+$iu_taufik[2]);
																					$iu_wahyu = $dt->hitung_revenue_gr('wahyu',$bulan);
																					$iu_wahyu_ = ($iu_wahyu[1]+$iu_wahyu[2]);
																					$iu_yus = $dt->hitung_revenue_gr('yus',$bulan);
																					$iu_yus_ = ($iu_yus[1]+$iu_yus[2]);
																				
																				?>
																				<td>1</td>
																				<td>TOTAL LABOUR COST + SPARE PART</td>
																				<td><?php   echo "Rp.". number_format($iu_ari_,0,",","."); ?></td>
																				<td><?php   echo "Rp.". number_format($iu_ihsan_,0,",","."); ?></td>
																				<td><?php   echo "Rp.". number_format($iu_suherman_,0,",","."); ?></td>
																				<td><?php   echo "Rp.". number_format($iu_taufik_,0,",","."); ?></td>
																				<td><?php   echo "Rp.". number_format($iu_wahyu_,0,",","."); ?></td>
																				<td><?php   echo "Rp.". number_format($iu_yus_,0,",","."); ?></td>
																				<td></td>
																				<td></td>
																				<td><?php  $total_labour = $iu_ari_+$iu_ihsan_+$iu_suherman_+$iu_taufik_+$iu_wahyu_+$iu_yus_;
																				echo "Rp.". number_format($total_labour,0,",","."); ?></td>																				
																			</tr>	
																			<tr>
																				<td>2</td>
																				<td>TOTAL ACCHIEVEMENT BY POINT</td>
																				<td><?php $point_total_ari = $ari_plus[2]+$ari_engineoil[2]+$ari_others[2]+$ari_revenue[2];  echo $point_total_ari; ?></td>
																				<td><?php $point_total_ihsan = $ihsan_plus[2]+$ihsan_engineoil[2]+$ihsan_others[2]+$ihsan_revenue[2]; echo $point_total_ihsan ; ?></td>
																				<td><?php $point_total_suherman = $suherman_plus[2]+$suherman_engineoil[2]+$suherman_others[2]+$suherman_revenue[2]; echo $point_total_suherman ; ?></td>
																				<td><?php $point_total_taufik = $taufik_plus[2]+$taufik_engineoil[2]+$taufik_others[2]+$taufik_revenue[2]; echo $point_total_taufik ; ?></td>
																				<td><?php $point_total_wahyu = $wahyu_plus[2]+$wahyu_engineoil[2]+$wahyu_others[2]+$wahyu_revenue[2]; echo $point_total_wahyu ; ?></td>
																				<td><?php $point_total_yus = $yus_plus[2]+$yus_engineoil[2]+$yus_others[2]+$yus_revenue[2]; echo $point_total_yus ; ?></td>
																				<td></td>
																				<td></td>
																				<td></td>																				
																			</tr>												
																		
																			<tr>
																				<td>3</td>
																				<td>TOTAL ACCHIEVEMENT BY RATIO</td>
																				<td><?php $ratio_total_ari = ($ari_plus[3]+$ari_engineoil[3]+$ari_others[3]+$ari_revenue[3]) ; echo round($ratio_total_ari/4,2) . '%'; ?></td>
																				<td><?php $ratio_total_ihsan = ($ihsan_plus[3]+$ihsan_engineoil[3]+$ihsan_others[3]+$ihsan_revenue[3]); echo round($ratio_total_ihsan/4,2) . '%'; ?></td>
																				<td><?php $ratio_total_suherman = ($suherman_plus[3]+$suherman_engineoil[3]+$suherman_others[3]+$suherman_revenue[3]); echo round($ratio_total_suherman/4,2) . '%'; ?></td>
																				<td><?php $ratio_total_taufik = ($taufik_plus[3]+$taufik_engineoil[3]+$taufik_others[3]+$taufik_revenue[3]); echo round($ratio_total_taufik/4,2) . '%'; ?></td>
																				<td><?php $ratio_total_wahyu = ($wahyu_plus[3]+$wahyu_engineoil[3]+$wahyu_others[3]+$wahyu_revenue[3]); echo round($ratio_total_wahyu/4,2) . '%'; ?></td>
																				<td><?php $ratio_total_yus = ($yus_plus[3]+$yus_engineoil[3]+$yus_others[3]+$yus_revenue[3]); echo round($ratio_total_yus/4,2) . '%'; ?></td>
																				
																				<td colspan = "3" align = "center"><?php $sum_ratio = ($ratio_total_ari/4) + ($ratio_total_ihsan/4)+($ratio_total_suherman/4)+
																				($ratio_total_taufik/4)+($ratio_total_wahyu/4)+($ratio_total_yus/4); 
																				($sum_ratio/6 < 60 ? $sum_ratio_persen = "<span class='label label-danger label-mini'>".round($sum_ratio/6,2)."%</span>" : $sum_ratio_persen = "<span class='label label-success label-mini'>".round($sum_ratio/6,2)."%</span>" );
																				echo $sum_ratio_persen;
																				?></td>
																				
																			</tr>											
																		
																			<tr>
																				<td>4</td>
																				<td>TOTAL GROSS ACCHIEVEMENT</td>
																				<td><?php $dasar_incentif_ari = (((($ratio_total_ari/100)/4)*$point_total_ari)+$ari_care[2])*1000; echo "Rp.".number_format($dasar_incentif_ari,0,',','.') ; ?></td>
																				<td><?php $dasar_incentif_ihsan = (((($ratio_total_ihsan/100)/4)*$point_total_ihsan)+$ihsan_care[2])*1000; echo "Rp.".number_format($dasar_incentif_ihsan,0,',','.') ; ?></td>
																				<td><?php $dasar_incentif_suherman = (((($ratio_total_suherman/100)/4)*$point_total_suherman)+$suherman_care[2])*1000; echo "Rp.".number_format($dasar_incentif_suherman,0,',','.') ; ?></td>
																				<td><?php $dasar_incentif_taufik = (((($ratio_total_taufik/100)/4)*$point_total_taufik)+$taufik_care[2])*1000; echo "Rp.".number_format($dasar_incentif_taufik,0,',','.') ; ?></td>
																				<td><?php $dasar_incentif_wahyu = (((($ratio_total_wahyu/100)/4)*$point_total_wahyu)+$wahyu_care[2])*1000; echo "Rp.".number_format($dasar_incentif_wahyu,0,',','.') ; ?></td>
																				<td><?php $dasar_incentif_yus = (((($ratio_total_yus/100)/4)*$point_total_yus)+$yus_care[2])*1000; echo "Rp.".number_format($dasar_incentif_yus,0,',','.') ; ?></td>
																				<td><?php $dasar_incentif_cecep = ($dasar_incentif_ari+$dasar_incentif_ihsan+$dasar_incentif_suherman+
																				$dasar_incentif_taufik+$dasar_incentif_wahyu+$dasar_incentif_yus)*0.3*0.45; echo "Rp.".number_format($dasar_incentif_cecep,0,',','.'); ?></td>
																				<td><?php $dasar_incentif_ponco = ($dasar_incentif_ari+$dasar_incentif_ihsan+$dasar_incentif_suherman+
																				$dasar_incentif_taufik+$dasar_incentif_wahyu+$dasar_incentif_yus)*0.3*0.55; echo "Rp.".number_format($dasar_incentif_ponco,0,',','.'); ?></td>
																				<td><?php $dasar_incentif_total = ($dasar_incentif_ari+$dasar_incentif_ihsan+$dasar_incentif_suherman+
																				$dasar_incentif_taufik+$dasar_incentif_wahyu+$dasar_incentif_yus+$dasar_incentif_cecep+$dasar_incentif_ponco); echo "Rp.".number_format($dasar_incentif_total,0,',','.'); ?></td>
																			</tr>											
																		
																			<tr>
																				<td>5</td>
																				<td>TOTAL ACCHIEVEMENT INCENTIVE</td>
																				<td><?php $final_incentive_ari = $dasar_incentif_ari * 0.7; echo "<b>Rp.".number_format($final_incentive_ari,0,',','.')."</b>"; ?></td>
																				<td><?php $final_incentive_ihsan = $dasar_incentif_ihsan * 0.7; echo "<b>Rp.".number_format($final_incentive_ihsan,0,',','.')."</b>"; ?></td>
																				<td><?php $final_incentive_suherman = $dasar_incentif_suherman * 0.7; echo "<b>Rp.".number_format($final_incentive_suherman,0,',','.')."</b>"; ?></td>
																				<td><?php $final_incentive_taufik = $dasar_incentif_taufik * 0.7; echo "<b>Rp.".number_format($final_incentive_taufik,0,',','.')."</b>"; ?></td>
																				<td><?php $final_incentive_wahyu = $dasar_incentif_wahyu * 0.7; echo "<b>Rp.".number_format($final_incentive_wahyu,0,',','.')."</b>"; ?></td>
																				<td><?php $final_incentive_yus = $dasar_incentif_yus * 0.7; echo "<b>Rp.".number_format($final_incentive_yus,0,',','.')."</b>"; ?></td>
																				
																				
																				<td><?php 
																					$dt = new hitung_persa;
																					$cecep_care = $dt->sagr('cecep',$bulan,1);
																					
																					$final_incentive_cecep = ($cecep_care[2]*1000)+$dasar_incentif_cecep;

																					echo "<b>Rp.".number_format($final_incentive_cecep,0,',','.')."</b>"; ?>
																				
																				</td>
																				<td><?php 
																					$dt = new hitung_persa;
																					$ponco_care = $dt->sagr('ponco',$bulan,1);
																					
																					$final_incentive_ponco = ($ponco_care[2]*1000)+$dasar_incentif_ponco;

																					echo "<b>Rp.".number_format($final_incentive_ponco,0,',','.')."</b>"; ?>
																					
																				</td>
																				<td><?php echo "<b>Rp.".number_format($final_incentive_ari+$final_incentive_ihsan+$final_incentive_suherman
																				+$final_incentive_taufik+$final_incentive_wahyu+$final_incentive_yus+$final_incentive_ponco,0,',','.')."</b>"; ?></td>
																				
																			</tr>												
																	
																			<tr>
																				<?php 
																					$dt = new hitung_data;
																					$iu_ari = $dt->hitung_revenue_gr('ari',$bulan);
																					$iu_ari_ = ($iu_ari[1]+$iu_ari[2])/$iu_ari[0];
																					$iu_ihsan = $dt->hitung_revenue_gr('ihsan',$bulan);
																					$iu_ihsan_ = ($iu_ihsan[1]+$iu_ihsan[2])/$iu_ihsan[0];
																					$iu_suherman = $dt->hitung_revenue_gr('suherman',$bulan);
																					$iu_suherman_ = ($iu_suherman[1]+$iu_suherman[2])/$iu_suherman[0];
																					$iu_taufik = $dt->hitung_revenue_gr('taufik',$bulan);
																					$iu_taufik_ = ($iu_taufik[1]+$iu_taufik[2])/$iu_taufik[0];
																					$iu_wahyu = $dt->hitung_revenue_gr('wahyu',$bulan);
																					$iu_wahyu_ = ($iu_wahyu[1]+$iu_wahyu[2])/$iu_wahyu[0];
																					$iu_yus = $dt->hitung_revenue_gr('yus',$bulan);
																					$iu_yus_ = ($iu_yus[1]+$iu_yus[2])/$iu_yus[0];
																				?>
																				<td>6</td>
																				<td>INCOME / UNIT				</td>
																				<td><?php echo "Rp.".number_format(round($iu_ari_,2),0,',','.'); ?></td>
																				<td><?php echo "Rp.".number_format(round($iu_ihsan_,2),0,',','.'); ?></td>
																				<td><?php echo "Rp.".number_format(round($iu_suherman_,2),0,',','.'); ?></td>
																				<td><?php echo "Rp.".number_format(round($iu_taufik_,2),0,',','.'); ?></td>
																				<td><?php echo "Rp.".number_format(round($iu_wahyu_,2),0,',','.'); ?></td>
																				<td><?php echo "Rp.".number_format(round($iu_yus_,2),0,',','.'); ?></td>
																				<td colspan=3 align = "center"><?php $iu_total = (($iu_ari[1]+$iu_ihsan[1]+$iu_suherman[1]+$iu_taufik[1]+$iu_wahyu[1]+$iu_yus[1])+
																					($iu_ari[2]+$iu_ihsan[2]+$iu_suherman[2]+$iu_taufik[2]+$iu_wahyu[2]+$iu_yus[2]))/($iu_ari[0]+$iu_ihsan[0]+$iu_suherman[0]+$iu_taufik[0]+$iu_wahyu[0]+$iu_yus[0]); 
																					echo "Rp.".number_format(round($iu_total,2),0,',','.'); ?></td>
																				
																				
																				
																			</tr>												
																		
																			<tr>	
																				<?php 
																					
																					
																					$efisien_ari = $dt->hitung_revenue_gr('ari',$bulan);
																					$efisien_ari = $efisien_ari[0]/25;
																					$efisien_ihsan = $dt->hitung_revenue_gr('ihsan',$bulan);
																					$efisien_ihsan = $efisien_ihsan[0]/25;
																					$efisien_suherman = $dt->hitung_revenue_gr('suherman',$bulan);
																					$efisien_suherman = $efisien_suherman[0]/25;
																					$efisien_taufik = $dt->hitung_revenue_gr('taufik',$bulan);
																					$efisien_taufik = $efisien_taufik[0]/25;
																					$efisien_wahyu = $dt->hitung_revenue_gr('wahyu',$bulan);
																					$efisien_wahyu = $efisien_wahyu[0]/25;
																					$efisien_yus = $dt->hitung_revenue_gr('yus',$bulan);
																					$efisien_yus = $efisien_yus[0]/25;
																				?>
																				<td>7</td>
																				<td>SA EFFICIENCY				</td>
																				<td><?php echo $efisien_ari; ?> </td>
																				<td><?php echo $efisien_ihsan; ?> </td>
																				<td><?php echo $efisien_suherman; ?> </td>
																				<td><?php echo $efisien_taufik; ?> </td>
																				<td><?php echo $efisien_wahyu; ?> </td>
																				<td><?php echo $efisien_yus; ?> </td>
																				<td colspan = 3 align = "center"><?php echo round(($efisien_ari+$efisien_ihsan+$efisien_suherman+$efisien_taufik+$efisien_wahyu+$efisien_yus)/6,2); ?></td>
																				
																				
																			</tr>												
																		
																														
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													
													
													<script>var point_ari = "<?php echo $point_total_ari; ?>";
															var point_ihsan = "<?php echo $point_total_ihsan; ?>";
															var point_suherman = "<?php echo $point_total_suherman; ?>";
															var point_taufik = "<?php echo $point_total_taufik; ?>";
															var point_wahyu = "<?php echo $point_total_wahyu; ?>";
															var point_yus = "<?php echo $point_total_yus; ?>";
															
															var care_ari = "<?php echo $ari_care[3]; ?>";
															var care_ihsan = "<?php echo $ihsan_care[3]; ?>";
															var care_suherman = "<?php echo $suherman_care[3]; ?>";
															var care_taufik = "<?php echo $taufik_care[3]; ?>";
															var care_wahyu = "<?php echo $wahyu_care[3]; ?>";
															var care_yus = "<?php echo round($yus_care[3],2); ?>";
															
															var plus_ari = "<?php echo $ari_plus[3]; ?>";
															var plus_ihsan = "<?php echo $ihsan_plus[3]; ?>";
															var plus_suherman = "<?php echo $suherman_plus[3]; ?>";
															var plus_taufik = "<?php echo $taufik_plus[3]; ?>";
															var plus_wahyu = "<?php echo $wahyu_plus[3]; ?>";
															var plus_yus = "<?php echo round($yus_plus[3],2); ?>";
															
															var engineoil_ari = "<?php echo $ari_engineoil[3]; ?>";
															var engineoil_ihsan = "<?php echo $ihsan_engineoil[3]; ?>";
															var engineoil_suherman = "<?php echo $suherman_engineoil[3]; ?>";
															var engineoil_taufik = "<?php echo $taufik_engineoil[3]; ?>";
															var engineoil_wahyu = "<?php echo $wahyu_engineoil[3]; ?>";
															var engineoil_yus = "<?php echo round($yus_engineoil[3],2); ?>";
															
															var revenue_ari = "<?php echo $ari_revenue[3]; ?>";
															var revenue_ihsan = "<?php echo $ihsan_revenue[3]; ?>";
															var revenue_suherman = "<?php echo $suherman_revenue[3]; ?>";
															var revenue_taufik = "<?php echo $taufik_revenue[3]; ?>";
															var revenue_wahyu = "<?php echo $wahyu_revenue[3]; ?>";
															var revenue_yus = "<?php echo round($yus_revenue[3],2); ?>";
															
															var others_ari = "<?php echo $ari_others[3]; ?>";
															var others_ihsan = "<?php echo $ihsan_others[3]; ?>";
															var others_suherman = "<?php echo $suherman_others[3]; ?>";
															var others_taufik = "<?php echo $taufik_others[3]; ?>";
															var others_wahyu = "<?php echo $wahyu_others[3]; ?>";
															var others_yus = "<?php echo round($yus_others[3],2); ?>";
													</script>		
												
													<div id="chart" class="tab-pane padding-bottom-5 active">
														<div class = "row">
															<div class = "col-md-6">
															<h1 class="mainTitle">Acchievement Point</h1>
																
																		<canvas id="barChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="barLegend" class="chart-legend"></div>
																		</div>
																	
															</div>
															<div class = "col-md-6">
															<h1 class="mainTitle">Extra Care</h1>
																
																		<canvas id="lineChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="lineLegend" class="chart-legend"></div>
																		</div>
																	
															</div>
														</div>
														<div class = "row">
															<div class = "col-lg-6 col-md-12 col-sm-12">
															<h1 class="mainTitle">Plus +</h1>
																
																		<canvas id="barChart2" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="barLegend2" class="chart-legend"></div>
																		</div>
																
															</div>
															<div class = "col-lg-6 col-md-12 col-sm-12">
															<h1 class="mainTitle">Engine Oil</h1>
																
																		<canvas id="lineChart2" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="lineLegend2" class="chart-legend"></div>
																		</div>
																
															</div>
														</div>
														<div class = "row">
															<div class = "col-md-6">
															<h1 class="mainTitle">Revenue</h1>
																
																		<canvas id="pieChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="pieLegend" class="chart-legend"></div>
																		</div>
																	
															</div>
															<div class = "col-md-6">
															<h1 class="mainTitle">Others</h1>
																
																		<canvas id="doughnutChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="doughnutLegend" class="chart-legend"></div>
																		</div>
																	
															</div>
															
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								
								
								
								
								
								
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
			mysql_unbuffered_query("insert into acchv (tanggal,bulan,id_item,total,package_point,nm_sa,tgl_input) values('$tanggal','$bulan_post','$_POST[id_item]','$_POST[total]','$_POST[package_point]','$_SESSION[username]','$tgl_input')");
			
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

}} ?>