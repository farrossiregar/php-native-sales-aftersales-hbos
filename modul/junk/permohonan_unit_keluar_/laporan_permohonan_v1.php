<?php
//include "../../config/koneksi.php";
include "koneksi.php"; 
require('fpdf/html_table.php');

date_default_timezone_set('Asia/Jakarta');
	
	//include "koneksi.php"; 
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
							


$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
//$pdf->Output('permohonan_unit_keluar('.$_GET['no_spk'].'-'.$data['waktu_keluar'].').pdf', 'D');


$html="
			
		<table border='0' width='100%' style='margin:20px;'>
			<tr>
				<td colspan='3' align='center'>&nbsp;</td>
		    </tr>
		    <tr>
				<td colspan='3' align='center'><b>HONDA BINTARO</b></td>
		    </tr>
		    <tr>
				<td colspan='3' align='center'><b>PERMOHONAN UNIT KELUAR</b></td>
		    </tr>
		    <tr>
				<td colspan='3' align='center'><hr /></td>
		    </tr>	
			<tr>
				<td>
					<div><h5>No SPK</h5></div>
				</td>
				<td>
					<div class='underline'><h5> : ".$data['no_spk']."</h5></div>
				</td>
				<td>
					<div class='underline'><h5>  <font color='#ffffff'>.</font></h5></div>
				</td>
				
				<td>
					<div class='underline'><h5> SALES : ".$data['nama_sales']."</h5></div>
				</td>
			</tr>
			<tr>
				<td>
					<div><h5>TYPE</h5></div>
				</td>
				<td>
					<div class='underline'><h5> : ".trim($sql1['tipe_mobil']).' / '.$sql1['nama_tipe']."</h5></div>
				</td>
				<td>
					<div class='underline'><h5> <font color='#ffffff'>.</font></h5></div>
				</td>
				<td>
					<div class='underline'><h5> WARNA : ".$sql1['warna']."</h5></div>
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
			
			
			<tr>
				<td style='width:15px;'>
					<br><br><br><br>FORM PENDUKUNG
				</td>
				<td style='width:15px;'>
					- PO LEASING & KONTRAK ASLI YG TELAH DI TTD CUSTOMER
				</td>
				
			</tr>
			<tr>
				<td style='width:15px;'>
					DARI SALES
				</td>
				<td style='width:15px;'>
					- COPY TANDA TERIMA SEMENTARA SEMUA PEMBAYARAN
				</td>
				
			</tr>
			<tr>
				<td style='width:15px;'>
					<br>FORM PENDUKUNG
				</td>
				<td style='width:15px;'>
					- FORM MATCHING , - FORM AKSESORIS OPTIONAL
				</td>
				
			</tr>
			<tr>
				<td style='width:15px;'>
					SALES ADM
				</td>
				<td style='width:15px;'>
					- FORM AKSESORIS + ASURANSI PURNA JUAL / TTP
				</td>
				
			</tr>
			<tr>
				<td style='width:15px;'>
					<br>FORM PENDUKUNG
				</td>
				<td style='width:15px;'>
					- FORM PENJUALAN + DATA PER SPK
				</td>
				
			</tr>
			<tr>
				<td style='width:15px;'>
					DARI FINANCE
				</td>
				<td style='width:15px;'>
					- TANDA TERIMA TAGIHAN LEASING + BUKTI EMAIL COVER ASURANSI
				</td>
				
			</tr>
			
			<tr>
				<td colspan='5'><br><br><br><br>TANGERANG, ".substr($data['input'], 0, 11)."</td>
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
				<td style='width:15px;'>
					
				</td>
				<td style='width:15px;'>
					
				</td>
				<td style='width:15px;'>
					
				</td>
				<td style='width:15px;'>
					
				</td>
				<td style='width:15px;'>
					
				</td>
			</tr>
			<tr>
				<td style='width:15px;'>
					
				</td>
				<td style='width:15px;'>
					
				</td>
				<td style='width:15px;'>
					
				</td>
				<td style='width:15px;'>
					
				</td>
				<td style='width:15px;'>
					
				</td>
			</tr>
			<tr>
				<td style='width:15px;'>
					(".$data['nama_sales'].")
				</td>
				<td style='width:15px;'>
					(..........................)
				</td>
				<td style='width:15px;'>
					(..........................)
				</td>
				<td style='width:15px;'>
					(..........................)
				</td>
				<td style='width:15px;'>
					(..........................)
				</td>
			</tr>
			
			<tr>
				<td style='width:15px;'>
					Sales
				</td>
				<td style='width:15px;'>
					Sales Supervisor
				</td>
				<td style='width:15px;'>
					A/R Finance
				</td>
				<td style='width:15px;'>
					A/R Finance
				</td>
				<td style='width:15px;'>
					Supervisor Finance
				</td>
			</tr>
			<tr>
				<td colspan='5'>
					<br>
					<br>
					
				</td>
				<td>
					<p>NOTE : PUK + FORM PENDUKUNG DISERAHKAN 3 (TIGA) HARI SEBELUM TANGGAL KELUAR KE BAGIAN FINANCE</p>
				</td>
			</tr>
			<tr>
				
			</tr>
		</table>

		";





