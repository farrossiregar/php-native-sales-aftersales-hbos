<?php
include "../../config/koneksi.php";
require('../pengajuan_diskon/fpdf/html_table.php');
	
	$kueri = mysql_query("select * FROM checklist_pameran where no_pameran='$_GET[id]'");
	if(mysql_num_rows($kueri)>=1){
		$double = 'Y';
		while($er = mysql_fetch_array($kueri)){
		$leasing_ulang=$er['leasing'];
		$cara_beli_ulang=$er['cara_beli'];
		$ket_discount_ulang=$er['ket_discount'];
		$tenor_ulang=$er['tenor'];
		$pengajuan_disc_ulang = "Rp ".number_format("$er[pengajuan_disc]",0,".",".");
		$total_discount_aks = "Rp ".number_format("$er[total_discount_accs]",0,".",".");
		$refund_ulang = "Rp ".number_format("$er[refund]",0,".",".");
		
	    $total_discount1 = $er[pengajuan_disc] +  $er[total_discount_accs] - $er[refund];
		
    	$total_discount_ulang = "Rp ".number_format("$total_discount1",0,".",".");
		}	
	}else{
		$double = 'N';
	}	
	
    $sql = mysql_query("select * FROM pengajuan_discount where no_pengajuan='$_GET[id]'");
	//$sql = mysql_query("select * FROM pengajuan_discount pd
	//left join pengajuan_discount_ulang pdu on pdu.no_pengajuan=pd.no_pengajuan
	//where pd.no_pengajuan='$_GET[id]'");
	
    $i = 1;
    $no = 1;
    $max = 31;
    $row = 6;
    
    while($r = mysql_fetch_array($sql)){
    $no_pengajuan=$r['no_pengajuan'];
	
    $no_spk=$r['no_spk'];
    $no_pengajuan=$r['no_pengajuan'];
    $nama_customer=$r['nama_customer'];
    $model=$r['model'];
    $kode_tipe = trim($r['tipe_mobil']);
    $tipe_mobil=$r['tipe_mobil'];
    //$harga_otr=$r[harga_otr];
    //$discount_unit=$r[discount_unit];
    //$pengajuan_disc=$r[pengajuan_disc];
    
    //$total_discount_accs=$r[total_discount_accs];
    //$refund=$r[refund];
    //$total_discount=$r[total_discount];
    //$disc_approved=$r[disc_approved];
    $tgl_approve = $r['tgl_approve'];
    $waktu=$r['waktu'];
    $status_approved=$r['status_approved'];
	$pemohon=$r['pemohon'];
    $user_approve=$r['user_approve'];
    
    $statusaprrov=$status_approved;
    if($statusaprrov=="Y") {
    $statusaprrov="Disetujui"; 
    }
    if($statusaprrov=="N") {
    $statusaprrov="Belum Disetujui"; 
    }
    
	
	if($double=='Y'){
		$leasing=$leasing_ulang;
		$cara_beli=$cara_beli_ulang;
		$ket_discount=$ket_discount_ulang;
		$tenor=$tenor_ulang;
		$pengajuan_disc = $pengajuan_disc_ulang;
		$total_discount_accs = $total_discount_aks;
		$refund = $refund_ulang;
		$total_discount = $total_discount_ulang;
	}else{
		$leasing=$r['leasing'];
		$cara_beli=$r['cara_beli'];
		$ket_discount=$r['ket_discount'];
		$tenor=$r['tenor'];
		$pengajuan_disc = "Rp ".number_format("$r[pengajuan_disc]",0,".",".");
		$total_discount_accs = "Rp ".number_format("$r[total_discount_accs]",0,".",".");
		$refund = "Rp ".number_format("$r[refund]",0,".",".");
	    $total_discount = "Rp ".number_format("$r[total_discount]",0,".",".");
	}
	
    $harga_otr = "Rp ".number_format("$r[harga_otr]",0,".",".");
	$discount_unit = "Rp ".number_format("$r[discount_unit]",0,".",".");
	$disc_approved = "Rp ".number_format("$r[disc_approved]",0,".",".");
	
    
        $len = strlen($ket_discount);
            if ($len > 61){
                $ket_discount1=substr($ket_discount,0,61);
                $ket_discount2=substr($ket_discount,61,61);
                $ket_discount3=substr($ket_discount,122,61);
                //$ket_discount=$ket_discount.substr($ket_discount, 100, 100);
                //$a1=$ket_discount.'<br/>'.$ket_discount1;
                
            }
            else
            {
                $ket_discount1=$ket_discount;
				$ket_discount2="-";
				$ket_discount3="-";
				
            }
    }

