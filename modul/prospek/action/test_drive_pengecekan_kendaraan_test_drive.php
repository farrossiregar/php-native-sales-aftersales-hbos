<?php 
	session_start();
	include "../../../config/koneksi_service.php";
?>

<script type="text/javascript" src="modul/prospek/action/act/canvasdraw.js"></script>			
<script type="text/javascript" src="assets/js/jquery.1.6.js"></script>	

<script>

	function uploadEx() {
	/*	var canvas = document.getElementById("myCanvas");
		var dataURL = canvas.toDataURL("image/png");
		document.getElementById('hidden_data').value = dataURL;
		var fd = new FormData(document.forms["form1"]);

		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'modul/service_general_repair/action/act/simpen.php', true);

		xhr.upload.onprogress = function(e) {
			if (e.lengthComputable) {
				var percentComplete = (e.loaded / e.total) * 100;
				console.log(percentComplete + '% uploaded');
				alert('Succesfully uploaded');
			}
		};

		xhr.onload = function() {

		};
		xhr.send(fd);	*/
	};	
	
	function myFunction(x) {
		x.classList.toggle("change");
	}	
		
	function post() {
							
		var table = document.getElementById("table_filter");
		var tbody = table.getElementsByTagName("tbody")[0];
		tbody.onclick = function (e) {
			e = e || window.event;
			var data = [];
			var target = e.srcElement || e.target;
			while (target && target.nodeName !== "TR") {
				target = target.parentNode;
			}
			if (target) {
				var cells = target.getElementsByTagName("td");
				for (var i = 0; i < cells.length; i++) {
					data.push(cells[i].innerHTML);
					dt = data.toString();
				
				}
			}
			
			dt = data.toString();
			dt_split = dt.split(",");
			
			
			$('#model').val(dt_split[1].trim());
			var tipe = dt_split[1].trim();
			gambar_mobil(tipe);
			
		};
	}
	
	function gambar_mobil(){
		drawImageSedan();
	}
		
