<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=summary_insentif_sales_(".$_GET['tgl_awal'].")_sd_(".$_GET['tgl_akhir'].").xls");

?>

<?php
include "../../config/koneksi.php";
//include "../../config/koneksi_sqlserverit.php";
include "../../config/koneksi_sqlserver.php";
include "../../config/koneksi_service.php";
//include "koneksi.php";

	
	$nomor = 1;
				//$tgl_doank2 = $tgl_doank - 0;
			$query3 = "select * ,substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,convert(varchar,tglappfakpol,105) as tgl_faktur,convert(varchar,tgl_spk,105) as tgl_spk from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$_GET[tgl_awal]' and convert(date,tglappfakpol,105) <= '$_GET[tgl_akhir]' and kode_supervisor = '$_GET[kode_supervisor]' and kode_salesman = '$_GET[kode_sales]' order by tglappfakpol"; 
			$result = sqlsrv_query($conn, $query3);
				
			

			
?>

                        <table border = "1">
								<tr>
									<th colspan='30' bgcolor='#bdc3c7'><h3>SUMMARY INCENTIVE SALES</h3></th>
								</tr>
								<tr>
									<!--th colspan='30' align = "left">Hari/Tanggal : <?php echo substr($_GET['tgl_awal'], 8, 2)." sampai ".substr($_GET['tgl_akhir'], 8, 2) ?> </th-->
									<th colspan='30' align = "left">Hari/Tanggal : <?php echo $_GET['tgl_awal']." sampai ".$_GET['tgl_akhir'] ?> </th>
								</tr>
									<tr>
										<td bgcolor='#bdc3c7' width="30" height="29"><b>No</td>
										<td bgcolor='#bdc3c7'><b>Tipe</td>												
										<td bgcolor='#bdc3c7'><b>Point</td>
										<td bgcolor='#bdc3c7'><b>No Rangka</td>
										<td bgcolor='#bdc3c7'><b>No Spk</td>
										<td bgcolor='#bdc3c7'><b>Sales</td>
										<td bgcolor='#bdc3c7'><b>SPV</td>																				
										<td bgcolor='#bdc3c7'><b>Grade</td>
										<td bgcolor='#bdc3c7'><b>Nama Stnk</td>
										<td bgcolor='#bdc3c7'><b>Leasing</td>
										<td bgcolor='#bdc3c7'><b>Tenor</td>												
										<td bgcolor='#bdc3c7'><b>Tgl Faktur</td>
										<td bgcolor='#bdc3c7'><b>Tgl Spk</td>
										<td bgcolor='#bdc3c7'><b>Price List</td>
										<td bgcolor='#bdc3c7'><b>Disc</td>
										<td bgcolor='#bdc3c7'><b>Acc</td>																				
										<td bgcolor='#bdc3c7'><b>Total 1</td>
										<td bgcolor='#bdc3c7'><b>Asing Pembuat</td>
										<td bgcolor='#bdc3c7'><b>Total 2</td>
										<td bgcolor='#bdc3c7'><b>#</td>
										<td bgcolor='#bdc3c7'><b>Plafon</td>												
										<td bgcolor='#bdc3c7'><b>Selisih</td>
										<td bgcolor='#bdc3c7'><b>Tabel</td>
										<td bgcolor='#bdc3c7'><b>Ins Leasing</td>
										<td bgcolor='#bdc3c7'><b>Ins Unit</td>
										<td bgcolor='#bdc3c7'><b>Ins Acs</td>																				
										<td bgcolor='#bdc3c7'><b>Ins P.Dok</td>
										<td bgcolor='#bdc3c7'><b>Ins Ass</td>
										<td bgcolor='#bdc3c7'><b>Progresif</td>
										<td bgcolor='#bdc3c7'><b>Total Ins</td>
									</tr>
                    		</thead>
							<tbody>
								<?php
								
										while($data_faktur = sqlsrv_fetch_array($result)){
										$querygrade = mysql_query("select grade from target_sales where nama_sales = '$data_faktur[nama_sales]' and bulan ='$data_faktur[tglbulan_faktur]'");
										while ($dgrade = mysql_fetch_array($querygrade)){

											
								?>
								<tr>
									<td width='100dp'><?php echo $nomor ?></td>
									<td><?php  echo  $data_faktur['nama_mobil']; ?></td>
									<td align='center'><?php  echo  $data_faktur['point']; ?>
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
									<td align='center'>
										<?php
											echo  $dgrade['grade'];
											
										?>
									</td>
									<td><?php  echo  $data_faktur['namastnk']; ?></td>
									<td align='center'>
										<?php 
										
											if ($data_faktur['kode_bank'] != ''){
												echo $data_faktur['kode_bank'];
											}else{
												echo 'CASH';
											}
										?>
									</td>
									<td align='center'>
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
									<td><?php  echo  'Rp.'.number_format($data_faktur['hargatotal'],0,".","."); ?></td>
									<td><?php  echo  'Rp.'.number_format($data_faktur['discount'],0,".","."); ?></td>
									<td align='center'><?php  echo  'Rp.'.number_format($data_faktur['discaccs'],0,".","."); ?></td>
									<td>
										<?php  
											$total1= $data_faktur['discount']+$data_faktur['discaccs'];
											echo  'Rp.'.number_format($total1,0,".",".");
										?>
									
									</td>
									<td align='center'><?php
											if ($data_faktur['leasingpembuat'] != ''){
												echo  'Rp.'.number_format($data_faktur['leasingpembuat'],0,".","."); 
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
									<td align='center'><?php
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
									<td align='center'><?php  echo  'Rp.'.number_format($data_faktur['plafon'],0,".","."); ?></td>
									<td><?php
											$selisih = $data_faktur['plafon']-$total1;
											if ($total2 == $data_faktur['plafon']) {
												echo "<font color='yellow'>".'Rp.'.number_format($selisih,0,".",".")."</font>";
											
											}else if ($total2 > $data_faktur['plafon']) {
												echo "<font color='red'>".'Rp.'.number_format($selisih,0,".",".")."</font>";
												
											}else if($total2 < $data_faktur['plafon']){
												echo "<font color='green'>".'Rp.'.number_format($selisih,0,".",".")."</font>";
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
												}else if ($datatab['amount'] == ''){
													echo '-';
												}
																								
										?>
										
									</td>
									<td>
										<?php
											$queryinc = mysql_query("SELECT igl.kode_leasing,igl.nama_leasing,ial.grade,ial.kode_group,ial.kode_tipe,ial.nama_tipe,ial.amount,ial.tenor,itm.kode_tipe_mobil,itm.nama_mobil 
											FROM `incentive_amount_leasing` ial 
											left join incentive_group_leasing igl on ial.kode_group=igl.kode_group 
											left join incentive_tipe_mobil itm on ial.nama_tipe=itm.kode_model 
											where ial.grade='$dgrade[grade]' and igl.kode_leasing ='$data_faktur[kode_bank]' and itm.kode_tipe_mobil ='$data_faktur[kode_model]' and ial.tenor='$data_faktur[tenor]'");
											$datainc = mysql_fetch_array($queryinc);
											if($total2 > $data_faktur['plafon']){
												echo 'Rp.'.number_format($datainc['amount'],0,".",".");
											}else if ($total2 == $data_faktur['plafon']) {
												echo  '-';
											}else if ($total2 < $data_faktur['plafon']) {
												echo  '-';
											}else{
												echo  'error';
											}
											
										?>
									</td>
									<td>
										<?php
											$querym = mysql_query("select * from incentive_grade where grade ='$dgrade[grade]'");
											//tambahin where tgl awal & tgl akhir $querym = mysql_query("select * from incentive_grade where grade ='$dgrade[grade]'");
											$datam = mysql_fetch_array($querym);
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
												$query9 = "select * ,substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,convert(varchar,tglappfakpol,105) as tgl_faktur,convert(varchar,tgl_spk,105) as tgl_spk 
												from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$_GET[tgl_awal]' and convert(date,tglappfakpol,105) <= '$_GET[tgl_akhir]' and kode_supervisor = '$_GET[kode_supervisor]' 
												and kode_salesman = '$_GET[kode_sales]' order by tglappfakpol"; 
												$result = sqlsrv_query($conn, $query9);
												$data_faktura = sqlsrv_fetch_array($result);
												//pembatas query
												$tgl_faktura = substr($data_faktura['tgl_faktur'],3,7);
												$querytarget = mysql_query("select target_point from target_sales where bulan='$tgl_faktura' and nama_sales ='$data_faktura[nama_sales]'");
												while($datatarget = mysql_fetch_array($querytarget)){
												echo "TARGET ".$datatarget['target_point']." POINT";
												
											?>
										</td>
										<td>
											tes
											<?php
												$query4 = "select *,substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,
												convert(varchar,tglappfakpol,105) as tgl_faktur,convert(varchar,tgl_spk,105) as tgl_spk 
												from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$_GET[tgl_awal]' and convert(date,tglappfakpol,105) <= '$_GET[tgl_akhir]' 
												and kode_supervisor = '$_GET[kode_supervisor]' and kode_salesman = '$_GET[kode_sales]' order by tglappfakpol";
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
													from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$_GET[tgl_awal]' and convert(date,tglappfakpol,105)
													<= '$_GET[tgl_akhir]' and kode_supervisor = '$_GET[kode_supervisor]' and kode_salesman = '$_GET[kode_sales]'"; 
													$result = sqlsrv_query($conn, $query3);			
													$data_fakturb = sqlsrv_fetch_array($result);
													//echo $data_fakturb['total_point'];
													
													//2. tanggal
													$query4 = "select *,substring(convert(varchar,tglappfakpol,105),4,7) as tglbulan_faktur,
													convert(varchar,tglappfakpol,105) as tgl_faktur,convert(varchar,tgl_spk,105) as tgl_spk 
													from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$_GET[tgl_awal] and convert(date,tglappfakpol,105) <= '$_GET[tgl_akhir]' 
													and kode_supervisor = '$_GET[kode_supervisor]' and kode_salesman = '$_GET[kode_sales]' order by tglappfakpol";
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
												$query3 = "select sum(point) as total_point from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$_GET[tgl_awal]' and convert(date,tglappfakpol,105) <= '$_GET[tgl_akhir]' and kode_supervisor = '$_GET[kode_supervisor]' and kode_salesman = '$_GET[kode_sales]'"; 
												$result = sqlsrv_query($conn, $query3);			
												while($data_faktur = sqlsrv_fetch_array($result)){
												
												if ($data_faktur['total_point'] >= $datatarget['target_point']){
													echo "<font color='green'>".'REWARD'."</font>";
												}else if ($data_faktur['total_point'] < $datatarget['target_point']){
													echo "<font color='#ff0000'>".'PUNISH'."</font>";
												}else{
													echo '-';
												}
												}
											?>
										
										</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<?php } ?>  
									<tr>
										<td colspan="2">Total Point</td>
										<td>
											<?php
												$query3 = "select sum(point) as total_point from vw_Insentifsos where convert(date,tglappfakpol,105) >= '$_GET[tgl_awal]' and convert(date,tglappfakpol,105) <= '$_GET[tgl_akhir]' and kode_supervisor = '$_GET[kode_supervisor]' and kode_salesman = '$_GET[kode_sales]'"; 
												$result = sqlsrv_query($conn, $query3);			
												while($data_faktur = sqlsrv_fetch_array($result)){
												echo $data_faktur['total_point'];
												}
											?>
										</td>
										<td colspan="20"></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									
				
							</tbody>
                        </table>