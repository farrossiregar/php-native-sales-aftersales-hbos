<?php 
	if(count($_POST)) {
                            
                        // Cek username di database
                        $data=mysql_query("select * from incentive_sales");
					    $sql = $data;
						$nomor = 0;
						while($data = mysql_fetch_array($sql)){
						$nomor += 1; 
                        $nama_mobil = $_POST['nama_mobil'.$nomor];
                        $point = $_POST['point'.$nomor];
						$kode = $_POST['kode'.$nomor];
						$no_spk = $_POST['no_spk'.$nomor];
						$nama_sales = $_POST['nama_sales'.$nomor];
						$kode_supervisor = $_POST['kode_supervisor'.$nomor];
						$tgl_faktur = $_POST['tgl_faktur'.$nomor];
                        $price_list = $_POST['price_list'.$nomor];
						$discount = $_POST['discount'];
                        $acc = $_POST['acc'];
						$plafon = $_POST['plafon'.$nomor];
                        
                        
                        $cek_no_spk=mysql_num_rows(mysql_query("SELECT no_spk FROM incentive_sales"));
                        
                        // Kalau username sudah ada yang pakai
                        if ($cek_no_spk > 0){
                          $msg = "							
							<div class='alert alert-warning alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-warning'></i> Peringatan!</h4>
							Target di bulan ini sudah ada.</div>";
                        }
                        // Kalau username valid, inputkan data ke tabel users
                        else{
						  mysql_unbuffered_query("INSERT INTO `incentive_sales` (nama_mobil, kode, point, no_spk, nama_sales, kode_supervisor, tgl_faktur, price_list, discount, acc, plafon) 
							VALUES('$nama_mobil','$kode','$point','$no_spk','$nama_sales','$kode_supervisor','$tgl_faktur','$price_list','$discount','$acc','$plafon')");
							
							$msg = "
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil menambah Target.</div>";   
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
							url : "modul/master_data_showroom/get_data/get_data_insentif_sales.php",
							data : {data_ajax : isipd},
							success : function(data){
								//alert("sadasfd");
								$('#tampil_data_sa_bp').html(data);
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
										<?php echo(isset ($msg) ? $msg : ''); ?>
									</div>
								<div class="col-md-3">
								    
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="">
										
										<div class="form-group">
												<label class="control-label">
													Pilih Supervisor <span class="symbol required"></span>
												</label>
													<select class = 'form-control' name="kode_supervisor" id="kode_supervisor" onchange = "getSales();">
													<option value="">--PILIH--</option>
													 <?php
													 $a="SELECT * FROM `supervisor`";
													 $sql=mysql_query($a);
													 while($data=mysql_fetch_array($sql)){
													 ?>
													 <option value="<?php echo $data['kode_supervisor']; ?>" <?php echo ($data['kode_supervisor'] == $_GET['kode_supervisor'] ? 'selected' : '') ?>><?php echo $data['kode_supervisor']?></option>
													 <?php } ?>
													 </select>
													 
											</div>
										
										<div class="form-group">
												<label class="control-label">
													Pilih Periode <span class="symbol required"></span>
												</label>
												<div class="input-group input-daterange datepicker" data-date-format='dd-mm-yyyy'>
													<input class="form-control" type="text" id="tgl_awal" name="tgl_awal" value ="<?php echo $_GET[tgl_awal]; ?>" readonly>
														<span class="input-group-addon bg-primary">s/d</span>
													<input class="form-control" type="text" id="tgl_akhir" name="tgl_akhir" value ="<?php echo $_GET[tgl_akhir]; ?>" readonly>
												</div>
											</div>
										
								</div>
										
										<?php 

											$tgl_awal = $_GET['tgl_awal'];
											$tgl_akhir = $_GET['tgl_akhir'];
											$kode_supervisor = $_GET['kode_supervisor'];
											
											if($waktu_booking != "-") { 
												$query = "select count(nomor) as total, convert(varchar,tglappfakpol()105) as tgl_faktur from vw_Insentifsos where convert(varchar,tglappfakpol()105) >= '$tgl_awal' and convert(varchar,tglappfakpol()105) <= '$tgl_akhir' and kode_supervisor = '$kode_supervisor'";
												
												$result = sqlsrv_query($conn, $query);		
												
												
												while($data_faktur = sqlsrv_fetch_array($result)){
													$ada_record = $data_faktur['total'];
												}
										?>
										
										<?php
										
										include "config/koneksi_sqlserver.php";
										include "../config/koneksi_service.php";
											$tgl_akhir_doank = substr($_GET['tgl_akhir'],8,2); 
											$tgl_awal_doank = substr($_GET['tgl_awal'],8,2); 
											$nomor = 1;
											//$query3 = "select *, convert(varchar,tglappfakpol()105) as tgl_faktur from vw_Insentifsos where nama_sales !='office' and kode_supervisor ='SUDI' and 
											//convert(varchar,tglappfakpol()105) >= '2017-12-01' and convert(varchar,tglappfakpol()105) <= '2017-12-30'"; 
											$query3 = ("select * ,substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,
											convert(varchar,tglappfakpol,105) as tgl_faktur,
											convert(varchar,tgl_spk,105) as tgl_spk 
											from vw_Insentifsos where substring(convert(varchar,tglappfakpol,105),4,7) ='04-2018' and kode_supervisor ='SUDI' and nama_sales='ARISSWARI'");
											
											/*$query3 = "select * ,substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,convert(varchar,tglappfakpol,105) as tgl_faktur,convert(varchar,tgl_spk,105) as tgl_spk 
											from vw_Insentifsos where kode_supervisor ='SUDI'
											and nama_sales='ARISSWARI' "; 
											*/
											$result = sqlsrv_query($conn, $query3);		
											while($data_faktur = sqlsrv_fetch_array($result)){
										    
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
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'nama_mobil'.$nomor; ?>" value="<?php echo trim($data_faktur[nama_mobil]); ?>" readonly required>
											</div>
											<div class="col-md-2">
											    <label class="control-label">
														Point <span class="symbol required"></span>
												</label>
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'point'.$nomor; ?>" value="<?php echo trim($data_faktur[point]); ?>" readonly required>
											</div>
											<div class="col-md-2">
											    <label class="control-label">
														Kode <span class="symbol required"></span>
												</label>
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'kode'.$nomor; ?>" value="<?php echo trim($data_faktur[kode_model]); ?>" readonly required>
											</div>
											<div class="col-md-2">
											    <label class="control-label">
														Nomor Spk <span class="symbol required"></span>
												</label>
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'no_spk'.$nomor; ?>" value="<?php echo trim($data_faktur[nomor]); ?>" readonly required>
											</div>
											
											<div class="col-md-2">
											    <label class="control-label">
													Nama Sales <span class="symbol required"></span>
												</label>
												
											    <input type="text" style="text-transform:uppercase" class="form-control"  name="<?php echo 'nama_sales'.$nomor; ?>" value="<?php echo trim($data_faktur['nama_sales']); ?>" readonly required>
											</div>
											<div class="col-md-2">
											    <label class="control-label">
													Kode Spv <span class="symbol required"></span>
												</label>
												
											    <input type="text" style="text-transform:uppercase" class="form-control"  name="<?php echo 'kode_supervisor'.$nomor; ?>" value="<?php echo trim($data_faktur['kode_supervisor']); ?>" readonly required>
											</div>
											<div class="col-md-2">
											    <label class="control-label">
													Tgl Faktur <span class="symbol required"></span>
												</label>
												
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'tgl_faktur'.$nomor; ?>" value="<?php echo trim($data_faktur[tgl_faktur]); ?>" readonly required>
											</div>
											<div class="col-md-2">
											    <label class="control-label">
														Price List <span class="symbol required"></span>
												</label>
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'price_list'.$nomor; ?>" value="<?php echo trim($data_faktur[hargatotal]); ?>" readonly required>
											</div>
											<div class="col-md-2">
											    <label class="control-label">
														Discount <span class="symbol required"></span>
												</label>
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'discount'.$nomor; ?>" value="<?php echo trim($data_faktur[discount]); ?>" readonly required>
											</div>
											<div class="col-md-2">
											    <label class="control-label">
														Acc <span class="symbol required"></span>
												</label>
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'acc'.$nomor; ?>" value="<?php echo trim($data_faktur[discaccs]); ?>" readonly required>
											</div>
											<div class="col-md-2">
											    <label class="control-label">
														Plafon <span class="symbol required"></span>
												</label>
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'plafon'.$nomor; ?>" value="<?php echo trim($data_faktur[plafon]); ?>" readonly required>
											</div>
										
									    	<?php
                                            }
                                            ?>
									    	
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Harus diisi
													
												</div>
											</div>
																						
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="submit" id="gar-contact-button">
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
<?php } ?>