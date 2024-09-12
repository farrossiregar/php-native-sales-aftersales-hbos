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
						
						
						
						
						<div class="container-fluid container-fullw bg-white">
							<section class="col-md-12" id="message">
								<fieldset>
									<legend>Edit Data</legend>
									<div class="form-group">	
										<div class="div_simpan">
											<div class="form-group">
												<label class="control-label">
													No Peminjaman
												</label>
												<input id="no_peminjaman_edit" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control simpan_test_drive" type="text"  name="input_test_drive" required readonly>
											</div>
										</div>
										<div class=" div_simpan">
											<div class="form-group">
												<label class="control-label">
													Nama Customer
												</label>
												<input id="nama_cust_edit" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control simpan_test_drive" type="text"  name="input_test_drive" required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>>
											</div>
										</div>
										<div class="div_simpan">
											<div class="form-group">
												<label class="control-label">
													Alamat <span class="symbol required"></span>
												</label>
												<div class="note-editor">
													<textarea class="form-control simpan_test_drive" id="alamat_edit" name="input_test_drive" required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 div_simpan">
												<div class="form-group">
													<label class="control-label">
														No KTP
													</label>
													<input type="text"  class="form-control simpan_test_drive" id="no_ktp_edit" name="input_test_drive"  required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>>
												</div>
											</div>
											<div class="col-md-6 div_simpan">
												<div class="form-group">
													<label class="control-label">
														No Telp
													</label>
													<input type="text"  class="form-control simpan_test_drive" id="telepon_edit" name="input_test_drive"  required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>>
												</div>
											</div>
										</div>
										<div class=" div_simpan">
											<div class="form-group">
												<label class="control-label">
													Jenis Customer
												</label>
												<input type="text"  class="form-control simpan_test_drive" name = "jenis_customer_edit" id="jenis_customer"  required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>>
												<!--select  class = "form-control simpan_test_drive" >														
													<option value="" selected disabled> -- JENIS CUSTOMER -- </option>
													<option value="PEMBELIAN PERTAMA">PEMBELIAN PERTAMA</option>
													<option value="REPEAT ORDER">REPEAT ORDER</option>
													<option value="TRADE IN">TRADE IN</option>
												</select-->
											</div>
										</div>
										<div class="div_simpan">
											<div class="form-group">
												<label class="control-label">
													Keterangan <span class="symbol required"></span>
												</label>
												<div class="form-group">
													<div class="note-editor">
														<textarea class="form-control simpan_test_drive" id="keterangan_edit" name="keterangan"  required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>></textarea>
													</div>
												</div>
											</div>
										</div>
										
										<div class="div_simpan">
											<div class="form-group">
												<label class="control-label">
													Tanggal Test Drive <span class="symbol required"></span>
												</label>
												<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
													<input class="form-control simpan_test_drive" type="text" id="tgl_test_drive_edit" name="tgl_test_drive"  <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?> required >
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 div_simpan">
												<div class="form-group" >
													<label class="control-label">
														Jam Test Drive <span class="symbol required"></span>
													</label>
													<div>
														<input class="form-control simpan_test_drive" type="text" id="waktu_test_drive_awal_edit" name="waktu_test_drive_awal_edit" <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?> required >
														<!--select name = "waktu_test_drive_awal" id="waktu_test_drive_awal" class = "form-control simpan_test_drive" style=""></select-->
													</div>
												</div>
											</div>
											<div class="col-md-6 div_simpan">
												<div class="form-group" >
													<label class="control-label">
														Estimasi Jam Selesai<span class="symbol required"></span>
													</label>
													<div>
														<input class="form-control simpan_test_drive" type="text" id="waktu_test_drive_akhir_edit" name="waktu_test_drive_akhir_edit"  <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?> required >
													</div>
												</div>
											</div>
										</div>
										<div class="div_simpan">
											<div class="form-group">
												<label class="control-label">
													Tipe Mobil
												</label>
												<input class="form-control simpan_test_drive" type="text" name = "tipe" id="tipe" class = "form-control simpan_test_drive"  <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?> required >
												<!--select name = "tipe" id="tipe" class = "form-control simpan_test_drive" >														
													<option value="" selected disabled>CARI MODEL</option>
													<?php
													/*	$data = mysql_query("select nama_model from model");
														while ($r=mysql_fetch_array($data))
														{
															if ($r[nama_model] == $_GET[model]){
																$selek = "selected";
															}else {
																$selek = "";
															}
															echo "<option value='$r[nama_model]' $selek > $r[nama_model] </option>";															
														}*/
													?>
												</select-->
											</div>
										</div>
										<div class="div_simpan">
											<div class="form-group">
												<label class="control-label">
													Lokasi Test Drive
												</label>
												<input type="text"  class="form-control simpan_test_drive" id="lokasi_test_drive" name="lokasi_test_drive" required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>>
											</div>
										</div>
										<div class="div_simpan">
											<div class="form-group">
												<label class="control-label">
													Peserta Test Drive
												</label>
												<input type="text"  class="form-control simpan_test_drive" id="peserta_test_drive" name="peserta_test_drive"  required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?> >
											</div>
										</div>
										

										<?php
											if($hasil == 'Hasil Test'){
												echo $hasil_test_drive;
												$action = "1";
											}else{
												echo "";
												$action = "2";
											}
										?>
										<div class = "col-md-12" id = "rencana_spk_test">
										</div>
										<div class="col-md-12">
											<button type = "button" id="ubah_data" name="ubah_data" class="btn btn-primary btn-wide" data-style="expand-right" onclick = "update_test_drive(<?php echo $action ?>)">
												<span class="ladda-label"><i class="fa fa-mail-save"></i> Ubah Data</span>
											</button>
											<button type = "button" id="batal_edit" class="btn btn-wide btn-danger ladda-button" data-style="expand-right"  onclick='batal_edit();'
												<span class="ladda-label"><i class="fa fa-mail-reply"></i> Batal </span>
											</button>
										</div>
											
									</div>
								</fieldset>	
							</section>
							
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