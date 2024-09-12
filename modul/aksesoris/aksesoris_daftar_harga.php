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
									<h1 class="mainTitle">Data Harga Aksesoris</h1>
									<span class="mainDescription">Modul Harga Aksesoris, Untuk Tambah dan Edit Harga Aksesoris</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Harga Aksesoris</span>
									</li>
									<li class="active">
										<span>Tabel Harga Aksesoris</span>
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
										<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=aksesoris_daftar_harga&act=tambahharga';>
											<span class="ladda-label"><i class="fa fa-plus"></i> Tambah Data</span>
										</button>
									</p>
									<hr>
									<?php
										}
									?>
									
									<div class="form-group">
										<form action="" method="GET" name="postform">
											<input type = "hidden" name = "module" value = "aksesoris_daftar_harga" />
												<div class="form-group">
													<label for="form-field-select-2">
														Pilih Model<span class="symbol required"></span>
													</label>													
													<select name = "model" id="model" class = "form-control" >														
														<option value="semua_model" selected disabled>CARI MODEL</option>
														<?php $data = mysql_query("select nama_model from model");
															while ($r=mysql_fetch_array($data))
															{
																if ($r[nama_model] == $_GET[model]){
																	$selek = "selected";
																}else {
																	$selek = "";
																}
																echo "<option value='$r[nama_model]' $selek > $r[nama_model] </option>";																
															}
														?>
													</select>
												</div>
									</div>
									
									<div class="form-group">
										<button type="submit" class="btn btn-white btn-info btn-bold">Tampilkan Data</button>
										</form>
									</div>
									
									<?php
									//di proses jika sudah klik tombol cari
										if($_GET['model'] != ''){
										$query=mysql_query("select * from harga_aksesoris where kode_tipe='$_GET[model]' ");
									?>
									
									<table id="sample_1" class="table table-striped table-bordered table-hover table-full-width">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama Aksesoris</th>
												<th>Harga Jual</th>
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
										
										<?php
											//untuk penomoran data
											$no=0;
											
											//menampilkan data
											while($row=mysql_fetch_array($query)){
											$no++;
										?>
										
											<tr>
												<td>
													<?php
														echo $no;
													?>
												</td>
												<td>
													<?php
														echo $row['nama_accs'];
													?>
												</td>
												<td>
													<?php
														echo "Rp ".number_format("$row[harga_jual]",0,".",".");
													?>
												</td>
												
												<?php
													$level = $_SESSION['leveluser'];
													
													$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ");
													$cek_akses2 = mysql_fetch_array($cek_akses);
													if($cek_akses2['edit'] == 'Y' && $cek_akses2['hapus'] == 'Y')
													{
												
												?>
													<td align="center">
														<a class="btn btn-xs btn-warning" href="media_showroom.php?module=aksesoris_daftar_harga&act=editharga&id=<?php echo "$row[nomor]"; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Update Harga <?php echo $row[kode_tipe]." ".$row[nama_accs]; ?>">

															<i class="fa fa-pencil"></i>
														</a>
														<a class="btn btn-xs btn-danger" href="media_showroom.php?module=aksesoris_daftar_harga&act=hapusharga&id=<?php echo $row['nomor'] ; ?>" onClick='return warning();' data-placement="top" data-toggle="tooltip" data-original-title="Hapus Harga <?php echo $row[kode_tipe]." ".$row[nama_accs]; ?>."><i class="fa fa-trash"></i></a>
													</td>
												<?php
													}elseif($cek_akses2['edit'] == 'Y' && $cek_akses2['hapus'] == ''){
												?>
													<td align="center">
														<a class="btn btn-xs btn-warning" href="media_showroom.php?module=aksesoris_daftar_harga&act=editharga&id=<?php echo "$row[nomor]"; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Update Harga <?php echo $row[kode_tipe]." ".$row[nama_accs]; ?>">
															<i class="fa fa-pencil"></i>
														</a>
													</td>
													
												<?php
													}elseif($cek_akses2['edit'] == '' && $cek_akses2['hapus'] == 'Y'){
												?>
													<td align="center">
														<a class="btn btn-xs btn-danger" href="media_showroom.php?module=aksesoris_daftar_harga&act=hapusharga&id=<?php echo $row['nomor'] ; ?>" onClick='return warning();' data-placement="top" data-toggle="tooltip" data-original-title="Hapus Harga <?php echo $row[kode_tipe]." ".$row[nama_accs]; ?>."><i class="fa fa-trash"></i></a>
													</td>
													
												<?php
													}else{
													
												?>
												<?php
													}
												?>
											</tr>
											
											<?php
												}
										}
											?>
												
									</table>
								</div>
							</div>
						</div>
						<!-- end: DYNAMIC TABLE -->
					</div>
				</div>
			
	<?php 
		break;
		case "tambahharga":
		
		if(count($_POST)) {
						if(mysql_num_rows($kueri)==0){
							mysql_unbuffered_query("insert into harga_aksesoris (kode_tipe, kode_accs, nama_accs, harga_pokok, harga_jual) 
							values('$_POST[kodetipe]','$_POST[kodeaccs]','$_POST[namaaccs]','$_POST[hargapokok]','$_POST[hargajual]')");
							
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
							Data sudah terdaftar.</div>";
						}
		}
	?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Harga Aksesoris</h1>
									<span class="mainDescription">Tambah Harga Aksesoris Baru pada Database</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Tambah Harga Aksesoris Baru</span>
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
												<!--div class="form-group">
													<label class="control-label">
														Kode Tipe <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Kode Tipe" class="form-control" id="kodetipe" name="kodetipe">
												</div-->
												<div class="form-group">
													<label for="form-field-select-2">
														Kode Tipe <span class="symbol required"></span>
													</label>
													<select name='kodetipe' id='kodetipe' class='form-control'>
														<option disabled selected>Pilih Tipe Mobil</option>
														<?php $data = mysql_query("select nama_model from model");
															while ($r=mysql_fetch_array($data))
															{
																if ($r[nama_model] == $_GET[model]){
																	$selek = "selected";
																}else {
																	$selek = "";
																}
																echo "<option value='$r[nama_model]' $selek > $r[nama_model] </option>";																
															}
														?>
													</select>
												</div>
												<div class="form-group">
													<label class="control-label">
														Kode Aksesoris <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Kode Aksesoris" class="form-control" id="kodeaccs" name="kodeaccs">
												</div>
												<div class="form-group">
													<label class="control-label">
														Nama Aksesoris <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Nama Aksesoris" class="form-control" id="namaaccs" name="namaaccs">
												</div>
												<div class="form-group">
													<label class="control-label">
														Harga Pokok <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Harga Pokok" class="form-control" id="hargapokok" name="hargapokok">
												</div>
												<div class="form-group">
													<label class="control-label">
														Harga Jual <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Harga Jual" class="form-control" id="hargajual" name="hargajual">
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=aksesoris_daftar_harga';>
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
    case "hapusharga":
    $sql 	= "delete from harga_aksesoris where nomor='$_GET[id]'";
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
	case "editharga":
	$a = "select * from harga_aksesoris where nomor='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
				
	if(count($_POST)) {
		mysql_unbuffered_query("update harga_aksesoris set kode_tipe = '$_POST[kodetipe]',
																kode_accs = '$_POST[kodeaccs]',
																nama_accs = '$_POST[namaaccs]',
																harga_pokok = '$_POST[hargapokok]',
																harga_jual = '$_POST[hargajual]' where nomor = '$_GET[id]'");
						
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
									<h1 class="mainTitle">Edit Harga Aksesoris</h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Daftar Harga Aksesoris</span>
									</li>
									<li class="active">
										<span>Edit Harga Aksesoris</span>
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
														Kode Tipe <span class="symbol required"></span>
													</label>
													<input type="text" value = "<?php echo $r['kode_tipe']; ?>" placeholder="Kode Tipe" class="form-control" id="kodetipe" name="kodetipe" readonly>
												</div>
												<div class="form-group">
													<label class="control-label">
														Kode Aksesoris <span class="symbol required"></span>
													</label>
													<input type="text" value = "<?php echo $r['kode_accs']; ?>" placeholder="Kode Aksesoris" class="form-control" id="kodeaccs" name="kodeaccs">
												</div>
												<div class="form-group">
													<label class="control-label">
														Nama Aksesoris <span class="symbol required"></span>
													</label>
													<input type="text" value = "<?php echo $r['nama_accs']; ?>"placeholder="Nama Aksesoris" class="form-control" id="namaaccs" name="namaaccs">
												</div>
												<div class="form-group">
													<label class="control-label">
														Harga Pokok <span class="symbol required"></span>
													</label>
													<input type="text" value = "<?php echo $r['harga_pokok']; ?>"placeholder="Harga Pokok" class="form-control" id="hargapokok" name="hargapokok">
												</div>
												<div class="form-group">
													<label class="control-label">
														Harga Jual <span class="symbol required"></span>
													</label>
													<input type="text" value = "<?php echo $r['harga_jual']; ?>" placeholder="Harga Jual" class="form-control" id="hargajual" name="hargajual">
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=window.location.href='?module=aksesoris_daftar_harga';>
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
}?>