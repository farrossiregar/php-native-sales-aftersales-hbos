
			
	<?php 
		include "../../../config/koneksi.php";		
		session_start();
		date_default_timezone_set('Asia/Jakarta');
				
		if(count($_POST)) {
			
			
						$harga_otr=str_replace(".","",$_POST['harga_otr']);
		                $discount_unit=str_replace(".","",$_POST['discount_unit']);
		                $pengajuan_disc=str_replace(".","",$_POST['pengajuan_disc']);
		                $total_discount_accs=str_replace(".","",$_POST['total_discount_accs']);
		                $refund=str_replace(".","",$_POST['refund']);
			
						$tgl = date("Y-m-d H:i:s")	;	
					
						$no_spk = mysql_real_escape_string($_POST['no_spk']);
						
						
						$tipe = mysql_real_escape_string($_POST['tipe_mobil']);
						
						

						$hari_ini = date('Y-m-d');


						$tgl_pengajuan =mysql_real_escape_string($_POST['waktu']);
						
						
						$no_pengajuan = mysql_real_escape_string($_POST['no_pengajuan']);
						$ket_discount = mysql_real_escape_string($_POST['ket_discount']);
						$cara_beli = mysql_real_escape_string($_POST['cara_beli']);
						$leasing = "";
						$tenor = "";
						if ($cara_beli == "KREDIT"){
							$leasing = mysql_real_escape_string($_POST['leasing']);
							$tenor = mysql_real_escape_string($_POST['tenor']);
						}
						
						$promo_dealer = mysql_real_escape_string($_POST['promo_dealer']);
						$nama_customer = mysql_real_escape_string($_POST['nama_customer']);
						$jenis_identitas = mysql_real_escape_string($_POST['jenis_identitas']);
						$no_identitas = mysql_real_escape_string($_POST['no_identitas']);
						$hp_customer = mysql_real_escape_string($_POST['hp_customer']);
						$alamat_customer = mysql_real_escape_string($_POST['alamat_customer']);
						$asal_prospek = mysql_real_escape_string($_POST['asal_prospek']);
						$ket_asal_prospek = "";
						if ($asal_prospek != "RETAIL"){
							$ket_asal_prospek = mysql_real_escape_string($_POST['ket_asal_prospek']);
						}
						$model = mysql_real_escape_string($_POST['model']);
						$tipe_mobil = mysql_real_escape_string($_POST['tipe_mobil']);
						$warna = mysql_real_escape_string($_POST['warna']);
						$tahun_buat = mysql_real_escape_string($_POST['tahun_buat']);
						$ikut_asuransi = mysql_real_escape_string($_POST['ikut_asuransi']);
						$asuransi = mysql_real_escape_string($_POST['asuransi']);
						$ket_asuransi = mysql_real_escape_string($_POST['ket_asuransi']);
						
						
						
				if (strlen(trim($_POST['pengajuan_disc'])) >= 1 AND strlen(trim($_POST['promo_dealer'])) >= 2 AND strlen(trim($_POST['cara_beli'])) >= 1
					AND strlen(trim($_POST['ket_discount'])) >= 2 and strlen($_SESSION['username']) >=1){
						
						
						if ($_POST['cara_beli'] == "KREDIT" AND strlen(trim($_POST['leasing'])) <= 2 AND strlen(trim($_POST['tenor'])) <= 2 ){
							header("location:../../../media_showroom.php?module=prospek_pengajuandiscount&status=kosong"); 
						}else {
							if ($_POST['asal_prospek'] != "RETAIL" and strlen(trim($_POST['ket_asal_prospek'])) <= 2 )
							{
								header("location:../../../media_showroom.php?module=prospek_pengajuandiscount&status=kosong"); 
								return false;
							}
							
							if ($_POST['cara_beli'] != "KREDIT" and strlen(trim($_POST['ikut_asuransi'])) < 1){
								header("location:../../../media_showroom.php?module=prospek_pengajuandiscount&status=kosong"); 
								return false;
							}
							if ($_POST['cara_beli'] != "KREDIT" and $_POST['ikut_asuransi'] == "Y" and strlen(trim($_POST['asuransi'])) < 1 ){
								header("location:../../../media_showroom.php?module=prospek_pengajuandiscount&status=kosong"); 
								return false;
							}
						
						$plafon_diskon = 0;
						$harga_jual = 0;
						
						// Pengecekan inputan User
						if ($no_spk == ""){

							$uery = mysql_query("select tw.*,IFNULL(pf.plafon_diskon,0) as plafon_diskon from tipe_warna tw 
							left join plafon_diskon pf on pf.kode_tipe = tw.kode_tipe and pf.tahun_buat = '$tahun_buat' and ('$hari_ini' >= pf.tgl_awal and '$hari_ini' <= pf.tgl_akhir)
							where tw.kode_tipe = '$tipe' and tw.kode_warna = '$warna'  ");

							$record_warna = mysql_num_rows($uery);

							if ($record_warna >0){
								$hasil = mysql_fetch_array($uery); 
								
								$plafon_diskon = $hasil['plafon_diskon'];
								$harga_jual = $hasil['harga_jual'];
								
							} else {
								
								$cuery = mysql_query("SELECT t.*,IFNULL(pf.plafon_diskon,0) as plafon_diskon FROM tipe t 
								left join plafon_diskon pf on pf.kode_tipe = t.kode_tipe and pf.tahun_buat = '$tahun_buat' and ('$hari_ini' >= pf.tgl_awal and '$hari_ini' <= pf.tgl_akhir)
								where t.kode_tipe = '$tipe' ");
								
								$record_tipe = mysql_num_rows($cuery);
								if ($record_tipe >= 1) {
									$hasil = mysql_fetch_array($cuery); 
									
									$plafon_diskon = $hasil['plafon_diskon'];
									$harga_jual = $hasil['harga_jual'];
								}else {
									$plafon_diskon = 0;
									$harga_jual = 0;
								}
							}

						}else {
	
							$uery = mysql_query("select tw.*,IFNULL(pf.plafon_diskon,0) as plafon_diskon from tipe_warna tw 
							left join plafon_diskon pf on pf.kode_tipe = tw.kode_tipe and pf.tahun_buat = '$tahun_buat' and ('$tgl_pengajuan' >= pf.tgl_awal and '$tgl_pengajuan' <= pf.tgl_akhir)
							where tw.kode_tipe = '$tipe' and tw.kode_warna = '$warna'  ");

							$record_warna = mysql_num_rows($uery);

							if ($record_warna >0){
								$hasil = mysql_fetch_array($uery); 
								
								//echo $hasil['plafon_diskon'].$hasil['harga_jual'];
								$plafon_diskon = $hasil['plafon_diskon'];
								$harga_jual = $hasil['harga_jual'];
							} else {
								
								$cuery = mysql_query("SELECT t.*,IFNULL(pf.plafon_diskon,0) as plafon_diskon FROM tipe t 
								left join plafon_diskon pf on pf.kode_tipe = t.kode_tipe and pf.tahun_buat = '$tahun_buat' and ('$tgl_pengajuan' >= pf.tgl_awal and '$tgl_pengajuan' <= pf.tgl_akhir)
								where t.kode_tipe = '$tipe' ");
								
								$record_tipe = mysql_num_rows($cuery);
								if ($record_tipe >= 1) {
								
									$hasil = mysql_fetch_array($cuery); 
									//echo $hasil['plafon_diskon'].$hasil['harga_jual'];
									
									$plafon_diskon = $hasil['plafon_diskon'];
									$harga_jual = $hasil['harga_jual'];
								
								}else {
									//echo 10;
									$plafon_diskon = 0;
									$harga_jual = 0;
								}
							}
							
						}
						
						
						
						
						
						//return false;
						
						
						
						//Update status pada pengajuan diskon
						$query_pengajuandiscount = mysql_query(" select * from pengajuan_discount where no_pengajuan = '$_POST[no_pengajuan]' ");
						$data_pengajuandiscount = mysql_fetch_array($query_pengajuandiscount);
						
						if ($data_pengajuandiscount['status_spk'] == 'Y' ){							
							mysql_unbuffered_query("update pengajuan_discount set status_approved = 'N', proses_approve = 'N',pengajuan_ulang = 'Y' where no_pengajuan = '$_POST[no_pengajuan]'");
						}else {
							
							$kode_spv_sales = mysql_unbuffered_query("select * from users where username = '$_SESSION[username]'");
							$data_kode_spv_sales = mysql_fetch_array($kode_spv_sales);
							$kode_spv = $data_kode_spv_sales['kode_supervisor'];
							mysql_unbuffered_query("update pengajuan_discount set status_approved = 'N', proses_approve = 'N',pengajuan_ulang = 'Y', tgl_pengajuan_ulang = '$tgl', kode_spv = '$kode_spv'  where no_pengajuan = '$_POST[no_pengajuan]'");
						
						//	mysql_unbuffered_query("update pengajuan_discount set status_approved = 'N', proses_approve = 'N',pengajuan_ulang = 'Y',tgl_pengajuan_ulang = '$tgl' where no_pengajuan = '$_POST[no_pengajuan]'");
						}
						
						
						
						
						//update status pengajuan diskon yang sudah ada menjadi kagak aktif
						mysql_unbuffered_query("update pengajuan_discount_ulang set aktif = 'N' where no_pengajuan = '$_POST[no_pengajuan]' ");
						
						
						
						
						
						
						
						//Insert record ke pengajuan discount ulang
						mysql_unbuffered_query("insert into pengajuan_discount_ulang (no_pengajuan,ket_discount,harga_otr,discount_unit,pengajuan_disc,total_discount_accs,refund,cara_beli,leasing,tenor,promo_dealer,tanggal,aktif,nama_customer,
						jenis_identitas,no_identitas,hp_customer,alamat_customer,asal_prospek,ket_asal_prospek,model,tipe_mobil,warna,tahun_buat,ikut_asuransi,asuransi,ket_asuransi) 
						values ('$no_pengajuan','$ket_discount','$harga_jual','$plafon_diskon','$pengajuan_disc','$total_discount_accs','$refund','$cara_beli','$leasing',
						'$tenor','$promo_dealer','$tgl','Y','$nama_customer',
						'$jenis_identitas','$no_identitas','$hp_customer','$alamat_customer','$asal_prospek','$ket_asal_prospek',
						'$model','$tipe_mobil','$warna','$tahun_buat','$ikut_asuransi','$asuransi','$ket_asuransi')");
						
						//mysql_unbuffered_query("insert into notif (no_pengajuan,read_admin,read_mngr,read_drksi,read_user,notif_admin,notif_mngr,notif_drksi,notif_user) values ('$_POST[no_pengajuan]','N','N','N','N','Y','Y','Y','Y')");
						$query_notif = mysql_query("select * from notif where no_pengajuan = '$_POST[no_pengajuan]'")	;		
						$row_notif = mysql_num_rows($query_notif);
						
						if ($row_notif > 0){
							mysql_unbuffered_query("update notif set read_admin = 'N',read_mngr = 'N', read_drksi = 'N', read_user = 'N',notif_admin = 'Y',notif_mngr = 'Y',notif_drksi = 'Y',notif_user = 'Y' where no_pengajuan = '$_POST[no_pengajuan]'");
						}else{
							mysql_unbuffered_query("insert into notif (no_pengajuan,read_admin,read_mngr,read_drksi,read_user,notif_admin,notif_mngr,notif_drksi,notif_user, username) values ('$_POST[no_pengajuan]','N','N','N','N','Y','Y','Y','Y','$_SESSION[username]'))");
						
						}
						
						
                        $a = "select t.nama_tipe as nama_tipe, w.nama_warna as nama_warna, m.nama_model as nama_model ,pd.no_pengajuan,pd.nama_sales ,pd.no_spk,pd.pemohon,pdu.* from pengajuan_discount pd 
								
							
								left join pengajuan_discount_ulang pdu on pdu.no_pengajuan = pd.no_pengajuan
                    			left join tipe t on t.kode_tipe=pdu.tipe_mobil
                    			left join model m on m.kode_model=pdu.model
                    			left join warna w on w.kode_warna=pdu.warna
                    			where pd.no_pengajuan='$_POST[no_pengajuan]' and pdu.aktif = 'Y' ";
                    	
                    	$kueri = mysql_query($a);
                    	$r = mysql_fetch_array($kueri);
	
	
	                    $statusaprrov=$r[proses_approve];
    					    if($statusaprrov=="Y") {
    						    $statusaprrov="Disetujui"; 
    						}
    						if($statusaprrov=="N") {
    						    $statusaprrov="Tidak Disetujui"; 
    						}
	                    
	                    $harga_otr = "Rp ".number_format("$r[harga_otr]",0,".",".");
						$discount_unit = "Rp ".number_format("$r[discount_unit]",0,".",".");
						$total_discount_accs = "Rp ".number_format("$r[total_discount_accs]",0,".",".");
						$pengajuan_disc = "Rp ".number_format("$r[pengajuan_disc]",0,".",".");
						$total_discount = $r['pengajuan_disc'] + $r['total_discount_accs'] ;
						$total_discount = "Rp ".number_format("$total_discount",0,".",".");
						$no_spk = $r['no_spk'];
						
						$refund = "Rp ".number_format("$r[refund]",0,".",".");
						
						
						$email_pemohon = mysql_fetch_array(mysql_query("select * from users where username = '$_SESSION[username]' ")) ;
	                    $email_pemohon = $email_pemohon['email'];
						
						$pengajuan = "Y";
						$pengajuan_ulang = "Y";
						$ajukan_lagi = "N";
						$approve = "N";
						
	
                        $to = "gusti_it@honda-bintaro.com, abdullah_it@honda-bintaro.com, benni_it@honda-bintaro.com,burli_sales@honda-bintaro.com";
						//$to = "gusti_it@honda-bintaro.com";
						
						                        
						
						$subject = "Informasi Pengajuan Ulang Diskon Online";
						
						$message = "
						
						<html>
                    	<head>
                    	<title>Informasi Pengajuan Ulang Diskon Online</title>
                    	</head>
                    	<body>
                    	<table width='50%' border='0' align='center' cellpadding='0' cellspacing='0'>
                    	<tr>
                    	<td colspan='2' align='center' valign='top'><img style=' margin-top: 15px; ' src='http://www.honda-bintaro.com/wp-content/uploads/2016/04/logo-honda-1-300x138.png' ></td>
                    	</tr>
                    	<tr>
                    	<td width='50%' align='right'>&nbsp;</td>
                    	<td align='left'>&nbsp;</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>No Pengajuan:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[no_pengajuan]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Tgl Pengajuan:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[tanggal]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>No SPK:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[no_spk]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Nama Sales:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[nama_sales]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Nama Customer:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[nama_customer]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Unit:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[nama_model]." ".$r[nama_tipe]." ".$r[nama_warna]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Harga OTR:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$harga_otr."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Diskon Plafon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$discount_unit."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Pengajuan Diskon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$pengajuan_disc."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; border-bottom:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Keterangan Diskon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; border-bottom:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".nl2br($r[ket_discount])."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Total Diskon Aksesoris:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$total_discount_accs."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Refund:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$refund."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Total Diskon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$total_discount."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Metode Pembayaran:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[cara_beli]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Nama Leasing:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[leasing]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Tenor:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[tenor]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Pemohon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$r[pemohon]."</td>
                    	</tr>
						
                    	</table>
                    	</body>
                    	</html>
						
						<br /><br />
						Please don't reply this email,
						<br /><br />
						IT Team.
						<br /><br />
						<font color='#b4b4b4'>DISCLAIMERS : This e-mail, including any attachment is confidential. Use or disclosure of it by anyone other than an intended addressee is strictly prohibited. If you are not an intended addressee, please notify the sender by telephone or e-mail and delete the e-mail and any attachment from your system. PT. Gading Prima Perkasa does not accept any liability in respect of communication made by its employee which is contrary to the company policy or outside the scope of the employment of the individual concerned. The employee responsible will be personally liable for any damages or other liability arising.</font>
						";
	                    
	                    
	                    // Always set content-type when sending HTML email
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        // More headers
                        $headers .= 'From: <pengajuan.diskon@honda-bintaro.com>' . 'pengajuan Ulang Diskon Honda Bintaro';
                        
						
						
                        $server_lokal = 'Y';
						
						if ($server_lokal != "Y"){
							 $mail_sent = @mail( $to, $subject, $message, $headers );
						}else{
							//echo "asdfasdf";
							include "php_mailer/kirim_email.php";
							
						}
	
					
					
					
				
				
?>
					
		
		<?php header("location:../../../media_showroom.php?module=prospek_pengajuandiscount&status=ok"); 
				}
				
				}else {
					
					header("location:../../../media_showroom.php?module=prospek_pengajuandiscount&status=kosong");
				}
		
}?>
		
		
		
		
		
