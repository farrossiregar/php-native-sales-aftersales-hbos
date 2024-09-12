<?php

	$a = "select * from unit_keluar where no_spk = '$_GET[id]'";
	
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
	
	if(count($_POST)) {
	$tgl = date("Y-m-d H:i:s")	;	

		$app_time = date("Y-m-d H:i:s");
		
		if($_SESSION['leveluser']=='supervisor'){
			mysql_unbuffered_query("update unit_keluar set spv_app = '$_POST[status_approved]', spv_user_app = '$_SESSION[namalengkap]', spv_app_time='$app_time' where no_spk = '$_GET[id]'");
		}elseif($_SESSION['leveluser']=='ar_finance'){
			if($r['spv_app']=='Y'){
				mysql_unbuffered_query("update unit_keluar set arfinance_app = '$_POST[status_approved]', arfinance_user_app = '$_SESSION[namalengkap]', arfinance_app_time='$app_time' where no_spk = '$_GET[id]'");
			}else{
			}
			
		}elseif($_SESSION['leveluser']=='spv_finance'){
			if($r['arfinance_app']=='Y'){
				mysql_unbuffered_query("update unit_keluar set spv_finance_app = '$_POST[status_approved]', spv_finance_user_app = '$_SESSION[namalengkap]', spv_finance_app_time='$app_time' where no_spk = '$_GET[id]'");
			}else{
			}
			
		}elseif($_SESSION['leveluser']=='mngr_finance'){
			if($r['spv_finance_app']=='Y'){
				mysql_unbuffered_query("update unit_keluar set mngr_finance_app = '$_POST[status_approved]', mngr_finance_user_app = '$_SESSION[namalengkap]', mngr_finance_app_time='$app_time' where no_spk = '$_GET[id]'");
			}else{
			}
			
		}else{
		}
	
	if ($_POST[status_approved] =="1"){
	    $msg = "
					
		<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4><i class='icon fa fa-check'></i> Selamat!</h4>
		Dokumen sudah diproses.
		</div>
		
		";
	}					
	
	else {
	    $msg = "
					
		<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4><i class='icon fa fa-check'></i> Selamat!</h4>
		Dokumen sudah diproses.
		</div>
		
		";
	}
		

	}	
	
	
	$a = mysql_query("select * from unit_keluar where no_spk = '$_GET[id]'");
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
										if ($_GET[act] == 'approvepermohonan'){echo "Setujui Permohonan Unit Keluar";}
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
												
											<div class="panel panel-white collapses" id="panel5">
													<a data-original-title="Tampilkan" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
													<div class="panel-heading">
														<h4 class="panel-title text-primary">Detail Permohonan Unit Keluar</h4>
														<div class="panel-tools">
															<a data-original-title="Tampilkan" data-toggle="tooltip" data-placement="top" class="btn btn-transparent btn-sm panel-collapse" href="#"><i class="ti-minus collapse-off"></i><i class="ti-plus collapse-on"></i></a>
														</div>
													</div>
													</a>
													<?php
														$qry1 = mysql_query("select * from matching_local where no_spk_local='$j[no_spk]'");
														$sql1 = mysql_fetch_array($qry1);
													?>
													<?php
														$qry2 = mysql_query("select * from data_mobil where norangka='$sql1[norangka_local]'");
														$sql2 = mysql_fetch_array($qry2);
													?>
													<?php
													//	$qry3 = mysql_query("select * from pengajuan_discount where no_spk='$j[no_spk]'");
														$qry3 = mysql_query("SELECT pd.tipe_mobil as tipe_mobil, t.nama_tipe as nama_tipe, pd.*, t.* FROM pengajuan_discount pd, tipe t where no_spk='$j[no_spk]' and t.kode_tipe = pd.tipe_mobil");
														$sql3 = mysql_fetch_array($qry3);
													?>
													<?php
														$qry4 = mysql_query("select * from status_spk where no_spk='$sql3[no_spk]'");
														$sql4 = mysql_fetch_array($qry4);
													?>
													
													<div class="panel-body" style="display: none;">
														<div class="table-responsive">
															<table class="table table-bordered table-hover" id="sample-table-1">
																<tbody>
																	<tr class="warning">
																		<td>No SPK</td>
																		<td><?php echo $j[no_spk] ?></td>
																	</tr>
																	<tr class="info">
																		<td>Pemohon</td>
																		<td><?php echo $j[nama_sales]." / ".$j[input] ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Nama Customer</td>
																		<td><?php echo $sql3[nama_customer] ?></td>
																	</tr>
																	<tr class="info">
																		<td>Tipe</td>
																		<td><?php echo $sql3[tipe_mobil].' / '.$sql3[nama_tipe] ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Warna</td>
																		<td><?php echo $sql3[warna] ?></td>
																	</tr>
																	<tr class="info">
																		<td>No Rangka</td>
																		<td><?php echo $sql2[norangka] ?></td>
																	</tr>
																	<tr class="warning">
																		<td>No Mesin</td>
																		<td><?php echo $sql2[nomesin] ?></td>
																	</tr>
																	<tr class="info">
																		<td>Waktu Keluar</td>
																		<td><?php echo $j[waktu_keluar] ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Cara Pembayaran</td>
																		<td><?php echo $sql3[cara_beli] ?></td>
																	</tr>
																	<tr class="info">
																		<td>Leasing</td>
																		<td><?php echo $sql3[leasing] ?></td>
																	</tr>
																	<tr class="warning">
																		<td>Tenor</td>
																		<td><?php echo $sql3[tenor] ?></td>
																	</tr>
																	<?php
																		$qry5total = mysql_query("select sum(nilaipenerimaan) as dp1 from kwitansi_pesanan_kendaraan where noreferensi='$sql3[no_spk]'");
																		$sql5total = mysql_fetch_array($qry5total);
																		$total_dp1 = $sql5total['dp1'];
																		
																		$qry5 = mysql_query("select * from kwitansi_pesanan_kendaraan where noreferensi='$sql3[no_spk]'");
																		while($sql5 = mysql_fetch_array($qry5)){
																	?>
																	<tr class="info">
																		<td>DP</td>
																		<td><?php echo number_format("$sql5[nilaipenerimaan]",0,".",".") ?></td>
																	</tr>
																	<?php
																		}
																	?>
																	
																	<?php
																		$qry6total = mysql_query("select sum(nilaipenerimaan) as dp2 from kwitansi_pesanan_kendaraan where noreferensi='$sql4[no_penjualan]'");
																		$sql6total = mysql_fetch_array($qry6total);
																		$total_dp2 = $sql6total['dp2'];
																		
																	
																		$qry6 = mysql_query("select * from kwitansi_pesanan_kendaraan where noreferensi='$sql4[no_penjualan]'");
																		while($sql6 = mysql_fetch_array($qry6)){
																	?>
																	<tr class="warning">
																		<td>DP</td>
																		<td><?php echo number_format("$sql6[nilaipenerimaan]",0,".",".") ?></td>
																	</tr>
																	<?php
																		}
																	?>
																	
																	<?php
																		if($tot!='0'){	
																			$tot = $total_dp1 + $total_dp2;
																	?>
																	<tr class="info">
																		<td>TOTAL</td>
																		<td><?php echo number_format("$tot",0,".",".") ?></td>
																	</tr>
																	<?php
																		}
																	?>
																	
																	<tr class="warning">
																		<td>Discount</td>
																		<td><?php echo number_format("$sql3[pengajuan_disc]",".",".") ?></td>
																	</tr>
																	<tr class="info">
																		<td>Keterangan</td>
																		<td><?php echo $j[nama_customer] ?></td>
																	</tr>
																	
																</tbody>
															</table>
													</div>
												</div>
											</div>
											
											
												<?php 
												if ($_GET[act] == 'approvepermohonan'){ 
												?>
												<div class="radio clip-radio radio-primary radio-inline">												
													<input type="radio" id="radio1" name="status_approved" value="1" <?php if($status_approved=='Y'){echo 'checked';}?> onclick="cekstatus();" >
													
													<label for="radio1">
														Setujui
													</label>
												</div>
												<?php }?>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="status_approved" value="2" <?php if($status_approved=='N' and count($_POST)){echo 'checked';}?> onclick="cekstatus();" >
													<label for="radio2">
														Tidak Di Setujui
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
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>