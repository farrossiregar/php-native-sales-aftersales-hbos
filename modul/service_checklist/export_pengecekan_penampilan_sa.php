<?php

header("Content-type: application/vnd-ms-excel");
	$bulan = $_GET['bulan'];
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
//	$no_pengecekan_mingguan = $_GET['no_pengecekan_mingguan'];
	$tahun = date('Y');
header("Content-Disposition: attachment; filename=Green_Dealer_Check_Sheet_Penampilan_SA_".$bulan."_".$tahun.".xls");

?>

<?php
include "../../config/koneksi_service.php";

?>
			
		<table border="1">
			<thead>
				<tr>
				</tr>
				<tr >
					<!--th rowspan = "2" bgcolor = "yellow" style="border:2px;">NO<?php echo $_GET['bulan'] ?></th-->
					<th rowspan = "2" bgcolor = "yellow" border = '1'>KODE SA</th>
					<th rowspan = "2" bgcolor = "yellow" border = '1'>PUKUL</th>
					<th rowspan = "2" bgcolor = "yellow" border = '1'>PENILAIAN</th>
					<th width="10"></th>
					<?php
						$jumlah_data = mysql_query("select tanggal from pengecekan_penampilan_sa_detail where substr(tanggal, 6, 2) = '$_GET[bulan]' group by tanggal");
						$data_jumlah_data = mysql_num_rows($jumlah_data);
					?>
					<th colspan = "<?php echo $data_jumlah_data ?>" bgcolor = "yellow" border = '1'>TANGGAL</th>
				</tr>
				<tr >
					<th width="2"></th>
					
					<?php
						$tanggal_pengecekan = mysql_query("select tanggal from pengecekan_penampilan_sa_detail where substr(tanggal, 6, 2) = '$_GET[bulan]' group by tanggal");
						while($data_tanggal_pengecekan = mysql_fetch_array($tanggal_pengecekan)){
					?>
					<th bgcolor = "green" border = '1'><?php echo substr($data_tanggal_pengecekan['tanggal'], 8, 2); ?></th>
					<?php
						}
					?>
				</tr>
			</thead>
		</table>
		
		
		<table border="1">
			<tbody>
			
			<?php
				$master = mysql_query("SELECT * from pengecekan_penampilan_sa_detail where substr(tanggal, 6, 2) = '$_GET[bulan]' limit 55");	
				$no = 0;
				while($data_master = mysql_fetch_array($master)){
					$no = $no+1;
			?>
		
				<tr>
					<!--td border = '1' rowspan = "2" valign = "middle"><?php echo $no; ?></td-->
					<td border = '1' rowspan = "" valign = "middle"><?php echo $data_master['kode_sa']; ?></td>
					<td border = '1' rowspan = "">08:00</td>
					<td><?php echo $data_master['jenis_penilaian']; ?></td>
					<td></td>
					<?php
						$tanggal_pengecekan = mysql_query("select tanggal from pengecekan_penampilan_sa_detail where substr(tanggal, 6, 2) = '$_GET[bulan]' and kode_sa = '$data_master[kode_sa]' group by tanggal ");
					//	while($data_tanggal_pengecekan = mysql_fetch_array($tanggal_pengecekan)){
							$tgl_cek = substr($data_tanggal_pengecekan['tanggal'], 8, 2);
							$penilaian = mysql_query("SELECT hasil_penilaian, catatan_pengecekan from pengecekan_penampilan_sa_detail where jam = '08:00' and kode_sa = '$data_master[kode_sa]' and substr(tanggal, 6, 2) = '$_GET[bulan]' and jenis_penilaian = '$data_master[jenis_penilaian]' order by tanggal");	
							$no = 0;
							while($data_penilaian = mysql_fetch_array($penilaian)){
								$cek_penilaian = mysql_num_rows($penilaian);
								$no = $no+1;
								if($data_penilaian['hasil_penilaian'] == "Y"){
									$hasil = "<td border = '1'> &#10003 </td>";
								}else{
									$hasil = "<td border = '1'><font color = 'red'><b> - </b></font></td>";
								}
								echo "$hasil";
					
							}
					//	}
					?>
				</tr>
				<tr>
					<td border = '1' rowspan = "" valign = "middle"><?php echo $data_master['kode_sa']; ?></td>
					<td border = '1' rowspan = "">13:00</td>
					<td><?php echo $data_master['jenis_penilaian']; ?></td>
					<td></td>
					<?php
						$tanggal_pengecekan = mysql_query("select tanggal from pengecekan_penampilan_sa_detail where substr(tanggal, 6, 2) = '$_GET[bulan]' and kode_sa = '$data_master[kode_sa]' group by tanggal");
					//	while($data_tanggal_pengecekan = mysql_fetch_array($tanggal_pengecekan)){
							$tgl_cek = substr($data_tanggal_pengecekan['tanggal'], 8, 2);
							$penilaian = mysql_query("SELECT hasil_penilaian, catatan_pengecekan from pengecekan_penampilan_sa_detail where jam = '13:00' and kode_sa = '$data_master[kode_sa]' and substr(tanggal, 6, 2) = '$_GET[bulan]' and jenis_penilaian = '$data_master[jenis_penilaian]' order by tanggal");	
							$no = 0;
							while($data_penilaian = mysql_fetch_array($penilaian)){
								$no = $no+1;
								if($data_penilaian['hasil_penilaian'] == "Y"){
									$hasil = "<td border = '1'> &#10003 </td>";
								}else{
									$hasil = "<td border = '1'><font color = 'red'><b> - </b></font></td>";
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
							<td colspan='25'>
								<b>Catatan</b>
							</td>
						</tr>
						
							<?php
								$keterangan_pengecekan = mysql_query("select * from pengecekan_penampilan_sa_detail where substr(tanggal, 6, 2) = '$_GET[bulan]' and hasil_penilaian = 'N' and catatan_pengecekan != ''");
								while($data_keterangan_pengecekan = mysql_fetch_array($keterangan_pengecekan)){
									$nama_pengecekan = $data_keterangan_pengecekan['jenis_penilaian'];
									$tgl_pengecekan = $data_keterangan_pengecekan['tanggal'];
									$catatan_pengecekan = $data_keterangan_pengecekan['catatan_pengecekan'];
									$jam = $data_keterangan_pengecekan['jam'];
									$kode_sa = $data_keterangan_pengecekan['kode_sa'];
							?>
								<tr>
									<td colspan='25'>
										<?php echo $kode_sa." : ".substr($tgl_pengecekan, 8, 2).'-'.substr($tgl_pengecekan, 5, 2).'-'.substr($tgl_pengecekan, 0, 4)." ".$jam." : ".$catatan_pengecekan; ?>
									</td>
								
								</tr>
							<?php
								}
							?>
					</table>
				</td>
			</tr>
		</table>