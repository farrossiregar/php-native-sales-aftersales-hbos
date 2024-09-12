<script type="text/javascript" src="../../../assets/js/jquery.1.6.js"></script>

<script>


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
                                    
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="modul/Aksesoris/action/pemasangan_aksesoris_simpan.php" onsubmit="return cek_inputan()">
										<div class="row">
											<div class="col-md-12">
											<?php echo(isset ($msg) ? $msg : ''); ?>
												
											</div>
											<div class="col-md-6">
											<fieldset>
												<legend>FORM AKSESORIS UNIT KELUAR </legend>
											    
											    <?php
											    $today=date("ym");
                                                $query = "SELECT max(no_permohonan) as last FROM pemasangan_aksesoris WHERE no_permohonan LIKE 'PA$today%'";
                                                $hasil = mysql_query($query);
                                                $data  = mysql_fetch_array($hasil);
                                                $lastNoTransaksi = $data['last'];
                                                $lastNoUrut = substr($lastNoTransaksi, 6, 3);
                                                $nextNoUrut = $lastNoUrut + 1;
                                                $nextNoTransaksi = $today.sprintf('%03s', $nextNoUrut);
												
												$no_permohonan = substr(addslashes($_GET['id']),0,28);
												$no_permohonan2 = substr(addslashes($_GET['id']),28,32);
												
												$a = mysql_query("select * from pemasangan_aksesoris where substring(md5(md5(no_permohonan)),1,28) = '$no_permohonan' and md5(no_permohonan) = '$no_permohonan2'");
												$j = mysql_fetch_array($a);
												
												
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
														Nama Sales <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="No Permohonan" class="form-control" value ="<?php echo $j['nama_sales'] ?>" id="no_permohonan" name="no_permohonan" required readonly>
													</input>
												</div>
												<div class="form-group">
													<label class="control-label">
														No SPK <span class="symbol required"></span>
													</label>
													
													<input type="text" value ="<?php echo $j['no_spk'] ?>" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="No SPK" class="form-control" id="nospk" name="no_spk" required readonly>
														
													
												</div>
												<div class="form-group">
													<label class="control-label">
														No Rangka <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" value ="<?php echo $j['no_rangka'] ?>" onblur="this.value=this.value.toUpperCase()" placeholder="No Rangka" class="form-control" id="no_rangka" name="no_rangka" required readonly>
												</div>
												<div class="form-group">
													<label class="control-label">
														No Mesin <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" value ="<?php echo $j['no_mesin'] ?>" onblur="this.value=this.value.toUpperCase()" placeholder="No Mesin" class="form-control" id="no_mesin" name="no_mesin" required readonly>
												</div>
												<div class="form-group">
													<label class="control-label">
														Nama Customer <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" value ="<?php echo $j['nama_customer'] ?>" placeholder="Nama Customer" class="form-control" id="customer" name="nama_customer" required readonly>
												</div>
												
												<div class="form-group">
														<label for="form-field-select-2">
															Tipe <span class="symbol required"></span>
														</label>	
														<input type="text" placeholder="" class="form-control" value="<?php echo $j['tipe_model'] ?>" id="tipe_mobil" name="tipe_mobil" required readonly>
														
												</div>
												<div class="form-group">
													<label class="control-label">
															Warna <span class="symbol required"></span>
														</label>
														<input type="text" placeholder="" class="form-control" value="<?php echo $j['warna'] ?>" id="warna" name="warna" required readonly />
												
													
												</div>
												
												<div class="form-group">
													<label class="control-label">
															Tahun Pembuatan <span class="symbol required"></span>
														</label>
														<input type="text" placeholder="" class="form-control" value="<?php echo $j['tahun_buat'] ?>" id="tahunbuat" name="tahun_buat" required readonly />
												
													
												</div>
												<div class="form-group">
													<label class="control-label">
														Tgl Unit Keluar <span class="symbol required"></span>
													</label>
													<p class="input-group input-append datepicker date " data-date-format='yyyy-mm-dd'>
														<input type="text" class="form-control" id="tgl_unit_keluar" readonly name="tgl_unit_keluar" value="<?php echo $j['tgl_unit_keluar'] ?>" required />
														<span class="input-group-btn">
															<button type="button" class="btn btn-default">
																<i class="glyphicon glyphicon-calendar"></i>
															</button> </span>
													</p>
												</div>
												
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
		
		
		
		
		
		
