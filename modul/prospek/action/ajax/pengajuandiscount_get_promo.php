

<?php 
if (count($_POST)){
$id = $_POST['data_ajax'];
 

if ($id == "Tidak Ikut Program"){
?>
<div id = "id_metodebyr_2" >
<fieldset >
	<legend>
		Metode Pembayaran
	</legend>
	
	<div class="radio clip-radio radio-primary radio-inline">
		<input type="radio" id="radio1" class="metodebayar" name="cara_beli" value="TUNAI" onclick="removereadonly();tampil_leasing();" >
		<label for="radio1">
			Tunai
		</label>
	</div>
	<div class="radio clip-radio radio-primary radio-inline">
		<input type="radio" id="radio2" class="metodebayar" name="cara_beli" value="KREDIT" onclick="addreadonly();tampil_leasing();" >
		<label for="radio2">
			Kredit
		</label>
	</div>
	<div class="radio clip-radio radio-primary radio-inline">
		<input type="radio" id="radio3" class="metodebayar" name="cara_beli" value="COP" onclick="removereadonly();tampil_leasing();" >
		<label for="radio3">
			COP
		</label>
	</div>
	<div class="radio clip-radio radio-primary radio-inline">
		<input type="radio" id="radio4" class="metodebayar" name="cara_beli" value="GSO" onclick="removereadonly();tampil_leasing();">
		<label for="radio4">
			GSO
		</label>
	</div>
	
	<div class="form-group" id = "id_leasing" style = "display:none;" >
		<label for="form-field-select-2">
			Nama leasing <span class="symbol required"></span>
		</label>
		<select name='leasing' id='leasing' class='form-control' onchange = "hitung_refund();" >
			<option selected value=''>PILIH LEASING</option>
			<option value='MBF'  >MBF</option>
			<option value='MTF' >MTF</option>
			<option value='OTO MULTIARTHA' >OTO MULTIARTHA</option>
			<option value='MY BANK' >MAYBANK</option>
			<option value='(KPM) MANDIRI' >KPM MANDIRI</option>
			<option value='(KKB) MAYBANK' >KKB MAYBANK</option>
			<option value='(KKB) BCA' >KKB BCA</option>
			<option value='BCA FINANCE' >BCA FINANCE</option>
			<option value='MAF' >MAF</option>
			<option value="CLIPAN">CLIPAN</option>
		</select>
	</div>
	<div class="form-group" id="id_tenor" style = "display:none;" >
		<label for="form-field-select-2">
			Tenor <span class="symbol required"></span>
		</label>
		<select name='tenor' id='tenor' class='form-control' onchange = "hitung_refund();" >
		<option selected value=''>PILIH TENOR</option>
		<option value='1tahun' >1 TAHUN</option>
		<option value='2tahun' >2 TAHUN</option>
		<option value='3tahun' >3 TAHUN</option>
		<option value='4tahun' >4 TAHUN</option>
		<option value='5tahun' >5 TAHUN</option>
		<option value='6tahun' >6 TAHUN</option>
		</select>
	</div>
	
</fieldset>	
	</div>
<?php } 
//	if ($id == "BCA KOMBINASI"){ 
	if ($id == "MTF KOMBINASI"){
?>
<div id = "id_metodebyr_2">
<fieldset>
	<legend>
		Metode Pembayaran
	</legend>
	<div class="radio clip-radio radio-primary radio-inline">
		<input type="radio" id="radio2" class="metodebayar" name="cara_beli" value="KREDIT" checked onclick="addreadonly();" >
		<label for="radio2">
			Kredit
		</label>
	</div>
	
	<div class="form-group">
		<label for="form-field-select-2" >
			Nama leasing <span class="symbol required"></span>
		</label>
		<select name='leasing' id='leasing' class='form-control' onchange = "hitung_refund();" >
		
		<option value='MTF' selected >MTF</option>
		
		</select>
	</div>
	<div class="form-group" >
		<label for="form-field-select-2">
			Tenor <span class="symbol required"></span>
		</label>
		<select name='tenor' id='tenor' class='form-control' onchange = "hitung_refund();" >
		<option selected value=''>PILIH TENOR</option>
		<option value='1tahun' >1 TAHUN</option>
		<option value='2tahun' >2 TAHUN</option>
		<option value='3tahun' >3 TAHUN</option>
		<option value='4tahun' >4 TAHUN</option>
		<option value='5tahun' >5 TAHUN</option>
		<option value='6tahun' >6 TAHUN</option>
		</select>
	</div>	
	
</fieldset>
</div>
<?php }
}?>
	
												