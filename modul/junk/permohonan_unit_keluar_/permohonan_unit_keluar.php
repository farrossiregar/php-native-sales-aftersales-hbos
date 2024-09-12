<?php
session_start();

include "config/koneksi_sqlserver.php";

$level = $_SESSION['leveluser'];
										    
$cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 

");
$cek_akses2 = mysql_fetch_array($cek_akses);

										
if($cek_akses2['akses'] != 'Y'){

  
	include "modul/protected.php";

}else{
		
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
					
					function tampil_modal(id){
						param_id = id;
						//alert(id);
						$.ajax({
									method : "GET",
									url : "modul/permohonan_unit_keluar/ajax_lihat_spk.php",
									data : {data_ajax : param_id},
									success : function(data){
										
										$('#modal').html(data);
										$("#modal").modal('show');
										
									}	
								})
						
					}
				</script>
				
				<?php
										
					if ($_GET['status']=='ok'){
						
						$msg = "
						<div class='alert alert-success alert-dismissable'>
						
						<h4><i class='icon fa fa-check'></i> Selamat!</h4>
						Berhasil menyimpan data, Pilih Tanggal dan klik tombol tampilkan data untuk melihat detail data yang sudah disimpan.</div>";
						
					
					
					?>
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog  modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="myModalLabel">Info</h4>
								</div>
								<div class="modal-body">
									<?php echo $msg; ?>
																						
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
										Tutup
									</button>
									<!--button type="button" class="btn btn-primary">
										Save changes
									</button-->
								</div>
							</div>
						</div>
					</div>
					<?php }else if ($_GET['status']=='gagal'){	
						$msg = "
						<div class='alert alert-danger alert-dismissable'>
						
						<h4><i class='icon fa fa-check'></i> Perhatian!</h4>
						Gagal!!!! Data sudah ada..</div>";
					//echo $msg;
					?>
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog  modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="myModalLabel">Info</h4>
								</div>
								<div class="modal-body">
									<?php echo $msg; ?>
																						
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
										Tutup
									</button>
									<!--button type="button" class="btn btn-primary">
										Save changes
									</button-->
								</div>
							</div>
						</div>
					</div>

					<?php
					}
					?>
				
				
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE --->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Logistik</h1>
									<span class="mainDescription">Permohonan Unit Keluar</span>
								</div>
								<!--ol class="breadcrumb">
									<li>
										<span>Logistik</span>
									</li>
									<li class="active">
										<span>Permohonan Unit Keluar</span>
									</li>
								</ol-->
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
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=logistik_puk&act=buat';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Tambah Data</span>
											</button>	
										</p>
										<hr>
										<?php
		                                }
										?>
									
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">								
									<div class="form-group">
                                    <form action="" method="GET" name="postform">
										<input type = "hidden" name = "module" value = "logistik_puk" />				
                                    </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label class="control-label">
										<font>Pilih Range Tanggal <span class="symbol required"></span></font>
									</label>
									<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
										<input class="form-control" type="text" placeholder ="Pilih Tanggal Awal" name="tgl_awal" id="tgl_awal" value = "<?php echo $_GET[tgl_awal] ?>" readonly>
										
										<span class="input-group-addon bg-primary">s/d</span>
										<input class="form-control" type="text" placeholder ="Pilih Tanggal Akhir" name="tgl_akhir" id="tgl_akhir" value = "<?php echo $_GET[tgl_akhir] ?>" readonly>
									</div>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-3"><br/>
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-white btn-info btn-bold">Tampilkan Data</button>									
									</br>	
                                    </form>
                                    </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
								<?php
								
									if(($_GET['tgl_awal'] != '') && ($_GET['tgl_akhir'] != '')){
										if($_SESSION['leveluser']!='supervisor'){
											if($_SESSION['leveluser'] =='user'){
												$qry=mysql_query("select * from unit_keluar where nama_sales = '$_SESSION[username]' and substr(date(waktu_keluar), 1, 10)>='$_GET[tgl_awal]' AND substr(date(waktu_keluar), 1, 10)<='$_GET[tgl_akhir]' order by no_puk desc");	
											}else {
												$qry=mysql_query("select * from unit_keluar where substr(date(waktu_keluar), 1, 10)>='$_GET[tgl_awal]' AND substr(date(waktu_keluar), 1, 10)<='$_GET[tgl_akhir]' order by no_puk desc");	
												
											}
											
										}else{
											$qry=mysql_query("select * from unit_keluar where kd_spv='$_SESSION[kode_spv]' AND substr(date(waktu_keluar), 1, 10)>='$_GET[tgl_awal]' AND substr(date(waktu_keluar), 1, 10)<='$_GET[tgl_akhir]' order by no_puk desc");	
										}
									}else{
										if($_SESSION['leveluser']!='supervisor'){
											if($_SESSION['leveluser'] =='user'){
												$qry=mysql_query("select * from unit_keluar where nama_sales = '$_SESSION[username]' order by no_puk desc limit 10");	
											}else {
												$qry=mysql_query("select * from unit_keluar order by no_puk desc limit 10");	
												
											}
											
										}else{
											$qry=mysql_query("select * from unit_keluar where kd_spv='$_SESSION[kode_spv]' order by no_puk desc limit 10");	
										}

									}									
								?>
							
									<!--div class="table-header"><i><b>Pencarian Data Permohonan Unit Keluar <?php echo $_GET[tgl_awal] ?> Sampai <?php echo $_GET[tgl_akhir] ?> <?php echo $_SESSION['kode_supervisor'] ?></b></i></div><br /-->
						
                        <table id="sample_2" class="table table-striped table-bordered table-hover table-full-width">
                    		<thead>
                    			<tr>
									<th>No.</th>
									<th>Tipe</th>
									
								</tr>
                    		</thead>
                            <tbody>
											
							<?php
								$no = 0;
								while($dt = mysql_fetch_array($qry)){
									
									
									$query = "select SPK.* from vw_PukSOS SPK
																where SPK.NomorSPK = '$dt[no_spk]' ";
									$query = sqlsrv_query($conn, $query);
									$n=0;
									while($data = sqlsrv_fetch_array($query)){
										$norangka = $data['NoRangka'];
										$nomesin = $data['NoMesin'];
										$tipe = $data['NamaTipe'];
										$nama_customer = $data['NamaCustomer'];
										$cara_beli = $data['JenisPenjualan'];
										$nomor_kontrak = $data['NomorKontrak'];
									}
									
									
								$no++;
								$awal = $_GET['tgl_awal'];
								$akhir = $_GET['tgl_akhir'];
								$setuju = "<a class='btn btn-xs btn-success' href='media_showroom.php?module=logistik_puk&act=approvepermohonan&id=$dt[no_spk]' data-placement='top' data-toggle='tooltip' data-original-title='Setujui Permohonan Unit Keluar $dt[no_spk]'><i class='fa fa-check'></i> SETUJUI PERMOHONAN</a>";
							?>
							<?php
								$qry1 = mysql_query("select * from matching_local where no_spk_local='$dt[no_spk]'");
								$sql1 = mysql_fetch_array($qry1);
							?>
							<?php
								$qry2 = mysql_query("select * from data_mobil where norangka='$sql1[norangka_local]'");
								$sql2 = mysql_fetch_array($qry2);
							?>
							<?php
							//	$qry3 = mysql_query("select * from pengajuan_discount where no_spk='$dt[no_spk]'");
								$qry3 = mysql_query("SELECT pd.tipe_mobil as tipe_mobil, t.nama_tipe as nama_tipe, pd.*, t.* FROM pengajuan_discount pd, tipe t where no_spk='$dt[no_spk]' and t.kode_tipe = pd.tipe_mobil");
								$sql3 = mysql_fetch_array($qry3);
							?>
							<?php
								$qry4 = mysql_query("select * from status_spk where no_spk='$dt[no_spk]'");
								$sql4 = mysql_fetch_array($qry4);
							?>
							
							
						
								<tr>
									<td width='5%'><?php echo $no;?></td>
									<td>
										<b>Pemohon : </b><?php echo $dt['nama_sales'];?> / <?php echo $dt['input'];?></br>
										<b>No SPK : </b><?php echo $dt['no_spk'];?></br>
										<b>Waktu Keluar : </b><?php echo $dt['waktu_keluar'];?></br>
										<!--b>Tipe : </b><?php echo $tipe ;?></br>
										<b>No Rangka : </b><?php echo $norangka; ?></br>
										<b>No Mesin : </b><?php echo $nomesin;?></br>
										<b>Nama Customer : </b><?php echo $nama_customer;?></br>
										<!--b>Waktu Keluar : </b><?php echo $dt['tgl_keluar']." ".$dt['jam_keluar'];?></br-->
										
										<!--b>Cara Pembayaran : </b><?php echo $cara_beli;?></br>
										<?php if($cara_beli != 'Tunai') {?><b>Leasing : </b><?php echo $sql3['leasing'];?><b> / Tenor : </b><?php echo $sql3['tenor'];?></br--> <?php } ?>
										<?php
										
										/*
											$qry5total = mysql_query("select sum(nilaipenerimaan) as dp1 from kwitansi_pesanan_kendaraan where noreferensi='$dt[no_spk]'");
											$sql5total = mysql_fetch_array($qry5total);
											$total_dp1 = $sql5total['dp1'];
											
											$qry5 = mysql_query("select * from kwitansi_pesanan_kendaraan where noreferensi='$dt[no_spk]'");
											while($sql5 = mysql_fetch_array($qry5)){
												echo "<b>DP : </b>Rp ".number_format("$sql5[nilaipenerimaan]",0,".",".")."</br>";
											}
										?>
										<?php
											$qry6total = mysql_query("select sum(nilaipenerimaan) as dp2 from kwitansi_pesanan_kendaraan where noreferensi='$sql4[no_penjualan]'");
											$sql6total = mysql_fetch_array($qry6total);
											$total_dp2 = $sql6total['dp2'];
											$tot = $total_dp1+$total_dp2;
											
											$qry6 = mysql_query("select * from kwitansi_pesanan_kendaraan where noreferensi='$sql4[no_penjualan]'");
											while($sql6 = mysql_fetch_array($qry6)){
												echo "<b>DP : </b>Rp ".number_format("$sql6[nilaipenerimaan]",0,".",".")."</br>";
											}
										?>
										<?php
											if($tot!='0'){
												echo "<b>Total : </b>Rp ".number_format("$tot",0,".",".")."</br>";
											}
										?>
										<b>Discount : </b><?php echo "Rp ".number_format("$sql3[pengajuan_disc]",0,".",".");?></br>
										<b>Keterangan : </b><?php echo $dt['keterangan'];?></br>
										</br>
										<?php 
											if($dt['mngr_finance_app']=='Y'){
												echo "<b>Disetujui oleh Manager Finance : </b>".strtoupper($dt['mngr_finance_user_app']);
											}elseif($dt['mngr_finance_app']=='N'){
												echo "<b>Tidak Disetujui oleh Manager Finance : </b>".strtoupper($dt['mngr_finance_user_app']);
											}	
										?>
										<br>
										<?php 
											if($dt['arfinance_app']=='Y'){
												echo "<b>Disetujui oleh A/R Finance : </b>".strtoupper($dt['arfinance_user_app']);
											}elseif($dt['arfinance_app']=='N'){
												echo "<b>Tidak Disetujui oleh A/R Finance : </b>".strtoupper($dt['arfinance_user_app']);
											}	
										?>
										<br>
										<?php 
											if($dt['spv_finance_app']=='Y'){
												echo "<b>Disetujui oleh Supervisor Finance : </b>".strtoupper($dt['spv_finance_user_app']);
											}elseif($dt['spv_finance_app']=='N'){
												echo "<b>Tidak Disetujui oleh Supervisor Finance : </b>".strtoupper($dt['spv_finance_user_app']);
											}	
										?>
										<br>
										<?php 
											if($dt['spv_app']=='Y'){
												echo "<b>Disetujui oleh Supervisor : </b>".strtoupper($dt['spv_user_app']);
											}elseif($dt['spv_app']=='N'){
												echo "<b>Tidak Disetujui oleh Supervisor : </b>".strtoupper($dt['spv_user_app']);
											}	
											
											*/
										?>
										
										
										<div class="progress-demo">
											<?php
												//echo $setuju;
												$no_spk = md5(md5($dt['no_spk']));
											?>
										
											<!--a href='modul/permohonan_unit_keluar/puk_print.php?no_spk=<?php echo $dt['no_spk']."&tgl_keluar=".$dt['tgl_keluar']; ?>' target="_blank">
												<button class="btn btn-xs btn-warning" data-style="expand-right">
													<span class="ladda-label"><i class='fa fa-print'></i> Cetak</span>
												</button>
											</a-->
											<!--a class='btn btn-xs btn-info' href='media_showroom.php?module=logistik_puk&act=lihatpermohonan&id=<?php echo md5(md5($dt['no_spk'])); ?>' data-placement='top' data-toggle='tooltip' data-original-title='Setujui Permohonan Unit Keluar <?php echo $dt['no_spk']; ?>'><i class='fa fa-check'></i> Lihat Data</a -->
											
											<a class='btn btn-xs btn-info' onclick="<?php echo "tampil_modal('$no_spk')"; ?>;"><i class='fa fa-check'></i> Lihat Data</a>
											
											<?php if ($_SESSION[leveluser] == 'admin' || $_SESSION[leveluser] == 'salesadm' || $_SESSION[leveluser] == 'staff_salesadm' || $_SESSION[leveluser] == 'supervisor'){ if ($cara_beli == "Kredit" and $nomor_kontrak != "-"){?>
											<a class='btn btn-xs btn-warning' href='modul/permohonan_unit_keluar/laporan_permohonan.php?id=<?php echo md5(md5($dt['no_spk']));?>' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Permohonan <?php echo $dt['no_spk'] ?>' target='_blank'><i class='fa fa-print'></i> CETAK</a>
											
											<?php }elseif($cara_beli != "Kredit"){
												
											

											?>
											<a class='btn btn-xs btn-warning' href='modul/permohonan_unit_keluar/laporan_permohonan.php?id=<?php echo md5(md5($dt['no_spk']));?>' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Permohonan <?php echo $dt['no_spk'] ?>' target='_blank'><i class='fa fa-print'></i> CETAK</a>
											<?php
											}else {echo "<span class='label label-danger'>No Kontrak Blm Diinput</span>";}}
											
											if ($_SESSION[leveluser] == 'user' || $_SESSION[leveluser] == 'admin'){
												
												
											
											?>
											<a class='btn btn-xs btn-success' href='media_showroom.php?module=logistik_puk&act=update&id=<?php echo md5(md5($dt['no_spk'])); ?>' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Permohonan <?php echo $dt['no_spk'] ?>'><i class='fa fa-edit'></i> Ubah Data</a>
											
											<?php } ?>
										</div>
										
										</br>
									</td>
									
									
								</tr>
								
							<?php
								
								}
							?>
											
							</tbody>
                        </table>
						
						<!--a href='modul/ekspor?tgl_awal=.php'-->
						<!--a href='modul/ekspor.php?$dt['tgl_awal']'-->
						
						
								</div> 
							</div>
						</div>
					</div>
				</div>
				
				<div class="modal fade" id="modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							
				</div>

			
