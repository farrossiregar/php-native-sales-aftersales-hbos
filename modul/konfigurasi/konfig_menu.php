<?php
session_start();
 if (strtoupper($_SESSION['leveluser']) != 'ADMIN') {
  
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
		include "config/fungsi_thumb.php";
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
									<h1 class="mainTitle">Data Menu</h1>
									<span class="mainDescription">Modul Menu, Untuk Tambah dan Edit Data</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Tabel Menu</span>
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
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=konfig_menu&act=tambahmenu';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Tambah Data</span>
											</button>
											
											
										</p>
									<hr>
									<div class = "table-responsive">
									<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama Menu</th>
												<th>Level Menu</th>
												<th>Jenis Bisnis</th>
												<th>Link</th>
												<th>Module</th>
												<th>Kode Menu</th>
												<th>Icon</th>
												<th>Path</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											
											<?php
					
												$sql = mysql_query("select * from menu order by kode_menu ");
												if(mysql_num_rows($sql) > 0){
												$no = 1;
												while($data = mysql_fetch_assoc($sql)){
						                        $namamenu = $data['nama_menu'];
												$level=$data['level_menu'];
												$link = $data['link'];
												$module=$data['module'];
												$kodemenu = $data['kode_menu'];
												$path = $data['path'];
												$icon=$data['icon'];
						
											?>
						
												<tr>
												<td><?php echo $no;?></td>
												<td><?php echo $namamenu;?></td>
												<td><?php echo $level;?></td>
												<td><?php echo $data['jenis_bisnis'];?></td>
												<td><center><?php echo $link; ?></center></td>
												<td><?php echo $module; ?></td>
												<td><?php echo $kodemenu; ?></td>
												<td><?php echo $icon;?></td>
												<td><?php echo $path;?></td>
												
												<td align="center">
													<a class="btn btn-xs btn-warning" href="media_showroom.php?module=konfig_menu&act=editmenu&id=<?php echo "$data[kode_menu]"; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Update Menu <?php echo $namamenu; ?>">

														<i class="fa fa-pencil"></i>
													</a>
													<a class="btn btn-xs btn-danger" href="media_showroom.php?module=konfig_menu&act=hapusmenu&id=<?php echo $data['kode_menu'] ; ?>" onClick='return warning();' data-placement="top" data-toggle="tooltip" data-original-title="Hapus Menu <?php echo $namamenu; ?>."><i class="fa fa-trash"></i></a>
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
		case "tambahmenu":
		
		if(count($_POST)) {	
			$query = mysql_query("select * from menu where kode_menu = '$_POST[kodemenu]'");
			if(mysql_num_rows($query)==0){
				mysql_unbuffered_query("insert into menu (nama_menu, level_menu, link, module, kode_menu, icon,jenis_bisnis,path) 
				values('$_POST[namamenu]','$_POST[levelmenu]','$_POST[link]','$_POST[module]','$_POST[kodemenu]','$_POST[icon]','$_POST[jenis_bisnis]','$_POST[path]')");
				
				$msg = "
				<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-check'></i> Selamat!</h4>
				Berhasil menambah data.</div>";
			}else{
				$msg = "							
				<div class='alert alert-warning alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-warning'></i> Peringatan!</h4>
				Kode Menu sudah terdaftar.</div>";
			}
		}
?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Menu</h1>
									<span class="mainDescription">Tambah Menu Baru pada Database</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Tambah Menu Baru</span>
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
														Nama Menu <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Nama Menu" class="form-control" id="namamenu" name="namamenu">
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Level Menu <span class="symbol required"></span>
													</label>
													<select name='levelmenu' id='levelmenu' class='form-control'>
														<option disabled selected>PILIH LEVEL MENU</option>
														<option value='main_menu'>MAIN MENU</option>
														<option value='sub_menu'>SUB MENU</option>
													</select>
													
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Jenis Bisnis <span class="symbol required"></span>
													</label>
													<select name='jenis_bisnis' class='form-control'>
														<option disabled selected>PILIH JENIS BISNIS</option>
														<option value='SALES'>SALES</option>
														<option value='SERVICE'>SERVICE</option>
														<option value='KONFIG'>KONFIG</option>
													</select>
													
												</div>
												<div class="form-group">
													<label class="control-label">
														Link <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Link" class="form-control" id="link" name="link">
												</div>
												<div class="form-group">
													<label class="control-label">
														Module <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Module" class="form-control" id="module" name="module">
												</div>
												<div class="form-group">
													<label class="control-label">
														Kode Menu <span class="symbol required"></span>
													</label>
													<input type="text" value = "<?php echo $r['kode_menu']; ?>" placeholder="Kode Menu" class="form-control" id="kodemenu" name="kodemenu">
												</div>
												<div class="form-group">
													<label class="control-label">
														Icon
													</label>
													<input type="text" placeholder="Icon" class="form-control" id="icon" name="icon">
												</div>
												<div class="form-group">
													<label class="control-label">
														Path
													</label>
													<input type="text" placeholder="Path" class="form-control" id="path" name="path">
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
													<i class="fa fa-save"></i> Simpan
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=konfig_menu';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
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
    case "hapusmenu":
    $sql 	= "delete from menu where kode_menu='$_GET[id]'";
    $query	= mysql_query($sql);
   
   if($query){
		header('location: siswa.php');
	}
	else{
		echo 'Gagal';
	}
?>
		
<?php	
	break;
	case "editmenu":
	$a = "select * from menu where kode_menu='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
				
	if(count($_POST)) {
		mysql_unbuffered_query("update menu set nama_menu = '$_POST[namamenu]',
																level_menu = '$_POST[levelmenu]',
																link = '$_POST[link]',
																jenis_bisnis = '$_POST[jenis_bisnis]',
																module = '$_POST[module]',
																kode_menu = '$_POST[kodemenu]',
																icon = '$_POST[icon]' where kode_menu = '$_GET[id]'");
		

		mysql_unbuffered_query("update akses set kode_menu = '$_POST[kodemenu]' where kode_menu = '$_GET[id]'");
		
		$msg = "
					
		<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4><i class='icon fa fa-check'></i> Selamat!</h4>
		Berhasil Ubah Data, Silahkan Refresh Halaman.
		</div>
		
		";	
		
		
	}
?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Edit Data Menu</h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Menu</span>
									</li>
									<li class="active">
										<span>Edit Menu</span>
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
														Nama Menu <span class="symbol required"></span>
													</label>
													<input type="text" value = "<?php echo $r['nama_menu']; ?>" placeholder="Nama Menu" class="form-control" id="namamenu" name="namamenu" required>
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Level Menu <span class="symbol required"></span>
													</label>
													<select name = "levelmenu" id = "levelmenu" class="form-control">
														<!--option value='<?php echo $r['level_menu']; ?>' selected disabled hidden><?php echo $r['level_menu']; ?></option-->
														<option disabled>Pilih Level Menu</option>
														<?php
															$slc=mysql_query("select distinct(level_menu) from menu order by level_menu asc");
															while($slc2=mysql_fetch_array($slc)){
															if(($r[level_menu]) == ($slc2[level_menu])){
																$slct = "selected";
															}else{
																$slct = "";
															}
															
														?>
														
														<option value='<?php echo $slc2[level_menu]; ?>' <?php echo $slct; ?>><?php echo $slc2[level_menu]; ?></option>
														<?php
															}
														?>
														
													</select>
													
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Jenis Bisnis <span class="symbol required"></span>
													</label>
													<select name='jenis_bisnis' class='form-control'>
														<option disabled >PILIH JENIS BISNIS</option>
														<option value='SALES' <?php echo ($r['jenis_bisnis'] == "SALES" ? "selected" : "") ;?>>SALES</option>
														<option value='SERVICE' <?php echo ($r['jenis_bisnis'] == "SERVICE" ? "selected" : "") ;?> >SERVICE</option>
														<option value='KONFIG' <?php echo ($r['jenis_bisnis'] == "KONFIG" ? "selected" : "") ;?> >KONFIG</option>
													</select>
													
												</div>
												<div class="form-group">
													<label class="control-label">
														Link <span class="symbol required"></span>
													</label>
													<input type="text" value = "<?php echo $r['link']; ?>" placeholder="Link" class="form-control" id="link" name="link">
												</div>
												<div class="form-group">
													<label class="control-label">
														Module <span class="symbol required"></span>
													</label>
													<input type="text" value = "<?php echo $r['module']; ?>" placeholder="Module" class="form-control" id="module" name="module">
												</div>
												<div class="form-group">
													<label class="control-label">
														Kode Menu <span class="symbol required"></span>
													</label>
													<input type="text" value = "<?php echo $r['kode_menu']; ?>" placeholder="Kode Menu" class="form-control" id="kodemenu" name="kodemenu">
												</div>
												<div class="form-group">
													<label class="control-label">
														Icon <span class="symbol required"></span>
													</label>
													<input type="text" value = "<?php echo $r['icon']; ?>" placeholder="Icon" class="form-control" id="icon" name="icon">
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
													<i class="fa fa-save"></i> Simpan
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=window.location.href='?module=konfig_menu';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
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