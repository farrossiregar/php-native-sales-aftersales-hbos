<?php

header("Content-type: application/vnd-ms-excel");
	$bulan = substr($_GET['bulan'], 5, 2);
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
	$bulan_cek = $_GET['bulan'];
	$tahun = date('Y');
header("Content-Disposition: attachment; filename=Green_Dealer_Check_Sheet_Showroom_".$bulan."_".$tahun.".xls");

?>

<?php
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
						$jumlah_data = mysql_query("select tanggal from pengecekan_showroom_detail where substr(tanggal, 1, 7) = '$bulan_cek' group by tanggal");
						$data_jumlah_data = mysql_num_rows($jumlah_data);
					?>
					<th colspan = "<?php echo $data_jumlah_data ?>" bgcolor = "#40a337" border = '1'>TANGGAL</th>
				</tr>
				<tr >
					<th width="2"></th>
					
					<?php
						$tanggal_pengecekan = mysql_query("select tanggal from pengecekan_showroom_detail where substr(tanggal, 1, 7) = '$bulan_cek' group by tanggal");
						while($data_tanggal_pengecekan = mysql_fetch_array($tanggal_pengecekan)){
					?>
					<th bgcolor = "orange" border = '1'><?php echo substr($data_tanggal_pengecekan['tanggal'], 8, 2); ?></th>
					<?php
						}
					?>
				</tr>
			</thead>
			<tbody>
			
			<?php
				$master = mysql_query("SELECT * from pengecekan_showroom_detail group by nama_penilaian order by no");	
				$no = 0;
				while($data_master = mysql_fetch_array($master)){
					$no = $no+1;
			?>
				
				<tr>
					<!--td border = '1' rowspan = "2" valign = "middle"><?php echo $no; ?></td-->
					<td border = '1' rowspan = "2" valign = "middle"><?php echo $data_master['nama_penilaian']; ?></td>
					<td border = '1'>09:00</td>
					<td></td>
					<?php
						$tanggal_pengecekan = mysql_query("select tanggal from pengecekan_showroom_detail where substr(tanggal, 1, 7) = '$bulan_cek' group by tanggal");
					//	while($data_tanggal_pengecekan = mysql_fetch_array($tanggal_pengecekan)){
							$tgl_cek = substr($data_tanggal_pengecekan['tanggal'], 8, 2);
							$penilaian = mysql_query("SELECT hasil from pengecekan_showroom_detail where jam = '09:00' and nama_penilaian = '$data_master[nama_penilaian]' and substr(tanggal, 1, 7) = '$bulan_cek' group by tanggal order by tanggal");	
							$no = 0;
							while($data_penilaian = mysql_fetch_array($penilaian)){
								$no = $no+1;
								if($data_penilaian['hasil'] == "Y"){
									$hasil = "<td border = '1'>&#10003</td>";
								}else{
									$hasil = "<td border = '1'><font color = 'red'><b>X</b></font></td>";
								}
								echo "$hasil";
							}
					//	}
					?>
				</tr>
				<tr>
					<td border = '1'>14:00</td>
					<td></td>
					<?php
						$tanggal_pengecekan = mysql_query("select tanggal from pengecekan_showroom_detail where substr(tanggal, 6, 2) = '$bulan_cek' group by tanggal");
					//	while($data_tanggal_pengecekan = mysql_fetch_array($tanggal_pengecekan)){
							$tgl_cek = substr($data_tanggal_pengecekan['tanggal'], 8, 2);
							$penilaian = mysql_query("SELECT hasil from pengecekan_showroom_detail where jam = '14:00' and nama_penilaian = '$data_master[nama_penilaian]' and substr(tanggal, 1, 7) = '$bulan_cek' group by tanggal order by tanggal");	
							$no = 0;
							while($data_penilaian = mysql_fetch_array($penilaian)){
								$no = $no+1;
								if($data_penilaian['hasil'] == "Y"){
									$hasil = "<td border = '1'>&#10003</td>";
								}else{
									$hasil = "<td border = '1'><font color = 'red'><b>X</b></font></td>";
								}
								echo "$hasil";
					
							}
					//	}
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
							$keterangan_pengecekan = mysql_query("select * from pengecekan_showroom_detail where substr(tanggal, 1, 7) = '$bulan_cek' and hasil = 'N'");
							while($data_keterangan_pengecekan = mysql_fetch_array($keterangan_pengecekan)){
								$nama_pengecekan = $data_keterangan_pengecekan['nama_penilaian'];
								$tgl_pengecekan = $data_keterangan_pengecekan['tanggal'];
								$catatan_pengecekan = $data_keterangan_pengecekan['catatan_pengecekan'];
								$jam = $data_keterangan_pengecekan['jam'];
						?>
							<tr>
								<td colspan='15'>
									<b><?php echo strtoupper($nama_pengecekan) ?></b></br>
								</td>
							</tr>
							
							<?php
								$keterangan_pengecekan = mysql_query("select * from pengecekan_showroom_detail where substr(tanggal, 1, 7) = '$bulan_cek' and hasil = 'N'");
								while($data_keterangan_pengecekan = mysql_fetch_array($keterangan_pengecekan)){
									$nama_pengecekan = $data_keterangan_pengecekan['nama_penilaian'];
									$tgl_pengecekan = $data_keterangan_pengecekan['tanggal'];
									$catatan_pengecekan = $data_keterangan_pengecekan['catatan_pengecekan'];
									$jam = $data_keterangan_pengecekan['jam'];
							?>
								<tr>
									<td colspan='15'>
										<?php echo "Tanggal ".substr($tgl_pengecekan, 8, 2).'-'.substr($tgl_pengecekan, 5, 2).'-'.substr($tgl_pengecekan, 0, 4)." ".$jam ?><br>
										<?php echo $catatan_pengecekan; ?>
									</td>
								</tr>
						<?php
								}
							}
						?>
					</table>
				</td>
			</tr>
		</table>