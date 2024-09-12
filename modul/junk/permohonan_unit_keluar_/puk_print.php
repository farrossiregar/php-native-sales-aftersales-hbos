<?php ob_start(); ?>
	<html>
		<head>  
			<title>Cetak PDF</title>       
			
			<style>
				table {border-collapse:collapse; table-layout:fixed;width: 960px;}   table td {word-wrap:break-word;width: 20%;}
				.underline {border-bottom:1px dashed black;}
			</style>
		</head>
		
		<body>  
			<h2 style="text-align: center;"><u>PERMOHONAN UNIT KELUAR</u></h2>
			<hr>
			
				
				
				<?php
				// Load file koneksi.php
					include "koneksi.php"; 
					$query = mysql_query("SELECT * FROM unit_keluar where no_spk = '$_GET[no_spk]'"); 
					$row = mysql_num_rows($query);
					if($row > 0){ 
				
							$data = mysql_fetch_array($query); 
							$no_spk = $data['no_spk'];
							
						//	$query1 = mysql_query("select * from pengajuan_discount where no_spk = '$no_spk'");
							$query1 = mysql_query("SELECT pd.tipe_mobil as tipe_mobil, t.nama_tipe as nama_tipe, pd.*, t.* FROM pengajuan_discount pd, tipe t where no_spk='$no_spk' and t.kode_tipe = pd.tipe_mobil");
							$sql1 = mysql_fetch_array($query1);
							$dsc = "Rp ".number_format("$sql1[pengajuan_disc]",0,".",".");
							
							$query2 = mysql_query("select * from matching_local where no_spk_local = '$no_spk'");
							$sql2 = mysql_fetch_array($query2);
							$norangka_local = $sql2['norangka_local'];
							
							$query3 = mysql_query("select * from data_mobil where norangka = '$norangka_local'");
							$sql3 = mysql_fetch_array($query3);
							
							$query4 = mysql_query("select * from status_spk where no_spk = '$no_spk'");
							$sql4 = mysql_fetch_array($query4);
							
						//	$qry5 = mysql_query("select * from kwitansi_pesanan_kendaraan where noreferensi='$no_spk'");
							$qry5 = mysql_query("select sum(nilaipenerimaan) as dp1 from kwitansi_pesanan_kendaraan where noreferensi='$no_spk'");
							$sql5 = mysql_fetch_array($qry5);
								$dp1 = $sql5['dp1'];
							
						//	$qry6 = mysql_query("select * from kwitansi_pesanan_kendaraan where noreferensi='$sql4[no_penjualan]'");
							$qry6 = mysql_query("select sum(nilaipenerimaan) as dp2 from kwitansi_pesanan_kendaraan where noreferensi='$sql4[no_penjualan]'");
							$sql6 = mysql_fetch_array($qry6);
								$dp2 = $sql6['dp2'];
								$dpp1 = "<tr>
											<td style='width:25%; border:0px;'>
												<div><h5>DP</h5></div>
											</td>
											<td style='width:25%; border:0px;'>
												<div><h5> : ".$dp2."</h5></div>
											</td>
										</tr>";
							$total = $dp1 + $dp2;
							$ttl = "Rp ".number_format("$total",0,".",".");
							     
								echo "<table border='0' width='100%' style='margin:20px;'>
									
									<tr>
										<td style='width:25%; border:0px;'>
											<div><h5>No SPK</h5></div>
										</td>
										<td style='width:70%; border:0px;'>
											<div class='underline'><h5> : ".$data['no_spk']."</h5></div>
										</td>
									</tr>
									<tr>
										<td>
											<div><h5>SALES</h5></div>
										</td>
										<td>
											<div class='underline'><h5> : ".$data['nama_sales']."</h5></div>
										</td>
									</tr>
									<tr>
										<td>
											<div><h5>TYPE</h5></div>
										</td>
										<td>
											<div class='underline'><h5> : ".$sql1['tipe_mobil'].' / '.$sql1['nama_tipe']."</h5></div>
										</td>
									</tr>
									<tr>
										<td>
											<div><h5>WARNA</h5></div>
										</td>
										<td>
											<div class='underline'><h5> : ".$sql1['warna']."</h5></div>
										</td>
									</tr>
									<tr>
										<td>
											<div><h5>NO. RANGKA</h5></div>
										</td>
										<td>
											<div class='underline'><h5> : ".$norangka_local."</h5></div>
										</td>
									</tr>
									<tr>
										<td>
											<div><h5>NO. MESIN</h5></div>
										</td>
										<td>
											<div class='underline'><h5> : ".$sql3['nomesin']."</h5></div>
										</td>
									</tr>
									<tr>
										<td>
											<div><h5>SPK A/N </h5></div>
										</td>
										<td>
											<div class='underline'><h5> : ".$sql1['nama_customer']."</h5></div>
										</td>
									</tr>
									<tr>
										<td>
											<div><h5>WAKTU KELUAR </h5></div>
										</td>
										<td>
											<div class='underline'><h5> : ".$data['waktu_keluar']."</h5></div>
										</td>
										
									</tr>
									<tr>
										<td>
											<div><h5>CARA PEMBAYARAN </h5></div>
										</td>
										<td>
											<div class='underline'><h5> : ".$sql1['cara_beli']." ".$sql1['leasing']." ".$sql1['tenor']."</h5></div>
										</td>
									</tr>
									<tr>
										<td style='width:25%; border:0px;'>
											<div><h5>TOTAL PELUNASAN </h5></div>
										</td>
										<td style='width:35%; border:0px;'>
											<div class='underline'><h5> : ".$ttl."</h5></div>
										</td>
									</tr>
									<tr>
										<td>
											<div><h5>DISCOUNT </h5></div>
										</td>
										<td>
											<div class='underline'><h5> : ".$dsc."</h5></div>
										</td>
									</tr>
									<tr>
										<td>
											<div><h5>KETERANGAN </h5></div>
										</td>
										<td>
											<div class='underline'><h5> : ".$data['keterangan']."</h5></div>
										</td>
									</tr>
									</table>";
									
								/*	echo "<table width='100%' style='margin:20px;'>
									<tr>
										<td style='width: 20%; border:0px;'>
											<div style='vertical-align:top;'><h5>FORM PENDUKUNG <b>DARI SALES</b> :</h5></div>
										</td>
										<td style='width: 75%; border:0px;'>
											<div>
												<h5>
													<ul>
														<li>PO LEASING & KONTRAK ASLI YG TELAH DI TTD CUSTOMER</li>
														<li>COPY TANDA TERIMA SEMENTARA SEMUA PEMBAYARAN</li>
													</ul>
												</h5>
											</div>
											
										</td>
										
									</tr>
									<tr>
										<td style='border:0px;'>
											<div style='vertical-align:top;'><h5>FORM PENDUKUNG <b>DARI ADM</b> :</h5></div>
										</td>
										<td style='border:0px;'>
											<div>
												<h5>
													<ul>
														<li>FORM MATCHING</li>
														<li>FORM AKSESORIS OPTIONAL</li>
														<li>FORM AKSESORIS + ASURANSI PURNA JUAL / TTP</li>
													</ul>
												</h5>
											</div>
											
										</td>
									</tr>
									<tr>
										<td style='border:0px;'>
											<div style='vertical-align:top;'><h5>FORM PENDUKUNG <b>DARI FINANCE</b> :</h5></div>
										</td>
										<td style='width:300px; border:0px;'>
											<div>
												<h5>
													<ul>
														<li>FORM PENJUALAN + DATA PER SPK</li>
														<li>TANDA TERIMA TAGIHAN LEASING + BUKTI EMAIL COVER ASURANSI</li>
													</ul>
												</h5>
											</div>
											
										</td>
									</tr>
								</table>";	*/
								
								echo "
									<table width='100%' style='margin:20px;'>
										<tr>
											<td colspan='5'><br><br>TANGERANG, ".substr($data['input'], 0, 11)."</td>
										</tr>
										<tr>
											<td style='width:15px;'>
												Yang Memohon,
											</td>
											<td style='width:15%;'>
												Mengetahui,
											</td>
											<td style='width:15%;'>
												Yang Menerima,
											</td>
											<td style='width:15%;'>
												Menyetujui,
											</td>
											<td style='width:15%;'>
												Menyetujui,
											</td>
										</tr>
										<tr>
											<td >
												<br>
												(".$data['nama_sales'].")
												<br>
											</td>
											<td >
												<br>
												(".$data['spv_user_app'].")
												<br>
											</td>
											<td >
												<br>
												(".$data['arfinance_user_app'].")
												<br>
											</td>
											<td >
												<br>
												(".$data['spv_finance_user_app'].")
												<br>
											</td>
											<td >
												<br>
												(".$data['mngr_finance_user_app'].")
												<br>
											</td>
										</tr>
										<tr>
											<td >
												<br>
												Sales
											</td>
											<td >
												<br>
												Sales Supervisor
											</td>
											<td >
												<br>
												A/R Finance
											</td>
											<td >
												Supervisor Finance
											</td>
											<td >
												<br>
												Supervisor Finance
											</td>
										</tr>
										<tr>
											<td colspan='5'>
											<br><br>
												<p style='color:red;'>* DOKUMEN INI TIDAK MEMERLUKAN TANDA TANGAN</p>
											</td>
										</tr>
										<tr>
											<td colspan='5'>
												<b>NOTE</b> : PUK + FORM PENDUKUNG DISERAHKAN 3 (TIGA) HARI SEBELUM TANGGAL KELUAR KE BAGIAN FINANCE
											</td>
										</tr>
									</table>";
								
							
					//	}
					}
				?>
			
		</body>
	</html>
			
<?php
	$html = ob_get_contents();
	ob_end_clean();        
	require_once('html2pdf/html2pdf.class.php');
	$pdf = new HTML2PDF('P','A4','en');
	$pdf->WriteHTML($html);
//	$pdf->Output('permohonan_unit_keluar('.$_GET['no_spk'].'-'.$data['waktu_keluar'].').pdf', 'D');
?>