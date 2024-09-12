	<?php 
		
		
		if(count($_POST)) {
                        
                        $cek_bulan=mysql_num_rows(mysql_query ("SELECT bulan FROM target_semua_sa where bulan = '$bulan'"));
                        
                        
                        // Kalau username sudah ada yang pakai
                        if ($cek_bulan > 0){
                          $msg = "							
							<div class='alert alert-warning alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-warning'></i> Peringatan!</h4>
							Target di bulan ini sudah ada.</div>";
                        }
                        // Kalau username valid, inputkan data ke tabel users
                        else{
							
							$data=mysql_query("select * from master_target_sa");
							$sql = $data;
							$nomor = 0;
							while($data = mysql_fetch_array($sql)){
								$nomor += 1; 
								$bulan = $_POST['bulan'];
								$target_unit = $_POST['target_unit'.$nomor];
								$target_point = $_POST['target_point'.$nomor];
								$kode_item = $_POST['kode_item'.$nomor];
								$nama_item = $_POST['nama_item'.$nomor];
								$kode_kategori = $_POST['kode_kategori'.$nomor];
								$nama_kategori = $_POST['nama_kategori'.$nomor];
								$program = $_POST['program'.$nomor];
								$urutan = $_POST['urutan'.$nomor];
								$fix_pembagi = $_POST ['fix_pembagi'.$nomor];
								
								
								mysql_unbuffered_query("insert into target_semua_sa (target_unit, target_point, nama_item, kode_item, kode_kategori,nama_kategori,urutan,bulan,program,fix_pembagi) 
								values ('$target_unit','$target_point','$nama_item','$kode_item','$kode_kategori','$nama_kategori','$urutan','$bulan','$program','$fix_pembagi')
								");
								
								
							}	
								$msg = "
								<div class='alert alert-success alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								<h4><i class='icon fa fa-check'></i> Selamat!</h4>
								Berhasil menambah Target.</div>";   
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
									<span class="mainDescription">Masukkan Target Service Advisor</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Service</span>
									</li>
									<li>
										<span>Master Data Service</span>
									</li>
									<li class="active">
										<span>Input Target Service Advisor</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
								    
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="media_showroom.php?module=service_master_target_service_target_inc&act=buat">
										
										<div class="row">
										    <div class="col-md-12">
										    <?php echo(isset ($msg) ? $msg : ''); ?>
										    </div>
										    	
										    <div class="col-md-4">
										        
										            <label class="control-label">
													Periode <span class="symbol required"></span>
												    </label>
														<p class="input-group input-append datepicker date" data-date-format='mm-yyyy'>
														<input class="form-control" type="text" id="bulan" name="bulan" required >
														<span class="input-group-btn">
															<button type="button" class="btn btn-default">
																<i class="glyphicon glyphicon-calendar"></i>
															</button> </span>
													</p>
											</div>
									    </div>
										</div>
										
										
										
										<?php
											$data=mysql_query("select * from master_target_sa order by urutan");
										    $sql = $data;
										    $nomor = 0;
										    while($data = mysql_fetch_assoc($sql)){
										    $nomor ++;  
										        
										    
										    
										    
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
											
											
											<div class="row">
											
											 <input type="hidden" name="<?php echo 'urutan'.$nomor; ?>" value="<?php echo trim($data['urutan']) ; ?>" >
											 <input type="hidden" name="<?php echo 'nama_kategori'.$nomor; ?>" value="<?php echo trim($data['nama_kategori']); ?>">
											 
											<div class="col-md-2">
											    <label class="control-label">
													Kategori <span class="symbol required"></span>
												</label>
												
											    <input type="text" style="text-transform:uppercase" class="form-control" id="target" name="<?php echo 'kode_kategori'.$nomor; ?>" value="<?php echo trim($data['kode_kategori']); ?>" readonly required>
											
									    	</div>

									    	<div class="col-md-2">
											    <label class="control-label">
														Kode Item <span class="symbol required"></span>
												</label>
												
											    <input type="text" style="text-transform:uppercase"  class="form-control" id="target" name="<?php echo 'kode_item'.$nomor; ?>" value="<?php echo trim($data['kode_item']); ?>"  required>
											
									    	</div>
									    	
									    	<div class="col-md-2">
									    		<div class="form-group">
													<label class="control-label">
														Nama Item <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase"  class="form-control"name="<?php echo 'nama_item'.$nomor; ?>" value="<?php echo trim($data['nama_item']); ?>" required>
												</div>
									    	</div>

											<div class="col-md-2">
									    		<div class="form-group">
													<label class="control-label">
														Program <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase"  class="form-control" name="<?php echo 'program'.$nomor; ?>" value="<?php echo trim($data['program']); ?>" required>
												</div>
									    	</div>
											<div class="col-md-2">
									    		<div class="form-group">
													<label class="control-label">
														Pembagi <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase"  class="form-control" name="<?php echo 'fix_pembagi'.$nomor; ?>" value="<?php echo trim($data['fix_pembagi']); ?>" required>
												</div>
									    	</div>
											
									    	<div class="col-md-2">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																Target Unit <span class="symbol required"></span>
															</label>
															<input type="text" onkeypress="return hanyaAngka(event)" class="form-control" size="3" id="target" name="<?php echo 'target_unit'.$nomor; ?>" value="<?php echo ceil($data['target_unit']); ?>" required>
														</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																Target Point <span class="symbol required"></span>
															</label>
															<input type="text" onkeypress="return hanyaAngka(event)" class="form-control" size="3" id="target" name="<?php echo 'target_point'.$nomor; ?>" value="<?php echo $data['target_point']; ?>" required>
														</div>
													</div>
												</div>
									    	</div>
											
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=service_master_target_service_target_inc';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
											</div>
											
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
		
		
		
		
		
		
