<?php

	$a = "select * from test_drive_peminjaman_kendaraan where md5(md5(no_peminjaman)) = '$_GET[id]'";
	
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
	
	if(count($_POST)) {
		
		$tgl = date("Y-m-d H:i:s")	;	

		$app_time = date("Y-m-d H:i:s");
		$persetujuan_data = $_POST['status_approved'];
		$ket_approved = $_POST['ket_approved'];
		if($persetujuan_data == '1'){
			$persetujuan = 'Y';
		}else{
			$persetujuan = 'N';
		}
		
		$ket_approved = $_POST['ket_approved'];
		
		if($_SESSION['leveluser']=='SUPERVISOR'){
			mysql_unbuffered_query("update test_drive_peminjaman_kendaraan set spv_app = '$persetujuan', spv_user_app = '$_SESSION[namalengkap]', spv_app_time='$app_time' where md5(md5(no_peminjaman)) = '$_GET[id]'");
		}else if($_SESSION['leveluser']=='MNGR' or $_SESSION['leveluser']=='admin'){
			mysql_unbuffered_query("update test_drive_peminjaman_kendaraan set mngr_app = '$persetujuan', mngr_user_app = '$_SESSION[namalengkap]', mngr_app_time='$app_time' where md5(md5(no_peminjaman)) = '$_GET[id]'");
		}else if($_SESSION['leveluser']=='HRD'){
			mysql_unbuffered_query("update test_drive_peminjaman_kendaraan set hrd_app = '$persetujuan', hrd_user_app = '$_SESSION[namalengkap]', hrd_app_time='$app_time' where md5(md5(no_peminjaman)) = '$_GET[id]'");
		}else{
			mysql_unbuffered_query("update test_drive_peminjaman_kendaraan set mngr_app = '$persetujuan' where md5(md5(no_peminjaman)) = '123xyz'");
		}
	
	    $msg = "	
		<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4><i class='icon fa fa-check'></i> Selamat!</h4>
		Dokumen sudah diproses.
		</div>";
	}	
	
	
	$test_drive = mysql_query("select * from test_drive_peminjaman_kendaraan where md5(md5(no_peminjaman)) = '$_GET[id]'");
	$data_test_drive = mysql_fetch_array($test_drive);
    
