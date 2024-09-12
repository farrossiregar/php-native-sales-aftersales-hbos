<?php
session_start();
 if (strtoupper($_SESSION['leveluser']) != 'SUPERVISOR' and strtoupper($_SESSION['leveluser']) != 'ADMIN' and strtoupper($_SESSION['leveluser']) != 'MNGR' ) {
  
?>
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle text-orange ">This page is PROTECTED..!!!</h1>
									
								</div>
								
							</div>
						</section>
					</div>
				</div>
<?php
}
	else {
		include "config/fungsi_thumb.php";
		switch($_GET[act]){
		//tampilkan data
		default:
?>
               <script language="JavaScript">
					function warning() {
						return confirm('Anda yakin menghapus data ini?');
					}
				</script>

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Input Discount</h1>
									<span class="mainDescription">Input Discount SPK</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li class="active">
										<span>Input Discount</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-3">
									<!--h5 class="over-title margin-bottom-15">Keseluruhan <span class="text-bold">Data Sales</span></h5-->
									
										<?php
										    if($_SESSION['leveluser'] != 'supervisor')
										    {
										
										?>
										
										<p class="progress-demo">
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_transaksi_input_discount&act=buat';>
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
										<input type = "hidden" name = "module" value = "sub_transaksi_input_discount" />
                                        <label class="control-label">
											   <font color="red"><b>Note : </b></font>Pilih Data yang akan di tampilkan <span class="symbol required"></span>
									    </label>
                                        <select id="status_approved" name="status_approved" >
															<option value="" disabled>CARI DATA BERDASARKAN:</option>
															<option value="" <?php if($_GET[status_approved]==''){echo "selected";}  ?> >Semua Data</option>
															<option value="B" <?php if($_GET[status_approved]=='B'){echo "selected"; } ?> >Belum Diproses</option>
															<option value="Y" <?php if($_GET[status_approved]=='Y'){echo "selected";  }?>>Sudah Diproses dan Disetujui</option>
															<option value="N" <?php if($_GET[status_approved]=='N'){echo "selected";  }?>>Sudah Diproses dan Tidak Disetujui</option>
															<option value="AL" <?php if($_GET[status_approved]=='AL'){echo "selected"; } ?>>Pengajuan ke Direktur</option>
															
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
										<input class="form-control" type="text" name="tgl_awal" value = "<?php echo $_GET[tgl_awal] ?>">
										<span class="input-group-addon bg-primary">s/d</span>
										<input class="form-control" type="text" name="tgl_akhir" value = "<?php echo $_GET[tgl_akhir] ?>">
									</div>
									
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-3"><br/>
                                    <div class="form-group">
                                    <button type="submit"  class="btn btn-white btn-info btn-bold">Tampilkan Data</button>
                                    </form>
                                    </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									
									<?php
                    //di proses jika sudah klik tombol cari
                    if(isset($_GET['status_approved'])){
                    	
                    	//menangkap nilai form
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
                    	$kueri="
                    		
                    		select t.nama_tipe as nama_tipe, w.nama_warna as nama_warna, m.nama_model as nama_model ,pd.* from pengajuan_discount pd 
                                            			left join tipe t on t.kode_tipe=pd.tipe_mobil
                                            			left join model m on m.kode_model=pd.model
                                            			left join warna w on w.kode_warna=pd.warna 
                    		
                    		";
                    	if (empty($status_approved)){
                    		//jika tidak menginput apa2
                    		if ($_SESSION['leveluser'] == 'supervisor')
								{$data=mysql_query("$kueri where (username_pemohon = '$_SESSION[username]' or kode_spv = '$_SESSION[kode_spv]') and pd.waktu >='$_GET[tgl_awal]' and pd.waktu <='$_GET[tgl_akhir]' order by pd.no_pengajuan desc");}
							
                    		if ($_SESSION['leveluser'] != 'user' and $_SESSION['leveluser'] != 'supervisor') {$data=mysql_query("$kueri where pd.waktu >='$_GET[tgl_awal]' and pd.waktu <='$_GET[tgl_akhir]' order by pd.no_pengajuan desc ");}
                    		
                    		
                    	}else{
                    	    if ($_GET['status_approved']=="B")
                    	    {
								if ($_SESSION['leveluser'] == 'supervisor') {$data=mysql_query("$kueri where proses_approve='N' and pd.waktu >='$_GET[tgl_awal]' and pd.waktu <='$_GET[tgl_akhir]' and (username_pemohon = '$_SESSION[username]' or kode_spv = '$_SESSION[kode_spv]') order by pd.no_pengajuan desc");}
								
                    	        if ($_SESSION['leveluser'] != 'supervisor' and $_SESSION['leveluser'] != 'user')
                    	             {$data=mysql_query("$kueri where proses_approve='N' and pd.waktu >='$_GET[tgl_awal]' and pd.waktu <='$_GET[tgl_akhir]' order by pd.no_pengajuan desc");}
                    	        
                    	        
                    	    }
                    	    else
                    	    {
								if ($_SESSION['leveluser'] == 'supervisor') {$data=mysql_query("$kueri where status_approved='$status_approved' and pd.waktu >='$_GET[tgl_awal]' and pd.waktu <='$_GET[tgl_akhir]' and proses_approve='Y' and (username_pemohon = '$_SESSION[username]' or kode_spv = '$_SESSION[kode_spv]') order by pd.no_pengajuan desc");}
								
                    	        if ($_SESSION['leveluser'] != 'supervisor' and $_SESSION['leveluser'] != 'user')
                    	             {$data=mysql_query("$kueri where status_approved='$status_approved' and pd.waktu >='$_GET[tgl_awal]' and pd.waktu <='$_GET[tgl_akhir]' and proses_approve='Y' order by pd.no_pengajuan desc");}
                    	        
                    	        
                    	    }
                    		
                    		?>
                        
                                <div class="table-header"><i><b>Pencarian dari data Pengajuan <?php echo $status_approved2 ?></b></i></div><br />
                                
                        <?php
                    		
                    	//	$data=mysql_query("$kueri where status_approved='$status_approved'");
                    		
                    	}
                    	
                    	?>
                    
                    
                        
                        <table id="sample_1" class="table table-striped table-bordered table-hover table-full-width">
                    		<thead>
                    			<tr>
									<th>No.</th>
									<th>Tipe</th>
								</tr>
                    		</thead>
                            <tbody>
											
							<?php
					
								    //$sql = mysql_query("$kueri");
								    $sql = $data;
									if(mysql_num_rows($sql) > 0){
									$no = 1;
									while($data = mysql_fetch_assoc($sql)){
						            $no_spk = $data['no_spk'];
						            $statapp = $data['status_approved'];
						            $proses_approve = $data['proses_approve'];
						            $tombollogin = $_SESSION['leveluser'];
						                        
									$harga_otr = "Rp ".number_format("$data[harga_otr]",0,".",".");
									$discount_unit = "Rp ".number_format("$data[discount_unit]",0,".",".");
												
									$total_discount = "Rp ".number_format("$data[total_discount]",0,".",".");
									$disc_approved = "Rp ".number_format("$data[disc_approved]",0,".",".");
									$refund = "Rp ".number_format("$data[refund]",0,".",".");
						                        
						            $plafondisc=$data[discount_unit];
    								    if($plafondisc>=$data[total_discount]) {
    									    $plafondisc="<a class='btn btn-xs btn-success' href='media_showroom.php?module=sub_transaksi_pengajuan_discount&act=approvepengajuan&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Setujui Pengajuan $data[no_pengajuan]'><i class='fa fa-check'></i> BERI PERSETUJUAN</a>"; 
    									}else {
    									    $plafondisc = "<a class='btn btn-xs btn-danger' href='media_showroom.php?module=sub_transaksi_pengajuan_discount&act=ajukanapprove&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Pengajuan $data[no_pengajuan] Total Diskon Melebihi Plafon Diskon'><i class='fa fa-check'></i> AJUKAN KE DIREKTUR</a>
    											    
                                    	    ";
    								    }  
    											    
    								$direkturapprove=$data['status_approved'];
    									if($direkturapprove=="AL") {
    										$direkturapprove="<a class='btn btn-xs btn-success' href='media_showroom.php?module=sub_transaksi_pengajuan_discount&act=approvepengajuan&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Setujui Pengajuan $data[no_pengajuan]'><i class='fa fa-check'></i> BERI PERSETUJUAN</a>"; 
    									}else {$direkturapprove="";
    								
    								    }
    										    
						                      
						            $tombol=$tombollogin;
    									if($tombol=="admin") {
    									    $tombol="$plafondisc
    								         <!--a class='btn btn-xs btn-success' href='media_showroom.php?module=sub_transaksi_pengajuan_discount&act=approvepengajuan&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Setujui Pengajuan $data[no_pengajuan]'><i class='fa fa-check'></i> BERI PERSETUJUAN</a-->
    								         <a class='btn btn-xs btn-warning' href='modul/laporan_pengajuan_discount_2.php?id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pengajuan $data[no_pengajuan]' target='_blank'><i class='fa fa-print'></i> CETAK</a>
    									     <a class='btn btn-xs btn-primary' href='media_showroom.php?module=sub_transaksi_pengajuan_discount&act=ubahpengajuan&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Ubah Pengajuan $data[no_pengajuan]'><i class='fa fa-edit'></i> UBAH</a>
    									     <a class='btn btn-xs btn-danger' href='media_showroom.php?module=sub_transaksi_pengajuan_discount&act=hapuspengajuan&id=$data[no_pengajuan]' onClick='return warning();' data-placement='top' data-toggle='tooltip' data-original-title='Hapus Pengajuan $data[no_pengajuan]'><i class='fa fa-trash'></i> HAPUS</a>"; 
    									}
    									if($tombol=="supervisor") {
    									    if ($data['proses_approve'] == "N"){
    									       $tombol="<!--a class='btn btn-xs btn-primary' href='media_showroom.php?module=sub_transaksi_pengajuan_discount&act=ubahpengajuan&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Ubah Pengajuan $data[no_pengajuan]'><i class='fa fa-edit'></i> UBAH</a-->
    										            <!--a class='btn btn-xs btn-warning' href='modul/laporan_pengajuan_discount_2.php?id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pengajuan $data[no_pengajuan]' target='_blank'><i class='fa fa-print'></i> CETAK</a-->"; 
    												
    									   }else {
											   if ($no_spk == ""){
												   if ($data['status_approved'] == "Y"){
												 	   $tombol="<a class='btn btn-xs btn-info' href='media_showroom.php?module=sub_transaksi_input_discount&act=tambahdetail&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Setujui Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> ISI NOMOR SPK</a>"; 
												   }else {
													   $tombol = "<a class='btn btn-xs btn-primary' href='media_showroom.php?module=sub_transaksi_input_discount&act=lihat_approve&id=$data[no_pengajuan]' target ='_BLANK' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>"  ;
												   }
												     
											   
											   }else {
													$tombol = "<a class='btn btn-xs btn-primary' href='media_showroom.php?module=sub_transaksi_input_discount&act=lihat_approve&id=$data[no_pengajuan]' target ='_BLANK' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>"  ;
											   }
										   }   
    									}
    									if($tombol=="salesadm") {
    									    if ($data['status_approved'] == "Y"){
    									        $tombol="<a class='btn btn-xs btn-warning' href='modul/laporan_pengajuan_discount_2.php?id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pengajuan $data[no_pengajuan]' target='_blank'><i class='fa fa-print'></i> CETAK</a>"; 
    									    }
    									    else {$tombol="";}
    									   }
    									if($tombol=="MNGR") {
    								        if ($data['status_approved'] == "N" and $data['status_approved'] != "AL"){
    											$tombol="$plafondisc
    									     	         <!--a class='btn btn-xs btn-warning' href='modul/laporan_pengajuan_discount_2.php?id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pengajuan $data[no_pengajuan]' target='_blank'><i class='fa fa-print'></i> CETAK</a-->
    												    ";   
    									    }else {
    										    //$tombol = "<!--a class='btn btn-xs btn-warning' href='modul/laporan_pengajuan_discount_2.php?id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pengajuan $data[no_pengajuan]' target='_blank'><i class='fa fa-print'></i> CETAK</a-->";
    										      $tombol = "<a class='btn btn-xs btn-primary' href='media_showroom.php?module=sub_transaksi_pengajuan_discount&act=lihat_approve&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>"  ;
    										      }  
    										}
						                if($tombol=="DRKSI") {
						                    if ($data['status_approved'] == "AL"){
    									    	//$tombol="$direkturapprove <a class='btn btn-xs btn-warning' href='modul/laporan_pengajuan_discount_2.php?id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pengajuan $data[no_pengajuan]' target='_blank'><i class='fa fa-print'></i> CETAK</a>
    											$tombol="$direkturapprove";
						                    }else {
    						                        if ($data['status_approved'] == "Y"){
        										        //$tombol = "<a class='btn btn-xs btn-warning' href='modul/laporan_pengajuan_discount_2.php?id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Cetak Pengajuan $data[no_pengajuan]' target='_blank'><i class='fa fa-print'></i> CETAK</a>";
        											    $tombol = "<a class='btn btn-xs btn-primary' href='media_showroom.php?module=sub_transaksi_pengajuan_discount&act=lihat_approve&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>"  ;
    						                            }
    						                        else {
    						                            if ($proses_approve == "Y"){
    						                                $tombol = "<a class='btn btn-xs btn-primary' href='media_showroom.php?module=sub_transaksi_pengajuan_discount&act=lihat_approve&id=$data[no_pengajuan]' data-placement='top' data-toggle='tooltip' data-original-title='Lihat Detail Pengajuan $data[no_pengajuan]'><i class='fa fa-book'></i> LIHAT DETAIL DATA</a>"  ;
    						                            }
    						                            else
    						                            {
    						                                $tombol = "";
    						                            }
    						                        }
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
    										}
    										if($statusaprrov=="N") {
    											$statusaprrov="<span class='label label-danger'>Tidak Disetujui</span>"; 
    											}
    										if($statusaprrov=="AL") {
    											$statusaprrov="<span class='label label-warning'>Menunggu Persetujuan</span>"; 
    											}
    										
						
											?>
						
												<tr>
												<td width='1%'><?php echo $no;?></td>
												<td width='30%'>
												    <?php 
												    echo '
												    <b>No Pengajuan :</b> '.$data['no_pengajuan'].'<br />
												    <b>No SPK :</b> '.$data['no_spk'].'<br />
												    <b>Nama Sales :</b> '.$data['nama_sales'].'<br />
												    <b>Nama Customer :</b> '.$data['nama_customer'].'<br />
												    <b>('.$data['tipe_mobil'] .' - '. $data['nama_tipe'].' - '.$data['nama_warna'].')<br /> Harga OTR :</b> '.$harga_otr.
												    '<br /><b>Pemohon : </b>'.$data[pemohon].
												    '<br /><b>Diskon Plafon : </b>'.$discount_unit.
												    '</br> <b>Pengajuan Diskon :</b> '.$total_discount;
												    
												    
												     if($statapp=="Y")
												     {echo '<br /><b>Di Setujui Oleh : </b>'.$data[user_approve].'<br/><br />'.$proses_approve2.' '.$statusaprrov;
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
												    ?><br /><br />
												    <center>
												    <?php
												    echo $tombol;
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
	include "input_diskon/buat_pengajuan_input_diskon.php";
		
?>	

<?php
    break;
    case "hapuspengajuan":
    $sql 	= "delete from pengajuan_discount where no_pengajuan='$_GET[id]'";
    $query	= mysql_query($sql);
   
		header('location:../media_showroom.php?module=sub_transaksi_pengajuan_discount');

?>
		
<?php	
	break;
	case "ubahpengajuan":
	include "input_diskon/ubah_pengajuan_input_diskon.php";
	
?>				

<?php	
	break;
	case "tambahdetail":
	include "input_diskon/tambah_nospk.php";
	
?>	
				
<?php	
	break;
	case "approvepengajuan":
	
	include "input_diskon/approve_pengajuan_input_diskon.php";
	
?>
<?php	
	break;
	case "lihat_approve":
	
	include "input_diskon/lihat_approve_input_diskon.php";
	
?>

<?php	
	break;
	case "ajukanapprove":
	
	include "input_diskon/ajukan_approve_input_diskon.php";
	
?>
			
<?php	
	break;
	case "cetakpd":
	
	include "laporan_pengajuan_discount.php";

?>

				
				
				
<?php break;

}} ?>