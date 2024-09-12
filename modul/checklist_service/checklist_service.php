<script type="text/javascript" src="../../assets/js/jquery.1.6.js"></script>

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
	
		
		include "config/koneksi_service.php";
		
		switch($_GET[act]){
		//tampilkan data
		default:
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
				
				
			<?php
				$judul_header = mysql_query("select * from menu where module = '$_GET[module]'",$koneksi_showroom);
				$hasil_judul_header = mysql_fetch_array($judul_header);
			?>
			<div class="main-content">
				<div class="wrap-content container" id="container">
					<!-- start: PAGE TITLE -->
					<section id="page-title">
						<div class="row">
							<div class="col-sm-8">
								<h1 class="mainTitle">Data <?php echo $hasil_judul_header['nama_menu']; ?></h1>
								<span class="mainDescription">Tambah <?php echo $hasil_judul_header['nama_menu']; ?> pada Database</span>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>Service</span>
								</li>
								<li>
									<span>Checklist</span>
								</li>
								<li class="active">
									<span><?php echo $hasil_judul_header['nama_menu']; ?></span>
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
									    
										<?php
										    $level = $_SESSION['leveluser'];
										    
										    $cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
										    left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 
										    
										    ",$koneksi_showroom);
										    $cek_akses2 = mysql_fetch_array($cek_akses);
										    
										
										    if($cek_akses2['tambah_data'] == 'Y')
										    {
										
										?>
										<div class="progress-demo">
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=service_checklist_service&act=buat';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Input Data Checklist service<span>
											</button>	
										</div>
										<hr>
										<?php
		                                }
										?>
								</div>
									
								<form action="" method="GET" name="postform">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">
												Pilih Periode <span class="symbol required"></span>
											</label>
												<input type="hidden" name="module" value="service_checklist_service" />					 
												<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm'>
													<input class="form-control" type="text" id="tgl_awal" value = "<?php echo $_GET[tgl_awal]; ?>" name="tgl_awal" readonly>
														<!--span class="input-group-addon bg-primary">s/d</span>
													<input class="form-control" type="text" id="tgl_akhir" value = "<?php echo $_GET[tgl_akhir]; ?>" name="tgl_akhir" readonly-->
												</div>
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" name="cari" class="btn btn-white btn-info btn-bold">Tampilkan Data</button>
										</div>
									</div>
								
								</form>        
									
								<?php
									//di proses jika sudah klik tombol cari
									if(isset($_GET['cari'])){
								
									//menangkap nilai form
									$tgl_awal=$_GET['tgl_awal'];
									$tgl_akhir=$_GET['tgl_akhir'];
									if (empty($tgl_awal) and empty($tgl_akhir)){
									}else{
										$bulan_pengecekan_tgl_awal  = substr($tgl_awal, 5, 2);
										$query = mysql_query("select * from pengecekan_service where substr(tanggal, 6, 2) = '$bulan_pengecekan_tgl_awal'");
									}
								?>
                    
								<table id="sample_1" class="table table-striped table-hover table-full-width">
									<thead>
										<tr>
											<th width = "5%">No.</th>
											<th>Keterangan</th>
										</tr>
									</thead>
								<?php
									//untuk penomoran data
									$no=0;
									$tombollogin = $_SESSION['leveluser'];
									//menampilkan data
									while($row=mysql_fetch_array($query)){
									$tombol=$tombollogin;
										 
											$ubah_data="
												 <a class='btn btn-xs btn-info' href='media_showroom.php?module=service_checklist_service&act=lihat&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Ubah Data Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-eye'></i> UBAH DATA</a>
												 "; 
											$beri_persetujuan="
												<a class='btn btn-xs btn-warning' href='media_showroom.php?module=service_checklist_service&act=approve&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Approve Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-check'></i> BERI PERSETUJUAN</a>
												 "; 
												 
											$menunggu_persetujuan="
												 <a class='btn btn-xs btn-warning' href='media_showroom.php?module=service_checklist_service&act=approve&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Approve Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-check'></i> MENUNGGU PERSETUJUAN</a>
												 "; 
											$sudah_diproses="
												 <a class='btn btn-xs btn-success' href='media_showroom.php?module=service_checklist_penampilan_sa&act=approve&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Approve Laporan Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-check'></i> SUDAH DIPROSES</a>
												 "; 
											$belum_diproses="
												  <a class='btn btn-xs btn-danger' href='media_showroom.php?module=service_checklist_service&act=approve&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Approve Laporan Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-close'></i> BELUM DIPROSES</a>
												 ";		 
													 
											$tombol3="
												 <a class='btn btn-xs btn-warning' href='modul/checklist_service/laporan_pengecekan_service.php?no_pengecekan_mingguan=$row[no_pengecekan_mingguan]' target='_BLANK' data-toggle='tooltip' data-original-title='Cetak Pengecekan $row[no_pengecekan_mingguan]' ><i class='fa fa-print'></i> CETAK</a>
												 "; 
											$tombol4="
												 <a class='btn btn-xs btn-warning' href='modul/checklist_service/export_pengecekan_service.php?bulan=$row[bulan]' data-toggle='tooltip' data-original-title='Ekspor Pengecekan $row[no_pengecekan_mingguan]' ><i class='fa fa-print'></i> Ekspor ke Excel</a>
												 "; 
											
									$no++;
									$bulan = $row['bulan'];
									if($bulan == '01'){
										 $bulan = "Januari";
									}elseif($bulan == '02'){
										 $bulan = "Februari";
									}elseif($bulan == '03'){
										 $bulan = "Maret";
									}elseif($bulan == '04'){
										 $bulan = "April";
									}elseif($bulan == '05'){
										 $bulan = "Mei";
									}elseif($bulan == '06'){
										 $bulan = "Juni";
									}elseif($bulan == '07'){
										 $bulan = "Juli";
									}elseif($bulan == '08'){
										 $bulan = "Agustus";
									}elseif($bulan == '09'){
										 $bulan = "September";
									}elseif($bulan == '10'){
										 $bulan = "Oktober";
									}elseif($bulan == '11'){
										 $bulan = "November";
									}elseif($bulan == '12'){
										 $bulan = "Desember";
									}else{
										 $bulan = "";
									}
									
									$periode_pengecekan = mysql_query("select min(tanggal) as first from pengecekan_service_detail where no_pengecekan_mingguan = '$row[no_pengecekan_mingguan]'");
									$data_periode_pengecekan = mysql_fetch_array($periode_pengecekan);
									$tgl_pengecekan_awal = substr($data_periode_pengecekan['first'], 8, 2).'-'.substr($data_periode_pengecekan['first'], 5, 2).'-'.substr($data_periode_pengecekan['first'], 0, 4);
									
									$periode_pengecekan2 = mysql_query("select max(tanggal) as last from pengecekan_service_detail where no_pengecekan_mingguan = '$row[no_pengecekan_mingguan]'");
									$data_periode_pengecekan2 = mysql_fetch_array($periode_pengecekan2);
									$tgl_pengecekan_akhir = substr($data_periode_pengecekan2['last'], 8, 2).'-'.substr($data_periode_pengecekan2['last'], 5, 2).'-'.substr($data_periode_pengecekan2['last'], 0, 4);
								?>
								   <tbody class="table-striped">
									 <tr>
										<td><?php echo $no ?>.</td>
										<td><?php echo '<strong>No Pengecekan : </strong>'. $row['no_pengecekan_mingguan'] .'<br />
														<strong>Bulan Pengecekan : </strong>'.$bulan.', <strong>Pengecekan Minggu Ke : </strong>'.$row['minggu_pengecekan'] .'<br />
														<strong>Periode Pengecekan : </strong>'.$tgl_pengecekan_awal.', <strong> s/d </strong>'.$tgl_pengecekan_akhir.'<br />
														<strong>HRD Approve : </strong>'.$row['sign_atasan2'].'<br />
														<strong>Service Manager Approve : </strong>'.$row['sign_atasan2'].'<br />
														<strong>Direktur Approve : </strong>'.$row['sign_atasan1']
														;?>
														
											<br><br><br>
											<?php 
												if($_SESSION['leveluser']=='CCO' or $_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='HRD'){
													echo $ubah_data; 
												}else{
													echo "";
												}
											
												
												if($_SESSION['leveluser']=='mngr_bengkel'){
													if($row['sign_atasan1'] == 'Y'){
														echo $sudah_diproses; 
													}else{
														if($row['sign_atasan2'] != 'Y'){
															echo $belum_diproses; 
														}else if($row['sign_atasan2'] == 'Y'){
															echo $menunggu_persetujuan; 
														}else{
															
														}
													}
												}elseif($_SESSION['leveluser']=='DRKSI'){
													if($row['sign_atasan1'] == 'Y'){
														echo $sudah_diproses;
													}else{
														if($row['sign_atasan2'] != 'Y'){
															echo $belum_diproses; 
														}else{
															echo $menunggu_persetujuan; 
														}
													}
												}elseif($_SESSION['leveluser']=='admin'){
													if($row['sign_atasan1'] == 'Y'){
														echo $sudah_diproses; 
													}else{
														echo $belum_diproses; 
													}
												}else{
													
												}
												
												
											?>
										</td>
									</tr>
								   </tbody>
									
									<?php
									}
									?>
								</table>
								
								<?php
									$bulan_pengecekan_tgl_awal  = substr($tgl_awal, 5, 2);
									$tombol_ekspor = mysql_query("select * from pengecekan_service where substr(tanggal, 6, 2) = '$bulan_pengecekan_tgl_awal'");
								//	while($data_tombol_ekspor = mysql_fetch_array($tombol_ekspor)){
									$cek_tombol_ekspor = mysql_num_rows($tombol_ekspor);
									if($cek_tombol_ekspor > 0){
								?>
								<div class = "row">
									<div class = "col-md-12">
										<?php
											if($_SESSION['leveluser']=='CCO' or $_SESSION['leveluser']=='admin'){
											//	echo $tombol3;
												echo $tombol4; 
											}else{
											//	echo "";
												echo "";
											}
										?>
									</div>
								</div>
								
								<?php
									}
								?>
						
                     </div>
                </div>
            
            </div>
        </div>


<?php
}
else{
	unset($_GET['cari']);

?>
                        </div>
                     </div>
                </div>
            </div>
        </div>
<?php
}
 
	break;
	case "buat":
	
	if(count($_POST)) {
	
		$qry=mysql_query("select * from master_pengecekan_service");
		$n = 0;
		while($sql=mysql_fetch_array($qry)){
			$n=$n+1;	
			
			$no_pengecekan = $_POST['no_pengecekan'];
			$nama_pic = $_POST['nama_pic'];
			$minggu = $_POST['minggu'];
			$bulan = $_POST['bulan'];
			$tanggal_pengecekan = $_POST['tanggal_pengecekan'];
		//	$hari = $_POST['hari'];
			$kategori_penilaian = $_POST['kategori_penilaian'.$n];
			$nama_penilaian = $_POST['nama_penilaian'.$n];
			$jam = $_POST['jam'];
			$penilaian = $_POST['penilaian'.$n];
			$keterangan = $_POST['keterangan'.$n];
		
			$today=date("ymd");
			$week=date("W");
			$query = "SELECT max(no_pengecekan) as last FROM pengecekan_service_detail WHERE no_pengecekan LIKE 'PS$today'";
			$hasil = mysql_query($query);
			$data  = mysql_fetch_array($hasil);
			$lastNoTransaksi = $data['last'];
			$lastNoUrut = substr($lastNoTransaksi, 6, 3);
			$nextNoUrut = $lastNoUrut + 1;
		//	$nextNoTransaksi = "PS".$today;
			$nextNoTransaksiMingguan = "PS".$week;
		
			$cek=mysql_query("select * from pengecekan_service_detail where no_pengecekan = '$no_pengecekan' and jam = '$jam'");
			$jml_rec = mysql_num_rows($cek);
			if ($jml_rec < 11){
				mysql_unbuffered_query("insert into pengecekan_service_detail (no_pengecekan_mingguan, no_pengecekan, jam, tanggal, hasil, kategori_penilaian, nama_penilaian, catatan_pengecekan, keterangan_catatan_pengecekan) 
				values('$nextNoTransaksiMingguan', '$no_pengecekan','$jam', '$tanggal_pengecekan', '$penilaian','$kategori_penilaian','$nama_penilaian','$keterangan','')");
				
				mysql_query("insert into notif_pengecekan_service (no_pengecekan, tanggal, jam, kategori_penilaian, read_admin, notif_admin, read_hrd, notif_hrd, read_cco, notif_cco, catatan_pengecekan, hasil, tipe_pengecekan) 
				values('$no_pengecekan', '$tanggal_pengecekan', '$jam', '$kategori_penilaian', 'N', 'Y', 'N', 'Y', 'Y', 'N', '$keterangan', '$penilaian', 'Pengecekan Service')");
				
				
				mysql_query("delete from notif_pengecekan_service where hasil = 'Y' and catatan_pengecekan = ''");

				$msg = "
				<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-check'></i> Selamat!</h4>
				Berhasil Menambah Data.</div>";
					
			}else {
				$msg = "							
				<div class='alert alert-warning alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-warning'></i> Gagal!</h4>
				Data Sudah Ada.</div>";
			}
		
		}
		$cek=mysql_query("select * from pengecekan_service where no_pengecekan_mingguan = '$nextNoTransaksiMingguan'");
		$jml_rec = mysql_num_rows($cek);
		if ($jml_rec < 1){
			mysql_unbuffered_query("insert into pengecekan_service (no_pengecekan_mingguan, no_pengecekan, divisi_pic, nama_pic, tanggal, bulan, minggu_pengecekan, sign_atasan1, sign_atasan2, sign_atasan1_date, sign_atasan2_date, sign_atasan1_user, sign_atasan2_user) values
			('$nextNoTransaksiMingguan', '$no_pengecekan','Greeter','$nama_pic','$tanggal_pengecekan','$bulan','$minggu','', '', '', '', '', '')");
		}else{
			
		}
		
		$keterangan_lain = $_POST['keterangan_lain'];
		if($keterangan_lain != ''){
			mysql_query("insert into pengecekan_service_detail_lain (no_pengecekan_mingguan, no_pengecekan, jam, tanggal, hasil, catatan_pengecekan) 
			values('$nextNoTransaksiMingguan', '$no_pengecekan', '$jam', '$tanggal_pengecekan', 'N' ,'$keterangan_lain')");	
		}
	}
?>
				<script>
				
					function bulan(){
						$get_month = $('#bulan').val();
						if(get_month == '01'){
							var get_month2 = "Januari";
						}else if(get_month == '02'){
							var get_month2 = "Februari";
						}else if(get_month == '03'){
							var get_month2 = "Maret";
						}else if(get_month == '04'){
							var get_month2 = "April";
						}else if(get_month == '05'){
							var get_month2 = "Mei";
						}else if(get_month == '06'){
							var get_month2 = "Juni";
						}else if(get_month == '07'){
							var get_month2 = "Juli";
						}else if(get_month == '08'){
							var get_month2 = "Agustus";
						}else if(get_month == '09'){
							var get_month2 = "September";
						}else if(get_month == '10'){
							var get_month2 = "Oktober";
						}else if(get_month == '11'){
							var get_month2 = "November";
						}else if(get_month == '12'){
							var get_month2 = "Desember";
						}else{
							var get_month2 = "";
						}
						
						$('#bulan').val(get_month2);
					}
					
					
				</script>
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Checklist Pengecekan Service</h1>
									<span class="mainDescription">Masukkan Data Checklist Pengecekan Service</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Service</span>
									</li>
									<li class="active">
										<span>Checklist Pengecekan Service</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
								    
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="">
										
										<div class="row">
										    <div class="col-md-12">
										    <?php echo(isset ($msg) ? $msg : ''); ?>
										    </div>
											
											<?php
												$today=date("ymd");
                                                $query = "SELECT max(no_pengecekan) as last FROM pengecekan_service_detail WHERE no_pengecekan LIKE 'PS$today'";
                                                $hasil = mysql_query($query);
                                                $data  = mysql_fetch_array($hasil);
                                                $lastNoTransaksi = $data['last'];
                                            //    $lastNoUrut = substr($lastNoTransaksi, 6, 3);
                                            //    $nextNoUrut = $lastNoUrut + 1;
                                                $nextNoTransaksi = "PS".$today;
                                                ?>
											<div class="col-md-3">
												<label class="control-label">
													No Pengecekan <span class="symbol required"></span>
												</label>
												<input type="text" placeholder="No Permohonan" class="form-control" value="<?php echo $nextNoTransaksi; ?>" id="no_pengecekan" name="no_pengecekan" required readonly>
												</input>
											</div>
											<div class="row" hidden>
												<div class="col-md-12">
													<div class="form-group">
														<label class="control-label">
															Jenis Pengecekan
														</label>
														<input id="jenis_pengecekan" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="jenis_pengecekan" readonly>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<label class="control-label">
													Nama PIC <span class="symbol required"></span>
												 </label>
												<div class="form-group">
													<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" value = "<?php echo $_SESSION['username'] ?>" class="form-control" id="nama_pic" name="nama_pic" required readonly>
												</div>
											</div>
											<div class="col-md-3">
												<label class="control-label">
													Tanggal Pengecekan <span class="symbol required"></span>
												</label>
												<!--div style="padding :0px;" class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'-->
												<div style="padding :0px;" data-date-format='yyyy-mm-dd'>
													<input class="form-control" type="text" value = "<?php echo date('Y-m-d') ?>" id="tanggal_pengecekan" name="tanggal_pengecekan" onchange = "days();" readonly>
												</div>
												<!--div class="form-group">
													<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
														<input type="text" value = "<?php echo date('Y-m-d') ?>" class="form-control" id="tanggal_pengecekan" name="tanggal_pengecekan" required onchange = "days();" readonly>
													</div>				 	
												</div-->				 
												
											</div>
											<div class="col-md-3">
												<label class="control-label">
													  Waktu Pengecekan<span class="symbol required"></span>
												</label>
												<input class="form-control" type="text" value = "<?php echo date('D') ?>" id="pilih_hari" name="pilih_hari" readonly style="display:none;">
												<div class="form-group">
													<select id="jam" name="jam" class="form-control">
														<option value="" disabled>Pilih Waktu:</option>
														<?php
															if($_GET['pilih_hari'] != 'Sun'){
														?>
														<option value="08:30" <?php if($_GET[jam]=='08:30'){echo "selected"; } ?>>08:30</option>
														<option value="13:30" <?php if($_GET[jam]=='13:30'){echo "selected";  }?>>13:30</option>	
														<?php
															}else{
														?>
														<option value="09:30" <?php if($_GET[jam]=='09:30'){echo "selected"; } ?>>09:30</option>
														<option value="13:30" <?php if($_GET[jam]=='13:30'){echo "selected";  }?>>13:30</option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
										</div>
										<div class = "row">
											<div class="col-md-3">
												<label class="control-label">
													Bulan <span class="symbol required"></span>
												 </label>
												<div class="form-group">
													<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" value = "<?php echo date('m') ?>" class="form-control" id="bulan" name="bulan" onload = "bulan();" required readonly>
												
												</div>
											</div>
											<div class="col-md-3">
												<label class="control-label">
													Hari <span class="symbol required"></span>
												</label>
												<div class="form-group">
													<input class="form-control" type="text" value = "<?php echo date('D') ?>" id="hari" name="hari" readonly>
												</div>
											</div>
											<div class="col-md-3">
												<label class="control-label">
													Minggu <span class="symbol required"></span>
												 </label>
												<div class="form-group">
													<input type="number" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="minggu" name="minggu" required>
												</div>
											</div>
											
									    </div>
										</div>
										
										
										
										<?php
										
										    $data=mysql_query("select * from master_pengecekan_service group by kategori_penilaian order by no_kategori_penilaian asc ");
										    $sql = $data;
										    $no1 = 0;
											$no2 = 0;
										    while($data = mysql_fetch_assoc($sql)){
										    
										    $kategori_penilaian = strtoupper($data['kategori_penilaian']);
											$kategori2=$data[kategori_kontrol];
                                            ?>
											
											<div class="col-md-12">
											
											<fieldset>
											
											<legend><?php echo $kategori_penilaian; ?></legend>

											<?php
											$kueri=mysql_query("select * from master_pengecekan_service where kategori_penilaian = '$kategori_penilaian' order by no_nama_penilaian asc");
											while($data = mysql_fetch_assoc($kueri)){
												$no1 = $no1+1;
												$no2 = $no2+1;
											?>
											
											<div class = "row">
												<div class = "col-md-3">
													<div class="form-group">
														<input type="hidden" style="text-transform:uppercase" placeholder="0" class="form-control" id="kategori_penilaian" name="<?php echo 'kategori_penilaian'.$no1; ?>" value="<?php echo $data['kategori_penilaian']; ?>" readonly required>
														<input type="hidden" style="text-transform:uppercase" placeholder="0" class="form-control" id="nama_penilaian" name="<?php echo 'nama_penilaian'.$no1; ?>" value="<?php echo $data['nama_penilaian']; ?>" readonly required>
														<b><?php echo $data['no_nama_penilaian'].". ".strtoupper($data['nama_penilaian']); ?></b>
													</div>
												</div>
												<div class = "col-md-9">
													<div class = "row">
														<div class = "col-md-3">
															<div class="radio clip-radio radio-primary radio-inline">
																<input id="radio<?php echo $no1; ?>" name="penilaian<?php echo $no1; ?>" value="Y" type="radio">
																<label for="radio<?php echo $no1; ?>">
																	Ya
																</label>
															</div>
															
															<div class="radio clip-radio radio-primary radio-inline">
																<input id="radios<?php echo $no2; ?>" name="penilaian<?php echo $no2; ?>" value="N" type="radio">
																<label for="radios<?php echo $no2; ?>">
																	Tidak
																</label>
															</div>
														</div>
														<div class = "col-md-6">
															<div class="form-group">
																<!--input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="Keterangan" class="form-control" id="keterangan" name="<?php echo 'keterangan'.$no1; ?>"-->
																<div class="note-editor">
																	<textarea style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="keterangan" name="<?php echo 'keterangan'.$no1; ?>"></textarea>
																</div>
															</div>
														</div>
													</div>
													<?php
													//	}
													?>
													<br>
													
												</div>
											</div>
											
											

											<?php 
											}
											?>
											
									    	</fieldset>
									    	
									    	</div>
									    	<?php
											}
                                            ?>
									    	
											<?php
											//	if($_SESSION['username'] == 'farros'){
											?>
											<br><br>
											<div class="col-md-12">
												<fieldset>
													<legend>PENGECEKAN JENIS LAIN</legend>
													<div class="row">
														<div class="form-group">
															<div class="panel-body">
																<div class="col-md-12">
																	<div class="form-group">
																		<label class="control-label">
																			<b>CATATAN PENGECEKAN</b>
																		</label>
																		<div class="note-editor">
																			<textarea style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="keterangan_lain" name="keterangan_lain"></textarea>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													
												</fieldset>
											</div>
											
											<?php
											//	}
											?>
											
											
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Harus diisi
													<hr>
												</div>
											</div>
																					
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="submit" id="gar-contact-button">
													<i class="fa fa-save"></i> Simpan
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=service_checklist_service';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
											</div>
											
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
		
		
		
		
		
		

<?php
	break;
	case "lihat":
	
	$no_form = $_GET[id];
	$query = "SELECT * FROM pengecekan_service where no_pengecekan_mingguan = '$no_form'";
                $hasil = mysql_query($query);
                $data  = mysql_fetch_array($hasil);

	include "../../config/koneksi_service.php";
	date_default_timezone_set('Asia/Jakarta');

?>
			
			<script>
				
				function edit_catatan($id){
					var no_id = $id;
					console.log("test");
					$.ajax({
						method : "post",
						url : "modul/checklist_service/data_edit.php",
						data : "data_ajax="+no_id,
						success : function(data){
							console.log("ok");
							var parse = JSON.parse(data);
							$('#Modal_catatan').modal('show');
							console.log(data);
							$('#id').val(parse['id']);
							$('#no_pengecekan').val(parse['no_pengecekan']);
							$('#no_pengecekan_mingguan').val(parse['no_pengecekan_mingguan']);
							$('#nama_penilaian').val(parse['nama_penilaian']);
							$('#kategori_penilaian').val(parse['kategori_penilaian']);
							$('#jam_edit').val(parse['jam']);
							$('#keterangan').val(parse['catatan_pengecekan']);
							$('#catatan_keterangan').val(parse['keterangan_catatan_pengecekan']);
							$('#hasil').val(parse['hasil_penilaian']);
							$('#jenis').val(parse['jenis']);
							if (parse['hasil_penilaian']  == "Y"){
								var hasil = "<center class = 'info'><i class='fa fa-check fa-4x text-success' style = 'cursor:pointer;' ></i><br><center>";	
							}else{
								var hasil = "<center><i class='fa fa-close fa-4x text-danger' style = 'cursor:pointer;'></i><br><center>";
							}
							$('#symbol').html(hasil);
							$('#myModal2Label').html("Tambahkan Catatan Keterangan");
						}
					})
				}
				
				
				function edit_catatan_lain($id){
					var no_id = $id;
					$.ajax({
						method : "post",
						url : "modul/checklist_service/data_edit_pengecekan_lain.php",
						data : "data_ajax="+no_id,
						success : function(data){
							
							var parse = JSON.parse(data);
							$('#Modal_catatan').modal('show');
							$('#id').val(parse['id']);
							$('#no_pengecekan').val(parse['no_pengecekan']);
							$('#keterangan').val(parse['catatan_pengecekan']);
							$('#catatan_keterangan').val(parse['keterangan_catatan_pengecekan']);
							$('#hasil').val(parse['hasil_penilaian']);
							$('#jenis').val(parse['jenis']);
							$('#symbol').html("");
							$('#myModal2Label').html("Tambahkan Catatan Keterangan");
						}
					})
				}
				
				function ubah_hasil(){
					var x = $("#hasil").val();
					if ($("#hasil").val() == "Y") {
						var hasil = "<center><i class='fa fa-close fa-4x text-danger' style = 'cursor:pointer;'></i><br><center>";
						console.log("N");
						$('#hasil').val("N");	
					} else {
						console.log("Y");
						
						var hasil = "<center class = 'info'><i class='fa fa-check fa-4x text-success' style = 'cursor:pointer;'></i><br><center>";
						$('#hasil').val("Y");	
					}
					$('#symbol').html(hasil);
				}
				
				window.onload = function() {
					var no = "<?php echo $_GET['no'] ?>";
					var no_id = parseInt(no);
					var leveluser = "<?php echo $_SESSION['leveluser'] ?>";
					if(no != '' && leveluser != 'CCO'){
						edit_catatan(no_id);
					}
				};
			</script>
			
			<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						
						<!-- start: INVOICE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row" id="print-area-1">
								<div class="col-md-12">
									<div class="invoice">
										<div class="row invoice-logo">
											<div class="col-sm-6">
											<br /><br /><br />
												<img alt="" src="modul/master_data_pameran/honda-logo.jpg">
											</div>
											<div class="col-sm-4 pull-right">
												<h4>Form Detail:</h4>
												<ul class="list-unstyled invoice-details padding-bottom-30 padding-top-10 text-dark">
													<li>
														<strong>No Pengecekan Mingguan:</strong> <?php echo $data['no_pengecekan_mingguan']; ?>
													</li>
													<li>
														<strong>Minggu Pengecekan :</strong> <?php echo $data['minggu_pengecekan']; ?>
													</li>
													<li>
														<strong>Nama PIC :</strong> <?php echo $data['nama_pic']; ?>
													</li>
												</ul>
											</div>
										</div>
										
										
										<div class="modal fade" id="Modal_catatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onpageshow="focus">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header" style="background-color: white;">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='exit_modal();'>
															<span aria-hidden="true">&times;</span>
														</button>
														<h4 class="modal-title" id="myModal2Label"></h4>
													</div>
													<div class="modal-body" style="background-color: white;">
														<form role="form" id="form" enctype="multipart/form-data" method="post" action="modul/checklist_service/update_data_pengecekan.php" >
														<div class="row">
															<div class="col-md-12">
																<div class="row" hidden>
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">
																				No Id
																			</label>
																			<input id="id" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="id" readonly>
																		</div>
																	</div>
																</div>
																<div class="row" hidden>
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">
																				No Pengecekan Mingguan
																			</label>
																			<input id="no_pengecekan_mingguan" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="no_pengecekan_mingguan" readonly>
																		</div>
																	</div>
																</div>
																
																<div class="row" hidden>
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">
																				No Pengecekan
																			</label>
																			<input id="no_pengecekan" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="no_pengecekan" readonly>
																		</div>
																	</div>
																</div>
																<div class="row" hidden>
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">
																				User
																			</label>
																			<input id="leveluser" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="<?php echo $_SESSION['leveluser'] ?>" name="leveluser" readonly>
																		</div>
																	</div>
																</div>
																<div class="row" hidden>
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">
																				Kategori Penilaian
																			</label>
																			<input id="kategori_penilaian" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="kategori_penilaian" readonly>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">
																				Nama Penilaian
																			</label>
																			<input id="nama_penilaian" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="nama_penilaian" readonly>
																		</div>
																	</div>
																</div>
																
																<div class="row">
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">
																				Jam
																			</label>
																			<input id="jam_edit" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="jam_edit" readonly>
																		</div>
																	</div>
																</div>
																<div class="row" hidden>
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">
																				Jenis Pengecekan
																			</label>
																			<input id="jenis" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="jenis" readonly>
																		</div>
																	</div>
																</div>
																<div class = "row">
																	<div class="col-md-12">
																		<div id = "symbol" onclick = "ubah_hasil();" style = 'cursor:pointer;' >
																		</div>
																		<div hidden>
																			<input id="hasil" class="form-control" type="text" value="" name="hasil" hidden>
																		</div>
																		
																	</div>
																</div>
																<?php
																	if($_SESSION['leveluser'] == 'CCO' or $_SESSION['leveluser'] == 'admin'){
																		$readonly = "";
																	}else{
																		$readonly = "readonly";
																	}
																?>
																<div class="form-group">
																	<label class="control-label">
																		Catatan Pengecekan PIC <span class="symbol required"></span>
																	</label>
																	<div class="form-group">
																		<div class="note-editor">
																			<textarea class="form-control" id="keterangan" name="keterangan" <?php echo $readonly ?>></textarea>
																		</div>
																	</div>
																</div>
																
																<?php
																	if($_SESSION['leveluser'] == 'HRD' or $_SESSION['leveluser'] == 'admin'){
																		$readonly = "";
																	}else{
																		$readonly = "readonly";
																	}
																?>
																<div class="form-group" >
																	<label class="control-label">
																		Keterangan Pengecekan dari Atasan <span class="symbol required"></span>
																	</label>
																	<div class="form-group">
																		<div class="note-editor">
																			<textarea class="form-control" id="catatan_keterangan" name="catatan_keterangan" <?php echo $readonly ?>></textarea>
																		</div>
																	</div>
																</div>
																
															</div>
														</div>
														</br>
														<div class="row">											
															<div class="col-md-12">
																<button class="btn btn-primary btn-wide" type="submit" id="bn" name="bn">
																	<span class="ladda-label"><i class="fa fa-save"></i> Simpan</span>
																</button>
																<button type="button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" data-dismiss="modal" aria-label="Close" onclick='exit_modal();'>
																	<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
																</button>
																<br>
																<br>
															</div>
														</div>
													</form>
													</div>
												</div>
											</div>
										</div>
										
										
										<hr>
										<div class="row">
											<div class="col-sm-12">
												<div class="panel panel-white no-radius">
													<div class="panel-body no-padding">
														<div class="tabbable no-margin no-padding">
															<ul class="nav nav-tabs" id="myTab">
															<?php
																$tgl_pengecekan = mysql_query("select * from pengecekan_service_detail where no_pengecekan_mingguan = '$data[no_pengecekan_mingguan]' group by tanggal");
																$no = 0;
																while($data_tgl_pengecekan = mysql_fetch_array($tgl_pengecekan)){
																	$no = $no+1;
															?>
																<li class="<?php ($no == "1" ? $act = "active ": $act = ""); echo $act; ?> padding-top-5">
																	<a data-toggle="tab" href="#<?php echo $data_tgl_pengecekan['tanggal'] ?>">
																		<?php echo $data_tgl_pengecekan['tanggal'] ?>
																	</a>
																</li>
															<?php
																}
															?>
															</ul>
														</div>
														<div class="tab-content">
														
														<?php
															$tgl_pengecekan = mysql_query("select * from pengecekan_service_detail where no_pengecekan_mingguan = '$data[no_pengecekan_mingguan]' group by tanggal");
															$no = 0;
															while($data_tgl_pengecekan = mysql_fetch_array($tgl_pengecekan)){
																$no = $no+1;
														?>
															<div id="<?php echo $data_tgl_pengecekan['tanggal'] ?>" class="<?php ($no == "1" ? $act = "active ": $act = ""); echo $act; ?> tab-pane padding-bottom-5">
																<div class="panel-scroll height-360">
																<?php
																
																	$data_master_pengecekan = mysql_query("select * from master_pengecekan_service group by kategori_penilaian order by no_kategori_penilaian  ");
																	$sql = $data_master_pengecekan;
																	$nomor = 0;
																	$nomor2 = 0;
																	echo "<div id = 'header_table' class='table-responsive'><table class='table table-striped'>";
																	while($data = mysql_fetch_array($sql)){
																	
																	$kategori=$data['kategori_penilaian'];
																	$nama_penilaian = $data['nama_penilaian'];
																	$kategori2 = $data['nama_penilaian'];
																	
																?>
																		
																				
																					<thead>
																						<tr style="font-weight: bold; background-color:darkgray; ">
																							<th align = "center" style="width:30%; "><h4 class="panel-title text-primary"><?php echo ucwords(strtoupper($kategori)); ?></h4> </th>
																							<th align = "center" style="width:5%; "> <font color="white"> PUKUL</font></th>
																							<th align = "center" style="width:5%;"><font color="white"> STATUS</font></th>
																							<th class="hidden-480" style="width:25%;"><font color="white"> KETERANGAN </font></th>
																							<th class="hidden-480" style="width:25%;"><font color="white"> KETERANGAN CATATAN PENGECEKAN </font></th>
																							<th class="hidden-480" style="width:15%;"><font color="white"> ACTION </font></th>
																						</tr>
																					</thead>
																					<tbody>
																				
																					<?php
																						$kategori_penilaian = mysql_query("select * from master_pengecekan_service where kategori_penilaian = '$data[kategori_penilaian]' order by no_nama_penilaian");
																						while($data_kategori_penilaian = mysql_fetch_array($kategori_penilaian)){
																							$nomor += 1;  
																							$nomor2 += 1;
																							
																							$detail_penilaian = mysql_query("select * from pengecekan_service_detail where tanggal = '$data_tgl_pengecekan[tanggal]' and jam = '08:30' and nama_penilaian = '$data_kategori_penilaian[nama_penilaian]' order by jam");
																							while($data_detail_penilaian = mysql_fetch_array($detail_penilaian)){
																					?>
																						<tr>
																							<td> <?php echo $data_kategori_penilaian['nama_penilaian']; ?> </td>
																							<td> <?php echo $data_detail_penilaian['jam']; ?> </td>
																							<td align = "center"> 
																								<?php 
																									if ($data_detail_penilaian['hasil'] == "Y"){
																										echo "<i class='fa fa-check text-success'></i>";
																									}else{
																										echo "<i class='fa fa-close text-danger'></i>";
																									}
																									
																								?> 
																							</td>
																							<td> <?php echo $data_detail_penilaian['catatan_pengecekan']; ?> </td>
																							<td> <?php echo $data_detail_penilaian['keterangan_catatan_pengecekan']; ?> </td>
																							<td>
																								<button type='button' id='edit<?php echo $data_detail_penilaian['no'] ?>' name='edit' class='dlt btn btn-xs btn-warning' onclick='<?php echo "edit_catatan(".$data_detail_penilaian['no'].")" ?>' data-original-title='Update Data Booking <?php echo $data_detail_penilaian[no] ?>' value='<?php echo $data_detail_penilaian['no'] ?>' >
																									<span class='ladda-label'><i class='fa fa-pencil'></i>Edit</span>
																								</button>
																							
																							</td>
																							
																						</tr>
																				
																					<?php 
																							}
																						}
																					?>
																					
																					<?php
																						$kategori_penilaian = mysql_query("select * from master_pengecekan_service where kategori_penilaian = '$data[kategori_penilaian]' order by no_nama_penilaian");
																						while($data_kategori_penilaian = mysql_fetch_array($kategori_penilaian)){
																							$nomor += 1;  
																							$nomor2 += 1;
																							
																							$detail_penilaian = mysql_query("select * from pengecekan_service_detail where tanggal = '$data_tgl_pengecekan[tanggal]' and jam = '13:30' and nama_penilaian = '$data_kategori_penilaian[nama_penilaian]' order by jam");
																							while($data_detail_penilaian = mysql_fetch_array($detail_penilaian)){
																					?>
																						<tr>
																							<td> <?php echo $data_kategori_penilaian['nama_penilaian']; ?> </td>
																							<td> <?php echo $data_detail_penilaian['jam']; ?> </td>
																							<td align = "center"> 
																								<?php 
																									if ($data_detail_penilaian['hasil'] == "Y"){
																										echo "<i class='fa fa-check text-success'></i>";
																									}else{
																										echo "<i class='fa fa-close text-danger'></i>";
																									}
																									
																								?> 
																							</td>
																							<td> <?php echo $data_detail_penilaian['catatan_pengecekan']; ?> </td>
																							<td> <?php echo $data_detail_penilaian['keterangan_catatan_pengecekan']; ?> </td>
																							<td>
																							<?php
																							//	if($_SESSION['leveluser']=='mngr_bengkel' or $_SESSION['leveluser']=='admin') { 
																							//		if($data_detail_penilaian['catatan_pengecekan'] != '' and $data_detail_penilaian['keterangan_catatan_pengecekan'] == '' and $data_detail_penilaian['hasil'] != "Y"){
																							?>
																								<button type='button' id='edit<?php echo $data_detail_penilaian['no'] ?>' name='edit' class='dlt btn btn-xs btn-warning' onclick='<?php echo "edit_catatan(".$data_detail_penilaian['no'].")" ?>' data-original-title='Update Data Booking <?php echo $data_detail_penilaian[no] ?>' value='<?php echo $data_detail_penilaian['no'] ?>' >
																									<span class='ladda-label'><i class='fa fa-pencil'></i>Edit</span>
																								</button>
																							<?php
																							//		}
																							//	}
																							?>
																							</td>
																							
																						</tr>
																				
																					<?php 
																							}
																						}
																					?>
																				
																					</tbody>
																				
																<?php 
																	}
																?>
																</table>
																</div>
																</div>
															
																<?php
																//	if($_SESSION['username']=='farros'){
																
																	$pengecekan_lain = mysql_query("select * from pengecekan_service_detail_lain where tanggal = '$data_tgl_pengecekan[tanggal]'");
																	$pengecekan_lain_rows = mysql_num_rows($pengecekan_lain);
																	if($pengecekan_lain_rows > 0){
																?>
																<br><br>
																	<div id = 'header_table' class='table-responsive'>
																		<table class='table table-striped'>
																			<tr style="font-weight: bold; background-color:darkgray; ">
																				<th align = "center" style="width:30%; "> <h4 style="color: white;"><?php echo (strtoupper('PENGECEKAN JENIS LAIN')); ?></h4></th>
																				<th class="hidden-480" style="width:25%;"><font color="white"> KETERANGAN </font></th>
																				<th class="hidden-480" style="width:25%;"><font color="white"> KETERANGAN CATATAN PENGECEKAN </font></th>
																				<th class="hidden-480" style="width:15%;"><font color="white"> ACTION </font></th>
																			</tr>
																			<tbody>
																			<?php
																				while($data_pengecekan_lain = mysql_fetch_array($pengecekan_lain)){
																			?>
																				<tr>
																					<td></td>
																					<td><?php echo $data_pengecekan_lain['catatan_pengecekan'] ?></td>
																					<td><?php echo $data_pengecekan_lain['keterangan_catatan_pengecekan'] ?></td>
																					<td>
																						<button type='button' id='edit_lain<?php echo $data_detail_penilaian['no'] ?>' name='edit_lain' class='dlt btn btn-xs btn-warning' onclick='<?php echo "edit_catatan_lain(".$data_pengecekan_lain['no'].")" ?>' data-original-title='Update Data Pengecekan <?php echo $data_pengecekan_lain[no] ?>' value='<?php echo $data_pengecekan_lain['no'] ?>' >
																							<span class='ladda-label'><i class='fa fa-pencil'></i> Edit</span>
																						</button>
																					</td>
																				</tr>
																			<?php
																				}
																			?>
																			</tbody>
																		</table>
																	</div>
																<?php
																	}
																//	}
																?>
																
															</div>
															
															
															<?php
																}
															?>
														</div>
														
													</div>
												</div>
											
											</div>
										</div>
										<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=<?php if(count($_POST)) { echo "history.go(-2)"; } else {echo "history.go(-1)";}?>>
											<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
										</button>
										
									</div>
								</div>
							</div>
						</div>
						<!-- end: INVOICE -->
					</div>
				</div>
			
<?php
	break;
	case "approve":
	
	include "approve_checklist.php";
?>

<?php				
	
	break;
		}	
		}
?>

				