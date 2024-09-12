<?php
	include "../../../../config/koneksi.php";
	$status = $_POST['value'];
	$model = $_POST['model'];
	$data = mysql_unbuffered_query("update status_ketersediaan_mobil set ketersediaan_unit = '$status' where nama_model = '$model' ");
?>