<?php
	$data = $_POST['data'];
	if($data != ''){
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
							<div class="input-group">
								<input class="form-control" type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase(); $('#src').click();" placeholder="" class="form-control" id="nopemeriksaan" name="nopemeriksaan" required readonly>
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
									<input type="text"  class="form-control" value="" id="model" name="model" required >
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
							<div class="input-group">	
								<select id="transmisi_mobil" name = "transmisi_mobil" class = "form-control" onchange = 'transmission();'>
									<option value="" selected>Pilih Transmisi</option>
									<option value="mt">MT</option>
									<option value="at">AT</option>
									<option value="cvt">CVT</option>
								</select>
								<span class="input-group-btn">
									<button type="button" id="transmisi_mobil" class="btn btn-primary">
										<i class="fa fa-search"></i>
									</button>
								</span>
							</div>
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
								<!--input type="text"  class="form-control" value="" id="odmeter" name="odmeter" required onkeypress="return hanyaAngka(event)" onFocus="startCalc();" onBlur="stopCalc();" onkeyup="this.value=format_angka(this.value);"  /-->
								<input type="text"  class="form-control" value="" id="odmeter" name="odmeter" required   />
						
							
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
							<input type="text"  class="form-control" value="" id="customer" name="customer" required onkeypress="return hanyaAngka(event)" onFocus="startCalc();" onBlur="stopCalc();" onkeyup="this.value=format_angka(this.value);"  />
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
	<style>
		.bgtable {background-image: url(assets/type-sedan-samping.png); 
		background-repeat:no-repeat;
		background-size:520px;}
	</style>
	<div class="row center">
		<div class="col-md-12" id = 'type_sedan'>
			<fieldset>
				<legend>Type Sedan</legend>
					<div align="center">
						<canvas id="myCanvas" style="border:2px solid black"></canvas>
						<br /><br />
						<button onclick="javascript:drawImage();return false;">Clear Area</button>
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
						<input name="hidden_data" id='hidden_data' type="hidden"/>
					</div>
			</fieldset>	
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
								<label for="<?php echo "$waktu_kejadian[$no]" ?>">
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
					<div class="form-group">
						<select id="kondisi_pengendaraan" name = "kondisi_pengendaraan" class = "form-control">
							<option value="" selected="selected"></option>
							<option value="Lurus">Lurus</option>
							<option value="Belok Kiri">Belok Kiri</option>
							<option value="Belok Kanan">Belok Kanan</option>
						</select> 
					</div>
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
								<input id="<?php echo "$data_kondisi_jalan" ?>" value="<?php echo "$data_kondisi_jalan" ?>" name="<?php echo "$data_kondisi_jalan" ?>" type="checkbox"  >
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
			
	</div>
	<div class="row">											
		<div class="col-md-12">
			<button id="simpan" type="button" class="btn btn-wide btn-o btn-success" onclick = 'ubahPemeriksaan();'>
				Ubah
			</button>	
			<button id="batal" type="button" class="btn btn-wide btn-o btn-danger">
				Batal
			</button>	
		</div>
			
	</div>
</form>

<?php
	}
?>