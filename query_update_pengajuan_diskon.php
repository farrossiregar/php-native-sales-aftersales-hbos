<?php 
	

	include "config/koneksi.php";

	//echo "asdfsadf";
	
	$query = mysql_query("select * from pengajuan_discount_ulang 
								
	
	where tipe_mobil = ''  order by no_pengajuan ");
	
	
	while ($data = mysql_fetch_array($query)){
		$query2 = mysql_query(" select * from pengajuan_discount where no_pengajuan = '$data[no_pengajuan]' ");
		$data2 = mysql_fetch_array($query2);
		echo $data['no_pengajuan'].' '.$data2['model'].'</br>';
		
		
		$query3 = mysql_unbuffered_query(" update pengajuan_discount_ulang set model = '$data2[model]',warna = '$data2[warna]',asal_prospek = '$data2[asal_prospek]',ket_asal_prospek = '$data2[ket_asal_prospek]'
						,nama_customer = '$data2[nama_customer]',no_identitas = '$data2[no_identitas]',jenis_identitas = '$data2[jenis_identitas]',hp_customer = '$data2[hp_customer]',alamat_customer = '$data2[alamat_customer]'
						,tipe_mobil = '$data2[tipe_mobil]'

		where no_pengajuan = '$data[no_pengajuan]' ");
		
	}
	
?>
