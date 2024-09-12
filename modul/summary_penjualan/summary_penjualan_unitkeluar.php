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
		include "../config/koneksi_service.php";
		//include "config/koneksi_online.php";
?>
	
				
			
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-7">
									<h1 class="mainTitle">Summary</h1>
									<span class="mainDescription">Permohonan Unit Keluar</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
							
								<div class = "col-md-6">
									<div class="form-group">
																					
										<form action = "<?php echo "$_SERVER[PHP_SELF]"; ?>" method = "GET">
											<input type = "hidden" name="module" value = "summary_penjualan_unitkeluar" />
											
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
											    <font color="red"><b>Note : </b></font>Sebelum Proses,Terlebih Dahulu Pilih <font color="red">Tanggal Waktu Keluar</font> Yang Akan di Tampilkan <span class="symbol required"></span>
													
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
									
									$tgl_awal = $_GET['tgl_awal'];
									$tgl_akhir = $_GET['tgl_akhir'];
									
									if($waktu_keluar != "-") { 
										$query = mysql_query("select count(no_puk) as total from unit_keluar where substring(waktu_keluar,1,11) >= '$tgl_awal' and substring(waktu_keluar,1,11) <= '$tgl_akhir'");
										
										while($data_puk = mysql_fetch_array($query)){
											$ada_record = $data_puk['total'];
										}
										
										
										
										if ($ada_record == '0') { echo "<div class='col-sm-12'> Tidak ada data pada periode Ini, silahkan pilih ulang </div>"; } else {
								?>
								
								<div class="col-sm-12">
									
									<div class="panel panel-white no-radius">
										<div class="panel-body no-padding">
											<div class="tabbable no-margin no-padding">
												<ul class="nav nav-tabs" id="myTab">
												
													
													<li class="active padding-top-5 padding-left-5">
														<a data-toggle="tab" href="#SUMMARY">
															SUMMARY <?php echo "<font color='red'> *$ada_record DATA</font>" ?>
														</a>
													</li>
													
												</ul>
											
											
											<div class="tab-content">
														<div id="SUMMARY" class="tab-pane padding-bottom-5 active" >
															<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1" style= "text-align:center; border-collapse:collapse" >
																		<thead>
																			<tr>
																				
																				<td width="30" height="29"><b>No</td>
																			    <td><b>No PUK</td>												
																				<td><b>No SPK</td>
																				<td><b>Nama Customer</td>
																				<td><b>Type Mobil</td>												
																				<td><b>Warna Mobil</td>
																				<td><b>Salesman</td>
																				<td><b>Supervisor</td>
																				<td><b>No Rangka</td>
																				<td><b>No Mesin</td>
																				<td><b>Tanggal Keluar</td>																				
																				<td><b>Jam Keluar</td>																				
																				<td><b>Keterangan</td>
																				<td><b>Input Pada</td>
																				<td><b>Status Approved</td>
																				<td><b>Tanggal PUK Awal</td>
																				
																				
																			</tr>
																		</thead>
																		<tbody>
																	
													
															<?php

																	$tgl_akhir_doank = substr($_GET['tgl_akhir'],8,2); 
																	$tgl_awal_doank = substr($_GET['tgl_awal'],8,2); 
																		
																		//$tgl_doank2 = $tgl_doank - 0;
																	$query = mysql_query("select * from unit_keluar where substring(waktu_keluar,1,11) >= '$tgl_awal' and substring(waktu_keluar,1,11) <= '$tgl_akhir' order by waktu_keluar desc, kd_spv desc");
																	$nomor = 0;
																	while($data_puk = mysql_fetch_array($query)){
																	$nomor += 1; 
																	//$query2 = "select SPK.* from vw_PukSOS SPK where NomorSPK = '$data_puk[no_spk]'";
																	$query2 = "select NamaCustomer, NomorSpk,NoRangka,NamaTipe,NamaWarna,NoMesin, NamaSalesman from vw_PukSOS where NomorSPK = '$data_puk[no_spk]'";
																	$query3 = sqlsrv_query($conn, $query2);
																	$data_detail = sqlsrv_fetch_array($query3);
																	/*while ($data_detail = sqlsrv_fetch_array($query3)){
																		$sales = $data_detail['NamaSalesman'];
																		$warna = $data_detail['NamaWarna'];
																		$tipe = $data_detail['NamaTipe'];
																	}*/ 
																	
															?>
															<tr>
																<td width='100dp'><?php echo $nomor ?></td>
																<td><?php  echo  $data_puk['no_puk']; ?></td>
																<td><?php  echo  $data_puk['no_spk']; ?></td>
																<td align='center'><?php  echo  $data_detail['NamaCustomer']; ?></td>
																<td><?php  echo  $data_detail['NamaTipe']; ?></td>
																<td><?php  echo  $data_detail['NamaWarna']; ?></td>
																<td align='center'><?php  echo  $data_detail['NamaSalesman']; ?></td>
																<td align='center'><?php  echo  $data_puk['kd_spv']; ?></td>
																<td align='center'><?php  echo  $data_puk['norangka']; ?></td>
																<td align='center'><?php  echo  $data_detail['NoMesin']; ?></td>
																<td align='center'><?php  echo  substr($data_puk['waktu_keluar'],0,10); ?></td>
																<td align='center'><?php  echo  substr($data_puk['waktu_keluar'],11,8); ?></td>
																<td align='center'><?php  echo  $data_puk['keterangan']; ?></td>
																<td align='center'><?php  echo  $data_puk['input']; ?></td>
																<td align='center'>
																	<?php 
																		if ($data_puk['status_approved'] == 'MNGR_APP'){
																			$hasil = 'SALES MANAGER';
																		}else if ($data_puk['status_approved'] == 'FIN_APP'){
																			$hasil = 'FINANCE MANAGER';
																		}else if ($data_puk['status_approved'] == 'SPV_APP'){
																			$hasil = 'SUPERVISOR';
																		}else if ($data_puk['status_approved'] == 'ADM_APP'){
																			$hasil = 'SALES ADMIN';
																		}else if ($data_puk['status_approved'] == 'N'){
																			if($data_puk['spv_app'] == 'N'){
																				$hasil ='TIDAK DI SETUJUI SUPERVISOR';
																			}else if($data_puk['mngr_app'] == 'N'){
																				$hasil ='TIDAK DI SETUJUI SALES MANAGER';
																			}else if($data_puk['salesadm_app'] == 'N'){
																				$hasil ='TIDAK DI SETUJUI SALES ADMIN';
																			}else if($data_puk['mngr_finance_app'] == 'N'){
																				$hasil ='TIDAK DI SETUJUI MANAGER FINANCE MANAGER';
																			}
																		}
																		echo  $hasil;
																	?>
																</td>
																<td align='center'><?php  echo  $data_puk['tanggal_puk_awal']; ?></td>
																
															</tr>
																	<?php } ?>
																</tbody>
																		
																	</table>
																	<?php
																		$level = $_SESSION['leveluser'];
																		
																		$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ");
																		$cek_akses2 = mysql_fetch_array($cek_akses);
																			if($cek_akses2['ekspor'] == 'Y')
																			{
																	?>
																		<div class="progress-demo">
																			<a href='modul/summary_penjualan/export_summary_penjualan_unitkeluar.php?tgl_awal=<?php echo $_GET['tgl_awal'].'&tgl_akhir='.$_GET['tgl_akhir']; ?>' id="export">
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