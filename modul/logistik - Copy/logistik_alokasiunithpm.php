<?php
session_start();
$level = $_SESSION['leveluser'];
										    
$cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 

");
$cek_akses2 = mysql_fetch_array($cek_akses);

										
if($cek_akses2['akses'] != 'Y'){

  
	include "modul/protected.php";

}else{
		//include "config/fungsi_thumb.php";
		include "config/koneksi_sqlserver.php";
		
		switch($_GET[act]){
		//tampilkan data
		default:
?>	

               <script language="JavaScript">
					function warning() {
						return confirm('Anda yakin menghapus data ini?');
					}
					function tampil(){
						document.getElementById("tampil_data").click();
					}
					
					
					function show_filter() {
						var x = document.getElementById("filter");
						if (x.style.display === "none") {
							x.style.display = "block";
						} else {
							x.style.display = "none";
						}
					}
					
					function ajax_tampil_tipe(){
						var pilihan = "tipe";
						var model = $('#model_').val();
						
						var bulan = $('#bulan_').val();
						$.ajax({
							method : "post",
							url : "modul/logistik/action/logistik_alokasiunithpmajax.php",
							data : {id_ajax : model , bulan_ajax : bulan, pilihan_ajax : pilihan},
							success : function(data){
								$('#tipe_').html(data);
								
							}
							
						})
						
						
					}
					function ajax_tampil_warna(){
						var pilihan = "warna";
						var model = $('#model_').val();
						
						var tipe = $('#tipe_').val();
						var bulan = $('#bulan_').val();
						$.ajax({
							method : "post",
							url : "modul/logistik/action/logistik_alokasiunithpmajax.php",
							data : {id_ajax : tipe , bulan_ajax : bulan, pilihan_ajax : pilihan},
							success : function(data){
								$('#warna_').html(data);
								console.log(tipe);
							}
							
						})
						
						
					}
				</script>
				
				
				
				
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-7">
									<h1 class="mainTitle">Summary</h1>
									<span class="mainDescription">Alokasi Unit HPM</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-3">
									<!--h5 class="over-title margin-bottom-15">Keseluruhan <span class="text-bold">Data Sales</span></h5-->
									
										<?php
										    $level = $_SESSION['leveluser'];
										    
										    $cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
										    left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 
										    
										    ");
										    $cek_akses2 = mysql_fetch_array($cek_akses);
										    
										
										    if($cek_akses2['tambah_data'] == 'Y')
										    {
										
										?>
										
										<p class="progress-demo">
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=logistik_alokasiunithpm&act=buat';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Buat Alokasi Unit HPM</span>
											</button>	
										</p>
										<hr>
										<?php
		                                }
										?>
									
								</div>
							</div>
							
							<form role="form" id="form" enctype="multipart/form-data" method="get" action="<?php echo $_SERVER[PHP_SELF] ?>" >
								
								<div class="row">
									<div class="col-md-3">								
										<div class="form-group">
										
											<input type = "hidden" name = "module" value = "logistik_alokasiunithpm" />		
											
											<label class="control-label">
											Pilih Bulan Alokasi <span class="symbol required"></span>
											</label>
												<p style = "padding:0px;" class="input-group input-append datepicker date" data-date-format='mm-yyyy'>
													<input class="form-control"  type="text" id="bulan_" name="bulan" required value = "<?php echo $_GET['bulan']?>" >
													<span class="input-group-btn">
														<button type="button" class="btn btn-default">
															<i class="glyphicon glyphicon-calendar"></i>
														</button>
													</span>
												</p>										
										</div>
									</div>
								</div>
								<div class="panel-group accordion" id="accordion">
									<div class="panel panel-white">
											
										<div class="panel-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
												<h5 class="panel-title">
												   <b style=color:#007aff>KLIK DISINI UNTUK FILTER</b>
												 </h5>
											</a>
										</div>
											
										<div id="collapseOne" class="panel-collapse collapse">
											<div class="panel-body">
													
													
											
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
															<label for="form-field-select-2">
																Pilih Model <span class="symbol required"></span>
															</label>													
															<select name = "model" id="model_" class = "form-control" onchange="ajax_tampil_tipe();" >														
																<option value="semua_model" selected>SEMUA MODEL</option>
																<?php $data = mysql_query("select * from model ");
																	
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
															<select name = "tipe" id = "tipe_" class = "form-control" onchange="ajax_tampil_warna();" >	
																<option value = "semua_tipe">SEMUA TIPE</option>
															</select>
														</div>
														<div class="form-group">
															<label for="form-field-select-2">
																Pilih Warna <span class="symbol required"></span>
															</label>													
															<select name = "warna" id="warna_" class = "form-control" >														
																<option value="semua_warna">SEMUA WARNA</option>
																<?php 
																	/*
																	$data = mysql_query("select * from warna where status = 1");
																	while ($r=mysql_fetch_array($data))
																	{
																		echo "<option value=$r[kode_warna]> $r[nama_warna] </option>";
																	}
																	*/
																?>
															</select>
														</div>
														
													</div>											
												</div>
												
												
											</div>
										</div>
									</div>
								</div>
							
							
								
								<div class='row'>
									<div class="col-md-3"><br/>
										<div class="form-group">
										<button type="submit" id="tampil_data"  class="btn btn-white btn-info btn-bold">Tampilkan Data</button>									
																				
										</div>
									</div>
								</div>
							
							</form>
							
							<div class="row">
								<div class="col-md-12">
								<?php
								
									if($_GET['bulan'] != ''){
										
										$alokasi = "select a.*,w.nama_warna,t.nama_tipe from alokasi_unit_hpm a
										left join tipe T on t.kode_tipe = a.kode_tipe
										left join warna w on w.kode_warna = a.kode_warna
										where a.bulan_alokasi = '$_GET[bulan]'
										
										";
										if($_GET['model']=='semua_model'){
											$tampil = mysql_query("$alokasi ORDER BY a.kode_model, a.kode_tipe ");
										}
										
										elseif ($_GET['tipe']=='semua_tipe'){
											if ($_GET['warna']=='semua_warna'){                  
												$filter= "and a.kode_model='$_GET[model]'";
												$tampil = mysql_query("$alokasi $filter ORDER BY a.kode_model, a.kode_tipe ");
											}
											else{                  
												$filter = "and a.kode_model='$_GET[model]' and a.kode_warna='$_GET[warna]'";
												$tampil = mysql_query("$alokasi $filter ORDER BY a.kode_model, a.kode_tipe");
											}
										}
										else{
											  if ($_GET['warna']=='semua_warna'){                
												$filter = "and a.kode_model='$_GET[model]' and a.kode_tipe='$_GET[tipe]'";
												$tampil = mysql_query("$alokasi $filter ORDER BY a.kode_model, a.kode_tipe");
											  }
											  else{                
												$filter = "and a.kode_model='$_GET[model]' and a.kode_tipe='$_GET[tipe]' and
												a.kode_warna='$_GET[warna]'";
												$tampil = mysql_query("$alokasi $filter ORDER BY a.kode_model, a.kode_tipe ");
											  }  
											  
										}
												
										
										
								?>
							
									<div class="table-header"><i><b>Pencarian Data Alokasi Unit HPM <?php echo $_GET[bulan] ?></b></i></div><br />
						
                        <table class="table table-striped table-bordered table-hover table-full-width dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                    		<thead>
                    			<tr>
									<th align="center">No.</th>									
									<th>Keterangan</th>
									
								</tr>
                    		</thead>
                            <tbody>
											
							<?php
								$no = 0;
								$total_alokasi = 0;
								$unit_datang = 0;
								$sisa_alokasi = 0;
								while($dt = mysql_fetch_array($tampil)){
									
									
									$query_data_kendaraan = "
									select count(dk.kode_tipe) as total from UntT_Pembelian P
									left join UntT_DataKendaraan DK on dk.norangka = p.norangka
									where format(tanggal,'MM-yyyy') = '$_GET[bulan]' and dk.kode_tipe = '$dt[kode_tipe]' and dk.kode_warna = '$dt[kode_warna]' and p.kode_asal = '0000000127' and p.batal = '0'
									
									
									";

									$data_kendaraan = sqlsrv_query($conn, $query_data_kendaraan);
									
									while($data = sqlsrv_fetch_array($data_kendaraan)){
										 $total = $data['total'];
									}
									
									
								$no++;
								?>
							
								<tr>
									<td align = "center"><?php echo $no;?></td>
									
									<td>
										<?php echo trim($dt['kode_tipe'], " ")." (".trim($dt['nama_tipe'], " ").") / ".strtoupper(trim($dt['nama_warna'], " ")) ?>
										
										<br>
										Jumlah Alokasi : <?php echo $dt['jumlah_unit'] ?><br>
										Unit Datang : <?php echo $total ?><br>
										Sisa unit : <?php echo $dt['jumlah_unit'] - $total ?><br>
										Unit Booking : <?php echo $dt['jumlah_booking']?><br>
										<?php 
										$kode_tipe = trim($dt['kode_tipe'], " ");
										if($_SESSION['leveluser'] != 'supervisor'){ echo "<a class='btn btn-xs btn-primary' href='media_showroom.php?module=logistik_alokasiunithpm&act=booking_alokasi&kode_tipe=$kode_tipe&kode_warna=$dt[kode_warna]&jumlah_booking=$dt[jumlah_booking]'
										data-placement='top' data-toggle='tooltip' data-original-title='Booking Alokasi $r[norangka]'><i class='fa fa-car'></i> Booking Alokasi</a>"; 
										
										}?>
									</td>
									
									
								</tr>
								
							<?php
								$total_alokasi = $total_alokasi + $dt['jumlah_unit'];
								$unit_datang = $unit_datang + $total ;
								$sisa_alokasi = $sisa_alokasi + ($dt['jumlah_unit'] - $total);
								$total_alokasi_booking = $total_alokasi_booking + $dt['jumlah_booking'];
								}
							?>
											
							</tbody>
                        </table>
						
						<!--a href='modul/ekspor?tgl_awal=.php'-->
						<!--a href='modul/ekspor.php?$dt['tgl_awal']'-->
						</br>
						
						Total Alokasi : <?php echo $total_alokasi; ?> , Total Datang : <?php echo $unit_datang; ?> , Total Sisa Alokasi : <?php echo $sisa_alokasi; ?> , Total Alokasi di booking : <?php echo $total_alokasi_booking; ?>
						
								</div> 
							</div>
						</div>
					</div>
				</div>


<?php
}else{
	unset($_POST['cari']);

?>
                        </div>
                     </div>
                </div>
            </div>
        </div>
<?php
}
?>
<?php 
	break;
	case "buat":
	
					
					date_default_timezone_set('Asia/Jakarta');
					if(count($_POST)) {
						$bulan = $_POST['bulan'];
						$model = $_POST['model'];
						$tipe_mobil = $_POST['tipe_mobil'];
						$warna = $_POST['warna'];
						$jumlah_unit = $_POST['jumlah_unit'];
						$tgl_beli = $_POST['tgl_beli'];
						$input = date("Y-m-d H:i:s");
					
						$cek=mysql_query("select * from alokasi_unit_hpm where kode_tipe = '$tipe_mobil' and kode_warna = '$warna' and bulan_alokasi = '$bulan'");
						
						$jml_rec = mysql_num_rows($cek);
						
						if ($jml_rec < 1){	
						mysql_unbuffered_query("insert into alokasi_unit_hpm (kode_model, kode_tipe, kode_warna, bulan_alokasi, jumlah_unit) 
						values('$model', '$tipe_mobil', '$warna','$bulan','$jumlah_unit')");
						
						$msg = "
						<div class='alert alert-success alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Selamat!</h4>
						Berhasil Menambah Data.</div>";
								
						}
						
						else {
						$msg = "							
						<div class='alert alert-warning alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-warning'></i> Gagal!</h4>
						Data Sudah Ada.</div>";
						}	
					}
				?>
				
				
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Input Alokasi Unit HPM</h1>
									<span class="mainDescription">Tambah Data Alokasi Unit HPM pada Database</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Transaksi Showroom</span>
									</li>
									<li class="active">
										<span>Input Alokasi Unit HPM</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						
						
						
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" id="form" enctype="multipart/form-data" method="post" action="">
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
													
													
													<div class="from-group">
														<label class="control-label">
														Periode <span class="symbol required"></span>
														</label>
															<p class="input-group input-append datepicker date" data-date-format='mm-yyyy'>
																<input class="form-control" type="text" id="bulan" name="bulan" required >
																<span class="input-group-btn">
																	<button type="button" class="btn btn-default">
																		<i class="glyphicon glyphicon-calendar"></i>
																	</button>
																</span>
															</p>
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
															<select name="tipe_mobil" id = "tipe_mobil" class = "form-control" required >	
																<option value="" selected disabled >PILIH TIPE</option>
															</select>
													</div>
													<div class="form-group">
														<label for="form-field-select-2">
															Pilih Warna <?php  //$tgl =date('Y-m-d'); if($tgl > '2017-12-01'){echo "wawaw";}?> <span class="symbol required"></span>
														</label>													
														<select name="warna" id="warna" class = "form-control" >														
															<option value="" selected disabled>PILIH WARNA</option>
															<?php $data = mysql_query("select * from warna");
																while ($r=mysql_fetch_array($data))
																{
																	echo "<option value=$r[kode_warna]> $r[nama_warna] </option>";
																}
																
															?>
														</select>
													</div>
													
													<div class="form-group">
														<label class="control-label">
															Jumlah unit <span class="symbol required"></span>
														</label>
														<input class="form-control" type="text" value="" placeholder="Jumlah Unit" name="jumlah_unit" onkeypress="return hanyaAngka(event)">
													</div>
													
													
													
												</div>
												<p id="txtHint"></p>
											</div>
										</div>
									</br>
										<div class="row">											
											<div class="col-md-4">
												
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Simpan
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick="window.location.href='?module=logistik_alokasiunithpm';">
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

		

<?php 
		break;
		case "booking_alokasi":
		$tgl = date('Y-m-d H:i:s');
		
			if(count($_POST)) {
			
			$data = mysql_query("select * from alokasi_unit_hpm where kode_tipe = '$_GET[kode_tipe]' and kode_warna = '$_GET[kode_warna]'");
			$hasil_data = mysql_fetch_array($data);
			$jml_data = mysql_num_rows($data);
			
			if ($jml_data > 0){
				mysql_unbuffered_query("update alokasi_unit_hpm set jumlah_booking = '$_POST[jumlah_booking]' where kode_tipe = '$_GET[kode_tipe]' and kode_warna = '$_GET[kode_warna]'");
				$msg = "
							
				<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-check'></i> Selamat!</h4>
				Berhasil mengubah data
				</div>
				
				";	
			}
			else {
								
				$msg = "
							
				<div class='alert alert-warning alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-check'></i> Gagal!</h4>
				Gagal mengubah data.
				</div>
				
				";	
				
			}	
		}
		
	?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Alokasi unit HPM</h1>
									<span class="mainDescription">Booking Alokasi</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									
									
									<form role="form" id="form" enctype="multipart/form-data" method="POST" action="">
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
													<input style="text-transform:uppercase" type="text" value = "<?php echo $tgl; ?>" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Kategori" class="form-control" name="tgl" readonly required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Tipe Mobil <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" value = "<?php echo $_GET[kode_tipe]; ?>" type="text" onblur="this.value=this.value.toUpperCase()" class="form-control"  name="norangka_local" readonly required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Warna Mobil <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" value = "<?php echo $_GET[kode_warna]; ?>" type="text" onblur="this.value=this.value.toUpperCase()" class="form-control"  name="norangka_local" readonly required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Jumlah Booking <span class="symbol required"></span>
													</label>
													<input type="text" class="form-control" value = "<?php if(count($_POST)){ echo $hasil_data[jumlah_booking]; } else { echo $_GET[jumlah_booking]; } ?>" name="jumlah_booking" onkeypress="return hanyaAngka(event)" required>
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
													<i class="fa fa-save"></i> Simpan
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick="window.location.href='?module=logistik_alokasiunithpm';">
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
							
<?php break;
}
}
 ?>