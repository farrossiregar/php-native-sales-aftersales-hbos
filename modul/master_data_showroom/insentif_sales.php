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
		include "config/koneksi.php";
		switch($_GET[act]){
		//tampilkan data
		default:
?>


					<?php
					if(count($_POST['ubah'])) {
                            
                     /*   // Cek username di database
                         $data=mysql_query("select * from target_serviceadvisor_bp where tgl_faktur='$_POST[tgl_faktur]' and nama_bp = '$_POST[nama_bp]' order by urutan asc ");
					    $sql = $data;
						$nomor = 0;
						while($data = mysql_fetch_array($sql)){
						$nomor += 1; 
                        $tgl_faktur = $_POST['tgl_faktur'];
						$nama_bp = $_POST['nama_bp'];
						$kode_item = $_POST['kode_item'.$nomor];
                        $nama_item = $_POST['nama_item'.$nomor];
						$kode_kategori = $_POST['kode_kategori'.$nomor];
						$nama_kategori = $_POST['nama_kategori'.$nomor];
						$target_unit = $_POST['target_unit'.$nomor];
						$target_point = $_POST['target_point'.$nomor];
						$program = $_POST['program'.$nomor];
						$urutan = $_POST['urutan'.$nomor];
						$fix_pembagi = $_POST['fix_pembagi'.$nomor];
						
                        
                        // Kalau username valid, inputkan data ke tabel users
                        
						mysql_query("update target_serviceadvisor_bp set fix_pembagi='$fix_pembagi', nama_item='$nama_item', target_unit='$target_unit', target_point='$target_point' where kode_item='$kode_item' and nama_bp='$nama_bp' and tgl_faktur ='$tgl_faktur'");
						
						
                        
						
                          $msg = "
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil Mengubah Target.  $nama_sa</div>";
                             
						}*/
					}
				?>

               <script language="JavaScript">
					function warning() {
						return confirm('Anda yakin menghapus data ini?');
					}
				</script>
				<script>
					function getSales(){
						var kode_spv = $('#kode_supervisor').val();
					//	alert(kode_spv);
						$.ajax({
							method : "post",
							data : "kode_spv="+kode_spv,
							url : "modul/master_data_showroom/get_salesman.php",
							success : function(data){
								console.log(data);
								$('#kd_sales').html(data);
							}
						})
					}
				</script>


				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Insentif Sales</h1>
									<span class="mainDescription">Input Data Insentif Sales</span>
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
											<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_master_target_insentif_sales&act=buat';>
												<span class="ladda-label"><i class="fa fa-plus"></i> Input Data Insentif</span>
											</button>	
										</p>
										<hr>
										<?php
		                                }
										?>
									
									<?php echo(isset ($msg) ? $msg : ''); ?>
									
									<form action="#" method="post" name="postform">
									<div class="form-group">
									    
									  
                                    <!--label class="control-label">
										Pilih Periode :
									</label-->
                                    
                                    <select name="tgl_faktur" id="tgl_faktur">
									<option value='' selected disabled class="blink">&#9654; PILIH PERIODE &#9664;</option>
                                    <?php
                                    $query = "SELECT substring(tgl_faktur,4,8) as tgl_faktur FROM incentive_sales group by substring(tgl_faktur,4,8)";
                                    $hasil = mysql_query($query);
                                    while ($data = mysql_fetch_array($hasil))
                                    {
									if($_POST[tgl_faktur]==$data[tgl_faktur]){
										if(!count($_POST['ubah'])){
										echo "<option value='".$data['tgl_faktur']."' selected>".$data['tgl_faktur']."</option>";
										}else{
										echo "<option value='".$data['tgl_faktur']."'>".$data['tgl_faktur']."</option>";
										}
										
									}
									else{
										echo "<option value='".$data['tgl_faktur']."'>".$data['tgl_faktur']."</option>";
									}
                                    }
                                    ?>
                                    </select>
								
									
									
									<div class="form-group">
											<label class="control-label">
												Pilih Supervisor <span class="symbol required"></span>
											</label>
												<select class = 'form-control' name="kode_supervisor" id="kode_supervisor" onchange = "getSales();">
												<option value="">--PILIH--</option>
												 <?php
												 $a="SELECT * FROM `supervisor`";
												 $sql=mysql_query($a);
												 while($data=mysql_fetch_array($sql)){
												 ?>
												 <option value="<?php echo $data['kode_supervisor']; ?>" <?php echo ($data['kode_supervisor'] == $_GET['kode_supervisor'] ? 'selected' : '') ?>><?php echo $data['kode_supervisor']?></option>
												 <?php } ?>
												 </select>
												 
										</div>
										
										<div class="form-group">
											<label class="control-label">
												Pilih Sales <span class="symbol required"></span>
											</label>
												<select class = 'form-control' name="kode_sales" id="kd_sales">
												 
												 </select>
												 
										</div>
									
									<!--select name="kode_supervisor" id="kode_supervisor">
									<option value='' selected disabled class="blink">&#9654; PILIH SUPERVISOR &#9664;</option>
                                    <!--?php
                                    $query = "SELECT DISTINCT kode_supervisor FROM supervisor";
                                    $hasil = mysql_query($query);
                                    while ($data = mysql_fetch_array($hasil))
                                    {
									if($_POST[kode_supervisor]==$data[kode_supervisor]){
										echo "<option value='".$data['kode_supervisor']."' selected>".$data['kode_supervisor']."</option>";
									}
									else{
										echo "<option value='".$data['kode_supervisor']."'>".$data['kode_supervisor']."</option>";
									}
                                    }
                                    ?>
                                    </select>
								
											
									<!--select name="nama_sales" id="nama_sales">
									<option value='' selected disabled class="blink">&#9654; PILIH SALESMAN &#9664;</option>
                                    <!--?php
									$supervisor = $_POST['kode_supervisor'];
                                    $query = "SELECT DISTINCT nama_sales FROM salesman where kode_supervisor = '$supervisor'";
                                    $hasil = mysql_query($query);
                                    while ($datas = mysql_fetch_array($hasil))
                                    {
									if($_POST[nama_sales]==$datas[nama_sales]){
										echo "<option value='".$datas['nama_sales']."' selected>".$datas['nama_sales']."</option>";
									}
									else{
										echo "<option value='".$datas['nama_sales']."'>".$datas['nama_sales']."</option>";
									}
                                    }
                                    ?>
                                    </select-->
									
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
								$bulan_faktur=$_POST['tgl_faktur'];
								$kode_supervisor=$_POST['kode_supervisor'];
								$nama_sales=$_POST['nama_sales'];
								$kueri="SELECT *, substring(tgl_faktur,4,8) as bulan_faktur FROM incentive_sales ";
															
								if (empty($bulan_faktur)){
									//jika tidak menginput apa2
									$query=mysql_query("$kueri");
									
									
								}else{
									
									?>
								
										<div class="table-header"><i><b>Target Periode: <?php echo $_POST['tgl_faktur']?></b></i></div><br />
										
								<?php
									
									$query=mysql_query("$kueri where substring(tgl_faktur,4,8)='$bulan_faktur' and kode_supervisor='$kode_supervisor' and nama_sales ='$nama_sales'");
									
								}
                    	
                    	?>
						
						
						<form method="post" action="" name="tabel">
						<div class="responsive" >
                        <table class="table table-bordered table-hover" id="sample_1">
                    		<thead>
                    			<tr>
                    				<th>No.</th>
                    				<th>Nama Mobil</th>
                    				<th>Kode Mobil</th>
									<th>Point</th>
									<th>No Spk</th>
									<th>Sales</th>
									<th>Supervisor</th>
									<th>Tgl Faktur</th>
									<th>Price List</th>
									<th>Discount</th>
									<th>Acc</th>
									<th>Plafon</th>
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
										<input type="hidden" name="<?php echo 'kode'.$nomor; ?>" value="<?php echo $row['kode'];?>" />
                            			<?php echo $row['kode'];?>
                            		</td>
									<td align = 'center'>
										<input type="hidden" name="<?php echo 'point'.$nomor; ?>" value="<?php echo $row['point'];?>" />
                            			<?php echo $row['point'];?>
                            		</td>
									<td>
                                	    <input type="text" value="<?php echo $row['no_spk'];?>" name="<?php echo 'no_spk'.$nomor; ?>" id="no_spk"></input>
                            		</td>
                                	<td>
                                	    <input type="text" value="<?php echo $row['nama_sales'];?>" name="<?php echo 'nama_sales'.$nomor; ?>" id="nama_sales"></input>
                            		</td>
									<td>
                                	    <input type="text" value="<?php echo $row['kode_supervisor'];?>" name="<?php echo 'kode_supervisor'.$nomor; ?>" id="kode_supervisor"></input>
                            		</td>
									<td>
                                	    <input type="text" value="<?php echo $row['tgl_faktur'];?>" name="<?php echo 'tgl_faktur'.$nomor; ?>" id="tgl_faktur"></input>
                            		</td>
									<td>
                                	    <input type="text" value="<?php echo $row['price_list'];?>" name="<?php echo 'price_list'.$nomor; ?>" id="price_list"></input>
                            		</td>
                                	<td>
                                	    <input type="text" value="<?php echo $row['discount'];?>" name="<?php echo 'discount'.$nomor; ?>" id="discount"></input>
                            		</td>
									<td>
                                	    <input type="text" value="<?php echo $row['acc'];?>" name="<?php echo 'acc'.$nomor; ?>" id="acc"></input>
                            		</td>
									<td>
                                	    <input type="text" value="<?php echo $row['plafon'];?>" name="<?php echo 'plafon'.$nomor; ?>" id="plafon"></input>
                            		</td>
                                </tr>
								
                                <?php
                            	}
                            	?>
                        </table>
						</div>
						
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
	include "input_insentif_sales.php";
		
