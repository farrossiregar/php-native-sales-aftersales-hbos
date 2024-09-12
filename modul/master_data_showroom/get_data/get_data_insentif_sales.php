<?php
	
	include "../../../config/koneksi_sqlserver.php";
	include "../../../config/koneksi_service.php";
	$spv = $_POST['data_ajax'];
		
		
		$query3 = ("select * ,substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,
		convert(varchar,tglappfakpol,105) as tgl_faktur,
		convert(varchar,tgl_spk,105) as tgl_spk 
		from vw_Insentifsos where substring(convert(varchar,tglappfakpol,105),4,7) ='04-2018' and kode_supervisor ='SUDI' and nama_sales='HALIMATUS SADIYAH'");
		
		$result = sqlsrv_query($conn, $query3);
		$nomor = 0;
		while($data_faktur = sqlsrv_fetch_array($result)){
		$nomor += 1; 
?>
				<div class="col-md-12">
											
				<div class="errorHandler alert alert-danger no-display">
					<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
				</div>
				<div class="successHandler alert alert-success no-display">
					<i class="fa fa-ok"></i> Your form validation is successful!
				</div>
			</div>
			
			<div class="col-md-2">
				<label class="control-label">
						Nama Mobil <span class="symbol required"></span>
				</label>
				<input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'nama_mobil'.$nomor; ?>" value="<?php echo trim($data_faktur['nama_mobil']); ?>" readonly required>
			</div>
			<div class="col-md-2">
				<label class="control-label">
						Point <span class="symbol required"></span>
				</label>
				<input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'point'.$nomor; ?>" value="<?php echo trim($data_faktur['point']); ?>" readonly required>
			</div>
			<div class="col-md-2">
				<label class="control-label">
						Kode <span class="symbol required"></span>
				</label>
				<input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'kode'.$nomor; ?>" value="<?php echo trim($data_faktur['kode_model']); ?>" readonly required>
			</div>
			<div class="col-md-2">
				<label class="control-label">
						Nomor Spk <span class="symbol required"></span>
				</label>
				<input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'no_spk'.$nomor; ?>" value="<?php echo trim($data_faktur['nomor']); ?>" readonly required>
			</div>
			
			<div class="col-md-2">
				<label class="control-label">
					Nama Sales <span class="symbol required"></span>
				</label>
				
				<input type="text" style="text-transform:uppercase" class="form-control"  name="<?php echo 'nama_sales'.$nomor; ?>" value="<?php echo trim($data_faktur['nama_sales']); ?>" readonly required>
			</div>
			<div class="col-md-2">
				<label class="control-label">
					Kode Spv <span class="symbol required"></span>
				</label>
				
				<input type="text" style="text-transform:uppercase" class="form-control"  name="<?php echo 'kode_supervisor'.$nomor; ?>" value="<?php echo trim($data_faktur['kode_supervisor']); ?>" readonly required>
			</div>
			<div class="col-md-2">
				<label class="control-label">
					Tgl Faktur <span class="symbol required"></span>
				</label>
				
				<input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'tgl_faktur'.$nomor; ?>" value="<?php echo trim($data_faktur['tgl_faktur']); ?>" readonly required>
			</div>
			<div class="col-md-2">
				<label class="control-label">
						Price List <span class="symbol required"></span>
				</label>
				<input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'price_list'.$nomor; ?>" value="<?php echo trim($data_faktur['hargatotal']); ?>" readonly required>
			</div>
			<div class="col-md-2">
				<label class="control-label">
						Discount <span class="symbol required"></span>
				</label>
				<input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'discount'.$nomor; ?>" value="<?php echo trim($data_faktur['discount']); ?>" readonly required>
			</div>
			<div class="col-md-2">
				<label class="control-label">
						Acc <span class="symbol required"></span>
				</label>
				<input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'acc'.$nomor; ?>" value="<?php echo trim($data_faktur['discaccs']); ?>" readonly required>
			</div>
			<div class="col-md-2">
				<label class="control-label">
						Plafon <span class="symbol required"></span>
				</label>
				<input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'plafon'.$nomor; ?>" value="<?php echo trim($data_faktur['plafon']); ?>" readonly required>
			</div>
		
<?php
}
?>