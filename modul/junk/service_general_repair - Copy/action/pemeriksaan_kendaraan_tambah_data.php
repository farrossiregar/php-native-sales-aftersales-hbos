<?php if (count($_POST)){
		session_start();
		include "../../../config/koneksi_service.php";
		?>

<style>

</style>

<script>
	function panggil(){
		$('.datepicker').datepicker({autoclose: true, todayHighlight: true});
					
		$('#src').click(function(){
			var nopolisi = $('#nopolisi').val();
			
			if (nopolisi != ""){
				$(".preload-wrapper3").show();
				$.ajax({
						method : "post",
						url : "modul/service_general_repair/action/pemeriksaan_kendaraan_tampil_data.php",
						data : 	'nopolisi='+nopolisi+
								
								'&data_konfirmasi_sms='+nopolisi,
						success : function(data){
							
							var hasil = JSON.parse(data);
							
							if (hasil['status']=="kosong"){
								swal({
									title: "Perhatian!",
									text: "Nomor Polisi Tidak Terdaftar",
									type: "warning",
									confirmButtonColor: "#007AFF"
								});
							}else{
								var tipe_mobil = hasil['model'];
								var tipe = tipe_mobil.trim();
								$('#model').val(tipe);
								gambar_mobil(tipe);
								
								$('#tahunbuat').val(hasil['tahunbuat']);
								$('#odmeter').val(hasil['odmeterakhir']);
								$('#customer').val(hasil['nama']);
							}
							$(".preload-wrapper3").fadeOut("slow");
						}
										
				})
			
			}
		})
		
					
			$('#tampil_tipe').click(function(){
				$(".preload-wrapper3").show();
				$.ajax({
					method : "post",
					url : "modul/service_general_repair/action/pemeriksaan_kendaraan_list_tipe.php",
					data : "id=tampildata",
					success : function(data){
						
						$('#modal').html(data);
						$("#modal").modal('show');
						$(".preload-wrapper3").fadeOut("slow");
						//document.getElementById("search").focus();
						//console.log(data);
					}	
				})
			})			
	}
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
	
	function gambar_mobil($tipe){
		var tipe_mobil = $tipe;
		if(tipe_mobil== 'ACCORD' || tipe_mobil== 'CITY' || tipe_mobil== 'CIVIC'){
			$('#model_mobil').html("Type Sedan");
			$('#type_mbl').show();
			drawImageSedan();
			console.log(tipe_mobil);
		}else if(tipe_mobil== 'MOBILIO' || tipe_mobil== 'BRIO' || tipe_mobil== 'FREED' || tipe_mobil== 'CR-V' || tipe_mobil== 'BR-V' || tipe_mobil== 'CR-Z' || 
					tipe_mobil== 'HR-V' || tipe_mobil== 'ODYSSEY' || tipe_mobil== 'STREAM' || tipe_mobil== 'ELLYSON' || tipe_mobil== 'JAZZ'){
			drawImageSUV();
			console.log(tipe_mobil);
			$('#model_mobil').html("Type SUV, MPV dan Hatchback");
			$('#type_mbl').show();
		}else{
		//	console.log(tipe_mobil);
			$('#type_mbl').hide();
		}
	}
						
						
						
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
		tampil_gambar();
		var no_pemeriksaan = $('#nopemeriksaan').val();
		var tanggal_datang = $('#tanggal').val();
		var no_polisi = $('#nopolisi').val();
		var model = $('#model').val();
		var gambar64 = $('#base_64').val();
		var ttd_base64 = $('#ttd_base64').val();
		
		var gambar_64 = gambar64.toString();
		var transmisi_mobil = $('#transmisi_mobil').val();
		if(transmisi_mobil == 'at'){
			var posisi_transmisi = $('#transmisi_at').val();
		}else if(transmisi_mobil == 'mt'){
			var posisi_transmisi = $('#transmisi_mt').val();
		}else if(transmisi_mobil == 'cvt'){
			var posisi_transmisi = $('#transmisi_mt').val();
		}else{
			var posisi_transmisi = "";
		}
		
		
		var tahunbuat = $('#tahunbuat').val();
		var odmeter = $('#odmeter').val();
		var pic = $('#pic').val();
		var customer = $('#customer').val();
		var keluhan = $('#keluhan').val();
		var catatan = $('#catatan').val();
		var image = $('#hidden_data').val();
		var battery = jQuery('input[name="radio10"]:checked').val();
	
		
		
		var tebaldepankanan = $('#tebaldepanKANAN').val();
		var tebaldepankiri= $('#tebaldepanKIRI').val();
		var tebalbelakangkanan = $('#tebalbelakangKANAN').val();
		var tebalbelakangkiri = $('#tebalbelakangKIRI').val();
		
		var keterangandepankanan = $('#keterangandepanKANAN').val();
		var keterangandepankiri= $('#keterangandepanKIRI').val();
		var keteranganbelakangkanan = $('#keteranganbelakangKANAN').val();
		var keteranganbelakangkiri = $('#keteranganbelakangKIRI').val();
		
		var kondisidepankiri = jQuery('input[name="kondisidepanKIRI"]:checked').val();
		var kondisidepankanan = jQuery('input[name="kondisidepanKANAN"]:checked').val();
		var kondisibelakangkiri = jQuery('input[name="kondisibelakangKIRI"]:checked').val();
		var kondisibelakangkanan = jQuery('input[name="kondisibelakangKANAN"]:checked').val();
		
		if($('#status1').is(":checked")){
			var stnk = "Y";
		}else{
			var stnk = "N";
		}
		
		if($('#status2').is(":checked")){
			var bukusrv = "Y";
		}else{
			var bukusrv = "N";
		}
		
		if($('#status3').is(":checked")){
			var toolset = "Y";
		}else{
			var toolset = "N";
		}
		
		if($('#status4').is(":checked")){
			var dongkrak = "Y";
		}else{
			var dongkrak = "N";
		}
		
		if($('#status5').is(":checked")){
			var doproda = "Y";
		}else{
			var doproda = "N";
		}
		
		if($('#status6').is(":checked")){
			var bancadangan = "Y";
		}else{
			var bancadangan = "N";
		}
		
		
		var kondisi_stnk = $('#kondisi1').val();
		var kondisi_buku_srv = $('#kondisi2').val();
		var kondisi_toolset = $('#kondisi3').val();
		var kondisi_dongkrak = $('#kondisi4').val();
		var kondisi_doproda = $('#kondisi5').val();
		var kondisi_bancadangan = $('#kondisi6').val();
		
		var bunyi = $('#bunyi').val();
		var sumberbunyi = $('#sumberbunyi').val();
		var volumebunyi = $('#volumebunyi').val();
		var karakterbunyi = $('#karakterbunyi').val();
		var intensitasbunyi = $('#intensitasbunyi').val();
		var waktubunyi1 = $('#waktubunyi').val();
		var waktubunyi2 = $('#waktubunyi2').val();
		var waktu_bunyi = waktubunyi1 + ' ' + waktubunyi2;
		
		if($('#start').is(":checked")){
			var start = "start ";
		}else{
			var start = "";
		}
		
		if($('#idle').is(":checked")){
			var idle = "idle ";
		}else{
			var idle = "";
		}
		
		if($('#pagi').is(":checked")){
			var pagi = "pagi ";
		}else{
			var pagi = "";
		}
		
		if($('#mesin_panas').is(":checked")){
			var mesin_panas = "mesin_panas ";
		}else{
			var mesin_panas = "";
		}
		
		if($('#mesin_dingin').is(":checked")){
			var mesin_dingin = "mesin_dingin ";
		}else{
			var mesin_dingin = "";
		}
		
		if($('#siang').is(":checked")){
			var siang = "siang ";
		}else{
			var siang = "";
		}
		
		if($('#ac_on').is(":checked")){
			var ac_on = "ac_on ";
		}else{
			var ac_on = "";
		}
		
		if($('#ac_off').is(":checked")){
			var ac_off = "ac_off ";
		}else{
			var ac_off = "";
		}
		
		if($('#malam').is(":checked")){
			var malam = "malam ";
		}else{
			var malam = "";
		}
		
		var menit = $('#menit_dinyalakan').val();
		var menit2 = menit + ' menit setelah engine on';
		var km = $('#km_dinyalakan').val();
		var km2 = km + ' km setelah pengendaraan';
		
		var waktukejadian = start +
							idle +
							pagi +
							mesin_panas +
							mesin_dingin +
							siang +
							ac_on +
							ac_off +
							malam +
							menit2 +
							km2;
		
		var rpm = $('#rpm').val();
		
		
		if($('#lurus').is(":checked")){
			var lurus = "lurus ";
		}else{
			var lurus = "";
		}
		
		if($('#belok_kiri').is(":checked")){
			var belok_kiri = "belok kiri ";
		}else{
			var belok_kiri = "";
		}
		
		if($('#belok_kanan').is(":checked")){
			var belok_kanan = "belok kanan ";
		}else{
			var belok_kanan = "";
		}
		
		var kondisipengendaraan = lurus + belok_kiri + belok_kanan;
		
		if($('#tanjakan').is(":checked")){
			var tanjakan = "tanjakan ";
		}else{
			var tanjakan = "";
		}
		
		if($('#datar').is(":checked")){
			var datar = "datar ";
		}else{
			var datar = "";
		}
		
		if($('#turunan').is(":checked")){
			var turunan = "turunan ";
		}else{
			var turunan = "";
		}
		
		if($('#aspal').is(":checked")){
			var aspal = "aspal ";
		}else{
			var aspal = "";
		}
		
		if($('#beton').is(":checked")){
			var beton = "beton ";
		}else{
			var beton = "";
		}
		
		if($('#tanah').is(":checked")){
			var tanah = "tanah ";
		}else{
			var tanah = "";
		}
		
		if($('#gelombang').is(":checked")){
			var gelombang = "gelombang ";
		}else{
			var gelombang = "";
		}
		
		if($('#halus').is(":checked")){
			var halus = "halus ";
		}else{
			var halus = "";
		}
		
		if($('#kasar').is(":checked")){
			var kasar = "kasar ";
		}else{
			var kasar = "";
		}
		
		var kondisijalan = tanjakan + datar + turunan + aspal + beton + tanah + gelombang + halus + kasar;
		
		
		
		if (customer == ""){
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
		}else if (no_polisi == ""){
			swal({
				title: "Perhatian!",
				text: "Nomor Polisi Tidak Boleh Kosong",
				type: "warning",
				confirmButtonColor: "#007AFF"
			});
		}else if (model == ""){
			swal({
				title: "Perhatian!",
				text: "Model Tidak Boleh Kosong",
				type: "warning",
				confirmButtonColor: "#007AFF"
			});
		}else if (transmisi_mobil == ""){
			swal({
				title: "Perhatian!",
				text: "Transmisi Tidak Boleh Kosong",
				type: "warning",
				confirmButtonColor: "#007AFF"
			});
		}else if (tahunbuat == ""){
			swal({
				title: "Perhatian!",
				text: "Tahun Buat Tidak Boleh Kosong",
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
		}
		else{
		$.ajax({
			method : "post",
			url : "modul/service_general_repair/action/pemeriksaan_kendaraan_simpan.php",
			data : "no_pemeriksaan="+no_pemeriksaan+
					'&tanggal_datang='+tanggal_datang+
					'&no_polisi='+no_polisi+
					'&model='+model+
					'&transmisi_mobil='+transmisi_mobil+
					'&tahunbuat='+tahunbuat+
					'&odmeter='+odmeter+
					'&pic='+pic+
					'&customer='+customer+
					'&rpm='+rpm+
					'&keluhan='+keluhan+
					'&gambar_64='+gambar_64+
					'&ttd_base64='+ttd_base64+
					'&catatan='+catatan+
					'&posisi_transmisi='+posisi_transmisi+
					
					'&battery='+battery+
					'&tebaldepankanan='+tebaldepankanan+
					'&tebaldepankiri='+tebaldepankiri+
					'&tebalbelakangkanan='+tebalbelakangkanan+
					'&tebalbelakangkiri='+tebalbelakangkiri+
					'&keterangandepankanan='+keterangandepankanan+
					'&keterangandepankiri='+keterangandepankiri+
					'&keteranganbelakangkanan='+keteranganbelakangkanan+
					'&keteranganbelakangkiri='+keteranganbelakangkiri+
					'&kondisidepankiri='+kondisidepankiri+
					'&kondisidepankanan='+kondisidepankanan+
					'&kondisibelakangkiri='+kondisibelakangkiri+
					'&kondisibelakangkanan='+kondisibelakangkanan+
					
					'&stnk='+stnk+
					'&bukusrv='+bukusrv+
					'&toolset='+toolset+
					'&dongkrak='+dongkrak+
					'&doproda='+doproda+
					'&bancadangan='+bancadangan+
					
					'&kondisi_stnk='+kondisi_stnk+
					'&kondisi_buku_srv='+kondisi_buku_srv+
					'&kondisi_toolset='+kondisi_toolset+
					'&kondisi_dongkrak='+kondisi_dongkrak+
					'&kondisi_doproda='+kondisi_doproda+
					'&kondisi_bancadangan='+kondisi_bancadangan+
					
					'&bunyi='+bunyi+
					'&sumberbunyi='+sumberbunyi+
					'&volumebunyi='+volumebunyi+
					'&karakterbunyi='+karakterbunyi+
					'&intensitasbunyi='+intensitasbunyi+
					'&waktubunyi='+waktu_bunyi+
					'&waktukejadian='+waktukejadian+
					'&kondisipengendaraan='+kondisipengendaraan+
					'&kondisijalan='+kondisijalan
					,
			success : function(data){
				console.log(battery);
				$('#tampiltambahdata').slideUp(3000);
				$('#tambahdata').fadeIn(1000);
				$('#tampildata').fadeIn(1000);
				var canvas = document.getElementById("myCanvas");
				var dataURL = canvas.toDataURL("image/png");
			//	document.getElementById('hidden_data').value = dataURL;
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
				xhr.send(fd);
				
			}	
		})
		
		
		}
	}
	
	
	
	function transmission(){
		
		var transmission = $('#transmisi_mobil').val();
		if(transmission != ''){
		//	$('#transmisi_' + transmission ).show();
			if(transmission == 'mt'){
				$('#transmisi_mt').show();
				$('#transmisi_at').hide();
				$('#transmisi_cvt').hide();
			}else if(transmission == 'at'){
				$('#transmisi_mt').hide();
				$('#transmisi_at').show();
				$('#transmisi_cvt').hide();
			}else if(transmission == 'cvt'){
				$('#transmisi_mt').hide();
				$('#transmisi_at').hide();
				$('#transmisi_cvt').show();
			}else{
				$('#transmisi_mt').hide();
				$('#transmisi_at').hide();
				$('#transmisi_cvt').hide();
			}
			
			
		}
	}

</script>        

<?php
///	if(count($_POST)){
		include "../../../config/koneksi_service.php";
		date_default_timezone_set('Asia/Jakarta');
			$today=date("ym");
			$query = "SELECT max(no_pemeriksaan) as last FROM pemeriksaan_kendaraan WHERE no_pemeriksaan LIKE 'NP$today%'";
		//	$query = "SELECT max(no_pemeriksaan) as last FROM pemeriksaan_kendaraan";
			$hasil = mysql_query($query, $koneksi_service);
			$data  = mysql_fetch_array($hasil);
			$lastNoTransaksi = $data['last'];
			$lastNoUrut = substr($lastNoTransaksi, 6, 4);
			$nextNoUrut = $lastNoUrut + 1;
			$nextNoTransaksi = "NP".$today.sprintf('%04s', $nextNoUrut);				

			
//	}
?>
                 
<form role="form" id="form" name="form1" enctype="multipart/form-data" method="post" action="modul/Aksesoris/simpan_buat_permohonan.php" onsubmit="return cek_inputan()">
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
								<input class="form-control" type="text" style="text-transform:uppercase" value = "<?php echo $nextNoTransaksi; ?>" onblur="this.value=this.value.toUpperCase(); $('#src').click();" placeholder="" class="form-control" id="nopemeriksaan" name="nopemeriksaan" required readonly>
							
						</div>
					</div>	
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label">
								Tgl Datang <span class="symbol required"></span>
							</label>
							<p class="input-group input-append datepicker date " data-date-format="dd-mm-yyyy" data-provide="datepicker">
								<input class="form-control" id="tanggal" readonly="" name="tanggal" value="<?php echo date("d-m-Y"); ?>" required="" type="text">
								<span class="input-group-btn">
									<button type="button" class="btn btn-default">
										<i class="glyphicon glyphicon-calendar"></i>
									</button> </span>
							</p>
						</div>
					</div>
					<div class="col-md-2">												  
						<div class="form-group">
							<label class="control-label">
								No Polisi <span class="symbol required"></span>
							</label>
							<div class="input-group">
								<input class="form-control" type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase(); $('#src').click();" placeholder="B-199-PP" class="form-control" id="nopolisi" name="nopolisi" required >
								<span class="input-group-btn">
									<button type="button" id="src" class="btn btn-primary">
										<i class="fa fa-check"></i>
									</button>
								</span>
							</div>
						</div>
					</div>	
					<div class="col-md-2">
						<div class="form-group">
								<label for="form-field-select-2">
									Model <span class="symbol required"></span>
								</label>
								<div class="input-group">																	
									<input type="text"  class="form-control" value="" id="model" name="model" readonly required >
									<span class="input-group-btn">
										<button type="button" id="tampil_tipe" class="btn btn-primary">
											<i class="fa fa-search"></i>
										</button>
									</span>
								</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="form-field-select-2">
								Transmisi <span class="symbol required"></span>
							</label>
							
								<select id="transmisi_mobil" name = "transmisi_mobil" class = "form-control" onchange = 'transmission();'>
									<option value="" selected>Pilih Transmisi</option>
									<option value="mt">MT</option>
									<option value="at">AT</option>
									<option value="cvt">CVT</option>
								</select>
								
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label">
									Tahun <span class="symbol required"></span>
								</label>
								<input type="text"  class="form-control" value="" id="tahunbuat" name="tahunbuat" required  />
						
							
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label">
									Odometer <span class="symbol required"></span>
								</label>
								<input type="text"  class="form-control" value="" id="odmeter" name="odmeter" required onkeypress="return hanyaAngka(event)" onFocus="startCalc();" onBlur="stopCalc();" onkeyup="this.value=format_angka(this.value);"  />
								
						
							
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label">
								PIC Appearance Check<span class="symbol required"></span>
							</label>
							<input type="text"  class="form-control" value="<?php echo strtoupper($_SESSION['username']); ?>" id="pic" name="pic" required  readonly />
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label">
								Pelanggan <span class="symbol required"></span>
							</label>
							<input type="text"  class="form-control" value="" id="customer" name="customer" required   />
						</div>
					</div>
				</div>	
			</fieldset>
			
			
			
		</div>
		<div class="col-md-6">
			<fieldset>
				<legend>Kelengkapan</legend>
				<?php  
					$kelengkapan = array("STNK","Buku Service","Tool Set","Dongkrak","Dop Roda","Ban Cadangan");
				?>
				
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
							<tbody>
								<tr><th width="5%">KELENGKAPAN</th><th width="1%">CHECK</th><th width="30%">KONDISI</th></tr>
								
									<?php 
										$no = 0;
										foreach($kelengkapan as $data){
											$no++;
											
											echo "<tr><td>$data</td>";
									?>
											
											<td><div class="checkbox clip-check check-primary checkbox-inline" style="line-height: 10px;">
														<!--input id="<?php echo "$data$no" ?>" value="Y" name="<?php echo "status$no" ?>" type="checkbox"  -->
														<input id="<?php echo "status$no" ?>" value="Y" name="<?php echo "status$no" ?>" type="checkbox"  >
														<label for="<?php echo "status$no" ?>">
															
														</label>
													</div>
											</td>
											<td><input type = "text" class="form-control" name="<?php echo "kondisi$no" ?>" id="<?php echo "kondisi$no" ?>" /></td>
											</tr>
									<?php } ?>
								
								
							</tbody>
						</table>
					</div>	
			</fieldset>
		</div>
		<div class="col-md-6">
			<fieldset>
				<legend>Battery</legend>
				<div class="radio clip-radio radio-primary radio-inline">
					<input id="radio7" name="radio10" value="G" type="radio">
					<label for="radio7">
						Good
					</label>
				</div>
				<div class="radio clip-radio radio-warning radio-inline">
					<input id="radio9" name="radio10" value="GR"  type="radio">
					<label for="radio9">
						Good & Recharge
					</label>
				</div>
				<div class="radio clip-radio radio-danger radio-inline">
					<input id="radio10" name="radio10" value="BR"  type="radio">
					<label for="radio10">
						Bad & Replace
					</label>
				</div>
			</fieldset>
			
			<?php $sisi = array("depan","belakang") ;
				$no_sisi = 0;
				foreach($sisi as $data_sisi){
					$no_sisi = 0;
					
			
			?>
			<fieldset>
				<legend>
					<?php 
						if($data_sisi == "depan"){
							echo "Ban Depan";
						}else{
							echo "Ban Belakang"; 
						}						
					?>
				</legend>
				<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
						<tbody>
						<tr><th width="5%">SISI</th><th width="3%">TEBAL</th><th width="10%">KONDISI</th><th width="10%">KETERANGAN</th></tr>
						<?php $belakang = array("KIRI","KANAN"); 
							$no = 0;
							foreach($belakang as $data){
								$no ++;
								echo "<tr><td>
									$data
								</td>";
								
						?>
							<td>
								<input type = "text" size="2" style="height:34px;" name="<?php echo "tebal$data_sisi$data" ?>" id="<?php echo "tebal$data_sisi$data" ?>" /> mm
							</td>
							<td>
								<div class="radio clip-radio radio-primary radio-inline">
									<input id="<?php echo "baik$data_sisi$data"; ?>" name="<?php echo "kondisi$data_sisi$data"; ?>" value="BAIK"  type="radio">
									<label for="<?php echo "baik$data_sisi$data"; ?>">
										Baik
									</label>
								</div>
								<div class="radio clip-radio radio-danger radio-inline">
									<input id="<?php echo "tidak$data_sisi$data"; ?>" name="<?php echo "kondisi$data_sisi$data"; ?>" value="TIDAK BAIK"  type="radio">
									<label for="<?php echo "tidak$data_sisi$data"; ?>">
										Tidak
									</label>
								</div>
							</td>
							<td>
								<input type = "text" class="form-control" name="<?php echo "keterangan$data_sisi$data" ?>" id="<?php echo "keterangan$data_sisi$data" ?>" />
							</td>
						</tr>
						
							<?php } ?>
						</tbody>
				</table>
				</div>
			</fieldset>
				<?php } ?>
		</div>
		
	
	</div>
		
		
	
		
		<div class="row center">
		<div class="col-md-12" id = 'type_mbl' style = "display:none;">
			<fieldset>
				<legend id = "model_mobil"></legend>
					<div align="center">
						<div class="table-responsive">
							<canvas id="myCanvas" width="1006" height="318" style="border:2px solid black"></canvas>
						
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
								<!--option value="black">black</option-->
								<option value="blue" selected="selected">Biru (Lain-lain)</option>
								<option value="red">Merah (Body Penyok)</option>
								<!--option value="green">green</option-->
								<!--option value="yellow">yellow</option-->
								<option value="gray">Abu-abu (Cat tergores)</option>
							</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<button onclick="javascript:cUndo();return false;">Undo</button>
							<button onclick="javascript:cRedo();return false;">Redo</button>
							<!--div>
								<input type="button" onclick="uploadEx()" value="Upload" />
							</div-->
							<input name="hidden_data" value = "" id='hidden_data' type="hidden"/>
							<textarea name="base_64" value = "" id='base_64' hidden></textarea>
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
			
			<!--div class="col-md-12" id = 'type_sedan'>
				<fieldset>
					<legend>Type SUV, MPV dan Hatchback</legend>
						<div align="center">
							<canvas id="myCanvas" width="1000" height="318" style="border:2px solid black"></canvas>
							<br /><br />
							<button onclick="javascript:drawImageSuv();return false;">Clear Area</button>
							Line width : <select id="selWidth">
								<option value="1">1</option>
								<option value="3">3</option>
								<option value="5">5</option>
								<option value="7">7</option>
								<option value="9" selected="selected">9</option>
								<option value="11">11</option>
							</select> 
							Color : <select id="selColor">
								<option value="black">black</option>
								<option value="blue" selected="selected">blue</option>
								<option value="red">red</option>
								<option value="green">green</option>
								<option value="yellow">yellow</option>
								<option value="gray">gray</option>
							</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<button onclick="javascript:cUndo();return false;">Undo</button>
							<button onclick="javascript:cRedo();return false;">Redo</button>
							<div>
								<input type="button" onclick="uploadEx()" value="Upload" />
							</div>
								<input name="hidden_data" id='hidden_data' type="hidden"/>
						</div>
				</fieldset>	
			</div-->
		</div>
	
		<div class="row">
			<div class="col-md-12">
				<img id="sig-image" src="" alt = "">
			</div>
		</div>
		
		
		
		
	
	<div class="row">											
		<div class="col-md-6">
			<fieldset>
				<legend>Keluhan</legend>
					<div class="form-group">
						<div class="note-editor">
							<textarea class="form-control" id="keluhan" name="keluhan"></textarea>
						</div>
					</div>
			</fieldset>
			
		</div>
		<div class="col-md-6">
			<fieldset>
				<legend>Catatan</legend>
				<div class="form-group">
					<div class="note-editor">
						<textarea class="form-control" id="catatan" name="catatan"></textarea>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	
	<div class="row">											
		<div class="col-md-12">
			<fieldset>
				<legend>Bunyi Bunyi</legend>
				<div class="col-md-6">
					<div class="form-group">
						<label>
							1. Bagaimana bunyinya (bunyi) ?
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<input class="form-control" type="text" style="text-transform:uppercase"  placeholder="" class="form-control" id="bunyi" name="bunyi" required >
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>
							2. Bunyi tersebut terdengar dari mana (bunyi) ?
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<input class="form-control" type="text" style="text-transform:uppercase" placeholder="" class="form-control" id="sumberbunyi" name="sumberbunyi" required > 
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>
							3. Seberapa besar bunyinya (bunyi) ?
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<select id="volumebunyi" name = "volumebunyi" class = "form-control">
							<option value="" selected disabled></option>
							<option value="samar-samar">samar-samar</option>
							<option value="Jelas">Jelas</option>
							<option value="Keras">Keras</option>
						</select> 
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>
							4. Bagaimana karakter bunyinya (bunyi) ?
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<select id="karakterbunyi" name = "karakterbunyi" class = "form-control">
							<option value="" selected disabled></option>
							<option value="terus-menerus">terus-menerus</option>
							<option value="sekali-sekali">sekali-sekali</option>
							<option value="sekali saja">sekali saja</option>
						</select> 
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>
							5. Seberapa sering problem tersebut muncul (bunyi) ?
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<select id="intensitasbunyi" name = "intensitasbunyi" class = "form-control">
							<option value="" selected disabled></option>
							<option value="terus-menerus">terus-menerus</option>
							<option value="sekali-sekali">sekali-sekali</option>
							<option value="sekali saja">sekali saja</option>
						</select> 
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>
							6. Sejak kapan problem tersebut muncul (bunyi) ?
						</label>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="form-group">
						<input class="form-control" type="number" placeholder="" class="form-control" id="waktubunyi" name="waktubunyi" required > 
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<select id="waktubunyi2" name = "waktubunyi2" class = "form-control">
							<option value="" selected disabled></option>
							<option value="hari yang lalu">hari yang lalu</option>
							<option value="minggu yang lalu">minggu yang lalu</option>
							<option value="bulan yang lalu">bulan yang lalu</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>
							7. Waktu kejadian pada saat kondisi :
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<?php
						$waktu_kejadian = array("Start", "Idle", "Pagi", "Mesin panas", "Mesin dingin", "Siang", "A/C On", "A/C Off", "Malam");
						$waktu_kejadian_id = array("start", "idle", "pagi", "mesin_panas", "mesin_dingin", "siang", "ac_on", "ac_off", "malam");
						$no = -1;
						foreach($waktu_kejadian as $data_waktu_kejadian){
							$no ++;
					?>
					<div class="col-md-4">
						<div class="form-group">
							<div class="checkbox clip-check check-primary checkbox-inline" style="line-height: 10px;">
								<input id="<?php echo "$waktu_kejadian_id[$no]" ?>" value="Y" name="<?php echo "status$no" ?>" type="checkbox"  >
								<label for="<?php echo "$waktu_kejadian_id[$no]" ?>">
									<?php echo $data_waktu_kejadian ?>
								</label>
							</div>
						</div>
					</div>
					<?php
						}
					?>
					
					<div class="col-md-4">
						<div class="form-group">
							<input id="<?php echo "menit_dinyalakan" ?>"  class="form-control" name="<?php echo "menit_dinyalakan" ?>" type="number"  >
							<label for="<?php echo "menit_dinyalakan" ?>">
								Menit Setelah dinyalakan
							</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input id="<?php echo "km_dinyalakan" ?>" class="form-control" name="<?php echo "km_dinyalakan" ?>" type="number"  >
							<label for="<?php echo "km_dinyalakan" ?>">
								KM Setelah Pengendaraan
							</label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>
							8. Kondisi pengendaraan saat timbul problem :
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<?php
						$kondisi_pengendaraan = array("lurus", "belok kiri", "belok kanan");
						$kondisi_pengendaraan_id = array("lurus", "belokkiri", "belokkanan");
					//	foreach($kondisi_pengendaraan_id as $data_kondisi_pengendaraan){
					?>
						<div class="col-md-4">
							<div class="form-group">
								<div class="checkbox clip-check check-primary checkbox-inline" style="line-height: 10px;">
									<input id="<?php echo "lurus" ?>" value="Y" name="<?php echo "lurus" ?>" type="checkbox"  >
									<label for="<?php echo "lurus" ?>">
										Lurus
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="checkbox clip-check check-primary checkbox-inline" style="line-height: 10px;">
									<input id="<?php echo "belok_kiri" ?>" value="Y" name="<?php echo "belok_kiri" ?>" type="checkbox"  >
									<label for="<?php echo "belok_kiri" ?>">
										Belok Kiri
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="checkbox clip-check check-primary checkbox-inline" style="line-height: 10px;">
									<input id="<?php echo "belok_kanan" ?>" value="Y" name="<?php echo "belok_kanan" ?>" type="checkbox"  >
									<label for="<?php echo "belok_kanan" ?>">
										Belok Kanan
									</label>
								</div>
							</div>
						</div>
					<?php
					//	}
					?>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>
							9. Kondisi jalan yang menyebabkan timbulnya problem :
						</label>
					</div>
				</div>
				<div class="col-md-6">
				<?php
					$kondisi_jalan = array("tanjakan", "datar", "turunan", "aspal", "beton", "tanah", "gelombang", "halus", "kasar");
					
					foreach($kondisi_jalan as $data_kondisi_jalan){
				?>
					<div class="col-md-4">
						<div class="form-group">
							<div class="checkbox clip-check check-primary checkbox-inline" style="line-height: 10px;">
								<input id="<?php echo "$data_kondisi_jalan" ?>" value="Y" name="<?php echo "$data_kondisi_jalan" ?>" type="checkbox"  >
								<label for="<?php echo "$data_kondisi_jalan" ?>">
									<?php echo $data_kondisi_jalan ?>
								</label>
							</div>
						</div>
					</div>
				<?php
					}
				?>
					
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>
							10. Waktu kejadian pada saat putaran mesin (rpm) :
						</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<div class="form-group">
							<input class="form-control" type="text" placeholder="" class="form-control" id="rpm" name="rpm" required >
						</div>
					</div>
					
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<select id="transmisi_mt" name = "transmisi_mt" class = "form-control" style = "display:none;">
							<option value="" selected="selected">Transmisi</option>
							<option value="N">N</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="R">R</option>
						</select>
						
						<select id="transmisi_at" name = "transmisi_at" class = "form-control" style = "display:none;">
							<option value="" selected="selected">Transmisi</option>
							<option value="N">N</option>
							<option value="P">P</option>
							<option value="R">R</option>
							<option value="N">N</option>
							<option value="D4">D4</option>
							<option value="D3">D3</option>
							<option value="2">2</option>
							<option value="1">1</option>
						</select>
						
						<select id="transmisi_cvt" name = "transmisi_cvt" class = "form-control" style = "display:none;">
							<option value="" selected="selected">Transmisi</option>
							<option value="P">P</option>
							<option value="R">R</option>
							<option value="N">N</option>
							<option value="D">D</option>
							<option value="S">S</option>
							<option value="L">L</option>
						</select>
					</div>
				</div>
			</fieldset>
		</div>
			
		<div class="col-md-12">
			<fieldset>
				<legend>TTD Pelanggan</legend>
				<canvas id="myCanvas2" width="300" height="150" style="border:1px solid black"></canvas></br>
				<textarea name="ttd_base64" value = "" id='ttd_base64' hidden></textarea>
				<button onclick="javascript:drawImageTtd();return false;">Clear</button>
			</fieldset>
			
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


<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onblur="reload();" onpageshow="focus">
</div>
		
<?php  } ?>		
		
		