//	function gambar_mobil($tipe){
	/*	var tipe_mobil = $tipe;
		if(tipe_mobil== 'ACCORD' || tipe_mobil== 'CITY' || tipe_mobil== 'CIVIC'){
			$('#model_mobil').html("Type Sedan");
			$('#type_mbl').show();
			drawImageSedan();
			console.log(tipe_mobil);
		}else if(tipe_mobil== 'MOBILIO' || tipe_mobil== 'BRIO' || tipe_mobil== 'FREED' || tipe_mobil== 'CR-V' || tipe_mobil== 'BR-V' || tipe_mobil== 'CR-Z' || 
					tipe_mobil== 'HR-V' || tipe_mobil== 'ODYSSEY' || tipe_mobil== 'STREAM' || tipe_mobil== 'ELYISON' || tipe_mobil== 'JAZZ'){
			drawImageSUV();
			console.log(tipe_mobil);
			$('#model_mobil').html("Type SUV, MPV dan Hatchback");
			$('#type_mbl').show();
		}else{
		//	console.log(tipe_mobil);
			$('#type_mbl').hide();
		}
		
	}	*/
						
						
						
	function format_angka(nilai) 
	{
		bk = nilai.replace(/[^\d]/g,"");
			ck = "";
			panjangk = bk.length;
			j = 0;
			for (i = panjangk; i > 0; i--) 
			{
				j = j + 1;
				if (((j % 3) == 1) && (j != 1)) 
				{
					ck = bk.substr(i-1,1) + "." + ck;
					xk = bk;
				} 
				else 
				{
					ck = bk.substr(i-1,1) + ck;
					xk = bk;
				}
			}
			return ck;
	}
	
	function simpanPemeriksaan(){
	//	tampil_gambar();
		var no_pengecekan = $('#no_pengecekan').val();
		var waktu_pengecekan = $('#waktu_pengecekan').val();
		var nopolisi = $('#nopolisi').val();
		var model = $('#model').val();
		var odmeter = $('#odmeter').val();
		var pic = $('#pic').val();
	//	var gambar64 = $('#base_64').val();
		var gambar64 = "hahaha hahaha hahaha";
	//	var ttd_base64 = $('#ttd_base64').val();
		
		var gambar_64 = gambar64.toString();
	
		var image = $('#hidden_data').val();
	
		
		if($('#status1').is(":checked")){
			var status_stnk = "Y";
		}else{
			var status_stnk = "N";
		}
		
		if($('#status2').is(":checked")){
			var status_buku_srv = "Y";
		}else{
			var status_buku_srv = "N";
		}
		
		if($('#status3').is(":checked")){
			var status_dokumen = "Y";
		}else{
			var status_dokumen = "N";
		}
		
		if($('#status4').is(":checked")){
			var status_radio = "Y";
		}else{
			var status_radio = "N";
		}
		
		if($('#status5').is(":checked")){
			var status_cd = "Y";
		}else{
			var status_cd = "N";
		}
		
		if($('#status6').is(":checked")){
			var status_tape = "Y";
		}else{
			var status_tape = "N";
		}
		
		if($('#status7').is(":checked")){
			var status_steer = "Y";
		}else{
			var status_steer = "N";
		}
		
		if($('#status8').is(":checked")){
			var status_dongkrak = "Y";
		}else{
			var status_dongkrak = "N";
		}
		
		if($('#status9').is(":checked")){
			var status_ban = "Y";
		}else{
			var status_ban = "N";
		}
		
		if($('#status10').is(":checked")){
			var status_cover_ban = "Y";
		}else{
			var status_cover_ban = "N";
		}
		
		if($('#status11').is(":checked")){
			var status_kunci = "Y";
		}else{
			var status_kunci = "N";
		}
		
		if($('#status12').is(":checked")){
			var status_dop = "Y";
		}else{
			var status_dop = "N";
		}
		
		if($('#status13').is(":checked")){
			var status_tutup_pentil = "Y";
		}else{
			var status_tutup_pentil = "N";
		}

		var qty_stnk = $('#qty1').val();
		var qty_buku_srv = $('#qty2').val();
		var qty_dokumen = $('#qty3').val();
		var qty_radio = $('#qty4').val();
		var qty_cd = $('#qty5').val();
		var qty_tape = $('#qty6').val();
		var qty_steer = $('#qty7').val();
		var qty_dongkrak = $('#qty8').val();
		var qty_ban = $('#qty9').val();
		var qty_cover_ban = $('#qty10').val();
		var qty_kunci = $('#qty11').val();
		var qty_dop = $('#qty12').val();
		var qty_tutup_pentil = $('#qty13').val();
		
		
		
		
	/*	if (customer == ""){
			swal({
				title: "Perhatian!",
				text: "Nama Pelanggan Tidak Boleh Kosong",
				type: "warning",
				confirmButtonColor: "#007AFF"
			});
		}else if (odmeter == ""){
			swal({
				title: "Perhatian!",
				text: "Odometer Tidak Boleh Kosong",
				type: "warning",
				confirmButtonColor: "#007AFF"
			});
		}else if (battery === undefined){
			swal({
				title: "Perhatian!",
				text: "Baterry Tidak Boleh Kosong",
				type: "warning",
				confirmButtonColor: "#007AFF"
			});
		}	*/
		
		$.ajax({
			method : "post",
			url : "modul/prospek/action/test_drive_simpan_pengecekan_kendaraan.php",
			data : "no_pengecekan="+no_pengecekan+
					'&waktu_pengecekan='+waktu_pengecekan+
					'&nopolisi='+nopolisi+
					'&model='+model+
					'&odometer='+odometer+
					'&gambar64='+gambar64+
					'&aksi=pengecekan'+
					
					'&status_stnk='+status_stnk+
					'&status_buku_srv='+status_buku_srv+
					'&status_dokumen='+status_dokumen+
					'&status_radio='+status_radio+
					'&status_cd='+status_cd+
					'&status_tape='+status_tape+
					'&status_steer='+status_steer+
					'&status_dongkrak='+status_dongkrak+
					'&status_ban='+status_ban+
					'&status_cover_ban='+status_cover_ban+
					'&status_kunci='+status_kunci+
					'&status_dop='+status_dop+
					'&status_tutup_pentil='+status_tutup_pentil+
					
					'&qty_stnk='+qty_stnk+
					'&qty_buku_srv='+qty_buku_srv+
					'&qty_dokumen='+qty_dokumen+
					'&qty_radio='+qty_radio+
					'&qty_cd='+qty_cd+
					'&qty_tape='+qty_tape+
					'&qty_steer='+qty_steer+
					'&qty_dongkrak='+qty_dongkrak+
					'&qty_ban='+qty_ban+
					'&qty_cover_ban='+qty_cover_ban+
					'&qty_kunci='+qty_kunci+
					'&qty_dop='+qty_dop+
					'&qty_tutup_pentil='+qty_tutup_pentil
					,
			success : function(data){
			/*	$('#tampiltambahdata').slideUp(3000);
				$('#tambahdata').fadeIn(1000);
				$('#tampildata').fadeIn(1000);
				var canvas = document.getElementById("myCanvas");
				var dataURL = canvas.toDataURL("image/png");
				document.getElementById('hidden_data').value = dataURL;
				var fd = new FormData(document.forms["form1"]);

				var xhr = new XMLHttpRequest();
				xhr.open('POST', 'modul/service_general_repair/action/act/simpen.php', true);
				xhr.upload.onprogress = function(e) {
					if (e.lengthComputable) {
						var percentComplete = (e.loaded / e.total) * 100;
						console.log(percentComplete + '% uploaded');
						console.log('Succesfully uploaded');
					}
				};

				xhr.onload = function() {

				};
				xhr.send(fd);	*/
				
			}	
		})
	}


