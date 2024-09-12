
					
		
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Pengajuan Discount</h1>
									<span class="mainDescription">Buat Pengajuan Discount</span>
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
								    
                                    <script language="JavaScript">
                                      function removereadonly(){
                                        var read=document.getElementById("refund")
                                            .removeAttribute("readonly",0);
                                        //var read=document.getElementById("leasing")
                                           // .removeAttribute("required",0);  
                                       // var read=document.getElementById("tenor")
                                           // .removeAttribute("required",0);
                                     //alert("atribut textbox readonly telah terhapus");
                                      }
                                      function addreadonly(){
                                          document.getElementById("refund").readOnly = true;
                                          //document.getElementById("leasing").required = true;
                                          //document.getElementById("tenor").required = true;
                                      }
                                      
									
									 function removerequire(){
                                      //  var read=document.getElementById("k")
                                         //   .removeAttribute("readonly",0);
                                        var read=document.getElementById("ket_asuransi")
                                            .removeAttribute("required",0);  
                                       // var read=document.getElementById("tenor")
                                           // .removeAttribute("required",0);
                                     //alert("atribut textbox readonly telah terhapus");
                                      }
                                      function addrequire(){
                                         // document.getElementById("refund").readOnly = true;
                                          document.getElementById("ket_asuransi").required = true;
                                          //document.getElementById("tenor").required = true;
                                      }
		
		
		
		
										function cek_input_pengajuan_diskon() {
											/*
											var cek = document.forms['form']['no_spk'].value;
											 if(cek==null || cek=="")
											 {
											   alert("Nomor spk harus diisi !!!");
											   return false;
											 }
											 */
											//hitung_refund();

											
											plafon_disc = document.form.discount_unit.value;
											total_discount = document.form.total_discount.value; 
											total_diskon_bruto = document.form.discbruto.value;
											
											
											
											
											var rupiah1 = plafon_disc;
											var rupiah2 = total_discount;
											
											var rupiah4 = total_diskon_bruto;
											
											var plafon_disc1 = rupiah1.replace(/\D/g, '');
											var total_discount1 = rupiah2.replace(/\D/g, '');
											var total_discount_bruto1 = rupiah4.replace(/\D/g, '');
											
											/* untuk diskon berdasarkan diskon netto
											if (total_discount1 > plafon_disc1){
												alert("Total diskon tidak boleh lebih besar dari plafon diskon !!!");
											   return false;
											}
											*/
											
											
											
											
											var nama_Warna = (document.form.warna.value).length;
											var TahunBuat = (document.form.tahun_buat.value).length;
											var PromoDealer = (document.form.promo_dealer.value).length;											
											var CaraBeli = (document.form.cara_beli.value).length;
											var metodebyr = $('input[name=cara_beli]:checked').val();
											var Jenis_identitas = (document.form.jenis_identitas.value).length;
											var No_identitas = (document.form.no_identitas.value).split(' ').join('').length;
											var Hp_customer = (document.form.hp_customer.value).split(' ').join('').length;
											var Alamat_customer = (document.form.alamat_customer.value).split(' ').join('').length;
											 
											
											
											var Leasing = (document.form.leasing.value).length;
											var Tenor = (document.form.tenor.value).length;
											
											
											if (Jenis_identitas < 1){
												swal({
													title: "Peringatan!",
													text: "Jenis Identitas Tidak Boleh Kosong",
													type: "warning",
													confirmButtonColor: "#007AFF"
												});
												
												//document.form.warna.focus();
												return false;
												
											}
											
											if (No_identitas < 1){
												swal({
													title: "Peringatan!",
													text: "Nomor Identitas Tidak Boleh Kosong",
													type: "warning",
													confirmButtonColor: "#007AFF"
												});
												
												//document.form.warna.focus();
												return false;
												
											}
											
											if (Hp_customer < 1){
												swal({
													title: "Peringatan!",
													text: "Nomor HP Customer Tidak Boleh Kosong",
													type: "warning",
													confirmButtonColor: "#007AFF"
												});
												
												//document.form.warna.focus();
												return false;
												
											}
											
											if (Alamat_customer < 1){
												swal({
													title: "Peringatan!",
													text: "Alamat Customer Tidak Boleh Kosong",
													type: "warning",
													confirmButtonColor: "#007AFF"
												});
												
												//document.form.warna.focus();
												return false;
												
											}
											
											if (nama_Warna < 1){
												swal({
													title: "Peringatan!",
													text: "Warna Mobil Tidak Boleh Kosong",
													type: "warning",
													confirmButtonColor: "#007AFF"
												});
												
												//document.form.warna.focus();
												return false;
												
											}
											if (TahunBuat < 1){
												swal({
													title: "Peringatan!",
													text: "Tahun Mobil Tidak Boleh Kosong",
													type: "warning",
													confirmButtonColor: "#007AFF"
												});
												
												//document.form.tahun_buat.focus();
												return false;
												
											}
											
											if (PromoDealer < 1){
												swal({
													title: "Peringatan!",
													text: "Program Marketing Tidak Boleh Dikosongkan",
													type: "warning",
													confirmButtonColor: "#007AFF"
												});
												
												
												return false;
												
											}
											
											if (CaraBeli < 1){
												swal({
													title: "Peringatan!",
													text: "Metode Pembayaran Tidak Boleh Dikosongkan",
													type: "warning",
													confirmButtonColor: "#007AFF"
												});
												
												
												return false;
												
											}
											
											
											if (metodebyr == "KREDIT"){
												if (Leasing < 1) {
													swal({
														title: "Peringatan!",
														text: "Leasing Tidak Boleh Dikosongkan",
														type: "warning",
														confirmButtonColor: "#007AFF"
													});
													return false;
												}
												if (Tenor < 1) {
													swal({
														title: "Peringatan!",
														text: "Tenor Tidak Boleh Dikosongkan",
														type: "warning",
														confirmButtonColor: "#007AFF"
													});
													return false;
												}
											}
												
												
											
											
											
											/*
											
											if (total_discount_bruto1 > plafon_disc1){
												//alert("Total diskon tidak boleh lebih besar dari plafon diskon !!!");
												//	$('#myModal2').modal('show');	


												swal({
													title: "Peringatan!",
													text: "Diskon Tidak Boleh Lebih Besar Dari Rp " + rupiah1 ,
													type: "warning",
													confirmButtonColor: "#007AFF"
												});
												//e.preventDefault;

												
												  return false;
											}
											
											*/
											
										}
										
										function asal_prospek(){
											var isipd = $('input[name=asal_prospek]:checked').val();
											//alert(isipd);
											$.ajax({
												method : "post",
												url : "modul/pengajuan_diskon/get_asal_prospek.php",
												data : {data_ajax : isipd},
												success : function(data){
													$('#ket_asal_prospek').html(data);
													//console.log(data);
													//$('#harga_otr').val(10000000);
												
												}
												
											})
											
											
										}
										
									/*	function get_kombinasi(){
											
										}	*/
										
										
									/*	function leasing_match(){
											var leas1 = $('#promo_dealer').val();
											var leas1_mtc = leas1.replace("KOMBINASI", "");
										//	alert(leas1_mtc);
											var rtn = $('#leasing3').val(leas1_mtc); 
										   return rtn;
										//	return leas1;
										}	*/
                                    </script>
                                   
                                    
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="modul/pengajuan_diskon/simpan_pengajuan.php" onsubmit ="return cek_input_pengajuan_diskon();">
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
											    
											    <?php
											    $today=date("ym");
                                                $query = "SELECT max(no_pengajuan) as last FROM pengajuan_discount WHERE no_pengajuan LIKE 'PD$today%'";
                                                $hasil = mysql_query($query);
                                                $data  = mysql_fetch_array($hasil);
                                                $lastNoTransaksi = $data['last'];
                                                $lastNoUrut = substr($lastNoTransaksi, 6, 3);
                                                $nextNoUrut = $lastNoUrut + 1;
                                                $nextNoTransaksi = $today.sprintf('%03s', $nextNoUrut);
                                                ?>
											    <div class="form-group">
													<label class="control-label">
														No Pengajuan <span class="symbol required"></span>
													</label>
													<input type="text" placeholder="No Pengajuan" class="form-control" value="PD<?php echo $nextNoTransaksi; ?>" id="no_pengajuan" name="no_pengajuan" required readonly>
													</input>
												</div>
																								
												<div class="form-group">
													<label class="control-label">
														Nama Sales <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Sales" class="form-control" id="nama_sales" name="nama_sales" required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Nama Customer <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Customer" class="form-control" id="nama_customer" name="nama_customer" required>
												</div>
												<fieldset>
													<legend>
														Jenis Identitas
													</legend>
													<div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio5" name="jenis_identitas" value="KTP" >
														<label for="radio5">
															KTP
														</label>
													</div>
													<div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio6" name="jenis_identitas" value="SIM" >
														<label for="radio6">
															SIM
														</label>
													</div>
													<div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio7" name="jenis_identitas" value="NPWP" >
														<label for="radio7">
															NPWP
														</label>
													</div>
												</fieldset>
												<div class="form-group">
													<label class="control-label">
														No Identitas Customer <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="No Identitas Customer" class="form-control" id="no_identitas" name="no_identitas" >
												</div>
												<div class="form-group">
													<label class="control-label">
														No Handphone Customer <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="No handphone Customer" class="form-control" id="hp_customer" name="hp_customer" >
												</div>
												<div class="form-group">
													<div class="panel-heading">
													<div class="panel-title">
														Alamat Customer
													</div>
											    	</div>
													<div class="panel-body">
														<div class="form-group">
															<div class="note-editor">
																<textarea class="form-control" id="alamat_customer" name="alamat_customer" ></textarea>
															</div>
														</div>
													</div>
												</div>
												<fieldset >
													
														<legend>
															Asal Prospek
														</legend>
													<div id = "asal_prospek" onchange="asal_prospek();">
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio9" name="asal_prospek" value="RETAIL" >
															<label for="radio9">
																RETAIL
															</label>
														</div>
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio10" name="asal_prospek" value="MOVING" >
															<label for="radio10">
																MOVING
															</label>
														</div>
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio11" name="asal_prospek" value="EVENT" >
															<label for="radio11">
																EVENT
															</label>
														</div>
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio12" name="asal_prospek" value="PAMERAN" >
															<label for="radio12">
																PAMERAN
															</label>
														</div>
													</div>
													<div id="ket_asal_prospek">													
													
													</div>
												</fieldset>
												
												
												
												<div class="form-group">
													<label for="form-field-select-2">
														Mobil <span class="symbol required"></span>
													</label>
													<select name = "model" id="model" class = "form-control" required >														
    														<option value="" selected disabled>PILIH MODEL</option>
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
    													<select name="tipe_mobil" id = "tipe_mobil" class = "form-control" required onchange = "harga_otomatis('baru');" >	
    														<option value="" selected disabled >PILIH TIPE</option>
    													</select>
    											</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Pilih Warna <?php  //$tgl =date('Y-m-d'); if($tgl > '2017-12-01'){echo "wawaw";}?> <span class="symbol required"></span>
													</label>													
													<select name="warna" id="warna" class = "form-control" onchange = "harga_otomatis('baru');" >														
														<option value="" selected disabled>PILIH WARNA</option>
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
													<label for="form-field-select-2">
														Tahun <span class="symbol required"></span>
													</label>
													<select name="tahun_buat" id="tahun_buat" class="form-control"  onchange = "harga_otomatis('baru');" >
													<option selected value="">PILIH TAHUN</option>
													<option value="2016" >2016</option>
													<option value="2017" >2017</option>
													<option value="2018" >2018</option>
													<option value="2019" >2019</option>
													
												    </select>
												</div>
												<div class="form-group">
													<label class="control-label">
														Harga OTR <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" id="harga_otr" required name="harga_otr" readonly onkeypress="return hanyaAngka(event)" onKeyup="titikpemisah();"/>
													</div>
												</div>
												<!--div class="form-group">
													<div class="checkbox clip-check check-primary checkbox-inline">
														<input id="checkbox4" value="1"  type="checkbox">
														<label for="checkbox4">
															Ikut Program Marketing
														</label>
													</div>
												</div-->
												
												<div class="form-group">
													<label for="form-field-select-2">
														Program Marketing <span class="symbol required"></span>
													</label>													
													<select name="promo_dealer" id="promo_dealer" class = "form-control" onchange = "promo_dealer1();"  >														
														<option value="" selected >PILIH PROGRAM</option>
														<option value="Tidak Ikut Program">TIDAK IKUT PROGRAM</option>
														<!--option value="BCA KOMBINASI">BCA KOMBINASI</option>
														<option value="MBF KOMBINASI">MBF KOMBINASI</option>
														<option value="MTF KOMBINASI">MTF KOMBINASI</option>
														<option value="OTO MULTIARTHA KOMBINASI">OTO MULTIARTHA KOMBINASI</option-->
														<!--option value="MAYBANK KOMBINASI">MAYBANK KOMBINASI</option-->
														<option value="MTF KOMBINASI" onclick="removerequire();">MTF KOMBINASI</option>
														<!--option value="CLIPAN KOMBINASI">CLIPAN KOMBINASI</option-->
													</select>
												</div>
												<!---- buat dummy -->
												<fieldset id="id_metodebyr2" style="display:none;">
													<legend>
														Metode Pembayaran
													</legend>
													
													
													<div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio12" class="metodebayar" name="cara_beli3" value="KREDIT" onclick="addreadonly();" checked >
														<label for="radio12">
															Kredit
														</label>
													</div>
													
												</fieldset>
												<div class="form-group" id="id_leasing2" style="display:none;">
													<label for="form-field-select-2">
														Nama leasing  <span class="symbol required"></span>
													</label>
													<!--input type="text" disabled name='leasing3' id='leasing3' class='form-control' onchange = "hitung_refund();" -->	
													<select  name='leasing3' id='leasing3' class='form-control' onchange = "hitung_refund();" >
														<option selected value=" " >MTF</option>
												    </select>
												</div>
												
												<!---->
												
												<fieldset id="id_metodebyr">
													<legend>
														Metode Pembayaran
													</legend>
													
													<div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio1" class="metodebayar" name="cara_beli" value="TUNAI" onclick="removereadonly();" >
														<label for="radio1">
															Tunai
														</label>
													</div>
													<div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio2" class="metodebayar" name="cara_beli" value="KREDIT" onclick="addreadonly(); removerequire();" >
														<label for="radio2">
															Kredit
														</label>
													</div>
													<div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio3" class="metodebayar" name="cara_beli" value="COP" onclick="removereadonly(); removerequire();" >
														<label for="radio3">
															COP
														</label>
													</div>
													<div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio4" class="metodebayar" name="cara_beli" value="GSO" onclick="removereadonly(); removerequire();">
														<label for="radio4">
															GSO
														</label>
													</div>
												</fieldset>
												
												<fieldset id="ikut_asuransi" style="display:none;">
													<legend>
														Ikut Asuransi
													</legend>
													
													<div id = "id_ikut_asuransi">
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio20"  name="ikut_asuransi" value="Y"  onclick=" removerequire();">
															<label for="radio20">
																Ya
															</label>
														</div>
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio21"  name="ikut_asuransi" value="N"  onclick="addrequire();">
															<label for="radio21">
																Tidak
															</label>
														</div>
													</div>
													<div id="nama_asuransi" style="display:none;">
														<div class="form-group" >
															<label for="form-field-select-2">
																Nama Asuransi <span class="symbol required"></span>
															</label>
															<select name="asuransi" id="asuransi" class="form-control" >
															<option selected value=''>PILIH ASURANSI</option>
															<option value='ARTARINDO' >ARTARINDO</option>
															<option value='BESS' >BESS</option>
															
															</select>
														</div>
													
													</div>
													
													<div id="keterangan_asuransi" style="display:none;">
														<div class="form-group">
															<div class="panel-heading">
																<div class="panel-title">
																	Keterangan Asuransi
																</div>
															</div>
															<div class="panel-body">
																<div class="form-group">
																	<div class="note-editor">
																		<textarea class="form-control" id="ket_asuransi" name="ket_asuransi"></textarea>
																	</div>
																</div>
															</div>
														</div>
													
													</div>
													
												</fieldset>
												
												<div class="form-group" id="id_leasing" style="display:none;>
													<label for="form-field-select-2">
														Nama leasing <span class="symbol required"></span>
													</label>
													<select name='leasing' id='leasing' class='form-control' onchange = "hitung_refund();" >
													<option selected value=''>PILIH LEASING</option>
													<option value='MBF' >MBF</option>
													<option value='MTF' >MTF</option>
													<option value='OTO MULTIARTHA' >OTO MULTIARTHA</option>
													<option value='MY BANK' >MAYBANK</option>
													<option value='(KPM) MANDIRI' >KPM MANDIRI</option>
													<option value='(KKB) MAYBANK' >KKB MAYBANK</option>
													<option value='(KKB) BCA' >KKB BCA</option>
													<option value='BCA FINANCE' >BCA FINANCE</option>
													<option value='MAF' >MAF</option>
													<option value="CLIPAN">CLIPAN</option>
												    </select>
												</div>
												<div class="form-group" id="id_tenor" style="display:none;>
													<label for="form-field-select-2">
														Tenor <span class="symbol required"></span>
													</label>
													<select name='tenor' id='tenor' class='form-control' onchange = "hitung_refund();" >
													<option selected value=''>PILIH TENOR</option>
													<option value='1tahun' >1 TAHUN</option>
													<option value='2tahun' >2 TAHUN</option>
													<option value='3tahun' >3 TAHUN</option>
													<option value='4tahun' >4 TAHUN</option>
													<option value='5tahun' >5 TAHUN</option>
													<option value='6tahun' >6 TAHUN</option>
												    </select>
												</div>
												
												<div class="form-group" >
													<label class="control-label">
														Refund <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" readonly class="form-control" id="refund" name="refund" onkeypress="return hanyaAngka(event)" onFocus="startCalc();" onBlur="stopCalc();" onKeyup="titikpemisah();"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label">
														Plafon Discount <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" id="discount_unit" required name="discount_unit" onkeypress="return hanyaAngka(event)" onKeyup="titikpemisah();" readonly />
													</div>
												</div>
												
												<div class="form-group">
													<label class="control-label">
														Pengajuan Discount <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" id="pengajuan_disc" required name="pengajuan_disc" onFocus="startCalc();" onBlur="stopCalc();" onkeypress="return hanyaAngka(event)" onKeyup="titikpemisah();"/>
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
															<textarea class="form-control" id="ket_discount" name="ket_discount" required></textarea>
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
															<input type="text" class="form-control" id="total_discount_accs" name="total_discount_accs" onkeypress="return hanyaAngka(event)" onFocus="startCalc();" onBlur="stopCalc();" onKeyup="titikpemisah();"/>
													</div>
												</div>
												
												<div class="form-group">
													<label class="control-label">
														Total Discount Bruto <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" onKeyup="titikpemisah();" id="discbruto" name="discbruto" readonly /> 
													</div>
												</div>												
												
												
												<div class="form-group"> 
													<label class="control-label">
														Total Discount Netto <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" onKeyup="titikpemisah();" id="total_discount" name="total_discount" readonly /> 
													</div>
												</div>
													
											
												<div class="form-group" style = display:none;>
													<label class="control-label">
														Tgl Pengajuan <span class="symbol required"></span>
													</label>
													<p class="input-group input-append datepicker date " data-date-format='yyyy-mm-dd'>
														<input type="text" class="form-control" id="waktu" readonly name="waktu" value="<?php echo date('Y-m-d H:i:s'); ?>" />
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=prospek_pengajuandiscount';>
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
		
		
		
		
		
		
