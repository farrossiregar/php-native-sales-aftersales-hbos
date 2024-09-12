

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
<div class="form-group" >
	<label for="form-field-select-2" >
		Nama leasing <span class="symbol required"></span>
	</label>
	<select name='leasing' id='leasing' class='form-control' onchange = "hitung_refund();" >
	<option selected value=''>PILIH LEASING</option>
	<option value='MBF'>MBF</option>
	<option value='MTF'>MTF</option>
	<option value='OTO MULTIARTHA' >OTO MULTIARTHA</option>
	<option value='MY BANK' >MAYBANK</option>
	<option value='(KPM) MANDIRI'>KPM MANDIRI</option>
	<option value='(KKB) MAYBANK'>KKB MAYBANK</option>
	<option value='(KKB) BCA'>KKB BCA</option>
	<option value='BCA FINANCE'>BCA FINANCE</option>
	<option value='MAF'>MAF</option>
	<option value="CLIPAN">CLIPAN</option>
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

<?php }?>
	
												