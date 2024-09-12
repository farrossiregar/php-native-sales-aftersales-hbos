<?php 
//	$id = $_POST['data_ajax'];

	include "config/koneksi.php";

/*	$query = mysql_unbuffered_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv");
									
									
	$r = mysql_fetch_array($query);
	
		
		if($id != ''){
			echo $tipe.",".$warna.",".$cust.",".$bayar.",".$leasing.",".$tenor.",".$nilai;
		}else{
			echo "";
		}	*/
	$mjj = array("1","2","3","4");
	echo $mjj;
?>
