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
									<h1 class="mainTitle">Data Kategori</h1>
									<span class="mainDescription">Modul Kategori, Untuk menambah dan edit data</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Tabel Kategori</span>
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
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_master_list_kategori&act=tambah';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Tambah Data</span>
											</button>
											
											
										</p>
									<hr>
									<div class = "table-responsive">
									<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
										<thead>
											<tr>
												<th>No.</th>												
												<th>Nama Kategori</th>
												<th>Klasifikasi</th>
												<th>Aktif</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											
											<?php
					
												$sql = mysql_query("select * from kategori order by nm_kategori ");
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
												<td><?php echo $data['nm_kategori'];?></td>												
												<td><?php echo (($data['klasifikasi']=='GR') ?  "GENERAL REPAIR" :  "BODY & PAINT"); ?></td>												
												<td><center><?php echo $kodestatus; ?></center></td>											
												
												<td align="center">
													<a class="btn btn-xs btn-warning" href="media.php?module=sub_master_list_kategori&act=edituser&id=<?php echo "$data[id_kategori]"; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Update <?php echo $data['nm_kategori']; ?>">

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
			mysql_unbuffered_query("insert into kategori values (default,'{$_POST['nm_kategori']}','{$_POST['klasifikasi']}','Y')");
			
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
									<h1 class="mainTitle">Data Kategori</h1>
									<span class="mainDescription">Input data baru</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Tabel Kategori</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									
									
									<form role="form" id="form" enctype="multipart/form-data" method="post" action="">
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
														Nama Kategori <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" type="text" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Kategori" class="form-control" id="nm_kategori" name="nm_kategori" required>
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Klasifikasi <span class="symbol required"></span>
													</label>
													<select name = "klasifikasi" id = "klasifikasi" class="cs-select cs-skin-elastic">
														<option value = "" disabled selected >Pilih Klasifikasi</option>
														<option value = "GR" >GENERAL REPAIR</option>
														<option value = "BP" >BODY & PAINT</option>
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_master_list_kategori';>
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
	$a = "select * from kategori where id_kategori='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
				
	if(count($_POST)) {
		mysql_unbuffered_query("update kategori set nm_kategori = '$_POST[nm_kategori]',klasifikasi = '$_POST[klasifikasi]',aktif = '$_POST[aktif]' where id_kategori = '$_GET[id]'");
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
									<h1 class="mainTitle">Edit Data Kategori</h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li>
										<span>Tabel Kategori</span>
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
														Nama Kategori <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" type="text" value = "<?php echo $r[nm_kategori]?>" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Kategori" class="form-control" id="nm_kategori" name="nm_kategori" required>
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Klasifikasi <span class="symbol required"></span>
													</label>
													<select name = "klasifikasi" id = "klasifikasi" class="cs-select cs-skin-elastic">
														<?php if (empty($r[klasifikasi])){ ?>
														<option value = "" selected disabled >Pilih Klasifikasi</option>
														<?php } if ($r[klasifikasi]=='GR'){ ?>
														<option value = "GR" selected >GENERAL REPAIR</option>
														<option value = "BP" >BODY & PAINT</option><?php } else { ?>
														<option value = "GR" >GENERAL REPAIR</option>
														<option value = "BP" selected>BODY & PAINT</option><?php }?>
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_master_list_kategori';>
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