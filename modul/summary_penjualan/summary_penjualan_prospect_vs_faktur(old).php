<?php
session_start();
$level = $_SESSION['leveluser'];
										    
$cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 

");
$cek_akses2 = mysql_fetch_array($cek_akses);

										
if($cek_akses2['akses'] != 'Y'){

  
	include "modul/protected.php";

}else {
		switch($_GET[act]){
		//tampilkan data
		default:
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		//$bulan_sekarang = date("m-Y");
		//include "class_hitung_incentif.php"; 
?>
	
				

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-7">
									<h1 class="mainTitle">Summary</h1>
									<span class="mainDescription">Prospect VS Faktur <?php //$tgllalu = date('Y-m-d H:i:s', strtotime('-3 days')); echo $tgllalu; ?></span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
							
								<div class = "col-md-6">
									<?php $isi_lama = $_GET['bulan']; 
										
										
									?>
									<div class="form-group">
																					
										<form action = "<?php echo "$_SERVER[PHP_SELF]"; ?>" method = "GET">
											<input type = "hidden" name="module" value = "summary_penjualan_prospect_vs_faktur" />
											<div class="form-group">
												<label for="form-field-select-2">
													Pilih bulan & Tahun <span class="symbol required"></span>
												</label></br>													
												<select name = "bulan" >	
													<option value ="01" <?php echo ($_GET[bulan]=='02' ? "selected" : "") ?> > Januari </option>
													<option value ="02" <?php if ($_GET[bulan]=='02'){echo "selected"; }?> > Februari </option>
													<option value ="03" <?php if ($_GET[bulan]=='03'){echo "selected"; }?> > Maret </option>
													<option value ="04" <?php if ($_GET[bulan]=='04'){echo "selected"; }?> > April </option>
													<option value ="05" <?php if ($_GET[bulan]=='05'){echo "selected"; }?> > Mei </option>
													<option value ="06" <?php if ($_GET[bulan]=='06'){echo "selected"; }?> > Juni </option>
													<option value ="07" <?php if ($_GET[bulan]=='07'){echo "selected"; }?> > Juli </option>
													<option value ="08" <?php if ($_GET[bulan]=='08'){echo "selected"; }?> > Agustus </option>
													<option value ="09" <?php if ($_GET[bulan]=='09'){echo "selected"; }?> > September </option>
													<option value ="10" <?php if ($_GET[bulan]=='10'){echo "selected"; }?> > Oktober </option>
													<option value ="11" <?php if ($_GET[bulan]=='11'){echo "selected"; }?> > November </option>
													<option value ="12" <?php if ($_GET[bulan]=='12'){echo "selected"; }?> > Desember </option>
												
													
												
												</select>
												<select name = "tahun"  >
													<option value="2017"> 2017 </option>
												</select>
											</div>
											
											<!--label class="control-label">
												Pilih Bulan <span class="symbol required"></span>
											</label>
											<div class="input-group input-append datepicker date" data-date-format='mm-yyyy'>
												<input type="text" class="form-control" name = "bulan" id = "bulan" value = "<?php if(empty($isi_lama)){
													echo "";
												} else { echo "$isi_lama";} ?>"  />
												<span class="input-group-btn">
													<button type="button" class="btn btn-default">
														<i class="glyphicon glyphicon-calendar"></i>
													</button> </span>
											</div-->	
											<div class="progress-demo">
												<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" >
													<span class="ladda-label"><i class="fa fa-check"></i> Proses </span>
												</button>
											</div><br/>
											<label class="control-label">
											    <font color="red"><b>Note : </b></font>Sebelum Proses,Terlebih dahulu Pilih Bulan yang akan di tampilkan <span class="symbol required"></span>
									    	</label>
										</form>										
									</div>
								</div>		
								
								<!------------------ UNTUK SS PERFORMANCE ------------------------------------------------------------------------------------------------>
								<?php 
								
								$bulan = "$_GET[bulan]"."-"."$_GET[tahun]";
								$bulan2 = "$_GET[bulan]";
								$tahun2 = "$_GET[tahun]";
								
								if($bulan !="-") { $faktur = mysql_query("SELECT * FROM pengajuan_discount where month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2'  ");
												$tot_rec = mysql_num_rows($faktur);
												if ($tot_rec == '0') { echo "<div class='col-sm-12'> Tidak ada data pada periode Ini, silahkan pilih ulang </div>"; } else {
								?>
								
								<div class="col-sm-12">
									
														
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center;" >
																		<thead>
																			<tr style = "font-weight: bold;">
																			   										
																				<td align = "left">ITEM</td>	
																			    <?php 
																			        $query = mysql_query("select * from target_spv where bulan = '$bulan'");
																			        while ($data = mysql_fetch_array($query)){
																			            echo "<td><div style=color:$data[warna]>".substr($data[kode_spv],0,3)."</div></td>";
																			        }
																			    ?>
																														
																				<!--th>HENRI</th>
																				<th>WIND</th>
																				<th>ZAIN</th>
																				<th>IBNU</th>
																				<th>INDRA</th>
																				<th>COUNTER</th-->
																				<td>TOTAL</td>											
																			</tr>
																		</thead>
																		<tbody>
																			
																		   
																			<tr>																				
																				<td align = "left">
																					PROSPECT
																				
																				</td>
																				
																				<?php 
																					$query2 = mysql_query("select * from target_spv where bulan = '$bulan'");
																			        while ($data = mysql_fetch_array($query2)){
																						//echo "<td>a</td>";
																						$query3 = mysql_query("select count(no_pengajuan) as total_prospect from pengajuan_discount where kode_spv = '$data[kode_spv]' and month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																						$data3 = mysql_fetch_array($query3);
																						echo "<td style='font-size:17px;'>".$data3[total_prospect]."</td>";
																					}
																				?>
																				<td style='font-size:17px;'>
																					<?php
																					$query3 = mysql_query("select count(no_pengajuan) as total_prospect from pengajuan_discount where month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																						$data3 = mysql_fetch_array($query3);
																						echo $data3[total_prospect] ;
																					?>
																				
																				</td>																				
																			</tr>
																			<tr>																				
																				<td align = "left">
																					DISETUJUI
																				
																				</td>
																				
																				<?php 
																					$query6 = mysql_query("select * from target_spv where bulan = '$bulan'");
																			        while ($data2 = mysql_fetch_array($query6)){
																						//echo "<td>a</td>";
																						$query4 = mysql_query("select count(no_pengajuan) as total_disetujui from pengajuan_discount where status_approved = 'Y' and kode_spv = '$data2[kode_spv]' and month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																						$data4 = mysql_fetch_array($query4);
																						echo "<td style='font-size:17px;'>".$data4[total_disetujui]."</td>";
																					}
																				?>
																				<td style="font-size:17px;">
																					<?php 
																					$query4 = mysql_query("select count(no_pengajuan) as total_disetujui from pengajuan_discount where status_approved = 'Y' and month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																					$data4 = mysql_fetch_array($query4);
																					
																					echo $data4[total_disetujui];
																					
																					?>
																				
																				</td>																			
																			</tr>
																			<tr>																				
																				<td align = "left">
																					SPK
																				
																				</td>
																				
																				<?php 
																					$query6 = mysql_query("select * from target_spv where bulan = '$bulan'");
																			        while ($data2 = mysql_fetch_array($query6)){
																						//echo "<td>a</td>";
																						$query4 = mysql_query("select count(no_pengajuan) as total_disetujui from pengajuan_discount where no_spk !='' and status_approved = 'Y' and kode_spv = '$data2[kode_spv]' and month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																						$data4 = mysql_fetch_array($query4);
																						echo "<td style='font-size:17px;'>".$data4[total_disetujui]."</td>";
																					}
																				?>
																				<td style="font-size:17px;">
																					<?php 
																					$query4 = mysql_query("select count(no_pengajuan) as total_disetujui from pengajuan_discount where no_spk !='' and status_approved = 'Y' and month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																					$data4 = mysql_fetch_array($query4);
																					
																					echo $data4[total_disetujui];
																					
																					?>
																				
																				</td>																			
																			</tr>
																			<tr>																				
																				<td align = "left">
																					FAKTUR BLN LALU
																				
																				</td>
																				
																				<?php 
																					$query6 = mysql_query("select * from target_spv where bulan = '$bulan'");
																			        while ($data2 = mysql_fetch_array($query6)){
																						//echo "<td>a</td>";
																						$query4 = mysql_query("select count(nama_sales) as total_disetujui from summary_faktur where kode_spv = '$data2[kode_spv]' and bulan = '$bulan' and month(tgl_spk) < $bulan2 ");
																						$data4 = mysql_fetch_array($query4);
																						echo "<td style='font-size:17px;'>".$data4[total_disetujui]."</td>";
																					}
																				?>
																				<td style="font-size:17px;">
																					<?php 
																					$query4 = mysql_query("select count(nama_sales) as total_disetujui from summary_faktur where bulan = '$bulan' and month(tgl_spk) < $bulan2 ");
																					$data4 = mysql_fetch_array($query4);
																					
																					echo $data4[total_disetujui];
																					
																					?>
																				
																				</td>																			
																			</tr>
																			<tr>																				
																				<td align = "left">
																					FAKTUR BLN INI
																				
																				</td>
																				
																				<?php 
																					$query6 = mysql_query("select * from target_spv where bulan = '$bulan'");
																			        while ($data2 = mysql_fetch_array($query6)){
																						//echo "<td>a</td>";
																						$query4 = mysql_query("select count(nama_sales) as total_disetujui from summary_faktur where kode_spv = '$data2[kode_spv]' and bulan = '$bulan' and month(tgl_spk) = $bulan2 ");
																						$data4 = mysql_fetch_array($query4);
																						echo "<td style='font-size:17px;'>".$data4[total_disetujui]."</td>";
																					}
																				?>
																				<td style="font-size:17px;">
																					<?php 
																					$query4 = mysql_query("select count(nama_sales) as total_disetujui from summary_faktur where bulan = '$bulan' and month(tgl_spk) = $bulan2 ");
																					$data4 = mysql_fetch_array($query4);
																					
																					echo $data4[total_disetujui];
																					
																					?>
																				
																				</td>																			
																			</tr>
																			<tr>																				
																				<td align = "left">
																					RASIO
																				
																				</td>
																				
																				<?php 
																					$query6 = mysql_query("select * from target_spv where bulan = '$bulan'");
																			        while ($data2 = mysql_fetch_array($query6)){
																						//echo "<td>a</td>";
																						$query4 = mysql_query("select count(nama_sales) as total_faktur from summary_faktur where kode_spv = '$data2[kode_spv]' and bulan = '$bulan' and month(tgl_spk) = $bulan2 ");
																						$data4 = mysql_fetch_array($query4);
																						
																						$query3 = mysql_query("select count(no_pengajuan) as total_prospect from pengajuan_discount where kode_spv = '$data2[kode_spv]' and month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																						$data3 = mysql_fetch_array($query3);
																						
																						$ratio = round($data4[total_faktur]/$data3[total_prospect],2)*100;
																						
																						if ($ratio >= 100){
																							echo "<td style='font-size:17px;'><span class='label label-success'>".$ratio."%</span></td>";
																							
																						}elseif( $ratio > 65 and $ratio <100){
																							echo "<td style='font-size:17px;'><span class='label label-warning'>".$ratio."%</span></td>";
																							
																						}else {
																							echo "<td style='font-size:17px;'><span class='label label-danger'>".$ratio."%</span></td>";
																						}
																							
																						
																						//
																					}
																				
																				
																					$query4 = mysql_query("select count(nama_sales) as total_faktur from summary_faktur where bulan = '$bulan' and month(tgl_spk) = $bulan2 ");
																						$data4 = mysql_fetch_array($query4);
																						
																						$query3 = mysql_query("select count(no_pengajuan) as total_prospect from pengajuan_discount where month(tgl_pengajuan_ulang) = '$bulan2' and year(tgl_pengajuan_ulang) = '$tahun2' ");
																						$data3 = mysql_fetch_array($query3);
																						
																						$ratio = round($data4[total_faktur]/$data3[total_prospect],2)*100;
																					
																					if ($ratio >= 100){
																							echo "<td style='font-size:17px;'><span class='label label-success'>".$ratio."%</span></td>";
																							
																						}elseif( $ratio > 65 and $ratio <100){
																							echo "<td style='font-size:17px;'><span class='label label-warning'>".$ratio."%</span></td>";
																							
																						}else {
																							echo "<td style='font-size:17px;'><span class='label label-danger'>".$ratio."%</span></td>";
																						}
																					
																					?>
																				
																																						
																			</tr>
																		</tbody>
																	</table>
																</div>	
												
								</div>
								
								<?php }} ?>
								
								
								
								
								
							</div>
						</div>
						<!-- end: DYNAMIC TABLE -->
					</div>
				</div>
			
	<?php 
		break;
		case "tambah":
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$tanggal = date('Y-m-d',strtotime($_POST[tanggal]));
		$tanggal_post = $_POST[tanggal];
		$bulan_post = date('m-Y',strtotime($_POST[tanggal]));
        $tgl_input = date('Y-m-d H:i:s');
		if(count($_POST)) {
			mysql_unbuffered_query("insert into acchv (tanggal,bulan,id_item,total,package_point,nm_sa,tgl_input) values('$tanggal','$bulan_post','$_POST[id_item]','$_POST[total]','$_POST[package_point]','$_SESSION[username]','$tgl_input')");
			
				$msg = "							
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Data telah berhasil disimpan</div>";
								
		}
	?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Acchievement</h1>
									<span class="mainDescription">Input data baru</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Transaksi</span>
									</li>									
									<li class="active">
										<span>Acchievement</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" id="item_control" enctype="multipart/form-data" method="post" action="">
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
														Tanggal <span class="symbol required"></span>
													</label>											
													
													<p class="input-group input-append datepicker date">
														<input type="text" class="form-control" name = "tanggal" id = "tanggal" required  />
														<span class="input-group-btn">
															<button type="button" class="btn btn-default">
																<i class="glyphicon glyphicon-calendar"></i>
															</button> </span>
													</p>
												</div>	
												<div class="form-group">
													<label for="form-field-select-2">
														Kategori <span class="symbol required"></span>
													</label>													
													<select name = "id_kategori" id="id_kategori" class = "form-control" required >														
														<option value="" selected>PILIH KATEGORI</option>
														<?php 
														if ($_SESSION[leveluser] == 'SA_GR'){
															$tampil=mysql_query("SELECT * FROM kategori where aktif = 'Y' and klasifikasi = 'GR'");
														}elseif ($_SESSION[leveluser] == 'SA_BP') {
															$tampil=mysql_query("SELECT * FROM kategori where aktif = 'Y' and klasifikasi = 'BP'");
														}else {
															$tampil=mysql_query("SELECT * FROM kategori where aktif = 'Y'");
														}
														
														while ($w = mysql_fetch_array($tampil)){															
															echo "<option value = '$w[id_kategori]'>$w[nm_kategori]</option>";															
														}
														?>
													</select>
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Item <span class="symbol required"></span>
													</label>													
													<select name = "id_item" id = "id_item" class = "form-control" required >	
														<option value = "">PILIH ITEM</option>
													</select>
												</div>
												<div id = "package" class="form-group">
													<label for="form-field-select-2">
														Type Mobil <span class="symbol required"></span>
													</label>													
													<select name = "package_point" class = "form-control" >	
														<option value = "" selected>PILIH TYPE</option>
														<?php 
															$data = mysql_query("select * from pmpackage where aktif = 'Y'");
															while ($r = mysql_fetch_array($data)){
																echo "<option value = '$r[point]'>$r[type_mobil] - $r[periode] ($r[kategori])</option>";
															}
														?>
													</select>
												</div>
												
												<div class="form-group">
													<label class="control-label">
														Total <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" type="number" value = "<?php echo $r[nm_kategori]?>" onblur="this.value=this.value.toUpperCase()" placeholder="Total" class="form-control" id="total" name="total" required>
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
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_bodyrepair';>
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

<?php	
	break;
	case "edituser":
	$a = "select * from asuransi where id_asuransi='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
				
	if(count($_POST)) {
		mysql_unbuffered_query("update asuransi set nm_asuransi = '$_POST[nm_asuransi]',aktif = '$_POST[aktif]' where id_asuransi = '$_GET[id]'");
		$msg = "							
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Data telah berhasil dirubah</div>";
	}
?>

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Edit Data Asuransi</h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li>
										<span>Tabel Asuransi</span>
									</li>
									<li class="active">
										<span>Edit Data</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" id="frm_kategori" enctype="multipart/form-data" method="post" action="">
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
														Nama Item <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" type="text" value = "<?php echo $r[nm_asuransi]?>" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Asuransi" class="form-control" id="nm_asuransi" name="nm_asuransi" required>
												</div>												
												<?php if ($r[aktif] == 'Y'){?>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio1" name="aktif" value="Y" checked = "checked">
													<label for="radio1">
														Yes
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="aktif" value="N">
													<label for="radio2">
														No
													</label>
												</div>
												<?php } else { ?>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio1" name="aktif" value="Y">
													<label for="radio1">
														Yes
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="aktif" value="N" checked="checked">
													<label for="radio2">
														No
													</label>
												</div>
												<?php } ?>
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
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_master_list_asuransi';>
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
<?php break;
}
}
 ?>