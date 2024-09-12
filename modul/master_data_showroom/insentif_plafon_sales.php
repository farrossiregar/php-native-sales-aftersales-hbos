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

				<?php
					if(count($_POST['ubah'])) {
                            
                        // Cek username di database
                        $data=mysql_query("select * from target_marketing where tahun_buat='$_POST[tahun_buat]'");
					    $sql = $data;
						$nomor = 0;
						while($data = mysql_fetch_array($sql)){
						$nomor += 1; 
                        $tahun_buat = $_POST['tahun_buat'];
                        $model = $_POST['model'.$nomor];
                        $target = $_POST['target'.$nomor];
                        
                        
                        // Kalau username valid, inputkan data ke tabel users
                        
                          mysql_unbuffered_query("update target_marketing set target=$target where model='$model' and tahun_buat='$tahun_buat'");
						
						  $msg = "
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil Mengubah Target.</div>";
                             
						}
					}
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
									<h1 class="mainTitle">Data Target Permodel</h1>
									<span class="mainDescription">Input Data Target Permodel</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li>
										<span>Master Data Showroom</span>
									</li>
									<li class="active">
										<span>Pengajuan Discount</span>
									</li>
								</ol>
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
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_master_target_insentif_plafon&act=buat';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Input Target Perbulan</span>
											</button>	
										</p>
										<hr>
										<?php
		                                }
										?>
									
									
									<div class="form-group">
									    
									    <?php $isi_tahun = $_GET['tahun_buat']; 
										
										?>
										
									<?php echo(isset ($msg) ? $msg : ''); ?>
									 
                                    <form action="#" method="post" name="postform">
                                    
                                    <label class="control-label">
											Pilih Tahun Buat <span class="symbol required"></span>
									</label>
                                    
                                    <select name="tahun_buat" id="tahun_buat">
									<option value="">--PILIH TAHUN BUAT--</option>
                                    <?php
                                    $query = "SELECT DISTINCT tahun_buat FROM incentive_plafon";
                                    $hasil = mysql_query($query);
                                    while ($data = mysql_fetch_array($hasil))
                                    {
									if($_POST[tahun_buat]==$data[tahun_buat]){
										echo "<option value='".$data['tahun_buat']."' selected>".$data['tahun_buat']."</option>";
									}
									else{
										echo "<option value='".$data['tahun_buat']."'>".$data['tahun_buat']."</option>";
									}
                                    }
                                    ?>
                                    </select>
									
									 <label class="control-label">
											Pilih Tahun Buat <span class="symbol required"></span>
									</label>
                                    
                                    <select name="tgl_plafon_awal" id="tgl_plafon_awal">
									<option value="">--PILIH TANGGAL AWAL--</option>
                                    <?php
                                    $query = "SELECT DISTINCT tgl_plafon_awal FROM incentive_plafon";
                                    $hasil = mysql_query($query);
                                    while ($doto = mysql_fetch_array($hasil))
                                    {
									if($_POST[tgl_plafon_awal]==$doto[tgl_plafon_awal]){
										echo "<option value='".$doto['tgl_plafon_awal']."' selected>".$doto['tgl_plafon_awal']."</option>";
									}
									else{
										echo "<option value='".$doto['tgl_plafon_awal']."'>".$doto['tgl_plafon_awal']."</option>";
									}
                                    }
                                    ?>
                                    </select>
                                        				
                                    </div>
									
									
                                    <div class="form-group">
                                    <button type="submit" name="cari" class="btn btn-white btn-info btn-bold">Tampilkan Data</button>
									</div>
                                    </form>
                                    
									
									<?php
                    //di proses jika sudah klik tombol cari
                    if(isset($_POST['cari'])){
                    	
                    	//menangkap nilai form
                    	$tahun_buat=$_POST['tahun_buat'];
						$tgl_plafon_awal=$_POST['tgl_plafon_awal'];
                    	$kueri="
                    		
                    		SELECT * FROM incentive_plafon
                    		
                    		";
                    	if (empty($tahun_buat)){
                    		//jika tidak menginput apa2
                    		$query=mysql_query("$kueri");
                    		
                    		
                    	}else{
                    		
                    		?>
                        
                                <div class="table-header"><i><b>Target Periode: <?php echo $_POST['tahun_buat']?></b></i></div><br />
                                
                        <?php
                    		
                    		$query=mysql_query("$kueri where tahun_buat='$tahun_buat' and tgl_plafon_awal='$tgl_plafon_awal'");
                    		
                    	}
                    	
                    	?>
						
						<form method="post" action="" name="tabel">
                        <table class="table table-bordered table-hover" id="sample-table-1">
						<tbody>
                    		<thead>
                    			<tr>
                    				<th>No.</th>
                    				<th>Nama Mobil</th>
                    				<th>Jenis</th>
									<th>Kode Mobil</th>
									<th>Tahun</th>
									<th>Plafon Insentif</th>
									<th>Tgl Awal</th>
									<th>Tgl Akhir</th>
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
										<input type="hidden" name="<?php echo 'nama_mobil'.$nomor; ?>" value="<?php echo $row['nama_mobil'];?>" />
                            			<?php echo $row['nama_mobil'];?>
                            		</td>
									<td align = 'center'>
										<input type="hidden" name="<?php echo 'jenis'.$nomor; ?>" value="<?php echo $row['jenis'];?>" />
                            			<?php echo $row['jenis'];?>
                            		</td>
									<td align = 'center'>
										<input type="hidden" name="<?php echo 'kode'.$nomor; ?>" value="<?php echo $row['kode'];?>" />
                            			<?php echo $row['kode'];?>
                            		</td>
									<td>
                                	    <input type="text" value="<?php echo $row['tahun_buat'];?>" name="<?php echo 'tahun_buat'.$nomor; ?>" id="tahun_buat"></input>
                            		</td>
                                	<td>
                                	    <input type="text" value="<?php echo $row['plafon'];?>" name="<?php echo 'plafon'.$nomor; ?>" id="plafon"></input>
                            		</td>
									<td>
                                	    <input type="text" value="<?php echo $row['tgl_plafon_awal'];?>" name="<?php echo 'tgl_plafon_awal'.$nomor; ?>" id="tgl_plafon_awal"></input>
                            		</td>
									<td>
                                	    <input type="text" value="<?php echo $row['tgl_plafon_akhir'];?>" name="<?php echo 'tgl_plafon_akhir'.$nomor; ?>" id="tgl_plafon_akhir"></input>
                            		</td>
                                </tr>
								
                                <?php
                            	}
                            	?>
											
							</tbody>
                        </table>
							 <button type="submit" name="ubah" class="btn btn-white btn-info btn-bold">Ubah</button>
						
						</form>
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
	include "input_insentif_plafon_sales.php";
		
?>

<?php 
	break;
	case "ubahtarget":
	//echo 'Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek'.$_POST[model1].$_POST[tahun_buat];
	if(count($_POST)) {
                            
                        // Cek username di database
                        $data=mysql_query("select * from target_marketing69 where tahun_buat='$_POST[tahun_buat]'");
					    $sql = $data;
						$nomor = 0;
						while($data = mysql_fetch_array($sql)){
						$nomor += 1; 
                        $tahun_buat = $_POST['tahun_buat'];
                        $model = $_POST['model'.$nomor];
                        $target = $_POST['target'.$nomor];
                        
                        
                        // Kalau username valid, inputkan data ke tabel users
                        
                          mysql_unbuffered_query("update target_marketing69 set target=$target where model='$model' and tahun_buat='$tahun_buat'");
						
                        
                             
						}
					}
					
		


?>		

		
<?php break;
} 
}?>