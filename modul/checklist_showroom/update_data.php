
<?php 
	include "koneksi.php";
	date_default_timezone_set('Asia/Jakarta');
	
	$no = $_POST['data_update'];
	$catatan_keterangan = $_POST['data1'];
	
	
		$query = mysql_unbuffered_query("UPDATE pengecekan_showroom_detail SET keterangan_catatan_pengecekan = '$catatan_keterangan' where no = '$no'");
	
		$msg = "<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-check'></i> Selamat!</h4>
				Berhasil Mengubah Data.</div>";
		echo $msg;

?>


