
				<script>
					function tipe_mobil(){
						var tanggal = $('#tgl_test_drive').val();
						if(tanggal != ''){
							$.ajax({
								method : "post",
								url : "modul/prospek/action/test_drive_cek_stok_mobil.php",
								data : "tanggal=" +tanggal,
								success : function(data){
									console.log(data);
									$('#tipe').html(data);
								}
							})
						}
					}
					
				</script>
				
				

				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">BUAT Permohonan Test Drive</h1>
									<!--span class="mainDescription">Tambah Permohonan Test Drive Baru pada Database</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Tambah Permohonan Test Drive Baru</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						
						
						
						<div class="container-fluid container-fullw bg-white">
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
											<?php
												include "../../../../config/koneksi.php";
												date_default_timezone_set('Asia/Jakarta');
													$today=date("ym");
													$query = "SELECT max(no_peminjaman) as last FROM test_drive_peminjaman_kendaraan WHERE no_peminjaman LIKE 'TD$today%'";
													$hasil = mysql_query($query);
													$data  = mysql_fetch_array($hasil);
													$lastNoTransaksi = $data['last'];
													$lastNoUrut = substr($lastNoTransaksi, 6, 3);
													$nextNoUrut = $lastNoUrut + 1;
													$nextNoTransaksi = "TD".$today.sprintf('%03s', $nextNoUrut);				

                                            ?>
											
												<div class="form-group">
													<div class="row">
														<div class="col-md-12">
															<div class="panel panel-white collapses" id="panel5">
																<a data-original-title="Buka" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
																</a>
																<div class="panel-heading">
																	<a data-original-title="Buka" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
																		<h4 class="panel-title text-primary">PERATURAN TEST DRIVE</h4>
																	</a>
																	<ul class="panel-heading-tabs border-light">
																		<a data-original-title="Buka" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">	
																		</a>
																		<li class="panel-tools">
																			<a data-original-title="Buka" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
																			</a>
																			<a data-original-title="Collapse" data-toggle="tooltip" data-placement="top" class="btn btn-transparent btn-sm panel-collapse" href="#">
																				<i class="ti-minus collapse-off"></i>
																				<i class="ti-plus collapse-on"></i>
																			</a>
																		</li>
																	</ul>
																</div>
																<div class="panel-body" style="display: none;">	
																	<div class="row">
																		<div class = "col-md-6">
																			<center><h4>PERATURAN MEMINJAM MOBIL TEST DRIVE</h4></center>
																			<center>
																				<ol>
																					<li>DILARANG KERAS MEROKOK DI DALAM MOBIL, APALAGI MINUM-MINUMAN KERAS, DLL</li>
																					<li>TIDAK DIGUNAKAN UNTUK KEPERLUAN PRIBADI ATAU KEGIATAN LAINNYA DILUAR TEST DRIVE DENGAN CUSTOMER/ACARA DEALER YANG MELIBATKAN TEST DRIVE</li>
																					<li>KONDISI MOBIL BENSIN SUDAH TERISI PADA SAAT MASUK KE DEALER</li>
																					<li>PENGGUNAAN MOBIL TEST DRIVE HARUS SEPENGETAHUAN HRD</li>
																					<li>UNIT TEST DRIVE SETELAH DIPAKAI HARUS DISERAHKAN DALAM KEADAAN BERSIH DAN TIDAK BERBAU KEPADA HRD</li>
																					<li>UNIT TEST DRIVE SETELAH DIPAKAI DALAM KONDISI BAIK / TIDAK CACAT / TERJADI KECELAKAAN</li>
																				</ol>
																			</center>
																		</div>
																		<div class = "col-md-6">
																			<center><h4>SANKSI</h4></center>
																			<center>
																				<ol>
																					<li>PERATURAN NO. 1, 3 & 5 AKAN MENDAPAT SANKSI : DIKENAKAN DENDA UNTUK BIAYA SALON MOBIL & TIDAK BOLEH MEMBAWA MOBIL TEST DRIVE SELAMA 2 BULAN BAIK SENDIRI MAUPUN DENGAN SALES LAIN</li>
																					<li>PERATURAN NO. 2 AKAN MENDAPAT SANKSI : DENDA & MENGUNDURKAN DIRI</li>
																					<li>PERATURAN NO. 4 AKAN MENDAPAT SANKSI : SURAT PERINGATAN (SP)</li>
																					<li>PERATURAN NO. 6 APABILA TIDAK DAPAT MEMPERTANGGUNG JAWABKAN, AKAN MENDAPAT SANKSI : MEMPERBAIKI KENDARAAN DAN BIAYA DITANGGUNG OLEH PEMINJAM KENDARAAN</li>
																				</ol>
																			</center>
																		</div>
																	</div>
																	
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<fieldset>
																<legend>Data Customer</legend>
																<div class="div_simpan">
																	<div class="form-group">
																		<label class="control-label">
																			No Peminjaman
																		</label>
																		<input id="no_peminjaman" name="no_peminjaman" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="<?php echo $nextNoTransaksi ?>" required readonly>
																	</div>
																</div>
																<div class="div_simpan">
																	<div class="form-group">
																		<label class="control-label">
																			Pemohon
																		</label>
																		<input id="nama_sales" name="nama_sales" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="<?php echo $_SESSION['kode_sales'] ?>" required readonly>
																	</div>
																</div>
																<div class=" div_simpan">
																	<div class="form-group">
																		<label class="control-label">
																			Nama Customer
																		</label>
																		<input id="nama_cust" name="nama_cust" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" required>
																	</div>
																</div>
																<div class="div_simpan">
																	<div class="form-group">
																		<label class="control-label">
																			Alamat <span class="symbol required"></span>
																		</label>
																		<div class="note-editor">
																			<textarea class="form-control" id="alamat" name="alamat" required></textarea>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-6 div_simpan">
																		<div class="form-group">
																			<label class="control-label">
																				No KTP
																			</label>
																			<input type="text"  class="form-control " id="no_ktp" name="no_ktp" value="" required>
																		</div>
																	</div>
																	<div class="col-md-6 div_simpan">
																		<div class="form-group">
																			<label class="control-label">
																				No Telp
																			</label>
																			<input type="text" class="form-control" id="telepon" name="telepon" value="" required>
																		</div>
																	</div>
																</div>
																<div class=" div_simpan">
																	<div class="form-group">
																		<label class="control-label">
																			Jenis Customer
																		</label>
																		<select name = "jenis_customer" id="jenis_customer" class = "form-control simpan_test_drive" >														
																			<option value="" selected disabled> KATEGORI CUSTOMER </option>
																			<option value="PEMBELIAN PERTAMA">PEMBELIAN PERTAMA</option>
																			<option value="REPEAT ORDER">REPEAT ORDER</option>
																			<option value="TRADE IN">TRADE IN</option>
																		</select>
																	</div>
																</div>
																<div class="div_simpan">
																	<div class="form-group">
																		<label class="control-label">
																			Keterangan <span class="symbol required"></span>
																		</label>
																		<div class="form-group">
																			<div class="note-editor">
																				<textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
																			</div>
																		</div>
																	</div>
																</div>
															</fieldset>
														</div>
														<div class="col-md-6">
															<fieldset>
																<legend>Data Test Drive</legend>
																<div class="div_simpan">
																	<div class="form-group">
																		<label class="control-label">
																			Tanggal Test Drive <span class="symbol required"></span>
																		</label>
																		<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
																			<input class="form-control" type="text" id="tgl_test_drive" name="tgl_test_drive" onchange = 'tipe_mobil();'  readonly required >
																		</div>
																	</div>
																</div>
																<div class="div_simpan">
																	<div class="form-group" >
																		<label class="control-label">
																			Jam Test Drive <span class="symbol required"></span>
																		</label>
																		<div class="row">
																			<div class="col-md-6">
																				<select name = "waktu_test_drive_awal" id="waktu_test_drive_awal" class = "form-control simpan_test_drive" style="">														
																					<option value="" selected disabled>PILIH JAM</option>
																						<?php 
																							for($i=9; $i<=16; $i++ ){
																								echo "<option value=".($i<10 ? "0$i" : "$i") .">".($i<10 ? "0$i" : "$i")."</option>";
																						
																							}
																						?>
																				</select>
																			</div>
																				
																			<div class="col-md-6">
																				<select name = "menit_test_drive_awal" id="menit_test_drive_awal" class = "form-control simpan_test_drive" style="">														
																					<option value="" selected disabled>PILIH MENIT</option>
																						<?php 
																							for($i=0; $i<60; $i=$i+15 ){
																								echo "<option value=".($i<10 ? "0$i" : "$i") .">".($i<10 ? "0$i" : "$i")."</option>";
																								
																							}
																						?>
																				</select>
																			</div>
																			
																		</div>
																	</div>
																</div>
																<div class="div_simpan">
																	<div class="form-group" >
																		<label class="control-label">
																			Estimasi Jam Selesai<span class="symbol required"></span>
																		</label>
																		<div class="row">
																			<div class="col-md-6">
																				<select name = "waktu_test_drive_akhir" id="waktu_test_drive_akhir" class = "form-control simpan_test_drive" style="">														
																					<option value="" selected disabled>PILIH JAM</option>
																						<?php 
																							for($i=9; $i<=16; $i++ ){
																								echo "<option value=".($i<10 ? "0$i" : "$i") .">".($i<10 ? "0$i" : "$i")."</option>";
																						
																							}
																						?>
																				</select>
																			</div>
																			<div class="col-md-6">
																				<select name = "menit_test_drive_akhir" id="menit_test_drive_akhir" class = "form-control simpan_test_drive" style="">														
																					<option value="" selected disabled>PILIH MENIT</option>
																						<?php 
																							for($i=0; $i<60; $i=$i+15 ){
																								echo "<option value=".($i<10 ? "0$i" : "$i") .">".($i<10 ? "0$i" : "$i")."</option>";
																								
																							}
																						?>
																				</select>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="div_simpan">
																	<div class="form-group">
																		<label class="control-label">
																			Tipe Mobil
																		</label>
																		<select name = "tipe" id="tipe" class = "form-control"  >														
																			<option value="" selected disabled>CARI MODEL</option>
																		</select>
																	</div>
																</div>
																<div class="div_simpan">
																	<div class="form-group">
																		<label class="control-label">
																			Lokasi Test Drive
																		</label>
																		<input type="text"  class="form-control simpan_test_drive" id="lokasi_test_drive" name="lokasi_test_drive" value="" required>
																	</div>
																</div>
																<div class="div_simpan">
																	<div class="form-group">
																		<label class="control-label">
																			Peserta Test Drive
																		</label>
																		<input type="text"  class="form-control simpan_test_drive" id="peserta_test_drive" name="peserta_test_drive" value="" required>
																	</div>
																</div>
															</fieldset>	
															<div class="row">
																<div class="col-md-12">
																	<div class="panel panel-white collapses" id="panel5">
																		<a data-original-title="Buka" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
																		</a>
																		<div class="panel-heading">
																			<a data-original-title="Buka" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
																				<h4 class="panel-title text-primary">KONDISI KENDARAAN</h4>
																			</a>
																			<ul class="panel-heading-tabs border-light">
																				<a data-original-title="Buka" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">	
																				</a>
																				<li class="panel-tools">
																					<a data-original-title="Buka" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
																					</a>
																					<a data-original-title="Collapse" data-toggle="tooltip" data-placement="top" class="btn btn-transparent btn-sm panel-collapse" href="#">
																						<i class="ti-minus collapse-off"></i>
																						<i class="ti-plus collapse-on"></i>
																					</a>
																				</li>
																			</ul>
																		</div>
																	
																		<div class="panel-body" style="display: none;">	
																			<div class="row">
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
																										
																										$pemeriksaan_mobil = $pdo->query("select * from test_drive_inspeksi where nama_model = 'BRIO'");
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
																	</div>
																</div>
															</div>
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
