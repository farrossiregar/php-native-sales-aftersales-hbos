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
		//include "class_hitung_incentif.php"; 
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
											<input type = "hidden" name="module" value = "checklist_checklist_summary_pameran" />
											<div class="form-group">
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
													<option value="2017" <?php if ($_GET['tahun']=='2017'){echo "selected"; }?>> 2017 </option>
													<option value="2018" <?php if ($_GET['tahun']=='2018'){echo "selected"; }?>> 2018 </option>
													<option value="2019" <?php if ($_GET['tahun']=='2019'){echo "selected"; }?>> 2019 </option>
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
									function jin_date_sql($tgl_awal){
										$exp = explode('-',$tgl_awal);
										if(count($exp) == 3) {
											$tgl_awal = $exp[2].'-'.$exp[1].'-'.$exp[0];
										}
										return $tgl_awal;
									}
									
									
									
								$bulan = "$_GET[bulan]"."-"."$_GET[tahun]";
								$tahun_bulan = "$_GET[tahun]"."-"."$_GET[bulan]";
								if($bulan !="-") { 
											//	$faktur = mysql_query("select * from checklist_pameran where substr(periode_pameran_awal, 1, 7) >= '$tahun_bulan' and substr(periode_pameran_akhir, 1, 7) <= '$tahun_bulan'");
												$faktur = mysql_query("select * from checklist_pameran where substr(periode_pameran_awal, 1, 7) = '$tahun_bulan'");
												$tot_rec = mysql_num_rows($faktur);
												if ($tot_rec == '0') { echo "<div class='col-sm-12'> Tidak ada data pada periode Ini, silahkan pilih ulang </div>"; } else {
								?>
								
								<div class="col-sm-12">
									<div class="panel panel-white no-radius">
										<div class="panel-body no-padding">
											<div class="tabbable no-margin no-padding">
												<ul class="nav nav-tabs" id="myTab">
												    <!--li class="active padding-top-5 padding-left-5"> 
														<a data-toggle="tab" href="#chart">
															GRAFIK
														</a>
													</li-->
												    <li class=" active padding-top-5">
														<a data-toggle="tab" href="#incentif">
															SUMMARY PAMERAN
														</a>
													</li>
													<?php
														$pameran_pic = mysql_query("select pic_pameran from checklist_pameran where substr(periode_pameran_awal, 1, 7) = '$tahun_bulan'");
														while($data_pameran_pic = mysql_fetch_array($pameran_pic)){
													?>
													 <li class="padding-top-5">
														<a data-toggle="tab" href="#<?php echo $data_pameran_pic['pic_pameran'] ?>">
															<?php echo $data_pameran_pic['pic_pameran']; ?>
														</a>
													</li>
													<?php
														}
													?>
													
												</ul>
												
												<div class="tab-content">
													<div id="incentif" class="tab-pane padding-bottom-5 active">
														<div class="panel-scroll height-360">
																<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center;" >
																		<thead>
																			<tr style = "font-weight: bold;">
																			    <td>Periode Pengecekan</td>	
																				<td>PIC</td>
																				<td>Lokasi</td>
																				<td>Materi Promosi</td>
																				<td>Booth</td>
																				<td>Unit Display</td>
																				<td>Sales Person</td>
																				<td>Pencapaian (%)</td>									
																			</tr>
																		</thead>
																		<tbody>
																			<?php
																			//	$periode_pameran = mysql_query("select * from checklist_pameran where substr(periode_pameran_awal, 1, 7) >= '$tahun_bulan' and substr(periode_pameran_akhir, 1, 7) <= '$tahun_bulan'");
																				$periode_pameran = mysql_query("select * from checklist_pameran where substr(periode_pameran_awal, 1, 7) = '$tahun_bulan'");	
																				while($data_periode_pameran = mysql_fetch_array($periode_pameran)){
																			?>
																			<tr>
																			    <td><?php echo jin_date_sql($data_periode_pameran['periode_pameran_awal']).' - '.jin_date_sql($data_periode_pameran['periode_pameran_akhir']) ?></td>	
																				<td><?php echo $data_periode_pameran['pic_pameran'] ?></td>
																				<td><?php echo $data_periode_pameran['lokasi_pameran'] ?></td>
																				<td>
																					<?php
																						$bobot_materi_promosi = mysql_query("SELECT sum(bobot) as hasil_penilaian FROM standar_keputusan_pameran skp
																															left join checklist_pameran_detail cpd on skp.standar_keputusan = cpd.standar_keputusan
																															WHERE cpd.penilaian = 'Y' and skp.kategori_kontrol = 'materi_promosi' and cpd.no_pameran = '$data_periode_pameran[no_pameran]'");
																						$data_bobot_materi_promosi = mysql_fetch_array($bobot_materi_promosi);
																						echo $data_bobot_materi_promosi['hasil_penilaian'];
																					?>
																				</td>
																				<td>
																					<?php
																						$bobot_booth = mysql_query("SELECT sum(bobot) as hasil_penilaian FROM standar_keputusan_pameran skp
																															left join checklist_pameran_detail cpd on skp.standar_keputusan = cpd.standar_keputusan
																															WHERE cpd.penilaian = 'Y' and skp.kategori_kontrol = 'booth' and cpd.no_pameran = '$data_periode_pameran[no_pameran]'");
																						$data_bobot_booth = mysql_fetch_array($bobot_booth);
																						echo $data_bobot_booth['hasil_penilaian'];
																					?>
																				</td>	
																				<td>
																					<?php
																						$bobot_unit_display = mysql_query("SELECT sum(bobot) as hasil_penilaian FROM standar_keputusan_pameran skp
																															left join checklist_pameran_detail cpd on skp.standar_keputusan = cpd.standar_keputusan
																															WHERE cpd.penilaian = 'Y' and skp.kategori_kontrol = 'unit_display' and cpd.no_pameran = '$data_periode_pameran[no_pameran]'");
																						$data_bobot_unit_display = mysql_fetch_array($bobot_unit_display);
																						echo $data_bobot_unit_display['hasil_penilaian'];
																					?>
																				</td>
																				<td>
																					<?php
																						$bobot_sales_person = mysql_query("SELECT sum(bobot) as hasil_penilaian FROM standar_keputusan_pameran skp
																															left join checklist_pameran_detail cpd on skp.standar_keputusan = cpd.standar_keputusan
																															WHERE cpd.penilaian = 'Y' and skp.kategori_kontrol = 'sales_person' and cpd.no_pameran = '$data_periode_pameran[no_pameran]'");
																						$data_bobot_sales_person = mysql_fetch_array($bobot_sales_person);
																						echo $data_bobot_sales_person['hasil_penilaian'];
																					?>
																				</td>
																				<td>
																				<?php 
																					$pencapaian_pameran = $data_bobot_materi_promosi['hasil_penilaian'] + $data_bobot_booth['hasil_penilaian'] + $data_bobot_unit_display['hasil_penilaian'] + $data_bobot_sales_person['hasil_penilaian'];
																					
																					if($pencapaian_pameran < 100){
																						if($pencapaian_pameran >= 65 and $pencapaian_pameran < 100){
																							echo "<span class='label label-warning'>".$pencapaian_pameran."</span>";
																						}else{
																							echo "<span class='label label-danger'>".$pencapaian_pameran."</span>";
																						}
																					}else{
																						echo "<span class='label label-success'>".$pencapaian_pameran."</span>";
																					}
																					
																				?>
																				</td>									
																			</tr>
																			<?php
																				}
																			?>
																			<!--tr style = "font-weight: bold;">
																			    <td colspan = '3'>TOTAL</td>
																				<td>Materi Promosi</td>
																				<td>Booth</td>
																				<td>Unit Display</td>
																				<td>Sales Person</td>
																				<td>Pencapaian</td>									
																			</tr-->
																			<tr>
																			    <td colspan='12'></td> 
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
												       
												        $tot_brio = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'BRIO' and bulan ='$bulan' "));
												        $tot_mobilio = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'MOBILIO' and bulan ='$bulan' "));
												        $tot_brv = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'BR-V' and bulan ='$bulan' "));
												        $tot_hrv = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'HR-V' and bulan ='$bulan' "));
												        $jazz       = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'JAZZ' and bulan ='$bulan' "));
												        $city       = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'CITY' and bulan ='$bulan' "));
												        $civic      = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'HIVIC' and bulan ='$bulan' "));
												        $crv        = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'CR-V' and bulan ='$bulan' "));
												        $accord     = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'ACCORD' and bulan ='$bulan' "));
												        $odyssey    = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'ODYSSEY' and bulan ='$bulan' "));
												        $crz        = mysql_num_rows(mysql_query("select * from summary_faktur where model = 'CR-Z' and bulan ='$bulan' "));
												        
												        // VARIABEL VARIABEL UNTUK GRAFIK PENCAPAIAN PER SUPERVISOR
												        //===============================================================================================
												        
												        $target_henri = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'HENRI' and bulan ='$bulan' "));
												        $target_henri = $target_henri[target_unit];
												        
												        $target_sudi = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'SUDI' and bulan ='$bulan' "));
												        $target_sudi = $target_sudi[target_unit];
												        
												        $target_wind = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'WIND' and bulan ='$bulan' "));
												        $target_wind = $target_wind[target_unit];
												        
												        $target_ibnu = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'IBNU' and bulan ='$bulan' "));
												        $target_ibnu = $target_ibnu[target_unit];
												        
												        $target_indra = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'INDRA' and bulan ='$bulan' "));
												        $target_indra = $target_indra[target_unit];
												        
												        $target_zain = mysql_fetch_array(mysql_query("select * from target_spv where kode_spv = 'ZAIN' and bulan ='$bulan' "));
												        $target_zain = $target_zain[target_unit];
												        
												        $result_henri = mysql_num_rows(mysql_query("select * from summary_faktur where kode_spv = 'HENRI' and bulan ='$bulan' "));
												        $result_sudi = mysql_num_rows(mysql_query("select * from summary_faktur where kode_spv = 'SUDI' and bulan ='$bulan' "));
												        $result_wind = mysql_num_rows(mysql_query("select * from summary_faktur where kode_spv = 'WIND' and bulan ='$bulan' "));
												        $result_ibnu = mysql_num_rows(mysql_query("select * from summary_faktur where kode_spv = 'IBNU' and bulan ='$bulan' "));
												        $result_indra = mysql_num_rows(mysql_query("select * from summary_faktur where kode_spv = 'INDRA' and bulan ='$bulan' "));
												        $result_zain = mysql_num_rows(mysql_query("select * from summary_faktur where kode_spv = 'ZAIN' and bulan ='$bulan' "));
												        
												        //VARIABEL VARIABEL UNTUK CASH VS LEASING
												        //========================================================================================================
												        $tunai = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'TUNAI' and bulan ='$bulan' "));
												        $kredit = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'KREDIT' and bulan ='$bulan' "));
												        
												        //VARIABEL VARIABEL UNTUK NAMA LEASING
												        //=======================================================================================================
												        
												        $mbf = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'KREDIT' and kode_leasing = 'BLMR1' and bulan ='$bulan' "));
												        $maf = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'KREDIT' and kode_leasing = 'MAF1' and bulan ='$bulan' "));
												        $mtf = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'KREDIT' and kode_leasing = 'MTFSR1' and bulan ='$bulan' "));
												        $may = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'KREDIT' and kode_leasing = 'MAYB1' and bulan ='$bulan' ")); 
												        $bca = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'KREDIT' and kode_leasing = 'BCA L1' and bulan ='$bulan' "));
												        $other = mysql_num_rows(mysql_query("select * from summary_faktur where jenispenjualan = 'KREDIT' and kode_leasing not in('BLMR1','MTFSR1','MAF1','MAYB1','BCA L1') and bulan ='$bulan' "));
												        
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
												        
												        var target_henri = "<?php echo $target_henri; ?>";
												        var target_sudi = "<?php echo $target_sudi; ?>";
												        var target_wind = "<?php echo $target_wind; ?>";
												        var target_ibnu = "<?php echo $target_ibnu; ?>";
												        var target_indra = "<?php echo $target_indra; ?>";
												        var target_zain = "<?php echo $target_zain; ?>";
												        
												        var result_henri = "<?php echo $result_henri; ?>";
												        var result_sudi = "<?php echo $result_sudi; ?>";
												        var result_wind = "<?php echo $result_wind; ?>";
												        var result_ibnu = "<?php echo $result_ibnu; ?>";
												        var result_indra = "<?php echo $result_indra; ?>";
												        var result_zain = "<?php echo $result_zain; ?>";
												        
												        var tunai = "<?php echo $tunai; ?>";
												        var kredit = "<?php echo $kredit; ?>";
												        
												        var mbf = "<?php echo $mbf; ?>";
												        var maf = "<?php echo $maf; ?>";
												        var mtf = "<?php echo $mtf; ?>";
												        var may = "<?php echo $may; ?>";
												        var bca = "<?php echo $bca; ?>";
												        var other = "<?php echo $other; ?>";
												        
												    </script>
												    
													<!--div id="chart" class="tab-pane padding-bottom-5 active" >
														<div class = "row">
															<div class = "col-md-6">
															<h1 class="mainTitle">Penilaian Per Team</h1>
																<canvas id="barChart" class="full-width"></canvas>
																<div class="inline pull-left legend-xs">
																	<div id="barLegend" class="chart-legend"></div>
																</div>
																	
															</div>
															<div class = "col-md-6">
																<h1 class="mainTitle">Penjualan Per Team</h1>
																
																		<canvas id="lineChart" class="full-width"></canvas>
																		<div class="inline pull-left legend-xs">
																			<div id="lineLegend" class="chart-legend"></div>
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
														
													</div-->
													
													<?php  
													///////////////////////////////////////////////////////////////////////////////
													//////////////////////////////////////////////////////////////////////////////
													
													
													$pameran_pic = mysql_query("select pic_pameran from checklist_pameran where substr(periode_pameran_awal, 1, 7) = '$tahun_bulan'");
														while($data_pameran_pic = mysql_fetch_array($pameran_pic)){
													?>
													
													<div id="<?php echo $data_pameran_pic['pic_pameran'] ?>" class="tab-pane padding-bottom-5"> 
														<div class="panel-scroll height-360">
															<div class = "table-responsive">
																<?php
																	$detail_pameran = mysql_query("select * from checklist_pameran where substr(periode_pameran_awal, 1, 7) = '$tahun_bulan' and pic_pameran = '$data_pameran_pic[pic_pameran]'");
																	while ($data_detail_pameran = mysql_fetch_array($detail_pameran)){  
																?>
																<table class="table table-striped table-bordered table-hover table-full-width" id="sampl1" style= "text-align:center;" >
																	<thead>
																		<tr>
																			<div class="col-sm-4 pull-left">
																				<ul class="list-unstyled invoice-details padding-bottom-30 padding-top-10 text-dark">
																					<li>
																						<strong>No Pameran :</strong> <?php echo $data_detail_pameran['no_pameran'] ?>
																					</li>
																					<li>
																						<strong>Lokasi :</strong> <?php echo $data_detail_pameran['lokasi_pameran'] ?>
																					</li>
																					<li>
																						<strong>Jenis :</strong> <?php echo $data_detail_pameran['jenis_pameran'] ?>
																					</li>
																					<li>
																						<strong>PIC :</strong> <?php echo $data_detail_pameran['pic_pameran'] ?>
																					</li>
																					<li>
																						<strong>Periode :</strong> <?php echo jin_date_sql($data_detail_pameran['periode_pameran_awal'])." - ".jin_date_sql($data_detail_pameran['periode_pameran_akhir']) ?>
																					</li>
																				</ul>
																			</div>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<th>STANDAR KEPUTUSAN</th>
																			<th>HASIL PENILAIAN</th>
																			<th>BOBOT</th>												
																		</tr>
																		<?php
																			$pameran_detail = mysql_query("select * from checklist_pameran_detail where no_pameran = '$data_detail_pameran[no_pameran]'");
																			while ($data_pameran_detail = mysql_fetch_array($pameran_detail)){  
																		?>
																		<tr>
																			<td style="text-align:left;"><?php echo $data_pameran_detail['standar_keputusan'] ?></td>
																			<td style="text-align:left;">
																				<?php 
																					$penilaian = $data_pameran_detail['penilaian'] ;
																					if ($penilaian=="Y"){
																						echo "<i class='fa fa-check text-success'></i>";
																					}else{
																						echo "<i class='fa fa-close text-danger'></i>";
																					}
																				?>
																			</td>
																			<td style="text-align:left;">
																				<?php
																					$bobot_pameran = mysql_query("select bobot from standar_keputusan_pameran where standar_keputusan = '$data_pameran_detail[standar_keputusan]'");
																					while($data_bobot_pameran = mysql_fetch_array($bobot_pameran)){
																						if($data_pameran_detail['penilaian'] == 'Y'){
																							echo $data_bobot_pameran['bobot'];
																						}else{
																							echo "0";
																						}
																						
																					}
																				?>
																			</td>																			
																		</tr>
																		<?php
																			}
																		?>
																		<tr>
																			<td colspan = '2'><b style=color:#007aff>TOTAL PENCAPAIAN (%)</b></td>
																			<td style="text-align:left;">
																				<?php
																					$total_pencapaian = mysql_query("SELECT sum(bobot) as hasil_penilaian FROM standar_keputusan_pameran skp
																													left join checklist_pameran_detail cpd on skp.standar_keputusan = cpd.standar_keputusan
																													WHERE cpd.penilaian = 'Y' and cpd.no_pameran = '$data_detail_pameran[no_pameran]'");
																					$data_total_pencapaian = mysql_fetch_array($total_pencapaian);
																					if($data_total_pencapaian['hasil_penilaian'] < 100){
																						if($data_total_pencapaian['hasil_penilaian'] >= 65 and $data_total_pencapaian['hasil_penilaian'] < 100){
																							echo "<span class='label label-warning'>".$data_total_pencapaian['hasil_penilaian']."</span>";
																						}else{
																							echo "<span class='label label-danger'>".$data_total_pencapaian['hasil_penilaian']."</span>";
																						}
																					}else{
																						echo "<span class='label label-success'>".$data_total_pencapaian['hasil_penilaian']."</span>";
																					}
																					
																				?>
																			</td>
																		</tr>
																			<td colspan = '5'>
																				
																			</td>
																		<tr>
																		</tr>
																	</tbody>
																	
																</table>
																<br><br>
																<?php
																	}
																?>
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
} ?>