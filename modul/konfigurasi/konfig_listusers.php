<?php
session_start();
$level = $_SESSION['leveluser'];
										    
$cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 

");
$cek_akses2 = mysql_fetch_array($cek_akses);

										
if($cek_akses2['akses'] != 'Y'){
// if ($_SESSION['leveluser'] == 'supervisor'){
  
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
}else{
		include "config/fungsi_thumb.php";
		switch($_GET[act])
{
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
									<h1 class="mainTitle">Data User</h1>
									<span class="mainDescription">Modul Users, Untuk tambah dan edit data</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Tabel Users</span>
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
									
										
										<?php
										    $level = $_SESSION['leveluser'];
										    
										    $cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
										    left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 
										    
										    ");
										    $cek_akses2 = mysql_fetch_array($cek_akses);
										    
										
										    if($cek_akses2['tambah_data'] == 'Y')
										    {
										
										?>
										<p class="progress-demo">
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=konfig_listusers&act=tambahuser';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Tambah Data</span>
											</button>
										</p>
										<hr>
									
										<?php
											}
										?>
											
									<div class = "table-responsive">
									<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
										<thead>
											<tr>
												<th>No.</th>
												<th class="hidden-xs">Username</th>
												<th>Nama Lengkap</th>
												<th class="hidden-xs">Email</th>
												<th>Blokir</th>
												<th>Supervisor</th>
												<th>Last Login</th>
												<th>Level</th>
												
												<?php
													$level = $_SESSION['leveluser'];
													
													$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ");
													$cek_akses2 = mysql_fetch_array($cek_akses);
													if($cek_akses2['edit'] == 'Y' && $cek_akses2['hapus'] == 'Y')
													{
												
												?>
													<th>Action</th>
												<?php
													}elseif($cek_akses2['edit'] == 'Y' && $cek_akses2['hapus'] == '' ){
												?>
													<th>Action</th>
												<?php
													}elseif($cek_akses2['edit'] == '' && $cek_akses2['hapus'] == 'Y'){
												?>
													<th>Action</th>
												<?php
													}else{
												?>
												<?php
													}
												?>
											</tr>
										</thead>
										<tbody>
											
											<?php
					
												$sql = mysql_query("select * from users order by username ");
												if(mysql_num_rows($sql) > 0){
												$no = 1;
												while($data = mysql_fetch_assoc($sql)){
						                        $username = $data['username'];
						                        
												$kodestatus=$data['blokir'];
												if($kodestatus=="N") {
												$kodestatus="<span class='label label-info label-mini'>NO</span>"; 
												}
												if($kodestatus=="Y") {
												$kodestatus="<span class='label label-danger label-mini'>YES</span>"; 
												}
						
											?>
						
												<tr>
												<td><?php echo $no;?></td>
												<td class = "hidden-xs"><?php echo $data['username'];?></td>
												<td><?php echo $data['nama_lengkap'];?></td>
												<td class = "hidden-xs"><?php echo $data['email'];?></td>
												<td><center><?php echo $kodestatus; ?></center></td>
												<td><?php echo $data['kode_supervisor']; ?></td>
												<td><?php echo $data['last_login']; ?></td>
												<td><?php echo $data['level'];?></td>
												
												<?php
													$level = $_SESSION['leveluser'];
													
													$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ");
													$cek_akses2 = mysql_fetch_array($cek_akses);
													if($cek_akses2['edit'] == 'Y' && $cek_akses2['hapus'] == 'Y')
													{
												
												?>
													<td align="center">
														<a class="btn btn-xs btn-warning" href="media_showroom.php?module=konfig_listusers&act=edituser&id=<?php echo "$data[username]"; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Update User <?php echo $data['username']; ?>" target="_blank">
															<i class="fa fa-pencil"></i>
														</a>
														<a class="btn btn-xs btn-danger" href="media_showroom.php?module=konfig_listusers&act=hapususer&id=<?php echo $data['username'] ; ?>" onClick='return warning();' data-placement="top" data-toggle="tooltip" data-original-title="Hapus User <?php echo $data['username']; ?>."><i class="fa fa-trash"></i></a>
													</td>
												<?php
													}elseif($cek_akses2['edit'] == 'Y' && $cek_akses2['hapus'] == ''){
												?>
													<td align="center">
														<a class="btn btn-xs btn-warning" href="media_showroom.php?module=konfig_listusers&act=edituser&id=<?php echo "$data[username]"; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Update User <?php echo $data['username']; ?>" target="_blank">
															<i class="fa fa-pencil"></i>
														</a>
													</td>
													
												<?php
													}elseif($cek_akses2['edit'] == '' && $cek_akses2['hapus'] == 'Y'){
												?>
													<td align="center">
														<a class="btn btn-xs btn-danger" href="media_showroom.php?module=konfig_listusers&act=hapususer&id=<?php echo $data['username'] ; ?>" onClick='return warning();' data-placement="top" data-toggle="tooltip" data-original-title="Hapus User <?php echo $data['username']; ?>.">
															<i class="fa fa-trash"></i>
														</a>
													</td>
													
												<?php
													}else{
													
												?>
												<?php
													}
												?>
												
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
		case "tambahuser":
		
		if(count($_POST)) {
				$pass = md5($_POST[password]);
				// code B
				$unik = uniqid();
				$lokasi_file = $_FILES['foto']['tmp_name'];
				$tipe_file   = $_FILES['foto']['type'];
				$nama_file   = $_FILES['foto']['name'];
				//$direktori   = 'image/'.$unik.'_'.$nama_file;
				$nama_file_unik   = $unik.'_'.$nama_file;

				if (!empty($lokasi_file)) {
					if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
						$msg = "
							<div class='alert alert-warning alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-warning'></i> Peringatan!</h4>
							File yang diupload harus dengan format JPEG.</div>";
					}else{
						UploadImage($nama_file_unik);
						
						$a = "select * from users where username='".$_POST['username']."'";
						$kueri = mysql_query($a);
						if(mysql_num_rows($kueri)==0){
							mysql_unbuffered_query("insert into users (username,nama_lengkap,foto,password,email,level,kode_supervisor,no_telp,blokir,bisnis) 
							values('$_POST[username]','$_POST[nama_lengkap]','$nama_file_unik','$pass','$_POST[email]','$_POST[level]','$_POST[supervisor]','$_POST[no_telp]','N','$_POST[bisnis]')");
							
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
							Username sudah terdaftar.</div>";
						}

					}
					
				}else{
				echo $msg = "							
							<div class='alert alert-warning alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-warning'></i> Peringatan!</h4>
							Belum ada foto yang dipilih untuk diupload</div>";
				}
				
}
?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Users</h1>
									<span class="mainDescription">Add new user to Database</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Add New User</span>
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
														Username <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Username" class="form-control" id="username" name="username" required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Nama Lengkap <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Nama Lengkap" class="form-control" id="nama_lengkap" name="nama_lengkap">
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Level User <span class="symbol required"></span>
													</label>
													<?php
														echo "<select name='level' id='id_level' class='form-control'>";
															$tampil=mysql_query("SELECT * FROM level");
														echo "<option disabled selected value=''>Pilih Level</option>";

															while($w=mysql_fetch_array($tampil))
																{
														echo "<option value=$w[kd_level]>$w[kd_level]</option>";        
																	}
														echo "</select>";
													?>
												</div>

												<!--div class="form-group" style="display: none;" id='id_spv'-->
												<div class="form-group" id='id_spv' style="display:none;">
													<label for="form-field-select-2">
														Kode Supervisor <span class="symbol required"></span>
													</label>
													<?php
														echo "<select name='supervisor' class='form-control'>";
															$tampil=mysql_query("SELECT * FROM supervisor");
														echo "<option disabled selected value=''>Pilih Supervisor</option>";

															while($w=mysql_fetch_array($tampil))
																{
														echo "<option value=$w[kode_supervisor]>$w[nama_supervisor]</option>";        
																	}
														echo "</select>";
													?>
												</div>

												<div class="form-group">
													<label class="control-label">
														Password <span class="symbol required"></span>
													</label>
													<input type="password" placeholder="Password" class="form-control" id="password" name="password">
												</div>
												<div class="form-group">
													<label class="control-label">
														Email <span class="symbol required"></span>
													</label>
													<input type="email" placeholder="Email" class="form-control" id="email" name="email">
												</div>
												<div class="form-group">
													<label class="control-label">
														Nomor Telp <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Nomor Telp" onkeypress="return hanyaAngka(event)" class="form-control" id="no_telp" name="no_telp">
												</div>											
												
												<div class="form-group">
													<label class="control-label">
														Bisnis <span class="symbol required"></span>
													</label>
													<select name="bisnis" id="bisnis" class="cs-select cs-skin-elastic">
														<option value = "" disabled >Pilih Bisnis</option>
														
														<option value = "SHOWROOM" selected>SHOWROOM</option>
													</select>
												</div>

											</div>
											<div class="col-md-6">
												<div class="form-group connected-group">
													<label class="control-label">
														Foto Sales <span class="symbol required"></span>
													</label>
													<div class="form-group">
																	<div class="fileinput fileinput-new" data-provides="fileinput">
																		<div class="fileinput-new thumbnail"><img src="assets/images/default-user.png" alt="">
																		</div>
																		<div class="fileinput-preview fileinput-exists thumbnail"></div>
																		<div class="user-edit-image-buttons">
																			<span class="btn btn-azure btn-file"><span class="fileinput-new"><i class="fa fa-picture"></i> Pilih foto</span><span class="fileinput-exists"><i class="fa fa-picture"></i> Ubah</span>
																				<input type="file" name="foto" id="foto" required>
																			</span>
																			<a href="#" class="btn fileinput-exists btn-red" data-dismiss="fileinput">
																				<i class="fa fa-times"></i> Hapus
																			</a>
																		</div>
																	</div>
																</div>
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=konfig_listusers';>
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
    case "hapususer":
    $sql 	= "delete from users where username='$_GET[id]'";
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
	case "edituser":
	
				
	if(count($_POST)) {
				$pass = md5($_POST[password]);
				 // code B
				$unik = uniqid();
				$lokasi_file = $_FILES['foto']['tmp_name'];
				$tipe_file   = $_FILES['foto']['type'];
				$nama_file   = $_FILES['foto']['name'];
				//$direktori   = 'image/'.$unik.'_'.$nama_file;
				$nama_file_unik   = $unik.'_'.$nama_file;
				  
				if (!empty($lokasi_file)) {
					unlink("image/$r[foto]");
					if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
						$msg = "
							<div class='alert alert-warning alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-warning'></i> Peringatan!</h4>
							File yang diupload harus dengan format JPEG.</div>";
					}else{
						UploadImage($nama_file_unik);
						//$_SESSION[foto]= $nama_file_unik;
						if (empty($_POST[password])){
							mysql_unbuffered_query("update users set nama_lengkap = '$_POST[nama_lengkap]',
																no_telp = '$_POST[no_telp]',
																level = '$_POST[level]',
																kode_supervisor = '$_POST[supervisor]',
																email = '$_POST[email]',
																blokir = '$_POST[blokir]',
																bisnis = '$_POST[bisnis]',
																foto = '$nama_file_unik' where username = '$_GET[id]'");
						}
						else {
							mysql_unbuffered_query("update users set nama_lengkap = '$_POST[nama_lengkap]',
																no_telp = '$_POST[no_telp]',
																level = '$_POST[level]',
																kode_supervisor = '$_POST[supervisor]',
																email = '$_POST[email]',
																blokir = '$_POST[blokir]',
																foto = '$nama_file_unik',
																bisnis = '$_POST[bisnis]',
																password = '$pass'
																where username = '$_GET[id]'");
						}

					}
				}
				else {
					if (empty($_POST[password])){
						mysql_unbuffered_query("update users set nama_lengkap = '$_POST[nama_lengkap]',
															no_telp = '$_POST[no_telp]',
															level = '$_POST[level]',
															kode_supervisor = '$_POST[supervisor]',
															email = '$_POST[email]',
															bisnis = '$_POST[bisnis]',
															blokir = '$_POST[blokir]'
															where username = '$_GET[id]'");
					}
					else {
						mysql_unbuffered_query("update users set nama_lengkap = '$_POST[nama_lengkap]',
															no_telp = '$_POST[no_telp]',
															level = '$_POST[level]',
															kode_supervisor = '$_POST[supervisor]',
															email = '$_POST[email]',
															blokir = '$_POST[blokir]',
															bisnis = '$_POST[bisnis]',
															password = '$pass'
															where username = '$_GET[id]'");
					}
				}
						
		$msg = "
					
		<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4><i class='icon fa fa-check'></i> Selamat!</h4>
		Berhasil menambah data.
		</div>
		
		";	
	}
	$a = "select * from users where username='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Edit Data Users</h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Users</span>
									</li>
									<li class="active">
										<span>Edit Users</span>
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
														Username <span class="symbol required"></span>
													</label>
													<input type="text" value = "<?php echo $r[username]; ?>" placeholder="Username" class="form-control" id="username" name="username" readonly required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Nama Lengkap <span class="symbol required"></span>
													</label>
													<input type="text" value = "<?php echo $r[nama_lengkap]; ?>" placeholder="Nama Lengkap" class="form-control" id="nama_lengkap" name="nama_lengkap">
												</div>
												<div class="form-group">
													<label class="control-label">
														Password <span class="symbol required"></span>
													</label>
													<input type="password" placeholder="Password" class="form-control" id="password" name="password">
												</div>
												<div class="form-group">
													<label class="control-label">
														Email <span class="symbol required"></span>
													</label>
													<input type="email" value = "<?php echo $r[email]; ?>" placeholder="Email" class="form-control" id="email" name="email">
												</div>
												<div class="form-group">
													<label class="control-label">
														Nomor Telp <span class="symbol required"></span>
													</label>
													<input type="text" value = "<?php echo $r[no_telp]; ?>" onkeypress="return hanyaAngka(event);" placeholder="Nomor Telp" class="form-control" id="no_telp" name="no_telp">
												</div>		
												<div class="form-group">
													<label class="control-label">
														Blokir <span class="symbol required"></span><br />
													</label>
												</div>
												<?php if ($r[blokir] == 'Y'){?>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio1" name="blokir" value="Y" checked = "checked">
													<label for="radio1">
														Yes
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="blokir" value="N">
													<label for="radio2">
														No
													</label>
												</div>
												<?php } else { ?>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio1" name="blokir" value="Y">
													<label for="radio1">
														Yes
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="blokir" value="N" checked="checked">
													<label for="radio2">
														No
													</label>
												</div>
												<?php } ?>
												<div class="form-group">
													<label for="form-field-select-2">
														Level <span class="symbol required"></span>
													</label>
													<select name = "level" id = "id_level" class="form-control">
													<?php 
														$tampil=mysql_query("SELECT * FROM level");
														if ($r[level]==''){
															echo "<option disabled selected value=''>Pilih Level</option>";
														}
														while ($w = mysql_fetch_array($tampil)){
															if ($r[level]==$w[kd_level]){
																echo "<option value = $w[kd_level] selected>$w[kd_level]</option>";
															}
															else {
																echo "<option value = $w[kd_level]>$w[kd_level]</option>";
															}
														}
													?>
													
													</select>
													
												</div>

												<div class="form-group" style="display: none;" id='id_spv'>
													<label for="form-field-select-2">
														Level <span class="symbol required"></span>
													</label>
													<?php
														echo "<select name='supervisor' class='form-control'>";
															$tampil=mysql_query("SELECT * FROM supervisor");
														echo "<option disabled selected value=''>Pilih Supervisor</option>";

															while($w=mysql_fetch_array($tampil))
																{
														echo "<option value=$w[kode_supervisor]>$w[nama_supervisor]</option>";        
																	}
														echo "</select>";
													?>
												</div>
												
												<div class="form-group">
													<label class="control-label">
														Bisnis <span class="symbol required"></span>
													</label>
													<select name="bisnis" id="bisnis" class="cs-select cs-skin-elastic">
														<option value = "" disabled >Pilih Bisnis</option>
														
														<option value = "SHOWROOM" selected>SHOWROOM</option>
													</select>
												</div>

											</div>
											<div class="col-md-6">
												<div class="form-group connected-group">
													<label class="control-label">
														Foto Sales <span class="symbol required"></span>
													</label>
													<div class="form-group">
																	<div class="fileinput fileinput-new" data-provides="fileinput">
																		<div class="fileinput-new thumbnail"><img src="image/<?php echo (!empty($lokasi_file) ? "medium_".$nama_file_unik : "medium_".$r[foto]); ?>" alt="">
																		</div>
																		<div class="fileinput-preview fileinput-exists thumbnail"></div>
																		<div class="user-edit-image-buttons">
																			<span class="btn btn-azure btn-file"><span class="fileinput-new"><i class="fa fa-picture"></i> Pilih foto</span><span class="fileinput-exists"><i class="fa fa-picture"></i> Ubah</span>
																				<input type="file" name="foto" id="foto">
																			</span>
																			<a href="#" class="btn fileinput-exists btn-red" data-dismiss="fileinput">
																				<i class="fa fa-times"></i> Hapus
																			</a>
																		</div>
																	</div>
																</div>
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=javascript:window.close();>
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
}
?>