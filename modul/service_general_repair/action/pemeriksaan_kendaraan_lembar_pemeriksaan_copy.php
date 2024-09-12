<?php
//include "../../config/koneksi.php";
include "../../../config/koneksi_service.php"; 
require('fpdf/html_table.php');

date_default_timezone_set('Asia/Jakarta');
	
	$pemeriksaan_kendaraan = mysql_query("SELECT * FROM pemeriksaan_kendaraan where no_pemeriksaan = '$_GET[no_pemeriksaan]'"); 
	$cek_pemeriksaan_kendaraan = mysql_num_rows($pemeriksaan_kendaraan);
	if($cek_pemeriksaan_kendaraan > 0){ 
			$data_pemeriksaan_kendaraan = mysql_fetch_array($pemeriksaan_kendaraan); 
			

$pdf=new PDF('P','mm','A4');
$pdf->setautopagebreak(true,15);
$pdf->AddPage();
$pdf->SetFont('Arial','',7.5);


$html="
			
		<table>
		    <tr>
				<td colspan='2' align='center'><b>HONDA BINTARO</b></td>
				<td align='center'><h1><b>LEMBAR PEMERIKSAAN KENDARAAN</b></h1></td>
		    </tr>
		    <tr>
				<td colspan='2' align='center'><hr /></td>
		    </tr>
		</table>
		

		<table>
			<tr>
				<td width='400%'>
					<div ><h5>Tanggal Kedatangan : ".substr($data_pemeriksaan_kendaraan['tanggal'], 0, 10)."</h5></div>
				</td>
				<td width='500%'>
					<div ><h5>Model / Tahun : ".$data_pemeriksaan_kendaraan['model'].' / '.$data_pemeriksaan_kendaraan['tahun'].' ('.strtoupper($data_pemeriksaan_kendaraan['transmisi_mobil']).') '."</h5></div>
				</td>
			</tr>
			<tr>
				<td width='400%'>
					<div ><h5>No Polisi : ".$data_pemeriksaan_kendaraan['no_polisi']."</h5></div>
				</td>
				<td width='400%'>
					<div ><h5>Odometer : ".$data_pemeriksaan_kendaraan['odmeter']."</h5></div>
				</td>
				
			</tr>
		</table><br><br>";	

$pdf->WriteHTML($html);

$kelengkapan_ban_batere = "<table>
								<tr>
									<td width='400%'>
										<div ><h5>Tanggal Kedatangan : ".substr($data_pemeriksaan_kendaraan['tanggal'], 0, 10)."</h5></div>
									</td>
									<td width='500%'>
										<div ><h5>Model / Tahun : ".$data_pemeriksaan_kendaraan['model'].' / '.$data_pemeriksaan_kendaraan['tahun'].' ('.strtoupper($data_pemeriksaan_kendaraan['transmisi_mobil']).') '."</h5></div>
									</td>
								</tr>
								<tr>
									<td width='400%'>
										<div ><h5>No Polisi : ".$data_pemeriksaan_kendaraan['no_polisi']."</h5></div>
									</td>
									<td width='400%'>
										<div ><h5>Odometer : ".$data_pemeriksaan_kendaraan['odmeter']."</h5></div>
									</td>
									
								</tr>
							</table>";

		
$pemeriksaan_kendaraan_kelengkapan = mysql_query("select * from pemeriksaan_kendaraan_kelengkapan where no_pemeriksaan = '$_GET[no_pemeriksaan]'");
$cek_pemeriksaan_kendaraan_kelengkapan = mysql_num_rows($pemeriksaan_kendaraan_kelengkapan);
if($cek_pemeriksaan_kendaraan_kelengkapan > 0){
$no = 0;
		$pdf->cell(6,4.5,'no',1,0);
		$pdf->cell(20,4.5,'Kelengkapan',1,0);
		$pdf->cell(20,4.5,'Checklist',1,0);
		$pdf->cell(20,4.5,'Kondisi',1,1);
	while($data_pemeriksaan_kendaraan_kelengkapan = mysql_fetch_array($pemeriksaan_kendaraan_kelengkapan)){
		$no = $no+1;
		$pdf->cell(6,4.5,$no,1,0);
		$pdf->cell(20,4.5,$data_pemeriksaan_kendaraan_kelengkapan['nama_item'],1,0);
		$pdf->cell(20,4.5,$data_pemeriksaan_kendaraan_kelengkapan['status'],1,0);
		$pdf->cell(20,4.5,$data_pemeriksaan_kendaraan_kelengkapan['kondisi'],1,1);
	}
}else{
		$pdf->cell(6,4.5,'no',1,0);
		$pdf->cell(20,4.5,'Kelengkapan',1,0);
		$pdf->cell(20,4.5,'Checklist',1,0);
		$pdf->cell(20,4.5,'Kondisi',1,1);
		$no = 0;
	for($i = 0; $i < 6; $i++){
		$no = $no+1;
		$pdf->cell(6,4.5,$no,1,0);
		$pdf->cell(20,4.5,'',1,0);
		$pdf->cell(20,4.5,'',1,0);
		$pdf->cell(20,4.5,'',1,1);
	}
}

$break = "<br>";
$pdf->WriteHTML($break);


	/*	$pdf->cell(12,4.5,'Battery',1,0);
		$pdf->cell(30,4.5,'Good',1,0);
		$pdf->cell(30,4.5,'Good & Recharge',1,0);
		$pdf->cell(30,4.5,'Bad & Replace',1,1);	*/

$pemeriksaan_kendaraan_batere = mysql_query("select * from pemeriksaan_kendaraan_ban_battery where no_pemeriksaan = '$_GET[no_pemeriksaan]' and nama_item != 'Ban'");
$cek_pemeriksaan_kendaraan_batere = mysql_num_rows($pemeriksaan_kendaraan_batere);
if($cek_pemeriksaan_kendaraan_batere > 0){
	while($data_pemeriksaan_kendaraan_batere = mysql_fetch_array($pemeriksaan_kendaraan_batere)){
		$pdf->cell(12,4.5,'Battery',1,0);
		if($data_pemeriksaan_kendaraan_batere['kondisi'] == 'BAIK'){
			$pdf->cell(30,4.5,'Good',1,0);
		}else{
			$pdf->cell(30,4.5,'',1,0);
		}
		if($data_pemeriksaan_kendaraan_batere['kondisi'] == 'SEDANG'){
			$pdf->cell(30,4.5,'Good and Recharge',1,0);
		}else{
			$pdf->cell(30,4.5,'',1,0);
		}
		if($data_pemeriksaan_kendaraan_batere['kondisi'] == 'TIDAK BAIK'){
			$pdf->cell(30,4.5,'Bad and Replace',1,0);
		}else{
			$pdf->cell(30,4.5,'',1,1);
		}
		
	}
		
$pemeriksaan_kendaraan_ban_batere = mysql_query("select * from pemeriksaan_kendaraan_ban_battery where no_pemeriksaan = '$_GET[no_pemeriksaan]' and nama_item != 'Battery'");
	while($data_pemeriksaan_kendaraan_ban_batere = mysql_fetch_array($pemeriksaan_kendaraan_ban_batere)){
		$pdf->cell(12,4.5,'BAN',1,0);
		$pdf->cell(30,4.5,$data_pemeriksaan_kendaraan_ban_batere['sisi'].'/'.$data_pemeriksaan_kendaraan_ban_batere['sebelah'],1,0);
		$pdf->cell(30,4.5,$data_pemeriksaan_kendaraan_ban_batere['tebal'].' mm',1,0);
		$pdf->cell(30,4.5,$data_pemeriksaan_kendaraan_ban_batere['kondisi'],1,1);
	}
}else{
	$pdf->cell(12,4.5,'Battery',1,0);
	$pdf->cell(30,4.5,'Good',1,0);
	$pdf->cell(30,4.5,'Good and Recharge',1,0);
	$pdf->cell(30,4.5,'Bad and Replace',1,1);
	
	for($i = 0; $i < 4; $i++){
		$pdf->cell(12,4.5,'BAN',1,0);
		$pdf->cell(30,4.5,'',1,0);
		$pdf->cell(30,4.5,'',1,0);
		$pdf->cell(30,4.5,'',1,1);
	}
}

$pemeriksaan_body = "<br><table>
						<tr>
							<td>
								<b>Pemeriksaan Body</b>
							</td>
						</tr>
					</table>";
					
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

$pdf->Image($file, $pdf->GetX(), $pdf->GetY(), 100);

 unlink($file);
$keterangan = "<br><br><br><br><br><br><br><br><table>
						<tr>
							<td>
								<b>Keterangan : </b>
							</td>
						</tr>
						<tr>
							<td>
								Merah : Body Penyok
							</td>
						</tr>
						<tr>
							<td>
								Abu-abu : Cat Tergores
							</td>
						</tr>
						<tr>
							<td>
								Biru : Lain-lain
							</td>
						</tr>
						
					</table><br><br><br>";
$pdf->WriteHTML($keterangan);

$pdf->cell(95,4.5,"Keluhan : ".$data_pemeriksaan_kendaraan['keluhan'],1,0);
$pdf->cell(95,4.5,"Catatan : ".$data_pemeriksaan_kendaraan['catatan'],1,1);

$pemeriksaan_kendaraan_bunyi = mysql_query("select * from pemeriksaan_kendaraan_bunyi where no_pemeriksaan = '$_GET[no_pemeriksaan]'");
$data_pemeriksaan_kendaraan_bunyi = mysql_fetch_array($pemeriksaan_kendaraan_bunyi);

$bunyi = "<br><table>
				<tr>
					<td width='300%'>
						1. Bagaimana bunyinya (bunyi) ? 
					</td>
					<td>
						".$data_pemeriksaan_kendaraan_bunyi['bunyi_bagaimana']."
					</td>
				</tr>
				<tr>
					<td width='300%'>
						2. Bunyi tersebut terdengar dari mana (bunyi) ? 
					</td>
					<td>
						".$data_pemeriksaan_kendaraan_bunyi['bunyi_darimana']."
					</td>
				</tr>
				<tr>
					<td width='300%'>
						3. Seberapa besar bunyinya (bunyi) ? 
					</td>
					<td>
						".$data_pemeriksaan_kendaraan_bunyi['bunyi_seberapakencang']."
					</td>
				</tr>
				<tr>
					<td width='300%'>
						4. Bagaimana karakter bunyinya (bunyi) ? 
					</td>
					<td>
						".$data_pemeriksaan_kendaraan_bunyi['bunyi_karakter']."
					</td>
				</tr>
				<tr>
					<td width='300%'>
						5. Seberapa sering problem tersebut muncul ? 
					</td>
					<td>
						".$data_pemeriksaan_kendaraan_bunyi['bunyi_sering']."
					</td>
				</tr>
				<tr>
					<td width='300%'>
						6. Sejak kapan timbul problem tersebut ?
					</td>
					<td>
						".$data_pemeriksaan_kendaraan_bunyi['kapan_timbul']."
					</td>
				</tr>
				<tr>
					<td width='300%'>
						7. Waktu kejadian pada kondisi : 
					</td>
					<td>
						".$data_pemeriksaan_kendaraan_bunyi['sejak_kapan_timbul']."
					</td>
				</tr>
				<tr>
					<td width='300%'>
						8. Kondisi pengendaraan saat timbul problem : 
					</td>
					<td>
						".$data_pemeriksaan_kendaraan_bunyi['kondisi_berkendara']."
					</td>
				</tr>
				<tr>
					<td width='300%'>
						9. Kondisi jalan yang menyebabkan timbulnya problem : 
					</td>
					<td>
						".$data_pemeriksaan_kendaraan_bunyi['kondisi_jalan']."
					</td>
				</tr>
				<tr>
					<td width='300%'>
						10. Waktu kejadian pada saat putaran mesin : 
					</td>
					<td>
						".$data_pemeriksaan_kendaraan['rpm']."
					</td>
				</tr>
				</table>";
$pdf->WriteHTML($bunyi);

$pic = "<br><br><table>
				<tr>
					<td>
						<b>PIC Appearance Check</b>
					</td>
					<td>
						<b>Pelanggan</b>
					</td>
				</tr><br><br><br>
				<tr>
					<td>
						<b>".$data_pemeriksaan_kendaraan['nama_pic']."</b>
					</td>
					<td>
						<b>".$data_pemeriksaan_kendaraan['nama_customer']."</b>
					</td>
				</tr>
				</table>";
$pdf->WriteHTML($pic);


$pdf->SetFont('Courier','',8);
//$pdf->text(143,190,"Dicetak tgl: ". date( 'd-m-Y, H:i:s'));
$pdf->Output();
//$pdf->Output('permohonan_unit_keluar('.$_GET['no_spk'].'-'.$data['tgl_unit_keluar'].').pdf', 'D');

}
?>