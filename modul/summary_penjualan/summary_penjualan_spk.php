<?php
session_start();
$level = $_SESSION['leveluser'];
										    
$cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 

");
$cek_akses2 = mysql_fetch_array($cek_akses);

										
if($cek_akses2['akses'] != 'Y'){

  
	include "modul/protected.php";

}else {
		switch($_GET[act]){
		//tampilkan data
		default:
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		//$bulan_sekarang = date("m-Y");
		//include "class_hitung_incentif.php"; 
?>
	
				

				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-7">
									<h1 class="mainTitle">Summary</h1>
									<span class="mainDescription">Pencapaian SPK</span>
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
											<input type = "hidden" name="module" value = "summary_penjualan_spk" />
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
													<option value="2017" <?php if ($_GET['tahun']=='2017'){echo "selected"; }?> > 2017 </option>
													<option value="2018" <?php if ($_GET['tahun']=='2018'){echo "selected"; }?> > 2018 </option>
													<option value="2019" <?php if ($_GET['tahun']=='2019'){echo "selected"; }?> > 2019 </option>
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
								
							/*	$bulan = "$_GET[bulan]"."-"."$_GET[tahun]";
								if($bulan !="-") { $faktur = mysql_query("select * from pesanan_kendaraan where bulan ='$bulan' and kode_spv != 'OFFCE' ");
												$tot_rec = mysql_num_rows($faktur);
												if ($tot_rec == '0') { echo "<div class='col-sm-12'> Tidak ada data pada periode Ini, silahkan pilih ulang </div>"; } else {	*/
								
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
								
								if($bulan !="-") { $faktur = mysql_query("select * from pesanan_kendaraan where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv != 'OFFCE' ");
												$tot_rec = mysql_num_rows($faktur);
												if ($tot_rec == '0') { echo "<div class='col-sm-12'> Tidak ada data pada periode Ini, silahkan pilih ulang </div>"; } else {
								?>
								
								<div class="col-sm-12">
									<div class="panel panel-white no-radius">
										<div class="panel-body no-padding">
											<div class="tabbable no-margin no-padding">
												<ul class="nav nav-tabs" id="myTab">
												    <li class="active padding-top-5 padding-left-5"> 
														<a data-toggle="tab" href="#chart">
															GRAFIK
														</a>
													</li>
												    <li class="padding-top-5">
														<a data-toggle="tab" href="#incentif">
															SS PERFORMANCE
														</a>
													</li>
													<?php 
												     //   $query = mysql_query("select * from target_spv where bulan = '$bulan' ");
														if ($thn_akhir - $thn_awal > 0){
															$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv");
														}else{
															$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv, bulan");
														}
															while ($data = mysql_fetch_array($query)){
															$kode_targetspv = $data[kode_spv];
													
												    ?>
												    <li class="padding-top-5" >
														<a data-toggle="tab" href="#<?php echo $kode_targetspv; ?>">
															<font color="<?php echo $data[warna]; ?>"><?php echo $kode_targetspv; ?> </font>
														</a>
													</li>
													
													<?php } ?>
													
													<!--li class="padding-top-5 padding-left-5">
														<a data-toggle="tab" href="#ariyanto">
															ARIYANTO
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#ihsan">
															IHSAN
														</a>
													</li>
													<li class="padding-top-5 padding-left-5">
														<a data-toggle="tab" href="#suherman">
															SUHERMAN
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#taufik">
															TAUFIK
														</a>
													</li>
													<li class="padding-top-5 padding-left-5">
														<a data-toggle="tab" href="#wahyu">
															WAHYU
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#yus">
															YUS
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#cecep">
															CECEP
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#ponco">
															PONCO
														</a>
													</li>
													<li class="padding-top-5">
														<a data-toggle="tab" href="#total">
															SUMMARY
														</a>
													</li-->
													
												</ul>
												<div class="tab-content">
													
												
													
													
													<div id="incentif" class="tab-pane padding-bottom-5">
														<div class="panel-scroll height-360">
														
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center;" >
																		<thead>
																			<tr style = "font-weight: bold;">
																			    <td>MODEL</td>												
																				<td>TGT</td>	
																			    <?php 
																			    //    $query = mysql_query("select * from target_spv where bulan = '$bulan'");
																				if ($thn_akhir - $thn_awal > 0){
																					$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv");
																					
																				}else{
																					$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv, bulan");
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
																		    //    $query_model = mysql_query("select * from target_marketing where bulan = '$bulan'");
																				if ($thn_akhir - $thn_awal > 0){
																					$query_model = mysql_query("select *, sum(target) as target from target_marketing  where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by model order by model asc");	
																				}else{
																					$query_model = mysql_query("select *, sum(target) as target from target_marketing  where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by model order by model asc");
																				}
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
    																				//    $query = mysql_query("select * from target_spv where bulan = '$bulan'");
																						if ($thn_akhir - $thn_awal > 0){
																							$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv");
																						}else{
																							$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv, bulan");
																						}
    																			        while ($data = mysql_fetch_array($query)){
    																			            echo "<td style='font-size:17px;'>";
    																			         //   $where = "select * from pesanan_kendaraan where kode_spv = '$data[kode_spv]' and model = '$model' and bulan = '$bulan'"; 
																							$where = "select * from pesanan_kendaraan where kode_spv = '$data[kode_spv]' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and model = '$model' and kode_spv != 'OFFCE' ";
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
    																			    //    $where = "select * from pesanan_kendaraan where model = '$model' and bulan = '$bulan' and kode_spv !='OFFCE' "; 
																						$where = "select * from pesanan_kendaraan where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and model = '$model' and kode_spv != 'OFFCE' ";
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
    																			    //    $query = "select * from pesanan_kendaraan where model = '$model' and bulan = '$bulan'"; 
																						$query = "select * from pesanan_kendaraan where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and model = '$model' and kode_spv != 'OFFCE' ";
    																				    $total = mysql_query($query);
    																				    $total_record = mysql_num_rows($total);
    																				    
    																				 //   $query = "select sum(discunit) as total_diskon from pesanan_kendaraan where model = '$model' and bulan = '$bulan'"; 
																						$query = "select sum(discunit) as total_diskon from pesanan_kendaraan where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and model = '$model' and kode_spv != 'OFFCE' ";
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
    																				//    $query = mysql_query("select * from target_spv where bulan = '$bulan'");
																						if ($thn_akhir - $thn_awal > 0){
																							$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv");
																						}else{
																							$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv, bulan");
																						}
    																			        while ($data = mysql_fetch_array($query)){
    																			            echo "<td style='font-size:17px;'>";
    																			        //  $where = "select * from pesanan_kendaraan where kode_spv = '$data[kode_spv]' and bulan = '$bulan'";
																							$where = "select * from pesanan_kendaraan where kode_spv = '$data[kode_spv]' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv != 'OFFCE' ";
																							
        																				    $total = mysql_query($where);
        																				    $total = mysql_num_rows($total);
        																				    echo "<b><font color='$data[warna]' >".$total."</font></b></td>";
    																			        }
    																				?>
    																			<td style="font-size:17px;">
    																			    <?php
    																			    //    $where = "select * from pesanan_kendaraan where bulan = '$bulan' and kode_spv != 'OFFCE'"; 
																						$where = "select * from pesanan_kendaraan where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv != 'OFFCE' ";
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
    																			    //    $query = "select * from pesanan_kendaraan where bulan = '$bulan' and diskon !=0"; 
																						$query = "select * from pesanan_kendaraan where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and diskon !=0 and kode_spv != 'OFFCE' ";
    																				    $total = mysql_query($query);
    																				    $total_record = mysql_num_rows($total);
    																				    
    																				//    $query = "select sum(diskon) as total_diskon from pesanan_kendaraan where bulan = '$bulan'"; 
																						$query = "select sum(diskon) as total_diskon from pesanan_kendaraan where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv != 'OFFCE' ";
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
                                													
                                												//	$query_tgtspv = mysql_query("select * from target_spv where bulan = '$bulan'");
																					if ($thn_akhir - $thn_awal > 0){
																						$query_tgtspv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv");
																						
																					}else{
																						$query_tgtspv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv, bulan");
																					}
                                																			        while ($data_targetspv = mysql_fetch_array($query_tgtspv)){
                                																			        $kode_spvtarget = $data_targetspv['kode_spv'];  
																													
																													if ($thn_akhir - $thn_awal > 0){
																														$jumlah_sales = mysql_query("select count(kode_sales) as kdsls from target_sales where kode_spv = '$kode_spvtarget' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) ");
																													}else{
																														$jumlah_sales = mysql_query("select count(kode_sales) as kdsls from target_sales where kode_spv = '$kode_spvtarget' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
																													}
																													$jumlah_sales2 = mysql_fetch_array($jumlah_sales);
																													$data_targetspv2 = $jumlah_sales2[kdsls] + $data_targetspv[target_unit];
                                																			        echo "<td style='font-size:17px;'><b><font color='$data_targetspv[warna]'>$data_targetspv2</font></b></td>";
                                																			        }				        
                                																			        
                                													?>
                                												<td colspan='3'></td>
																			</tr>
																			<tr>
																			    <td colspan='2'>RASIO %</td>
																			        <?php
    																				//    $query = mysql_query("select * from target_spv where bulan = '$bulan'");
																						if ($thn_akhir - $thn_awal > 0){
																							$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv");
																							
																						}else{
																							$query = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv, bulan");
																						}
    																			        while ($data = mysql_fetch_array($query)){
    																			            echo "<td>";
    																			        //    $where = "select * from pesanan_kendaraan where kode_spv = '$data[kode_spv]' and bulan = '$bulan'"; 
																						//	$where = "select * from pesanan_kendaraan where kode_spv = '$data[kode_spv]' and tanggal >='$tgl_awal' and tanggal <= '$tgl_akhir' and kode_spv != 'OFFCE' ";
																							if ($thn_akhir - $thn_awal > 0){
																								$where = "select *, count(kode_spv) as kodespv from pesanan_kendaraan where kode_spv = '$data[kode_spv]' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv";
																								
																							}else{
																								$where = "select *, count(kode_spv) as kodespv from pesanan_kendaraan where kode_spv = '$data[kode_spv]' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv, bulan";
																							}
        																				    $total = mysql_query($where);
																							$total2 = mysql_fetch_array($total);
																							$result = $total2[kodespv];
        																				    $total = mysql_num_rows($total);
																							$target = $data[target_unit];
																							
																							if ($thn_akhir - $thn_awal > 0){
																								$jumlah_sales = mysql_query("select count(kode_sales) as kdsls from target_sales where kode_spv = '$data[kode_spv]' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) ");
																							}else{
																								$jumlah_sales = mysql_query("select count(kode_sales) as kdsls from target_sales where kode_spv = '$data[kode_spv]' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
																							}
																							$jumlah_sales2 = mysql_fetch_array($jumlah_sales);
																							$target2 = $target + $jumlah_sales2[kdsls];

        																				    
        																				    
        																				    if ($target==0){
    																				            echo 0;
    																				        }
    																				        else {
    																				            if($total==0){
    																				                echo "<span class='label label-danger'>"."0%</span>";
    																				            }else {
    																				                $ratio = round(($result/$target2)*100,2);
    																				                 if ((round(($total/$target)*100,2))<100){
    																				                     if ($ratio >= 65 and $ratio < 100){
    																				                         echo "<span class='label label-warning'>".(round(($result/$target2)*100))."</span>";
    																				                     }
    																				                     else {
    																				                         echo "<span class='label label-danger'>".(round(($result/$target2)*100))."</span>";
    																				                     }
    																				                 }
    																				                 else{
    																				                     echo "<span class='label label-success'>".(round(($result/$target2)*100))."</span>";
    																				                 }
    																				                
    																				            }
    																				            
    																				            
    																				        }
    																				        $total_point_tipe = 0;
        																				    
        																				    
        																				    //echo "<b style=color:#007aff>".$total."</b></td>";
    																			        }
    																			        
    																				?>
																					<td colspan='3'></td>
																			</tr>
																			
																			<!--tr>
																			    <td colspan='2'>PENJ ACC(Rp)</td>
																			    	<?php  
                                													///////////////////////////////////////////////////////////////////////////////
                                													//////////////////////////////////////////////////////////////////////////////
                                													
                                												//	$query_tgtspv = mysql_query("select * from target_spv where bulan = '$bulan'");
																					if ($thn_akhir - $thn_awal > 0){
																						$query_tgtspv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv");
																						
																					}else{
																						$query_tgtspv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv, bulan");
																					}
                                																			        while ($data_targetspv = mysql_fetch_array($query_tgtspv)){
                                																			        $kode_spvtarget = $data_targetspv['kode_spv'];  
                                																			        
                                																			        $query = mysql_query("select sum(hargajual) as hargajual from penjualan_aksesoris where bulan = '$bulan' and kode_spv = '$kode_spvtarget' ");
																													$query = mysql_query("select sum(hargajual) as hargajual from penjualan_aksesoris where kode_spv = '$kode_spvtarget' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' ");
																													
                                																			        $data = mysql_fetch_array($query);
                                																			        $hargajual = substr(number_format($data[hargajual],0,".","."),0,-4);
                                																			        echo "<td><b><font color='$data_targetspv[warna]'>$hargajual</font></b></td>";  
                                																			        
                                																			        }				        
                                																			        
                                													?>
                                												<td colspan='3'></td>
																			</tr-->
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
												       
												        $tot_brio = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where model = 'BRIO' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and kode_spv != 'OFFCE' "));
												        $tot_mobilio = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where model = 'MOBILIO' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and kode_spv != 'OFFCE' "));
												        $tot_brv = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where model = 'BR-V' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and kode_spv != 'OFFCE' "));
												        $tot_hrv = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where model = 'HR-V' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and kode_spv != 'OFFCE' "));
												        $jazz       = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where model = 'JAZZ' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and kode_spv != 'OFFCE' "));
												        $city       = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where model = 'CITY' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and kode_spv != 'OFFCE' "));
												        $civic      = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where model = 'HIVIC' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and kode_spv != 'OFFCE' "));
												        $crv        = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where model = 'CR-V' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and kode_spv != 'OFFCE' "));
												        $accord     = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where model = 'ACCORD' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and kode_spv != 'OFFCE' "));
												        $odyssey    = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where model = 'ODYSSEY' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and kode_spv != 'OFFCE' "));
												        $crz        = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where model = 'CR-Z' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <='$tgl_akhir' and kode_spv != 'OFFCE' "));
												        
												        // VARIABEL VARIABEL UNTUK GRAFIK PENCAPAIAN PER SUPERVISOR
												        //===============================================================================================
												        
												        $target_henri = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'HENRI' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
												        $target_henri = $target_henri[target_unit];
												        
												        $target_sudi = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'SUDI' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
												        $target_sudi = $target_sudi[target_unit];
												        
												        $target_wind = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'WIND' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
												        $target_wind = $target_wind[target_unit];
												        
												        $target_ibnu = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'IBNU' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
												        $target_ibnu = $target_ibnu[target_unit];
												        
												        $target_indra = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'INDRA' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
												        $target_indra = $target_indra[target_unit];
												        
												        $target_zain = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'ZAIN' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
												        $target_zain = $target_zain[target_unit];
														
														$target_wildy = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'WILDY' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
												        $target_wildy = $target_zain[target_unit];
														
														$tgt_ss = mysql_query("select *, sum(target_unit) as targetunit from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv asc");
													//	$tgt_ss = mysql_query("select *, sum(target_unit) as targetunit from target_spv where bulan = '$bulan' group by kode_spv order by kode_spv asc");
														
												        
												        $result_henri = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where kode_spv = 'HENRI' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
												        $result_sudi = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where kode_spv = 'SUDI' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
												        $result_wind = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where kode_spv = 'WIND' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
												        $result_ibnu = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where kode_spv = 'IBNU' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
												        $result_indra = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where kode_spv = 'INDRA' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
												        $result_zain = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where kode_spv = 'ZAIN' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
														$result_wildy = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where kode_spv = 'WILDY' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
														
													//	$spv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv asc");
													/*	$spv = mysql_query("select * from target_spv where bulan = '$bulan' order by kode_spv asc");
													
														$targets = '';
														$results = '';
														while ($spv2 = mysql_fetch_array($spv)){
															$spv3 = $spv2['kode_spv'];
															
															$res_ss = mysql_query("select * from pesanan_kendaraan where bulan = '$bulan' and kode_spv = '$spv3' and kode_spv != 'OFFCE' order by kode_spv asc");
														
															$res_ss1 = mysql_num_rows($res_ss);
															if ($results == ''){
															//	$results = $cd1['kdspv'];
																if($res_ss1 == 0){
																	$results = '0';
																}
															}else{
																$results = $results.','.$res_ss1;
															}
												        }	*/
														
														
													//	$spv = mysql_query("select * from target_spv where bulan = '$bulan' order by kode_spv asc");
														if ($thn_akhir - $thn_awal > 0){
															$spv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv");
															
														}else{
															$spv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv, bulan");
														}
															
													
														$targets = '';
														$results = '';
														while ($spv2 = mysql_fetch_array($spv)){
															$spv3 = $spv2['kode_spv'];
													
														//	$res_ss = mysql_query("select * from pesanan_kendaraan where bulan = '$bulan' and kode_spv = '$spv3' and kode_spv != 'OFFCE' order by kode_spv asc");
															$res_ss = mysql_query("select * from pesanan_kendaraan where kode_spv = '$spv3' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv != 'OFFCE' ");
															$res_ss1 = mysql_num_rows($res_ss);
														//	$res_ss1 = '1';
															if ($results == ''){
															
																	$results = $res_ss1;
															
															}else {
																$results = $results.','.$res_ss1;
																//$results = $res_ss1;
															}
												        }
													//	$results = $res_ss1;
														
												        
												        //VARIABEL VARIABEL UNTUK CASH VS LEASING
												        //========================================================================================================
												        $tunai = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where jenispenjualan = 'TUNAI' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
												        $kredit = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where jenispenjualan = 'KREDIT' and bulan ='$bulan' and kode_spv != 'OFFCE' "));
												        
												        //VARIABEL VARIABEL UNTUK NAMA LEASING
												        //=======================================================================================================
												        
												        $mbf = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where jenispenjualan = 'KREDIT' and kode_leasing = 'BLMR1' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv != 'OFFCE' "));
												        $maf = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where jenispenjualan = 'KREDIT' and kode_leasing = 'MAF1' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv != 'OFFCE' "));
												        $mtf = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where jenispenjualan = 'KREDIT' and kode_leasing = 'MTFSR1' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv != 'OFFCE' "));
												        $may = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where jenispenjualan = 'KREDIT' and kode_leasing = 'MAYB1' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv != 'OFFCE' ")); 
												        $bca = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where jenispenjualan = 'KREDIT' and kode_leasing = 'BCA L1' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv != 'OFFCE' "));
												        $other = mysql_num_rows(mysql_query("select * from pesanan_kendaraan where jenispenjualan = 'KREDIT' and kode_leasing not in('BLMR1','MTFSR1','MAF1','MAYB1','BCA L1') and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv != 'OFFCE' "));
														
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
														var target_wildy = "<?php echo $target_wildy; ?>";
														
														var tgt_ss = "<?php echo $targets; ?>";
												        
												        var result_henri = "<?php echo $result_henri; ?>";
												        var result_sudi = "<?php echo $result_sudi; ?>";
												        var result_wind = "<?php echo $result_wind; ?>";
												        var result_ibnu = "<?php echo $result_ibnu; ?>";
												        var result_indra = "<?php echo $result_indra; ?>";
												        var result_zain = "<?php echo $result_zain; ?>";
														var result_wildy = "<?php echo $result_wildy; ?>";
														
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
												    
													<div id="chart" class="tab-pane padding-bottom-5 active" >
														<div class = "row">
															<div class = "col-md-6">
															<h1 class="mainTitle">SPK Per Tipe</h1>
																
																		<canvas id="barChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="barLegend" class="chart-legend"></div>
																		</div>
																	
															</div>
															<div class = "col-md-6">
															<h1 class="mainTitle">SPK Per Team</h1>
																
																		<canvas id="lineChart1" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="lineLegend1" class="chart-legend"></div>
																		</div>
																	
															</div>
															<!--div class = "col-md-6">
															<h1 class="mainTitle">SPK Per Team1</h1>
																
																		<canvas id="lineChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="lineLegend" class="chart-legend"></div>
																		</div>
																	
															</div-->
														</div>
														<!--div class = "row">
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
														</div-->
														<!--div class = "row">
															<div class = "col-lg-6 col-md-12 col-sm-12">
															<h1 class="mainTitle">Plus +</h1>
																
																		<canvas id="barChart2" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="barLegend2" class="chart-legend"></div>
																		</div>
																
															</div>
															<div class = "col-lg-6 col-md-12 col-sm-12">
															<h1 class="mainTitle">Engine Oil</h1>
																
																		<canvas id="lineChart2" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="lineLegend2" class="chart-legend"></div>
																		</div>
																
															</div>
														</div-->
														
													</div>
													
													
													<?php  
													///////////////////////////////////////////////////////////////////////////////
													//////////////////////////////////////////////////////////////////////////////
													
												//	$query_tgtspv = mysql_query("select * from target_spv where bulan = '$bulan'");
																	if ($thn_akhir - $thn_awal > 0){
																		$query_tgtspv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by kode_spv order by kode_spv");
																		
																	}else{
																		$query_tgtspv = mysql_query("select * from target_spv where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by kode_spv order by kode_spv, bulan");
																	}
																			        while ($data_targetspv = mysql_fetch_array($query_tgtspv)){
																			        $kode_spvtarget = $data_targetspv['kode_spv'];  
																			        //echo "aaaaaabbbbbbbb";
																			        
													?>
													
													<div id="<?php echo $kode_spvtarget; ?>" class="tab-pane padding-bottom-5"> 
														<div class="panel-scroll height-360">
															<?php
																/*
																	$query = mysql_query("SELECT nm_sa from acchv where bulan = '$bulan' group by nm_sa");
																	while ($r=mysql_fetch_array($query)){
																		$nama_sa = $nama_sa.$r[nm_sa];
																	}
																	$nama_sa = array("$nama_sa",1);
																	 */
																?>
																
																
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center;" >
																		<thead>
																			<tr>
																			    <td><font color = "<?php echo $data_targetspv[warna]; ?>"><?php echo $kode_spvtarget; ?></font></td>												
																				<td>GRD</td>	
																				<td>TGT</td>
																			    <?php 
																			     //   $query = mysql_query("select * from target_marketing where bulan = '$bulan'");
																					 if ($thn_akhir - $thn_awal > 0){
																						$query = mysql_query("select *, sum(target) as target from target_marketing  where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) group by model order by model asc");
																						
																					}else{
																						$query = mysql_query("select *, sum(target) as target from target_marketing  where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') group by model order by model asc");
																					}
																			        while ($data = mysql_fetch_array($query)){
																						$singkatan_model = substr(str_replace("-","",$data[model]),0,3);
																			            
																						if ($singkatan_model =="CIT"){
																							$singkatan_model = "CTY";
																						}
																						if ($singkatan_model=="CIV"){
																							$singkatan_model = "CVC";
																						}
																						echo "<td width='5%'><div>".$singkatan_model."</div></td>";
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
																				<td>(T/K)</td>
																				<!--th>RATA2 DISKON</th-->												
																			</tr>
																		</thead>
																		<tbody>
																		    <?php 
																				if ($thn_akhir - $thn_awal > 0){
																					$query_sales = mysql_query("SELECT *, sum(target_unit) as target_unit FROM target_sales where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) and kode_spv = '$kode_spvtarget' or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) and kode_spv = '$kode_spvtarget' group by kode_sales order by grade desc");
																					
																				}else{
																					$query_sales = mysql_query("SELECT *, sum(target_unit) as target_unit FROM target_sales where (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir') and kode_spv = '$kode_spvtarget' group by kode_sales order by grade desc");
																				}
																		    //    $query_sales = mysql_query("select * from target_sales where kode_spv = '$kode_spvtarget' and bulan = '$bulan' order by grade desc");
																			        while ($sales = mysql_fetch_array($query_sales))
																			        {
																			           $nama_sales = trim($sales['nama_sales']);
																			           $kode_sales = trim($sales['kode_sales']);
																			           $grade = trim($sales['grade']);
																			           
																			           $target = $sales['target_unit'];
																					   $target2 = $target + 1;
																			           $target_point = $sales['target_point'];
																		    ?>
																			<tr>
																				
																				<td style="text-align:left;"><?php echo $kode_sales; ?></td>
																				<td><?php echo $grade; ?></td>
																				<td><?php echo $target2; ?></td>
																				
    																				<?php
    																				    $query = mysql_query("select * from model order by nama_model");
    																			        while ($data = mysql_fetch_array($query)){
    																			            echo "<td style='font-size:17px;'>";
    																			            $model = trim($data[nama_model]);
    																			        //    $where = "select * from pesanan_kendaraan where kode_sales = '$kode_sales' and model = '$model' and bulan = '$bulan' and kode_spv = '$kode_spvtarget' "; 
        																				    $where = "select * from pesanan_kendaraan where kode_sales = '$kode_sales' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and model = '$model' and kode_spv = '$kode_spvtarget' and kode_spv != 'OFFCE' ";
																							$total = mysql_query($where);
        																				    $total = mysql_num_rows($total);
        																				    $total_point =  $data[point] * $total;
        																				    $total_point_all =$total_point_all + $total_point;
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
    																				/*
    																				    $query_model = mysql_query("select * from model");
    																				    while ($data_model = mysql_fetch_array($query_model)){
    																				        $where = "select * from pesanan_kendaraan where kode_sales = '$kode_sales' and bulan = '$bulan' and kode_spv = '$kode_spvtarget' and model ='$data_model[nama_model]' "; 
    																				         $total = mysql_query($where);
    																				        $total = mysql_num_rows($total);
    																				        $total_point = $total * $data_model[point];
    																				        $total_point_tipe = $total_point_tipe + $total_point;
    																				    }
    																				    */
    																			    //    $where = "select * from pesanan_kendaraan where kode_sales = '$kode_sales' and bulan = '$bulan' and kode_spv = '$kode_spvtarget'"; 
																						$where = "select * from pesanan_kendaraan where kode_sales = '$kode_sales' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv = '$kode_spvtarget' and kode_spv != 'OFFCE' ";
    																				    $total = mysql_query($where);
    																				    $total = mysql_num_rows($total);
    																				    echo "<b>$total</b>";
    																				    
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
																				                $ratio = round(($total/$target2)*100,2);
																				                 if ((round(($total/$target2)*100,2))<100){
																				                     if ($ratio >= 65 and $ratio < 100){
																				                         echo "<span class='label label-warning'>".(round(($total/$target2)*100))."</span>";
																				                     }
																				                     else {
																				                         echo "<span class='label label-danger'>".(round(($total/$target2)*100))."</span>";
																				                     }
																				                 }
																				                 else{
																				                     echo "<span class='label label-success'>".(round(($total/$target2)*100))."</span>";
																				                 }
																				                
																				            }
																				            /*
																				            $ratio_point = round(($total_point_tipe/$target_point)*100,2);
																				            if ($ratio_point < 100) {
																				                if ($ratio_point >= 65 and $ratio_point < 100){
																				                    echo "  <span class='label label-warning'>".$ratio_point."%</span>";
																				                     }
																				                     else {
																				                         echo "  <span class='label label-danger'>".$ratio_point."%</span>";
																				                     }
																				                    
																				            }
																				            else{
																				                     echo "  <span class='label label-success'>".$ratio_point."%</span>";
																				                 }
																				            */
																				        }
																				        $total_point_tipe = 0;
																				    ?>
																				    
																				</td>
																				<td>
																				    <?php
    																				    
    																			       
    																				//    $total_kredit = mysql_query("select * from pesanan_kendaraan where kode_sales = '$kode_sales' and bulan = '$bulan' and kode_spv = '$kode_spvtarget' and jenispenjualan = 'KREDIT' ");
																						$total_kredit = mysql_query("select * from pesanan_kendaraan where kode_sales = '$kode_sales' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv = '$kode_spvtarget' and jenispenjualan = 'KREDIT' and kode_spv != 'OFFCE' ");
    																				    $total_kredit = mysql_num_rows($total_kredit);
    																				//    $total_tunai = mysql_query("select * from pesanan_kendaraan where kode_sales = '$kode_sales' and bulan = '$bulan' and kode_spv = '$kode_spvtarget' and jenispenjualan = 'TUNAI' ");
																						$total_tunai = mysql_query("select * from pesanan_kendaraan where kode_sales = '$kode_sales' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv = '$kode_spvtarget' and jenispenjualan = 'TUNAI' and kode_spv != 'OFFCE' ");
																						$total_tunai = mysql_num_rows($total_tunai);
    																				    echo "<b>$total_tunai / ".$total_kredit."</b>";
    																				    
    																				?>
																				</td>
																				<!--td>
																				    <?php
    																			     //   $query = "select * from pesanan_kendaraan where model = '$model' and bulan = '$bulan'"; 
																						$query = "select * from pesanan_kendaraan where model = '$model' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv != 'OFFCE' ";
    																				    $total = mysql_query($query);
    																				    $total_record = mysql_num_rows($total);
    																				    
    																				//    $query = "select sum(diskon) as total_diskon from pesanan_kendaraan where model = '$model' and bulan = '$bulan'"; 
																						$query = "select sum(diskon) as total_diskon from pesanan_kendaraan where model = '$model' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv != 'OFFCE' ";
    																				    $total = mysql_query($query);
    																				    $total_diskon = mysql_fetch_array($total);
    																				    $total_diskon = $total_diskon[total_diskon];
    																				    
    																				    //$rata2diskon = round($total_diskon / $total_record);
    																				    	$rata2diskon = "Rp ".number_format(round($total_diskon / $total_record),0,".",".");
    																				    echo $rata2diskon;
    																				?>
																				</td-->																				
																			</tr>
																			<?php
																			        }
																			?>
																			<tr>
																			    <td colspan = '2' ><b style=color:#007aff>TOTAL</b></td>
																			    <td>
																			        <?php
																			           
																			            $target_team = $data_targetspv[target_unit];
																					//	$jumlah_sales = mysql_query("select count(kode_sales) as kdsls from target_sales where kode_spv = '$kode_spvtarget' and tanggal >='$tgl_awal' and tanggal <= '$tgl_akhir' ");
																						if ($thn_akhir - $thn_awal > 0){
																							$jumlah_sales = mysql_query("select count(kode_sales) as kdsls from target_sales where kode_spv = '$kode_spvtarget' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) ");
																						}else{
																							$jumlah_sales = mysql_query("select count(kode_sales) as kdsls from target_sales where kode_spv = '$kode_spvtarget' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
																						}
																						$jumlah_sales2 = mysql_fetch_array($jumlah_sales);
																						$target_team2 = $target_team + $jumlah_sales2[kdsls];
																					//	$target_team2 = $target_team + 5;
																			            $target_team_point = $data_targetspv[target_point];
																			            echo "<b style=color:#007aff>$target_team2</b>";
																			           
																			        ?>
																			    </td>
																			    	<?php
    																				    $query = mysql_query("select * from model");
    																			        while ($data = mysql_fetch_array($query)){
    																			            echo "<td style='font-size:17px;'>";
    																			        //    $where = "select * from pesanan_kendaraan where model = '$data[nama_model]' and bulan = '$bulan' and kode_spv = '$kode_spvtarget' "; 
																							$where = "select * from pesanan_kendaraan where model = '$data[nama_model]' and substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv = '$kode_spvtarget' and kode_spv != 'OFFCE' ";
																							
        																				    $total = mysql_query($where);
        																				    $total = mysql_num_rows($total);
        																				    echo "<b style=color:#007aff>$total</b></td>";
    																			        }
    																				?>
    																			<td style="font-size:17px;">
    																			    <?php
    																			    //    $query1 = mysql_query("select * from pesanan_kendaraan where bulan = '$bulan' and kode_spv = '$kode_spvtarget'");
																						$query1 = mysql_query("select * from pesanan_kendaraan where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv = '$kode_spvtarget' and kode_spv != 'OFFCE' ");
    																				    $total = mysql_num_rows($query1);
    																				    /*
    																				    while ($data_faktur = mysql_fetch_array($query1)){
    																				        while ($data_model =mysql_fetch_array(mysql_query("select * from model "))){
    																				            if ($data_faktur[model] == $data_model[nama_model]){
    																				                $total_point = $data_model[point];
    																				            }
    																				        }
    																				        $total_point=$total_point + $total_point;
    																				    }
    																				    */
    																				    echo "<b>$total</b>";
    																				     
    																				?>
    																			</td>
    																			<td>
																				    <?php
																					
																						if ($thn_akhir - $thn_awal > 0){
																							$jumlah_sales = mysql_query("select count(kode_sales) as kdsls from target_sales where kode_spv = '$kode_spvtarget' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '12') and (substr(bulan,4,4) >= '$thn_awal' ) or (substr(bulan,1,2) >= '01' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_akhir' ) ");
																						}else{
																							$jumlah_sales = mysql_query("select count(kode_sales) as kdsls from target_sales where kode_spv = '$kode_spvtarget' and (substr(bulan,1,2) >= '$bln_awal' and substr(bulan,1,2) <= '$bln_akhir') and (substr(bulan,4,4) >= '$thn_awal' and substr(bulan,4,4) <= '$thn_akhir')");
																						}
																						$jumlah_sales2 = mysql_fetch_array($jumlah_sales);
																						
																						$target_team2 = $jumlah_sales2[kdsls] + $target_team;
																				        if ($total==0){
																				            echo 0;
																				        }
																				        else {
																				            $ratio = round(($total/$target_team2)*100);
																				            if ($ratio < 100){
																				                    if ($ratio >= 65 and $ratio < 100){
																				                         echo "<span class='label label-warning'>".$ratio."</span>";
																				                     }
																				                     else {
																				                         echo "<span class='label label-danger'>".$ratio."</span>";
																				                     }
																				            }
																				            else {
																				                echo "<span class='label label-success'>".(round(($total/$target_team2)*100))."</span>";
																				            }
																				            //<span class="label label-danger"> Danger</span>
																				            //echo (round(($total/$total_target)*100,2))."%";
																				        }
																				        /*
																				            $ratio = round(($total_point_all/$target_team_point)*100,2);
																				            if ($ratio < 100){
																				                    if ($ratio >= 65 and $ratio < 100){
																				                         echo " <span class='label label-warning'>".$ratio."%</span>";
																				                     }
																				                     else {
																				                         echo " <span class='label label-danger'>".$ratio."%</span>";
																				                     }
																				            }
																				            else {
																				                echo " <span class='label label-success'>".$ratio."%</span>";
																				            }
																				            */
																				        $total_point_all= 0;
																				    ?>
																				    
																				</td>
																				<td>
																				    <?php
    																				    
    																			       
    																				//    $total_kredit = mysql_query("select * from pesanan_kendaraan where bulan = '$bulan' and kode_spv = '$kode_spvtarget' and jenispenjualan = 'KREDIT' ");
																						$total_kredit = mysql_query("select * from pesanan_kendaraan where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv = '$kode_spvtarget' and jenispenjualan = 'KREDIT' and kode_spv != 'OFFCE' ");
    																				    $total_kredit = mysql_num_rows($total_kredit);
    																				//    $total_tunai = mysql_query("select * from pesanan_kendaraan where bulan = '$bulan' and kode_spv = '$kode_spvtarget' and jenispenjualan = 'TUNAI' ");
																						$total_tunai = mysql_query("select * from pesanan_kendaraan where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and kode_spv = '$kode_spvtarget' and jenispenjualan = 'TUNAI' and kode_spv != 'OFFCE' ");
    																				    $total_tunai = mysql_num_rows($total_tunai);
    																				    echo "<b>$total_tunai / ".$total_kredit."</b>";
    																				    
    																				?>
																				</td>
																				<!--td>
																				    <?php
    																			     //   $query = "select * from pesanan_kendaraan where bulan = '$bulan' and diskon !=0"; 
																						$query = "select * from pesanan_kendaraan where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir' and diskon !=0";
    																				    $total = mysql_query($query);
    																				    $total_record = mysql_num_rows($total);
    																				    
    																				//    $query = "select sum(diskon) as total_diskon from pesanan_kendaraan where bulan = '$bulan'"; 
																						$query = "select sum(diskon) as total_diskon from pesanan_kendaraan where substr(tanggal, 1, 11) >='$tgl_awal' and substr(tanggal, 1, 11) <= '$tgl_akhir'"; 
    																				    $total = mysql_query($query);
    																				    $total_diskon = mysql_fetch_array($total);
    																				    $total_diskon = $total_diskon[total_diskon];
    																				    
    																				    //$rata2diskon = round($total_diskon / $total_record);
    																				    	$rata2diskon = "Rp ".number_format(round($total_diskon / $total_record),0,".",".");
    																				    echo $rata2diskon;
    																				?>
																				</td-->	
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
			mysql_unbuffered_query("insert into acchv (tanggal,bulan,id_item,total,package_point,nm_sa,tgl_input) values('$tanggal','$bulan_post','$_POST[id_item]','$_POST[total]','$_POST[package_point]','$_SESSION[username]','$tgl_input')");
			
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
}
 ?>