?>

<?php 
	break;
	case "ubahtarget":
	//echo 'Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek Test Page Tes pek'.$_POST[model1].$_POST[tgl_faktur];
	if(count($_POST)) {
                            
                        // Cek username di database
                        $data=mysql_query("select * from target_serviceadvisor_bp where tgl_faktur='$_POST[tgl_faktur]'");
					    $sql = $data;
						$nomor = 0;
						while($data = mysql_fetch_array($sql)){
						$nomor += 1; 
                        $tgl_faktur = $_POST['tgl_faktur'];
                        $model = $_POST['model'.$nomor];
                        $target = $_POST['target'.$nomor];
                        
                        
                        // Kalau username valid, inputkan data ke tabel users
                        
                          mysql_unbuffered_query("update target_marketing69 set target=$target where model='$model' and tgl_faktur='$tgl_faktur'");
						
                        
                             
						}
					}
?>		

<script type="text/javascript">
alert('Berhasil di Ubah');
window.location = "media_showroom.php?module=sub_master_target_insentif_sales";
</script>;

<?php
    break;
    case "hapuspengajuan":
    $sql 	= "delete from target_serviceadvisor where no_pengajuan='$_GET[id]'";
    $query	= mysql_query($sql);
   
		header('location:../media_showroom.php?module=sub_master_target_insentif_sales');

?>			
				


				
				
				
<?php break;
}
} ?>