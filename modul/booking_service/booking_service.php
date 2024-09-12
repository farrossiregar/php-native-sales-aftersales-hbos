<?php
		include "config/fungsi_thumb.php";
		
		session_start();
		
		include "modul/booking_service/fungsi.php";
		
		switch($_GET[act]){
		//tampilkan data
		default:
?>
			
				<!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script-->
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
				<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
				
				
				
				<?php
					$judul_header = mysql_query("select * from menu where module = '$_GET[module]'");
					$hasil_judul_header = mysql_fetch_array($judul_header);
				?>
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data <?php echo $hasil_judul_header['nama_menu']; ?></h1>
									<span class="mainDescription">Tambah <?php echo $hasil_judul_header['nama_menu']; ?> pada Database</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Genereal Repair</span>
									</li>
									<li class="active">
										<span><?php echo $hasil_judul_header['nama_menu']; ?></span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<br>
						
						<?php include "config/koneksi_service.php"; ?>
						
						<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onpageshow="focus">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header" style="background-color: white;">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='exit_modal();'>
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title" id="myModal2Label"></h4>
									</div>
									<div class="modal-body" style="background-color: white;" id = 'modal_booking'>
										<form role="form" id="form" enctype="multipart/form-data" method="post" action="" >
											<div class="row">
												<div class="col-md-12" >
												<?php echo(isset ($msg) ? $msg : ''); ?>
													<div class="errorHandler alert alert-danger no-display ">
														<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
													</div>
													<div class="successHandler alert alert-success no-display">
														<i class="fa fa-ok"></i> Your form validation is successful!
													</div>
												</div>
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label">
																	No Pengajuan
																</label>
																<input id="no_booking" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="no_booking" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Nama Customer
																</label>
																<input id="nama_cust" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="nama_cust" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Telepon
																</label>
																<input type="text"  class="form-control" id="telepon" name="telepon" value=""  onkeypress="return hanyaAngka(event)" required>
															</div>
														</div>
													</div>
													<div class = "row">
														<div class="form-group col-md-12">
															<fieldset onchange="pilih_hari();">
																	<legend>
																		Jenis Service
																	</legend><br>
																<div class = "col-md-3">
																	<div class="radio clip-radio radio-primary radio-inline" >
																		<input id="srv3" name="jenis_perbaikan" value="QS" type="radio" onchange = "service_type();" style="display: none;">
																		<label for="srv3">
																			QS
																		</label>
																	</div>
																</div>
																<div class = "col-md-3">
																	<div class="radio clip-radio radio-primary radio-inline" >
																		<input id="srv1" name="jenis_perbaikan" value="PM" type="radio" onchange = "service_type();" style="display: none;">
																		<label for="srv1">
																			PM
																		</label>
																	</div>
																</div>
																<div class = "col-md-3">
																	<div class="radio clip-radio radio-primary radio-inline" >
																		<input id="srv2" name="jenis_perbaikan" value="REPAIR" type="radio" onchange = "service_type();" style="display: none;">
																		<label for="srv2">
																			REPAIR
																		</label>
																	</div>
																</div>
																<div class = "col-md-3">
																	<div class="radio clip-radio radio-primary radio-inline" >
																		<input id="srv4" name="jenis_perbaikan" value="PUD" type="radio" onchange = "service_type();" style="display: none;">
																		<label for="srv4">
																			PUD (WARRANTY)
																		</label>
																	</div>
																</div>
															</fieldset>
														</div>	
														
														
														
														
													</div>
													<div class="form-group" id="perbaikan_pud_qs" >
														<label class="control-label">
															Pekerjaan
														</label>
														<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="perbaikan" name="perbaikan" value="">
													</div>
													<div class="form-group" id="perbaikan_pm" >
														<label class="control-label">
															Pekerjaan PM
														</label>
														<select name = "perbaikan" id="perbaikan1" class = "form-control" >														
															<option value="" selected disabled>PM</option>
															<option value="30.000 KM" >30.000 KM</option>
															<option value="50.000 KM" >50.000 KM</option>
															<option value="70.000 KM" >70.000 KM</option>
															<option value="90.000 KM" >90.000 KM</option>
															<option value="130.000 KM" >130.000 KM</option>
															<option value="150.000 KM" >150.000 KM</option>
															<option value="170.000 KM" >170.000 KM</option>
															<option value="190.000 KM" >190.000 KM</option>
														</select>
													</div>
													<div class="form-group" id="perbaikan_repair" >
														<label class="control-label">
															Pekerjaan Repair
														</label>
														<select name = "perbaikan" id="perbaikan2" class = "form-control" >														
															<option value="" selected disabled>REPAIR</option>															
															<option value="40.000 KM" >40.000 KM</option>
															<option value="60.000 KM" >60.000 KM</option>
															<option value="80.000 KM" >80.000 KM</option>
															<option value="100.000 KM" >100.000 KM</option>
															<option value="120.000 KM" >120.000 KM</option>
															<option value="140.000 KM" >140.000 KM</option>
															<option value="160.000 KM" >160.000 KM</option>
															<option value="180.000 KM" >180.000 KM</option>
															<option value="200.000 KM" >200.000 KM</option>
															<option value="LAIN-LAIN" >LAIN-LAIN</option>
														</select>
													</div>
													<div class="row" id = "waktu1">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Pilih Periode <span class="symbol required"></span>
																</label>
																
																
																<div class="input-group input-append datepicker date" data-date-format='yyyy-mm-dd D' style="padding : 0px;"> 
																	<input class="form-control" type="text" id="tgl_booking" name="tgl_booking" onchange="pilih_hari();" value ="<?php echo date('Y-m-d D'); ?>" readonly required >
																	<span class="input-group-btn">
																		<button type="button" class="btn btn-default">
																			<i class="glyphicon glyphicon-calendar"></i>
																		</button> </span>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group" >
																<label class="control-label">
																	Jam Booking <span class="symbol required"></span>
																</label>
																<!--select name = "jam" id="jam_booking" class = "form-control" onclick = "if (this.value == ''){pilih_hari()}" style=""-->
																<select name = "jam" id="jam_booking" class = "form-control" >														
																	
																</select>
															</div>
														</div>
													</div>
													<div class="row" id="waktu2">
														<div class="col-md-6" id='tgl2'>
															<div class="form-group">
																<label class="control-label">
																	Pilih Periode <span class="symbol required"></span>
																</label>
																<div class="input-group input-daterange " style="padding:0px" data-date-format='yyyy-mm-dd D'>
																	<input class="form-control" type="text" id="tgl_booking2" name="tgl_booking2" readonly >
																</div>
															</div>
														</div>
														<div class="col-md-6" id='jam2'>
															<div class="form-group" >
																<label class="control-label">
																	Jam Booking <span class="symbol required"></span>
																</label>
																<div>
																	<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="jam_booking2" name="jam" value="" readonly>
																</div>
															</div>
														</div>
													</div>
													<div class="row" id = 'radio_button'>
														<div class="form-group col-md-12">
															<fieldset>
																<legend>
																	Status Kedatangan
																</legend><br>
																<div class="row">
																	<div class = "col-md-6">
																		<div class="radio clip-radio radio-primary radio-inline" >
																			<input id="radio1" name="kedatangan" value="Y" type="radio" onchange = "status_kedatangan();">
																			<label for="radio1">
																				Datang
																			</label>
																		</div>
																	</div>
																	<div class = "col-md-6">
																		<div class="radio clip-radio radio-primary radio-inline" >
																			<input id="radio9" name="kedatangan" value="Sudah Service" type="radio" onchange = "status_kedatangan();">
																			<label for="radio9">
																				Sudah Service
																			</label>
																		</div>
																	</div>
																	
																</div>
																<div class="row">
																	<div class = "col-md-6">
																		<div class="radio clip-radio radio-primary radio-inline">
																			<input id="radio2" name="kedatangan" value="N" type="radio" onchange = "status_kedatangan();">
																			<label for="radio2">
																				Tidak Datang
																			</label>
																		</div>
																	</div>
																	
																</div>
																<div class = "col-md-12" id = 'tidak_datang1' style="display: none;">
																	<div class="form-group">
																		<label class="control-label">
																			Keterangan<span class="symbol required"></span>
																		</label>
																		<div class="form-group">
																			<div class="note-editor">
																				<textarea class="form-control" id="ket_tidak_datang" name="ket_tidak_datang" required></textarea>
																			</div>
																		</div>
																	</div>
																	<div class = "row">
																		<div class = "col-md-6" id = 'tidak_datang2' style="display: none;">
																			<div class="form-group" id = "reschedule_div">
																				<label class="control-label">
																					Reschedule
																				</label>
																				<br>
																				<input id = "reschedule" name = "reschedule" value="Y" type="checkbox" onclick = "status_reschedule();">
																			</div>
																		</div>
																	</div>
																	<br>
																	<div class="row" id = "waktu3" style="display: none;">
																		<div class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">
																					Pilih Periode <span class="symbol required"></span>
																				</label>
																				<div class="input-group input-daterange datepicker" style="padding:0px" data-date-format='yyyy-mm-dd D'>
																					<input class="form-control" type="text" id="tgl_booking3" name="tgl_booking3" onchange="pilih_hari2();"  readonly required >
																				</div>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="form-group" >
																				<label class="control-label">
																					Jam Booking <span class="symbol required"></span>
																				</label>
																					<select name = "jam" id="jam_booking3" class = "form-control" style="">														
																						<option value="semua_model" selected disabled>PILIH JAM</option>
																						
																					</select>
																			</div>
																			
																		</div>
																	</div>
																</div>
															</fieldset>
														</div>
													</div>
													
													
													
													<div class="row" id="konfirmasi" style="display:none;">
														<div class="form-group col-md-12">
															<fieldset>
																<legend>
																	Konfirmasi H-1
																</legend><br>
																
																<div class = "col-md-12" >
																	
																	<div class = "row">
																		<div class="checkbox clip-check check-primary checkbox-inline">
																			<input id="checkbox4" class="konfirmasi_telp" value="Y" name='konfirmasi_telp' type="checkbox">
																			<label for="checkbox4">
																				TELP
																			</label>
																		</div>
																		<div class="checkbox clip-check check-primary checkbox-inline">
																			<input id="checkbox5" class="konfirmasi_sms" value="Y" name="konfirmasi_sms" type="checkbox">
																			<label for="checkbox5">
																				SMS/WA/EMAIL
																			</label>
																		</div>
																	</div>
																	
																</div>
															</fieldset>
														</div>
													</div>
													
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	No Polisi<?php sizeof($time); ?>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="no_polisi" name="no_polisi" value="" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Tipe
																</label>
																<select name = "tipe" id="tipe" class = "form-control" >														
																	<option value="semua_model" selected disabled>Cari Model</option>
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
													</div>
													<div class="row" id = "no_rangka_mesin">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	No Rangka
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="norangka" name="norangka" value="" >
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	No Mesin
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="nomesin" name="nomesin" value="" >
															</div>
														</div>
													</div>
													<div class="row" id = "no_rangka_mesin">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Booking Via
																</label>
																<select name = "booking_via" id="booking_via" class = "form-control" onchange="if (this.value=='LAIN-LAIN'){$('#lain_lain').show();}else{$('#lain_lain').hide()}" >		
																	<?php 
																		$pilihan = array("SMS","WA","TELP","PROGRAM","WEBSITE","LAIN-LAIN");
																	?>
																	<option value="" selected disabled>BOOKING VIA</option>
																	<?PHP
																		for($i = 0; $i < sizeof($pilihan); $i++){
																			echo "<option value='$pilihan[$i]'>$pilihan[$i]</option>";
																		}
																	?>
																	
																</select>
															</div>
														</div>
														<div class="col-md-6" style="display: none;" id="lain_lain">
															<div class="form-group">
																<label class="control-label">
																	Keterangan
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="lain-lain" name="lain-lain" value="" >
															</div>
														</div>
													</div>
													
													<br>
													
													
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
													
													<div id = "id_double">
													
													</div>
													
													
													<div class="row">											
														<div class="col-md-12">
															<button class="btn btn-primary btn-wide" type="button" id="bn" name="bn" onClick="simpan();">
																<span class="ladda-label"><i class="fa fa-save"></i> Simpan</span>
															</button>
															
															<button type = "button" id="upd" name="upd" class="btn btn-primary btn-wide" data-style="expand-right"  onclick = 'update_booking();' style="display:none;">
																<span class="ladda-label"><i class="fa fa-mail-save"></i> Update </span>
															</button>
															
															<button type = "button" id="upd2" name="upd2" class="btn btn-primary btn-wide" data-style="expand-right" style="display:none;">
																<span class="ladda-label"><i class="fa fa-mail-save"></i> Reschedule</span>
															</button>
															
															<button type = "button" id="keluar" class="btn btn-wide btn-danger ladda-button" data-style="expand-right"  onclick='exit_modal();'>
																<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
															</button>
															<br>
															<br>
														</div>
													</div>
												</div>
											</div>
											</br>
											
										</form>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="container-fluid container-fullw bg-white">
							<section class="col-md-12" id="message">
							</section>
								<?php
										$level = $_SESSION['leveluser'];
										
										$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ",$koneksi_showroom);
										$cek_akses2 = mysql_fetch_array($cek_akses);
											if($cek_akses2['tambah_data'] == 'Y')
											{
									?>
								<div class="row">
									<div class="col-md-6">
										<div>
											<button class='btn btn-primary' id='bttn' data-toggle='modal' data-target='.modal' onclick='tambah_data();'>
											<!--button class='btn btn-primary' id='bttn' data-toggle='modal' data-target='.modal' onclick='edit_data();'-->
												<i class='fa fa-plus'></i> Tambah Data
											</button>
										</div>
										<br>
									</div>
									
								</div>
								
											<?php } ?>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<div class="form-group">
												<label class="control-label">
													Pilih Tanggal Booking<span class="symbol required"></span>
												</label>
												<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
													<input class="form-control" type="text" id="periode_booking" name="periode_booking" value = "<?php echo $_GET['periode_booking']?>" readonly>
												</div>
											</div>
										</div>
										<div class="form-group">
											<button id="tampil_data" class="btn btn-white btn-info btn-bold" onclick="cari_data_booking()">Tampilkan Data</button>
											<!--button type="submit" class="btn btn-white btn-info btn-bold">Tampilkan Data</button-->
										</div>
									</div>
								</div>
								
								<?php echo $_GET[periode_booking]; ?>
								<div id = 'header_table'  class = "table-responsive" style="display:none;">
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Cari" name="search" id="search" onkeyup="search();">
									</div>
									<br>
									<table class="table table-striped table-bordered table-hover table-full-width">
										<thead>
											<tr >
												<th>No</th>
												<th>Action</th>
												<th>Status Kedatangan</th>
												<th>Data Servis</th>
												<th>Data Customer</th>
												
												
												<th class="hidden-xs">Status Input</th>
											</tr>
										</thead>
										<div id="container">
											<div id="content">
												<div id="content-item-template" class="content-item">
													<span class="line-number">
													</span>
													<span class="data">
														<tbody id="table_booking">
											
														</tbody>
														
													</span>
												</div>
											</div>
										</div>
									
										
									</table>
									<?php
										$level = $_SESSION['leveluser'];
										
										$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ",$koneksi_showroom);
										$cek_akses2 = mysql_fetch_array($cek_akses);
											if($cek_akses2['ekspor'] == 'Y')
											{
									?>
									<div class="progress-demo">
										<!--a href='modul/booking_service/export_data_booking.php?periode_booking=<?php echo $_GET['periode_booking']; ?>' id="export"-->
										<a href='' id="export">
											<button class="btn btn-wide btn-primary ladda-button" data-style="expand-right" >
												<span class="ladda-label"> Export Data ke Excel</span>
											</button>
										</a>
									</div>
									<br>
									<?php
										}
									?>
								</div>
								
								
								<!--div>
									<br>
									<button type = "button" id="test" class="btn btn-primary btn-wide" data-style="expand-right"  onclick='tambah2();'>
										 LOAD MORE 
									</button>
								</div-->
								
							<br>
							<br>
						</div>
						
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>

<?php break;
} 
?>