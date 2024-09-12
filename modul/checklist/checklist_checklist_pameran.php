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
									<h1 class="mainTitle">Data Checklist Pameran</h1>
									<span class="mainDescription">Input Data Checklist Pameran</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li>
										<span>Pameran</span>
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
									    
										<?php
										    $level = $_SESSION['leveluser'];
										    
										    $cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
										    left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 
										    
										    ");
										    $cek_akses2 = mysql_fetch_array($cek_akses);
										    
										
										    if($cek_akses2['tambah_data'] == 'Y')
										    {
										
										?>
										
										<p class="progress-demo">
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=checklist_checklist_pameran&act=buat';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Input Data Checklist Pameran</span>
											</button>	
										</p>
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
							<input type="hidden" name="module" value="checklist_checklist_pameran" />					 
								<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
									<input class="form-control" type="text" id="tgl_awal" value = "<?php echo $_GET[tgl_awal]; ?>" name="tgl_awal" readonly>
										<span class="input-group-addon bg-primary">s/d</span>
									<input class="form-control" type="text" id="tgl_akhir" value = "<?php echo $_GET[tgl_akhir]; ?>" name="tgl_akhir" readonly>
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
                    		//jika tidak menginput apa2
                    		//$query=mysql_query("select * from checklist_pameran order by periode_pameran_awal desc");
                    		
							}else{
                    		
                    		?>
							<div class="col-md-12">
							<div class="form-group">
							<div class="table-header"><i><b>Data Pameran: </b> dari Periode <b><?php echo $_GET['tgl_awal']?></b> sampai dengan periode <b><?php echo $_GET['tgl_akhir']?></b></i></div><br />
                            </div>
							</div>
							<?php
                    		if ($_SESSION['leveluser'] == 'supervisor'){
								$query=mysql_query("select * from checklist_pameran where (date(periode_pameran_awal) <= '$tgl_awal' and date(periode_pameran_awal) >= '$tgl_akhir')  or (date(periode_pameran_akhir) <= '$tgl_akhir' and date(periode_pameran_akhir) >= '$tgl_awal') and pic_pameran = '$_SESSION[kode_spv]'");
								
							}else {
								$query=mysql_query("select * from checklist_pameran where (date(periode_pameran_awal) <= '$tgl_awal' and date(periode_pameran_awal) >= '$tgl_akhir')  or (date(periode_pameran_akhir) <= '$tgl_akhir' and date(periode_pameran_akhir) >= '$tgl_awal')");
                    		}
							}
							?>
                    
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
                            	$tombollogin = $_SESSION['leveluser'];
								
								
                            	//menampilkan data
                            	while($row=mysql_fetch_array($query)){
									
								$tombol=$tombollogin;
    								//if($tombol=="admin") {
    								   $tombol="
    								         <a class='btn btn-xs btn-warning' href='media_showroom.php?module=checklist_checklist_pameran&act=lihat&id=$row[no_pameran]' data-toggle='tooltip' data-original-title='Cetak Pengajuan $row[no_pameran]' ><i class='fa fa-print'></i> LIHAT</a>
    									     "; 
    									//}	
										/* 
										 $tombol="
										 
    								         <a class='btn btn-xs btn-warning' href='media_showroom.php?module=sub_pameran_checklist_pameran&act=lihat&id=$row[no_pameran]' data-toggle='tooltip' data-original-title='Cetak Pengajuan $row[no_pameran]' ><i class='fa fa-print'></i> LIHAT</a>
    									     <a class='btn btn-xs btn-primary' href='media_showroom.php?module=sub_pameran_checklist_pameran&act=ubahpengajuan&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Ubah Pengajuan $data[no_pengajuan]'><i class='fa fa-edit'></i> UBAH</a>
    									     <a class='btn btn-xs btn-danger' href='media_showroom.php?module=sub_pameran_checklist_pameran&act=hapuspengajuan&id=$data[no_pengajuan]' onClick='return warning();' data-placement='top' data-toggle='tooltip' data-original-title='Hapus Pengajuan $data[no_pengajuan]'><i class='fa fa-trash'></i> HAPUS</a>"; 
										
										*/
									
                            	$no++;
                            ?>
                                <tr>
                                	<td><?php echo $no ?>.</td>
                                    <td><?php echo '<strong>No Form Pameran : </strong>'. $row['no_pameran'] .'<br />
												    <strong>Lokasi Pameran : </strong>'.$row['lokasi_pameran'] .'<br /> 
													<strong>Lokasi Pameran : </strong>'.$row['jenis_pameran'] .'<br /> 
													<strong>Periode Pameran : </strong>'.$row['periode_pameran_awal'] .' s/d '. $row['periode_pameran_akhir'] .'<br />
												    <strong>User Buat : </strong>'.$row['user_buat'];?>

													<br /><br />
													<center><?php echo $tombol; ?></center>
									
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
?>
		
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Checklist Pameran</h1>
									<span class="mainDescription">Masukkan Data Checklist Pameran</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li>
										<span>Pameran</span>
									</li>
									<li class="active">
										<span>Checklist Pameran</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
								    
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="modul/checklist/simpan_checklist_pameran.php">
										
										<div class="row">
										    <div class="col-md-12">
										    <?php echo(isset ($msg) ? $msg : ''); ?>
										    </div>
											
											<?php
											    $today=date("ym");
                                                $query = "SELECT max(no_pameran) as last FROM checklist_pameran WHERE no_pameran LIKE 'CP$today%'";
                                                $hasil = mysql_query($query);
                                                $data  = mysql_fetch_array($hasil);
                                                $lastNoTransaksi = $data['last'];
                                                $lastNoUrut = substr($lastNoTransaksi, 6, 3);
                                                $nextNoUrut = $lastNoUrut + 1;
                                                $nextNoTransaksi = $today.sprintf('%03s', $nextNoUrut);
                                                ?>
											<div class="col-md-2">
												<label class="control-label">
													No Permohonan <span class="symbol required"></span>
												</label>
												<input type="text" placeholder="No Permohonan" class="form-control" value="CP<?php echo $nextNoTransaksi; ?>" id="no_pameran" name="no_pameran" required readonly>
												</input>
											</div>
											
											<div class="col-md-2">
												<label class="control-label">
													Lokasi Pameran <span class="symbol required"></span>
												 </label>
												<div class="form-group">
													<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="Lokasi Pameran" class="form-control" id="lokasi_pameran" name="lokasi_pameran" required>
												</div>
											</div>
											
											<div class="col-md-2">
												<label class="control-label">
													PIC Pameran <span class="symbol required"></span>
												 </label>
													<select id="form-field-select-1" name="pic_pameran" class="form-control">
													<option value="" selected disabled>- Pilih PIC -</option>
													<?php $pic = mysql_query("select * from supervisor where aktif = 'Y'" );
														while ($pic2 = mysql_fetch_array($pic)){
															
														
													?>
															
															<option value="<?php echo $pic2[kode_supervisor]; ?>"><?php echo $pic2[kode_supervisor] ;?></option>
															
													<?php
													}
													?>
													</select>
											</div>
											
											<div class="col-md-2">
												<label class="control-label">
													Jenis Pameran <span class="symbol required"></span>
												 </label>
													<select id="form-field-select-1" name="jenis_pameran" class="form-control">
															<option value="" selected disabled>- Pilih Jenis -</option>
															<option value="INDOOR">INDOOR</option>
															<option value="OUTDOOR">OUTDOOR</option>
													</select>
											</div>
											
										    <div class="col-md-4">
												<label class="control-label">
													Periode <span class="symbol required"></span>
												 </label>
												 
													<div style="padding :0px;" class="input-group input-daterange datepicker" data-date-format='dd-mm-yyyy'>
														<input class="form-control" type="text" id="periode_awal" name="periode_awal" readonly>
															<span class="input-group-addon bg-primary">s/d</span>
														<input class="form-control" type="text" id="periode_akhir" name="periode_akhir" readonly>
													</div>
											</div>
									    </div>
										</div>
										
										
										
										<?php
										
										    $data=mysql_query("select * from standar_keputusan_pameran group by kategori_kontrol order by no");
										    $sql = $data;
										    $nomor = 0;
											$nomor2 = 0;
										    while($data = mysql_fetch_assoc($sql)){
										    
										    $kategori=$data[kategori_kontrol];
											$kategori2=$data[kategori_kontrol];
											
											if($kategori=="materi_promosi") {
												$kategori="MATERI PROMOSI"; 
											}
											if($kategori=="booth") {
												$kategori="BOOTH"; 
											}
											if($kategori=="unit_display") {
												$kategori="UNIT DISPLAY"; 
											}
											if($kategori=="sales_person") {
												$kategori="SALES PERSON"; 
											}
										    
                                            //$jumlah=2;
                                            //for($i=0; $i<$jumlah; $i++){;
                                            ?>
											
											<div class="col-md-12">
											
											<fieldset>
											
											<legend><?php echo $kategori; ?></legend>

											<?php
											$kueri=mysql_query("select * from standar_keputusan_pameran where kategori_kontrol = '$kategori2'");
											
											while($data = mysql_fetch_assoc($kueri)){
											$nomor += 1;  
										    $nomor2 += 1;
											?>
											
											<input type="hidden" style="text-transform:uppercase" placeholder="0" class="form-control" id="kategori_kontrol" name="<?php echo 'kategori_kontrol'.$nomor; ?>" value="<?php echo trim($data[kategori_kontrol]); ?>" readonly required>
									    	
									    	<div class="col-md-6">
									    		<div class="form-group">
													<input type="hidden" style="text-transform:uppercase" placeholder="0" class="form-control" id="standar_keputusan" name="<?php echo 'standar_keputusan'.$nomor; ?>" value="<?php echo trim($data[standar_keputusan]); ?>" readonly required>
												<b><?php echo $nomor; ?>. <?php echo trim($data[standar_keputusan]); ?></b>
												</div>
									    	</div>
											
											
											
									    	<div class="col-md-2">
									    		
													<div class="radio clip-radio radio-primary radio-inline">
														<input id="radio<?php echo $nomor2; ?>" name="penilaian<?php echo $nomor; ?>" value="Y" type="radio">
														<label for="radio<?php echo $nomor2; ?>">
															Ya
														</label>
													</div>
													
													<div class="radio clip-radio radio-primary radio-inline">
														<?php $nomor2 = $nomor2 + 1;  ?>
														<input id="radio<?php echo $nomor2; ?>" name="penilaian<?php echo $nomor; ?>" value="T" type="radio">
														<label for="radio<?php echo $nomor2; ?>">
															Tidak
														</label>
													</div>
													
												
									    	</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="Keterangan" class="form-control" id="keterangan" name="<?php echo 'keterangan'.$nomor; ?>">
												
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
									    	
											<div class="col-md-6">
												<div class="form-group connected-group">
													<label class="control-label">
														Foto Pameran <span class="symbol required"></span>
													</label>
													<div class="form-group">
														<div class="fileinput fileinput-new" data-provides="fileinput">
															<div class="fileinput-new thumbnail"><img src="assets/images/pameran-mobil-honda.jpg" alt="">
															</div>
														<div class="fileinput-preview fileinput-exists thumbnail"></div>
															<div class="user-edit-image-buttons">
																<span class="btn btn-azure btn-file"><span class="fileinput-new"><i class="fa fa-picture"></i> Pilih foto</span><span class="fileinput-exists"><i class="fa fa-picture"></i> Ubah</span>
																	<input type="file" name="foto[]" id="foto" multiple required>
																</span>
																	<a href="#" class="btn fileinput-exists btn-red" data-dismiss="fileinput">
																		<i class="fa fa-times"></i> Hapus
																	</a>
															</div>
														</div>
														<!--input type="file" name="foto[]" multiple-->
												
														
													</div>
												</div>
											</div>
											
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=checklist_checklist_pameran';>
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
	include "lihat_checklist_pameran.php";
	
	$no_form = $_GET[id];
	$query = "SELECT * FROM checklist_pameran where no_pameran = '$no_form'";
                $hasil = mysql_query($query);
                $data  = mysql_fetch_array($hasil);
				
				
?>
			<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<!--section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Invoice</h1>
									<span class="mainDescription">Beautifully simple invoicing and payments. Give clients attractive invoices, estimates, and receipts.</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Pages</span>
									</li>
									<li class="active">
										<span>Invoice</span>
									</li>
								</ol>
							</div>
						</section-->
						<!-- end: PAGE TITLE -->
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
														<strong>No Form :</strong> <?php echo $data['no_pameran']; ?>
													</li>
													<li>
														<strong>Lokasi :</strong> <?php echo $data['lokasi_pameran']; ?>
													</li>
													<li>
														<strong>PIC :</strong> <?php echo $data['pic_pameran']; ?>
													</li>
													<li>
														<strong>Jenis :</strong> <?php echo $data['jenis_pameran']; ?>
													</li>
													<li>
														<strong>Periode :</strong> <?php echo $data['periode_pameran_awal'] .' s/d '. $data['periode_pameran_akhir']; ?>
													</li>
												</ul>
											</div>
										</div>
										<hr>
										<div class="row">
											<!--div class="col-sm-4">
												<h4>Client:</h4>
												<div class="well">
													<address>
														<strong class="text-dark">Customer Company, Inc.</strong>
														<br>
														1 Infinite Loop
														<br>
														Cupertino, CA 95014
														<br>
														<abbr title="Phone">P:</abbr> (123) 456-7890
													</address>
													<address>
														<strong class="text-dark">E-mail:</strong>
														<a href="mailto:#">
															info@customer.com
														</a>
													</address>
												</div>
											</div-->
											<!--div class="col-sm-4">
												<h4>We appreciate your business.</h4>
												<div class="padding-bottom-30 padding-top-10 text-dark">
													Thanks for being a customer.
													A detailed summary of your invoice is below.
													<br>
													If you have questions, we're happy to help.
													<br>
													Email support@cliptheme.com or contact us through other support channels.
												</div>
											</div-->
											
										</div>
										<div class="row">
											<div class="col-sm-12">
											
											<?php
											
											$data5=mysql_query("SELECT SUM(skp.bobot) AS bobobotz FROM standar_keputusan_pameran skp
											left join checklist_pameran_detail cpd on skp.standar_keputusan = cpd.standar_keputusan
											WHERE cpd.penilaian = 'Y' and cpd.no_pameran = '$no_form'");
											$sql5 = mysql_fetch_assoc($data5);
										
										
										?>
										
										
										<div role="alert" class="alert alert-info">
														
														
												<?php $rasio = ($sql5[bobobotz]/100) * 100; ?>
														<strong><h4><i class="ti-stats-up"></i> Pencapaian =   <?php echo round($rasio).'%'; ?></strong></h4>
													
													</div>
										
										<?php
										
										    $data=mysql_query("select * from standar_keputusan_pameran group by kategori_kontrol order by no");
										    $sql = $data;
										    $nomor = 0;
											$nomor2 = 0;
										    while($data = mysql_fetch_assoc($sql)){
										    
										    $kategori=$data[kategori_kontrol];
											$kategori2=$data[kategori_kontrol];
											
											if($kategori=="materi_promosi") {
												$kategori="MATERI PROMOSI"; 
											}
											if($kategori=="booth") {
												$kategori="BOOTH"; 
											}
											if($kategori=="unit_display") {
												$kategori="UNIT DISPLAY"; 
											}
											if($kategori=="sales_person") {
												$kategori="SALES PERSON"; 
											}
										    
											$data2=mysql_query("SELECT SUM(bobot) AS bobot FROM standar_keputusan_pameran WHERE kategori_kontrol = '$kategori2'");
											$sql2 = mysql_fetch_assoc($data2);
											
											$data3=mysql_query("SELECT SUM(skp.bobot) AS bobobotz FROM standar_keputusan_pameran skp
											left join checklist_pameran_detail cpd on skp.standar_keputusan = cpd.standar_keputusan
											WHERE skp.kategori_kontrol = '$kategori2' and cpd.penilaian = 'Y' and cpd.no_pameran = '$no_form'");
											$sql3 = mysql_fetch_assoc($data3);
											
                                            //$jumlah=2;
                                            //for($i=0; $i<$jumlah; $i++){;
                                            ?>
												
											<div class="panel panel-white collapses" id="panel5">
												<a data-original-title="Buka" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
												<div class="panel-heading">
													<h4 class="panel-title text-primary"><?php echo ucwords(strtolower($kategori)); ?></h4>
													<ul class="panel-heading-tabs border-light">
														
														<li class="panel-tools">
																<a data-original-title="Collapse" data-toggle="tooltip" data-placement="top" class="btn btn-transparent btn-sm panel-collapse" href="#"><i class="ti-minus collapse-off"></i><i class="ti-plus collapse-on"></i></a>
															
														</li>
													</ul>
												</div>
												</a>
												<div class="panel-body" style="display: none;">		
												
												
												<button type="button" class="btn btn-wide btn-primary btn-squared btn-o">
														Bobot = <?php echo $sql2[bobot]; ?>
													</button>
												
												<button type="button" class="btn btn-wide btn-primary btn-squared btn-o">
												<?php $rasio = ($sql3[bobobotz]/$sql2[bobot]) * 100; ?>
														Pencapaian = <?php echo round($rasio).'%'; ?>
													</button>
												
													<div class="table-responsive">
													<table class="table table-striped table-bordered">
													<thead>
														<tr style="font-weight: bold;">
															<td  class="hidden-480"> STANDAR KEPUTUSAN </td>
															<td align = "center"> BOBOT </td>
															<td align = "center"> STATUS </td>
															<td class="hidden-480"> KETERANGAN </td>
														</tr>
													</thead>
													<tbody>
													
													<?php
													$kueri=mysql_query("select cpd.*,skp.bobot from checklist_pameran_detail cpd 
													left join standar_keputusan_pameran skp on skp.standar_keputusan = cpd.standar_keputusan
													
													where cpd.kategori_kontrol = '$kategori2' and cpd.no_pameran = '$no_form'");
													
													while($data = mysql_fetch_assoc($kueri)){
													$nomor += 1;  
													$nomor2 += 1;
													?>
													<tr>
														<td> <?php echo $data[standar_keputusan]; ?> </td>
														<td align = "center"> <?php echo $data[bobot]; ?> </td>
														<td align = "center"> 
														<?php
														$penilaian = $data[penilaian];
															if ($penilaian=="Y"){
																echo "<i class='fa fa-check text-success'></i>";
															}else{
																echo "<i class='fa fa-close text-danger'></i>";
															}
															?> 
														</td>
														<td> <?php echo $data[keterangan]; ?> </td>
													</tr>
													
													<?php 
													}
													?>
													
													</tbody>
													</table>
													</div>
													
												</div>
											</div>
												
											<?php 
											}
											?>
											
											</div>
										</div>
										<div class="row">
											<?php
												$gambar = mysql_query("select * from checklist_pameran_foto where no_pameran = '$no_form' ");
												while ($gambar2 = mysql_fetch_array($gambar)){
													?>
												<div class="col-sm-3">		
													<img src="foto_pameran/medium_<?php echo $gambar2[foto_pameran]; ?>" alt="..." class="img-rounded img-responsive margin-bottom-15">
													
													
												</div>
							
											<?php		
												}
											?>
											
										
										</div>
										<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=<?php if(count($_POST)) { echo "history.go(-2)"; } else {echo "history.go(-1)";}?>>
											<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
										</button>
										<!--div class="row">
											<div class="col-sm-12 invoice-block">
												<br>
												<a href="javascript:window.print();" class="btn btn-lg btn-primary hidden-print">
													Cetak <i class="fa fa-print"></i>
												</a>
												<a class="btn btn-lg btn-primary btn-o hidden-print">
													Ubah <i class="fa fa-check"></i>
												</a>
											</div>
										</div-->
									</div>
								</div>
							</div>
						</div>
						<!-- end: INVOICE -->
					</div>
				</div>
			<!--
			javascript:printDiv('print-area-1');
			textarea id="printing-css" ></textarea>
			<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>

			<script>
			function printDiv(elementId) {
				var a = document.getElementById('printing-css').value;
				var b = document.getElementById(elementId).innerHTML;
				window.frames["print_frame"].document.title = document.title;
				window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
				window.frames["print_frame"].window.focus();
				window.frames["print_frame"].window.print();
			}
			</script-->


<?php				
	
	break;
		}	
		}
?>

				