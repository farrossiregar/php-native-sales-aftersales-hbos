	<?php 
		
		include "../../config/koneksi_sqlserver.php";
		include "../../config/koneksi_service.php";
		if(count($_POST)) {
                            
                        // Cek username di database
						$kode_supervisor = $_POST['kode_supervisor'];
						$no_spk = $_POST['no_spk'];
							
						//$bulan = $_POST['bulan'];
                        $sql=mysql_query("select * from incentive_sales");
						/*$query3 = "select * ,substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,
						convert(varchar,tglappfakpol,105) as tgl_faktur,
						convert(varchar,tgl_spk,105) as tgl_spk 
						from vw_Insentifsos where substring(convert(varchar,tglappfakpol,105),4,7) ='04-2018' and kode_supervisor ='SUDI' and nama_sales='ARISSWARI'";
						*/
						
							
						$cek_spk=mysql_num_rows(mysql_query("SELECT no_spk FROM incentive_sales where no_spk = $no_spk"));
							
							
							// Kalau username sudah ada yang pakai
						if ($cek_spk > 0){
						  $msg = "							
							<div class='alert alert-warning alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-warning'></i> Peringatan!</h4>
							Target di bulan ini sudah ada.</div>";
						}else{
						
							$nomor = 0;		
							for ($i = 0; $i < 8; $i++){
							//for ($i = 0; $i<count($no_spk); $i++){
							//$result = sqlsrv_query($conn, $query3);
												
							//while($data = sqlsrv_fetch_array($result)){
							//while($data = mysql_fetch_assoc($sql)){
								$nomor += 1; 
								
								$nama_mobil = $_POST['nama_mobil'.$nomor];
								$point = $_POST['point'.$nomor];
								$kode = $_POST['kode'.$nomor];
								$no_spk = $_POST['no_spk'.$nomor];
								$nama_sales = $_POST['nama_sales'.$nomor];
								$kode_supervisor = $_POST['kode_supervisor'.$nomor];
								$tgl_faktur = $_POST['tgl_faktur'.$nomor];
								$price_list = $_POST['price_list'.$nomor];
								$discount = $_POST['discount'.$nomor];
								$acc = $_POST['acc'.$nomor];
								$plafon = $_POST['plafon'.$nomor];
								
							
								// Kalau username valid, inputkan data ke tabel users
								
								  mysql_unbuffered_query("INSERT INTO `incentive_sales` (nama_mobil, kode, point, no_spk, nama_sales, kode_supervisor, tgl_faktur, price_list, discount, acc, plafon) 
									VALUES('$nama_mobil','$kode','$point','$no_spk','$nama_sales','$kode_supervisor','$tgl_faktur','$price_list','$discount','$acc','$plafon')");
								
								 //mysql_unbuffered_query("INSERT INTO `incentive_sales` (nama_mobil, kode, point, no_spk) 
									//VALUES('$nama_mobil[$i]','$kode[$i]','$point[$i]','$no_spk[$i]')");
									
									$msg = "
									<div class='alert alert-success alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
									<h4><i class='icon fa fa-check'></i> Selamat!</h4>
									Berhasil menambah Target. $no_spk</div>";   
								
							
							//tutup while  
							}						
						}
		                
					

					}

				
?>
				<script>
					function tgt_ins(){
						//alert("sadasfd");
						var isipd = $('#idinstarget').val();
						$.ajax({
							method : "post",
							url : "modul/master_data_showroom/get_data/get_data_insentif_sales.php",
							data : {data_ajax : isipd},
							success : function(data){
								//alert("sadasfd");
								$('#tampil_data_insentif_sales').html(data);
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
									<span class="mainDescription">Insentife Sales</span>
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
											Pilih Supervisor:
											</label>
												<select name="kode_supervisor" id="idinstarget" onchange="tgt_ins()" >
												<option value="">--PILIH--</option>
												 <?php
												 $a="SELECT * FROM supervisor";
												 $sql=mysql_query($a);
												 while($data=mysql_fetch_array($sql)){
												 ?>
												 <option value="<?php echo $data['kode_supervisor']?>"><?php echo $data['kode_supervisor']?></option>
												 <?php
												 }
												 ?>
												 </select>
										</div>

										<!--div class="col-md-12">
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
										</div-->
										
										<div class="col-md-12">
										<div id="tampil_data_insentif_sales">

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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=sub_master_target_insentif_sales';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
											</div>


									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
		
		
		
		
		
		
