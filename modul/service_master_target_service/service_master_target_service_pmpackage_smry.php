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
                        $data=mysql_query("select * from target_pmpackage where bulan='$_POST[bulan]'");
					    $sql = $data;
						$number = 0;
						while($data = mysql_fetch_array($sql)){
						$number += 1; 
								$bulan = $_POST['bulan'];
								$group_type = $_POST['group_type'.$number];
								$type_item = $_POST['type_item'.$number];
								$oil = $_POST['oil'.$number];
								$periode = $_POST['periode'.$number];
								$point = $_POST['point'.$number];
								$nomor_id = $_POST['nomor_id'.$number];
								
								
                        // Kalau username valid, inputkan data ke tabel users
                        
                       mysql_unbuffered_query("update target_pmpackage set point='$point' where nomor_id='$nomor_id' and bulan='$bulan'");
					   
                      //mysql_unbuffered_query("update target_pmpackage set kode_item='$kode_item', nama_item='$nama_item', kode_kategori='$kode_kategori', 
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
									<h1 class="mainTitle">Data Target Pmpackage Summary</h1>
									<span class="mainDescription">Input Target Pmpackage</span>
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
										    
										    ",$koneksi_showroom);
										    $cek_akses2 = mysql_fetch_array($cek_akses);
										    
										
										    if($cek_akses2['tambah_data'] == 'Y')
										    {
										
										?>
										
										<p class="progress-demo">
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=service_master_target_service_pmpackage_smry&act=buat';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Input Target Pmpackage Summary</span>
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
                                    $query = "SELECT DISTINCT bulan FROM target_pmpackage";
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
						$kueri="SELECT * FROM target_pmpackage";
                    	if (empty($bulan)){
                    		//jika tidak menginput apa2
                    		$query=mysql_query("$kueri");
                    		
                    		
                    	}else{
                    		
                    		?>
                        
                                <div class="table-header blink"><i><font color="red"><b>Target Periode: <?php echo $_POST['bulan']?></b></font></i></div><br />
                                
                        <?php
                    		
                    		$query=mysql_query("$kueri where bulan='$bulan'");
                    		
                    	}
                    	
                    	?>
						
						
						<form method="post" action="" name="tabel">
                        <table class="table table-bordered table-hover" id="sample-table-1">
                    		<thead>
                    			<tr>
                    				<td align='center'>No.</td>
                    				<th>Group</th>
                    				<th>Oil</th>
									<th>Type</th>
									<th>Periode</th>
									<th>Point</th>
									
                    			</tr>
                    		</thead>
                            <?php
                            	//untuk penomoran data
                            	$no=0;
                            	$number = 0;
                            	//menampilkan data
                            	while($row=mysql_fetch_array($query)){
								$number += 1;
                            	$no++;
                            ?>
                                <tr>
                                	<td align="center"><?php echo $no ?>.</td>
                                		<input type="hidden" name="<?php echo 'nomor_id'.$number; ?>" value="<?php echo $row['nomor_id'];?>" />
									<td align = 'center'>
										<input type="hidden" name="<?php echo 'group_type'.$number; ?>" value="<?php echo $row['group_type'];?>" />
                            			<?php echo $row['group_type'];?>
                            		</td>                                	
                                	<td align = 'center'>
										<input type="hidden" name="<?php echo 'oil'.$number; ?>" value="<?php echo $row['oil'];?>" />
                            			<?php echo $row['oil'];?>
                            		</td>  
									<td align = 'center'>
										<input type="hidden" name="<?php echo 'type_item'.$number; ?>" value="<?php echo $row['type_item'];?>" />
                            			<?php echo $row['type_item'];?>
                            		</td> 									
                                	<td align = 'center'>
										<input type="hidden" name="<?php echo 'periode'.$number; ?>" value="<?php echo $row['periode'];?>" />
                            			<?php echo $row['periode'];?>
                            		</td>
									<td align='center'>
                                	    <input type="text" onkeypress="return hanyaAngka(event)" value="<?php echo $row['point'];?>" name="<?php echo 'point'.$number; ?>" id="target"></input>
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
	include "input_target_pmpackage_summary.php";
		
?>

<?php 
	break;
	case "ubahtarget":
	if(count($_POST)) {
                            
                        // Cek username di databaseS
                        $data=mysql_query("select * from target_pmpackage where bulan='$_POST[bulan]'");
					    $sql = $data;
						$number = 0;
						while($data = mysql_fetch_array($sql)){
						$number += 1; 
                    	$bulan = $_POST['bulan'];
								$group_type = $_POST['group_type'.$number];
								$type_item = $_POST['type_item'.$number];
								$oil = $_POST['oil'.$number];
								$periode = $_POST['periode'.$number];
								$point = $_POST['point'.$number];
								$nomor = $_POST['nomor'];
								
								
                        // Kalau username valid, inputkan data ke tabel users
                        
                       mysql_unbuffered_query("update target_pmpackage set point='$point' where nomor='$nomor' and bulan='$bulan'");
					   
                        
						}
					}
?>		

<script type="text/javascript">
alert('Berhasil di Ubah');
window.location = "media_showroom.php?module=service_master_target_service_pmpackage_smry";
</script>;

<?php
    break;
    case "hapustarget":
    $sql 	= "delete from target_pmpackage where bulan ='$bulan'";
    $query	= mysql_query($sql);
   
		header('location:../media_showroom.php?module=service_master_target_service_pmpackage_smry');

?>			
				


				
				
				
<?php break;
}
} ?>