</script>     

<style>
	#tampiltambahdata{display:none;}
	#tampilfilterdata{display:none;}
	#loading{display:none;}		
</style>
<style>
	.bgtable {background: url(assets/type-sedan-samping.png) -16px 0 no-repeate;}
</style>   

<?php
///	if(count($_POST)){
		include "config/koneksi_service_pdo.php";
		date_default_timezone_set('Asia/Jakarta');
			$today=date("ym");	
			$hasil = $pdo->query("SELECT max(no_pengecekan) as last FROM test_drive_pengecekan_kendaraan WHERE no_pengecekan LIKE 'PK$today%'");
			$data = $hasil->fetch();
			$lastNoTransaksi = $data['last'];
			$lastNoUrut = substr($lastNoTransaksi, 6, 3);
			$nextNoUrut = $lastNoUrut + 1;
			$nextNoTransaksi = "PK".$today.sprintf('%03s', $nextNoUrut);

			
//	}
?>
<div class="main-content" >
	<div class="wrap-content container" id="container">
		<!-- start: PAGE TITLE -->
		<section id="page-title">
			<div class="row">
				<div class="col-sm-8">
					<h1 class="mainTitle"> 
						Pengecekan Kendaraan Test Drive
					</h1>
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
					<form role="form" id="form" name="form1" enctype="multipart/form-data" method="post" action="modul/prospek/action/test_drive_simpan_pengecekan_kendaraan.php?aksi=pengecekan" onsubmit="return cek_inputan()">
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
							
								<fieldset>
									<legend>Data Kendaraan</legend>
									
									<div class="row">
										<div class="col-md-2">												  
											<div class="form-group">
												<label class="control-label">
													No Pemeriksaan <span class="symbol required"></span>
												</label>
													<input class="form-control" type="text" style="text-transform:uppercase" value = "<?php echo $nextNoTransaksi; ?>" onblur="this.value=this.value.toUpperCase(); $('#src').click();" placeholder="" class="form-control" id="no_pengecekan" name="no_pengecekan" required readonly>
												
											</div>
										</div>	
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label">
													Tanggal Pemeriksaan <span class="symbol required"></span>
												</label>
												<p class="input-append datepicker date " data-date-format="dd-mm-yyyy" data-provide="datepicker">
													<input class="form-control" id="waktu_pengecekan" readonly="" name="waktu_pengecekan" value="<?php echo date("d-m-Y"); ?>" required="" type="text">
												</p>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="form-field-select-2">
													Model <span class="symbol required"></span>
												</label>
												<select id="model" name = "model" class = "form-control" onchange = 'transmission();'>
													<?php
														$model = mysql_query("select * from test_drive_status_ketersediaan_mobil");
														while($data_model = mysql_fetch_array($model)){
															echo "<option value='' selected>".$data_model[nama_model]."</option>";
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-2">												  
											<div class="form-group">
												<label class="control-label">
													Pemilik Kendaraan <span class="symbol required"></span>
												</label>
												<input class="form-control" type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase(); $('#src').click();" placeholder="" class="form-control" id="pemilik_kendaraan" name="pemilik_kendaraan" readonly >
												
											</div>
										</div>
										<div class="col-md-2">												  
											<div class="form-group">
												<label class="control-label">
													No Polisi <span class="symbol required"></span>
												</label>
												<input class="form-control" type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase(); $('#src').click();" placeholder="B-199-PP" class="form-control" id="nopolisi" name="nopolisi" readonly >
												
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label">
													Odometer <span class="symbol required"></span>
												</label>
												<input type="text"  class="form-control" value="" id="odometer" name="odometer" required onkeypress="return hanyaAngka(event)" onFocus="startCalc();" onBlur="stopCalc();" onkeyup="this.value=format_angka(this.value);"  />	
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">
													Keterangan Pengecekan <span class="symbol required"></span>
												</label>
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
									<legend id = "model_mobil">Kondisi Mobil</legend>
										<div id = 'type_mbl' style = "display:block;">
											<div align="center">
												<div class="table-responsive">
													<canvas id="myCanvas" width="420" height="240" style="border:2px solid black"></canvas>
													<br /><br />
													Geser Disini..
												</div>		
													<button onclick="javascript:gambar_mobil($('#model').val().trim());return false;">Clear Area</button>
													Line width : <select id="selWidth">
														<option value="1">1</option>
														<option value="3">3</option>
														<option value="5" selected="selected">5</option>
														<option value="7">7</option>
														<option value="9">9</option>
														<option value="11">11</option>
													</select> 
													Color : <select id="selColor">
														<option value="blue" selected="selected">Biru (Lain-lain)</option>
														<option value="red">Merah (Body Penyok)</option>
														<option value="gray">Abu-abu (Cat tergores)</option>
													</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<button onclick="javascript:cUndo();return false;">Undo</button>
													<button onclick="javascript:cRedo();return false;">Redo</button>
													<input name="hidden_data" value = "" id='hidden_data' type="text"/>
													<textarea name="base_64" value = "" id='base_64'></textarea>
											</div>
										</div>
								</fieldset>	
							</div>
							<div class="col-md-6">
								<fieldset>
									<legend>Kelengkapan</legend>
									<?php  
										$kelengkapan = array("STNK","Buku Service","Dokumen / Surat / Koran","Radio - Tape / CD Charger / TV","Cassete / CD","Remote Tape / Remote Alarm","Kunci Steer","Dongkrak","Ban Cadangan","Cover Ban Cadangan","Kunci-kunci","Dop Roda","Tutup Pentil");
									?>
									
									<div class="table-responsive">
										<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
											<tbody>
												<tr>
													<th width="20%">KELENGKAPAN</th>
													<th width="5%">CHECK</th>
													<th width="20%">QTY</th>
												</tr>
												<?php 
													$no = 0;
													foreach($kelengkapan as $data){
														$no++;
														echo "<tr><td>$data</td>";
												?>	
													<td>
														<div class="checkbox clip-check check-primary checkbox-inline" style="line-height: 10px;">
															<input id="<?php echo "status$no" ?>" value="Y" name="<?php echo "status$no" ?>" type="checkbox" >
															<label for="<?php echo "status$no" ?>">
																
															</label>
														</div>
														
													</td>
													<td>
														<input type = "number" class="form-control" name="<?php echo "qty$no" ?>" id="<?php echo "qty$no" ?>" />
													</td>
													</tr>
												<?php 
													} 
												?>
											</tbody>
										</table>
									</div>	
								</fieldset>
							</div>
						
							
							<script>
								function tampil_gambar(){
									var sigImage = document.getElementById("sig-image");
									var canvas = document.getElementById("myCanvas");
									var dataUrl = canvas.toDataURL();
									$('#base_64').val(dataUrl);
									
									var canvasTtd = document.getElementById("myCanvas2");
									var dataUrlTtd = canvasTtd.toDataURL();
									$('#ttd_base64').val(dataUrlTtd);
									
								//	sigImage.setAttribute("src", dataUrl);
								//	console.log(dataUrl);
								}
							</script>
						</div>
							
							
						
							
							<div class="row center">
								
								
							</div>
						
							<div class="row">
								<div class="col-md-12">
									<img id="sig-image" src="" alt = "">
								</div>
							</div>
						
						<div class="row">											
							<div class="col-md-12">
								<button id="simpan" type="button" class="btn btn-wide btn-o btn-success" onclick = 'simpanPemeriksaan();'>
									Simpan
								</button>	
								<button id="batal" type="button" class="btn btn-wide btn-o btn-danger">
									Batal
								</button>	
							</div>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onblur="reload();" onpageshow="focus">
</div>
	
		
		
