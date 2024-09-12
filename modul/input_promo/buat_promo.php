<?php
session_start();
 if (strtoupper($_SESSION['leveluser']) != 'SUPERVISOR' and strtoupper($_SESSION['leveluser']) != 'ADMIN' and strtoupper($_SESSION['leveluser']) != 'MNGR' ) {
?>
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle text-orange ">This page is PROTECTED..!!!</h1>
								</div>
							</div>
						</section>
					</div>
				</div>
<?php
	}else{
?>
	<?php 
	
		if(count($_POST)) {
			if(strtoupper($_SESSION['leveluser']) == 'SUPERVISOR'){
				mysql_unbuffered_query("insert into informasi (judul, isi_informasi, tanggal, kode_spv, tgl_awal, tgl_akhir) 
									values('$_POST[judul]','$_POST[isi_promo]','$_POST[tanggal]','$_SESSION[kode_spv]','$_POST[tgl_awal]','$_POST[tgl_akhir]')");
							
			$msg = "
					<div class='alert alert-success alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<h4><i class='icon fa fa-check'></i> Selamat!</h4>
					Berhasil menambah data.</div>"; 
			}else{
				mysql_unbuffered_query("insert into informasi (judul, isi_informasi, tanggal, tgl_awal, tgl_akhir) 
									values('$_POST[judul]','$_POST[isi_promo]','$_POST[tanggal]','$_POST[tgl_awal]','$_POST[tgl_akhir]')");
							
			$msg = "
					<div class='alert alert-success alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<h4><i class='icon fa fa-check'></i> Selamat!</h4>
					Berhasil menambah data.</div>"; 
			}                        
		}
	?>

				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Informasi</h1>
									<span class="mainDescription">Buat Informasi</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li class="active">Informasi</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
								    
                                    <script language="JavaScript">
                                      function removereadonly(){
                                        var read=document.getElementById("refund")
                                            .removeAttribute("readonly",0);
                                        var read=document.getElementById("leasing")
                                            .removeAttribute("required",0);  
                                        var read=document.getElementById("tenor")
                                            .removeAttribute("required",0);
                                     //alert("atribut textbox readonly telah terhapus");
                                      }
                                      function addreadonly(){
                                          document.getElementById("refund").readOnly = true;
                                          document.getElementById("leasing").required = true;
                                          document.getElementById("tenor").required = true;
                                      }
                                      
                                    </script>                                    
                                    
 
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="">
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
											<div class="col-md-6">
											
											    <div class="form-group">
													<label class="control-label">
														Judul<span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Judul Informasi" class="form-control" id="judul" name="judul" required>
													</input>
												</div>
																								
												<div class="form-group" hidden>
													<label class="control-label">
														Tanggal Input
													</label>
													<input type="text" style="text-transform:uppercase" value="<?php echo date("Y-m-d H:i:s"); ?>" class="form-control" id="tanggal" name="tanggal" readonly>
												</div>
												<div class="form-group">
													<div class="panel-heading">
														<div class="panel-title">
															Isi Informasi <span class="symbol required"></span>
														</div>
											    	</div>
													<div class="panel-body">
														<div class="form-group">
															<div class="note-editor">
																<textarea class="form-control" id="isi_promo" name="isi_promo" required></textarea>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label">
																Tanggal Berlaku
															</label>
															<div class="input-group input-append datepicker date" data-date-format='yyyy-mm-dd'>
																<input type="text" class="form-control" name = "tgl_awal" id = "tgl_awal" />
																	<span class="input-group-btn">
																		<button type="button" class="btn btn-default">
																			<i class="glyphicon glyphicon-calendar"></i>
																		</button>
																	</span>
															</div>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label">
																Tanggal Berakhir
															</label>
															<div class="input-group input-append datepicker date" data-date-format='yyyy-mm-dd'>
																<input type="text" class="form-control" name = "tgl_akhir" id = "tgl_akhir" />
																	<span class="input-group-btn">
																		<button type="button" class="btn btn-default">
																			<i class="glyphicon glyphicon-calendar"></i>
																		</button>
																	</span>
															</div>
														</div>
													</div>
											
													<!--<div class="form-group" style = display:none;>
														<label class="control-label">
															Tgl Pengajuan <span class="symbol required"></span>
														</label>
														<p class="input-group input-append datepicker date " data-date-format='yyyy-mm-dd'>
															<input type="text" class="form-control" id="waktu" readonly name="waktu" value="<?php echo date('Y-m-d'); ?>" />
															<span class="input-group-btn">
																<button type="button" class="btn btn-default">
																	<i class="glyphicon glyphicon-calendar"></i>
																</button> </span>
														</p>
													</div>-->
													
												</div>	
											</div>
											<div class="row">
												<div class="col-md-12">
													<div>
														<span class="symbol required"></span>Harus diisi
														<hr>
													</div>
												</div>
											</div>
											<div class="row">											
												<div class="col-md-4">
													<button class="btn btn-primary btn-wide" type="submit" id="gar-contact-button" onclick = "harga_otomatis();">
														<i class="fa fa-save"></i> Simpan
													</button>
													<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=info_promo';>
														<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
													</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>
				<?php
	}
	?>
		
		
