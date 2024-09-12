<?php
	include "config/koneksi_sqlserver.php";
	
	$no_spk = addslashes($_GET['id']);
	
	
	$a = "select * from pemasangan_aksesoris where no_spk = '$no_spk'";
	
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
	
	if(count($_POST)) {
				
				if($_SESSION['leveluser']=='salesadm' || $_SESSION['leveluser']=='staff_salesadm'){
					
						$status_pemesanan_akhir = ($_POST[status_pemesanan] == "1" ? "P" : "BP");
						mysql_unbuffered_query("update pemasangan_aksesoris set status_pemesanan = '$status_pemesanan_akhir' where no_spk = '$no_spk'");
					
					
				}
				
				
				
				$query = mysql_query("select count(no_permohonan) as total from pemasangan_aksesoris_md where no_permohonan = '$r[no_permohonan]'");
				$data = mysql_fetch_array($query);
				$tot_md= $data['total'];
				
				for ($md = 0 ; $md <= $tot_md ;$md++){
					
					
					
					
					$id = mysql_real_escape_string($_POST['id_md'.$md]);
					$pemasangan = mysql_real_escape_string($_POST['checkbox_md'.$md]);
					$no_transaksi = strtoupper(mysql_real_escape_string($_POST['no_transaksi_md'.$md]));
					$supplier = strtoupper(mysql_real_escape_string($_POST['supplier_md'.$md]));
					
					mysql_unbuffered_query("update pemasangan_aksesoris_md set pemesanan = '$pemasangan',nomor_transaksi = '$no_transaksi',supplier = '$supplier' where id = '$id' ");
					
				}
				
				
				
				
				
				$query = mysql_query("select count(no_permohonan) as total from pemasangan_aksesoris_bonus where no_permohonan = '$r[no_permohonan]'");
				$data = mysql_fetch_array($query);
				$tot_bonus= $data['total'];
				
				for ($no = 0 ; $no <= $tot_bonus ;$no++){
					
					
					
					
					$id_bonus = mysql_real_escape_string($_POST['id_bonus'.$no]);
					$pemasangan_bonus = mysql_real_escape_string($_POST['checkbox_bonus'.$no]);
					$no_transaksi = strtoupper(mysql_real_escape_string($_POST['no_transaksi_bonus'.$no]));
					$supplier = strtoupper(mysql_real_escape_string($_POST['supplier_bonus'.$no]));
					
					
					mysql_unbuffered_query("update pemasangan_aksesoris_bonus set pemesanan = '$pemasangan_bonus',nomor_transaksi = '$no_transaksi',supplier = '$supplier' where id = '$id_bonus' ");
					
				}
				
				$kata = "";
				
				
				$query = mysql_query("select count(no_permohonan) as total from pemasangan_aksesoris_tambahan where no_permohonan = '$r[no_permohonan]'");
				$data = mysql_fetch_array($query);
				$tot_tambahan= $data['total'];
				
				for ($no = 0 ; $no <= $tot_tambahan ;$no++){
					
					
					
					
					$id = mysql_real_escape_string($_POST['id_tambahan'.$no]);
					$pemesanan = mysql_real_escape_string($_POST['checkbox_tambahan'.$no]);
					$no_transaksi = strtoupper(mysql_real_escape_string($_POST['no_transaksi_tambahan'.$no]));
					$supplier = strtoupper(mysql_real_escape_string($_POST['supplier_tambahan'.$no]));
					
					
					mysql_unbuffered_query("update pemasangan_aksesoris_tambahan set pemesanan = '$pemesanan',nomor_transaksi = '$no_transaksi',supplier = '$supplier' where id = '$id' ");
					
				}
				
				
					$msg = "
								
					<div class='alert alert-success alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<h4><i class='icon fa fa-check'></i> Selamat!</h4>
					Dokumen sudah diproses $kata.
					</div>
					
					";
				
		

	}	//tutup if
	
	
	$a = mysql_query("select * from pemasangan_aksesoris where no_spk = '$no_spk'");
	$j = mysql_fetch_array($a);
    
