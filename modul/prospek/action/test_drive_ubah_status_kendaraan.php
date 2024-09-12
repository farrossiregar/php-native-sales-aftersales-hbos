
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Permohonan Test Drive</h1>
									<span class="mainDescription">Ubah Status Kendaraan Test Drive</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Ubah Status Kendaraan Test Drive</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						
						<script>
							function modal_pengecekan_mobil($model){
								$("#modal_pengecekan_mobil_test_drive").modal('show');
								var model = $model;
								$.ajax({
									method : "post",
									url : "modul/prospek/action/test_drive_pemeriksaan_kendaraan.php",
									data : "model="+model,
									success : function(data){
									//	console.log("hahaha");
										
										$('#modal_pengecekan_mobil_test_drive').html(data);
									}
								})
							}
						</script>
						
						<div class="container-fluid container-fullw bg-white">
							
									<div class="modal fade" id="modal_pengecekan_mobil_test_drive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onpageshow="focus">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header" style="background-color: white;">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='exit_modal();'>
														<span aria-hidden="true">&times;</span>
													</button>
													<h4 class="modal-title" id="myModal2Label"></h4>
												</div>
												<div class="modal-body" style="background-color: white;">
													<form role="form" id="form" enctype="multipart/form-data" method="post" >
														<div class="row">
															<div class="col-md-12">
																<div class="row" hidden>
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">
																				No Pengecekan
																			</label>
																			<input id="no_pengecekan" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="no_pengecekan" readonly>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
							
							<div class="row">
								<div class="col-md-12">
									<form role="form" id="form" enctype="multipart/form-data" method="post" action="modul/prospek/action/test_drive_simpan_permohonan_test_drive.php">
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
													<div class="row">
														<fieldset>
															<legend>Data Customer</legend>
															<form role="form" id="form" enctype="multipart/form-data" method="post" action="modul/prospek/action/test_drive_simpan_status_kendaraan.php">
																<div class="row" >
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
																				<div class="form-group">
																					<label class="control-label">
																						Tanggal Pengecekan
																					</label>
																					<input type="text" value = "<?php echo date('Y-m-d'); ?>" class="form-control" id="tanggal_pengecekan" name="tanggal_pengecekan" readonly>
																				</div>
																			</div>
																		</div><br><br>
																		<div class="table-responsive">
																			<table class="table table-striped table-hover table-full-width" >
																				<thead>
																					<tr>
																						<th width = '5%'>No</th>
																						<th width = '25%'>Data Mobil</th>
																						<th>Keterangan</th>
																						<th width = '15%'></th>
																					</tr>
																				</thead>
																				<tbody>
																				<?php
																					include "config/koneksi_service_pdo.php";
																					$jam_skrg = date('H:i:s');
																					
																					$no = 1;
																					$status_kendaraan = $pdo->query("select skm.*, ptd.*, skm.no as no_mobil from test_drive_status_ketersediaan_mobil skm 
																														left join test_drive_peminjaman_kendaraan ptd on skm.nama_model = ptd.tipe_mobil
																														order by skm.nama_model asc");
																					$t = 0;
																					while ($data_status_kendaraan = $status_kendaraan->fetch()) {
																					$t=$t+1;
																				?>
																					
																					<tr>
																						<td>
																							<?php echo $no; ?>
																						</td>
																						<td>
																							<input type="hidden" name="kodemenu<?php echo $t;?>" id="kodemenu" value="<?php echo $data_status_kendaraan['nama_model']; ?>" readonly>
																							<input type="hidden" name="kodemenu<?php echo $t;?>" id="kodemenu" value="<?php echo $data_status_kendaraan['no_polisi']; ?>" readonly>
																							<input type="hidden" name="kodemenu<?php echo $t;?>" id="kodemenu" value="<?php echo $data_status_kendaraan['pemilik_kendaraan']; ?>" readonly>
																							<b>
																								<?php
																									echo "<span class='label label-primary'>".$data_status_kendaraan['nama_model']."</span>"; 
																								?>
																								<br><br>
																								<?php echo $data_status_kendaraan['no_polisi']; ?><?php echo $_GET['tanggal_pengecekan'] ?><br>
																								<?php echo $data_status_kendaraan['pemilik_kendaraan']; ?><br><br>
																							</b>
																							<div class = "row">
																								<div class = "col-md-12">
																								<?php
																									if($data_status_kendaraan['no_peminjaman'] != '' and $jam_skrg >= $data_status_kendaraan['jam_test_drive'] and $jam_skrg <= $data_status_kendaraan['estimasi_jam_selesai']){
																										$checked = "checked";
																									}else{
																										$checked = "";
																									}
																								?>
																									<input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="tambahdata<?php echo $t;?>" id="tambahdata" value='Y' <?php echo $checked; ?>>
																								</div>
																							</div>
																						</td>
																						<td>
																							<div class="note-editor">
																								<textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
																							</div>
																						</td>
																						<td>
																							<div class="btn btn-primary btn-wide" onclick = "modal_pengecekan_mobil(<?php echo $data_status_kendaraan['no_mobil']; ?>);">
																								<i class="fa fa-save"></i> Lihat Pengecekan Terakhir
																							</div>
																						</td>
																					</tr>
																				<?php
																					$no++;
																					}
																				?>
																				</tbody>
																			</table>
																		</div>
																	</div>
																</div>
															</form>
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=window.location.href='media_showroom.php?module=logistik_puk'>
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
				
				
				
				
				
