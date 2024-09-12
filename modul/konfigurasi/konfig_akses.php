<?php
session_start();
$level = $_SESSION['leveluser'];
										    
$cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 

");
$cek_akses2 = mysql_fetch_array($cek_akses);

										
if($cek_akses2['akses'] != 'Y'){

  
	include "modul/protected.php";

}else{
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
									<h1 class="mainTitle">Data Akses</h1>
									<span class="mainDescription">Modul Akses, Untuk Tambah dan Edit Data</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Tabel Akses</span>
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
											
											$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ");
											$cek_akses2 = mysql_fetch_array($cek_akses);
											if($cek_akses2['tambah_data'] == 'Y')
											{
										
										?>
										<p class="progress-demo">
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=konfig_akses&act=tambahakses';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Tambah Data</span>
											</button>
										</p>
										<?php
											}
										?>
									<hr>
									<div class = "table-responsive">
									<table class="table table-striped table-bordered table-hover table-full-width">
										<thead>
											<tr>
												<th width=3%>No.</th>
												<th>Level User</th>
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
												
												
												$sql = mysql_query("select * from akses group by level order by level asc");
												if(mysql_num_rows($sql) > 0){
												$no = 1;
												while($data = mysql_fetch_assoc($sql)){
						                        $lvl = $data['level'];
												$tambah = $data['tambah_data'];
												$akses=$data['akses'];
												$kodemenu = $data['kode_menu'];
												$icon=$data['icon'];
												
												$lv=mysql_query("select * from level where kd_level='$lvl'");
												while($dt=mysql_fetch_array($lv)){
													$nmlvl=$dt['nm_level'];
						
											?>
						
												<tr>
												<td><?php echo $no;?></td>
												<td><?php echo $nmlvl;?></td>
												<?php
														$level = $_SESSION['leveluser'];
														
														$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ");
														$cek_akses2 = mysql_fetch_array($cek_akses);
														if($cek_akses2['edit'] == 'Y' && $cek_akses2['hapus'] == 'Y')
														{
													
													?>
														<td align="center">
															<a class="btn btn-xs btn-warning" href="media_showroom.php?module=konfig_akses&act=editakses&id=<?php echo "$lvl"; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Update Akses <?php echo $lvl; ?>" >

																<i class="fa fa-pencil"></i>
															</a>
															<a class="btn btn-xs btn-danger" href="media_showroom.php?module=konfig_akses&act=hapusakses&id=<?php echo $lvl ; ?>" onClick='return warning();' data-placement="top" data-toggle="tooltip" data-original-title="Hapus Akses <?php echo $lvl; ?>."><i class="fa fa-trash"></i></a>
														</td>
													<?php
														}elseif($cek_akses2['edit'] == 'Y' && $cek_akses2['hapus'] == ''){
													?>
														<td align="center">
															<a class="btn btn-xs btn-warning" href="media_showroom.php?module=konfig_akses&act=editakses&id=<?php echo "$lvl"; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Update Akses <?php echo $lvl; ?>" >

																<i class="fa fa-pencil"></i>
															</a>
														</td>
														
													<?php
														}elseif($cek_akses2['edit'] == '' && $cek_akses2['hapus'] == 'Y'){
													?>
														<td align="center">
															<a class="btn btn-xs btn-danger" href="media_showroom.php?module=konfig_akses&act=hapusakses&id=<?php echo $lvl ; ?>" onClick='return warning();' data-placement="top" data-toggle="tooltip" data-original-title="Hapus Akses <?php echo $lvl; ?>."><i class="fa fa-trash"></i></a>
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
		case "tambahakses":
		
		if(count($_POST)) {
			
			$qry=mysql_query("select * from menu group by kode_menu");
			$n = 0;
			while($sql=mysql_fetch_array($qry)){
			$n=$n+1;	
			
			$kdmn=$_POST['kodemenu'.$n];
			$aks=$_POST['akses'.$n];
			$tmbdt=$_POST['tambahdata'.$n];
			$edit=$_POST['edit'.$n];
			$hapus=$_POST['hapus'.$n];
			$ekspor=$_POST['ekspor'.$n];
				$cek=mysql_query("select * from akses where level = '$_POST[level]' and kode_menu = '$kdmn'");
				
				$jml_rec = mysql_num_rows($cek);
				
				if ($jml_rec < 1){
				mysql_unbuffered_query("insert into akses (level, kode_menu, akses, tambah_data, edit, hapus, ekspor) 
				values('$_POST[level]','$kdmn','$aks','$tmbdt','$edit','$hapus','$ekspor')");
				
				$msg = "
				<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-check'></i> Selamat!</h4>
				Berhasil Menambah Data.</div>";
						
				}else {
				$msg = "							
				<div class='alert alert-warning alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-warning'></i> Gagal!</h4>
				Data Sudah Ada.</div>";}
				
				}
	}
?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Akses</h1>
									<span class="mainDescription">Tambah Akses Baru pada Database</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Tambah Akses Baru</span>
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
													<label for="form-field-select-2">
														Level User <span class="symbol required"></span>
													</label>
													
													<select name = "level" id = "level" class="form-control" required>
														<option disabled selected value=''>Pilih Level Menu</option>
														<?php 
															$data = mysql_query("select * from level order by nm_level asc");
															while ($r=mysql_fetch_array($data))
															{
																echo "<option value='$r[kd_level]'> $r[nm_level] </option>";																
															}
    													?>
													</select>
												</div>
												<div class = "table-responsive">
													<table class="table table-striped table-bordered table-hover table-full-width">
														<thead>
															<tr>
																<th>Kode Menu</th>
																<th>Nama Menu</th>
																<th>Akses</th>
																<th>Tambah</th>
																<th>Edit</th>
																<th>Delete</th>
																<th>Ekspor</th>
															</tr>
														</thead>
														<tbody>
														<?php
															$qry=mysql_query("select * from menu group by kode_menu order by kode_menu asc");
															$n = 0;
															while($sql=mysql_fetch_array($qry)){
															$n=$n+1;	
														?>
															<tr>
																<td><input type="text" name="kodemenu<?php echo $n; ?>" id="kodemenu" value="<?php echo $sql['kode_menu']; ?>" readonly></td>
																<td><?php echo $sql['nama_menu']; ?></td>
																<td><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="akses<?php echo $n; ?>" id="akses" value = 'Y'/></td>
																<td><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="tambahdata<?php echo $n; ?>" id="tambahdata" value = 'Y'/></td>
																<td><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="edit<?php echo $n; ?>" id="edit" value = 'Y'/></td>
																<td><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="hapus<?php echo $n; ?>" id="hapus" value = 'Y'/></td>
																<td><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="ekspor<?php echo $n; ?>" id="ekspor" value = 'Y'/></td>
																
															</tr>
														<?php
															}
														?>
														</tbody>
													</table>
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
													<i class="fa fa-save"></i> Simpan
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=konfig_akses';>
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
			
		

<?php
    break;
    case "hapusakses":
    $sql 	= "delete from akses where level='$_GET[id]'";
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
	case "editakses":
	$a = "select * from akses where level='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
				
	if(count($_POST)) {
		$cueri=mysql_query("select * from menu order by kode_menu asc");
			$k = 0;
		while($sql=mysql_fetch_array($cueri)){
				
			$k = $k+1;		
			
			$kdmn=$_POST['kodemenu'.$k];
			$aks=$_POST['akses'.$k];
			$tmbdt=$_POST['tambahdata'.$k];
			$edit=$_POST['edit'.$k];
			$hapus=$_POST['hapus'.$k];
			$ekspor=$_POST['ekspor'.$k];
			$qry2=mysql_query("select * from akses where level='$_POST[level]' and kode_menu = '$kdmn'");
				$row=mysql_num_rows($qry2);
				if($row >= 1){
					mysql_unbuffered_query("update akses set akses = '$aks', tambah_data = '$tmbdt', edit = '$edit', hapus = '$hapus', ekspor = '$ekspor' where kode_menu = '$kdmn' and level='$_GET[id]'");
							
					$msg = "			
					<div class='alert alert-success alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Selamat!</h4>
						Berhasil Ubah Data, Silahkan Refresh Halaman.
					</div>";
					
					}else{
						
					mysql_unbuffered_query("insert into akses (level, kode_menu, akses, tambah_data, edit, hapus, ekspor) 
							values('$_POST[level]','$kdmn','$aks','$tmbdt','$edit', '$hapus','$ekspor')");
									
							$msg = "			
							<div class='alert alert-success alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								<h4><i class='icon fa fa-check'></i> Selamat!</h4>
								Berhasil Menambah Data.
							</div>";
						
					}				
	
			}
	
	}
?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Edit Data Akses</h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Akses</span>
									</li>
									<li class="active">
										<span>Edit Akses</span>
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
											<div class="col-md-12">
												
												<div class="form-group">
													<label class="control-label">
														Level User
													</label>
													<input type="text" value = "<?php echo $r['level']; ?>" class="form-control" id="level" name="level" readonly>
												</div>
												<div class="table-responsive">
													<table class="table table-striped table-bordered table-hover table-full-width" >
														<thead>
															<tr>
																<th>No</th>
																<th>Kode Menu</th>
																<th>Nama Menu</th>
																<th>Akses</th>
																<th>Add</th>
																<th>Edit</th>
																<th>Delete</th>
																<th>Ekspor</th>
															</tr>
														</thead>
														<tbody>
														<?php
															$no = 1;
															
															$qry=mysql_query("select * from menu order by kode_menu asc");
															$t = 0;
															while($sql=mysql_fetch_array($qry)){
															$t=$t+1;	
															
															$qry2=mysql_query("select * from akses where kode_menu='$sql[kode_menu]' and level='$r[level]'");
															$data_2 = mysql_fetch_array($qry2);
															$jml_rec = mysql_num_rows($qry2);
															
															if ($jml_rec >0){
																
																?>
															
																<tr>
																	<td><?php echo $no; ?></td>
																	<td><input type="text" name="kodemenu<?php echo $t;?>" id="kodemenu" value="<?php echo $sql['kode_menu']; ?>" readonly></td>
																	<td><?php echo $sql['nama_menu']; ?></td>
																	
																	<?php 
																		
																		if($data_2['akses'] == 'Y'){
																			$value = 'checked';
																		}else{
																			$value = '';
																		}
																		if($data_2['tambah_data'] == 'Y'){
																			$value1 = 'checked';
																		}else{
																			$value1 = '';
																		}
																		if($data_2['edit'] == 'Y'){
																			$value2 = 'checked';
																		}else{
																			$value2 = '';
																		}
																		if($data_2['hapus'] == 'Y'){
																			$value3 = 'checked';
																		}else{
																			$value3 = '';
																		}
																		if($data_2['ekspor'] == 'Y'){
																			$value4 = 'checked';
																		}else{
																			$value4 = '';
																		}
																	?>
																	
																	<td><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="akses<?php echo $t;?>" id="akses" value='Y' <?php echo $value; ?> >    </td>
																	<td><?php if ($sql['level_menu'] == 'sub_menu'){ ?><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="tambahdata<?php echo $t;?>" id="tambahdata" value='Y' <?php echo $value1; ?>> <?php } ?></td>
																	<td><?php if ($sql['level_menu'] == 'sub_menu'){ ?><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="edit<?php echo $t;?>" id="edit" value='Y' <?php echo $value2; ?>/><?php } ?></td>
																	<td><?php if ($sql['level_menu'] == 'sub_menu'){ ?><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="hapus<?php echo $t;?>" id="hapus" value='Y' <?php echo $value3; ?>><?php } ?></td>
																	<!--td><input type="checkbox" name="ekspor<?php echo $t;?>" id="ekspor" value='Y' <?php echo $value4; ?>></td-->
																	<td><?php if ($sql['level_menu'] == 'sub_menu'){ ?><input data-toggle="toggle" data-onstyle="primary" data-size="mini" value="Y" <?php echo $value4; ?> type="checkbox" name="ekspor<?php echo $t;?>"><?php } ?></td>
																</tr>
																
																<?php
															}else {	
																?>
																<tr>
																	<td><?php echo $no; ?></td>
																	<td><input type="text" name="kodemenu<?php echo $t;?>" id="kodemenu" value="<?php echo $sql['kode_menu']; ?>" readonly></td>
																	<td><?php echo $sql['nama_menu']; ?></td>	
																	<td><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="akses<?php echo $t;?>" id="akses" value='Y' /></td>
																	<td><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="tambahdata<?php echo $t;?>" id="tambahdata" value='Y' ></td>
																	<td><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="edit<?php echo $t;?>" id="edit" value='Y' /></td>
																	<td><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="hapus<?php echo $t;?>" id="hapus" value='Y' ></td>
																	<td><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="ekspor<?php echo $t;?>" id="ekspor" value='Y' ></td>
																</tr>
																
																
																<?php
																}
																?>	
															<?php
																$no++;
															}
															?>
														</tbody>
													</table>
												</div>
												
											</div>
											
										</div>
										
										<div class="row">											
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Update
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=window.location.href='?module=konfig_akses';>
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
		}
} ?>