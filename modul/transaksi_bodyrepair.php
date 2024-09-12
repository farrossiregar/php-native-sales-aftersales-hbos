<?php
session_start();
 if ($_SESSION['leveluser'] == 'SA_GR' ){
  
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
		$bulan_sekarang = date("m-Y");
?>
	
				

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Body Repair</h1>
									<span class="mainDescription">Service Advisor</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<!--h5 class="over-title margin-bottom-15">Keseluruhan <span class="text-bold">Data Sales</span></h5-->
									
										
										<p class="progress-demo">
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_bodyrepair&act=tambah';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Tambah Data</span>
											</button>
											
											
										</p>
									<hr>
									<?php include "hitung_incentif_BP.php"; ?>
									<h1 class="mainTitle text-orange "><u><?php echo "Incentive : Rp. ".number_format($final_incentive) ;  ?> </u></h1>
									<h1 class="mainTitle text-primary">Point Total : <?php echo $point_total ." -- Ratio Total :". round($ratio_total_*100,2)."%" ;  ?> </h1>
									<hr>
									<br />
									<!------------------------------------------------- CAR CARE --------------------------------->
												<?php
													$bulan_sekarang = date("m-Y");
													
													$query_item = mysql_query("select itemcontrol.nm_item,itemcontrol.id_item,
													itemcontrol.id_kategori,kategori.nm_kategori,target_sa.target_unit,target_sa.target_point from itemcontrol 
													left join kategori on itemcontrol.id_kategori = kategori.id_kategori 
													left join target_sa on itemcontrol.id_item = target_sa.id_item
													where itemcontrol.aktif = 'Y' and kategori.id_kategori = 7 and target_sa.bulan = '$bulan_sekarang' order by nm_item");
													
													
													
													$ntotal = 0;
													$grandtotal_point = 0;
													while ($r=mysql_fetch_array($query_item)){
														//echo "Kategori :$r[nm_kategori] --> $r[id_item] - $r[nm_item] ";
														//echo "<tr><td>$no</td><td>target item</td><td>target point</td><td>";
														$jml = 0;
														if (!empty($r[id_item])){
															$data = mysql_query("select id_item,sum(total) as total,sum(package_point) as point from acchv where acchv.id_item 
															= $r[id_item] and bulan = '$bulan_sekarang' and nm_sa = '$_SESSION[username]' group by id_item");
															 while ($d=mysql_fetch_array($data)){
																//echo "Total = ". $d['sum(total)'];
																//echo "<td>$d['sum(total)']</td><td>result point</td>";														
																	
																
																$total_ = $d[total];															
																$total_point = ($total_ * $r[target_point]) + $d[point] ;
																$grandtotal_point = $grandtotal_point + $total_point;
																$ratio_total = (($total_ / $r[target_unit]) < 1? round(($total_ / $r[target_unit]) *100,2): 1*100 ) ;
																$ntotal = ($ntotal + $ratio_total);
																
															 }
														}
														
													}
													
												?>
									<?php $count = mysql_query("select count(id_item) as count from itemcontrol where id_kategori = '7' and aktif = 'Y'");
										$count = mysql_fetch_array($count);
									?>
									<h1 class="mainTitle">CAR Care <?php $ntotal = round($ntotal / $count['count'],2); echo " ($ntotal%) - $grandtotal_point"; ?>  </h1>
									
									<hr />
									<div class = "table-responsive">
										<table class="table table-striped table-bordered table-hover table-full-width" id="sample">
											<thead>
												<tr>
													<th>No.</th>												
													<th>Item</th>												
													<th>Target Unit</th>
													<th>Target Point</th>
													<th>Result Item</th>
													<th>Result Point</th>
													<th>Ratio</th>												
												</tr>
											</thead>
											<tbody>
												
												<?php
													
													$bulan_sekarang = date("m-Y");
													
													$query_item = mysql_query("select itemcontrol.nm_item,itemcontrol.id_item,
													itemcontrol.id_kategori,kategori.nm_kategori,target_sa.target_unit,target_sa.target_point from itemcontrol 
													left join kategori on itemcontrol.id_kategori = kategori.id_kategori 
													left join target_sa on itemcontrol.id_item = target_sa.id_item
													where itemcontrol.aktif = 'Y' and kategori.id_kategori = 7 and target_sa.bulan = '$bulan_sekarang' order by nm_item");
													
													
													$no = 1;
													$ntotal = 0;
													while ($r=mysql_fetch_array($query_item)){
														//echo "Kategori :$r[nm_kategori] --> $r[id_item] - $r[nm_item] ";
														//echo "<tr><td>$no</td><td>target item</td><td>target point</td><td>";
														$jml = 0;
														if (!empty($r[id_item])){
															$data = mysql_query("select id_item,sum(total) as total,sum(package_point) as point from acchv where acchv.id_item 
															= $r[id_item] and bulan = '$bulan_sekarang' and nm_sa = '$_SESSION[username]' group by id_item");
															 while ($d=mysql_fetch_array($data)){
																//echo "Total = ". $d['sum(total)'];
																//echo "<td>$d['s	um(total)']</td><td>result point</td>";
																
																$total_ = $d[total];															
																$total_point = ($total_ * $r[target_point]) + $d[point] ;
																
																$ratio_total = (($total_ / $r[target_unit]) < 1? round(($total_ / $r[target_unit]) *100,2): 1*100 ) ;
																$ntotal = $ntotal + $ratio_total;
																$ratio = (($total_ / $r[target_unit]) < 1? round(($total_ / $r[target_unit]) *100,2): 1*100 ) ;
																$ratio = ($ratio < 100 ? "<span class='label label-danger label-mini'>$ratio%</span>" : "<span class='label label-info label-mini'>$ratio%</span>" );
																
																
																echo "<tr><td>$no</td><td>$r[nm_item]</td><td>$r[target_unit]</td>
																<td>$r[target_point]</td><td>$total_</td><td>$total_point</td><td>$ratio</td></tr>";
																
																$no++;
															 }
														}
														
													}
													
												?>
											</tbody>
										</table>
									</div>
									
									
									
									<!----------------------------------------------------------- REVENUE ---------------------------->
									
												<?php
													$bulan_sekarang = date("m-Y");
													
													$query_item = mysql_query("select itemcontrol.nm_item,itemcontrol.id_item,
													itemcontrol.id_kategori,kategori.nm_kategori,target_sa.target_unit,target_sa.target_point from itemcontrol 
													left join kategori on itemcontrol.id_kategori = kategori.id_kategori 
													left join target_sa on itemcontrol.id_item = target_sa.id_item
													where itemcontrol.aktif = 'Y' and kategori.id_kategori = 23 and target_sa.bulan = '$bulan_sekarang' order by nm_item");
													
													
													
													$ntotal = 0;
													$grandtotal_point = 0 ;
													
													while ($r=mysql_fetch_array($query_item)){
														//echo "Kategori :$r[nm_kategori] --> $r[id_item] - $r[nm_item] ";
														//echo "<tr><td>$no</td><td>target item</td><td>target point</td><td>";
														$jml = 0;
														if (!empty($r[id_item])){
															$grandtotal = 0;
															$data = mysql_query("select id_item,sum(total) as total from acchv 
															where acchv.id_item = $r[id_item] and bulan = '$bulan_sekarang' and nm_sa = '$_SESSION[username]' group by id_item");
															 while ($d=mysql_fetch_array($data)){
																//echo "Total = ". $d['sum(total)'];
																//echo "<td>$d['sum(total)']</td><td>result point</td>";
																
																	
																
																$total_ = $d[total];	
																
																
																$grandtotal = $grandtotal + $total_;
																if ($grandtotal > $r[target_unit]){$total_point = $r[target_point] ;}else {$total_point = 0 ;}	
																
																$grandtotal_point = $grandtotal_point + $total_point;
																$ratio_total = (($total_ / $r[target_unit]) < 1? round(($total_ / $r[target_unit]) *100,2): 1*100 ) ;
																$ntotal = ($ntotal + $ratio_total);
																
															 }
														}
														
													}
													
												?>
									<?php $count = mysql_query("select count(id_item) as count from itemcontrol where id_kategori = 23 and aktif = 'Y'");
										$count = mysql_fetch_array($count);
									?>
									<h1 class="mainTitle">REVENUE <?php $ntotal = round($ntotal / $count['count'],2); echo " ($ntotal%) - $grandtotal_point"; ?></h1>
									
									<hr />
									<div class = "table-responsive">
										<table class="table table-striped table-bordered table-hover table-full-width" id="sample">
											<thead>
												<tr>
													<th>No.</th>												
													<th>Item</th>												
													<th>Target Unit</th>
													<th>Target Point</th>
													<th>Result Item</th>
													<th>Result Point</th>
													<th>Ratio</th>												
												</tr>
											</thead>
											<tbody>
												
												<?php
													$bulan_sekarang = date("m-Y");
													
													$query_item = mysql_query("select itemcontrol.nm_item,itemcontrol.id_item,
													itemcontrol.id_kategori,kategori.nm_kategori,target_sa.target_unit,target_sa.target_point from itemcontrol 
													left join kategori on itemcontrol.id_kategori = kategori.id_kategori 
													left join target_sa on itemcontrol.id_item = target_sa.id_item
													where itemcontrol.aktif = 'Y' and kategori.id_kategori = 23 and target_sa.bulan = '$bulan_sekarang' order by nm_item");
													
													$no = 1;
													
													while ($r=mysql_fetch_array($query_item)){
														//echo "Kategori :$r[nm_kategori] --> $r[id_item] - $r[nm_item] ";
														//echo "<tr><td>$no</td><td>target item</td><td>target point</td><td>";
														$jml = 0;
														if (!empty($r[id_item])){
															$grandtotal = 0;
															$data = mysql_query("select id_item,sum(total) as total from acchv where acchv.id_item 
															= $r[id_item] and bulan = '$bulan_sekarang' and nm_sa = '$_SESSION[username]' group by id_item");
															 while ($d=mysql_fetch_array($data)){
																//echo "Total = ". $d['sum(total)'];
																//echo "<td>$d['sum(total)']</td><td>result point</td>";
																$total_ = $d[total];	
																$grandtotal = $grandtotal + $total_;
																if ($grandtotal > $r[target_unit]){$total_point = $r[target_point] ;}else {$total_point = 0 ;}																
																//$total_point = $total_ * $r[target_point] ;
																$ratio = (($total_ / $r[target_unit]) < 1? round(($total_ / $r[target_unit]) *100,2): 1*100 ) ;
																$ratio = ($ratio < 100 ? "<span class='label label-danger label-mini'>$ratio%</span>" : "<span class='label label-info label-mini'>$ratio%</span>" );
																
																
																echo "<tr><td>$no</td><td>$r[nm_item]</td><td>".number_format($r[target_unit],0,',','.')."</td>
																<td>$r[target_point]</td><td>".number_format($total_,0,',','.')."</td><td>$total_point</td><td>$ratio</td></tr>";
																$no++;
															 }
														}
														
														
														
													}
												?>
											</tbody>
										</table>
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