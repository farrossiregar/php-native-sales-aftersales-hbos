<?php 
		
		
		if(count($_POST)) {
                            
                        // Cek username di database
						$nama_sa = $_POST['nama_sa'];
						$bulan = $_POST['bulan'];
                        $sql=mysql_query("select * from master_target_sa");
						
						
						
						
						$cek_bulan=mysql_num_rows(mysql_query("SELECT bulan FROM target_serviceadvisor where nama_sa = '$nama_sa' and bulan = '$bulan'"));
							
							
							// Kalau username sudah ada yang pakai
						if ($cek_bulan > 0){
						  $msg = "							
							<div class='alert alert-warning alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-warning'></i> Peringatan!</h4>
							Target di bulan ini sudah ada.</div>";
						}else{
						
						
					   
							$nomor = 0;
							while($data = mysql_fetch_assoc($sql)){
								$nomor += 1; 
								
								$kode_item	= $_POST['kode_item'.$nomor];
								$nama_item = $_POST['nama_item'.$nomor];
								$kode_kategori = $_POST['kode_kategori'.$nomor];
								$nama_kategori = $_POST['nama_kategori'.$nomor];
								$target_unit = $_POST['target_unit'.$nomor];
								$target_point = $_POST['target_point'.$nomor];
								$program = $_POST['program'.$nomor];
								$urutan = $_POST['urutan'.$nomor];
								$fix_pembagi = $_POST['fix_pembagi'.$nomor];
								
								
								
								// Kalau username valid, inputkan data ke tabel users
								
							
								  mysql_unbuffered_query("insert into target_serviceadvisor (bulan,nama_sa,urutan,kode_item,nama_item,kode_kategori,nama_kategori,target_unit,target_point,program,fix_pembagi) 
									values('$bulan','$nama_sa','$urutan','$kode_item','$nama_item','$kode_kategori','$nama_kategori','$target_unit','$target_point','$program','$fix_pembagi')
									");
									
									$msg = "
									<div class='alert alert-success alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
									<h4><i class='icon fa fa-check'></i> Selamat!</h4>
									Berhasil menambah Target. $kode_sales</div>";   
								
							
							//tutup while  
							}						
						}
		                
					

					}

					
				
				
?>
				<script>
					function tgt_sa(){
						//alert("sadasfd");
						var isipd = $('#idsatarget').val();
						$.ajax({
							method : "post",
							url : "modul/service_master_target_service/get_data/get_data_sa.php",
							data : {data_ajax : isipd},
							success : function(data){
								//alert("sadasfd");
								$('#tampil_data_sa').html(data);
								//console.log(data);
								//console.log("MJJ");
								//$('#harga_otr').val(10000000);
							}
							
						})	
					}
				</script>
		
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Input Data Perbulan</h1>
									<span class="mainDescription">Masukkan Target SA</span>
								</div>
								
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
											Pilih Service Advisor :
											</label>
												<select name="nama_sa" id="idsatarget" onchange="tgt_sa()" >
												<option value="">--PILIH--</option>
												 <?php
												 $a="SELECT * FROM service_advisor";
												 $sql=mysql_query($a);
												 while($data=mysql_fetch_array($sql)){
												 ?>
												 <option value="<?php echo $data['nama_sa']?>"><?php echo $data['nama_sa']?></option>
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
										<div id="tampil_data_sa">

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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=service_master_target_service_target_sa';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
											</div>


									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
		
		
		
		
		
		
