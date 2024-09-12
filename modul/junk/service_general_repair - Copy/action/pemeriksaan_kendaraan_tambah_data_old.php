<script type="text/javascript" src="../../../assets/js/jquery.1.6.js"></script>
<script>

$(document).ready(function(){
	$('#src').click(function(){
		var nopolisi = $('#nopolisi').val();
		
		if (nopolisi != ""){
			$(".preload-wrapper3").show();
			$.ajax({
					method : "post",
					url : "modul/service_general_repair/action/pemeriksaan_kendaraan_tampil_data.php",
					data : 	'nopolisi='+nopolisi+
							
							'&data_konfirmasi_sms='+nopolisi,
					success : function(data){
						
						var hasil = JSON.parse(data);
						
						if (hasil['status']=="kosong"){
							swal({
								title: "Perhatian!",
								text: "Nomor Polisi Tidak Terdaftar",
								type: "warning",
								confirmButtonColor: "#007AFF"
							});
						}
						
						
						$('#model').val(hasil['model']);
						
						$('#tahunbuat').val(hasil['tahunbuat']);
						$('#odmeter').val(hasil['odmeterakhir']);
						
						$(".preload-wrapper3").fadeOut("slow");
					}
									
			})
		
		}
	})
	
	
	
	
	
					
		$('#tampil_tipe').click(function(){
			$.ajax({
				method : "post",
				url : "modul/service_general_repair/action/pemeriksaan_kendaraan_ajax_list_tipe.php",
				
				success : function(data){
					
					$('#modal').html(data);
					$("#modal").modal('show');
					//document.getElementById("search").focus();
					//console.log(data);
				}	
			})
		})			
})

					
					
					
					
					function post() {
						
						var table = document.getElementById("table_filter");
						var tbody = table.getElementsByTagName("tbody")[0];
						tbody.onclick = function (e) {
							e = e || window.event;
							var data = [];
							var target = e.srcElement || e.target;
							while (target && target.nodeName !== "TR") {
								target = target.parentNode;
							}
							if (target) {
								var cells = target.getElementsByTagName("td");
								for (var i = 0; i < cells.length; i++) {
									data.push(cells[i].innerHTML);
									dt = data.toString();
								
								}
							}
							
							dt = data.toString();
							dt_split = dt.split(",");
							
							
							
							$('#model').val(dt_split[1].trim());
										
						};
					}
					
					
					
					function format_angka(nilai) 
					{
						bk = nilai.replace(/[^\d]/g,"");
							ck = "";
							panjangk = bk.length;
							j = 0;
							for (i = panjangk; i > 0; i--) 
							{
								j = j + 1;
								if (((j % 3) == 1) && (j != 1)) 
								{
									ck = bk.substr(i-1,1) + "." + ck;
									xk = bk;
								} 
								else 
								{
									ck = bk.substr(i-1,1) + ck;
									xk = bk;
								}
							}
							return ck;
						
					}
