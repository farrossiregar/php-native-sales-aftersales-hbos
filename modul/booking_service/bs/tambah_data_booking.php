<?php
	include "koneksi.php";
	date_default_timezone_set('Asia/Jakarta');
		$today=date("ym");
		$query = "SELECT max(no_booking) as last FROM booking_service WHERE no_booking LIKE 'BS$today%'";
		$hasil = mysql_query($query);
		while($data  = mysql_fetch_array($hasil)){
		$lastNoTransaksi = $data['last'];
		$lastNoUrut = substr($lastNoTransaksi, 6, 3);
		$nextNoUrut = $lastNoUrut + 1;
		$nextNoTransaksi = "BS".$today.sprintf('%03s', $nextNoUrut);				

	//	echo $nextNoTransaksi;

?>
<script>
	function pilih_hari(){
		var tgl = $('#tgl_booking').val();
		var hari = tgl.substr(-3, 3);
		var tgl2 = tgl.substr(0, 10);
		$.ajax({
			method : "post",
			url : "modul/booking_service/get_hari.php",
			data : 'data='+hari+'&data1='+tgl2,
			success : function(data){
				$('#jam_booking').html(data);
			}
		})
	}
</script>

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
						<input id="no_booking" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="<?php echo $nextNoTransaksi ?>" name="no_booking" required readonly>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							Nama Customer
						</label>
						<input id="nama_cust" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="nama_cust" required >
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
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							Pilih Periode <span class="symbol required"></span>
						</label>
						<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd D'>
							<input class="form-control" type="text" id="tgl_booking" name="tgl_booking" onchange="pilih_hari();" onload = "pilih_hari();" value ="" readonly required >
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
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							No Polisi
						</label>
						<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="no_polisi" name="no_polisi" value="" required >
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							Tipe
						</label>
						<select name = "tipe" id="tipe" class = "form-control" >														
							<option value="semua_model" selected disabled>Cari Model</option>
							<?php 
								include "koneksi.php";
								date_default_timezone_set('Asia/Jakarta');
								
								$data = mysql_query("select nama_model from model");
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
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							No Rangka
						</label>
						<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="norangka" name="norangka" value="" required >
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">
							No Mesin
						</label>
						<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="nomesin" name="nomesin" value="" required >
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label">
					Perbaikan
				</label>
				<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="perbaikan" name="perbaikan" value="" required >
			</div>
			<div class="form-group">
				<label class="control-label">
					Keterangan <span class="symbol required"></span>
				</label>
				<div class="form-group">
					<div class="note-editor">
						<textarea class="form-control" id="keterangan" name="keterangan" required ></textarea>
					</div>
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

