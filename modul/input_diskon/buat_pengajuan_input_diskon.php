
			
	<?php 
		
		
		if(count($_POST)) {
		                $harga_otr=str_replace(".","",$_POST['harga_otr']);
		                $discount_unit=str_replace(".","",$_POST['discount_unit']);
		                $pengajuan_disc=str_replace(".","",$_POST['pengajuan_disc']);
		                $total_discount_accs=str_replace(".","",$_POST['total_discount_accs']);
		                $refund=str_replace(".","",$_POST['refund']);
		                $total_discount=str_replace(".","",$_POST['total_discount']);
		                
		                $hari_ini=date("ym");
                                                $query = "SELECT max(no_pengajuan) as last FROM pengajuan_discount WHERE no_pengajuan LIKE 'PD$hari_ini%'";
                                                $hasil = mysql_query($query);
                                                $data  = mysql_fetch_array($hasil);
                                                $lastNoTransaksi = $data['last'];
                                                $lastNoUrut = substr($lastNoTransaksi, 6, 3);
                                                $nextNoUrut = $lastNoUrut + 1;
                                                $nextNoTransaksi = $hari_ini.sprintf('%03s', $nextNoUrut);
                                                
                        mysql_unbuffered_query("insert into pengajuan_discount (no_pengajuan,no_spk,nama_customer,model,tipe_mobil,warna,harga_otr,discount_unit,pengajuan_disc,ket_discount,total_discount_accs,refund,total_discount,waktu,status_approved,cara_beli,leasing,tenor,pemohon,username_pemohon,nama_sales,kode_spv,tahun_buat,promo_dealer) 
							values('PD$nextNoTransaksi','$_POST[no_spk]','$_POST[nama_customer]','$_POST[model]','$_POST[tipe_mobil]','$_POST[warna]','$harga_otr','$discount_unit','$pengajuan_disc','$_POST[ket_discount]','$total_discount_accs','$refund','$total_discount','$_POST[waktu]','N','$_POST[cara_beli]','$_POST[leasing]','$_POST[tenor]','$_SESSION[namalengkap]','$_SESSION[username]','$_POST[nama_sales]','$_SESSION[kode_spv]','$_POST[tahun_buat]','$_POST[promo_dealer]')");
							
							$msg = "
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil menambah data.</div>";                        
		                
		                
				        $abc = "select t.nama_tipe as nama_tipe, w.nama_warna as nama_warna, m.nama_model as nama_model ,pd.* from pengajuan_discount pd 
				        left join tipe t on t.kode_tipe=pd.tipe_mobil
				        left join model m on m.kode_model=pd.model
				        left join warna w on w.kode_warna=pd.warna
				        where pd.no_pengajuan='PD$nextNoTransaksi'";
				        
				        //$a = "select * from pengajuan_discount where no_pengajuan='PD$nextNoTransaksi'";
                    	$kueri = mysql_query($abc);
                    	$r = mysql_fetch_array($kueri);
						
						$model = $r['nama_model'];
						$tipe_mobil = $r['nama_tipe'];
						$warna = $r['nama_warna'];
						
					    
						$today = date("Ymd"); //untuk mengambil tahun, tanggal dan bulan Hari INI
						
						$email_pemohon = mysql_fetch_array(mysql_query("select * from users where username = '$_SESSION[username]' ")) ;
	                    $email_pemohon = $email_pemohon['email'];
						
						$to = "gusti_it@honda-bintaro.com, benni_it@honda-bintaro.com, abdullah_it@honda-bintaro.com,burli_sales@honda-bintaro.com, $email_pemohon ";
						//$to = "gusti_it@honda-bintaro.com";
						
						                        
						
						$subject = "Informasi Pengajuan Diskon Online";
						$message = "
						
						<html>
                    	<head>
                    	<title>Informasi Pengajuan Diskon Online</title>
                    	</head>
                    	<body>
                    	<table width='50%' border='0' align='center' cellpadding='0' cellspacing='0'>
                    	<tr>
                    	<td colspan='2' align='center' valign='top'><img style=' margin-top: 15px; ' src='http://www.honda-bintaro.com/wp-content/uploads/2016/04/logo-honda-1-300x138.png' ></td>
                    	</tr>
                    	<tr>
                    	<td width='50%' align='right'>&nbsp;</td>
                    	<td align='left'>&nbsp;</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>No Pengajuan:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$nextNoTransaksi."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Tgl Pengajuan:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[waktu]."</td>
                    	</tr>
						<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Nama Sales:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[nama_sales]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>No SPK:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[no_spk]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Nama Customer:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[nama_customer]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Unit:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$model." ".$tipe_mobil." ".$warna."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Harga OTR:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[harga_otr]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Diskon Unit:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[discount_unit]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Pengajuan Diskon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[pengajuan_disc]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; border-bottom:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Keterangan Diskon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; border-bottom:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".nl2br($_POST[ket_discount])."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Total Diskon Aksesoris:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[total_discount_accs]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Refund:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[refund]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Total Diskon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[total_discount]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Metode Pembayaran:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[cara_beli]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Nama Leasing:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[leasing]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Tenor:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[tenor]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Pemohon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_SESSION[namalengkap]."</td>
                    	</tr>
                    	</table>
                    	</body>
                    	</html>
						
						<br /><br />
						Please don't reply this email,
						<br /><br />
						IT Team.
						<br /><br />
						<font color='#b4b4b4'>DISCLAIMERS : This e-mail, including any attachment is confidential. Use or disclosure of it by anyone other than an intended addressee is strictly prohibited. If you are not an intended addressee, please notify the sender by telephone or e-mail and delete the e-mail and any attachment from your system. PT. Gading Prima Perkasa does not accept any liability in respect of communication made by its employee which is contrary to the company policy or outside the scope of the employment of the individual concerned. The employee responsible will be personally liable for any damages or other liability arising.</font>
						";
						
						//DAH GAK KEPAKE NIH, ADA YANG BARU MAH LUPA SAMA YG LAMA T_T
                        //$message .= "No Pengajuan           : PD$nextNoTransaksi \n";
                        //$message .= "Tgl Pengajuan          : $_POST[waktu] \n";
                        //$message .= "No SPK                 : $_POST[no_spk] \n";
                        //$message .= "Nama Customer          : $_POST[nama_customer] \n";
                        //$message .= "Harga OTR              : $_POST[harga_otr] \n";
                        //$message .= "Diskon Unit            : $_POST[discount_unit] \n";
                        //$message .= "Pengajuan Diskon       : $_POST[pengajuan_disc] \n";
                        //$message .= "Keteranga  Diskon      : $_POST[ket_discount] \n";
                        //$message .= "Total Diskon Aksesoris : $_POST[total_discount_accs] \n";
                        //$message .= "Refund                 : $_POST[refund] \n";
                        //$message .= "Total Diskon           : $_POST[total_discount] \n";
                        //$message .= "Metode Pembayaran      : $_POST[cara_beli] \n";
                        //$message .= "Nama Leasing           : $_POST[leasing] \n";
                        //$message .= "Tenor                  : $_POST[tenor] \n";
                        //$message .= "Pemohon                : $_SESSION[namalengkap] \n";
                        
                        // Always set content-type when sending HTML email
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        //$headers .= 'From: <pengajuan.diskon@honda-bintaro.com>' . "Pengajuan Diskon Honda Bintaro";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        // More headers
                        $headers .= 'From: <pengajuan.diskon@honda-bintaro.com>' . 'Pengajuan Diskon Honda Bintaro';
                        
                        $mail_sent = @mail( $to, $subject, $message, $headers );
						
							
						

						
						/*
						if(mysql_num_rows($kueri)==0){
							mysql_unbuffered_query("insert into pengajuan_discount (no_pengajuan,no_spk,nama_customer,model,tipe_mobil,harga_otr,discount_unit,pengajuan_disc,ket_discount,total_discount_accs,refund,total_discount,waktu,status_approved,cara_beli,leasing,tenor) 
							values('PD$nextNoTransaksi','$_POST[no_spk]','$_POST[nama_customer]','$_POST[model]','$_POST[tipe_mobil]','$_POST[harga_otr]','$discount_unit','$pengajuan_disc','$_POST[ket_discount]','$total_discount_accs','$refund','$total_discount','$_POST[waktu]','N','$_POST[cara_beli]','$_POST[leasing]','$_POST[tenor]')");
							
							$msg = "
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil menambah data.</div>";
						}else{
							$msg = "							
							<div class='alert alert-warning alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-warning'></i> Peringatan!</h4>
							No SPK Sudah Ada.</div>";
						} */
						
					}

					
				
				
?>

		
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Discount SPK</h1>
									<span class="mainDescription">Input Discount SPK</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li class="active">
										<span>Input Discount SPK</span>
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
                                      
                                    					
                                        
                                        
										function cek_input() {
											/*
										    var cek = document.forms['form']['no_spk'].value;
											 if(cek==null || cek=="")
											 {
											   alert("Nomor spk harus diisi !!!");
											   return false;
											 }
											 */
											hitung_refund();

											
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
											
											
										}
										
										
                                    
                                    </script>    
                                    
									<!-- TEST PESAN DENGAN MODAL DISKON========================================== BERHASIL TAPI KURANG KUL
									
									<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
													<h4 class="modal-title" id="myModalLabel">Modal title</h4>
												</div>
												<div class="modal-body">
													Modal Content
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
														Close
													</button>
													<button type="button" class="btn btn-primary">
														Save changes
													</button>
												</div>
											</div>
										</div>
									</div>
									
									-->
									
									
									
									
									<!--form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="" onsubmit = "return cekdiskon();"-->
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="" onsubmit = "return cek_input();">
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
														No SPK <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="No SPK" class="form-control" id="no_spk" maxlength="12" name="no_spk" required >
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
    													<select name="tipe_mobil" id = "tipe_mobil" class = "form-control" required onchange = "harga_otomatis();" >	
    														<option value="" selected disabled >PILIH TIPE</option>
    													</select>
    											</div>
    												<div class="form-group">
    													<label for="form-field-select-2">
    														Pilih Warna <span class="symbol required"></span>
    													</label>													
    													<select name="warna" id="warna" class = "form-control" onchange = "harga_otomatis();" >														
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
													<select name="tahun_buat" id="tahun_buat" class="form-control" onchange = "harga_otomatis();" > 
													<option selected value="">PILIH TAHUN</option>
													<option value="2016" >2016</option>
													<option value="2017" >2017</option>
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
												<div class="form-group">
													<label for="form-field-select-2">
														Program Marketing <span class="symbol required"></span>
													</label>													
													<select name="promo_dealer" id="promo_dealer" class = "form-control" onchange = "promo_dealer1();"  >														
														<option value="" selected >PILIH PROGRAM</option>
														<option value="Tidak Ikut Program">TIDAK IKUT PROGRAM</option>
														<option value="BCA KOMBINASI">BCA KOMBINASI</option>
													</select>
												</div>
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
														<input type="radio" id="radio2" class="metodebayar" name="cara_beli" value="KREDIT" onclick="addreadonly();" >
														<label for="radio2">
															Kredit
														</label>
													</div>
													<div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio3" class="metodebayar" name="cara_beli" value="COP" onclick="removereadonly();" >
														<label for="radio3">
															COP
														</label>
													</div>
													<div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio4" class="metodebayar" name="cara_beli" value="GSO" onclick="removereadonly();" >
														<label for="radio4">
															GSO
														</label>
													</div>
												</fieldset>
												<div class="form-group" id="id_leasing">
													<label for="form-field-select-2">
														Nama leasing <span class="symbol required"></span>
													</label>
													<select name='leasing' id='leasing' class='form-control' onchange = "hitung_refund();">
													<option selected value=''>PILIH LEASING</option>
													<option value='MBF' >MBF</option>
													<option value='MTF' >MTF</option>
													<option value='OTO MULTIARTHA' >OTO MULTIARTHA</option>
													<option value='MY BANK' >MAYBANK</option>
													
													<option value='(KKB) BCA' >KKB BCA</option>
													<option value='BCA FINANCE' >BCA FINANCE</option>
													<option value='MAF' >MAF</option>
												    </select>
												</div>
												<div class="form-group" id="id_tenor">
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
												<fieldset id="jenis_asuransi" style="display:none;">
													<legend>
														Asuransi
													</legend>
												<div>
													
													<!--div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio7" class="allrisk" name="asuransi" value="allrisk" onclick="removereadonly();" required>
														<label for="radio7">
															All Risk
														</label>
													</div-->
													<div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio8" class="kombinasi" name="asuransi" value="kombinasi" onclick="addreadonly();" disabled>
														<label for="radio8">
															Kombinasi
														</label>
													</div>
												</div>
												</fieldset>
												<div class="form-group">
													<label class="control-label">
														Refund <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" readonly id="refund" name="refund" onkeypress="return hanyaAngka(event)" onFocus="startCalc();" onBlur="stopCalc();" onKeyup="titikpemisah();"/>
													</div>
												</div>
												<div class="form-group" >
													<label class="control-label">
														Plafon Discount <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" readonly id="discount_unit" required name="discount_unit" onkeypress="return hanyaAngka(event)" onKeyup="titikpemisah();"/>
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
														<input type="text" class="form-control" id="waktu" readonly name="waktu" value="<?php echo date('Y-m-d'); ?>" />
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
												<button class="btn btn-primary btn-wide" type="submit" id="gar-contact-button" >
													<i class="fa fa-save"></i> Simpan
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='media_showroom.php?module=sub_transaksi_input_discount';>
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
		
		
		
		
		
		
