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
		include "config/fungsi_thumb.php";
		switch($_GET[act]){
		//tampilkan data
		default:
?>



				<?php 

					if(count($_POST['ubah'])) {
                            
                        // Cek username di database
                        $data=mysql_query("select * from target_spv where bulan='$_POST[bulan]'");
					    $sql = $data;
						$nomor = 0;
						while($data = mysql_fetch_array($sql)){
						$nomor += 1; 
                        $bulan = $_POST['bulan'];
                        $kode_spv = $_POST['kode_spv'.$nomor];
                        $target_unit = $_POST['target_unit'.$nomor];
                        $target_point = $_POST['target_point'.$nomor];
                        
                        
                        // Kalau username valid, inputkan data ke tabel users
                        
                          mysql_unbuffered_query("update target_spv set target_unit=$target_unit, target_point=$target_point where kode_spv='$kode_spv' and bulan='$bulan'");
						
							$msg = "
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil Mengubah Target.</div>";   
                            
						}
					
					}
					
				?>
				
				<?php
										
					if ($_GET['status']=='ok'){
						
					$msg = "
						<div class='alert alert-success alert-dismissable'>
						
						<h4><i class='icon fa fa-check'></i> Selamat!</h4>
						Berhasil menyimpan data, Pilih Tanggal dan klik tombol tampilkan data untuk melihat detail data yang sudah disimpan.</div>";
						
					//echo $msg;
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

					<?php
					}
					?>
				
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Pemasangan Aksesoris</h1>
									<span class="mainDescription">Input Data Pemasangan Aksesoris</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li>
										<span>Aksesoris</span>
									</li>
									<li class="active">
										<span>Checklist Pameran</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<!--h5 class="over-title margin-bottom-15">Keseluruhan <span class="text-bold">Data Sales</span></h5-->
									
										
										<p class="progress-demo">
											<?php
											$level = $_SESSION['leveluser'];
											
											$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ");
											$cek_akses2 = mysql_fetch_array($cek_akses);
											if($cek_akses2['tambah_data'] == 'Y')
											{
										
											?>
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=aksesoris_pemasangan_aksesoris&act=buat';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Tambah Data </span>
											</button>	
											<?php
											}
											?>
											<button type="button" class="btn btn-wide btn-o btn-success" onclick="filter()">
												Filter Pencarian
											</button>	
										</p>
										
										<hr>
										
										
										<div class="modal fade" id="modal_ucok" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onpageshow="focus">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header" style="background-color: white;">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='exit_modal();'>
															<span aria-hidden="true">&times;</span>
														</button>
														<h4 class="modal-title" id="myModal2Label">Detail Aksesoris</h4>
														
													</div>
													
													<div class="modal-body" style="background-color: white;" id = 'lihat_data_aksesoris'>
													
													</div>
												
												</div>
											</div>
										</div>
										
										
										<form action="" method="GET" name="postform">
											<input type="hidden" name="module" value="aksesoris_pemasangan_aksesoris" />
											
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
																						<option value="ADM_APP" <?php if($_GET[status_approved]=='ADM_APP'){echo "selected";  }?>>MENUNGGU PEMASANGAN LOGISTIK</option>	
																						
																	</select>
																</div>
																
																<div class="form-group" >
																	<label class="control-label">
																		   Status Pemesanan <span class="symbol required"></span>
																	</label>
																	
																	<select class="form-control" name="status_pemesanan" >
																						<option value="" disabled>CARI DATA BERDASARKAN:</option>
																						<option value="" <?php if($_GET[status_pemesanan]==''){echo "selected";}  ?>>SEMUA DATA</option>
																						<option value="BP" <?php if($_GET[status_pemesanan]=='BP'){echo "selected"; } ?>>BELUM PESAN</option>
																						<option value="P" <?php if($_GET[status_pemesanan]=='P'){echo "selected";  }?>>SUDAH PESAN</option>	
																	</select>
																</div>
																
																<div class="form-group" >
																	<label class="control-label">
																		   Status Pemasangan <span class="symbol required"></span>
																	</label>
																	
																	<select id="status_pasang" class="form-control" name="status_pasang" >
																						<option value="" disabled>CARI DATA BERDASARKAN:</option>
																						<option value="" <?php if($_GET[status_pasang]==''){echo "selected";}  ?>>SEMUA DATA</option>
																						<option value="BP" <?php if($_GET[status_pasang]=='BP'){echo "selected"; } ?>>BELUM PASANG</option>
																						<option value="P" <?php if($_GET[status_pasang]=='P'){echo "selected";  }?>>SUDAH PASANG</option>	
																	</select>
																</div>
																
																
																
																<div class="form-group">
																	<label class="control-label">
																		Pilih Periode <span class="symbol required"></span>
																	</label>
																	<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
																		<input class="form-control" value = "<?php echo $_GET['tgl_awal']; ?>" type="text" id="tgl_awal" name="tgl_awal" readonly>
																			<span class="input-group-addon bg-primary">s/d</span>
																		<input class="form-control" type="text" value = "<?php echo $_GET['tgl_akhir']; ?>" id="tgl_akhir" name="tgl_akhir" readonly>
																	</div>
																</div>
																
																<div class="form-group" >
																	<label class="control-label">
																		   Berdasarkan <span class="symbol required"></span>
																	</label>
																	
																	<select id="status_pasang" class="form-control" name="berdasarkan" >
																						
																						<option value="user_input" <?php if($_GET[berdasarkan]=='user_input'){echo "selected";}  ?>>INPUT</option>
																						<option value="sales_admin_app" <?php if($_GET[berdasarkan]=='sales_admin_app'){echo "selected"; } ?>>SALESADMIN APPROVE</option>
																						
																	</select>
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
										
							
									
							<?php
							//di proses jika sudah klik tombol cari
							
                    	
							//menangkap nilai form
							$status_approved = addslashes($_GET['status_approved']);
							$status_pemesanan=addslashes($_GET['status_pemesanan']);
							$status_pasang=addslashes($_GET['status_pasang']);
							$berdasarkan = addslashes($_GET['berdasarkan']);
							
							$filter_approved = ($status_approved == "SEMUA" ? "" : "status_approved = '$status_approved' and");
							$filter_pemesanan = ($status_pemesanan == "" ? "" : "status_pemesanan = '$status_pemesanan' and");
							
							$filter_tanggal = ($berdasarkan == "user_input" ? "date(pa.input_form)" : "date(pa.salesadm_app_time)");
							
							$filter_pasang = ($status_pasang == "" ? "" : "status_pasang = '$status_pasang' and" );
							
							
							$tgl_awal=$_GET['tgl_awal'];
							$tgl_akhir=$_GET['tgl_akhir'];
							
							$kueri="select t.nama_tipe as nama_tipe, w.nama_warna as nama_warna, m.nama_model as nama_model ,pa.* from pemasangan_aksesoris pa 
															left join tipe t on t.kode_tipe=pa.tipe_model
															left join model m on m.kode_model=pa.model
															left join warna w on w.kode_warna=pa.warna";
							
							if (empty($tgl_awal) and empty($tgl_akhir)){
								
								
								if (!isset($_GET['status_approved']))
								{
									if ($_SESSION['leveluser'] == 'supervisor') {$query=mysql_query("$kueri where kode_spv = '$_SESSION[kode_spv]' order by pa.no_permohonan desc limit 10");}
									elseif ($_SESSION['leveluser'] == 'user') {$query=mysql_query("$kueri where user_input = '$_SESSION[username]' order by pa.no_permohonan desc limit 10");}
									
									elseif ($_SESSION['leveluser'] != 'supervisor' and $_SESSION['leveluser'] != 'user')
										 {$query=mysql_query("$kueri order by pa.no_permohonan desc limit 10");}
									
								}else{
										
										
										if ($_SESSION['leveluser'] == 'supervisor') {$query=mysql_query("$kueri where $filter_approved $filter_pemesanan $filter_pasang kode_spv = '$_SESSION[kode_spv]' order by pa.no_permohonan desc");}
										elseif ($_SESSION['leveluser'] == 'user') {$query=mysql_query("$kueri where $filter_approved $filter_pemesanan $filter_pasang user_input = '$_SESSION[username]' order by pa.no_permohonan desc");}
										
										elseif ($_SESSION['leveluser'] != 'supervisor' and $_SESSION['leveluser'] != 'user')
											 {$query=mysql_query("$kueri where $filter_approved $filter_pemesanan $filter_pasang no_permohonan != '' order by pa.no_permohonan desc");}
										
									
								}
							
							}else{
                    		
								if ($_SESSION['leveluser'] == 'supervisor') {$query=mysql_query("$kueri where $filter_approved $filter_pemesanan $filter_pasang $filter_tanggal >='$_GET[tgl_awal]' and $filter_tanggal <='$_GET[tgl_akhir]' and kode_spv = '$_SESSION[kode_spv]' order by pa.no_permohonan desc");}
								elseif ($_SESSION['leveluser'] == 'user') {$query=mysql_query("$kueri where $filter_approved $filter_pemesanan $filter_pasang $filter_tanggal >='$_GET[tgl_awal]' and $filter_tanggal <='$_GET[tgl_akhir]' and user_input = '$_SESSION[username]' order by pa.no_permohonan desc");}
								
								elseif ($_SESSION['leveluser'] != 'supervisor' and $_SESSION['leveluser'] != 'user')
									 {$query=mysql_query("$kueri where $filter_approved $filter_pemesanan $filter_pasang $filter_tanggal >='$_GET[tgl_awal]' and $filter_tanggal <='$_GET[tgl_akhir]' order by pa.no_permohonan desc");}
								
								
									
                    		}
							
							
                    		?>
							<div class="col-md-12">
							<div class="form-group">
							<!--div class="table-header"><i><b>Data Pameran: </b> dari Periode <b><?php echo $_GET['tgl_awal']?></b> sampai dengan periode <b><?php echo $_GET['tgl_akhir']?></b></i></div><br /-->
                            </div>
							</div>
							<table id="sample_1" class="table table-striped table-bordered table-hover table-full-width">
								<thead>
									<tr>
										<th width = "5%">No.</th>
										<th>Keterangan</th>
									</tr>
								</thead>
                            <?php
                            	//untuk penomoran data
                            	$no=0;
                            	$level = $_SESSION['leveluser'];
								
								
								
								
								
                            	//menampilkan data
								while($row=mysql_fetch_assoc($query)){
									
									$tombol="<a class='btn btn-xs btn-success' href='media_showroom.php?module=aksesoris_pemasangan_aksesoris&act=approvedpemasangan&id=$row[no_permohonan]' 
										   data-placement='top' data-toggle='tooltip' data-original-title='Setujui Pemasangan Aksesoris $row[no_permohonan]'><i class='fa fa-check'></i> SETUJUI PEMASANGAN</a>
												";	
												
									$tombol_status_pemesanan="<a class='btn btn-xs btn-dark-beige' href='media_showroom.php?module=aksesoris_pemasangan_aksesoris&act=ubahstatuspemesanan&id=$row[no_permohonan]' 
										   data-placement='top' data-toggle='tooltip' data-original-title='Ubah Status Pemesanan Aksesoris $row[no_permohonan]'><i class='fa fa-edit'></i> UBAH STATUS PEMESANAN</a>
												";
												
									$tombol_status_pemasangan="<a class='btn btn-xs btn-dark-beige' href='media_showroom.php?module=aksesoris_pemasangan_aksesoris&act=ubahstatuspemasangan&id=$row[no_permohonan]' 
										   data-placement='top' data-toggle='tooltip' data-original-title='Setujui Pemasangan Aksesoris $row[no_permohonan]'><i class='fa fa-edit'></i> UBAH STATUS PEMASANGAN</a>
												";
										

									$status_pasang = $row['status_pasang'];
									
									$stat_pasang=$status_pasang;
										if($stat_pasang=="P") {
										   $stat_pasang="<span class='label label-success'>Terpasang</span>"; 
										}
										if($stat_pasang=="BP") {
											$stat_pasang="<span class='label label-danger'>Belum Terpasang</span>";
										}
										
										
									$no++;
								?>
									<tr>
										<td><?php echo $no ?>.</td>
										<td><?php echo '<strong>No Form : </strong>'. $row['no_permohonan'] .' / '.$row['input_form'].'<br />
														<strong>No SPK : </strong>'.$row['no_spk'] .'<br /> 
														<strong>Nama Sales : </strong>'.$row['nama_sales'] .' / '.$row['kode_spv'].'<br />
														<strong>Nama Customer : </strong>'.$row['nama_customer'];
											
												if($row['spv_app']=='Y'){
													echo "</br><b>Disetujui oleh Supervisor : </b>".strtoupper($row['spv_user_app'])."</br>";
												}elseif($row['spv_app']=='N'){
													echo "</br><b style='color:red'>Tidak Disetujui oleh Supervisor : </b>".strtoupper($row['spv_user_app'])."</br>";
												}	
											
												if($row['mngr_app']=='Y'){
													echo "<b>Disetujui oleh Manager : </b>".strtoupper($row['mngr_user_app'])."</br>";
												}elseif($row['mngr_app']=='N'){
													echo "<b style='color:red'>Tidak Disetujui oleh Manager : </b>".strtoupper($row['mngr_user_app'])."</br>";
												}	
											
												if($row['salesadm_app']=='Y'){
													echo "<b>Disetujui oleh Sales Admin : </b>".strtoupper($row['salesadm_user_app'])." / ".$row['salesadm_app_time']."</br>";
												}elseif($row['salesadm_app']=='N'){
													echo "<b style='color:red'>Tidak Disetujui oleh Sales Admin : </b>".strtoupper($row['salesadm_user_app'])."</br>";
												}	
												
												if($row['keuangan_app']=='Y'){
													echo "<b>Disetujui oleh Finance : </b>".strtoupper($row['keuangan_user_app'])."</br>";
												}elseif($row['keuangan_app']=='N'){
													echo "<b style='color:red'>Tidak Disetujui oleh Finance : </b>".strtoupper($row['keuangan_user_app'])."</br>";
												}	
											?>
											<br>
											
											
										
											
											<?php
													
												
													if($row['spv_app']==''){
														echo "<span class='label label-danger'>Belum Approve Supervisor</span></br></br>". ($level =="supervisor" || $level == "admin" ? $tombol : ""); 
													}else
													
												
													
													if($row['spv_app']=='Y' and $row['mngr_app']=='' ){
														echo "<span class='label label-warning'>Menunggu Approve Manager</span></br></br>". ($level =="MNGR" || $level == "admin" ? $tombol : ""); 
													}else
													
												
													
													if($row['mngr_app']=='Y' and $row['salesadm_app']==''){
														echo "<span class='label label-warning'>Menunggu Approve SalesAdmin</span></br></br>". ($level =="salesadm" || $level =="staff_salesadm" || $level == "admin" ? $tombol : ""); 
													}else
													
												
													
													if($row['salesadm_app']=='Y' and $row['status_pasang'] == 'P' and $row['status_pasang'] == 'BP' ){
														echo "<span class='label label-danger'>Menunggu Pemasangan Logistik</span></br></br>". ($level =="mngr_finance" || $level == "admin" ? $tombol : ""); 
													}
												
													
													
													if($level == "user" || $level == 'admin' ){
											?>
											
														<a class='btn btn-xs btn-success' href='media_showroom.php?module=aksesoris_pemasangan_aksesoris&act=update&id=<?php echo  substr(md5(md5(addslashes($row['no_permohonan']))),0,28).md5($row['no_permohonan'])  ; ?>' data-placement='top' data-toggle='tooltip' data-original-title='Ubah Data No Permohonan : <?php echo $row['no_permohonan'] ?>'><i class='fa fa-edit'></i> Revisi Data</a>
														<a class='btn btn-xs btn-info' href='media_showroom.php?module=aksesoris_pemasangan_aksesoris&act=tambahlagi&id=<?php echo $row['no_spk']; ?>' data-placement='top' data-toggle='tooltip' data-original-title='Tambah Item Aksesoris Nomor Spk : <?php echo $row['no_spk'] ?>'><i class='fa fa-check'></i> Tambahan Aksesoris</a>
											<?php			
													}
												
											
											?>
											
											<a class='btn btn-xs btn-info' href='media_showroom.php?module=aksesoris_pemasangan_aksesoris&act=lihat&id=<?php echo $row['no_permohonan']; ?>' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Data No Permohonan : <?php echo $row['no_permohonan'] ?>'><i class='fa fa-check'></i> Lihat Data</a>
											<?php			
													
												
											if($row['salesadm_app']=='Y' ){	
											?>
											
											<a class='btn btn-xs btn-warning' href='modul/aksesoris/action/pemasangan_aksesoris_laporan.php?id=<?php echo substr(md5(md5(addslashes($row['no_permohonan']))),0,28).md5($row['no_permohonan']) ; ?>' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pemasangan Aksesoris <?php echo $row['no_permohonan']; ?>' target='_blank'><i class='fa fa-print'></i> CETAK</a>	
											<?php			
											}	
												
												echo ($row['status_pemesanan'] == 'P' ? "<span class='label label-success'>Aksesoris Sudah Di Pesan</span> " :( $level == "salesadm" || $level == "staff_salesadm" || $level == "admin" ? $tombol_status_pemesanan : "")) ; 
												echo ($row['status_pasang'] == 'P' ? "<span class='label label-success'>Aksesoris Sudah Di Pasang</span> " :($row['status_pemesanan'] == 'BP' ? "" : ($level =="staff_logistik" || $level == "admin" ? $tombol_status_pemasangan : "")));
											?>
										</td>
									</tr>
									
                                <?php
                            	}
                            	?>
							</table>
						
						</form>
                           </div>
                     </div>
                </div>
            
            </div>
        </div>
			<script language="JavaScript">
					function filter(){
						$("#filter").modal('show');
						
					}
					function tampil_modal(id){
						param_id = id;
						//alert(id);
						$.ajax({
									method : "GET",
									url : "modul/aksesoris/action/ajax_lihat_aksesoris.php",
									data : {data_ajax : param_id},
									success : function(data){

										$("#modal_ucok").modal('show');
										$('#lihat_data_aksesoris').html(data);
										
									}	
								})
					}
			</script>



			
<?php 
	break;
	case "buat":
	include "action/buat_permohonan.php";
		

	break;
	case "tambahlagi":
	include "action/tambah_lagi.php";
		

	break;
	case "lihat":
	include "action/approve_pemasangan.php";
		

	break;
	case "approvedpemasangan":
	include "action/approve_pemasangan.php";
	
	break;
	case "ubahstatuspemesanan":
	include "action/approve_pemasangan.php";
	
	break;
	case "ubahstatuspemasangan":
	include "action/approve_pemasangan.php";
		
	
	break;
	case "print":
	
	include "laporan_pemasangan_aksesoris.php";

	
	break;
	case "cetak":
	
	include "contoh.php";
	
	break;
	case "update":
	include "action/ubah_data_pemasangan.php";
	break;
} 
}?>