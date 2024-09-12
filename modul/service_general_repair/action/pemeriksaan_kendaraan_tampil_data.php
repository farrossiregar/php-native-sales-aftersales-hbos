<?php
if (count($_POST)){
	
	$nopolisi = addslashes($_POST['nopolisi']);
	
	session_start();
	include "../../../config/koneksi_sqlserver.php";
	
	
	
	$query = "select j.nama as nama_model,KC.*,GC.* from srvt_kendaraancustomer  KC
			  left join GlbM_Customer GC on gc.nomor = KC.nomor_customer
			  left join UntM_Tipe T on t.kode = kc.Kode_Tipe
			  left join UntM_Jenis J on j.kode = t.kode_jenis
			   where KC.nopolisi = '$nopolisi'
			";
	
	
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$row = sqlsrv_query( $conn, $query , $params, $options );
	
	$row_count = sqlsrv_num_rows($row);
	
	if ($row_count > 0){
		
		
	
		
		$result = sqlsrv_query($conn, $query);		
		while ($data = sqlsrv_fetch_array($result)){
			$data_ajax = array ('status'=>"OK",'norangka'=>$data['NoRangka'],'nomesin'=>$data['NoMesin'],'tahunbuat'=>$data['TahunPembuatan'],'tipe'=>$data['Tipe'],'warna'=>$data['Warna'],
								'nama'=>$data['nama'],'alamat'=>$data['alamat'],'kelurahan'=>$data['kelurahan'],'kecamatan'=>$data['kecamatan'],'kota'=>$data['kota'],'kodepos'=>$data['kodepos'],
								'noktp'=>$data['noktp'],'nohp'=>$data['nohp'],'nohp2'=>$data['nohp2'],'nohp2'=>$data['nohp2'],'namapic'=>$data['namapic'],'nohppic'=>$data['nohppic'],'agama'=>$data['agama'],
								'odmeterakhir'=>number_format($data['OdmeterAkhir'],0,',','.'),'model'=>$data['nama_model']
			);
		}
		
		echo json_encode($data_ajax);
	}else{
		$data_ajax = array ('status'=>"kosong");
		
		echo json_encode($data_ajax);
	}
}

?>