
			
	<?php 
		
		
		if(count($_POST)) {
                            
                        // Cek username di database
						$spv = $_POST['spv'];
                        $data=mysql_query("
                        	select s.kode_sales, s.nama_sales, s.kode_supervisor, ss.nama_supervisor, s.grade  from salesman s 
                        	left JOIN supervisor ss on ss.kode_supervisor = s.kode_supervisor 
                        	where ss.kode_supervisor = '$spv' order by s.grade desc ");
					    $sql = $data;
						$nomor = 0;
						while($data = mysql_fetch_assoc($sql)){
						$nomor += 1; 
                        $bulan = $_POST['bulan'];
                        $kode_sales = $_POST['kode_sales'.$nomor];
                        $kode_supervisor = $data['kode_supervisor'];
                        $nama_sales = $data['nama_sales'];
                        $nama_supervisor = $data['nama_supervisor'];
                        $grade = $_POST['grade'.$nomor];
                        $target_unit = $_POST['target_unit'.$nomor];
                        $target_point = $_POST['target_point'.$nomor];
                        
                        /* SQL TEST TANPA CEK BULAN
                        mysql_unbuffered_query("insert into target_sales (bulan, kode_sales, nama_sales, kode_spv, nama_spv,grade,target_unit,target_point) 
							values('$bulan','$kode_sales','$nama_sales','$kode_supervisor','$nama_supervisor','$grade','$target_unit','$target_point')");
							
							$msg = "
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil menambah Target.  $bulan $nomor $spv $nama_supervisor $kode_supervisor $kode_sales $targetunit $targetpoin $nama_sales 
							</div>";
                        */
                        
                        
                        
                        $cek_bulan=mysql_num_rows(mysql_query
                                     ("SELECT bulan FROM target_sales
                                       WHERE bulan='$bulan' and kode_supervisor='$spv'"));
                        
                        
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
                          mysql_unbuffered_query("insert into target_sales (bulan, kode_sales, nama_sales, kode_spv, nama_spv,grade,target_unit,target_point) 
							values('$bulan','$kode_sales','$nama_sales','$kode_supervisor','$nama_supervisor','$grade','$target_unit','$target_point')");
							
							$msg = "
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil menambah Target. $kode_sales</div>";   
                        }
                        
                        //tutup while     
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
									<span class="mainDescription">Masukkan Target Salesman</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li>
										<span>Master Data Showroom</span>
									</li>
									<li class="active">
										<span>Input Target Salesman</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							
							<div class="row">

									<div class="col-md-12">
										<?php echo(isset ($msg) ? $msg : ''); ?>
									</div>
										</div>

							<div class="row">
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="">

										<div class="col-md-12">
										        
											<label class="control-label">
											Pilih Supervisor:
											</label>
												<select name="spv" id="idspvtarget" >
												<option value="">--PILIH--</option>
												 <?php
												 $a="SELECT * FROM supervisor where aktif = 'Y'";
												 $sql=mysql_query($a);
												 while($data=mysql_fetch_array($sql)){
												 ?>
												 <option value="<?php echo $data['kode_supervisor']?>"><?php echo $data['kode_supervisor']?></option>
												 <?php
												 }
												 ?>
												 </select>
										</div>

										<div class="col-md-12">
												<div class="row">
												    	
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
										
										<div class="col-md-12">
										<div id="tampil_data_sales">

										</div>
										</div>
									    	
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Harus diisi
													<hr>
												</div>
											</div>
											
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="submit" id="simpan" name="simpan">
													<i class="fa fa-save"></i> Simpan
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=sub_master_target_penjualan_salesman';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
											</div>


									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
		
		
		
		
		
		
