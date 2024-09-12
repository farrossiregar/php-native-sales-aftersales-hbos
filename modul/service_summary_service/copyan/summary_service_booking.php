<?php
session_start();

$level = $_SESSION['leveluser'];
										    
$cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 

");
$cek_akses2 = mysql_fetch_array($cek_akses);

										
if($cek_akses2['akses'] != 'Y'){

  
	include "modul/protected.php";

}else{
		switch($_GET[act]){
		//tampilkan data
		default:
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$tgl = date("Y-m-d");
		//$waktu_booking_sekarang = date("m-Y");
		//include "class_hitung_incentif.php"; 
		include "config/koneksi_sqlserver.php";
		//include "modul/summary_service/class_hitung_incentif.php";
		include "config/koneksi_service.php";
?>
	
				<style>
					
					table div {
  
					  position:relative;
					  //height:90px;
					  width:20px;
					  
					  
					}
					table span{
						  transform: rotate(-90deg);display:block; border: 0px solid red;
						}

					.vertical-text {
						//transform: rotate(-90deg);
						text-align:center;
						white-space:nowrap;
						transform-origin:50% 50%;
						-webkit-transform: rotate(-90deg);
						-moz-transform: rotate(-90deg);
						-ms-transform: rotate(-90deg);
						-o-transform: rotate(-90deg);
						transform: rotate(-90deg);
						padding:0%;
					}
					
					.vertical-text:before {
					
					content:'';
					padding-top:100%;/* takes width as reference, + 10% for faking some extra padding */
					//width : 5px;
					display:inline-block;
					vertical-align:middle;
					
					}
				</style>
				

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-7">
									<h1 class="mainTitle">Summary</h1>
									<span class="mainDescription">Booking Service</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
							
								<div class = "col-md-6">
									<?php $isi_lama = $_GET['waktu_booking']; 
										
										
									?>
									<div class="form-group">
																					
										<form action = "<?php echo "$_SERVER[PHP_SELF]"; ?>" method = "GET">
											<input type = "hidden" name="module" value = "service_summary_service_booking_srv" />
											
											<div class="form-group">
												<label class="control-label">
													Pilih Periode <span class="symbol required"></span>
												</label>
												<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
													<input class="form-control" type="text" id="tgl_awal" name="tgl_awal" value ="<?php echo $_GET[tgl_awal]; ?>" readonly>
														<span class="input-group-addon bg-primary">s/d</span>
													<input class="form-control" type="text" id="tgl_akhir" name="tgl_akhir" value ="<?php echo $_GET[tgl_akhir]; ?>" readonly>
												</div>
											</div>
											
											
											<div class="progress-demo">
												<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" >
													<span class="ladda-label"><i class="fa fa-check"></i> Proses </span>
												</button>
											</div><br/>
											<label class="control-label">
											    <font color="red"><b>Note : </b></font>Sebelum Proses,Terlebih dahulu Pilih waktu booking yang akan di tampilkan <span class="symbol required"></span>
													
									    	</label>
											<?php
												$tgl_awal = $_GET[tgl_awal];
												$tgl_akhir = $_GET[tgl_akhir];
											?>
											
											<div class="form-group">
												<i><b></b></i>
											</div>

											</form>	
										
										</div>						
									</div>
								
								<!------------------ UNTUK SS PERFORMANCE ------------------------------------------------------------------------------------------------>
								<?php 
								
								
									
									$bln = "substr($_GET[waktu_booking], 1, 7)";
									
									$tgl_awal = $_GET[tgl_awal];
									$tgl1 = substr($tgl_awal,4,4);
									$bln_awal = substr($tgl_awal, 5, 2);
									$thn_awal = substr($tgl_awal, 0, 4);
									$waktu_booking1 = $bln_awal."-".$thn_awal;
									
									$tgl_akhir = $_GET[tgl_akhir];
									$tgl2 = substr($tgl_akhir,4,4);
									$bln_akhir = substr($tgl_akhir, 5, 2);
									$thn_akhir = substr($tgl_akhir, 0, 4);
									$waktu_booking2 = $bln_akhir."-".$thn_akhir;
									
									if($waktu_booking !="-") { 
										$querysadetail = "select count(f.nomor) as total from srvt_faktur F
															where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'
															and f.batal = 0 ";
														
										$result = sqlsrv_query($conn, $querysadetail);		
										
										
										while($data_faktur = sqlsrv_fetch_array($result)){
											$ada_record = $data_faktur['total'];
										}
										
										
										if ($ada_record == '0') { echo "<div class='col-sm-12'> Tidak ada data pada periode Ini, silahkan pilih ulang </div>"; } else {
								?>
								
								<div class="col-sm-12">
									
									<div class="panel panel-white no-radius">
										<div class="panel-body no-padding">
											<div class="tabbable no-margin no-padding">
												<ul class="nav nav-tabs" id="myTab">
												
													<li class="padding-top-5">
														<a data-toggle="tab" href="#GRAFIK">
															GRAFIK
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#SUMMARY">
															SUMMARY
														</a>
													</li>
													<!--li class="padding-top-5">
														<a data-toggle="tab" href="#SUMMARY_BOOKING">
															SUMMARY BOOKING
														</a>
													</li-->
												</ul>
											
											
											<div class="tab-content">
											
											<?php
												$total_booking = mysql_num_rows(mysql_query("SELECT * FROM `booking_service` where waktu_booking >='$tgl_awal' and waktu_booking <='$tgl_akhir' ORDER BY `waktu_booking` ASC"));
												$total_datang = mysql_num_rows(mysql_query("SELECT* FROM `booking_service` where (kedatangan = 'Y' or kedatangan ='Sudah Service') and waktu_booking >='$tgl_awal' and waktu_booking <='$tgl_akhir' ORDER BY `waktu_booking` ASC"));
												$total_tdk_datang = mysql_num_rows(mysql_query("SELECT* FROM `booking_service` where (kedatangan='N' or kedatangan ='') and waktu_booking >='$tgl_awal' and waktu_booking <='$tgl_akhir' ORDER BY `waktu_booking` ASC"));
												$total_reschedule = mysql_num_rows(mysql_query("SELECT* FROM `booking_service` where reschedule ='Y' and waktu_booking >='$tgl_awal' and waktu_booking <='$tgl_akhir' ORDER BY `waktu_booking` ASC"));
										
										
												//untuk grafik bulet bulet
												$query1 = mysql_query("select * from booking_service where jam_booking < jam_datang  and waktu_booking >='$tgl_awal' and waktu_booking <='$tgl_akhir'");
																		
												$tot_terlambat = 0;
													while ($data = mysql_fetch_array($query1)){
													
														$date_awal  = new DateTime($data['jam_booking']);
														$date_akhir = new DateTime($data['jam_datang']);
														$selisih = $date_akhir->diff($date_awal);

														$jam = $selisih->format('%h');
														$menit = $selisih->format('%i');
														$detik = $selisih->format('%s');
														 
														 if($menit >= 0 && $menit <= 9){
														   $menit = "0".$menit;
														 }
														 
														$hasil = ($jam == "0" ? "" : "$jam Jam ").$menit." Menit";
														$status_datang ="";
														$selisih_waktu = "";
														if ($jam != 0 or ($jam == 0 and $menit > 16) ){
															if ($data['kedatangan'] == 'Y' or $data['kedatangan'] == 'Sudah Service'){
															$tot_terlambat = $tot_terlambat + 1;
															}
														}
														
													}
													
													//echo $tot_terlambat;
													
												//SDDDDDDDDDDDDD
												
												$query2 = mysql_query("select * from booking_service where jam_booking != '00:00:00' and waktu_booking >='$tgl_awal' and waktu_booking <='$tgl_akhir'");
																			
												$tot_tepatwaktu = 0;
												while ($data = mysql_fetch_array($query2)){
												
													$date_awal  = new DateTime($data['jam_booking']);
													$date_akhir = new DateTime($data['jam_datang']);
													$selisih = $date_akhir->diff($date_awal);

													$jam = $selisih->format('%h');
													$menit = $selisih->format('%i');
													$detik = $selisih->format('%s');
													 
													 if($menit >= 0 && $menit <= 9){
													   $menit = "0".$menit;
													 }
													 
													$hasil = ($jam == "0" ? "" : "$jam Jam ").$menit." Menit";
													$status_datang ="";
													$selisih_waktu = "";
													if ($jam != 0 or ($jam == 0 and $menit > 16) ){
														
													}else{
														if ($data['kedatangan'] == 'Y' or $data['kedatangan'] == 'Sudah Service'){
															$tot_tepatwaktu = $tot_tepatwaktu + 1;
														}
													}											
												}
												
												//echo $tot_tepatwaktu;
																			
												//SSSSSSSSSSSSSSSSSSSS
												
												$time_booking = substr($tgl_awal,0,7)."-".$noL;
												$query5 = mysql_query("select * from booking_service where jam_booking > jam_datang and jam_booking != '00:00:00' and waktu_booking >='$tgl_awal' and waktu_booking <='$tgl_akhir'");
												
												$tot_lebihawal = 0;
													while ($data = mysql_fetch_array($query5)){
													
														$date_awal  = new DateTime($data['jam_booking']);
														$date_akhir = new DateTime($data['jam_datang']);
														$selisih = $date_akhir->diff($date_awal);

														$jam = $selisih->format('%h');
														$menit = $selisih->format('%i');
														$detik = $selisih->format('%s');
														 
														 if($menit >= 0 && $menit <= 9){
														   $menit = "0".$menit;
														 }
														 
														$hasil = ($jam == "0" ? "" : "$jam Jam ").$menit." Menit";
														$status_datang ="";
														$selisih_waktu = "";
														if ($jam != 0 or ($jam == 0 and $menit > 16) ){
															if ($data['kedatangan'] == 'Y' or $data['kedatangan'] == 'Sudah Service'){
															$tot_lebihawal = $tot_lebihawal + 1;
															}
														}
														
													}
													
													//echo $tot_lebihawal;
																			
											?>
											
											
											<script>
												var total_booking 		= "<?php echo $total_booking; ?>";
												var total_datang 		= "<?php echo $total_datang; ?>";
												var total_tdk_datang 	= "<?php echo $total_tdk_datang; ?>";
												var total_reschedule 	= "<?php echo $total_reschedule; ?>";
												
												//untuk grafik bulet bulet
												var lebih_awal			= "<?php echo $tot_lebihawal; ?>";
												var tepat_waktu			= "<?php echo $tot_tepatwaktu; ?>";
												var terlambat			= "<?php echo $tot_terlambat; ?>";
											</script>
											
											<div id="GRAFIK" class="tab-pane padding-bottom-5 active" >
												<div class = "row">
													<div class = "col-md-6">
													<h1 class="mainTitle">Booking Service</h1>
														
																<canvas id="barChart" class="full-width"></canvas>
																<div class="inline pull-left legend-xs">
																	<div id="barLegend" class="chart-legend"></div>
																</div>
															
													</div>
													
													<div class = "col-md-6">
													<h1 class="mainTitle">Summary Waktu Kedatangan</h1>
														
																<canvas id="pieChart" class="full-width"></canvas>
																<div class="inline pull-left legend-xs">
																	<div id="pieLegend" class="chart-legend"></div>
																</div>
															
													</div>
												</div>
											</div>
											


											<div id="SUMMARY" class="tab-pane padding-bottom-5" >
															<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center; border-collapse:collapse" >
																		<thead>
																			<tr>
																				<td width="30" height="29"><b>TGL</td>
																			    <td><b>Total Booking</td>												
																				<td><b>Tidak Datang</td>
																				<td><b>Total Datang</td>
																				<td><b>Terlambat</td>
																				<td><b>Tepat Waktu</td>
																				<td><b>Lebih Awal</td>																				
																				<td><b>Reschedule</td>
																				<td><b>Rasio</td>
																			</tr>
																		</thead>
																		<tbody>
																	
													
															<?php

																	$tgl_akhir_doank = substr($_GET['tgl_akhir'],8,2); 
																	$tgl_awal_doank = substr($_GET['tgl_awal'],8,2); 
																		
																		//$tgl_doank2 = $tgl_doank - 0;
																		$query3 = mysql_query("select * from booking_service where waktu_booking >= '$_GET[tgl_awal]' and waktu_booking <= '$_GET[tgl_akhir]' group by waktu_booking order by waktu_booking asc"); 
																		while ($data = mysql_fetch_array($query3)){
																		
															?>
															<tr>
																	<td>

																		<?php 
																			echo substr($data['waktu_booking'],8,2);
																			
																		?>
																	</td>	
																	<td>
																	<?php
																	$query5 = mysql_query("select no_booking from booking_service where waktu_booking ='$data[waktu_booking]' ");
																	$tot_boking = mysql_num_rows($query5);
																	
																	echo $tot_boking;
																	
																	?>
																	</td>
																	<td>
																	<?php
																	$query5 = mysql_query("select *, kedatangan from booking_service where (kedatangan='N' or kedatangan ='') and waktu_booking ='$data[waktu_booking]'"); 
																	$tot_tdk_datang = mysql_num_rows($query5);
																	echo $tot_tdk_datang;
																	
																	?>
																	</td>
																	<td>
																	<?php
																	$query5 = mysql_query("select kedatangan from booking_service where (kedatangan = 'Y' or kedatangan ='Sudah Service')  and waktu_booking ='$data[waktu_booking]'");
																	$tot_datang = mysql_num_rows($query5);
																	echo $tot_datang;
																	
																	?>
																	</td>
																	<td>
																		<?php
																			$query5 = mysql_query("select * from booking_service where jam_booking < jam_datang and waktu_booking ='$data[waktu_booking]' and kedatangan = 'Y'");
																			
																			
																			$total_terlambat = 0;
																			while ($file = mysql_fetch_array($query5)){
																			
																				$date_awal  = new DateTime($file['jam_booking']);
																				$date_akhir = new DateTime($file['jam_datang']);
																				$selisih = $date_akhir->diff($date_awal);

																				$jam = $selisih->format('%h');
																				$menit = $selisih->format('%i');
																				$detik = $selisih->format('%s');
																				 
																				 if($menit >= 0 && $menit <= 9){
																				   $menit = "0".$menit;
																				 }
																				 
																				$hasil = ($jam == "0" ? "" : "$jam Jam ").$menit." Menit";
																				$status_datang ="";
																				$selisih_waktu = "";
																				if ($jam != 0 or ($jam == 0 and $menit > 16) ){
																					if (($file['kedatangan'] == 'Y') or ($file['kedatangan'] == 'Sudah Service')){
																					$total_terlambat = $total_terlambat + 1;
																					}
																				}
																				
																			}
																			
																			echo $total_terlambat;
																	
																		
																		?>
																		
																	</td>
																	<td>
																		<?php
																			$query4 = mysql_query("select * from booking_service where waktu_booking ='$data[waktu_booking]'");
																			
																			$total_tepatwaktu = 0;
																			while ($file = mysql_fetch_array($query4)){
																			
																				$date_awal  = new DateTime($file['jam_booking']);
																				$date_akhir = new DateTime($file['jam_datang']);
																				$selisih = $date_akhir->diff($date_awal);

																				$jam = $selisih->format('%h');
																				$menit = $selisih->format('%i');
																				$detik = $selisih->format('%s');
																				 
																				 if($menit >= 0 && $menit <= 9){
																				   $menit = "0".$menit;
																				 }
																				 
																				$hasil = ($jam == "0" ? "" : "$jam Jam ").$menit." Menit";
																				$status_datang ="";
																				$selisih_waktu = "";
																				if ($jam != 0 or ($jam == 0 and $menit > 16) ){
																					
																				}else{
																					if (($file['kedatangan'] == 'Y') or ($file['kedatangan'] == 'Sudah Service')){
																						$total_tepatwaktu = $total_tepatwaktu + 1;
																					}
																				}											
																			}
																			
																			echo $total_tepatwaktu;
																	
																		?>
																	</td>
																	<td>
																	<?php
																			$query5 = mysql_query("select * from booking_service where jam_booking > jam_datang and waktu_booking = '$data[waktu_booking]' and (kedatangan = 'Y' or kedatangan ='Sudah Service') ");
																			
																			
																			$total_lebihawal = 0;
																			while ($file = mysql_fetch_array($query5)){
																			
																				$date_awal  = new DateTime($file['jam_booking']);
																				$date_akhir = new DateTime($file['jam_datang']);
																				$selisih = $date_akhir->diff($date_awal);

																				$jam = $selisih->format('%h');
																				$menit = $selisih->format('%i');
																				$detik = $selisih->format('%s');
																				 
																				 if($menit >= 0 && $menit <= 9){
																				   $menit = "0".$menit;
																				 }
																				 
																				$hasil = ($jam == "0" ? "" : "$jam Jam ").$menit." Menit";
																				$status_datang ="";
																				$selisih_waktu = "";
																				if ($jam != 0 or ($jam == 0 and $menit > 16) ){
																					if (($file['kedatangan'] == 'Y') or ($file['kedatangan'] == 'Sudah Service')){
																					$total_lebihawal = $total_lebihawal + 1;
																					}
																				}
																				
																			}
																			
																			echo $total_lebihawal;
																	
																		
																		?>
																	</td>
																	<td>
																	<?php
																	$query8 = mysql_query("select reschedule from booking_service where reschedule='Y' and waktu_booking ='$data[waktu_booking]'");
																	$tot_reschedule = mysql_num_rows($query8);
																	echo $tot_reschedule;
																	
																	?>
																	</td>
																	<td>
																	<?php
																		$rasio = ($tot_datang*100)/$tot_boking;
																		if ($rasio > 80){
																			echo "<div class='label  label-success'>".round($rasio)."%</div>";
																		}else if($rasio <= 50){
																			echo "<div class='label  label-danger'>".round($rasio)."%</div>";
																		}else{
																			echo "<div class='label  label-warning'>".round($rasio)."%</div>";
																		}
																	?>
																	</td>
															</tr>
															
														<?php
															}
														?>
															
															<tr>
																<td><b>TOTAL</td>
																
																<td>
																	<?php
																		$query5 = mysql_query("select count(no_booking) as total_booking from booking_service where waktu_booking >='$tgl_awal' and waktu_booking <='$tgl_akhir'");
																		$total_booking = mysql_fetch_array($query5);
																		echo $total_booking['total_booking'];
																	?>
																</td>
																<td>
																	<?php
																		$query5 = mysql_query("select count(kedatangan) as total_tdkkedatangan from booking_service where (kedatangan = 'N' or kedatangan ='') and waktu_booking >='$tgl_awal' and waktu_booking <='$tgl_akhir'");
																		$total_tdkkedatangan = mysql_fetch_array($query5);
																		echo $total_tdkkedatangan['total_tdkkedatangan'];
																	?>
																</td>
																<td>
																	<?php
																		$query5 = mysql_query("select count(kedatangan) as total_kedatangan from booking_service where (kedatangan = 'Y' or kedatangan ='Sudah Service') and waktu_booking >='$tgl_awal' and waktu_booking <='$tgl_akhir'");
																		$total_kedatangan = mysql_fetch_array($query5);
																		echo $total_kedatangan['total_kedatangan'];
																		
																	?>
																</td>
																<td>
																	<?php
																		$query5 = mysql_query("select * from booking_service where jam_booking < jam_datang and  waktu_booking >='$tgl_awal' and waktu_booking <='$tgl_akhir'");
																		
																		$tot_terlambat = 0;
																			while ($data = mysql_fetch_array($query5)){
																			
																				$date_awal  = new DateTime($data['jam_booking']);
																				$date_akhir = new DateTime($data['jam_datang']);
																				$selisih = $date_akhir->diff($date_awal);

																				$jam = $selisih->format('%h');
																				$menit = $selisih->format('%i');
																				$detik = $selisih->format('%s');
																				 
																				 if($menit >= 0 && $menit <= 9){
																				   $menit = "0".$menit;
																				 }
																				 
																				$hasil = ($jam == "0" ? "" : "$jam Jam ").$menit." Menit";
																				$status_datang ="";
																				$selisih_waktu = "";
																				if ($jam != 0 or ($jam == 0 and $menit > 16) ){
																					if ($data['kedatangan'] == 'Y' or $data['kedatangan'] == 'Sudah Service'){
																					$tot_terlambat = $tot_terlambat + 1;
																					}
																				}
																				
																			}
																			
																			echo $tot_terlambat;
																		
																	?>	
																</td>
																	<td>
																	<?php
																			$query5 = mysql_query("select * from booking_service where jam_booking != '00:00:00' and waktu_booking >='$tgl_awal' and waktu_booking <='$tgl_akhir'");
																			
																			$tot_tepatwaktu = 0;
																			while ($data = mysql_fetch_array($query5)){
																			
																				$date_awal  = new DateTime($data['jam_booking']);
																				$date_akhir = new DateTime($data['jam_datang']);
																				$selisih = $date_akhir->diff($date_awal);

																				$jam = $selisih->format('%h');
																				$menit = $selisih->format('%i');
																				$detik = $selisih->format('%s');
																				 
																				 if($menit >= 0 && $menit <= 9){
																				   $menit = "0".$menit;
																				 }
																				 
																				$hasil = ($jam == "0" ? "" : "$jam Jam ").$menit." Menit";
																				$status_datang ="";
																				$selisih_waktu = "";
																				if ($jam != 0 or ($jam == 0 and $menit > 16) ){
																					
																				}else{
																					if ($data['kedatangan'] == 'Y' or $data['kedatangan'] == 'Sudah Service'){
																						$tot_tepatwaktu = $tot_tepatwaktu + 1;
																					}
																				}											
																			}
																			
																			echo $tot_tepatwaktu;
																
																	?>	
																</td>
																<td>
																	<?php
																		$query5 = mysql_query("select * from booking_service where jam_booking > jam_datang and jam_booking != '00:00:00' and (kedatangan = 'Y' or kedatangan = 'Sudah Service') and waktu_booking >='$tgl_awal' and waktu_booking <='$tgl_akhir'");
																		
																		$tot_lebihawal = 0;
																			while ($data = mysql_fetch_array($query5)){
																			
																				$date_awal  = new DateTime($data['jam_booking']);
																				$date_akhir = new DateTime($data['jam_datang']);
																				$selisih = $date_akhir->diff($date_awal);

																				$jam = $selisih->format('%h');
																				$menit = $selisih->format('%i');
																				$detik = $selisih->format('%s');
																				 
																				 if($menit >= 0 && $menit <= 9){
																				   $menit = "0".$menit;
																				 }
																				 
																				$hasil = ($jam == "0" ? "" : "$jam Jam ").$menit." Menit";
																				$status_datang ="";
																				$selisih_waktu = "";
																				if ($jam != 0 or ($jam == 0 and $menit > 16) ){
																					if ($data['kedatangan'] == 'Y' or $data['kedatangan'] == 'Sudah Service'){
																					$tot_lebihawal = $tot_lebihawal + 1;
																					}
																				}
																				
																			}
																			
																			echo $tot_lebihawal;
																		
																	?>	
																</td>
																
																
																<td>
																	<?php
																	$query5 = mysql_query("select count(reschedule) as total_reschedule from booking_service where reschedule='Y' and waktu_booking >='$tgl_awal' and waktu_booking <='$tgl_akhir'");
																	$total_reschedule = mysql_fetch_array($query5);
																	echo $total_reschedule['total_reschedule'];
																	
																	?>
																</td>
																<td>
																	<?php
																		$totrasio = ($total_kedatangan['total_kedatangan']*100)/$total_booking['total_booking'];
																		if ($totrasio > 80){
																			echo "<div class='label  label-success'>".round(substr($totrasio,0,6))."%</div>";
																		}else if($totrasio <= 50){
																			echo "<div class='label  label-danger'>".round(substr($totrasio,0,6))."%</div>";
																		}else{
																			echo "<div class='label  label-warning'>".round(substr($totrasio,0,6))."%</div>";
																		}
																	?>
																	</td>
															</tr>
															
																		</tbody>
																		
																	</table>
																	<?php
																		$level = $_SESSION['leveluser'];
																		
																		$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ",$koneksi_showroom);
																		$cek_akses2 = mysql_fetch_array($cek_akses);
																			if($cek_akses2['ekspor'] == 'Y')
																			{
																	?>
																		<div class="progress-demo">
																			<a href='modul/summary_service/export_summary_booking.php?tgl_awal=<?php echo $_GET['tgl_awal'].'&tgl_akhir='.$_GET['tgl_akhir']; ?>' id="export">
																				<button class="btn btn-wide btn-primary ladda-button" data-style="expand-right" >
																					<span class="ladda-label"> Export Data ke Excel</span>
																				</button>
																			</a>
																		</div>
																		<br>
																	<?php
																			}
																	?>
															</div>	
														
													</div>
													
													
													
													</div>
												</div>
											</div>
										</div>
									</div>
								
								<?php }} ?>
								
								
								
								
								
							</div>
						</div>
						<!-- end: DYNAMIC TABLE -->
					</div>
				</div>
			
	
<?php break;
}
} ?>