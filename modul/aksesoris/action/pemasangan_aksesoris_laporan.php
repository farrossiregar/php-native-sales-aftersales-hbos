<?php

include "../../../config/koneksi.php"; 
require('../../../vendor/fpdf/html_table.php');

date_default_timezone_set('Asia/Jakarta');
	
	//include "koneksi.php"; 
	
	$no_permohonan = substr(addslashes($_GET['id']),0,28);
	$no_permohonan2 = substr(addslashes($_GET['id']),28,32);
	
	$query = mysql_query("SELECT * FROM pemasangan_aksesoris where substring(md5(md5(no_permohonan)),1,28) = '$no_permohonan' and md5(no_permohonan) = '$no_permohonan2'"); 
	$row = mysql_num_rows($query);
	if($row > 0){ 

			$data = mysql_fetch_array($query); 
			
			$no_spk = $data['no_spk'];			


$pdf=new PDF('P','mm','A4');
//$pdf=new PDF($cell);
$pdf->setautopagebreak(true,15);
$pdf->AddPage();
$pdf->SetFont('Arial','',7.5);
//$pdf->setStyle( "p", $cell->getDefaultFontName(), "", 10, "130,0,30" );
//$pdf->Output('permohonan_unit_keluar('.$_GET['no_spk'].'-'.$data['waktu_keluar'].').pdf', 'D');


$html="
			
		<table>
		    <tr>
				<td colspan='2' align='center'><b>HONDA BINTARO</b></td>
		    </tr>
		    <tr>
				<td colspan='2' align='center'><b>FORM ACCESORIS UNIT KELUAR</b></td>
		    </tr>
		    <tr>
				<td colspan='2' align='center'><hr /></td>
		    </tr>
		</table>
		

		<table>
			<tr>
				<td width='250%'>
					<div ><h5>NO FORM</h5></div>
				</td>
				<td width='250%'>
					<div class='underline'><h5> : ".$data['no_permohonan']."</h5></div>
				</td>
				
			</tr>
			<tr>
				<td width='250%'>
					<div ><h5>TYPE MOBIL</h5></div>
				</td>
				<td width='250%'>
					<div class='underline'><h5> : ".$data['tipe_model']."</h5></div>
				</td>
				
			</tr>
			<tr>
				<td width='250%'>
					<div><h5>NO.RANGKA</h5></div>
				</td>
				<td width='250%'>
					<div class='underline'><h5> : ".$data['no_rangka']."</h5></div>
				</td>
			</tr>
			<tr>
				<td width='250%'>
					<div><h5>NO.MESIN</h5></div>
				</td>
				<td width='250%'>
					<div class='underline'><h5> : ".$data['no_mesin']."</h5></div>
				</td>
			</tr>
			<tr>
				<td width='250%'>
					<div><h5>WARNA / TAHUN</h5></div>
				</td>
				<td width='250%'>
					<div class='underline'><h5> : ".$data['warna']."</h5></div>
				</td>
			</tr>
			<tr>
				<td width='250%'>
					<div><h5>NAMA CUSTOMER</h5></div>
				</td>
				<td width='250%'>
					<div class='underline'><h5> : ".$data['nama_customer']."</h5></div>
				</td>
			</tr>
			<tr>
				<td width='250%'>
					<div><h5>NO. SPK</h5></div>
				</td>
				<td width='250%'>
					<div class='underline'><h5> : ".$no_spk."</h5></div>
				</td>
			</tr>
			<tr>
				<td width='250%'>
					<div><h5>NAMA SALES </h5></div>
				</td>
				<td width='250%'>
					<div class='underline'><h5> : ".$data['nama_sales']."</h5></div>
				</td>
			</tr>
			<tr>
				<td width='250%'>
					<div><h5>TANGGAL UNIT KELUAR </h5></div>
				</td>
				<td width='250%'>
					<div class='underline'><h5> : ".date('d-m-Y',strtotime($data['tgl_unit_keluar']))."</h5></div>
				</td>
				
			</tr>
		</table>";	
		

//$pdf->WriteHTML($ket_discount);
//$pdf->write(10,40,$ket_discount);
$pdf->WriteHTML($html);

$html1 = "<table>
			<tr>
				<td width='500%'>
					<br>
					<h4><b>PEMASANGAN ACCESSORIES : </b></h4>
					<br>
					<h4><u><b>ACCESSORIES PROGRAM MD </b></u></h4>
				</td>
			</tr>
		</table>";
		
	
$pdf->WriteHTML($html1);
$query2 = mysql_query("select * from pemasangan_aksesoris_md where no_permohonan='$data[no_permohonan]'");
$n = 0;
$num2 = mysql_num_rows($query2);
while($sql2 = mysql_fetch_array($query2)){

	$n = $n+1;

	//$pdf->setXY(30,40);
	//$pdf->cell(4,5,'',0,0);
	$pdf->cell(80,5.5,$n. ". ".$sql2['nama_aksesoris'],0,0);
	$pdf->cell(-30,5.5,$sql2['nomor_transaksi'],0,0);
	$pdf->cell(50,5.5,'',0,0);
	$pdf->cell(15,5.5,'Suppl : '.$sql2['supplier'],0,0);
	$pdf->cell(50,5.5,'',0,1);

	if ($sql2['keterangan'] != '')
	{
		$pdf->cell(60,5.5, " Ket : ".$sql2['keterangan'],0,0);
		$pdf->cell(50,5.5,'',0,1);
	}
}
/*
$index2 = 4;
$res2 = $index2 - $num2;
$i;
for($i=1; $i<=$res2; $i++){
	$pdf->cell(4,5,'',0,0);
	$pdf->cell(60,5.5,'',0,0);
	$pdf->cell(14,5.5,'Tgl Order : ',0,0);
	$pdf->cell(50,5.5,'',0,0);
	$pdf->cell(13,5.5,'Supplier : ',0,0);
	$pdf->cell(50,5.5,'',0,1);
}

*/

$html2 = "
		<table style='position:fixed; top:100px;'>
			<tr>
				<td width='500%'>
					<br>
					<h4><u><b>ACCESSORIES BONUS : </b></u></h4>
				</td>
			</tr>
		</table>";
			
$pdf->WriteHTML($html2);
$query3 = mysql_query("select * from pemasangan_aksesoris_bonus where no_permohonan='$data[no_permohonan]'");
$n = 0;
$num3 = mysql_num_rows($query3);
while($sql3 = mysql_fetch_array($query3)){

$n = $n+1;
//$pdf->setXY(30,40);
//$pdf->cell(4,5,'',0,0);
$pdf->cell(80,5.5,$n. ". ".$sql3['nama_aksesoris'],0,0);
$pdf->cell(-30,5.5,$sql3['nomor_transaksi'],0,0);
$pdf->cell(50,5.5,'',0,0);
$pdf->cell(15,5.5,'Suppl : '.$sql3['supplier'],0,0);
$pdf->cell(50,5.5,'',0,1);

	if ($sql3['keterangan'] != '')
	{
		$pdf->cell(60,5.5, " Ket : ".$sql3['keterangan'],0,0);
		$pdf->cell(50,5.5,'',0,1);
	}
}
/*
$index3 = 8;
$res3 = $index3- $num3;
$i;
	for($i=1; $i<=$res3; $i++){
		$pdf->cell(4,5,'',0,0);
		$pdf->cell(60,5,'',0,0);
		$pdf->cell(14,5,'Tgl Order : ',0,0);
		$pdf->cell(50,5,'',0,0);
		$pdf->cell(13,5,'Supplier : ',0,0);
		$pdf->cell(50,5,'',0,1);
	}
*/
$pdf->cell(65,5,' Gesekan Rangka Mesin : ',0,0);

$html4 = "<br>
			<table>
			<tr>
				<td width='500%'>
					<br>
					<h4><u><b>ACCESSORIES TAMBAHAN : </b></u></h4>
				</td>
			</tr>
		</table>";
	
$query4 = mysql_query("select * from pemasangan_aksesoris_tambahan where no_permohonan='$data[no_permohonan]'");
$n = 0;
$num4 = mysql_num_rows($query4);
if ($num4 >0){
	$pdf->WriteHTML($html4);
	
}

while($sql4 = mysql_fetch_array($query4)){
	
	
$n = $n+1;
//$pdf->setXY(30,40);
//$pdf->cell(4,5,'',0,0);
$pdf->cell(80,5,$n. ". ".$sql4['nama_aksesoris'],0,0);
//$pdf->cell(14,5,'Tgl Order : ',0,0);
$pdf->cell(20,5.5,$sql4['nomor_transaksi'],0,0);
$pdf->cell(1,5,'',0,0);
$pdf->cell(13,5,'Hrg Jual : '.number_format($sql4['harga_jual'],0,".","."),0,0);
$pdf->cell(15,5,'',0,0);
$pdf->cell(13,5,'Supplier : '.$sql4['supplier'],0,0);
$pdf->cell(36,5,'',0,1);

	if ($sql4['keterangan'] != '')
	{
		$pdf->cell(60,5.5, " Ket : ".$sql4['keterangan'],0,0);
		$pdf->cell(50,5.5,'',0,1);
	}
}		
/*
$index4 = 7;
$res4 = $index4 - $num4;
$i;
for($i=1; $i<=$res4; $i++){
	$pdf->cell(4,5,'',0,0);
	$pdf->cell(40,5,'',0,0);
	$pdf->cell(14,5,'Tgl Order : ',0,0);
	$pdf->cell(30,5,'',0,0);
	$pdf->cell(13,5,'Supplier : ',0,0);
	$pdf->cell(30,5,'',0,0);
	$pdf->cell(13,5,'Hrg Jual : ',0,0);
	$pdf->cell(36,5,'',0,1);
}
*/			
$html5="<br>
		
		<div style='background-color:blue;'>
			<table>
				
				<tr>
					<td>
						<p>Bintaro, ".date('d-m-Y',strtotime($data['tgl_unit_keluar']))."<br>
							Yang Menyerahkan<br></p>	
					</td>
				</tr>
				
				<tr>
					<td style='width:10px;'>
						(".$data['nama_sales'].")
					</td>
					<td style='width:10px;'>
						(".$data['spv_user_app'].")
					</td>
					<td style='width:10px;'>
						(".$data['mngr_user_app'].")
					</td>
					<td style='width:10px;'>
						(".$data['salesadm_user_app'].")
					</td>
					
				</tr>
				<tr>
					<td style='width:10px;'>
						Sales
					</td>
					<td style='width:10px;'>
						Sales Supervisor
					</td>
					<td style='width:10px;'>
						Sales Manager
					</td>
					<td style='width:10px;'>
						Sales Admin
					</td>
					
				</tr>
			</table>
		</div>
		";

$pdf->WriteHTML($html5);

$pdf->text(75,30.6,'....................................................................................................................................................');
$pdf->text(75,37,'....................................................................................................................................................');
$pdf->text(75,43,'....................................................................................................................................................');
$pdf->text(75,48.5,'....................................................................................................................................................');
$pdf->text(75,55.2,'....................................................................................................................................................');
$pdf->text(75,60.8,'....................................................................................................................................................');
$pdf->text(75,66.5,'....................................................................................................................................................');
$pdf->text(75,73,'....................................................................................................................................................');
$pdf->text(75,79,'....................................................................................................................................................');


/*

$pdf->text(11,100.4,' .....................................................................');
$pdf->text(87,100.4,'..........................................................');
$pdf->text(150,100.4,'..........................................................');

$pdf->text(11,106.4,' .....................................................................');
$pdf->text(87,106.4,'..........................................................');
$pdf->text(150,106.4,'..........................................................');

$pdf->text(11,112.4,' .....................................................................');
$pdf->text(87,112.4,'..........................................................');
$pdf->text(150,112.4,'..........................................................');

$pdf->text(11,117.4,' .....................................................................');
$pdf->text(87,117.4,'..........................................................');
$pdf->text(150,117.4,'..........................................................');




$pdf->text(11,132.9,' .....................................................................');
$pdf->text(87,132.9,'..........................................................');
$pdf->text(150,132.9,'..........................................................');

$pdf->text(11,137.9,' .....................................................................');
$pdf->text(87,137.9,'..........................................................');
$pdf->text(150,137.9,'..........................................................');

$pdf->text(11,142.7,' .....................................................................');
$pdf->text(87,142.7,'..........................................................');
$pdf->text(150,142.7,'..........................................................');

$pdf->text(11,148.1,' .....................................................................');
$pdf->text(87,148.1,'..........................................................');
$pdf->text(150,148.1,'..........................................................');

$pdf->text(11,152.8,' .....................................................................');
$pdf->text(87,152.8,'..........................................................');
$pdf->text(150,152.8,'..........................................................');

$pdf->text(11,157.9,' .....................................................................');
$pdf->text(87,157.9,'..........................................................');
$pdf->text(150,157.9,'..........................................................');

$pdf->text(11,162.7,' .....................................................................');
$pdf->text(87,162.7,'..........................................................');
$pdf->text(150,162.7,'..........................................................');

$pdf->text(11,168,' .....................................................................');
$pdf->text(87,168,'..........................................................');
$pdf->text(150,168,'..........................................................');



$pdf->text(11,188.8,'1. ................................................');
$pdf->text(68,188.8,'...................................');
$pdf->text(111,188.8,'.....................................');
$pdf->text(153.5,188.8,'.......................................................');

$pdf->text(11,194,'2. ................................................');
$pdf->text(68,194,'...................................');
$pdf->text(111,194,'.....................................');
$pdf->text(153.5,194,'.......................................................');

$pdf->text(11,199,'3. ................................................');
$pdf->text(68,199,'...................................');
$pdf->text(111,199,'.....................................');
$pdf->text(153.5,199,'.......................................................');

$pdf->text(11,203.8,'4. ................................................');
$pdf->text(68,203.8,'...................................');
$pdf->text(111,203.8,'.....................................');
$pdf->text(153.5,203.8,'.......................................................');

$pdf->text(11,209,'5. ................................................');
$pdf->text(68,209,'...................................');
$pdf->text(111,209,'.....................................');
$pdf->text(153.5,209,'.......................................................');

$pdf->text(11,213.7,'6. ................................................');
$pdf->text(68,213.7,'...................................');
$pdf->text(111,213.7,'.....................................');
$pdf->text(153.5,213.7,'.......................................................');

$pdf->text(11,219.2,'7. ................................................');
$pdf->text(68,219.2,'...................................');
$pdf->text(111,219.2,'.....................................');
$pdf->text(153.5,219.2,'.......................................................');




$pdf->text(22,239.5,'.......................................................');



*/

/*
$pdf->addText(50,$p,7,"{$x['PolicyNumber']}");
$pdf->addText(80,$p,7,"{$x['StoreId']}");
*/


$pdf->SetFont('Courier','',8);
//$pdf->text(143,190,"Dicetak tgl: ". date( 'd-m-Y, H:i:s'));
$pdf->text(143,265,"Dicetak tgl: ". date( 'd-m-Y, H:i:s'));
$pdf->Output();
//$pdf->Output('permohonan_unit_keluar('.$_GET['no_spk'].'-'.$data['tgl_unit_keluar'].').pdf', 'D');

}
?>