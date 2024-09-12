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
		include "config/fungsi_thumb.php";
		switch($_GET[act]){
		//tampilkan data
		default:
?>


					<?php
					if(count($_POST['ubah'])) {
                            
                        // Cek username di database
                        $data=mysql_query("select * from target_sales where bulan='$_POST[bulan]'");
					    $sql = $data;
						$nomor = 0;
						while($data = mysql_fetch_array($sql)){
						$nomor += 1; 
                        $bulan = $_POST['bulan'];
                        $kode_spv = $_POST['kode_spv'.$nomor];
                        $kode_sales = $_POST['kode_sales'.$nomor];
                        $target_unit = $_POST['target_unit'.$nomor];
                        $target_point = $_POST['target_point'.$nomor];
                        
                        
                        // Kalau username valid, inputkan data ke tabel users
                        
                          mysql_unbuffered_query("update target_sales set target_unit=$target_unit, target_point=$target_point where kode_spv='$kode_spv' and kode_sales='$kode_sales' and bulan='$bulan'");
						
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
									<h1 class="mainTitle">Data Target Salesman</h1>
									<span class="mainDescription">Input Data Target Salesman</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroomnbvnmbvnb</span>
									</li>
									<li>
										<span>Master Data Showroom</span>
									</li>
									<li class="active">
										<span>Input Target Salesman</span>
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
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_master_target_penjualan_salesman&act=buat';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Input Target Salesman Perbulan</span>
											</button>	
										</p>
										<hr>
										<?php
		                                }
										?>
									
									<?php echo(isset ($msg) ? $msg : ''); ?>
									
									<form action="#" method="post" name="postform">
									<div class="form-group">
									    
									    <?php $isi_lama = $_GET['bulan']; 
										
										?>
                                    <!--label class="control-label">
										Pilih Periode :
									</label-->
                                    
                                    <select name="bulan" id="bulan">
									<option value='' selected disabled class="blink">&#9654; PILIH PERIODE &#9664;</option>
                                    <?php
                                    $query = "SELECT DISTINCT bulan FROM target_sales";
                                    $hasil = mysql_query($query);
                                    while ($data = mysql_fetch_array($hasil))
                                    {
									if($_POST[bulan]==$data[bulan]){
										if(!count($_POST['ubah'])){
										echo "<option value='".$data['bulan']."' selected>".$data['bulan']."</option>";
										}else{
										echo "<option value='".$data['bulan']."'>".$data['bulan']."</option>";
										}
										
									}
									else{
										echo "<option value='".$data['bulan']."'>".$data['bulan']."</option>";
									}
                                    }
                                    ?>
                                    </select>
									
									<select name="supervisor" id="supervisor">
									<option value='' selected disabled class="blink">&#9654; PILIH SUPERVISOR &#9664;</option>
                                    <?php
                                    $query = "SELECT DISTINCT nama_supervisor,kode_supervisor FROM supervisor";
                                    $hasil = mysql_query($query);
                                    while ($data = mysql_fetch_array($hasil))
                                    {
									if($_POST[supervisor]==$data[kode_supervisor]){
										echo "<option value='".$data['kode_supervisor']."' selected>".$data['nama_supervisor']."</option>";
									}
									else{
										echo "<option value='".$data['kode_supervisor']."'>".$data['nama_supervisor']."</option>";
									}
                                    }
                                    ?>
                                    </select>
									
									</div>
									
									<div class="form-group">
									<!--label class="control-label">
										Pilih Supervisor :
									</label-->
                                    
                                    
                                    </div>
                                    
                                    <div class="form-group">
                                    <button type="submit" name="cari" class="btn btn-white btn-info btn-bold">Tampilkan Data</button>
									</div>
                                    </form>
									
									<?php
                    //di proses jika sudah klik tombol cari
                    if(isset($_POST['cari'])){
                    	
                    	//menangkap nilai form
                    	$bulan=$_POST['bulan'];
						$supervisor=$_POST['supervisor'];
                    	$kueri="
                    		
                    		SELECT * FROM target_sales
                    		
                    		";
                    	if (empty($bulan)){
                    		//jika tidak menginput apa2
                    		$query=mysql_query("$kueri");
                    		
                    		
                    	}else{
                    		
                    		?>
                        
                                <div class="table-header blink"><font color="red"><i><b>Target Periode: <?php echo $_POST['bulan']?> dengan Supervisor: <?php echo $_POST['supervisor']?></b></i></font></div><br />
                                
                        <?php
                    		
                    		$query=mysql_query("$kueri where bulan='$bulan' and kode_spv='$supervisor'");
                    		
                    	}
                    	
                    	?>
						
						
						<form method="post" action="" name="tabel">
                        <table class="table table-bordered table-hover" id="sample-table-1">
                    		<thead>
                    			<tr>
                    				<th>No.</th>
                    				<th>Nama Supervisor</th>
                    				<th>Nama Sales</th>
                    				<th>Grade</th>
                    				<th>Target Unit</th>
                    				<th>Target Point</th>
									
                    			</tr>
                    		</thead>
                            <?php
                            	//untuk penomoran data
                            	$no=0;
                            	$nomor = 0;
                            	//menampilkan data
                            	while($row=mysql_fetch_array($query)){
								$nomor += 1;
                            	$no++;
                            ?>
                                <tr>
                                	<td><?php echo $no ?>.</td>
                                	<td align = 'center'>
										<input type="hidden" name="<?php echo 'kode_spv'.$nomor; ?>" value="<?php echo $row['kode_spv'];?>" />
                            			<?php echo $row['nama_spv'];?>
                            		</td>
                                	<td align = 'center'>
										<input type="hidden" name="<?php echo 'kode_sales'.$nomor; ?>" value="<?php echo $row['kode_sales'];?>" />
                            			<?php echo $row['nama_sales'];?>
                            		</td>
									<td align = 'center'>
                            			<?php echo $row['grade'];?>
                            		</td>
									<td>
                                	    <input type="text" value="<?php echo $row['target_unit'];?>" name="<?php echo 'target_unit'.$nomor; ?>" id="target"></input>
                            		</td>
									<td>
                                	    <input type="text" value="<?php echo $row['target_point'];?>" name="<?php echo 'target_point'.$nomor; ?>" id="target"></input>
                            		</td>
                                </tr>
								
                                <?php
                            	}
                            	?>
									<input type="hidden" name="bulan" id="bulan" value="<?php echo $_POST['bulan'];?>" />		
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
	include "input_target_salesman.php";
		
?>

<?php 
	break;
	case "ubahtarget":
	//echo 'Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek'.$_POST[model1].$_POST[bulan];
	if(count($_POST)) {
                            
                        // Cek username di database
                        $data=mysql_query("select * from target_marketing69 where bulan='$_POST[bulan]'");
					    $sql = $data;
						$nomor = 0;
						while($data = mysql_fetch_array($sql)){
						$nomor += 1; 
                        $bulan = $_POST['bulan'];
                        $model = $_POST['model'.$nomor];
                        $target = $_POST['target'.$nomor];
                        
                        
                        // Kalau username valid, inputkan data ke tabel users
                        
                          mysql_unbuffered_query("update target_marketing69 set target=$target where model='$model' and bulan='$bulan'");
						
                        
                             
						}
					}
?>		

<script type="text/javascript">
alert('Berhasil di Ubah');
window.location = "media_showroom.php?module=sub_master_target_penjualan_per_model";
</script>;

<?php
    break;
    case "hapuspengajuan":
    $sql 	= "delete from pengajuan_discount where no_pengajuan='$_GET[id]'";
    $query	= mysql_query($sql);
   
		header('location:../media_showroom.php?module=sub_transaksi_pengajuan_discount');

?>			
				


				
				
				
<?php break;
}
} ?>