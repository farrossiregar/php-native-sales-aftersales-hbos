

<?php 
 $id = $_POST['data_ajax'];
 
include '../../config/koneksi.php';
 
 //$query = mysql_unbuffered_query("select * from data_mobil where nopenjualan = '' and data_mobil.kode_model = '$id' group by kode_tipe");
 //echo "<option value = 'semua_tipe'>SEMUA TIPE</option>";
 //while ($r=mysql_fetch_assoc($query)){
 //   echo "<option value = '$r[kode_tipe]'>$r[kode_tipe] - $r[nama_tipe]</option>";   
 //}
 
 //echo "";
if ($id == "KREDIT"){
?>
<fieldset id="id_metodebyr2" style="display:none;">
	<legend>
		Metode Pembayaran
	</legend>
	
	
	<div class="radio clip-radio radio-primary radio-inline">
		<input type="radio" id="radio12" class="metodebayar" name="cara_beli3" value="KREDIT" onclick="addreadonly();" checked >
		<label for="radio12">
			Kredit
		</label>
	</div>
	
</fieldset>
<div class="form-group" id="id_leasing2" style="display:none;">
	<label for="form-field-select-2">
		Nama leasing  <span class="symbol required"></span>
	</label>
	<!--input type="text" disabled name='leasing3' id='leasing3' class='form-control' onchange = "hitung_refund();" -->	
	<select  name='leasing' id='leasing3' class='form-control' onchange = "hitung_refund();" >
		<option selected value=" " >MTF</option>
	</select>
</div>

<?php }?>
	
												