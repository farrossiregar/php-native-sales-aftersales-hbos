<?php
session_start();

//require "config/koneksi_sqlserver.php";

//include "../../../config/koneksi_server_pdo.php";

$level = $_SESSION['leveluser'];
										    
$cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 
");
$cek_akses2 = mysql_fetch_array($cek_akses);						
if($cek_akses2['akses'] != 'Y'){
	include "modul/protected.php";

}else{
		
		switch($_GET[act]){
		//tampilkan data
		default:
?>	
<script type="text/javascript" src="modul/prospek/action/act/canvasdraw.js"></script>			
<script type="text/javascript" src="assets/js/jquery.1.6.js"></script>	

               <script language="JavaScript">
					function warning() {
						return confirm('Anda yakin menghapus data ini?');
					}
					function tampil(){
						document.getElementById("tampil_data").click();
					}
					
					function tampil_modal(id){
						param_id = id;
						//alert(id);
						$.ajax({
							method : "GET",
							url : "modul/logistik/action/puk_ajax_lihat_spk.php",
							data : {data_ajax : param_id},
							success : function(data){
								
								$('#modal').html(data);
								$("#modal").modal('show');
								
							}	
						})
						
					}
				</script>
				
				<?php
										
					if ($_GET['status']=='ok'){
						
						$msg = "
						<div class='alert alert-success alert-dismissable'>
						
						<h4><i class='icon fa fa-check'></i> Selamat!</h4>
						Berhasil menyimpan data, Pilih Tanggal dan klik tombol tampilkan data untuk melihat detail data yang sudah disimpan.</div>";
					?>
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog  modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="myModalLabel">Info</h4>
								</div>
								<div class="modal-body">
									<?php echo $msg; ?>
																						
									
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
					<?php }else if ($_GET['status']=='gagal'){	
						$msg = "
						<div class='alert alert-danger alert-dismissable'>
						
						<h4><i class='icon fa fa-check'></i> Perhatian!</h4>
						Gagal!!!! Data sudah ada..</div>";
					//echo $msg;
					?>
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog  modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="myModalLabel">Info</h4>
								</div>
								<div class="modal-body">
									<?php echo $msg; ?>
																						
									
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
					}
					?>
				
				
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE --->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">TEST DRIVE</h1>
									<span class="mainDescription">Peminjaman Unit Test Drive</span>
								</div>
								<!--ol class="breadcrumb">
									<li>
										<span>Logistik</span>
									</li>
									<li class="active">
										<span>Permohonan Unit Keluar</span>
									</li>
								</ol-->
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
										    if($cek_akses2['tambah_data'] == 'Y'){
										
										?>
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=prospek_test_drive&act=buat';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Tambah Data</span>
											</button>	
											
											<button type = "submit" class="btn btn-wide btn-o btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=prospek_test_drive&act=status_kendaraan';>
												<span class="ladda-label"><i class="fa fa-check"></i> Ubah Status Kendaraan</span>
											</button>
											
											<button type = "submit" class="btn btn-wide btn-o btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=prospek_test_drive&act=pengecekan_kendaraan_test_drive';>
												<span class="ladda-label"><i class="fa fa-check"></i> Pengecekan Kendaraan Test Drive</span>
											</button>
											
										<?php
											}
										?>
										<button type="button" class="btn btn-wide btn-o btn-success"  data-toggle="modal" data-target="#filter">
											Filter Pencarian
										</button>	
										<hr>
								</div>
							</div>
						<form action="" method="GET" name="postform">
							<input type = "hidden" name = "module" value = "propek_test_drive" />
							<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onpageshow="focus">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header" style="background-color: white;">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
											<h4 class="modal-title" id="myModalLabel">Filter Data</h4>
										</div>
										<div class="modal-body" style="background-color: white;">
											<label class="control-label">
												<font>Pilih Range Tanggal <span class="symbol required"></span></font>
											</label>
											<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
												<input class="form-control" type="text" placeholder ="Pilih Tanggal Awal" name="tgl_awal" id="tgl_awal" value = "<?php echo $_GET[tgl_awal] ?>" readonly>
													<span class="input-group-addon bg-primary">s/d</span>
												<input class="form-control" type="text" placeholder ="Pilih Tanggal Akhir" name="tgl_akhir" id="tgl_akhir" value = "<?php echo $_GET[tgl_akhir] ?>" readonly>
											</div>
										</div>
										<div class="modal-footer" style="background-color: white;">
											<button type="submit" name="cari" class="btn btn-primary">Tampilkan Data</button>
											<button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
												Close
											</button>
										</div>
									</div>
								</div>
							</div>
						 </form>
							<div class="row">
								<div class="col-md-12">
								<?php
									if(($_GET['tgl_awal'] != '') && ($_GET['tgl_akhir'] != '')){
										$test_drive = mysql_query("select * from test_drive_peminjaman_kendaraan where tgl_test_drive >= '$_GET[tgl_awal]' and tgl_test_drive <= '$_GET[tgl_awal]'");	
									}else{
										$test_drive = mysql_query("select * from test_drive_peminjaman_kendaraan order by tgl_test_drive, jam_test_drive asc");	
									}							
								?>
							
									<!--div class="table-header"><i><b>Pencarian Data Permohonan Unit Keluar <?php echo $_GET[tgl_awal] ?> Sampai <?php echo $_GET[tgl_akhir] ?> <?php echo $_SESSION['kode_supervisor'] ?></b></i></div><br /-->
						
									<table id="sample_2" class="table table-striped table-hover table-full-width">
										<thead>
											<tr>
												<th>No</th>
												<th>Data Test Drive</th>
												<th>Data Customer</th>
											</tr>
										</thead>
										<tbody>
														
										<?php
											$no = 0;
											while($data_test_drive = mysql_fetch_array($test_drive)){
												$tanggal_test_drive = $data_test_drive['tgl_test_drive'];
												$jam_test_drive_awal = $data_test_drive['jam_test_drive'];
												$jam_test_drive_akhir = $data_test_drive['estimasi_jam_selesai'];
												$no_peminjaman = $data_test_drive['no_peminjaman'];
												$nama = $data_test_drive['nama_customer'];
												$no_ktp = $data_test_drive['no_ktp'];
												$alamat = $data_test_drive['alamat_customer'];
												$telepon = $data_test_drive['no_telp'];
												$tipe = $data_test_drive['tipe_mobil'];
												$lokasi_test_drive = $data_test_drive['lokasi_test_drive'];
												$peserta_test_drive = $data_test_drive['peserta_test_drive'];
												$rencana_spk = $data_test_drive['rencana_spk'];
												
												if($tipe == 'ACCORD'){
													$button_color = "btn btn-light-azure";
												}elseif($tipe == 'BRIO'){
													$panel_color = "panel-primary";
													$button_color = "btn btn-light-green";
												}elseif($tipe == 'BR-V'){
													$button_color = "btn btn-info";
												}elseif($tipe == 'CR-V'){
													$button_color = "btn btn-light-orange";
												}elseif($tipe == 'CITY'){
													$button_color = "btn btn-light-red";
												}elseif($tipe == 'CIVIC'){
													$button_color = "btn btn-light-grey";
												}elseif($tipe == 'FREED'){
													$button_color = "btn btn-azure";
												}elseif($tipe == 'HR-V'){
													$button_color = "btn btn-wide btn-o btn-success";
												}elseif($tipe == 'JAZZ'){
													$button_color = "btn btn-wide btn-o btn-info";
												}elseif($tipe == 'MOBILIO'){
													$button_color = "btn btn-wide btn-o btn-dark-yellow";
												}else{
													$button_color = "btn btn-wide btn-o btn-dark-red";
												}
												
											$no++;
											$awal = $_GET['tgl_awal'];
											$akhir = $_GET['tgl_akhir'];
											$setuju = "<a class='btn btn-xs btn-success' href='media_showroom.php?module=prospek_test_drive&act=approvepermohonan&id=".md5(md5($data_test_drive[no_peminjaman]))."' data-placement='top' data-toggle='tooltip' data-original-title=' Setujui Permohonan Test Drive $data_test_drive[no_peminjaman]'><i class='fa fa-check'></i>Beri Persetujuan</a>";
										?>
										<tr>
											<td = 'tede'>
												<?php echo $no ?>
											</td>
											<td>
												<div class = '<?php echo $button_color ?>'><?php echo $tipe ?></div>
												<br><br>
												<b>
												Waktu Test Drive : <?php echo $tanggal_test_drive.' '.substr($jam_test_drive_awal, 0, 5).' - '.substr($jam_test_drive_akhir, 0, 5) ?><br>
												Lokasi Test Drive : <?php echo $lokasi_test_drive ?><br>
												Peserta Test Drive : <?php echo $peserta_test_drive ?><br><br>
												
												<?php
													if($data_test_drive['spv_app'] == 'Y'){
														echo "Disetujui Oleh Supervisor : ".$data_test_drive['spv_user_app']."<br>";
													}else if($data_test_drive['spv_app'] == 'N'){
														echo "Tidak Disetujui Oleh Supervisor"."<br>";
													}else{
														echo "Belum Disetujui Supervisor"."<br>";
													}
													
													if($data_test_drive['mngr_app'] == 'Y'){
														echo "Disetujui Oleh Manager : ".$data_test_drive['mngr_user_app']."<br>";
													}else if($data_test_drive['mngr_app'] == 'N'){
														echo "Tidak Disetujui Oleh Manager"."<br>";
													}else{
														echo "Belum Disetujui Manager"."<br>";
													}
													
													if($data_test_drive['hrd_app'] == 'Y'){
														echo "Disetujui Oleh HRD : ".$data_test_drive['hrd_user_app']."<br>";
													}else if($data_test_drive['hrd_app'] == 'N'){
														echo "Tidak Disetujui Oleh HRD"."<br>";
													}else{
														echo "Belum Disetujui HRD"."<br><br>";
													}
												?>
												<br><br>
												
												<?php
													if($rencana_spk == 'Y'){
												?>
													Rencana SPK : <?php echo $rencana_spk ?><br>
													Tujuan Test Drive : <?php echo $jenis_customer ?><br>
												<?php
													}
												?>
												
												
												</b>
												
												<?php 
													if($_SESSION['leveluser'] == 'user' or $_SESSION['leveluser'] == 'admin'){
														echo $hasil_test; 
													}
													
													if($_SESSION['leveluser'] == 'MNGR' or $_SESSION['leveluser'] == 'admin'){
														echo $setuju; 
													}
												?>
												<?php
													if($_SESSION['leveluser'] == 'user' or $_SESSION['leveluser'] == 'admin'){
												?>
													<a class='btn btn-xs btn-warning' href='media_showroom.php?module=prospek_test_drive&act=update&id=<?php echo md5(md5($data_test_drive['no_peminjaman'])); ?>' data-placement='top' data-toggle='tooltip' data-original-title='Hasil Test Drive <?php echo $dt['no_puk'] ?>'><i class='fa fa-edit'></i> Ubah Data</a>
												<?php 
													}
												?>
											</td>
											<td>
												<b>
													No Peminjaman : <?php echo $no_peminjaman ?><br>
													Nama Customer : <?php echo $nama ?><br>
													No KTP : <?php echo $no_ktp ?><br>
													No Telp : <?php echo $telepon ?><br>
													Alamat : <?php echo $alamat ?><br>
													
												</b>
											</td>
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
				</div>
				
				<div class="modal fade" id="modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							
				</div>

			
<?php 
	break;
	case "buat":
	include "action/test_drive_buat_permohonan_test_drive.php";
	
	break;
	case "status_kendaraan":
	include "action/test_drive_ubah_status_kendaraan.php";
	
	break;
	case "pengecekan_kendaraan_test_drive":
	include "action/test_drive_pengecekan_kendaraan_test_drive.php";

    break;
    case "hapuspengajuan":
    $sql 	= "delete from unit_keluar where no_spk='$_GET[id]'";
    $query	= mysql_query($sql);
   
	header('location:../media_showroom.php?module=prospek_test_drive');

	break;
	case "approvepermohonan":
	include "action/test_drive_approve_permohonan_test_drive.php";
	
	break;
	case "update":
	
	$query = mysql_query("select * from test_drive_peminjaman_kendaraan where md5(md5(no_peminjaman)) = '$_GET[id]'");
	$data = mysql_fetch_array($query);
?>				

				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Permohonan Test Drive</h1>
									<span class="mainDescription">Revisi permohonan Test Drive</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Permohonan Test Drive</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						
						
						
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" id="form" enctype="multipart/form-data" method="post" action="modul/prospek/action/test_drive_simpan_permohonan_test_drive.php?aksi=update">
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
												<div class="row">
													<div class="col-md-3">
														<fieldset>
															<legend>FORM PERMOHONAN UNIT KELUAR </legend>
															<div class="form-group">
																<label class="control-label">
																	No Peminjaman <span class="symbol required"></span>
																</label>
																<input id="no_peminjaman" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control simpan_test_drive" type="text"  value = "<?php echo $data['no_peminjaman'] ?>" name="no_peminjaman" required readonly>
																</input>
															</div>
															<div class="form-group">
																<label class="control-label">
																	Pemohon <span class="symbol required"></span>
																</label>
																<input type="text" placeholder="nama_sales" class="form-control" value ="<?php echo strtoupper($data['nama_sales']).' / '.$data['waktu_permohonan'] ?>" id="no_permohonan" name="no_permohonan" readonly>
																</input>
															</div>
															<div class="form-group">
																<label class="control-label">
																	Nama Customer <span class="symbol required"></span>
																</label>
																<input id="nama_cust" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control simpan_test_drive" type="text" value = "<?php echo $data['nama_customer'] ?>" name="nama_customer" required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>>
															</div>
															<div class="form-group">
																<label class="control-label">
																	Alamat <span class="symbol required"></span>
																</label>
																<div class="note-editor">
																	<textarea class="form-control" id="alamat" name="alamat" required ><?php echo $data['alamat_customer'] ?></textarea>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label">
																	No KTP
																</label>
																<input type="text"  class="form-control" id="no_ktp" name="no_ktp"  value = "<?php echo $data['no_ktp'] ?>" >
															</div>
															<div class="form-group">
																<label class="control-label">
																	No Telp
																</label>
																<input type="text"  class="form-control" id="telepon" name="telepon" value = "<?php echo $data['no_telp'] ?>">
																<!--input type="text"  class="form-control" id="telepon" name="telepon" value = "<?php echo $data['no_telp'] ?>" readonly <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>-->
															</div>
															<div class="form-group">
																<label class="control-label">
																	Jenis Customer
																</label>
																<input type="text" class="form-control" id="jenis_customer" name="jenis_customer" value = "<?php echo $data['jenis_customer'] ?>">
																<!--select name = "jenis_customer" id="jenis_customer" class = "form-control" value = "<?php echo $data['jenis_customer'] ?>">														
																	<option value="" selected disabled>JENIS CUSTOMER</option>
																	<option value="<?php if($data['jenis_customer'] == 'PEMBELIAN PERTAMA'){ echo "selected";}else{ echo "";} ?>">PEMBELIAN PERTAMA</option>
																	<option value="<?php if($data['jenis_customer'] == 'REPEAT ORDER'){ echo "selected";}else{ echo "";} ?>">REPEAT ORDER</option>
																	<option value="<?php if($data['jenis_customer'] == 'TRADE IN'){ echo "selected";}else{ echo "";} ?>">TRADE IN</option>
																</select-->
															</div>
															
													<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action=""  >			
															
														</fieldset>
														
													</div>	
													<div class="col-md-9">
														<fieldset>
															<legend>DATA TEST DRIVE</legend>
															<div class = "row">
																<div class = "col-md-6">
																	<div class="form-group">
																		<label for="form-field-select-2">
																			Tipe <span class="symbol required"></span>
																		</label>
																		<input class="form-control" type="text" name = "tipe_mobil" id="tipe_mobil" class = "form-control" value="<?php echo trim($data['tipe_mobil']) ?>" <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?> required >
																	</div>
																</div>
																<div class = "col-md-6">
																	<div class="form-group">
																		<label class="control-label">
																			Waktu Test Drive <span class="symbol required"></span>
																		</label>
																		<input class="form-control" type="text" id="tgl_test_drive" name="tgl_test_drive"   value = "<?php echo $data['tgl_test_drive'] ?>" required >
																	</div>
																</div>
															</div>
															<div class = "row">
																<div class = "col-md-6">
																	<div class="form-group">
																		<label for="form-field-select-2">
																			Jam Mulai <span class="symbol required"></span>
																		</label>
																		<input class="form-control" type="text" id="waktu_test_drive_awal" name="waktu_test_drive_awal" value="<?php echo trim($data['jam_test_drive']) ?>"  required >
																	</div>
																</div>
																<div class = "col-md-6">
																	<div class="form-group">
																		<label class="control-label">
																			Jam Selesai <span class="symbol required"></span>
																		</label>
																		<input class="form-control simpan_test_drive" type="text" id="waktu_test_drive_akhir" name="waktu_test_drive_akhir" value="<?php echo $data['estimasi_jam_selesai'] ?>"  required >
																	</div>
																</div>
															</div>
															<div class = "row">
																<div class = "col-md-6">
																	<div class="form-group">
																		<label class="control-label">
																			Lokasi Test Drive
																		</label>
																		<input type="text"  class="form-control simpan_test_drive" id="lokasi_test_drive" name="lokasi_test_drive"  value = "<?php echo $data['lokasi_test_drive'] ?>" required >
																	</div>
																</div>
																<div class = "col-md-6">
																	<div class="form-group">
																		<label class="control-label">
																			Peserta Test Drive
																		</label>
																		<input type="text"  class="form-control simpan_test_drive" id="peserta_test_drive" name="peserta_test_drive"  value = "<?php echo $data['peserta_test_drive'] ?>" required >
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label">
																	Keterangan Test drive <span class="symbol required"></span>
																</label>
																<div class="form-group">
																	<div class="note-editor">
																		<textarea class="form-control" id="keterangan" name="keterangan" ><?php echo $data['keterangan'] ?></textarea>
																	</div>
																</div>
															</div>
														</fieldset>
														
														<fieldset>
															<legend>
																Rencana SPK
															</legend>
															<div class = 'col-md-3'>
																<div class='radio clip-radio radio-primary radio-inline' >
																	<input id='spk1' name='rencana_spk' value='Y' type='radio'>
																	<label for='spk1'>
																		Ya
																	</label>
																</div>
															</div>
															
															<div class = 'col-md-3'>
																<div class='radio clip-radio radio-primary radio-inline' >
																	<input id='spk2' name='rencana_spk' value='N' type='radio'>
																	<label for='spk2'>
																		Tidak
																	</label>
																</div>
															</div>
															<br>
															<div class='col-md-12'>
																<div class='form-group'>
																	<label class='control-label'>
																		Keterangan <span class='symbol required'></span>
																	</label>
																	<div class='form-group'>
																		<div class='note-editor'>
																			<textarea class='form-control' id='keterangan_spk' name='keterangan_spk'></textarea>
																		</div>
																	</div>
																</div>
															</div>
														</fieldset>
														
													</div>
												</div>
											</div>
											
										</div>
										</br>
										<div class="row">											
											<div class="col-md-4">
												
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Simpan
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=window.location.href='media_showroom.php?module=prospek_test_drive'>
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
				
				
				<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onblur="reload();" onpageshow="focus">
							
				</div>


<?php	
	break;
	
}
}
 ?>