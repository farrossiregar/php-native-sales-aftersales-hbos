<?php
		include "config/fungsi_thumb.php";
		switch($_GET[act]){
		//tampilkan data
		default:
?>
			
				<!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script-->
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
				<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
				<script type="text/javascript" src="assets/js/jquery.1.6.js"></script>	
				
				<script language="JavaScript">
					function warning() {
						return confirm('Anda yakin menghapus data ini?');
					}
					
					
					
					function tambah_data(){
						var simpan = "<button class='btn btn-primary btn-wide' type='button' id='bn' name='bn' onClick='simpan();'><span class='ladda-label'><i class='fa fa-save'></i> Simpan</span></button>";
						var keluar = "<button type = 'button' id='keluar' class='btn btn-wide btn-danger ladda-button' data-style='expand-right'  onclick='exit_modal();'><span class='ladda-label'><i class='fa fa-mail-reply'></i> Keluar </span></button>";
						$.ajax({
							method : "post",
							url : "modul/prospek/test_drive/action/test_drive_no_peminjaman.php",
							success : function(data){
								$("modal_test_drive").modal('show');
								$('#myModal2Label').html("Buat Permohonan Test Drive");
								$('#modal_test_drive').find(".simpan_test_drive").val("");
								$('#modal_test_drive').find(".div_simpan").show();	
								$('#table_test_drive').html("");
								$("#no_peminjaman").val(data);
								$('#modal_test_drive').find(".simpan_test_drive").prop("readonly", false);		
								$('#modal_test_drive').find(".simpan_test_drive").attr("disabled", false);
								$('#button_modal').html(simpan + keluar);
							}
						})
					}	
					
				
					function cari_data_test_drive(){
						var tanggal_awal = $('#periode_test_drive_awal').val();
						var tanggal_akhir = $('#periode_test_drive_akhir').val();
						if ($('#periode_test_drive_awal').val() != '' && $('#periode_test_drive_akhir').val() != ''){
							$.ajax({
								method : "post",
								url : "modul/prospek/test_drive/action/test_drive_tampil_data_test_drive.php",
								data : 'tanggal_awal='+tanggal_awal+'&tanggal_akhir='+tanggal_akhir,
								success : function(data){
									var str = data.toString();
									var trm = str.trim();
									var splt = trm.split(",");
									$('#table_booking').html(data);
									$('#header_table').show();
								//	$('#export').attr('href', 'modul/booking_service/export_data_booking.php?periode_booking='+tanggal);
								}
							})
						}
						var waktu = setTimeout("cari_data_test_drive()",5000);
					}
					
				
					
					function tipe_mobil(){
						var tanggal_test_drive = $('#tgl_test_drive').val();
						var jam_awal = $('#jam_test_drive_awal').val();
						var jam_akhir = $('#jam_test_drive_akhir').val();
						$.ajax({
							method : "post",
							url : "modul/prospek/test_drive/action/test_drive_cek_stok_mobil.php",
						//	data : 'jam_awal='+jam_awal+'&jam_akhir='+jam_akhir+'&tanggal='+tanggal_test_drive,
							data : 'tanggal='+tanggal_test_drive,
							success : function(data){
							//	$('#tipe').html(data);
								console.log(data);
							}
						})
					}
					
					
					
				/*	function search() {
						var input, filter, table, tr, td, i, x;
						input = document.getElementById("search");
						filter = input.value.toUpperCase();
						table = document.getElementById("table_booking");
						tr = table.getElementsByTagName("tr");
						td = table.getElementsByTagName("td");
						for (i = 0; i < tr.length; i++) {
							for (j = 0; j < td.length; j++) {
								x = tr[i];
								y = x[j];
								if (x) {
									if (x.innerHTML.toUpperCase().indexOf(filter) > -1) {
										tr[i].style.display = "";
									} else {
										tr[i].style.display = "none";
									}
								}   
							}								
						}
					}
				
					var add = (function () {
						var counter = 1;
						var x = 15;
						return function () {
							counter += 1;
							return y = counter * x;
						}
					})();	*/

					
					
					// ==============	EDIT ============================ //
			
					function hasil_test_drive($id, $hasil){
						var no_peminjaman = $id;
						var hasil = $hasil;
						
						$.ajax({
							method : "post",
							url : "modul/prospek/test_drive/action/test_drive_hasil_test_drive.php",
							data : "data=" + no_peminjaman + '&hasil='+hasil,
							
							success : function(data){
								var tostring = data.toString();
								var trim = tostring.trim();
								var split = trim.split(",");
								$('#edit_testdrive').html(data);
								$('#tambah_data_testdrive').hide();
								$('#table_test_drive').html(data);
								
								$.ajax({
									method : "post",
									url : "modul/prospek/test_drive/action/test_drive_isi_data_edit.php",
									data : "no_peminjaman="+no_peminjaman,
									success : function(data){
										var hasil = JSON.parse(data);
										$('#no_peminjaman_edit').val(hasil['no_peminjaman']);
										$('#nama_cust_edit').html(hasil['no_peminjaman']);
										console.log(data);
										var alamat = $('#alamat_edit').val();
										var no_ktp = $('#no_ktp_edit').val();
										var telepon = $('#telepon_edit').val();
										var keterangan2 = $('#keterangan_edit').val();
									}
								})
							
							//	$('#modal_test_drive').find(".div_simpan").hide();		
							//	$('#modal_test_drive').find(".simpan_test_drive").prop("readonly", true);		
							//	$('#modal_test_drive').find(".simpan_test_drive").attr("disabled", true);
							//	$('#button_modal').html("");
							}
						})
					}
					
						//	===============	UPDATE	============================
					function update_test_drive($action){
						var action = $action;
						var no_peminjaman = $('#no_peminjaman_edit').val();
						var nama = $('#nama_cust_edit').val();
						var alamat = $('#alamat_edit').val();
						var no_ktp = $('#no_ktp_edit').val();
						var telepon = $('#telepon_edit').val();
						var keterangan2 = $('#keterangan_edit').val();
						var keterangan = keterangan2.replace(/,/g, ".");
						var tipe = $('#tipe_edit').val();
						var tanggal_test_drive = $('#tgl_test_drive_edit').val();
						var jam_test_drive_awal = $('#waktu_test_drive_awal_edit').val() + $('#menit_test_drive_awal').val() + "00";
						var jam_test_drive_akhir = $('#waktu_test_drive_akhir_edit').val() + $('#menit_test_drive_akhir').val() + "00";
						var jenis_customer = $('#jenis_customer_edit').val();
						var lokasi_test_drive = $('#lokasi_test_drive_edit').val();
						var peserta_test_drive = $('#peserta_test_drive_edit').val();
						
					/*	if($("#spk1").is(":checked")){
							var rencana_spk = 'Y';
						}else if($("#spk2").is(":checked")){
							var rencana_spk = 'N';
						}else{
							var rencana_spk = '';
						}	*/
						
						var rencana_spk = 'Y';
						var keterangan_spk = $('#keterangan_spk_edit').val();
						
						var user_input = "<?php echo $_SESSION['username']?>";

						$.ajax({
							method : "post",
							url : "modul/prospek/test_drive/action/test_drive_update_data.php",
							data : 	'no_peminjaman='+no_peminjaman+
									'&nama='+nama+
									'&alamat='+alamat+
									'&no_ktp='+no_ktp+
									'&telepon='+telepon+
									'&keterangan='+keterangan+
									'&tipe='+tipe+
									'&tanggal_test_drive='+tanggal_test_drive+
									'&jam_test_drive_awal='+jam_test_drive_awal+
									'&jam_test_drive_akhir='+jam_test_drive_akhir+
									'&jenis_customer='+jenis_customer+
									'&lokasi_test_drive='+lokasi_test_drive+
									'&peserta_test_drive='+peserta_test_drive+
									'&rencana_spk='+rencana_spk+
									'&keterangan_spk='+keterangan_spk+
									'&action='+action,
									
							success : function(data){
									$('#modal_test_drive').modal('hide');
									$('#message').html(data);
									cari_data_test_drive();
								//	var waktu = setTimeout(function(){$('#message').fadeOut("slow");},5000);
									var waktu = setTimeout(function(){$('#message').html("");},5000);
									$('#edit_testdrive').html("");
									$('#tambah_data_testdrive').show();
									$('#table_test_drive').html("");
							}
						})
					}
				
					function status_kendaraan(){
						$('#status_ketersediaan').show();
					}
					
					//	===============	SIMPAN	============================//
					function simpan(){
						var no_peminjaman = $('#no_peminjaman').val();
						var nama = $('#nama_cust').val();
						var alamat = $('#alamat').val();
						var no_ktp = $('#no_ktp').val();
						var telepon = $('#telepon').val();
						var keterangan2 = $('#keterangan').val();
						var keterangan = keterangan2.replace(/,/g, ".");
						var tipe = $('#tipe').val();
						var tanggal_test_drive = $('#tgl_test_drive').val();
						var jam_test_drive_awal = $('#waktu_test_drive_awal').val() + $('#menit_test_drive_awal').val() + "00";
						var jam_test_drive_akhir = $('#waktu_test_drive_akhir').val() + $('#menit_test_drive_akhir').val() + "00";
						var jenis_customer = $('#jenis_customer').val();
						var lokasi_test_drive = $('#lokasi_test_drive').val();
						var peserta_test_drive = $('#peserta_test_drive').val();
						var user_input = "<?php echo $_SESSION['username']?>";
						if($('#nama_cust').val("")){
							$.ajax({
								method : "post",
								url : "modul/prospek/test_drive/action/test_drive_insert_data.php",
								data: 	'no_peminjaman='+no_peminjaman+
										'&nama='+nama+
										'&alamat='+alamat+
										'&no_ktp='+no_ktp+
										'&telepon='+telepon+
										'&keterangan='+keterangan+
										'&tipe='+tipe+
										'&tanggal_test_drive='+tanggal_test_drive+
										'&jam_test_drive_awal='+jam_test_drive_awal+
										'&jam_test_drive_akhir='+jam_test_drive_akhir+
										'&jenis_customer='+ jenis_customer +
										'&lokasi_test_drive='+ lokasi_test_drive +
										'&peserta_test_drive='+ peserta_test_drive +
										'&user_input='+user_input,
								success : function(data){
								//	$('#modal_test_drive').find(".simpan_test_drive").val("");
									$('#modal_test_drive').modal('hide');
									$('#message').html(data);
									var waktu = setTimeout(function(){$('#message').fadeOut("slow");},5000);
									cari_data_test_drive();
								}
							})
						}
					} 
					
					
					//	===============	KELUAR	============================//
					function exit_modal(){
						$('#modal_test_drive').find(".simpan_test_drive").val("");
						$('#modal_test_drive').modal('hide');
					}
					
					function batal_edit(){
					//	$('#edit_testdrive').fadeOut("slow");	
						$('#edit_testdrive').html("");	
						$('#tambah_data_testdrive').show();
					}
					
					
					function ubahStatusKendaraan($nama_model){
						if($nama_model == '1'){
							var kode_model = 'ACCORD';
						}else if($nama_model == '2'){
							var kode_model = 'CITY';
						}else if($nama_model == '3'){
							var kode_model = 'CIVIC';
						}else if($nama_model == '4'){
							var kode_model = 'CR-V';
						}else if($nama_model == '5'){
							var kode_model = 'JAZZ';
						}else if($nama_model == '6'){
							var kode_model = 'ODYSSEY';
						}else if($nama_model == '9'){
							var kode_model = 'BRIO';
						}else if($nama_model == '13'){
							var kode_model = 'MOBILIO';
						}else if($nama_model == '14'){
							var kode_model = 'HR-V';
						}else{
							var kode_model = 'BR-V';
						}
						
						var value = $('#status_'+kode_model).val();
						if(value === "Y"){
							value = "N";
						}else{
							value = "Y";
						}
						
						$.ajax({
							method : "post",
							url : "modul/prospek/test_drive/action/test_drive_ubah_data_status.php",
							data: 	'value='+value+
									'&model='+kode_model,
							success : function(data){
								console.log(value);
							}
						})
					}
					
					
				
				</script>
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
										<span>Prospek</span>
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
						
						
						<div class="modal fade" id="modal_test_drive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onpageshow="focus">
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
											<div class="col-md-12 form-group">
												<div class="col-md-12" >
												<?php echo(isset ($msg) ? $msg : ''); ?>
													<div class="errorHandler alert alert-danger no-display ">
														<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
													</div>
													<div class="successHandler alert alert-success no-display">
														<i class="fa fa-ok"></i> Your form validation is successful!
													</div>
												</div>
												<div class="form-group" id = 'data_test_drive'>
													<div class="row">
														<fieldset>
															<legend>Data Customer</legend>
															<div class="div_simpan">
																<div class="form-group">
																	<label class="control-label">
																		No Peminjaman
																	</label>
																	<input id="no_peminjaman" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="input_test_drive" required readonly>
																</div>
															</div>
															<div class=" div_simpan">
																<div class="form-group">
																	<label class="control-label">
																		Nama Customer
																	</label>
																	<input id="nama_cust" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control simpan_test_drive" type="text" value="" name="input_test_drive" required>
																</div>
															</div>
															<div class="div_simpan">
																<div class="form-group">
																	<label class="control-label">
																		Alamat <span class="symbol required"></span>
																	</label>
																	<div class="note-editor">
																		<textarea class="form-control simpan_test_drive" id="alamat" name="input_test_drive" required></textarea>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6 div_simpan">
																	<div class="form-group">
																		<label class="control-label">
																			No KTP
																		</label>
																		<input type="text"  class="form-control simpan_test_drive" id="no_ktp" name="input_test_drive" value="" required>
																	</div>
																</div>
																<div class="col-md-6 div_simpan">
																	<div class="form-group">
																		<label class="control-label">
																			No Telp
																		</label>
																		<input type="text" class="form-control simpan_test_drive" id="telepon" name="input_test_drive" value="" required>
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
																			<textarea class="form-control simpan_test_drive" id="keterangan" name="keterangan" required></textarea>
																		</div>
																	</div>
																</div>
															</div>
														</fieldset>
															
														<fieldset>
															<legend>Data Test Drive</legend>
															<div class="div_simpan">
																<div class="form-group">
																	<label class="control-label">
																		Tanggal Test Drive <span class="symbol required"></span>
																	</label>
																	<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
																		<input class="form-control simpan_test_drive" type="text" id="tgl_test_drive" name="tgl_test_drive" value ="<?php echo date('Y-m-d'); ?>" readonly required >
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
																						for($i=8; $i<=17; $i++ ){
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
																						for($i=8; $i<=17; $i++ ){
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
																	<select name = "tipe" id="tipe" class = "form-control simpan_test_drive" onclick = 'tipe_mobil();' >														
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
													</div>
												</div>
												<div id = "table_test_drive">
												</div>
											</div>
											</br>
											<div class="row">											
												<div class="col-md-12" id = "button_modal">
												
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="container-fluid container-fullw bg-white">
							<section class="col-md-12" id="message">
							</section>
							<div class="col-md-12">
								<div class="form-group" id = 'tambah_data_testdrive'>
									<fieldset>
										<legend>Tambah Data</legend>
										<div>
											<button class='btn btn-primary' id='bn' data-toggle='modal' data-target='.modal' onclick='tambah_data();'>
												<i class='fa fa-plus'></i> Buat Permohonan Test Drive
											</button>
											<button class='btn btn-o btn-success' id='status_mobil' onclick='status_kendaraan();' >
												Status Ketersediaan Mobil
											</button>
										</div>
									</fieldset>
								</div>
								
								<div class="form-group" id = "edit_testdrive">

								</div>
								<div class="form-group" id = "status_ketersediaan" style = "display:none;">
									<fieldset>
										<legend>Status Ketersediaan Kendaraan</legend>
										<div class="form-group">
											<table class="table table-striped table-bordered table-hover table-full-width" >
												<thead>
													<tr>
														<th>Nama Model</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
												<?php
													$no = 1;	
													$status_mobil=mysql_query("select * from status_ketersediaan_mobil");
													$t = 0;
													while($data_status_mobil=mysql_fetch_array($status_mobil)){
													$t=$t+1;

														if($data_status_mobil['nama_model'] == 'ACCORD'){
															$kode_model = '1';
														}elseif($data_status_mobil['nama_model'] == 'CITY'){
															$kode_model = '2';
														}elseif($data_status_mobil['nama_model'] == 'CIVIC'){
															$kode_model = '3';
														}elseif($data_status_mobil['nama_model'] == 'CR-V'){
															$kode_model = '4';
														}elseif($data_status_mobil['nama_model'] == 'JAZZ'){
															$kode_model = '5';
														}elseif($data_status_mobil['nama_model'] == 'ODYSSEY'){
															$kode_model = '6';
														}elseif($data_status_mobil['nama_model'] == 'BRIO'){
															$kode_model = '9';
														}elseif($data_status_mobil['nama_model'] == 'MOBILIO'){
															$kode_model = '13';
														}elseif($data_status_mobil['nama_model'] == 'HR-V'){
															$kode_model = '14';
														}else{
															$kode_model = '15';
														}
												?>
													<tr>
														<td><input type="text" name="namamodel<?php echo $t;?>" id="namamodel" value="<?php echo $data_status_mobil['nama_model']; ?>" readonly ></td>
														<td><input data-toggle="toggle" data-onstyle="primary" data-size="mini" type="checkbox" name="<?php echo "status_".$data_status_mobil['nama_model'] ;?>" id="<?php echo "status_".$data_status_mobil['nama_model'] ;?>" value='<?php echo $data_status_mobil['ketersediaan_unit'] ?>' <?php if($data_status_mobil['ketersediaan_unit'] == 'Y'){ echo "checked"; } ?> onchange = "ubahStatusKendaraan(<?php echo $kode_model ?>);" > </td>
													</tr>
												<?php
													$no++;
													}
												?>
												</tbody>
											</table>
										</div>
										<div>
											<button class='btn btn-danger' >
												Batal
											</button>
										</div>
									</fieldset>
								</div>
							</div>
							
								
							<div class="col-md-12">	
								<fieldset>
									<legend>Data Test Drive</legend>
									<div class="form-group">
										<label class="control-label">
											Pilih Tanggal Test Drive<span class="symbol required"></span>
										</label>
										<div class="row">
											<div class="col-md-6">
												<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
													<input class="form-control" type="text" id="periode_test_drive_awal" name="periode_test_drive_awal" value ="<?php echo $_GET[periode_test_drive_awal]; ?>" readonly>
														<span class="input-group-addon bg-primary">s/d</span>
													<input class="form-control" type="text" id="periode_test_drive_akhir" name="periode_test_drive_akhir" value ="<?php echo $_GET[periode_test_drive_akhir]; ?>" readonly>
												</div>
												<br>
												<div class="form-group">
													<button id="tampil_data" onclick="cari_data_test_drive()" class="btn btn-white btn-info btn-bold" >Tampilkan Data</button>
												</div>
											</div>
										</div>
									</div>
									
									<br>
									<div id = 'header_table'  class = "table-responsive" style="display:none;">
										<table class="table table-striped table-hover table-full-width">
											<thead>
												<tr>
													<th>Action</th>
													<th>Data Test Drive</th>
													<th>Data Customer</th>
													<th>Hasil Test Drive</th>
												</tr>
											</thead>
											<div id="container">
												<div id="content">
													<div id="content-item-template" class="content-item">
														<span class="line-number">	
														</span>
														<span class="data">
															<tbody  class = "table-striped" id="table_booking">
												
															</tbody>
														</span>
													</div>
												</div>
											</div>
										</table>
										
										<?php
											$level = $_SESSION['leveluser'];
											
											$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ");
											$cek_akses2 = mysql_fetch_array($cek_akses);
												if($cek_akses2['ekspor'] == 'Y')
												{
										?>
										<div class="progress-demo">
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
								</fieldset>
							</div>	
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>

<?php break;
} 
?>



<script>

//	======================================	UNTUK MENGAMBIL NILAI DARI SEMUA FIELD DI DALAM DIV ATAU MODAL	======================================	//
/*		//var get_value = $('#modal_test_drive').find(".simpan_test_drive").val();
		//var get_value = $('#modal_test_drive').children(".simpan_test_drive").val();
	
	var get_value = $('input[name="input_test_drive"]').serialize();
	var replace = get_value.replace(/input_test_drive=/g, "");
	var replace2 = replace.replace(/&/g, "_");
	var data_split = replace2.split("_");
	console.log(data_split);	*/

</script>