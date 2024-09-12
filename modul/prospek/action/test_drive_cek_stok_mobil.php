<?php
	include "../../../config/koneksi.php";
	$tanggal = $_POST['tanggal'];
	
	$model = array("ACCORD", "BRIO", "BR-V", "CR-V", "CITY", "CIVIC", "HR-V", "JAZZ", "MOBILIO");
	
	for($i = 0; $i <= sizeof($model); $i++){
		$stok_mobil = mysql_query("SELECT * FROM test_drive_peminjaman_kendaraan where tgl_test_drive = '$tanggal' and tipe_mobil = '$model[$i]' order by tipe_mobil asc");
		$data_stok_mobil = mysql_fetch_array($stok_mobil);
			if($data_stok_mobil['tipe_mobil'] != $model[$i]){
				echo "<option value='$model[$i]' style='background-color: white; color:#40d65e;' ><font><b>".$model[$i]."</b></font></option>";
			}else{
				echo "<option value='$model[$i]' style='background-color: white; color:red;' disabled><font><b>".$model[$i]."</b></font></option>";
			}
	}
	
?>