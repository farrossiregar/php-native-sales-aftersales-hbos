<?php
	include "../../../../config/koneksi.php";
//	$jam_awal = $_POST['jam_awal'];
//	$jam_akhir = $_POST['jam_akhir'];
	$tanggal = $_POST['tanggal'];
//	$query = mysql_unbuffered_query("SELECT * FROM status_ketersediaan_mobil where tgl_test_drive = '$tanggal' and jam_test_drive < '' and  jam_test_drive > '' ");
	$data = mysql_unbuffered_query("SELECT * FROM status_ketersediaan_mobil where ketersediaan_unit = 'Y' ");
//	$data = mysql_query("SELECT tipe_mobil FROM peminjaman_test_drive where tgl_test_drive = '$tanggal' ");
	$cek_data = mysql_num_rows($data);
	$i=0;
		while($r=mysql_fetch_array($data)){
			$i += 1;
		/*	if($r[nama_model] == $_GET[model]){
				$selected = "selected";
			}else {
				$selected = "";
			}	*/
		//	echo "<option value='$r[nama_model]' $selected > $r[nama_model] </option>";	
			if($i < 4){
				$nama_model = "'".$r['nama_model']."',";
			}else{
				$nama_model = "'".$r['nama_model']."'";
			}
			
			
			$mobil_tersedia = mysql_query("SELECT * FROM model where nama_model NOT IN (".$nama_model.") ");
			while($data_mobil_tersedia = mysql_fetch_array($mobil_tersedia)){
				echo $data_mobil_tersedia;
			}
		}
?>