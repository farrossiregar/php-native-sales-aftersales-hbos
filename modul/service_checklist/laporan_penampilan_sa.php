<?php
include "config/koneksi.php";
//include "koneksi.php"; 
require('fpdf/html_table.php');

date_default_timezone_set('Asia/Jakarta');
	
	//include "koneksi.php"; 
//	$query = mysql_query("SELECT * FROM pemasangan_aksesoris where no_spk = 'JHGBUYG'"); 
	$query = mysql_query("SELECT * FROM pengecekan_penampilan_sa where no_pengecekan_mingguan = '$_GET[no_pengecekan_mingguan]'"); 
	$row = mysql_num_rows($query);
	if($row > 0){ 

			$data = mysql_fetch_array($query); 
			$no_pengecekan_mingguan = $data['no_pengecekan_mingguan'];			
			$bulan = substr($data['tanggal'], 5, 2);
			$bln = substr($data['tanggal'], 5, 2).'-'.substr($data['tanggal'], 0, 4);
																		
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
				<td colspan='2' align='center'><b>FORM PENGECEKAN PENAMPILAN SA BP</b></td>
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
					<div class='underline'><h5> : ".strtoupper($data['nama_pic'])."</h5></div>
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
			
		</table>";	
		




$pdf->WriteHTML($html);




$html1 = "<table>
			<tr>
				<td width='500%'>
					<br>
					<h4><b>PENILAIAN PENAMPILAN SA BP : </b></h4>
				</td>
			</tr>
			
			<tr width='900%'>
			<br>
				<td width='195%'>
					<h5><b><u>Jenis Penilaian </u></b></h5>
				</td>
				<td width='100%'>
					<h5><b><u>Hasil Penilaian </u></b></h5>
				</td>
				
			</tr>
		</table>
		";
		
	
$pdf->WriteHTML($html1);
$tgl_pengecekan = mysql_query("select tanggal from pengecekan_penampilan_sa_detail where no_pengecekan_mingguan = '$no_pengecekan_mingguan' group by tanggal");
		$pdf->cell(47.5, 4.5,'',0,0);
	while($data_tgl_pengecekan = mysql_fetch_array($tgl_pengecekan)){
		$pdf->cell(10,4.5,substr($data_tgl_pengecekan['tanggal'], 8, 2),1,0);
		
	}
	
$pdf->cell(90,4.5,'',0,1);

$master_kategori = mysql_query("select * from sa_bp");
$n = 0;
while($data_master_kategori = mysql_fetch_array($master_kategori)){
		
$num2 = mysql_num_rows($master_kategori);
$n = $n+1;
$pdf->cell(4,4.5,$n.".",0,0);
$pdf->cell(50,4.5,strtoupper($data_master_kategori['kode_sa_bp']),0,1);

	
//	$pengecekan_showroom_detail = mysql_query("select * from pengecekan_showroom_detail where kategori_penilaian = '$data_master_kategori[kategori_penilaian]' and no_pengecekan_mingguan = '$no_pengecekan_mingguan' order by nama_penilaian, tanggal");
	$pengecekan_showroom_detail = mysql_query("select * from pengecekan_penampilan_sa_detail where kode_sa = '$data_master_kategori[kode_sa_bp]' and no_pengecekan_mingguan = '$no_pengecekan_mingguan' group by jenis_penilaian");
	while($data_pengecekan_showroom_detail = mysql_fetch_array($pengecekan_showroom_detail)){

		$nama_penilaian = $data_pengecekan_showroom_detail['jenis_penilaian'];
		$jam = $data_pengecekan_showroom_detail['jam'];
		$tgl = $data_pengecekan_showroom_detail['tanggal'];
		$pdf->cell(8,4.5,'',0,0);
	//	$pdf->cell(15,5.5,$tgl,1,0);
		$pdf->cell(20,4.5,$nama_penilaian,0,0);
		$pdf->cell(20,4.5,'',0,0);
	//	$pdf->cell(23,5.5,$data_pengecekan_showroom_detail['hasil'],0,0);
		
			$pengecekan_showroom_detail2 = mysql_query("select * from pengecekan_penampilan_sa_detail where jenis_penilaian = '$nama_penilaian' and no_pengecekan_mingguan = '$no_pengecekan_mingguan' and kode_sa = '$data_master_kategori[kode_sa_bp]' order by tanggal, jam");
			$total = mysql_num_rows($pengecekan_showroom_detail2);
			while($data_pengecekan_showroom_detail2 = mysql_fetch_array($pengecekan_showroom_detail2)){
				$pdf->cell(4.7, 4.5,$data_pengecekan_showroom_detail2['hasil_penilaian'],1,0);
			}
			$total2 = 6;
			$res2 = $total2 - $total;
			$i;
			for($i=1; $i<=$res2; $i++){
				$pdf->cell(8,4.5,'',0,0);
			}
		$pdf->cell(5,4.5,'',0,1);
	}
}




$pdf->AddPage();
$html3 = "<h2><b>Keterangan Catatan Pengecekan : </b></h2><br><hr><br>";
$pdf->WriteHTML($html3);
$keterangan = mysql_query("select * from pengecekan_penampilan_sa_detail where no_pengecekan_mingguan = '$_GET[no_pengecekan_mingguan]' and hasil_penilaian = 'N' order by kode_sa, jenis_penilaian, tanggal");
$no = 0;
while($data_keterangan = mysql_fetch_array($keterangan)){
	$no += 1;
	$pdf->cell(5,5.5,$no.'.',0,0);
	$pdf->cell(8,5.5,strtoupper($data_keterangan['kode_sa']).' ('.strtoupper($data_keterangan['jenis_penilaian']).') ('.$data_keterangan['tanggal'].' '.$data_keterangan['jam'].')',0,1);
	$pdf->cell(8,5.5,'',0,0);
	$pdf->cell(8,5.5,"Catatan Pengecekan : ".strtolower($data_keterangan['catatan_pengecekan']),0,1);
	$pdf->cell(8,5.5,'',0,0);
	$pdf->cell(8,5.5,"Keterangan Catatan Pengecekan : ".strtolower($data_keterangan['keterangan_catatan_pengecekan']),0,1);
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
						<h4><b>Manager Bengkel</b></h4>
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