</script>
				
			
				
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">General Repair</h1>
									<span class="mainDescription">History Service</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">                                 
                                    
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="modul/Aksesoris/simpan_buat_permohonan.php" onsubmit="return cek_inputan()">
										<div class="row">
											<div class="col-md-12">
											<?php echo(isset ($msg) ? $msg : ''); ?>
												<div class="errorHandler alert alert-danger no-display">
													<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
												</div>
												<div class="successHandler alert alert-success no-display">
													<i class="fa fa-ok"></i> Your form validation is successful!
												</div>
											</div>
											<div class="col-md-12">
												<fieldset>
													<legend>Data Kendaraan</legend>
													
												    <div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">
																	Tgl Datang <span class="symbol required"></span>
																</label>
																<p class="input-group input-append datepicker date " data-date-format="dd-mm-yyyy">
																	<input class="form-control" id="tanggal" readonly="" name="tanggal" value="<?php echo date("d-m-Y"); ?>" required="" type="text">
																	<span class="input-group-btn">
																		<button type="button" class="btn btn-default">
																			<i class="glyphicon glyphicon-calendar"></i>
																		</button> </span>
																</p>
															</div>
														</div>
														<div class="col-md-2">												  
															<div class="form-group">
																<label class="control-label">
																	No Polisi <span class="symbol required"></span>
																</label>
																<div class="input-group">
																	<input class="form-control" type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase(); $('#src').click();" placeholder="B-199-PP" class="form-control" id="nopolisi" name="nopolisi" required >
																	<span class="input-group-btn">
																		<button type="button" id="src" class="btn btn-primary">
																			<i class="fa fa-check"></i>
																		</button>
																	</span>
																</div>
															</div>
														</div>	
														<div class="col-md-2">
															<div class="form-group">
																	<label for="form-field-select-2">
																		Model <span class="symbol required"></span>
																	</label>
																	<div class="input-group">																	
																		<input type="text"  class="form-control" value="" id="model" name="model" required >
																		<span class="input-group-btn">
																			<button type="button" id="tampil_tipe" class="btn btn-primary">
																				<i class="fa fa-search"></i>
																			</button>
																		</span>
																	</div>
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">
																		Tahun <span class="symbol required"></span>
																	</label>
																	<input type="text"  class="form-control" value="" id="tahunbuat" name="tahunbuat" required  />
															
																
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">
																		Odometer <span class="symbol required"></span>
																	</label>
																	<input type="text"  class="form-control" value="" id="odmeter" name="tahunbuat" required onkeypress="return hanyaAngka(event)" onFocus="startCalc();" onBlur="stopCalc();" onkeyup="this.value=format_angka(this.value);"  />
															
																
															</div>
														</div>
														
														
													</div>	
												</fieldset>
												
												
												
											</div>
											<div class="col-md-6">
												<fieldset>
													<legend>Kelengkapan</legend>
													<?php  
														$kelengkapan = array("STNK","Buku Service","Tool Set","Dongkrak","Dop Roda","Ban Cadangan");
													?>
													
														<div class="table-responsive">
															<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
																	<tbody>
																		<tr><th width="5%">KELENGKAPAN</th><th width="1%">CHECK</th><th width="30%">KONDISI</th></tr>
																		
																			<?php 
																				$no = 0;
																				foreach($kelengkapan as $data){
																					$no++;
																					
																					echo "<tr><td>$data</td>";
																			?>
																					
																					<td><div class="checkbox clip-check check-primary checkbox-inline" style="line-height: 10px;">
																								<input id="<?php echo "$data$no" ?>" value="Y" name="<?php echo "status$no" ?>" type="checkbox"  >
																								<label for="<?php echo "$data$no" ?>">
																									
																								</label>
																							</div>
																					</td>
																					<td><input type = "text" class="form-control" name="<?php echo "kondisi$no" ?>" /></td>
																					</tr>
																			<?php } ?>
																		
																		
																	</tbody>
															</table>
														</div>	
												</fieldset>
											</div>
											<div class="col-md-6">
												<fieldset>
													<legend>Battery</legend>
													<div class="radio clip-radio radio-primary radio-inline">
														<input id="radio7" name="radio10" value="radio10" type="radio">
														<label for="radio7">
															Good
														</label>
													</div>
													<div class="radio clip-radio radio-warning radio-inline">
														<input id="radio9" name="radio10" value="radio10"  type="radio">
														<label for="radio9">
															Good & Recharge
														</label>
													</div>
													<div class="radio clip-radio radio-danger radio-inline">
														<input id="radio10" name="radio10" value="radio10"  type="radio">
														<label for="radio10">
															Bad & Replace
														</label>
													</div>
												</fieldset>
												
												<?php $sisi = array("depan","belakang") ;
													$no_sisi = 0;
													foreach($sisi as $data_sisi){
														$no_sisi = 0;
														
												
												?>
												<fieldset>
													<legend><?php echo ($data_sisi == "depan" ? "Ban Depan" : "Ban Belakang" ); ?></legend>
													<div class="table-responsive">
													<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
															<tbody>
															<tr><th width="5%">SISI</th><th width="3%">TEBAL</th><th width="10%">KONDISI</th><th width="10%">KETERANGAN</th></tr>
															<?php $belakang = array("KIRI","KANAN"); 
																$no = 0;
																foreach($belakang as $data){
																	$no ++;
																	echo "<tr><td>
																		$data
																	</td>";
																	
															?>
																<td>
																	<input type = "text" size="2" style="height:34px;" name="<?php echo "tebal$data_sisi$data" ?>" /> mm
																</td>
																<td>
																	<div class="radio clip-radio radio-primary radio-inline">
																		<input id="<?php echo "baik$data_sisi$data"; ?>" name="<?php echo "kondisi$data_sisi$data"; ?>" value="BAIK"  type="radio">
																		<label for="<?php echo "baik$data_sisi$data"; ?>">
																			Baik
																		</label>
																	</div>
																	<div class="radio clip-radio radio-danger radio-inline">
																		<input id="<?php echo "tidak$data_sisi$data"; ?>" name="<?php echo "kondisi$data_sisi$data"; ?>" value="TIDAK BAIK"  type="radio">
																		<label for="<?php echo "tidak$data_sisi$data"; ?>">
																			Tidak
																		</label>
																	</div>
																</td>
																<td>
																	<input type = "text" class="form-control" name="<?php echo "keterangan$data_sisi$data" ?>" />
																</td>
															</tr>
															
																<?php } ?>
															</tbody>
													</table>
													</div>
												</fieldset>
													<?php } ?>
											</div>
											
										
										</div>
										<div class="row">											
											<div class="col-md-6">
												<fieldset>
																<legend>Keluhan</legend>
																<div class="form-group">
															<div class="note-editor">
																<textarea class="form-control" id="keluhan" name="keluhan"></textarea>
															</div>
														</div>
															</fieldset>
												
											</div>
											<div class="col-md-6">
												<fieldset>
																<legend>Catatan</legend>
																<div class="form-group">
															<div class="note-editor">
																<textarea class="form-control" id="catatan" name="catatan"></textarea>
															</div>
														</div>
															</fieldset>
												
											</div>
										</div>
										
										<div class="row">											
											<div class="col-md-6">
												<fieldset>
																<legend>Bunyi Bunyi</legend>
																<div class="form-group">
															<div class="note-editor">
																<textarea class="form-control" id="keluhan" name="keluhan"></textarea>
															</div>
														</div>
															</fieldset>
												
											</div>
											
										</div>
										
										
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>
		
		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onblur="reload();" onpageshow="focus">
							
				</div>
		
		
		
		
