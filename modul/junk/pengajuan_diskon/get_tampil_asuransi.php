

<?php 
 $id = $_POST['data_ajax'];
 

 
 //$query = mysql_unbuffered_query("select * from data_mobil where nopenjualan = '' and data_mobil.kode_model = '$id' group by kode_tipe");
 //echo "<option value = 'semua_tipe'>SEMUA TIPE</option>";
 //while ($r=mysql_fetch_assoc($query)){
 //   echo "<option value = '$r[kode_tipe]'>$r[kode_tipe] - $r[nama_tipe]</option>";   
 //}
 
 //echo "";
if ($id != "KREDIT"){
?>

<script>
	function cek_asu(){
		var ikut_asuransi = $('input[name=ikut_asuransi]:checked').val();
				
				if (ikut_asuransi == "Y"){
						$("#nama_asuransi").show();
						
					}else {
						$("#nama_asuransi").hide();
						document.getElementById("asuransi").selectedIndex = "0"; 
					}
		
	}

</script>
<fieldset id = "ikut_asuransi" onchange = "cek_asu();" >

	<legend>
	Asuransi
	</legend>
	
	<div class="radio clip-radio radio-primary radio-inline">
		<input type="radio" id="radio20"  name="ikut_asuransi" value="Y"  >
		<label for="radio20">
			Ya
		</label>
	</div>
	<div class="radio clip-radio radio-primary radio-inline">
		<input type="radio" id="radio21"  name="ikut_asuransi" value="N"  >
		<label for="radio21">
			Tidak
		</label>
	</div>
	
	
	<div class="form-group" style = "display : none;" id = "nama_asuransi" >
		<label for="form-field-select-2">
			Nama Asuransi <span class="symbol required"></span>
		</label>
		<select name="asuransi" id = "asuransi" class="form-control" >
		<option selected value=''>PILIH ASURANSI</option>
		<option value='ARTARINDO' >ARTARINDO</option>
		<option value='BESS' >BESS</option>
		
		</select>
	</div>

	
	</fieldset>

<?php }else {?>


<?php }?>
	
												