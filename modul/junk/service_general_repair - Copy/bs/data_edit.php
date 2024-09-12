<?php
	include "koneksi.php";
	
	$no_bs = $_POST['data'];
	$tanggal = $_POST['data2'];

		$query = mysql_query("SELECT * FROM booking_service where no = '$no_bs'");

						
		while($r = mysql_fetch_array($query)){
				$no_booking = $r['no_booking'];
				$nama = $r['nama_customer'];
				$jam_booking = $r['jam_booking'];
				$waktu_booking = $r['waktu_booking'];
				$no_polisi = $r['no_polisi'];
				$tipe = $r['tipe'];
				$telepon = $r['telepon'];
				$perbaikan = $r['perbaikan'];
				$keterangan = $r['keterangan'];
				$kedatangan = $r['kedatangan'];
				$jam_datang = $r['jam_datang'];
				$reschedule = $r['reschedule'];
				$ket_tidak_datang = $r['ket_kedatangan'];
				$user = $r['user_input'];
				$input = $r['waktu_input'];
		
	//	echo $no_booking.",".$nama.",".$jam_booking.",".$waktu_booking.",".$no_polisi.",".$tipe.",".$telepon.",".$perbaikan.",".$keterangan.",".$kedatangan.",".$jam_datang.",".$reschedule.",".$ket_tidak_datang.",".$user.",".$input;

	
?>
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
						<input id="no_booking" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="<?php echo $no_booking ?>" name="no_booking" required readonly>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							Nama Customer
						</label>
						<input id="nama_cust" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="<?php echo $nama ?>" name="nama_cust" required readonly>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							Telepon
						</label>
						<input type="text"  class="form-control" id="telepon" name="telepon" value="<?php echo $telepon ?>" required readonly>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							Pilih Periode <span class="symbol required"></span>
						</label>
						<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd D'>
							<input class="form-control" type="text" id="tgl_booking" name="tgl_booking" onchange="pilih_hari();" onload = "pilih_hari();" value ="<?php echo $waktu_booking ?>" readonly required >
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
							<!--select name = "jam" id="jam_booking" class = "form-control" style="">														
								<option value="semua_model" selected disabled>PILIH JAM</option>
								
							</select-->
							<input class="form-control" type="text" id="jam_booking" name="jam" value ="<?php echo $jam_booking ?>" readonly required >
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							No Polisi
						</label>
						<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="no_polisi" name="no_polisi" value="<?php echo $no_polisi ?>" required readonly>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							Tipe
						</label>
						<!--select name = "tipe" id="tipe" class = "form-control" >														
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
						</select-->
						<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="tipe" name="tipe" value="<?php echo $tipe ?>" required readonly>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							No Rangka
						</label>
						<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="norangka" name="norangka" value="" required readonly>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							No Mesin
						</label>
						<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="nomesin" name="nomesin" value="" required readonly>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label">
					Perbaikan
				</label>
				<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="perbaikan" name="perbaikan" value="<?php echo $perbaikan ?>" required readonly>
			</div>
			<div class="form-group">
				<label class="control-label">
					Keterangan <span class="symbol required"></span>
				</label>
				<div class="form-group">
					<div class="note-editor">
						<textarea class="form-control" id="keterangan" name="keterangan" required readonly><?php echo $keterangan ?></textarea>
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
							<div class = "col-md-6" id = 'datang' style="display: none;">
								<div class="form-group">
									<label class="control-label">
										Jam Datang <span class="symbol required"></span>
									</label>
									<div class="input-group bootstrap-timepicker col-md-12" >
									  <input type="text" class="form-control" name="jam" id="datetimepicker2" data-date-format='HH:mm:ss'  />
									  <span class="input-group-addon"><i class="glyphicon glyphicon-time" id="datetimepicker2"></i></span>
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
			<!--button class="btn btn-primary btn-wide" type="button" id="bn" name="bn" onClick="simpan();">
				<span class="ladda-label"><i class="fa fa-save"></i> Simpan</span>
			</button-->
			
			<button type = "button" id="upd" name="upd" class="btn btn-primary btn-wide" data-style="expand-right" style="display:none;">
				<span class="ladda-label"><i class="fa fa-mail-save"></i> Update </span>
			</button>
			
			<!--button type = "button" id="upd2" name="upd2" class="btn btn-primary btn-wide" data-style="expand-right" style="display:none;">
				<span class="ladda-label"><i class="fa fa-mail-save"></i> Reschedule</span>
			</button-->
			
			<button type = "button" id="keluar" class="btn btn-wide btn-danger ladda-button" data-style="expand-right"  onclick='exit_modal();'>
				<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
			</button>
			<br>
			<br>
		</div>
	</div>
</form>


<?php
		}
?>

