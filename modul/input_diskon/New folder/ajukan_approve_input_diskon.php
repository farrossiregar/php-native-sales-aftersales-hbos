<?php

$disc_approved=str_replace(".","",$_POST['disc_approved']);
	$a = "select t.nama_tipe as nama_tipe, w.nama_warna as nama_warna, m.nama_model as nama_model ,pd.* from pengajuan_discount pd 
			left join tipe t on t.kode_tipe=pd.tipe_mobil
			left join model m on m.kode_model=pd.model
			left join warna w on w.kode_warna=pd.warna
			where pd.no_pengajuan='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
	
	$model = $r['nama_model'];
	$tipe_mobil = $r['nama_tipe'];
	$warna = $r['nama_warna'];
				
	if(count($_POST)) {
			
	mysql_unbuffered_query("update pengajuan_discount set status_approved = '$_POST[status_approved]', proses_approve = 'Y',user_approve = 'Sedang Diajukan' where no_pengajuan = '$_GET[id]'");
				
						
	$msg = "
					
		<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4><i class='icon fa fa-check'></i> Selamat!</h4>
		Anda telah mengajukan ke direktur.
		</div>
		
		";
		
                    	$a = "select t.nama_tipe as nama_tipe, w.nama_warna as nama_warna, m.nama_model as nama_model ,pd.* from pengajuan_discount pd 
                    			left join tipe t on t.kode_tipe=pd.tipe_mobil
                    			left join model m on m.kode_model=pd.model
                    			left join warna w on w.kode_warna=pd.warna
                    			where pd.no_pengajuan='$_GET[id]'";
                    	
                    	$kueri = mysql_query($a);
                    	$r = mysql_fetch_array($kueri);
	
	
	                   $statusaprrov=$r[status_approved];
    					    if($statusaprrov=="Y") {
    						    $statusaprrov="Disetujui"; 
    						}
    						if($statusaprrov=="N") {
    						    $statusaprrov="Tidak Disetujui"; 
    						}
    						if($statusaprrov=="AL") {
    						    $statusaprrov="Sedang Diajukan ke Direktur"; 
    						}
	                    
	                    $harga_otr = "Rp ".number_format("$r[harga_otr]",0,".",".");
						$discount_unit = "Rp ".number_format("$r[discount_unit]",0,".",".");
						$total_discount_accs = "Rp ".number_format("$r[total_discount_accs]",0,".",".");
						$pengajuan_disc = "Rp ".number_format("$r[pengajuan_disc]",0,".",".");
						$total_discount = "Rp ".number_format("$r[total_discount]",0,".",".");
						$total_discount = "Rp ".number_format("$r[total_discount]",0,".",".");
						$disc_approved = "Rp ".number_format("$r[disc_approved]",0,".",".");
						$refund = "Rp ".number_format("$r[refund]",0,".",".");
	
                        $to = "gusti_it@honda-bintaro.com, abdullah_it@honda-bintaro.com, benni_it@honda-bintaro.com, tinkoksin@honda-bintaro.com";
						//$to = "gusti_it@honda-bintaro.com";
						
						                        
						
						$subject = "Informasi Permohonan Diskon Online";
						
						$message = "
						
						<html>
                    	<head>
                    	<title>Informasi Permohonan Diskon Online</title>
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
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>PD".$r[no_pengajuan]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Tgl Pengajuan:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[waktu]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>No SPK:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[no_spk]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Nama Customer:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[nama_customer]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Unit:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$model." ".$tipe_mobil." ".$warna."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Harga OTR:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$harga_otr."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Diskon Plafon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$discount_unit."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Pengajuan Diskon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$pengajuan_disc."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; border-bottom:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Keterangan Diskon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; border-bottom:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".nl2br($r[ket_discount])."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Total Diskon Aksesoris:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$total_discount_accs."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Refund:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$refund."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Total Diskon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$total_discount."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Metode Pembayaran:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[cara_beli]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Nama Leasing:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[leasing]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Tenor:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[tenor]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Pemohon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[pemohon]."</td>
                    	</tr>
                    	
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Status Persetujuan:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$statusaprrov."</td>
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
	                    
	                    
	                    // Always set content-type when sending HTML email
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        // More headers
                        $headers .= 'From: <permohonan.diskon@honda-bintaro.com>' . 'Permohonan Diskon Honda Bintaro';
                        
                        $mail_sent = @mail( $to, $subject, $message, $headers );
		
	}
	
	//$join = "select PD.*,PK.kode_tipe,PK.nilaikwitansi,PK.nama_tipe,PK.accessories,PK.kode_warna,PK.nama_warna from pengajuan_discount PD left join pesanan_kendaraan PK on PK.nomor = PD.no_spk where PD.no_pengajuan='$_GET[id]'";
	//$kuery = mysql_query($join);
	//$l = mysql_fetch_array($kuery);
	
	/*
	// MULAI JOIN NAMA, TIPE DAN WARNA MODEL
	$join = "select t.nama_tipe as nama_tipe, w.nama_warna as nama_warna, m.nama_model as nama_model ,pd.* from pengajuan_discount pd 
			left join tipe t on t.kode_tipe=pd.tipe_mobil
			left join model m on m.kode_model=pd.model
			left join warna w on w.kode_warna=pd.warna
			where pd.no_pengajuan='$_GET[id]'";
			
    $kuery = mysql_query($join);
    $rdata = mysql_fetch_array($kuery);
    
    $model = $rdata['nama_model'];
	$tipe_mobil = $rdata['nama_tipe'];
	$warna = $rdata['nama_warna'];
	// TUTUP JOIN NAMA, TIPE DAN WARNA MODEL
	*/
	
	$harga_otr = "Rp ".number_format("$r[harga_otr]",0,".",".");
	$discount_unit = "Rp ".number_format("$r[discount_unit]",0,".",".");
	$pengajuan_disc = "Rp ".number_format("$r[pengajuan_disc]",0,".",".");
	$total_discount_accs = "Rp ".number_format("$r[total_discount_accs]",0,".",".");
	$refund = "Rp ".number_format("$r[refund]",0,".",".");
	$total_discount = "Rp ".number_format("$r[total_discount]",0,".",".");

    $dt = "select * from data_mobil where kode_tipe = '$r[tipe_mobil]' and kode_warna = '$r[warna]' and nomatching = '' ";
    $cueri = mysql_query($dt);
    $sisa_stock = mysql_num_rows($cueri);
    /*
    $a = "select * from pengajuan_discount where no_pengajuan='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
	*/
	
	$status_approved=$r['status_approved'];
    
