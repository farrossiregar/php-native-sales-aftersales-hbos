<?php

	$a = "select * from pengecekan_penampilan_sales_detail where no_pengecekan_mingguan = '$_GET[id]'";
	
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
	
	if(count($_POST)) {
	$tgl = date("Y-m-d H:i:s")	;	

		$app_time = date("Y-m-d H:i:s");
		
		if($_SESSION['leveluser']=='MNGR'){
			mysql_unbuffered_query("update pengecekan_penampilan_sales set sign_atasan2 = '$_POST[status_approved]', sign_atasan2_user = '$_SESSION[username]', sign_atasan2_time='$app_time' where no_pengecekan_mingguan = '$_GET[id]'");
		}elseif($_SESSION['leveluser']=='DRKSI'){
			mysql_unbuffered_query("update pengecekan_penampilan_sales set sign_atasan1 = '$_POST[status_approved]', sign_atasan1_user = '$_SESSION[username]', sign_atasan1_time='$app_time' where no_pengecekan_mingguan = '$_GET[id]'");
		}else{
			$keterangan_lainnya = mysql_query("select * from pengecekan_penampilan_sales_detail where no_pengecekan_mingguan = '$_GET[id]' and catatan_pengecekan = 'KETERANGAN LAINNYA' and keterangan_catatan_pengecekan = '' ");
			$cek_keterangan_lainnya = mysql_num_rows($keterangan_lainnya);
			if($cek_keterangan_lainnya < 1){
				mysql_unbuffered_query("update pengecekan_penampilan_sales set sign_atasan3 = '$_POST[status_approved]', sign_atasan3_user = '$_SESSION[username]', sign_atasan3_time='$app_time' where no_pengecekan_mingguan = '$_GET[id]'");
			}else{
				 
			}
		}
		
		
	
	if ($_POST[status_approved] =="1"){
	    $msg = "
					
		<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4><i class='icon fa fa-check'></i> Selamat!</h4>
		Dokumen sudah diproses.
		</div>
		
		";
	}else {
	    $msg = "
					
		<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4><i class='icon fa fa-check'></i> Selamat!</h4>
		Dokumen sudah diproses.
		</div>
		
		";
	}
		

	}	
	
	
	$pengecekan_detail = mysql_query("select * from pengecekan_penampilan_sales_detail where no_pengecekan_mingguan = '$_GET[id]'");
	$data_pengecekan_detail = mysql_fetch_array($pengecekan_detail);
	
	$pengecekan_detail_1 = mysql_query("select * from pengecekan_penampilan_sales where no_pengecekan_mingguan = '$_GET[id]'");
	$data_pengecekan_detail_1 = mysql_fetch_array($pengecekan_detail_1);
    
?>

<script>
				function lihat_keterangan($id){
					var no_id = $id;
					console.log(no_id);
					$.ajax({
						method : "post",
						url : "modul/checklist_penampilan_sales/lihat_keterangan.php",
						data : "data_ajax="+no_id,
						success : function(data){
							$('#Modal_keterangan_penampilan').modal('show');
							$('#myModal2Label').html("Keterangan Pengecekan");
							$('#table_keterangan').html(data);
						}
					})
				}
				
				function hover($id){
					var no_id = $id;
					var cls = $('#'+no_id).on('hover', function(){
						console.log(cls);
					});
				//	$(cls).removeClass('fa-2x');
				//	$(cls).addClass('fa-3x');
				/*	$(cls).removeClass('text-success');
					$(cls).removeClass('text-danger');
					$(cls).addClass('text-info');	*/
				}
				
				function mouseout($id){
					var no_id = $id;
					var cls = $('#'+no_id).on('hover', function(){
						console.log(cls);
					});
				//	$(cls).removeClass('fa-3x');
				//	$(cls).addClass('fa-2x');
				/*	$(cls).removeClass('text-info');
					$(cls).addClass('text-success');
					$(cls).addClass('text-danger');	*/
				}
