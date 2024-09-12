<?php

	$a = "select * from unit_keluar where md5(md5(no_spk)) = '$_GET[id]'";
	
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
	
	if(count($_POST)) {
		$catatan = $_POST['catatan'];
		$tgl = date("Y-m-d H:i:s")	;	

		$app_time = date("Y-m-d H:i:s");
		$persetujuan_data = $_POST['status_approved'];
		if($persetujuan_data == '1'){
			$persetujuan = 'Y';
		}else{
			$persetujuan = 'N';
		}
		
		$ket_approved = $_POST['ket_approved'];
		
		if($_SESSION['leveluser']=='supervisor' or $_SESSION['leveluser']=='admin'){
			$persetujuan_akhir = ($persetujuan == 'Y' ? "SPV_APP" : "N");
			mysql_unbuffered_query("update unit_keluar set status_approved = '$persetujuan_akhir', spv_app = '$persetujuan', spv_user_app = '$_SESSION[namalengkap]', spv_app_time='$app_time' where md5(md5(no_spk)) = '$_GET[id]'");
			
			
			mysql_unbuffered_query("update notif_permohonan_unit_keluar set read_spv = 'Y', notif_mngr = 'Y', read_mngr = 'N'  where md5(md5(no_spk)) = '$_GET[id]'");
		
			
		}elseif($_SESSION['leveluser']=='MNGR'){
			if($r['spv_app']=='Y'){
				$persetujuan_akhir = ($persetujuan == 'Y' ? "MNGR_APP" : "N");
				if ($persetujuan == "Y"){
					mysql_unbuffered_query("update unit_keluar set status_approved = '$persetujuan_akhir',ket_approved = '$ket_approved', mngr_app = '$persetujuan', mngr_user_app = '$_SESSION[namalengkap]', mngr_app_time='$app_time' where md5(md5(no_spk)) = '$_GET[id]'");
					
					
				}else{
					mysql_unbuffered_query("update unit_keluar set spv_app = '',status_approved = '$persetujuan_akhir',ket_approved = '$ket_approved', mngr_app = '$persetujuan', mngr_user_app = '$_SESSION[namalengkap]', mngr_app_time='$app_time' where md5(md5(no_spk)) = '$_GET[id]'");
				}
				
				mysql_unbuffered_query("update notif_permohonan_unit_keluar set read_mngr = 'Y', notif_salesadm = 'Y', read_salesadm = 'N' where md5(md5(no_spk)) = '$_GET[id]'");
			}
		}elseif($_SESSION['leveluser']=='salesadm' || $_SESSION['leveluser']=='staff_salesadm'){
			if($r['mngr_app']=='Y'){
				$persetujuan_akhir = ($persetujuan == 'Y' ? "ADM_APP" : "N");
				if ($persetujuan == "Y"){
					if($r['revisi'] == 'Y' and $r['mngr_finance_app'] == 'Y'){
						mysql_unbuffered_query("update unit_keluar set status_approved = 'FIN_APP', ket_approved = '$ket_approved', salesadm_app = '$persetujuan', salesadm_user_app = '$_SESSION[namalengkap]', salesadm_app_time='$app_time' where md5(md5(no_spk)) = '$_GET[id]'");
					}else{
						mysql_unbuffered_query("update unit_keluar set status_approved = '$persetujuan_akhir',ket_approved = '$ket_approved', salesadm_app = '$persetujuan', salesadm_user_app = '$_SESSION[namalengkap]', salesadm_app_time='$app_time' where md5(md5(no_spk)) = '$_GET[id]'");
					}
				}else{
					mysql_unbuffered_query("update unit_keluar set spv_app = '',mngr_app = '',status_approved = '$persetujuan_akhir',ket_approved = '$ket_approved', salesadm_app = '$persetujuan', salesadm_user_app = '$_SESSION[namalengkap]', salesadm_app_time='$app_time' where md5(md5(no_spk)) = '$_GET[id]'");
				}
			
				if($r['revisi'] == 'Y' and $r['mngr_finance_app'] == 'Y'){
					mysql_unbuffered_query("update notif_permohonan_unit_keluar set read_salesadm = 'Y', notif_logistik = 'Y', read_logistik = 'N' where md5(md5(no_spk)) = '$_GET[id]'");	
				}else{
					mysql_unbuffered_query("update notif_permohonan_unit_keluar set read_salesadm = 'Y', notif_finance = 'Y', read_finance = 'N' where md5(md5(no_spk)) = '$_GET[id]'");
				}
			}
		}elseif($_SESSION['leveluser']=='mngr_finance'){
			if($r['salesadm_app']=='Y'){
				$persetujuan_akhir = ($persetujuan == 'Y' ? "FIN_APP" : "N");
				if ($persetujuan == "Y"){
					mysql_unbuffered_query("update unit_keluar set status_approved = '$persetujuan_akhir',ket_approved = '$ket_approved', mngr_finance_app = '$persetujuan', mngr_finance_user_app = '$_SESSION[namalengkap]', mngr_finance_app_time='$app_time' where md5(md5(no_spk)) = '$_GET[id]'");
				}else{
					mysql_unbuffered_query("update unit_keluar set spv_app = '',mngr_app = '',salesadm_app = '',status_approved = '$persetujuan_akhir',ket_approved = '$ket_approved', mngr_finance_app = '$persetujuan', mngr_finance_user_app = '$_SESSION[namalengkap]', mngr_finance_app_time='$app_time' where md5(md5(no_spk)) = '$_GET[id]'");
				}
				mysql_unbuffered_query("update notif_permohonan_unit_keluar set read_finance = 'Y' where md5(md5(no_spk)) = '$_GET[id]'");
			}
			
		}elseif($_SESSION['leveluser']=='ar_finance' or $_SESSION['leveluser']=='admin'){
			if($r['salesadm_app']=='Y'){
				mysql_unbuffered_query("update unit_keluar set catatan = '$catatan' where md5(md5(no_spk)) = '$_GET[id]'");
			}
		}
	
	    $msg = "
					
		<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4><i class='icon fa fa-check'></i> Selamat!</h4>
		Dokumen sudah diproses.
		</div>
		
		";
	
		

	}	
	
	
	$a = mysql_query("select * from unit_keluar where md5(md5(no_spk)) = '$_GET[id]'");
	$j = mysql_fetch_array($a);
	
		$get_kode_sales = mysql_query("select kode_sales, nama_lengkap from users where username = '$j[nama_sales]'");
			$data_get_kode_sales = mysql_fetch_array($get_kode_sales);
			$kode_sales = $data_get_kode_sales['kode_sales'];
			$nama_lengkap = $data_get_kode_sales['nama_lengkap'];
    
