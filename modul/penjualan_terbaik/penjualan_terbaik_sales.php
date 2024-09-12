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
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		//$bulan_sekarang = date("m-Y");
		//include "../class_hitung_incentif.php"; 
?>
	
				

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-7">
									<h1 class="mainTitle">Summary</h1>
									<span class="mainDescription">Performance Sales</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
							
								<div class = "col-md-6">
									<?php $isi_lama = $_GET['bulan']; 
										
										
									?>
									<div class="form-group">
																				
										<form action = "<?php echo "$_SERVER[PHP_SELF]"; ?>" method = "GET">
											<input type = "hidden" name="module" value = "penjualan_terbaik_sales" />
											<div class="form-group">
												<label for="form-field-select-2">
													Pilih bulan & Tahun <span class="symbol required"></span>
												</label></br>													
												<select name = "bulan" >	
													<option value ="01" <?php if ($_GET[bulan]=='01'){echo "selected"; }?> > Januari </option>
													<option value ="02" <?php if ($_GET[bulan]=='02'){echo "selected"; }?> > Februari </option>
													<option value ="03" <?php if ($_GET[bulan]=='03'){echo "selected"; }?> > Maret </option>
													<option value ="04" <?php if ($_GET[bulan]=='04'){echo "selected"; }?> > April </option>
													<option value ="05" <?php if ($_GET[bulan]=='05'){echo "selected"; }?> > Mei </option>
													<option value ="06" <?php if ($_GET[bulan]=='06'){echo "selected"; }?> > Juni </option>
													<option value ="07" <?php if ($_GET[bulan]=='07'){echo "selected"; }?> > Juli </option>
													<option value ="08" <?php if ($_GET[bulan]=='08'){echo "selected"; }?> > Agustus </option>
													<option value ="09" <?php if ($_GET[bulan]=='09'){echo "selected"; }?> > September </option>
													<option value ="10" <?php if ($_GET[bulan]=='10'){echo "selected"; }?> > Oktober </option>
													<option value ="11" <?php if ($_GET[bulan]=='11'){echo "selected"; }?> > November </option>
													<option value ="12" <?php if ($_GET[bulan]=='12'){echo "selected"; }?> > Desember </option>
												
												</select>
												<select name = "tahun"  >
													<option value="2017" <?php ($_GET['tahun'] == '2017' ? $selected = 'selected' : $selected = ''); echo $selected  ?> > 2017 </option>
													<option value="2018" <?php ($_GET['tahun'] == '2018' ? $selected = 'selected' : $selected = ''); echo $selected  ?>> 2018 </option>
													<option value="2019" <?php ($_GET['tahun'] == '2019' ? $selected = 'selected' : $selected = ''); echo $selected  ?>> 2019 </option>
												</select>
											</div>	
											<div class="progress-demo">
												<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" >
													<span class="ladda-label"><i class="fa fa-check"></i> Proses </span>
												</button>
											</div><br/>
											<label class="control-label">
											    <font color="red"><b>Note : </b></font>Sebelum Proses,Terlebih dahulu Pilih Bulan yang akan di tampilkan <span class="symbol required"></span>
									    	</label>
										</form>										
									</div>
								</div>		
								
								<!------------------ UNTUK SS PERFORMANCE ------------------------------------------------------------------------------------------------>
								<?php 
								
								$bulan = "$_GET[bulan]"."-"."$_GET[tahun]";
								if($bulan !="-") { 
								
								$faktur = mysql_query("select * from summary_faktur where bulan ='$bulan' ");
												$tot_rec = mysql_num_rows($faktur);
												if ($tot_rec == '0') { echo "<div class='col-sm-12'> Tidak ada data pada periode Ini, silahkan pilih ulang </div>"; } else {
								?>
								
								<div class="col-sm-12">
									<div class = "table-responsive">
										<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center;">
											<thead>
												<tr>
												<!--td><font color = "<?php echo $data_targetspv[warna]; ?>"><?php echo $kode_spvtarget; ?></font></td-->
												<!--td><font color = "<?php echo $data_targetspv[warna]; ?>"></font></td-->
												<!--<td>GRD</td>-->	
												<!--td>TGT</td-->
												<?php 
												$query = mysql_query("select * from target_marketing where bulan = '$bulan'");
												while ($data = mysql_fetch_array($query)){
												$singkatan_model = substr(str_replace("-","",$data[model]),0,3);
																			            
												if ($singkatan_model =="CIT"){
													$singkatan_model = "CTY";
													}
												if ($singkatan_model=="CIV"){
													$singkatan_model = "CVC";
													}
												}
												?>
																														
																				
												<td>GAMBAR</td>
												<td>DETAIL</td>									
												</tr>
											</thead>
											<tbody>
												<?php 
												/*$query_sales = mysql_query("SELECT count(sf.kode_sales) as num, sf.*, ts.*, (count(sf.kode_sales)/ts.target_unit*100) as pencapaian 
																			FROM summary_faktur sf, target_sales ts WHERE sf.kode_sales = ts.kode_sales and sf.bulan = '$bulan' and ts.bulan = '$bulan' group 
																			by sf.kode_sales order by pencapaian desc limit 3");*/
												$query_sales = "SELECT MAX(date(tanggal)) as tgl, (round(count(sf.kode_sales)/ts.target_unit*100)) as pencapaian, count(sf.kode_sales) as terjual, 
																target_unit, sf.*, ts.* FROM summary_faktur sf, target_sales ts WHERE sf.kode_sales = ts.kode_sales and sf.bulan = ts.bulan and 
																sf.bulan= '$bulan' group by sf.kode_sales order by pencapaian desc, tgl asc limit 3";
												$qrysls = mysql_query("$query_sales ");
												$sls = mysql_num_rows($query_sales);
													
																			//$query_sales = mysql_query("select * from target_sales where bulan = '$bulan' ");
												$prev=+1;
												while ($sales = mysql_fetch_array($qrysls))
													{
													$nama_sales = $sales['nama_sales'];
													$kode_sales = $sales['kode_sales'];
													$kdspv = $sales['kode_spv'];
													$grade = $sales['grade'];
													$jual = $sales['jual'];
													$pencapaian = $sales['pencapaian'];
													$target = $sales['target_unit'];
													$target_point = $sales['target_point'];
													
												?>
												
												<tr>
												
												<?php
												$gmb=mysql_query("select * from users where kode_sales='$kode_sales'");
												$j = 0;
												$j++;
												if (mysql_num_rows($gmb) >=1){
													$gmb_rec = mysql_fetch_assoc($gmb);
													$foto1 = $gmb_rec['foto'];
												}else{
													$foto1 ="591a723a7ca38_user.jpg";
													}
																							
												if($pencapaian >='100'){
													echo "	<td>
																<img src='image/medium_".$foto1."'>
															</td>
															<td>
																Nama Sales : ".$nama_sales."</br>
																Team : ".$kdspv."</br>
																Pencapaian : <span class='label label-success'>".$pencapaian." %</span>
															</td>";
												}
												?>											
												</tr>
												
												<?php
												}
												
												?>
												
											</tbody>
										</table>
									</div>	
								</div>
								<?php 						            
									}
								?>
								
								<?php } ?>
								
								
								
								</div></div>
								
							</div>
						</div>
						<!-- end: DYNAMIC TABLE -->

<?php break;
} 
}
?>