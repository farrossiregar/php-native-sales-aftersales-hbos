
				<script>
					function puk(){
					
							var isipd = $('#nospk').val();
								
								$.ajax({
									method : "post",
									url : "modul/logistik/action/puk_ajax_pembayaran.php",
									data : {data : isipd},
									success : function(data){
										$('#depe').html(data);
									}
								})
								
					}
					
					function myFunction() {
					  var input, filter, table, tr, td, i;
					  input = document.getElementById("search");
					  filter = input.value.toUpperCase();
					  table = document.getElementById("sample");
					  tr = table.getElementsByTagName("tr");
					  for (i = 0; i < tr.length; i++) {
						td = tr[i].getElementsByTagName("td")[0];
						if (td) {
						  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
						  } else {
							tr[i].style.display = "none";
						  }
						}       
					  }
					}
					
					function reload(){
						if($("#search").val("")){
							$(this).html();
						}
						setTimeout(myFunction());
					}
					
					
					
					function post() {
						var table = document.getElementsByTagName("table")[0];
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
							
							x = document.getElementById('nospk');
							x.value = dt_split[0].trim();
								$.ajax({
									method : "post",
									url : "modul/logistik/action/puk_ajax_post_data_spk.php",
									data : {data_ajax : x.value},
									success : function(data){
										
										var dd = data.toString();
										var dat = dd.split("--");
										
										
										$('#nospk').val(dat[0]);
										$('#tipe_mobil').val(dat[2])
										$('#warna').val(dat[3]);
										$('#no_rangka').val(dat[5]);
										$('#no_mesin').val(dat[6]);
										$('#customer').val(dat[1]);
										$('#cara_bayar').val(dat[4]);
										$('#leasing').val(dat[9]);
										$('#tenor').val(dat[7]);
										
										
										total_diskon = dat[8];											
										
										disc_format_angka = kurensi(total_diskon.toString());	
										$('#disc').val(disc_format_angka);	
										
										puk();
											
										
									}	
								})
						};
					}
					
					
					function tampil_modal(){
						//alert("sadf");
						x = document.getElementById('nospk');
						$.ajax({
									method : "GET",
									url : "modul/logistik/action/puk_ajax_list_spk.php",
									data : {data_ajax : x.value},
									success : function(data){
										
										$('#modal').html(data);
										$("#modal").modal('show');
										//document.getElementById("search").focus();
										//console.log(data);
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
									<h1 class="mainTitle">Data Permohonan Unit Keluar</h1>
									<span class="mainDescription">Tambah Permohonan Unit Keluar Baru pada Database</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Tambah Permohonan Unit Keluar Baru</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						
						
						
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" id="form" enctype="multipart/form-data" method="post" action="modul/logistik/action/puk_simpan_permohonan_unit_keluar.php">
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
											 <?php
											    $today=date("ym");
                                                $query = "SELECT max(no_puk) as last FROM unit_keluar WHERE no_puk LIKE 'PUK$today%'";
                                                $hasil = mysql_query($query);
                                                $data  = mysql_fetch_array($hasil);
                                                $lastNoTransaksi = $data['last'];
                                                $lastNoUrut = substr($lastNoTransaksi, 7, 3);
                                                $nextNoUrut = $lastNoUrut + 1;
                                                $nextNoTransaksi = $today.sprintf('%03s', $nextNoUrut);
                                                ?>
											<div class="col-md-6">
												
												<div class="form-group">
													<div class="form-group">
														<label class="control-label">
															Nomor PUK <span class="symbol required"></span>
														</label>
														<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  value="PUK<?php echo $nextNoTransaksi; ?>" class="form-control" id="nama_sales" name="nama_sales" required readonly>
													</div>
													<div class="form-group" hidden>
														<label class="control-label">
															Nama Sales <span class="symbol required"></span>
														</label>
														<input type="hidden" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="" value="<?php echo $_SESSION['username']; ?>" class="form-control" id="nama_sales" name="nama_sales" required readonly>
													</div>
													
													<div class="form-group" hidden >
														<label class="control-label">
															Kode SPV <span class="symbol required"></span>
														</label>
														<input type="hidden" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="" value="<?php echo $_SESSION['kode_spv']; ?>" class="form-control" id="kode_spv" name="kode_spv" required readonly>
													</div>
													
													<div class="form-group">
														<label for="form-field-mask-1">
															Nomor SPK <small class="text-success"></small>
														</label>
														<div class="input-group">
															<input id="nospk" class="form-control" type="text" value="" placeholder="NO SPK" name="nospk"" readonly onblur="puk();">
															<span class="input-group-btn">
																<button type="button" id="src" class="btn btn-primary" onclick="tampil_modal();">
																	<i class="fa fa-search"></i>
																</button>
															</span>
														</div>
													</div>
													
													<!--div class="form-group">
														<label class="control-label">
															No SPK <span class="symbol required"></span>
														</label>
														<input id="nospk" class="form-control" type="text" value="" placeholder="NO SPK" name="nospk" onblur="puk();">
														
													</div-->
													
													<div class="form-group">
														<label class="control-label">
															Tipe <span class="symbol required"></span>
														</label>
														<input type="text" placeholder="" class="form-control" value="" id="tipe_mobil" name="tipe_mobil" required readonly>
														</input>
													</div>
													<div class="form-group">
														<label class="control-label">
															Warna <span class="symbol required"></span>
														</label>
														<input type="text" placeholder="" class="form-control" value="" id="warna" name="warna" required readonly>
														</input>
													</div>
													
													<div class="form-group">
														<label class="control-label">
															No Rangka <span class="symbol required"></span>
														</label>
														<input type="text" placeholder="" class="form-control" value="" id="no_rangka" name="no_rangka" required readonly >
														</input>
													</div>
													<div class="form-group">
														<label class="control-label">
															No Mesin <span class="symbol required"></span>
														</label>
														<input type="text" placeholder="" class="form-control" value="" id="no_mesin" name="no_mesin" required readonly >
														</input>
													</div>
													
													<div class="form-group">
														<label class="control-label">
															SPK A/N <span class="symbol required"></span>
														</label>
														<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="" class="form-control" id="customer" name="customer" required readonly>
													</div>
													<!--div class="form-group">
														<label class="control-label">
															Tanggal Keluar <span class="symbol required"></span>
														</label>
														<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
															<input class="form-control" required readonly type="text" placeholder ="Pilih Tanggal Awal" name="tanggal" value = "<?php echo date("Y-m-d"); ?>">
															<span class="input-group-btn"><i class="glyphicon glyphicon-time"></i></span>
														</div>
													</div-->
													<div class="form-group">
														<label class="control-label">
															Discount <span class="symbol required"></span>
														</label>
														<div class="input-group">
															<span class="input-group-addon">Rp</span>
															<input type="text" placeholder="" class="form-control" value="" id="disc" name="disc" required readonly>
															</input>
															</div>
													</div>
													
													<div class="form-group">
														<label for="form-field-select-2">
															Cara Pembayaran <span class="symbol required"></span>
														</label>
															<input type="text" placeholder="" class="form-control" value="" id="cara_bayar" name="cara_bayar" required readonly>
															</input>
													</div>
													
													<div class="form-group">
														<label for="form-field-select-2">
															Leasing <span class="symbol required"></span>
														</label>													
															<input type="text" placeholder="" class="form-control" value="" id="leasing" name="leasing" required readonly>
															</input>
													</div>
													
													<div class="form-group">
														<label class="control-label">
															Tenor <span class="symbol required"></span>
														</label>
														<input type="text" placeholder="" class="form-control" value="" id="tenor" name="tenor" required readonly>
														</input>
													</div>
													
													<div id="depe">
														
													</div>
													
													<div class="form-group" id="depe2">
														
													</div>
													
													<div class="form-group" id="total3">
														
													</div>
													
													
													<div class="form-group">
														<label class="control-label">
															Tanggal Keluar <span class="symbol required"></span>
														</label>
														<p class="input-group input-append datepicker date " data-date-format="yyyy-mm-dd">
															<input class="form-control" required readonly type="text" placeholder ="Pilih Tanggal Keluar" name="tanggal" value = "<?php //echo date("Y-m-d"); ?>">
															<span class="input-group-btn">
																<button type="button" class="btn btn-default">
																	<i class="glyphicon glyphicon-calendar"></i>
																</button> 
															</span>
														</p>
													</div>
													
													
													<!--div class="form-group">
														<label class="control-label">
															Jam Keluar <span class="symbol required"></span>
														</label>
														<div class="input-group bootstrap-timepicker col-md-12" >
														  <input type="text" class="form-control" name="jam" id="datetimepicker2" data-date-format='HH:mm:ss' />
														  <span class="input-group-addon" onclick="document.getElementById('datetimepicker2').focus();"><i class="glyphicon glyphicon-time" ></i></span>
														</div>
													</div-->
													
													
													
													
													<div class="form-group">
														<label>
															Pilih Jam
														</label>
														<select data-placeholder="Pilih Jam" class="js-example-basic-single js-states form-control" style="height:50px;" required name="jam1">
																<option value="">Pilih Jam</option>
																<?php for($i=6; $i<20; $i++ ){
																echo "<option value=".($i<10 ? "0$i" : "$i") .">".($i<10 ? "0$i" : "$i")."</option>";
																
																  }?>
														</select>
													</div>
													<div class="form-group">
														<label>
															Pilih Menit
														</label>
														<select data-placeholder="Pilih Menit" class="js-example-basic-single js-states form-control" style="height:50px;" required name="menit1">
																<option value="">Pilih Menit</option>
																<?php for($i=0; $i<60; $i=$i+5 ){
																echo "<option value=".($i<10 ? "0$i" : "$i") .">".($i<10 ? "0$i" : "$i")."</option>";
																
																  }?>
														</select>
													</div>
													
													
													<div class="form-group">
														<label class="control-label">
															Keterangan <span class="symbol required"></span>
														</label>
														<div class="form-group">
															<div class="note-editor">
																<textarea class="form-control" id="keterangan" name="keterangan"></textarea>
															</div>
														</div>
													</div>
													
												</div>
												<p id="txtHint"></p>
											</div>
										</div>
									</br>
										<div class="row">											
											<div class="col-md-4">
												
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Simpan
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=window.location.href='media_showroom.php?module=logistik_puk'>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
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
				
				
				<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onblur="reload();" onpageshow="focus">
							
				</div>
