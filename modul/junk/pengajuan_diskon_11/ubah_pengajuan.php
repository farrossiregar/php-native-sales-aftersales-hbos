<?php

$harga_otr=str_replace(".","",$_POST['harga_otr']);
	$discount_unit=str_replace(".","",$_POST['discount_unit']);
	$pengajuan_disc=str_replace(".","",$_POST['pengajuan_disc']);
	$total_discount_accs=str_replace(".","",$_POST['total_discount_accs']);
	$refund=str_replace(".","",$_POST['refund']);
	$total_discount=str_replace(".","",$_POST['total_discount']);
	$a = "select * from pengajuan_discount where no_pengajuan='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
				
	if(count($_POST)) {
			
	mysql_unbuffered_query("update pengajuan_discount set no_spk = '$_POST[no_spk]', nama_customer = '$_POST[nama_customer]',
	model = '$_POST[model]', tipe_mobil = '$_POST[tipe_mobil]', harga_otr = '$harga_otr', discount_unit = '$discount_unit',
	pengajuan_disc = '$pengajuan_disc', ket_discount = '$_POST[ket_discount]', total_discount_accs = '$total_discount_accs',
	refund = '$refund', total_discount = '$total_discount', waktu = '$_POST[waktu]',cara_beli = '$_POST[cara_beli]',leasing = '$_POST[leasing]',
	tenor = '$_POST[tenor]' where no_pengajuan = '$_GET[id]'");
				
						
	$msg = "
					
		<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4><i class='icon fa fa-check'></i> Selamat!</h4>
		Berhasil mengubah data.
		</div>
		
		";	
	}
	
	$a = "select * from pengajuan_discount where no_pengajuan='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
	//$jenis=$r['jenis_pembayaran_local'];
?>

                                    <script>
                                        function startCalc(){
                                        interval = setInterval("calc()",1);}
                                        function calc(){
                                        one = document.form.pengajuan_disc.value;
                                        two = document.form.total_discount_accs.value; 
                                        three = document.form.refund.value; 
                                        
                                        var rupiah1 = one;
                                        var rupiah2 = two;
                                        var rupiah3 = three;
                                        var clean1 = rupiah1.replace(/\D/g, '');
                                        var clean2 = rupiah2.replace(/\D/g, '');
                                        var clean3 = rupiah3.replace(/\D/g, '');
                                        
                                        
                                        
                                        var bilangan = (clean1 * 1) + (clean2 * 1) - (clean3 * 1);
                                        
                                        var	reverse = bilangan.toString().split('').reverse().join(''),
                                    	ribuan 	= reverse.match(/\d{1,3}/g);
                                    	ribuan	= ribuan.join('.').split('').reverse().join('');
                                        
                                        document.form.total_discount.value = (ribuan);}
                                        
                                        function stopCalc(){
                                        clearInterval(interval);}
                                    </script>
                                    
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Ubah Pengajuan Discount</h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li class="active">
										<span>Pengajuan Discount</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
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
														No Pengajuan <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="No Pengajuan" class="form-control" id="no_pengajuan" value="<?php echo $r[no_pengajuan]; ?>" name="no_pengajuan" required readonly>
													</input>
												</div>
												<div class="form-group">
													<label class="control-label">
														No SPK <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="No SPK" class="form-control" id="no_spk" name="no_spk" value="<?php echo $r[no_spk]; ?>" required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Nama Customer <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Nama Customer" class="form-control" id="nama_customer" name="nama_customer" value="<?php echo $r[nama_customer]; ?>">
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Mobil <span class="symbol required"></span>
													</label>
													<select name = "model" id="model" class = "form-control" >														
    														<option value="<?php echo $r[model]; ?>" selected><?php echo $r[model]; ?></option>
    														<?php $data = mysql_query("select * from model");
    															while ($r=mysql_fetch_array($data))
    															{
    																echo "<option value=$r[kode_model]> $r[nama_model] </option>";
    															}
    															
    														?>
    												</select>
												</div>
												<div class="form-group">
    													<label for="form-field-select-2">
    														Pilih Tipe <span class="symbol required"></span>
    													</label>													
    													<select name="tipe_mobil" id = "tipe_mobil" class = "form-control" >	
    														<option value="<?php echo $r[tipe_mobil]; ?>"><?php echo $r[tipe_mobil]; ?></option>
    													</select>
    												</div>
    												<div class="form-group">
    													<label for="form-field-select-2">
    														Pilih Warna <span class="symbol required"></span>
    													</label>													
    													<select name="warna" id="warna" class = "form-control" >														
    														<option value="<?php echo $r[warna]; ?>"><?php echo $r[warna]; ?></option>
    														<?php $data = mysql_query("select * from warna");
    															while ($r=mysql_fetch_array($data))
    															{
    																echo "<option value=$r[kode_warna]> $r[nama_warna] </option>";
    															}
    															
    														?>
    													</select>
    												</div>
												<!--div class="form-group">
													<label class="control-label">
														Tipe Mobil <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Tipe" class="form-control" id="tipe_mobil" name="tipe_mobil" />
												</div-->
												<div class="form-group">
													<label class="control-label">
														Harga OTR <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" id="harga_otr" name="harga_otr" onkeypress="return hanyaAngka(event)" value="<?php echo $r[harga_otr]; ?>" onKeyup="titikpemisah();"/>
													</div>
												</div>
												<label class="control-label">
													Metode Pembayaran <span class="symbol required"></span>
												</label>
												</br>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio1" class="metodebayar" name="cara_beli" value="TUNAI" <?php if($r[cara_beli]=="TUNAI"){echo "checked";} ?>>
													<label for="radio1">
														Tunai
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" class="metodebayar2" name="cara_beli" value="KREDIT"  <?php if($r[cara_beli]=="KREDIT"){echo "checked";} ?>>
													<label for="radio2">
														Kredit
													</label>
												</div>
													<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio3" class="metodebayar3" name="cara_beli" value="GSO"  <?php if($r[cara_beli]=="GSO"){echo "checked";} ?> >
													<label for="radio3">
														GSO
													</label>
												</div>
												<div class="form-group" id="id_leasing">
													<label class="control-label" >
														Nama leasing .<?php echo $carbay; ?> <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="Nama Leasing" class="form-control"  name="leasing" value = <?php echo $r[leasing]; ?> />
												</div>
												<div class="form-group" id="id_tenor">
													<label for="form-field-select-2">
														Tenor <span class="symbol required"></span>
													</label>
													<select name='tenor' id='tenor' class='form-control'>
													<option value=''> </option>
													<option value='1 Tahun' <?php if($r[tenor]=="1 Tahun"){echo "selected";} ?> >1 Tahun</option>
													<option value='2 Tahun' <?php if($r[tenor]=="2 Tahun"){echo "selected";} ?> >2 Tahun</option>
													<option value='3 Tahun' <?php if($r[tenor]=="3 Tahun"){echo "selected";} ?> >3 Tahun</option>
													<option value='4 Tahun' <?php if($r[tenor]=="4 Tahun"){echo "selected";} ?> >4 Tahun</option>
													<option value='5 Tahun' <?php if($r[tenor]=="5 Tahun"){echo "selected";} ?> >5 Tahun</option>
												    </select>
												</div>
												<div class="form-group">
													<label class="control-label">
														Discount Unit <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" id="discount_unit" name="discount_unit" onkeypress="return hanyaAngka(event)" value="<?php echo $r[discount_unit]; ?>" onKeyup="titikpemisah();"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label">
														Pengajuan Discount <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" id="pengajuan_disc" name="pengajuan_disc" onkeypress="return hanyaAngka(event)" value="<?php echo $r[pengajuan_disc]; ?>" onFocus="startCalc();" onBlur="stopCalc();" onkeypress="return hanyaAngka(event)" onKeyup="titikpemisah();" />
													</div>
												</div>
												<div class="form-group">
													<div class="panel-heading">
													<div class="panel-title">
														Keterangan Discount
													</div>
											    	</div>
													<div class="panel-body">
													<div class="form-group">
														<div class="note-editor">
															<textarea class="form-control" id="ket_discount" name="ket_discount"><?php echo $r[ket_discount]; ?></textarea>
														</div>
													</div>
												</div>
												</div>
												<div class="form-group">
													<label class="control-label">
														Total Discount Accessories <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" id="total_discount_accs" name="total_discount_accs" onkeypress="return hanyaAngka(event)" value="<?php echo $r[total_discount_accs]; ?>" onFocus="startCalc();" onBlur="stopCalc();" onkeypress="return hanyaAngka(event)" onKeyup="titikpemisah();"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label">
														Refund <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" id="refund" name="refund" onkeypress="return hanyaAngka(event)" value="<?php echo $r[refund]; ?>" onFocus="startCalc();" onBlur="stopCalc();" onkeypress="return hanyaAngka(event)" onKeyup="titikpemisah();"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label">
														Total Discount <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" id="total_discount" name="total_discount" onKeyup="titikpemisah();" onkeypress="return hanyaAngka(event)" value='<?php echo $r[total_discount]; ?>' readonly/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label">
														Tgl/Bln/Thn <span class="symbol required"></span>
													</label>
													<p class="input-group input-append datepicker date" data-date-format='yyyy-mm-dd'>
														<input type="text" class="form-control" id="waktu" name="waktu" value="<?php echo $r[waktu]; ?>"/>
														<span class="input-group-btn">
															<button type="button" class="btn btn-default">
																<i class="glyphicon glyphicon-calendar"></i>
															</button> </span>
													</p>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Harus di isi
													<hr>
												</div>
											</div>
										</div>
										<div class="row">											
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=window.location.href='?module=sub_transaksi_pengajuan_discount';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Cancel </span>
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