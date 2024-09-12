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
		include "config/koneksi_service.php";
		switch($_GET[act]){
		//tampilkan data
		default:
?>


					<?php
					if(count($_POST['ubah'])) {
                            
                        // Cek username di database
                        $data=mysql_query("select * from target_semua_sa where bulan='$_POST[bulan]' order by urutan asc");
					    $sql = $data;
						$nomor = 0;
						while($data = mysql_fetch_array($sql)){
						$nomor += 1; 
						$bulan = $_POST['bulan'];
						$target_unit = $_POST['target_unit'.$nomor];
						$target_point = $_POST['target_point'.$nomor];
						$kode_item = $_POST['kode_item'.$nomor];
						$nama_item = $_POST['nama_item'.$nomor];
						$kode_kategori = $_POST['kode_kategori'.$nomor];
						$nama_kategori = $_POST['nama_kategori'.$nomor];
						$program = $_POST['program'.$nomor];
						$urutan = $_POST['urutan'.$nomor];
						$fix_pembagi = $_POST['fix_pembagi'.$nomor];
					
                        // Kalau username valid, inputkan data ke tabel users
                        
                       mysql_unbuffered_query("update target_semua_sa set fix_pembagi='$fix_pembagi', nama_item='$nama_item', target_unit='$target_unit', target_point='$target_point' where urutan='$urutan' and bulan='$bulan'");
					   
                      //mysql_unbuffered_query("update target_semua_sa set kode_item='$kode_item', nama_item='$nama_item', kode_kategori='$kode_kategori', 
					  //nama_kategori='$nama_kategori', target_unit='$target_unit', target_point='$target_point' where id='$id' and bulan='$bulan'");
						
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
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Target SA</h1>
									<span class="mainDescription">Input Data Target Service Advisor</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li>
										<span>Master Data Showroom</span>
									</li>
									<li class="active">
										<span>Input Target Semua SA</span>
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
										    
										    ",$koneksi_showroom);
										    $cek_akses2 = mysql_fetch_array($cek_akses);
										    
										
										    if($cek_akses2['tambah_data'] == 'Y')
										    {
										
										?>
										
										<p class="progress-demo">
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=service_master_target_service_target_inc&act=buat';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Input Target Semua SA Perbulan</span>
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
                                    $query = "SELECT DISTINCT bulan FROM target_semua_sa";
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
						$kueri="SELECT * FROM target_semua_sa";
                    	if (empty($bulan)){
                    		//jika tidak menginput apa2
                    		$query=mysql_query("$kueri");
                    		
                    		
                    	}else{
                    		
                    		?>
                        
                                <div class="table-header blink"><i><font color="red"><b>Target Periode: <?php echo $_POST['bulan']?></b></font></i></div><br />
                                
                        <?php
                    		
                    		$query=mysql_query("$kueri where bulan='$bulan' order by urutan asc");
                    		
                    	}
                    	
                    	?>
						
						
						<form method="post" action="" name="tabel"> 
                        <table class="table table-bordered table-hover" id="sample-table-1">
                    		<thead>
                    			<tr>
                    				<td align='center'>No.</td>
                    				<th>Nama Kategori</th>
                    				<th>Program</th>
                    				<th>Fix Pembagi</th>
									<th>Nama Item</th>
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
									<input type="hidden" name="<?php echo 'kode_kategori'.$nomor; ?>" value="<?php echo $row['kode_kategori'];?>" />
									<input type="hidden" name="<?php echo 'kode_item'.$nomor; ?>" value="<?php echo $row['kode_item'];?>" />
									<td align="center"><?php echo $no ?>.</td>
                                		<input type="hidden" name="<?php echo 'id'.$nomor; ?>" value="<?php echo $row['id'];?>" />
                            		<td align = 'center'>
										<input type="hidden" name="<?php echo 'nama_kategori'.$nomor; ?>" value="<?php echo $row['nama_kategori'];?>" />
                            			<?php echo $row['nama_kategori'];?>
									</td>                                	
                                	<td align = 'center'>
										<input type="hidden" name="<?php echo 'program'.$nomor; ?>" value="<?php echo $row['program'];?>" />
                            			<?php echo $row['program'];?>
                            		</td>
									<td align = 'center'>
										<input type="text" value="<?php echo $row['fix_pembagi'];?>" name="<?php echo 'fix_pembagi'.$nomor; ?>" id="target"></input>
										<!--?php echo $row['fix_pembagi'];?-->
                            		</td>
									<td align = 'center'>
								    <input type="text" value="<?php echo $row['nama_item'];?>" name="<?php echo 'nama_item'.$nomor; ?>" id="target"></input>
                            		</td>
									<td>
                                	    <input type="text" value="<?php echo $row['target_unit'];?>" name="<?php echo 'target_unit'.$nomor; ?>" id="target"></input>
                            		</td>
									<td>
                                	    <input type="text" value="<?php echo $row['target_point'];?>" name="<?php echo 'target_point'.$nomor; ?>" id="target"></input>
                            		</td>
								
                                	    <input type="hidden" value="<?php echo $row['urutan'];?>" name="<?php echo 'urutan'.$nomor; ?>" id="target"></input>
                         
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
	include "input_target_semua_sa.php";
		
?>

<?php 
	break;
	case "ubahtarget":
	if(count($_POST)) {
                            
                        // Cek username di databaseS
                        $data=mysql_query("select * from target_semua_sa where bulan='$_POST[bulan]'");
					    $sql = $data;
						$nomor = 0;
						while($data = mysql_fetch_array($sql)){
						$nomor += 1; 
                        $bulan = $_POST['bulan'];
						$target_unit = $_POST['target_unit'.$nomor];
						$target_point = $_POST['target_point'.$nomor];
						$kode_item = $_POST['kode_item'.$nomor];
						$nama_item = $_POST['nama_item'.$nomor];
						$kode_kategori = $_POST['kode_kategori'.$nomor];
						$nama_kategori = $_POST['nama_kategori'.$nomor];
						$program = $_POST['program'.$nomor];	
						$urutan = $_POST['urutan'.$nomor];
						
                        // Kalau username valid, inputkan data ke tabel users
                        
                       
                      mysql_unbuffered_query("update target_semua_sa set target_unit='$target_unit', target_point='$target_point' where id='$id' and bulan='$bulan'");
							
                        
						}
					}
?>		

<script type="text/javascript">
alert('Berhasil di Ubah');
window.location = "media_showroom.php?module=service_master_target_service_target_inc";
</script>;

<?php
    break;
    case "hapustarget":
    $sql 	= "delete from target_semua_sa where bulan ='$bulan'";
    $query	= mysql_query($sql);
   
		header('location:../media_showroom.php?module=service_master_target_service_target_inc');

?>			
				


				
				
				
<?php break;
}
} ?>