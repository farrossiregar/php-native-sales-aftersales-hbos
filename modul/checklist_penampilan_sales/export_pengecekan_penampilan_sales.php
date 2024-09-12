<?php

header("Content-type: application/vnd-ms-excel");
	$bulan = substr($_GET['bulan_cek'], 5, 2);
	if($bulan == '01'){
		 $bulan = "JAN";
	}elseif($bulan == '02'){
		 $bulan = "FEB";
	}elseif($bulan == '03'){
		 $bulan = "MAR";
	}elseif($bulan == '04'){
		 $bulan = "April";
	}elseif($bulan == '05'){
		 $bulan = "MEI";
	}elseif($bulan == '06'){
		 $bulan = "JUN";
	}elseif($bulan == '07'){
		 $bulan = "JUL";
	}elseif($bulan == '08'){
		 $bulan = "AGS";
	}elseif($bulan == '09'){
		 $bulan = "SEP";
	}elseif($bulan == '10'){
		 $bulan = "OKT";
	}elseif($bulan == '11'){
		 $bulan = "NOV";
	}elseif($bulan == '12'){
		 $bulan = "DES";
	}else{
		 $bulan = "";
	}
	$tahun_bulan = $_GET['tahun_bulan'];
	$no_pengecekan_mingguan = $_GET['no_pengecekan_mingguan'];
	$get_bulan = substr($_GET['bulan_cek'], 5, 2);
	$tahun = date('Y');
header("Content-Disposition: attachment; filename=Green_Dealer_Check_Sheet_Penampilan_Sales_".$bulan."_".$tahun.".xls");


include "koneksi.php";

