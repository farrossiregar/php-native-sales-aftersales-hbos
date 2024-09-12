<?php

    $disc_approved=str_replace(".","",$_POST['disc_approved']);
    
	$a = "select t.nama_tipe as nama_tipe, w.nama_warna as nama_warna, m.nama_model as nama_model ,pd.* from pengajuan_discount pd 
			left join tipe t on t.kode_tipe=pd.tipe_mobil
			left join model m on m.kode_model=pd.model
			left join warna w on w.kode_warna=pd.warna
			where md5(md5(pd.no_pengajuan))='$_GET[id]'";
	
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
	
	
	
				
	
	

	$harga_otr = number_format("$r[harga_otr]",0,".",".");	
	$discount_unit = number_format("$r[discount_unit]",0,".",".");
	$pengajuan_disc = number_format("$r[pengajuan_disc]",0,".",".");
	$total_discount_accs = number_format("$r[total_discount_accs]",0,".",".");
	$disc_bruto1 = $r[pengajuan_disc]+$r[total_discount_accs];
	$disc_bruto = number_format("$disc_bruto1",0,".",".");
	$refund = number_format("$r[refund]",0,".",".");
	$total_discount = number_format("$r[total_discount]",0,".",".");

    $dt = "select * from data_mobil where kode_tipe = '$r[tipe_mobil]' and kode_warna = '$r[warna]' and nomatching = '' ";
    $cueri = mysql_query($dt);
    $sisa_stock = mysql_num_rows($cueri);
    
    
    $a = "select t.nama_tipe as nama_tipe, w.nama_warna as nama_warna, m.nama_model as nama_model ,pd.* from pengajuan_discount pd 
			left join tipe t on t.kode_tipe=pd.tipe_mobil
			left join model m on m.kode_model=pd.model
			left join warna w on w.kode_warna=pd.warna
			where md5(md5(pd.no_pengajuan))='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
	
	$model = $r['nama_model'];
	$tipe_mobil = $r['nama_tipe'];
	$nama_warna = $r['nama_warna'];
	
	$status_approved=$r['status_approved'];
    
