<?php
session_start();
$level = $_SESSION['leveluser'];
										    
$cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 

");
$cek_akses2 = mysql_fetch_array($cek_akses);

										
if($cek_akses2['akses'] != 'Y'){
// if ($_SESSION['leveluser'] == 'supervisor'){
  
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
}else{
		
$min_tanggal=mysql_fetch_array(mysql_query("select min(waktu) as min_tgl from user_login"));
$max_tanggal=mysql_fetch_array(mysql_query("select max(waktu) as max_tgl from user_login"));
?>


				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">User Active</h1>
									<span class="mainDescription">User Login Active</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">

                    <div class="form-group">
                    <form action="" method="post" name="postform">
                    
                        Tanggal Awal <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_awal);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
                        <input type="text" name="tgl_awal" size="15" placeholder="yyyy-mm-dd" class = "form-control"/>
                        				
                        Tanggal Akhir <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_akhir);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>
                        <input type="text" name="tgl_akhir" size="15" placeholder="yyyy-mm-dd" class = "form-control"/>
                        				
                    </div>
                    
                    <div class="form-group">
                    <button type="submit" name="cari" class="btn btn-white btn-info btn-bold">Tampilkan Data</button>
                    </form>
                    </div>
                    

                    <?php
                    //di proses jika sudah klik tombol cari
                    if(isset($_POST['cari'])){
                    	
                    	//menangkap nilai form
                    	$tgl_awal=$_POST['tgl_awal'];
                    	$tgl_akhir=$_POST['tgl_akhir'];
                    	if (empty($tgl_awal) and empty($tgl_akhir)){
                    		//jika tidak menginput apa2
                    		$query=mysql_query("select * from user_login order by waktu desc");
                    		
                    	}else{
                    		
                    		?>
                        
                                <div class="table-header"><i><b>Informasi User Login: </b> dari tanggal <b><?php echo $_POST['tgl_awal']?></b> sampai dengan tanggal <b><?php echo $_POST['tgl_akhir']?></b></i></div><br />
                                
                        <?php
                    		
                    		$query=mysql_query("select * from user_login where date(waktu) >= '$tgl_awal' and date(waktu) <= '$tgl_akhir'");
                    		
                    	}
                    	
                    	?>
                    
                    
                        
                        <table id="sample_1" class="table table-striped table-bordered table-hover table-full-width">
                    		<thead>
                    			<tr>
                    				<th>No.</th>
                    				<th>Username</th>
                    				<th>Nama</th>
                    				<th>Waktu Login</th>
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
                                	<td><?php echo $row['username']; ?></td>
                                    <td><?php $tampilnama	=mysql_query("SELECT * FROM users WHERE username='$row[username]'");
                            				  $nama	        =mysql_fetch_array($tampilnama);
                            			 echo $nama['nama_lengkap']
                            			?>
                            		</td>
                            		<td><?php echo $row['waktu'];?></td> 
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
        