//$pdf->WriteHTML($ket_discount);
//$pdf->write(10,40,$ket_discount);
$pdf->WriteHTML($html);
//$pdf->text(64,26,'...............................................................................................................................');
//$pdf->text(64,31.2,'...............................................................................................................................');
$pdf->text(52.5,36.6,'....................................................................................................................................................');
$pdf->text(52.5,41.6,'....................................................................................................................................................');
$pdf->text(52.5,47.4,'....................................................................................................................................................');
$pdf->text(52.5,54,'....................................................................................................................................................');
$pdf->text(52.5,59.5,'....................................................................................................................................................');
$pdf->text(52.5,66.2,'....................................................................................................................................................');
$pdf->text(52.5,72.8,'....................................................................................................................................................');
$pdf->text(52.5,77.8,'....................................................................................................................................................');
$pdf->text(52.5,85.2,'....................................................................................................................................................');
$pdf->text(52.5,90,'....................................................................................................................................................');
$pdf->text(52.5,97.2,'....................................................................................................................................................');
$pdf->text(52.5,103.4,'....................................................................................................................................................');


/*$pdf->text(64,96.2,'...............................................................................................................................');
$pdf->text(64,101,'...............................................................................................................................');
$pdf->text(64,106.2,'...............................................................................................................................');
$pdf->text(64,111.4,'...............................................................................................................................');
$pdf->text(64,116.4,'...............................................................................................................................');
$pdf->text(64,121,'...............................................................................................................................');
$pdf->text(64,126.2,'...............................................................................................................................');
$pdf->text(64,131.4,'...............................................................................................................................');
$pdf->text(64,136,'...............................................................................................................................');
$pdf->text(64,141.2,'...............................................................................................................................');
$pdf->text(64,146.4,'...............................................................................................................................');
$pdf->text(64,151,'...............................................................................................................................');	*/


$pdf->SetFont('Courier','',8);
//$pdf->text(143,190,"Dicetak tgl: ". date( 'd-m-Y, H:i:s'));
$pdf->Output();
//$pdf->Output('permohonan_unit_keluar('.$_GET['no_spk'].'-'.$data['waktu_keluar'].').pdf', 'D');




//$pdf->WriteHTML($ket_discount);
//$pdf->write(10,40,$ket_discount);
/*$pdf->WriteHTML($html);
//$pdf->text(64,26,'...............................................................................................................................');
//$pdf->text(64,31.2,'...............................................................................................................................');
$pdf->text(64,36.4,'...............................................................................................................................');
$pdf->text(64,41,'...............................................................................................................................');
$pdf->text(64,46.2,'...............................................................................................................................');
$pdf->text(64,51.4,'...............................................................................................................................');
$pdf->text(64,56.2,'...............................................................................................................................');
$pdf->text(64,61,'...............................................................................................................................');
$pdf->text(64,66.2,'...............................................................................................................................');
$pdf->text(64,71.4,'...............................................................................................................................');
$pdf->text(64,76.2,'...............................................................................................................................');
$pdf->text(64,81,'...............................................................................................................................');
$pdf->text(64,86.2,'...............................................................................................................................');
$pdf->text(64,91.4,'...............................................................................................................................');
$pdf->text(64,96.2,'...............................................................................................................................');
$pdf->text(64,101,'...............................................................................................................................');
$pdf->text(64,106.2,'...............................................................................................................................');
$pdf->text(64,111.4,'...............................................................................................................................');
$pdf->text(64,116.4,'...............................................................................................................................');
$pdf->text(64,121,'...............................................................................................................................');
$pdf->text(64,126.2,'...............................................................................................................................');
$pdf->text(64,131.4,'...............................................................................................................................');	

$pdf->SetFont('Courier','',8);
$pdf->text(143,170,"Dicetak tgl: ". date('d-m-Y, H:i:s'));
$pdf->Output();*/
}
?>