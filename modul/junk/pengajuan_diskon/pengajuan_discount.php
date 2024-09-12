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
		include "config/fungsi_thumb.php";
		switch($_GET[act]){
		//tampilkan data
		default:
?>	

               <script language="JavaScript">
					function warning() {
						return confirm('Anda yakin menghapus data ini?');
					}
					function tampil(){
						var tgl_awal = document.postform.tgl_awal.value;
						var tgl_akhir = document.postform.tgl_akhir.value;
						var filter = document.postform.filter.value;
						if (tgl_akhir!='' && tgl_awal!=''){
							document.getElementById("tampil_data").click();
						}
					}
					function tampil_lihat_detail($id){
						//alert("modal_pengajuan"+$id);
						$("#modal_pengajuan"+$id).modal('show');
						//$('#myModal').modal('show');
					}
				</script>

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE >
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Pengajuan Discount</h1>
									<span class="mainDescription">Input Pengajuan </span>
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
						<!-- start: DYNAMIC TABLE -->
						
						
						
						<?php if ($_GET[tgl_awal]=='') { ?>
						<!--div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog  modal-dialog modal-sm">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title" id="myModalLabel">Info</h4>
									</div>
									
									
									<div class="modal-body">
										<video width="100%" height="100%" controls="controls">
											<source src="http://honda-bintaro.com/pengajuandiskon.mp4" type="video/mp4" />
										</video>
																							
										
									</div>
									
									
									
									
									<div class="modal-footer">
										<button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
											Tutup
										</button>
										<!--button type="button" class="btn btn-primary">
											Save changes
										</button>
									</div>
								</div>
							</div>
						</div-->
						
						<?php } ?>
						
						
						
						
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-3">
									<!--h5 class="over-title margin-bottom-15">Keseluruhan <span class="text-bold">Data Sales</span></h5-->
										<?php
										
										if ($_GET['status']=='ok'){
											
											$msg = "
												<div class='alert alert-success alert-dismissable'>
												
												<h4><i class='icon fa fa-check'></i> Selamat!</h4>
												Berhasil menyimpan data, Pilih Tanggal dan klik tombol tampilkan data untuk melihat detail data yang sudah disimpan.</div>";
												
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
										
										}elseif ($_GET['status']=='gagal'){
											$msg = "
												<div class='alert alert-danger alert-dismissable'>
												
												<h4><i class='icon fa fa-times'></i> Data Tidak Disimpan!</h4>
												Data sudah pernah diinput!!!</div>";
												
											
											
											
										
										
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
										
										}elseif ($_GET['status']=='kosong'){
											$msg = "
												<div class='alert alert-danger alert-dismissable'>												
												<h4><i class='icon fa fa-times'></i> Data Tidak Disimpan!</h4>
												Data yang anda masukan tidak Lengkap!!!</div>";
												
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
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=prospek_pengajuandiscount&act=buat';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Buat Pengajuan Discount</span>
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
										<input type = "hidden" name = "module" value = "prospek_pengajuandiscount" />
                                        <label class="control-label">
											   Pilih Data yang akan di tampilkan <span class="symbol required"></span>
									    </label>
                                        <select id="status_approved" name="status_approved" >
															<option value="" disabled>CARI DATA BERDASARKAN:</option>
															<option value="" <?php if($_GET[status_approved]==''){echo "selected";}  ?> >Semua Data</option>
															<option value="B" <?php if($_GET[status_approved]=='B'){echo "selected"; } ?> >Belum Diproses</option>
															<option value="Y" <?php if($_GET[status_approved]=='Y'){echo "selected";  }?>>Sudah Diproses dan Disetujui</option>
															<option value="N" <?php if($_GET[status_approved]=='N'){echo "selected";  }?>>Sudah Diproses dan Tidak Disetujui</option>
															<option value="AL" <?php if($_GET[status_approved]=='AL'){echo "selected"; } ?>>Pengajuan ke Direktur</option>
															<option value="T" <?php if($_GET[status_approved]=='T'){echo "selected"; } ?>>Disetujui Tapi Belum SPK</option>
															<option value="GASPK" <?php if($_GET[status_approved]=='GASPK'){echo "selected"; } ?>>Disetujui Tapi Tidak SPK</option>
										</select>
                                        				
                                    </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									 <label class="control-label">
										   <font>Pilih Range Tanggal <span class="symbol required"></span></font>
									</label>
									<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
										<input class="form-control" required readonly type="text" placeholder ="Pilih Tanggal Awal" name="tgl_awal" value = "<?php echo $_GET['tgl_awal'] ?>">
										<span class="input-group-addon bg-primary">s/d</span>
										<input class="form-control" required readonly type="text" placeholder ="Pilih Tanggal Akhir" name="tgl_akhir" value = "<?php echo $_GET['tgl_akhir'] ?>">
									</div>
									
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-4"><br/>
                                    <div class="form-group">
                                    <button type="submit" id="tampil_data"  class="btn btn-white btn-info btn-bold">Tampilkan Data</button>	

									
										
									</br></br>Jumlah data <select id="batas" name="batas" onchange="tampil();" >
															<option value="5" <?php if($_GET[batas]=='5'){echo "selected";}  ?>  >5</option>
															<option value="10" <?php if($_GET[batas]=='10'){echo "selected";}  ?> >10</option>
															<option value="15" <?php if($_GET[batas]=='15'){echo "selected";}  ?> >15</option>
															<option value="20" <?php if($_GET[batas]=='20'){echo "selected";}  ?> >20</option>
															<option value="1000" <?php if($_GET[batas]=='1000'){echo "selected"; } ?> >All</option>
															
										</select>	
								
									<input style="height:32px;" type="text" value ="<?php echo $_GET[filter]; ?>" placeholder ="Filter Pencarian" name = "filter" onblur="tampil();" />
								
									
                                    </form>
									
									<?php
										 if (strtoupper($_SESSION['leveluser']) != 'USER' and strtoupper($_SESSION['leveluser']) != 'SUPERVISOR') 
										 
										 { if ($_GET[tgl_awal] != ''){
											 ?>
									
									
									
									<?php
										 }}
										 ?>
									
                                    </div>
								</div>
								
								
								
							</div>
							<div class="row">
								<div class="col-md-12">
									<?php
                    //di proses jika sudah klik tombol cari
                    if(isset($_GET['status_approved'])){
                    	
						function ubah_tanggal($tgl_awal){
							$exp = explode('-',$tgl_awal);
							if(count($exp) == 3) {
								$tgl_awal = $exp[2].'-'.$exp[1].'-'.$exp[0];
							}
							return $tlg_awal;
						}
						
						
                    	//menangkap nilai form
						
						$tanggal_awal = date($_GET['tgl_awal']);
						$tanggal_akhir = date($_GET['tgl_akhir']);
						
						
						
                    	$status_approved=$_GET['status_approved'];
                    	$status_approved2=$status_approved;
    						if($status_approved2=="Y") {
    						    $status_approved2="Disetujui"; 
    						}
    						if($status_approved2=="N") {
    						    $status_approved2="Tidak Disetujui"; 
    						}
    						if($status_approved2=="AL") {
    						    $status_approved2="Diajukan"; 
    						}
    						if($status_approved2=="B") {
    						    $status_approved2="Belum Diproses "; 
    						}
							
							if($status_approved2=="T") {
    						    $status_approved2="Tanpa No SPK "; 
    						}
							
							if (empty($_GET[filter])){
								$filter = "";
								
								
							}else {
								$filter = "and (nama_sales like '%$_GET[filter]%' or nama_customer like '%$_GET[filter]%' or kode_spv like '%$_GET[filter]%' or alamat_customer like '%$_GET[filter]%' )";
							}		
							
							$p      = new Paging;
							$batas  = $_GET[batas];
							$posisi = $p->cariPosisi($batas);
							
											
							
							$kueri="
                    		
                    		select t.nama_tipe as nama_tipe, w.nama_warna as nama_warna, m.nama_model as nama_model ,pd.* from pengajuan_discount pd 
                                            			left join tipe t on t.kode_tipe=pd.tipe_mobil
                                            			left join model m on m.kode_model=pd.model
                                            			left join warna w on w.kode_warna=pd.warna 
                    		
                    		";
                    	if (empty($status_approved)){
                    		//jika tidak menginput apa2
                    		if ($_SESSION['leveluser'] == 'supervisor')
								{$data=mysql_query("$kueri where (username_pemohon = '$_SESSION[username]' or kode_spv = '$_SESSION[kode_spv]') and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' $filter order by pd.no_pengajuan desc limit $posisi,$batas");}
							if ($_SESSION['leveluser'] == 'user')
								{$data=mysql_query("$kueri where username_pemohon = '$_SESSION[username]' and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' $filter order by pd.no_pengajuan desc limit $posisi,$batas");}
                    		    
                    		if ($_SESSION['leveluser'] != 'user' and $_SESSION['leveluser'] != 'supervisor') {$data=mysql_query("$kueri where date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' $filter order by pd.no_pengajuan desc limit $posisi,$batas ");}
                    		
                    		
                    	}else{
                    	    if ($_GET['status_approved']=="B")
                    	    {
								if ($_SESSION['leveluser'] == 'supervisor') {$data=mysql_query("$kueri where proses_approve='N' and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and (username_pemohon = '$_SESSION[username]' or kode_spv = '$_SESSION[kode_spv]') $filter order by pd.no_pengajuan desc limit $posisi,$batas");}
								if ($_SESSION['leveluser'] == 'user') {$data=mysql_query("$kueri where proses_approve='N' and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and username_pemohon = '$_SESSION[username]' $filter order by pd.no_pengajuan desc limit $posisi,$batas");}
								
                    	        if ($_SESSION['leveluser'] != 'supervisor' and $_SESSION['leveluser'] != 'user')
                    	             {$data=mysql_query("$kueri where proses_approve='N' and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' $filter order by pd.no_pengajuan desc limit $posisi,$batas");}
								 
                    	        
                    	        
                    	    }
							elseif($_GET['status_approved']=="T"){
								if ($_SESSION['leveluser'] == 'supervisor') {$data=mysql_query("$kueri where (username_pemohon = '$_SESSION[username]' or kode_spv = '$_SESSION[kode_spv]') and status_approved='Y' and (no_spk='' and status_spk !='N' ) and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' $filter order by pd.no_pengajuan desc limit $posisi,$batas");}
								if ($_SESSION['leveluser'] == 'user') {$data=mysql_query("$kueri where username_pemohon = '$_SESSION[username]' and status_approved='Y' and (no_spk='' and status_spk !='N' ) and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' $filter order by pd.no_pengajuan desc limit $posisi,$batas");}
		
								if ($_SESSION['leveluser'] != 'supervisor' and $_SESSION['leveluser'] != 'user')
                    	             {$data=mysql_query("$kueri where status_approved='Y' and (no_spk='' and status_spk !='N' ) and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' $filter order by pd.no_pengajuan desc limit $posisi,$batas");}
                    	        
                    	        
                    	    }
							elseif($_GET['status_approved']=="GASPK"){
								if ($_SESSION['leveluser'] == 'supervisor') {$data=mysql_query("$kueri where (username_pemohon = '$_SESSION[username]' or kode_spv = '$_SESSION[kode_spv]') and status_approved='Y' and (status_spk='N') and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' $filter order by pd.no_pengajuan desc limit $posisi,$batas");}
								if ($_SESSION['leveluser'] == 'user') {$data=mysql_query("$kueri where username_pemohon = '$_SESSION[username]' and status_approved='Y' and (status_spk='N') and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' $filter order by pd.no_pengajuan desc limit $posisi,$batas");}
		
								if ($_SESSION['leveluser'] != 'supervisor' and $_SESSION['leveluser'] != 'user')
                    	             {$data=mysql_query("$kueri where status_approved='Y' and (status_spk='N') and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' $filter order by pd.no_pengajuan desc limit $posisi,$batas");}
                    	        
							}
                    	    else
                    	    {
								if ($_SESSION['leveluser'] == 'supervisor') {$data=mysql_query("$kueri where status_approved='$status_approved' and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' and (username_pemohon = '$_SESSION[username]' or kode_spv = '$_SESSION[kode_spv]') $filter order by pd.no_pengajuan desc limit $posisi,$batas");}
								if ($_SESSION['leveluser'] == 'user') {$data=mysql_query("$kueri where status_approved='$status_approved' and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' and username_pemohon = '$_SESSION[username]' $filter order by pd.no_pengajuan desc limit $posisi,$batas");}
								
                    	        if ($_SESSION['leveluser'] != 'supervisor' and $_SESSION['leveluser'] != 'user')
                    	             {$data=mysql_query("$kueri where status_approved='$status_approved' and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' $filter order by pd.no_pengajuan desc limit $posisi,$batas");}
                    	        
                    	        
                    	    }
                    		
                    		?>
                        
                                <div class="table-header"><i><b>Pencarian dari data Pengajuan <?php echo $status_approved2 ?></b></i></div><br />
                                
                        <?php
                    		
                    	//	$data=mysql_query("$kueri where status_approved='$status_approved'");
                    		
                    	}
                    	
                    	?>
                    
                    
                        
                        <table  class="table table-striped table-bordered table-hover table-full-width">
                    		<thead>
                    			<tr>
									<th>NO</th>
									<th>KETERANGAN</th>
								</tr>
                    		</thead>
                            <tbody>
											
							<?php
					
								    //$sql = mysql_query("$kueri");
								    $sql = $data;
									if(mysql_num_rows($sql) > 0){
									$no = $posisi+1;
									while($data = mysql_fetch_assoc($sql)){
						            $no_spk = $data['no_spk'];
									$kdspv = $data['kode_spv'];
						            $statapp = $data['status_approved'];
						            $proses_approve = $data['proses_approve'];
						            $tombollogin = $_SESSION['leveluser'];
						                        
									$harga_otr = "Rp ".number_format("$data[harga_otr]",0,".",".");
									$discount_unit = "Rp ".number_format("$data[discount_unit]",0,".",".");
												
									$total_discount = "Rp ".number_format("$data[total_discount]",0,".",".");
									$disc_approved = "Rp ".number_format("$data[disc_approved]",0,".",".");
									$refund = "Rp ".number_format("$data[refund]",0,".",".");
									
									$disc_bruto1 = $data[pengajuan_disc]+$data[total_discount_accs];
						            $disc_bruto = "Rp ".number_format("$disc_bruto1",0,".",".");
									
						            $plafondisc=$data[discount_unit];
									
									$query_pengajuan_ulang = mysql_query("select * from pengajuan_discount_ulang where no_pengajuan = '$data[no_pengajuan]' and aktif = 'Y' ");
									$rec_pengu = mysql_num_rows($query_pengajuan_ulang);
									if ($rec_pengu >0 ){
										$data_pengu = mysql_fetch_array($query_pengajuan_ulang);
										
										$disc_bruto1 = $data_pengu[pengajuan_disc]+$data_pengu[total_discount_accs];
										 $plafondisc=$data_pengu[discount_unit];
										 $harga_otr = "Rp ".number_format("$data_pengu[harga_otr]",0,".",".");
									}
									
									
    								    if($plafondisc >= $disc_bruto1) {
											if ($data['leasing'] == '(KKB) BCA'){
												$plafondisc = "<a class='btn btn-xs btn-danger' href='media_showroom.php?module=prospek_pengajuandiscount&act=ajukanapprove&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Pengajuan $data[no_pengajuan] Total Diskon Melebihi Plafon Diskon'><i class='fa fa-check'></i> AJUKAN KE DIREKTUR</a>";
											}else {
												$plafondisc="<a class='btn btn-xs btn-success' href='media_showroom.php?module=prospek_pengajuandiscount&act=approvepengajuan&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Setujui Pengajuan $data[no_pengajuan]'><i class='fa fa-check'></i> BERI PERSETUJUAN</a>"; 
											}
    									    
    									}else {
    									    $plafondisc = "<a class='btn btn-xs btn-danger' href='media_showroom.php?module=prospek_pengajuandiscount&act=ajukanapprove&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Pengajuan $data[no_pengajuan] Total Diskon Melebihi Plafon Diskon'><i class='fa fa-check'></i> AJUKAN KE DIREKTUR</a>";
    								    }  
    											    
    								$direkturapprove=$data['status_approved'];
    									if($direkturapprove=="AL") {
    										$direkturapprove="<a class='btn btn-xs btn-success' href='media_showroom.php?module=prospek_pengajuandiscount&act=approvepengajuan&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Setujui Pengajuan $data[no_pengajuan]'><i class='fa fa-check'></i> BERI PERSETUJUAN</a>"; 
    									}else {$direkturapprove="";
    								
    								    }
    										    
						                      
						            $tombol=$tombollogin;
    									if($tombol=="admin") {
    									    $tombol="$plafondisc
    								         <!--a class='btn btn-xs btn-success' href='media_showroom.php?module=prospek_pengajuandiscount&act=approvepengajuan&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Setujui Pengajuan $data[no_pengajuan]'><i class='fa fa-check'></i> BERI PERSETUJUAN</a-->
    								         <a class='btn btn-xs btn-warning' href='modul/pengajuan_diskon/laporan_pengajuan_discount_2.php?id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pengajuan $data[no_pengajuan]' target='_blank'><i class='fa fa-print'></i> CETAK</a>
    									     <a class='btn btn-xs btn-primary' href='media_showroom.php?module=prospek_pengajuandiscount&act=ubahpengajuan&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Ubah Pengajuan $data[no_pengajuan]'><i class='fa fa-edit'></i> UBAH</a>
    									     <a class='btn btn-xs btn-danger' href='media_showroom.php?module=prospek_pengajuandiscount&act=hapuspengajuan&id=$data[no_pengajuan]' onClick='return warning();' data-placement='top' data-toggle='tooltip' data-original-title='Hapus Pengajuan $data[no_pengajuan]'><i class='fa fa-trash'></i> HAPUS</a>"; 
    									}
    									if($tombol=="supervisor") {
    									    if ($data['proses_approve'] == "N"){
    									       //$tombol="<!--a class='btn btn-xs btn-primary' href='media_showroom.php?module=prospek_pengajuandiscount&act=ubahpengajuan&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Ubah Pengajuan $data[no_pengajuan]'><i class='fa fa-edit'></i> UBAH</a-->
    										    //        <!--a class='btn btn-xs btn-warning' href='modul/laporan_pengajuan_discount_2.php?id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pengajuan $data[no_pengajuan]' target='_blank'><i class='fa fa-print'></i> CETAK</a-->"; 
											   $tombol = "<a class='btn btn-xs btn-primary' onclick = 'tampil_lihat_detail($no);' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>";
    									   }else {
											   if ($no_spk == ""){
												   if ($data['status_approved'] == "Y" ){
												 	   $tombol="<a class='btn btn-xs btn-info' href='media_showroom.php?module=prospek_pengajuandiscount&act=tambahdetail&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Setujui Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> UBAH STATUS PENGAJUAN</a>"; 
												   }else {
													   $tombol = "<a class='btn btn-xs btn-primary' onclick = 'tampil_lihat_detail($no);' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>";
												   }
												     
											   
											   }else {
													$tombol = "<a class='btn btn-xs btn-primary' onclick = 'tampil_lihat_detail($no);' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>";
											   }
										   }   
    									}
    									if($tombol=="salesadm") {
    									    if ($data['status_approved'] == "Y" ){
												if ($data['no_spk'] !='' or $data['status_spk']=='Y'){
    									        $tombol="<a class='btn btn-xs btn-warning' href='modul/pengajuan_diskon/laporan_pengajuan_discount_2.php?id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pengajuan $data[no_pengajuan]' target='_blank'><i class='fa fa-print'></i> CETAK</a>"; 
												}else {
													$tombol = "<a class='btn btn-xs btn-primary' onclick = 'tampil_lihat_detail($no);' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>
															<a class='btn btn-xs btn-info' href='media_showroom.php?module=prospek_pengajuandiscount&act=tambahdetail&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Setujui Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> ISI NO SPK</a>
											";
													
												}
											}
    									    else {$tombol = "<a class='btn btn-xs btn-primary' onclick = 'tampil_lihat_detail($no);' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>
															
											";}
    									   }
										
    									if($tombol=="MNGR") {
											
    								        if ($data['proses_approve'] == "N" and $data['status_approved'] != "AL"){
    											$tombol="$plafondisc
    									     	         <!--a class='btn btn-xs btn-warning' href='modul/laporan_pengajuan_discount_2.php?id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pengajuan $data[no_pengajuan]' target='_blank'><i class='fa fa-print'></i> CETAK</a-->
    												    ";   
    									    }else {
    										    //$tombol = "<!--a class='btn btn-xs btn-warning' href='modul/laporan_pengajuan_discount_2.php?id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pengajuan $data[no_pengajuan]' target='_blank'><i class='fa fa-print'></i> CETAK</a-->";
    										      $tombol = " <a class='btn btn-xs btn-warning' href='media_showroom.php?module=prospek_pengajuandiscount&act=pengajuan_ulang&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Ubah Pengajuan $data[no_pengajuan]'><i class='fa fa-edit'></i> Pengajuan Ulang </a>
																<a class='btn btn-xs btn-info' href='media_showroom.php?module=prospek_pengajuandiscount&act=tambahdetail&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Setujui Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> UBAH STATUS PENGAJUAN</a>
																<a class='btn btn-xs btn-primary' onclick = 'tampil_lihat_detail($no);' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>
																
																";
    										      }  
    										}
						                if($tombol=="DRKSI") {
						                    if ($data['status_approved'] == "AL"){
    									    	//$tombol="$direkturapprove <a class='btn btn-xs btn-warning' href='modul/laporan_pengajuan_discount_2.php?id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pengajuan $data[no_pengajuan]' target='_blank'><i class='fa fa-print'></i> CETAK</a>
    											$tombol="$direkturapprove";
						                    }else {
    						                        if ($data['status_approved'] == "Y"){
        										        //$tombol = "<a class='btn btn-xs btn-warning' href='modul/laporan_pengajuan_discount_2.php?id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pengajuan $data[no_pengajuan]' target='_blank'><i class='fa fa-print'></i> CETAK</a>";
        											    $tombol = "<a class='btn btn-xs btn-primary' onclick = 'tampil_lihat_detail($no);' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>";
    						                            }
    						                        else {
    						                            if ($proses_approve == "Y"){
    						                                $tombol = "<a class='btn btn-xs btn-primary' onclick = 'tampil_lihat_detail($no);' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>"  ;
    						                            }
    						                            else
    						                            {
    						                                $tombol = "<a class='btn btn-xs btn-primary' onclick = 'tampil_lihat_detail($no);' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>";
    						                            }
    						                        }
    											  } 
    										}
						                    if($tombol=="user") {
												if ($proses_approve == 'Y'){
													
													if($statapp=="AL") {
													$tombol = "<a class='btn btn-xs btn-primary' onclick = 'tampil_lihat_detail($no);' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>";	
													
													}else {
														//$tombol= "<a class='btn btn-xs btn-primary' href='media_showroom.php?module=prospek_pengajuandiscount&act=lihat_approve&id=$data[no_pengajuan]' target ='_BLANK' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>
														//<a class='btn btn-xs btn-warning' href='media_showroom.php?module=prospek_pengajuandiscount&act=pengajuan_ulang&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Ubah Pengajuan $data[no_pengajuan]'><i class='fa fa-edit'></i> Pengajuan Ulang </a> ";
														
														$tombol= "<a class='btn btn-xs btn-primary' onclick = 'tampil_lihat_detail($no);' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>
														<a class='btn btn-xs btn-warning' href='media_showroom.php?module=prospek_pengajuandiscount&act=pengajuan_ulang&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Ubah Pengajuan $data[no_pengajuan]'><i class='fa fa-edit'></i> Pengajuan Ulang </a> ";
														
													}
													
												}else {
													$tombol ="<a class='btn btn-xs btn-primary' onclick = 'tampil_lihat_detail($no);' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>";
												}
											}											
						                    if($proses_approve=="Y") {
    										    $proses_approve2="<span class='label label-success'>Sudah Diproses</span>"; 
    											    
    												}
    										if($proses_approve=="N") {
    											$proses_approve2="<span class='label label-danger'>Belum Diproses</span>"; 
    												}
    												
    										$statusaprrov=$statapp;
    										if($statusaprrov=="Y") {
    										   $statusaprrov="<span class='label label-success'>Disetujui</span>"; 
											   if ($data['status_spk'] == 'N'){ $status_spk = " <span class='label label-danger'>Tidak SPK</span>";  }elseif ($data['status_spk'] == '') {$status_spk = "";} else {$status_spk = "";}
    										}
    										if($statusaprrov=="N") {
    											$statusaprrov="<span class='label label-danger'>Tidak Disetujui</span>"; 
    											}
    										if($statusaprrov=="AL") {
												if ($data[pengajuan_ulang] == 'Y'){
													$pengajuan_ulang = ' (Pengajuan Ulang) ';
												}else { $pengajuan_ulang = '';}
													
													
    											$statusaprrov="<span class='label label-warning'>Menunggu Persetujuan".$pengajuan_ulang."</span>"; 
    											}
												
											/*if($status_approved=="T") {
    											$statusaprrov="<span class='label label-warning'>Tanpa No SPK</span>"; 
    											}*/
    										
											
											
											$query_pengajuan_ulang = mysql_query("
											select t.nama_tipe,w.nama_warna,pu.* from pengajuan_discount_ulang pu,tipe t,warna w where pu.no_pengajuan = '$data[no_pengajuan]'
											and pu.aktif = 'y' and t.kode_tipe = pu.tipe_mobil and w.kode_warna = pu.warna
											 ");
											if (mysql_num_rows($query_pengajuan_ulang) >= 1){
												$ada_pengajuan_ulang = 'ya';
												while ($dpu = mysql_fetch_assoc($query_pengajuan_ulang)) {
													$disc_bruto_ulang_1 = $dpu['pengajuan_disc']+$dpu['total_discount_accs'] ;	
													$disc_bruto_ulang = "Rp ".number_format("$disc_bruto_ulang_1",0,".",".");
													
													$disc_netto_ulang_1 = $disc_bruto_ulang_1 - $dpu['refund'];
													$disc_netto_ulang = "Rp ".number_format("$disc_netto_ulang_1",0,".",".");
													$tgl=$dpu['tanggal'];
													$tipe_ulang = $dpu['tipe_mobil'];
													$nama_tipe_ulang = $dpu['nama_tipe'];
													$nama_warna_ulang = $dpu['nama_warna'];
													$disc_unit_ulang = "Rp ".number_format("$dpu[discount_unit]",0,".",".");
													$harga_otr_ulang = "Rp ".number_format("$dpu[harga_otr]",0,".",".");
												}
												
											}else {
												$ada_pengajuan_ulang = '';
												$disc_bruto_ulang = '';
											}
											
						
											?>
						
												<tr>
												<td width='1%'><?php echo $no;?></td>
												<td width='30%'>
												    <?php 
												    echo '
												    <b>No Pengajuan :</b> '.$data[no_pengajuan].' / Tanggal: '.$data['waktu'].'<br />
												    <b>No SPK :</b> '.$data['no_spk'].'<br />
												    <b>Nama Sales :</b> '.$data['nama_sales'].' / '.$kdspv.'<br />
												    <b>Nama Customer :</b> '.$data['nama_customer'];
													
													//'</br> <b>Pengajuan Diskon Bruto :</b> '.$disc_bruto;
													
													if ($ada_pengajuan_ulang == 'ya'){
														echo 
														'<br /><b>('.$tipe_ulang .' - '. $nama_tipe_ulang.' - '.$nama_warna_ulang.')<br /> Harga OTR :</b> '.$harga_otr.												    
														'<br /><b>Plafon Diskon: </b>'.$disc_unit_ulang;
													
														
														echo '</br> <b>Pengajuan Diskon Bruto Ulang :</b> '.$disc_bruto_ulang;
														echo '</br> <b>Pengajuan Diskon Netto Ulang :</b> '.$disc_netto_ulang;	
														echo '</br> <b>Tanggal Pengajuan Ulang :</b> '.$tgl;
														
														
													}else {
														echo 
														'<br /><b>('.$data['tipe_mobil'] .' - '. $data['nama_tipe'].' - '.$data['nama_warna'].')';
														echo
														'<br /> Harga OTR :</b> '.$harga_otr.												   
														'<br /><b>Plafon Diskon: </b>'.$discount_unit;
														echo '</br> <b>Pengajuan Diskon Bruto :</b> '.$disc_bruto;
														echo '</br> <b>Pengajuan Diskon Netto :</b> '.$total_discount;														
													}
													
												    
												    
												    
												     if($statapp=="Y")
												     {echo '<br /><b>Di Setujui Oleh : </b>'.$data[user_approve].'<br/><br />'.$proses_approve2.' '.$statusaprrov.$status_spk;
												     }
												    else {
												        echo  '<br /><br />'.$proses_approve2;
												    }
												    
												    if($statapp=="AL")
												     {echo ' '.$statusaprrov;
												     }
												    else {
												        echo  '';
												    }
												    
												    if($statapp=="N" and $proses_approve=="Y")
												     {echo ' '.$statusaprrov;
												     }
												    else {
												        echo  '';
												    }
													
													$query_status_spk = mysql_query("select * from status_spk where no_spk = '$data[no_spk]' ");
													$dtspk = mysql_fetch_array($query_status_spk);
													$no_spk = trim($dtspk['no_spk']);
													$no_pengajuan = trim($dtspk['no_penjualan']);
													
													$query_kwitansi = mysql_query("select sum(nilaipenerimaan) as nilaipenerimaan from kwitansi_pesanan_kendaraan where noreferensi in('$no_spk','$no_pengajuan') ");
													$data_kwitansi = mysql_fetch_array($query_kwitansi);
													
													
													$nilai_penerimaan = $data_kwitansi[nilaipenerimaan];
													//$nilai_penerimaan = $data_kwitansi[nilaipenerimaan];
													$sisa_piutang = $dtspk[hargatotal] - $data_kwitansi[nilaipenerimaan];
													
													if ($data['no_spk']!=''){
														if (substr($dtspk['tgl_spk'],0,2) < 20 ){
															echo " <span class='label label-danger'>SPK Tidak Sesuai</span>"; 
														}else{
															echo " <span class='label label-success'>SPK ".date("Y-m-d",strtotime($dtspk[tgl_spk]))."</span>";
														}
														echo " <span class='label label-primary'>".trim($dtspk[carabeli])."</span> ";
														if ($data_kwitansi[nilaipenerimaan] >= $dtspk[hargatotal] and $data_kwitansi[nilaipenerimaan] <> '' ){
															echo " <span class='label label-success'>Lunas</span> ";
														}else{
															echo " <span class='label label-danger'>Pembayaran ".number_format("$nilai_penerimaan",0,".",".").' '."(- ".number_format("$sisa_piutang",0,".",".").")</span> ";
														}
														if (substr($dtspk['tgl_matching'],0,2) < 20 ){
															echo " <span class='label label-danger'>Unit</span>"; 
														}else{
															//$tgl_matching = ubah_tanggal($dtsp)
															$tgl_matching = date("Y-m-d",strtotime($dtspk[tgl_matching]));
															//$tgl_matching = date("Y-m-d",);
															echo " <span class='label label-success'>Alokasi Unit ($tgl_matching)</span>"; 
														}
														
														if (substr($dtspk['tgl_faktur'],0,2) < 20 ){
															echo " <span class='label label-danger'>Faktur</span>"; 
														}else{
															//$tgl_matching = ubah_tanggal($dtsp)
															$tgl_faktur = date("Y-m-d",strtotime($dtspk[tgl_faktur]));
															//$tgl_matching = date("Y-m-d",);
															echo " <span class='label label-success'>Faktur ($tgl_faktur)</span>"; 
														}
														
														if (substr($dtspk['tgl_kirim'],0,2) < 20 ){
															echo " <span class='label label-danger'>DO</span>"; 
														}else{
															//$tgl_matching = ubah_tanggal($dtsp)
															$tgl_kirim = date("Y-m-d",strtotime($dtspk[tgl_kirim]));
															//$tgl_matching = date("Y-m-d",);
															echo " <span class='label label-success'>DO ($tgl_kirim)</span>"; 
														}
														
													}
													
													
													
													
												    ?><br /><br />
												    <center>
												    <?php
												    echo $tombol;
													
													
													
													include "lihat_approve_new.php";
														
													
													
													
												    ?>
													
												</td>
											    
												
												</tr>
												<?php
												$no++;
													}
												}
											?>
											
										</tbody>
                        </table>
						<?php
							
						if (empty($status_approved)){
                    		//jika tidak menginput apa2
                    		if ($_SESSION['leveluser'] == 'supervisor')
								{$data=mysql_query("$kueri where (username_pemohon = '$_SESSION[username]' or kode_spv = '$_SESSION[kode_spv]') and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' $filter order by pd.no_pengajuan desc");}
							if ($_SESSION['leveluser'] == 'user')
								{$data=mysql_query("$kueri where username_pemohon = '$_SESSION[username]' and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' $filter order by pd.no_pengajuan desc");}
                    		    
                    		if ($_SESSION['leveluser'] != 'user' and $_SESSION['leveluser'] != 'supervisor') {$data=mysql_query("$kueri where date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' $filter order by pd.no_pengajuan desc ");}
                    		
                    		
                    	}else{
                    	     if ($_GET['status_approved']=="B")
                    	    {
								if ($_SESSION['leveluser'] == 'supervisor') {$data=mysql_query("$kueri where proses_approve='N' and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and (username_pemohon = '$_SESSION[username]' or kode_spv = '$_SESSION[kode_spv]') $filter order by pd.no_pengajuan desc ");}
								if ($_SESSION['leveluser'] == 'user') {$data=mysql_query("$kueri where proses_approve='N' and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and username_pemohon = '$_SESSION[username]' $filter order by pd.no_pengajuan desc ");}
								
                    	        if ($_SESSION['leveluser'] != 'supervisor' and $_SESSION['leveluser'] != 'user')
                    	             {$data=mysql_query("$kueri where proses_approve='N' and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' $filter order by pd.no_pengajuan desc ");}
								 
                    	        
                    	        
                    	    }
							elseif($_GET['status_approved']=="T"){
								if ($_SESSION['leveluser'] == 'supervisor') {$data=mysql_query("$kueri where (username_pemohon = '$_SESSION[username]' or kode_spv = '$_SESSION[kode_spv]') and status_approved='Y' and (no_spk='' and status_spk !='N' ) and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' $filter order by pd.no_pengajuan desc ");}
								if ($_SESSION['leveluser'] == 'user') {$data=mysql_query("$kueri where username_pemohon = '$_SESSION[username]' and status_approved='Y' and (no_spk='' and status_spk !='N' ) and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' $filter order by pd.no_pengajuan desc ");}
		
								if ($_SESSION['leveluser'] != 'supervisor' and $_SESSION['leveluser'] != 'user')
                    	             {$data=mysql_query("$kueri where status_approved='Y' and (no_spk='' and status_spk !='N' ) and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' $filter order by pd.no_pengajuan desc ");}
                    	        
                    	        
                    	    }
							elseif($_GET['status_approved']=="GASPK"){
								if ($_SESSION['leveluser'] == 'supervisor') {$data=mysql_query("$kueri where (username_pemohon = '$_SESSION[username]' or kode_spv = '$_SESSION[kode_spv]') and status_approved='Y' and (status_spk='N') and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' $filter order by pd.no_pengajuan desc ");}
								if ($_SESSION['leveluser'] == 'user') {$data=mysql_query("$kueri where username_pemohon = '$_SESSION[username]' and status_approved='Y' and (status_spk='N') and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' $filter order by pd.no_pengajuan desc ");}
		
								if ($_SESSION['leveluser'] != 'supervisor' and $_SESSION['leveluser'] != 'user')
                    	             {$data=mysql_query("$kueri where status_approved='Y' and (status_spk='N') and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' $filter order by pd.no_pengajuan desc ");}
                    	        
							}
                    	    else
                    	    {
								if ($_SESSION['leveluser'] == 'supervisor') {$data=mysql_query("$kueri where status_approved='$status_approved' and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' and (username_pemohon = '$_SESSION[username]' or kode_spv = '$_SESSION[kode_spv]') $filter order by pd.no_pengajuan desc ");}
								if ($_SESSION['leveluser'] == 'user') {$data=mysql_query("$kueri where status_approved='$status_approved' and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' and username_pemohon = '$_SESSION[username]' $filter order by pd.no_pengajuan desc ");}
								
                    	        if ($_SESSION['leveluser'] != 'supervisor' and $_SESSION['leveluser'] != 'user')
                    	             {$data=mysql_query("$kueri where status_approved='$status_approved' and date(pd.tgl_pengajuan_ulang) >='$tanggal_awal' and date(pd.tgl_pengajuan_ulang) <='$tanggal_akhir' and proses_approve='Y' $filter order by pd.no_pengajuan desc ");}
                    	        
                    	        
                    	    }
						}	
							
							$jmldata = mysql_num_rows($data);
							$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
							$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

							echo "<ul class='pagination pagination-red margin-bottom-10'>$linkHalaman</ul><br>";
						?>
						
						
						<a href='modul/pengajuan_diskon/eks_pd.php?status_approved=<?php echo $_GET[status_approved].'&tgl_awal='.$tanggal_awal.'&tgl_akhir='.$tanggal_akhir; ?>'>
									<!--a href='modul/eks_pd.php?tgl_awal=<?php echo $tanggal_awal.'&tgl_akhir='.$tanggal_akhir; ?>'-->
									
									<?php
										$level = $_SESSION['leveluser'];
										
										$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ");
										$cek_akses2 = mysql_fetch_array($cek_akses);
											if($cek_akses2['ekspor'] == 'Y')
											{
									?>
										<div class="progress-demo pull-right">
											<button class="btn btn-wide btn-primary ladda-button" data-style="expand-right">
												<span class="ladda-label"> Export Data ke Excel</span>
											</button>
										</div>
									<?php
										}
									?>
									</a></br>
                           </div>
                     </div>
                </div>
            
            </div>
        </div>


<?php
}else{
	unset($_GET['cari']);

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
	include "buat_pengajuan.php";
		
?>	

<?php
    break;
    case "hapuspengajuan":
    $sql 	= "delete from pengajuan_discount where no_pengajuan='$_GET[id]'";
    $query	= mysql_query($sql);
   
		header('location:../media_showroom.php?module=prospek_pengajuandiscount');

?>
		
<?php	
	break;
	case "ubahpengajuan":
	include "ubah_pengajuan.php";
	
?>	

<?php	
	break;
	case "pengajuan_ulang":
	include "pengajuan_ulang.php";
	
?>							

<?php	
	break;
	case "tambahdetail":
	include "tambah_nospk.php";
	
?>	
				
<?php	
	break;
	case "approvepengajuan":
	
	include "approve_pengajuan.php";
	
?>
<?php	
	break;
	case "lihat_approve":
	
	include "lihat_approve.php";
	
?>

<?php	
	break;
	case "ajukanapprove":
	
	include "approve_pengajuan.php";
	
?>
			
<?php	
	break;
	case "cetakpd":
	
	include "laporan_pengajuan_discount.php";

?>

				
				
				
<?php break;
}
} ?>