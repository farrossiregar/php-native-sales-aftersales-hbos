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
	
				<script language="JavaScript">
					function warning() {
						return confirm('Anda yakin menghapus data ini?');
					}
				</script>

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Body Repair</h1>
									<span class="mainDescription">Job Control</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Body Repair</span>
									</li>
									<li class="active">
										<span>Job Control</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class = "row">
										
								
								<div class="col-sm-12">
									<div class="panel panel-white no-radius">
										<div class="panel-body no-padding">
											<div class="tabbable no-margin no-padding">
												<ul class="nav nav-tabs" id="myTab">
													<li class="active padding-top-5 padding-left-5">
														<a data-toggle="tab" href="#asuransi">
															ASURANSI
														</a>
													</li>
													<li class="padding-top-5 padding-left-5">
														<a data-toggle="tab" href="#fariz">
															FARIZ
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#iqbal">
															IQBAL
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
													<div id="asuransi" class="tab-pane padding-bottom-5 active">
														<div class="panel-scroll height-360">
																<?php 
																$bulan_ini = date('m-Y');
																$bulan_ini2 = date('d-m-Y');
																$query = mysql_query("select * from acchv_asuransi where bulan = '$bulan_ini' ");
																$ada_record = mysql_num_rows($query);
																if ($ada_record == 0){
																	$query = mysql_query("select * from asuransi where aktif = 'Y'");
																	while ($r = mysql_fetch_array($query)){
																		mysql_query("insert into acchv_asuransi (id_asuransi,nm_asuransi,bulan,tanggal,total) values ('$r[id_asuransi]','$r[nm_asuransi]','$bulan_ini','$bulan_ini2',0)");
																	}
																	
																}
																
																$dt = new hitung_asuransi;
																$asuransi = $dt->tampil_asuransi(date("m-Y"));
																
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sample">
																		<thead>
																			<tr>
																				<th>No.</th>												
																				<th>Nama Asuransi</th>	
																				<th>Total</th>	
																				<th>Aksi</th>	
																															
																			</tr>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 4 >Asuransi : <?php echo $asuransi[1]; ?></td></tr>
																			<tr><td>1</td><td>NON ASURANSI</td><td><?php echo $asuransi[2] ?></td>
																			
																			<td align="center">
																				<a class="btn btn-xs btn-warning" href="media.php?module=sub_bodyrepair_jobcontrol&act=edituser&id=<?php echo "$asuransi[3]"; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Update ; ?>">

																					Edit <i class="fa fa-pencil"></i>
																				</a>
																				
																			</td>
																			</tr>
																			
																		</thead>
																		<tbody>
																			
																			<?php
																				echo $asuransi[0];																				
																			?>
																			
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													
													<div id="fariz" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-360">
																<?php 
									
																$dt = new hitung_persa;
																$fariz_care = $dt->sabp('fariz',date("m-Y"),7);
																$fariz_revenue  = $dt->sabp('fariz',date("m-Y"),23);
																
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
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Car Care</td><td><?php echo $fariz_care[2]; ?></td><td> <?php echo $fariz_care[1]; ?></td></tr>
																		</thead>
																		<tbody>
																			
																			<?php
																				echo $fariz_care[0];
																				
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Revenue</td><td><?php echo $fariz_revenue[2]; ?></td><td> <?php echo $fariz_revenue[1]; ?></td></tr>
																			<?php													
																				echo $fariz_revenue[0];
																			?>
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													<div id="iqbal" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-360">
																<?php 
									
																$dt = new hitung_persa;
																
																$iqbal_care = $dt->sabp('iqbal',date("m-Y"),7);
																$iqbal_revenue  = $dt->sabp('iqbal',date("m-Y"),23);
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
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Car Care</td><td><?php echo $iqbal_care[2]; ?></td><td> <?php echo $iqbal_care[1]; ?></td></tr>
																		</thead>
																		<tbody>
																			
																			<?php
																				echo $iqbal_care[0];
																				
																			?>
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 5 >Revenue</td><td><?php echo $iqbal_revenue[2]; ?></td><td> <?php echo $iqbal_revenue[1]; ?></td></tr>
																			<?php													
																				echo $iqbal_revenue[0];
																			?>
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													<div id="incentif" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-360">
															<?php
																	$dt = new hitung_data;
										
																	//Untuk FARIZ
																	$gt_care = $dt->data1('fariz',date("m-Y"),7);
																	$gt_revenue = $dt->data1('fariz',date("m-Y"),23);									
																	
																	$tot_point = $gt_care[0] + $gt_revenue[0];
																	$tot_ratio = ((($gt_revenue[1]*3)+$gt_care[1])/4);								
																	
																	
																	$jasabp = $dt->data2('fariz',date("m-Y"));
																	
																	$labour_incentive = ($jasabp[0] * $tot_ratio) * 0.018 * (40/100);
																	$other_incentive = $tot_point * $tot_ratio * 1000;
																	$final_incentive = ($labour_incentive + ($other_incentive*0.65));
																	$panel = $jasabp[1]/$jasabp[2];
																	$jasapanel = $jasabp[0]/$jasabp[1];
																	$iuunit = ($jasabp[0]+$jasabp[3]) / $jasabp[2];
																	
																	
																	
																	// Untuk IQBAL
																	
																	$gt_care_iqbal = $dt->data1('iqbal',date("m-Y"),7);
																	$gt_revenue_iqbal = $dt->data1('iqbal',date("m-Y"),23);
																	
																	$tot_point_iqbal = $gt_care_iqbal[0] + $gt_revenue_iqbal[0];
																	$tot_ratio_iqbal = ((($gt_revenue_iqbal[1]*3)+$gt_care_iqbal[1])/4);
																	
																	$jasabp_iqbal = $dt->data2('iqbal',date("m-Y"));
																	
																	$labour_incentive_iqbal = ($jasabp_iqbal[0] * $tot_ratio_iqbal) * 0.018 * (40/100);
																	$other_incentive_iqbal = $tot_point_iqbal * $tot_ratio_iqbal * 1000;
																	$final_incentive_iqbal = ($labour_incentive_iqbal + ($other_incentive_iqbal*0.65));
																	$panel_iqbal = $jasabp_iqbal[1]/$jasabp_iqbal[2];
																	$jasapanel_iqbal = $jasabp_iqbal[0]/$jasabp_iqbal[1];
																	$iuunit_iqbal = ($jasabp_iqbal[0]+$jasabp_iqbal[3]) / $jasabp_iqbal[2];
																	
																	//foreman
																	$incentive_dedi = (($jasabp[0] * $tot_ratio) + ($jasabp_iqbal[0] * $tot_ratio_iqbal)) * 0.018 * 0.17 ;
																	$incentive_novis = (($jasabp[0] * $tot_ratio) + ($jasabp_iqbal[0] * $tot_ratio_iqbal)) * 0.018 * 0.13 ;
																	$incentive_rizal = (($jasabp[0] * $tot_ratio) + ($jasabp_iqbal[0] * $tot_ratio_iqbal)) * 0.018 * 0.30 ;
																	
																	//other incentive
																	$tot_other = $other_incentive + $other_incentive_iqbal ;
																	
																	//total
																	$subtotal_point = $tot_point + $tot_point_iqbal;
																	$subtotal_ratio = round((($tot_ratio + $tot_ratio_iqbal)*100)/2,2);
																	$subtotal_ratio =($subtotal_ratio > 90 ? "<span class='label label-success label-mini'>$subtotal_ratio%</span>" : "<span class='label label-danger label-mini'>$subtotal_ratio%</span>")
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1">
																		<thead>
																			<tr>
																				<th>NO.</th>												
																				<th>ITEM</th>												
																				<th>FARIZ</th>
																				<th>IQBAL</th>
																				<th>DEDI</th>
																				<th>NOVIS</th>
																				<th>RIZAL</th>												
																				<th>TOTAL</th>												
																			</tr>
																		</thead>
																		<tbody>
																			<tr>
																				<td>1</td>
																				<td>TOTAL ACCHIEVEMENT BY POINT</td>
																				<td><?php echo $tot_point; ?></td>
																				<td></td<td><?php echo $tot_point_iqbal; ?></td>
																				<td></td>
																				<td></td>
																				<td></td>
																				<td><?php echo $subtotal_point; ?></td>
																			</tr>												
																		
																			<tr>
																				<td>2</td>
																				<td>TOTAL ACCHIEVEMENT BY RATIO</td>
																				<td><?php echo round($tot_ratio*100,2)." %"; ?></td>
																				<td><?php echo round($tot_ratio_iqbal*100,2)." %"; ?></td>
																				<td></td>
																				<td></td>
																				<td></td>
																				<td><?php echo $subtotal_ratio ; ?></td>
																			</tr>												
																		
																			<tr>
																				<td>3</td>
																				<td>ACCHIEVEMENT LABOUR INCENTIVE</td>
																				<td><?php echo "Rp.".number_format($labour_incentive,0,',','.'); ?></td>
																				<td><?php echo "Rp.".number_format($labour_incentive_iqbal,0,',','.'); ?></td>
																				<td><?php echo "Rp.".number_format($incentive_dedi,0,',','.'); ?></td>
																				<td><?php echo "Rp.".number_format($incentive_novis,0,',','.'); ?></td>
																				<td><?php echo "Rp.".number_format($incentive_rizal,0,',','.'); ?></td>
																				<td></td>
																			</tr>												
																		
																			<tr>
																				<td>4</td>
																				<td>ACCHIEVEMENT OTHER INCENTIVE				</td>
																				<td><?php echo "Rp.".number_format($other_incentive,0,',','.'); ?></td>
																				<td><?php echo "Rp.".number_format($other_incentive_iqbal,0,',','.'); ?></td>
																				<td colspan = 3 align = "center"><?php echo "Rp.".number_format($tot_other,0,',','.'); ?></td>
																				
																				<td></td>
																			</tr>												
																		
																			<tr>
																				<td>5</td>
																				<td>TOTAL ACCHIEVEMENT INCENTIVE</td>
																				<td><?php echo "<b>Rp.".number_format($final_incentive,0,',','.')."</b>"; ?></td>
																				<td><?php echo "<b>Rp.".number_format($final_incentive_iqbal,0,',','.')."</b>"; ?></td>
																				
																				<td><?php echo "<b>Rp.".number_format($incentive_dedi+($tot_other*0.1),0,',','.')."</b>"; ?></td>
																				<td><?php echo "<b>Rp.".number_format($incentive_novis+($tot_other*0.1),0,',','.')."</b>"; ?></td>
																				<td><?php echo "<b>Rp.".number_format($incentive_rizal+($tot_other*0.15),0,',','.')."</b>"; ?></td>
																				<td><?php echo "<b>Rp.".number_format($final_incentive+$final_incentive_iqbal+$incentive_dedi+($tot_other*0.1)
																				+$incentive_novis+($tot_other*0.1)+$incentive_rizal+($tot_other*0.15),0,',','.')."</b>"; ?></td>
																			</tr>												
																	
																			<tr>
																				<td>6</td>
																				<td>PANEL / UNIT				</td>
																				<td><?php echo round($panel,2); ?></td>
																				<td><?php echo round($panel_iqbal,2); ?></td>
																				<td></td>
																				<td></td>
																				<td></td>
																				<td><?php echo round(($panel+$panel_iqbal)/2,2); ?></td>
																			</tr>												
																		
																			<tr>
																				<td>7</td>
																				<td>JASA PER-PANEL				</td>
																				<td><?php echo "Rp.".number_format(round($jasapanel,2),0,',','.'); ?></td>
																				<td><?php echo "Rp.".number_format(round($jasapanel_iqbal,2),0,',','.'); ?></td>
																				<td></td>
																				<td></td>
																				<td></td>
																				<td><?php echo "Rp.".number_format(round(($jasapanel+jasabp_iqbal)/2,2),0,',','.'); ?></td>
																			</tr>												
																		
																			<tr>
																				<td>8</td>
																				<td>INCOME PER-UNIT				</td>
																				<td><?php echo "Rp.".number_format(round($iuunit,2),0,',','.'); ?></td>
																				<td><?php echo "Rp.".number_format(round($iuunit_iqbal,2),0,',','.'); ?></td>
																				<td></td>
																				<td></td>
																				<td></td>
																				<td><?php echo "Rp.".number_format(round(($iuunit+$iuunit_iqbal)/2,2),0,',','.'); ?></td>
																			</tr>												
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													<div id="total" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-390">
																<?php 
																$bulan = date("m-Y");
																$dt = new hitung_persa;
																$total_care = $dt->summary_bp('total',$bulan,7);																
																$total_revenue  = $dt->summary_bp('total',$bulan,23);
																
																$dt = new hitung_persa;
																
																$iqbal_care = $dt->sabp('iqbal','',7);
																$iqbal_revenue  = $dt->sabp('iqbal','',23);
																$fariz_care = $dt->sabp('fariz','',7);
																$fariz_revenue  = $dt->sabp('fariz','',23);
																
																$subtotal_ratio_care = round((($fariz_care[3]/100)+($iqbal_care[3]/100))/2,2);																													
																$subtotal_ratio_care = $dt->subtotal_ratio($subtotal_ratio_care);
																$subtotal_ratio_revenue = round((($fariz_revenue[3]/100)+($iqbal_revenue[3]/100))/2,2);																													
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
																			
																			<tr style="font-weight:bold;background-color:lightgrey; font-size: 20px;"><td colspan = 7 >Revenue Ratio : <?php echo $subtotal_ratio_revenue; ?></td></tr>
																			<?php													
																				echo $total_revenue[0];
																			?>
																		</tbody>
																	</table>
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
	$a = "select * from acchv_asuransi where id_acchv='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
				
	
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
									<form role="form" id="frm_kategori" enctype="multipart/form-data" method="post" action="modul/aksi_edit_acchvasuransi.php">
										<input type = "hidden" value = "<?php echo $r[id_acchv];  ?>" name = "id_acchv" />
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
												<div class="form-group">
													<label class="control-label">
														Total <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" type="text" value = "<?php echo $r[total]?>" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Asuransi" class="form-control" id="nm_asuransi" name="total" required>
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_bodyrepair_jobcontrol';>
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