<?php
session_start();

require "config/koneksi_sqlserver.php";

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
?>	

               <script language="JavaScript">
					function warning() {
						return confirm('Anda yakin menghapus data ini?');
					}
					function tampil(){
						document.getElementById("tampil_data").click();
					}
					
					function tampil_modal(id){
						param_id = id;
						//alert(id);
						$.ajax({
									method : "GET",
									url : "modul/logistik/action/puk_ajax_lihat_spk.php",
									data : {data_ajax : param_id},
									success : function(data){
										
										$('#modal').html(data);
										$("#modal").modal('show');
										
									}	
								})
						
					}
				</script>
				
				<?php
										
					if ($_GET['status']=='ok'){
						
						$msg = "
						<div class='alert alert-success alert-dismissable'>
						
						<h4><i class='icon fa fa-check'></i> Selamat!</h4>
						Berhasil menyimpan data, Pilih Tanggal dan klik tombol tampilkan data untuk melihat detail data yang sudah disimpan.</div>";
						
					
					
					 }else if ($_GET['status']=='double'){	
						$msg = "
						<div class='alert alert-danger alert-dismissable'>
						
						<h4><i class='icon fa fa-check'></i> Perhatian!</h4>
						Gagal!!!! Data sudah ada..</div>";
					//echo $msg;
					 }else if ($_GET['status']=='galengkap'){	
						 $msg = "
						<div class='alert alert-danger alert-dismissable'>
						
						<h4><i class='icon fa fa-check'></i> Perhatian!</h4>
						Gagal!!!! Data tidak lengkap..</div>";
						 
					 }
					 if (isset($_GET['status'])){
					?>
					
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog  modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="myModalLabel">Info</h4>
								</div>
								<div class="modal-body">
									<?php echo $msg; ?>
																						
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
										Tutup
									</button>
									<!--button type="button" class="btn btn-primary">
										Save changes
									</button-->
								</div>
							</div>
						</div>
					</div>
					 <?php } ?>
	
					
				
				
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE --->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Logistik</h1>
									<span class="mainDescription">Permohonan Unit Keluar</span>
								</div>
								<!--ol class="breadcrumb">
									<li>
										<span>Logistik</span>
									</li>
									<li class="active">
										<span>Permohonan Unit Keluar</span>
									</li>
								</ol-->
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<!--h5 class="over-title margin-bottom-15">Keseluruhan <span class="text-bold">Data Sales</span></h5-->
									
										<?php
										    $level = $_SESSION['leveluser'];
										    
										    $cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
										    left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 
										    
										    ");
										    $cek_akses2 = mysql_fetch_array($cek_akses);
										    
										
										    if($cek_akses2['tambah_data'] == 'Y')
										    {
										
										?>
										
										
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=logistik_puk&act=buat';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Tambah Data</span>
											</button>	
											
									
										
										<?php
		                                }
										?>
										<button type="button" class="btn btn-wide btn-o btn-success"  data-toggle="modal" data-target="#filter">
												Filter Pencarian
											</button>	
											<hr>
								</div>
							</div>
						<form action="" method="GET" name="postform">
							
							<input type = "hidden" name = "module" value = "logistik_puk" />				
                             
							<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onpageshow="focus">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header" style="background-color: white;">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
											<h4 class="modal-title" id="myModalLabel">Filter Data</h4>
										</div>
										<div class="modal-body" style="background-color: white;">
											
											<div class="form-group" >
												<label class="control-label">
													   Status Persetujuan <span class="symbol required"></span>
												</label>
												
												<select class="form-control" name="status_approved" >
																	<option value="SEMUA" disabled>CARI DATA BERDASARKAN:</option>
																	<option value="SEMUA" <?php if($_GET[status_approved]=='SEMUA'){echo "selected";}  ?>>SEMUA DATA</option>
																	<option value="" <?php if (isset($_GET[status_approved])){if($_GET[status_approved]==''){echo "selected"; }} ?>>BELUM DI PROSES</option>
																	<option value="N" <?php if($_GET[status_approved]=='N'){echo "selected"; } ?>>TIDAK DI SETUJUI</option>
																	<option value="SPV_APP" <?php if($_GET[status_approved]=='SPV_APP'){echo "selected"; } ?>>MENUNGGU APPROVE MANAGER</option>
																	<option value="MNGR_APP" <?php if($_GET[status_approved]=='MNGR_APP'){echo "selected";  }?>>MENUNGGU APPROVE ADMIN SALES</option>	
																	<option value="ADM_APP" <?php if($_GET[status_approved]=='ADM_APP'){echo "selected";  }?>>MENUNGGU APPROVE FINANCE</option>	
																	<option value="FIN_APP" <?php if($_GET[status_approved]=='FIN_APP'){echo "selected";  }?>>SUDAH APPROVE FINANCE</option>	
																	
												</select>
											</div>
										
											<label class="control-label">
												<font>Pilih Range Tanggal <span class="symbol required"></span></font>
											</label>
											<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
												<input class="form-control" type="text" placeholder ="Pilih Tanggal Awal" name="tgl_awal" id="tgl_awal" value = "<?php echo $_GET[tgl_awal] ?>" readonly>
												
												<span class="input-group-addon bg-primary">s/d</span>
												<input class="form-control" type="text" placeholder ="Pilih Tanggal Akhir" name="tgl_akhir" id="tgl_akhir" value = "<?php echo $_GET[tgl_akhir] ?>" readonly>
											</div>
				
							
										</div>
										<div class="modal-footer" style="background-color: white;">
											<button type="submit" name="cari" class="btn btn-primary">Tampilkan Data</button>
											<button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
												Close
											</button>
											
					
											
						
					
										</div>
									</div>
								</div>
							</div>
							
							
							
						 </form>
							<div class="row">
								<div class="col-md-12">
								<?php
									$status_approved = addslashes($_GET['status_approved']);
							
							
									$filter_approved = ($status_approved == "SEMUA" ? "" : "status_approved = '$status_approved' and");
									
									$tgl = ($status_approved == "" ? "input" : ($status_approved == "ADM_APP" ? "salesadm_app_time" : ($status_approved == "MNGR_APP" ? "mngr_app_time" : ($status_approved == "SPV_APP" ? "spv_app_time" : ($status_approved == "SEMUA" ? "input" : ($status_approved == "N" ? "input" : ($status_approved == "FIN_APP" ? "mngr_finance_app_time" : "input")))))));
									
									if(($_GET['tgl_awal'] != '') && ($_GET['tgl_akhir'] != '')){
										
										if($_SESSION['leveluser']!='supervisor'){
											if($_SESSION['leveluser'] =='user'){
												$qry=mysql_query("select * from unit_keluar where $filter_approved nama_sales = '$_SESSION[username]' and substr(date($tgl), 1, 10)>='$_GET[tgl_awal]' AND substr(date($tgl), 1, 10)<='$_GET[tgl_akhir]' order by no_puk desc");	
											}else {
												$qry=mysql_query("select * from unit_keluar where $filter_approved substr(date($tgl), 1, 10)>='$_GET[tgl_awal]' AND substr(date($tgl), 1, 10)<='$_GET[tgl_akhir]' order by no_puk desc");	
												
											}
											
										}else{
											$qry=mysql_query("select * from unit_keluar where $filter_approved kd_spv='$_SESSION[kode_spv]' AND substr(date($tgl), 1, 10)>='$_GET[tgl_awal]' AND substr(date($tgl), 1, 10)<='$_GET[tgl_akhir]' order by no_puk desc");	
										}
									}else{
										
										
										if ($status_approved == ""){
											if($_SESSION['leveluser']!='supervisor'){
												if($_SESSION['leveluser'] =='user'){
													$qry=mysql_query("select * from unit_keluar where nama_sales = '$_SESSION[username]' order by no_puk desc limit 10");	
												}else {
													$qry=mysql_query("select * from unit_keluar order by no_puk desc limit 10");	
													
												}
												
											}else{
												$qry=mysql_query("select * from unit_keluar where kd_spv='$_SESSION[kode_spv]' order by no_puk desc limit 10");	
											}

											
										}else{
											if ($status_approved == "SEMUA"){
												$limit = "limit 50";
											}else{
												$limit = "";
											}
											
											if($_SESSION['leveluser']!='supervisor'){
												if($_SESSION['leveluser'] =='user'){
													$qry=mysql_query("select * from unit_keluar where $filter_approved nama_sales = '$_SESSION[username]' order by no_puk desc $limit");	
												}else {
													$qry=mysql_query("select * from unit_keluar where $filter_approved no_puk !='' order by no_puk desc $limit");	
													
												}
												
											}else{
												$qry=mysql_query("select * from unit_keluar where kd_spv='$_SESSION[kode_spv]' order by no_puk desc $limit");	
											}
										}
										
	
									}									
								?>
							
									<!--div class="table-header"><i><b>Pencarian Data Permohonan Unit Keluar <?php echo $_GET[tgl_awal] ?> Sampai <?php echo $_GET[tgl_akhir] ?> <?php echo $_SESSION['kode_supervisor'] ?></b></i></div><br /-->
						
                        <table id="sample_2" class="table table-striped table-bordered table-hover table-full-width">
                    		<thead>
                    			<tr>
									<th>No.</th>
									<th>Keterangan <?php echo $tgl ?></th>
									
								</tr>
                    		</thead>
                            <tbody>
											
							<?php
								$no = 0;
								while($dt = mysql_fetch_array($qry)){
									
									
									$query = "select SPK.* from vw_PukSOS SPK
																where SPK.NomorSPK = '$dt[no_spk]' ";
									$query = sqlsrv_query($conn, $query);
									$n=0;
									while($data = sqlsrv_fetch_array($query)){
										$norangka = $data['NoRangka'];
										$nomesin = $data['NoMesin'];
										$tipe = $data['NamaTipe'];
										$nama_customer = $data['NamaCustomer'];
										$cara_beli = $data['JenisPenjualan'];
										$nomor_kontrak = $data['NomorKontrak'];
									}
									
									
								$no++;
								$awal = $_GET['tgl_awal'];
								$akhir = $_GET['tgl_akhir'];
								$setuju = "<a class='btn btn-xs btn-success' href='media_showroom.php?module=logistik_puk&act=approvepermohonan&id=$dt[no_spk]' data-placement='top' data-toggle='tooltip' data-original-title=' Setujui Permohonan Unit Keluar $dt[no_spk]'><i class='fa fa-check'></i>  Setujui Permohonan</a>";
							?>
							<?php
								$qry1 = mysql_query("select * from matching_local where no_spk_local='$dt[no_spk]'");
								$sql1 = mysql_fetch_array($qry1);
							?>
							<?php
								$qry2 = mysql_query("select * from data_mobil where norangka='$sql1[norangka_local]'");
								$sql2 = mysql_fetch_array($qry2);
							?>
							<?php
							//	$qry3 = mysql_query("select * from pengajuan_discount where no_spk='$dt[no_spk]'");
								$qry3 = mysql_query("SELECT pd.tipe_mobil as tipe_mobil, t.nama_tipe as nama_tipe, pd.*, t.* FROM pengajuan_discount pd, tipe t where no_spk='$dt[no_spk]' and t.kode_tipe = pd.tipe_mobil");
								$sql3 = mysql_fetch_array($qry3);
							?>
							<?php
								$qry4 = mysql_query("select * from status_spk where no_spk='$dt[no_spk]'");
								$sql4 = mysql_fetch_array($qry4);
							?>
							
							
						
								<tr>
									<td width='5%'><?php echo $no;?></td>
									<td>
										<b>No PUK : </b><?php echo $dt['no_puk'];?></br>
										<b>Salesman : </b><?php echo $dt['nama_sales'];?> / <?php echo $dt['input'];?></br>
										<b>Nama Customer : </b><?php echo $nama_customer;?></br>
										<b>No SPK : </b><?php echo $dt['no_spk'];?></br>
										<b>Waktu Keluar : </b><?php echo $dt['waktu_keluar'];?></br>
										
										<?php
											if($dt['spv_app']=='Y'){
												echo "</br><b>Disetujui oleh Supervisor : </b>".strtoupper($dt['spv_user_app'])." / ".$dt['spv_app_time']."</br>";
											}elseif($dt['spv_app']=='N'){
												echo "</br><b style='color:red'>Tidak Disetujui oleh Supervisor : </b>".strtoupper($dt['spv_user_app'])."</br>";
											}	
										
											if($dt['mngr_app']=='Y'){
												echo "<b>Disetujui oleh Manager : </b>".strtoupper($dt['mngr_user_app'])." / ".$dt['mngr_app_time']."</br>";
											}elseif($dt['mngr_app']=='N'){
												echo "<b style='color:red'>Tidak Disetujui oleh Manager : </b>".strtoupper($dt['mngr_user_app'])."</br>";
											}	
										
											if($dt['salesadm_app']=='Y'){
												echo "<b>Disetujui oleh Sales Admin : </b>".strtoupper($dt['salesadm_user_app'])." / ".$dt['salesadm_app_time']."</br>";
											}elseif($dt['salesadm_app']=='N'){
												echo "<b style='color:red'>Tidak Disetujui oleh Sales Admin : </b>".strtoupper($dt['salesadm_user_app'])."</br>";
											}	
											
											if($dt['mngr_finance_app']=='Y'){
												echo "<b>Disetujui oleh Finance : </b>".strtoupper($dt['mngr_finance_user_app'])." / ".$dt['mngr_finance_app_time']."</br>";
											}elseif($dt['mngr_finance_app']=='N'){
												echo "<b style='color:red'>Tidak Disetujui oleh Finance : </b>".strtoupper($dt['mngr_finance_app'])."</br>";
											}	
										?>
										<br>
										<!--b>Tipe : </b><?php echo $tipe ;?></br>
										<b>No Rangka : </b><?php echo $norangka; ?></br>
										<b>No Mesin : </b><?php echo $nomesin;?></br>
										<b>Nama Customer : </b><?php echo $nama_customer;?></br>
										<!--b>Waktu Keluar : </b><?php echo $dt['tgl_keluar']." ".$dt['jam_keluar'];?></br-->
										
										<!--b>Cara Pembayaran : </b><?php echo $cara_beli;?></br>
										<?php if($cara_beli != 'Tunai') {?><b>Leasing : </b><?php echo $sql3['leasing'];?><b> / Tenor : </b><?php echo $sql3['tenor'];?></br--> <?php } ?>
										<?php
										
										
										?>
										
										
										<div class="progress-demo">
											<?php
												//echo $setuju;
												$no_spk = md5(md5($dt['no_spk']));
											?>
										
											
											<!--a class='btn btn-xs btn-info' onclick="<?php echo "tampil_modal('$no_spk')"; ?>;"><i class='fa fa-check'></i> Lihat Data</a-->
											
											<?php 
												if($_SESSION[leveluser] == 'admin' || $_SESSION[leveluser] == 'salesadm' || $_SESSION[leveluser] == 'staff_salesadm' || $_SESSION[leveluser] == 'supervisor' || $_SESSION['leveluser'] == 'mngr_finance' || $_SESSION['leveluser'] == 'ar_finance' || $_SESSION['leveluser']== 'spv_finance' || $_SESSION['leveluser']== 'staff_logistik'){ 
													if ($cara_beli == "Kredit" and $nomor_kontrak != "-"){	
											?>
													<a class='btn btn-xs btn-warning' href='modul/logistik/action/puk_laporan_permohonan.php?id=<?php echo md5(md5($dt['no_spk']));?>' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Permohonan <?php echo $dt['no_puk'] ?>' target='_blank'><i class='fa fa-print'></i> CETAK</a>
											<?php 
													}elseif($cara_beli != "Kredit"){
											?>
													<a class='btn btn-xs btn-warning' href='modul/logistik/action/puk_laporan_permohonan.php?id=<?php echo md5(md5($dt['no_spk']));?>' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Permohonan <?php echo $dt['no_puk'] ?>' target='_blank'><i class='fa fa-print'></i> CETAK</a>
											<?php
													}else{
														echo "<span class='label label-danger'>No Kontrak Blm Diinput</span>";
														if($_SESSION[leveluser] == 'staff_logistik'){
															echo "<a class='btn btn-xs btn-warning' href='modul/logistik/action/puk_laporan_permohonan.php?id=".md5(md5($dt['no_spk']))."' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Permohonan $dt[no_puk]' target='_blank'><i class='fa fa-print'></i> CETAK</a>";
														}
														
													}
												}
											
											
											
										/*	$tanggal_hari_ini = strtotime(date('Y-m-d'));
											$tanggal_keluar = strtotime(substr($dt['waktu_keluar'], 0, 11));
											$no_spk_md5 = md5(md5($dt[no_spk]));
											
											$time_diff = abs($tanggal_keluar - $tanggal_hari_ini);
											
											$day = $time_diff/86400;
											$numberDays = intval($day);
											
											$tombol_revisi = "<a class='btn btn-xs btn-success' href='media_showroom.php?module=logistik_puk&act=update&id=$no_spk_md5' data-placement='top' data-toggle='tooltip' data-original-title='Ubah data $dt[no_puk] '><i class='fa fa-edit'></i> Ubah Data</a>";
											
											if($_SESSION[leveluser] == 'MNGR' or $_SESSION[leveluser] == 'supervisor'){
												if(($numberDays == 1) and $_SESSION[leveluser] == 'supervisor' and !($tanggal_hari_ini > $tanggal_keluar)){
													echo $tombol_revisi;
												}else if($numberDays == 0 and ($_SESSION[leveluser] == 'MNGR')){
													echo $tombol_revisi;
												}else{
													echo "";
												}
											}else if($numberDays >= 2 and ($_SESSION[leveluser] == 'user' || $_SESSION[leveluser] == 'admin') and !($tanggal_hari_ini > $tanggal_keluar)){
												echo $tombol_revisi;
											}else{
												echo "";
											}	*/
											
											
											if ($_SESSION[leveluser] == 'user' || $_SESSION[leveluser] == 'admin'){
											?>
											<a class='btn btn-xs btn-success' href='media_showroom.php?module=logistik_puk&act=update&id=<?php echo md5(md5($dt['no_spk'])); ?>' data-placement='top' data-toggle='tooltip' data-original-title='Ubah data <?php echo $dt['no_puk'].$numberDays ?>'><i class='fa fa-edit'></i> Ubah Data</a>
											
											<?php }?>
											
											<?php
											
												$cek_approve = mysql_query("select * from unit_keluar where no_spk = '$dt[no_spk]'");
												$data_cek_approve = mysql_fetch_array($cek_approve);
												$spv_app = $data_cek_approve['spv_app'];
												$mngr_app = $data_cek_approve['mngr_app'];
												$salesadm_app = $data_cek_approve['salesadm_app'];
												$finance_app = $data_cek_approve['mngr_finance_app'];
												if($_SESSION['leveluser'] == 'admin' or $_SESSION['leveluser'] == 'supervisor'){
													if($spv_app == 'Y'){
														$button_type = 'info';
														$button_name = ' Lihat Data';
													}else{
														$button_type = 'warning';
														$button_name = ' Setujui Permohonan';
													}
												}elseif($_SESSION['leveluser'] == 'MNGR'){
													if($spv_app == 'Y'){
														if($mngr_app == 'Y'){
															$button_type = 'info';
															$button_name = ' Lihat Data';
														}else{
															$button_type = 'warning';
															$button_name = ' Setujui Permohonan';
														}
													}elseif($spv_app == 'N'){
														$button_type = 'danger';
														$button_name = 'Tidak Disetujui';
													}else{
														$button_type = 'danger';
														$button_name = 'Belum Diproses';
													}
												}elseif($_SESSION['leveluser'] == 'salesadm' || $_SESSION['leveluser'] == 'staff_salesadm'){
													if($mngr_app == 'Y'){
														if($salesadm_app == 'Y'){
															$button_type = 'info';
															$button_name = ' Lihat Data';
														}else{
															$button_type = 'warning';
															$button_name = ' Setujui Permohonan';
														}
													}elseif($mngr_app == 'N'){
														$button_type = 'danger';
														$button_namee = 'Tidak Disetujui';
													}else{
														$button_type = 'danger';
														$button_name = 'Belum Diproses';
													}
												}elseif($_SESSION['leveluser'] == 'mngr_finance'){
													if($salesadm_app == 'Y'){
														if($finance_app == 'Y'){   
															$button_type = 'info';
															$button_name = ' Lihat Data';
														}else{
															$button_type = 'warning';
															$button_name = ' Setujui Permohonan';
														}
													}elseif($salesadm_app == 'N'){
														$button_type = 'danger';
														$button_namee = 'Tidak Disetujui';
													}else{
														$button_type = 'danger';
														$button_name = 'Belum Diproses';
													}
												}elseif($_SESSION['leveluser'] == 'staff_logistik'){
													
															$button_type = 'info';
															$button_name = ' Lihat Data';
														
												}elseif($_SESSION['leveluser'] == 'ar_finance'){
													if($salesadm_app == 'Y'){
														$button_type = 'info';
														$button_name = 'Tambahkan Catatan';
													}else{
														$button_type = 'danger';
														$button_name = 'Belum Diproses';
													}
												}
												
												
												
												if($_SESSION['leveluser'] == 'admin' || $_SESSION['leveluser'] == 'supervisor' || $_SESSION['leveluser'] == 'MNGR' || $_SESSION['leveluser'] == 'salesadm' || $_SESSION['leveluser'] == 'staff_salesadm' || $_SESSION['leveluser'] == 'mngr_finance' || $_SESSION['leveluser'] == 'staff_logistik' || $_SESSION['leveluser'] == 'ar_finance'){
											?>
												<a class='btn btn-xs btn-<?php echo $button_type ?>' href='media_showroom.php?module=logistik_puk&act=approvedpermohonan&id=<?php echo md5(md5($dt['no_spk'])); ?>' data-placement='top' data-toggle='tooltip' data-original-title='Approve Permohonan <?php echo $dt['no_spk'] ?>'><i class='fa fa-edit'></i><?php echo $button_name ?></a>
											<?php
												}
											?>
										</div>
										
										</br>
									</td>
									
									
								</tr>
								
							<?php
								
								}
							?>
											
							</tbody>
                        </table>
						
						<!--a href='modul/ekspor?tgl_awal=.php'-->
						<!--a href='modul/ekspor.php?$dt['tgl_awal']'-->
						
						
								</div> 
							</div>
						</div>
					</div>
				</div>
				
				<div class="modal fade" id="modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							
				</div>

			
