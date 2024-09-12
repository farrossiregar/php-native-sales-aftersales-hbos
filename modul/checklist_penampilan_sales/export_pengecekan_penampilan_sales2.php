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
				<tr >
					<!--th rowspan = "2" bgcolor = "yellow" style="border:2px;">NO</th-->
					<th rowspan = "2" bgcolor = "#40a337" border = '1'>PENILAIAN</th>
					<th rowspan = "2" bgcolor = "#40a337" border = '1'>PUKUL</th>
					<th width="3"></th>
					<?php
						$jumlah_data = mysql_query("select tanggal from pengecekan_penampilan_sales_detail where substr(tanggal, 6, 2) = '$get_bulan' group by tanggal");
						$data_jumlah_data = mysql_num_rows($jumlah_data);
						$bulan_tgt_spv = $get_bulan."-".$tahun;
					?>
					<th colspan = "<?php echo $data_jumlah_data ?>" bgcolor = "#40a337" border = '1'>TANGGAL </th>
				</tr>
				<tr >
					<th width="2"></th>
					
					<?php
						$tanggal_pengecekan = mysql_query("select tanggal from pengecekan_penampilan_sales_detail where substr(tanggal, 6, 2) = '$get_bulan' group by tanggal");
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
				$master = mysql_query("SELECT * from target_sales where kode_spv = 'SUDI' and bulan = '04-2018'");	
				$no = 0;
				while($data_master = mysql_fetch_array($master)){
					$no = $no+1;
			?>
		
				<tr>
					<!--td border = '1' rowspan = "2" valign = "middle"><?php echo $no; ?></td-->
					<td border = '1' rowspan = "2" valign = "middle"><?php echo $data_master['kode_sales']; ?></td>
					<td border = '1'>09:00</td>
					<td></td>
					<?php
						$tanggal_pengecekan = mysql_query("select tanggal from pengecekan_penampilan_sales_detail where substr(tanggal, 6, 2) = '$get_bulan' group by tanggal");
						while($data_tanggal_pengecekan = mysql_fetch_array($tanggal_pengecekan)){
							$tgl_cek = substr($data_tanggal_pengecekan['tanggal'], 8, 2);
							$penilaian = mysql_query("SELECT hasil_penilaian, catatan_pengecekan from pengecekan_penampilan_sales_detail where jam = '09:00' and kode_sales = '$data_master[kode_sales]' and substr(tanggal, 9, 2) = '$tgl_cek' group by kode_sales");	
							$no = 0;
							while($data_penilaian = mysql_fetch_array($penilaian)){
								$cek_penilaian = mysql_num_rows($penilaian);
								$no = $no+1;
								if($data_penilaian['hasil_penilaian'] == "Y"){
									$hasil = "<td border = '1'>&#10003</td>";
								}else{
									$hasil = "<td border = '1'>-</td>";
								}
								echo "$hasil";
					
							}
						}
					?>
				</tr>
				<tr>
					<td border = '1'>14:00</td>
					<td></td>
					<?php
						$tanggal_pengecekan = mysql_query("select tanggal from pengecekan_penampilan_sales_detail where substr(tanggal, 6, 2) = '$get_bulan' group by tanggal");
						while($data_tanggal_pengecekan = mysql_fetch_array($tanggal_pengecekan)){
							$tgl_cek = substr($data_tanggal_pengecekan['tanggal'], 8, 2);
							$penilaian = mysql_query("SELECT hasil_penilaian, catatan_pengecekan from pengecekan_penampilan_sales_detail where jam = '14:00' and kode_sales = '$data_master[kode_sales]' and substr(tanggal, 9, 2) = '$tgl_cek' group by kode_sales");	
							$no = 0;
							while($data_penilaian = mysql_fetch_array($penilaian)){
								$no = $no+1;
								if($data_penilaian['hasil_penilaian'] == "Y"){
									$hasil = "<td border = '1'>&#10003</td>";
								}else{
									$hasil = "<td border = '1'>-</td>";
								}
								echo "$hasil";
					
							}
						}
					?>
				</tr>
				
				<tr>
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
							<td colspan='25'>
								<b>Catatan</b>
							</td>
						</tr>
						<?php
							$keterangan_pengecekan = mysql_query("select * from pengecekan_penampilan_sales_detail where substr(tanggal, 6, 2) = '$get_bulan' and hasil_penilaian = 'N'");
							while($data_keterangan_pengecekan = mysql_fetch_array($keterangan_pengecekan)){
								$nama_pengecekan = $data_keterangan_pengecekan['jenis_penilaian'];
								$tgl_pengecekan = $data_keterangan_pengecekan['tanggal'];
								$catatan_pengecekan = $data_keterangan_pengecekan['catatan_pengecekan'];
								
						?>
							<tr>
								<td colspan='25'>
									<?php //echo strtoupper($nama_pengecekan) ?>
								</td>
							
							</tr>
							<?php
								$keterangan_pengecekan = mysql_query("select * from pengecekan_penampilan_sales_detail where substr(tanggal, 6, 2) = '$get_bulan' and jenis_penilaian = '$nama_pengecekan' and hasil_penilaian = 'N' order by tanggal, kode_sales");
								while($data_keterangan_pengecekan = mysql_fetch_array($keterangan_pengecekan)){
									$nama_pengecekan = $data_keterangan_pengecekan['jenis_penilaian'];
									$tgl_pengecekan = $data_keterangan_pengecekan['tanggal'];
									$catatan_pengecekan = $data_keterangan_pengecekan['catatan_pengecekan'];
									$jam = $data_keterangan_pengecekan['jam'];
									$kode_sa = $data_keterangan_pengecekan['kode_sales'];
							?>
								<tr>
									<td colspan='25'>
										<?php echo $kode_sa." (".substr($tgl_pengecekan, 8, 2).'-'.substr($tgl_pengecekan, 5, 2).'-'.substr($tgl_pengecekan, 0, 4)." ".$jam.") : ".$catatan_pengecekan; ?>
									</td>
								</tr>
							<?php
								}
							?>
						<?php
							}
						?>
					</table>
				</td>
			</tr>
		</table>