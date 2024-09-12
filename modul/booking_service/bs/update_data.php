
<?php 
	include "koneksi.php";
	date_default_timezone_set('Asia/Jakarta');
	
	$no_booking = $_POST['data_update'];
/*	$nama = $_POST['data1'];
	$waktu_booking = $_POST['data3'];
	$jam_booking = $_POST['data2'];
	$no_polisi = $_POST['data4'];
	$tipe = $_POST['data5'];
	$telepon = $_POST['data6'];
	$perbaikan = $_POST['data7'];
	$keterangan = $_POST['data8'];	*/
	$kedatangan = $_POST['data9'];
	$waktu_kedatangan = $_POST['data10'];
	$reschedule = $_POST['data11'];
	$ket_tidak_datang = $_POST['data12'];
	
	
	/*	$query = mysql_unbuffered_query("UPDATE booking_service SET nama_customer = '$nama', waktu_booking = '$waktu_booking', jam_booking = '$jam_booking', no_polisi = '$no_polisi', tipe = '$tipe', telepon = '$telepon', perbaikan = '$perbaikan', 
										keterangan = '$keterangan', kedatangan = '$kedatangan', jam_datang = '$waktu_kedatangan', reschedule = '$reschedule' where no_booking = '$no_booking'");	*/
		
		$query = mysql_unbuffered_query("UPDATE booking_service SET kedatangan = '$kedatangan', jam_datang = '$waktu_kedatangan', reschedule = '$reschedule', ket_kedatangan = '$ket_tidak_datang' where no_booking = '$no_booking'");
	
		$msg = "<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-check'></i> Selamat!</h4>
				Berhasil Mengubah Data.</div>";
		echo $msg;

?>


