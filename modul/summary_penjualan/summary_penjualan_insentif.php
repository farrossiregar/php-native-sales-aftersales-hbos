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
		
		//include "config/koneksi_sqlserverit.php";
		include "config/koneksi_sqlserver.php";
		include "../config/koneksi_service.php";
		//include "config/koneksi_online.php";
?>
	
				<script>
					function getSales(){
						var kode_spv = $('#kode_supervisor').val();
					//	alert(kode_spv);
						$.ajax({
							method : "post",
							data : "kode_spv="+kode_spv,
							url : "modul/summary_penjualan/get_salesman.php",
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
								<div class="col-sm-7">
									<h1 class="mainTitle">Summary</h1>
									<span class="mainDescription">Insentif Sales</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
							
								<div class = "col-md-6">
									<div class="form-group">
																					
										<form action = "<?php echo "$_SERVER[PHP_SELF]"; ?>" method = "GET">
											<input type = "hidden" name="module" value = "summary_penjualan_insentif" />
											
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
											
											
											
											
											<div class="progress-demo">
												<button type = "submit" class="btn btn-wide btn-primary ladda-button" data-style="expand-right" >
													<span class="ladda-label"><i class="fa fa-check"></i> Proses </span>
												</button>
											</div><br/>
											<label class="control-label">
											    <font color="red"><b>Note : </b></font>Sebelum Proses,Terlebih Dahulu Pilih <font color="red">Tanggal Faktur</font> Yang Akan di Tampilkan <span class="symbol required"></span>
													
									    	</label>
											<?php
												$tgl_awal = $_GET[tgl_awal];
												$tgl_akhir = $_GET[tgl_akhir];
											?>
											
											<div class="form-group">
												<i><b></b></i>
											</div>

											</form>	
										
										</div>						
									</div>
								
								<!------------------ UNTUK SS PERFORMANCE ------------------------------------------------------------------------------------------------>
								<?php 
									
									$tgl_awal = $_GET['tgl_awal'];
									$tgl_akhir = $_GET['tgl_akhir'];
									$kode_supervisor = $_GET['kode_supervisor'];
									
									if($waktu_booking != "-") { 
										$query = "select count(nomor) as total, convert(varchar,tglappfakpol()105) as tgl_faktur from vw_Insentifsos where convert(varchar,tglappfakpol()105) >= '$tgl_awal' and convert(varchar,tglappfakpol()105) <= '$tgl_akhir' and kode_supervisor = '$kode_supervisor'";
										
										$result = sqlsrv_query($conn, $query);		
										
										
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
												
													
													<li class="active padding-top-5 padding-left-5">
														<a data-toggle="tab" href="#SUMMARY">
															SUMMARY
														</a>
													</li>
													
												</ul>
											
											
											<div class="tab-content">
														<div id="SUMMARY" class="tab-pane padding-bottom-5 active" >
															<div class = "table-responsive">
																	<table class="table table-striped table-bordered table-hover table-full-width" id="sample1" style= "text-align:center; border-collapse:collapse" >
																		<thead>
																			<tr>
																				
																				<td width="30" height="29"><b>No</td>
																			    <td><b>Tipe</td>												
																				<td><b>Point</td>
																				<td><b>No Rangka</td>
																				<td><b>No Spk</td>
																				<td><b>Sales</td>
																				<td><b>SPV</td>																				
																				<td><b>Grade</td>
																				<td><b>Nama Stnk</td>
																				<td><b>Leasing</td>
																				<td><b>Tenor</td>												
																				<td><b>Tgl Faktur</td>
																				<td><b>Tgl Spk</td>
																				<td><b>Price List</td>
																				<td><b>Disc</td>
																				<td><b>Acc</td>																				
																				<td><b>Total 1</td>
																				<td><b>Asing Pembuat</td>
																				<td><b>Total 2</td>
																				<td><b>#</td>
																				<td><b>Plafon</td>												
																				<td><b>Selisih</td>
																				<td><b>Tabel</td>
																				<td><b>Ins Leasing</td>
																				<td><b>Ins Unit</td>
																				<td><b>Ins Acs</td>																				
																				<td><b>Ins P.Dok</td>
																				<td><b>Ins Ass</td>
																				<td><b>Progresif</td>
																				<td><b>Total Ins</td>
																			</tr>
																		</thead>
																		<tbody>
																	
													
															<?php

																	$tgl_akhir_doank = substr($_GET['tgl_akhir'],8,2); 
																	$tgl_awal_doank = substr($_GET['tgl_awal'],8,2); 
																		$nomor = 1;
																		//$tgl_doank2 = $tgl_doank - 0;
																	$query3 = "select * ,substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,convert(varchar,tglappfakpol,105) as tgl_faktur,convert(varchar,tgl_spk,105) as tgl_spk from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$tgl_awal' and convert(date,tglappfakpol,105) <= '$tgl_akhir' and kode_supervisor = '$kode_supervisor' and kode_salesman = '$_GET[kode_sales]' order by tglappfakpol"; 
																	$result = sqlsrv_query($conn, $query3);		
										
										
																	while($data_faktur = sqlsrv_fetch_array($result)){
																		
																	$querygrade = mysql_query("select grade from target_sales where nama_sales = '$data_faktur[nama_sales]' and bulan ='$data_faktur[tglbulan_faktur]'");
																	while ($dgrade = mysql_fetch_array($querygrade)){
																	
																		
															?>
															<tr>
																<td width='100dp'><?php echo $nomor ?></td>
																<td><?php  echo  $data_faktur['nama_mobil']; ?></td>
																<td><?php  echo  $data_faktur['point']; ?>
																	<!--?php
																	$query = mysql_query ("select point from model where kode_model ='$data_faktur[kode_jenis]'");
																	while ($data = mysql_fetch_array($query)){
																		echo $data['point'];
																	}
																	
																	?-->
																</td>
																<td><?php  echo  $data_faktur['norangka']; ?></td>
																<td><?php  echo  $data_faktur['nomor']; ?></td>
																<td><?php  echo  $data_faktur['nama_sales']; ?></td>
																<td><?php  echo  $data_faktur['nama_spv']; ?></td>
																<td>
																	<?php
																		echo  $dgrade['grade'];
																		
																	?>
																</td>
																<td><?php  echo  $data_faktur['namastnk']; ?></td>
																<td>
																	<?php 
																		//echo $data_faktur['kode_bank'];
																		if ($data_faktur['kode_bank'] != ''){
																			echo $data_faktur['kode_bank'];
																		}else{
																			echo 'CASH';
																		}
																		/*if ($data_faktur['kode_bank'] == 'BLMR1'){
																			echo 'BALIMOR';
																		}else if ($data_faktur['kode_bank'] == 'MTFSR1'){
																			echo 'MTF';
																		}else if ($data_faktur['kode_bank'] == 'BCA L1'){
																			echo 'BCA';
																		}else if ($data_faktur['kode_bank'] == 'MAF1'){
																			echo 'MAF';
																		}else if ($data_faktur['kode_bank'] == 'MAYB1'){
																			echo 'MYBANK';
																		}else if ($data_faktur['kode_bank'] == 'OTOS1'){
																			echo 'OTO';
																		}else if ($data_faktur['kode_bank'] == 'CLIF21'){
																			echo 'CLIPAN';
																		}else if ($data_faktur['kode_bank'] == 'CLIF21'){
																			echo 'CLIPAN';
																		}else {
																			echo 'CASH';
																		}*/
																	?>
																</td>
																<td>
																	<?php  
																		if ($data_faktur['tenor'] == '12'){
																			echo '1 TAHUN';
																		}else if ($data_faktur['tenor'] == '24'){
																			echo '2 TAHUN';
																		}else if ($data_faktur['tenor'] == '36'){
																			echo '3 TAHUN';
																		}else if ($data_faktur['tenor'] == '48'){
																			echo '4 TAHUN';
																		}else if ($data_faktur['tenor'] == '60'){
																			echo '5 TAHUN';
																		}else if ($data_faktur['tenor'] == '72'){
																			echo '6 TAHUN';
																		}else{
																			echo '-';
																		}
																	?>
																</td>
																<td><?php  echo  $data_faktur['tgl_faktur']; ?></td>
																<td><?php  echo  $data_faktur['tgl_spk']; ?></td>
																<td><?php  echo  'Rp.'.number_format($data_faktur[hargatotal],0,".","."); ?></td>
																<td><?php  echo  'Rp.'.number_format($data_faktur[discount],0,".","."); ?></td>
																<td><?php  echo  'Rp.'.number_format($data_faktur[discaccs],0,".","."); ?></td>
																<td>
																	<?php  
																		$total1= $data_faktur['discount']+$data_faktur['discaccs'];
																		echo  'Rp.'.number_format($total1,0,".",".");
																	?>
																
																</td>
																<td><?php
																		if ($data_faktur['leasingpembuat'] != ''){
																			echo  'Rp.'.number_format($data_faktur[leasingpembuat],0,".","."); 
																		}else{
																			echo '-';
																		}
																		?>
																</td>
																<td>
																	<?php
																		//lgi gk pake program ini
																		//total2 = $total1 - $data_faktur['leasingpembuat'];
																		
																		//sekarang ini yg lagi dipakai
																		$total2= $data_faktur['discount']+$data_faktur['discaccs'];
																		echo  'Rp.'.number_format($total2,0,".","."); 
																	?>
																
																</td>
																<td><?php
																	if ($total2 == $data_faktur['plafon']) {
																		$hasil = '=';
																		
																	}else if ($total2 > $data_faktur['plafon']) {
																		$hasil = '>';
																		
																	}else if($total2 < $data_faktur['plafon']){
																		$hasil = '<';
																	}else{
																		
																	}
																	echo $hasil;
																	?>
																	
																</td>
																<td><?php  echo  'Rp.'.number_format($data_faktur[plafon],0,".","."); ?></td>
																<td><?php
																		$selisih = $data_faktur['plafon']-$total1;
																		if ($total2 == $data_faktur['plafon']) {
																			echo "<div class='label  label-warning'>".'Rp.'.number_format($selisih,0,".",".")."</div>";
																		
																		}else if ($total2 > $data_faktur['plafon']) {
																			echo "<div class='label  label-danger'>".'Rp.'.number_format($selisih,0,".",".")."</div>";
																			
																		}else if($total2 < $data_faktur['plafon']){
																			echo "<div class='label  label-success'>".'Rp.'.number_format($selisih,0,".",".")."</div>";
																		}		
																	?>
																</td>
																<td>
																	<?php
																		$querytab = mysql_query("SELECT igl.kode_leasing,igl.nama_leasing,ial.grade,ial.kode_group,ial.kode_tipe,ial.nama_tipe,ial.amount,ial.tenor,itm.kode_tipe_mobil,itm.nama_mobil 
																		FROM incentive_amount_leasing ial 
																		left join incentive_group_leasing igl on ial.kode_group=igl.kode_group 
																		left join incentive_tipe_mobil itm on ial.nama_tipe=itm.kode_model 
																		where ial.grade='$dgrade[grade]' and igl.kode_leasing ='$data_faktur[kode_bank]' and itm.kode_tipe_mobil ='$data_faktur[kode_model]' and ial.tenor='$data_faktur[tenor]'");
																		$datatab = mysql_fetch_array($querytab);
																			if ($datatab['amount'] != ''){
																				echo 'Rp.'.number_format($datatab['amount'],0,".",".");
																			}else{
																				echo '-';
																			}
																															
																	?>
																	<!--?php echo $data_faktur['kode_bank'];?-->
																	<!--?php echo $data_faktur['kode_model'];?-->
																	<!--?php echo $data_faktur['tenor'];?-->
																	<!--?php echo $dgrade['grade']; ?-->
																</td>
																<td>
																	<?php
																		$queryinc = mysql_query("SELECT igl.kode_leasing,igl.nama_leasing,ial.grade,ial.kode_group,ial.kode_tipe,ial.nama_tipe,ial.amount,ial.tenor,itm.kode_tipe_mobil,itm.nama_mobil 
																		FROM `incentive_amount_leasing` ial 
																		left join incentive_group_leasing igl on ial.kode_group=igl.kode_group 
																		left join incentive_tipe_mobil itm on ial.nama_tipe=itm.kode_model 
																		where ial.grade='$dgrade[grade]' and igl.kode_leasing ='$data_faktur[kode_bank]' and itm.kode_tipe_mobil ='$data_faktur[kode_model]' and ial.tenor='$data_faktur[tenor]'");
																		$datainc = mysql_fetch_array($queryinc);
																		if($total2 < $data_faktur['plafon']){
																			//echo  '-';
																			echo 'Rp.'.number_format($datainc['amount'],0,".",".");
																		}else if ($total2 == $data_faktur['plafon']) {
																			echo  '-';
																		}else if ($total2 > $data_faktur['plafon']) {
																			echo  '-';
																			//echo 'Rp.'.number_format($datainc['amount'],0,".",".");
																		}else{
																			echo  '-';
																		}
																		
																	?>
																</td>
																<td>
																	<?php
																		$querym = mysql_query("select * from incentive_grade where grade ='$dgrade[grade]'");
																		//tambahin where tgl awal & tgl akhir $querym = mysql_query("select * from incentive_grade where grade ='$dgrade[grade]'");
																		while ($datam = mysql_fetch_array($querym)){
																			//echo $datam['amount_grade'];
																		$insunit = $data_faktur['point']*$datam['amount_grade'];
																			echo 'Rp.'.number_format($insunit,0,".",".");
																		
																	?>
																</td>
																<td>-</td>
																<td>-</td>
																<td>-</td>
																<td>-</td>
																<td>
																	<?php
																	$tot_insentif = $datainc['amount']+$insunit;
																	echo 'Rp.'.number_format($tot_insentif,0,".",".");
																	
																	?>
																</td>
																		<?php } ?>
																</tr>
																
																	<?php
																	$nomor ++;
																	}}
																	?>
																<tr>
																	<td colspan="23" align='left'>Penjualan Asuransi + Accessories</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																<tr>
																	
																	<td colspan="23" align='left'>
																		<?php
																			$query9 = "select * ,substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,convert(varchar,tglappfakpol,105) as tgl_faktur,convert(varchar,tgl_spk,105) as tgl_spk from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$tgl_awal' and convert(date,tglappfakpol,105) <= '$tgl_akhir' and kode_supervisor = '$kode_supervisor' and kode_salesman = '$_GET[kode_sales]' order by tglappfakpol"; 
																			$result = sqlsrv_query($conn, $query9);
																			$data_faktura = sqlsrv_fetch_array($result);
																			//pembatas query
																			//$tgl_faktura = substr($data_faktura['tgl_faktur'],3,7);
																			//$querytarget = mysql_query("select target_point from target_sales where bulan='$tgl_faktur' and nama_sales ='$data_faktura[nama_sales]'");
																			$querytarget = mysql_query("select target_point from target_sales where bulan='$data_faktura[tglbulan_faktur]' and nama_sales ='$data_faktura[nama_sales]'");
																			while($datatarget = mysql_fetch_array($querytarget)){
																			echo "TARGET ".$datatarget[target_point]." POINT";
																			
																		?>
																	</td>
																	<td>tes
																		<?php
																			$query4 = "select *,substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,
																			convert(varchar,tglappfakpol,105) as tgl_faktur,convert(varchar,tgl_spk,105) as tgl_spk 
																			from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$tgl_awal' and convert(date,tglappfakpol,105) <= '$tgl_akhir' 
																			and kode_supervisor = '$kode_supervisor' and kode_salesman = '$_GET[kode_sales]' order by tglappfakpol";
																			$result4 = sqlsrv_query($conn, $query4);			
																			$data_faktur = sqlsrv_fetch_array($result4);
																			//echo $data_faktur['tglbulan_faktur'];
																			
																			//grade
																			$querygrade = mysql_query("select grade from target_sales where nama_sales = '$data_faktur[nama_sales]' and bulan ='$data_faktur[tglbulan_faktur]'");
																			$dgrade = mysql_fetch_array($querygrade);
																			
																			//
																			$queryinc = mysql_query("SELECT igl.kode_leasing,igl.nama_leasing,ial.grade,ial.kode_group,ial.kode_tipe,ial.nama_tipe,ial.amount,ial.tenor,itm.kode_tipe_mobil,itm.nama_mobil 
																			FROM `incentive_amount_leasing` ial 
																			left join incentive_group_leasing igl on ial.kode_group=igl.kode_group 
																			left join incentive_tipe_mobil itm on ial.nama_tipe=itm.kode_model 
																			where ial.grade='$dgrade[grade]' and igl.kode_leasing ='$data_faktur[kode_bank]' and itm.kode_tipe_mobil ='$data_faktur[kode_model]' and ial.tenor='$data_faktur[tenor]'");
																			$datainc = mysql_fetch_array($queryinc);
																			echo $data_faktur['kode_model'];
																			/*if($total2 > $data_faktur['plafon']){
																				echo 'Rp.'.number_format($datainc['amount'],0,".",".");
																			}else if ($total2 == $data_faktur['plafon']) {
																				echo  '-';
																			}else if ($total2 < $data_faktur['plafon']) {
																				echo  '-';
																			}else{
																				echo  'error';
																			}*/
																			
																		?>
																	</td>
																	<td>
																	<?php
																			//1. point
																			//$query3 = "select substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,convert(varchar,tglappfakpol,105) as tgl_faktur
																			$query3 = "select sum(point) as total_point
																			from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$tgl_awal' and convert(date,tglappfakpol,105)
																			<= '$tgl_akhir' and kode_supervisor = '$kode_supervisor' and kode_salesman = '$_GET[kode_sales]'"; 
																			$result = sqlsrv_query($conn, $query3);			
																			$data_fakturb = sqlsrv_fetch_array($result);
																			//echo $data_fakturb['total_point'];
																			
																			//2. tanggal
																			$query4 = "select *,substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,
																			convert(varchar,tglappfakpol,105) as tgl_faktur,convert(varchar,tgl_spk,105) as tgl_spk 
																			from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$tgl_awal' and convert(date,tglappfakpol,105) <= '$tgl_akhir' 
																			and kode_supervisor = '$kode_supervisor' and kode_salesman = '$_GET[kode_sales]' order by tglappfakpol";
																			$result4 = sqlsrv_query($conn, $query4);			
																			$data_fakturc = sqlsrv_fetch_array($result4);
																			//echo $data_fakturc['tglbulan_faktur'];
																			
																			//3. GRADE
																			$querygrade = mysql_query("select grade from target_sales where nama_sales = '$data_fakturc[nama_sales]' and bulan ='$data_fakturc[tglbulan_faktur]'");
																			$dgrade = mysql_fetch_array($querygrade);
																			//echo $dgrade['grade'];
																			
																			//3. amount point/grade
																			$querym = mysql_query("select amount_grade from incentive_grade where grade ='$dgrade[grade]'");
																			$datam = mysql_fetch_array($querym);
																			$insunit = $data_fakturb['total_point']*$datam['amount_grade'];
																			echo 'Rp.'.number_format($insunit,0,".",".");
																		
																	?>
																	</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	
																</tr>
																
																<tr>
																	<td colspan="23" align='left'>
																		<?php
																			$query3 = "select sum(point) as total_point from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$tgl_awal' and convert(date,tglappfakpol,105) <= '$tgl_akhir' and kode_supervisor = '$kode_supervisor' and kode_salesman = '$_GET[kode_sales]'"; 
																			$result = sqlsrv_query($conn, $query3);			
																			$data_faktur = sqlsrv_fetch_array($result);
																			
																			
																			
																			if ($data_faktur['total_point'] >= $datatarget['target_point']){
																				echo "<div class='label  label-success'>".'REWARD'."</div>";
																			}else if ($data_faktur['total_point'] < $datatarget['target_point']){
																				echo "<div class='label  label-danger'>".'PUNISH'."</div>";
																			}else{
																				echo '-';
																			}
																			
																		?>
																	</td>
																	<td>
																		dsfs
																	</td>
																	<td>
																		<?php
																			$query3 = "select sum(point) as total_point from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$tgl_awal' and convert(date,tglappfakpol,105) <= '$tgl_akhir' and kode_supervisor = '$kode_supervisor' and kode_salesman = '$_GET[kode_sales]'"; 
																			$result = sqlsrv_query($conn, $query3);			
																			$data_faktur = sqlsrv_fetch_array($result);
																			
																			/*$querygrade = mysql_query("select grade from target_sales where nama_sales = '$data_fakturc[nama_sales]' and bulan ='$data_fakturc[tglbulan_faktur]'");
																			$dgrade = mysql_fetch_array($querygrade);
																			*/
																			//echo $dgrade['grade'];
																			
																			
																			 if ($data_faktur['total_point'] >= $datatarget['target_point'] and $dgrade['grade']){
																					if ($dgrade['grade'] == 'C0'){
																						echo "<div class='label  label-success'>".'-'."</div>";
																					}else if($dgrade['grade'] == 'F0'){
																						echo "<div class='label  label-success'>".'-'."</div>";
																					}else if($dgrade['grade'] == 'C1'){
																						echo "<div class='label  label-success'>".'Rp. 300.000'."</div>";
																					}else if($dgrade['grade'] == 'F1'){
																						echo "<div class='label  label-success'>".'Rp. 300.000'."</div>";
																					}else if($dgrade['grade'] == 'C2'){
																						echo "<div class='label  label-success'>".'Rp. 400.000'."</div>";
																					}else if($dgrade['grade'] == 'F2'){
																						echo "<div class='label  label-success'>".'Rp. 400.000'."</div>";
																					}else if($dgrade['grade'] == 'C3'){
																						echo "<div class='label  label-success'>".'Rp. 500.000'."</div>";
																					}else if($dgrade['grade'] == 'F3'){
																						echo "<div class='label  label-success'>".'Rp. 500.000'."</div>";
																					}else{
																						echo '';
																					}
																				
																			
																			}else if ($data_faktur['total_point'] < $datatarget['target_point'] and $dgrade['grade']){
																					if ($dgrade['grade'] == 'C0'){
																						echo "<div class='label  label-danger'>".'-'."</div>";
																					}else if($dgrade['grade'] == 'F0'){
																						echo "<div class='label  label-danger'>".'-'."</div>";
																					}else if($dgrade['grade'] == 'C1'){
																						echo "<div class='label  label-danger'>".'- Rp. 300.000'."</div>";
																					}else if($dgrade['grade'] == 'F1'){
																						echo "<div class='label  label-danger'>".'- Rp. 300.000'."</div>";
																					}else if($dgrade['grade'] == 'C2'){
																						echo "<div class='label  label-danger'>".'- Rp. 400.000'."</div>";
																					}else if($dgrade['grade'] == 'F2'){
																						echo "<div class='label  label-danger'>".'- Rp. 400.000'."</div>";
																					}else if($dgrade['grade'] == 'C3'){
																						echo "<div class='label  label-danger'>".'- Rp. 500.000'."</div>";
																					}else if($dgrade['grade'] == 'F3'){
																						echo "<div class='label  label-danger'>".'- Rp. 500.000'."</div>";
																					}else{
																						echo '';
																					}
																			}
																			
																		?>
																	</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																
																<tr>
																	<td colspan="2">Total Point</td>
																	<td>
																		<?php
																			$query3 = "select sum(point) as total_point from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$tgl_awal' and convert(date,tglappfakpol,105) <= '$tgl_akhir' and kode_supervisor = '$kode_supervisor' and kode_salesman = '$_GET[kode_sales]'"; 
																			$result = sqlsrv_query($conn, $query3);			
																			while($data_faktur = sqlsrv_fetch_array($result)){
																			echo $data_faktur['total_point'];
																			}
																		?>
																	</td>
																	<td colspan="20"></td>
																	<td>sss</td>
																	<td> 
																		<?php
																			//1. point
																			//$query3 = "select substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,convert(varchar,tglappfakpol,105) as tgl_faktur
																			$query3 = "select sum(point) as total_point
																			from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$tgl_awal' and convert(date,tglappfakpol,105)
																			<= '$tgl_akhir' and kode_supervisor = '$kode_supervisor' and kode_salesman = '$_GET[kode_sales]'"; 
																			$result = sqlsrv_query($conn, $query3);			
																			$data_fakturb = sqlsrv_fetch_array($result);
																			//echo $data_fakturb['total_point'];
																			
																			//2. tanggal
																			$query4 = "select *,substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,
																			convert(varchar,tglappfakpol,105) as tgl_faktur,convert(varchar,tgl_spk,105) as tgl_spk 
																			from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$tgl_awal' and convert(date,tglappfakpol,105) <= '$tgl_akhir' 
																			and kode_supervisor = '$kode_supervisor' and kode_salesman = '$_GET[kode_sales]' order by tglappfakpol";
																			$result4 = sqlsrv_query($conn, $query4);			
																			$data_fakturc = sqlsrv_fetch_array($result4);
																			//echo $data_fakturc['tglbulan_faktur'];
																			
																			//3. GRADE
																			$querygrade = mysql_query("select grade from target_sales where nama_sales = '$data_fakturc[nama_sales]' and bulan ='$data_fakturc[tglbulan_faktur]'");
																			$dgrade = mysql_fetch_array($querygrade);
																			//echo $dgrade['grade'];
																			
																			//3. amount point/grade
																			$querym = mysql_query("select amount_grade from incentive_grade where grade ='$dgrade[grade]'");
																			$datam = mysql_fetch_array($querym);
																			$insunit = $data_fakturb['total_point']*$datam['amount_grade'];
																			//echo 'Rp.'.number_format($insunit,0,".",".");
																			
																			
																			
																			
																			$query3 = "select sum(point) as total_point from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$tgl_awal' and convert(date,tglappfakpol,105) <= '$tgl_akhir' and kode_supervisor = '$kode_supervisor' and kode_salesman = '$_GET[kode_sales]'"; 
																			$result = sqlsrv_query($conn, $query3);			
																			$data_faktur = sqlsrv_fetch_array($result);
																			
																			$querygrade = mysql_query("select grade from target_sales where nama_sales = '$data_fakturc[nama_sales]' and bulan ='$data_fakturc[tglbulan_faktur]'");
																			$dgrade = mysql_fetch_array($querygrade);
																			
																			//echo $dgrade['grade'];
																			
																			
																			 if ($data_faktur['total_point'] >= $datatarget['target_point'] and $dgrade['grade']){
																					if ($dgrade['grade'] == 'C0'){
																						$tot_njing = $insunit;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else if($dgrade['grade'] == 'F0'){
																						$tot_njing = $insunit;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else if($dgrade['grade'] == 'C1'){
																						$tot_njing = $insunit+300000;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else if($dgrade['grade'] == 'F1'){
																						$tot_njing = $insunit+300000;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else if($dgrade['grade'] == 'C2'){
																						$tot_njing = $insunit+400000;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else if($dgrade['grade'] == 'F2'){
																						$tot_njing = $insunit+400000;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else if($dgrade['grade'] == 'C3'){
																						$tot_njing = $insunit+500000;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else if($dgrade['grade'] == 'F3'){
																						$tot_njing = $insunit+500000;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else{
																						echo '';
																					}
																				
																			
																			}else if ($data_faktur['total_point'] < $datatarget['target_point'] and $dgrade['grade']){
																					if ($dgrade['grade'] == 'C0'){
																						$tot_njing = $insunit;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else if($dgrade['grade'] == 'F0'){
																						$tot_njing = $insunit;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else if($dgrade['grade'] == 'C1'){
																						$tot_njing = $insunit-300000;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else if($dgrade['grade'] == 'F1'){
																						$tot_njing = $insunit-300000;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else if($dgrade['grade'] == 'C2'){
																						$tot_njing = $insunit-400000;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else if($dgrade['grade'] == 'F2'){
																						$tot_njing = $insunit-400000;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else if($dgrade['grade'] == 'C3'){
																						$tot_njing = $insunit-500000;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else if($dgrade['grade'] == 'F3'){
																						$tot_njing = $insunit-500000;
																						echo 'Rp.'.number_format($tot_njing,0,".",".");
																					}else{
																						echo '';
																					}
																			}
																		
																	?>
																	</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																<?php } ?>  
																</tbody>
																		
																	</table>
																	<?php
																		$level = $_SESSION['leveluser'];
																		
																		$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ");
																		$cek_akses2 = mysql_fetch_array($cek_akses);
																			if($cek_akses2['ekspor'] == 'Y')
																			{
																	?>
																		<div class="progress-demo">
																			<a href='modul/summary_penjualan/export_summary_penjualan_insentif.php?tgl_awal=<?php echo $_GET['tgl_awal'].'&tgl_akhir='.$_GET['tgl_akhir'].'&kode_supervisor='.$_GET['kode_supervisor'].'&kode_sales='.$_GET['kode_sales']; ?>' id="export">
																				<button class="btn btn-wide btn-primary ladda-button" data-style="expand-right" >
																					<span class="ladda-label"> Export Data ke Excel</span>
																				</button>
																			</a>
																		</div>
																		<br>
																	<?php
																			}
																	?>
																	
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
			
	
<?php break;
}
} ?>