<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
?>
<?php 
require "config/fungsi_thumb.php";


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
 
 <style type = "text/css">
 .item {
    position:relative;
    //padding-top:20px;
    display:inline-block;
}
.tengah {
margin: 0px 0 20px 0;
text-align: center;
//background: #bdbdbd;
padding: 0px;
}

.border {
background : white;
border:3px solid #DA251D;
}

.notify-badge{
    position: absolute;
    right:-30px;
    top:-10px;
    background:red;
    text-align: center;
    border-radius: 10px 10px 10px 10px;
    color:white;
    padding:5px 10px;
    font-size:15px;
	-moz-transform: rotate(30deg);
    -webkit-transform: rotate(30deg);
    -ms-transform: rotate(30deg);
    -o-transform: rotate(30deg);
}
 
 </style>
		

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
										
										
										<?php 
										
											date_default_timezone_set('Asia/Jakarta');
											$bulan1 = date("m")-1;
											if ($bulan1 == 0){
												$bulan1 = 12;												
											}else {
												$bulan1 = date("m")-1;
												
											}
											
											
											//$bulan1 = date("m")-1;
											switch ($bulan1) {
												case 1:
												$nama_bulan = "Januari";
												break;
												case 2:
												$nama_bulan = "Februari";
												break;
												case 3:
												$nama_bulan = "Maret";
												break;
												case 4:
												$nama_bulan = "April";
												break;
												case 5:
												$nama_bulan = "Mei";
												break;
												case 6:
												$nama_bulan = "Juni";
												break;
												case 7:
												$nama_bulan = "Juli";
												break;
												case 8:
												$nama_bulan = "Agustus";
												break;
												case 9:
												$nama_bulan = "September";
												break;
												case 10:
												$nama_bulan = "Oktober";
												break;
												case 11:
												$nama_bulan = "November";
												break;
												case 12:
												$nama_bulan = "Desember";
												break;
												
											}
											if ($bulan1 == "12"){
												$year = date("Y")-1;
												$bulan = (strlen($bulan1) == 2 ? $bulan1 : "0".$bulan1)  .'-'.$year;
											}else {
												$bulan = (strlen($bulan1) == 2 ? $bulan1 : "0".$bulan1)  .'-'.date("Y");
											}
											//$bulan = (strlen($bulan1) == 2 ? $bulan1 : "0".$bulan1)  .'-'.date("Y");
											$query_faktur = mysql_query("SELECT count(sf.kode_sales) as num, sf.*, ts.*, (count(sf.kode_sales)/ts.target_unit*100) as pencapaian, MAX(tanggal) as tgl 
																			FROM summary_faktur sf, target_sales ts WHERE sf.kode_sales = ts.kode_sales and sf.bulan = '$bulan' and ts.bulan = '$bulan' group 
																			by sf.kode_sales order by pencapaian desc ,tgl asc limit 1");
											
										?>
										<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog  modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
														<h4 class="modal-title" id="myModalLabel">Info</h4>
													</div>
													
										<?php
										//	if($_SESSION['leveluser']=='admin'){
												$stok = mysql_query("SELECT dm.norangka,nomesin,harga_jual,tahun_buat,tglbeli,nopenjualan,tglmatching,kode_model,nama_model,kode_tipe,nama_tipe,kode_warna,nama_warna,bisabooking,
																	umur ,kode_sales,nama_sales,nomatching,nofaktur,status,ml.norangka_local,ml.nama_sales_local,ml.tgl,ml.nounique,ml.fix,ml.user,ml.no_spk_local,
																	ml.nama_customer_local,ml.jenis_pembayaran_local, ff.norangka as rangka_fiktif FROM data_mobil dm 
																	
																	left join matching_local ml on ml.norangka_local = dm.norangka and ml.aktif='Y' 
																	left join faktur_fiktif ff on ff.norangka = dm.norangka where dm.nomatching='' and dm.nopenjualan='' and dm.tahun_buat = '2017' ");
												$stok2 = mysql_num_rows($stok);
										?>
											<!--div class="modal-body">
												<div class='alert alert-success'>
													<h3><b>Stok 2017 : <?php echo $stok2 ?></b></h3>
												</div>
											</div-->	
										<?php
										//	}
										?>												
													
										<div class="modal-body">
											<?php
											/*
											echo "<div class='alert alert-success'>";
																		echo "Prospek : <br/>
																		<table>
																		<tr>
																		<td>FO </td><td style='padding-left : 8px;'>: 4 Hari (Min 1 Prospek)</td>
																		</tr>
																		<tr>
																		<td>CO</td> <td style='padding-left : 8px;'>: 5 Hari (Min 1 Prospek)</td>
																		</tr>
																		<tr>
																		<td>F1/C1</td> <td style='padding-left : 8px;'>: 3 Hari (Min 1 Prospek)</td>
																		</tr>
																		<tr>
																		<td>F3/F2/C2/C3 </td> <td style='padding-left : 8px;'>: 2 Hari (Min 1 Prospek)</td>
																		</tr>
																		
																		</table>"
																		
																		;
																		echo "</div>";
																		
																		*/
											
											?>
											
											<div class = "tengah">
											
											<?php
											
														$n = 0;
												while ($d = mysql_fetch_array($query_faktur)){
													if ($d[pencapaian] >= 100){
														
														
															$query2 = mysql_query("select * from users where kode_sales ='$d[kode_sales]'");
															$g = mysql_fetch_array($query2);
											?>
												<br/>
											<div class="item border">
													
													<img src="<?php echo 'image/medium_'.$g[foto]; ?>" alt="">
													<span class="notify-badge">Best Sales</span>
													<br />
													<?php echo strtoupper($g[nama_lengkap]); ?>
													<br/>
													<?php echo 'Team : '.$g[kode_supervisor]; ?>
													<br/>
													<?php echo 'Pencapaian : '. round($d[pencapaian]).'%'; ?>
													<br/>
													<?php echo 'Bulan : '. $nama_bulan; ?>
													
											</div>
											<?php 
												
														
														}
												}
												
											?>
											</div>
											
											
											
											
											
													
													<?php 
								
								$bulan = "$_GET[bulan]"."-"."$_GET[tahun]";
								
								?>
													
													
													<!--video width="100%" height="100%" controls="controls">
														<source src="modul/tutorial.mp4" type="video/mp4" />
													</video-->
														<?php
														
											$hari_ini = date("Y-m-d");
											$query_data = "select * from informasi where tgl_awal <= '$hari_ini' and tgl_akhir >= '$hari_ini' ";
											$d=mysql_query("$query_data");
											$filter = " and kode_spv = '$_SESSION[kode_spv]'";
											
											//$filter_data = "$d $filter";
														
														
														if (mysql_num_rows($d) > 0 ){
															//$hari_ini = date("Y-m-d");
															//$d=mysql_query("select * from informasi where tgl_awal <= '$hari_ini' and tgl_akhir >= '$hari_ini' ");
															
															if ($_SESSION[leveluser] != 'supervisor' and $_SESSION[leveluser] != 'user'){
																while ($r=mysql_fetch_array($d)){
																    if ($r[kode_spv]==''){
																		echo "<div class='alert alert-danger'>";
																		echo "<b>$r[judul]</b><br/>$r[isi_informasi]<hr> ";
																		echo "</div>";
																	}else{
																		$a=mysql_query("select * from supervisor where kode_supervisor = '$r[kode_spv]'");
																		$b=mysql_fetch_array($a);
																		echo "<div class='alert alert-success'>";
																		echo "<b>$r[judul] (Team : $b[nama_supervisor]) </b><br/>$r[isi_informasi]<hr> ";
																		echo "</div>";
																		
																	}
																	
																}
															}elseif($_SESSION[leveluser] == 'supervisor' || $_SESSION[leveluser] == 'user'){
																$d = mysql_query("$query_data $filter");
																if (mysql_num_rows($d) >= 1){
																	
																
																	
																echo "<div class='alert alert-danger'>";
																echo "<h4>Info Team</h4> <br/>";
																
																
																
																while ($r=mysql_fetch_array($d)){
																	$a=mysql_query("select * from supervisor where kode_supervisor = '$_SESSION[kode_spv]'");
																	$b=mysql_fetch_array($a);
																	echo "<b>$r[judul] (Team : $b[nama_supervisor])</b><br/>$r[isi_informasi]<hr> ";
																	
																}
																echo "</div>";
																}
																//info untuk dealer
																
																$d = mysql_query("$query_data and kode_spv=''");
																echo "<div class='alert alert-success'><h4>Info Dealer </h4><br/>";
																
																while ($r=mysql_fetch_array($d)){
																	echo "<b>$r[judul]</b><br/>$r[isi_informasi]<hr> ";
																	
																}
																echo "</div>";
																
															}
														?>
														
														<!--div class="alert alert-success">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
															
														</div-->
														
														<?php
														}	
														?>
													</div>
													
													
													
													
													<div class="modal-footer">
														<button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
															Tutup
														</button>
														<!--button type="button" class="btn btn-primary">
															Save changes
														</button-->
													</div>
												</div>
											</div>
										</div>
										
										<?php
												
												
												$query = mysql_query("select * from users where username = '$_SESSION[username]'");
												$r = mysql_fetch_array($query);
										?>
										
										
										
										<div class="tab-content">
											<div id="panel_overview" class="tab-pane fade in active">
												<div class="row">
													<div class="col-sm-12 col-md-12">
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
																	<input type="password" placeholder="password" class="form-control" name="password" id="password" >
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
																			<div class="input-group input-append datepicker date" data-date-format='yyyy-mm-dd'>
																				<input type="text" value = "<?php echo (count($_POST) ? date("Y-m-d",strtotime($_POST[tgl_lahir])) : date("Y-m-d",strtotime($r[tgl_lahir]))); ?>" class="form-control" name = "tgl_lahir" id = "tgl_lahir" />
																				<span class="input-group-btn">
																					<button type="button" class="btn btn-default">
																						<i class="glyphicon glyphicon-calendar"></i>
																					</button> </span>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-8">
																		<div class="form-group" style="display:none;">
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
				
				
				
				
				
				
		