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
		//$bulan_sekarang = date("m-Y");
		//include "class_hitung_incentif.php"; 
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
									<span class="mainDescription">Performance Service Advisor BP
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
											<input type = "hidden" name="module" value = "service_summary_service_semua_sa_bp" />
											
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
												    <!--li class="active padding-top-5 padding-left-5"> 
														<a data-toggle="tab" href="#chart">
															GRAFIK
														</a>
													</li>
												    <!--li class="padding-top-5">
														<a data-toggle="tab" href="#incentif">
															SS PERFORMANCE
														</a>
													</li-->
													<li class="active padding-top-5">
														<a data-toggle="tab" href="#INCENTIF_SA">
															INCENTIF
														</a>
													</li>
													<!--li class="padding-top-5">
														<a data-toggle="tab" href="#PM_PACKAGE">
															PM PACKAGE
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#POLES">
															POLES
														</a>
													</li-->
												
													
												</ul>
												
												<div class="tab-content">
													
													
													
													
													
													<div id="<?php echo "INCENTIF_SA"; ?>" class="active tab-pane padding-bottom-5"> 
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
																				<td>TGT SA BP</td>
																				<td>P</td>
																			    <?php 
																					$query5 = mysql_query("select * from target_serviceadvisor_bp where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') 
																					and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by nama_bp ");
																						  
																			        while ($data_sa = mysql_fetch_array($query5)){
																						
																						echo "<td>".$data_sa['nama_bp']."</td>";
																						
																			        }
																			    ?>
																				<?php
																					$query_jcbp = mysql_query("select * from jc_bp where bulan = '$bulan1'");
																					while ($data_jcbp = mysql_fetch_array($query_jcbp)){
																						echo "<td>$data_jcbp[nama_jc]</td>";
																					}
																				?>

																				
																				
																				<td>TOTAL</td>
																				
																															
																			</tr>
																		</thead>
																		<tbody>
																			<?php
																				$query_sa2 = mysql_query("SELECT * FROM target_semua_sa_bp where bulan = '$bulan1'  group by kode_kategori order by urutan ");
																				
																				 while ($data_sa2 = mysql_fetch_array($query_sa2))
																			        {
																						
																						$kategori = $data_sa2['kode_kategori'];
																			?>
																						
																							<?php
																								$query5 = mysql_query("select * from target_semua_sa_bp where bulan = '$bulan1' and kode_kategori = '$kategori' order by urutan ");
																								$no = 1;
																								$row_count = 0;
																								$tot_point_kategori = '';
																								
																								
																								
																								//misahin nama sa.. belom ada ide lagi jadi gini dulu dah................///////////////////////
																							
																								
																								$gabung_kategori = '';
																								$total_rasio_kategori_semuasa = '';
																								$total_point_kategori_semuasa = '';
																								$gabung_point_kategori = '';
																								
																								
																								while ($data_sa = mysql_fetch_array($query5)){
																									
																										$kode_item = $data_sa['kode_item'];
																										
																										$query6 = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
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
																											
																											
																											$kode_bp = $data_query6['nama_bp'];
																											$program = $data_sa['program'];
																											
																											switch ($program){
																												
																											
																												
																												case "POLES":  /////////////////////////////////////
																												
																													if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																														$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																														
																														$querysadetail = "select wo.penerima,f.Tanggal,
																																			Fd.* from SrvT_FakturBodyRepair F
																																			left join SrvT_FakturBodyRepairDetail FD on fd.Nomor_FakturBody = f.Nomor
																																			left join SrvT_WOBodyRepair WO on wo.nomor = F.Nomor_WOBody
																																												
																																					where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'
																																					
																																					
																																					and wo.penerima = '$kode_bp' 
																																					and fd.Nama_Referensi like '%POLES%' 
																																					and fd.jenis = '3'
																																					
																																					and f.batal = 0 order by f.tanggal ";
																																				
																														$result = sqlsrv_query($conn, $querysadetail);		
																														$row_count = 0;
																														$point_count_poles = 0;		
																														while ($data = sqlsrv_fetch_array($result)){
																															$harga_poles = $data['SubTotal'];
																															
																															$query_package = mysql_query("select * from target_poles_bp where kode_item = '$data[Kode_Referensi]' and grup = '$kode_item' and bulan = '$bulan1'");
																													
																															while($data_poles = mysql_fetch_array($query_package)){	
																																	$row_count = $row_count + 1 ;
																																	$point_count_poles = $point_count_poles + $data_poles['target_point'];
																															}
																																	
																														}
																														
																													}else {
																														$row_count = "-";
																														$point_count_poles = 0;
																													}
																												
																												break;
																												
																											}
																											
																											
																											
																											
																											if ($data_sa['kode_item'] == 'INCOMING UNIT'){
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													//$tglakhir = "2017-12-".$tanggalan ;
																													
																													$querysadetail = "select count(f.nomor) as total from SrvT_FakturBodyRepair F
																																	left join SrvT_WOBodyRepair WO on wo.nomor = F.Nomor_WOBody																													
																															
																																	where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'																																			
																																	and wo.penerima = '$kode_bp' 																															
																																	and f.batal = 0 ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																																																									
																													while($data = sqlsrv_fetch_array($result)){	
																														$row_count = $data['total'] ;
																															
																													}
																												
																												}else {
																													$row_count = "-";
																												}	
																											}
																											
																											if ($data_sa['kode_item'] == 'POLIS ASURANSI'){
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													($kode_bp == "TAUFIK BP" ? $kode_bp_showroom = "TAUFK" : ($kode_bp == 'TONY BP' ? $kode_bp_showroom = "TONI" : $kode_bp_showroom = $kode_bp ) );
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													//$tglakhir = "2017-12-".$tanggalan ;
																													
																													$querysadetail = "select count(f.kode_salesman) as total from untt_asuransipurnajual f																												
																															
																																	where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'																																			
																																	and f.kode_salesman = '$kode_bp_showroom' 																															
																																	and f.batal = 0 ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																																																									
																													while($data = sqlsrv_fetch_array($result)){	
																														$row_count = $data['total'] ;
																															
																													}
																												
																												}else {
																													$row_count = "-";
																												}	
																											}
																											
																											if ($data_sa['kode_item'] == 'PANEL'){
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													//$tglakhir = "2017-12-".$tanggalan ;
																													
																													$querysadetail = "select count(FD.Nomor_FakturBody) as total from SrvT_FakturBodyRepair F
																																	left join SrvT_FakturBodyRepairDetail FD on fd.Nomor_FakturBody = f.Nomor
																																	left join SrvT_WOBodyRepair WO on wo.nomor = F.Nomor_WOBody
																																																																
																															where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'		
																																		
																																		
																															and wo.penerima = '$kode_bp' 
																															and (fd.Jenis = 3)
																															
																															and f.batal = 0 ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													
																													$row_count = 0;
																													while ($data = sqlsrv_fetch_array($result)){
																														$row_count = $data['total'];
																													}
																													
																												
																												
																												}else {
																													$row_count = "-";
																												}	
																											}
																											
																											if ($data_sa['kode_item'] == 'JASA BP'){
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													//$tglakhir = "2017-12-".$tanggalan ;
																													
																													$querysadetail = "select sum(fd.subtotal) as total from 
																																	SrvT_FakturBodyRepair F
																																	left join SrvT_FakturBodyRepairDetail FD on fd.Nomor_FakturBody = f.Nomor
																																	left join SrvT_WOBodyRepair WO on wo.nomor = F.Nomor_WOBody
																																																																
																															where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'	
																																		
																																		
																															and wo.penerima = '$kode_bp' 
																															and (fd.Jenis = 3)
																															
																															and f.batal = 0 ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													
																													$row_count = 0;
																													while ($data = sqlsrv_fetch_array($result)){
																														$row_count = $data['total'];
																														$total_labour_jasa = $data['total'];
																													}
																													
																												
																												
																												}else {
																													$row_count = "-";
																												}	
																											}
																											
																											
																											if ($data_sa['kode_item'] == 'SPARE PARTS BP'){
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													//$tglakhir = "2017-12-".$tanggalan ;
																													
																													$querysadetail = "select sum(fd.subtotal) as total from 
																																	SrvT_FakturBodyRepair F
																																	left join SrvT_FakturBodyRepairDetail FD on fd.Nomor_FakturBody = f.Nomor
																																	left join SrvT_WOBodyRepair WO on wo.nomor = F.Nomor_WOBody
																																																																
																															where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'	
																																		
																																		
																															and wo.penerima = '$kode_bp' 
																															and (fd.Jenis = 1 or fd.jenis = 4)
																															
																															and f.batal = 0 ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													
																													$row_count = 0;
																													while ($data = sqlsrv_fetch_array($result)){
																														$row_count = $data['total'];
																													}
																													
																												
																												
																												}else {
																													$row_count = "-";
																												}	
																											}
																											
																											
																											
																											
																											//mysql_unbuffered_query("insert into rasio_sa_performance (bulan,kode_item,kode_kategori,nama_bp,total) values ('$data_sa[bulan]','$data_sa[kode_item]','$data_sa[kode_kategori]','$kode_bp','$ratio')");
																											
																											
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
																												if ($point_count_poles == 0){																													
																													$total_point = 0;
																												}else{
																													$total_point = $point_count_poles;
																												}
																											}
																											
																											
																											//echo "<td>".number_format($row_count,0,".",".")." / ".$total_point." / ".round($ratio*100,2) ."%</td>";
																											echo "<td>".number_format($row_count,0,".",".")."</td>";
																											
																											//echo "<td>".$row_count."</td>";
																											
																											$tot_item = $tot_item + $row_count;
																											//////////////////////////////////
																											
																											if ($total_point_kategori_semuasa == ""){
																												if ($total_point == '0'){
																													$total_point_kategori_semuasa = '0';
																													
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
																											if ($data_sa['kode_item'] == 'INCOMING UNIT'){
																												if ($gabung_tot_iu ==''){
																													$gabung_tot_iu = $row_count;


																												} else{
																													$gabung_tot_iu = $gabung_tot_iu . ",".$row_count;
																												}
																												$tot_iu_semua = $tot_iu_semua + $row_count;
																											}
																											
																											/////////////////// 
																											if ($data_sa['kode_item'] == 'PANEL'){
																												if ($gabung_tot_panel ==''){
																													$gabung_tot_panel = $row_count;


																												} else{
																													$gabung_tot_panel = $gabung_tot_panel . ",".$row_count;
																												}
																												$tot_iu_semua = $tot_iu_semua + $row_count;
																											}
																											/////////////////// 
																											
																											/////////////////// 
																											if ($data_sa['kode_item'] == 'JASA BP'){
																												if ($tot_mount_kategori_jasa ==''){
																													$tot_mount_kategori_jasa = $row_count;


																												} else{
																													$tot_mount_kategori_jasa = $tot_mount_kategori_jasa . ",".$row_count;
																												}
																												
																											}
																											
																											
																											/////////////////// 
																											if ($data_sa['kode_item'] == 'SPARE PARTS BP'){
																												if ($tot_mount_kategori_part ==''){
																													$tot_mount_kategori_part = $row_count;


																												} else{
																													$tot_mount_kategori_part = $tot_mount_kategori_part . ",".$row_count;
																												}
																											}
																											
																											
																											
																											
																										}
																										
																										$query_jcbp = mysql_query("select * from jc_bp where bulan = '$bulan1'");
																										while ($data_jcbp = mysql_fetch_array($query_jcbp)){
																											echo "<td></td>";
																										}
																										
																										echo "<td>".number_format($tot_item,0,".",".")."</td>";
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
																								$query7 = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																								$rec_sa = mysql_num_rows($query7);
																								
																								$no2 = 0;
																								$total_rasio_kategori_semuasa = 0;
																								//$total_point_kategori_semuasa = 0;
																								
																								while ($data_query7 = mysql_fetch_array($query7)){
																									//echo "<td>".$data[nama_bp]."</td>";
																									$kode_bp = $data_query7['nama_bp'];
																									
																									
																									$query8 = mysql_query("select * from target_serviceadvisor_bp where bulan = '$bulan1' and kode_kategori = '$kategori' and nama_bp = '$kode_bp' ");
																									$rec = mysql_num_rows($query8);
																									
																									$no3 = 0;
																									$total_rasio_kategori_persa = 0;
																									$total_point_kategori_persa = 0;
																									$fix_pembagi = 0;
																									while ($data = mysql_fetch_array($query8) ){
																										$total_rasio_kategori_persa = $total_rasio_kategori_persa + $split_gabung_kategori[($no3 * $rec_sa)+$no2];
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
																									$total_rasio_kategori_persa = round(($total_rasio_kategori_persa / $fix_pembagi)*100,2);
																									
																									
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
																											$gabung_total_point_kategori_persa = '0';
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
																								
																								$query_jcbp = mysql_query("select * from jc_bp where bulan = '$bulan1'");
																								while ($data_jcbp = mysql_fetch_array($query_jcbp)){
																									echo "<td style='background-color:darkgrey;'></td>";
																								}
																								
																							
																							echo "<td style='background-color:darkgrey;'>". round($total_rasio_kategori_semuasa/$no2,2) ."%</td>";
																							
																							?>
																						</tr>
																						
																			<?php		
																					}
																			?>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "TOTAL LABOUR COST + SPAREPART"; ?></td>
																							<?php 
																								$query = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																								$no_amount_revenue = 0;
																								
																								$split_tot_mount_kategori_jasa = split(",",$tot_mount_kategori_jasa);
																								$split_tot_mount_kategori_part = split(",",$tot_mount_kategori_part);
																								$total_revenue = 0;
																								while ($data = mysql_fetch_array($query)){
																									$kode_bp = $data['nama_bp'];
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
																								$query_jcbp = mysql_query("select * from jc_bp where bulan = '$bulan1'");
																								$query_jcbp = mysql_query("select count(nama_jc) as colspan from jc_bp where bulan = '$bulan1'");
																								$data_jcbp = mysql_fetch_array($query_jcbp);
																								$colspan = $data_jcbp['colspan']+1;
																								echo "<td style='background-color:darkgrey;' colspan = '$colspan'>".number_format($total_revenue,0,".",".")."</td>";
																							?>
																							
																							
																							
																						</tr>	
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "TOTAL ACCHIEVEMENT BY POINT"; ?>
																							
																							
																							<?php
																							//$total_point_kategori_semuasa
																								
																								
																								$query = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																								$rec_sa = mysql_num_rows($query);
																								
																								$split_gabung_total_point_kategori_persa = split(",",$gabung_total_point_kategori_persa);
																							
																								$no_sa = 0;
																								while ($data = mysql_fetch_array($query)){
																									$kode_bp = $data['nama_bp'];
																									
																									$query2 = mysql_query("select kode_kategori from target_serviceadvisor_bp where nama_bp = '$kode_bp' and bulan = '$bulan1' group by kode_kategori order by urutan");
																									$rec = mysql_num_rows($query2);
																									
																									$total_point = 0;
																									$total_semua_point_kategori = 0;
																									
																									$extra = 0;
																									
																									$no_kategori = 0;
																									while ($no_kategori < $rec){
																										
																										$total_semua_point_kategori = $total_semua_point_kategori + $split_gabung_total_point_kategori_persa[($no_kategori * $rec_sa)+$no_sa];
																										
																										
																										$no_kategori ++;
																									}
																									$total_point = $total_semua_point_kategori ;
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
																									
																									echo "<td style='background-color:darkgrey;'>".number_format($total_point,0,",",",")."</td>";
																									
																									$no_sa ++;			
																								}
																								$query_jcbp = mysql_query("select count(nama_jc) as colspan from jc_bp where bulan = '$bulan1'");
																								$data_jcbp = mysql_fetch_array($query_jcbp);
																								$colspan = $data_jcbp['colspan']+1;
																								echo "<td style='background-color:darkgrey;' colspan = '$colspan'>".number_format($total_semua,0,",",",")."</td>";
																							?>
																							
																							
																							
																							</td>
																						</tr>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "TOTAL ACCHIEVEMENT BY RATIO"; ?>
																							
																							<?php
																							
																								$query = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																								$rec_sa = mysql_num_rows($query);
																								
																								$split_gabung_total_rasio_kategori_persa = split(",",$gabung_total_rasio_kategori_persa);
																							
																								$no_sa = 0;
																								$total_semua = 0;
																								while ($data = mysql_fetch_array($query)){
																									$kode_bp = $data['nama_bp'];
																									
																									$query2 = mysql_query("select kode_kategori from target_serviceadvisor_bp where nama_bp = '$kode_bp' and bulan = '$bulan1' group by kode_kategori order by urutan");
																									$rec = mysql_num_rows($query2);
																									
																									
																									$total_semua_rasio_kategori = 0;
																									$total_ratio_carcare = 0;
																									$total_ratio_revenue = 0;
																									
																									
																									$no_kategori = 0;
																									while ($no_kategori < $rec){
																										
																										$total_semua_rasio_kategori = $total_semua_rasio_kategori + $split_gabung_total_rasio_kategori_persa[($no_kategori * $rec_sa)+$no_sa];
																										
																										
																										if ($no_kategori == '0'){
																											$total_ratio_carcare = $total_ratio_carcare + $split_gabung_total_rasio_kategori_persa[($no_kategori * $rec_sa)+$no_sa];
																										}
																										
																										if ($no_kategori == '1'){
																											$total_ratio_revenue = $total_ratio_revenue + $split_gabung_total_rasio_kategori_persa[($no_kategori * $rec_sa)+$no_sa];
																										}
																										
																										
																										$no_kategori ++;
																									}
																									//$total = round((($total_ratio_revenue * 3) + $total_ratio_carcare) / 4,2) ;
																									$total = round((($total_ratio_revenue * 3) + $total_ratio_carcare) / 4,2) ;
																									
																									
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
																								
																								$query_jcbp = mysql_query("select count(nama_jc) as colspan from jc_bp where bulan = '$bulan1'");
																								$data_jcbp = mysql_fetch_array($query_jcbp);
																								$colspan = $data_jcbp['colspan']+1;
																								
																								echo "<td style='background-color:darkgrey;' colspan = '$colspan' >".round(($total_semua / $no_sa),2)."%</td>";
																							?>
																							
																							</td>
																						</tr>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "TOTAL LABOUR INCENTIVE"; ?>
																							
																							<?php
																							
																								$query = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																								$rec_sa = mysql_num_rows($query);
																								
																								$split_group_point_kategori = split(",",$group_point_kategori);
																								$split_group_rasio_kategori = split(",",$group_rasio_kategori);
																								$split_total_point_kategori_extra = split(",",$group_point_kategori_extra);
																								
																								$split_tot_mount_kategori_jasa = split(",",$tot_mount_kategori_jasa);
																								
																								$no_sa = 0;
																								$total_semua = 0;
																								while ($data = mysql_fetch_array($query)){
																									
																									$query2 = mysql_query("select kode_kategori from target_serviceadvisor_bp where nama_bp = '$kode_bp' and bulan = '$bulan1' group by kode_kategori order by urutan");
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
																									
																									
																									//$total_gross = (($split_group_point_kategori[$no_sa]*($split_group_rasio_kategori[$no_sa]/100))+$split_total_point_kategori_extra[$no_sa])*1000;
																									$total_gross = ($split_tot_mount_kategori_jasa[$no_sa] * ($split_group_rasio_kategori[$no_sa] / 100)) * 0.018 * 0.47;
																									
																									//echo "<td style='background-color:darkgrey;'>".$split_group_point_kategori[$no_sa]."--".$split_group_rasio_kategori[$no_sa]."--".$split_total_point_kategori_extra[$no_sa]."</td>";
																									
																									
																									$total_semua = $total_semua + $total_gross;
																									
																									echo "<td style='background-color:darkgrey;'>".number_format($total_gross,0,",",",")."</td>";
																									
																									if($gabung_total_labour == ''){
																										$gabung_total_labour = $total_gross;
																									}else{
																										$gabung_total_labour = $gabung_total_labour .",".$total_gross;
																									}
																									
																									$no_sa ++;			
																								}
																								
																								
																								
																								$split_group_rasio_kategori = split(",",$group_rasio_kategori);
																								$split_tot_mount_kategori_jasa = split(",",$tot_mount_kategori_jasa);
																								
																								
																								$query_jcbp = mysql_query("select * from jc_bp where bulan = '$bulan1'");
																								
																								$total_labour_incentif_jc = 0;
																								
																								while ($data_jcbp = mysql_fetch_array($query_jcbp)){
																									$query = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																									$no = 0;
																									$total = 0;
																									while ($data = mysql_fetch_array($query)){
																										$total = $total + (($split_group_rasio_kategori[$no]/100) * $split_tot_mount_kategori_jasa[$no]);
																										$no ++;
																									}
																									$total = round($total * $data_jcbp['rasio1'] * $data_jcbp['rasio2'],2);
																									$total_labour_incentif_jc = $total_labour_incentif_jc + $total;
																									
																									echo "<td style='background-color:darkgrey;'>".number_format($total,0,".",",")."</td>";
																								}
																								echo "<td style='background-color:darkgrey;'>".number_format($total_semua + $total_labour_incentif_jc,0,",",",")."</td>";
																							?>
																							</td>
																						</tr>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "TOTAL OTHER INCENTIVE"; ?>
																							
																							<?php
																							
																								$query = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																								$rec_sa = mysql_num_rows($query);
																								
																								$split_group_point_kategori = split(",",$group_point_kategori);
																								$split_group_rasio_kategori = split(",",$group_rasio_kategori);
																								$split_total_point_kategori_extra = split(",",$group_point_kategori_extra);
																								
																								$split_tot_mount_kategori_jasa = split(",",$tot_mount_kategori_jasa);
																								
																								$no_sa = 0;
																								$total_semua_other_incentif = 0;
																								while ($data = mysql_fetch_array($query)){
																									
																									$query2 = mysql_query("select kode_kategori from target_serviceadvisor_bp where nama_bp = '$kode_bp' and bulan = '$bulan1' group by kode_kategori order by urutan");
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
																									
																									
																									//$total_gross = (($split_group_point_kategori[$no_sa]*($split_group_rasio_kategori[$no_sa]/100))+$split_total_point_kategori_extra[$no_sa])*1000;
																									$total_other_incentif = $split_group_point_kategori[$no_sa] * ($split_group_rasio_kategori[$no_sa] / 100) * 1000;
																									
																									//echo "<td style='background-color:darkgrey;'>".$split_group_point_kategori[$no_sa]."--".$split_group_rasio_kategori[$no_sa]."--".$split_total_point_kategori_extra[$no_sa]."</td>";
																									
																									
																									$total_semua_other_incentif = $total_semua_other_incentif + $total_other_incentif;
																									
																									echo "<td style='background-color:darkgrey;'>".number_format($total_other_incentif,0,",",",")."</td>";
																									
																									
																									if($gabung_total_other == ''){
																										$gabung_total_other = $total_other_incentif;
																									}else{
																										$gabung_total_other = $gabung_total_other .",".$total_other_incentif;
																									}
																									
																									
																									$no_sa ++;			
																								}
																								
																								
																								
																								
																								$query_jcbp = mysql_query("select count(nama_jc) as colspan from jc_bp where bulan = '$bulan1'");
																								$data_jcbp = mysql_fetch_array($query_jcbp);
																								$colspan = $data_jcbp['colspan']+1;
																								echo "<td style='background-color:darkgrey;' colspan = '$colspan'>".number_format($total_semua_other_incentif,0,",",",")."</td>";
																							?>
																							</td>
																						</tr>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "TOTAL ACCHIEVEMENT INCENTIVE"; ?>
																							<?php
																							
																								$query = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																								$rec_sa = mysql_num_rows($query);
																								
																								
																								$split_gabung_total_labour = split(",",$gabung_total_labour);
																								$split_gabung_total_other = split(",",$gabung_total_other);
																							
																								$no_sa = 0;
																								$total_semua_incentif = 0;
																								while ($data = mysql_fetch_array($query)){
																									
																									$insentif = $split_gabung_total_labour[$no_sa] + ($split_gabung_total_other[$no_sa]*0.6);
																									
																									
																									echo "<td style='background-color:darkgrey;'>".number_format($insentif ,0,",",",")."</td>";
																									
																									$total_semua_incentif = $total_semua_incentif + ($insentif - $penguran_insentif);
																									
																									$no_sa ++;			
																								}
																								
																								$split_group_rasio_kategori = split(",",$group_rasio_kategori);
																								$split_tot_mount_kategori_jasa = split(",",$tot_mount_kategori_jasa);
																								
																								
																								$query_jcbp = mysql_query("select * from jc_bp where bulan = '$bulan1'");
																								
																								$total_achievement_incentif_jc = 0;
																								
																								while ($data_jcbp = mysql_fetch_array($query_jcbp)){
																									$query = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																									$no = 0;
																									$total = 0;
																									while ($data = mysql_fetch_array($query)){
																										$total = $total + (($split_group_rasio_kategori[$no]/100) * $split_tot_mount_kategori_jasa[$no]);
																										$no ++;
																									}
																									$total = round($total * $data_jcbp['rasio1'] * $data_jcbp['rasio2'],2);
																									$total_achievement_incentif_jc = $total_achievement_incentif_jc + $total+($total_semua_other_incentif * 0.1);
																									
																									echo "<td style='background-color:darkgrey;'>".number_format($total+($total_semua_other_incentif * 0.1),0,".",",")."</td>";
																								}
																								echo "<td style='background-color:darkgrey;'>".number_format($total_semua_incentif +$total_achievement_incentif_jc ,0,",",",")."</td>";
																							?>
																							
																							
																							</td>
																						</tr>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "PANEL PER-UNIT"; ?>
																							
																							<?php
																							
																								$query = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																								$rec_sa = mysql_num_rows($query);
																								
																								
																								
																								$split_gabung_tot_iu = split(",",$gabung_tot_iu);
																								
																								$split_gabung_tot_panel = split(",",$gabung_tot_panel);
																								
																								$no_sa = 0;
																								$total_semua = 0;
																								while ($data = mysql_fetch_array($query)){
																									
																									
																									
																									$rasio_iu = $split_gabung_tot_panel[$no_sa] / $split_gabung_tot_iu[$no_sa];
																									
																									echo "<td style='background-color:darkgrey;'>". round($rasio_iu,2) ."</td>";
																									
																									$total_semua = $total_semua + $rasio_iu;
																									
																									$no_sa ++;			
																								}
																								$query_jcbp = mysql_query("select count(nama_jc) as colspan from jc_bp where bulan = '$bulan1'");
																								$data_jcbp = mysql_fetch_array($query_jcbp);
																								$colspan = $data_jcbp['colspan']+1;
																								echo "<td style='background-color:darkgrey;' colspan = '$colspan'>". round($total_semua/$no_sa,2)."</td>";
																							?>
																							
																							
																							</td>
																						</tr>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "JASA PER-PANEL "; ?>
																							<?php
																							
																								$query = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																								$rec_sa = mysql_num_rows($query);
																								
																								
																								$split_gabung_total_amount = split(",",$tot_mount_kategori_jasa);
																								$split_gabung_tot_iu = split(",",$gabung_tot_iu);
																								$split_gabung_tot_panel = split(",",$gabung_tot_panel);
																								
																								
																								$no_sa = 0;
																								$total_semua = 0;
																								while ($data = mysql_fetch_array($query)){
																									
																									
																									
																									$jasaperpanel = $split_gabung_total_amount[$no_sa]/$split_gabung_tot_panel[$no_sa];
																									
																									echo "<td style='background-color:darkgrey;'>".number_format($jasaperpanel,0,",",",")."</td>";
																									
																									$total_semua = $total_semua + $jasaperpanel;
																									
																									$no_sa ++;			
																								}
																								$query_jcbp = mysql_query("select count(nama_jc) as colspan from jc_bp where bulan = '$bulan1'");
																								$data_jcbp = mysql_fetch_array($query_jcbp);
																								$colspan = $data_jcbp['colspan']+1;
																								
																								echo "<td style='background-color:darkgrey;' colspan = '$colspan'>".number_format($total_semua/$no_sa,0,",",",")."</td>";
																							?>
																							</td>
																						</tr>
																						<tr>	
																							
																							<td colspan=5 align=left style="background-color:darkgrey;"><?php echo "INCOME PER-UNIT "; ?>
																							<?php
																							
																								$query = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																								$rec_sa = mysql_num_rows($query);
																								
																								$split_gabung_total_amount = split(",",$gabung_total_amount);
																								
																								$split_gabung_tot_iu = split(",",$gabung_tot_iu);
																								$split_gabung_tot_panel = split(",",$gabung_tot_panel);
																								
																								
																								$no_sa = 0;
																								$total_semua = 0;
																								while ($data = mysql_fetch_array($query)){
																									
																									
																									
																									$incomeperunit = $split_gabung_total_amount[$no_sa]/$split_gabung_tot_iu[$no_sa];
																									
																									echo "<td style='background-color:darkgrey;'>".number_format($incomeperunit,0,",",",")."</td>";
																									
																									$total_semua = $total_semua + $incomeperunit;
																									
																									$no_sa ++;			
																								}
																								$query_jcbp = mysql_query("select count(nama_jc) as colspan from jc_bp where bulan = '$bulan1'");
																								$data_jcbp = mysql_fetch_array($query_jcbp);
																								$colspan = $data_jcbp['colspan']+1;
																								echo "<td style='background-color:darkgrey;' colspan = '$colspan'>".number_format($total_semua/$no_sa,0,",",",")."</td>";
																							?>
																							</td>
																						</tr>
																		</tbody>
																	</table>
																</div>
														</div>
													</div>
													
													<?php
														$query_sa = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
														$nama_bp = '';
														while($data = mysql_fetch_array($query_sa)){
															if ($nama_bp == ''){
																$nama_bp = $data['nama_bp'];
															}else{
																$nama_bp = $nama_bp .",".$data['nama_bp'];
															}
															
														}
													?>
													<script>
														var nama_bp = "<?php echo $nama_bp; ?>";
														var point_semua_sa = "<?php echo $group_point_kategori; ?>";
														var rasio_extracare = "<?php echo $rasio_extracare; ?>";
														var rasio_plus = "<?php echo $rasio_plus; ?>";
														var rasio_engineoil = "<?php echo $rasio_engineoil; ?>";
														var rasio_others = "<?php echo $rasio_others; ?>";
														var rasio_revenue = "<?php echo $rasio_revenue; ?>";
														
														
													</script>
													
													<div id="chart" class="tab-pane padding-bottom-5 " >
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
													
													<!--div id="PM_PACKAGE" class="tab-pane padding-bottom-5" >
															<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center; border-collapse:collapse" >
																		<thead>
																			<tr>
																				<td width="30" height="29">NO</td>
																			    <td>TIPE</td>												
																				
																				
																				<td>OIL</td>
																			   							
																				
																				<td>P</td>
																				
																				
																				<?php   
																					$query_sa = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																					
																					while ($data_sa = mysql_fetch_array($query_sa)){
																						echo "<td>$data_sa[nama_bp]</td>";
																						
																					}
																				
																				
																				?>
																				
																			</tr>
																		</thead>
																		<tbody>
													
														<?PHP
														/*
														
																		$query = mysql_query("select * from target_pmpackagedua where bulan = '$bulan1'");															
																		$nomor = 1;
																		
																		$query_sa21 = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																		
																		
																		while ($data = mysql_fetch_array($query)){
																			
																			$kode_referensi = $data['kode_item'];
																			
																			echo "<tr>";
																			echo "<td>$nomor</td>";
																			echo "<td>".$data['nama_item']."</td>";
																			echo "<td>".$data['oil']."</td>";
																			echo "<td>".$data['point']."</td>";
																			
																			
																		
																			
																			
																				
																				$querysadetail = "select wo.penerima,f.tanggal,fd.* from srvt_faktur F
																									left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																									left join srvt_wo WO on wo.nomor = F.nomor_wo
																									
																									where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'		
																									
																									
																									 																																
																									and fd.Kode_Referensi = '$kode_referensi'
																									and f.batal = 0  ";
																								
																				$result_ppb = sqlsrv_query($conn, $querysadetail);	
																				
																				while ($data2 = sqlsrv_fetch_array($result_ppb)){
																					
																				}


																				
																				$row_count = 0;
																				$point_ppb = 0;
																				
																				echo "<td>". 12 ."</td>";
																				
																			
																			
																			
																			echo "</tr>";
																			
																		}	


																			*/		


																			
																			
																				$querysadetail = "select wo.penerima,f.tanggal,fd.* from srvt_faktur F
																									left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																									left join srvt_wo WO on wo.nomor = F.nomor_wo
																									
																									where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'		
																									
																									
																																																								
																									and fd.Nama_Referensi like '%PPB%'
																									and f.batal = 0 order by fd.kode_referensi ";
																								
																				$result_ppb = sqlsrv_query($conn, $querysadetail);		
																				$nomor = 1;
																				while ($data = sqlsrv_fetch_array($result_ppb)){
																					$kode_bp = $data['penerima'];
																					$kode_referensi = $data['Kode_Referensi'];
																					
																					
																					$query_package = mysql_query("select * from target_pmpackagedua where kode_item = '$data[Kode_Referensi]' and bulan = '$bulan1'");
																					$row_count = 0;
																					$point = 0;		
																					while($data_pm = mysql_fetch_array($query_package)){
																						echo "<tr>";
																						echo "<td>$nomor</td>";
																						echo "<td>".$data_pm['nama_item']."</td>";
																						echo "<td>".$data_pm['oil']."</td>";
																						echo "<td>".$data_pm['point']."</td>";
																						
																						$query_sa = mysql_query("select nama_bp from target_serviceadvisor_bp where bulan = '$bulan1' group by nama_bp ");
																						
																						while ($data_sa = mysql_fetch_array($query_sa)){
																									if ($data_sa['nama_bp'] == "$kode_bp"){
																										
																										$row_count = $row_count + 1 ;
																										$point = $point + $data_pm['point'];
																										
																											echo "<td>".$row_count."</td>";
																										
																										
																									}else{
																										echo "<td></td>";
																									}
																						}
																						
																							
																							
																							
																							echo "</tr>";
																						
																						
																						
																					}
																					
																					
																					$nomor ++;
																					
																				}
																		
																			
														?>	
																		</tbody>
																	</table>
															</div>	
													</div-->
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
		case "tambah":
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$tanggal = date('Y-m-d',strtotime($_POST[tanggal]));
		$tanggal_post = $_POST[tanggal];
		$bulan_post = date('m-Y',strtotime($_POST[tanggal]));
        $tgl_input = date('Y-m-d H:i:s');
		if(count($_POST)) {
			mysql_unbuffered_query("insert into acchv (tanggal,bulan,id_item,total,package_point,nm_sa,tgl_input) values('$tanggal','$bulan_post','$_POST[id_item]','$_POST[total]','$_POST[package_point]','$_SESSION[username_service]','$tgl_input')");
			
				$msg = "							
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Data telah berhasil disimpan</div>";
								
		}
	?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Acchievement</h1>
									<span class="mainDescription">Input data baru</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Transaksi</span>
									</li>									
									<li class="active">
										<span>Acchievement</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" id="item_control" enctype="multipart/form-data" method="post" action="">
										<div class="row">
											<div class="col-md-12">
											<?php echo(isset ($msg) ? $msg : ''); ?>
												<div class="errorHandler alert alert-danger no-display">
													<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
												</div>
												<div class="successHandler alert alert-success no-display">
													<i class="fa fa-ok"></i> Your form validation is successful!
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														Tanggal <span class="symbol required"></span>
													</label>											
													
													<p class="input-group input-append datepicker date">
														<input type="text" class="form-control" name = "tanggal" id = "tanggal" required  />
														<span class="input-group-btn">
															<button type="button" class="btn btn-default">
																<i class="glyphicon glyphicon-calendar"></i>
															</button> </span>
													</p>
												</div>	
												<div class="form-group">
													<label for="form-field-select-2">
														Kategori <span class="symbol required"></span>
													</label>													
													<select name = "id_kategori" id="id_kategori" class = "form-control" required >														
														<option value="" selected>PILIH KATEGORI</option>
														<?php 
														if ($_SESSION[leveluser] == 'SA_GR'){
															$tampil=mysql_query("SELECT * FROM kategori where aktif = 'Y' and klasifikasi = 'GR'");
														}elseif ($_SESSION[leveluser] == 'SA_BP') {
															$tampil=mysql_query("SELECT * FROM kategori where aktif = 'Y' and klasifikasi = 'BP'");
														}else {
															$tampil=mysql_query("SELECT * FROM kategori where aktif = 'Y'");
														}
														
														while ($w = mysql_fetch_array($tampil)){															
															echo "<option value = '$w[id_kategori]'>$w[nm_kategori]</option>";															
														}
														?>
													</select>
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Item <span class="symbol required"></span>
													</label>													
													<select name = "id_item" id = "id_item" class = "form-control" required >	
														<option value = "">PILIH ITEM</option>
													</select>
												</div>
												<div id = "package" class="form-group">
													<label for="form-field-select-2">
														Type Mobil <span class="symbol required"></span>
													</label>													
													<select name = "package_point" class = "form-control" >	
														<option value = "" selected>PILIH TYPE</option>
														<?php 
															$data = mysql_query("select * from pmpackage where aktif = 'Y'");
															while ($r = mysql_fetch_array($data)){
																echo "<option value = '$r[point]'>$r[type_mobil] - $r[periode] ($r[kategori])</option>";
															}
														?>
													</select>
												</div>
												
												<div class="form-group">
													<label class="control-label">
														Total <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" type="number" value = "<?php echo $r[nm_kategori]?>" onblur="this.value=this.value.toUpperCase()" placeholder="Total" class="form-control" id="total" name="total" required>
												</div>
											</div>											
										</div>
										<div class="row">
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Harus diisi
													<hr>
												</div>
											</div>
										</div>
										<div class="row">											
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_bodyrepair';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Cancel </span>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>

<?php	
	break;
	case "edituser":
	$a = "select * from asuransi where id_asuransi='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
				
	if(count($_POST)) {
		mysql_unbuffered_query("update asuransi set nm_asuransi = '$_POST[nm_asuransi]',aktif = '$_POST[aktif]' where id_asuransi = '$_GET[id]'");
		$msg = "							
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Data telah berhasil dirubah</div>";
	}
?>

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Edit Data Asuransi</h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li>
										<span>Tabel Asuransi</span>
									</li>
									<li class="active">
										<span>Edit Data</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" id="frm_kategori" enctype="multipart/form-data" method="post" action="">
										<div class="row">
											<div class="col-md-12">
											<?php echo(isset ($msg) ? $msg : ''); ?>
												<div class="errorHandler alert alert-danger no-display">
													<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
												</div>
												<div class="successHandler alert alert-success no-display">
													<i class="fa fa-ok"></i> Your form validation is successful!
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														Nama Item <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" type="text" value = "<?php echo $r[nm_asuransi]?>" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Asuransi" class="form-control" id="nm_asuransi" name="nm_asuransi" required>
												</div>												
												<?php if ($r[aktif] == 'Y'){?>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio1" name="aktif" value="Y" checked = "checked">
													<label for="radio1">
														Yes
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="aktif" value="N">
													<label for="radio2">
														No
													</label>
												</div>
												<?php } else { ?>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio1" name="aktif" value="Y">
													<label for="radio1">
														Yes
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="aktif" value="N" checked="checked">
													<label for="radio2">
														No
													</label>
												</div>
												<?php } ?>
											</div>											
										</div>
										<div class="row">
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Harus diisi
													<hr>
												</div>
											</div>
										</div>
										<div class="row">											
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_master_list_asuransi';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Cancel </span>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>
<?php break;
}
} ?>