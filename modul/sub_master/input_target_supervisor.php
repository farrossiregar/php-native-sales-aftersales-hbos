
			
	<?php 
		
		
		if(count($_POST)) {
                            
                        // Cek username di database
                        $data=mysql_query("select * from supervisor");
					    $sql = $data;
						$nomor = 0;
						while($data = mysql_fetch_assoc($sql)){
						$nomor += 1; 
                        $bulan = $_POST['bulan'];
                        $spv = $_POST['spv'.$nomor];
                        $targetunit = $_POST['targetunit'.$nomor];
                        $targetpoin = $_POST['targetpoin'.$nomor];
                        $warna = $_POST['warna'.$nomor];
                        
                        /*$jumlah=11;
                        for($i=0; $i<$jumlah; $i++){
                        $urut = $i+1;
                        $bulan = $_POST['bulan'];
                        $model = $_POST['model'][$i];
                        $target = $_POST['target'][$i];*/
                        
                        /*mysql_unbuffered_query("insert into target_marketing69 (bulan, model, target) 
							values('$bulan','$model',$target)");
							
							$msg = "
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil menambah Target.
							</div>";*/
                        
                        
                        
                        
                        $cek_bulan=mysql_num_rows(mysql_query
                                     ("SELECT bulan FROM target_spv
                                       WHERE bulan='$bulan' and kode_spv='$spv'"));
                        
                        
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
                          mysql_unbuffered_query("insert into target_spv (bulan, kode_spv, target_unit, target_point, warna) 
							values('$bulan','$spv',$targetunit,$targetpoin,'$warna')");
							
							$msg = "
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil menambah Target.</div>";   
                        }
                             
						}
		                
						/*
						if(mysql_num_rows($query)==0){
							mysql_unbuffered_query("insert into target_marketing (bulan,brio, br-v, city, civic, cr-z, cr-v, accord, odyssey, jazz, hr-v, mobilio ) 
							values('$_POST[bulan]','$_POST[brio]','$_POST[brv]','$_POST[city]','$_POST[civic]','$_POST[crz]','$_POST[crv]','$_POST[accord]','$_POST[odyssey]','$_POST[jazz]','$_POST[hrv]','$_POST[mobilio]')");
							
							$msg = "
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil menambah target.</div>";
						}else{
							$msg = "							
							<div class='alert alert-warning alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-warning'></i> Peringatan!</h4>
							Target di bulan ini sudah ada.</div>";
						} */

					}

					
				
				
?>

		
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Input Data Perbulan</h1>
									<span class="mainDescription">Masukkan Target Supervisor</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li>
										<span>Master Data Showroom</span>
									</li>
									<li class="active">
										<span>Input Target Supervisor</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
								    
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="media_showroom.php?module=sub_master_target_penjualan_supervisor&act=buat">
										
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
										
										    $data=mysql_query("select * from supervisor");
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
														Model <span class="symbol required"></span>
												</label>
												
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'spv'.$nomor; ?>" value="<?php echo trim($data[kode_supervisor]); ?>" readonly required>
											
									    	</div>
									    	
									    	<div class="col-md-2">
									    		<div class="form-group">
													<label class="control-label">
														Target Unit <?php echo $i; ?><span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" onkeypress="return hanyaAngka(event)" placeholder="0" class="form-control" id="target" name="<?php echo 'targetunit'.$nomor; ?>" required>
												</div>
									    	</div>

									    	<div class="col-md-2">
									    		<div class="form-group">
													<label class="control-label">
														Target Poin <?php echo $i; ?><span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" onkeypress="return hanyaAngka(event)" placeholder="0" class="form-control" id="target" name="<?php echo 'targetpoin'.$nomor; ?>" required>
												</div>
									    	</div>

									    	<div class="col-md-2">
											    <label class="control-label">
														Warna <span class="symbol required"></span>
												</label>
												
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'warna'.$nomor; ?>" value="<?php echo trim($data[warna]); ?>" readonly required>
											
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=sub_master_target_penjualan_supervisor';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
											</div>
											
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
		
		
		
		
		
		
