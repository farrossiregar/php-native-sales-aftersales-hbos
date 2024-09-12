<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js">



</script>
<script>

$(document).ready(function(){
	$('#src').click(function(){
		var nopolisi = $('#nopolisi').val();
		
		if (nopolisi != ""){
			$(".preload-wrapper3").show();
			$.ajax({
					method : "post",
					url : "modul/general_repair/action/history_service_tampil_data.php",
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
						
						$('#norangka').val(hasil['norangka']);
						$('#nomesin').val(hasil['nomesin']);
						$('#tipe').val(hasil['tipe']);
						$('#warna').val(hasil['warna']);
						$('#tahunbuat').val(hasil['tahunbuat']);
						
						$('#nama').val(hasil['nama']);
						$('#alamat').val(hasil['alamat']);
						$('#kelurahan').val(hasil['kelurahan']);
						$('#kecamatan').val(hasil['kecamatan']);
						$('#kota').val(hasil['kota']);
						$('#kodepos').val(hasil['kodepos']);
						$('#noktp').val(hasil['noktp']);
						$('#nohp').val(hasil['nohp']);
						$('#nohp2').val(hasil['nohp2']);
						$('#namapic').val(hasil['namapic']);
						$('#nohppic').val(hasil['nohppic']);
						
						
						if (hasil['agama'] == "3"){
							$('#agama').val("ISLAM");
							
						}else if (hasil['agama'] == "4"){
							$('#agama').val("KATOLIK");
						}
						else if (hasil['agama'] == "1"){
							$('#agama').val("BUDHA");
						}
						else if (hasil['agama'] == "2"){
							$('#agama').val("HINDU");
						}
						else if (hasil['agama'] == "6"){
							$('#agama').val("KONGHUCU");
						}else if (hasil['agama'] == "5"){
							$('#agama').val("KRISTEN");
							
						}else{
							$('#agama').val("");
							
						}
						
						$.ajax({
							method : "post",
							url : "modul/general_repair/action/history_service_listhistory.php",
							data : 	'nopolisi='+nopolisi,
							success : function(data){
								
								$('#detailhistory').html(data)
								$(".preload-wrapper3").fadeOut("slow");
							}
						})
						
					}
									
			})
		
		}
	})
	
	
	$('#btnlihatdetailhistory').click(function(){
		var nopolisi = $('#nopolisi').val();
		var norangka = $('#norangka').val();
		if (norangka != ""){
			$(".preload-wrapper3").show();
			$.ajax({
				method : "post",
				url : "modul/general_repair/action/history_service_tampildetailhistory.php",
				data : 	'nopolisi='+nopolisi,
				success : function(data){
					$("#Modal2").modal('show');
					$('#myModal2Label').html("Detail History Kendaraan");

					$('#tampildetailhistory').html(data);
					$(".preload-wrapper3").fadeOut("slow");
				}
			})
		}
		
	
	
	})
	
})
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
														<div class="col-md-6">												  
															<div class="form-group">
																<label class="control-label">
																	No Polisi <span class="symbol required"></span>
																</label>
																<div class="input-group">
																	<input class="form-control" type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase(); $('#src').click();" placeholder="B-199-PP" class="form-control" id="nopolisi" name="nopolisi" required >
																	<span class="input-group-btn">
																		<button type="button" id="src" class="btn btn-primary">
																			<i class="fa fa-search"></i>
																		</button>
																	</span>
																</div>
															</div>
														</div>	
														<div class="col-md-3">
															<div class="form-group">
																<label class="control-label">
																		Tahun Pembuatan <span class="symbol required"></span>
																	</label>
																	<input type="text"  class="form-control" value="" id="tahunbuat" name="tahunbuat" required  />
															
																
															</div>
														</div>
													</div>	
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	No Rangka <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="No Rangka" class="form-control" id="norangka" name="norangka" required >
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	No Mesin <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="No Mesin" class="form-control" id="nomesin" name="nomesin" required >
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																	<label for="form-field-select-2">
																		Tipe <span class="symbol required"></span>
																	</label>	
																	<input type="text"  class="form-control" value="" id="tipe" name="tipe_mobil" required >
																	
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																		Warna <span class="symbol required"></span>
																	</label>
																	<input type="text"  class="form-control" value="" id="warna" name="warna" required  />
															
																
															</div>
														</div>
													</div>
													
												</fieldset>
												
												
												
											</div>
											<div class="col-md-12">
												<fieldset>
													<legend>Data Pelanggan</legend>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Nama Customer <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  class="form-control" id="nama" name="nama" required >
															</div>
														</div>
													
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Alamat <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  class="form-control" id="alamat" name="alamat" required >
															</div>
														</div>
													</div>
													
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Kelurahan <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  class="form-control" id="kelurahan" name="kelurahan" required >
															</div>
														</div>
														<div class="col-md-6">	
															<div class="form-group">
																<label class="control-label">
																	Kecamatan <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  class="form-control" id="kecamatan" name="kecamatan" required >
															</div>
														</div>	
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Kota  <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  class="form-control" id="kota" name="kota" required >
															</div>
														</div>
														<div class="col-md-6">
													
															<div class="form-group">
																<label class="control-label">
																	Kode Pos <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  class="form-control" id="kodepos" name="kodepos" required >
															</div>
														</div>
														
													</div>
													<div class="row">		
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Nomor KTP <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  class="form-control" id="noktp" name="noktp" required >
															</div>
														</div>
														<div class="col-md-6">	
															<div class="form-group">
																<label class="control-label">
																	Nomor Hp <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  class="form-control" id="nohp" name="nohp" required >
															</div>
														</div>	
													</div>	
													<div class="row">		
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Nomor Hp 2 <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  class="form-control" id="nohp2" name="nohp2" required >
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Contact Via <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  class="form-control" id="namapic" name="namapic" required >
															</div>
														</div>
													</div>
													<div class="row">		
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Telp <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  class="form-control" id="nohppic" name="nohppic" required >
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label">
																	Agama <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  class="form-control" id="agama" name="agama" required >
															</div>
														</div>
													</div>	
												
											
											</fieldset>
												
											</div>
											
											
											<div class="col-md-12">
												<fieldset>
													<legend>History Service</legend>
													<div class="row">
														
														
														
														<div class = "table-responsive" style="overflow:scroll;height:300px;" >
															<table class="table table-striped table-bordered table-hover table-full-width"  >
																<thead>
																	<tr>
																		<th width="10%">No</th>
																		<th>No WO</th>
																		<th>Tgl WO</th>
																		<th>Keluhan</th>
																		<th>Od Meter</th>
																		
																		
																	</tr>
																</thead>
																<tbody id="detailhistory">
																	
																	
																	
																</tbody>
															</table>
														</div>
														
														
														
													</div>
													
													
													
												</fieldset>
											</div>
										
										</div>
										
										<div class="row">											
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="button" id="btnlihatdetailhistory">
													<i class="fa fa-search"></i> Lihat Detail History
												</button>
												
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>
		
		<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onpageshow="focus">
		
		
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header" style="background-color: white;">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='exit_modal();'>
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModal2Label"></h4>
					</div>
					<div class="modal-body" style="background-color: white;" id = 'tampildetailhistory'>
						
						
						
						
						
						
						
					</div>
				</div>
								
			</div>
		
		
							
		</div>
		
		
		
		
