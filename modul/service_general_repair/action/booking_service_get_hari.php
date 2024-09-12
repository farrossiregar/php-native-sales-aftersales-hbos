<?php
if (count($_POST)){
	include "../../../config/koneksi_service.php";
	$day = $_POST['data'];
	$tgl = $_POST['data1'];
	
	
	$query_cek_record = mysql_query("select * from booking_service where no_booking = '$_POST[no_booking]'");
	$record = mysql_num_rows($query_cek_record);
	
	$data = mysql_fetch_array($query_cek_record);
	$data_jam_booking = '';
	
	if ($record > 0){
		$data_jam_booking = $data['jam_booking'];
		
	}
	
														
	if($day == 'Mon' or $day == 'Tue' or $day == 'Wed' or $day == 'Thu' or $day == 'Fri' or $day == 'Sat'){
		$time = array(  "08:00:00", "08:10:00", "08:20:00", "08:30:00", "08:40:00", "08:50:00", 
						"09:00:00", "09:10:00", "09:20:00", "09:30:00", "09:40:00", "09:50:00", 
						"10:00:00", "10:10:00", "10:20:00");
	}else if($day == 'Sun'){			
		$time = array(  "09:00:00", "09:10:00", "09:20:00", "09:30:00", "09:40:00", "09:50:00",
						"10:00:00", "10:10:00", "10:20:00", "10:30:00", "10:40:00", "10:50:00");	
	}else{
		$time = "";
	}
	$filter = "";
	
	
	
	echo "<option value='00:00:10' >Pilih Jam</option>";
	
	//$query = mysql_query("select * from booking_service_parameterjam where ");
	
	if ($_POST['jenis_perbaikan'] == 'QS'){
		if ($day == 'Mon' or $day == 'Tue' or $day == 'Wed' or $day == 'Thu' or $day == 'Fri'){
			$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan = 'QS' and hari = 'Mon-Fri' ");
		}
		elseif ($day == 'Sat'){
			$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan = 'QS' and hari = 'Sat' ");
		}
	}
	
	
	if ($_POST['jenis_perbaikan'] == 'PM'){
		if ($day == 'Mon' or $day == 'Tue' or $day == 'Wed' or $day == 'Thu' or $day == 'Fri' ){
			$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan = 'PM' and hari = 'Mon-Fri' ");
		}
		elseif ($day == 'Sat' ){
			$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan = 'PM' and hari = 'Sat' ");
		}
	}
	
	
	if ($_POST['jenis_perbaikan'] == 'REPAIR'){
		if ($day == 'Mon' or $day == 'Tue' or $day == 'Wed' or $day == 'Thu' or $day == 'Fri' ){
			$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan = 'REPAIR' and hari = 'Mon-Fri' ");
		}
		elseif ($day == 'Sat'){
			$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan = 'REPAIR' and hari = 'Sat' ");
		}
	}
	
	if ($_POST['jenis_perbaikan'] == 'PUD'){
		if ($day == 'Mon' or $day == 'Tue' or $day == 'Wed' or $day == 'Thu' or $day == 'Fri' ){
			$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan != 'QS' group by jam ");
		}
		if ($day == 'Sat'){
			$query = mysql_query("select * from booking_service_parameterjam where jenis_perbaikan != 'QS' and hari = 'sat' group by jam");
		}
		
		if ($day == 'Sun'){
			/*
			for($i = 0; $i < sizeof($time); $i++){
				$vacancy = mysql_query("select count(jam_booking) as total_booking from booking_service where waktu_booking = '$tgl' and jam_booking = '$time[$i]' $filter");
				$data = mysql_fetch_array($vacancy);
				
				if($data['total_booking'] < 2){
					echo "<option value='$time[$i]' style='background-color: white; color:#40d65e;' ><font><b>".substr($time[$i], 0, 5)."</b></font></option>";
				}else{
					echo "<option value='$time[$i]' style='background-color: white; color:red;' disabled><font><b>".substr($time[$i], 0, 5)." (FULL)</b></font></option>";
				}
			}
			*/
			echo "<option value='' style='background-color: white; color:red;' disabled><font><b>TIDAK BISA PUD</b></font></option>";
		}else{
			
		
			while ($data_jam = mysql_fetch_array($query)){
				
				$query_total_pud = mysql_query("select count(jam_booking) as total_booking from booking_service where waktu_booking = '$tgl' and jenis_perbaikan = 'PUD' and reschedule != 'Y' ");
				$data_total_pud = mysql_fetch_array($query_total_pud);
				
				$query_quota = mysql_query("select sum(quota) as total from booking_service_parameterjam where hari = '$data_jam[hari]' and jam = '$data_jam[jam]' ");
				$data_quota = mysql_fetch_array($query_quota);
				
				$vacancy = mysql_query("select count(jam_booking) as total_booking from booking_service where waktu_booking = '$tgl' and jam_booking = '$data_jam[jam]' and jenis_perbaikan = 'PUD' and reschedule != 'Y' ");
				$data = mysql_fetch_array($vacancy);
				
				$query_total_perjam = mysql_query("select count(jam_booking) as total_perjam from booking_service where waktu_booking = '$tgl' and jam_booking = '$data_jam[jam]' and reschedule != 'Y' ");
				$data_total_perjam = mysql_fetch_array($query_total_perjam);
				
				if ($data_total_pud['total_booking'] >= 10){
					echo "<option value='$data_jam[jam]' style='background-color: white; color:red;' ".($data_jam['jam'] == $data_jam_booking ? "selected" : "disabled")." ><font><b>".substr($data_jam['jam'], 0, 5)." (FULL)</b></font></option>";
					
				}else{
					if($data['total_booking'] < 1 and $data_total_perjam['total_perjam'] < 4){
						echo "<option value='$data_jam[jam]' style='background-color: white; color:#40d65e;' ".($data_jam['jam'] == $data_jam_booking ? "selected" : "")." ><font><b>".substr($data_jam['jam'], 0, 5)."</b></font></option>";
					}else{
						echo "<option value='$data_jam[jam]' style='background-color: white; color:red;' ".($data_jam['jam'] == $data_jam_booking ? "selected" : "disabled")." ><font><b>".substr($data_jam['jam'], 0, 5)." (FULL)</b></font></option>";
					}
				}
			}	
		}
		
	}else{
	
		if ($day == 'Sun'){
			for($i = 0; $i < sizeof($time); $i++){
				$vacancy = mysql_query("select count(jam_booking) as total_booking from booking_service where waktu_booking = '$tgl' and jam_booking = '$time[$i]' $filter");
				$data = mysql_fetch_array($vacancy);
				
				if($data['total_booking'] < 2){
					echo "<option value='$time[$i]' style='background-color: white; color:#40d65e;' ".($time[$i] == $data_jam_booking ? "selected" : "")." ><font><b>".substr($time[$i], 0, 5)."</b></font></option>";
				}else{
					echo "<option value='$time[$i]' style='background-color: white; color:red;' ".($time[$i] == $data_jam_booking ? "selected" : "disabled")." ><font><b>".substr($time[$i], 0, 5)." (FULL)</b></font></option>";
				}
			}
			
		}else{
	
			while ($data_jam = mysql_fetch_array($query)){
				
				$query_quota = mysql_query("select sum(quota) as total_quota from booking_service_parameterjam where hari = '$data_jam[hari]' and jam = '$data_jam[jam]' ");
				$data_quota = mysql_fetch_array($query_quota);
				
				$query_total_recod_perjam = mysql_query("select count(jam_booking) as total_booking_jam from booking_service where waktu_booking = '$tgl' and jam_booking = '$data_jam[jam]' and reschedule != 'Y' ");
				$data_total_recod_perjam = mysql_fetch_array($query_total_recod_perjam);
				
				
				$vacancy = mysql_query("select count(jam_booking) as total_booking from booking_service where waktu_booking = '$tgl' and jam_booking = '$data_jam[jam]' and jenis_perbaikan = '$data_jam[jenis_perbaikan]' and reschedule != 'Y' ");						
				
				
				$data = mysql_fetch_array($vacancy);
				
				if ($data_total_recod_perjam['total_booking_jam'] >= $data_quota['total_quota']){
					echo "<option value='$data_jam[jam]' style='background-color: white; color:red;' ".($data_jam['jam'] == $data_jam_booking ? "selected" : "disabled")." ><font><b>".substr($data_jam['jam'], 0, 5)." (FULL)</b></font></option>";
					
				}else{
					if($data['total_booking'] < $data_jam['quota']){
						$sisa_kuota = $data_jam['quota']-$data['total_booking'];
						echo "<option value='$data_jam[jam]' style='background-color: white; color:#40d65e;' ".($data_jam['jam'] == $data_jam_booking ? "selected" : "")." ><font><b>".substr($data_jam['jam'], 0, 5)." -- Sisa Kuota (".$sisa_kuota.")</b></font></option>";
					}else{
						echo "<option value='$data_jam[jam]' style='background-color: white; color:red;' ".($data_jam['jam'] == $data_jam_booking ? "selected" : "disabled")." ><font><b>".substr($data_jam['jam'], 0, 5)." (FULL)</b></font></option>";
					}	
				}
			}
		}
	
	}
			echo "<option value='00:00:00' style='background-color: white; color:#40d65e;' ><font><b>tambahan</b></font></option>";
	
}
?>