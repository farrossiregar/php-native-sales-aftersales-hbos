<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
			
	<?php 
		
		
		if(count($_POST)) {
		                
                                                
                        //mysql_unbuffered_query("insert into standar_keputusan_pameran (no, kategori_kontrol, standar_keputusan) 
						//	values('','$_POST[kategori_kontrol]','$_POST[checklist]')");
			
						$input1 = $_POST['checklist'];
						$input2 = $_POST['bobot'];
                        $n=0;
						foreach ($input1 as $checklist ) {
							if($checklist!=''){
							
							mysql_query("insert into standar_keputusan_pameran (no, kategori_kontrol, standar_keputusan, bobot) 
							values('','$_POST[kategori_kontrol]','$checklist','$input2[$n]')");	
							$n=$n+1;
							}
						}
							
							$msg = "
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil menambah data. $input2[0] $input2[1]</div>"; 

					}
				
?>

		
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Master Data Checklist Pameran</h1>
									<span class="mainDescription">Input Kategori Checklist Pameran</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li>
										<span>Master Data</span>
									</li>
									<li class="active">
										<span>Input Kategori Checklist Pameran</span>
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
											Pilih Kategori Kontrol Pameran <span class="symbol required"></span>
											</label>
											<div class="input-group control-group">
												<select name="kategori_kontrol" id="kategori_kontrol">
												<option value="">--PILIH--</option>
												<option value="materi_promosi">Materi Promosi</option>
												<option value="booth">Booth</option>
												<option value="unit_display">Unit Display</option>
												<option value="sales_person">Sales Person</option>
												</select>
											</div>
										</div>
										
										<div class="col-md-4">
										<div class="row">
										<div class="panel-body">
										<label class="control-label">
											Input Standar Keputusan Pameran <span class="symbol required"></span>
										</label>
											<div class="input-group control-group after-add-more">
												<div class="input-group-btn"> 
													<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i></button>
												</div>
												<input type="text" name="checklist[]" class="form-control" placeholder="STANDAR KEPUTUSAN" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()">
											</div>

										<!-- Copy Fields -->
											<div class="copy hide">
												<div class="control-group input-group" style="margin-top:10px">
													<div class="input-group-btn"> 
														<button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i></button>
													</div>
													<input type="text" name="checklist[]" class="form-control" placeholder="STANDAR KEPUTUSAN" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()">
												</div>
											</div>
										</div>
										</div>
										</div>
										
										<!-- PISAH -->
										
										<div class="col-md-2">
										<div class="row">
										<div class="panel-body">
										<label class="control-label">
											Bobot Standar Pameran <span class="symbol required"></span>
										</label>
											<div class="input-group control-group after-add-more-bobot">
												<input type="text" name="bobot[]" class="form-control" placeholder="BOBOT" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()">
											</div>

										<!-- Copy Fields -->
											<div class="copy-bobot hide">
												<div class="control-group input-group" style="margin-top:10px">
													<input type="text" name="bobot[]" class="form-control" placeholder="BOBOT" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()">
													<div class="input-group-btn"> 
														<button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i></button>
													</div>
												</div>
											</div>
										</div>
										</div>
										</div>
												
												<script type="text/javascript">
													$(document).ready(function() {
													$(".add-more").click(function(){
														var html = $(".copy").html();
														$(".after-add-more").after(html);
														
														var html = $(".copy-bobot").html();
														$(".after-add-more-bobot").after(html);
														
														 });
														 
													$("body").on("click",".remove",function(){
														$(this).parents(".control-group").remove();
														  });
														});										
												</script>
												
							</div>
										
									    <div class="col-md-12">	
											<div class="row">
												<div class="col-md-12">
													
														<span class="symbol required"></span>Harus diisi
														<hr>
													
												</div>
											</div>
										</div>
										<div class="col-md-12">
												<div class="row">
												    	
												    <div class="col-md-4">
												        
												            <button class="btn btn-primary btn-wide" type="submit" id="simpan" name="simpan">
													<i class="fa fa-save"></i> Simpan
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=sub_master_target_penjualan_salesman';>
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
				
				
		
		
		
		
		
		