<?php 
	break;
	case "buat":
	include "action/puk_buat_permohonan_unit_keluar.php";

    break;
    case "hapuspengajuan":
    $sql 	= "delete from unit_keluar where no_spk='$_GET[id]'";
    $query	= mysql_query($sql);
   
	header('location:../media_showroom.php?module=logistik_puk');

	break;
	case "approvedpermohonan":
	include "action/puk_approve_permohonan_unit_keluar.php";
	
	break;
	case "update":
	
	$query = mysql_query("select * from unit_keluar where md5(md5(no_spk)) = '$_GET[id]'");
	$data = mysql_fetch_array($query);
?>				

				<?php ($_SESSION['leveluser'] == "MNGR" ? $level_lokal = "odj0933*&^%&f.,s2@^#&%$*()_;" : $level_lokal = "") ;?>

				<script type="text/javascript" src="vendor/jquery/jquery.min.js"></script> 					
				<script>var level_lokal = "<?php echo $level_lokal; ?>";</script>
				<script type="text/javascript" src="modul/logistik/action/puk.js"></script> 
				
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Permohonan Unit Keluar</h1>
									<span class="mainDescription">Revisi permohonan unit keluar</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Permohonan Unit Keluar</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						
						
						
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" id="form" enctype="multipart/form-data" method="post" action="modul/logistik/action/puk_simpan_permohonan_unit_keluar.php?aksi=update">
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
													<div class="form-group">
														<label class="control-label">
															Nomor PUK <span class="symbol required"></span>
														</label>
														<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  value="<?php echo $data['no_puk']; ?>" class="form-control" name="no_puk" required readonly>
													</div>
													
													
													<div class="form-group">
														<label for="form-field-mask-1">
															Nomor SPK <small class="text-success"></small>
														</label>
														
															<input id="nospk" class="form-control" type="text" value="<?php echo $data['no_spk'] ?>" placeholder="NO SPK" name="nospk" readonly onblur="puk();">
															
													</div>
													
													
													
													
													<!--div class="form-group">
														<label class="control-label">
															Tanggal Keluar <span class="symbol required"></span>
														</label>
														<p class="input-group input-append datepicker date " data-date-format="yyyy-mm-dd">
															<input class="form-control" required  type="text" placeholder ="Pilih Tanggal Keluar" name="tanggal" value = "<?php //echo date("Y-m-d"); ?>">
															<span class="input-group-btn">
																<button type="button" class="btn btn-default">
																	<i class="glyphicon glyphicon-calendar"></i>
																</button> 
															</span>
														</p>
													</div-->
													
													<div class="form-group">
														<label class="control-label">
															Tanggal Keluar (Kuota 6) <span class="symbol required"></span>
														</label>
														<p class="input-group input-append datepicker date " data-date-format="yyyy-mm-dd">
															<input class="form-control" id="tanggal_keluar" required readonly type="text" placeholder ="Pilih Tanggal Keluar"  name="tanggal">
															
															<span class="input-group-btn">
																<button type="button" class="btn btn-default">
																	<i class="glyphicon glyphicon-calendar"></i>
																</button> 
															</span>
														</p>
													</div>
													
													
												
													
													
													<div class="form-group">
														<label>
															Pilih Jam
														</label>
														<select data-placeholder="Pilih Jam" class="js-example-basic-single js-states form-control" style="height:50px;" required name="jam1">
																<option value="">Pilih Jam</option>
																<?php for($i=6; $i<20; $i++ ){
																echo "<option value=".($i<10 ? "0$i" : "$i") .">".($i<10 ? "0$i" : "$i")."</option>";
																
																  }?>
														</select>
													</div>
													<div class="form-group">
														<label>
															Pilih Menit
														</label>
														<select data-placeholder="Pilih Menit" class="js-example-basic-single js-states form-control" style="height:50px;" required name="menit1">
																<option value="">Pilih Menit</option>
																<?php for($i=0; $i<60; $i=$i+5 ){
																echo "<option value=".($i<10 ? "0$i" : "$i") .">".($i<10 ? "0$i" : "$i")."</option>";
																
																  }?>
														</select>
													</div>
													
													
													<div class="form-group">
														<label class="control-label">
															Keterangan <span class="symbol required"></span>
														</label>
														<div class="form-group">
															<div class="note-editor">
																<textarea class="form-control" id="keterangan" name="keterangan"></textarea>
															</div>
														</div>
													</div>
													
												</div>
												<p id="txtHint"></p>
											</div>
										</div>
									</br>
										<div class="row">											
											<div class="col-md-4">
												
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Simpan
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=window.location.href='media_showroom.php?module=logistik_puk'>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
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
	
}
}
 ?>