?>

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Ajukan Pengajuan Discount</h1>
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
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="media_showroom.php?module=sub_transaksi_pengajuan_discount&act=ajukanapprove&id=<?php echo $_GET[id]; ?>">
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
												
												<div class="table-responsive">
            										<table class="table table-bordered table-hover" id="sample-table-1">
            										    <tbody>
            												<tr class="info">
            													<td>No Pengajuan</td>
            													<td><?php echo $r[no_pengajuan] ?></td>
            												</tr>
            												<tr class="warning">
            													<td>No SPK</td>
            													<td><?php echo $r[no_spk] ?></td>
            												</tr>
            												<tr class="info">
            													<td>Nama Sales</td>
            													<td><?php echo $r[nama_sales] ?></td>
            												</tr>
            												<tr class="warning">
            													<td>Nama Customer</td>
            													<td><?php echo $r[nama_customer] ?></td>
            												</tr>
            													<tr class="info">
            													<td>Model</td>
            													<td><?php echo $model ?> </td>
            												</tr>
            												<tr class="warning">
            													<td>Tipe Mobil</td>
            													<td> <?php echo $r[tipe_mobil].' - '. $tipe_mobil ?></td>
            												</tr>
            											    <tr class="info">
            													<td>Warna Mobil</td>
            													<td> <?php echo $warna ?></td>
            												</tr>
            												<tr class="warning">
            													<td>Harga OTR</td>
            													<td><?php echo $harga_otr ?></td>
            												</tr>
            												<tr class="danger">
            													<td><b>Diskon Plafon</b></td>
            													<td><b><?php echo $discount_unit ?></b></td>
            												</tr>
            												
            												<tr class="info">
            													<td>Pengajuan Diskon</td>
            													<td><?php echo $pengajuan_disc ?></td>
            												</tr>
            												<tr class="warning">
            													<td>Keterangan Diskon</td>
            													<td><?php echo $r[ket_discount] ?></td>
            												</tr>
            												<tr class="info">
            													<td>Total Diskon Aksesoris</td>
            													<td><?php echo $total_discount_accs ?></td>
            												</tr>
            												<tr class="warning">
            													<td>Refund</td>
            													<td><?php echo $refund ?></td>
            												</tr>
            												<tr class="danger">
            													<td><b>Total Diskon</b></td>
            													<td><b><?php echo $total_discount ?></b></td>
            												</tr>
            												<tr class="info">
            													<td>Metode Pembayaran</td>
            													<td><?php echo $r[cara_beli] ?></td>
            												</tr>
            												<tr class="warning">
            													<td>Leasing</td>
            													<td><?php echo $r[leasing] ?></td>
            												</tr>
            												<tr class="info">
            													<td>Tenor</td>
            													<td><?php echo $r[tenor] ?></td>
            												</tr>
            												<tr class="warning">
            													<td>Pemohon</td>
            													<td><?php echo $r[pemohon] ?></td>
            												</tr>
            											</tbody>
            										</table>
            									</div>
												
												
											</div>
											<div class="col-md-6">
											    <div class="form-group">
													<input type="hidden" placeholder="No Pengajuan" class="form-control" value="PD<?php echo $r[no_pengajuan]; ?>" id="no_pengajuan" name="no_pengajuan" required readonly>
													</input>
												</div>
												<div class="form-group">
													<label class="control-label">
														Sisa Stock :  <span class="label label-info"><i class="fa fa-car"></i> <?php echo $sisa_stock; ?> Unit</span>
													</label>
													
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio1" name="status_approved" value="3" <? if($status_approved=='AL'){echo 'checked';}?>>
													<label for="radio1">
														Ajukan ke Direktur
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="status_approved" value="2" <? if($status_approved=='N'){echo 'checked';}?>>
													<label for="radio2">
														Tidak Di Setujui
													</label>
												</div>
											</div>
																					
											<div class="col-md-6">
											    <span class="symbol required"></span>Harus di isi
											    <hr>
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Simpan
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=window.location.href='?module=sub_transaksi_pengajuan_discount';>
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