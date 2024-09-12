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
?>
	
				<script language="JavaScript">
					function warning() {
						return confirm('Anda yakin menghapus data ini?');
					}
				</script>

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Target</h1>
									<span class="mainDescription">Modul target, Untuk menambah dan edit target</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Target</span>
									</li>
									<li class="active">
										<span>Data Target</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<!--h5 class="over-title margin-bottom-15">Keseluruhan <span class="text-bold">Data Sales</span></h5-->
									
									<div class = "row">
										<div class = "col-md-6">
											<?php $isi_lama = $_GET['bulan']; 
												$bulan_sekarang = date("m-Y");
												
											?>
											<div class="form-group">
												<label class="control-label">
													Pilih Bulan <span class="symbol required"></span>
												</label>											
												<form action = "<?php echo "$_SERVER[PHP_SELF]"; ?>" method = "GET">
													<input type = "hidden" name="module" value = "sub_target_data" />
													<div class="input-group input-append datepicker date" data-date-format='mm-yyyy'>
														<input type="text" class="form-control" name = "bulan" id = "bulan" value = "<?php if(empty($isi_lama)){
															echo "$bulan_sekarang";
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
									</div>			
									<div class = "row">
										<div class = "col-md-12">
											<?php if (empty($_GET[bulan])){ ?>
											<div class = "table-responsive">
												<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
													<thead>
														<tr>
															<th>No.</th>												
															<th>Kategori</th>
															<th>Nama Item</th>
															<th>Target Dealer</th>
															<th>Target Unit</th>
															<th>Target Point</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														
														<?php 
															$bulan_sekarang = date("m-Y");
															$query = mysql_query("select target_sa.*,nm_kategori,nm_item from target_sa 
															left join kategori on kategori.id_kategori = target_sa.id_kategori
															left join itemcontrol on itemcontrol.id_item = target_sa.id_item
															where bulan = '$bulan_sekarang' order by nm_kategori");
															
															//$sql = mysql_query("select itemcontrol.*,nm_kategori from itemcontrol left join kategori on itemcontrol.id_kategori = kategori.id_kategori order by nm_item");
															if(mysql_num_rows($query) > 0){
															$no = 1;
															while($data = mysql_fetch_assoc($query)){
									
															
									
														?>
									
															<tr>
															<td><?php echo $no;?></td>
															<td><?php echo $data['nm_kategori'];?></td>
															<td><?php echo $data['nm_item'];?></td>		
															<td><?php echo $data['target_dealer']; ?></td>
															<td><?php echo $data['target_unit']; ?></td>
															<td><?php echo $data['target_point']; ?></td>
																									
															
															<td align="center">
																<a class="btn btn-xs btn-warning" href="media.php?module=sub_target_data&act=edituser&id=<?php echo "$data[id_target]"; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Update <?php echo $data['id_target']; ?>">

																	<i class="fa fa-pencil"></i>
																</a>
																<a class="btn btn-xs btn-danger" href="action-manager/hapussales.php?id=<?php echo $data['id_sales'] ; ?>" onClick='return warning();' data-placement="top" data-toggle="tooltip" data-original-title="Hapus User <?php echo $data['username']; ?>."><i class="fa fa-trash"></i></a>
															</td>
															
															</tr>
															<?php
															$no++;
																}
															}else {
																$query_item = mysql_query("select * from itemcontrol where aktif = 'y'");
																while ($r_item = mysql_fetch_array($query_item)){
																	mysql_query("insert into target_sa (id_kategori,id_item,bulan,target_dealer,target_unit,target_point) values 
																	('$r_item[id_kategori]','$r_item[id_item]','$bulan_sekarang','$r_item[target_dealer]','$r_item[target_unit]','$r_item[target_point]')");
																}
																	$query = mysql_query("select target_sa.*,nm_kategori,nm_item from target_sa 
																	left join kategori on kategori.id_kategori = target_sa.id_kategori
																	left join itemcontrol on itemcontrol.id_item = target_sa.id_item
																	where bulan = '$_GET[bulan]' order by nm_kategori");
																	$no = 1;
																	while ($data = mysql_fetch_assoc($query)){ ?>
																	<tr>
																	<td><?php echo $no;?></td>
																	<td><?php echo $data['nm_kategori'];?></td>
																	<td><?php echo $data['nm_item'];?></td>		
																	<td><?php echo $data['target_dealer']; ?></td>
																	<td><?php echo $data['target_unit']; ?></td>
																	<td><?php echo $data['target_point']; ?></td>
																											
																	
																	<td align="center">
																		<a class="btn btn-xs btn-warning" href="media.php?module=sub_target_data&act=edituser&id=<?php echo "$data[id_target]"; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Update <?php echo $data['id_target']; ?>">

																			<i class="fa fa-pencil"></i>
																		</a>
																		<a class="btn btn-xs btn-danger" href="action-manager/hapussales.php?id=<?php echo $data['id_sales'] ; ?>" onClick='return warning();' data-placement="top" data-toggle="tooltip" data-original-title="Hapus User <?php echo $data['username']; ?>."><i class="fa fa-trash"></i></a>
																	</td>
																	
																	</tr><?php
																	$no ++;
																}
																
																
															}
														?>
														
													</tbody>
												</table>
											
											
											</div>
											
											<!------- Get dari bulan ------------------------------->
											<?php } else { ?>
											

											<div class = "table-responsive">
												<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
													<thead>
														<tr>
															<th>No.</th>												
															<th>Kategori</th>
															<th>Nama Item</th>
															<th>Target Dealer</th>
															<th>Target Unit</th>
															<th>Target Point</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														
														<?php 
															$bulan_sekarang = date("m-Y");
															$query = mysql_query("select target_sa.*,nm_kategori,nm_item from target_sa 
															left join kategori on kategori.id_kategori = target_sa.id_kategori
															left join itemcontrol on itemcontrol.id_item = target_sa.id_item
															where bulan = '$_GET[bulan]' order by nm_kategori");
															
															//$sql = mysql_query("select itemcontrol.*,nm_kategori from itemcontrol left join kategori on itemcontrol.id_kategori = kategori.id_kategori order by nm_item");
															if(mysql_num_rows($query) > 0){
															$no = 1;
															while($data = mysql_fetch_assoc($query)){
									
															
									
														?>
									
															<tr>
															<td><?php echo $no;?></td>
															<td><?php echo $data['nm_kategori'];?></td>
															<td><?php echo $data['nm_item'];?></td>	
															<td><?php echo $data['target_dealer']; ?></td>															
															<td><?php echo $data['target_unit']; ?></td>
															<td><?php echo $data['target_point']; ?></td>
																									
															
															<td align="center">
																<a class="btn btn-xs btn-warning" href="media.php?module=sub_target_data&act=edituser&id=<?php echo "$data[id_target]"; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Update <?php echo $data['id_target']; ?>">

																	<i class="fa fa-pencil"></i>
																</a>
																<a class="btn btn-xs btn-danger" href="action-manager/hapussales.php?id=<?php echo $data['id_sales'] ; ?>" onClick='return warning();' data-placement="top" data-toggle="tooltip" data-original-title="Hapus User <?php echo $data['username']; ?>."><i class="fa fa-trash"></i></a>
															</td>
															
															</tr>
															<?php
															$no++;
																}
															}else {
																$query_item = mysql_query("select * from itemcontrol where aktif = 'y'");
																while ($r_item = mysql_fetch_array($query_item)){
																	mysql_query("insert into target_sa (id_kategori,id_item,bulan,target_dealer,target_unit,target_point) values 
																	('$r_item[id_kategori]','$r_item[id_item]','$_GET[bulan]','$r_item[target_dealer]','$r_item[target_unit]','$r_item[target_point]')");
																}
																	$query = mysql_query("select target_sa.*,nm_kategori,nm_item from target_sa 
																	left join kategori on kategori.id_kategori = target_sa.id_kategori
																	left join itemcontrol on itemcontrol.id_item = target_sa.id_item
																	where bulan = '$_GET[bulan]' order by nm_kategori");
																	
																	$no = 1;
																	while ($data = mysql_fetch_assoc($query)){ ?>
																	<tr>
																	<td><?php echo $no;?></td>
																	<td><?php echo $data['nm_kategori'];?></td>
																	<td><?php echo $data['nm_item'];?></td>	
																	<td><?php echo $data['target_dealer']; ?></td>																	
																	<td><?php echo $data['target_unit']; ?></td>
																	<td><?php echo $data['target_point']; ?></td>
																											
																	
																	<td align="center">
																		<a class="btn btn-xs btn-warning" href="media.php?module=sub_target_data&act=edituser&id=<?php echo "$data[id_target]"; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Update <?php echo $data['id_target']; ?>">

																			<i class="fa fa-pencil"></i>
																		</a>
																		<a class="btn btn-xs btn-danger" href="action-manager/hapussales.php?id=<?php echo $data['id_sales'] ; ?>" onClick='return warning();' data-placement="top" data-toggle="tooltip" data-original-title="Hapus User <?php echo $data['username']; ?>."><i class="fa fa-trash"></i></a>
																	</td>
																	
																	</tr><?php
																	$no ++;
																}
																
																
															}
														?>
														
													</tbody>
												</table>
											
											
											</div>

											
											<?php } ?>
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
		
		if(count($_POST)) {
			mysql_unbuffered_query("insert into itemcontrol values (default,'{$_POST['nm_item']}','{$_POST['id_kategori']}','Y')");
			
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
									<h1 class="mainTitle">Data Item Control</h1>
									<span class="mainDescription">Input data baru</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Tabel Item Control</span>
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
														Nama Item <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" type="text" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Item" class="form-control" id="nm_item" name="nm_item" required>
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Kategori <span class="symbol required"></span>
													</label>													
													<select name = "id_kategori" id = "id_kategori" class="cs-select cs-skin-elastic">
														<?php 
														$tampil=mysql_query("SELECT * FROM kategori where aktif = 'Y'");
														?>
														<option disabled selected value=''>Pilih Kategori</option>
														<?php 
														while ($w = mysql_fetch_array($tampil)){															
															echo "<option value = $w[id_kategori] selected>$w[nm_kategori]</option>";															
														}
														?>
													</select>
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_master_list_item_control';>
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
	$a = "select target_sa.*,itemcontrol.nm_item from target_sa left join itemcontrol on target_sa.id_item = itemcontrol.id_item where id_target='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
				
	
?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Edit Data Item Controll</h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Target</span>
									</li>
									<li>
										<span>Data Target</span>
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
									<form role="form" id="frm_kategori" enctype="multipart/form-data" method="post" action="modul/aksi_edittarget.php">
										<input type = "hidden" value = "<?php echo $_GET[id]  ;?>" name = "id" />
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
													<input style="text-transform:uppercase" type="text" value = "<?php echo $r[nm_item]?>" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Item" class="form-control" id="nm_item" name="nm_item" readonly>
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Target Dealer <span class="symbol required"></span>
													</label>
													<input type="number" value = "<?php echo $r[target_dealer]?>"  class="form-control" id="target_dealer" name="target_dealer" required>													
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Target Unit <span class="symbol required"></span>
													</label>
													<input type="number" value = "<?php echo $r[target_unit]?>"  class="form-control" id="target_unit" name="target_unit" required>													
												</div>	
												<div class="form-group">
													<label for="form-field-select-2">
														Target Point <span class="symbol required"></span>
													</label>
													<input type="number" value = "<?php echo $r[target_point]?>"  class="form-control" id="target_point" name="target_point" required>													
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_target_data';>
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