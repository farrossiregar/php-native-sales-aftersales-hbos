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
		
		switch($_GET[act]){
		//tampilkan data
		default:
		
		include "config/koneksi_sqlserver.php";
?>	
		
				
			<?php
				$judul_header = mysql_query("select * from menu where module = '$_GET[module]'");
				$hasil_judul_header = mysql_fetch_array($judul_header);
			?>
			<div class="main-content">
				<div class="wrap-content container" id="container">
					<!-- start: PAGE TITLE -->
					<section id="page-title">
						<div class="row">
							<div class="col-sm-8">
								<h1 class="mainTitle">Data <?php echo $hasil_judul_header['nama_menu']; ?></h1>
								<!--span class="mainDescription">Tambah <?php echo $hasil_judul_header['nama_menu']; ?> pada Database</span-->
							</div>
							
						</div>
					</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
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
										<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=checklist_showroom&act=buat';>
											<span class="ladda-label"><i class="fa fa-plus"></i> Input Data Checklist Pameran</span>
										</button>	
									</p>
									<hr>
									<?php
									}
									?>
									
									<form action="" method="GET" name="postform">
										<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">
												Pilih Periode <span class="symbol required"></span>
											</label>
										<input type="hidden" name="module" value="logistik_daftar_do" />					 
											<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
												<input class="form-control" type="text" id="tgl_awal" value = "<?php echo $_GET[tgl_awal]; ?>" name="tgl_awal" readonly>
													<span class="input-group-addon bg-primary">s/d</span>
												<input class="form-control" type="text" id="tgl_akhir" value = "<?php echo $_GET[tgl_akhir]; ?>" name="tgl_akhir" readonly>
											</div>
										</div>
										</div>
										
										<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-white btn-info btn-bold">Tampilkan Data</button>
										</div>
										</div>
										
										
										
										
										
										
										
										
															
														
										
										
										
										
										
									</form>        
											
									<?php
									//di proses jika sudah klik tombol cari
									if(count($_GET['tgl_awal'])){
								
									//menangkap nilai form
									$tgl_awal=$_GET['tgl_awal'];
									$tgl_akhir=$_GET['tgl_akhir'];
									if (empty($tgl_awal) and empty($tgl_akhir)){
									//jika tidak menginput apa2
									//$query=mysql_query("select * from checklist_pameran order by periode_pameran_awal desc");
									
									}else
									{
									
									?>
										<div class="col-md-12">
											<div class="form-group">
											<div class="table-header"><i><b>Data DO: </b> dari Periode <b><?php echo $_GET['tgl_awal']?></b> sampai dengan periode <b><?php echo $_GET['tgl_akhir']?></b></i></div><br />
											</div>
										</div>
									<?php
									
										//$query=mysql_query("select * from checklist_pameran where (date(periode_pameran_awal) <= '$tgl_awal' and date(periode_pameran_awal) >= '$tgl_akhir')  or (date(periode_pameran_akhir) <= '$tgl_akhir' and date(periode_pameran_akhir) >= '$tgl_awal')");
										
										$query = "select * from vw_gudangout where convert(date, TanggalGO, 105) >= '$tgl_awal' and convert(date, TanggalGO, 105) <= '$tgl_akhir' ";
										$query_result = sqlsrv_query($conn, $query);
										//while($data = sqlsrv_fetch_array($asuransi_result)){
									}
									?>
							
									<!--table id="sample_1" class="table table-striped table-bordered table-hover table-full-width"-->
									<div class="col-md-12">
									<table id="sample_1" class = "table table-striped table-hover" >
										<thead>
											<tr>
												<th width = "5%">No.</th>
												<th>Keterangan</th>
											</tr>
										</thead>
									<?php
										//untuk penomoran data
										$no=0;
										$tombollogin = $_SESSION['leveluser'];
										
										
										//menampilkan data
										while($data = sqlsrv_fetch_array($query_result)){
											
										$tombol=$tombollogin;
											//if($tombol=="admin") {
											   $tombol="
													 <a class='btn btn-xs btn-warning' href='media_showroom.php?module=checklist_checklist_pameran&act=lihat&id=$row[no_pameran]' data-toggle='tooltip' data-original-title='Cetak Pengajuan $row[no_pameran]' ><i class='fa fa-print'></i> LIHAT</a>
													 "; 
												
											
										$no++;
									?>
										<tr>
											<td><?php echo $no ?>.</td>
											<td><?php echo "Tipe : ".$data['Tipe']." </br> Warna : $data[WarnaKendaraan] </br>";
														echo "Metode Bayar : $data[JnsJual] </br> Sales : ".$data['Sales']
											
												?>

															
															
											
											</td>
										</tr>
										
										<?php
										}
										?>
									</table>
						
								</div>
                           </div>
                     </div>
                </div>
            
            </div>
        </div>


<?php
}
else{
	

?>
                        </div>
                     </div>
                </div>
            </div>
        </div>
<?php
}
 
	

	break;
	
		}	
		}
?>

				