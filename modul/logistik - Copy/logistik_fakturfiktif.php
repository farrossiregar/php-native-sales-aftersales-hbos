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
									<h1 class="mainTitle">Faktur Fiktif</h1>
									<span class="mainDescription">Daftar Nomor Rangka Fiktif</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">

                    
                    

                    <?php
                    //di proses jika sudah klik tombol cari
                    if(isset($_POST['cari'])){
                    	
                    	//menangkap nilai form
                    	$tgl_awal=$_POST['tgl_awal'];
                    	$tgl_akhir=$_POST['tgl_akhir'];
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
                        
                                <div class="table-header"><i><b>Informasi User Booking: </b> dari tanggal <b><?php echo $_POST['tgl_awal']?></b> sampai dengan tanggal <b><?php echo $_POST['tgl_akhir']?></b></i></div><br />
                                
                        <?php
                    		
                    		$query=mysql_query("$kueri and ml.tgl >= '$tgl_awal' and ml.tgl <= '$tgl_akhir'");
                    		
                    	}
					}
                    	?>
                    
						<?php 
							$query=mysql_query("select dm.norangka,ff.norangka as norangka_fiktif from faktur_fiktif  ff left join data_mobil dm on dm.norangka = ff.norangka");
						?>
                        
                        <table id="sample_1" class="table table-striped table-bordered table-hover table-full-width">
                    		<thead>
                    			<tr>
                    				<th>No.</th>
                    				<th>Norangka</th>
                    				
                    			</tr>
                    		</thead>
                            <?php
                            	//untuk penomoran data
                            	$no=0;
                            	
                            	//menampilkan data
                            	while($row=mysql_fetch_array($query)){                    	
                            	
    									
    							
                            	$no++;
								if ($row[norangka]!=""){
                            ?>
                                <tr>
                                	<td><?php echo $no ?>.</td>
                                	<td align = 'center'><?php echo $row[norangka_fiktif]; ?>
                            			
                            		</td>
                                	
                                </tr>
                                <?php
									}
                            	}
                            	?>

     
                        </table>
                           </div>
                     </div>
                </div>
            
            </div>
        </div>
<?php
}
?>
<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
        