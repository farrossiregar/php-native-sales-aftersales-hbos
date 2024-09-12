<?php
		include "config/fungsi_thumb.php";
		switch($_GET[act]){
		//tampilkan data
		default:
?>
			
				<!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script-->
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
				<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
				
				<script language="JavaScript">
					function warning() {
						return confirm('Anda yakin menghapus data ini?');
					}
					
					function status_kedatangan(){
						if($("#radio1").is(":checked")){
							$('#tidak_datang1').hide();
							$('#tidak_datang2').hide();
							$('#datang').show();
							$('#reschedule').val();
							$('#ket_tidak_datang').val();
						//	alert(jQuery('input[name="kedatangan"]:checked').val());
						}
						
						if($("#radio2").is(":checked")){
							$('#tidak_datang1').show();
							$('#tidak_datang2').show();
							$('#datang').hide();
						//	alert($('#reschedule').is(':checked'));
						//	alert(jQuery('input[name="kedatangan"]:checked').val());
						}
					}
					
					
					function service_type(){
					//	if($("#repair").is(":checked") || $("#warranty").is(":checked") ){
						if($("#srv3").is(":checked")){
							$('#perbaikan').val("");
							$('#perbaikan_repair_warranty').show();
							$('#perbaikan_pm').hide();
						}
						if($("#srv2").is(":checked")){
							$('#perbaikan').val("");
							$('#perbaikan_repair_warranty').show();
							$('#perbaikan_pm').hide();
						}
						
						if($("#srv1").is(":checked")){
							$('#perbaikan_pm').show();
							$('#perbaikan_repair_warranty').hide();
						}
					}
					
					
					function tambah_data(){
						$.ajax({
							method : "post",
							url : "modul/service_general_repair/no_booking.php",
							success : function(data){
								$("Modal2").modal('show');
								$('#myModal2Label').html("Tambah Booking Stock");
								$("#no_booking").val(data)
								$('#nama_cust').val("").prop("readonly", false);
								pilih_hari();
								$('#waktu1').show();
								$('#waktu2').hide();
								$('#jam_booking').val("").attr("disabled", false);
								$('#tgl_booking').val("").attr("disabled", false);
								$('#no_polisi').val("").prop("readonly", false);
								$('#tipe').val("").attr("disabled", false);
								$('#telepon').val("").prop("readonly", false);
								$('#perbaikan').val("").prop("readonly", false);
								$('#keterangan').val("").prop("readonly", false);
								$('#no_rangka_mesin').hide();
								$('#bn').show();
								$('#radio_button').hide();
								$('#upd').hide();
								$('#upd2').hide();
								
							}
						})
					}	
					
				
					
					function resch_modal($id){
						var periode = $('#periode_booking').val();
						var no_booking = $('#resch'+$id).val();
						var id = $id;
						$.ajax({
							method : "post",
							url : "modul/service_general_repair/data_edit.php",
							data : 'data='+no_booking+'&data2='+periode,
							success : function(data){
								var dd = data.toString();
								var d = dd.trim();
								var dat = d.split(",");
								$('#Modal2').modal('show');		
								$('#no_booking').val(dat[0]).prop("readonly", true);								
								$('#nama_cust').val(dat[1]).prop("readonly", true);
								pilih_hari();
								$('#waktu1').show();
								$('#waktu2').hide();
								$('#tgl_booking').val("").attr("disabled", false);
								$('#jam_booking').val("").attr("disabled", false);
								$('#no_polisi').val(dat[4]).prop("readonly", true);
								$('#tipe').val(dat[5]).attr("disabled", true);
								$('#telepon').val(dat[6]).prop("readonly", true);
								$('#perbaikan').val(dat[7]).prop("readonly", false);
								$('#keterangan').val(dat[8]).prop("readonly", false);
								$('#upd2').show();
								$('#radio_button').hide();
								$('#bn').hide();
								$('#upd').hide();
								$('#myModal2Label').html("Reschedule Booking Stock");
							}
						})
						$('#upd2').on('click', function(){
							
							var periode = $('#periode_booking').val();
							var no_booking = $('#no_booking').val();
							var nama = $('#nama_cust').val();
							var jam = $('#jam_booking').val();
							var tanggal = $('#tgl_booking').val();
							var no_polisi = $('#no_polisi').val();
							var tipe = $('#tipe').val();
							var telepon = $('#telepon').val();
							var perbaikan = $('#perbaikan').val();
							var keterangan = $('#keterangan').val();
							
							var user_input = "<?php echo $_SESSION['username_service']?>";
							if($('#tgl_booking').val("") && $('#jam').val("")){
							$.ajax({
								method : "post",
								url : "modul/service_general_repair/reschedule_data.php",
								data: 'data='+no_booking+'&data1='+nama+'&data2='+jam+'&data3='+tanggal+'&data4='+no_polisi+'&data5='+tipe+'&data6='+telepon+'&data7='+perbaikan+'&data8='+keterangan+'&data9='+user_input,
								success : function(data){
									$('#no_booking').val("");
									$('#nama_cust').val("");
									$('#jam_booking').val("");
									$('#tgl_booking').val("");
									$('#no_polisi').val("");
									$('#tipe').val("");
									$('#telepon').val("");
									$('#perbaikan').val("");
									$('#keterangan').val("");
									$('.kedatangan').val("");
									$('.terlambat').val("");
									$('#Modal2').modal('hide');
									$('#message').html(data);
									cari_data_booking();
									console.log(jam);
								}
							})
							}
						})
					}
					
					function cari_data_booking(){
						var tanggal = $('#periode_booking').val();
						if ($('#periode_booking').val() != ''){
							$.ajax({
								method : "post",
								url : "modul/service_general_repair/tampil_data_booking.php",
								data : {data_ajax : tanggal},
								success : function(data){
									var str = data.toString();
									var trm = str.trim();
									var splt = trm.split(",");
									$('#table_booking').html(data);
									$('#header_table').show();
									$('#export').attr('href', 'modul/service_general_repair/export_data_booking.php?periode_booking='+tanggal);
								}
							})
						}
					}
					
					function pilih_hari(){
						var tgl = $('#tgl_booking').val();
						var hari = tgl.substr(-3, 3);
						var tgl2 = tgl.substr(0, 10);
						$.ajax({
							method : "post",
							url : "modul/service_general_repair/get_hari.php",
							data : 'data='+hari+'&data1='+tgl2,
							success : function(data){
								$('#jam_booking').html(data);
							}
						})
					}
					
					
					function search() {
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
					})();

					
					
					// ==============	EDIT ============================ //
			
					function edit_modal($id){
						var periode = $('#periode_booking').val();
						var no_booking = $('#edit'+$id).val();
						var lim = add();
						var z = y;
						var id = $id;
						$.ajax({
							method : "post",
							url : "modul/service_general_repair/data_edit.php",
							data : 'data='+no_booking+'&data2='+periode,
							success : function(data){
								var dd = data.toString();
								var d = dd.trim();
								var dat = d.split(",");
								$('#Modal2').modal('show');		
								$('#no_booking').val(dat[0]).prop("readonly", true);								
								$('#nama_cust').val(dat[1]).prop("readonly", true);
								$('#waktu1').hide();
								$('#waktu2').show();
								$('#tgl_booking2').val(dat[3]).attr("disabled", true);
								$('#jam_booking2').val(dat[2]).attr("disabled", true);
								$('#no_polisi').val(dat[4]).prop("readonly", true);
								$('#tipe').val(dat[5]).attr("disabled", true);
								$('#telepon').val(dat[6]).prop("readonly", true);
								$('#perbaikan').val(dat[7]).prop("readonly", true);
								$('#keterangan').val(dat[8]).prop("readonly", true);
								$('#no_rangka_mesin').show();
								
								pilih_hari() == false;
							//	jQuery('input[name="kedatangan"]:checked').val(dat[9]);
								if(dat[9] == 'Y'){
									$('#radio1').attr('checked', true);
									$('#datang').show();
									$('#datetimepicker2').val(dat[10]).show();
								/*	var jam_kedatangan = dat[10];
									var jam_kedatangan2 = jam_kedatangan.substring(0, 2);
									var jam_kedatangan3 = jam_kedatangan.substring(4, 6);
									$('#hour').val(jam_kedatangan2).attr("disabled", true);
									$('#min').val(jam_kedatangan3).attr("disabled", true);	*/
									$('#tidak_datang1').hide();
									$('#tidak_datang2').hide();
									$('#upd').hide();
									$('#radio_button').hide();
								}else if(dat[9] == 'N'){
									$('#radio2').attr('checked', true);
									$('#datang').hide();
									$('#ket_tidak_datang').val(dat[12]).show();
									$('#tidak_datang1').show();
									$('#tidak_datang2').show();
									$('#upd').hide();
									$('#radio_button').hide();
									if(dat[11] == 'Y'){
										$('#reschedule').attr('checked', true);
									}else{
										$('#reschedule').attr('checked', false);
									}
									
								}else{
									$('#radio1').attr('checked', false);
									$('#radio2').attr('checked', false);
									$('#datang').hide();
									$('#ket_tidak_datang').val("").show();
									$('#tidak_datang1').hide();
									$('#tidak_datang2').hide();
									$('#upd').show();
									$('#radio_button').show();
								}
								
							//	$('#jam_datang').val(dat[10]);
							//	$('#reschedule').val(dat[11]);
							//	$('#ket_tidak_datang').val(dat[12]);
								$('#bn').hide();
								$('#upd2').hide();
								$('#myModal2Label').html("Edit Booking Stock");
							}
						})
										
					//	===============	UPDATE	============================
						
						$('#upd').on('click', function(){
							var no_booking = $('#no_booking').val();
							var datang = jQuery('input[name="kedatangan"]:checked').val();
							var reschedule = $('#reschedule').is(':checked');
						//	var jam_datang = $('#datetimepicker2').val();
							var hour = $('#hour').val();
							var min = $('#min').val();
							var jam_datang = hour + ":" + min;
							var ket_tidak_datang = $('#ket_tidak_datang').val();
							var norangka = $('#norangka').val();
							var nomesin = $('#nomesin').val();
							var periode = $('#periode_booking').val();
							if(datang == 'Y'){
								reschedule = 'N';
								ket_tidak_datang = "";
							}else{
								jam_datang = "00:00:00";
								if($('#reschedule').is(':checked') == true){
									reschedule = 'Y';
								}else{
									reschedule = 'N';
								}
							}
							
							$.ajax({
								method : "post",
								url : "modul/service_general_repair/update_data.php",
								data : 'data_update='+no_booking+'&data9='+datang+'&data10='+jam_datang+'&data11='+reschedule+'&data12='+ket_tidak_datang+'&data13='+norangka+'&data14='+nomesin,
								success : function(data){
									$('#nama_cust').val("");
									$('#tgl_booking').val("");
									$('#jam_booking').val("");
									$('#no_polisi').val("");
									$('#tipe').val("");
									$('#telepon').val("");
									$('#perbaikan').val("");
									$('#keterangan').val("");
									$('#Modal2').modal('hide');
									$('#message').html(data);
									cari_data_booking();
									console.log(reschedule);
								}
							})
						})
						
					}
				
					
					//	===============	SIMPAN	============================//
					function simpan(){
						
						var periode = $('#periode_booking').val();
						var no_booking = $('#no_booking').val();
						var nama = $('#nama_cust').val();
						var jam = $('#jam_booking').val();
						var tanggal = $('#tgl_booking').val();
						var no_polisi = $('#no_polisi').val();
						var tipe = $('#tipe').val();
					//	var jenis_perbaikan = 
						var telepon = $('#telepon').val();
						if($("#srv3").is(":checked") || $("#srv2").is(":checked")){
							var perbaikan = $('#perbaikan').val();
						}else{
							var perbaikan = $('#perbaikan1').val();
						}
						var jenis_perbaikan = jQuery('input[name="jenis_perbaikan"]:checked').val();
						var keterangan = $('#keterangan').val();
						var keterangan2 = keterangan.replace(/,/g, ".");
					
						var user_input = "<?php echo $_SESSION['username_service']?>";
						if($('#nama_cust').val("")){
							$.ajax({
								method : "post",
								url : "modul/service_general_repair/insert_data.php",
								data: 'data='+no_booking+'&data1='+nama+'&data2='+jam+'&data3='+tanggal+'&data4='+no_polisi+'&data5='+tipe+'&data6='+telepon+'&data7='+perbaikan+'&data8='+keterangan2+'&data9='+user_input+'&data10='+jenis_perbaikan,
								success : function(data){
									$('#no_booking').val("");
									$('#nama_cust').val("");
									$('#jam_booking').val("");
									$('#tgl_booking').val("");
									$('#no_polisi').val("");
									$('#tipe').val("");
									$('#telepon').val("");
									$('#perbaikan').val("");
									$('#keterangan').val("");
									$('.kedatangan').val("");
									$('.terlambat').val("");
									$('#Modal2').modal('hide');
									$('#message').html(data);
									cari_data_booking();
								}
							})
						}
					} 
					
			
					
					//	===============	KELUAR	============================//
					function exit_modal(){
						$('#nama_cust').val("");
						$('#jam_booking').val("");
						$('#tgl_booking').val("");
						$('#tgl_booking').attr("disabled", false);
						$('#no_polisi').val("");
						$('#tipe').val("");
						$('#telepon').val("");
						$('#perbaikan').val("");
						$('#keterangan').val("");
						$('#Modal2').modal('hide');
						$('#upd').hide();
						jQuery('input[name="kedatangan"]:checked').val();
						$('#radio_button').hide();
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
										<span>Konfigurasi</span>
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
																<input type="text"  class="form-control" id="telepon" name="telepon" value="" required>
															</div>
														</div>
													</div>
													<div class="row" id = "waktu1">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Pilih Periode <span class="symbol required"></span>
																</label>
																<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd D'>
																	<input class="form-control" type="text" id="tgl_booking" name="tgl_booking" onchange="pilih_hari();" onload = "pilih_hari();" value ="<?php echo date('Y-m-d D'); ?>" readonly required >
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group" >
																<label class="control-label">
																	Jam Booking <span class="symbol required"></span>
																</label>
																<!--div class="input-group bootstrap-timepicker col-md-12" >
																  <input type="text" class="form-control" name="jam" id="datetimepicker2" data-date-format='HH:mm:ss'  />
																  <span class="input-group-addon"><i class="glyphicon glyphicon-time" id="datetimepicker2"></i></span>
																</div-->
																<!--div style="background: url(http://i62.tinypic.com/15xvbd5.png) no-repeat 10% 0; height: 60px; overflow: hidden; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; background-color: #007AFF;"-->
																<div>	
																	<select name = "jam" id="jam_booking" class = "form-control" style="">														
																		<option value="semua_model" selected disabled>PILIH JAM</option>
																		
																	</select>
																</div>
															</div>
															
														</div>
													</div>
													<div class="row" id="waktu2">
														<div class="col-md-6" id='tgl2'>
															<div class="form-group">
																<label class="control-label">
																	Pilih Periode <span class="symbol required"></span>
																</label>
																<div class="input-group input-daterange " data-date-format='yyyy-mm-dd D'>
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
													<!--div class="form-group">
														<label class="control-label">
															Jenis Perbaikan
														</label>
														<select name = "jenis_perbaikan" id="jenis_perbaikan" class = "form-control" >														
															<option value="" selected disabled>Jenis Perbaikan</option>
															<option value="PM" >PM</option>
															<option value="REPAIR" >REPAIR</option>
															<option value="WARRANTY" >WARRANTY</option>
														</select>
													</div-->
													<div class = "row">
														
														<div class = "col-md-4">
															<div class="radio clip-radio radio-primary radio-inline" >
																<input id="srv2" name="jenis_perbaikan" value="REPAIR" type="radio" onchange = "service_type();">
																<label for="srv2">
																	REPAIR
																</label>
															</div>
														</div>
														<div class = "col-md-4">
															<div class="radio clip-radio radio-primary radio-inline" >
																<input id="srv3" name="jenis_perbaikan" value="WARRANTY" type="radio" onchange = "service_type();">
																<label for="srv3">
																	WARRANTY(PUD)
																</label>
															</div>
														</div>
														<div class = "col-md-4">
															<div class="radio clip-radio radio-primary radio-inline" >
																<input id="srv1" name="jenis_perbaikan" value="PM" type="radio" onchange = "service_type();">
																<label for="srv1">
																	PM
																</label>
															</div>
														</div>
													</div>
													<br>
													<div class="form-group" id="perbaikan_repair_warranty" style="display: none;">
														<label class="control-label">
															Perbaikan
														</label>
														<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="perbaikan" name="perbaikan" value="">
													</div>
													<div class="form-group" id="perbaikan_pm" style="display: none;">
														<label class="control-label">
															Perbaikan
														</label>
														<select name = "perbaikan" id="perbaikan1" class = "form-control" >														
															<option value="" selected disabled>PM</option>
															<option value="1.000 KM" >1.000 KM</option>
															<option value="10.000 KM" >10.000 KM</option>
															<option value="20.000 KM" >20.000 KM</option>
															<option value="30.000 KM" >30.000 KM</option>
															<option value="40.000 KM" >40.000 KM</option>
															<option value="50.000 KM" >50.000 KM</option>
															<option value="60.000 KM" >60.000 KM</option>
															<option value="70.000 KM" >70.000 KM</option>
															<option value="80.000 KM" >80.000 KM</option>
															<option value="90.000 KM" >90.000 KM</option>
															<option value="100.000 KM" >100.000 KM</option>
														</select>
													</div>
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
													<div class="row" id = 'radio_button' hidden>
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
																	<div class = "col-md-6" id = 'datang' style="display: none;">
																		<div class="form-group">
																			<label class="control-label">
																				Jam Datang <span class="symbol required"></span>
																			</label>
																			<!--div class="input-group bootstrap-timepicker col-md-12" >
																			  <input type="text" class="form-control" name="jam" id="datetimepicker2" data-date-format='HH:mm:ss'  />
																			  <span class="input-group-addon"><i class="glyphicon glyphicon-time" id="datetimepicker2"></i></span>
																			</div-->
																			<div class="row">
																				<div class = "col-md-6">
																					<select name = "hour" id="hour" class = "form-control" style="">														
																						<option value="" selected disabled>PILIH JAM</option>
																							<?php 
																								for($i=6; $i<20; $i++ ){
																									echo "<option value=".($i<10 ? "0$i" : "$i") .">".($i<10 ? "0$i" : "$i")."</option>";
																							
																								}
																							?>
																					</select>
																				</div>
																				<div class = "col-md-6">
																					<select name = "min" id="min" class = "form-control" style="">														
																						<option value="" selected disabled>PILIH MENIT</option>
																							<?php 
																								for($i=0; $i<60; $i=$i+5 ){
																									echo "<option value=".($i<10 ? "0$i" : "$i") .">".($i<10 ? "0$i" : "$i")."</option>";
																									
																								}
																							?>
																					</select>
																				</div>
																			</div>
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
																	<div class = "col-md-6" id = 'tidak_datang2' style="display: none;">
																		<div class="form-group" id = "reschedule_div">
																			<label class="control-label">
																				Reschedule
																			</label>
																			<br>
																			<input id = "reschedule" name = "reschedule" value="Y" type="checkbox">
																		</div>
																	</div>
																</div>
																<div class = "col-md-12" id = 'tidak_datang1' style="display: none;">
																	<div class="form-group">
																		<label class="control-label">
																			Keterangan Tidak Datang<span class="symbol required"></span>
																		</label>
																		<div class="form-group">
																			<div class="note-editor">
																				<textarea class="form-control" id="ket_tidak_datang" name="ket_tidak_datang" required></textarea>
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
												<div class="col-md-12">
													<button class="btn btn-primary btn-wide" type="button" id="bn" name="bn" onClick="simpan();">
														<span class="ladda-label"><i class="fa fa-save"></i> Simpan</span>
													</button>
													
													<button type = "button" id="upd" name="upd" class="btn btn-primary btn-wide" data-style="expand-right" style="display:none;">
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
										</form>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="container-fluid container-fullw bg-white">
							<section class="col-md-12" id="message">
							</section>
								
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
												<th >Data Servis</th>
												<th>Data Customer</th>
												
												<th>Status Kedatangan</th>
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
										$level = $_SESSION['leveluser_service'];
										
										$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ");
										$cek_akses2 = mysql_fetch_array($cek_akses);
											if($cek_akses2['ekspor'] == 'Y')
											{
									?>
									<div class="progress-demo">
										<!--a href='modul/service_general_repair/export_data_booking.php?periode_booking=<?php echo $_GET['periode_booking']; ?>' id="export"-->
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