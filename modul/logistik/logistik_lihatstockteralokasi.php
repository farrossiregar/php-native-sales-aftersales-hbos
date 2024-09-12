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
		
//untuk menantukan tanggal awal dan tanggal akhir data di database
$min_tanggal=mysql_fetch_array(mysql_query("select min(waktu) as min_tgl from user_login"));
$max_tanggal=mysql_fetch_array(mysql_query("select max(waktu) as max_tgl from user_login"));
?>
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Stock Teralokasi</h1>
									<span class="mainDescription">Lihat Stock Teralokasi</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">

									<div class="row">
										<div class="col-md-3">								
											<div class="form-group">
												<form action="" method="GET" name="postform">
													<input type = "hidden" name = "module" value = "logistik_lihatstockteralokasi" />				
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											Tanggal Awal <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_awal);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
											<input class="form-control" type="text" placeholder="yyyy-mm-dd" name="tgl_awal" >
										
											Tanggal Akhir <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_akhir);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
											<input class="form-control" type="text" placeholder="yyyy-mm-dd" name="tgl_akhir">
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
                    

                    <?php
                    //di proses jika sudah klik tombol cari
					if(($_GET['tgl_awal'] != '') && ($_GET['tgl_akhir'] != '')){
                    	
                    	//menangkap nilai form
                    	$tgl_awal=$_GET['tgl_awal'];
                    	$tgl_akhir=$_GET['tgl_akhir'];
                    	$kueri="
                    		
                    		SELECT norangka,nomesin,harga_jual,tahun_buat,tglbeli,nopenjualan,tglmatching,kode_model,nama_model,kode_tipe,nama_tipe,kode_warna,nama_warna
						    ,kode_sales,nama_sales,kode_supervisor,nomatching,nofaktur,status
						    FROM data_mobil
						    
						    where nomatching!='' and nofaktur=''
                    		
                    		";
                    	if (empty($tgl_awal) and empty($tgl_akhir)){
                    		//jika tidak menginput apa2
                    		$query=mysql_query("$kueri");
                    		
                    	}else{
                    		
                    		?>
                        
                                <div class="table-header"><i><b>Informasi Teralokasi: </b> dari tanggal <b><?php echo $_GET['tgl_awal']?></b> sampai dengan tanggal <b><?php echo $_GET['tgl_akhir']?></b></i></div><br />
                                
                        <?php
                    		
                    		$query=mysql_query("$kueri and tglmatching >= '$tgl_awal' and tglmatching <= '$tgl_akhir'");
                    		
                    	}
                    	
                    	?>
						<?php
							$level = $_SESSION['leveluser'];
							
							$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ");
							$cek_akses2 = mysql_fetch_array($cek_akses);
								if($cek_akses2['ekspor'] == 'Y')
								{
						?>
						<div class="progress-demo">
							<a href='modul/export_teralokasi.php?tgl_awal=<?php echo $_GET['tgl_awal'].'&tgl_akhir='.$_GET['tgl_akhir']; ?>'>
								<button class="btn btn-wide btn-primary ladda-button" data-style="expand-right" >
									<span class="ladda-label"> Export Data ke Excel</span>
								</button>
							</a>
						</div>
						<?php
							}
						?>
						</br>
                        
                        <table id="sample_1" class="table table-striped table-bordered table-hover table-full-width">
                    		<thead>
                    			<tr>
                    				<th>No.</th>
                    				<th>Tipe</th>
                    				<th>Keterangan</th>
                    			</tr>
                    		</thead>
                            <?php
                            	//untuk penomoran data
                            	$no=0;
                            	
                            	//menampilkan data
                            	while($row=mysql_fetch_array($query)){
                            	$no++;
                            ?>
                                <tr>
                                	<td><?php echo $no ?>.</td>
                                	<td align = 'center'>
                                	    <?php echo '<b>'.$row['nama_tipe'].'</b><br />'?>
                            			<?php echo 'Teralokasi : '. $row['kode_sales'].' ('.$row['nama_sales'].') - '.$row['kode_supervisor'];?><br />
                            			<?php 
											$umurmatching = (abs(strtotime(date('Y-m-d')) - strtotime($row[tglmatching])))/86400;
											if ($umurmatching > 7)
											{
											    echo '<div style=color:red;>Tgl Teralokasi : '.(date("d-m-Y",strtotime($row[tglmatching]))).'<br /><b class="blink">Sudah lewat dari tujuh hari</b></div>';
											}
											else
											{
											    echo '<div style=color:darkorchid;>Tgl Teralokasi : '.(date("d-m-Y",strtotime($row[tglmatching]))).'</div>';
											}
                            			?>
                            		</td>
                                	<td><?php 
                            			 echo 'No. Rangka : <b>'.$row['norangka'].'</b><br />';
                            			 echo 'No. Mesin : '.$row['nomesin'].'<br />';
                            			 echo 'Warna : <b>'.$row['nama_warna'].'</b><br />';
                            			 echo 'Tahun : '.$row['tahun_buat'].'<br />';
                            			?>
                            		</td>
                                </tr>
                                <?php
                            	}
                            	?>

     
                        </table>
                           </div>
                           <!--p><a href="export_teralokasi.php"><button>Export Data ke Excel</button></a></p-->
							
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
}
?>
<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
        