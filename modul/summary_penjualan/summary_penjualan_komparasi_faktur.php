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
		$tgl = date("Y-m-d");
		//$bulan_sekarang = date("m-Y");
		//include "class_hitung_incentif.php"; 
?>
	
				<script>
					
					function bedatahun(){
						$("#bulan_2").show();
						$("#tahun2").show();
						$("#span").show();
					}
					
					function samatahun(){
						$("#bulan_2").hide();
						$("#tahun2").hide();
						$("#span").hide();
					}
					
				/*	function show_filter(){
					//	setTimeout('$("#filter").show()', 2);
					
						$("#filter").show();
					}	*/
					
					function show_filter() {
						var x = document.getElementById("filter");
						if (x.style.display === "none") {
							x.style.display = "block";
						} else {
							x.style.display = "none";
						}
					}
				</script>

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-7">
									<h1 class="mainTitle">Summary</h1>
									<span class="mainDescription">Komparasi Faktur</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
							
								<div class = "col-md-12">
									<?php $isi_lama = $_GET['bulan']; 
										
										
									?>
									<div class="form-group">
																					
										<form action = "<?php echo "$_SERVER[PHP_SELF]"; ?>" method = "GET">
											<input type = "hidden" name="module" value = "summary_penjualan_komparasi_faktur" />
											<a class="accordion-toggle" data-toggle="collapse" onclick = 'show_filter();'>	
												<div class="panel panel-white">
													<div class="panel-heading">
														<h5 class="panel-title">
														   <b style=color:#007aff>KLIK DISINI UNTUK FILTER</b>
														  </h5>
													</div>
												</div>
											</a>
    												
											
											<div class="form-group filter" id = 'filter' style="display:none;">
												<div class="row">
							
													<div class = "col-md-6">
														<fieldset>
															<legend>
																	Pilih Tanggal <span class="symbol required"></span>
																</legend></br>
														
																													
																<div class="input-group">
																	<select name = "tggl1" class="form-control" >
																		<option disabled selected value=''>Pilih Tanggal Awal</option>
																		<?php
																		
																			for($i=1; $i<=31; $i++){
																				if(strlen($i)<2){
																					$i = "0".$i;
																				}
																			$selected = ($_GET['tggl1'] == $i ? "selected" : "")	;
																			echo "<option value='$i' $selected required> $i </option>";
																			}
																		?>
																	</select>
																	<span class="input-group-addon bg-primary">s/d</span>
																	<select name = "tggl2"  class="form-control">
																		<option disabled selected value=''>Pilih Tanggal Akhir</option>
																		<?php
																			for($j=1; $j<=31; $j++){
																				if(strlen($j)<2){
																					$j = "0".$j;
																				}
																				$selected = ($_GET['tggl2'] == $j ? "selected" : "")	;
																				echo "<option value='$j' $selected required> $j </option>";
																			}
																		?>
																	</select>
																</div>
															
															
														</fieldset>
													</div>
													<div class = "col-md-6">
														<fieldset>
															<legend>Pilih Tahun</legend>
															
															<div class="radio clip-radio radio-primary radio-inline">												
																<input type="radio" id="radio1" name="beda_tahun" value="1" <?php if($_GET[beda_tahun]=='1'){echo 'checked';}?> onclick="samatahun()">
																<label for="radio1">
																	Tahun yang Sama
																</label>
															</div>
															
															<div class="radio clip-radio radio-primary radio-inline">
																<input type="radio" id="radio2" name="beda_tahun" value="2" <?php if($_GET[beda_tahun]=='2'){echo 'checked';}?> onclick="bedatahun()" >
																<label for="radio2">
																	Tahun Berbeda
																</label>
															</div>
															<div>
																<select name = "tahun1"  >
																	<option disabled selected value=''>Pilih Tahun Awal</option>
																	<option value="2017" <?php if ($_GET[tahun1]=='2017'){echo "selected"; }?> required> 2017 </option>
																	<option value="2018" <?php if ($_GET[tahun1]=='2018'){echo "selected"; }?> required> 2018 </option>
																</select>
																<span id = 'span' <?php if($_GET['beda_tahun']=='2'){ echo "style='display: block;'"; }else{ echo "style='display: none;'"; }?>>s/d</span>
																<select id = 'tahun2' name = "tahun2" <?php if($_GET['beda_tahun']=='2'){ echo "style='display: block;'"; }else{ echo "style='display: none;'"; }?>>
																	<option disabled selected value=''>Pilih Tahun Akhir</option>
																	<option value="2017" <?php if ($_GET[tahun2]=='2017'){echo "selected"; }?>> 2017 </option>
																	<option value="2018" <?php if ($_GET[tahun2]=='2018'){echo "selected"; }?>> 2018 </option>
																</select>
															</div>
														</fieldset>
													</div>
												</div>
												<div class="row">
												
												
												
												<div class="col-md-6">
												<fieldset>
													<legend onclick="bedatahun()">Bulan</legend>
													
																
																	<label class="control-label">
																		<input type='checkbox' name = 'januari' value = '01' <?php if($_GET['januari']=='01'){echo "checked"; }?>>
																		Januari
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'februari' value = '02' <?php if($_GET['februari']=='02'){echo "checked"; }?>>
																		Februari
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'maret' value = '03' <?php if($_GET['maret']=='03'){echo "checked"; }?>>
																		Maret
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'april' value = '04' <?php if($_GET['april']=='04'){echo "checked"; }?>>
																		April
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'mei' value = '05' <?php if($_GET['mei']=='05'){echo "checked"; }?>>
																		Mei
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'juni' value = '06' <?php if($_GET['juni']=='06'){echo "checked"; }?>>
																		Juni
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'juli' value = '07' <?php if($_GET['juli']=='07'){echo "checked"; }?>>
																		Juli
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'agustus' value = '08' <?php if($_GET['agustus']=='08'){echo "checked"; }?>>
																		Agustus
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'september' value = '09' <?php if($_GET['september']=='09'){echo "checked"; }?>>
																		September
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'oktober' value = '10' <?php if($_GET['oktober']=='10'){echo "checked"; }?>>
																		Oktober
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'november' value = '11' <?php if($_GET['november']=='11'){echo "checked"; }?>>
																		November
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'desember' value = '12' <?php if($_GET['desember']=='12'){echo "checked"; }?>>
																		Desember
																	</label><br>
															
																<br>
																
														</fieldset>
														</div>
												<div class="col-md-6" id = 'bulan_2' <?php if($_GET['beda_tahun']=='2'){ echo "style='display: block;'"; }else{ echo "style='display: none;'"; }?>>
													<fieldset>
														<legend>Bulan 2</legend>
																
																<label class="control-label">
																		<input type='checkbox' name = 'januari2' value = '01' <?php if($_GET['januari2']=='01'){echo "checked"; }?>>
																		Januari
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'februari2' value = '02' <?php if($_GET['februari2']=='02'){echo "checked"; }?>>
																		Februari
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'maret2' value = '03' <?php if($_GET['maret2']=='03'){echo "checked"; }?>>
																		Maret
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'april2' value = '04' <?php if($_GET['april2']=='04'){echo "checked"; }?>>
																		April
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'mei2' value = '05' <?php if($_GET['mei2']=='05'){echo "checked"; }?>>
																		Mei
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'juni2' value = '06' <?php if($_GET['juni2']=='06'){echo "checked"; }?>>
																		Juni
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'juli2' value = '07' <?php if($_GET['juli2']=='07'){echo "checked"; }?>>
																		Juli
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'agustus2' value = '08' <?php if($_GET['agustus2']=='08'){echo "checked"; }?>>
																		Agustus
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'september2' value = '09' <?php if($_GET['september2']=='09'){echo "checked"; }?>>
																		September
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'oktober2' value = '10' <?php if($_GET['oktober2']=='10'){echo "checked"; }?>>
																		Oktober
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'november2' value = '11' <?php if($_GET['november2']=='11'){echo "checked"; }?>>
																		November
																	</label><br>
																	<label class="control-label">
																		<input type='checkbox' name = 'desember2' value = '12' <?php if($_GET['desember2']=='12'){echo "checked"; }?>>
																		Desember
																	</label><br>
																
																<br>
																
															
													
												</fieldset>
												</div>
											</div>
												
											</div>
												
											<div class="progress-demo">
												<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" >
													<span class="ladda-label"><i class="fa fa-check"></i> Proses </span>
												</button>
											</div><br/>
											
											<?php
												$tgl_awal = $_GET[tgl_awal];
												$tgl_akhir = $_GET[tgl_akhir];
											
												$tes_bulan = "'".$_GET['januari']."','".$_GET['februari']."','".$_GET['maret']."','".$_GET['april']."','".$_GET['mei']."','".$_GET['juni']."','".$_GET['juli']."','".$_GET['agustus']."','".$_GET['september']."','".$_GET['oktober']."','".$_GET['november']."','".$_GET['desember']."'";
												$tes_bulan2 = "'".$_GET['januari2']."','".$_GET['februari2']."','".$_GET['maret2']."','".$_GET['april2']."','".$_GET['mei2']."','".$_GET['juni2']."','".$_GET['juli2']."','".$_GET['agustus2']."','".$_GET['september2']."','".$_GET['oktober2']."','".$_GET['november2']."','".$_GET['desember2']."'";
												$chunk = chunk_split($tes_bulan, 4, ",");
												$trim_tes_bulan = trim($tes_bulan, ',');
												
												
												if($_GET['tggl1'] != "") { 
											?>
											
											<label class="control-label">
											    <div class="table-header">
													Data Faktur Sales: dari Tanggal <b><?php echo $_GET['tggl1']; ?></b> sampai dengan Tanggal <b><?php echo $_GET['tggl2']; ?> </b>
													
												</div>
									    	</label>
											
												<?php }?>
												
											<div class="form-group">
												<i><b><?php// echo $tes_bulan; ?><br><?php// echo $tes_bulan2; ?></b></i></div>
											</div>
										</form>										
									</div>
								
								<!------------------ UNTUK SS PERFORMANCE ------------------------------------------------------------------------------------------------>
								<?php 
								if($_GET['tggl1'] != "") { 
										
									
									$bln = "substr($_GET[bulan], 1, 7)";
									
									$tgl_awal = $_GET[tgl_awal];
									$tanggal1 = substr($_GET[tgl_awal], 9,2);
									$tgl1 = substr($tgl_awal,4,4);
									$bln_awal = substr($tgl_awal, 5, 2);
									$thn_awal = substr($tgl_awal, 0, 4);
									$bulan1 = $bln_awal."-".$thn_awal;
									
									$tgl_akhir = $_GET[tgl_akhir];
									$tanggal2 = substr($_GET[tgl_awal], 9,2);
									$tgl2 = substr($tgl_akhir,4,4);
									$bln_akhir = substr($tgl_akhir, 5, 2);
									$thn_akhir = substr($tgl_akhir, 0, 4);
									$bulan2 = $bln_akhir."-".$thn_akhir;
									
									if($bulan !="-") { 
									//	if($_GET['beda_tahun']=='1'){
											$faktur = mysql_query("SELECT *, count(bulan) as total FROM summary_faktur where substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and substr(bulan, 1, 2) in ($tes_bulan) and substr(bulan, 4,4) = '$_GET[tahun1]' group by bulan");
									//	}else{
											
									//	}
										$tot_rec = mysql_num_rows($faktur);
										if ($tot_rec == '0') { echo "<div class='col-sm-12'> Tidak ada data pada periode ini, silahkan pilih ulang </div>"; } else {
										//	$result = mysql_num_rows($faktur);
								?>
								
								<div class="col-sm-12">
									
									<div class="panel panel-white no-radius">
										<div class="panel-body no-padding">
											<div class="tabbable no-margin no-padding">
												<ul class="nav nav-tabs" id="myTab">
												<?php
														if ($_SESSION['leveluser'] != 'supervisor'){
													
													?>
												     <li class="active padding-top-5 padding-left-5"> 
														<a data-toggle="tab" href="#chart">
															GRAFIK
														</a>
													</li>
												    <li class=" padding-top-5">
														<a data-toggle="tab" href="#incentif">
															SS PERFORMANCE
														</a>
													</li>
													<?php
														}
													?>
													
													<?php 
														if ($_SESSION['leveluser'] != 'supervisor'){
															if ($_GET['beda_tahun'] == '1'){
																$query = mysql_query("select * from target_spv where substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]' group by kode_spv order by kode_spv, bulan");
																
															}else{
																$query = mysql_query("select * from target_spv where (substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]') or (substr(bulan,1,2) in ($tes_bulan2) and substr(bulan,4,4) = '$_GET[tahun2]') group by kode_spv order by kode_spv, bulan");
															}
														}else{
															if ($_GET['beda_tahun'] == '1'){
																$query = mysql_query("select * from target_spv where kode_spv = '$_SESSION[kode_spv]' and substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]' group by kode_spv order by kode_spv, bulan");
																
															}else{
																$query = mysql_query("select * from target_spv where kode_spv = '$_SESSION[kode_spv]' and (substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]') or (kode_spv = '$_SESSION[kode_spv]' and substr(bulan,1,2) in ($tes_bulan2) and substr(bulan,4,4) = '$_GET[tahun2]') group by kode_spv order by kode_spv, bulan");
															}
														}
															while ($data = mysql_fetch_array($query)){
															$kode_targetspv = $data[kode_spv];
												    ?>
												    <li class="padding-top-5 <?php ($_SESSION['leveluser'] == 'supervisor' ? $active = 'active' : $active = ''); echo $active;  ?>" >
														<a data-toggle="tab" href="#<?php echo $kode_targetspv; ?>">
															<font color="<?php echo $data[warna]; ?>"><?php echo $kode_targetspv; ?> </font>
														</a>
													</li>
													
													<?php } ?>
													
													
												</ul>
												
												<div class="tab-content">
													<div id="incentif" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-360">
															
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center;" >
																		<thead>
																			<tr style = "font-weight: bold;">
																			    <td>SPV</td>	
																			    <?php 
																				
																			//	$query = mysql_query("select * from target_spv where substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]' group by kode_spv ");
																			     
																				 if ($_GET['beda_tahun'] == '1'){
																				$query = mysql_query("SELECT *, count(bulan) as total FROM summary_faktur where substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and substr(bulan, 1, 2) in ($tes_bulan) and substr(bulan, 4, 4) = '$_GET[tahun1]' group by bulan");
																			}else{
																				$query = mysql_query("SELECT *, count(bulan) as total FROM summary_faktur where substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and (substr(bulan, 1, 2) in ($tes_bulan) and substr(bulan, 4, 4) = '$_GET[tahun1]') or (substr(bulan, 1, 2) in ($tes_bulan2) and substr(bulan, 4, 4) = '$_GET[tahun2]') group by bulan order by substr(bulan, 4, 4), substr(bulan, 1, 2)");
																			}



																				 while ($data = mysql_fetch_array($query)){
																			            echo "<td><div style=color:$data[warna]>".$data['bulan']."</div></td>";
																			        }
																			    ?>
																				
																				<!--td>TOTAL</td-->														
																			</tr>
																		</thead>
																		<tbody>
																			
																		    <?php
																			if ($_GET['beda_tahun'] == '1'){
																					$query_model = mysql_query("select * from target_spv where substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]' group by kode_spv order by kode_spv, bulan");
																				}else{
																					$query_model = mysql_query("select * from target_spv where (substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]') or (substr(bulan,1,2) in ($tes_bulan2) and substr(bulan,4,4) = '$_GET[tahun2]') group by kode_spv order by kode_spv, bulan");
																				}
																		//	$query_model = mysql_query("SELECT *, count(bulan) as total FROM summary_faktur where substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and substr(bulan, 1, 2) in ($tes_bulan) and substr(bulan, 4, 4) = '$_GET[tahun1]' group by bulan");
										
																			while ($rec = mysql_fetch_array($query_model))
																			{
																			   $target = $rec['target'];
																			   $model = trim($rec['model']);
																	
																			?>
																			
																			
																			<tr>
																				<td><?php echo $rec['kode_spv']; ?></td>	
																			    <?php
																						

																						$kode_spv = $rec['kode_spv'];
																					//$bulan = $rec['bulan'];
																					 if ($_GET['beda_tahun'] == '1'){
																							$query = mysql_query("SELECT *, count(bulan) as total FROM summary_faktur where substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and substr(bulan, 1, 2) in ($tes_bulan) and substr(bulan, 4, 4) = '$_GET[tahun1]' group by bulan");
																						}else{
																							$query = mysql_query("SELECT *, count(bulan) as total FROM summary_faktur where substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and (substr(bulan, 1, 2) in ($tes_bulan) and substr(bulan, 4, 4) = '$_GET[tahun1]') or (substr(bulan, 1, 2) in ($tes_bulan2) and substr(bulan, 4, 4) = '$_GET[tahun2]') group by bulan order by substr(bulan, 4, 4), substr(bulan, 1, 2)");
																						}
																					$total_ss = 0;
																					while ($data = mysql_fetch_array($query)){
																						if ($_GET['beda_tahun'] == '1'){
																							$where = "SELECT count(bulan) as total_bulanan FROM summary_faktur where kode_spv = '$kode_spv' and substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and bulan = '$data[bulan]' and kode_spv != 'OFFCE' ORDER BY kode_spv asc ";
																						}else{
																							$where = "SELECT count(bulan) as total_bulanan FROM summary_faktur where kode_spv = '$kode_spv' and substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and bulan = '$data[bulan]' and kode_spv != 'OFFCE' ORDER BY kode_spv asc ";
																						}
																						$total = mysql_query($where);
																						while($hasil = mysql_fetch_array($total)){
																							$total_faktur_bulan = $hasil['total_bulanan'];
																							
																							echo "<td style='font-size:17px;'><b><font color='$data[warna]' >".$total_faktur_bulan."</font></b></td>";
																							$total_ss = $total_ss + $total_faktur_bulan;
																						}
																					}
																				
    																				?>
    																			<!--td style="font-size:17px;">  ================= total ga dipake dulu
    																			    <?php 
																					
																						$where = "SELECT count(bulan) as total FROM summary_faktur where kode_spv = '$kode_spv' and substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and kode_spv != 'OFFCE' ORDER BY kode_spv asc ";
    																				    $total = mysql_query($where);
																						$totalsss = mysql_fetch_array($total);
    																				 //   $total = mysql_num_rows($total);
    																				    echo "<b style=color:red>$total_ss</b>";
    																				?>
    																			</td-->
    																			
																			</tr>
																			
																			<?php
																			}
																			?>
																			<tr>
																				<td>
																				<b>TOTAL</b>
																				</td>
																				<?php
																					if ($_GET['beda_tahun'] == '1'){
																							$query = mysql_query("SELECT *, count(bulan) as total FROM summary_faktur where substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and substr(bulan, 1, 2) in ($tes_bulan) and substr(bulan, 4, 4) = '$_GET[tahun1]' group by bulan");
																						}else{
																							$query = mysql_query("SELECT *, count(bulan) as total FROM summary_faktur where substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and (substr(bulan, 1, 2) in ($tes_bulan) and substr(bulan, 4, 4) = '$_GET[tahun1]') or (substr(bulan, 1, 2) in ($tes_bulan2) and substr(bulan, 4, 4) = '$_GET[tahun2]') group by bulan order by substr(bulan, 4, 4), substr(bulan, 1, 2)");
																						}
																					$total_ss = 0;
																					while ($data = mysql_fetch_array($query)){
																						if ($_GET['beda_tahun'] == '1'){
																							$where = "SELECT count(bulan) as total_bulanan FROM summary_faktur where substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and bulan = '$data[bulan]' and kode_spv != 'OFFCE' ORDER BY kode_spv asc ";
																						}else{
																							$where = "SELECT count(bulan) as total_bulanan FROM summary_faktur where substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and bulan = '$data[bulan]' and kode_spv != 'OFFCE' ORDER BY kode_spv asc ";
																						}
																						$total = mysql_query($where);
																						while($hasil = mysql_fetch_array($total)){
																							$total_faktur_bulan = $hasil['total_bulanan'];
																							
																							echo "<td style='font-size:17px;'><b><font color='$data[warna]' >".$total_faktur_bulan."</font></b></td>";
																							$total_ss = $total_ss + $total_faktur_bulan;
																						}
																						
																					}
																				//echo "<td style='font-size:17px;'><b style=color:red>$total_ss</b></td>";
																				?>
																				
																			</tr>
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													
													
												    <?php 
												       
														$kdspv = '';
														
														if ($_GET['beda_tahun'] == '1'){
																$query = mysql_query("SELECT *, count(bulan) as total FROM summary_faktur where substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and substr(bulan, 1, 2) in ($tes_bulan) and substr(bulan, 4, 4) = '$_GET[tahun1]' group by bulan");
															}else{
																$query = mysql_query("SELECT *, count(bulan) as total FROM summary_faktur where substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and (substr(bulan, 1, 2) in ($tes_bulan) and substr(bulan, 4, 4) = '$_GET[tahun1]') or (substr(bulan, 1, 2) in ($tes_bulan2) and substr(bulan, 4, 4) = '$_GET[tahun2]') group by bulan order by substr(bulan, 4, 4), substr(bulan, 1, 2)");
															}
														$gabung_pencapaian_bulanan = '';
														$gabung_bulan = '';
														while ($data = mysql_fetch_array($query)){
															if ($_GET['beda_tahun'] == '1'){
																$where = "SELECT count(bulan) as total_bulanan,bulan FROM summary_faktur where substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and bulan = '$data[bulan]' and kode_spv != 'OFFCE' ORDER BY kode_spv asc ";
															}else{
																$where = "SELECT count(bulan) as total_bulanan,bulan FROM summary_faktur where substr(tanggal, 9, 2)>= '$_GET[tggl1]' and substr(tanggal, 9, 2)<= '$_GET[tggl2]' and bulan = '$data[bulan]' and kode_spv != 'OFFCE' ORDER BY kode_spv asc ";
															}
															$total = mysql_query($where);
															
															
															while($hasil = mysql_fetch_array($total)){
																$total_faktur_bulan = $hasil['total_bulanan'];
																
																if($gabung_pencapaian_bulanan == ""){
																	$gabung_pencapaian_bulanan = $total_faktur_bulan;
																	$gabung_bulan = $hasil['bulan'];
																}else{
																	$gabung_pencapaian_bulanan = $gabung_pencapaian_bulanan .','. $total_faktur_bulan;
																	$gabung_bulan = $gabung_bulan .','. $hasil['bulan'];
																}
																
																
																
															}
															
														}
														//echo $gabung_pencapaian_bulanan;
														//echo $gabung_bulan;
														
														
														
														
												    ?>
												    
												    <script>
														var gabung_pencapaian_bulanan = "<?php echo $gabung_pencapaian_bulanan; ?>";
														var gabung_bulan = "<?php echo $gabung_bulan; ?>";
														
														
												    </script>
												    
													<div id="chart" class="tab-pane padding-bottom-5 <?php ($_SESSION['leveluser'] != 'supervisor' ? $active = 'active' : $active = ''); echo $active;  ?>" >
														<div class = "row">
															<!--div class = "col-md-6">
															<h1 class="mainTitle">Komparasi Faktur Per Team</h1>
																
																		<canvas id="lineChart1" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="lineLegend1" class="chart-legend"></div>
																		</div>
																	
															</div-->
															<div class = "col-md-6">
															<h1 class="mainTitle">Komparasi Faktur Bulanan </h1>
																
																		<canvas id="barChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="barLegend" class="chart-legend"></div>
																		</div>
																	
															</div>
															
															
														</div>
														
														
													</div>
												   
													
													<?php  
														if ($_SESSION['leveluser'] != 'supervisor'){
															if ($_GET['beda_tahun'] == '1'){
																$query_tgtspv = mysql_query("select * from target_spv where substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]' group by kode_spv order by kode_spv, bulan");
															}else{
																$query_tgtspv = mysql_query("select * from target_spv where (substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]') or (substr(bulan,1,2) in ($tes_bulan2) and substr(bulan,4,4) = '$_GET[tahun2]') group by kode_spv order by kode_spv, bulan");
															}
														}else{
															if ($_GET['beda_tahun'] == '1'){
																$query_tgtspv = mysql_query("select * from target_spv where kode_spv = '$_SESSION[kode_spv]' and substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]' group by kode_spv order by kode_spv, bulan");
															}else{
																$query_tgtspv = mysql_query("select * from target_spv where kode_spv = '$_SESSION[kode_spv]' and (substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]') or (kode_spv = '$_SESSION[kode_spv]' and substr(bulan,1,2) in ($tes_bulan2) and substr(bulan,4,4) = '$_GET[tahun2]') group by kode_spv order by kode_spv, bulan");
															}
															
														}
														while ($data_targetspv = mysql_fetch_array($query_tgtspv)){
														$kode_spvtarget = $data_targetspv['kode_spv'];  
																			        
													?>
													
													<div id="<?php echo $kode_spvtarget; ?>" class="tab-pane padding-bottom-5 <?php ($_SESSION['leveluser'] !='supervisor' ? $active = '' : $active = 'active'); echo $active;  ?>"> 
														<div class="panel-scroll height-360">
															
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center;" >
																		<thead>
																			<tr style = "font-weight: bold;">
																			    <td>SALES</td>												
																				<?php
																				if ($_GET['beda_tahun'] == '1'){
																					$sales_bulan = mysql_query("select * from target_spv where substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]' group by bulan");
																				}else{
																					$sales_bulan = mysql_query("select * from target_spv where (substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]') or (substr(bulan,1,2) in ($tes_bulan2) and substr(bulan,4,4) = '$_GET[tahun2]') group by bulan order by substr(bulan,4,4), substr(bulan,1,2)");
																				}
																					while($sales_bulan2 = mysql_fetch_array($sales_bulan)){
																				?>
																				<td><?php echo $sales_bulan2[bulan]; ?></td>		
																				<?php
																					}
																				?>																				
																			</tr>
																		</thead>
																		<tbody>
																			<?php
																				if ($_GET['beda_tahun'] == '1'){
																					$namasales = mysql_query("select * from target_sales where substr(bulan, 1, 2) in ($tes_bulan) and substr(bulan, 4,4) = '$_GET[tahun1]' and kode_spv = '$kode_spvtarget' group by kode_sales");
																				}else{
																				//	$namasales = mysql_query("select * from target_sales where substr(bulan, 1, 2) in ($tes_bulan) and substr(bulan, 4,4) = '$_GET[tahun1]' and kode_spv = '$kode_spvtarget' group by kode_sales");
																					$namasales = mysql_query("select * from target_sales where (substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]' and kode_spv = '$kode_spvtarget') or (substr(bulan,1,2) in ($tes_bulan2) and substr(bulan,4,4) = '$_GET[tahun2]' and kode_spv = '$kode_spvtarget') group by kode_sales");
																				}
																				while($hasil_namasales = mysql_fetch_array($namasales)){
																				
																			?>
																			<tr>
																				<td>
																					<?php echo $hasil_namasales['kode_sales'] ?>
																				</td>
																				<?php
																					if ($_GET['beda_tahun'] == '1'){
																						$sales_bulan = mysql_query("select * from target_spv where substr(bulan,1 ,2) in ($tes_bulan) and substr(bulan,4 ,4) = '$_GET[tahun1]' group by bulan");
																					}else{
																						$sales_bulan = mysql_query("select * from target_spv where (substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]') or (substr(bulan,1,2) in ($tes_bulan2) and substr(bulan,4,4) = '$_GET[tahun2]') group by bulan order by substr(bulan,4,4), substr(bulan,1,2)");
																					}
																				
																					while($sales_bulan2 = mysql_fetch_array($sales_bulan)){
																						$bulan_perss = $sales_bulan2['bulan'];
																						if ($_GET['beda_tahun'] == '1'){
																							$faktur_bulanan_sales = mysql_query("select count(bulan) as jumlah_faktur from summary_faktur where kode_sales = '$hasil_namasales[kode_sales]' and kode_spv = '$kode_spvtarget'
																						and substr(tanggal, 9, 2) >= '$_GET[tggl1]' and substr(tanggal, 9, 2) <= '$_GET[tggl2]'  and bulan = '$bulan_perss' order by substr(bulan, 1, 2), substr(bulan, 4, 4) ");
																						}else{
																						//	$faktur_bulanan_sales = mysql_query("select count(bulan) as jumlah_faktur from summary_faktur where kode_sales = '$hasil_namasales[kode_sales]' 
																					//	and substr(tanggal, 9, 2) >= '$_GET[tggl1]' and substr(tanggal, 9, 2) <= '$_GET[tggl2]' and (substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]') or (substr(bulan,1,2) in ($tes_bulan2) and substr(bulan,4,4) = '$_GET[tahun2]')");
																							$faktur_bulanan_sales = mysql_query("select count(bulan) as jumlah_faktur from summary_faktur where kode_sales = '$hasil_namasales[kode_sales]' and kode_spv = '$kode_spvtarget'
																						and substr(tanggal, 9, 2) >= '$_GET[tggl1]' and substr(tanggal, 9, 2) <= '$_GET[tggl2]'  and bulan = '$bulan_perss' order by substr(bulan, 4, 4), substr(bulan, 4, 4)");
																						}
																					
																						
																						while ($data_persales = mysql_fetch_array($faktur_bulanan_sales)){
																							echo "<td style='font-size:17px;'><b>$data_persales[jumlah_faktur]</b></td>";
																							
																						}
																						
																						
																					}
																				
																				?>
																			</tr>
																			<?php
																				}
																			?>
																			<tr>
																				<td>
																					<b>TOTAL</b>
																				</td>
																				<?php
																					if ($_GET['beda_tahun'] == '1'){
																						$sales_bulan = mysql_query("select * from target_spv where substr(bulan,1 ,2) in ($tes_bulan) and substr(bulan,4 ,4) = '$_GET[tahun1]' group by bulan");
																					}else{
																						$sales_bulan = mysql_query("select * from target_spv where (substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]') or (substr(bulan,1,2) in ($tes_bulan2) and substr(bulan,4,4) = '$_GET[tahun2]') group by bulan order by substr(bulan,4,4), substr(bulan,1,2)");
																					}
																				
																					while($sales_bulan2 = mysql_fetch_array($sales_bulan)){
																						$bulan_perss = $sales_bulan2['bulan'];
																						
																						if ($_GET['beda_tahun'] == '1'){
																							$total_faktur_bulanan_sales = mysql_query("select count(bulan) as total_faktur from summary_faktur where kode_spv = '$kode_spvtarget'
																							and substr(tanggal, 9, 2) >= '$_GET[tggl1]' and substr(tanggal, 9, 2) <= '$_GET[tggl2]' and bulan = '$bulan_perss' ");
																						}else{
																						//	$total_faktur_bulanan_sales = mysql_query("select count(bulan) as total_faktur from summary_faktur where substr(tanggal, 9, 2) >= '$_GET[tggl1]' and substr(tanggal, 9, 2) <= '$_GET[tggl2]' and (substr(bulan,1,2) in ($tes_bulan) and substr(bulan,4,4) = '$_GET[tahun1]' and kode_spv = '$kode_spvtarget') or (substr(bulan,1,2) in ($tes_bulan2) and substr(bulan,4,4) = '$_GET[tahun2]' and kode_spv = '$kode_spvtarget') group by bulan order by substr(bulan, 4, 4), substr(bulan,1,2)");
																							$total_faktur_bulanan_sales = mysql_query("select count(bulan) as total_faktur from summary_faktur where kode_spv = '$kode_spvtarget'
																							and substr(tanggal, 9, 2) >= '$_GET[tggl1]' and substr(tanggal, 9, 2) <= '$_GET[tggl2]' and bulan = '$bulan_perss' ");
																						}
																				
																						while($hasil_total_faktur_bulanan_sales = mysql_fetch_array($total_faktur_bulanan_sales)){
																				?>
																				<td style='font-size:17px;'><b>
																					<?php echo $hasil_total_faktur_bulanan_sales['total_faktur'] ?>
																				</b></td>
																				<?php
																					}
																				}
																				?>
																				
																			</tr>
																			
																		</tbody>
																	</table>
																</div>	
															</div>
													</div>
																
													<?php 									
														}
													?>
													
													
												</div>
											</div>
										</div>
									</div>
								</div>
								
										<?php }}} ?>
								
								
								
								
								
							</div>
						</div>
						<!-- end: DYNAMIC TABLE -->
					</div>
				</div>


<?php break;
}
} ?>