?>
			
		<table border="1">
			<thead>
				<tr>
				</tr>
				<tr>
					<th  bgcolor = "#40a337" border = '1' rowspan = '2' >KODE SALES</th>
					<th  bgcolor = "#40a337" border = '1' rowspan = '2'>PUKUL</th>
					<th  bgcolor = "#40a337" border = '1' rowspan = '2'>PENILAIAN</th>
					
					<th width="5"></th>
					<?php
						$jumlah_data = mysql_query("select tanggal from pengecekan_penampilan_sales_detail where substr(tanggal, 1, 7) = '$tahun_bulan' group by tanggal");
						$data_jumlah_data = mysql_num_rows($jumlah_data);
							$bulan_tgt_spv = $get_bulan."-".$tahun;
					?>
					<th colspan = "<?php echo $data_jumlah_data ?>" bgcolor = "#40a337" border = '1'>TANGGAL </th>
				</tr>
				<tr >
					<th width="2"></th>
					
					<?php
						$tanggal_pengecekan = mysql_query("select tanggal from pengecekan_penampilan_sales_detail where substr(tanggal, 1, 7) = '$tahun_bulan' group by tanggal");
						while($data_tanggal_pengecekan = mysql_fetch_array($tanggal_pengecekan)){
					?>
					<th bgcolor = "yellow" border = '1'><?php echo substr($data_tanggal_pengecekan['tanggal'], 8, 2); ?></th>
					<?php
						}
					?>
				</tr>
			</thead>
			<tbody>
			
			<?php
				$bulan_tgt_spv = $bulan."-".$tahun;
				$master = mysql_query("SELECT * from pengecekan_penampilan_sales_detail where substr(tanggal, 1, 7) = '$tahun_bulan' limit 35");	
				$no = 0;
				while($data_master = mysql_fetch_array($master)){
					$no = $no+1;
			?>
		
				<tr>
					<!--td border = '1' rowspan = "2" valign = "middle"><?php echo $no; ?></td-->
					<td border = '1' valign = "middle"><?php echo $data_master['kode_sales']; ?></td>
					<td border = '1'>09:00</td>
					<td border = '1' valign = "middle"><?php echo $data_master['jenis_penilaian']; ?></td>
					<td></td>
					<?php
							$penilaian = mysql_query("SELECT hasil_penilaian, catatan_pengecekan from pengecekan_penampilan_sales_detail where jam = '09:00' and kode_sales = '$data_master[kode_sales]' and substr(tanggal, 1, 7) = '$tahun_bulan' and jenis_penilaian = '$data_master[jenis_penilaian]' group by tanggal");	
							$no = 0;
							while($data_penilaian = mysql_fetch_array($penilaian)){
								$cek_penilaian = mysql_num_rows($penilaian);
								$no = $no+1;
								if($data_penilaian['hasil_penilaian'] == "Y"){
									$hasil = "<td border = '1'> &#10003 </td>";
								}else{
									$hasil = "<td border = '1'><font color = 'red'><b> X </b></font></td>";
								}
								echo "$hasil";
					
							}
					?>
				</tr>
				<tr>
					<td border = '1' valign = "middle"><?php echo $data_master['kode_sales']; ?></td>
					<td border = '1'>14:00</td>
					<td border = '1' valign = "middle"><?php echo $data_master['jenis_penilaian']; ?></td>
					<td></td>
					<?php
						$tanggal_pengecekan = mysql_query("select tanggal from pengecekan_penampilan_sales_detail where substr(tanggal, 1, 7) = '$tahun_bulan' group by tanggal");
					//	while($data_tanggal_pengecekan = mysql_fetch_array($tanggal_pengecekan)){
							$tgl_cek = substr($data_tanggal_pengecekan['tanggal'], 8, 2);
							$penilaian = mysql_query("SELECT hasil_penilaian, catatan_pengecekan from pengecekan_penampilan_sales_detail where jam = '14:00' and kode_sales = '$data_master[kode_sales]' and substr(tanggal, 1, 7) = '$tahun_bulan' and jenis_penilaian = '$data_master[jenis_penilaian]' group by tanggal");	
							$no = 0;
							while($data_penilaian = mysql_fetch_array($penilaian)){
								$no = $no+1;
								if($data_penilaian['hasil_penilaian'] == "Y"){
									$hasil = "<td border = '1'> &#10003 </td>";
								}else{
									$hasil = "<td border = '1'><font color = 'red'><b> X </b></font></td>";
								}
								echo "$hasil";
					
							}
					//	}
					?>
				</tr>
				
				<?php
					}
				?>		
				
				
			</tbody>
		</table>
		
		
		<table>
			<tr>
			</tr>
			<tr>
			</tr>
			<tr>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
					<table border="1">
						<tr>
							<td colspan='15'>
								<b>Catatan</b>
							</td>
						</tr>
						<tr>
							<td colspan='15'>
							</td>
						</tr>
						<?php
							$keterangan_pengecekan = mysql_query("select * from pengecekan_penampilan_sales_detail where substr(tanggal, 1, 7) = '$tahun_bulan' and hasil_penilaian = 'N' order by kode_sales asc, tanggal asc, jam asc");
							while($data_keterangan_pengecekan = mysql_fetch_array($keterangan_pengecekan)){
								$nama_pengecekan = $data_keterangan_pengecekan['jenis_penilaian'];
								$tgl_pengecekan = $data_keterangan_pengecekan['tanggal'];
								if($data_keterangan_pengecekan['catatan_pengecekan'] == 'KETERANGAN LAINNYA'){
									$catatan_pengecekan = "Keterangan dari SPV : ".$data_keterangan_pengecekan['keterangan_catatan_pengecekan'];
								}else{
									$catatan_pengecekan = "Keterangan dari CCO : ".$data_keterangan_pengecekan['catatan_pengecekan'];
								}
								
								$jam = $data_keterangan_pengecekan['jam'];
								$kode_sa = $data_keterangan_pengecekan['kode_sales'];
								
						?>
							<tr>
								<td colspan='15'>
									<b><?php echo strtoupper($data_keterangan_pengecekan['kode_sales']) ?></b><br>
									<?php echo "Tanggal ".$tgl_pengecekan.' '.$jam  ?><br>
									<?php echo "Jenis Penilaian : ".strtoupper($nama_pengecekan) ?><br>
									<?php echo $catatan_pengecekan  ?><br>
								</td>
							</tr>
							
						<?php
							}
						?>
						
						
					</table>
				</td>
			</tr>
		</table>