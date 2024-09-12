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
		include "config/koneksi_sqlserver.php";
		//include "modul/summary_service/class_hitung_incentif.php";
		include "config/koneksi_service.php";
?>
	
				<style>
					
					table div {
  
					  position:relative;
					  //height:90px;
					  width:20px;
					  
					  
					}
					table span{
						  transform: rotate(-90deg);display:block; border: 0px solid red;
						}

					.vertical-text {
						//transform: rotate(-90deg);
						text-align:center;
						white-space:nowrap;
						transform-origin:50% 50%;
						-webkit-transform: rotate(-90deg);
						-moz-transform: rotate(-90deg);
						-ms-transform: rotate(-90deg);
						-o-transform: rotate(-90deg);
						transform: rotate(-90deg);
						padding:0%;
					}
					
					.vertical-text:before {
					
					content:'';
					padding-top:100%;/* takes width as reference, + 10% for faking some extra padding */
					//width : 5px;
					display:inline-block;
					vertical-align:middle;
					
					}
				</style>

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-7">
									<h1 class="mainTitle">Summary</h1>
									<span class="mainDescription">Performance Service Advisor</span>
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
											<input type = "hidden" name="module" value = "service_summary_service_all" />
											<!--div class="form-group">
												<label for="form-field-select-2">
													Pilih bulan & Tahun <span class="symbol required"></span>
												</label></br>													
												<select name = "bulan" >	
													<option value ="01" <?php echo ($_GET[bulan]=='02' ? "selected" : "") ?> > Januari </option>
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
													<option value="2017"> 2017 </option>
													<option value="2018"> 2018 </option>
												</select>
											</div-->
											<div class="form-group">
												<label class="control-label">
													Pilih Periode <span class="symbol required"></span>
												</label>
												<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
													<input class="form-control" type="text" id="tgl_awal" name="tgl_awal" value ="<?php echo $_GET[tgl_awal]; ?>" readonly>
														<span class="input-group-addon bg-primary">s/d</span>
													<input class="form-control" type="text" id="tgl_akhir" name="tgl_akhir" value ="<?php echo $_GET[tgl_akhir]; ?>" readonly>
												</div>
											</div>
											
											<!--label class="control-label">
												Pilih Bulan <span class="symbol required"></span>
											</label>
											<div class="input-group input-append datepicker date" data-date-format='mm-yyyy'>
												<input type="text" class="form-control" name = "bulan" id = "bulan" value = "<?php if(empty($isi_lama)){
													echo "";
												} else { echo "$isi_lama";} ?>"  />
												<span class="input-group-btn">
													<button type="button" class="btn btn-default">
														<i class="glyphicon glyphicon-calendar"></i>
													</button> </span>
											</div-->	
											
											
											<div class="form-group">
												<label class="control-label">
													Pilih SA <span class="symbol required"></span>
												</label>
													<select name="nama_sa" id="idsatarget" onchange="tgt_sa()" >
													<option value="">--PILIH--</option>
													 <?php
													 $a="SELECT * FROM service_advisor";
													 $sql=mysql_query($a);
													 while($data=mysql_fetch_array($sql)){
													 ?>
													 <option value="<?php echo $data['nama_sa']; ?>" <?php echo ($data['nama_sa'] == $_GET['nama_sa'] ? 'selected' : '') ?>><?php echo $data['nama_sa']?></option>
													 <?php
													 }
													 ?>
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
											<?php
												$tgl_awal = $_GET[tgl_awal];
												$tgl_akhir = $_GET[tgl_akhir];
											?>
											<!--label class="control-label">
											    <div class="table-header">Data Faktur Sales: dari Periode <?php echo $tgl_awal; ?> sampai dengan periode <?php echo $tgl_akhir; ?> </div>
									    	</label-->
											
											<div class="form-group">
												<i><b></b></i></div>
											</div>
										</form>										
									</div>
								
								<!------------------ UNTUK SS PERFORMANCE ------------------------------------------------------------------------------------------------>
								<?php 
								
								//	$bulan = "$_GET[bulan]"."-"."$_GET[tahun]";
									
								/*	$tgl_awal = "$_GET[tgl_awal]";
									$bln_awal = "substr($_GET[tgl_awal], 1, 4)";
									$thn_awal = "substr($_GET[tgl_awal], 6, 2)";
									$bulan1 = "$bln_awal"."-"."$thn_awal";
									
									$tgl_akhir = "$_GET[tgl_akhir]";
									$bln_akhir = "substr($_GET[tgl_akhir], 1, 4)";
									$thn_akhir = "substr($_GET[tgl_akhir], 6, 2)";
									$bulan2 = "$bln_akhir"."-"."$thn_akhir";	*/
									
									$bln = "substr($_GET[bulan], 1, 7)";
									
									$tgl_awal = $_GET[tgl_awal];
									$tgl1 = substr($tgl_awal,4,4);
									$bln_awal = substr($tgl_awal, 5, 2);
									$thn_awal = substr($tgl_awal, 0, 4);
									$bulan1 = $bln_awal."-".$thn_awal;
									
									$tgl_akhir = $_GET[tgl_akhir];
									$tgl2 = substr($tgl_akhir,4,4);
									$bln_akhir = substr($tgl_akhir, 5, 2);
									$thn_akhir = substr($tgl_akhir, 0, 4);
									$bulan2 = $bln_akhir."-".$thn_akhir;
									
									if($bulan !="-") { 
										$querysadetail = "select count(f.nomor) as total from srvt_faktur F
															where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'
															and f.batal = 0 ";
														
										$result = sqlsrv_query($conn, $querysadetail);		
										
										
										while($data_faktur = sqlsrv_fetch_array($result)){
											$ada_record = $data_faktur['total'];
										}
										
										
										if ($ada_record == '0') { echo "<div class='col-sm-12'> Tidak ada data pada periode Ini, silahkan pilih ulang </div>"; } else {
								?>
								
								<div class="col-sm-12">
									
									<div class="panel panel-white no-radius">
										<div class="panel-body no-padding">
											<div class="tabbable no-margin no-padding">
												<ul class="nav nav-tabs" id="myTab">
												    <!--li class="padding-top-5 padding-left-5"> 
														<a data-toggle="tab" href="#chart">
															GRAFIK
														</a>
													</li>
												    <li class="padding-top-5">
														<a data-toggle="tab" href="#incentif">
															SS PERFORMANCE
														</a>
													</li-->
													<?php 
														if ($thn_akhir - $thn_awal > 0){
															//$query = mysql_query("select * from target_serviceadvisor where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) and nama_sa = '$_GET[nama_sa]' group by nama_sa order by nama_sa");
															
														}else{
															//$query = mysql_query("select * from target_serviceadvisor where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and nama_sa = '$_GET[nama_sa]' group by nama_sa order by nama_sa, bulan");
															$query = mysql_query("select * from service_advisor where nama_sa = '$_GET[nama_sa]'");
														}
																				
															while ($data = mysql_fetch_array($query)){
															$kode_targetspv = $data['nama_sa'];
															
													/*	$num_row = mysql_query("select * from target_spv where bulan >= '$bulan1' and bulan <= '$bulan2' and kode_spv = '$kode_targetspv' group by kode_spv order by kode_spv");
															$num = mysql_num_rows($num_row);	*/
												    ?>
															<li class="active padding-top-5" >
																<a data-toggle="tab" href="#<?php echo $kode_targetspv; ?>">
																	<font color="<?php echo $data[warna]; ?>"><?php echo $kode_targetspv; ?> </font>
																</a>
															</li>
													
													<?php } ?>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#PM_PACKAGE">
															PM PACKAGE
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#POLES">
															POLES
														</a>
													</li>
												
													
												</ul>
												
												<div class="tab-content">
													<div id="incentif" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-360">
															<?php
																	$query = mysql_query("SELECT nm_sa from acchv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by nm_sa");
																
																	while ($r=mysql_fetch_array($query)){
																		$nama_sa = $nama_sa.$r[nm_sa];
																	}
																	$nama_sa = array("$nama_sa",1);
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center;" >
																		<thead>
																			<tr style = "font-weight: bold;">
																			    <td>MODEL</td>												
																				<td>TGT</td>	
																			    <?php 
																				if ($thn_akhir - $thn_awal > 0){
																					$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) and nama_sa ='$_GET[nama_sa]'");
																					
																				}else{
																					$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and nama_sa ='$_GET[nama_sa]'");
																				}
																			        while ($data = mysql_fetch_array($query)){
																			            echo "<td width='6%'><div style=color:$data[warna]>".substr($data[kode_spv],0,3)."</div></td>";
																			        }
																			    ?>
																														
																				<!--th>HENRI</th>
																				<th>WIND</th>
																				<th>ZAIN</th>
																				<th>IBNU</th>
																				<th>INDRA</th>
																				<th>COUNTER</th-->
																				<td>TOTAL</td>
																				<td>%</td>																				
																				<td>DISC(Rp)</td>												
																			</tr>
																		</thead>
																		<tbody>
																			
																		    <?php 
																		     //   $query_model = mysql_query("select * from target_marketing where bulan = '$bulan'");
																			 if ($thn_akhir - $thn_awal > 0){
																				$query_model = mysql_query("select *, sum(target) as target from target_marketing  where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by model order by model asc");
																				
																			}else{
																				$query_model = mysql_query("select *, sum(target) as target from target_marketing  where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by model order by model asc");
																			}
																			//	$query_model = mysql_query("select *, sum(target) as target from target_marketing where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')group by model order by model asc");
																			        while ($rec = mysql_fetch_array($query_model))
																			        {
																					   $target = $rec['target'];
																			           $model = trim($rec['model']);
																					   
																			        
																		    ?>
																			<tr>																				
																				<td align="left"><?php 
																					$singkatan_model = substr(str_replace("-","",$model),0,3);
																					if ($singkatan_model =="CIT"){
																							$singkatan_model = "CTY";
																						}
																						if ($singkatan_model=="CIV"){
																							$singkatan_model = "CVC";
																						}
																					
																					echo $singkatan_model ; 
																				
																				?></td>
																				<td>
																				    <?php
																				        //$query = "select * from target_marketing where bulan = '$_GET[bulan]'"; 
    																				    //$target = mysql_query($query);
    																				    //$target = mysql_fetch_array($target);
    																				    //$target = $target[strtolower($model)];
    																				    $total_target =$total_target+ $target;
    																				    echo $target;
																				    ?>
																				</td>
    																				<?php
																					 if ($thn_akhir - $thn_awal > 0){
																						$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv");
																						
																					}else{
																						$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv");
																					}
																					//	$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv");
																					//	$query = mysql_query("select * from target_spv where bulan = '$bulan'");
    																			        while ($data = mysql_fetch_array($query)){
    																			            echo "<td style='font-size:17px;'>";
    																			            $where = "select * from summary_faktur where kode_spv = '$data[kode_spv]' and model = '$model' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir'"; 
																					
    																				    $total = mysql_query($where);
    																				    $total = mysql_num_rows($total);
    																				   
    																				    if ($total == 0){
        																				        echo "</td>";
        																				    }
        																				else {
        																				        echo "<b>$total</b></td>";
        																				    }
    																				    
    																				    
    																			        }
    																				?>
																				<td style="font-size:17px;">
    																				<?php
																					
																						$where = "select * from summary_faktur where model = '$model' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir'";
    																				    $total = mysql_query($where);
    																				    $total = mysql_num_rows($total);
    																				    echo "<b style=color:red>$total</b>";
    																				?>
																				</td>
																				<td>
																				    <?php
																				        if ($target==0){
																				            echo 0;
																				        }
																				        else {
																				            if($total==0){
																				                echo "<span class='label label-danger'>"."0</span>";
																				            }else {
																								 $ratio = round(($total/$target)*100,2);
																				                 if ((round(($total/$target)*100,2))<100){
																				                     //echo "<span class='label label-danger'>".(round(($total/$target)*100))."</span>";
																									 if ($ratio >= 65 and $ratio < 100){
    																				                         echo "<span class='label label-warning'>".(round(($total/$target)*100))."</span>";
    																				                     }
    																				                     else {
    																				                         echo "<span class='label label-danger'>".(round(($total/$target)*100))."</span>";
    																				                     }
																				                 }
																				                 else{
																				                     echo "<span class='label label-success'>".(round(($total/$target)*100))."</span>";
																				                 }
																				                
																				            }
																				            
																				        }
																				    ?>
																				    
																				</td>
																				<td>
																				    <?php
    																			        $query = "select * from summary_faktur where model = '$model' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir'"; 
    																				    $total = mysql_query($query);
    																				    $total_record = mysql_num_rows($total);
    																				    
    																				    $query = "select sum(diskon) as total_diskon from summary_faktur where model = '$model' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir'"; 
    																				    $total = mysql_query($query);
    																				    $total_diskon = mysql_fetch_array($total);
    																				    $total_diskon = $total_diskon[total_diskon];
    																				    
    																				    //$rata2diskon = round($total_diskon / $total_record);
    																				    	$rata2diskon = substr(number_format(round($total_diskon / $total_record),0,".","."),0,-4);
    																				    echo $rata2diskon;
    																				?>
																				</td>																				
																			</tr>
																			<?php
																			        }
																			?>
																			<tr>
																			    <td><b style=color:#007aff>TOTAL</b></td>
																			    <td>
																			        <?php
																			            echo "<b style=color:#007aff>$total_target</b>";
																			        ?>
																			    </td>
																			    	<?php
																						 if ($thn_akhir - $thn_awal > 0){
																							$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv");
																							
																						}else{
																							$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv");
																						}
    																				 //   $query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv");
    																			        while ($data = mysql_fetch_array($query)){
    																			            echo "<td style='font-size:17px;'>";
    																			            $where = "select * from summary_faktur where kode_spv = '$data[kode_spv]' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir'"; 
        																				    $total = mysql_query($where);
        																				    $total = mysql_num_rows($total);
        																				    echo "<b><font color='$data[warna]' >".$total."</font></b></td>";
    																			        }
    																				?>
    																			<td style="font-size:17px;">
    																			    <?php
    																			        $where = "select * from summary_faktur where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir'"; 
    																				    $total = mysql_query($where);
    																				    $total = mysql_num_rows($total);
    																				    echo "<b style=color:red>$total</b>";
    																				?>
    																			</td>
    																			<td>
																				    <?php
																				        if ($total==0){
																				            echo 0;
																				        }
																				        else {
																				            
																				            if ((round(($total/$total_target)*100,2))<100){
																				                echo "<span class='label label-danger'>".(round(($total/$total_target)*100))."</span>";
																				            }
																				            else {
																				                echo "<span class='label label-success'>".(round(($total/$total_target)*100))."</span>";
																				            }
																				            //<span class="label label-danger"> Danger</span>
																				            //echo (round(($total/$total_target)*100,2))."%";
																				        }
																				    ?>
																				    
																				</td>
																				<td>
																				    <?php
    																			        $query = "select * from summary_faktur where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and diskon !=0"; 
    																				    $total = mysql_query($query);
    																				    $total_record = mysql_num_rows($total);
    																				    
    																				    $query = "select sum(diskon) as total_diskon from summary_faktur where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir'"; 
    																				    $total = mysql_query($query);
    																				    $total_diskon = mysql_fetch_array($total);
    																				    $total_diskon = $total_diskon[total_diskon];
    																				    
    																				    //$rata2diskon = round($total_diskon / $total_record);
    																				    	$rata2diskon = substr(number_format(round($total_diskon / $total_record),0,".","."),0,-4);
    																				    echo $rata2diskon;
    																				?>
																				</td>	
																			</tr>
																			<tr>
																			    <td colspan='12'></td> 
																			</tr>
																			<tr>
																			    <td colspan='2'>SS TGT</td>
																			    	<?php  
                                													///////////////////////////////////////////////////////////////////////////////
                                													//////////////////////////////////////////////////////////////////////////////
                                													if ($thn_akhir - $thn_awal > 0){
																						$query_tgtspv = mysql_query("select *, sum(target_unit) target_unit from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv");
																					}else{
																						$query_tgtspv = mysql_query("select *, sum(target_unit) target_unit from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv");
																					}
                                												//	$query_tgtspv = mysql_query("select *, sum(target_unit) target_unit from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv");
                                																			        while ($data_targetspv = mysql_fetch_array($query_tgtspv)){
                                																			        $kode_spvtarget = $data_targetspv['kode_spv'];  
                                																			        echo "<td style='font-size:17px;'><b><font color='$data_targetspv[warna]'>$data_targetspv[target_unit]</font></b></td>";
                                																			        }				        
                                																			        
                                													?>
                                												<td colspan='3'></td>
																			</tr>
																			<tr>
																			    <td colspan='2'>RASIO %</td>
																			        <?php
																						if ($thn_akhir - $thn_awal > 0){
																							$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv");
																						}else{
																							$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv");
																						}
    																				 //   $query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv");
    																			        while ($data = mysql_fetch_array($query)){
    																			            echo "<td>";
    																			            $where = "select * from summary_faktur where kode_spv = '$data[kode_spv]' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv"; 
        																				    $total = mysql_query($where);
        																				    $total = mysql_num_rows($total);
        																				    $target = $data[target_unit];
        																				    
        																				    if ($target==0){
    																				            echo 0;
    																				        }
    																				        else {
    																				            if($total==0){
    																				                echo "<span class='label label-danger'>"."0%</span>";
    																				            }else {
    																				                $ratio = round(($total/$target)*100,2);
    																				                 if ((round(($total/$target)*100,2))<100){
    																				                     if ($ratio >= 65 and $ratio < 100){
    																				                         echo "<span class='label label-warning'>".(round(($total/$target)*100))."</span>";
    																				                     }
    																				                     else {
    																				                         echo "<span class='label label-danger'>".(round(($total/$target)*100))."</span>";
    																				                     }
    																				                 }
    																				                 else{
    																				                     echo "<span class='label label-success'>".(round(($total/$target)*100))."</span>";
    																				                 }
    																				                
    																				            }
    																				            
    																				            
    																				        }
    																				        $total_point_tipe = 0;
        																				    
        																				    
        																				    //echo "<b style=color:#007aff>".$total."</b></td>";
    																			        }
    																			        
    																				?>
																					<td colspan='3'></td>
																			</tr>
																			<tr>
																			    <td colspan='2'>PENJ ACC(Rp)</td>
																			    	<?php  
                                													///////////////////////////////////////////////////////////////////////////////
                                													//////////////////////////////////////////////////////////////////////////////
                                													if ($thn_akhir - $thn_awal > 0){
																						$query_tgtspv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv");
																					}else{
																						$query_tgtspv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv");
																					}
                                												//	$query_tgtspv = //mysql_query("select * from target_spv where bulan = '$bulan'");
																						mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv");
																							while ($data_targetspv = mysql_fetch_array($query_tgtspv)){
																							$kode_spvtarget = $data_targetspv['kode_spv'];  
																							if ($thn_akhir - $thn_awal > 0){
																								$query = mysql_query("select sum(hargajual) as hargajual from penjualan_aksesoris where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) and kode_spv = '$kode_spvtarget' or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) and kode_spv = '$kode_spvtarget'");
																							}else{
																								$query = mysql_query("select sum(hargajual) as hargajual from penjualan_aksesoris where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and kode_spv = '$kode_spvtarget' ");
																							}
																						//	$query = mysql_query("select sum(hargajual) as hargajual from penjualan_aksesoris where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')and kode_spv = '$kode_spvtarget' ");
																							$data = mysql_fetch_array($query);
																							$hargajual = substr(number_format($data[hargajual],0,".","."),0,-4);
																							echo "<td><b><font color='$data_targetspv[warna]'>$hargajual</font></b></td>"; 
																							
																						//    print json_encode($kode_spvtarget);
																							}				        
                                																			        
                                													?>
                                												<td colspan='3'></td>
																			</tr>
																		</tbody>
																	</table>
																</div>	
														</div>
													</div>
													
													
													
													
													
													
													<script>var point_ari = "<?php echo $point_total_ari; ?>";
															var point_ihsan = "<?php echo $point_total_ihsan; ?>";
															var point_suherman = "<?php echo $point_total_suherman; ?>";
															var point_taufik = "<?php echo $point_total_taufik; ?>";
															var point_wahyu = "<?php echo $point_total_wahyu; ?>";
															var point_yus = "<?php echo $point_total_yus; ?>";
															
															var care_ari = "<?php echo $ari_care[3]; ?>";
															var care_ihsan = "<?php echo $ihsan_care[3]; ?>";
															var care_suherman = "<?php echo $suherman_care[3]; ?>";
															var care_taufik = "<?php echo $taufik_care[3]; ?>";
															var care_wahyu = "<?php echo $wahyu_care[3]; ?>";
															var care_yus = "<?php echo round($yus_care[3],2); ?>";
															
															var plus_ari = "<?php echo $ari_plus[3]; ?>";
															var plus_ihsan = "<?php echo $ihsan_plus[3]; ?>";
															var plus_suherman = "<?php echo $suherman_plus[3]; ?>";
															var plus_taufik = "<?php echo $taufik_plus[3]; ?>";
															var plus_wahyu = "<?php echo $wahyu_plus[3]; ?>";
															var plus_yus = "<?php echo round($yus_plus[3],2); ?>";
															
															var engineoil_ari = "<?php echo $ari_engineoil[3]; ?>";
															var engineoil_ihsan = "<?php echo $ihsan_engineoil[3]; ?>";
															var engineoil_suherman = "<?php echo $suherman_engineoil[3]; ?>";
															var engineoil_taufik = "<?php echo $taufik_engineoil[3]; ?>";
															var engineoil_wahyu = "<?php echo $wahyu_engineoil[3]; ?>";
															var engineoil_yus = "<?php echo round($yus_engineoil[3],2); ?>";
															
															var revenue_ari = "<?php echo $ari_revenue[3]; ?>";
															var revenue_ihsan = "<?php echo $ihsan_revenue[3]; ?>";
															var revenue_suherman = "<?php echo $suherman_revenue[3]; ?>";
															var revenue_taufik = "<?php echo $taufik_revenue[3]; ?>";
															var revenue_wahyu = "<?php echo $wahyu_revenue[3]; ?>";
															var revenue_yus = "<?php echo round($yus_revenue[3],2); ?>";
															
															var others_ari = "<?php echo $ari_others[3]; ?>";
															var others_ihsan = "<?php echo $ihsan_others[3]; ?>";
															var others_suherman = "<?php echo $suherman_others[3]; ?>";
															var others_taufik = "<?php echo $taufik_others[3]; ?>";
															var others_wahyu = "<?php echo $wahyu_others[3]; ?>";
															var others_yus = "<?php echo round($yus_others[3],2); ?>";
													</script>		
												    
												    <?php 
												        // VARIABEL VARIABEL UNTUK GRAFIK PER TIPE
												        //===============================================================================================
												       
												        $tot_brio = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'BRIO' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $tot_mobilio = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'MOBILIO' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir'"));
												        $tot_brv = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'BR-V' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $tot_hrv = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'HR-V' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $jazz       = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'JAZZ' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $city       = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'CITY' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $civic      = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'HIVIC' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $crv        = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'CR-V' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $accord     = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'ACCORD' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $odyssey    = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'ODYSSEY' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $crz        = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'CR-Z' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        
												        // VARIABEL VARIABEL UNTUK GRAFIK PENCAPAIAN PER SUPERVISOR
												        //===============================================================================================
												        
												        $target_henri = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'HENRI' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') "));
												        $target_henri = $target_henri[target_unit];
												        
												        $target_sudi = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'SUDI' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') "));
												        $target_sudi = $target_sudi[target_unit];
												        
												        $target_wind = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'WIND' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') "));
												        $target_wind = $target_wind[target_unit];
												        
												        $target_ibnu = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'IBNU' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')"));
												        $target_ibnu = $target_ibnu[target_unit];
												        
												        $target_indra = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'INDRA' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') "));
												        $target_indra = $target_indra[target_unit];
												        
												        $target_zain = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'ZAIN' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') "));
												        $target_zain = $target_zain[target_unit];
														
														$target_tiko = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'TIKO' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') "));
												        $target_tiko = $target_tiko[target_unit];
														
														if ($thn_akhir - $thn_awal > 0){
															$tgt_ss = mysql_query("select *, sum(target_unit) as targetunit from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv asc");
														}else{
															$tgt_ss = mysql_query("select *, sum(target_unit) as targetunit from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv asc");
														}
													//	$tgt_ss = mysql_query("select *, sum(target_unit) as targetunit from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv");
												        //$tgt_ss = $tgt_ss[targetunit];
														//$kdspv = $tgt_ss[kode_spv];
												        
												        $result_henri = mysql_num_rows(mysql_query("select * from summary_faktur where kode_spv = 'HENRI' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $result_sudi = mysql_num_rows(mysql_query("select * from summary_faktur where kode_spv = 'SUDI' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $result_wind = mysql_num_rows(mysql_query("select * from summary_faktur where kode_spv = 'WIND' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $result_ibnu = mysql_num_rows(mysql_query("select * from summary_faktur where kode_spv = 'IBNU' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $result_indra = mysql_num_rows(mysql_query("select * from summary_faktur where kode_spv = 'INDRA' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $result_zain = mysql_num_rows(mysql_query("select * from summary_faktur where kode_spv = 'ZAIN' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
														$result_tiko = mysql_num_rows(mysql_query("select * from summary_faktur where kode_spv = 'TIKO' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
														
														if ($thn_akhir - $thn_awal > 0){
															$spv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv asc");
														}else{
															$spv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv asc");
														}	
													//	$spv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') order by kode_spv asc ");
														$targets = '';
														while ($spv2 = mysql_fetch_array($spv)){
															$spv3 = $spv2['kode_spv'];
													//	$res_ss = mysql_query("select *, count(kode_spv) as kdspv from summary_faktur where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and and kode_spv = '$spv3' and kode_spv != 'OFFCE' group by kode_spv ");
														
														$res_ss = mysql_query("select * from summary_faktur where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and kode_spv = '$spv3' and kode_spv != 'OFFCE' ");
														
														$res_ss1 = mysql_num_rows($res_ss);
														if ($results == ''){
															//	$results = $cd1['kdspv'];
																$results = $res_ss1;
															}else {
																$results = $results.','.$res_ss1;
															}
												        }
												        //VARIABEL VARIABEL UNTUK CASH VS LEASING
												        //========================================================================================================
												        $tunai = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'TUNAI' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $kredit = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'KREDIT' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        
												        //VARIABEL VARIABEL UNTUK NAMA LEASING
												        //=======================================================================================================
												        
												        $mbf = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'KREDIT' and kode_leasing = 'BLMR1' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $maf = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'KREDIT' and kode_leasing = 'MAF1' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $mtf = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'KREDIT' and kode_leasing = 'MTFSR1' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $may = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'KREDIT' and kode_leasing = 'MAYB1' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' ")); 
												        $bca = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'KREDIT' and kode_leasing = 'BCA L1' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        $other = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'KREDIT' and kode_leasing not in('BLMR1','MTFSR1','MAF1','MAYB1','BCA L1') and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' "));
												        
														$kdspv = '';
														
														while ($cd = mysql_fetch_array($tgt_ss)){
														//	$kode_ss = $kode_ss.','
															if ($kdspv == ''){
																$kdspv = $cd['kode_spv'];
																$targets = $cd['targetunit'];
															}else {
																$kdspv = $kdspv.','.$cd['kode_spv'];
																$targets = $targets.','.$cd['targetunit'];
															}
																
														}	
														
													/*	$results = '';
														while ($cd1 = mysql_fetch_array($res_ss)){
															if ($results == ''){
															//	$results = $cd1['kdspv'];
																$results = $res_ss1;
															}else {
															//	$results = $results.','.$cd1['kdspv'];
																$results = $res_ss1;
															}
																
														}	*/
														
												    ?>
												    
												    <script>
												        var brio    = "<?php echo $tot_brio; ?>";
												        var mobilio = "<?php echo $tot_mobilio; ?>";
												        var brv    = "<?php echo $tot_brv; ?>";
												        var hrv    = "<?php echo $tot_hrv; ?>";
												        var jazz    = "<?php echo $jazz; ?>";
												        var city    = "<?php echo $city; ?>";
												        var civic    = "<?php echo $civic; ?>";
												        var crv    = "<?php echo $crv; ?>";
												        var accord    = "<?php echo $accord; ?>";
												        var odyssey    = "<?php echo $odyssey; ?>";
												        var crz    = "<?php echo $crz; ?>";
														
														var kdspv = "<?php echo $kdspv; ?>";
												        
												        var target_henri = "<?php echo $target_henri; ?>";
												        var target_sudi = "<?php echo $target_sudi; ?>";
												        var target_wind = "<?php echo $target_wind; ?>";
												        var target_ibnu = "<?php echo $target_ibnu; ?>";
												        var target_indra = "<?php echo $target_indra; ?>";
												        var target_zain = "<?php echo $target_zain; ?>";
														var target_tiko = "<?php echo $target_tiko; ?>";
														var tgt_ss = "<?php echo $targets; ?>";
												        
												        var result_henri = "<?php echo $result_henri; ?>";
												        var result_sudi = "<?php echo $result_sudi; ?>";
												        var result_wind = "<?php echo $result_wind; ?>";
												        var result_ibnu = "<?php echo $result_ibnu; ?>";
												        var result_indra = "<?php echo $result_indra; ?>";
												        var result_zain = "<?php echo $result_zain; ?>";
														var result_tiko = "<?php echo $result_tiko; ?>";
														var res_ss = "<?php echo $results; ?>";
														
												        
												        var tunai = "<?php echo $tunai; ?>";
												        var kredit = "<?php echo $kredit; ?>";
												        
												        var mbf = "<?php echo $mbf; ?>";
												        var maf = "<?php echo $maf; ?>";
												        var mtf = "<?php echo $mtf; ?>";
												        var may = "<?php echo $may; ?>";
												        var bca = "<?php echo $bca; ?>";
												        var other = "<?php echo $other; ?>";
												        
												    </script>
												    
													<div id="chart" class="tab-pane padding-bottom-5 " >
														<div class = "row">
															<div class = "col-md-6">
															<h1 class="mainTitle">Penjualan Per Tipe</h1>
																
																		<canvas id="barChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="barLegend" class="chart-legend"></div>
																		</div>
																	
															</div>
															<div class = "col-md-6" hidden>
															<h1 class="mainTitle">Penjualan Per Team</h1>
																
																		<canvas id="lineChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="lineLegend" class="chart-legend"></div>
																		</div>
																	
															</div>
															<div class = "col-md-6">
															<h1 class="mainTitle">Penjualan Per Team</h1>
																
																		<canvas id="lineChart1" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="lineLegend1" class="chart-legend"></div>
																		</div>
																	
															</div>
														</div>
														<div class = "row">
															<div class = "col-md-6">
															<h1 class="mainTitle">Cash VS Leasing</h1>
																
																		<canvas id="pieChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="pieLegend" class="chart-legend"></div>
																		</div>
																	
															</div>
															<div class = "col-md-6">
															<h1 class="mainTitle">Leasing Company</h1>
																
																		<canvas id="doughnutChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="doughnutLegend" class="chart-legend"></div>
																		</div>
																	
															</div>
														</div>
														
														
													</div>
													
													<?php  
													///////////////////////////////////////////////////////////////////////////////
													//////////////////////////////////////////////////////////////////////////////
													if ($thn_akhir - $thn_awal > 0){	
														$query5 = mysql_query("select * from target_serviceadvisor where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) and nama_sa = '$_GET[nama_sa]' group by nama_sa");
														
													}else{
														$query5 = mysql_query("select * from target_serviceadvisor where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and nama_sa ='$_GET[nama_sa]' group by nama_sa");
													}
													//$query_tgtspv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
													
												//	$query_tgtspv = mysql_query("select * from target_spv where bulan = '$bulan'");
														while ($data_targetsa2 = mysql_fetch_array($query5))
														{
														$kode_sa = $data_targetsa2['nama_sa'];  
														
																			        
													?>
													
													<div id="<?php echo $kode_sa; ?>" class="tab-pane padding-bottom-5 active"> 
														<div class="panel-scroll height-360">
															<?php
																/*
																$query = mysql_query("SELECT nm_sa from acchv where bulan = '$bulan' group by nm_sa");
																while ($r=mysql_fetch_array($query)){
																	$nama_sa = $nama_sa.$r[nm_sa];
																}
																$nama_sa = array("$nama_sa",1);
																 */
																 //echo $kode_sa;
															?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center; border-collapse:collapse" >
																		<thead>
																			<tr>
																				<td width="30" height="29">NO</td>
																			    <td>ITEM</td>												
																				
																				<td>TGT</td>
																				<td>P</td>
																			    <?php 
																					$tgl_doank = substr($_GET['tgl_akhir'],8,2); 
																					
																					$tgl_doank2 = $tgl_doank - 0;
																					
																					$tgl_sa = 1		;		  
																			        while ($tgl_sa < 32){
																						
																						echo "<td width='5%'><div>".$tgl_sa."</div></td>";
																						$tgl_sa ++;
																			        }
																			    ?>
																														
																				
																				<td>TOTAL</td>
																				<td>POINT</td>	
																				<td>%</td>
																															
																			</tr>
																		</thead>
																		<tbody>
																		    <?php 
																				if ($thn_akhir - $thn_awal > 0){
																					$query_sa2 = mysql_query("SELECT * FROM target_serviceadvisor where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) and nama_sa = '$kode_sa' or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) and nama_sa = '$kode_sa' group by kode_kategori order by urutan ");
																					$filter_sa = "(substring(convert(varchar,f.tanggal,102),1,4) = '$thn_awal' 
																								or substring(convert(varchar,f.tanggal,102),1,4) = '$thn_akhir') ";
																								
																				}else{
																					$query_sa2 = mysql_query("SELECT * FROM target_serviceadvisor where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and nama_sa = '$kode_sa' group by kode_kategori order by urutan ");
																					$filter_sa = " substring(convert(varchar,f.tanggal,102),1,4) = '$thn_awal' ";
																					
																					if ($bln_akhir - $bln_awal > 0 ){
																						$awal = $bln_awal;
																						$akhir = $bln_akhir;
																						
																						while ($akhir >= $awal){
																							
																							$akhir = $akhir -1;
																						}
																						$filter_sa2 = "(substring(convert(varchar,f.tanggal,102),6,2) = '01'
																						or substring(convert(varchar,f.tanggal,102),6,2) = '01')";
																						
																					}else{
																						$filter_sa2 = " and (substring(convert(varchar,f.tanggal,102),6,2) = '$bln_awal') ";
																						$tgl_akhir_sa = substr($tgl_akhir,9,2);
																						
																						$filter_sa3 = " and (substring(convert(varchar,f.tanggal,102),9,2) <= '$tgl_akhir_sa') ";
																					}

																				}
																				
																				$query_ppb = "select wo.penerima,f.Tanggal,Fd.kode_referensi,fd.nama_referensi from srvt_faktur F
																																					left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																					left join srvt_wo WO on wo.nomor = F.nomor_wo
																																					
																																					where convert(date,f.tanggal,105) >= '$tgl_awal' and  convert(date,f.tanggal,105) >= '$tgl_awal'
																																					
																																					
																																					and wo.penerima = '$kode_sa' 
																																					and fd.kode_referensi ='EX-PB/RU20'
																																					and f.batal = 0 order by f.tanggal ";	
																				
																				
																				
																				
																					
																			//	$query_sales = mysql_query("SELECT *, sum(target_unit) as target_unit FROM target_sales where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and kode_spv = '$kode_spvtarget' group by kode_sales order by grade desc");
																			       
																					
																					$grandtotal_kategori=0;
																					$rata2rasio = 0;
																					$total_record_extracare = 0;
																					$total_record_chemical = 0;
																					$total_rasio_chemical = 0;
																					$tot_count_memberstarnew = 0;
																					
																				   while ($data_sa2 = mysql_fetch_array($query_sa2))
																			        {
																			          
																					   $kategori = $data_sa2['kode_kategori'];
																					//	$qry_sls = mysql_query("select * from target_sales where kode_spv = '$kode_spvtarget' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and kode_sales = '$kode_sales' order by grade desc");
																					//	$num_row = mysql_num_rows($qry_sls);
																		    ?>
																								
																						
																							
																							<?php 
																								if ($thn_akhir - $thn_awal > 0){
																									$query_sa3 = mysql_query("SELECT * FROM target_serviceadvisor where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) and nama_sa = '$kode_sa' or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) and nama_sa = '$kode_sa' and kode_kategori = '$kategori' order by urutan ");
																								
																								}else{
																									$query_sa3 = mysql_query("SELECT * FROM target_serviceadvisor where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and nama_sa = '$kode_sa' and kode_kategori = '$kategori' order by urutan ");
																								}
																								$no = 1;
																								
																								$tot_kategori = 0;
																								$rasio_total = 0 ;
																								$jumlah_rasio = 0;
																								
																								
																								while ($data_sa3 = mysql_fetch_array($query_sa3)){
																									$kode_item = trim($data_sa3['kode_item']);
																									
																									echo "<tr><td>$no</td><td>$data_sa3[nama_item]</td>";
																									
																									if ($data_sa3['kode_item'] =='JASA GR' || $data_sa3['kode_item'] =='SPAREPART GR'  ){
																										echo "<td><div style='height:80px'><br/><br/><br/><span>".number_format($data_sa3['target_unit'],0,".",".")."</span></div></td>";
																										
																										}else {
																												echo "<td>$data_sa3[target_unit]</td>";

																										}																										
																										echo "<td>$data_sa3[target_point]</td>"	;
																										  
																										$tgl_no = 1;
																										
																										
																										
																										$tot_count = 0;
																										$tot_point_count = 0;
																										while ($tgl_no <32)
																										{
																											
																											$tanggalan = (strlen($tgl_no) < 2 ? "0".$tgl_no : $tgl_no );
																											$tgl_depan = substr($_GET['tgl_awal'],8,2);
																											$tgl_belakang = substr($_GET['tgl_akhir'],8,2);
																											$point_count = 0;
																											
																											$program = $data_sa3['program'];
																											
																											switch ($program){
																												case "STANDAR":   ///////////////////////////////
																												
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													
																													
																													
																													$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																		left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																		left join srvt_wo WO on wo.nomor = F.nomor_wo
																																		
																																		where convert(date,f.tanggal,105) = '$tglawal'
																																		
																																		
																																		and wo.penerima = '$kode_sa' 
																																		and fd.kode_referensi = '$data_sa3[kode_item]'
																																		and f.batal = 0 ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													
																													while ($data = sqlsrv_fetch_array($result)){
																														$row_count = $data['total'];
																													}
																													
																													
																													
																													
																												}else {
																													$row_count = "-";
																												}
																												
																												break;
																												
																												case "SPOORING":  /////////////////////////////////////
																												
																													if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																														
																														
																													
																														$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																														
																														//$tglakhir = "2017-12-".$tanggalan ;
																														
																														$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																			left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																			left join srvt_wo WO on wo.nomor = F.nomor_wo
																																			
																																			where convert(date,f.tanggal,105) = '$tglawal'
																																			
																																			
																																			and wo.penerima = '$kode_sa' 
																																			and fd.nama_referensi = '$data_sa3[kode_item]'
																																			and f.batal = 0 ";
																																		
																														$result = sqlsrv_query($conn, $querysadetail);		
																														while ($data = sqlsrv_fetch_array($result)){
																															$row_count = $data['total'];
																														}
																													
																													}else {
																														$row_count = "-";
																													}
																												
																												break;
																												
																												
																												case "LEFT":  /////////////////////////////////////
																												
																													if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																														
																														
																													
																														$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																														
																														//$tglakhir = "2017-12-".$tanggalan ;
																														
																														$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																			left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																			left join srvt_wo WO on wo.nomor = F.nomor_wo
																																			
																																			where convert(date,f.tanggal,105) = '$tglawal'
																																			
																																			
																																			and wo.penerima = '$kode_sa' 
																																			and LEFT(fd.Kode_Referensi,5) = '$data_sa3[kode_item]'
																																			and f.batal = 0 ";
																																		
																														$result = sqlsrv_query($conn, $querysadetail);		
																														while ($data = sqlsrv_fetch_array($result)){
																															$row_count = $data['total'];
																														}
																													
																													}else {
																														$row_count = "-";
																													}
																												
																												break;
																												
																												case "POLES":  /////////////////////////////////////
																												
																													if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																														$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																														
																														$querysadetail = "select wo.penerima,f.Tanggal,Fd.Kode_Referensi,fd.Nama_Referensi from srvt_faktur F
																																					left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																					left join srvt_wo WO on wo.nomor = F.nomor_wo
																																					
																																					where convert(date,f.tanggal,105) = '$tglawal'
																																					
																																					
																																					and wo.penerima = '$kode_sa' 
																																					and fd.Nama_Referensi like '%POLES%' 
																																					
																																					and f.batal = 0 order by f.tanggal ";
																																				
																														$result = sqlsrv_query($conn, $querysadetail);		
																														$row_count = 0;
																														$point_count_poles = 0;		
																														while ($data = sqlsrv_fetch_array($result)){
																															$query_package = mysql_query("select * from target_polesdua where kode_item = '$data[Kode_Referensi]' and bulan = '$bulan1'");
																													
																															while($data_poles = mysql_fetch_array($query_package)){	
																																	$row_count = $row_count + 1 ;
																																	$point_count_poles = $point_count_poles + $data_poles['point'];
																															}
																																	
																														}
																														
																														/*
																														
																														$query_poles = mysql_query("select * from target_poles where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
																														$row_count = 0;
																														$point_count_poles = 0;
																														while ($data_poles = mysql_fetch_array($query_poles)){
																															$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																															
																															//if ($data_poles['paket'] == 'COMPLETE PACKAGE' and $data_poles['jenis'] == 'MEDIUM' ){
																															//$tglakhir = "2017-12-".$tanggalan ;
																															
																																
																																//$jumlah = sqlsrv_num_rows($result);
																																
																																$params = array();
																																$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																																$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																																$point_count_poles = $point_count_poles + (sqlsrv_num_rows($row) * $data_poles['point']);
																																$row_count = sqlsrv_num_rows($row);																														
																															//}
																														}
																															
																														*/
																													}else {
																														$row_count = "-";
																														$point_count_poles = 0;
																													}
																												
																												break;
																												
																												
																												case "PPB":  /////////////////////////////////////
																													
																													if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan){
																														
																														
																														$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																														
																														
																														$querysadetail = "select wo.penerima,f.Tanggal,Fd.Kode_Referensi,fd.Nama_Referensi from srvt_faktur F
																																					left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																					left join srvt_wo WO on wo.nomor = F.nomor_wo
																																					
																																					where convert(date,f.tanggal,105) = '$tglawal'
																																					
																																					
																																					and wo.penerima = '$kode_sa' 																																
																																					and fd.nama_referensi like '%PPB%'
																																					and f.batal = 0";
																																	
																														$result_ppb = sqlsrv_query($conn, $querysadetail);		
																														$row_count = 0;
																														
																														while ($data_ppb = sqlsrv_fetch_array($result_ppb)){
																															
																															
																															$query_package = mysql_query("select * from target_pmpackagedua where kode_item = '$data_ppb[Kode_Referensi]' and bulan = '$bulan1'");
																															
																															while($data_pm = mysql_fetch_array($query_package)){
																																	$row_count = $row_count + 1 ;
																																	$point_count = $point_count + $data_pm['point'];
																																	//$point_count = $point_count + 1;
																															}
																															
																															
																														}
																														
																														
																													
																													}else {
																														$row_count = "-";
																														$point_count = 0;
																													}
																												
																												break;
																												
																												
																												case "BALANCE":  /////////////////////////////////////
																												
																													if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																														
																														
																													
																														$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																														
																														//$tglakhir = "2017-12-".$tanggalan ;
																														
																														$querysadetail = "select wo.penerima,f.Tanggal,
																																		CASE fd.Kode_Referensi
																																		 WHEN 'G-B/S005' THEN 5
																																		 WHEN 'G-B/S004' THEN 4
																																		 WHEN 'G-B/G118' THEN 4
																																		 WHEN 'G-B/S003' THEN 3
																																		 WHEN 'G-B/S002' THEN 2
																																		 WHEN 'G-B/S001' THEN 1
																																		 
																																			END AS total_balance,
																																			Fd.* from srvt_faktur F
																																			left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																			left join srvt_wo WO on wo.nomor = F.nomor_wo
																																			
																																			where convert(date,f.tanggal,105) = '$tglawal'
																																			
																																			
																																			and wo.penerima = '$kode_sa' 
																																			and fd.kode_referensi in ('G-B/S001','G-B/S002','G-B/S003','G-B/S004','G-B/S005','G-B/G118')
																																			and f.batal = 0 order by f.tanggal ";
																																		
																														$result = sqlsrv_query($conn, $querysadetail);		
																														//$jumlah = sqlsrv_num_rows($result);
																														$row_count = 0;
																														while ($balance = sqlsrv_fetch_array($result)){
																															$row_count = $row_count + $balance['total_balance'];
																														}
																														
																														//$row_count = sqlsrv_num_rows($row);
																													
																													}else {
																														$row_count = "-";
																													}
																												
																												break;
																												
																												
																												case "DUNLOP":  /////////////////////////////////////
																												
																													if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																														
																														
																													
																														$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																														
																														//$tglakhir = "2017-12-".$tanggalan ;
																														
																														$querysadetail = "select wo.penerima,f.Tanggal,
																																		
																																			Fd.* from srvt_faktur F
																																			left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																			left join srvt_wo WO on wo.nomor = F.nomor_wo
																																			
																																			where convert(date,f.tanggal,105) = '$tglawal'
																																			
																																			
																																			and wo.penerima = '$kode_sa' 
																																			and LEFT(fd.Kode_Referensi,5) = '$data_sa3[kode_item]'
																																			and (fd.Nama_Referensi like '%DU%' or fd.Nama_Referensi like '%DLP%') 
																																			and f.batal = 0 order by f.tanggal ";
																																		
																														$result = sqlsrv_query($conn, $querysadetail);		
																														//$jumlah = sqlsrv_num_rows($result);
																														$row_count = 0;
																														while ($dunlop = sqlsrv_fetch_array($result)){
																															$row_count = $row_count + $dunlop['Qty'];
																														}
																														
																														//$row_count = sqlsrv_num_rows($row);
																													
																													}else {
																														$row_count = "-";
																													}
																												
																												break;
																												
																												
																												case "BRIDGESTONE":  /////////////////////////////////////
																												
																													if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																														
																														
																													
																														$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																														
																														//$tglakhir = "2017-12-".$tanggalan ;
																														
																														$querysadetail = "select wo.penerima,f.Tanggal,
																																		
																																			Fd.* from srvt_faktur F
																																			left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																			left join srvt_wo WO on wo.nomor = F.nomor_wo
																																			
																																			where convert(date,f.tanggal,105) = '$tglawal'
																																			
																																			
																																			and wo.penerima = '$kode_sa' 
																																			and LEFT(fd.Kode_Referensi,5) = '$data_sa3[kode_item]'
																																			and (fd.Nama_Referensi not like '%DU%' and fd.Nama_Referensi not like '%DLP%') 
																																			and f.batal = 0 order by f.tanggal ";
																																		
																														$result = sqlsrv_query($conn, $querysadetail);		
																														//$jumlah = sqlsrv_num_rows($result);
																														$row_count = 0;
																														while ($dunlop = sqlsrv_fetch_array($result)){
																															$row_count = $row_count + $dunlop['Qty'];
																														}
																														
																														//$row_count = sqlsrv_num_rows($row);
																													
																													}else {
																														$row_count = "-";
																													}
																												
																												break;
																												
																												case "DRESSING":  /////////////////////////////////////
																												
																													if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																														
																														
																													
																														$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																														
																														//$tglakhir = "2017-12-".$tanggalan ;
																														
																														$querysadetail = "select wo.penerima,f.Tanggal,
																																		
																																			Fd.* from srvt_faktur F
																																			left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																			left join srvt_wo WO on wo.nomor = F.nomor_wo
																																			
																																			where convert(date,f.tanggal,105) = '$tglawal'
																																			
																																			
																																			and wo.penerima = '$kode_sa' 																																			
																																			and fd.Nama_Referensi like '%DRESSING%'
																																			and f.batal = 0 order by f.tanggal ";
																																		
																														$result = sqlsrv_query($conn, $querysadetail);		
																														//$jumlah = sqlsrv_num_rows($result);
																														
																														$params = array();
																														$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																														$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																														
																														$row_count = sqlsrv_num_rows($row);
																														
																														//$row_count = sqlsrv_num_rows($row);
																													
																													}else {
																														$row_count = "-";
																													}
																												
																												break;
																												
																												
																												case "QTY":  /////////////////////////////////////
																												
																													if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																														
																														
																													
																														$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																														
																														//$tglakhir = "2017-12-".$tanggalan ;
																														
																														$querysadetail = "select wo.penerima,f.Tanggal,
																																		
																																			Fd.* from srvt_faktur F
																																			left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																			left join srvt_wo WO on wo.nomor = F.nomor_wo
																																			
																																			where convert(date,f.tanggal,105) = '$tglawal'
																																			
																																			
																																			and wo.penerima = '$kode_sa' 
																																			and fd.Kode_Referensi = '$data_sa3[kode_item]'																																			
																																			and f.batal = 0 order by f.tanggal ";
																																		
																														$result = sqlsrv_query($conn, $querysadetail);		
																														//$jumlah = sqlsrv_num_rows($result);
																														$row_count = 0;
																														while ($qty_data = sqlsrv_fetch_array($result)){
																															$row_count = $row_count + $qty_data['Qty'];
																														}
																														
																														//$row_count = sqlsrv_num_rows($row);
																													
																													}else {
																														$row_count = "-";
																													}
																												
																												break;
																												
																												case "LEFT 2":  /////////////////////////////////////
																												
																													if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																														
																														$query_left2 = mysql_query("select * from target_serviceadvisor_detail where kode_item = '$data_sa3[kode_item]' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
																														$row_count = 0 ;
																														while ($data_left2 = mysql_fetch_array($query_left2)){
																															
																															$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																															
																															$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																				left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																				left join srvt_wo WO on wo.nomor = F.nomor_wo
																																				
																																				where convert(date,f.tanggal,105) = '$tglawal'
																																				
																																				
																																				and wo.penerima = '$kode_sa' 
																																				and LEFT(fd.Kode_Referensi,5) = '$data_left2[kode_item_detail]'
																																				and f.batal = 0 order by f.tanggal ";
																																			
																															$result = sqlsrv_query($conn, $querysadetail);		
																															//$jumlah = sqlsrv_num_rows($result);
																															/*
																															$params = array();
																															$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																															$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																															
																															$row_count = $row_count + sqlsrv_num_rows($row);
																															*/
																															
																															while ($data_standar2 = sqlsrv_fetch_array($result)){
																																$row_count = $row_count + $data_standar2['total'];
																																if ($data_left2['kode_item'] == 'STAR MEMBER NEW'){
																																	$memberstarnew = $memberstarnew + $data_standar2['total'];
																																	
																																}
																																elseif ($data_left2['kode_item'] == 'STAR MEMBER EXT'){
																																	$memberstarext = $memberstarext + $data_standar2['total'];
																																	
																																}
																															}

																															
																														}
																														
																														
																													
																													}else {
																														$row_count = "-";
																													}
																												
																												break;
																												
																												case "STANDAR 2":  /////////////////////////////////////
																												
																													if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																														
																														$query_left2 = mysql_query("select * from target_serviceadvisor_detail where kode_item = '$kode_item' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
																														$row_count = 0 ;
																														$memberstarnew = 0;
																														while ($data_left2 = mysql_fetch_array($query_left2)){
																															
																															$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																															
																															$kode_standar = trim($data_left2['kode_item_detail']);
																															
																															$querysadetail = "select count(fd.kode_referensi) as total from srvt_faktur F
																																				left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																				left join srvt_wo WO on wo.nomor = F.nomor_wo
																																				
																																				where convert(date,f.tanggal,105) = '$tglawal'
																																				
																																				
																																				and wo.penerima = '$kode_sa' 
																																				and fd.Kode_Referensi = '$kode_standar'
																																				and f.batal = 0  ";
																																			
																															$result = sqlsrv_query($conn, $querysadetail);		
																															//$jumlah = sqlsrv_num_rows($result);
																															
																															while ($data = sqlsrv_fetch_array($result)){
																																$row_count = $row_count + $data['total'];
																																if ($data_left2['kode_item'] == 'STAR MEMBER NEW'){
																																	$memberstarnew = $memberstarnew + $data['total'];
																																	
																																}
																																elseif ($data_left2['kode_item'] == 'STAR MEMBER EXT'){
																																	$memberstarext = $memberstarext + $data['total'];
																																	
																																}
																															}

																															
																														}
																														
																														
																													
																													}else {
																														$row_count = "-";
																													}
																												
																												break;
																												
																												
																												
																											}
																											if ($data_sa3['kode_item'] == 'IU'){
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													//$tglakhir = "2017-12-".$tanggalan ;
																													
																													$querysadetail = "select count(f.nomor) as total from srvt_faktur f
																															left join srvt_wo wo on wo.nomor = f.Nomor_WO 																														
																															where convert(date,f.tanggal,105) = '$tglawal'
																																		
																																		
																															and wo.penerima = '$kode_sa' 
																															
																															
																															and f.batal = 0 ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																															//$jumlah = sqlsrv_num_rows($result);
																													while ($data = sqlsrv_fetch_array($result)){
																														$row_count = $data['total'];
																													}
																													
																													
																													
																												
																												
																												}else {
																													$row_count = "-";
																												}	
																											}
																											
																											if ($data_sa3['kode_item'] == 'ATF CHANGER'){
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													//$tglakhir = "2017-12-".$tanggalan ;
																													
																													$querysadetail = "select count(fd.Kode_Referensi) as total from srvt_faktur F
																																			left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																																			left join srvt_wo WO on wo.nomor = F.nomor_wo
																																			
																																			where convert(date,f.tanggal,105) = '$tglawal'
																																			
																																			
																																			and wo.penerima = '$kode_sa' 																																			
																																			and fd.Kode_Referensi ='G-B/S112' 
																																			and f.batal = 0";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																															//$jumlah = sqlsrv_num_rows($result);
																													while ($data = sqlsrv_fetch_array($result)){
																														$row_count = $data['total'];
																													}
																													
																													
																													
																												
																												
																												}else {
																													$row_count = "-";
																												}	
																											}
																											
																											
																											
																											if ($data_sa3['kode_item'] == 'JASA GR'){
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													//$tglakhir = "2017-12-".$tanggalan ;
																													
																													$querysadetail = "select sum(fd.subtotal) as total from srvt_faktur F
																															left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																															left join srvt_wo WO on wo.nomor = F.nomor_wo
																																																																
																															where convert(date,f.tanggal,105) = '$tglawal'
																																		
																																		
																																		and wo.penerima = '$kode_sa' 
																															and (fd.Jenis = 3 or fd.Jenis = 2)
																															
																															and f.batal = 0 group by wo.Penerima ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													
																													$row_count = 0;
																													while ($dunlop = sqlsrv_fetch_array($result)){
																														$row_count = $dunlop['total'];
																													}
																													
																												
																												
																												}else {
																													$row_count = "-";
																												}	
																											}
																											
																											if ($data_sa3['kode_item'] == 'SPAREPART GR'){
																												if ($tgl_no <= $tgl_belakang and $tgl_no >= $tgl_depan ){
																													
																													
																												
																													$tglawal = $thn_awal."-".$bln_awal."-".$tanggalan ;
																													
																													//$tglakhir = "2017-12-".$tanggalan ;
																													
																													$querysadetail = "select sum(fd.subtotal) as total from srvt_faktur F
																															left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																															left join srvt_wo WO on wo.nomor = F.nomor_wo
																																																																
																															where convert(date,f.tanggal,105) = '$tglawal'
																																		
																																		
																																		and wo.penerima = '$kode_sa' 
																															and (fd.Jenis = 1 or fd.jenis = 4)
																															
																															and f.batal = 0 group by wo.Penerima ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													
																													$row_count = 0;
																													while ($dunlop = sqlsrv_fetch_array($result)){
																														$row_count = $dunlop['total'];
																													}
																													
																												
																												
																												}else {
																													$row_count = "-";
																												}	
																											}
																											
																											
																											
																											
																											
																											//$result = $row_count;
																											$result = ($row_count == 0 ? '' : number_format($row_count,0,".","."));
																										
																											if ($data_sa3['kode_item'] =='JASA GR' || $data_sa3['kode_item'] =='SPAREPART GR'  ){
																												//echo "<td><div><br/><br/><br/><span>".number_format($row_count,0,".",".")."</span></div></td>";
																												echo "<td><div><br/><br/><br/><span>".$result."</span></div></td>";
																											
																											}else {
																													//$result = ($row_count == 0 ? '' : number_format($row_count,0,".","."));
																													echo "<td><div>$result</div></td>";

																											}
																											
																											if ($data_sa3['kode_item'] == 'STAR MEMBER NEW'){
																												$tot_count_memberstarnew = $tot_count_memberstarnew + $memberstarnew;
																											}
																											
																											$tot_count = $tot_count + $row_count;
																											$tot_point_count = $tot_point_count +$point_count;
																											
																											$tot_point_count_poles = $tot_point_count_poles + $point_count_poles;
																											$tgl_no++;
																										}
																										
																										
																									/////////// DARI KATEGORI  //////////////	
																									if ($data_sa3['kode_kategori'] == 'EXTRA CARE'){
																										
																										$total_point_ectracare = $tot_count * $data_sa3['target_point'];
																										$tot_kategori_extracare = $tot_kategori_extracare + $total_point_ectracare + $tot_point_count;
																										if ($data_sa3['target_unit'] == '0'){
																											$total_record_extracare = $total_record_extracare + 0;
																										}else{
																											$total_record_extracare = $total_record_extracare + 1;
																										}
																										$total_rasio_extracare = $total_rasio_extracare+(($tot_count / $data_sa3['target_unit']) > 1 ? 100 :round(($tot_count / $data_sa3['target_unit'])*100,2));
																										//$tot_kategori_extracare = 1575;
																									}
																									
																									if ($data_sa3['kode_kategori'] == 'PART & CHEMICALS'){
																										if ($data_sa3['target_unit'] == '0'){
																											$total_record_chemical = $total_record_chemical + 0;
																										}else{
																											$total_record_chemical = $total_record_chemical + 1;
																										}
																										$total_rasio_chemical = $total_rasio_chemical + (($tot_count / $data_sa3['target_unit']) > 1 ? 100 :round(($tot_count / $data_sa3['target_unit'])*100,2));
																									
																									}

																									
																									if ($data_sa3['kode_item'] =='JASA GR' || $data_sa3['kode_item'] =='SPAREPART GR' || $data_sa3['kode_item'] =='IU' ){																									
																										
																										
																									}else{
																									
																										$total_point = $tot_count * $data_sa3['target_point'];
																										$tot_kategori = $tot_kategori + $total_point + $tot_point_count_poles + $tot_point_count;
																									}
																									
																									
																									
																									
																									if ($data_sa3['kode_item'] =='JASA GR' || $data_sa3['kode_item'] =='SPAREPART GR' || $data_sa3['kode_item'] =='IU' ){	
																										if ($data_sa3['kode_item'] =='IU'){
																											
																											$querysadetail = "select wo.NoPolisi,convert(varchar,wo.Tanggal,103) as tgl_wo,convert(varchar,f.Tanggal,103) as tgl_faktur, F.total from srvt_faktur f
																															left join srvt_wo wo on wo.nomor = f.Nomor_WO and wo.batal = 0																													
																															where convert(date,f.tanggal,105) >= '$tgl_awal' AND convert(date,f.tanggal,105) <= '$tgl_akhir'	
																																		
																															and wo.penerima = '$kode_sa' 
																															and left(wo.keluhan,5) != 'KUPON' 
																															and f.total != 0
																															and f.batal = 0 order by wo.NoPolisi ";
																																	
																													$result = sqlsrv_query($conn, $querysadetail);		
																													$tot_count = 0;
																													while ($data = sqlsrv_fetch_array($result)){
																														if ($data['NoPolisi'] == $nopolisi_sblm and ($data['tgl_wo'] == $tglwo_sblm or $data['tgl_faktur'] == $tglfaktur_sblm ) ){
																															
																															
																														}else{
																															$tot_count = $tot_count + 1;
																														}
																														
																														$nopolisi_sblm = $data['NoPolisi'];
																														$tglwo_sblm = $data['tgl_wo'];
																														$tglfaktur_sblm = $data['tgl_faktur'];
																													}
																											
																											
																											
																											echo "<td>". number_format($tot_count,0,".",".")."</td>";
																											
																											if ($tot_count / $data_sa3['target_unit'] >= 1){
																												$total_point = $data_sa3[target_point];
																											}else{
																												$total_point = 0;
																											}
																											$tot_kategori = $tot_kategori + $total_point ;
																											
																											
																										}else{
																											if ($tot_count / $data_sa3['target_unit'] >= 1){
																												$total_point = $data_sa3[target_point];
																											}else{
																												$total_point = 0;
																											}
																											$tot_kategori = $tot_kategori + $total_point ;
																											
																											echo "<td><div><br/><br/><br/><span>". number_format($tot_count,0,".",".")."</span></div></td>";
																										}
																										
																										if ($tot_count / $data_sa3['target_unit'] >= 1){
																											echo "<td>$data_sa3[target_point]</td>";
																										}else{
																											echo "<td>0</td>";
																										}
																										
																									}else {
																											echo "<td><div>$tot_count</div></td>";
																											if ($data_sa3['kode_item'] =='PM PACKAGE'){
																												echo "<td>".ceil($tot_point_count)."</td>";
																											}else if($data_sa3['kode_item'] =='POLES'){
																												echo "<td>".ceil($tot_point_count_poles)."</td>"; 
																											}
																											
																											else{
																												echo "<td>".$total_point."</td>";
																											}

																									}	
																									
																									
																									//echo "<td>$tot_count </td>";
																									
																									
																									$rasio = (($tot_count / $data_sa3['target_unit']) > 1 ? 100 :round(($tot_count / $data_sa3['target_unit'])*100,2));
																									$rasio_total = $rasio_total + $rasio ;
																									
																									echo "<td>".$rasio ."</td>";
																									
																									echo	 "</tr>";
																									
																									if ($data_sa3['target_unit'] == '0'){
																										$jumlah_rasio = $jumlah_rasio + 0;
																									}else{
																										$jumlah_rasio = $jumlah_rasio + $data_sa3['fix_pembagi'];
																									}
																									
																									
																									$no ++;
																									
																									
																									
																									
																								}
																								
																								
																								
																								$persen_rasio = $rasio_total/$jumlah_rasio;
																								
																								
																								
																								$grand_total_kategori_rasio = $grand_total_kategori_rasio + $persen_rasio;
																								$grandtotal_kategori = $grandtotal_kategori + $tot_kategori;
																								
																								
																								
																							?>																		
																								<tr >
																									<td colspan=36 align=left style="background-color:darkgrey;"><?php echo $kategori; ?></td>
																									<td style="background-color:darkgrey;"><?php echo number_format($tot_kategori,0,".","."); ?></td>
																									<td style="background-color:darkgrey;"><?php echo round($persen_rasio,2); ?></td>
																																										
																								</tr>
																								
																								
																			<?php
																			        }
																					
																					$grand_total_kategori_rasio = round(($grand_total_kategori_rasio - round($total_rasio_chemical/$total_record_chemical,2)) / 5,2); 
																					$grandtotal_kategori = ($grandtotal_kategori - $tot_kategori_extracare);
																					
																					$dasar_perhitungan_incentif = (($grandtotal_kategori * ($grand_total_kategori_rasio/100)) + $tot_kategori_extracare) * 1000;
																					
																					$total_incentif = $dasar_perhitungan_incentif*0.7;
																					$pengurang_incentif = $total_incentif * 0.1;
																			?>
																						<tr >
																							<td colspan=36 align=left style="background-color:darkgrey;"><?php echo "TOTAL"; ?></td>
																							<td style="background-color:darkgrey;"><?php echo number_format($grandtotal_kategori,0,".","."); ?></td>
																							<td style="background-color:darkgrey;"><?php echo $grand_total_kategori_rasio; ?></td>
																																								
																						</tr>
																						<tr >
																							<td colspan=36 align=left style="background-color:darkgrey;"><?php echo "GROSS INCENTIF"; ?></td>
																							<td colspan=2 style="background-color:darkgrey;"><?php echo number_format($dasar_perhitungan_incentif,0,".","."); ?></td>
																						</tr>
																						<tr >
																							<td colspan=36 align=left style="background-color:darkgrey;"><?php echo "TOTAL INCENTIF"; ?></td>
																							<td colspan=2 style="background-color:darkgrey;"><?php echo number_format($total_incentif - $pengurang_incentif - ($tot_count_memberstarnew * 10000),0,".","."); ?></td>
																						</tr>
																					
																		</tbody>
																	</table>
																</div>	
																<?php
																		
																		/*
																		echo $tot_kategori_extracare; 
																
																		$grand_total_kategori_rasio1 = (($grandtotal_kategori * ($grand_total_kategori_rasio/100)) + $tot_kategori_extracare) * 1000;
																		
																		echo "</br>".number_format($grand_total_kategori_rasio1,0,".",".") ;
																		echo  "</br>".number_format($grand_total_kategori_rasio1*0.7,0,".",".");
																		
																		
																		*/
																?>
																
															</div>
													</div>
																
																<?php 									
																	}
																?>
													
													
													
													<div id="PM_PACKAGE" class="tab-pane padding-bottom-5" >
															<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center; border-collapse:collapse" >
																		<thead>
																			<tr>
																				<td width="30" height="29">NO</td>
																			    <td>TIPE</td>												
																				
																				<td>PERIODE</td>
																				<td>OIL</td>
																			   							
																				
																				<td>P</td>
																				<td>QTY</td>	
																				
																															
																			</tr>
																		</thead>
																		<tbody>
													
														<?PHP
															$query5 = mysql_query("select * from target_pmpackage where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and
															(substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
															$nomor = 1;
															
															while ($data = mysql_fetch_array($query5)){
																$row_count = 0 ;
														?>
															<tr>
																	<td><?php echo $nomor; ?></td>	
																	<td><?php echo $data['type_item'] ?></td>	
																	<td><?php echo $data['periode'] ?></td>
																	<td><?php echo $data['oil'] ?></td>
																	<td><?php echo $data['point'] ?></td>
																	<?php
																		$bulan = $bln_awal.'-'.$thn_awal ;
																		
																		
																		if ($data['group_type'] == 'GROUP2' AND $data['periode'] == '3' and $data['oil'] == 'GOLD'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_sa]' 
																								and fd.Nama_Referensi like '%PPB%' and (fd.Nama_Referensi like '%BRIO%' or fd.Nama_Referensi like '%MOBILIO%' or fd.Nama_Referensi like '%JAZZ%' or fd.Nama_Referensi like '%HR-V%' or fd.Nama_Referensi like '%BRV%'
																								or fd.Nama_Referensi like '%CITY%' or fd.Nama_Referensi like '%CIVIC%' or fd.Nama_Referensi like '%CR-V%' or fd.Nama_Referensi like '%HRV%') 
																								and fd.Nama_Referensi like '%3%' and fd.Nama_Referensi like '%GOLD%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count = sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		
																		
																		
																		
																		
																		
																		
																		if ($data['group_type'] == 'GROUP2' AND $data['periode'] == '3' and $data['oil'] == 'GREEN'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_sa]' 
																								
																								and fd.Nama_Referensi like '%PPB%' and (fd.Nama_Referensi like '%BRIO%' or fd.Nama_Referensi like '%MOBILIO%' or fd.Nama_Referensi like '%JAZZ%' or fd.Nama_Referensi like '%HR-V 1.5%' or fd.Nama_Referensi like '%BRV%') 
																								and fd.Nama_Referensi like '%3%' and fd.Nama_Referensi like '%GREEN%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count = sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		
																		if ($data['group_type'] == 'GROUP2' AND $data['periode'] == '3' and $data['oil'] == 'BLUE'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_sa]' 
																								and fd.Nama_Referensi like '%PPB%' and (fd.Nama_Referensi like '%BRIO%' or fd.Nama_Referensi like '%MOBILIO%' or fd.Nama_Referensi like '%JAZZ%' or fd.Nama_Referensi like '%HR-V 1.5%' or fd.Nama_Referensi like '%BRV%') 
																								and fd.Nama_Referensi like '%3%' and fd.Nama_Referensi like '%BLUE%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count =  sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		
																		
																		
																		
																		//GROUP 2 6TAHUN ///////////////////////////////////////////// ;
																		if ($data['group_type'] == 'GROUP2' AND $data['periode'] == '6' and $data['oil'] == 'GOLD'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_sa]' 
																								
																								and fd.Nama_Referensi like '%PPB%' and (fd.Nama_Referensi like '%BRIO%' or fd.Nama_Referensi like '%MOBILIO%' or fd.Nama_Referensi like '%JAZZ%' or fd.Nama_Referensi like '%HR-V%' or fd.Nama_Referensi like '%BRV%'
																								or fd.Nama_Referensi like '%CITY%' or fd.Nama_Referensi like '%CIVIC%' or fd.Nama_Referensi like '%CR-V%' or fd.Nama_Referensi like '%HRV%') 
																								
																								and fd.Nama_Referensi like '%6 TAHUN%' and fd.Nama_Referensi like '%GOLD%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count =  sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		
																		
																		
																		if ($data['group_type'] == 'GROUP2' AND $data['periode'] == '6' and $data['oil'] == 'GREEN'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_sa]' 
																								and fd.Nama_Referensi like '%PPB%' and (fd.Nama_Referensi like '%BRIO%' or fd.Nama_Referensi like '%MOBILIO%' or fd.Nama_Referensi like '%JAZZ%' or fd.Nama_Referensi like '%HR-V 1.5%' or fd.Nama_Referensi like '%BRV%') 
																								and fd.Nama_Referensi like '%6 TAHUN%' and fd.Nama_Referensi like '%GREEN%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count =  sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		if ($data['group_type'] == 'GROUP2' AND $data['periode'] == '6' and $data['oil'] == 'BLUE'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_sa]' 
																								and fd.Nama_Referensi like '%PPB%' and (fd.Nama_Referensi like '%BRIO%' or fd.Nama_Referensi like '%MOBILIO%' or fd.Nama_Referensi like '%JAZZ%' or fd.Nama_Referensi like '%HR-V 1.5%' or fd.Nama_Referensi like '%BRV%') 
																								and fd.Nama_Referensi like '%6 TAHUN%' and fd.Nama_Referensi like '%BLUE%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count =  sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		
																		////////////////////////
																		
																		
																		////GROUP 1 (1TAHUN) / MINI ///////////////////////////
																		if ($data['group_type'] == 'GROUP1' AND $data['periode'] == 'MINI' and $data['oil'] == 'GREEN'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_sa]' 
																								
																								and fd.Nama_Referensi like '%PPB%' and fd.Nama_Referensi like '%MINI%' and fd.Nama_Referensi like '%GREEN%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count =  sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		if ($data['group_type'] == 'GROUP1' AND $data['periode'] == 'MINI' and $data['oil'] == 'GOLD'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_sa]' 
																								
																								and fd.Nama_Referensi like '%PPB%' and fd.Nama_Referensi like '%MINI%' and fd.Nama_Referensi like '%GOLD%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count =  sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}
																		
																		/// ODYSSEY DAN ACCORD 3TAHUN GOLD/////////////////////////

																		if ($data['group_type'] == 'GROUP4' AND $data['periode'] == '3' and $data['oil'] == 'GOLD'){
																			$querysadetail = "select wo.penerima,f.Tanggal,Fd.* from srvt_faktur F
																								left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
																								left join srvt_wo WO on wo.nomor = F.nomor_wo
																								
																								where convert(date,f.tanggal,105) >= '$_GET[tgl_awal]'	and convert(date,f.tanggal,105) <= '$_GET[tgl_akhir]'	
																								and wo.penerima = '$_GET[nama_sa]' 
																								
																								and fd.Nama_Referensi like '%PPB%' and (fd.Nama_Referensi like '%ACCORD%' or fd.Nama_Referensi like '%ODYSSEY%' ) 
																								and fd.Nama_Referensi like '%3%' and fd.Nama_Referensi like '%GOLD%'
																								and f.batal = 0 order by f.tanggal ";

																			$result = sqlsrv_query($conn, $querysadetail);		
																			//$jumlah = sqlsrv_num_rows($result);
																			
																			$params = array();
																			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
																			$row = sqlsrv_query( $conn, $querysadetail , $params, $options );
																			
																			$point_count = $point_count + (sqlsrv_num_rows($row) * $data['point']);
																			$row_count =  sqlsrv_num_rows($row);
																			//$row_count = 1 + 1;

																		}	
																		
																		
																		
																		
																		
																	
																	?>
																	<td><?PHP echo $row_count; ?></td>
																		
															</tr>			
																		
																	
														<?php
														$nomor ++;
															}
														?>
																		</tbody>
																	</table>
															</div>	
													</div>
													<div id="POLES" class="tab-pane padding-bottom-5" >
															<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center; border-collapse:collapse" >
																		<thead>
																			<tr>
																				<td width="30" height="29">NO</td>
																			    <td>PAKET</td>												
																				
																				<td>JENIS</td>
																				<td>POINT</td>
																			   							
																				
																				
																				<td>QTY</td>	
																				
																															
																			</tr>
																		</thead>
																		<tbody>
													
														<?PHP
															$query5 = mysql_query("select * from target_poles where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and
															(substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
															$nomor = 1;
															while ($data = mysql_fetch_array($query5)){
														?>
															<tr>
																	<td><?php echo $nomor; ?></td>	
																	<td><?php echo $data['paket'] ?></td>	
																	<td><?php echo $data['jenis'] ?></td>
																	<td><?php echo $data['point'] ?></td>
																	
																	<td>0</td>
																		
															</tr>			
																		
																	
														<?php
														$nomor ++;
															}
														?>
																		</tbody>
																	</table>
															</div>	
														
													</div>
													
													
													
													
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<?php }} ?>
								
								
								
								
								
							</div>
						</div>
						<!-- end: DYNAMIC TABLE -->
					</div>
				</div>
			
	<?php 
		break;
		case "tambah":
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$tanggal = date('Y-m-d',strtotime($_POST[tanggal]));
		$tanggal_post = $_POST[tanggal];
		$bulan_post = date('m-Y',strtotime($_POST[tanggal]));
        $tgl_input = date('Y-m-d H:i:s');
		if(count($_POST)) {
			mysql_unbuffered_query("insert into acchv (tanggal,bulan,id_item,total,package_point,nm_sa,tgl_input) values('$tanggal','$bulan_post','$_POST[id_item]','$_POST[total]','$_POST[package_point]','$_SESSION[username_service]','$tgl_input')");
			
				$msg = "							
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Data telah berhasil disimpan</div>";
								
		}
	?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Acchievement</h1>
									<span class="mainDescription">Input data baru</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Transaksi</span>
									</li>									
									<li class="active">
										<span>Acchievement</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" id="item_control" enctype="multipart/form-data" method="post" action="">
										<div class="row">
											<div class="col-md-12">
											<?php echo(isset ($msg) ? $msg : ''); ?>
												<div class="errorHandler alert alert-danger no-display">
													<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
												</div>
												<div class="successHandler alert alert-success no-display">
													<i class="fa fa-ok"></i> Your form validation is successful!
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														Tanggal <span class="symbol required"></span>
													</label>											
													
													<p class="input-group input-append datepicker date">
														<input type="text" class="form-control" name = "tanggal" id = "tanggal" required  />
														<span class="input-group-btn">
															<button type="button" class="btn btn-default">
																<i class="glyphicon glyphicon-calendar"></i>
															</button> </span>
													</p>
												</div>	
												<div class="form-group">
													<label for="form-field-select-2">
														Kategori <span class="symbol required"></span>
													</label>													
													<select name = "id_kategori" id="id_kategori" class = "form-control" required >														
														<option value="" selected>PILIH KATEGORI</option>
														<?php 
														if ($_SESSION[leveluser] == 'SA_GR'){
															$tampil=mysql_query("SELECT * FROM kategori where aktif = 'Y' and klasifikasi = 'GR'");
														}elseif ($_SESSION[leveluser] == 'SA_BP') {
															$tampil=mysql_query("SELECT * FROM kategori where aktif = 'Y' and klasifikasi = 'BP'");
														}else {
															$tampil=mysql_query("SELECT * FROM kategori where aktif = 'Y'");
														}
														
														while ($w = mysql_fetch_array($tampil)){															
															echo "<option value = '$w[id_kategori]'>$w[nm_kategori]</option>";															
														}
														?>
													</select>
												</div>
												<div class="form-group">
													<label for="form-field-select-2">
														Item <span class="symbol required"></span>
													</label>													
													<select name = "id_item" id = "id_item" class = "form-control" required >	
														<option value = "">PILIH ITEM</option>
													</select>
												</div>
												<div id = "package" class="form-group">
													<label for="form-field-select-2">
														Type Mobil <span class="symbol required"></span>
													</label>													
													<select name = "package_point" class = "form-control" >	
														<option value = "" selected>PILIH TYPE</option>
														<?php 
															$data = mysql_query("select * from pmpackage where aktif = 'Y'");
															while ($r = mysql_fetch_array($data)){
																echo "<option value = '$r[point]'>$r[type_mobil] - $r[periode] ($r[kategori])</option>";
															}
														?>
													</select>
												</div>
												
												<div class="form-group">
													<label class="control-label">
														Total <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" type="number" value = "<?php echo $r[nm_kategori]?>" onblur="this.value=this.value.toUpperCase()" placeholder="Total" class="form-control" id="total" name="total" required>
												</div>
											</div>											
										</div>
										<div class="row">
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Harus diisi
													<hr>
												</div>
											</div>
										</div>
										<div class="row">											
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_bodyrepair';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Cancel </span>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>

<?php	
	break;
	case "edituser":
	$a = "select * from asuransi where id_asuransi='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
				
	if(count($_POST)) {
		mysql_unbuffered_query("update asuransi set nm_asuransi = '$_POST[nm_asuransi]',aktif = '$_POST[aktif]' where id_asuransi = '$_GET[id]'");
		$msg = "							
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Data telah berhasil dirubah</div>";
	}
?>

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Edit Data Asuransi</h1>
									<!--span class="mainDescription">Melihat data seluruh sales, tambah sales dan hapus sales.</span-->
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Master Data</span>
									</li>
									<li>
										<span>Tabel Asuransi</span>
									</li>
									<li class="active">
										<span>Edit Data</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" id="frm_kategori" enctype="multipart/form-data" method="post" action="">
										<div class="row">
											<div class="col-md-12">
											<?php echo(isset ($msg) ? $msg : ''); ?>
												<div class="errorHandler alert alert-danger no-display">
													<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
												</div>
												<div class="successHandler alert alert-success no-display">
													<i class="fa fa-ok"></i> Your form validation is successful!
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														Nama Item <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" type="text" value = "<?php echo $r[nm_asuransi]?>" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Asuransi" class="form-control" id="nm_asuransi" name="nm_asuransi" required>
												</div>												
												<?php if ($r[aktif] == 'Y'){?>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio1" name="aktif" value="Y" checked = "checked">
													<label for="radio1">
														Yes
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="aktif" value="N">
													<label for="radio2">
														No
													</label>
												</div>
												<?php } else { ?>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio1" name="aktif" value="Y">
													<label for="radio1">
														Yes
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="aktif" value="N" checked="checked">
													<label for="radio2">
														No
													</label>
												</div>
												<?php } ?>
											</div>											
										</div>
										<div class="row">
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Harus diisi
													<hr>
												</div>
											</div>
										</div>
										<div class="row">											
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_master_list_asuransi';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Cancel </span>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>
<?php break;
}
} ?>