?>
				
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">
									<?php 
										if ($_GET[act] == 'ubahstatuspemesanan'){echo "Status Pemesanan Aksesoris";}
									//	elseif ($_GET[act] == 'ajukanapprove'){echo "Ajukan Pengajuan Discount";}


									?></h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
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
												
												<div class="row">
													<div class="col-md-3">
														
														<fieldset>
															<legend>FORM AKSESORIS UNIT KELUAR</legend>
															
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
																
																	<input type="text" class="form-control" id="tgl_unit_keluar" readonly name="tgl_unit_keluar" value="<?php echo $j['tgl_unit_keluar'] ?>" required />
																	
															</div>
														</fieldset>
														
													</div>	
												<form role="form" id="form" name="form" enctype="multipart/form-data" method="post" action=""  >
													<div class="col-md-9">
														<fieldset>
															<legend>AKSESORIS MD</legend>														
															<div class="table-responsive">
																<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
																	<tbody>
																	<tr><th width="5%">PESAN</th><th width="30%">AKSESORIS</th><th width="10%">NOMOR</th><th width="20%">VENDOR</th><th>KETERANGAN</th></tr>
																<?php 
																	$query = mysql_query("select * from pemasangan_aksesoris_md where no_permohonan = '$j[no_permohonan]'");
																	$no_md = 0;
																	while ($data = mysql_fetch_array($query)){
																		$query_sql = "select pma.nomor,pma.nomor_supplier,pma.TipeAcc,pma.kode_accessories,UA.nama as nama_accessories,gs.nama as nama_supplier from UntT_PesanMatchingAccessories PMA
																				left join UntM_Accessories UA on UA.kode = PMA.kode_accessories
																				left join GlbM_Supplier gs on gs.nomor = pma.nomor_supplier
																			where PMA.nomor_pesanan = '$j[no_spk]' and tipeacc = 'program imora' and pma.batal = 0 and pma.kode_accessories = '$data[kode_accs]'
																				
																				 ";
																				 
																		
																		$params = array();
																		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																		$row = sqlsrv_query( $conn, $query_sql , $params, $options );
																		
																		$row_count = sqlsrv_num_rows($row);
																		
																		if ($row_count > 0){
																			$query_sql = sqlsrv_query($conn, $query_sql);
	
																			while($data_sql = sqlsrv_fetch_array($query_sql)){
																				$nomor_transaksi = $data_sql['nomor'];
																				$supplier = $data_sql['nama_supplier'];
																			}
																			
																		}else{
																			
																			$nomor_transaksi = $data['nomor_transaksi'];
																			$supplier = $data['supplier'];
																		}
																		
																		
																		
																		$no_md ++;
																		$pemesanan = ($data['pemesanan'] == "Y" ? "checked" : "");
																		
																		echo "<tr>
																				<td>
																					<input type='hidden' value='$data[id]' name='id_md$no_md' >
																					
																					<div class='checkbox clip-check check-primary checkbox-inline' style='line-height: 10px;'>
																						<input id='md$no_md' value='Y' name='checkbox_md$no_md'  type='checkbox' $pemesanan >
																						<label for='md$no_md'>
																							
																						</label>
																					</div>
																				
																				</td>
																				<td>$data[nama_aksesoris]</td>
																				<td><input type='text' size='10px' value='$nomor_transaksi' name='no_transaksi_md$no_md' ></td>
																				<td><input type='text' size='25px' value='$supplier' name='supplier_md$no_md' ></td>
																				<td>$data[keterangan]</td>
																				
																			</tr>";
																		
																	}
																?>
																	</tbody>
																</table>
															</div>
														</fieldset>
														<fieldset>
															<legend>AKSESORIS BONUS</legend>														
															<div class="table-responsive">
																<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
																	<tbody>
																	<tr><th width="5%">PESAN</th><th width="30%">AKSESORIS</th><th width="10%">NOMOR</th><th width="20%">VENDOR</th><th>KETERANGAN</th></tr>
																<?php 
																	$query = mysql_query("select * from pemasangan_aksesoris_bonus where no_permohonan = '$j[no_permohonan]'");
																	
																	$no_bonus = 0;
																	while ($data = mysql_fetch_array($query)){
																		
																		$query_sql = "select pma.nomor,pma.nomor_supplier,pma.TipeAcc,pma.kode_accessories,UA.nama as nama_accessories,gs.nama as nama_supplier from UntT_PesanMatchingAccessories PMA
																				left join UntM_Accessories UA on UA.kode = PMA.kode_accessories
																				left join GlbM_Supplier gs on gs.nomor = pma.nomor_supplier
																			where PMA.nomor_pesanan = '$j[no_spk]' and tipeacc != 'program imora' and pma.batal = 0 and pma.kode_accessories = '$data[kode_accs]'
																				
																				 ";
																				 
																		
																		$params = array();
																		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																		$row = sqlsrv_query( $conn, $query_sql , $params, $options );
																		
																		$row_count = sqlsrv_num_rows($row);
																		
																		if ($row_count > 0){
																			$query_sql = sqlsrv_query($conn, $query_sql);
	
																			while($data_sql = sqlsrv_fetch_array($query_sql)){
																				$nomor_transaksi = $data_sql['nomor'];
																				$supplier = $data_sql['nama_supplier'];
																			}
																			
																		}else{
																			
																			$nomor_transaksi = $data['nomor_transaksi'];
																			$supplier = $data['supplier'];
																		}
																		
																		
																		$no_bonus ++;
																		$pemesanan = ($data['pemesanan'] == "Y" ? "checked" : "");
																		
																		echo "<tr>
																				<td>
																					<input type='hidden' value='$data[id]' name='id_bonus$no_bonus' >
																					
																					<div class='checkbox clip-check check-primary checkbox-inline' style='line-height: 10px;'>
																						<input id='bonus$no_bonus' value='Y' name='checkbox_bonus$no_bonus'  type='checkbox' $pemesanan>
																						<label for='bonus$no_bonus'>
																							
																						</label>
																					</div>
																				
																				</td>
																				<td>$data[nama_aksesoris]</td>
																				<td><input type='text' size='10px' value='$nomor_transaksi' name='no_transaksi_bonus$no_bonus' ></td>
																				<td><input type='text' size='25px' value='$supplier' name='supplier_bonus$no_bonus' ></td>
																				<td>$data[keterangan]</td>
																				
																			</tr>";
																		
																	}
																?>
																	</tbody>
																</table>
															</div>
														</fieldset>
														<fieldset>
															<legend>AKSESORIS TAMBAHAN</legend>														
															<div class="table-responsive">
																<table class="table table-bordered table-condensed table-striped table-hover" id="sample-table-1">
																	<tbody>
																	<tr><th width="5%">PESAN</th><th width="30%">AKSESORIS</th><th width="10%">NOMOR</th><th width="20%">VENDOR</th><th>HARGA</th><th>KETERANGAN</th></tr>
																<?php 
																	$query = mysql_query("select * from pemasangan_aksesoris_tambahan where no_permohonan = '$j[no_permohonan]'");
																	$no_tambahan = 0;
																	while ($data = mysql_fetch_array($query)){
																		$no_tambahan ++;
																		$pemesanan = ($data['pemesanan'] == "Y" ? "checked" : "");
																		
																		echo "<tr>
																				<td>
																					<input type='hidden' value='$data[id]' name='id_tambahan$no_tambahan' >
																					<div class='checkbox clip-check check-primary checkbox-inline' style='line-height: 0px;'>
																						<input id='tambahan$no_tambahan' value='Y' name='checkbox_tambahan$no_tambahan'  type='checkbox' $pemesanan>
																						<label for='tambahan$no_tambahan'>
																							
																						</label>
																					</div>
																				
																				</td>
																				<td>$data[nama_aksesoris]</td>
																				<td><input type='text'  size='10px' value='$data[nomor_transaksi]' name='no_transaksi_tambahan$no_tambahan' ></td>
																				<td><input type='text' size='25px' value='$data[supplier]' name='supplier_tambahan$no_tambahan' ></td>
																				<td>".number_format($data['harga_jual'],0,",",".")."</td>
																				<td>$data[keterangan]</td>
																				
																			</tr>";
																		
																	}
																?>
																	</tbody>
																</table>
															</div>
														</fieldset>
													</div>
												</div>
													
													<div class="checkbox clip-check check-primary checkbox-inline" style="line-height: 10px;">
														<input id="status_pemesanan" value="1" name="status_pemesanan"  type="checkbox" <?php echo ($j['status_pemesanan'] == "P" ? "checked" : ""); ?> >
														<label for="status_pemesanan">
															Aksesoris Sudah Pesan Semua
														</label>
													</div>													
													<hr>
													<?php if(!count($_POST)) { ?>
														<button id="tombolsave" class="btn btn-primary btn-wide" type="submit">
															<i class="fa fa-save"></i> Save
														</button>
													<?php } ?>
													<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=<?php if(count($_POST)) { echo "history.go(-2)"; } else {echo "history.go(-1)";}?>>
														<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
													</button>
												
												</form>
											</div>
										</div>
										
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>