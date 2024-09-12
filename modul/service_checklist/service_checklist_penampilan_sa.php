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
											
					/*	$msg = "
							<div class='alert alert-success alert-dismissable'>
							
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil menyimpan data, Pilih Tanggal dan klik tombol tampilkan data untuk melihat detail data yang sudah disimpan.</div>";	*/
							
						//echo $msg;
						?>
						<!--div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
									<!--/div>
								</div>
							</div>
						</div-->

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
									<div class="form-group">
										<div class="col-md-4">
											<p class="progress-demo">
												<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=service_checklist_penampilan_sa&act=buat';>
													<span class="ladda-label"><i class="fa fa-plus"></i> Input Data Checklist Penampilan SA<span>
												</button>	
											</p>
										</div>
									</div>
									<br>
									<hr>
									<?php
									}
									?>
									
									<form action="" method="GET" name="postform">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">
													Pilih Periode <span class="symbol required"></span>
												</label>
												<input type="hidden" name="module" value="service_checklist_penampilan_sa" />					 
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
										       
									
									<?php
										//di proses jika sudah klik tombol cari
										if(isset($_GET['cari'])){
									
										//menangkap nilai form
										$tgl_awal=$_GET['tgl_awal'];
										$tgl_akhir=$_GET['tgl_akhir'];
										if (empty($tgl_awal) and empty($tgl_akhir)){
										}else{
									
									?>
									<div class="col-md-12">
										<div class="form-group">
											<div class="table-header"><i><b>Data Pengecekan SA  </b> Bulan <b><?php echo $_GET['tgl_awal']?></b> </i></div><br />
										</div>
									</div>
									
									<?php
									//	$query=mysql_query("select * from pengecekan_penampilan_sa where substr(tanggal, 1, 7) >= '$tgl_awal' and substr(tanggal, 1, 7) <= '$tgl_akhir' ");
										$query=mysql_query("select * from pengecekan_penampilan_sa where substr(tanggal, 1, 7) = '$tgl_awal' ");
									
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
												$bulan_pengecekan = substr($row[tanggal], 5, 2);
												
												$bln = substr($row[tanggal], 5, 2);
												
												if($bulan_pengecekan == '01'){
													 $bulan_pengecekan = "Januari";
												}elseif($bulan_pengecekan == '02'){
													 $bulan_pengecekan = "Februari";
												}elseif($bulan_pengecekan == '03'){
													 $bulan_pengecekan = "Maret";
												}elseif($bulan_pengecekan == '04'){
													 $bulan_pengecekan = "April";
												}elseif($bulan_pengecekan == '05'){
													 $bulan_pengecekan = "Mei";
												}elseif($bulan_pengecekan == '06'){
													 $bulan_pengecekan = "Juni";
												}elseif($bulan_pengecekan == '07'){
													 $bulan_pengecekan = "Juli";
												}elseif($bulan_pengecekan == '08'){
													 $bulan_pengecekan = "Agustus";
												}elseif($bulan_pengecekan == '09'){
													 $bulan_pengecekan = "September";
												}elseif($bulan_pengecekan == '10'){
													 $bulan_pengecekan = "Oktober";
												}elseif($bulan_pengecekan == '11'){
													 $bulan_pengecekan = "November";
												}elseif($bulan_pengecekan == '12'){
													 $bulan_pengecekan = "Desember";
												}else{
													 $bulan_pengecekan = "";
												}
											$tombol=$tombollogin;
												 $ubah_data="
													 <a class='btn btn-xs btn-info' href='media_showroom.php?module=service_checklist_penampilan_sa&act=lihat&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Lihat Laporan Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-eye'></i> UBAH DATA</a>
													 "; 
												$beri_persetujuan="
													 <a class='btn btn-xs btn-warning' href='media_showroom.php?module=service_checklist_penampilan_sa&act=approve&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Approve Laporan Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-check'></i> BERI PERSETUJUAN</a>
													 "; 
													 
												$menunggu_persetujuan="
													 <a class='btn btn-xs btn-warning' href='media_showroom.php?module=service_checklist_penampilan_sa&act=approve&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Approve Laporan Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-check'></i> BERI PERSETUJUAN</a>
													 "; 
												$sudah_diproses="
													 <a class='btn btn-xs btn-success' href='media_showroom.php?module=service_checklist_penampilan_sa&act=approve&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Approve Laporan Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-check'></i> SUDAH DIPROSES</a>
													 "; 
												$belum_diproses="
													 <a class='btn btn-xs btn-danger' href='media_showroom.php?module=service_checklist_penampilan_sa&act=approve&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Approve Laporan Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-close'></i> BELUM DIPROSES</a>
													 ";
												$tombol3="
													 <a class='btn btn-xs btn-warning' href='modul/service_checklist/laporan_penampilan_sa.php?no_pengecekan_mingguan=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Cetak Laporan Pengecekan $row[no_pengecekan_mingguan]' ><i class='fa fa-print'></i> CETAK</a>
													"; 
												$tombol4="
													<a class='btn btn-xs btn-warning' href='modul/service_checklist/export_pengecekan_penampilan_sa.php?bulan=$bln' data-toggle='tooltip' data-original-title='Ekspor Pengecekan $row[no_pengecekan_mingguan]' ><i class='fa fa-print'></i> Ekspor ke Excel</a>
													"; 
													
											$no++;
											
											$periode_pengecekan = mysql_query("select min(tanggal) as first from pengecekan_penampilan_sa_detail where no_pengecekan_mingguan = '$row[no_pengecekan_mingguan]'");
											$data_periode_pengecekan = mysql_fetch_array($periode_pengecekan);
											$tgl_pengecekan_awal = substr($data_periode_pengecekan['first'], 8, 2).'-'.substr($data_periode_pengecekan['first'], 5, 2).'-'.substr($data_periode_pengecekan['first'], 0, 4);
											
											$periode_pengecekan2 = mysql_query("select max(tanggal) as last from pengecekan_penampilan_sa_detail where no_pengecekan_mingguan = '$row[no_pengecekan_mingguan]'");
											$data_periode_pengecekan2 = mysql_fetch_array($periode_pengecekan2);
											$tgl_pengecekan_akhir = substr($data_periode_pengecekan2['last'], 8, 2).'-'.substr($data_periode_pengecekan2['last'], 5, 2).'-'.substr($data_periode_pengecekan2['last'], 0, 4);
										?>
										<tbody class="table-striped">
											<tr>
												<td><?php echo $no ?>.</td>
												<td><?php echo '<strong>No Pengecekan : </strong>'. $row['no_pengecekan_mingguan'] .'<br />
																<strong>Bulan Pengecekan : </strong>'. $bulan_pengecekan .'<br />
																<strong>Periode Pengecekan : </strong>'.$tgl_pengecekan_awal.', <strong> s/d </strong>'.$tgl_pengecekan_akhir.'<br />
																<strong>Manager Bengkel Approve : </strong>'.$row['sign_atasan2'].'<br />
																<strong>Direktur Approve : </strong>'.$row['sign_atasan1']
																;?>
																
													<br><br><br>
													<?php 
														if($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='CCO' or $_SESSION['leveluser']=='HRD'){
															echo $ubah_data; 
														}else{
															echo "";
														}
													?>
													<?php 
													
														if($_SESSION['leveluser']=='HRD'){
															if($row['sign_atasan1'] == 'Y'){
																echo $sudah_diproses;
															}else{
																if($row['sign_atasan3'] == ''){
																	echo $beri_persetujuan; 
																}else{
																	echo $menunggu_persetujuan; 
																}
															}
														}elseif($_SESSION['leveluser']=='mngr_bengkel'){
															if($row['sign_atasan1'] == 'Y'){
																echo $sudah_diproses; 
															}else{
																if($row['sign_atasan3'] == 'Y' and $row['sign_atasan2'] == '' ){
																	echo $beri_persetujuan; 
																}else if($row['sign_atasan3'] != 'Y'){
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
																if($row['sign_atasan3'] == 'Y'){
																	echo $beri_persetujuan; 
																}else if($row['sign_atasan3'] != 'Y'){
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
										}
										?>
									</table>
									
									
									<?php
										$tombol_ekspor = mysql_query("select * from pengecekan_penampilan_sa_detail where substr(tanggal, 1, 7) = '$tgl_awal'");
									//	while($data_tombol_ekspor = mysql_fetch_array($tombol_ekspor)){
										$cek_tombol_ekspor = mysql_num_rows($tombol_ekspor);
										if($cek_tombol_ekspor > 0){
									?>
									<div class = "row">
										<div class = "col-md-12">
											<?php 
												if($_SESSION['leveluser']=='CCO' or $_SESSION['leveluser']=='admin'){
													echo $tombol3; 
													echo $tombol4; 
												}else{
													echo "";
													echo "";
												}
											?>
										</div>
									</div>
									<?php
										}
									?>
								</form>
                           </div>
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
		$bulan = date('m-Y');
		$qry1=mysql_query("select * from sa_bp");
		while($sql1=mysql_fetch_array($qry1)){
		//	$bp = mysql_query("select * from service_advisor_bp");
		//	while($bp1 = mysql_fetch_array($bp)){
				$qry=mysql_query("select * from master_penilaian_sa");
				$week=date("W");
				
				while($sql=mysql_fetch_array($qry)){
					$n=$n+1;	
					$week=date("W");
					$nextNoTransaksiMingguan = "PS".$week;
					$no_pengecekan = $_POST['no_pengecekan'];
					$nama_pic = $_POST['nama_pic'];
					$jam = $_POST['jam'];
					$tanggal_pengecekan = $_POST['tanggal_pengecekan'];
				
					$kode_sa_bp = $_POST['kode_sa_bp'.$n];
					$jenis_penilaian = $_POST['jenis_penilaian'.$n];
					$penilaian = $_POST['penilaian'.$n];
					$keterangan = $_POST['keterangan'.$n];
					
					$today=date("ymd");
				//	$today = '180330';
					$week=date("W");
					$query = "SELECT max(no_pengecekan) as last FROM pengecekan_penampilan_sa_detail WHERE no_pengecekan LIKE 'PS$today'";
					$hasil = mysql_query($query);
					$data  = mysql_fetch_array($hasil);
					$lastNoTransaksi = $data['last'];
					$lastNoUrut = substr($lastNoTransaksi, 6, 3);
					$nextNoUrut = $lastNoUrut + 1;
					$nextNoTransaksiMingguan = "PS".$week;
				
					$cek=mysql_query("select * from pengecekan_penampilan_sa_detail where no_pengecekan = '$no_pengecekan' and jam = '$jam'");
					$jml_rec = mysql_num_rows($cek);
					if ($jml_rec < 55){
						mysql_unbuffered_query("insert into pengecekan_penampilan_sa_detail (no_pengecekan_mingguan, no_pengecekan, jam, tanggal, hasil_penilaian, kode_sa, jenis_penilaian, catatan_pengecekan, keterangan_catatan_pengecekan) 
						values('$nextNoTransaksiMingguan', '$no_pengecekan','$jam', '$tanggal_pengecekan', '$penilaian','$kode_sa_bp','$jenis_penilaian','$keterangan','')");
						
						mysql_query("insert into notif_penampilan_sa (no_pengecekan, tanggal, jam, kode_sa_bp, read_admin, notif_admin, read_cco, notif_cco, catatan_pengecekan, hasil, tipe_pengecekan) 
						values('$no_pengecekan', '$tanggal_pengecekan', '$jam', '$kode_sa_bp', 'N', 'Y', 'Y', 'N', '$keterangan', '$penilaian', 'Pengecekan Penampilan SA')");	
						
						mysql_query("delete from notif_penampilan_sa where hasil = 'Y'");	
						
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
				$cek=mysql_query("select * from pengecekan_penampilan_sa where no_pengecekan_mingguan = '$nextNoTransaksiMingguan'");
				$jml_rec = mysql_num_rows($cek);
				if ($jml_rec < 1){
					mysql_unbuffered_query("insert into pengecekan_penampilan_sa (no_pengecekan_mingguan, nama_pic, tanggal, sign_atasan1, sign_atasan2) 
					values('$nextNoTransaksiMingguan','$nama_pic','$tanggal_pengecekan','', '')");
					
				}else{
					
				}
							
		//	}
		
		}
	}
?>

<script>
	function ganti_value($id){
		var param = $id;
		if(param == 1){
			var kode_sales = 'HRMN';
		}else if(param == 2){
			var kode_sales = 'BHRI';
		}else if(param == 3){
			var kode_sales = 'IHSN';
		}else if(param == 4){
			var kode_sales = 'YUS';
		}else if(param == 5){
			var kode_sales = 'WHYU';
		}else if(param == 6){
			var kode_sales = 'ARI';
		}else if(param == 7){
			var kode_sales = 'TAUF';
		}else if(param == 8){
			var kode_sales = 'FARIZ';
		}else if(param == 9){
			var kode_sales = 'IKBAL';
		}else if(param == 10){
			var kode_sales = 'TAUFIK';
		}else{
			var kode_sales = 'TONY';
		}
		
		var value = $('.' + kode_sales +'_keterangan').val();
		$('#checklist_' + kode_sales + '').find("." + kode_sales +"_keterangan").val(value);
	//	var value = $('.DIAN_keterangan').val();
		console.log(kode_sales);
	
	}
	
	function tampil_sales($id){
		var sales = $id;
		
		if(sales == 1){
			kode_sales = 'HRMN';
		}else if(sales == 2){
			kode_sales = 'BHRI';
		}else if(sales == 3){
			kode_sales = 'IHSN';
		}else if(sales == 4){
			kode_sales = 'YUS';
		}else if(sales == 5){
			kode_sales = 'WHYU';
		}else if(sales == 6){
			kode_sales = 'ARI';
		}else if(sales == 7){
			kode_sales = 'TAUF';
		}else if(sales == 8){
			kode_sales = 'FARIZ';
		}else if(sales == 9){
			kode_sales = 'IKBAL';
		}else if(sales == 10){
			kode_sales = 'TAUFIK';
		}else{
			kode_sales = 'TONY';
		}
		console.log(kode_sales);
		if($('#'+kode_sales + sales).is(':checked')){
			console.log(kode_sales);
				$('#checklist_'+kode_sales).find("."+kode_sales+"").show();
				$('#atribut_sales'+kode_sales).hide();
			//	$('#checklist_'+kode_sales).find(".sales_diluar").show();
				$('#checklist_'+kode_sales).find(".sales_dishowroom").hide();
				$('#checklist_'+kode_sales).find("."+kode_sales+"_radio3").hide();
				$('#checklist_'+kode_sales).find("."+kode_sales+"_radio2").show();
				$('#checklist_'+kode_sales).find("."+kode_sales+"_radio1").hide();
				$('#checklist_'+kode_sales).find(".input2, .input3, .input4, .input5").hide();
				$('#checklist_'+kode_sales).find("."+kode_sales+"_radio3").attr('disabled', true);
		}else{
			console.log("no");
			$('#atribut_sales'+kode_sales).show();
			$('#checklist_'+kode_sales).find("."+kode_sales+"").show();
			$('#checklist_'+kode_sales).find(".sales_diluar").hide();
			$('#checklist_'+kode_sales).find(".sales_dishowroom").show();
			$('#checklist_'+kode_sales).find("."+kode_sales+"_radio3").show();
			$('#checklist_'+kode_sales).find("."+kode_sales+"_radio2").hide();
			$('#checklist_'+kode_sales).find("."+kode_sales+"_radio1").show();
			
		}
	}
</script>
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Checklist Penampilan Sa</h1>
									<span class="mainDescription">Masukkan Data Checklist Penampilan SA</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li class="active">
										<span>Checklist Penampilan SA</span>
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
											//	$today = '180330';
                                                $query = "SELECT max(no_pengecekan) as last FROM pengecekan_penampilan_sales_detail WHERE no_pengecekan LIKE 'PS$today'";
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
												<input type="text" class="form-control" value="<?php echo $nextNoTransaksi; ?>" id="no_pengecekan" name="no_pengecekan" required readonly>
												</input>
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
												<div class="form-group">
													<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" value = "<?php echo date('Y-m-d') ?>" class="form-control" id="tanggal_pengecekan" name="tanggal_pengecekan" required onchange = "days();" readonly>
												</div>
											</div>
											<div class="col-md-3">
												<label class="control-label">
													  Waktu Pengecekan<span class="symbol required"></span>
												</label>
												<!--input class="form-control" type="text" value = "<?php echo date('D') ?>" id="pilih_hari" name="pilih_hari" readonly style="display:none;"-->
												<div class="form-group">
													<select id="jam" name="jam" >
														<option value="" disabled>Pilih Waktu:</option>
														<option value="08:00" <?php if($_GET[jam]=='08:00'){echo "selected"; } ?>>08:00</option>
														<option value="13:00" <?php if($_GET[jam]=='13:00'){echo "selected";  }?>>13:00</option>	
														
														<?php
														/*	if($_GET['pilih_hari'] != 'Sun'){
														?>
														<option value="08:30" <?php if($_GET[jam]=='08:30'){echo "selected"; } ?>>08:30</option>
														<option value="13:30" <?php if($_GET[jam]=='13:30'){echo "selected";  }?>>13:30</option>	
														<?php
															}else{
														?>
														<option value="09:30" <?php if($_GET[jam]=='09:30'){echo "selected"; } ?>>09:30</option>
														<option value="13:30" <?php if($_GET[jam]=='13:30'){echo "selected";  }?>>13:30</option>
														<?php
															}	*/
														?>
													</select>
												</div>
											</div>
										</div>
										
										<?php
											$bulan = date('m-Y');
										    $sql=mysql_query("select * from sa_bp order by no asc");
										    $no1 = 0;
											$no2 = 0;
											$n1 = 1;
										    while($data_sql = mysql_fetch_assoc($sql)){
										    
										    $kode_sales = strtoupper($data_sql['kode_sa_bp']);
                                        ?>
											
											<div class="col-md-12" id = "checklist_<?php echo $kode_sales; ?>">
											<fieldset>
											<legend><?php echo $kode_sales; ?></legend>
											<div class = "row ">
												<div class = "col-md-3">
													<div class="radio clip-radio radio-primary radio-inline">
														<!--input id="<?php echo $kode_sales.$n1; ?>" name="kelengkapan<?php echo $kode_sales.$n1; ?>" value="Y" type="radio" onchange = "<?php echo 'tampil_'.$kode_sales.'()' ?>"-->
														<input id="<?php echo $kode_sales.$n1; ?>" name="kelengkapan<?php echo $kode_sales.$n1; ?>" value="Y" type="radio" onchange = "<?php echo 'tampil_sales('.$n1.')' ?>">
														<label for="<?php echo $kode_sales.$n1; ?>">
															Lengkap
														</label>
													</div>
													<div class="radio clip-radio radio-primary radio-inline">
														<!--input id="<?php echo $kode_sales."s".$n1; ?>" name="kelengkapan<?php echo $kode_sales.$n1; ?>" value="N" type="radio" onchange = "<?php echo 'tampil_'.$kode_sales.'()' ?>"-->
														<input id="<?php echo $kode_sales."s".$n1; ?>" name="kelengkapan<?php echo $kode_sales.$n1; ?>" value="Y" type="radio" onchange = "<?php echo 'tampil_sales('.$n1.')' ?>">
														<label for="<?php echo $kode_sales."s".$n1; ?>">
															Tidak Lengkap
														</label>
													</div>
												</div>
											</div>
											<br>
											<?php
											$kueri=mysql_query("select * from master_penilaian_sa order by no asc");
											$loop = 0;
											while($data = mysql_fetch_assoc($kueri)){
												$no1 = $no1+1;
												$no2 = $no2+1;
												$loop = $loop+1;
											?>
											
											<!--div class = "row">
												<div class = "col-md-3">
													<div class="form-group">
														<input type="hidden" style="text-transform:uppercase" placeholder="0" class="form-control" id="kode_sa" name="<?php echo 'kode_sa_bp'.$no1; ?>" value="<?php echo $data_sql['kode_sa_bp']; ?>" readonly required>
														<input type="hidden" style="text-transform:uppercase" placeholder="0" class="form-control" id="jenis_penilaian" name="<?php echo 'jenis_penilaian'.$no1; ?>" value="<?php echo $data['jenis_penilaian']; ?>" readonly required>
														
														<b><?php echo strtoupper($data['jenis_penilaian']); ?></b>
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
																<!--div class="note-editor">
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
											</div-->
											
											<div class = "row <?php echo $kode_sales; ?> <?php echo 'input'.$loop ?>" style="display:none;">
												<div class = "col-md-3">
													<div class="form-group">
														<input type="hidden" style="text-transform:uppercase" placeholder="0" class="form-control" id="kode_sa" name="<?php echo 'kode_sa_bp'.$no1; ?>" value="<?php echo $data_sql['kode_sa_bp']; ?>" readonly required>
														<input type="hidden" style="text-transform:uppercase" placeholder="0" class="form-control" id="jenis_penilaian" name="<?php echo 'jenis_penilaian'.$no1; ?>" value="<?php echo $data['jenis_penilaian']; ?>" readonly required>
														
														<b id = 'atribut_sales<?php echo $kode_sales; ?>'><?php echo strtoupper($data['jenis_penilaian']); ?></b>
													</div>
												</div>
												<div class = "col-md-9">
													<div class = "row">
														<div class = "col-md-3">
															<div class="radio clip-radio radio-primary radio-inline <?php echo $kode_sales.'_radio1'; ?>">
																<input id="radio<?php echo $no1; ?>" name="penilaian<?php echo $no1; ?>" value="Y" type="radio">
																<label for="radio<?php echo $no1; ?>">
																	Ya
																</label>
															</div>
															<div class="radio clip-radio radio-primary radio-inline <?php echo $kode_sales.'_radio2'; ?>">
																<input id="radio<?php echo $no1; ?>" name="penilaian<?php echo $no1; ?>" value="Y" type="radio" checked>
																<label for="radio<?php echo $no1; ?>">
																	Ya
																</label>
															</div>
															<div class="radio clip-radio radio-primary radio-inline <?php echo $kode_sales.'_radio3'; ?>">
																<input id="radios<?php echo $no1; ?>" name="penilaian<?php echo $no1; ?>" value="N" type="radio">
																<label for="radios<?php echo $no1; ?>">
																	Tidak
																</label>
															</div>
															
														</div>
														
														<div class = "col-md-6 sales_dishowroom" style="display:none;">
															<div class="form-group">
																<div class="note-editor">
																	<textarea style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" id="keterangan" name="<?php echo 'keterangan'.$no1; ?>"></textarea>
																</div>
															</div>
														</div>
														
														<div class = "col-md-6 sales_diluar" style="display:none;">
															<div class="form-group">
																<div class="form-group">
																	<select id="keterangan" class = "form-control <?php echo $kode_sales.'_keterangan'; ?>" name="<?php echo 'keterangan'.$no1 ?>" onchange = "<?php echo 'ganti_value('.$n1.')' ?>">
																		<option value="" disabled selected> PILIH KETERANGAN CATATAN PENGECEKAN SALES COUNTER </option>
																		<option value="PAMERAN">PAMERAN</option>
																		<option value="CUTI">CUTI</option>	
																		<option value="OFF">OFF</option>	
																		<option value="ANTAR MOBIL KE CUSTOMER">ANTAR MOBIL KE CUSTOMER</option>	
																		<option value="KETERANGAN LAINNYA">KETERANGAN LAINNYA</option>	
																	</select>
																</div>
															</div>
														</div>
													</div>
													<br>
												</div>
											</div>

											<?php 
											}
											?>
											
									    	</fieldset>
									    	
									    	</div>
									    	<?php
												$n1 = $n1+1;
											}
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=service_checklist_penampilan_sa';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
											</div>
											
									</form>
									</div>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
		
		
		
		
		
		

<?php
	break;
	case "lihat":
	
	include "../../config/koneksi_service.php";
	date_default_timezone_set('Asia/Jakarta');
	
	$no_form = $_GET[id];
	$query = "SELECT * FROM pengecekan_penampilan_sa where no_pengecekan_mingguan = '$no_form'";
                $hasil = mysql_query($query);
                $data  = mysql_fetch_array($hasil);

	
	/*	$msg = "<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-check'></i> Selamat!</h4>
				Berhasil Mengubah Data.</div>";	*/
		

?>
			
			<script>
				function edit_catatan($id){
					var no_id = $id;
					
					$.ajax({
						method : "post",
						url : "modul/service_checklist/data_edit.php",
						data : "data_ajax="+no_id,
						success : function(data){	
							var parse = JSON.parse(data);
							$('#Modal_catatan').modal('show');
							$('#id').val(parse['id']);
							$('#no_pengecekan').val(parse['no_pengecekan']);
							$('#no_pengecekan_mingguan').val(parse['no_pengecekan_mingguan']);
							$('#nama_penilaian').val(parse['nama_penilaian']);
							$('#kategori_penilaian').val(parse['kode_sa']);
							$('#jam_edit').val(parse['jam']);
							$('#jenis_pengecekan').val(parse['jenis']);
							$('#keterangan').val(parse['catatan_pengecekan']);
							$('#catatan_keterangan').val(parse['keterangan_catatan_pengecekan']);
							$('#hasil').val(parse['hasil_penilaian']);
							
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
					if(no != ''){
						edit_catatan(no_id);
						console.log(no_id);
					}
				}
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
														<strong>Nama PIC :</strong> <?php echo $data['nama_pic']; ?>
													</li>
													<!--li>
														<strong>Status Approve :</strong> <?php echo $data['sign_atasan1'] .' s/d '. $data['sign_atasan2']; ?>
													</li-->
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
														<form role="form" id="form" enctype="multipart/form-data" method="post" action="modul/service_checklist_penampilan_sa/update_data_pengecekan.php" >
														<div class="row">
															<div class="col-md-12">
																
																<div class="row" hidden>
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">
																				No Id
																			</label>
																			<input id="id" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="id" required>
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
																<div class="row">
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">
																				Kode SA
																			</label>
																			<input id="kategori_penilaian" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="kategori_penilaian" readonly>
																		</div>
																	</div>
																</div>
																<div class="row" >
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">
																				Jenis Penilaian
																			</label>
																			<input id="nama_penilaian" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="nama_penilaian" readonly>
																		</div>
																	</div>
																</div>
																
																<div class="row" >
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
																			<input id="jenis_pengecekan" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="jenis_pengecekan" readonly>
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
																	if($_SESSION['leveluser'] == 'mngr_bengkel' or $_SESSION['leveluser'] == 'HRD' or $_SESSION['leveluser'] == 'admin'){
																		$readonly = "";
																	}else{
																		$readonly = "readonly";
																	}
																?>
																<div class="form-group">
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
										
										<div>
											<?php echo $msg; ?>
										</div>
										<hr>
										<div class="row">
											<div class="col-sm-12">
												<div class="panel panel-white no-radius">
													<div class="panel-body no-padding">
														<div class="tabbable no-margin no-padding">
															<ul class="nav nav-tabs" id="myTab">
															<?php
																$tgl_pengecekan = mysql_query("select * from pengecekan_penampilan_sa_detail where no_pengecekan_mingguan = '$data[no_pengecekan_mingguan]' group by tanggal");
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
															$tgl_pengecekan = mysql_query("select * from pengecekan_penampilan_sa_detail where no_pengecekan_mingguan = '$data[no_pengecekan_mingguan]' group by tanggal");
															$no = 0;
															while($data_tgl_pengecekan = mysql_fetch_array($tgl_pengecekan)){
																$no = $no+1;
														?>
															<div id="<?php echo $data_tgl_pengecekan['tanggal'] ?>" class="<?php ($no == "1" ? $act = "active ": $act = ""); echo $act; ?> tab-pane padding-bottom-5">
																<div class="panel-scroll height-360">
																<?php
																	$bulan = date('m-Y');
																	$data_master_pengecekan = mysql_query("select * from sa_bp order by no");
																	$sql = $data_master_pengecekan;
																	$nomor = 0;
																	$nomor2 = 0;
																	echo "<div class='table-responsive'><table class='table table-striped'>";
																	while($data = mysql_fetch_array($sql)){
																	
																	$kode_sa=$data['kode_sa_bp'];
																	$nama_penilaian = $data['nama_penilaian'];
																	$kategori2 = $data['nama_penilaian'];
																	
																?>
																		
																			
																				
																					<thead>
																						<tr style="font-weight: bold; background-color:darkgray; ">
																							<th align = "center" style="width:30%; "> <h4 style="color: white;"><?php echo ucwords(strtoupper($kode_sa)); ?></h4></th>
																							<th align = "center" style="width:5%; "> <font color="white"> PUKUL</font></th>
																							<th align = "center" style="width:5%;"><font color="white"> STATUS</font></th>
																							<th class="hidden-480" style="width:25%;"><font color="white"> KETERANGAN </font></th>
																							<th class="hidden-480" style="width:25%;"><font color="white"> KETERANGAN CATATAN PENGECEKAN </font></th>
																							<th class="hidden-480" style="width:15%;"><font color="white"> ACTION </font></th>
																						</tr>
																					</thead>
																					<tbody class="table-striped">
																				
																					<?php
																						
																							$detail_penilaian = mysql_query("select * from pengecekan_penampilan_sa_detail where tanggal = '$data_tgl_pengecekan[tanggal]' and jam  = '08:00' and kode_sa = '$data[kode_sa_bp]' order by jenis_penilaian,jam");
																							while($data_detail_penilaian = mysql_fetch_array($detail_penilaian)){
																					?>
																						<tr>
																							<td> <?php echo $data_detail_penilaian['jenis_penilaian']; ?> </td>
																							<td> <?php echo $data_detail_penilaian['jam']; ?> </td>
																							<td align = "center"> 
																								<?php
																									if ($data_detail_penilaian['hasil_penilaian'] == "Y"){
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
																					?>
																					<?php
																						$detail_penilaian = mysql_query("select * from pengecekan_penampilan_sa_detail where tanggal = '$data_tgl_pengecekan[tanggal]' and jam  = '13:00' and kode_sa = '$data[kode_sa_bp]' order by jenis_penilaian,jam");
																						while($data_detail_penilaian = mysql_fetch_array($detail_penilaian)){
																					?>
																						<tr>
																							<td> <?php echo $data_detail_penilaian['jenis_penilaian']; ?></td>
																							<td> <?php echo $data_detail_penilaian['jam']; ?> </td>
																							<td align = "center"> 
																								<?php
																									if ($data_detail_penilaian['hasil_penilaian'] == "Y"){
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
																					?>
																					</tbody>
																				
																			
																	
																	
																<?php 
																	}
																?>
																	
																</table>
																</div>
																<?php
																/*	$bulan = date('m-Y');
																	$data_master_pengecekan = mysql_query("select * from service_advisor_bp");
																	$sql = $data_master_pengecekan;
																	$nomor = 0;
																	$nomor2 = 0;
																	echo "<table class='table table-striped'>";
																	while($data = mysql_fetch_array($sql)){
																	
																	$kode_sa=$data['kode_bp'];
																	$nama_penilaian = $data['nama_penilaian'];
																	$kategori2 = $data['nama_penilaian'];	*/
																	
																?>
																		
																			<!--div class="table-responsive">
																				
																					<thead>
																						<tr style="font-weight: bold; background-color:darkgray; ">
																							<th align = "center" style="width:30%; "> <h4 style="color: white;"><?php echo ucwords(strtoupper($kode_sa)); ?></h4></th>
																							<th align = "center" style="width:5%; "> <font color="white"> PUKUL</font></th>
																							<th align = "center" style="width:5%;"><font color="white"> STATUS</font></th>
																							<th class="hidden-480" style="width:25%;"><font color="white"> KETERANGAN </font></th>
																							<th class="hidden-480" style="width:25%;"><font color="white"> KETERANGAN CATATAN PENGECEKAN </font></th>
																							<th class="hidden-480" style="width:15%;"><font color="white"> ACTION </font></th>
																						</tr>
																					</thead>
																					<tbody class="table-striped">
																				
																					<?php
																						
																						//	$detail_penilaian = mysql_query("select * from pengecekan_penampilan_sa_detail where tanggal = '$data_tgl_pengecekan[tanggal]' and kode_sa = '$data[kode_bp]' order by jenis_penilaian,jam");
																						//	while($data_detail_penilaian = mysql_fetch_array($detail_penilaian)){
																					?>
																						<tr>
																							<td> <?php echo $data_detail_penilaian['jenis_penilaian']; ?> </td>
																							<td> <?php echo $data_detail_penilaian['jam']; ?> </td>
																							<td align = "center"> 
																								<?php
																									if ($data_detail_penilaian['hasil_penilaian'] == "Y"){
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
																								//	if($_SESSION['leveluser']=='MNGR' or $_SESSION['leveluser']=='DRKSI' or $_SESSION['leveluser']=='admin') { 
																								//		if($data_detail_penilaian['catatan_pengecekan'] != '' and $data_detail_penilaian['keterangan_catatan_pengecekan'] == '' and $data_detail_penilaian['hasil_penilaian'] != "Y"){
																								?>
																								<button type='button' id='edit<?php echo $data_detail_penilaian['no'] ?>' name='edit' class='dlt btn btn-xs btn-warning' onclick='<?php echo "edit_catatan(".$data_detail_penilaian['no'].")" ?>' data-original-title='Update Data Booking <?php echo $data_detail_penilaian[no] ?>' value='<?php echo $data_detail_penilaian['no'] ?>' >
																									<span class='ladda-label'><i class='fa fa-pencil'></i> Tambahkan Catatan Keterangan</span>
																								</button>
																								<?php
																									//	}
																								//	}
																								?>
																							</td>
																							
																						</tr>
																				
																					<?php 
																					//	}
																					?>
																				
																					</tbody>
																				
																			</div>
																	
																	
																<?php 
																//	}	
																?>
																</table-->
																</div>
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
	case "cetak":
	
	include "modul/service_checklist/laporan_penampilan_sa.php";
?>
<?php				
	
	break;
		}	
		}
?>

				