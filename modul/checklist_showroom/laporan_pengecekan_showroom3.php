<?php
//include "../../config/koneksi.php";
include "koneksi.php"; 
require('fpdf/html_table.php');

date_default_timezone_set('Asia/Jakarta');
	
	//include "koneksi.php"; 
//	$query = mysql_query("SELECT * FROM pemasangan_aksesoris where no_spk = 'JHGBUYG'"); 
	$query = mysql_query("SELECT * FROM pengecekan_showroom where no_pengecekan_mingguan = '$_GET[no_pengecekan_mingguan]'"); 
	$row = mysql_num_rows($query);
	if($row > 0){ 

			$data = mysql_fetch_array($query); 
			$no_pengecekan_mingguan = $data['no_pengecekan_mingguan'];			
			$bulan = $data['bulan'];
																		
			if($bulan == '01'){
				 $bulan = "Januari";
			}elseif($bulan == '02'){
				 $bulan = "Februari";
			}elseif($bulan == '03'){
				 $bulan = "Maret";
			}elseif($bulan == '04'){
				 $bulan = "April";
			}elseif($bulan == '05'){
				 $bulan = "Mei";
			}elseif($bulan == '06'){
				 $bulan = "Juni";
			}elseif($bulan == '07'){
				 $bulan = "Juli";
			}elseif($bulan == '08'){
				 $bulan = "Agustus";
			}elseif($bulan == '09'){
				 $bulan = "September";
			}elseif($bulan == '10'){
				 $bulan = "Oktober";
			}elseif($bulan == '11'){
				 $bulan = "November";
			}elseif($bulan == '12'){
				 $bulan = "Desember";
			}else{
				 $bulan = "";
			}

$pdf=new PDF('P','mm','A4');
$pdf->setautopagebreak(true,15);
$pdf->AddPage();
$pdf->SetFont('Arial','',7.5);


$html="
			
		<table>
		    <tr>
				<td colspan='2' align='center'><b>HONDA BINTARO</b></td>
		    </tr>
		    <tr>
				<td colspan='2' align='center'><b>FORM PENGECEKAN SHOWROOM</b></td>
		    </tr>
		    <tr>
				<td colspan='2' align='center'><hr /></td>
		    </tr>
		</table>
		

		<table>
			<tr>
				<td width='160%'>
					<div ><h5>NO PENGECEKAN MINGGUAN</h5></div>
				</td>
				<td width='250%'>
					<div class='underline'><h5> : ".$no_pengecekan_mingguan."</h5></div>
				</td>
				
			</tr>
			<tr>
				<td width='160%'>
					<div ><h5>NAMA PIC</h5></div>
				</td>
				<td width='250%'>
					<div class='underline'><h5> : ".strtoupper($data['nama_pic']).' ('.$data['divisi_pic'].')'."</h5></div>
				</td>
				
			</tr>
			<tr>
				<td width='160%'>
					<div><h5>BULAN PENGECEKAN</h5></div>
				</td>
				<td width='250%'>
					<div class='underline'><h5> : ".$bulan."</h5></div>
				</td>
			</tr>
			<tr>
				<td width='160%'>
					<div><h5>MINGGU PENGECEKAN</h5></div>
				</td>
				<td width='250%'>
					<div class='underline'><h5> : ".$data['minggu_pengecekan']."</h5></div>
				</td>
			</tr>
			
		</table>";	
		




$pdf->WriteHTML($html);




$html1 = "<table>
			<tr>
				<td width='500%'>
					<br>
					<h4><b>PENILAIAN SHOWROOM : </b></h4>
				</td>
			</tr>
			
			<tr width='900%'>
			<br>
				<td width='242%'>
					<h5><b><u>Nama Penilaian </u></b></h5>
				</td>
				<td width='50%'>
					<h5><b><u>Pukul</u></b></h5>
				</td>
				<td width='90%'>
					<h5><b><u>Hasil Penilaian </u></b></h5>
				</td>
				<td width='180%'>
					<h5><b><u>Catatan Penilaian </u></b></h5>
				</td>
				<td width='200%'>
					<h5><b><u>Keterangan Catatan Penilaian </u></b></h5>
				</td>

			</tr>
		</table>";
		
	
$pdf->WriteHTML($html1);

$master_kategori = mysql_query("select * from master_pengecekan_showroom group by kategori_penilaian order by no_kategori");
$n = 0;
while($data_master_kategori = mysql_fetch_array($master_kategori)){
$num2 = mysql_num_rows($master_kategori);
$n = $n+1;
$pdf->cell(4,5.5,$data_master_kategori['no_kategori'],0,0);
$pdf->cell(60,7,strtoupper($data_master_kategori['kategori_penilaian']),0,1);
	$pengecekan_showroom_detail = mysql_query("select * from pengecekan_showroom_detail where kategori_penilaian = '$data_master_kategori[kategori_penilaian]' and no_pengecekan_mingguan = '$no_pengecekan_mingguan' order by nama_penilaian, tanggal");
	while($data_pengecekan_showroom_detail = mysql_fetch_array($pengecekan_showroom_detail)){
		$nama_penilaian = $data_pengecekan_showroom_detail['nama_penilaian'];
		$jam = $data_pengecekan_showroom_detail['jam'];
		$tgl = $data_pengecekan_showroom_detail['tanggal'];
		$pdf->cell(6,5.5,'',0,0);
		$pdf->cell(15,5.5,$tgl,0,0);
		$pdf->cell(40,5.5,$nama_penilaian,0,0);
		$pdf->cell(13,5.5,$jam,0,0);
		$pdf->cell(23,5.5,$data_pengecekan_showroom_detail['hasil'],0,0);
		
			$pengecekan_showroom_detail2 = mysql_query("select * from pengecekan_showroom_detail where nama_penilaian = '$nama_penilaian' and jam = '$jam' and no_pengecekan_mingguan = '$no_pengecekan_mingguan' group by tanggal order by nama_penilaian");
			$total = mysql_num_rows($pengecekan_showroom_detail2);
			while($data_pengecekan_showroom_detail2 = mysql_fetch_array($pengecekan_showroom_detail2)){
			//	$pdf->cell(5,5.5,$data_pengecekan_showroom_detail2['hasil'],0,0);
			}
			$total2 = 6;
			$res2 = $total2 - $total;
			$i;
			for($i=1; $i<=$res2; $i++){
			//	$pdf->cell(5,5.5,'',0,0);
			}
		$pdf->cell(45,5.5,$data_pengecekan_showroom_detail['catatan_pengecekan'],0,0);
		$pdf->cell(45,5.5,$data_pengecekan_showroom_detail['keterangan_catatan_pengecekan'],0,1);
	}
}

$html2 = "<hr>
			<br>
			<br>
			<table>
				<tr>
					<td width='500%'>
						<h4><b>Di Approve oleh</b></h4>
					</td>
					<td width='500%'>
						<h4><b>Di Approve oleh</b></h4>
					</td>
				</tr>
				<tr><br><br>
					<td width='500%'>
						<h4><b>($data[sign_atasan2_user])</b></h4>
					</td>
					<td width='500%'>
						<h4><b>($data[sign_atasan1_user])</b></h4>
					</td>
					
				</tr>
				<tr>
					<td width='500%'>
						<h4><b>Sales Manager</b></h4>
					</td>
					<td width='500%'>
						<h4><b>Direktur</b></h4>
					</td>
				</tr>
			</table>";
		
	
$pdf->WriteHTML($html2);


$pdf->SetFont('Courier','',8);
//$pdf->text(143,190,"Dicetak tgl: ". date( 'd-m-Y, H:i:s'));
$pdf->Output();
//$pdf->Output('permohonan_unit_keluar('.$_GET['no_spk'].'-'.$data['tgl_unit_keluar'].').pdf', 'D');

}
?>