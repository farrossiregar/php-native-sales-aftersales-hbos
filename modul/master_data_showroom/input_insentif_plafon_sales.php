
			
	<?php 
		
		
		if(count($_POST)) {
                            
                        // Cek username di database
                        $data=mysql_query("select * from incentive_plafon");
					    $sql = $data;
						$nomor = 0;
						while($data = mysql_fetch_assoc($sql)){
						$nomor += 1; 
                        $tahun_buat = $_POST['tahun_buat'];
                        $nama_mobil = $_POST['nama_mobil'.$nomor];
                        $jenis = $_POST['jenis'.$nomor];
						$kode = $_POST['kode'.$nomor];
                        $plafon = $_POST['plafon'.$nomor];
						$tgl_plafon_awal = $_POST['tgl_plafon_awal'];
                        $tgl_plafon_akhir = $_POST['tgl_plafon_akhir'];
						
                        
                        
                        $cek_tahun_buat=mysql_num_rows(mysql_query 
						//("SELECT tahun_buat FROM incentive_plafon WHERE tahun_buat='$tahun_buat' and tgl_plafon_awal >= '$tgl_plafon_awal' and tgl_plafon_akhir <= '$tgl_plafon_akhir'"));
                        ("SELECT tahun_buat FROM incentive_plafon WHERE tahun_buat='$tahun_buat' and tgl_plafon_awal = '$tgl_plafon_awal'"));
                        
                        // Kalau username sudah ada yang pakai
                        if ($cek_tahun_buat > 0 and $cek_tgl_plafon_awal > 0){
                          $msg = "							
							<div class='alert alert-warning alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-warning'></i> Peringatan!</h4>
							Target di bulan ini sudah ada.</div>";
                        }
                        // Kalau username valid, inputkan data ke tabel users
                        else{
						//INSERT INTO `incentive_plafon` (`nama_mobil`, `jenis`, `kode`, `tahun_buat`, `plafon`, `tgl_plafon_awal`, `tgl_plafon_akhir`, `no_urut`) 
						//VALUES ('', '', '', '', '', '', '', NULL);
                          mysql_unbuffered_query("insert into incentive_plafon (tahun_buat, nama_mobil, jenis, kode, plafon, tgl_plafon_awal, tgl_plafon_akhir) 
							values('$tahun_buat','$nama_mobil','$jenis','$kode','$plafon','$tgl_plafon_awal','$tgl_plafon_akhir')");
							
							$msg = "
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil menambah Target.</div>";   
                        }
                             
						}
		                
						

					}

					
				
				
?>

		
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Input Data Perbulan</h1>
									<span class="mainDescription">Masukkan Plafon Insentif Salaes</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li>
										<span>Master Data Showroom</span>
									</li>
									<li class="active">
										<span>Input Plafon Insentif</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
								    
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="media_showroom.php?module=sub_master_target_insentif_plafon&act=buat">
										
										<div class="row">
										    <div class="col-md-12">
										    <?php echo(isset ($msg) ? $msg : ''); ?>
										    </div>
										    	
										    <div class="col-md-2">
												<label class="control-label">
													YEAR <span class="symbol required"></span>
												</label>
												
												<input type="text" name="tahun_buat"  class="form-control" placeholder="Tanggal Pengajuan" value="<?php
												$tgl=date('Y');echo $tgl;
												?>"  required /><br><br>		
											</div>
											<div class="col-md-2">
												<label class="control-label">
													Tgl Plafon Awal <span class="symbol required"></span>
												</label>
												<input type="text" name="tgl_plafon_awal"  class="form-control" placeholder="Tanggal_awal" value="<?php
												$tgl_plafonawal=date('Y-m-d');echo $tgl_plafonawal;
												?>"  required /><br><br>		
											</div>
											<div class="col-md-2">
												<label class="control-label">
													Tgl Plafon Akhir <span class="symbol required"></span>
												</label>
												<input type="text" name="tgl_plafon_akhir"  class="form-control" placeholder="Tanggal_akhir" value="<?php
												$tgl_plafonakhir=date('Y-m-d');echo $tgl_plafonakhir;
												?>"  required /><br><br>		
											</div>
									    </div>
										</div>
										
										
										
										<?php
										
										    $data=mysql_query("select * from incentive_plafon");
										    $sql = $data;
										    $nomor = 0;
										    while($data = mysql_fetch_assoc($sql)){
										    $nomor += 1;  
										        
										    
										    
										    
                                            //$jumlah=2;
                                            //for($i=0; $i<$jumlah; $i++){;
                                            ?>
											
											<div class="col-md-12">
											
												<div class="errorHandler alert alert-danger no-display">
													<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
												</div>
												<div class="successHandler alert alert-success no-display">
													<i class="fa fa-ok"></i> Your form validation is successful!
												</div>
											</div>
											
											<div class="col-md-2">
											    <label class="control-label">
														Nama Mobil <span class="symbol required"></span>
												</label>
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'nama_mobil'.$nomor; ?>" value="<?php echo trim($data[nama_mobil]); ?>" readonly required>
											</div>
											<div class="col-md-2">
											    <label class="control-label">
														Kode <span class="symbol required"></span>
												</label>
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'kode'.$nomor; ?>" value="<?php echo trim($data[kode]); ?>" readonly required>
											</div>
											
											<div class="col-md-2">
											    <label class="control-label">
														Plafon <span class="symbol required"></span>
												</label>
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'plafon'.$nomor; ?>" value="<?php echo trim($data[plafon]); ?>" required>
											</div>
											
											<div class="col-md-2">
											    <!--label class="control-label">
														Jenis <span class="symbol required"></span>
												</label-->
											    <input type="hidden" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'jenis'.$nomor; ?>" value="<?php echo trim($data[jenis]); ?>" required>
											</div>
											
									    	<?php
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=sub_master_target_insentif_plafon';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
											</div>
											
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
