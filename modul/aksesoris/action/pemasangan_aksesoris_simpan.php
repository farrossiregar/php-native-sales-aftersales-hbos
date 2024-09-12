<?php 
		
		if(count($_POST)) {
			
			
						include "../../../config/koneksi.php";		
						session_start();
						date_default_timezone_set('Asia/Jakarta');
		
		                
		                $hari_ini=date("ym");
						$query = "SELECT max(no_permohonan) as last FROM pemasangan_aksesoris WHERE no_permohonan LIKE 'PA$hari_ini%'";
						$hasil = mysql_query($query);
						$data  = mysql_fetch_array($hasil);
						$lastNoTransaksi = $data['last'];
						$lastNoUrut = substr($lastNoTransaksi, 6, 3);
						$nextNoUrut = $lastNoUrut + 1;
						$nextNoTransaksi = $hari_ini.sprintf('%03s', $nextNoUrut);
						$input_form = date ("Y-m-d H:i:s");
						
                        $no_spk = mysql_real_escape_string($_POST['no_spk']);
						$norangka = mysql_real_escape_string($_POST['no_rangka']);
						$no_mesin = mysql_real_escape_string($_POST['no_mesin']);
						$nama_customer = mysql_real_escape_string($_POST['nama_customer']);
						$tipe_mobil = mysql_real_escape_string($_POST['tipe_mobil']);
						$warna = mysql_real_escape_string($_POST['warna']);
						$tahun_buat = mysql_real_escape_string($_POST['tahun_buat']);
						$tgl_unit_keluar = mysql_real_escape_string($_POST['tgl_unit_keluar']);
						
                        mysql_unbuffered_query("insert into pemasangan_aksesoris (no_permohonan, no_spk, no_rangka, no_mesin, nama_sales, nama_customer, tipe_model, warna, tahun_buat,tgl_unit_keluar, input_form, spv_app, mngr_app, salesadm_app, keuangan_app,kode_spv,user_input) 
							values('PA$nextNoTransaksi','$no_spk','$norangka','$no_mesin','$_SESSION[namalengkap]','$nama_customer','$tipe_mobil','$warna',
							'$tahun_buat','$tgl_unit_keluar','$input_form','','','','','$_SESSION[kode_spv]','$_SESSION[username]')");
			
						mysql_unbuffered_query("insert into notif_pemasangan_aksesoris values('','PA$nextNoTransaksi', 'N', 'Y', 'N', 'Y', 'Y', 'N', 'Y', 'N', 'Y', 'N', 'Y', 'N')");
						
						$input1 = $_POST['accs_md'];
						$nomor_transaksi_md = $_POST['accs_bonus_notransaksi_md'];
						$supplier_md = $_POST['accs_bonus_supplier_md'];
						$keterangan_md = $_POST['accs_bonus_keterangan_md'];
						$kode_accs_md = $_POST['kode_accs_md'];
						
                        $no = 0;
						foreach ($input1 as $accs_md) {
							if($accs_md!=''){
							mysql_unbuffered_query("insert into pemasangan_aksesoris_md (no_permohonan,kode_accs,nama_aksesoris,nomor_transaksi,supplier,keterangan) 
							values('PA$nextNoTransaksi','$kode_accs_md[$no]','$accs_md','$nomor_transaksi_md[$no]','$supplier_md[$no]','$keterangan_md[$no]')");	
							$no ++;
							}
						}
						
						$input2 = $_POST['accs_bonus'];
						$nomor_transaksi = $_POST['accs_bonus_notransaksi'];
						$supplier = $_POST['accs_bonus_supplier'];
                        $bonus_keterangan = $_POST['accs_bonus_keterangan'];
						$kode_accs_bonus = $_POST['kode_accs_bonus'];
						
						$no = 0;
						foreach ($input2 as $accs_bonus) {
							if($accs_bonus!=''){
							mysql_unbuffered_query("insert into pemasangan_aksesoris_bonus (no_permohonan,kode_accs,nama_aksesoris,nomor_transaksi,supplier,keterangan) 
							values('PA$nextNoTransaksi','$kode_accs_bonus[$no]','$accs_bonus','$nomor_transaksi[$no]','$supplier[$no]','$bonus_keterangan[$no]')");	
							$no ++;
							}
						}
						
						$input3 = $_POST['accs_tambahan'];
                        $keterangan_tambahan = $_POST['accs_tambahan_keterangan'];
						$harga_jual = $_POST['accs_tambahan_hargajual'];
						
						
						$no = 0;
						foreach ($input3 as $accs_tambahan) {
							if($accs_tambahan!=''){
								$angka_harga_jual = str_replace(".","",$harga_jual[$no]);
								
								mysql_unbuffered_query("insert into pemasangan_aksesoris_tambahan (no_permohonan,nama_aksesoris,keterangan,harga_jual) 
								values('PA$nextNoTransaksi','$accs_tambahan','$keterangan_tambahan[$no]','$angka_harga_jual')");	
								$no ++;
							}
						}
						
						
						header("location:../../../media_showroom.php?module=aksesoris_pemasangan_aksesoris&status=ok"); 
						
							

					}

					
				
				
?>