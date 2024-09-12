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
									<h1 class="mainTitle">Data Item Control</h1>
									<span class="mainDescription">Modul Item Control, Untuk menambah dan edit data</span>
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
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<!--h5 class="over-title margin-bottom-15">Keseluruhan <span class="text-bold">Data Sales</span></h5-->
									
										
										<p class="progress-demo">
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_master_list_item_control&act=tambah';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Tambah Data</span>
											</button>
											
											
										</p>
									<hr>
									<div class = "table-responsive">
									<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
										<thead>
											<tr>
												<th>No.</th>												
												<th>Nama Item</th>
												<th>Kategori</th>
												<th>Target Dealer</th>
												<th>Target Unit</th>
												<th>Target Point</th>
												<th>Aktif</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											
											<?php
					
												$sql = mysql_query("select itemcontrol.*,nm_kategori from itemcontrol left join kategori on itemcontrol.id_kategori = kategori.id_kategori order by nm_item");
												if(mysql_num_rows($sql) > 0){
												$no = 1;
												while($data = mysql_fetch_assoc($sql)){
						
												$kodestatus=$data['aktif'];
												if($kodestatus=="Y") {
												$kodestatus="<span class='label label-info label-mini'>YES</span>"; 
												}
												if($kodestatus=="N") {
												$kodestatus="<span class='label label-danger label-mini'>NO</span>"; 
												}
						
											?>
						
												<tr>
												<td><?php echo $no;?></td>
												<td><?php echo $data['nm_item'];?></td>
												<td><?php echo $data['nm_kategori'];?></td>	
												<td><?php echo $data['target_dealer'];?></td>	
												<td><?php echo $data['target_unit'];?></td>	
												<td><?php echo $data['target_point'];?></td>	
												<td><center><?php echo $kodestatus; ?></center></td>											
												
												<td align="center">
													<a class="btn btn-xs btn-warning" href="media.php?module=sub_master_list_item_control&act=edititem&id=<?php echo "$data[id_item]"; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Update <?php echo $data['nm_item']; ?>">

														<i class="fa fa-pencil"></i>
													</a>
													<a class="btn btn-xs btn-danger" href="action-manager/hapussales.php?id=<?php echo $data['id_sales'] ; ?>" onClick='return warning();' data-placement="top" data-toggle="tooltip" data-original-title="Hapus User <?php echo $data['username']; ?>."><i class="fa fa-trash"></i></a>
												</td>
												
												</tr>
												<?php
												$no++;
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
		
		if(count($_POST)) {
			mysql_unbuffered_query("insert into itemcontrol values (default,'{$_POST['nm_item']}','{$_POST['id_kategori']}','{$_POST['target_dealer']}','{$_POST['target_unit']}','{$_POST['target_point']}','Y')");
			
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
												<div class="form-group">
													<label class="control-label">
														Target Dealer <span class="symbol required"></span>
													</label>
													<input type="number" placeholder="Target Dealer" class="form-control" id="target_dealer" name="target_dealer" required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Target Unit <span class="symbol required"></span>
													</label>
													<input type="number" placeholder="Target Unit" class="form-control" id="target_unit" name="target_unit" required readonly>
												</div>
												<div class="form-group">
													<label class="control-label">
														Target Point <span class="symbol required"></span>
													</label>
													<input type="number" placeholder="Target Point" class="form-control" id="target_point" name="target_point" required>
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
	case "edititem":
	$a = "select * from itemcontrol where id_item='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
				
	if(count($_POST)) {
		mysql_unbuffered_query("update itemcontrol set nm_item = '$_POST[nm_item]',id_kategori = '$_POST[id_kategori]',
		aktif = '$_POST[aktif]',target_dealer = '$_POST[target_dealer]',target_unit = '$_POST[target_unit]', target_point = '$_POST[target_point]'
		where id_item = '$_GET[id]'");
		$msg = "							
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Data telah berhasil dirubah</div>";
		header('location:media.php?module=sub_master_list_item_control');
	}
?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Edit Data Item Control</h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li>
										<span>Tabel Item Control</span>
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
													<input style="text-transform:uppercase" type="text" value = "<?php echo $r[nm_item]?>" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Item" class="form-control" id="nm_item" name="nm_item" required>
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Kategori <span class="symbol required"></span>
													</label>
													<select name = "id_kategori" id = "id_kategori" class="cs-select cs-skin-elastic">
													<?php 
														$tampil=mysql_query("SELECT * FROM kategori where aktif = 'Y'");
														if ($r[id_kategori]==''){
															echo "<option disabled selected value=''>Pilih Kategori</option>";
														}
														while ($w = mysql_fetch_array($tampil)){
															if ($r[id_kategori]==$w[id_kategori]){
																echo "<option value = $w[id_kategori] selected>$w[nm_kategori]</option>";
															}
															else {
																echo "<option value = $w[id_kategori]>$w[nm_kategori]</option>";
															}
														}
													?>
													
													</select>
													
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
												<div class="form-group">
													<label class="control-label">
														Target Dealer <span class="symbol required"></span>
													</label>
													<input type="number" value = "<?php echo $r[target_dealer]?>" placeholder="Target Dealer" class="form-control" id="target_dealer" name="target_dealer" required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Target Unit <span class="symbol required"></span>
													</label>
													<input type="number" value = "<?php echo $r[target_unit]?>" placeholder="Target Unit" class="form-control" id="target_unit" name="target_unit" required readonly>
												</div>
												<div class="form-group">
													<label class="control-label">
														Target Point <span class="symbol required"></span>
													</label>
													<input type="number" value = "<?php echo $r[target_point]?>" placeholder="Target Point" class="form-control" id="target_point" name="target_point" required>
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
<?php break;

}} ?>