

		
	<?php 
		include "../../config/koneksi.php";		
		session_start();
		date_default_timezone_set('Asia/Jakarta');
		
		
		if(count($_POST)) {
		                $harga_otr=str_replace(".","",$_POST['harga_otr']);
		                $discount_unit=str_replace(".","",$_POST['discount_unit']);
		                $pengajuan_disc=str_replace(".","",$_POST['pengajuan_disc']);
		                $total_discount_accs=str_replace(".","",$_POST['total_discount_accs']);
		                $refund=str_replace(".","",$_POST['refund']);
		                $total_discount=str_replace(".","",$_POST['total_discount']);
		                
		                $hari_ini=date("ym");
                                                $query = "SELECT max(no_pengajuan) as last FROM pengajuan_discount WHERE no_pengajuan LIKE 'PD$hari_ini%'";
                                                $hasil = mysql_query($query);
                                                $data  = mysql_fetch_array($hasil);
                                                $lastNoTransaksi = $data['last'];
                                                $lastNoUrut = substr($lastNoTransaksi, 6, 3);
                                                $nextNoUrut = $lastNoUrut + 1;
                                                $nextNoTransaksi = $hari_ini.sprintf('%03s', $nextNoUrut);
						

							
						$query_cek = mysql_query("select * from pengajuan_discount where nama_customer = '$_POST[nama_customer]' and username_pemohon = '$_SESSION[username]' and warna = '$_POST[warna]' and tipe_mobil = '$_POST[tipe_mobil]' ");
						$cek_double = mysql_num_rows($query_cek);
						
					if ( strlen(trim($_POST['nama_sales'])) >= 2 AND strlen(trim($_POST['nama_customer'])) >= 2 AND strlen(trim($_POST['jenis_identitas'])) >= 1 AND strlen(trim($_POST['no_identitas'])) >= 2 AND strlen(trim($_POST['hp_customer'])) >= 10
						AND strlen(trim($_POST['alamat_customer'])) >= 5 AND strlen(trim($_POST['model'])) >= 2 AND strlen(trim($_POST['tipe_mobil'])) >= 2 AND strlen(trim($_POST['warna'])) >= 2 AND strlen(trim($_POST['tahun_buat'])) >= 2
						AND strlen(trim($_POST['harga_otr'])) >= 2 AND strlen(trim($_POST['promo_dealer'])) >= 2 AND strlen(trim($_POST['cara_beli'])) >= 1
						AND strlen(trim($_POST['discount_unit'])) >= 1 AND strlen(trim($_POST['pengajuan_disc'])) >= 1 AND strlen(trim($_POST['ket_discount'])) >= 2 and strlen($_SESSION['username']) >=1 AND strlen(trim($_POST['asal_prospek'])) >= 1 ){
						
						if ($_POST['cara_beli'] == "KREDIT" AND strlen(trim($_POST['leasing'])) <= 2 AND strlen(trim($_POST['tenor'])) <= 2 ){
							header("location:../../media_showroom.php?module=sub_transaksi_pengajuan_discount&status=kosong"); 
						}else {
							if ($_POST['asal_prospek'] != "RETAIL" and strlen(trim($_POST['ket_asal_prospek'])) <= 2 )
							{
								header("location:../../media_showroom.php?module=sub_transaksi_pengajuan_discount&status=kosong"); 
								return false;
							}
							
							if ($_POST['cara_beli'] != "KREDIT" and strlen(trim($_POST['ikut_asuransi'])) < 1){
								header("location:../../media_showroom.php?module=sub_transaksi_pengajuan_discount&status=kosong"); 
								return false;
							}
							if ($_POST['cara_beli'] != "KREDIT" and $_POST['ikut_asuransi'] == "Y" and strlen(trim($_POST['asuransi'])) < 1 ){
								header("location:../../media_showroom.php?module=sub_transaksi_pengajuan_discount&status=kosong"); 
								return false;
							}
						
						if ($cek_double >= 1){
							header("location:../../media_showroom.php?module=sub_transaksi_pengajuan_discount&status=gagal"); 
						}else {
                            $double = 'N';
							$postok = 'Y';
							
                        mysql_unbuffered_query("insert into pengajuan_discount (no_pengajuan,hp_customer,alamat_customer,jenis_identitas,no_identitas,nama_customer,model,tipe_mobil,warna,harga_otr,discount_unit,pengajuan_disc,ket_discount,total_discount_accs,refund,total_discount,waktu
							,status_approved,cara_beli,leasing,tenor,pemohon,username_pemohon,nama_sales,kode_spv,tahun_buat,promo_dealer,tgl_pengajuan_ulang,asal_prospek,ket_asal_prospek,ikut_asuransi,asuransi, ket_asuransi) 
							values('PD$nextNoTransaksi','$_POST[hp_customer]','$_POST[alamat_customer]','$_POST[jenis_identitas]','$_POST[no_identitas]','$_POST[nama_customer]','$_POST[model]','$_POST[tipe_mobil]','$_POST[warna]','$harga_otr','$discount_unit','$pengajuan_disc','$_POST[ket_discount]','$total_discount_accs','$refund','$total_discount','$_POST[waktu]','N','$_POST[cara_beli]'
							,'$_POST[leasing]','$_POST[tenor]','$_SESSION[namalengkap]','$_SESSION[username]','$_POST[nama_sales]','$_SESSION[kode_spv]','$_POST[tahun_buat]','$_POST[promo_dealer]','$_POST[waktu]','$_POST[asal_prospek]','$_POST[ket_asal_prospek]','$_POST[ikut_asuransi]','$_POST[asuransi]','$_POST[ket_asuransi]')");
						
						mysql_unbuffered_query("insert into notif (no_pengajuan,read_admin,read_mngr,read_drksi,read_user,notif_admin,notif_mngr,notif_drksi,notif_user, username) values ('PD$nextNoTransaksi','N','N','N','N','Y','Y','Y','Y','$_SESSION[username]')");

												
							$msg = "
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Berhasil menambah data.</div>";                        
		                
		                
				        $abc = "select t.nama_tipe as nama_tipe, w.nama_warna as nama_warna, m.nama_model as nama_model ,pd.* from pengajuan_discount pd 
				        left join tipe t on t.kode_tipe=pd.tipe_mobil
				        left join model m on m.kode_model=pd.model
				        left join warna w on w.kode_warna=pd.warna
				        where pd.no_pengajuan='PD$nextNoTransaksi'";
				        
				        //$a = "select * from pengajuan_discount where no_pengajuan='PD$nextNoTransaksi'";
                    	$kueri = mysql_query($abc);
                    	$r = mysql_fetch_array($kueri);
						
						$model = $r['nama_model'];
						$tipe_mobil = $r['nama_tipe'];
						$warna = $r['nama_warna'];
						
					    
						$today = date("Ymd"); //untuk mengambil tahun, tanggal dan bulan Hari INI
						
						$email_pemohon = mysql_fetch_array(mysql_query("select * from users where username = '$_SESSION[username]' ")) ;
	                    $email_pemohon = $email_pemohon['email'];
						
						
						$pengajuan = "Y";
						$pengajuan_ulang = "N";
						$ajukan_lagi = "N";
						$approve = "N";
						
						
						$to = "gusti_it@honda-bintaro.com, benni_it@honda-bintaro.com, abdullah_it@honda-bintaro.com,burli_sales@honda-bintaro.com, $email_pemohon ";
						//$to = "gusti_it@honda-bintaro.com";
						
						                        
						
						$subject = "Informasi Pengajuan Diskon Online";
						$message = "
						
						<html>
                    	<head>
                    	<title>Informasi Pengajuan Diskon Online</title>
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
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>PD".$nextNoTransaksi."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Tgl Pengajuan:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST['waktu']."</td>
                    	</tr>
						<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Nama Sales:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[nama_sales]."</td>
                    	</tr>
                    							
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Nama Customer:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[nama_customer]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Unit:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$model." ".$tipe_mobil." ".$warna."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Harga OTR:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[harga_otr]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Diskon Unit:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[discount_unit]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Pengajuan Diskon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[pengajuan_disc]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; border-bottom:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Keterangan Diskon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; border-bottom:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".nl2br($_POST[ket_discount])."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Total Diskon Aksesoris:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[total_discount_accs]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Refund:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[refund]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Total Diskon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[total_discount]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Metode Pembayaran:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[cara_beli]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Nama Leasing:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[leasing]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Tenor:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_POST[tenor]."</td>
                    	</tr>
                    	<tr>
                    	<td align='right' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 5px 7px 0;'>Pemohon:</td>
                    	<td align='left' valign='top' style='border-top:1px solid #dfdfdf; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000; padding:7px 0 7px 5px;'>".$_SESSION[namalengkap]."</td>
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
						
						//DAH GAK KEPAKE NIH, ADA YANG BARU MAH LUPA SAMA YG LAMA T_T
                        //$message .= "No Pengajuan           : PD$nextNoTransaksi \n";
                        //$message .= "Tgl Pengajuan          : $_POST[waktu] \n";
                        //$message .= "No SPK                 : $_POST[no_spk] \n";
                        //$message .= "Nama Customer          : $_POST[nama_customer] \n";
                        //$message .= "Harga OTR              : $_POST[harga_otr] \n";
                        //$message .= "Diskon Unit            : $_POST[discount_unit] \n";
                        //$message .= "Pengajuan Diskon       : $_POST[pengajuan_disc] \n";
                        //$message .= "Keteranga  Diskon      : $_POST[ket_discount] \n";
                        //$message .= "Total Diskon Aksesoris : $_POST[total_discount_accs] \n";
                        //$message .= "Refund                 : $_POST[refund] \n";
                        //$message .= "Total Diskon           : $_POST[total_discount] \n";
                        //$message .= "Metode Pembayaran      : $_POST[cara_beli] \n";
                        //$message .= "Nama Leasing           : $_POST[leasing] \n";
                        //$message .= "Tenor                  : $_POST[tenor] \n";
                        //$message .= "Pemohon                : $_SESSION[namalengkap] \n";
                        
                        // Always set content-type when sending HTML email
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        //$headers .= 'From: <pengajuan.diskon@honda-bintaro.com>' . "Pengajuan Diskon Honda Bintaro";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        // More headers
                        $headers .= 'From: <pengajuan.diskon@honda-bintaro.com>' . 'Pengajuan Diskon Honda Bintaro';
                        
                       
						
							
						$server_lokal = 'Y';
						
						if ($server_lokal != "Y"){
							 $mail_sent = @mail( $to, $subject, $message, $headers );
						}else{
							//echo "asdfasdf";
							include "php_mailer/kirim_email.php";
							
						}

						
					
						header("location:../../media_showroom.php?module=sub_transaksi_pengajuan_discount&status=ok"); 
						}
						
						}}else {
						header("location:../../media_showroom.php?module=sub_transaksi_pengajuan_discount&status=kosong"); 
					}
			
			
		
		
		
		
		}?>
		
		
		
		
		
