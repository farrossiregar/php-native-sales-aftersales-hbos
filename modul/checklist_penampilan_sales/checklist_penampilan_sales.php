<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>

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
				$judul_header = mysql_query("select * from menu where module = '$_GET[module]'");
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
									<span>Showroom</span>
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
										
										");
										$cek_akses2 = mysql_fetch_array($cek_akses);
										
									
										if($cek_akses2['tambah_data'] == 'Y')
										{
									
									?>
									<div class="form-group">
										<div class="col-md-4">
											<p class="progress-demo">
												<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=checklist_penampilan_sales&act=buat';>
													<span class="ladda-label"><i class="fa fa-plus"></i> Input Data Checklist Showroom<span>
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
											<input type="hidden" name="module" value="checklist_penampilan_sales" />					 
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
									<!--div class="col-md-12">
										<div class="form-group">
											<div class="table-header"><i><b>Data Penampilan Sales: </b> Bulan <b><?php echo $_GET['tgl_awal']?></b> </i></div><br />
										</div>
									</div-->
									
									<?php
										$bulan_pengecekan_tgl_awal  = substr($tgl_awal, 5, 2);
										$query=mysql_query("select * from pengecekan_penampilan_sales where substr(tanggal, 6, 2) = '$bulan_pengecekan_tgl_awal'");
									
									?>
									
									<table id="sample_1" class="table table-hover table-full-width">
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
												
												
												$bulan = substr($row['tanggal'], 5, 2);
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
												
												$periode_pengecekan = mysql_query("select min(tanggal) as first from pengecekan_penampilan_sales_detail where no_pengecekan_mingguan = '$row[no_pengecekan_mingguan]'");
												$data_periode_pengecekan = mysql_fetch_array($periode_pengecekan);
												$tgl_pengecekan_awal = substr($data_periode_pengecekan['first'], 8, 2).'-'.substr($data_periode_pengecekan['first'], 5, 2).'-'.substr($data_periode_pengecekan['first'], 0, 4);
												
												$periode_pengecekan2 = mysql_query("select max(tanggal) as last from pengecekan_penampilan_sales_detail where no_pengecekan_mingguan = '$row[no_pengecekan_mingguan]'");
												$data_periode_pengecekan2 = mysql_fetch_array($periode_pengecekan2);
												$tgl_pengecekan_akhir = substr($data_periode_pengecekan2['last'], 8, 2).'-'.substr($data_periode_pengecekan2['last'], 5, 2).'-'.substr($data_periode_pengecekan2['last'], 0, 4);
										
												$tombol=$tombollogin;
												$ubah_data="
													 <a class='btn btn-xs btn-info' href='media_showroom.php?module=checklist_penampilan_sales&act=lihat&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Ubah Data Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-eye'></i> UBAH DATA</a>
													 "; 
												$beri_persetujuan="
													<a class='btn btn-xs btn-warning' href='media_showroom.php?module=checklist_penampilan_sales&act=approve&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Approve Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-check'></i> BERI PERSETUJUAN</a>
													 "; 
													 
												$menunggu_persetujuan="
													 <a class='btn btn-xs btn-warning' href='media_showroom.php?module=checklist_penampilan_sales&act=approve&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Approve Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-check'></i> MENUNGGU PERSETUJUAN</a>
													 "; 
												$sudah_diproses="
													 <a class='btn btn-xs btn-success' href='media_showroom.php?module=checklist_penampilan_sales&act=approve&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Approve Laporan Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-check'></i> SUDAH DIPROSES</a>
													 "; 
												$belum_diproses="
													  <a class='btn btn-xs btn-danger' href='media_showroom.php?module=checklist_penampilan_sales&act=approve&id=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Approve Laporan Pengecekan $row[no_pengecekan_mingguan]' ><i class='ti-close'></i> BELUM DIPROSES</a>
													 ";		 	 
												$tombol3="
													 <a class='btn btn-xs btn-warning' href='modul/checklist_penampilan_sales/laporan_penampilan_sales.php?no_pengecekan_mingguan=$row[no_pengecekan_mingguan]' data-toggle='tooltip' data-original-title='Cetak Laporan Pengecekan $row[no_pengecekan_mingguan]' ><i class='fa fa-print'></i> CETAK</a>
													"; 
												$tombol4="
													 <a class='btn btn-xs btn-warning' href='modul/checklist_penampilan_sales/export_pengecekan_penampilan_sales.php?bulan_cek=$row[tanggal]&no_pengecekan_mingguan=$row[no_pengecekan_mingguan]&tahun_bulan=$_GET[tgl_awal]' data-toggle='tooltip' data-original-title='Ekspor Pengecekan $_GET[tgl_awal]' ><i class='fa fa-print'></i> Ekspor ke Excel</a>
													 "; 
													
											$no++;
										?>
										<tbody class="table-striped">
											<tr>
												<?php
													if($row['sign_atasan3'] == 'Y'){
														$app_spv = '<i class="fa fa-check fa-2x text-success" ></i>';
													}else{
														$app_spv = '<i class="fa fa-close fa-2x text-danger" ></i>';
													}
													
													if($row['sign_atasan2'] == 'Y'){
														$app_mngr = '<i class="fa fa-check fa-2x text-success" ></i>';
													}else{
														$app_mngr = '<i class="fa fa-close fa-2x text-danger" ></i>';
													}
													
													if($row['sign_atasan1'] == 'Y'){
														$app_drksi = '<i class="fa fa-check fa-2x text-success" ></i>';
													}else{
														$app_drksi = '<i class="fa fa-close fa-2x text-danger" ></i>';
													}
													
													
												?>
												<td><?php echo $no ?>.</td>
												<td><?php echo '
																<strong>No Pengecekan : </strong>'. $row['no_pengecekan_mingguan'] .'<br />
																<strong>Bulan Pengecekan : </strong>'.$bulan .'<br /> 
																<strong>Periode Pengecekan : </strong>'.$tgl_pengecekan_awal.', <strong> s/d </strong>'.$tgl_pengecekan_akhir.'<br /> 
																<strong>Supervisor Approve : </strong>'.$app_spv.'<br />
																<strong>Sales Manager Approve : </strong>'.$app_mngr.'<br />
																<strong>Direktur Approve : </strong>'.$app_drksi
																;?>
													<br><br><br>
													<?php 
														if($_SESSION['leveluser']=='HRD' or $_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='CCO' or $_SESSION['leveluser']=='supervisor'){
															echo $ubah_data; 
														}else{
															echo "";
														}
														
													/*	if(($_SESSION['leveluser']=='supervisor' and $row['sign_atasan3'] == '') or ($_SESSION['leveluser']=='MNGR' and $row['sign_atasan2'] == 'Y') or ($_SESSION['leveluser']=='DRKSI' and $row['sign_atasan1'] != 'Y' and $row['sign_atasan2'] == 'Y') or $_SESSION['leveluser'] == 'admin' ){ 
																echo $beri_persetujuan; 
															}elseif(($_SESSION['leveluser']=='DRKSI' and $row['sign_atasan2'] == '') or $_SESSION['leveluser'] == 'admin'){
																echo $tombol_approve; 
															}else{
																if($_SESSION['leveluser']=='CCO'){
																	echo "";
																}else{
																	echo $tombol2;
																}
															}	*/
															
														if($_SESSION['leveluser']=='supervisor'){
															if($row['sign_atasan1'] == 'Y'){
																echo $sudah_diproses;
															}else{
																if($row['sign_atasan3'] == ''){
																	echo $beri_persetujuan; 
																}else{
																	echo $menunggu_persetujuan; 
																}
															}
														}elseif($_SESSION['leveluser']=='MNGR'){
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
													<?php
													//	if()
													?>
													<div class = "row">
														<div class = "col-md-12">
															
														</div>
													</div>
												</td>
											</tr>
										</tbody>
											
										<?php
										}
										?>
									</table>
									
									<?php
										$bulan_pengecekan_tgl_awal  = substr($tgl_awal, 5, 2);
										$tombol_ekspor = mysql_query("select * from pengecekan_penampilan_sales where substr(tanggal, 6, 2) = '$bulan_pengecekan_tgl_awal'");
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
		$qry1=mysql_query("select * from target_sales where kode_spv = 'SUDI' and bulan = '$bulan'");
		while($sql1=mysql_fetch_array($qry1)){
				
			$qry=mysql_query("select * from master_penilaian_sales");
			
			$week=date("W");
		
			while($sql=mysql_fetch_array($qry)){
				$n=$n+1;	
				
				$week=date("W");
				$nextNoTransaksiMingguan = "PS".$week;
				$no_pengecekan = $_POST['no_pengecekan'];
				$nama_pic = $_POST['nama_pic'];
				$jam = $_POST['jam'];
				$tanggal_pengecekan = $_POST['tanggal_pengecekan'];
			
				$kode_sales = $_POST['kode_sales'.$n];
				$jenis_penilaian = $_POST['jenis_penilaian'.$n];
				$penilaian = $_POST['penilaian'.$n];
				$keterangan = $_POST['keterangan'.$n];
				
				$today=date("ymd");
				$week=date("W");
				$query = "SELECT max(no_pengecekan) as last FROM pengecekan_penampilan_sales_detail WHERE no_pengecekan LIKE 'PS$today'";
				$hasil = mysql_query($query);
				$data  = mysql_fetch_array($hasil);
				$lastNoTransaksi = $data['last'];
				$lastNoUrut = substr($lastNoTransaksi, 6, 3);
				$nextNoUrut = $lastNoUrut + 1;
				$nextNoTransaksiMingguan = "PS".$week;
			
				$cek=mysql_query("select * from pengecekan_penampilan_sales_detail where no_pengecekan = '$no_pengecekan' and jam = '$jam'");
				$jml_rec = mysql_num_rows($cek);
				if ($jml_rec < 30){
					mysql_unbuffered_query("insert into pengecekan_penampilan_sales_detail (no_pengecekan_mingguan, no_pengecekan, jam, tanggal, hasil_penilaian, kode_sales, jenis_penilaian, catatan_pengecekan, keterangan_catatan_pengecekan) 
					values('$nextNoTransaksiMingguan', '$no_pengecekan','$jam', '$tanggal_pengecekan', '$penilaian','$kode_sales','$jenis_penilaian','$keterangan','')");
					
					mysql_query("insert into notif_penampilan_sales (no_pengecekan, tanggal, jam, kode_sales, read_admin, notif_admin, read_spv, notif_spv, read_cco, notif_cco, catatan_pengecekan, hasil) 
					values('$no_pengecekan', '$tanggal_pengecekan', '$jam', '$kode_sales', 'N', 'Y', 'N', 'Y', 'Y', 'N', '$keterangan', '$penilaian')");	
					
					mysql_query("delete from notif_penampilan_sales where hasil = 'Y'");	
					
				/*	$data_empty = mysql_query("select * from pengecekan_penampilan_sales_detail where no_pengecekan = '$no_pengecekan' and jam = '$jam' and hasil_penilaian = '' and catatan_pengecekan = ''");
					$cek_data_empty = mysql_num_rows($data_empty);
					if($cek_data_empty > 0){
						mysql_unbuffered_query("update pengecekan_penampilan_sales_detail set hasil_penilaian = '$penilaian', catatan_pengecekan = '$keterangan' where kode_sales = '$kode_sales' and tanggal = '$tanggal_pengecekan' and jam = '$jam' and hasil_penilaian = '' and catatan_keterangan = ''");
					}	*/
					
				
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
			$cek=mysql_query("select * from pengecekan_penampilan_sales where no_pengecekan_mingguan = '$nextNoTransaksiMingguan'");
			$jml_rec = mysql_num_rows($cek);
			if ($jml_rec < 1){
				mysql_unbuffered_query("insert into pengecekan_penampilan_sales (no_pengecekan_mingguan, nama_pic, tanggal, sign_atasan1, sign_atasan2, sign_atasan3) 
				values('$nextNoTransaksiMingguan','$nama_pic','$tanggal_pengecekan','', '', '')");
			}else{
				
			}
			
			
			
		
			$input2 = $_POST['accs_bonus'];
			$nomor_transaksi = $_POST['accs_bonus_notransaksi'];
			$supplier = $_POST['accs_bonus_supplier'];
			$bonus_keterangan = $_POST['accs_bonus_keterangan'];
			
			$no = 0;
			foreach ($input2 as $accs_bonus) {
				if($accs_bonus!=''){
				mysql_query("insert into pengecekan_penampilan_sales_detail2 (no_pengecekan_mingguan,no_pengecekan, jam, tanggal, hasil, kode_sales, jenis_penilaian, catatan_pengecekan, keterangan_catatan_pengecekan) 
				values('$nextNoTransaksiMingguan','$no_pengecekan','$bonus_keterangan[$no]', '', '', '$bonus_keterangan[$no]','Y' ,'$bonus_keterangan[$no]', '')");	
				$no ++;
				}
			}
		}
	}
?>


<script>

	function ganti_value($id){
		var param = $id;
		if(param == 1){
			var kode_sales = 'HANI';
			var value = $('.' + kode_sales +'_keterangan').val();
			$('#checklist_' + kode_sales + '').find("." + kode_sales +"_keterangan").val(value);
		}else if(param == 2){
			var kode_sales = 'HLMH';
			var value = $('.' + kode_sales +'_keterangan').val();
			$('#checklist_' + kode_sales + '').find("." + kode_sales +"_keterangan").val(value);
		}else if(param == 3){
			var kode_sales = 'LIES';
			var value = $('.' + kode_sales +'_keterangan').val();
			$('#checklist_' + kode_sales + '').find("." + kode_sales +"_keterangan").val(value);
		}else if(param == 4){
			var kode_sales = 'RERE';
			var value = $('.' + kode_sales +'_keterangan').val();
			$('#checklist_' + kode_sales + '').find("." + kode_sales +"_keterangan").val(value);
		}else if(param == 5){
			var kode_sales = 'RIA';
			var value = $('.' + kode_sales +'_keterangan').val();
			$('#checklist_' + kode_sales + '').find("." + kode_sales +"_keterangan").val(value);
		}else{
			var kode_sales = 'WARI';
			var value = $('.' + kode_sales +'_keterangan').val();
			$('#checklist_' + kode_sales + '').find("." + kode_sales +"_keterangan").val(value);
		}
		
		console.log(kode_sales);
	
	}
	
	function tampil_sales($id){
		var sales = $id;
		
		if(sales == 1){
			kode_sales = 'HANI';
		}else if(sales == 2){
			kode_sales = 'HLMH';
		}
		else if(sales == 3){
			kode_sales = 'LIES';
		}
		else if(sales == 4){
			kode_sales = 'RERE';
		}
		else if(sales == 5){
			kode_sales = 'RIA';
		}
		else{
			kode_sales = 'WARI';
		}
		
		if($('#'+kode_sales + sales).is(':checked')){
			console.log("ok");
				$('#checklist_'+kode_sales).find("."+kode_sales+"").show();
				$('#atribut_sales'+kode_sales).hide();
				$('#checklist_'+kode_sales).find(".sales_diluar").show();
				$('#checklist_'+kode_sales).find(".sales_dishowroom").hide();
				$('#checklist_'+kode_sales).find("."+kode_sales+"_radio2").show();
				$('#checklist_'+kode_sales).find("."+kode_sales+"_radio1").hide();
				$('#checklist_'+kode_sales).find(".input2, .input3, .input4, .input5").hide();
		}else{
			console.log("no");
			$('#atribut_sales'+kode_sales).show();
			$('#checklist_'+kode_sales).find("."+kode_sales+"").show();
			$('#checklist_'+kode_sales).find(".sales_diluar").hide();
			$('#checklist_'+kode_sales).find(".sales_dishowroom").show();
			$('#checklist_'+kode_sales).find("."+kode_sales+"_radio2").hide();
				$('#checklist_'+kode_sales).find("."+kode_sales+"_radio1").show();
			$('#checklist_'+kode_sales).find("."+kode_sales+"_radio2").attr('checked', false);
		}
	
	}


</script>


	<div class="main-content">
		<div class="wrap-content container" id="container">
			<!-- start: PAGE TITLE -->
			<section id="page-title">
				<div class="row">
					<div class="col-sm-8">
						<h1 class="mainTitle">Data Checklist Penampilan Sales Counter</h1>
						<span class="mainDescription">Masukkan Data Checklist Penampilan Sales Counter</span>
					</div>
					<ol class="breadcrumb">
						<li>
							<span>Showroom</span>
						</li>
						<li class="active">
							<span>Checklist Penampilan Sales</span>
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
									<div class="form-group">
										<select id="jam" name="jam" >
											<option value="" disabled>Pilih Waktu:</option>
											<option value="09:00" <?php if($_GET[jam]=='09:00'){echo "selected"; } ?>>09:00</option>
											<option value="14:00" <?php if($_GET[jam]=='14:00'){echo "selected";  }?>>14:00</option>	
										</select>
									</div>
								</div>
							</div>
					</div>
							
					<?php
						$bulan = date('m-Y');
						$sql=mysql_query("select * from target_sales where kode_spv = 'sudi' and bulan = '$bulan' order by kode_sales asc");
						$no1 = 0;
						$no2 = 0;
						$n1 = 1;
						$n2 = 1;
						$nomor2 = 1;
						while($data_sql = mysql_fetch_assoc($sql)){
							$nomor2 = $nomor2+5;
						
							
						$kode_sales = strtoupper($data_sql['kode_sales']);
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
													Tidak Ada di Tempat
												</label>
											</div>
											<div class="radio clip-radio radio-primary radio-inline">
												<!--input id="<?php echo $kode_sales."s".$n1; ?>" name="kelengkapan<?php echo $kode_sales.$n1; ?>" value="N" type="radio" onchange = "<?php echo 'tampil_'.$kode_sales.'()' ?>"-->
												<input id="<?php echo $kode_sales."s".$n1; ?>" name="kelengkapan<?php echo $kode_sales.$n1; ?>" value="Y" type="radio" onchange = "<?php echo 'tampil_sales('.$n1.')' ?>">
												<label for="<?php echo $kode_sales."s".$n1; ?>">
													Ada di Tempat
												</label>
											</div>
										</div>
									</div>
									<br>
									
									<?php
										$no2 = $no2+5;
									//	$no2 = $no2+2;
									?>
									
									<?php
										$kueri=mysql_query("select * from master_penilaian_sales order by no asc");
										$loop = 0;
										while($data = mysql_fetch_assoc($kueri)){
											$no1 = $no1+1;
											$loop = $loop+1;
										//	$no2 = $no2+1;
										//	$nomor2 = $nomor2+1;
									?>
									
									
									<div class = "row <?php echo $kode_sales; ?> <?php echo 'input'.$loop ?>" style="display:none;">
										<div class = "col-md-3">
											<div class="form-group">
												<input type="hidden" style="text-transform:uppercase" placeholder="0" class="form-control" id="kode_sales" name="<?php echo 'kode_sales'.$no1; ?>" value="<?php echo $data_sql['kode_sales']; ?>" readonly required>
												<input type="hidden" style="text-transform:uppercase" placeholder="0" class="form-control" id="jenis_penilaian" name="<?php echo 'jenis_penilaian'.$no1; ?>" value="<?php echo $data['jenis_penilaian']; ?>" readonly required>
												
												<b id = 'atribut_sales<?php echo $kode_sales; ?>'><?php echo strtoupper($data['jenis_penilaian']); ?></b>
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
													<div class="radio clip-radio radio-primary radio-inline <?php echo $kode_sales.'_radio1'; ?>">
														<input id="radios<?php echo $no1; ?>" name="penilaian<?php echo $no1; ?>" value="N" type="radio">
														<label for="radios<?php echo $no1; ?>">
															Tidak
														</label>
													</div>
													<div class="radio clip-radio radio-primary radio-inline <?php echo $kode_sales.'_radio2'; ?>">
														<input id="radios<?php echo $no1; ?>" name="penilaian<?php echo $no1; ?>" value="N" type="radio" checked>
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
																<option value="SAKIT">SAKIT</option>
																<option value="TEST DRIVE">TEST DRIVE</option>
																<option value="KE GUDANG">KE GUDANG</option>
																<option value="CUTI">CUTI</option>	
																<option value="OFF">OFF</option>	
																<option value="ANTAR MOBIL KE CUSTOMER">ANTAR MOBIL KE CUSTOMER</option>
																<option value="BERTEMU DENGAN CUSTOMER	">BERTEMU DENGAN CUSTOMER	</option>
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
							$n2 = $n2+1;
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
							<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=checklist_penampilan_sales';>
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
	
	include "koneksi.php";
	date_default_timezone_set('Asia/Jakarta');
	
	$no_form = $_GET[id];
	$query = "SELECT * FROM pengecekan_penampilan_sales where no_pengecekan_mingguan = '$no_form'";
                $hasil = mysql_query($query);
                $data  = mysql_fetch_array($hasil);
				

	
	
	/*	$msg = "<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-check'></i> Selamat!</h4>
				Berhasil Mengubah Data.</div>";
		echo $msg;	*/

?>
			
			<script>
				function edit_catatan($id){
					var no_id = $id;
					
					$.ajax({
						method : "post",
						url : "modul/checklist_penampilan_sales/data_edit.php",
						data : "data_ajax="+no_id,
						success : function(data){
							var user = "<?php echo $_SESSION['username'] ?>";
							var jam = "<?php echo date('Y-m-d H:i:s') ?>";
							var parse = JSON.parse(data);
							$('#Modal_catatan').modal('show');
							$('#id').val(parse['id']);
							$('#no_pengecekan').val(parse['no_pengecekan']);
							$('#no_pengecekan_mingguan').val(parse['no_pengecekan_mingguan']);
							$('#nama_penilaian').val(parse['nama_penilaian']);
							$('#kategori_penilaian').val(parse['kode_sales']);
							$('#jam_edit').val(parse['jam']);
							$('#tanggal').val(parse['tanggal']);
							$('#keterangan').val(parse['catatan_pengecekan']);
							$('#catatan_keterangan').val(parse['keterangan_catatan_pengecekan']);
							$('#hasil').val(parse['hasil_penilaian']);
							$('#jenis_pengecekan').val(parse['jenis']);
							if (parse['hasil_penilaian']  == "Y"){
								var hasil = "<center class = 'info'><i class='fa fa-check fa-4x text-success' style = 'cursor:pointer;' ></i><br><center>";	
							}else{
								var hasil = "<center><i class='fa fa-close fa-4x text-danger' style = 'cursor:pointer;'></i><br><center>";
							}
							$('#symbol').html(hasil);
							
						/*	if(parse['catatan_pengecekan'] != ''){
								$('#keterangan').val(parse['catatan_pengecekan'] + '\n \n' + user + ' [' + jam + '] ' + ' : ');
							}else{
								$('#keterangan').val(user + '[' + jam + '] ' + ' : ');
							}
							
							if(parse['keterangan_catatan_pengecekan'] != ''){
								$('#catatan_keterangan').val(parse['keterangan_catatan_pengecekan'] + '\n \n' + user + ' [' + jam + '] ' + ' : ');
							}else{
								$('#catatan_keterangan').val(user + '[' + jam + '] ' + ' : ');
							}	*/
							
							$('#myModal2Label').html("Tambahkan Catatan Keterangan");
							$("input[name=filter_update]").prop("checked",false);
						}
					})
				}
				
				function edit_catatan_spv($id){
					var no_id = "PS" + $id;
					console.log(no_id);
					$.ajax({
						method : "post",
						url : "modul/checklist_penampilan_sales/data_edit_catatan_spv.php",
						data : "data_ajax="+no_id,
						success : function(data){
							var user = "<?php echo $_SESSION['username'] ?>";
							var jam = "<?php echo date('Y-m-d H:i:s') ?>";
							
							var parse = JSON.parse(data);
							$('#Modal_catatan').modal('show');
							$('#id').val(parse['id']);
							$('#no_pengecekan').val(parse['no_pengecekan']);
							$('#keterangan_spv').val(parse['keterangan_spv']);
							$('#catatan_keterangan').val(parse['keterangan_catatan_pengecekan']);
							$('#hasil').val(parse['hasil_penilaian']);
							$('#myModal2Label').html("Tambahkan Catatan Keterangan");
						}
					})
				}
				
				function ubah_hasil(){
					var x = $("#hasil").val();
					if ($("#hasil").val() == "Y") {
						var hasil = "<center><i class='fa fa-close fa-4x text-danger' style = 'cursor:pointer;'></i><br><center>";
						$('#hasil').val("N");	
					} else {
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
														<strong>Nama PIC :</strong> <?php echo strtoupper($data['nama_pic']); ?>
													</li>
													<li>
														<strong>Divisi PIC :</strong> CCO
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
														<form role="form" id="form" enctype="multipart/form-data" method="post" action="modul/checklist_penampilan_sales/update_data_keterangan.php" >
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
																				Kode Sales
																			</label>
																			<input id="kategori_penilaian" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="kategori_penilaian" readonly>
																		</div>
																	</div>
																</div>
																<div class="row" hidden>
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
																<div class="row" >
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="control-label">
																				Tanggal
																			</label>
																			<input id="tanggal" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control" type="text" value="" name="tanggal" readonly>
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
																			<input id="hasil" class="form-control" type="text" value="" name="hasil" >
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
																	if($_SESSION['leveluser'] == 'HRD' or $_SESSION['leveluser'] == 'admin'  or $_SESSION['leveluser']=='supervisor'){
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
																			<textarea class="form-control" id="catatan_keterangan" name="catatan_keterangan" <?php echo $readonly ?> ></textarea>
																		</div>
																	</div>
																</div>
															</div>
															<?php 
																if($_SESSION['leveluser'] == 'admin' or ($leveluser=='supervisor' and $_SESSION['username']=='sudi123') or $_SESSION['leveluser'] == 'CCO'){
															?>
															<div class="col-md-12">
																<div class="radio clip-radio radio-primary radio-inline">												
																	<input type="radio" id="radio1" name="filter_update" class="filter_update" value="1" >
																	<label for="radio1">
																		Ubah Hanya Data ini
																	</label>
																</div>
																<div class="radio clip-radio radio-primary radio-inline">
																	<input type="radio" id="radio2" name="filter_update" class="filter_update" value="2" >
																	<label for="radio2">
																		Ubah Data untuk Sales ini
																	</label>
																</div>
																<div class="radio clip-radio radio-primary radio-inline">
																	<input type="radio" id="radio3" name="filter_update" class="filter_update" value="3" >
																	<label for="radio3">
																		Ubah Data untuk Sales Pada Waktu ini
																	</label>
																</div>
																<div class="radio clip-radio radio-primary radio-inline">
																	<input type="radio" id="radio4" name="filter_update" class="filter_update" value="4" >
																	<label for="radio4">
																		Ubah Data untuk Hari ini
																	</label>
																</div>
															</div>
															<?php 
																}
															?>
														</div>
														</br>
														<div class="row">											
															<div class="col-md-12">
																<button class="btn btn-primary btn-wide" type="submit" id="bn" name="bn">
																	<span class="ladda-label"><i class="fa fa-save"></i> Simpan</span>
																</button>
																
																<!--button type = "button" id="keluar" class="btn btn-wide btn-danger ladda-button" data-style="expand-right"  onclick='exit_modal();'>
																	<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
																</button-->
																
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
																$tgl_pengecekan = mysql_query("select * from pengecekan_penampilan_sales_detail where no_pengecekan_mingguan = '$data[no_pengecekan_mingguan]' group by tanggal");
																$no = 0;
																while($data_tgl_pengecekan = mysql_fetch_array($tgl_pengecekan)){
																	$no = $no+1;
															?>
																<li class="<?php ($no == "1" ? $act = "active ": $act = ""); echo $act; ?>  padding-top-5 ">
																<!--li class="  padding-top-5 "-->
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
															$tgl_pengecekan = mysql_query("select * from pengecekan_penampilan_sales_detail where no_pengecekan_mingguan = '$data[no_pengecekan_mingguan]' group by tanggal");
															$no = 0;
															while($data_tgl_pengecekan = mysql_fetch_array($tgl_pengecekan)){
																$no = $no+1;
														?>
															<div id="<?php echo $data_tgl_pengecekan['tanggal'] ?>"  class="<?php ($no == "1" ? $act = "active ": $act = ""); echo $act; ?> tab-pane padding-bottom-5">
															<!--div class=" padding-top-5 padding-left-5" id="<?php //echo $data_tgl_pengecekan['tanggal'] ?>" class="tab-pane padding-bottom-5"-->
																<div class="panel-scroll height-360">
																<?php
																	$bulan = date('m-Y');
																	$data_master_pengecekan = mysql_query("select * from target_sales where kode_spv = 'SUDI' and bulan = '$bulan' order by kode_sales asc");
																	$sql = $data_master_pengecekan;
																	$nomor = 0;
																	$nomor2 = 0;
																	echo "<div id = 'header_table' class='table-responsive'><table class='table table-striped'>";
																	while($data = mysql_fetch_array($sql)){
																	$nomor = $nomor+1;
																	$kode_sales=$data['kode_sales'];
																	$nama_penilaian = $data['nama_penilaian'];
																	$kategori2 = $data['nama_penilaian'];
																	
																?>
																		
																				
																					<thead>
																						<tr style="font-weight: bold; background-color:darkgray; ">
																							<th align = "center" style="width:30%; "> <h4 style="color: white;"><?php echo ucwords(strtoupper($kode_sales)); ?></h4></th>
																							<th align = "center" style="width:5%; "> <font color="white"> PUKUL</font></th>
																							<th align = "center" style="width:5%;"><font color="white"> STATUS</font></th>
																							<th class="hidden-480" style="width:25%;"><font color="white"> KETERANGAN </font></th>
																							<th class="hidden-480" style="width:25%;"><font color="white"> KETERANGAN CATATAN PENGECEKAN </font></th>
																							<th class="hidden-480" style="width:15%;"><font color="white"> ACTION </font></th>
																						</tr>
																					</thead>
																					<tbody class="table-striped">
																				
																					<?php
																						$detail_penilaian = mysql_query("select * from pengecekan_penampilan_sales_detail where tanggal = '$data_tgl_pengecekan[tanggal]' and jam = '09:00' and kode_sales = '$data[kode_sales]' order by jenis_penilaian,jam");
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
																								<button type='button' id='edit<?php echo $data_detail_penilaian['no'] ?>' name='edit' class='dlt btn btn-xs btn-warning' onclick='<?php echo "edit_catatan(".$data_detail_penilaian['no'].', '.$nomor.")" ?>' data-original-title='Update Data Booking <?php echo $data_detail_penilaian[no] ?>' value='<?php echo $data_detail_penilaian['no'] ?>' >
																									<span class='ladda-label'><i class='fa fa-pencil'></i>Edit</span>
																								</button>
																								<br>
																								
																							</td>
																							
																						</tr>
																						
																						
																					<?php 
																						}
																					?>
																					
																					<?php
																						$detail_penilaian = mysql_query("select * from pengecekan_penampilan_sales_detail where tanggal = '$data_tgl_pengecekan[tanggal]' and jam = '14:00' and kode_sales = '$data[kode_sales]' order by jenis_penilaian,jam");
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
																								<button type='button' id='edit<?php echo $data_detail_penilaian['no'] ?>' name='edit' class='dlt btn btn-xs btn-warning' onclick='<?php echo "edit_catatan(".$data_detail_penilaian['no'].', '.$nomor.")" ?>' data-original-title='Update Data Booking <?php echo $data_detail_penilaian[no] ?>' value='<?php echo $data_detail_penilaian['no'] ?>' >
																									<span class='ladda-label'><i class='fa fa-pencil'></i>Edit</span>
																								</button>
																								<br>
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
																</div>
															</div>
															
															<?php
																}
															?>
														</div>
														
														<?php
														//	if($_SESSION['username'] == 'farros'){
														?>
														<br><br>
														<div class = 'col-md-12'>
															<div id = 'header_table' class='table-responsive'>
																<table class='table table-striped'>
																	<tr style="font-weight: bold; background-color:darkgray; ">
																		<th align = "center" style="width:30%; "> <h4 style="color: white;"><?php echo (strtoupper('PENGECEKAN SUPERVISOR')); ?></h4></th>
																		<th class="hidden-480" style="width:25%;"><font color="white"> KETERANGAN SUPERVISOR </font></th>
																		<th class="hidden-480" style="width:15%;"><font color="white"> ACTION </font></th>
																	</tr>
																	<tbody>
																		<?php
																			$no_form = $_GET[id];
																			$query = "SELECT * FROM pengecekan_showroom where no_pengecekan_mingguan = '$no_form'";
																				$hasil = mysql_query($query);
																				$data  = mysql_fetch_array($hasil);
																						
																			$pengecekan_lain = mysql_query("select * from pengecekan_penampilan_sales where no_pengecekan_mingguan = '$no_form'");
																			while($data_pengecekan_lain = mysql_fetch_array($pengecekan_lain)){
																		?>
																		<tr>
																			<td> <h4 style="color: black;"></h4></th>
																			<td><?php echo $data_pengecekan_lain['keterangan_spv'] ?></td>
																			<td>
																				<button type='button' id='edit<?php echo $data_detail_penilaian['no'] ?>' name='edit' class='dlt btn btn-xs btn-warning' onclick='<?php echo "edit_catatan_spv(".substr($data_pengecekan_lain['no_pengecekan_mingguan'], 2, 2).")" ?>' data-original-title='Update Data Pengecekan <?php echo $data_pengecekan_lain[no] ?>' value='<?php echo $data_pengecekan_lain['no'] ?>' >
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
														</div>
														<?php
														//	}
														?>
														
													</div>
												</div>
											</div>
										</div>
										<!--button type = "button" class="btn btn-wide btn-success ladda-button">
											Sudah Direview oleh Supervisor </span>
										</button-->
										
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
	
	include "modul/checklist_penampilan_sales/laporan_pengecekan_showroom.php";
?>
<?php				
	
	break;
		}	
		}
?>

				