?>
				
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Pengajuan Discount Ulang</h1>
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
						
						
						
						<script type="text/javascript" src="modul/prospek/action/pengajuandiscount.js"></script>
						
						
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="modul/prospek/action/pengajuandiscount_ulangsimpan.php" >
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
												
											<div class="panel panel-white collapses" id="panel5">
												<div class="panel-heading">
													<h4 class="panel-title text-primary">Detail pengajuan Sebelumnya</h4>
													<div class="panel-tools">
														<a data-original-title="Tampilkan" data-toggle="tooltip" data-placement="top" class="btn btn-transparent btn-sm panel-collapse" href="#"><i class="ti-minus collapse-off"></i><i class="ti-plus collapse-on"></i></a>
													</div>
												</div>
												<div class="panel-body" style="display: none;">
													<div class="table-responsive">
            										<table class="table table-bordered table-hover" id="sample-table-1">
            										    <tbody>
            												<tr class="info">
            													<td>No Pengajuan</td>
            													<td><?php echo $r[no_pengajuan].' / '.$r[waktu] ?></td>
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
            													<td> <?php echo $r[tipe_mobil] ." - $tipe_mobil (".$r[tahun_buat].")"; ?></td>
            												</tr>
            											    <tr class="info">
            													<td>Warna Mobil</td>
            													<td> <?php echo $nama_warna ?></td>
            												</tr>
            												<tr class="warning">
            													<td>Harga OTR</td>
            													<td><?php echo "Rp $harga_otr"; ?></td>
            												</tr>
															<tr class="success">
            													<td>Program Delaer</td>
            													<td><?php echo $r[promo_dealer]; ?></td>
            												</tr>
            												<tr class="danger">
            													<td><b>Plafon Diskon</b></td>
            													<td><b><?php echo "Rp $discount_unit"; ?></b></td>
            												</tr>
            												
            												<tr class="info">
            													<td>Pengajuan Diskon</td>
            													<td><?php echo "Rp $pengajuan_disc"; ?></td>
            												</tr>
            												
            												<tr class="warning">
            													<td>Total Diskon Aksesoris</td>
            													<td><?php echo "Rp $total_discount_accs"; ?></td>
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
            													<td><?php echo "Rp $refund"; ?></td>
            												</tr>
            												<tr class="warning">
            													<td>Total Diskon Netto</td>
            													<td><?php echo "Rp $total_discount"; ?></td>
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
											</div>
												
											<?php 
												$ket_discount = $r[ket_discount];
												$model = $r[model];
												$tipe = $r[tipe_mobil];
												$warna = $r[warna];
												
											
											
											
											
												$data2 = mysql_query("select t.nama_tipe as nama_tipe, w.nama_warna as nama_warna, m.nama_model as nama_model ,pd.* from pengajuan_discount_ulang pd 
																	left join tipe t on t.kode_tipe=pd.tipe_mobil
																	left join model m on m.kode_model=pd.model
																	left join warna w on w.kode_warna=pd.warna
																	where pd.no_pengajuan ='$r[no_pengajuan]' order by pd.nomor ");
																	
												while ($tampil=mysql_fetch_array($data2)){
											
												$harga_otr2 = number_format("$tampil[harga_otr]",0,".",".");
												$discount_unit2 = number_format("$tampil[discount_unit]",0,".",".");
												$pengajuan_disc2 = number_format("$tampil[pengajuan_disc]",0,".",".");
												$total_discount_accs2 = number_format("$tampil[total_discount_accs]",0,".",".");
												$disc_bruto12 = $tampil[pengajuan_disc]+$tampil[total_discount_accs];
												$disc_bruto2 = number_format("$disc_bruto12",0,".",".");
												$disc_netto1 = $tampil[pengajuan_disc]+$tampil[total_discount_accs]-$tampil[refund];
												if ($disc_netto1 < 1){
													$disc_netto = "0 ";
												}else {
													$disc_netto = number_format("$disc_netto1",0,".",".");
												}
												$refund2 = number_format("$tampil[refund]",0,".",".");
												
												
												$ket_discount = $tampil['ket_discount'];
												
												$kode_model = $tampil['model'];
												$kode_tipe = $tampil['tipe_mobil'];
												$kode_warna = $tampil['warna'];
												
												$nama_model = $tampil['nama_model'];
												$nama_tipe = $tampil['nama_tipe'];
												$nama_warna = $tampil['nama_warna'];
												
												$tahun_buat = $tampil['tahun_buat'];
												$promo_dealer = $tampil['promo_dealer'];
												$cara_beli = $tampil['cara_beli'];
												$leasing = $tampil['leasing'];
												$tenor = $tampil['tenor'];
												$ikut_asuransi = $tampil['ikut_asuransi'];
												$asuransi = $tampil['asuransi'];
												
												$disc_unit_ulang = $tampil['disc_unit'];
												//$pengajuan_disc_ulang = $tampil[pengajuan_disc];
												
												
												
												$nama_customer = $tampil['nama_customer'];
												$asal_prospek = $tampil['asal_prospek'];
												$alamat_customer = $tampil['alamat_customer'];
												$jenis_identitas = $tampil['jenis_identitas'];
												$no_identitas = $tampil['no_identitas'];
												$hp_customer = $tampil['hp_customer'];
												$alamat_customer = $tampil['alamat_customer'];
												$ket_asal_prospek_ulang = $tampil[ket_asal_prospek];
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
													
													
														<div class="table-responsive">
															<table class="table table-bordered table-hover" id="sample-table-1">
																<tbody>
																	<tr class="warning">
																		<td>Nama Customer</td>
																		<td><?php echo $tampil[nama_customer] ?></td>
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
																		<td>Alamat Customer</td>
																		<td><?php echo $tampil[alamat_customer] ?></td>
																	</tr>
																		<tr class="info">
																		<td>Model</td>
																		<td><?php echo $nama_model ?> </td>
																	</tr>
																	<tr class="warning">
																		<td>Tipe Mobil</td>
																		<td> <?php echo "$nama_tipe (". $tahun_buat.")"; ?></td>
																	</tr>
																	<tr class="info">
																		<td>Warna Mobil</td>
																		<td> <?php echo $nama_warna ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Harga OTR</td>
																		<td><?php echo "Rp $harga_otr2"; ?></td>
																	</tr>
																	<tr class="success">
																		<td>Program Delaer</td>
																		<td><?php echo $tampil[promo_dealer]; ?></td>
																	</tr>
																	<tr class="danger">
																		<td><b>Plafon Diskon</b></td>
																		<td><b><?php echo "Rp $discount_unit2"; ?></b></td>
																	</tr>
																	
																	<tr class="info">
																		<td>Pengajuan Diskon</td>
																		<td><?php echo "Rp $pengajuan_disc2"; ?></td>
																	</tr>
																	
																	<tr class="warning">
																		<td>Total Diskon Aksesoris</td>
																		<td><?php echo "Rp $total_discount_accs2"; ?></td>
																	</tr>
																	<tr class="danger">
																		<td><b>Total Diskon Bruto</b></td>
																		<td><b><?php echo "Rp $disc_bruto2"; ?></b></td>
																	</tr>
																	<tr class="warning">
																		<td>Keterangan Diskon</td>
																		<td><?php echo $tampil[ket_discount] ?></td>
																	</tr>
																	<tr class="info">
																		<td>Refund</td>
																		<td><?php echo "Rp $refund2";?></td>
																	</tr>
																	<tr class="warning">
																		<td>Total Diskon Netto</td>
																		<td><?php echo ($disc_netto < 1 ? "Rp 0" : "Rp $disc_netto" ) ?></td>
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
											</div>
											
											
											
												 <?php 
												 $dt = "select * from data_mobil where kode_tipe = '$tampil[tipe_mobil]' and kode_warna = '$tampil[warna]' and nomatching = '' ";
												$cueri = mysql_query($dt);
												$sisa_stock = mysql_num_rows($cueri);
												 
												 
												 } ?>	
												
												
												
												
											
											    <div class="form-group">
													<input type="hidden" placeholder="No Pengajuan" class="form-control" value="<?php echo $r[no_pengajuan]; ?>" id="no_pengajuan" name="no_pengajuan" required readonly>
													</input>
												</div>
												
												
												<input type="hidden" placeholder="No Pengajuan" class="form-control" value="<?php echo date('Y-m-d',strtotime($r['waktu'])); ?>" id="tgl_pengajuan" name="waktu">
												<input type="hidden" placeholder="No Pengajuan" class="form-control" value="<?php echo $r['no_spk']; ?>" id="no_spk" name="no_spk">
												
												<div class="form-group">
													<label class="control-label">
														Sisa Stock :  <span class="label label-info"><i class="fa fa-car"></i> <?php echo $sisa_stock; ?> Unit</span>
													</label>
													
												</div>
												<?php if (strtoupper($_SESSION['leveluser']) == 'USER') { ?>
												<div class="form-group" id = "id_ket_approve" >
													<div class="panel-heading">
													<div class="panel-title">
														CATATAN
													</div>
											    	</div>
													<div class="panel-body">
														<div class="form-group">
															<div class="note-editor">
																<textarea disabled class="form-control" id="ket_approve" name="ket_approve" ><?php echo $r[ket_approve]; ?></textarea>
															</div>
														</div>
													</div>
												</div>
												<?php }?>
												
												<div class="form-group">
														<label class="control-label">
															Nama Customer <span class="symbol required"></span>
														</label>
														<input value ="<?php echo ($nama_customer == "" ? $r[nama_customer] : $nama_customer ) ; ?>" type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Customer" class="form-control" name="nama_customer" >
													</div>
												
												<fieldset>
													<legend>
														Jenis Identitas
													</legend>
													<div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio5" name="jenis_identitas" value="KTP" <?php $jns_idt = ($jenis_identitas == "" ? $r[jenis_identitas] : $jenis_identitas ); if ($jns_idt == "KTP"){echo "checked";}  ?> >
														<label for="radio5">
															KTP
														</label>
													</div>
													<div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio6" name="jenis_identitas" value="SIM" <?php $jns_idt = ($jenis_identitas == "" ? $r[jenis_identitas] : $jenis_identitas ); if ($jns_idt == "SIM"){echo "checked";}  ?> >
														<label for="radio6">
															SIM
														</label>
													</div>
													<div class="radio clip-radio radio-primary radio-inline">
														<input type="radio" id="radio7" name="jenis_identitas" value="NPWP" <?php $jns_idt = ($jenis_identitas == "" ? $r[jenis_identitas] : $jenis_identitas ); if ($jns_idt == "NPWP"){echo "checked";}  ?> >
														<label for="radio7">
															NPWP
														</label>
													</div>
													<div class="form-group">
														<label class="control-label">
															No Identitas Customer <span class="symbol required"></span>
														</label>
														<input value ="<?php echo ($no_identitas == "" ? $r[no_identitas] : $no_identitas ) ; ?>" type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="No Identitas Customer" class="form-control" id="no_identitas" name="no_identitas" >
													</div>
												</fieldset>
												
												<div class="form-group">
													<label class="control-label">
														No Handphone Customer <span class="symbol required"></span>
													</label>
													<input value ="<?php echo ($hp_customer == "" ? $r[hp_customer] : $hp_customer ) ; ?>" type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" placeholder="No handphone Customer" class="form-control" id="hp_customer" name="hp_customer" >
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
																<textarea class="form-control" id="alamat_customer" name="alamat_customer" ><?php echo ($alamat_customer == "" ? $r['alamat_customer'] : $alamat_customer ) ; ?></textarea>
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
															<input type="radio" id="radio9" name="asal_prospek" value="RETAIL" <?php $asl_pros = ($asal_prospek == "" ? $r[asal_prospek] : $asal_prospek ); if ($asl_pros == "RETAIL"){echo "checked";}  ?> >
															<label for="radio9">
																RETAIL 
															</label>
														</div>
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio10" name="asal_prospek" value="MOVING" <?php $asl_pros = ($asal_prospek == "" ? $r[asal_prospek] : $asal_prospek ); if ($asl_pros == "MOVING"){echo "checked";}  ?> >
															<label for="radio10">
																MOVING 
															</label>
														</div>
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio11" name="asal_prospek" value="EVENT"  <?php $asl_pros = ($asal_prospek == "" ? $r[asal_prospek] : $asal_prospek ); if ($asl_pros == "EVENT"){echo "checked";}  ?> >
															<label for="radio11">
																EVENT
															</label>
														</div>
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio12" name="asal_prospek" value="PAMERAN"  <?php $asl_pros = ($asal_prospek == "" ? $r[asal_prospek] : $asal_prospek ); if ($asl_pros == "PAMERAN"){echo "checked";}  ?> >
															<label for="radio12">
																PAMERAN
															</label>
														</div>
													</div>
													<div id="ket_asal_prospek">													
													<?php 
															
														if ($asl_pros=="EVENT"){
														?>

															<div class="form-group">
																<label for="form-field-select-2">
																	Lokasi Event <span class="symbol required"></span>
																</label>
																<select name = "ket_asal_prospek" class = "form-control"  >														
																		<option value="" selected disabled>PILIH LOKASI</option>
																		<option value="SHOWROOM EVENT" <?php $pameran = ($ket_asal_prospek_ulang == "" ? $r[ket_asal_prospek] : $ket_asal_prospek_ulang); if($pameran == "SHOWROOM EVENT"){echo "selected";} ?>>SHOWROOM EVENT</option>
																		<option value="JONEX" <?php $pameran = ($ket_asal_prospek_ulang == "" ? $r[ket_asal_prospek] : $ket_asal_prospek_ulang); if($pameran == "JONEX"){echo "selected";} ?> >JONEX</option>
																		<option value="LAIN-LAIN" <?php $pameran = ($ket_asal_prospek_ulang == "" ? $r[ket_asal_prospek] : $ket_asal_prospek_ulang); if($pameran == "LAIN-LAIN"){echo "selected";} ?> >LAIN-LAIN</option>
																</select>
															</div>
															
														<?php }if ($asl_pros == "MOVING"){ ?>
															<div class="form-group">
																<label class="control-label">
																	Lokasi Moving <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" value = "<?php echo ($ket_asal_prospek_ulang == "" ? $r[ket_asal_prospek] : $ket_asal_prospek_ulang); ?>" onblur="this.value=this.value.toUpperCase()" placeholder="ISI DENGAN LOKASI MOVING" class="form-control" name="ket_asal_prospek" >
															</div>

														<?php }if ($asl_pros == "PAMERAN"){ ?>
															<div class="form-group">
																<label for="form-field-select-2">
																	Lokasi Pameran <span class="symbol required"></span>
																</label>
																<select name = "ket_asal_prospek" class = "form-control"  >														
																		<option value="" selected disabled>PILIH LOKASI</option>
																		<option value="BINTARO EXCHANGE" <?php $pameran = ($ket_asal_prospek_ulang == "" ? $r[ket_asal_prospek] : $ket_asal_prospek_ulang); if($pameran == "BINTARO EXCHANGE"){echo "selected";} ?> >BINTARO EXCHANGE</option>
																		<option value="CBD CILEDUG" <?php $pameran = ($ket_asal_prospek_ulang == "" ? $r[ket_asal_prospek] : $ket_asal_prospek_ulang); if($pameran == "CBD CILEDUG"){echo "selected";} ?> >CBD CILEDUG</option>
																		<option value="GIANT BINTARO" <?php $pameran = ($ket_asal_prospek_ulang == "" ? $r[ket_asal_prospek] : $ket_asal_prospek_ulang); if($pameran == "GIANT BINTARO"){echo "selected";} ?> >GIANT BINTARO</option>
																		<option value="HARMONY SWALAYAN" <?php $pameran = ($ket_asal_prospek_ulang == "" ? $r[ket_asal_prospek] : $ket_asal_prospek_ulang); if($pameran == "HARMONY SWALAYAN"){echo "selected";} ?> >HARMONY SWALAYAN</option>
																</select>
															</div>
														<?php } ?>
													</div>
												</fieldset>
												
												
												
												<div class="form-group">
													<label for="form-field-select-2">
														Mobil <span class="symbol required"></span>
													</label>
													<select name = "model" id="model" class = "form-control" onchange="get_tipe();" required >														
    														<option value="" selected disabled>PILIH MODEL</option>
    														<?php $data = mysql_query("select * from model");
    															while ($u=mysql_fetch_array($data))
    															{
																	$kode_model1 = ($kode_model == "" ? $r[model] : $kode_model);
																	if ($u[kode_model] == trim($kode_model1)){$selected = "selected";}else{$selected = "";}
																	
    																echo "<option $selected value='$u[kode_model]'> $u[nama_model] </option>";
    															}
    															
    														?>
    												</select>
												</div>
												<div class="form-group">
    													<label for="form-field-select-2">
    														Pilih Tipe <span class="symbol required"></span>
    													</label>													
    													<select name="tipe_mobil" id = "tipe_mobil" class = "form-control" required onchange = "harga_otomatis('ulang'); get_warna();" >	
    														
															<?php 
																$query_tipe = mysql_query("select * from tipe where kode_model = '$kode_model1' ");
																while ($data_tipe = mysql_fetch_array($query_tipe)){
																	$kode_tipe1 = ($kode_tipe == "" ? $tipe : $kode_tipe);
																	
																	if (trim($data_tipe['kode_tipe']) == trim($kode_tipe1) ){ $selected = "selected";} else { $selected = "";}
															?>
															
																<option <?php echo "$selected"; ?> value="<?php echo $data_tipe['kode_tipe']; ?>"  ><?php echo $data_tipe['kode_tipe']." - ".$data_tipe['nama_tipe']; ?></option>
															
															<?php } ?>
															
    													</select>
    											</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Pilih Warna<span class="symbol required"></span>
													</label>													
													<select name="warna" id="warna" class = "form-control" onchange = "harga_otomatis('ulang');" >														
														
														<?php 
															
															$data = mysql_query("select * from varian_warna where kode_tipe = '$kode_tipe1' order by kode_warna asc");
															
															while ($q=mysql_fetch_array($data))
															{
																	$kode_warna1 = ($kode_warna == "" ? $r[warna] : $kode_warna);
																	if (trim($q[kode_warna]) == trim($kode_warna1)){$selected = "selected";}else{$selected = "";}
																	
    																echo "<option $selected value='$q[kode_warna]'> ".strtoupper($q[nama_warna])." </option>";
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
													<select name="tahun_buat" id="tahun_buat" class="form-control"  onchange = "harga_otomatis('ulang');" >
													<option value="">PILIH TAHUN</option>
													<option value="2016" <?php $thn_buat1 = ($tahun_buat == "" ? $r[tahun_buat] : $tahun_buat); if($thn_buat1 == "2016"){ echo "selected";} ?> >2016</option>
													<option value="2017" <?php $thn_buat1 = ($tahun_buat == "" ? $r[tahun_buat] : $tahun_buat); if($thn_buat1 == "2017"){ echo "selected";} ?> >2017</option>
													<option value="2018" <?php $thn_buat1 = ($tahun_buat == "" ? $r[tahun_buat] : $tahun_buat); if($thn_buat1 == "2018"){ echo "selected";} ?> >2018</option>
													<option value="2019" <?php $thn_buat1 = ($tahun_buat == "" ? $r[tahun_buat] : $tahun_buat); if($thn_buat1 == "2019"){ echo "selected";} ?> >2019</option>
												    </select>
												</div>
												
												<div class="form-group">
													<label class="control-label">
														Harga OTR <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" id="harga_otr" value ="<?php echo ($harga_otr2 == "" ? $harga_otr : $harga_otr2); if($thn_buat1 == "2016");  ?>"required name="harga_otr" readonly onkeypress="return hanyaAngka(event)" onKeyup="titikpemisah();"/>
													</div>
												</div>
												
												
												<script>
													
												
												
												
												
												
												</script>
												
												
												<div class="form-group">
													<label for="form-field-select-2">
														Program Marketing <span class="symbol required"></span>
													</label>													
													<select name="promo_dealer" id="promo_dealer" class = "form-control" onchange = "promo();"  >														
														<option value="" selected >PILIH PROGRAM</option>
														<option value="Tidak Ikut Program" <?php $promo_dealer1 = ($promo_dealer == "" ? $r[promo_dealer] : $promo_dealer); if($promo_dealer1 == "Tidak Ikut Program"){ echo "selected";} ?> >TIDAK IKUT PROGRAM</option>
														<!--option value="BCA KOMBINASI" <?php $promo_dealer1 = ($promo_dealer == "" ? $r[promo_dealer] : $promo_dealer); if($promo_dealer1 == "BCA KOMBINASI"){ echo "selected";} ?> >BCA KOMBINASI</option-->
														<!--option value="MAYBANK KOMBINASI" <?php $promo_dealer1 = ($promo_dealer == "" ? $r[promo_dealer] : $promo_dealer); if($promo_dealer1 == "MAYBANK KOMBINASI"){ echo "selected";} ?> >MAYBANK KOMBINASI</option-->
														<option value="MTF KOMBINASI" <?php $promo_dealer1 = ($promo_dealer == "" ? $r[promo_dealer] : $promo_dealer); if($promo_dealer1 == "MTF KOMBINASI"){ echo "selected";} ?> >MTF KOMBINASI</option>
													</select>
												</div>
												<!---- buat dummy 
												<fieldset id="id_metodebyr2" <?php if($promo_dealer1 != "BCA KOMBINASI"){echo "style='display:none;'" ;} ?>>
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
												<div class="form-group" id="id_leasing2" <?php if($promo_dealer1 != "BCA KOMBINASI"){echo "style='display:none;'" ;} ?> >
													<label for="form-field-select-2">
														Nama leasing  <span class="symbol required"></span>
													</label>
													<select disabled name='leasing3' id='leasing3' class='form-control' onchange = "hitung_refund();" >													
													<option selected value='BCA FINANCE' >BCA FINANCE</option>
													
												    </select>
												</div>
												
												<!---->
												
												<?php if($promo_dealer1 != "MTF KOMBINASI"){  ?>
												<div id="id_metodebyr_2" >
													<fieldset>
														<legend>
															Metode Pembayaran
														</legend>
														
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio1" class="metodebayar" name="cara_beli" value="TUNAI" <?php $cara_beli1 = ($cara_beli == "" ? $r[cara_beli] : $cara_beli); if($cara_beli1 == "TUNAI"){ echo "checked";} ?> onclick="removereadonly();tampil_leasing();" >
															<label for="radio1">
																Tunai
															</label>
														</div>
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio2" class="metodebayar" name="cara_beli" value="KREDIT" <?php $cara_beli1 = ($cara_beli == "" ? $r[cara_beli] : $cara_beli); if($cara_beli1 == "KREDIT"){ echo "checked";} ?> onclick="addreadonly(); tampil_leasing();" >
															<label for="radio2">
																Kredit
															</label>
														</div>
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio3" class="metodebayar" name="cara_beli" value="COP" <?php $cara_beli1 = ($cara_beli == "" ? $r[cara_beli] : $cara_beli); if($cara_beli1 == "COP"){ echo "checked";} ?> onclick="removereadonly();tampil_leasing();" >
															<label for="radio3">
																COP
															</label>
														</div>
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio4" class="metodebayar" name="cara_beli" value="GSO" <?php $cara_beli1 = ($cara_beli == "" ? $r[cara_beli] : $cara_beli); if($cara_beli1 == "GSO"){ echo "checked";} ?> onclick="removereadonly();tampil_leasing();">
															<label for="radio4">
																GSO
															</label>
														</div>
														
														<?php if ($cara_beli1 == "KREDIT"){

														?>
														<div class="form-group" id = "id_leasing">
															<label for="form-field-select-2" >
																Nama leasing <span class="symbol required"></span>
															</label>
															<select name='leasing' id='leasing' class='form-control' onchange = "hitung_refund();" >
																<option selected value=''>PILIH LEASING</option>
																<option value='MBF' <?php $leasing1 = ($leasing == "" ? $r[leasing] : $leasing); if($leasing1 == "MBF"){ echo "selected";} ?> >MBF</option>
																<option value='MTF' <?php $leasing1 = ($leasing == "" ? $r[leasing] : $leasing); if($leasing1 == "MTF"){ echo "selected";} ?> >MTF</option>
																<option value='OTO MULTIARTHA' <?php $leasing1 = ($leasing == "" ? $r[leasing] : $leasing); if($leasing1 == "OTO MULTIARTHA"){ echo "selected";} ?> >OTO MULTIARTHA</option>
																<option value='MY BANK' <?php $leasing1 = ($leasing == "" ? $r[leasing] : $leasing); if($leasing1 == "MY BANK"){ echo "selected";} ?> >MAYBANK</option>
																<option value='(KPM) MANDIRI' <?php $leasing1 = ($leasing == "" ? $r[leasing] : $leasing); if($leasing1 == "(KPM) MANDIRI"){ echo "selected";} ?> >KPM MANDIRI</option>
																<option value='(KKB) MAYBANK' <?php $leasing1 = ($leasing == "" ? $r[leasing] : $leasing); if($leasing1 == "(KKB) MAYBANK"){ echo "selected";} ?> >KKB MAYBANK</option>
																<option value='(KKB) BCA' <?php $leasing1 = ($leasing == "" ? $r[leasing] : $leasing); if($leasing1 == "(KKB) BCA"){ echo "selected";} ?> >KKB BCA</option>
																<option value='BCA FINANCE' <?php $leasing1 = ($leasing == "" ? $r[leasing] : $leasing); if($leasing1 == "BCA FINANCE"){ echo "selected";} ?> >BCA FINANCE</option>
																<option value='MAF' <?php $leasing1 = ($leasing == "" ? $r[leasing] : $leasing); if($leasing1 == "MAF"){ echo "selected";} ?> >MAF</option>
																<option value="CLIPAN" <?php $leasing1 = ($leasing == "" ? $r[leasing] : $leasing); if($leasing1 == "CLIPAN"){ echo "selected";} ?> >CLIPAN</option>
															</select>
														</div>
														<div class="form-group" id="id_tenor" >
															<label for="form-field-select-2">
																Tenor <span class="symbol required"></span>
															</label>
															<select name='tenor' id='tenor' class='form-control' onchange = "hitung_refund();" >
															<option selected value=''>PILIH TENOR</option>
															<option value='1tahun' <?php $tenor1 = ($tenor == "" ? $r[tenor] : $tenor); if($tenor1 == "1tahun"){ echo "selected";} ?> >1 TAHUN</option>
															<option value='2tahun' <?php $tenor1 = ($tenor == "" ? $r[tenor] : $tenor); if($tenor1 == "2tahun"){ echo "selected";} ?> >2 TAHUN</option>
															<option value='3tahun' <?php $tenor1 = ($tenor == "" ? $r[tenor] : $tenor); if($tenor1 == "3tahun"){ echo "selected";} ?> >3 TAHUN</option>
															<option value='4tahun' <?php $tenor1 = ($tenor == "" ? $r[tenor] : $tenor); if($tenor1 == "4tahun"){ echo "selected";} ?> >4 TAHUN</option>
															<option value='5tahun' <?php $tenor1 = ($tenor == "" ? $r[tenor] : $tenor); if($tenor1 == "5tahun"){ echo "selected";} ?> >5 TAHUN</option>
															<option value='6tahun' >6 TAHUN</option>
															</select>
														</div>
														
														<?php }else{ ?>
														
														<div id="tampil_leasing_2">
														
														</div>
														<?php } ?>
														
														
															
													</fieldset>
												</div>
												
												
												
												
												<?php }else{ ?>
												<div id="id_metodebyr_2" >
													<fieldset>
														<legend>
															Metode Pembayaran
														</legend>
														
														
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio2" class="metodebayar" name="cara_beli" value="KREDIT" <?php $cara_beli1 = ($cara_beli == "" ? $r[cara_beli] : $cara_beli); if($cara_beli1 == "KREDIT"){ echo "checked";} ?> onclick="addreadonly();" >
															<label for="radio2">
																Kredit
															</label>
														</div>
														
														
														<div class="form-group">
															<label for="form-field-select-2" >
																Nama leasing <span class="symbol required"></span>
															</label>
															<select name='leasing' id='leasing' class='form-control' onchange = "hitung_refund();" >
															<!--option value='BCA FINANCE' <?php $leasing1 = ($leasing == "" ? $r[leasing] : $leasing); if($leasing1 == "BCA FINANCE"){ echo "selected";} ?> >BCA FINANCE</option-->
															<!--option value='MAYBANK' <?php $leasing1 = ($leasing == "" ? $r[leasing] : $leasing); if($leasing1 == "MAYBANK FINANCE"){ echo "selected";} ?> >MAYBANK</option-->
															<option value='MTF' <?php $leasing1 = ($leasing == "" ? $r[leasing] : $leasing); if($leasing1 == "MTF"){ echo "selected";} ?> >MTF</option>
															
															</select>
														</div>
														<div class="form-group" >
															<label for="form-field-select-2">
																Tenor <span class="symbol required"></span>
															</label>
															<select name='tenor' id='tenor' class='form-control' onchange = "hitung_refund();" >
															<option selected value=''>PILIH TENOR</option>
															<option value='1tahun' <?php $tenor1 = ($tenor == "" ? $r[tenor] : $tenor); if($tenor1 == "1tahun"){ echo "selected";} ?> >1 TAHUN</option>
															<option value='2tahun' <?php $tenor1 = ($tenor == "" ? $r[tenor] : $tenor); if($tenor1 == "2tahun"){ echo "selected";} ?> >2 TAHUN</option>
															<option value='3tahun' <?php $tenor1 = ($tenor == "" ? $r[tenor] : $tenor); if($tenor1 == "3tahun"){ echo "selected";} ?> >3 TAHUN</option>
															<option value='4tahun' <?php $tenor1 = ($tenor == "" ? $r[tenor] : $tenor); if($tenor1 == "4tahun"){ echo "selected";} ?> >4 TAHUN</option>
															<option value='5tahun' <?php $tenor1 = ($tenor == "" ? $r[tenor] : $tenor); if($tenor1 == "5tahun"){ echo "selected";} ?> >5 TAHUN</option>
															<option value='6tahun' >6 TAHUN</option>
															</select>
														</div>
														
														
														
													</fieldset>
												</div>
												<?php }
												
												if ($cara_beli1 == "TUNAI" || $cara_beli1 == "COP" || $cara_beli1 == "GSO"){
												?>
												
												
												<fieldset id="ikut_asuransi" >
													<legend>
														Asuransi
													</legend>
													
													<div id = "id_ikut_asuransi" onchange = "cek_asu();">
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio20"  name="ikut_asuransi" value="Y" <?php $ikut_asuransi1 = ($ikut_asuransi == "" ? $r[ikut_asuransi] : $ikut_asuransi ); if($ikut_asuransi1 == "Y"){echo "checked";} ?>   >
															<label for="radio20">
																Ya
															</label>
														</div>
														<div class="radio clip-radio radio-primary radio-inline">
															<input type="radio" id="radio21"  name="ikut_asuransi" value="N" <?php $ikut_asuransi1 = ($ikut_asuransi == "" ? $r[ikut_asuransi] : $ikut_asuransi ); if($ikut_asuransi1 == "N"){echo "checked";} ?>  >
															<label for="radio21">
																Tidak
															</label>
														</div>
													</div>
													
													<div id="nama_asuransi" <?php echo ($ikut_asuransi1 == "N" ? "style = 'display : none;'" : "" );  ?> >
														<div class="form-group" >
															<label for="form-field-select-2">
																Nama Asuransi <span class="symbol required"></span>
															</label>
															<select name="asuransi" id="asuransi" class="form-control" >
															<option selected value=''>PILIH ASURANSI</option>
															<option value='ARTARINDO' <?php $asuransi1 = ($asuransi == "" ? $r[asuransi] : $asuransi ); if($asuransi1 == "ARTARINDO"){echo "selected";} ?> >ARTARINDO</option>
															<option value='BESS' <?php $asuransi1 = ($asuransi == "" ? $r[asuransi] : $asuransi ); if($asuransi1 == "BESS"){echo "selected";} ?> >BESS</option>
															
															</select>
														</div>
													
													</div>
													
													<div id="keterangan_asuransi" <?php echo ($ikut_asuransi1 == "Y" ? "style = 'display : none;'" : "" );  ?>>
													<!--div id="keterangan_asuransi" style="display : none;"-->
														<div class="form-group">
															<div class="panel-heading">
																<div class="panel-title">
																	Keterangan Asuransi
																</div>
															</div>
															<div class="panel-body">
																<div class="form-group">
																	<div class="note-editor">
																		<textarea class="form-control" id="ket_asuransi" name="ket_asuransi"><?php echo $r[ket_asuransi]; ?></textarea>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</fieldset>
												
												<?php }else{ ?>
												
												<div id="tampil_asuransi_5">
												
												</div>
												
												<?php } ?>
												
												
												
												<div class="form-group" >
													<label class="control-label">
														Refund <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" value = "<?php echo ($refund2 == "" ? $refund : $refund2); ?>" <?php $cara_beli1 = ($cara_beli == "" ? $r[cara_beli] : $cara_beli); if($cara_beli1 == "KREDIT"){ echo "readonly";} ?> class="form-control" id="refund" name="refund" onkeypress="return hanyaAngka(event)" onFocus="startCalc();" onBlur="stopCalc();" onKeyup="titikpemisah();"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label">
														Plafon Discount <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" value = "<?php echo ($discount_unit_ulang == "" ? $discount_unit : $discount_unit_ulang); ?>" id="discount_unit" required name="discount_unit" onkeypress="return hanyaAngka(event)" onKeyup="titikpemisah();" readonly />
													</div>
												</div>
												
												<div class="form-group">
													<label class="control-label">
														Pengajuan Discount <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" id="pengajuan_disc" value = "<?php echo ($pengajuan_disc2 == "" ? $pengajuan_disc : $pengajuan_disc2); ?>" name="pengajuan_disc" onFocus="startCalc();" onBlur="stopCalc();" onkeypress="return hanyaAngka(event)" onKeyup="titikpemisah();"/>
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
															<textarea class="form-control" id="ket_discount" name="ket_discount"> <?php echo $ket_discount ;?> </textarea>
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
															<input type="text" class="form-control" id="total_discount_accs" value = "<?php echo ($total_discount_accs_2 == "" ? $total_discount_accs : $total_discount_accs_2); ?>" name="total_discount_accs" onkeypress="return hanyaAngka(event)" onFocus="startCalc();" onBlur="stopCalc();" onKeyup="titikpemisah();"/>
													</div>
												</div>
												
												<div class="form-group">
													<label class="control-label">
														Total Discount Bruto <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" value = "<?php echo ($disc_bruto2 == "" ? $disc_bruto : $disc_bruto2); ?>" onKeyup="titikpemisah();" id="discbruto" name="discbruto" readonly /> 
													</div>
												</div>												
												
												
												<div class="form-group"> 
													<label class="control-label">
														Total Discount Netto <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" value = "<?php echo ($disc_netto == "" ? $total_discount : $disc_netto); ?>" onKeyup="titikpemisah();" id="total_discount" name="total_discount" readonly /> 
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
												
												
												
												<div class="form-group" style = "display :none;">
													<label class="control-label">
														Diskon Disetujui <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" id="disc_approved" name="disc_approved" onkeypress="return hanyaAngka(event)" value="<?php if ($r[disc_approved] != 0){echo $r[disc_approved];}  ?>" onKeyup="titikpemisah2();" />
													</div>
												</div>
												
												<!--div class="radio clip-radio radio-primary radio-inline">												
													<input type="radio" id="radio1" name="status_approved" value="1" <?php if($status_approved=='Y'){echo 'checked';}?>>
													<label for="radio1">
														Setujui
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="status_approved" value="2" <?php if($status_approved=='N'){echo 'checked';}?>>
													<label for="radio2">
														Tidak Di Setujui
													</label>
												</div-->
												<br/>
											    <span class="symbol required"></span>Harus di isi
											    <hr>
												<?php if(!count($_POST)) { ?>
												<button id="tombolsave" class="btn btn-primary btn-wide" type="button" onclick="cek_input_pengajuan();" >
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