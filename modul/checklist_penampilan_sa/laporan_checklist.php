<?php
include "koneksi.php"; 
require('fpdf/html_table.php');

date_default_timezone_set('Asia/Jakarta');

	$pengecekan_showroom = mysql_query("SELECT * FROM pengecekan_showroom where no_pengecekan_mingguan = '$_GET[no_pengecekan_mingguan]'"); 
	$row = mysql_num_rows($pengecekan_showroom);
	if($row > 0){ 

			$data_pengecekan_showroom = mysql_fetch_array($pengecekan_showroom); 

$kategori_pengecekan = mysql_query("select * from master_pengecekan_showroom group by kategori_penilaian order by no_kategori asc");
$pdf=new PDF();

while ($data_kategori_pengecekan = mysql_fetch_array($kategori_pengecekan)) {
	$kategori = $data_kategori_pengecekan['nama_penilaian'];
	
	$pdf->AddPage();
	$pdf->Cell(42, 50, $kategori, 0, 0);
	$pdf->SetFont('Arial','',10);
} 


$html = $kategori;
/*$html="
		<table border='1' class='table table-bordered' id='sample-table-1'>
			<tbody>
		    <tr>
				<td colspan='3' align='center'><b>HONDA BINTARO</b></td>
		    </tr>
		    <tr>
				<td colspan='3' align='center'><b>PERMOHONAN UNIT KELUAR</b></td>
		    </tr>
		    <tr>
				<td colspan='3' align='center'><hr /></td>
		    </tr>	
			
		</tbody>
	</table>
	
	<table border='1' class='table table-bordered' id='sample-table-1'>
		<tbody>
			<tr>
				<td style='padding:10px;'>
					No Pengecekan Mingguan : 
				</td>
				<td>
					$data_pengecekan_showroom[no_pengecekan_mingguan]
				</td>
			</tr>
			<tr>
				<td colspan='2'>Nama PIC :</td>
				<td> $data_pengecekan_showroom[nama_pic]</td>
			</tr>
			<tr>
				<td>Minggu Pengecekan :</td>
				<td> $data_pengecekan_showroom[minggu_pengecekan]</td>
			</tr>
			<tr>
				<td>Bulan Pengecekan :</td>
				<td>$data_pengecekan_showroom[bulan]</td>
			</tr>
			<tr>
				<td>Divisi PIC : </td>
				<td>$data_pengecekan_showroom[divisi_pic]<br></td>
			</tr>
				".$kategori."</tr>
			
			<tr>
				<td></td>
				<td></td>
			</tr>
			
		</tbody>
	</table>
															
															
		<table border='0' width='100%' style='margin:50px;'>
			
			
			<tr>
				<td colspan='5'><br><br><br><br>TANGERANG, </td>
			</tr>
			<tr>
				<td >
					Yang Memohon,
				</td>
				<td >
					Menyetujui,
				</td>
				<td >
					Menyetujui,
				</td>
			</tr>
			<tr>
				<td >
					
				</td>
				<td >
					
				</td>
				<td >
					
				</td>
				
			</tr>
			<tr>
				<td >
					
				</td>
				<td >
					
				</td>
				<td >
					
				</td>
				
			</tr>
			<tr>
				<td >
					()
				</td>
				<td >
					()
				</td>
				<td >
					()
				</td>
				
			</tr>
			
			<tr>
				<td >
					PIC
				</td>
				<td >
					Sales Manager
				</td>
				<td >
					Direktur
				</td>
				
			</tr>
			
			<tr>
				
			</tr>
		</table>

		";*/


$pdf->WriteHTML($html);
//$pdf->text(64,26,'...............................................................................................................................');
//$pdf->text(64,31.2,'...............................................................................................................................');
/*$pdf->text(52.5,36.6,'....................................................................................................................................................');
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
$pdf->text(52.5,103.4,'....................................................................................................................................................');	*/



$pdf->SetFont('Courier','',8);
//$pdf->text(143,190,"Dicetak tgl: ". date( 'd-m-Y, H:i:s'));
$pdf->Output();
}
?>