<?php
session_start();
$level = $_SESSION['leveluser'];
										    
$cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 

");
$cek_akses2 = mysql_fetch_array($cek_akses);

										
if($cek_akses2['akses'] != 'Y'){
include "protected.php";

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
									<h1 class="mainTitle">Booking Stock</h1>
									<span class="mainDescription">Lihat Booking Stock</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">

                    <!--div class="form-group">
                    <form action="" method="post" name="postform">
                    
                        Tanggal Awal <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_awal);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
                        <input type="text" name="tgl_awal" style ="width:100%;" placeholder="yyyy-mm-dd" class = "form-control"/>
                        				
                        Tanggal Akhir <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_akhir);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
                        <input type="text" name="tgl_akhir" style ="width:100%;" placeholder="yyyy-mm-dd" class = "form-control"/>
                        				
                    </div>
					<div class="form-group">
                    <button type="submit" name="cari" class="btn btn-white btn-info btn-bold">Tampilkan Data</button>
                    </form>
                    </div-->
					
					<div class="row">
						<div class="col-md-3">								
							<div class="form-group">
								<form action="" method="GET" name="postform">
									<input type = "hidden" name = "module" value = "sub_transaksi_booking_stock" />				
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
					
					<?php
						//$menu=mysql_query("SELECT mn.*, ac.* FROM menu mn, akses ac WHERE mn.kode_menu = ac.kode_menu and ac.level='$_SESSION[leveluser]' and mn.level_menu = 'main_menu' order by mn.kode_menu asc");
						//while($sql=mysql_fetch_array($menu)){
						//if($sql['tambah_data'] != 'Y'){
					?>
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
						//}
						//}
					?>
                    
                    
                    

                    <?php
                    //di proses jika sudah klik tombol cari
                    if(($_GET['tgl_awal'] != '') && ($_GET['tgl_akhir'] != '')){
						
                    	//menangkap nilai form
                    	$tgl_awal=$_GET['tgl_awal'];
                    	$tgl_akhir=$_GET['tgl_akhir'];
                    	$kueri="
                    		
                    		SELECT norangka,nomesin,harga_jual,tahun_buat,tglbeli,nopenjualan,tglmatching,kode_model,nama_model,kode_tipe,nama_tipe,kode_warna,nama_warna
						    ,kode_sales,nama_sales,nomatching,nofaktur,status,ml.norangka_local,ml.nama_sales_local,ml.tgl,ml.nounique,ml.fix,ml.user,ml.no_spk_local,ml.nama_customer_local,ml.jenis_pembayaran_local
						    FROM data_mobil dm
						
						    left join matching_local ml on ml.norangka_local = dm.norangka 
						    
						    
						    where ml.aktif='Y' and dm.nomatching=''
                    		
                    		";
                    	if (empty($tgl_awal) and empty($tgl_akhir)){
                    		//jika tidak menginput apa2
                    		$query=mysql_query("$kueri");
                    		
                    		
                    	}else{
                    		
                    		?>
                        
                                <div class="table-header"><i><b>Informasi User Booking: </b> dari tanggal <b><?php echo $_GET['tgl_awal']?></b> sampai dengan tanggal <b><?php echo $_GET['tgl_akhir']?></b></i></div><br />
                                
                        <?php
                    		
                    		$query=mysql_query("$kueri and ml.tgl >= '$tgl_awal' and ml.tgl <= '$tgl_akhir'");
                    		
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
							<a href='modul/export_booking.php?tgl_awal=<?php echo $_GET['tgl_awal'].'&tgl_akhir='.$_GET['tgl_akhir']; ?>'>
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
                            	
                            	$jenispembayaranlocal = "$row[jenis_pembayaran_local]";
                            	$nospk_local = "$row[no_spk_local]";
                            	$namacustomer_local = "$row[nama_customer_local]";
                                $jenispembayaran=$jenispembayaranlocal;
    							    if($jenispembayaran=="1") {
    								    $jenispembayaran="Kredit"; 
    									}
    								if($jenispembayaran=="2") {
    									$jenispembayaran="Tunai"; 
    									}
    								if($jenispembayaran=="3") {
    								    $jenispembayaran="GSO"; 
    									}
    							$no_spklocal=$nospk_local;
    							    if($no_spklocal=="") {
    								    $no_spklocal="<b class='blink'>No SPK Belum di Input</b>"; 
    									}
    								if($no_spklocal=="-") {
    								    $no_spklocal="<b class='blink'>No SPK Belum di Input</b>"; 
    									}
    								if($no_spklocal!=="") {
    									$no_spklocal="($no_spklocal)"; 
    									}
    							$nama_customerlocal=$namacustomer_local;
    							    if($nama_customerlocal=="") {
    								    $nama_customerlocal="<b>Belum di Input</b>"; 
    									}
    								if($nama_customerlocal=="-") {
    								    $nama_customerlocal="<b>Belum di Input</b>"; 
    									}
    								if($nama_customerlocal!=="") {
    									$nama_customerlocal="<b>Customer : $nama_customerlocal</b>"; 
    									}
    									
    							
                            	$no++;
                            ?>
                                <tr>
                                	<td><?php echo $no ?>.</td>
                                	<td align = 'center'><b><?php $tampilmodel	=mysql_query("SELECT * FROM data_mobil WHERE norangka='$row[norangka_local]'");
                            				  $tampilkan    =mysql_fetch_array($tampilmodel);
                            			 echo $tampilkan['nama_tipe'];
                            			?></b><br />
                            			<?php $tampilnama	=mysql_query("SELECT * FROM users WHERE username='$row[user]'");
                            				  $nama	        =mysql_fetch_array($tampilnama);
                            			 echo 'Booked By : '. $nama['nama_lengkap'];
                            			?><br />
                            			<?php echo 'Booking For : '. $row['nama_sales_local'];?><br />
                            			<?php 
											if ($row['fix']=='N')
												{
													echo "<div style=color:darkorchid;>
													<b>". $no_spklocal."</b><br />
													". $nama_customerlocal."<br />
													Jenis Pembayaran : ". $jenispembayaran."<br />
													Tgl Booking : ".(date("d-m-Y",strtotime($row[tgl])))."</div>";
												}   
											else
												{
												    echo "<div style=color:#26a69a;>
												    <b>". $no_spklocal."</b><br />
													". $nama_customerlocal."<br />
													Jenis Pembayaran : ". $jenispembayaran."<br />
												    Tgl Booking : ".(date("d-m-Y",strtotime($row[tgl])))."</div>";
												}
                            			?>
                            		</td>
                                	<td><?php $tampilmodel	=mysql_query("SELECT * FROM data_mobil WHERE norangka='$row[norangka_local]'");
                            				  $tampilkan    =mysql_fetch_array($tampilmodel);
                            			 echo 'No. Rangka : '.$tampilkan['norangka'].'<br />';
                            			 echo 'No. Mesin : '.$tampilkan['nomesin'].'<br />';
                            			 echo 'Warna : <b>'.$tampilkan['nama_warna'].'</b><br />';
                            			 echo 'Tahun : '.$tampilkan['tahun_buat'].'<br />';
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
}
?>
<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
        