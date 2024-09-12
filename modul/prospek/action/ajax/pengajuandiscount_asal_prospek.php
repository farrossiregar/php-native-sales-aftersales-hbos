

<?php 
if (count($_POST)){
$id = $_POST['data_ajax'];
 

if ($id=="EVENT"){
?>

	<div class="form-group">
		<label for="form-field-select-2">
			Lokasi Event <span class="symbol required"></span>
		</label>
		<select name = "ket_asal_prospek" class = "form-control"  >														
				<option value="" selected disabled>PILIH LOKASI</option>
				<option value="SHOWROOM EVENT">SHOWROOM EVENT</option>
				<option value="JONEX">JONEX</option>
				<option value="LAIN-LAIN">LAIN-LAIN</option>
		</select>
	</div>
	
<?php }if ($id == "MOVING"){ ?>
	<div class="form-group">
		<label class="control-label">
			Lokasi Moving <span class="symbol required"></span>
		</label>
		<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="ISI DENGAN LOKASI MOVING" class="form-control" name="ket_asal_prospek" >
	</div>

<?php }if ($id == "PAMERAN"){ ?>
	<div class="form-group">
		<label for="form-field-select-2">
			Lokasi Pameran <span class="symbol required"></span>
		</label>
		<select name = "ket_asal_prospek" class = "form-control"  >														
				<option value="" selected disabled>PILIH LOKASI</option>
				<option value="BINTARO EXCHANGE">BINTARO EXCHANGE</option>
				<option value="CBD CILEDUG">CBD CILEDUG</option>
				<option value="GIANT BINTARO">GIAN BINTARO</option>
				<option value="HARMONY SWALAYAN">HARMONY SWALAYAN</option>
		</select>
	</div>
<?php } 

}?>
												