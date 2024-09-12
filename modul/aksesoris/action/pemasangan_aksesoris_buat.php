<script type="text/javascript" src="../../../assets/js/jquery.1.6.js">



</script>
<script>
function tampil_modal(){
		$(".preload-wrapper3").show();
		
		x = document.getElementById('nospk');
	
		$.ajax({
					method : "POST",
					url : "modul/aksesoris/action/pemasangan_aksesoris_ajax_list_spk.php",
					data : {data_ajax : "nospk"},
					success : function(data){
						
						$('#modal').html(data);
						$("#modal").modal('show');
						$(".preload-wrapper3").fadeOut("slow");
						//document.getElementById("search").focus();
						//console.log(data);
					}	
				})
		
	}

function post() {
	//alert ("tes");
	$(".preload-wrapper3").show();
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
				url : "modul/aksesoris/action/pemasangan_aksesoris_ajax_post_data_spk.php",
				data : {data_ajax : x.value},
				success : function(data){
					
					var dd = data.toString();
					var dat = dd.split("--");
					
					
					$('#nospk').val(dat[0]);
					$('#tipe_mobil').val(dat[2]);
					$('#warna').val(dat[3]);
					$('#no_rangka').val(dat[5]);
					$('#no_mesin').val(dat[6]);
					$('#customer').val(dat[1]);
					$('#tahunbuat').val(dat[10]);
					//$('#cara_bayar').val(dat[4]);
					//$('#leasing').val(dat[9]);
					//$('#tenor').val(dat[7]);
					
					
					
					//total_diskon = dat[8];											
					
					//disc_format_angka = kurensi(total_diskon.toString());	
					//$('#disc').val(disc_format_angka);	
					
					//var html = $(".copy").html();
					//$(".after-add-more").after(html);
					
					$.ajax({
						method : "post",
						url : "modul/aksesoris/action/pemasangan_aksesoris_ajax_post_data_aksesoris_program.php",
						data : {data_ajax : x.value},
						success : function(data){					
							
							//alert ("tes");
							
							$('#accs_md').html(data);
						}
					})
					
					$.ajax({
						method : "post",
						url : "modul/aksesoris/action/pemasangan_aksesoris_ajax_post_data_aksesoris_bonus.php",
						data : {data_ajax : x.value},
						success : function(data){					
							
							//alert ("tes");
							$('#accs_bonus').html(data);
							$(".preload-wrapper3").fadeOut("slow");
						}
					})
					
				}	
			})
	};
}

function cek_inputan(){
											
	if ((document.form.tgl_unit_keluar.value).length < 1){
		swal({
			title: "Peringatan!",
			text: "Tanggal Unit Keluar Tidak Boleh Dikosongkan",
			type: "warning",
			confirmButtonColor: "#007AFF"
		});
		
		//document.form.warna.focus();
		return false;
		
	}
	
	
}

</script>