?>
				
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">
									<?php 
										if ($_GET[act] == 'approvepermohonan'){echo "Setujui Permohonan Test Drive";}
									//	elseif ($_GET[act] == 'ajukanapprove'){echo "Ajukan Pengajuan Discount";}
									?></h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
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
								
								<script>
								/*	function cekstatus(){
										var Cek_status = $('input[name=status_approved]:checked').val();
										
										if  (Cek_status == "3"){
											$("#id_ket_approve").hide();
											$("#id_ket_permohonan").show();
										}else if (Cek_status == "2") {
											$("#id_ket_permohonan").hide();
											$("#id_ket_approve").show();
											
										}else if (Cek_status == "1") {
											$("#id_ket_approve").hide();
											
										}
									}	*/
								</script>
								
								
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="" >
										<div class="row">
											<?php echo(isset ($msg) ? $msg : ''); ?>
											<div class="errorHandler alert alert-danger no-display">
												<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
											</div>
											<div class="successHandler alert alert-success no-display">
												<i class="fa fa-ok"></i> Your form validation is successful!
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
																<input type="text" class="form-control" value ="<?php echo $data_test_drive['no_peminjaman'] ?>" readonly>
																</input>
															</div>
															<div class="form-group">
																<label class="control-label">
																	Pemohon <span class="symbol required"></span>
																</label>
																<input type="text" placeholder="No Permohonan" class="form-control" value ="<?php echo strtoupper($data_test_drive['nama_sales']).' / '.$data_test_drive['waktu_permohonan'] ?>" id="no_permohonan" name="no_permohonan" readonly>
																</input>
															</div>
															<div class="form-group">
																<label class="control-label">
																	Nama Customer <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" value ="<?php echo $data_test_drive['nama_customer'] ?>" placeholder="Nama Customer" class="form-control" id="nama_cust" name="nama_cust" readonly>
															</div>
															<div class="form-group">
																<label class="control-label">
																	Alamat <span class="symbol required"></span>
																</label>
																<div class="note-editor">
																	<textarea class="form-control" id="alamat" name="alamat" readonly><?php echo $data_test_drive['alamat_customer'] ?>"</textarea>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label">
																	No KTP
																</label>
																<input type="text"  class="form-control " id="no_ktp" name="no_ktp" value ="<?php echo $data_test_drive['no_ktp'] ?>" readonly>
															</div>
															<div class="form-group">
																<label class="control-label">
																	No Telp
																</label>
																<input type="text" class="form-control" id="telepon" name="telepon" value ="<?php echo $data_test_drive['no_telp'] ?>" readonly>
															</div>
															<div class="form-group">
																<label class="control-label">
																	Jenis Customer
																</label>
																<input type="text" class="form-control" id="jenis_customer" name="jenis_customer" value ="<?php echo $data_test_drive['jenis_customer'] ?>" readonly>
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
																		<input type="text" placeholder="" class="form-control" value="<?php echo trim($data_test_drive['tipe_mobil']) ?>" id="tipe_mobil" name="tipe_mobil" readonly>
																	</div>
																</div>
																<div class = "col-md-6">
																	<div class="form-group">
																		<label class="control-label">
																			Waktu Test Drive <span class="symbol required"></span>
																		</label>
																		<input type="text" class="form-control" id="tgl_test_drive" readonly name="tgl_test_drive" value="<?php echo $data_test_drive['tgl_test_drive'] ?>" required />
																	</div>
																</div>
															</div>
															<div class = "row">
																<div class = "col-md-6">
																	<div class="form-group">
																		<label for="form-field-select-2">
																			Jam Mulai <span class="symbol required"></span>
																		</label>
																		<input class="form-control" type="text" id="waktu_test_drive_awal" name="waktu_test_drive_awal" value="<?php echo trim($data_test_drive['jam_test_drive']) ?>"  readonly >
																	</div>
																</div>
																<div class = "col-md-6">
																	<div class="form-group">
																		<label class="control-label">
																			Jam Selesai <span class="symbol required"></span>
																		</label>
																		<input class="form-control simpan_test_drive" type="text" id="waktu_test_drive_akhir" name="waktu_test_drive_akhir" value="<?php echo $data_test_drive['estimasi_jam_selesai'] ?>" readonly >
																	</div>
																</div>
															</div>
															<div class = "row">
																<div class = "col-md-6">
																	<div class="form-group">
																		<label class="control-label">
																			Lokasi Test Drive
																		</label>
																		<input type="text"  class="form-control simpan_test_drive" id="lokasi_test_drive" name="lokasi_test_drive"  value = "<?php echo $data_test_drive['lokasi_test_drive'] ?>" readonly>
																	</div>
																</div>
																<div class = "col-md-6">
																	<div class="form-group">
																		<label class="control-label">
																			Peserta Test Drive
																		</label>
																		<input type="text"  class="form-control simpan_test_drive" id="peserta_test_drive" name="peserta_test_drive"  value = "<?php echo $data_test_drive['peserta_test_drive'] ?>" readonly >
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label">
																	Keterangan Test drive <span class="symbol required"></span>
																</label>
																<div class="form-group">
																	<div class="note-editor">
																		<textarea class="form-control" id="keterangan" name="keterangan" disabled><?php echo $data_test_drive['keterangan'] ?></textarea>
																	</div>
																</div>
															</div>
														</fieldset>
														
														<fieldset>
															<legend>INSPEKSI TERAKHIR MOBIL</legend>	
																<div class="row">
																	<div class = "row">
																		<div class = "col-md-3">
																			<div class="form-group">
																				<label class="control-label">
																					No WO <span class="symbol required"></span>
																				</label>
																				<input class="form-control simpan_test_drive" type="text" id="waktu_test_drive_akhir" name="waktu_test_drive_akhir" value="<?php echo $data_test_drive['estimasi_jam_selesai'] ?>" readonly >
																			</div>
																		</div>
																		<div class = "col-md-3">
																			<div class="form-group">
																				<label for="form-field-select-2">
																					No Polisi <span class="symbol required"></span>
																				</label>
																				<input class="form-control" type="text" id="waktu_test_drive_awal" name="waktu_test_drive_awal" value="<?php echo trim($data_test_drive['jam_test_drive']) ?>"  readonly >
																			</div>
																		</div>
																		<div class = "col-md-3">
																			<div class="form-group">
																				<label class="control-label">
																					Odometer <span class="symbol required"></span>
																				</label>
																				<input class="form-control simpan_test_drive" type="text" id="waktu_test_drive_akhir" name="waktu_test_drive_akhir" value="<?php echo $data_test_drive['estimasi_jam_selesai'] ?>" readonly >
																			</div>
																		</div>
																	</div>
																	<div class = "col-md-12">
																		<img src ="modul/prospek/action/kondisi_kendaraan/type-sedan.jpg" width = "100%">
																	</div>
																	<br><br><br>
																	<div class = "col-md-12">
																		<div class="table-responsive">
																			<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
																				<tbody>
																					<tr>
																						<th width="5%">KELENGKAPAN</th><th width="1%">CHECK</th>
																						<th width="30%">KONDISI</th>
																					</tr>
																						<?php 
																							include "config/koneksi_service_pdo.php";
																							
																						//	$pemeriksaan_mobil = $pdo->query("select * from test_drive_inspeksi where nama_model = 'BRIO' and no_peminjaman = '$data_test_drive[no_peminjaman]'");
																							$pemeriksaan_mobil = $pdo->query("select * from test_drive_inspeksi where no_pemeriksaan = '$data_test_drive[no_peminjaman]'");
																							while($data_pemeriksaan_mobil = $pemeriksaan_mobil->fetch()) {
																								$perlengkapan = $data_pemeriksaan_mobil['perlengkapan_kendaraan'];
																								$status_perlengkapan = $data_pemeriksaan_mobil['status_perlengkapan'];
																								$kondisi_perlengkapan = $data_pemeriksaan_mobil['kondisi_perlengkapan'];
																						?>
																								<tr>
																									<td><?php echo $perlengkapan; ?></td>
																									<td>
																										<div class="checkbox clip-check check-primary checkbox-inline" style="line-height: 10px;">
																											<input id="<?php echo $status_perlengkapan; ?>"  type="checkbox" <?php if($status_perlengkapan != 'Y'){ echo "";}else{echo "checked";} ?> >
																											<label for="<?php echo $perlengkapan; ?>">
																											</label>
																										</div>
																									</td>
																									<td>
																										<?php echo $kondisi_perlengkapan; ?>
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
														</fieldset>
													</div>
												</div>
												
												<?php 
													if ($_GET[act] == 'approvepermohonan'){
														if($_SESSION['leveluser'] == 'admin' || $_SESSION['leveluser'] == 'supervisor' || ($_SESSION['leveluser'] == 'MNGR') || ($_SESSION['leveluser'] == 'HRD')){
												?>
												<div class="radio clip-radio radio-primary radio-inline">												
													<input type="radio" id="radio1" name="status_approved" value="1" <?php if($_POST['status_approved']=='1'){echo 'checked';}?> onclick="cekstatus();" >
													
													<label for="radio1">
														Setujui
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="status_approved" value="2" <?php if($_POST['status_approved']=='2' and count($_POST)){echo 'checked';}?> onclick="cekstatus();" >
													<label for="radio2">
														Tidak Di Setujui
													</label>
												</div>
												<?php
														}
													}
												?>
												
											    <hr>
												<?php 
													if(!count($_POST)) {
														if($_SESSION['leveluser'] == 'admin' || $_SESSION['leveluser'] == 'supervisor' || ($_SESSION['leveluser'] == 'MNGR') || ($_SESSION['leveluser'] == 'HRD')){
												?>
												<button id="tombolsave" class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
												<?php
														}
													}
												?>
												<?php
													if($_GET['notif']!='Y'){
												?>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=<?php if(count($_POST)) { echo "history.go(-2)"; } else {echo "history.go(-1)";}?>>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
												
												<?php
													}else{
												?>
												
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=window.location.href='media_showroom.php?module=prospek_test_drive';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
												
												<?php
													}
												?>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>