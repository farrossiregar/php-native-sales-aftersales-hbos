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
	
		if ($_POST[status_spk] == "Y"){
			mysql_unbuffered_query("update pengajuan_discount set tgl_spk = '$_POST[tgl_spk]', no_spk = '$_POST[no_spk]',status_spk = '$_POST[status_spk]',ket_tidakspk = '$_POST[ket_tidakspk]' where no_pengajuan = '$_GET[id]'");
			
		}else {
			mysql_unbuffered_query("update pengajuan_discount set no_spk = '',status_spk = '$_POST[status_spk]',ket_tidakspk = '$_POST[ket_tidakspk]' where no_pengajuan = '$_GET[id]'");
		}
	
				
						
	$msg = "
					
		<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4><i class='icon fa fa-check'></i> Selamat!</h4>
		Nomor SPK Berhasil disimpan
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
	
                        //$to = "gusti_it@honda-bintaro.com, abdullah_it@honda-bintaro.com, benni_it@honda-bintaro.com, tinkoksin@honda-bintaro.com";
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
                        
                        //$mail_sent = @mail( $to, $subject, $message, $headers );
		
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

   
    /*
    $a = "select * from pengajuan_discount where no_pengajuan='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
	*/
	
	$status_approved=$r['status_approved'];
	$status_spk = $r['status_spk'];
	$no_spk = $r['no_spk'];
    
?>

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Isi Nomor SPK</h1>
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
											<div class="col-md-12">
												<div class="panel panel-primary">
												
													<div class="panel-body" style = "text-align:center;">
														
																No Pengajuan : <?php echo $r[no_pengajuan] ?> <br/>
							
																Sales : <?php echo $r[pemohon] ?><br/>
																Status :  <?php echo ($r[proses_approve] == "Y" ? ( $r[status_approved] == "Y" ? "Di Setujui " : ($r[status_approved] == "N" ? "Tidak Disetujui" : "Menunggu Persetujuan BOD"   )) : "Belum Diproses" );   ?>
																<?php echo ($r[ket_approve] != "" ? "<br/>Catatan : $r[ket_approve] " : ""); ?>
																<?php echo ($r[status_spk] == "N" ? "<br/><font color='orange'>Tidak SPK </font></br> Catatan : $r[ket_tidakspk]"  : ""  ); ?>
																							
													</div>
												</div>
												<div class="panel panel-white collapses" id="panel5">
													<a data-original-title="Tampilkan" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
													<div class="panel-heading">
														<h4 class="panel-title text-primary">Detail pengajuan</h4>
														<div class="panel-tools">
															<a data-original-title="Tampilkan" data-toggle="tooltip" data-placement="top" class="btn btn-transparent btn-sm panel-collapse" href="#"><i class="ti-minus collapse-off"></i><i class="ti-plus collapse-on"></i></a>
														</div>
													</div>
													</a>
													<div class="panel-body" style="display: none;">
														
															<table class="table table-bordered table-hover" id="sample-table-1">
																<tbody>
																	
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
																		<td>Hp Customer</td>
																		<td><?php echo $r[hp_customer] ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Jenis Identitas</td>
																		<td><?php echo $r[jenis_identitas] ?></td>
																	</tr>
																	<tr class="info">
																		<td>Nomor Identitas</td>
																		<td><?php echo $r[no_identitas] ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Alamat Customer</td>
																		<td><?php echo $r[alamat_customer] ?></td>
																	</tr>
																		<tr class="info">
																		<td>Model</td>
																		<td><?php echo $model ?> </td>
																	</tr>
																	<tr class="warning">
																		<td>Tipe Mobil</td>
																		<td> <?php echo $r[tipe_mobil] ." - $tipe_mobil" ?></td>
																	</tr>
																	<tr class="info">
																		<td>Warna Mobil</td>
																		<td> <?php echo $warna ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Harga OTR</td>
																		<td><?php echo "$harga_otr"; ?></td>
																	</tr>
																	<tr class="success">
																		<td>Program Delaer</td>
																		<td><?php echo $r[promo_dealer]; ?></td>
																	</tr>
																	<tr class="danger">
																		<td><b>Plafon Diskon</b></td>
																		<td><b><?php echo "$discount_unit"; ?></b></td>
																	</tr>
																	
																	<tr class="info">
																		<td>Pengajuan Diskon</td>
																		<td><?php echo $pengajuan_disc ?></td>
																	</tr>
																	
																	<tr class="warning">
																		<td>Total Diskon Aksesoris</td>
																		<td><?php echo $total_discount_accs ?></td>
																	</tr>
																	<tr class="danger">
																		<td><b>Total Diskon Bruto</b></td>
																		<td><b><?php echo $disc_bruto ?></b></td>
																	</tr>
																	<tr class="warning">
																		<td>Keterangan Diskon</td>
																		<td><?php echo $r[ket_discount] ?></td>
																	</tr>
																	<tr class="info">
																		<td>Refund</td>
																		<td><?php echo $refund ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Total Diskon Netto</td>
																		<td><?php echo $total_discount ?></td>
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
											