<script>	
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
									<h1 class="mainTitle">Permohonan Pemasangan Aksesoris</h1>
									<span class="mainDescription">Buat Permohonan Pemasangan Aksesoris</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Aksesoris</span>
									</li>
									<li class="active">
										<span>Pemasangan Aksesoris</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">                                 
                                    
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="modul/aksesoris/action/pemasangan_aksesoris_simpan.php" onsubmit="return cek_inputan()">
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
											<fieldset>
												<legend>FORM AKSESORIS UNIT KELUAR</legend>
											    
											    <?php
											    $today=date("ym");
                                                $query = "SELECT max(no_permohonan) as last FROM pemasangan_aksesoris WHERE no_permohonan LIKE 'PA$today%'";
                                                $hasil = mysql_query($query);
                                                $data  = mysql_fetch_array($hasil);
                                                $lastNoTransaksi = $data['last'];
                                                $lastNoUrut = substr($lastNoTransaksi, 6, 3);
                                                $nextNoUrut = $lastNoUrut + 1;
                                                $nextNoTransaksi = $today.sprintf('%03s', $nextNoUrut);
                                                ?>
											    <div class="form-group">
													<label class="control-label">
														No Permohonan <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="No Permohonan" class="form-control" value="PA<?php echo $nextNoTransaksi; ?>" id="no_permohonan" name="no_permohonan" required readonly>
													</input>
												</div>
												<div class="form-group">
													<label class="control-label">
														No SPK <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<input class="form-control" type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="No SPK" class="form-control" id="nospk" name="no_spk" required readonly>
														<span class="input-group-btn">
															<button type="button" id="src" class="btn btn-primary" onclick="tampil_modal();">
																<i class="fa fa-search"></i>
															</button>
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label">
														No Rangka <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="No Rangka" class="form-control" id="no_rangka" name="no_rangka" required readonly>
												</div>
												<div class="form-group">
													<label class="control-label">
														No Mesin <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="No Mesin" class="form-control" id="no_mesin" name="no_mesin" required readonly>
												</div>
												<div class="form-group">
													<label class="control-label">
														Nama Customer <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Customer" class="form-control" id="customer" name="nama_customer" required readonly>
												</div>
												
												<div class="form-group">
    													<label for="form-field-select-2">
    														Tipe <span class="symbol required"></span>
    													</label>	
														<input type="text" placeholder="" class="form-control" value="" id="tipe_mobil" name="tipe_mobil" required readonly>
    													
    											</div>
												<div class="form-group">
													<label class="control-label">
															Warna <span class="symbol required"></span>
														</label>
														<input type="text" placeholder="" class="form-control" value="" id="warna" name="warna" required readonly />
												
													
												</div>
												<!--div class="form-group">
													<label class="control-label">
														Tipe Mobil <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Tipe" class="form-control" id="tipe_mobil" name="tipe_mobil" />
												</div-->
												<div class="form-group">
													<label class="control-label">
															Tahun Pembuatan <span class="symbol required"></span>
														</label>
														<input type="text" placeholder="" class="form-control" value="" id="tahunbuat" name="tahun_buat" required readonly />
												
													
												</div>
												<div class="form-group">
													<label class="control-label">
														Tgl Unit Keluar <span class="symbol required"></span>
													</label>
													<p class="input-group input-append datepicker date " data-date-format='yyyy-mm-dd'>
														<input type="text" class="form-control" id="tgl_unit_keluar" readonly name="tgl_unit_keluar" value="" required />
														<span class="input-group-btn">
															<button type="button" class="btn btn-default">
																<i class="glyphicon glyphicon-calendar"></i>
															</button> </span>
													</p>
												</div>
												</fieldset>
												
												<fieldset>
												<legend>PEMASANGAN AKSESORIS PROGRAM MD</legend>
												<div class="row">
												<div class="form-group">
													<!--label class="control-label">
														Aksesoris Program MD  <span class="symbol required"></span>
													</label-->
													
													<div class="panel-body">
														<div id="accs_md">
														  
														</div>
														
														<div class="input-group control-group after-add-more">
														 <input type="text" name="accs_md[]" class="form-control" placeholder="Aksesoris Program MD" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()">
														 <input type="text" name="accs_bonus_keterangan_md[]" value = "" placeholder="KETERANGAN" class="form-control" >		
														 <div class="input-group-btn"> 
															<button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i></button>
														  </div>
														</div>
														
														
														
														<!-- Copy Fields -->
														<div class="copy hide">
														  <div class="control-group input-group" style="margin-top:10px">
															<input type="text" name="accs_md[]" class="form-control" placeholder="Aksesoris Program MD" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()">
															<input type="text" name="accs_bonus_keterangan_md[]" value = "" placeholder="KETERANGAN" class="form-control" >
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
														 });
													$("body").on("click",".remove",function(){ 
														$(this).parents(".control-group").remove();
														  });
														});
												</script>
												
												</fieldset>
												
											</div>
											
											
											
											
											<div class="col-md-6">
											<fieldset>
												<legend>PEMASANGAN AKSESORIS BONUS</legend>
												<div class="row">
													
													<div class="form-group">
													<!--label class="control-label">
														Aksesoris Bonus  <span class="symbol required"></span>
													</label-->
													
													<div class="panel-body">
														<div id="accs_bonus">
														  
														</div>
														
														<div class="input-group control-group after-add-more-bonus">
														  <input type="text" name="accs_bonus[]" class="form-control" placeholder="Aksesoris Bonus" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()">
														  <input type="text" name="accs_bonus_keterangan[]" value = "" placeholder="KETERANGAN" class="form-control" >
														  <div class="input-group-btn"> 
															<button class="btn btn-success add-more-bonus" type="button"><i class="glyphicon glyphicon-plus"></i></button>
														  </div>
														</div>
														<!-- Copy Fields -->
														<div class="copy-bonus hide">
														  <div class="control-group input-group" style="margin-top:10px">
															<input type="text" name="accs_bonus[]" class="form-control" placeholder="Aksesoris Bonus" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()">
															<input type="text" name="accs_bonus_keterangan[]" value = "" placeholder="KETERANGAN" class="form-control" >
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
													$(".add-more-bonus").click(function(){ 
														var html = $(".copy-bonus").html();
														$(".after-add-more-bonus").after(html);
														 });
													$("body").on("click",".remove",function(){ 
														$(this).parents(".control-group").remove();
														  });
														});
												</script>
												
											</fieldset>
											</div>
											
											
											
											<div class="col-md-6">
											<fieldset>
												<legend>PEMASANGAN AKSESORIS TAMBAHAN</legend>
												<div class="row">
												
												<div class="form-group">
													<!--label class="control-label">
														Aksesoris Tambahan  <span class="symbol required"></span>
													</label-->
													
													<div class="panel-body">
														<div class="input-group control-group after-add-more-tambahan">
														  <input type="text" name="accs_tambahan[]" class="form-control" placeholder="Aksesoris Tambahan" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()">
														   <input type="text" name="accs_tambahan_hargajual[]" id = "id_hrg_accs" value = "" placeholder="HARGA JUAL" class="form-control" onfocus="startCalc();" onblur="stopCalc();" onkeypress="return hanyaAngka(event)" onkeyup="this.value=format_angka(this.value);"  >
														  <input type="text" name="accs_tambahan_keterangan[]" value = "" placeholder="KETERANGAN" class="form-control" >
														 
														  <div class="input-group-btn"> 
															<button class="btn btn-success add-more-tambahan" type="button"><i class="glyphicon glyphicon-plus"></i></button>
														  </div>
														</div>
														<!-- Copy Fields -->
														<div class="copy-tambahan hide">
														  <div class="control-group input-group" style="margin-top:10px">
															<input type="text" name="accs_tambahan[]" class="form-control" placeholder="Aksesoris Tambahan" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()">
															<input type="text" name="accs_tambahan_hargajual[]" id = "id_hrg_accs[]" value = "" placeholder="HARGA JUAL" class="form-control" onfocus="startCalc();" onblur="stopCalc();" onkeypress="return hanyaAngka(event)" onkeyup="this.value=format_angka(this.value);"  >
															<input type="text" name="accs_tambahan_keterangan[]" value = "" placeholder="KETERANGAN" class="form-control" >															
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
													$(".add-more-tambahan").click(function(){ 
														var html = $(".copy-tambahan").html();
														$(".after-add-more-tambahan").after(html);
														 });
													$("body").on("click",".remove",function(){ 
														$(this).parents(".control-group").remove();
														  });
														});
												</script>
												
											</fieldset>
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
												<button class="btn btn-primary btn-wide" type="submit" id="gar-contact-button">
													<i class="fa fa-save"></i> Simpan
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=aksesoris_pemasangan_aksesoris';>
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
		
		
		
		
