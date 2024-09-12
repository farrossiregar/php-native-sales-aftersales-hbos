<?php
if (count($_POST)){
	include "../../../config/koneksi_service.php";
	
	$no_bs = $_POST['data'];
	$tanggal = $_POST['data2'];

		$query = mysql_query("SELECT * FROM booking_service where no = '$no_bs'");

		
			$r = mysql_fetch_array($query);
				$no_booking = $r['no_booking'];
				$nama = $r['nama_customer'];
				$jam_booking = $r['jam_booking'];
				$waktu_booking = $r['waktu_booking'];
				$no_polisi = $r['no_polisi'];
				$tipe = $r['tipe'];
				$telepon = $r['telepon'];
				$perbaikan = $r['perbaikan'];
				$jenisperbaikan = $r['jenis_perbaikan'];
				$keterangan = $r['keterangan'];
				$kedatangan = $r['kedatangan'];
				$jam_datang = $r['jam_datang'];
				$reschedule = $r['reschedule'];
				$ket_tidak_datang = $r['ket_kedatangan'];
				$user = $r['user_input'];
				$input = $r['waktu_input'];
				$norangka = $r['norangka'];
				$nomesin = $r['nomesin'];
				$booking_via = $r['booking_via'];
				$konfirmasi_telp = $r['konfirmasi_telp'];
				$konfirmasi_sms = $r['konfirmasi_sms'];
				
				$query2 = mysql_query("SELECT * FROM booking_service_reschedule where no_booking = '$no_booking'");
					
					$r2 = mysql_fetch_array($query2);
					$num2 = mysql_num_rows($query2);
					if($r2 > 0){
						$jam_booking = $r2['jam_booking'];
						$waktu_booking = $r2['waktu_booking'];
					}
		
		
		$data = array('no_booking'=>$no_booking,'nama'=>$nama,'jam_booking'=>$jam_booking,'waktu_booking'=>$waktu_booking,'no_polisi'=>$no_polisi,'tipe'=>$tipe,'telepon'=>$telepon,'perbaikan'=>$perbaikan,'keterangan'=>$keterangan,
		'kedatangan'=>$kedatangan,'jam_datang'=>$jam_datang,'reschedule'=>$reschedule,'ket_kedatangan'=>$ket_tidak_datang,'user_input'=>$user,'waktu_input'=>$input,
		'jenis_perbaikan'=>$jenisperbaikan,'norangka'=>$norangka,'nomesin'=>$nomesin,'booking_via'=>$booking_via,'konfirmasi_telp'=>$konfirmasi_telp,'konfirmasi_sms'=>$konfirmasi_sms);
		
		echo json_encode($data);
		
		
}
?>