// MULAI JOIN NAMA, TIPE DAN WARNA MODEL
	$join = "select t.nama_tipe as nama_tipe, w.nama_warna as nama_warna, m.nama_model as nama_model ,pd.* from pengajuan_discount pd 
			left join tipe t on t.kode_tipe=pd.tipe_mobil
			left join model m on m.kode_model=pd.model
			left join warna w on w.kode_warna=pd.warna
			where pd.no_pengajuan='$_GET[id]'";
			
    $kuery = mysql_query($join);
    $rdata = mysql_fetch_array($kuery);
    
    $model = $rdata['nama_model'];
	$tipe_mobil = $rdata['nama_tipe'];
	$warna = $rdata['nama_warna'];
	// TUTUP JOIN NAMA, TIPE DAN WARNA MODEL

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$html="
<table border='0' cellspacing='10' cellpadding='10'>
  
  <tr>
    <td colspan='3' align='center'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='3' align='center'><b>HONDA BINTARO</b></td>
  </tr>
  <tr>
    <td colspan='3' align='center'><b>FORM PENGAJUAN DISKON ONLINE</b></td>
  </tr>
  <tr>
    <td colspan='3' align='center'><hr /></td>
  </tr>
  <tr>
    <td>No Pengajuan</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$no_pengajuan</td>
  </tr>
  <tr>
    <td align='left'>No SPK</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$no_spk</td>
  </tr>
  <tr>
    <td align='left'>Nama Customer</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$nama_customer</td>
  </tr>
  <tr>
    <td align='left'>Tipe Unit</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='200'>$kode_tipe - $tipe_mobil</td>
  </tr>
  <tr>
    <td align='left'>Warna</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$warna</td>
  </tr>
  <tr>
    <td align='left'>Harga OTR</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$harga_otr</td>
  </tr>
  <tr>
    <td align='left'>Diskon Unit</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$discount_unit</td>
  </tr>
  <tr>
    <td align='left'>Pengajuan Diskon</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$pengajuan_disc</td>
  </tr>
  <tr>
    <td align='left'>Keterangan Diskon</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$ket_discount1</td>
  </tr>
  <tr>
    <td align='left'>&nbsp;</td>
    <td align='center' width='1'>&nbsp;</td>
    <td align='left' width='500'>$ket_discount2</td>
  </tr>
  <tr>
    <td align='left'>&nbsp;</td>
    <td align='center' width='1'>&nbsp;</td>
    <td align='left' width='500'>$ket_discount3</td>
  </tr>
  <tr>
    <td align='left'>Total Diskon Aksesoris</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$total_discount_accs</td>
  </tr>
  <tr>
    <td align='left'>Refund</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$refund</td>
  </tr>
  <tr>
    <td align='left'>Total Diskon</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$total_discount</td>
  </tr>
  <tr>
    <td align='left'>Tgl Pengajuan</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$waktu</td>
  </tr>
  <tr>
    <td align='left'>Tanggal Approve</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$tgl_approve</td>
  </tr>
  <tr>
    <td align='left'>Status Disetujui</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$statusaprrov</td>
  </tr>
  <tr>
    <td align='left'>Metode Pembayaran</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$cara_beli</td>
  </tr>
  <tr>
    <td align='left'>Nama Leasing</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$leasing</td>
  </tr>
  <tr>
    <td align='left'>Tenor</td>
    <td align='center' width='1'>:</td>
    <td align='left' width='500'>$tenor</td>
  </tr>
  
  <tr>
    <td align='left'>&nbsp;</td>
    <td align='center' width='1'>&nbsp;</td>
    <td align='left' width='500'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left'><font color='red'>*Dokumen ini tidak memerlukan tanda tangan</font></td>
    <td align='center' width='1'>&nbsp;</td>
    <td align='left' width='200'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left'>&nbsp;</td>
    <td align='center' width='1'>&nbsp;</td>
    <td align='left' width='500'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left'>&nbsp;</td>
    <td align='center' width='1'>&nbsp;</td>
    <td align='left' width='500'>&nbsp;</td>
  </tr>
  <tr>
    <td align='left'>&nbsp;</td>
    <td align='center' width='1'>&nbsp;</td>
    <td align='left' width='500'>&nbsp;</td>
  </tr>
  <tr>
    <td align='center' width='50'></td>
    <td align='left'>Pemohon</td>
    <td align='center' width='300'>&nbsp;</td>
    <td align='right' width='100'>Disetujui</td>
  </tr>
  <tr>
    <td align='center' width='50'></td>
    <td align='left'>($pemohon)</td>
    <td align='center' width='300'>&nbsp;</td>
    <td align='right' width='200'>($user_approve)</td>
  </tr>
</table>
";




//$pdf->WriteHTML($ket_discount);
//$pdf->write(10,40,$ket_discount);
$pdf->WriteHTML($html);
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
$pdf->text(143,175,"Dicetak tgl: ". date( 'd-m-Y, H:i:s'));
$pdf->Output();
?>