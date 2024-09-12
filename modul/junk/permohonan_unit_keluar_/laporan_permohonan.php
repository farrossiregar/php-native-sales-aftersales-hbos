<?php
//include "../../config/koneksi.php";
include "../../config/koneksi_sqlserver.php";

include "../../config/koneksi.php"; 
require('fpdf/html_table.php');

date_default_timezone_set('Asia/Jakarta');
	
	//include "koneksi.php"; 
	$query_puk = mysql_query("SELECT * FROM unit_keluar where md5(md5(no_spk)) = '$_GET[id]'"); 
	
	
	$row = mysql_num_rows($query_puk);
	if($row > 0){ 
			
			
			$data = mysql_fetch_array($query_puk); 
			
			$len = strlen($data['keterangan']);
			
			$ket1 = substr($data['keterangan'],0,100);
			$ket2 = substr($data['keterangan'],100,100);
			$ket3 = substr($data['keterangan'],200,100);
			$ket4 = substr($data['keterangan'],300,100);
			
			$no_spk = $data['no_spk'];
			
			$query = "select SPK.* from vw_PukSOS SPK
						 where NomorSPK = '$no_spk'";
						 
			$query = sqlsrv_query($conn, $query);
			while($data_detail = sqlsrv_fetch_array($query)){
				//PEMBAYARAN PEMBAYARAN ============================================================================
				$carabeli = $data_detail['JenisPenjualan'];
				$no_penjualan = $data_detail['NomorFakturJual'];
				$no_kontrak = $data_detail['NomorKontrak'];
				$norangka = $data_detail['NoRangka'];
				$nomesin = $data_detail['NoMesin'];
				$discount = $data_detail['Diskon'];
				$tipe = $data_detail['NamaTipe'];
				$warna = $data_detail['NamaWarna'];
				$nama_customer = $data_detail['NamaCustomer'];
				$carabeli = $data_detail['JenisPenjualan'];
				$leasing = $data_detail['NamaLeasing'];
				$nama_sales = $data_detail['NamaSalesman'];
				
				
				/// DOKUMEN PURNA JUAL
				
				$hitung_record = "select count(NomorPesanan) as totrec from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$no_spk' and JenisKwitansi = 'P.Dokumen PJ'";
				$hitung_record = sqlsrv_query($conn, $hitung_record);
				while ($data_hitung_record = sqlsrv_fetch_array($hitung_record)){
					$tot_rec = $data_hitung_record['totrec'];
				}
				
				$query_dokumenpj = "select * from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$no_spk' and JenisKwitansi = 'P.Dokumen PJ'";
				$query_dokumenpj = sqlsrv_query($conn, $query_dokumenpj);
				
				$dokumenpj = "";
				$totalpj = 0;
				$no = 1;
				while ($data_dokumenpj = sqlsrv_fetch_array($query_dokumenpj)){
					if (substr($no/4,2,2) == 25 ){
						$dokumenpj = $dokumenpj."<tr>
						<td>
								<div><h5>DOKUMEN P.J</h5></div>
							</td>";
						
						
					}
					$dokumenpj = $dokumenpj."
							<td style='width:25%; border:0px;'>
								<div><h5>PJ$no : ".number_format($data_dokumenpj['NilaiPenerimaan'],0,".",".")."</h5></div>
							</td>
						";
					if ($no > 2 and substr($no/4,2,2) == ""){
						$dokumenpj = $dokumenpj."</tr>";
					}
					
					if ($no == $tot_rec and substr($tot_rec/4,2,2) != ""){
						$dokumenpj = $dokumenpj."</tr>";
					}
					$no++;
					$totalpj = $totalpj + $data_dokumenpj['NilaiPenerimaan'];
					
				}
				
				//// AKSESORIS PURNA JUAL ========================================
				$hitung_record = "select count(NomorPesanan) as totrec from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$no_spk' and JenisKwitansi = 'Accessories PJ'";
				$hitung_record = sqlsrv_query($conn, $hitung_record);
				while ($data_hitung_record = sqlsrv_fetch_array($hitung_record)){
					$tot_rec = $data_hitung_record['totrec'];
				}
				
				
				$query_accessories = "select * from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$no_spk' and JenisKwitansi = 'Accessories PJ'";
				$query_accessories = sqlsrv_query($conn, $query_accessories);
				
				$pembayaran_accs = "";
				$tot_accs = 0;
				$no = 1;
				while ($data_accessories = sqlsrv_fetch_array($query_accessories)){
					if (substr($no/4,2,2) == 25 ){
						$pembayaran_accs = $pembayaran_accs."<tr>
						<td>
								<div><h5>AKSESORIS</h5></div>
							</td>";
						
						
					}
					$pembayaran_accs = $pembayaran_accs."
							<td style='width:25%; border:0px;'>
								<div><h5>ACS$no : ".number_format($data_accessories['NilaiPenerimaan'],0,".",".")."</h5></div>
							</td>
						";
					if ($no > 2 and substr($no/4,2,2) == ""){
						$pembayaran_accs = $pembayaran_accs."</tr>";
					}else
					if ($no == $tot_rec and substr($tot_rec/4,2,2) != ""){
						$pembayaran_accs = $pembayaran_accs."</tr>";
					}
					
					$no++;
					$tot_accs = $tot_accs + $data_accessories['NilaiPenerimaan'];
				}
				
				
				//// ASURANSI PURNA JUAL ========================================
				$hitung_record = "select count(NomorPesanan) as totrec from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$no_spk' and JenisKwitansi = 'Asuransi PJ'";
				$hitung_record = sqlsrv_query($conn, $hitung_record);
				while ($data_hitung_record = sqlsrv_fetch_array($hitung_record)){
					$tot_rec = $data_hitung_record['totrec'];
				}
				
				
				$query_asuransi = "select * from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$no_spk' and JenisKwitansi = 'Asuransi PJ'";
				$query_asuransi = sqlsrv_query($conn, $query_asuransi);
				
				$pembayaran_asu = "";
				$tot_asu = 0;
				$no = 1;
				while ($data_asuransi = sqlsrv_fetch_array($query_asuransi)){
					if (substr($no/4,2,2) == 25 ){
						$pembayaran_asu = $pembayaran_asu."<tr>
						<td>
								<div><h5>ASURANSI</h5></div>
							</td>";
						
						
					}
					$pembayaran_asu = $pembayaran_asu."
							<td style='width:25%; border:0px;'>
								<div><h5>ASU$no : ".number_format($data_asuransi['NilaiPenerimaan'],0,".",".")."</h5></div>
							</td>
						";
					if ($no > 2 and substr($no/4,2,2) == ""){
						$pembayaran_asu = $pembayaran_asu."</tr>";
					}else
					if ($no == $tot_rec and substr($tot_rec/4,2,2) != ""){
						$pembayaran_asu = $pembayaran_asu."</tr>";
					}
					
					$no++;
					$tot_asu = $tot_asu + $data_asuransi['NilaiPenerimaan'];
				}
				
				// UANG MUKA =========================================================
				
				$hitung_record = "select count(NomorPesanan) as totrec from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$no_spk' and JenisKwitansi = 'Uang Muka'";
				$hitung_record = sqlsrv_query($conn, $hitung_record);
				while ($data_hitung_record = sqlsrv_fetch_array($hitung_record)){
					$tot_rec = $data_hitung_record['totrec'];
				}
				
				$query_uangmuka = "select * from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$no_spk' and JenisKwitansi = 'Uang Muka'";
				$query_uangmuka = sqlsrv_query($conn, $query_uangmuka);
				
				$uangmuka = "";
				$tot_uangmuka = 0;
				$no = 1;
				while ($data_uangmuka = sqlsrv_fetch_array($query_uangmuka)){
					
					if (substr($no/4,2,2) == 25 ){
						$uangmuka = $uangmuka."<tr>
						<td>
								<div><h5>UANG MUKA</h5></div>
							</td>";
						
						
					}
					$uangmuka = $uangmuka."
							<td style='width:25%; border:0px;'>
								<div><h5>DP$no : ".number_format($data_uangmuka['NilaiPenerimaan'],0,".",".")."</h5></div>
							</td>
						";
					if ($no > 2 and substr($no/4,2,2) == ""){
						$uangmuka = $uangmuka."</tr>";
					}else
					if ($no == $tot_rec and substr($tot_rec/4,2,2) != ""){
						$uangmuka = $uangmuka."</tr>";
					}
					
					$no++;
					$tot_uangmuka = $tot_uangmuka + $data_uangmuka['NilaiPenerimaan'];
				}
				
				// PEMBAYARAN PELUNASAN  ============================================
				
				$hitung_record = "select count(NomorPesanan) as totrec from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$no_spk' and JenisKwitansi = 'Pelunasan'";
				$hitung_record = sqlsrv_query($conn, $hitung_record);
				while ($data_hitung_record = sqlsrv_fetch_array($hitung_record)){
					$tot_rec = $data_hitung_record['totrec'];
				}
				
				
				
				$query_pembayaran = "select * from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$no_spk' and JenisKwitansi = 'Pelunasan'";
				$query_pembayaran = sqlsrv_query($conn, $query_pembayaran);
				
				$pembayaran = "";
				$tot_pelunasan = 0;
				$no = 1;
				while ($data_pembayaran = sqlsrv_fetch_array($query_pembayaran)){
					if (substr($no/4,2,2) == 25 ){
						$pembayaran = $pembayaran."<tr>
						<td>
								<div><h5>PELUNASAN</h5></div>
							</td>";
						
						
					}
					$pembayaran = $pembayaran."
							<td style='width:25%; border:0px;'>
								<div><h5>PL$no : ".number_format($data_pembayaran['NilaiPenerimaan'],0,".",".")."</h5></div>
							</td>
						";
					if ($no > 2 and substr($no/4,2,2) == ""){
						$pembayaran = $pembayaran."</tr>";
					}else
					if ($no == $tot_rec and substr($tot_rec/4,2,2) != ""){
						$pembayaran = $pembayaran."</tr>";
					}
					
					$no++;
					$tot_pelunasan = $tot_pelunasan + $data_pembayaran['NilaiPenerimaan'];
				}
				
				
				
				
				
			}
			
			/// AR DOKUMEN PURNA JUAL
			
			$arpj = "select sum(hjtotal) as arpurnajual from UntT_NomorPolisiKhususPurnaJual where nomor_pesanan = '$no_spk'";
			$arpj = sqlsrv_query($conn, $arpj);
			while ($data_arpj = sqlsrv_fetch_array($arpj)){
				
				$arpurnajual = $data_arpj['arpurnajual'];
				if($arpurnajual != 0){
					$purnajual = "<tr>
					<td >
						<div><h5>TOTAL DOKUMEN PJ </h5></div>
					</td>
					<td >
						<div class='underline'><h5> : ".number_format($arpurnajual,0,".",".")."</h5></div>
					</td>
					<td >
						<div><h5>BAYAR : ".number_format($totalpj ,0,".",".")." </h5></div>
					</td>
					<td >
						<div class='underline'><h5>KURANG : ".number_format($arpurnajual - $totalpj ,0,".",".")."</h5></div>
					</td>
				</tr>";
				}else{
					$purnajual = "";
				}
			}
			
			/// AR ASURANSI PURNA JUAL
			
			$arpj = "select sum(hargajualakhir) as arasuransi from UntT_AsuransiPurnaJual where norangka = '$norangka'";
			$arpj = sqlsrv_query($conn, $arpj);
			while ($data_arpj = sqlsrv_fetch_array($arpj)){
				
				$arasuransi = $data_arpj['arasuransi'];
				if($arasuransi != 0){
					$asuransi = "<tr>
					<td >
						<div><h5>TOTAL ASURANSI PJ </h5></div>
					</td>
					<td >
						<div class='underline'><h5> : ".number_format($arasuransi,0,".",".")."</h5></div>
					</td>
					<td >
						<div><h5>BAYAR : ".number_format($tot_asu ,0,".",".")." </h5></div>
					</td>
					<td >
						<div class='underline'><h5>KURANG : ".number_format($arasuransi - $tot_asu ,0,".",".")."</h5></div>
					</td>
				</tr>";
				}else{
					$asuransi = "";
				}
			}
			
			/// AR AKSESORIS PURNA JUAL
			
			$arpj = "select sum(hargajualakhir) as araksesoris from UntT_AccessoriesPurnaJual where norangka = '$norangka'";
			$arpj = sqlsrv_query($conn, $arpj);
			while ($data_arpj = sqlsrv_fetch_array($arpj)){
				
				$araksesoris = $data_arpj['araksesoris'];
				if($araksesoris != 0){
					$aksesoris = "<tr>
					<td >
						<div><h5>TOTAL AKSESORIS PJ </h5></div>
					</td>
					<td >
						<div class='underline'><h5> : ".number_format($araksesoris,0,".",".")."</h5></div>
					</td>
					<td >
						<div><h5>BAYAR : ".number_format($tot_accs ,0,".",".")." </h5></div>
					</td>
					<td >
						<div class='underline'><h5>KURANG : ".number_format($araksesoris - $tot_accs ,0,".",".")."</h5></div>
					</td>
				</tr>";
				}else{
					$aksesoris = "";
				}
			}
			
			/// AR UNIR ===========================
			
			$spk = " SELECT PK.hargaperunit,pk.DiscUnit,ak.NilaiTDP FROM UntT_PesananKendaraan PK left join UntT_AplikasiKredit AK on PK.nomor = AK.nomor_pesanan where PK.nomor = '$no_spk'";
			$spk = sqlsrv_query($conn, $spk);
			
			
			while ($data_spk = sqlsrv_fetch_array($spk)){
				$disc = $data_spk['DiscUnit'];
				
				if ($carabeli == "Tunai"){
					$ar_unit = $data_spk['hargaperunit'];
					
				}
				if ($carabeli == "Kredit"){
					$ar_unit = $data_spk['NilaiTDP'];
				}
			}
			
			
			
			
			if ($carabeli == "Tunai"){
				$total_ar = "<tr>
				<td >
					<div><h5>HARGA OTR - DISC </h5></div>
				</td>
				<td >
					<div class='underline'><h5> : ".number_format($ar_unit - $disc,0,".",".")."</h5></div>
				</td>
				<td >
					<div><h5>BAYAR : ".number_format($tot_uangmuka + $tot_pelunasan ,0,".",".")."</h5></div>
				</td>
				<td >
					<div class='underline'><h5>KURANG : ".number_format($ar_unit - ($tot_uangmuka + $tot_pelunasan) - $disc ,0,".",".")."</h5></div>
				</td>
			</tr>";
				
			}else if ($carabeli == "Kredit"){
				$total_ar = "<tr>
				<td >
					<div><h5>TOTAL TDP </h5></div>
				</td>
				<td >
					<div class='underline'><h5> : ".number_format($ar_unit - $disc,0,".",".")."</h5></div>
				</td>
				<td >
					<div><h5>BAYAR : ".number_format($tot_uangmuka + $tot_pelunasan ,0,".",".")."</h5></div>
				</td>
				<td >
					<div class='underline'><h5>KURANG : ".number_format($ar_unit - ($tot_uangmuka + $tot_pelunasan) - $disc  ,0,".",".")."</h5></div>
				</td>
			</tr>";
				
			}
			
			///================================================================================================
			
			
		//	$query1 = mysql_query("select * from pengajuan_discount where no_spk = '$no_spk'");
			$query1 = mysql_query("SELECT pd.tipe_mobil as tipe_mobil, t.nama_tipe as nama_tipe, pd.*, t.* FROM pengajuan_discount pd, tipe t where no_spk='$no_spk' and t.kode_tipe = pd.tipe_mobil");
			$sql1 = mysql_fetch_array($query1);
			$dsc = "Rp ".number_format("$discount",0,".",".");
			
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
							<td style='width:10%; border:0px;'>
								<div><h5>DP</h5></div>
							</td>
							<td style='width:10%; border:0px;'>
								<div><h5> : ".$dp2."</h5></div>
							</td>
						</tr>";
			$total = $dp1 + $dp2;
			$ttl = "Rp ".number_format("$total",0,".",".");
			
			


$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',7);
//$pdf->Output('permohonan_unit_keluar('.$_GET['no_spk'].'-'.$data['waktu_keluar'].').pdf', 'D');


$html="
			
		<table border='0' >
			<tr>
				<td colspan='3' align='center'>&nbsp;</td>
		    </tr>
		    <tr>
				
				<td colspan='3' align='center'><b></b></td>
		    </tr>
		    <tr>
				
				<td  align='center'><b></b></td>
		    </tr>
		    <tr>
				<td colspan='3' align='center'><hr /></td>
		    </tr>	
			<tr>
				<td>
					<div><h5>No SPK / No Penjualan</h5></div>
				</td>
				<td>
					<div class='underline'><h5> : ".$data['no_spk']." / ".$no_penjualan."</h5></div>
				</td>
				<td>
					<div class='underline'><h5>  <font color='#ffffff'>.</font></h5></div>
				</td>
				
				<td>
					<div class='underline'><h5> SALES : ".$nama_sales."</h5></div>
				</td>
			</tr>
			<tr>
				<td>
					<div><h5>TYPE</h5></div>
				</td>
				<td>
					<div class='underline'><h5> : ".$tipe."</h5></div>
				</td>
				<td>
					<div class='underline'><h5> <font color='#ffffff'>.</font></h5></div>
				</td>
				<td>
					<div class='underline'><h5> WARNA : ".$warna."</h5></div>
				</td>
			</tr>
			<tr>
				<td>
					<div><h5>NO. RANGKA</h5></div>
				</td>
				<td>
					<div class='underline'><h5> : ".$norangka."</h5></div>
				</td>
			</tr>
			<tr>
				<td>
					<div><h5>NO. MESIN</h5></div>
				</td>
				<td>
					<div class='underline'><h5> : ".$nomesin."</h5></div>
				</td>
			</tr>
			<tr>
				<td>
					<div><h5>SPK A/N </h5></div>
				</td>
				<td>
					<div class='underline'><h5> : ".$nama_customer."</h5></div>
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
					<div class='underline'><h5> : ".$carabeli .$leasing.($carabeli == 'Kredit' ? " (No Kontrak : $no_kontrak) " : '')."</h5></div>
				</td>
			</tr>
			
			<tr>
				<td>
					<div><h5>DISCOUNT </h5></div>
				</td>
				<td>
					<div class='underline'><h5> : ".number_format($discount,0,".",".")."</h5></div>
				</td>
			</tr>
			<tr>
				<td>
					<div><h5>KETERANGAN </h5></div>
				</td>
				<td>
					<div class='underline'><h5> : ".$ket1."</h5></div>
				</td>
			</tr>
			<tr>
				<td>
					<div class='underline'><h5>  <font color='#ffffff'>.</font></h5></div>
				</td>
				<td>
					<div class='underline'><h5>  ".$ket2."</h5></div>
				</td>
			</tr>
			<tr>
				<td>
					<div class='underline'><h5>  <font color='#ffffff'>.</font></h5></div>
				</td>
				<td>
					<div class='underline'><h5>  ".$ket3."</h5></div>
				</td>
			</tr>
			<tr>
				<td>
					<div class='underline'><h5>  <font color='#ffffff'>.</font></h5></div>
				</td>
				<td>
					<div class='underline'><h5>  ".$ket4."</h5></div>
				</td>
			</tr>
			
			<tr>
				<td style='width:10px;'>
					
				</td>
				
			</tr>
			
			".$total_ar.$aksesoris.$purnajual.$asuransi.
			
			"
			<tr>
				<td style='width:10px;'>
					
				</td>
				
			</tr>".
			$uangmuka.$pembayaran.$pembayaran_accs.$dokumenpj.$pembayaran_asu.
			
			
			"
			
			<tr>
				<td style='width:10px;'>
					<br>FORM PENDUKUNG
				</td>
				<td style='width:10px;'>
					- PO LEASING & KONTRAK ASLI YG TELAH DI TTD CUSTOMER
				</td>
				
			</tr>
			<tr>
				<td style='width:10px;'>
					DARI SALES
				</td>
				<td style='width:10px;'>
					- PRINT PERMOHONAN UNIT KELUAR
				</td>
				
			</tr>
			<tr>
				<td style='width:10px;'>
					<br>FORM PENDUKUNG
				</td>
				<td style='width:10px;'>
					- FORM MATCHING , - FORM AKSESORIS OPTIONAL
				</td>
				
			</tr>
			<tr>
				<td style='width:10px;'>
					SALES ADM
				</td>
				<td style='width:10px;'>
					- FORM AKSESORIS + ASURANSI PURNA JUAL / TTP
				</td>
				
			</tr>
			<tr>
				<td style='width:10px;'>
					<br>FORM PENDUKUNG
				</td>
				<td style='width:10px;'>
					- FORM PENJUALAN + DATA PER SPK
				</td>
				
			</tr>
			<tr>
				<td style='width:10px;'>
					DARI FINANCE
				</td>
				<td style='width:10px;'>
					- TANDA TERIMA TAGIHAN LEASING + BUKTI EMAIL COVER ASURANSI
				</td>
				
			</tr>
			
			<tr>
				<td colspan='5'><br><br>TANGERANG, ".substr($data['input'], 0, 11)."</td>
			</tr>
			<tr>
				<td style='width:10px;'>
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
				<td style='width:10px;'>
					
				</td>
				<td style='width:10px;'>
					
				</td>
				<td style='width:10px;'>
					
				</td>
				<td style='width:10px;'>
					
				</td>
				<td style='width:10px;'>
					
				</td>
			</tr>
			<tr>
				<td style='width:10px;'>
					
				</td>
				<td style='width:10px;'>
					
				</td>
				<td style='width:10px;'>
					
				</td>
				<td style='width:10px;'>
					
				</td>
				<td style='width:10px;'>
					
				</td>
			</tr>
			<tr>
				<td style='width:10px;'>
					(".$nama_sales.")
				</td>
				<td style='width:10px;'>
					(..........................)
				</td>
				<td style='width:10px;'>
					(..........................)
				</td>
				<td style='width:10px;'>
					(..........................)
				</td>
				<td style='width:10px;'>
					(..........................)
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
					A/R Finance
				</td>
				<td style='width:10px;'>
					SPV Finance
				</td>
				<td style='width:10px;'>
					Manager Finance
				</td>
			</tr>
			<tr>
				<td colspan='5'>
					
					
				</td>
				<td>
					NOTE : PUK + FORM PENDUKUNG DISERAHKAN 3 (TIGA) HARI SEBELUM TANGGAL KELUAR KE BAGIAN FINANCE
				</td>
			</tr>
			
		</table>

		";





//$pdf->WriteHTML($ket_discount);
//$pdf->write(10,40,$ket_discount);
$pdf->WriteHTML("<font color='#ffffff' size='50px'>...........................................................................................................................</font><b>HONDA BINTARO</b>
<br>
<font color='#ffffff'>.................................................................................................................</font><b>PERMOHONAN UNIT KELUAR</b>
");
$pdf->WriteHTML($html);
//$pdf->text(64,26,'...............................................................................................................................');
//$pdf->text(64,31.2,'...............................................................................................................................');

//$pdf->text(52.5,36.6,'..................................................................................................................................................................................................................');
$pdf->text(52.5,41.6,'..................................................................................................................................................................................................................');
$pdf->text(52.5,47.4,'..................................................................................................................................................................................................................');
$pdf->text(52.5,53.8,'..................................................................................................................................................................................................................');
$pdf->text(52.5,59.5,'..................................................................................................................................................................................................................');
$pdf->text(52.5,66,'..................................................................................................................................................................................................................');
$pdf->text(52.5,72.8,'..................................................................................................................................................................................................................');
$pdf->text(52.5,77.8,'..................................................................................................................................................................................................................');
$pdf->text(52.5,84.2,'..................................................................................................................................................................................................................');
$pdf->text(52.5,90,'..................................................................................................................................................................................................................');
$pdf->text(52.5,96.2,'..................................................................................................................................................................................................................');
$pdf->text(52.5,102.2,'..................................................................................................................................................................................................................');
//$pdf->text(52.5,103.4,'....................................................................................................................................................');


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
$pdf->text(143,265,"Dicetak tgl: ". date( 'd-m-Y, H:i:s'));
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