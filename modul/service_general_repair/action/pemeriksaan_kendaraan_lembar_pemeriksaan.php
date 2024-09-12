<?php

include "../../../config/koneksi_service.php"; 
require('../../../vendor/fpdf/html_table.php');

date_default_timezone_set('Asia/Jakarta');
	
	$pemeriksaan_kendaraan = mysql_query("SELECT * FROM pemeriksaan_kendaraan where no_pemeriksaan = '$_GET[no_pemeriksaan]'"); 
	$cek_pemeriksaan_kendaraan = mysql_num_rows($pemeriksaan_kendaraan);
	if($cek_pemeriksaan_kendaraan > 0){ 
			$data_pemeriksaan_kendaraan = mysql_fetch_array($pemeriksaan_kendaraan); 
			

$pdf=new PDF('P','mm','A4');
$pdf->setautopagebreak(true,15);
$pdf->AddPage();
$pdf->SetFont('Arial','',7.5);


$pemeriksaan_kendaraan_kelengkapan = mysql_query("select * from pemeriksaan_kendaraan_kelengkapan where no_pemeriksaan = '$_GET[no_pemeriksaan]'");
$cek_pemeriksaan_kendaraan_kelengkapan = mysql_num_rows($pemeriksaan_kendaraan_kelengkapan);


$html="
			
		<table>
		    <tr>
				<td colspan='2' align='center'><b>HONDA BINTARO</b></td>
				<td align='center'><h1><b>LEMBAR PEMERIKSAAN KENDARAAN</b></h1></td>
		    </tr>
		    <tr>
				<td colspan='2' align='center'><hr /></td>
		    </tr>
		</table>";
	

$pdf->WriteHTML($html);


$pdf->cell(30,4.5,'No Pemeriksaan ',0,0);
$pdf->cell(65,4.5,':'.$data_pemeriksaan_kendaraan['no_pemeriksaan'],0,0);
$pdf->cell(30,4.5,'PIC Appearance Check ',0,0);
$pdf->cell(65,4.5,':'.$data_pemeriksaan_kendaraan['nama_pic'],0,1);
$pdf->cell(30,4.5,'Nama Pelanggan',0,0);
$pdf->cell(65,4.5,':'.$data_pemeriksaan_kendaraan['nama_customer'],0,1);
$pdf->cell(30,4.5,'No Pol / Model / Tahun ',0,0);
$pdf->cell(65,4.5,':'.$data_pemeriksaan_kendaraan['no_polisi'].' / '.$data_pemeriksaan_kendaraan['model'].' / '.$data_pemeriksaan_kendaraan['tahun'].' '.strtoupper($data_pemeriksaan_kendaraan['transmisi_mobil']).'',0,0);
$pdf->cell(30,4.5,'Odemeter ',0,0);
$pdf->cell(65,4.5,':'.$data_pemeriksaan_kendaraan['odmeter'],0,1);
$pdf->Ln();
$pdf->cell(30,4.5,'Keluhan ',0,0);
if(strlen($data_pemeriksaan_kendaraan['keluhan']) > 120){
//if(explode($data_pemeriksaan_kendaraan['keluhan']) > 10){
	$keluhan1 = substr($data_pemeriksaan_kendaraan['keluhan'], 0, 120);
	$keluhan_explode = explode(" ", $keluhan1);
	$keluhan2 = substr($data_pemeriksaan_kendaraan['keluhan'], 120, 40);
	$explode = explode(" ",$data_pemeriksaan_kendaraan['keluhan']);
	$explode_array = array($explode);
	$array_slice = array_slice($explode, 4);
	foreach($explode as $expld){
		
	}
	$chunk_split = chunk_split($data_pemeriksaan_kendaraan['keluhan'], 5, "=");
	$pdf->cell(65,4.5,': '.end($keluhan_explode),0,1);
	$pdf->cell(30,4.5,' ',0,0);
	$pdf->cell(65,4.5,': '.$keluhan2,0,1);
	$break = 1;
}else{
	$break = 0;
	$pdf->cell(65,4.5,':'.$data_pemeriksaan_kendaraan['keluhan'],0,1);
}
$pdf->cell(30,4.5,'Catatan ',0,0);
if(strlen($data_pemeriksaan_kendaraan['catatan']) > 120){
	$catatan1 = substr($data_pemeriksaan_kendaraan['catatan'], 0, 120);
	$catatan2 = substr($data_pemeriksaan_kendaraan['catatan'], 120, 40);
	$pdf->cell(65,4.5,': '.$catatan1,0,1);
	$pdf->cell(30,4.5,' ',0,0);
	$pdf->cell(65,4.5,': '.$catatan2,0,1);
	$break = 1;
}else{
	$break = 0;
	$pdf->cell(65,4.5,':'.$data_pemeriksaan_kendaraan['catatan'],0,1);
}



$kelengkapan = "<br><table><tr>
					<td width='200%'>
						<div><h5><b>KELENGKAPAN</b></h5></div>
					</td>
					<td width='200%'>
					</td>
				</tr>
			</table>";		
$pdf->WriteHTML($kelengkapan);

$pemeriksaan_kendaraan_kelengkapan = mysql_query("select * from pemeriksaan_kendaraan_kelengkapan where no_pemeriksaan = '$_GET[no_pemeriksaan]' and status = 'Y'");
$no = 0;
	while($data_pemeriksaan_kendaraan_kelengkapan = mysql_fetch_array($pemeriksaan_kendaraan_kelengkapan)){
		$no = $no+1;
		if($no == '2' || $no == '4' || $no == '6'){
			$nn = 1;
		}else{
			$nn = 0;
		}
		
		$pdf->cell(5,4.5,'',0,0);
		$pdf->cell(5,4.5,$no,0,0);
		$pdf->cell(25,4.5,$data_pemeriksaan_kendaraan_kelengkapan['nama_item'],0,0);
		$pdf->cell(50,4.5,"Keterangan : ".$data_pemeriksaan_kendaraan_kelengkapan['kondisi'],0,$nn);
	}

$ban_batere = "<br><table><tr>
					<td width='200%'>
						<div><h5><b>BAN DAN BATERE</b></h5></div>
					</td>
					<td width='200%'>
					</td>
				</tr>
			</table>";		
$pdf->WriteHTML($ban_batere);

$pemeriksaan_kendaraan_batere = mysql_query("select * from pemeriksaan_kendaraan_ban_battery where no_pemeriksaan = '$_GET[no_pemeriksaan]' and nama_item != 'Ban'");

	while($data_pemeriksaan_kendaraan_batere = mysql_fetch_array($pemeriksaan_kendaraan_batere)){
		$pdf->cell(5,4.5,'',0,0);
		$pdf->cell(5,4.5,'1',0,0);
		$pdf->cell(30,4.5,'Battery',0,0);
		if($data_pemeriksaan_kendaraan_batere['kondisi'] == 'BAIK'){
			$kondisi_batere = "Good";
		}else if($data_pemeriksaan_kendaraan_batere['kondisi'] == 'SEDANG'){
			$kondisi_batere = "Good and Recharge";
		}else if($data_pemeriksaan_kendaraan_batere['kondisi'] == 'TIDAK BAIK'){
			$kondisi_batere = "Bad and Replace";
		}else{
			$kondisi_batere = "";
		}
		$pdf->cell(30,4.5,'',0,0);
		$pdf->cell(30,4.5,$kondisi_batere,0,1);
		$pdf->Ln();
		
	}
		
$pemeriksaan_kendaraan_ban_batere = mysql_query("select * from pemeriksaan_kendaraan_ban_battery where no_pemeriksaan = '$_GET[no_pemeriksaan]' and nama_item != 'Battery'");
$no = 0;
	while($data_pemeriksaan_kendaraan_ban_batere = mysql_fetch_array($pemeriksaan_kendaraan_ban_batere)){
		$no = $no+1;
		if($no == '2' || $no == '4' || $no == '6'){
			$nn = 1;
		}else{
			$nn = 0;
		}
		
		$pdf->cell(5,4.5,'',0,0);
		$pdf->cell(5,4.5,$no,0,0);
		$pdf->cell(30,4.5,'Ban '.strtolower($data_pemeriksaan_kendaraan_ban_batere['sisi'].' - '.$data_pemeriksaan_kendaraan_ban_batere['sebelah']),0,0);
		$pdf->cell(10,4.5,$data_pemeriksaan_kendaraan_ban_batere['tebal'].' mm',0,0);
		$pdf->cell(35,4.5,strtolower($data_pemeriksaan_kendaraan_ban_batere['kondisi']),0,$nn);
	}

$pemeriksaan_body = "<br><table>
						<tr>
							<td>
								<b>PEMERIKSAAN BODY</b>
							</td>
						</tr>
					</table><br>";
					
$pdf->WriteHTML($pemeriksaan_body);

if($data_pemeriksaan_kendaraan['gambar_pemeriksaan_base64']!=''){

$upload_dir = "act/upload/";
$img = $data_pemeriksaan_kendaraan['gambar_pemeriksaan_base64'];
$dataPieces = explode(',',$img);
$encodedImg = $dataPieces[1];
$nama_file = mktime().".png";
$data = base64_decode($encodedImg);
$file = $upload_dir . $nama_file;
$success = file_put_contents($file, $data);	
}	

$pdf->Image($file, $pdf->GetX(), $pdf->GetY(), 150);

unlink($file);


$pemeriksaan_kendaraan_bunyi = mysql_query("select * from pemeriksaan_kendaraan_bunyi where no_pemeriksaan = '$_GET[no_pemeriksaan]'");
$data_pemeriksaan_kendaraan_bunyi = mysql_fetch_array($pemeriksaan_kendaraan_bunyi);

				
$pemeriksaan_bunyi = "<br><br><br><br><br><br><br><br><br><br><br><table>
						<tr>
							<td>
								<b>PEMERIKSAAN BUNYI</b>
							</td>
						</tr>
					</table><br>";
					
$pdf->WriteHTML($pemeriksaan_bunyi);

$pdf->cell(70,4.5,'1. Bagaimana bunyinya (bunyi) ? ',0,0);
$pdf->cell(70,4.5,$data_pemeriksaan_kendaraan_bunyi['bunyi_bagaimana'],0,1);
$pdf->cell(70,4.5,'2. Bunyi tersebut terdengar dari mana (bunyi) ? ',0,0);
$pdf->cell(70,4.5,$data_pemeriksaan_kendaraan_bunyi['bunyi_darimana'],0,1);
$pdf->cell(70,4.5,'3. Seberapa besar bunyinya (bunyi) ? ',0,0);
$pdf->cell(70,4.5,$data_pemeriksaan_kendaraan_bunyi['bunyi_seberapakencang'],0,1);
$pdf->cell(70,4.5,'4. Bagaimana karakter bunyinya (bunyi) ? ',0,0);
$pdf->cell(70,4.5,$data_pemeriksaan_kendaraan_bunyi['bunyi_karakter'],0,1);
$pdf->cell(70,4.5,'5. Seberapa sering problem tersebut muncul ?  ',0,0);
$pdf->cell(70,4.5,$data_pemeriksaan_kendaraan_bunyi['bunyi_sering'],0,1);
$pdf->cell(70,4.5,'6. Sejak kapan timbul problem tersebut ?',0,0);
$pdf->cell(70,4.5,$data_pemeriksaan_kendaraan_bunyi['kapan_timbul'],0,1);
$pdf->cell(70,4.5,'7. Waktu kejadian pada kondisi',0,0);
$pdf->cell(70,4.5,$data_pemeriksaan_kendaraan_bunyi['sejak_kapan_timbul'],0,1);
$pdf->cell(70,4.5,'8. Kondisi pengendaraan saat timbul problem ',0,0);
$pdf->cell(70,4.5,$data_pemeriksaan_kendaraan_bunyi['kondisi_berkendara'],0,1);
$pdf->cell(70,4.5,'9. Kondisi jalan yang menyebabkan timbulnya problem ',0,0);
$pdf->cell(70,4.5,$data_pemeriksaan_kendaraan_bunyi['kondisi_jalan'],0,1);
$pdf->cell(70,4.5,'10. Waktu kejadian pada saat putaran mesin',0,0);
$pdf->cell(70,4.5,$data_pemeriksaan_kendaraan['rpm'],0,1);

$break = "<br><br>";
$pdf->WriteHTML($break);

if($data_pemeriksaan_kendaraan['ttd_pelanggan']!=''){

$upload_dir = "act/upload/";
$ttd = $data_pemeriksaan_kendaraan['ttd_pelanggan'];
$dataPiecesTtd = explode(',',$ttd);
$encodedImgTtd = $dataPiecesTtd[1];
$nama_file_ttd = mktime().mktime().".png";
$data_ttd = base64_decode($encodedImgTtd);
$file_ttd = $upload_dir . $nama_file_ttd;
$success_ttd = file_put_contents($file_ttd, $data_ttd);	
}	

$pdf->cell(50,4.5,'PIC Appearance Check',0,0);
$pdf->cell(50,4.5,'Pelanggan',0,1);
$pdf->cell(50,14,$pdf->Image($file_ttd, $pdf->GetX(), $pdf->GetY(), 30),0,0);
$pdf->cell(50,14,$pdf->Image($file_ttd, $pdf->GetX(), $pdf->GetY(), 30),0,1);
$pdf->cell(50,4.5,$data_pemeriksaan_kendaraan['nama_pic'],0,0);
$pdf->cell(50,4.5,$data_pemeriksaan_kendaraan['nama_customer'],0,1);
unlink($file_ttd);


$pdf->SetFont('Courier','',8);
//$pdf->text(143,190,"Dicetak tgl: ". date( 'd-m-Y, H:i:s'));
$pdf->Output();
//$pdf->Output('permohonan_unit_keluar('.$_GET['no_spk'].'-'.$data['tgl_unit_keluar'].').pdf', 'D');

}
?>