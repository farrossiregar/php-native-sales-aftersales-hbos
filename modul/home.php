<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
?>
<?php $query = mysql_query("select * from users where username = '$_SESSION[username]'");
$r = mysql_fetch_array($query);
include "config/fungsi_thumb.php";
if (count($_POST)){
	$unik = uniqid();
	$lokasi_file = $_FILES['foto']['tmp_name'];
	$tipe_file   = $_FILES['foto']['type'];
	$nama_file   = $_FILES['foto']['name'];
	//$direktori   = 'image/'.$unik.'_'.$nama_file;
	$nama_file_unik   = $unik.'_'.$nama_file;
	
	if (!empty($lokasi_file)){$_SESSION[foto] = $nama_file_unik;}
}
 ?>
		

			<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Selamat Datang</h1>
									<span class="mainDescription"><?php echo $_SESSION['namalengkap']; ?></span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Pages</span>
									</li>
									<li class="active">
										<span>User Profile</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: USER PROFILE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<div class="tabbable">
										<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
											<li class="active">
												<a data-toggle="tab" href="#panel_overview">
													Data
												</a>
											</li>
											<li>
												<a data-toggle="tab" href="#panel_edit_account">
													Edit Account
												</a>
											</li>
											
										</ul>
										<div class="tab-content">
											<div id="panel_overview" class="tab-pane fade in active">
												<div class="row">
													<div class="col-sm-5 col-md-4">
														<div class="user-left">
															<div class="center">
																<h4><?php echo $_SESSION['namalengkap']; ?></h4>
																<div class="fileinput fileinput-new" data-provides="fileinput">
																	<div class="user-image">
																		<div class="fileinput-new thumbnail"><img src="<?php echo 'image/medium_'.$_SESSION[foto]; ?>" alt="">
																		</div>
																		<div class="fileinput-preview fileinput-exists thumbnail"></div>
																		<div class="user-image-buttons">
																			<span class="btn btn-azure btn-file btn-sm"><span class="fileinput-new"><i class="fa fa-pencil"></i></span><span class="fileinput-exists"><i class="fa fa-pencil"></i></span>
																				<input type="file">
																			</span>
																			<a href="#" class="btn fileinput-exists btn-red btn-sm" data-dismiss="fileinput">
																				<i class="fa fa-times"></i>
																			</a>
																		</div>
																	</div>
																</div>
																<hr>
																<!--div class="social-icons block">
																	<ul>
																		<li data-placement="top" data-original-title="Twitter" class="social-twitter tooltips">
																			<a href="http://www.twitter.com" target="_blank">
																				Twitter
																			</a>
																		</li>
																		<li data-placement="top" data-original-title="Facebook" class="social-facebook tooltips">
																			<a href="http://facebook.com" target="_blank">
																				Facebook
																			</a>
																		</li>
																		<li data-placement="top" data-original-title="Google" class="social-google tooltips">
																			<a href="http://google.com" target="_blank">
																				Google+
																			</a>
																		</li>
																		<li data-placement="top" data-original-title="LinkedIn" class="social-linkedin tooltips">
																			<a href="http://linkedin.com" target="_blank">
																				LinkedIn
																			</a>
																		</li>
																		<li data-placement="top" data-original-title="Github" class="social-github tooltips">
																			<a href="#" target="_blank">
																				Github
																			</a>
																		</li>
																	</ul>
																</div-->
																<hr>
															</div>
															<table class="table table-condensed">
																<thead>
																	<tr>
																		<th colspan="3">Informasi Data</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Username</td>
																		<td><?php echo $r[username] ?></td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	<tr>
																		<td>Nama User</td>
																		<td><?php echo $r[nama_lengkap] ?></td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	<tr>
																		<td>Website</td>
																		<td>
																		<a href="www.honda-bintaro.com">
																			www.honda-bintaro.com
																		</a></td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	<tr>
																		<td>Email</td>
																		<td>
																		<a href="">
																			<?php echo $r[email]; ?>
																		</a></td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	<tr>
																		<td>No Telepon</td>
																		<td><?php echo $r[no_telp] ?></td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	
																</tbody>
															</table>
															<table class="table">
																<thead>
																	<tr>
																		<th colspan="3">Informasi Umum</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Position</td>
																		<td><?php echo $r[jabatan]; ?></td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	<tr>
																		<td>Terakhir Login</td>
																		<td><?php echo $r[last_login] ?></td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>																	
																	
																</tbody>
															</table>
															<table class="table">
																<thead>
																	<tr>
																		<th colspan="3">informasi Lain</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Tanggal Lahir</td>
																		<td><?php echo date('d-m-Y',strtotime($r[tgl_lahir])) ?></td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																	<tr>
																		<td>Alamat</td>
																		<td><?php echo $r[alamat]; ?></td>
																		<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
													<div class="col-sm-7 col-md-8">
														<div class="row space20">
															<div class="col-sm-3">
																<button class="btn btn-icon margin-bottom-5 margin-bottom-5 btn-block">
																	<i class="ti-layers-alt block text-primary text-extra-large margin-bottom-10"></i>
																	Projects
																</button>
															</div>
															<div class="col-sm-3">
																<button class="btn btn-icon margin-bottom-5 btn-block">
																	<i class="ti-comments block text-primary text-extra-large margin-bottom-10"></i>
																	Messages <span class="badge badge-danger"> 23 </span>
																</button>
															</div>
															<div class="col-sm-3">
																<button class="btn btn-icon margin-bottom-5 btn-block">
																	<i class="ti-calendar block text-primary text-extra-large margin-bottom-10"></i>
																	Calendar
																</button>
															</div>
															<div class="col-sm-3">
																<button class="btn btn-icon margin-bottom-5 btn-block">
																	<i class="ti-flag block text-primary text-extra-large margin-bottom-10"></i>
																	Notifications
																</button>
															</div>
														</div>
														<div class="panel panel-white" id="activities">
															<div class="panel-heading border-light">
																<h4 class="panel-title text-primary">Recent Activities</h4>
																<paneltool class="panel-tools" tool-collapse="tool-collapse" tool-refresh="load1" tool-dismiss="tool-dismiss"></paneltool>
															</div>
															<div collapse="activities" ng-init="activities=false" class="panel-wrapper">
																<div class="panel-body">
																	<ul class="timeline-xs">
																		<li class="timeline-item success">
																			<div class="margin-left-15">
																				<div class="text-muted text-small">
																					...
																				</div>
																				<p>
																					
																					Mulailah setiap aktifitas dengan 
																					<a class="text-info" href>
																						berdoa 
																					</a>
																					terlebih dahulu
																				</p>
																			</div>
																		</li>
																		<li class="timeline-item">
																			<div class="margin-left-15">
																				<div class="text-muted text-small">
																					...
																				</div>
																				<p>
																					Kerjakan tugas dengan semaksimal mungkin
																				</p>
																			</div>
																		</li>
																		<li class="timeline-item danger">
																			<div class="margin-left-15">
																				<div class="text-muted text-small">
																					...
																				</div>
																				<p>
																					Jangan berhenti untuk berkarya dan berinovasi
																				</p>
																			</div>
																		</li>
																		<li class="timeline-item info">
																			<div class="margin-left-15">
																				<div class="text-muted text-small">
																					...
																				</div>
																				<p>
																					Tidak ada kata terlambat untuk 
																					<a class="text-info" href>
																						belajar
																					</a>
																					
																				</p>
																			</div>
																		</li>
																		<li class="timeline-item">
																			<div class="margin-left-15">
																				<div class="text-muted text-small">
																					...
																				</div>
																				<p>
																					Jangan mudah menyerah dengan keadaan sulit, disitulah awal perkembangan diri
																				</p>
																			</div>
																		</li>
																		<li class="timeline-item">
																			<div class="margin-left-15">
																				<div class="text-muted text-small">
																					...
																				</div>
																				<p>
																					Bersyukur akan mendatangkan kenikmatan yang lebih besar
																				</p>
																			</div>
																		</li>
																		<li class="timeline-item warning">
																			<div class="margin-left-15">
																				<div class="text-muted text-small">
																					...
																				</div>
																				<p>
																					......
																				</p>
																			</div>
																		</li>
																		<li class="timeline-item">
																			<div class="margin-left-15">
																				<div class="text-muted text-small">
																					...
																				</div>
																				<p>
																					.............
																				</p>
																			</div>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
														<div class="panel panel-white space20">
															<div class="panel-heading">
																<h4 class="panel-title">Recent Tweets</h4>
															</div>
															<div class="panel-body">
																<ul class="ltwt">
																	<li class="ltwt_tweet">
																		<p class="ltwt_tweet_text">
																			<a href class="text-info">
																				@hondabintaro
																			</a>
																			Sekarang booking service di Honda bintaro bisa online lho... :)
																		</p>
																		<span class="block text-light"><i class="fa fa-fw fa-clock-o"></i> 2 minuts ago</span>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="panel_edit_account" class="tab-pane fade">
												<?php if(count($_POST)) {
													$pass = md5($_POST[password]);
													$tgl_lahir = date('Y-m-d',strtotime($_POST[tgl_lahir]));
													 // code B
													
													  
													if (!empty($lokasi_file)) {
														unlink("image/$r[foto]");
														unlink("image/small_$r[foto]");
														unlink("image/medium_$r[foto]");
														if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
															$msg = "
																<div class='alert alert-warning alert-dismissable'>
																<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
																<h4><i class='icon fa fa-warning'></i> Peringatan!</h4>
																File yang diupload harus dengan format JPEG.</div>";
														}else{
															//move_uploaded_file($lokasi_file,$direktori); 
															UploadImage($nama_file_unik);
															$_SESSION[foto]= $nama_file_unik;
															if (empty($_POST[password])){
																mysql_unbuffered_query("update users set nama_lengkap = '$_POST[nama_lengkap]',
																									no_telp = '$_POST[no_telp]',
																									tgl_lahir = '$tgl_lahir',
																									alamat = '$_POST[alamat]',
																									email = '$_POST[email]',
																									jabatan = '$_POST[jabatan]',
																									foto = '$nama_file_unik' where username = '$_SESSION[username]'");
															}
															else {
																mysql_unbuffered_query("update users set nama_lengkap = '$_POST[nama_lengkap]',
																									no_telp = '$_POST[no_telp]',
																									tgl_lahir = '$tgl_lahir',
																									alamat = '$_POST[alamat]',
																									email = '$_POST[email]',
																									jabatan = '$_POST[jabatan]',
																									foto = '$nama_file_unik',
																									password = '$pass'
																									where username = '$_SESSION[username]'");
															}

														}
													}
													else {
														if (empty($_POST[password])){
															mysql_unbuffered_query("update users set nama_lengkap = '$_POST[nama_lengkap]',
																								no_telp = '$_POST[no_telp]',
																								tgl_lahir = '$tgl_lahir',
																									alamat = '$_POST[alamat]',
																									email = '$_POST[email]',
																									jabatan = '$_POST[jabatan]'
																								where username = '$_SESSION[username]'");
														}
														else {
															mysql_unbuffered_query("update users set nama_lengkap = '$_POST[nama_lengkap]',
																								no_telp = '$_POST[no_telp]',
																								tgl_lahir = '$tgl_lahir',
																									alamat = '$_POST[alamat]',
																									email = '$_POST[email]',
																									jabatan = '$_POST[jabatan]',
																								
																								password = '$pass'
																								where username = '$_SESSION[username]'");
														}
													}
																		
												} ?>
												<form action = "" enctype="multipart/form-data" role="form" id="form" method = "POST">
													<fieldset>
														<legend>
															Account Info
														</legend>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">
																		Username
																	</label>
																	<input type="text" value ="<?php echo $_SESSION[username]; ?>"  class="form-control" id="username" name="username" readonly>
																</div>
																<div class="form-group">
																	<label class="control-label">
																		Nama User
																	</label>
																	<input type="text" value = "<?php echo (count($_POST) ? $_POST[nama_lengkap] : $r[nama_lengkap]) ;?>" class="form-control" id="nama_lengkap" name="nama_lengkap">
																</div>
																<div class="form-group">
																	<label class="control-label">
																		Email 
																	</label>
																	<input type="email" value = "<?php echo (count($_POST) ? $_POST[email] : $r[email]) ?>" class="form-control" id="email" name="email">
																</div>
																<div class="form-group">
																	<label class="control-label">
																		No Telp
																	</label>
																	<input type="text" value = "<?php echo (count($_POST) ? $_POST[no_telp] : $r[no_telp]); ?>" class="form-control" id="no_telp" name="no_telp">
																</div>
																<div class="form-group">
																	<label class="control-label">
																		Password
																	</label>
																	<input type="password" placeholder="password" class="form-control" name="password" id="password">
																</div>
																<div class="form-group">
																	<label class="control-label">
																		Alamat
																	</label>
																	<textarea name="alamat" id="alamat" class="form-control"><?php echo (count($_POST) ? $_POST[alamat] : $r[alamat]); ?></textarea>
																	
																</div>
															</div>
															<div class="col-md-6">
																
																<div class="row">
																	<div class="col-md-4">
																		<div class="form-group">
																			<label class="control-label">
																				Tanggal Lahir
																			</label>
																			<div class="input-group input-append datepicker date" data-date-format='dd-mm-yyyy'>
																				<input type="text" value = "<?php echo (count($_POST) ? date("d-m-Y",strtotime($_POST[tgl_lahir])) : date("d-m-Y",strtotime($r[tgl_lahir]))); ?>" class="form-control" name = "tgl_lahir" id = "tgl_lahir" />
																				<span class="input-group-btn">
																					<button type="button" class="btn btn-default">
																						<i class="glyphicon glyphicon-calendar"></i>
																					</button> </span>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-8">
																		<div class="form-group">
																			<label class="control-label">
																				Jabatan
																			</label>
																			<input class="form-control" value = "<?php echo (count($_POST) ? $_POST[jabatan] : $r[jabatan]); ?>" type="text" name="jabatan" id="jabatan">
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	<label>
																		Image Upload
																	</label>
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
													</fieldset>
													
													
													<div class="row">
														
														<div class="col-md-4">
															<button class="btn btn-primary" type="submit">
																Update <i class="fa fa-arrow-circle-right"></i>
															</button>
														</div>
													</div>
												</form>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end: USER PROFILE -->
					</div>
				</div>
				
				
				
				
				
				
		