</script>
				
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">
									<?php 
										if ($_GET[act] == 'approve'){echo "Approve Pengecekan Penampilan Sales";}
									//	elseif ($_GET[act] == 'ajukanapprove'){echo "Ajukan Pengajuan Discount";}


									?></h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Checklist</span>
									</li>
									<li class="active">
										<span>Checklist Showroom</span>
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
											
											<div class="modal fade" id="Modal_keterangan_penampilan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onpageshow="focus">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">
														<div class="modal-header" style="background-color: white;">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='exit_modal();'>
																<span aria-hidden="true">&times;</span>
															</button>
															<h4 class="modal-title" id="myModal2Label"></h4>
														</div>
														<div class="modal-body" style="background-color: white;">
															<div id = 'table_keterangan'>
															</div>
															<div class="row">											
																<div class="col-md-12">
																	<button type = "button" id="keluar" class="btn btn-wide btn-danger ladda-button close" data-dismiss="modal" aria-label="Close" data-style="expand-right"  onclick='exit_modal();'>
																		<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
																	</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											
											<div class="col-md-12">
												
											<div class="panel panel-white collapses" id="panel5">
													<a data-original-title="Tampilkan" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
													<div class="panel-heading">
														<h4 class="panel-title text-primary">Detail Checklist Showroom</h4>
														<div class="panel-tools">
															<a data-original-title="Tampilkan" data-toggle="tooltip" data-placement="top" class="btn btn-transparent btn-sm panel-collapse" href="#"><i class="ti-minus collapse-off"></i><i class="ti-plus collapse-on"></i></a>
														</div>
													</div>
													</a>
													<?php
														$pengecekan_showroom = mysql_query("select * from pengecekan_penampilan_sales where no_pengecekan_mingguan = '$data_pengecekan_detail[no_pengecekan_mingguan]'");
														$data_pengecekan_showroom = mysql_fetch_array($pengecekan_showroom);
													?>
													
													<div class="panel-body" style="display: none;">
														<div class="table-responsive">
															<table class="table table-bordered table-hover" id="sample-table-1">
																<tbody>
																	<tr class="info">
																		<?php
																			$detail_pengecekan = mysql_query("select tanggal from pengecekan_penampilan_sales_detail where no_pengecekan_mingguan = '$data_pengecekan_detail[no_pengecekan_mingguan]' group by tanggal");
																			$jumlah_tgl = mysql_num_rows($detail_pengecekan);
																			$jumlah_tgl2 = $jumlah_tgl + 2;
																		?>
																		<td colspan='<?php echo $jumlah_tgl2; ?>'>
																			No Pengecekan Mingguan : <?php echo $data_pengecekan_detail[no_pengecekan_mingguan] ?></br>
																			Nama PIC : <?php echo $data_pengecekan_showroom[nama_pic] ?><br>
																		</td>
																	</tr>
																	<?php
																		$bulan = date('m-Y');
																		$sql=mysql_query("select * from target_sales where kode_spv = 'sudi' and bulan = '$bulan'");
																		$no1 = 0;
																		$no2 = 0;
																		while($data_sql = mysql_fetch_assoc($sql)){
																	?>
																	
																	<tr class="warning">
																		<td><b><?php echo strtoupper($data_sql[kode_sales]) ?></b></td>
																		<td><b>Pukul</b></td>
																		<?php
																			$detail_pengecekan = mysql_query("select * from pengecekan_penampilan_sales_detail where kode_sales = '$data_sql[kode_sales]' and no_pengecekan_mingguan = '$data_pengecekan_detail[no_pengecekan_mingguan]' group by tanggal");
																			while($data_detail_pengecekan = mysql_fetch_array($detail_pengecekan)){
																		?>
																		<td><b><?php echo substr($data_detail_pengecekan[tanggal], 8, 2) ?></b></td>
																		<?php
																			}
																		?>
																	</tr>
																	<?php
																		$nama_pengecekan = mysql_query("select * from master_penilaian_sales");
																		while($data_nama_pengecekan = mysql_fetch_array($nama_pengecekan)){
																			
																			
																	?>
																	<tr class="info">
																	<?php
																		$detail_pengecekan = mysql_query("select * from pengecekan_penampilan_sales_detail where kode_sales = '$data_sql[kode_sales]' and jenis_penilaian = '$data_nama_pengecekan[jenis_penilaian]' and jam = '09:00' group by tanggal order by jenis_penilaian");
																			while($data_detail_pengecekan = mysql_fetch_array($detail_pengecekan)){
																	?>
																		<td><?php echo $data_detail_pengecekan[jenis_penilaian] ?></b></td>
																		<td><?php echo $data_detail_pengecekan[jam] ?></td>
																		<?php
																			$detail_pengecekan = mysql_query("select * from pengecekan_penampilan_sales_detail where kode_sales = '$data_sql[kode_sales]' and jenis_penilaian = '$data_nama_pengecekan[jenis_penilaian]' and no_pengecekan_mingguan = '$data_pengecekan_detail[no_pengecekan_mingguan]' and jam = '09:00' group by tanggal asc");
																			while($data_detail_pengecekan = mysql_fetch_array($detail_pengecekan)){
																		?>
																		<td>
																			<?php 
																				if ($data_detail_pengecekan[hasil_penilaian]  == "Y"){
																					echo "<i class='fa fa-check fa-2x text-success' style = 'cursor:pointer;' id='$data_detail_pengecekan[no]' onmouseover = 'hover($data_detail_pengecekan[no])' onmouseout = 'mouseout($data_detail_pengecekan[no])' onclick = 'lihat_keterangan($data_detail_pengecekan[no])'></i><br>";
																				
																				}else{
																					echo "<i class='fa fa-close fa-2x text-danger' style = 'cursor:pointer;' id='$data_detail_pengecekan[no]' onmouseover = 'hover($data_detail_pengecekan[no])' onmouseout = 'mouseout($data_detail_pengecekan[no])' onclick = 'lihat_keterangan($data_detail_pengecekan[no])'></i><br>";
																				
																				}
																			?>
																		</td>
																		<?php
																			}
																		}
																		?>
																	</tr>
																	
																	<tr class="info">
																	<?php
																		$detail_pengecekan = mysql_query("select * from pengecekan_penampilan_sales_detail where kode_sales = '$data_sql[kode_sales]' and jenis_penilaian = '$data_nama_pengecekan[jenis_penilaian]' and jam = '14:00' group by tanggal asc");
																			while($data_detail_pengecekan = mysql_fetch_array($detail_pengecekan)){
																	?>
																		<td><?php echo $data_detail_pengecekan[jenis_penilaian] ?></b></td>
																		<td><?php echo $data_detail_pengecekan[jam] ?></td>
																		<?php
																			$detail_pengecekan = mysql_query("select * from pengecekan_penampilan_sales_detail where kode_sales = '$data_sql[kode_sales]' and jenis_penilaian = '$data_nama_pengecekan[jenis_penilaian]' and no_pengecekan_mingguan = '$data_pengecekan_detail[no_pengecekan_mingguan]' and jam = '14:00' group by tanggal asc");
																			while($data_detail_pengecekan = mysql_fetch_array($detail_pengecekan)){
																		?>
																		<td>
																			<?php 
																				if ($data_detail_pengecekan[hasil_penilaian]  == "Y"){
																					echo "<i class='fa fa-check fa-2x text-success' style = 'cursor:pointer;' id='$data_detail_pengecekan[no]' onmouseover = 'hover($data_detail_pengecekan[no])' onmouseout = 'mouseout($data_detail_pengecekan[no])' onclick = 'lihat_keterangan($data_detail_pengecekan[no])'></i><br>";
																				
																				}else{
																					echo "<i class='fa fa-close fa-2x text-danger' style = 'cursor:pointer;' id='$data_detail_pengecekan[no]' onmouseover = 'hover($data_detail_pengecekan[no])' onmouseout = 'mouseout($data_detail_pengecekan[no])' onclick = 'lihat_keterangan($data_detail_pengecekan[no])'></i><br>";
																				
																				}
																			?>
																		</td>
																		<?php
																			}
																			}
																		?>
																	</tr>
																	<?php
																		}
																	?>
																	
																	<?php
																		}
																	?>
																</tbody>
															</table>
															
															<?php
																$detail_pengecekan = mysql_query("select * from pengecekan_penampilan_sales_detail where no_pengecekan_mingguan = '$data_pengecekan_detail[no_pengecekan_mingguan]' and hasil_penilaian = 'N'");
																$cek_detail_pengecekan = mysql_num_rows($detail_pengecekan);
																if($cek_detail_pengecekan > 0){
															?>
															<br><br><br>
															<table class="table table-bordered table-hover" id="sample-table-1">
																<tr class = 'info'>
																	<td colspan = '6'><b><?php echo strtoupper('DETAIL PENGECEKAN PENAMPILAN SALES') ?></b></td>
																	
																</tr>
																<tr class = 'warning'>
																	<th ><b><?php echo strtoupper('NO') ?></b></th>
																	<th ><b><?php echo strtoupper('KODE SALES') ?></b></th>
																	<th ><b><?php echo strtoupper('PENILAIAN') ?></b></th>
																	<th ><b><?php echo strtoupper('WAKTU') ?></b></th>
																	<th ><b><?php echo strtoupper('CATATAN PENGECEKAN') ?></b></th>
																	<th ><b><?php echo strtoupper('KETERANGAN CATATAN PENGECEKAN') ?></b></th>
																	
																</tr>
																<?php
																	$detail_pengecekan = mysql_query("select * from pengecekan_penampilan_sales_detail where no_pengecekan_mingguan = '$data_pengecekan_detail[no_pengecekan_mingguan]' and hasil_penilaian = 'N' group by tanggal, kode_sales, jam order by tanggal asc, jam asc");
																	$no = 0;
																	while($data_detail_pengecekan = mysql_fetch_array($detail_pengecekan)){
																		$no = $no+1;
																?>
																<tr class="info">
																	<td><?php echo $no ?></td>
																	<td>
																		<?php echo $data_detail_pengecekan['kode_sales'] ?>
																	</td>
																	<td>
																		<?php echo $data_detail_pengecekan['jenis_penilaian'] ?>
																	</td>
																	<td>
																		<?php echo $data_detail_pengecekan['tanggal'].' '.$data_detail_pengecekan['jam'] ?>
																	</td>
																	<td>
																		<?php echo $data_detail_pengecekan['catatan_pengecekan'] ?>
																	</td>
																	<td>
																		<?php echo $data_detail_pengecekan['keterangan_catatan_pengecekan'] ?>
																	</td>
																</tr>
																<?php
																	}
																?>
															</table>
															<?php
																}
															?>
															
															
													</div>
												</div>
											</div>
											
											
												<?php 
												if ($_GET[act] == 'approve'){ 
													if(($_SESSION['leveluser']=='supervisor' and $data_pengecekan_detail_1['sign_atasan3'] == '') or ($_SESSION['leveluser']=='MNGR' and $data_pengecekan_detail_1['sign_atasan3'] == 'Y') or ($_SESSION['leveluser']=='DRKSI' and $data_pengecekan_detail_1['sign_atasan1'] != 'Y' and $data_pengecekan_detail_1['sign_atasan2'] == 'Y') or $_SESSION['leveluser'] == 'admin' ){ 
												?>
												<div class="radio clip-radio radio-primary radio-inline">												
													<input type="radio" id="radio1" name="status_approved" value="1" <?php if($status_approved=='Y'){echo 'checked';}?> onclick="cekstatus();" >
													
													<label for="radio1">
														Setujui
													</label>
												</div>
												
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="status_approved" value="2" <?php if($status_approved=='N' and count($_POST)){echo 'checked';}?> onclick="cekstatus();" >
													<label for="radio2">
														Tidak Di Setujui
													</label>
												</div>
												<?php }}?>
												
											    <hr>
												<?php 
													if(!count($_POST)) {
														if(($_SESSION['leveluser']=='supervisor' and $data_pengecekan_detail_1['sign_atasan3'] == '') or ($_SESSION['leveluser']=='MNGR' and $data_pengecekan_detail_1['sign_atasan3'] == 'Y') or ($_SESSION['leveluser']=='DRKSI' and $data_pengecekan_detail_1['sign_atasan1'] != 'Y' and $data_pengecekan_detail_1['sign_atasan2'] == 'Y') or $_SESSION['leveluser'] == 'admin' ){ 
												?>
												<button id="tombolsave" class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
													<?php }} ?>
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