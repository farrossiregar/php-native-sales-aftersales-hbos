<?php 
	$id = $_POST['data_ajax'];

	include "../../config/koneksi_sqlserver.php";
	
	
	$query = "select SPK.* from vw_PukSOS SPK
				

				 where SPK.NoBSTK = '-' and NomorSPK = '$id'";
	$query = sqlsrv_query($conn, $query);
	while($data = sqlsrv_fetch_array($query)){
	
		$no_spk = $data['NomorSPK'];
		$namacustomer = $data['NamaCustomer'];
		
		
		
		echo $no_spk."--".$namacustomer."--".$data['NamaTipe']."--".$data['NamaWarna']."--".$data['JenisPenjualan'].
		"--".$data['NoRangka']."--".$data['NoMesin']."--".$data['lamaangsuran']."--".$data['Diskon']."--".$data['NamaLeasing'];
	}
?>