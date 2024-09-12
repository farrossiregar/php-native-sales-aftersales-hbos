<?php
	include "koneksi.php";
	$day = $_POST['data'];
	$tgl = $_POST['data1'];
														
	if($day != 'Sun'){
		$time = array(  "08:00:00", "08:10:00", "08:20:00", "08:30:00", "08:40:00", "08:50:00", 
						"09:00:00", "09:10:00", "09:20:00", "09:30:00", "09:40:00", "09:50:00", 
						"10:00:00", "10:10:00", "10:20:00");
	}else{			
		$time = array(  "09:00:00", "09:10:00", "09:20:00", "09:30:00", "09:40:00", "09:50:00",
						"10:00:00", "10:10:00", "10:20:00", "10:30:00", "10:40:00", "10:50:00", 
						"11:00:00", "11:10:00", "11:20:00");	
	}
	
	//	$vacancy = mysql_unbuffered_query("select * from booking_service where waktu_booking = '$tgl' having count(jam_booking) = 2");
	//	while($hasil = mysql_fetch_array($vacancy)){
	//	$jam = $hasil['jam_booking'];
	//	$jam = '08:00:00';
	//	echo $jam;
		
			for($i = 0; $i < sizeof($time); $i++){
				if($jam == $time[$i]){
					$vacancy = mysql_query("select count(jam_booking) as total_booking from booking_service where waktu_booking = '$tgl' and jam_booking = '$time[$i]'");
					$data = mysql_fetch_array($vacancy);
					
					if($data['total_booking'] < 2){
						echo "<option value='$time[$i]' style='background-color: white; color:#40d65e;' disabled><font><b>".substr($time[$i], 0, 5)."</b></font></option>";
					}else{
						echo "<option value='$time[$i]' style='background-color: white; color:red;' disabled><font><b>".substr($time[$i], 0, 5)." (FULL)</b></font></option>";
					}
				}
				else{
					$vacancy = mysql_query("select count(jam_booking) as total_booking from booking_service where waktu_booking = '$tgl' and jam_booking = '$time[$i]'");
					$data = mysql_fetch_array($vacancy);
					
					if($data['total_booking'] < 2){
						echo "<option value='$time[$i]' style='background-color: white; color:#40d65e;' ><font><b>".substr($time[$i], 0, 5)."</b></font></option>";
					}else{
						echo "<option value='$time[$i]' style='background-color: white; color:red;' disabled><font><b>".substr($time[$i], 0, 5)." (FULL)</b></font></option>";
					}
					
				}
			}
	

?>