<?php 
	break;
	case "buat":
	include "buat_permohonan_unit_keluar.php";

    break;
    case "hapuspengajuan":
    $sql 	= "delete from unit_keluar where no_spk='$_GET[id]'";
    $query	= mysql_query($sql);
   
	header('location:../media_showroom.php?module=logistik_puk');

	
	break;
	case "update":
	
	$query = mysql_query("select * from unit_keluar where md5(md5(no_spk)) = '$_GET[id]'");
	$data = mysql_fetch_array($query);
?>				

				
				
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Permohonan Unit Keluar</h1>
									<span class="mainDescription">Revisi permohonan unit keluar</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
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
									<form role="form" id="form" enctype="multipart/form-data" method="post" action="modul/permohonan_unit_keluar/simpan_permohonan_unit_keluar.php?aksi=update">
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
													<div class="form-group">
														<label class="control-label">
															Nomor PUK <span class="symbol required"></span>
														</label>
														<input type="text" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()"  value="<?php echo $data['no_puk']; ?>" class="form-control" name="no_puk" required readonly>
													</div>
													
													
													<div class="form-group">
														<label for="form-field-mask-1">
															Nomor SPK <small class="text-success"></small>
														</label>
														<div class="input-group">
															<input id="nospk" class="form-control" type="text" value="<?php echo $data['no_spk'] ?>" placeholder="NO SPK" name="nospk"" readonly onblur="puk();">
															<span class="input-group-btn">
																<button type="button" id="src" class="btn btn-primary" >
																	<i class="fa fa-search"></i>
																</button>
															</span>
														</div>
													</div>
													
													
													
													
													<div class="form-group">
														<label class="control-label">
															Tanggal Keluar <span class="symbol required"></span>
														</label>
														<p class="input-group input-append datepicker date " data-date-format="yyyy-mm-dd">
															<input class="form-control" required  type="text" placeholder ="Pilih Tanggal Keluar" name="tanggal" value = "<?php //echo date("Y-m-d"); ?>">
															<span class="input-group-btn">
																<button type="button" class="btn btn-default">
																	<i class="glyphicon glyphicon-calendar"></i>
																</button> 
															</span>
														</p>
													</div>
													
													
												
													
													
													<div class="form-group">
														<label>
															Pilih Jam
														</label>
														<select data-placeholder="Pilih Jam" class="js-example-basic-single js-states form-control" style="height:50px;" required name="jam1">
																<option value="">Pilih Jam</option>
																<?php for($i=6; $i<20; $i++ ){
																echo "<option value=".($i<10 ? "0$i" : "$i") .">".($i<10 ? "0$i" : "$i")."</option>";
																
																  }?>
														</select>
													</div>
													<div class="form-group">
														<label>
															Pilih Menit
														</label>
														<select data-placeholder="Pilih Menit" class="js-example-basic-single js-states form-control" style="height:50px;" required name="menit1">
																<option value="">Pilih Menit</option>
																<?php for($i=0; $i<60; $i=$i+5 ){
																echo "<option value=".($i<10 ? "0$i" : "$i") .">".($i<10 ? "0$i" : "$i")."</option>";
																
																  }?>
														</select>
													</div>
													
													
													<div class="form-group">
														<label class="control-label">
															Keterangan <span class="symbol required"></span>
														</label>
														<div class="form-group">
															<div class="note-editor">
																<textarea class="form-control" id="keterangan" name="keterangan"></textarea>
															</div>
														</div>
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
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-left" onclick=window.location.href='media_showroom.php?module=logistik_puk'>
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
				
				
				<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onblur="reload();" onpageshow="focus">
							
				</div>


<?php	
	break;
	case "tambahdetail":
	include "input_diskon/tambah_nospk.php";
	
	
	break;
	case "print":
	
	include "laporan_permohonan.php";
	
	break;
	case "approvepermohonan":
	
	include "approve_permohonan.php";
	
	break;
	case "lihatpermohonan":
	
	include "lihat_permohonan.php";
	
	break;
	case "lihat_approve":
	
	
	break;
	case "ajukanapprove":
	
	include "input_diskon/ajukan_approve_input_diskon.php";
	
	break;
	case "cetakpd":
	
	include "laporan_pengajuan_discount.php";

 break;
}
}
 ?>