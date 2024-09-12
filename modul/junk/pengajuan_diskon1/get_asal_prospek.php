

<?php 
 $id = $_POST['data_ajax'];
 
include '../../config/koneksi.php';
 
 //$query = mysql_unbuffered_query("select * from data_mobil where nopenjualan = '' and data_mobil.kode_model = '$id' group by kode_tipe");
 //echo "<option value = 'semua_tipe'>SEMUA TIPE</option>";
 //while ($r=mysql_fetch_assoc($query)){
 //   echo "<option value = '$r[kode_tipe]'>$r[kode_tipe] - $r[nama_tipe]</option>";   
 //}
 
 //echo "";
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
<?php } ?>
												