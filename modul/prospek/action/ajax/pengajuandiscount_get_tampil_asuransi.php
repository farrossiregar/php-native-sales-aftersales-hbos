

<?php 
if (count($_POST)){
$id = $_POST['data_ajax'];
 

if ($id != "KREDIT"){
?>


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
	
	<div id="keterangan_asuransi" style="display : none;">
													
		<div class="form-group">
			<div class="panel-heading">
				<div class="panel-title">
					Keterangan Asuransi
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="note-editor">
						<textarea class="form-control" id="ket_asuransi" name="ket_asuransi"></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</fieldset>

<?php }
}?>
	
												