?>
				
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">
									<?php 
										if ($_GET[act] == 'approvedpermohonan'){echo "Setujui Permohonan Unit Keluar";}
									//	elseif ($_GET[act] == 'ajukanapprove'){echo "Ajukan Pengajuan Discount";}


									?></h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li class="active">
										<span>Permohonan Unit Keluar</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
								
								<script>
								/*	function cekstatus(){
										var Cek_status = $('input[name=status_approved]:checked').val();
										
										if  (Cek_status == "3"){
											$("#id_ket_approve").hide();
											$("#id_ket_permohonan").show();
										}else if (Cek_status == "2") {
											$("#id_ket_permohonan").hide();
											$("#id_ket_approve").show();
											
										}else if (Cek_status == "1") {
											$("#id_ket_approve").hide();
											
										}
									}	*/
								</script>
								
								
									<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action="" >
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
											
												<?php
													$qry1 = mysql_query("select * from matching_local where no_spk_local='$j[no_spk]'");
													$sql1 = mysql_fetch_array($qry1);
													
													$qry2 = mysql_query("select * from data_mobil where norangka='$sql1[norangka_local]'");
													$sql2 = mysql_fetch_array($qry2);
													
													$qry3 = mysql_query("SELECT pd.tipe_mobil as tipe_mobil, t.nama_tipe as nama_tipe, pd.*, t.* FROM pengajuan_discount pd, tipe t where no_spk='$j[no_spk]' and t.kode_tipe = pd.tipe_mobil");
													$sql3 = mysql_fetch_array($qry3);
													
													$qry4 = mysql_query("select * from status_spk where no_spk='$sql3[no_spk]'");
													$sql4 = mysql_fetch_array($qry4);
													
													$query = "select SPK.* from vw_PukSOS SPK
																 where NomorSPK = '$j[no_spk]'";
																 
													$query = sqlsrv_query($conn, $query);
													$data_detail = sqlsrv_fetch_array($query);
												?>
												<div class="row">
													<div class="col-md-3">
														<fieldset>
															<legend>FORM PERMOHONAN UNIT KELUAR </legend>
															<div class="form-group">
																<label class="control-label">
																	NO PUK <span class="symbol required"></span>
																</label>
																<input type="text" class="form-control" value ="<?php echo $j['no_puk'] ?>" readonly>
																</input>
															</div>
															<div class="form-group">
																<label class="control-label">
																	NO SPK <span class="symbol required"></span>
																</label>
																<input type="text" placeholder="No SPK" class="form-control" value ="<?php echo $j['no_spk'] ?>" readonly>
																</input>
															</div>
															<div class="form-group">
																<label class="control-label">
																	Pemohon <span class="symbol required"></span>
																</label>
																<input type="text" placeholder="No Permohonan" class="form-control" value ="<?php echo strtoupper($nama_lengkap).' / '.$j['input'] ?>" id="no_permohonan" name="no_permohonan" required readonly>
																</input>
															</div>
															<div class="form-group">
																<label class="control-label">
																	Nama Customer <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" value ="<?php echo $sql3['nama_customer'] ?>" placeholder="Nama Customer" class="form-control" id="customer" name="nama_customer" required readonly>
															</div>
															<div class="form-group">
																<label for="form-field-select-2">
																	Tipe <span class="symbol required"></span>
																</label>	
																<input type="text" placeholder="" class="form-control" value="<?php echo trim($sql3['tipe_mobil']).' / '.$sql3['nama_tipe'] ?>" id="tipe_mobil" name="tipe_mobil" required readonly>
															</div>
															<div class="form-group">
																<label class="control-label">
																	Warna <span class="symbol required"></span>
																</label>
																<input type="text" placeholder="" class="form-control" value="<?php echo $sql3['warna'] ?>" id="warna" name="warna" required readonly />
															</div>
															<div class="form-group">
																<label class="control-label">
																	No Rangka <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" value ="<?php echo $data_detail['NoRangka'] ?>" onblur="this.value=this.value.toUpperCase()" placeholder="No Rangka" class="form-control" id="no_rangka" name="no_rangka" required readonly>
															</div>
															<div class="form-group">
																<label class="control-label">
																	No Mesin <span class="symbol required"></span>
																</label>
																<input type="text" style="text-transform:uppercase" value ="<?php echo $data_detail['NoMesin'] ?>" onblur="this.value=this.value.toUpperCase()" placeholder="No Mesin" class="form-control" id="no_mesin" name="no_mesin" required readonly>
															</div>
															
															
															
													<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action=""  >			
															<div class="form-group">
																<label class="control-label">
																	Waktu Keluar <span class="symbol required"></span>
																</label>
																<input type="text" class="form-control" id="tgl_unit_keluar" readonly name="tgl_unit_keluar" value="<?php echo $j['waktu_keluar'] ?>" required />
															</div>
															
															<div class="form-group">
																<label class="control-label">
																	Keterangan <span class="symbol required"></span>
																</label>
																<div class="form-group">
																	<div class="note-editor">
																		<textarea class="form-control" id="keterangan" name="keterangan" disabled><?php echo $j['keterangan'] ?></textarea>
																	</div>
																</div>
															</div>
														</fieldset>
														
													</div>	
													<div class="col-md-9">
														<fieldset>
															<legend>DATA PEMBAYARAN</legend>
															<?php
																		$query = "select SPK.* from vw_PukSOS SPK
																					 where NomorSPK = '$j[no_spk]'";
																					 
																		$query = sqlsrv_query($conn, $query);
																		$data_detail = sqlsrv_fetch_array($query);
																		
																		?>
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">
																		Jenis Pembayaran <span class="symbol required"></span>
																	</label>
																	<input type="text" style="text-transform:uppercase" value ="<?php echo $data_detail['JenisPenjualan']; ?>" onblur="this.value=this.value.toUpperCase()" placeholder="JENIS PEMBAYARAN" class="form-control" id="no_rangka" name="no_rangka" required readonly>
																</div>
															</div>
															<?php  if ($data_detail['JenisPenjualan'] != 'Tunai'){ ?>
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">
																		Leasing <span class="symbol required"></span>
																	</label>
																	<input type="text" style="text-transform:uppercase" value ="<?php echo $data_detail['NamaLeasing']; ?>" onblur="this.value=this.value.toUpperCase()" placeholder="LEASING" class="form-control" id="no_rangka" name="no_rangka" required readonly>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">
																		Tenor <span class="symbol required"></span>
																	</label>
																	<input type="text" style="text-transform:uppercase" value ="<?php echo $data_detail['lamaangsuran']." Bulan"; ?>" onblur="this.value=this.value.toUpperCase()" placeholder="TENOR" class="form-control" id="no_rangka" name="no_rangka" required readonly>
																</div>
															</div>
															<?php }?>
														</fieldset>
														<fieldset>
															<legend>DAFTAR AR</legend>														
															<div class="table-responsive">
																<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
																	<tbody>
																	<tr><th></th><th>PENJUALAN</th><th>PEMBAYARAN</th><th>SISA</th></tr>
																	<?php
																		
																		//PEMBAYARAN PEMBAYARAN ============================================================================
																		$carabeli = $data_detail['JenisPenjualan'];
																		$no_penjualan = $data_detail['NomorFakturJual'];
																		$no_kontrak = $data_detail['NomorKontrak'];
																		$norangka = $data_detail['NoRangka'];
																		$nomesin = $data_detail['NoMesin'];
																		$discount = $data_detail['Diskon'];
																		$tipe = $data_detail['NamaTipe'];
																		$warna = $data_detail['NamaWarna'];
																		$nama_customer = $data_detail['NamaCustomer'];
																		$carabeli = $data_detail['JenisPenjualan'];
																		$leasing = $data_detail['NamaLeasing'];
																		$nama_sales = $data_detail['NamaSalesman'];
																	
																		$query_pembayaran = "SELECT PK.hargaperunit,pk.DiscUnit,ak.NilaiTDP FROM UntT_PesananKendaraan PK left join UntT_AplikasiKredit AK on PK.nomor = AK.nomor_pesanan where PK.nomor = '$j[no_spk]'";
																		$query_pembayaran = sqlsrv_query($conn, $query_pembayaran);
																		$data_pembayaran = sqlsrv_fetch_array($query_pembayaran);
																		$disc_unit = $data_pembayaran['DiscUnit'];
																		$harga_otr = $data_pembayaran['hargaperunit'] - $data_pembayaran['DiscUnit'];
																		
																		$query_pembayaran = "select sum(NilaiPenerimaan) as total_uang_muka from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'Uang Muka'";
																		$query_pembayaran = sqlsrv_query($conn, $query_pembayaran);
																		$data_pembayaran = sqlsrv_fetch_array($query_pembayaran);
																		$total_uang_muka = $data_pembayaran['total_uang_muka'];
																		
																		$query_pembayaran = "select sum(NilaiPenerimaan) as total_pelunasan from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'Pelunasan'";
																		$query_pembayaran = sqlsrv_query($conn, $query_pembayaran);
																		$data_pembayaran = sqlsrv_fetch_array($query_pembayaran);
																		$total_pelunasan = $data_pembayaran['total_pelunasan'];
																		
																		$total_bayar = $total_uang_muka + $total_pelunasan;
																		
																		
																		/// AR UNIR ===========================
			
																		$spk = " SELECT PK.hargaperunit,pk.DiscUnit,ak.NilaiTDP,ak.nilaikredit FROM UntT_PesananKendaraan PK left join UntT_AplikasiKredit AK on PK.nomor = AK.nomor_pesanan where PK.nomor = '$j[no_spk]'";
																		$spk = sqlsrv_query($conn, $spk);
																		
																		
																		while ($data_spk = sqlsrv_fetch_array($spk)){
																			$disc = $data_spk['DiscUnit'];
																			
																			if ($carabeli == "Tunai" || $carabeli == "COP"){
																				$ar_unit = $data_spk['hargaperunit'];
																				$sisa_bayar = $harga_otr - $total_bayar;
																				
																			}
																			if ($carabeli == "Kredit"){
																				$ar_unit_tdp = $data_spk['NilaiTDP'];
																				$ar_unit = $data_spk['hargaperunit'];
																				//$sisa_bayar = $ar_unit - $disc_unit - $total_bayar;
																				$sisa_bayar = $ar_unit - $disc_unit - $total_bayar;
																				$nilaikredit = $data_spk['nilaikredit'];
																			}
																			
																			
																		}
																			echo "
																				<tr><th>".($carabeli == "Tunai" ? "Harga OTR - Disc" : "Total TDP: ".number_format($ar_unit_tdp - $disc_unit,0,".",".")." - (Pel Leasing: ".number_format($nilaikredit,0,".",".").")" )."</th><th>".number_format($ar_unit - $disc_unit,0,".",".")."</th><th>
																				".number_format($total_bayar,0,".",".")."</th><th>".number_format($sisa_bayar,0,".",".")."</th></tr>
																				";
																				
																		
																		
																		$query_accessories = "select sum(hargajualakhir) as araksesoris from UntT_AccessoriesPurnaJual where norangka = '$norangka'";
																		$query_accessories = sqlsrv_query($conn, $query_accessories);
																		$data_query_accessories = sqlsrv_fetch_array($query_accessories);
																		
																		
																		$query_pelunasan_accessories = "select sum(NilaiPenerimaan) as NilaiPenerimaan from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'Accessories PJ'";
																		$query_pelunasan_accessories = sqlsrv_query($conn, $query_pelunasan_accessories);
																		$data_query_pelunasan_accessories = sqlsrv_fetch_array($query_pelunasan_accessories);
																			echo "
																				<tr><th>Accessories Purna Jual</th><th>".number_format($data_query_accessories['araksesoris'],0,".",".")."</th><th>".number_format($data_query_pelunasan_accessories['NilaiPenerimaan'],0,".",".")."</th><th>".number_format($data_query_accessories['araksesoris'] - $data_query_pelunasan_accessories['NilaiPenerimaan'],0,".",".")."</th></tr>
																				";
																		
																		
																		
																		$query_asuransi = "select sum(hargajualakhir) as arasuransi from UntT_AsuransiPurnaJual where norangka = '$norangka'";
																		$query_asuransi = sqlsrv_query($conn, $query_asuransi);
																		$data_asuransi = sqlsrv_fetch_array($query_asuransi);
																		
																		$query_pelunasan_asuransi = "select sum(NilaiPenerimaan) as NilaiPenerimaan from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'Asuransi PJ'";
																		$query_pelunasan_asuransi = sqlsrv_query($conn, $query_pelunasan_asuransi);
																		$data_query_pelunasan_asuransi = sqlsrv_fetch_array($query_pelunasan_asuransi);
																		
																		
																			echo "
																				<tr><th>Asuransi Purna Jual</th><th>".number_format($data_asuransi['arasuransi'],0,".",".")."</th><th>".number_format($data_query_pelunasan_asuransi['NilaiPenerimaan'],0,".",".")."</th><th>".number_format($data_asuransi['arasuransi'] - $data_query_pelunasan_asuransi['NilaiPenerimaan'],0,".",".")."</th></tr>
																				";
																				
																		
																		
																		$query_dokumenpj = "select sum(hjtotal) as arpurnajual from UntT_NomorPolisiKhususPurnaJual where nomor_pesanan = '$j[no_spk]'";
																		$query_dokumenpj = sqlsrv_query($conn, $query_dokumenpj);
																		$data_dokumenpj = sqlsrv_fetch_array($query_dokumenpj);
																		
																		$query_pelunasan_dokumenpj = "select sum(NilaiPenerimaan) as NilaiPenerimaan from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'P.Dokumen PJ'";
																		$query_pelunasan_dokumenpj = sqlsrv_query($conn, $query_pelunasan_dokumenpj);
																		$data_query_pelunasan_dokumenpj = sqlsrv_fetch_array($query_pelunasan_dokumenpj);
																			echo "
																				<tr><th>Pengurusan Dokumen Purna Jual</th><th>".number_format($data_dokumenpj['arpurnajual'],0,".",".")."</th><th>".number_format($data_query_pelunasan_dokumenpj['NilaiPenerimaan'],0,".",".")."</th><th>".number_format($data_dokumenpj['arpurnajual'] - $data_query_pelunasan_dokumenpj['NilaiPenerimaan'],0,".",".")."</th></tr>
																				";
																	?>
																	</tbody>
																</table>
															</div>
														</fieldset>
														<?php
															$query_pembayaran = "select count(NomorKwitansi) as jumlah from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'Uang Muka'";
															$query_pembayaran = sqlsrv_query($conn, $query_pembayaran);
															$no = 0;
															$data_pembayaran = sqlsrv_fetch_array($query_pembayaran);
															$jumlah_record = $data_pembayaran['jumlah'];
															if($jumlah_record > 0){
														?>
														<fieldset>
															<legend>UANG MUKA</legend>
															<div class="table-responsive">
																<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
																	<tbody>
																	<tr><th width="3%">No</th><th>NO KWITANSI</th><th>TANGGAL KWITANSI</th><th>JENIS PEMBAYARAN</th><th>NILAI PENERIMAAN</th></tr>
																	<?php
																		$query_pembayaran = "select *, convert(varchar, TanggalKwitansi, 120) as tanggal from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'Uang Muka'";
																		$query_pembayaran = sqlsrv_query($conn, $query_pembayaran);
																		$no = 0;
																		while ($data_pembayaran = sqlsrv_fetch_array($query_pembayaran)){
																			$no++;
																			echo "
																				<tr><th>$no</th><th>".$data_pembayaran['NomorKwitansi']."</th><th>".$data_pembayaran['tanggal']."</th><th>".$data_pembayaran['JenisPembayaran']."</th><th>".number_format($data_pembayaran['NilaiPenerimaan'],0,".",".")."</th></tr>
																				";
																		}
																	?>
																	</tbody>
																</table>
															</div>
														</fieldset>
														<?php
															}
															
															$query_pembayaran = "select count(NomorKwitansi) as jumlah from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'Pelunasan'";
															$query_pembayaran = sqlsrv_query($conn, $query_pembayaran);
															$no = 0;
															$data_pembayaran = sqlsrv_fetch_array($query_pembayaran);
															$jumlah_record = $data_pembayaran['jumlah'];
															if($jumlah_record > 0){
														?>
														<fieldset>
															<legend>PELUNASAN</legend>		
															<div class="table-responsive">
																<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
																	<tbody>
																	<tr><th width="3%">No</th><th>NO KWITANSI</th><th>TANGGAL KWITANSI</th><th>JENIS PEMBAYARAN</th><th>NILAI PENERIMAAN</th></tr>
																		<?php
																			$query_pembayaran = "select *, convert(varchar, TanggalKwitansi, 120) as tanggal from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'Pelunasan'";
																			$query_pembayaran = sqlsrv_query($conn, $query_pembayaran);
																			$no = 0;
																			while ($data_pembayaran = sqlsrv_fetch_array($query_pembayaran)){
																				$no++;
																				echo "
																					<tr><th>$no</th><th>".$data_pembayaran['NomorKwitansi']."</th><th>".$data_pembayaran['tanggal']."</th><th>".$data_pembayaran['JenisPembayaran']."</th><th>".number_format($data_pembayaran['NilaiPenerimaan'],0,".",".")."</th></tr>
																					";
																			}
																		?>
																	</tbody>
																</table>
															</div>
														</fieldset>
														<?php
															}
															$query_cek_pelunasan_asuransi = "select count(NomorPesanan) as jumlah from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'Asuransi PJ'";
															$query_cek_pelunasan_asuransi = sqlsrv_query($conn, $query_cek_pelunasan_asuransi);
															$data_query_cek_pelunasan_asuransi = sqlsrv_fetch_array($query_cek_pelunasan_asuransi);
															$no = 0;
															$jumlah_record = $data_query_cek_pelunasan_asuransi['jumlah'];
															if($jumlah_record > 0){
														?>
														<fieldset>
															<legend>ASURANSI PURNA JUAL</legend>		
															<div class="table-responsive">
																<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
																	<tbody>
																	<tr><th width="3%">No</th><th>NO KWITANSI</th><th>TANGGAL KWITANSI</th><th>JENIS PEMBAYARAN</th><th>NILAI PENERIMAAN</th></tr>
																		<?php
																		//	$query_pelunasan_asuransi = "select nomor, convert(varchar, tanggal, 120) as tanggal, hargajualakhir from UntT_AsuransiPurnaJual where norangka = '$norangka'";
																			$query_pelunasan_asuransi = "select *, convert(varchar, TanggalKwitansi, 120) as tanggal from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'Asuransi PJ'";
																			$query_pelunasan_asuransi = sqlsrv_query($conn, $query_pelunasan_asuransi);
																			$no = 0;
																			while ($data_query_pelunasan_asuransi = sqlsrv_fetch_array($query_pelunasan_asuransi)){
																				$no++;
																				echo "
																					<tr><th>$no</th><th>".$data_query_pelunasan_asuransi['NomorKwitansi']."</th><th>".$data_query_pelunasan_asuransi['tanggal']."</th><th>".$data_query_pelunasan_asuransi['JenisPembayaran']."</th><th>".number_format($data_query_pelunasan_asuransi['NilaiPenerimaan'],0,".",".")."</th></tr>
																					";
																					
																			}
																		?>
																	</tbody>
																</table>
															</div>
														</fieldset>
														<?php
															}
														
															$query_pelunasan_accessories = "select count(NomorPesanan) as jumlah from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'Accessories PJ'";
															$query_pelunasan_accessories = sqlsrv_query($conn, $query_pelunasan_accessories);
															$data_query_pelunasan_accessories = sqlsrv_fetch_array($query_pelunasan_accessories);
															$no = 0;
															$jumlah_record = $data_query_pelunasan_accessories['jumlah'];
															if($jumlah_record > 0){
														?>
														
														<fieldset>
															<legend>ACCESSORIES PURNA JUAL</legend>		
															<div class="table-responsive">
																<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
																	<tbody>
																	<tr><th width="3%">No</th><th>NO KWITANSI</th><th>TANGGAL KWITANSI</th><th>JENIS PEMBAYARAN</th><th>NILAI PENERIMAAN</th></tr>
																		<?php
																		//	$query_pelunasan_accessories = "select nomor, convert(varchar, tanggal, 120) as tanggal, hargajualakhir from UntT_AccessoriesPurnaJual where norangka = '$norangka'";
																			$query_pelunasan_accessories = "select *, convert(varchar, TanggalKwitansi, 120) as tanggal from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'Accessories PJ'";
																			$query_pelunasan_accessories = sqlsrv_query($conn, $query_pelunasan_accessories);
																			
																			$no = 0;
																			while ($data_query_pelunasan_accessories = sqlsrv_fetch_array($query_pelunasan_accessories)){
																				$no++;
																				echo "
																					<tr><th>$no</th><th>".$data_query_pelunasan_accessories['NomorKwitansi']."</th><th>".$data_query_pelunasan_accessories['tanggal']."</th><th>".$data_query_pelunasan_accessories['JenisPembayaran']."</th><th>".number_format($data_query_pelunasan_accessories['NilaiPenerimaan'],0,".",".")."</th></tr>
																					";
																			}
																		?>
																	</tbody>
																</table>
															</div>
														</fieldset>
														<?php
															}
														
															$query_pelunasan_purna_jual = "select count(NomorPesanan) as jumlah from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'P.Dokumen PJ'";
															$query_pelunasan_purna_jual = sqlsrv_query($conn, $query_pelunasan_purna_jual);
															$data_query_pelunasan_purna_jual = sqlsrv_fetch_array($query_pelunasan_purna_jual);
															$no = 0;
															$jumlah_record = $data_query_pelunasan_purna_jual['jumlah'];
															if($jumlah_record > 0){
														?>
														
														<fieldset>
															<legend>PENGURUSAN DOKUMEN PURNA JUAL</legend>		
															<div class="table-responsive">
																<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
																	<tbody>
																	<tr><th width="3%">No</th><th>NO KWITANSI</th><th>TANGGAL KWITANSI</th><th>JENIS PEMBAYARAN</th><th>NILAI PENERIMAAN</th></tr>
																		<?php
																		//	$query_pelunasan_purna_jual = "select nomor, convert(varchar, tanggal, 120) as tanggal, hjtotal from UntT_NomorPolisiKhususPurnaJual where nomor_pesanan = '$j[no_spk]'";
																			$query_pelunasan_purna_jual = "select *, convert(varchar, TanggalKwitansi, 120) as tanggal from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$j[no_spk]' and JenisKwitansi = 'P.Dokumen PJ'";
																			$query_pelunasan_purna_jual = sqlsrv_query($conn, $query_pelunasan_purna_jual);
																			
																			$no = 0;
																			while ($data_query_pelunasan_purna_jual = sqlsrv_fetch_array($query_pelunasan_purna_jual)){
																				$no++;
																				echo "
																					<tr><th>$no</th><th>".$data_query_pelunasan_purna_jual['NomorKwitansi']."</th><th>".$data_query_pelunasan_purna_jual['tanggal']."</th><th>".$data_query_pelunasan_purna_jual['JenisPembayaran']."</th><th>".number_format($data_query_pelunasan_purna_jual['NilaiPenerimaan'],0,".",".")."</th></tr>
																					";
																			}
																		?>
																	</tbody>
																</table>
															</div>
														</fieldset>
														<?php
															}
														?>
													</div>
												</div>
												
												
												<?php
													if($_SESSION['leveluser'] == 'admin' or ($_SESSION['leveluser'] == 'ar_finance' and $j['salesadm_app'] == 'Y') or ($_SESSION['leveluser'] == 'mngr_finance' and $j['salesadm_app'] == 'Y')){
														
														if($_SESSION['leveluser'] == 'mngr_finance'){
															$readonly = "readonly";
														}else{
															$readonly = "";
														}
												?>
												<div class="form-group">
													<label class="control-label">
														Catatan <span class="symbol required"></span>
													</label>
													<div class="form-group">
														<div class="note-editor">
															<textarea class="form-control" id="catatan" name="catatan" <?php echo $readonly ?>><?php echo $j['catatan'] ?></textarea>
														</div>
													</div>
												</div>
												<?php
													}
												?>
												
												
												<?php 
												if ($_GET[act] == 'approvedpermohonan'){
												
												if(($_SESSION['leveluser'] == 'admin' and $j['spv_app'] == '') or ($_SESSION['leveluser'] == 'supervisor' and $j['spv_app'] == '') or ($_SESSION['leveluser'] == 'MNGR' and $j['spv_app'] == 'Y' and $j['mngr_app'] == '')
													or ($_SESSION['leveluser'] == 'salesadm' and $j['mngr_app'] == 'Y' and $j['salesadm_app'] == '') or ($_SESSION['leveluser'] == 'staff_salesadm' and $j['mngr_app'] == 'Y' and $j['salesadm_app'] == '') or ($_SESSION['leveluser'] == 'mngr_finance' and $j['salesadm_app'] == 'Y' and $j['mngr_finance_app'] == '')){
												?>
												<div class="radio clip-radio radio-primary radio-inline">												
													<input type="radio" id="radio1" name="status_approved" value="1" <?php if($_POST['status_approved']=='1'){echo 'checked';}?> onclick="cekstatus();" >
													
													<label for="radio1">
														Setujui
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="status_approved" value="2" <?php if($_POST['status_approved']=='2' and count($_POST)){echo 'checked';}?> onclick="cekstatus();" >
													<label for="radio2">
														Tidak Di Setujui
													</label>
												</div>
												<?php }
												}?>
												
												<?php
													if($_SESSION['leveluser'] != 'ar_finance'){
												?>
												<div class="form-group">
													<label class="control-label">
														Keterangan Persetujuan <span class="symbol required"></span>
													</label>
													<div class="form-group">
														<div class="note-editor">
															<textarea class="form-control" id="keterangan" name="ket_approved" ><?php echo $j['ket_approved'] ?></textarea>
														</div>
													</div>
												</div>
												<?php
													}
												?>
												
												
												
												
												
											    <hr>
												<?php if(!count($_POST)) {
													if(($_SESSION['leveluser'] == 'admin' and $j['spv_app'] == '') or ($_SESSION['leveluser'] == 'supervisor' and $j['spv_app'] == '') or ($_SESSION['leveluser'] == 'MNGR' and $j['spv_app'] == 'Y' and $j['mngr_app'] == '')
													or ($_SESSION['leveluser'] == 'salesadm' and $j['mngr_app'] == 'Y' and $j['salesadm_app'] == '')  or ($_SESSION['leveluser'] == 'staff_salesadm' and $j['mngr_app'] == 'Y' and $j['salesadm_app'] == '') 
													or ($_SESSION['leveluser'] == 'mngr_finance' and $j['salesadm_app'] == 'Y' and $j['mngr_finance_app'] == '') or ($_SESSION['leveluser'] == 'ar_finance' and $j['salesadm_app'] == 'Y')){
												?>
												<button id="tombolsave" class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
												<?php }
												}
												?>
												<?php
													if($_GET['notif']!='Y'){
												?>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=<?php if(count($_POST)) { echo "history.go(-2)"; } else {echo "history.go(-1)";}?>>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
												
												<?php
													}else{
												?>
												
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=window.location.href='media_showroom.php?module=logistik_puk';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
												
												<?php
													}
												?>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>