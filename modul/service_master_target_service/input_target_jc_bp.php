	<?php 
		
		
		if(count($_POST)) {
                            
                        
                        $cek_bulan=mysql_num_rows(mysql_query
                                     ("SELECT bulan FROM jc_bp WHERE bulan='$bulan'"));
                        
                        
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
							
							$data=mysql_query("select * from master_jc_bp");
							$sql = $data;
							$number = 0;
							while($data = mysql_fetch_array($sql)){
							$number += 1; 
								$bulan = $_POST['bulan'];
								$nama_jc = $_POST['nama_jc'.$number];
								$rasio1 = $_POST ['rasio1'.$number];
								$rasio2 = $_POST ['rasio2'.$number];
									
								
								//mysql_unbuffered_query("INSERT INTO target_pmpackagedua (rasio2,nama_item,kode_kategori,nama_kategori,target_unit,target_point,bulan,program,urutan) 
								//VALUES ('$rasio2','$nama_item','$kode_kategori','$nama_kategori','$target_unit','$target_point','$bulan','$program','$urutan'");
								
								mysql_unbuffered_query("INSERT INTO jc_bp (nama_jc, rasio1, rasio2, bulan) 
								VALUES ('$nama_jc','$rasio1','$rasio2','$bulan')");
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
									<span class="mainDescription">Masukkan Target Job Control BP</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Service</span>
									</li>
									<li>
										<span>Master Data Service</span>
									</li>
									<li class="active">
										<span>Input Target Job Control BP</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
								    
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="media_showroom.php?module=service_master_target_service_target_jc_bp&act=buat">
										
										<div class="row">
										    <div class="col-md-12">
												<?php echo(isset ($msg) ? $msg : ''); ?>
										    </div>
										    	
										    <div class="col-md-4">
										        
										            <label class="control-label">
													Bulan <span class="symbol required"></span>
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
										
										    $data=mysql_query("select * from master_jc_bp");
										    $sql = $data;
										    $number = 0;
										    while($data = mysql_fetch_assoc($sql)){
										    $number ++;  
										        
										    
										    
										    
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
											    <input type="hidden" style="text-transform:uppercase" class="form-control" id="target" name="<?php echo 'bulan'.$number; ?>" value="<?php echo trim($data['bulan']); ?>" readonly required>
											    <input type="hidden" style="text-transform:uppercase" class="form-control" id="target" name="<?php echo 'ID'.$number; ?>" value="<?php echo trim($data['ID']); ?>" readonly required>
											<div class="col-md-2">
											    <label class="control-label">
													Nama <span class="symbol required"></span>
												</label>
												
											    <input type="text" style="text-transform:uppercase" class="form-control" id="target" name="<?php echo 'nama_jc'.$number; ?>" value="<?php echo trim($data['nama_jc']); ?>" readonly required>
											
									    	</div>

									    	<div class="col-md-2">
											    <label class="control-label">
														Rasio 1 <span class="symbol required"></span>
												</label>
												
											    <input type="text" style="text-transform:uppercase"  class="form-control" id="target" name="<?php echo 'rasio1'.$number; ?>" value="<?php echo trim($data['rasio1']); ?>"  required>
											
									    	</div>
									    	
									    	<div class="col-md-2">
									    		<div class="form-group">
													<label class="control-label">
														Rasio 2 <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase"  class="form-control" id="target" name="<?php echo 'rasio2'.$number; ?>" value="<?php echo trim($data['rasio2']); ?>" required>
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=service_master_target_service_target_jc_bp';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
											</div>
											
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
		
		
		
		
		
		
