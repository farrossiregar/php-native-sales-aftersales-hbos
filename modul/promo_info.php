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
						document.getElementById("tampil_data").click();
					}
				</script>
				
				
				
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE >
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Input Discount</h1>
									<span class="mainDescription">Input Discount SPK</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>ShowShowroom</span>
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
										    $level = $_SESSION['leveluser'];
										    
										    $cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
										    left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 
										    
										    ");
										    $cek_akses2 = mysql_fetch_array($cek_akses);
										    
										
										    if($cek_akses2['tambah_data'] == 'Y')
										    {
										
										?>
										
										<p class="progress-demo">
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=info_promo_lihat&act=buat';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Buat Informasi</span>
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
										<input type = "hidden" name = "module" value = "info_promo_lihat" />				
                                    </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label class="control-label">
										<font>Pilih Range Tanggal <span class="symbol required"></span></font>
									</label>
									<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
										<input class="form-control" type="text" placeholder ="Pilih Tanggal Berlaku" name="tgl_awal" id="tgl_awal" value = "<?php echo $_GET[tgl_awal] ?>">
										
										<span class="input-group-addon bg-primary">s/d</span>
										<input class="form-control" type="text" placeholder ="Pilih Tanggal Berakhir" name="tgl_akhir" id="tgl_akhir" value = "<?php echo $_GET[tgl_akhir] ?>">
									</div>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-3"><br/>
                                    <div class="form-group">
                                    <button type="submit" id="tampil_data"  class="btn btn-white btn-info btn-bold">Tampilkan Data</button>									
									</br>	
                                    </form>
                                    </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
								<?php
									
									if(($_GET['tgl_awal'] != '') && ($_GET['tgl_akhir'] != '')){
										if(strtoupper($_SESSION['leveluser']) == 'SUPERVISOR'){
											$qry=mysql_query("select * from informasi where date(tanggal)>='$_GET[tgl_awal]' AND date(tanggal)<='$_GET[tgl_akhir]' AND kode_spv='$_SESSION[kode_spv]'order by tanggal asc");
										}else{
											$qry=mysql_query("select * from informasi where date(tanggal)>='$_GET[tgl_awal]' AND date(tanggal)<='$_GET[tgl_akhir]' order by tanggal asc");
										}	
											
								?>
							
									<div class="table-header"><i><b>Pencarian data Informasi <?php echo $_GET[tgl_awal] ?> Sampai <?php echo $_GET[tgl_akhir] ?></b></i></div><br />
						
                        <table id="sample_2" class="table table-striped table-bordered table-hover table-full-width">
                    		<thead>
                    			<tr>
									<th>No.</th>
									<th>Judul</th>
									<th>Tanggal Input</th>
									<th>Isi Informasi</th>
									<th>Kode Supervisor</th>
									<th>Tanggal Berlaku</th>
									<th>Tanggal Berakhir</th>
								</tr>
                    		</thead>
                            <tbody>
											
							<?php
									$no = 0;
									while($dt = mysql_fetch_array($qry)){
									$no++;
							?>
							<?php
								$input = strtotime($dt[tanggal]);
								$awal = $_GET['tgl_awal'];
								$akhir = $_GET['tgl_akhir'];
							?>
						
								<tr>
									<td width='1%'><?php echo $no;?></td>
									<td><?php echo $dt['judul'];?></td>
									<td><?php echo $dt['tanggal'];?></td>
									<td><?php echo $dt['isi_informasi'];?></td>
									<td><?php echo $dt['kode_spv']; ?></td>
									<td><?php echo $dt['tgl_awal'];?></td>
									<td><?php echo $dt['tgl_akhir'];?></td>
								</tr>
							<?php
								}
							?>
											
							</tbody>
                        </table>
						
						<!--a href='modul/ekspor?tgl_awal=.php'-->
						<!--a href='modul/ekspor.php?$dt['tgl_awal']'-->
						<a href='modul/ekspor.php?tgl_awal=<?php echo $awal.'&tgl_akhir='.$akhir; ?>'>
						
							<div class="progress-demo">
								<button class="btn btn-wide btn-primary ladda-button" data-style="expand-right">
									<span class="ladda-label"> Export Data ke Excel</span>
								</button>
							</div>
						</a></br>
						
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
	include "input_promo/buat_promo.php";
		
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
}
}
 ?>