<?php 
												$data2 = mysql_query("select * from pengajuan_discount_ulang where no_pengajuan = '$_GET[id]' ");
												 while ($tampil=mysql_fetch_array($data2)){
											
												$harga_otr2 = "Rp ".number_format("$tampil[harga_otr]",0,".",".");
												$discount_unit2 = "Rp ".number_format("$tampil[discount_unit]",0,".",".");
												$pengajuan_disc2 = "Rp ".number_format("$tampil[pengajuan_disc]",0,".",".");
												$total_discount_accs2 = "Rp ".number_format("$tampil[total_discount_accs]",0,".",".");
												$disc_bruto12 = $tampil[pengajuan_disc]+$tampil[total_discount_accs];
												$disc_bruto2 = "Rp ".number_format("$disc_bruto12",0,".",".");
												$disc_netto1 = $tampil[pengajuan_disc]+$tampil[total_discount_accs]-$tampil[refund];
												$disc_netto = "Rp ".number_format("$disc_netto1",0,".",".");
												$refund2 = "Rp ".number_format("$tampil[refund]",0,".",".");
												$total_discount2 = "Rp ".number_format("$tampil[total_discount]",0,".",".");
											
											?>
											
											<div class="panel panel-white collapses" id="panel5">
													<a data-original-title="Tampilkan" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
													<div class="panel-heading">
														<h4 class="panel-title text-primary">Detail pengajuan Ulang</h4>
														<div class="panel-tools">
															<a data-original-title="Tampilkan" data-toggle="tooltip" data-placement="top" class="btn btn-transparent btn-sm panel-collapse" href="#"><i class="ti-minus collapse-off"></i><i class="ti-plus collapse-on"></i></a>
														</div>
													</div>
													</a>
													<div class="panel-body" style="display: none;">
													
													
													
													<!--div class="list-group">
														<a class="list-group-item active" >
															<h5 class="list-group-item-heading">Nama Customer</h5>
															<p class="list-group-item-text">
																Muhamad Abdullah
															</p>
														</a>
														<a class="list-group-item" href="#">
															<h5 class="list-group-item-heading">List group item heading</h5>
															<p class="list-group-item-text">
																Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
															</p>
														</a>
														<a class="list-group-item" href="#">
															<h5 class="list-group-item-heading">List group item heading</h5>
															<p class="list-group-item-text">
																Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
																Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
																Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
																Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
																Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
																Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
																Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
																Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
																Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
																Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
																Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
																Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.
															</p>
														</a>
													</div-->
													
													
													
														
															<table class="table table-bordered table-hover" id="sample-table-1">
																<tbody>
																	<tr class="warning">
																		<td>Nama Customer</td>
																		<td><?php echo $r[nama_customer] ?></td>
																	</tr>
																	<tr class="info">
																		<td>Hp Customer</td>
																		<td><?php echo $tampil[hp_customer] ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Jenis Identitas</td>
																		<td><?php echo $tampil[jenis_identitas] ?></td>
																	</tr>
																	<tr class="info">
																		<td>Nomor Identitas</td>
																		<td><?php echo $tampil[no_identitas] ?></td>
																	</tr>
																	<tr class="warning">
																		<td width = "50%">Alamat Customer</td>
																		<td><?php echo $tampil[alamat_customer] ?></td>
																	</tr>
																	<tr class="info">
																		<td>Asal Prospek</td>
																		<td><?php echo $tampil[asal_prospek] . ($tampil[ket_asal_prospek] != "" ? " - $tampil[ket_asal_prospek]" : "" ) ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Asuransi</td>
																		<td><?php echo ($tampil[ikut_asuransi] == "Y" ? "IKUT ASURANSI" : ($tampil[ikut_asuransi] == "" ? "" : "TIDAK ASURANSI")).($tampil[ikut_asuransi] == "Y" ? " - $data_pu[asuransi]" : "") ; ?></td>
																	</tr>
																		<tr class="info">
																		<td>Model</td>
																		<td><?php echo $tampil[nama_model] ?> </td>
																	</tr>
																	<tr class="warning">
																		<td>Tipe Mobil</td>
																		<td> <?php echo $tampil[tipe_mobil] ." - $tampil[nama_tipe]" ?></td>
																	</tr>
																	<tr class="info">
																		<td>Warna Mobil</td>
																		<td> <?php echo $tampil[nama_warna] ?></td>
																	</tr>
																	
																	<tr class="warning">
																		<td>Harga OTR</td>
																		<td><?php echo "$harga_otr2"; ?></td>
																	</tr>
																	<tr class="success">
																		<td>Program Delaer</td>
																		<td><?php echo $tampil[promo_dealer]; ?></td>
																	</tr>
																	<tr class="danger">
																		<td><b>Plafon Diskon</b></td>
																		<td><b><?php echo "$discount_unit2"; ?></b></td>
																	</tr>
																	
																	<tr class="info">
																		<td>Pengajuan Diskon</td>
																		<td><?php echo $pengajuan_disc2 ?></td>
																	</tr>
																	
																	<tr class="warning">
																		<td>Total Diskon Aksesoris</td>
																		<td><?php echo $total_discount_accs2 ?></td>
																	</tr>
																	<tr class="danger">
																		<td><b>Total Diskon Bruto</b></td>
																		<td><b><?php echo $disc_bruto2 ?></b></td>
																	</tr>
																	<tr class="warning">
																		<td>Keterangan Diskon</td>
																		<td><?php echo $tampil[ket_discount] ?></td>
																	</tr>
																	<tr class="info">
																		<td>Refund</td>
																		<td><?php echo $refund2 ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Total Diskon Netto</td>
																		<td><?php echo $disc_netto ?></td>
																	</tr>
																	<tr class="info">
																		<td>Metode Pembayaran</td>
																		<td><?php echo $tampil[cara_beli] ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Leasing</td>
																		<td><?php echo $tampil[leasing] ?></td>
																	</tr>
																	<tr class="info">
																		<td>Tenor</td>
																		<td><?php echo $tampil[tenor] ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Pemohon</td>
																		<td><?php echo $r[pemohon] ?></td>
																	</tr>
																</tbody>
															</table>
													
												</div>
											</div>
											
												 <?php } ?>											
												
											
											    <div class="form-group">
													<input type="hidden" placeholder="No Pengajuan" class="form-control" value="PD<?php echo $r[no_pengajuan]; ?>" id="no_pengajuan" name="no_pengajuan" required readonly>
													</input>
												</div>
												<fieldset>
													<legend>
														Status SPK
													</legend>			
													<div class="radio clip-radio radio-primary radio-inline" >
														<input type="radio" id="radio1" class="status_spk" required name="status_spk" value="B" <?php if($status_spk=='B'){echo 'checked';}?>>
														<label for="radio1">
															Belum SPK
														</label>
													</div>
													<div class="radio clip-radio radio-primary radio-inline" >
														<input type="radio" id="radio2" class="status_spk" required name="status_spk" value="Y" <?php if($status_spk=='Y'){echo 'checked';}?>>
														<label for="radio2">
															SPK
														</label>
													</div>
													<div class="radio clip-radio radio-primary radio-inline" >
														<input type="radio" id="radio3" class="status_spk" required name="status_spk" value="N" <?php if($status_spk=='N'){echo 'checked';}?>>
														<label for="radio3">
															Tidak SPK
														</label>
													</div>
													<div class = "row">
														<div class = "col-md-3">
															<div class="form-group" id="id_nospk" <?php if($status_spk=='N' or $status_spk == 'B' or $no_spk == ''){echo "style = display:none";} ?> >
																<label class="control-label">
																	No SPK <span class="symbol required"></span>
																</label>
																<input type="text" value="<?php echo $r[no_spk]; ?>" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="No SPK" class="form-control" id="no_spk" maxlength="12" name="no_spk" >
															</div>
													
															<div class="form-group"  id="tgl_spk" <?php if($status_spk=='N' or $status_spk == 'B' or $no_spk == ''){echo "style = display:none";} ?> >
																<label class="control-label">
																	Tgl SPK <span class="symbol required"></span>
																</label>
																<p class="input-group input-append datepicker date " data-date-format='yyyy-mm-dd'>
																	<input value = "<?php if($status_spk=='Y'){echo $r[tgl_spk];}  ?>" type="text" class="form-control" id="tgl_spk" readonly name="tgl_spk" />
																	<span class="input-group-btn">
																		<button type="button" class="btn btn-default">
																			<i class="glyphicon glyphicon-calendar"></i>
																		</button> </span>
																</p>
																
															</div>
														</div>
													</div>
													<div class="form-group" id = "ket_tidakspk" >
													<div class="panel-heading">
													<div class="panel-title">
														Keterangan Supervisor
													</div>
											    	</div>
													<div class="panel-body">
														<div class="form-group">
															<div class="note-editor">
																<textarea class="form-control" id="ket_tidakspk" name="ket_tidakspk"><?php echo $r[ket_tidakspk]; ?></textarea>
															</div>
														</div>
													</div>
												</div>
												
											</div>
												</fieldset>
												
												
												
																					
											<div class="col-md-12">
											    <span class="symbol required"></span>Harus di isi
											    <hr>
												<?php if(!count($_POST)) { ?>
												<button id="tombolsave" class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
												<?php } ?>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=<?php if(count($_POST)) { echo "history.go(-2)"; } else {echo "history.go(-1)";}?>>
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