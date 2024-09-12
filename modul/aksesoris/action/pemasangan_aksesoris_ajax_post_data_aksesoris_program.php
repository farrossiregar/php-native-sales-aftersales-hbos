<?php 
if (isset($_POST['data_ajax'])){
	$id = addslashes($_POST['data_ajax']);

	include "../../../config/koneksi_sqlserver.php";
	
	
	$query = "select pma.nomor,pma.nomor_supplier,pma.TipeAcc,pma.kode_accessories,UA.nama as nama_accessories,gs.nama as nama_supplier from UntT_PesanMatchingAccessories PMA
				left join UntM_Accessories UA on UA.kode = PMA.kode_accessories
				left join GlbM_Supplier gs on gs.nomor = pma.nomor_supplier
			where PMA.nomor_pesanan = '$id' and tipeacc = 'program imora' and pma.batal = 0 
				
				 ";
				 
	
	
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$row = sqlsrv_query( $conn, $query , $params, $options );
	
	$row_count = sqlsrv_num_rows($row);		
	
	if ($row_count < 1 ){
		$query = "select '' as nomor,pma.nomor_supplier,pma.TipeAcc,pma.kode_accessories,UA.nama as nama_accessories,'' as nama_supplier from UntT_PesananAccessories PMA
				left join UntM_Accessories UA on UA.kode = PMA.kode_accessories
				left join GlbM_Supplier gs on gs.nomor = pma.nomor_supplier
			where PMA.nomor_pesanan = '$id' and tipeacc = 'program imora' ";
		
		
		
	}
	
	$query = sqlsrv_query($conn, $query);
	
	
	while($data = sqlsrv_fetch_array($query)){
	
		//$no_spk = $data['NomorSPK'];
		//$namacustomer = $data['NamaCustomer'];
		
?>

<div  style="margin-bottom:10px">
	<input type="hidden" name="kode_accs_md[]" value = "<?php echo $data['kode_accessories']; ?>" class="form-control" readonly>
	<input type="text" name="accs_md[]" value = "<?php echo $data['nama_accessories']; ?>" class="form-control" readonly>
	<input type="hidden" name="accs_bonus_notransaksi_md[]" value = "<?php echo $data['nomor']; ?>" class="form-control" readonly>
	<input type="hidden" name="accs_bonus_supplier_md[]" value = "<?php echo $data['nama_supplier']; ?>" class="form-control" readonly>
	<input type="text" name="accs_bonus_keterangan_md[]" value = "" placeholder="KETERANGAN" class="form-control" >
</div>
												 

<?php 		
		
		
	}
}
?>