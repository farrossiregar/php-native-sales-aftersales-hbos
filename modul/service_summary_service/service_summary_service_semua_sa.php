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
		
		include "config/koneksi_sqlserver.php";
		
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
									<span class="mainDescription">Performance Service Advisor
<?php
/*
    $_IP_SERVER = $_SERVER['SERVER_ADDR'];
    $_IP_ADDRESS = $_SERVER['REMOTE_ADDR']; 
    if($_IP_ADDRESS == $_IP_SERVER)
    {
        ob_start();
        system('ipconfig /all');
        $_PERINTAH  = ob_get_contents();
        ob_clean();
        $_PECAH = strpos($_PERINTAH, "Physical");
        $_HASIL = substr($_PERINTAH,($_PECAH+36),17);
        echo $_HASIL;   
    } else {
        $_PERINTAH = "arp -a $_IP_ADDRESS";
        ob_start();
        system($_PERINTAH);
        $_HASIL = ob_get_contents();
        ob_clean();
        $_PECAH = strstr($_HASIL, $_IP_ADDRESS);
        $_PECAH_STRING = explode($_IP_ADDRESS, str_replace(" ", "", $_PECAH));
        $_HASIL = substr($_PECAH_STRING[1], 0, 17);
        echo "IP Anda : ".$_IP_ADDRESS."
        MAC ADDRESS Anda : ".$_HASIL;
    }

  function getRealIpAddr()
  {
    if ( !empty( $_SERVER['HTTP_CLIENT_IP'] ) )
    {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
    //to check ip passed from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }
echo getRealIpAddr();

*/	

	
?>							
									</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
							
								<div class = "col-md-6">
									<?php $isi_lama = $_GET['bulan']; 
										
										
									?>
									<div class="form-group">
																					
										<form action = "<?php echo "$_SERVER[PHP_SELF]"; ?>" method = "GET">
											<input type = "hidden" name="module" value = "service_summary_service_semua_sa" />
											
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
											
											<?php
												$tgl_awal = $_GET[tgl_awal];
												$tgl_akhir = $_GET[tgl_akhir];
											?>
											<!--label class="control-label">
											    <div class="table-header">Data Faktur Sales: dari Periode <?php echo $tgl_awal; ?> sampai dengan periode <?php echo $tgl_akhir; ?> </div>
									    	</label-->
											
											<div class="form-group">
												<i><b></b></i></div>
											</div>
										</form>										
									</div>
								
								<!------------------ UNTUK SS PERFORMANCE ------------------------------------------------------------------------------------------------>
								<?php 
								
							
									
									$bln = "substr($_GET[bulan], 1, 7)";
									
									$tgl_awal = $_GET[tgl_awal];
									$tgl1 = substr($tgl_awal,4,4);
									$bln_awal = substr($tgl_awal, 5, 2);
									$thn_awal = substr($tgl_awal, 0, 4);
									$bulan1 = $bln_awal."-".$thn_awal;
									
									$tgl_akhir = $_GET[tgl_akhir];
									$tgl2 = substr($tgl_akhir,4,4);
									$bln_akhir = substr($tgl_akhir, 5, 2);
									$thn_akhir = substr($tgl_akhir, 0, 4);
									$bulan2 = $bln_akhir."-".$thn_akhir;
									
									if($bulan !="-") {
										
										
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
												    <li class="active padding-top-5 padding-left-5"> 
														<a data-toggle="tab" href="#chart">
															GRAFIK
														</a>
													</li>
												    <!--li class="padding-top-5">
														<a data-toggle="tab" href="#incentif">
															SS PERFORMANCE
														</a>
													</li-->
													<li class="padding-top-5">
														<a data-toggle="tab" href="#INCENTIF_SA">
															INCENTIF
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#PM_PACKAGE">
															PM PACKAGE
														</a>
													</li>
													<!--li class="padding-top-5">
														<a data-toggle="tab" href="#POLES">
															POLES
														</a>
													</li-->
												
													
												</ul>
												
												<div class="tab-content">
													
													
													
													
													
													<div id="<?php echo "INCENTIF_SA"; ?>" class="tab-pane padding-bottom-5"> 
														<div class="panel-scroll height-360">
														
														<?php
														/////////////////// data PM Package
														$querysadetail = "select wo.penerima,f.tanggal,fd.* from srvt_faktur F
																				left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																				left join srvt_wo WO on wo.nomor = F.nomor_wo
																				
																				where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'		
																				
																				
																																																						
																				and fd.Nama_Referensi like '%PPB%'
																				and f.batal = 0  ";
																			
															$result_ppb = sqlsrv_query($conn, $querysadetail);		
														
															
															
														?>
															<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center; border-collapse:collapse" >
																		<thead>
																			<tr>
																				<td width="30" height="29">NO</td>
																			    <td>ITEM</td>												
																				
																				<td>TGT DEALER</td>
																				<td>TGT SA</td>
																				<td>P</td>
																			    <?php 
																					$query5 = mysql_query("select * from target_serviceadvisor where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') 
																					and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by nama_sa order by nama_sa ");
																						  
																			        while ($data_sa = mysql_fetch_array($query5)){
																						
																						echo "<td>".$data_sa['nama_sa']."</td>";
																						
																			        }
																			    ?>
																														
																				<td>CECEP</td>
																				<td>PONCO</td>
																				<td>TOTAL</td>
																				
																															
																			</tr>
																		</thead>
																		<tbody>
																			<?php
																				$query_sa2 = mysql_query("SELECT * FROM target_semua_sa where bulan = '$bulan1'  group by kode_kategori order by urutan ");
																			
																				 while ($data_sa2 = mysql_fetch_array($query_sa2))
																			        {
																						
																						$kategori = $data_sa2['kode_kategori'];
																			?>
																						
																							<?php
																								$query5 = mysql_query("select * from target_semua_sa where bulan = '$bulan1' and kode_kategori = '$kategori' order by urutan ");
																								$no = 1;
																								$row_count = 0;
																								$tot_point_kategori = '';
																								
																								
																								
																								//misahin nama sa.. belom ada ide lagi jadi gini dulu dah................///////////////////////
																							
																								
																								$gabung_kategori = '';
																								$total_rasio_kategori_semuasa = '';
																								
																								$gabung_point_kategori = '';
																								$total_point_kategori_semuasa = '';
																								
																								if ($kode_kategori == 'EXTRA CARE'){
																									$row_count_ponco_total = 0 ;
																									
																									$row_count_cecep_total = 0 ;
																								}
																								
																								while ($data_sa = mysql_fetch_array($query5)){
																										
																										$query6 = mysql_query("select nama_sa from target_serviceadvisor where bulan = '$bulan1' group by nama_sa order by nama_sa ");
																										$jml_sa = mysql_num_rows($query6);
																										
																										echo "<tr>
																													<td>$no</td>
																													<td>".$data_sa['nama_item']."</td>";
																										echo "<td>".number_format($data_sa['target_unit'],0,".",".")."</td>";
																										echo "<td>".number_format(ceil($data_sa['target_unit']/$jml_sa),0,".",".")."</td>";
																										echo "<td>".$data_sa['target_point']."</td>";
																										
																										$tot_item = 0;
																										$tot_point = '';
																										
																										while ($data_query6 = mysql_fetch_array($query6)){
																											
																											
																											$kode_sa = $data_query6['nama_sa'];
																											$program = $data_sa['program'];
																											
																											switch ($program){
																												
																												
																												case "POLES":
																													$querysadetail = "select wo.penerima,f.tanggal,fd.* from srvt_faktur F
																																		left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																		left join srvt_wo WO on wo.nomor = F.nomor_wo
																																		
																																		where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'		
																																		
																																		
																																		and wo.penerima = '$kode_sa' 																																
																																		and fd.Nama_Referensi like '%POLES%'
																																		and f.batal = 0  ";
																																	
																													$result_poles = sqlsrv_query($conn, $querysadetail);		
																													$row_count = 0;
																													$point_poles = 0;
																													while ($data = sqlsrv_fetch_array($result_poles)){
																														
																														$query_package = mysql_query("select * from target_polesdua where kode_item = '$data[Kode_Referensi]' and bulan = '$bulan1'");
																														
																														while($data_pm = mysql_fetch_array($query_package)){																													
																															
																															
																																$row_count = $row_count + 1 ;
																																$point_poles = $point_poles + $data_pm['point'];
																															
																															
																															
																														}
																														
																													}
																												
																												
																												break;
																												
																												case "PPB":
																													$querysadetail = "select wo.penerima,f.tanggal,fd.* from srvt_faktur F
																																		left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																		left join srvt_wo WO on wo.nomor = F.nomor_wo
																																		
																																		where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'		
																																		
																																		
																																		and wo.penerima = '$kode_sa' 																																
																																		and fd.Nama_Referensi like '%PPB%'
																																		and f.batal = 0  ";
																																	
																													$result_ppb = sqlsrv_query($conn, $querysadetail);		
																													$row_count = 0;
																													$point_ppb = 0;
																													while ($data = sqlsrv_fetch_array($result_ppb)){
																														
																														$query_package = mysql_query("select * from target_pmpackagedua where kode_item = '$data[Kode_Referensi]' and bulan = '$bulan1'");
																														
																														while($data_pm = mysql_fetch_array($query_package)){	
																															
																																$row_count = $row_count + 1 ;
																																$point_ppb = $point_ppb + $data_pm['point'];
																															
																															
																															
																														}
																														
																													}
																												
																												
																												break;
																												
																												case "LEFT":  /////////////////////////////////////
																												
																													
																														
																														$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																			left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																			left join srvt_wo WO on wo.nomor = F.nomor_wo
																																			
																																			where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'
																																			
																																			
																																			and wo.penerima = '$kode_sa' 
																																			and LEFT(fd.Kode_Referensi,5) = '$data_sa[kode_item]'
																																			and f.batal = 0 group by wo.penerima ";
																																		
																														$result = sqlsrv_query($conn, $querysadetail);		
																														//$jumlah = sqlsrv_num_rows($result);
																														$row_count = 0;
																														while ($data = sqlsrv_fetch_array($result)){
																															$row_count = $data['total'];
																														}
																														
																													
																												
																												break;
																												
																												case "STANDAR":   ///////////////////////////////
																												
																												
																													
																													
																													
																													
																													$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																		left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																		left join srvt_wo WO on wo.nomor = F.nomor_wo
																																		
																																		where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'
																																		
																																		
																																		and wo.penerima = '$kode_sa'
																																		and fd.kode_referensi = '$data_sa[kode_item]'
																																		and f.batal = 0 group by wo.Penerima ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													//$jumlah = sqlsrv_num_rows($result);
																													/*
																													$params = array();
																													$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																													$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																													
																													$row_count = sqlsrv_num_rows($row);
																													*/
																													$row_count = 0;
																													while ($data = sqlsrv_fetch_array($result)){																													
																														$row_count = $data['total'];																														
																													}
																													
																													
																													
																												
																												
																												break;
																												
																												case "SPOORING":  /////////////////////////////////////
																												
																													
																														
																														$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																			left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																			left join srvt_wo WO on wo.nomor = F.nomor_wo
																																			
																																			where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'
																																			
																																			and fd.subtotal != '0'
																																			and wo.penerima = '$kode_sa' 
																																			and fd.nama_referensi = '$data_sa[kode_item]'
																																			and f.batal = 0 group by wo.Penerima ";
																																		
																														$result = sqlsrv_query($conn, $querysadetail);		
																														$row_count = 0;
																														while ($data = sqlsrv_fetch_array($result)){
																															$row_count = $data['total'];
																														}
																													
																												
																												break;
																												
																												case "BALANCE":  /////////////////////////////////////
																												
																																																											
																														$querysadetail = "select wo.penerima,f.Tanggal,
																																		CASE fd.Kode_Referensi
																																		 WHEN 'G-B/S005' THEN 5
																																		 WHEN 'G-B/S004' THEN 4
																																		 WHEN 'G-B/G118' THEN 4
																																		 WHEN 'G-B/S003' THEN 3
																																		 WHEN 'G-B/S002' THEN 2
																																		 WHEN 'G-B/S001' THEN 1
																																		 
																																		END AS total_balance,
																																		Fd.* from srvt_faktur F
																																		left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																		left join srvt_wo WO on wo.nomor = F.nomor_wo
																																		
																																		where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'
																																		
																																		
																																		and wo.penerima = '$kode_sa' 
																																		and fd.kode_referensi in ('G-B/S001','G-B/S002','G-B/S003','G-B/S004','G-B/S005','G-B/G118')
																																		and f.batal = 0 order by f.tanggal ";
																																		
																														$result = sqlsrv_query($conn, $querysadetail);		
																														//$jumlah = sqlsrv_num_rows($result);
																														$row_count = 0;
																														while ($balance = sqlsrv_fetch_array($result)){
																															$row_count = $row_count + $balance['total_balance'];
																														}
																														
																														//$row_count = sqlsrv_num_rows($row);
																														//and (fd.kode_referensi = 'G-B/S001' or fd.kode_referensi = 'G-B/S002' or fd.kode_referensi = 'G-B/S003' or fd.kode_referensi = 'G-B/S004' or fd.kode_referensi = 'G-B/S005' or fd.kode_referensi = 'G-B/G118')
																													
																												
																												break;
																												
																												case "DUNLOP":  /////////////////////////////////////
																												
																													
																														
																														
																														$querysadetail = "select wo.penerima,f.Tanggal,
																																		
																																			Fd.* from srvt_faktur F
																																			left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																			left join srvt_wo WO on wo.nomor = F.nomor_wo
																																			
																																			where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'
																																			
																																			
																																			and wo.penerima = '$kode_sa' 
																																			and LEFT(fd.Kode_Referensi,5) = '$data_sa[kode_item]'
																																			and (fd.Nama_Referensi like '%DU%' or fd.Nama_Referensi like '%DLP%') 
																																			and f.batal = 0 order by f.tanggal ";
																																		
																														$result = sqlsrv_query($conn, $querysadetail);		
																														//$jumlah = sqlsrv_num_rows($result);
																														$row_count = 0;
																														while ($dunlop = sqlsrv_fetch_array($result)){
																															$row_count = $row_count + $dunlop['Qty'];
																														}
																														
																														//$row_count = sqlsrv_num_rows($row);
																													
																													
																												
																												break;
																												
																												case "BRIDGESTONE":  /////////////////////////////////////
																												
																													
																														
																														$querysadetail = "select wo.penerima,f.Tanggal,
																																		
																																			Fd.* from srvt_faktur F
																																			left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																			left join srvt_wo WO on wo.nomor = F.nomor_wo
																																			
																																			where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'																																			
																																			
																																			and wo.penerima = '$kode_sa' 
																																			and LEFT(fd.Kode_Referensi,5) = '$data_sa[kode_item]'
																																			and (fd.Nama_Referensi not like '%DU%' and fd.Nama_Referensi not like '%DLP%') 
																																			and f.batal = 0 order by f.tanggal ";
																																		
																														$result = sqlsrv_query($conn, $querysadetail);		
																														//$jumlah = sqlsrv_num_rows($result);
																														$row_count = 0;
																														while ($dunlop = sqlsrv_fetch_array($result)){
																															$row_count = $row_count + $dunlop['Qty'];
																														}
																														
																													
																												
																												break;
																												
																												case "DRESSING":  /////////////////////////////////////
																												
																														
																														$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																			left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																			left join srvt_wo WO on wo.nomor = F.nomor_wo
																																			
																																			where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'		
																																			
																																			
																																			and wo.penerima = '$kode_sa' 																																			
																																			and fd.Kode_Referensi = 'G-B/S107'
																																			and f.batal = 0 group by wo.penerima ";
																																		
																														$result = sqlsrv_query($conn, $querysadetail);		
																														$row_count = 0;
																														while ($data = sqlsrv_fetch_array($result)){
																															$row_count = $data['total'];
																														}
																													
																													
																												
																												break;
																												
																												case "QTY":  /////////////////////////////////////
																												
																													
																														
																														$querysadetail = "select sum(fd.Qty) as total from srvt_faktur F
																																			left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																			left join srvt_wo WO on wo.nomor = F.nomor_wo
																																			
																																			where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'		
																																			
																																			
																																			and wo.penerima = '$kode_sa' 
																																			and fd.Kode_Referensi = '$data_sa[kode_item]'																																			
																																			and f.batal = 0 group by wo.penerima ";
																																		
																														$result = sqlsrv_query($conn, $querysadetail);		
																														$row_count = 0;
																														while ($data = sqlsrv_fetch_array($result)){
																															$row_count = $data['total'];
																														}
																														
																													
																												
																												break;
																												
																												case "LEFT 2":  /////////////////////////////////////
																												
																												
																														
																														$query_left2 = mysql_query("select * from target_serviceadvisor_detail where kode_item = '$data_sa[kode_item]' and (substr(bulan,1,2) >= 
																														'$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
																														$row_count = 0 ;
																														while ($data_left2 = mysql_fetch_array($query_left2)){
																															
																															$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																															
																															$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																				left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																				left join srvt_wo WO on wo.nomor = F.nomor_wo
																																				
																																				where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'		
																																				
																																				
																																				and wo.penerima = '$kode_sa' 
																																				and LEFT(fd.Kode_Referensi,5) = '$data_left2[kode_item_detail]'
																																				and f.batal = 0 group by wo.penerima ";
																																			
																															$result = sqlsrv_query($conn, $querysadetail);		
																															
																															while ($data = sqlsrv_fetch_array($result)){
																																$row_count = $data['total'];
																															}
																														

																															
																														}
																														
																													
																												
																												break;
																												
																												case "STANDAR 2":  /////////////////////////////////////
																												
																													
																														
																														$query_standar2 = mysql_query("select * from target_serviceadvisor_detail where kode_item = '$data_sa[kode_item]' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
																														$row_count = 0 ;
																														$memberstarext = 0;
																														$memberstarnew = 0;
	
																														while ($data_left2 = mysql_fetch_array($query_standar2)){
																															$kode_item_standar = trim($data_left2['kode_item_detail']);
																															
																															
																															$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																				left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																				left join srvt_wo WO on wo.nomor = F.nomor_wo
																																				
																																				where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'		
																																				
																																				
																																				and wo.penerima = '$kode_sa' 
																																				and fd.Kode_Referensi = '$kode_item_standar'
																																				and f.batal = 0 group by wo.penerima ";
																																			
																															$result = sqlsrv_query($conn, $querysadetail);		
																															
																															while ($data_standar2 = sqlsrv_fetch_array($result)){
																																$row_count = $row_count + $data_standar2['total'];
																																if ($data_left2['kode_item'] == 'STAR MEMBER NEW'){
																																	$memberstarnew = $memberstarnew + $data_standar2['total'];
																																	
																																}
																																elseif ($data_left2['kode_item'] == 'STAR MEMBER EXT'){
																																	$memberstarext = $memberstarext + $data_standar2['total'];
																																	
																																}
																															}
																														
																														}
																														
																														
																													
																													
																												
																												break;
																												
																											}
																											
																											/*
																											if ($data_sa['kode_item'] == 'IU'){
																												
																													
																													$querysadetail = "select count(f.nomor) as total from srvt_faktur f
																															left join srvt_wo wo on wo.nomor = f.Nomor_WO 																														
																															where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'	
																																		
																															and wo.penerima = '$kode_sa' 
																															
																															and f.total != 0
																															and f.batal = 0 ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													$row_count = 0;
																													while ($data = sqlsrv_fetch_array($result)){
																														$row_count = $data['total'];
																													}
																													
																												
																											}
																											
																											*/
																											
																											
																											///SCREENING INCOMING UNIT=============================================
																											
																											if ($data_sa['kode_item'] == 'IU'){
																												
																													
																													$querysadetail = "select wo.NoPolisi,convert(varchar,wo.Tanggal,103) as tgl_wo,convert(varchar,f.Tanggal,103) as tgl_faktur, F.total from srvt_faktur f
																															left join srvt_wo wo on wo.nomor = f.Nomor_WO and wo.batal = 0																													
																															where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'	
																																		
																															and wo.penerima = '$kode_sa' 
																															and left(wo.keluhan,5) != 'KUPON' 
																															and f.total != 0
																															and f.batal = 0 order by wo.NoPolisi ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													$row_count = 0;
																													while ($data = sqlsrv_fetch_array($result)){
																														if ($data['NoPolisi'] == $nopolisi_sblm and ($data['tgl_wo'] == $tglwo_sblm or $data['tgl_faktur'] == $tglfaktur_sblm ) ){
																															
																															
																														}else{
																															$row_count = $row_count + 1;
																														}
																														
																														$nopolisi_sblm = $data['NoPolisi'];
																														$tglwo_sblm = $data['tgl_wo'];
																														$tglfaktur_sblm = $data['tgl_faktur'];
																													}
																													
																												
																											}
																											/////////////////===========================================================
																											
																											if ($data_sa['kode_item'] == 'JASA GR'){
																												
																													
																													$querysadetail = "select sum(fd.subtotal) as total from srvt_faktur F
																															left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																															left join srvt_wo WO on wo.nomor = F.nomor_wo
																																																																
																															where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'	
																																		
																																		
																																		and wo.penerima = '$kode_sa' 
																															and (fd.Jenis = 3 or fd.Jenis = 2)
																															
																															and f.batal = 0 group by wo.Penerima ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													
																													$row_count = 0;
																													$tot_jasa = 0;
																													while ($jasa = sqlsrv_fetch_array($result)){
																														$row_count = $jasa['total'];
																														$tot_jasa = $jasa['total'];
																													}
																													
																												
																											}
																											
																											if ($data_sa['kode_item'] == 'ATF CHANGER'){
																												$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																		left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																		left join srvt_wo WO on wo.nomor = F.nomor_wo
																																		
																																		where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'
																																		
																																		
																																		and wo.penerima = '$kode_sa'
																																		and fd.Kode_Referensi ='G-B/S112' 
																																		and f.batal = 0 group by wo.Penerima ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													
																													$row_count = 0;
																													while ($data = sqlsrv_fetch_array($result)){																													
																														$row_count = $data['total'];																														
																													}
																											}
																											
																											
																											if ($data_sa['kode_item'] == 'SPAREPART GR'){
																												
																													
																													$querysadetail = "select sum(fd.subtotal) as total from srvt_faktur F
																															left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																															left join srvt_wo WO on wo.nomor = F.nomor_wo
																																																																
																															where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'	
																																		
																																		
																																		and wo.penerima = '$kode_sa' 
																															and (fd.Jenis = 1 or fd.jenis = 4)
																															
																															and f.batal = 0 group by wo.Penerima ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													
																													$row_count = 0;
																													$tot_spart = 0;
																													while ($spart = sqlsrv_fetch_array($result)){
																														$row_count = $spart['total'];
																														$tot_spart = $spart['total'];
																													}
																													
																												
																												
																											}
																											
																											
																											
																											
																											//mysql_unbuffered_query("insert into rasio_sa_performance (bulan,kode_item,kode_kategori,nama_sa,total) values ('$data_sa[bulan]','$data_sa[kode_item]','$data_sa[kode_kategori]','$kode_sa','$ratio')");
																											
																											
																											//$ratio = round($ratio*100,2);
																											$ratio = $row_count/ceil($data_sa['target_unit']/$jml_sa);
																											
																											$ratio = ($ratio >= 1 ? 1 : $ratio);
																											if ($row_count == ""){
																												$ratio = '0' ; 
																												$total_point = '0';
																												
																												
																											}
																											
																											
																											if ($data_sa['kode_kategori'] == 'REVENUE'){
																												if ($ratio >= 1){
																													$total_point = $data_sa['target_point'];
																												}else{
																													$total_point = 0;
																												}
																												if ($total_point == 0){
																													$total_point = '0';
																												}
																												
																											}else{
																												$total_point = $row_count * $data_sa['target_point'];
																											}
																											
																											if ($data_sa['program'] == 'PPB'){
																												if ($point_ppb == 0){																													
																													$total_point = '0';
																												}else{
																													$total_point = $point_ppb;
																												}
																											}
																											
																											
																											if ($data_sa['program'] == 'POLES'){
																												if ($point_poles == 0){																													
																													$total_point = '0';
																												}else{
																													$total_point = $point_poles;
																												}
																											}
																											
																											
																											if ($ratio >= 1){
																												//echo "<td style='color:green'>".number_format($row_count,0,".",".")." / ".$total_point." / ".round($ratio*100,2) ."%</td>";
																												echo "<td><font color='green'>".number_format($row_count,0,".",".")."</font></td>";
																												
																												//echo "<td><font color='green'>".$row_count."</font></td>";
																												
																											}else{
																												//echo "<td>".number_format($row_count,0,".",".")." / ".$total_point." / ".round($ratio*100,2) ."%</td>";
																												echo "<td>".($row_count == 0 ? '' : number_format($row_count,0,".","."))."</td>";
																												
																												//echo "<td>".$row_count."</td>";
																											}
																											
																											
																											$tot_item = $tot_item + $row_count;
																											
																											
																											if ($total_point_kategori_semuasa == ""){
																												if ($total_point == 0){
																													$total_point_kategori_semuasa = "0";
																													
																												}else{
																													$total_point_kategori_semuasa = $total_point;
																												}
																											}else{
																												$total_point_kategori_semuasa = $total_point_kategori_semuasa.','. $total_point;
																											}
																											
																											/////////////////////
																													
																											if($total_rasio_kategori_semuasa == ''){
																												$total_rasio_kategori_semuasa = $ratio;
																												
																											}else{
																												$total_rasio_kategori_semuasa = $total_rasio_kategori_semuasa . "," . $ratio;
																											}
																											
																											
																											/////////////////// 
																											if ($data_sa['kode_item'] == 'IU'){
																												if ($gabung_tot_iu ==''){
																													$gabung_tot_iu = $row_count;


																												} else{
																													$gabung_tot_iu = $gabung_tot_iu . ",".$row_count;
																												}
																												$tot_iu_semua = $tot_iu_semua + $row_count;
																											}
																											
																											
																											/////////////////// 
																											
																											/////////////////// 
																											if ($data_sa['kode_item'] == 'JASA GR'){
																												if ($tot_mount_kategori_jasa ==''){
																													$tot_mount_kategori_jasa = $row_count;


																												} else{
																													$tot_mount_kategori_jasa = $tot_mount_kategori_jasa . ",".$row_count;
																												}
																												
																											}
																											
																											
																											/////////////////// 
																											if ($data_sa['kode_item'] == 'SPAREPART GR'){
																												if ($tot_mount_kategori_part ==''){
																													$tot_mount_kategori_part = $row_count;


																												} else{
																													$tot_mount_kategori_part = $tot_mount_kategori_part . ",".$row_count;
																												}
																											}
																											
																											if ($data_sa['kode_item'] == 'STAR MEMBER NEW'){
																												if ($gabung_memberstarnew ==''){
																													$gabung_memberstarnew = $memberstarnew;


																												} else{
																													$gabung_memberstarnew = $gabung_memberstarnew . ",".$memberstarnew;
																												}
																											}
																											
																											if ($data_sa['kode_item'] == 'STAR MEMBER EXT'){
																												if ($gabung_memberstarext ==''){
																													$gabung_memberstarext = $memberstarext;


																												} else{
																													$gabung_memberstarext = $gabung_memberstarext . ",".$memberstarext;
																												}
																											}
																											
																											
																										}
																										
																										
																										if ($data_sa['kode_item'] == "STAR MEMBER NEW" || $data_sa['kode_item'] == "STAR MEMBER EXT"){
																										
																											$query_star = mysql_query("select * from target_serviceadvisor_detail where kode_item = '$data_sa[kode_item]' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
																														$row_count_cecep = 0 ;
																														$row_count_cecep_total = 0 ;
																														
																														while ($data_left2 = mysql_fetch_array($query_star)){
																															$kode_item_standar = trim($data_left2['kode_item_detail']);
																															
																															
																															$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																				left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																				left join srvt_wo WO on wo.nomor = F.nomor_wo
																																				
																																				where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'		
																																				
																																				
																																				and wo.penerima = 'CECEP' 
																																				and fd.Kode_Referensi = '$kode_item_standar'
																																				and f.batal = 0 group by wo.penerima ";
																																			
																															$result = sqlsrv_query($conn, $querysadetail);		
																															
																															while ($data_standar2 = sqlsrv_fetch_array($result)){
																																$row_count_cecep = $row_count_cecep + $data_standar2['total'];
																																$row_count_cecep_total = $row_count_cecep_total + ($data_standar2['total'] + $data_sa['total_point']);
																															}
																														
																														}
																										
																										}else{
																											$row_count_cecep = 0 ;
																										}
																										
																										echo "<td>".($row_count_cecep == 0 ? '' : $row_count_cecep) ."</td>";
																										
																										if ($data_sa['kode_item'] == "STAR MEMBER NEW" || $data_sa['kode_item'] == "STAR MEMBER EXT"){
																										
																											$query_star = mysql_query("select * from target_serviceadvisor_detail where kode_item = '$data_sa[kode_item]' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
																														$row_count_ponco = 0 ;
																														$row_count_ponco_total = 0 ;
																														
																														while ($data_left2 = mysql_fetch_array($query_star)){
																															$kode_item_standar = trim($data_left2['kode_item_detail']);
																															
																															
																															$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																				left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																				left join srvt_wo WO on wo.nomor = F.nomor_wo
																																				
																																				where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'		
																																				
																																				
																																				and wo.penerima = 'PONCO' 
																																				and fd.Kode_Referensi = '$kode_item_standar'
																																				and f.batal = 0 group by wo.penerima ";
																																			
																															$result = sqlsrv_query($conn, $querysadetail);		
																															
																															while ($data_standar2 = sqlsrv_fetch_array($result)){
																																$row_count_ponco = $row_count_ponco + $data_standar2['total'];
																																$row_count_ponco_total = $row_count_ponco_total + ($data_standar2['total'] * $data_sa['target_point']);
																															}
																														
																														}
																										
																										}elseif ($data_sa['kode_item'] == 'PM PACKAGE'){
																											$querysadetail = "select wo.penerima,f.tanggal,fd.* from srvt_faktur F
																																		left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																		left join srvt_wo WO on wo.nomor = F.nomor_wo
																																		
																																		where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'		
																																		
																																		
																																		and wo.penerima = 'PONCO' 																																
																																		and fd.Nama_Referensi like '%PPB%'
																																		and f.batal = 0  ";
																																	
																													$result_ppb = sqlsrv_query($conn, $querysadetail);		
																													$row_count = 0;
																													$point_ppb = 0;
																													
																													while ($data = sqlsrv_fetch_array($result_ppb)){
																														
																														$query_package = mysql_query("select * from target_pmpackagedua where kode_item = '$data[Kode_Referensi]' and bulan = '$bulan1'");
																														
																														while($data_pm = mysql_fetch_array($query_package)){	
																															
																																$row_count_ponco = $row_count_ponco  + 1 ;
																																$row_count_ponco_total = $row_count_ponco_total + $data_pm['point'];
																															
																															
																															
																														}
																														
																													}
																										}else{
																											$row_count_ponco = 0 ;
																										}
																										
																										$subtotal_sa = $tot_item + $row_count_cecep + $row_count_ponco;
																										
																										echo "<td>".($row_count_ponco == 0 ? '' : $row_count_ponco)."</td>";
																										if ($subtotal_sa >= $data_sa['target_unit']){
																											echo "<td><font color='green'> ".number_format($subtotal_sa,0,".",".")."</green></td>";
																											
																										}else{
																											echo "<td>".number_format($subtotal_sa,0,".",".")."</td>";
																										}
																										
																										echo "</tr>";
																										
																										//$tot_point_kategori = $tot_point_kategori .','. $tot_point;
																										
																										
																										$no++;
																								}
																								
																								
																								if($gabung_kategori == ''){
																									$gabung_kategori = $total_rasio_kategori_semuasa;
																									
																								}else{
																									$gabung_kategori = $gabung_kategori . ',' . $total_rasio_kategori_semuasa;
																								}
																								
																								$split_gabung_kategori = split(",",$gabung_kategori);
																								
																								
																								
																								if($gabung_point_kategori == ''){
																									$gabung_point_kategori = $total_point_kategori_semuasa;
																									
																								}else{
																									$gabung_point_kategori = $gabung_point_kategori . ',' . $total_point_kategori_semuasa;
																								}
																								
																								$split_point_kategori = split(",",$gabung_point_kategori);
																								
																									
																							?>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo $kategori; ?></td>
																							<?php
																								$query7 = mysql_query("select nama_sa from target_serviceadvisor where bulan = '$bulan1' group by nama_sa order by nama_sa ");
																								$rec_sa = mysql_num_rows($query7);
																								
																								$no2 = 0;
																								$total_rasio_kategori_semuasa = 0;
																								$total_point_kategori_semuasa = 0;
																								
																								while ($data_query7 = mysql_fetch_array($query7)){
																									//echo "<td>".$data[nama_sa]."</td>";
																									$kode_sa = $data_query7['nama_sa'];
																									
																									
																									$query8 = mysql_query("select * from target_serviceadvisor where bulan = '$bulan1' and kode_kategori = '$kategori' and nama_sa = '$kode_sa' ");
																									$rec = mysql_num_rows($query8);
																									
																									$no3 = 0;
																									$total_rasio_kategori_persa = 0;
																									$total_point_kategori_persa = 0;
																									$fix_pembagi = 0;
																									while ($data = mysql_fetch_array($query8) ){
																										$total_rasio_kategori_persa = $total_rasio_kategori_persa + round($split_gabung_kategori[($no3 * $rec_sa)+$no2]*100,2);
																										$total_point_kategori_persa = $total_point_kategori_persa + $split_point_kategori[($no3 * $rec_sa)+$no2];
																										
																										if ($no3 == 0){
																											if ($total_point_kategori_extra == ''){
																												$total_point_kategori_extra = $split_point_kategori[($no3 * $rec_sa)+$no2];
																											}else{
																												$total_point_kategori_extra = $total_point_kategori_extra .",". $split_point_kategori[($no3 * $rec_sa)+$no2];
																											}
																										}
																										$fix_pembagi = $fix_pembagi + $data['fix_pembagi'];
																										$no3++;
																									}
																									
																									
																									//$total_rasio_kategori_persa = round(($total_rasio_kategori_persa / ($no-1))*100,2);
																									//$total_rasio_kategori_persa = round(($total_rasio_kategori_persa / $fix_pembagi)*100,2);
																									$total_rasio_kategori_persa = round($total_rasio_kategori_persa / $fix_pembagi,2);
																									
																									
																									//echo "<td style='background-color:darkgrey;'>". $total_rasio_kategori_persa."--".$total_point_kategori_persa ."%</td>";
																									
																									
																									echo "<td style='background-color:darkgrey;'>".$total_rasio_kategori_persa."% / ". $total_point_kategori_persa ."</td>";
																									//echo "<td style='background-color:darkgrey;'>".$total_rasio_kategori_persa."%</td>";
																									
																									
																									//$rasio_kategori = round($split_gabung_kategori[$no2]/($no-1),2)*100;
																									if($gabung_total_rasio_kategori_persa == ''){
																										if ($total_rasio_kategori_persa == '0'){
																											$gabung_total_rasio_kategori_persa = '0';
																										}else{
																											$gabung_total_rasio_kategori_persa = $total_rasio_kategori_persa;
																										}
																									}else{
																										$gabung_total_rasio_kategori_persa = $gabung_total_rasio_kategori_persa .','.$total_rasio_kategori_persa ;
																									}
																									
																									if ($kategori == "EXTRA CARE"){
																										$rasio_extracare = $gabung_total_rasio_kategori_persa;																										
																									}
																									
																									
																									if ($kategori == "PLUS +"){
																										if($gabung_plus == ''){
																											if ($gabung_plus == '0'){
																												$gabung_plus = '0';
																											}else{
																												$gabung_plus = $total_rasio_kategori_persa;
																											}
																										}else{
																											$gabung_plus = $gabung_plus .','.$total_rasio_kategori_persa ;
																										}

																									
																										$rasio_plus = $gabung_plus;																									
																									}
																									
																									if ($kategori == "ENGINE OIL"){
																										if($gabung_engineoil == ''){
																											if ($gabung_engineoil == '0'){
																												$gabung_engineoil = '0';
																											}else{
																												$gabung_engineoil = $total_rasio_kategori_persa;
																											}
																										}else{
																											$gabung_engineoil = $gabung_engineoil .','.$total_rasio_kategori_persa ;
																										}

																									
																										$rasio_engineoil = $gabung_engineoil;																									
																									}
																									
																									
																									if ($kategori == "OTHERS"){
																										if($gabung_others == ''){
																											if ($gabung_others == '0'){
																												$gabung_others = '0';
																											}else{
																												$gabung_others = $total_rasio_kategori_persa;
																											}
																										}else{
																											$gabung_others = $gabung_others .','.$total_rasio_kategori_persa ;
																										}

																									
																										$rasio_others = $gabung_others;																									
																									}
																									
																									if ($kategori == "REVENUE"){
																										if($gabung_revenue == ''){
																											if ($gabung_revenue == '0'){
																												$gabung_revenue = '0';
																											}else{
																												$gabung_revenue = $total_rasio_kategori_persa;
																											}
																										}else{
																											$gabung_revenue = $gabung_revenue .','.$total_rasio_kategori_persa ;
																										}

																									
																										$rasio_revenue = $gabung_revenue;																									
																									}
																									
																									
																									if($gabung_total_point_kategori_persa == ''){
																										if ($total_point_kategori_persa == 0){
																											$gabung_total_point_kategori_persa = "0";
																											
																										}else{
																											$gabung_total_point_kategori_persa = $total_point_kategori_persa;
																										}
																									}else{
																										$gabung_total_point_kategori_persa = $gabung_total_point_kategori_persa .','.$total_point_kategori_persa ;
																									}
																									
																									
																									
																									$total_rasio_kategori_semuasa = $total_rasio_kategori_semuasa + $total_rasio_kategori_persa;
																									$total_point_kategori_semuasa = $total_point_kategori_semuasa + $total_point_kategori_persa;
																									
																									$no2 ++;
																								}
																							echo "<td style='background-color:darkgrey;'></td>";	
																							echo "<td style='background-color:darkgrey;'></td>";
																							echo "<td style='background-color:darkgrey;'>". round($total_rasio_kategori_semuasa/$no2,2) ."%</td>";
																							
																							?>
																						</tr>
																						
																			<?php		
																					}
																			?>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "TOTAL LABOUR COST + SPAREPART"; ?></td>
																							<?php 
																								$query = mysql_query("select nama_sa from target_serviceadvisor where bulan = '$bulan1' group by nama_sa ");
																								$no_amount_revenue = 0;
																								
																								$split_tot_mount_kategori_jasa = split(",",$tot_mount_kategori_jasa);
																								$split_tot_mount_kategori_part = split(",",$tot_mount_kategori_part);
																								$total_revenue = 0;
																								while ($data = mysql_fetch_array($query)){
																									$kode_sa = $data['nama_sa'];
																									$total = $split_tot_mount_kategori_jasa[$no_amount_revenue] + $split_tot_mount_kategori_part[$no_amount_revenue];
																									
																									echo "<td style='background-color:darkgrey;'>".number_format($total,0,".",".")."</td>";
																									
																									
																									if($gabung_total_amount == ''){
																										$gabung_total_amount = $total;
																										
																									}else{
																										$gabung_total_amount = $gabung_total_amount .",". $total;
																									}
																									
																									$total_revenue = $total_revenue + $total;
																									$no_amount_revenue ++;		
																								}
																								echo "<td style='background-color:darkgrey;'></td>";
																								echo "<td style='background-color:darkgrey;'></td>";
																								echo "<td style='background-color:darkgrey;'>".number_format($total_revenue,0,".",".")."</td>";
																							?>
																							
																							
																							
																						</tr>	
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "TOTAL ACCHIEVEMENT BY POINT"; ?>
																							
																							
																							<?php
																							//$total_point_kategori_semuasa
																								
																								
																								$query = mysql_query("select nama_sa from target_serviceadvisor where bulan = '$bulan1' group by nama_sa ");
																								$rec_sa = mysql_num_rows($query);
																								
																								$split_gabung_total_point_kategori_persa = split(",",$gabung_total_point_kategori_persa);
																							
																								$no_sa = 0;
																								while ($data = mysql_fetch_array($query)){
																									$kode_sa = $data['nama_sa'];
																									
																									$query2 = mysql_query("select kode_kategori from target_serviceadvisor where nama_sa = '$kode_sa' and bulan = '$bulan1' group by kode_kategori order by urutan");
																									$rec = mysql_num_rows($query2);
																									
																									$total_point = 0;
																									$total_semua_point_kategori = 0;
																									
																									$extra = 0;
																									
																									$no_kategori = 0;
																									while ($no_kategori < $rec){
																										
																										$total_semua_point_kategori = $total_semua_point_kategori + $split_gabung_total_point_kategori_persa[($no_kategori * $rec_sa)+$no_sa];
																										
																										
																										
																										
																										if ($no_kategori == 0){
																											$extra = $extra + $split_gabung_total_point_kategori_persa[($no_kategori * $rec_sa)+$no_sa];
																										}
																										
																										$no_kategori ++;
																									}
																									$total_point = $total_semua_point_kategori - $extra ;
																									$total_semua = $total_semua + $total_point;
																									
																									///UNTUK ARRAY KE PERHITUNGAN GROSS ACHIEVEMENT////////////
																									if ($group_point_kategori ==''){
																										$group_point_kategori = $total_point;
																									}else{
																										$group_point_kategori = $group_point_kategori .",".$total_point;
																									}
																									
																									if ($group_point_kategori_extra ==''){
																										$group_point_kategori_extra = $extra;
																									}else{
																										$group_point_kategori_extra = $group_point_kategori_extra .",".$extra;
																									}
																									
																									
																									
																									//////////////////////////////////////
																									
																									echo "<td style='background-color:darkgrey;'>".number_format($total_point,2,",",",")."</td>";
																									
																									$no_sa ++;			
																								}
																								echo "<td style='background-color:darkgrey;'></td>";
																								echo "<td style='background-color:darkgrey;'></td>";
																								echo "<td style='background-color:darkgrey;'>".number_format($total_semua,2,",",",")."</td>";
																							?>
																							
																							
																							
																							</td>
																						</tr>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "TOTAL ACCHIEVEMENT BY RATIO"; ?>
																							
																							<?php
																							
																								$query = mysql_query("select nama_sa from target_serviceadvisor where bulan = '$bulan1' group by nama_sa ");
																								$rec_sa = mysql_num_rows($query);
																								
																								$split_gabung_total_rasio_kategori_persa = split(",",$gabung_total_rasio_kategori_persa);
																							
																								$no_sa = 0;
																								$total_semua = 0;
																								while ($data = mysql_fetch_array($query)){
																									$kode_sa = $data['nama_sa'];
																									
																									$query2 = mysql_query("select kode_kategori from target_serviceadvisor where nama_sa = '$kode_sa' and bulan = '$bulan1' group by kode_kategori order by urutan");
																									$rec = mysql_num_rows($query2);
																									
																									
																									$total_semua_rasio_kategori = 0;
																									$chemical = 0;
																									
																									
																									
																									$no_kategori = 0;
																									while ($no_kategori < $rec){
																										
																										$total_semua_rasio_kategori = $total_semua_rasio_kategori + $split_gabung_total_rasio_kategori_persa[($no_kategori * $rec_sa)+$no_sa];
																										
																										
																										if ($no_kategori == '3'){
																											$chemical = $chemical + $split_gabung_total_rasio_kategori_persa[($no_kategori * $rec_sa)+$no_sa];
																										}
																										
																										$no_kategori ++;
																									}
																									$total = round(($total_semua_rasio_kategori - $chemical) / ($no_kategori-1),2) ;
																									$total_semua = $total_semua + $total;
																									///UNTUK ARRAY KE PERHITUNGAN GROSS ACHIEVEMENT////////////
																									IF($group_rasio_kategori == ''){
																										$group_rasio_kategori = $total;
																									}else{
																										$group_rasio_kategori = $group_rasio_kategori .",".$total;
																									}
																									
																									
																									//--------------bates yang atas-----------
																									
																									
																									echo "<td style='background-color:darkgrey;'>".$total."%</td>";
																									
																									$no_sa ++;			
																								}
																								
																								
																								
																								echo "<td style='background-color:darkgrey;' colspan = '3'>".round(($total_semua / $no_sa),2)."%</td>";
																							?>
																							
																							</td>
																						</tr>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "TOTAL GROSS ACCHIEVEMENT"; ?>
																							
																							<?php
																							
																								$query = mysql_query("select nama_sa from target_serviceadvisor where bulan = '$bulan1' group by nama_sa ");
																								$rec_sa = mysql_num_rows($query);
																								
																								$split_group_point_kategori = split(",",$group_point_kategori);
																								$split_group_rasio_kategori = split(",",$group_rasio_kategori);
																								$split_total_point_kategori_extra = split(",",$group_point_kategori_extra);
																							
																								$no_sa = 0;
																								$total_semua = 0;
																								while ($data = mysql_fetch_array($query)){
																									
																									
																									
																									$query2 = mysql_query("select kode_kategori from target_serviceadvisor where nama_sa = '$kode_sa' and bulan = '$bulan1' group by kode_kategori order by urutan");
																									$rec = mysql_num_rows($query2);
																									
																									
																									$total_semua_point_kategori = 0;
																									$chemical = 0;
																									
																									$no_kategori = 0;
																									while ($no_kategori < $rec){
																										
																										$total_semua_point_kategori = $total_semua_point_kategori + $split_gabung_total_point_kategori_persa[($no_kategori * $rec_sa)+$no_sa];
																										
																										
																										
																										
																										if ($no_kategori == '0'){
																											$extra = $extra + $split_gabung_total_point_kategori_persa[($no_kategori * $rec_sa)+$no_sa];
																										}
																										
																										$no_kategori ++;
																									}
																									
																									
																									$total_gross = (($split_group_point_kategori[$no_sa]*($split_group_rasio_kategori[$no_sa]/100))+$split_total_point_kategori_extra[$no_sa])*1000;
																									//echo "<td style='background-color:darkgrey;'>".$split_group_point_kategori[$no_sa]."--".$split_group_rasio_kategori[$no_sa]."--".$split_total_point_kategori_extra[$no_sa]."</td>";
																									
																									
																									$total_semua = $total_semua + $total_gross;
																									
																									echo "<td style='background-color:darkgrey;'>".number_format($total_gross,0,",",",")."</td>";
																									
																									if($gabung_total_gross == ''){
																										$gabung_total_gross = $total_gross;
																									}else{
																										$gabung_total_gross = $gabung_total_gross .",".$total_gross;
																									}
																									
																									$no_sa ++;			
																								}
																								$ponco = $total_semua*0.3*0.55;
																								$cecep = $total_semua*0.3*0.45;
																								
																								
																								
																								echo "<td style='background-color:darkgrey;'>".number_format($cecep,0,",",",")."</td>";
																								echo "<td style='background-color:darkgrey;'>".number_format($ponco,0,",",",")."</td>";
																								echo "<td style='background-color:darkgrey;'>".number_format($total_semua + $cecep + $ponco,0,",",",")."</td>";
																							?>
																							</td>
																						</tr>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "TOTAL ACCHIEVEMENT INCENTIVE"; ?>
																							<?php
																							
																								$query = mysql_query("select nama_sa from target_serviceadvisor where bulan = '$bulan1' group by nama_sa ");
																								$rec_sa = mysql_num_rows($query);
																								
																								
																								$split_gabung_total_gross = split(",",$gabung_total_gross);
																								
																								$split_gabung_memberstarnew = split(",",$gabung_memberstarnew);
																								$split_gabung_memberstarext = split(",",$gabung_memberstarext);
																							
																								$no_sa = 0;
																								$total_semua_incentif = 0;
																								while ($data = mysql_fetch_array($query)){
																									
																									$insentif = $split_gabung_total_gross[$no_sa]*0.7;
																									$penguran_insentif = $insentif * 0.1;
																									
																									//echo "<td style='background-color:darkgrey;'>".number_format($insentif - $penguran_insentif - ( ($split_gabung_memberstarnew[$no_sa]*10000) + ($split_gabung_memberstarext[$no_sa] * 10000) ),0,",",",")." - ".$split_gabung_memberstarnew[$no_sa]." - ".$split_gabung_memberstarext[$no_sa]."</td>";
																									echo "<td style='background-color:darkgrey;'>".number_format($insentif - $penguran_insentif - ( ($split_gabung_memberstarnew[$no_sa]*10000) + ($split_gabung_memberstarext[$no_sa] * 10000) ),0,",",",")."</td>";
																									
																									$total_semua_incentif = $total_semua_incentif + ($insentif - $penguran_insentif);
																									
																									$no_sa ++;			
																								}
																								
																								$tot_incentif_cecep = $cecep + ($row_count_cecep_total * 1000);
																								$tot_incentif_ponco = $ponco + ($row_count_ponco_total * 1000);
																								
																								echo "<td style='background-color:darkgrey;'>".number_format($tot_incentif_cecep - ($tot_incentif_cecep*0.1),0,",",",")."</td>";
																								echo "<td style='background-color:darkgrey;'>".number_format($tot_incentif_ponco - ($tot_incentif_ponco * 0.1),0,",",",")."</td>";
																								echo "<td style='background-color:darkgrey;'>".number_format($total_semua_incentif + $tot_incentif_cecep - ($tot_incentif_cecep*0.1) + $tot_incentif_ponco - ($tot_incentif_ponco * 0.1),0,",",",")."</td>";
																							?>
																							
																							
																							</td>
																						</tr>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "INCOME PER-UNIT"; ?>
																							
																							<?php
																							
																								$query = mysql_query("select nama_sa from target_serviceadvisor where bulan = '$bulan1' group by nama_sa ");
																								$rec_sa = mysql_num_rows($query);
																								
																								
																								$split_gabung_total_amount = split(",",$gabung_total_amount);
																								$split_gabung_tot_iu = split(",",$gabung_tot_iu);
																								
																								$no_sa = 0;
																								$total_semua = 0;
																								while ($data = mysql_fetch_array($query)){
																									
																									
																									
																									$rasio_iu = round($split_gabung_total_amount[$no_sa] / $split_gabung_tot_iu[$no_sa],2);
																									
																									echo "<td style='background-color:darkgrey;'>".number_format($rasio_iu,0,",",",")."</td>";
																									
																									$total_semua = $total_semua + $insentif;
																									
																									$no_sa ++;			
																								}
																								
																								echo "<td style='background-color:darkgrey;' colspan = '3'>".number_format($total_revenue/$tot_iu_semua,0,",",",")."</td>";
																							?>
																							
																							
																							</td>
																						</tr>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "SA EFFICIENCY "; ?>
																							<?php
																							
																								$query = mysql_query("select nama_sa from target_serviceadvisor where bulan = '$bulan1' group by nama_sa ");
																								$rec_sa = mysql_num_rows($query);
																								
																								
																								$split_gabung_total_amount = split(",",$gabung_total_amount);
																								$split_gabung_tot_iu = split(",",$gabung_tot_iu);
																								
																								$no_sa = 0;
																								$total_semua = 0;
																								while ($data = mysql_fetch_array($query)){
																									
																									
																									
																									$effisien_sa = round($split_gabung_tot_iu[$no_sa] /25,2);
																									
																									echo "<td style='background-color:darkgrey;'>".number_format($effisien_sa,0,",",",")."</td>";
																									
																									$total_semua = $total_semua + $effisien_sa;
																									
																									$no_sa ++;			
																								}
																								
																								echo "<td style='background-color:darkgrey;' colspan = '3'>".number_format($total_semua/$no_sa,0,",",",")."</td>";
																							?>
																							</td>
																						</tr>
																		</tbody>
																	</table>
																</div>
														</div>
													</div>
													
													<?php
														$query_sa = mysql_query("select nama_sa from target_serviceadvisor where bulan = '$bulan1' group by nama_sa ");
														$nama_sa = '';
														while($data = mysql_fetch_array($query_sa)){
															if ($nama_sa == ''){
																$nama_sa = $data['nama_sa'];
															}else{
																$nama_sa = $nama_sa .",".$data['nama_sa'];
															}
															
														}
													?>
													<script>
														var nama_sa = "<?php echo $nama_sa; ?>";
														var point_semua_sa = "<?php echo $group_point_kategori; ?>";
														var rasio_extracare = "<?php echo $rasio_extracare; ?>";
														var rasio_plus = "<?php echo $rasio_plus; ?>";
														var rasio_engineoil = "<?php echo $rasio_engineoil; ?>";
														var rasio_others = "<?php echo $rasio_others; ?>";
														var rasio_revenue = "<?php echo $rasio_revenue; ?>";
														
														
													</script>
													
													<div id="chart" class="tab-pane padding-bottom-5 active" >
														<div class = "row">
															<div class = "col-md-6">
															<h1 class="mainTitle">Acchievement By Point</h1>
																
																		<canvas id="barChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="barLegend" class="chart-legend"></div>
																		</div>
																	
															</div>
															
															<div class = "col-md-6">
															<h1 class="mainTitle">Extra Care</h1>
																
																		<canvas id="lineChart2" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="lineLegend2" class="chart-legend"></div>
																		</div>
																	
															</div>
														</div>
														<div class = "row">
															<div class = "col-md-6">
															<h1 class="mainTitle">Plus Plus</h1>
																
																		<canvas id="barChart2" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="barLegend2" class="chart-legend"></div>
																		</div>
																	
															</div>
															
															<div class = "col-md-6">
															<h1 class="mainTitle">Engine OIL</h1>
																
																		<canvas id="lineChart3" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="lineLegend3" class="chart-legend"></div>
																		</div>
																	
															</div>
														</div>
														<div class = "row">
															<div class = "col-md-6">
															<h1 class="mainTitle">Others</h1>
																
																		<canvas id="barChart3" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="barLegend3" class="chart-legend"></div>
																		</div>
																	
															</div>
															
															<div class = "col-md-6">
															<h1 class="mainTitle">Revenue</h1>
																
																		<canvas id="lineChart4" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="lineLegend4" class="chart-legend"></div>
																		</div>
																	
															</div>
														</div>
														<!--div class = "row">
															<div class = "col-md-6">
															<h1 class="mainTitle">Cash VS Leasing</h1>
																
																		<canvas id="pieChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="pieLegend" class="chart-legend"></div>
																		</div>
																	
															</div>
															<div class = "col-md-6">
															<h1 class="mainTitle">Leasing Company</h1>
																
																		<canvas id="doughnutChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="doughnutLegend" class="chart-legend"></div>
																		</div>
																	
															</div>
														</div-->
														
														
													</div>
													
													<div id="PM_PACKAGE" class="tab-pane padding-bottom-5" >
															<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center; border-collapse:collapse" >
																		<thead>
																			<tr>
																				<td width="30" height="29">NO</td>
																			    <td>TIPE</td>
																				<td>PERIODE</td>	
																				
																				
																				<td>OIL</td>
																			   							
																				
																				<td>P</td>
																				
																				
																				<?php   
																					$query_sa = mysql_query("select nama_sa from target_serviceadvisor where bulan = '$bulan1' group by nama_sa ");
																					
																					while ($data_sa = mysql_fetch_array($query_sa)){
																						echo "<td>$data_sa[nama_sa]</td>";
																						
																					}
																				
																				
																				?>
																				
																			</tr>
																		</thead>
																		<tbody>
													
														<?PHP
																	
																	$nomor = 1;																	
																	
																	$query = mysql_query("select * from target_pmpackage where bulan = '$bulan1'");
																	
																	while ($data = mysql_fetch_array($query)){
																		echo "<tr>";
																		
																		echo "<td>$nomor</td>";
																		echo "<td>".$data['type_item']."</td>";
																		echo "<td>".$data['periode']."</td>";
																		echo "<td>".$data['oil']."</td>";
																		echo "<td>".$data['point']."</td>";
																		
																		
																		
																		$query_sa = mysql_query("select nama_sa from target_serviceadvisor where bulan = '$bulan1' group by nama_sa ");
																		while ($data_sa = mysql_fetch_array($query_sa)){																						
																			$kode_sa = $data_sa['nama_sa'];
																			$row_count = 0;
																			$query_2 = mysql_query("select kode_item from target_pmpackagedua where grup = '$data[group_type]' and periode = '$data[periode]' and oil = '$data[oil]' and bulan = '$bulan1' ");
																			
																			while ($data_2 = mysql_fetch_array($query_2)){
																			
																				$kode_item = $data_2['kode_item'];
																				
																				$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																						left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																						left join srvt_wo WO on wo.nomor = F.nomor_wo
																																														
																						where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'
																																														
																																														
																						and wo.penerima	= '$kode_sa'																														
																						and fd.Kode_Referensi = '$kode_item'
																						and f.batal = 0  group by wo.penerima ";
																																													
																				$result_ppb = sqlsrv_query($conn, $querysadetail);		
																				
																				while ($data_pm = sqlsrv_fetch_array($result_ppb)){
																					
																			
																					$row_count = $row_count + $data_pm['total'];
																				}
																				
																				
																			}
																			echo "<td>". ($row_count == 0 ? '' : $row_count) ."</td>";
																		}
																		echo "</tr>";
																		$nomor ++;
																	}
																				
																				
																			
																					
																					
																				
																		
																			
														?>	
																		</tbody>
																	</table>
															</div>	
													</div>
													<!--div id="POLES" class="tab-pane padding-bottom-5" >
															<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center; border-collapse:collapse" >
																		<thead>
																			<tr>
																				<td width="30" height="29">NO</td>
																			    <td>PAKET</td>												
																				
																				<td>JENIS</td>
																				<td>POINT</td>
																			   							
																				
																				
																				<td>QTY</td>	
																				
																															
																			</tr>
																		</thead>
																		<tbody>
													
														<?PHP
															$query5 = mysql_query("select * from target_poles where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and
															(substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
															$nomor = 1;
															while ($data = mysql_fetch_array($query5)){
														?>
															<tr>
																	<td><?php echo $nomor; ?></td>	
																	<td><?php echo $data['paket'] ?></td>	
																	<td><?php echo $data['jenis'] ?></td>
																	<td><?php echo $data['point'] ?></td>
																	
																	<td>0</td>
																		
															</tr>			
																		
																	
														<?php
														$nomor ++;
															}
														?>
																		</tbody>
																	</table>
															</div>	
														
													</div-->
													
													
													
													
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
			
	<?php 
		break;
		
}
} ?>